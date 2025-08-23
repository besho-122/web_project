//Profile Sections

let password = document.getElementById('password-section');
let settings = document.getElementById('settings-section');
let cart = document.getElementById('cart-section');
let profile = document.getElementById('personal-info');
let orders = document.getElementById('orders-section');
document.querySelectorAll('aside nav .password').forEach(button => {
  button.addEventListener('click', () => {
    profile.classList.add('hidden');
    password.style.display = 'block';
    settings.style.display = 'none';
    cart.style.display = 'none';
    orders.style.display = 'none';
  });
});
document.querySelectorAll('aside nav .cart').forEach(button => {
  button.addEventListener('click', () => {
     profile.classList.add('hidden');
    cart.style.display = 'block';
    password.style.display = 'none';
    settings.style.display = 'none';
    orders.style.display = 'none';
  });
});
document.querySelectorAll('aside nav .Settings').forEach(button => {
  button.addEventListener('click', () => {
     profile.classList.add('hidden');
    settings.style.display = 'block';
      cart.style.display = 'none';
    password.style.display = 'none';
    orders.style.display = 'none';
  });
});
document.querySelectorAll('aside nav .information').forEach(button => {
  button.addEventListener('click', () => {
    profile.classList.remove('hidden');
    settings.style.display = 'none';
    cart.style.display = 'none';
    password.style.display = 'none';
    orders.style.display = 'none';
  });
});

document.querySelectorAll('aside nav .Orders').forEach(button => {
  button.addEventListener('click', () => {
     profile.classList.add('hidden');
    settings.style.display = 'none';
      cart.style.display = 'none';
    password.style.display = 'none';
    orders.style.display = 'block';
  });
});



(function () {
  const cartSection = document.getElementById('cart-section');

  function getCart() {
    return JSON.parse(localStorage.getItem('cartCars')) || [];
  }

  function setCart(list) {
    localStorage.setItem('cartCars', JSON.stringify(list));
  }

  function renderCart() {
    const cartCars = getCart();

    if (!cartCars.length) {
      cartSection.innerHTML = `<h1 class="empty-cart">
      
  <span class="word">No</span> 
  <span class="word special">cars</span> 
  <span class="word">in</span> 
  <span class="word">cart</span>
</h1>
`;
      return;
    }

    const carsHtml = cartCars.map(car => {
      const id = car.id ?? '';                
      const name = car.name ?? 'Unknown';
      const img = car.image ?? '';
      const description = car.description ?? '';

      return `
        <div class="car-card-small" data-id="${id}">
          <button class="btnRemoveFromCart" data-id="${id}" title="Remove">
            <i class="fa fa-times"></i>
          </button>
          <img src="${img}" alt="${name}" />
          <h3>${name}</h3>
          <p>${description}</p>
          <a class="btnShowDetails" href="../pages/model.php?id=${encodeURIComponent(id)}">Show Details</a>
        </div>
      `;
    }).join('');



    cartSection.innerHTML = `
      <div class="cart-items-container">
        ${carsHtml}
        <div class="Buynow">
          <button class="btnBuyNow" >Buy Now</button>
        </div>
      </div>
    `;
  }

  cartSection.addEventListener('click', (e) => {

    const btn = e.target.closest('.btnRemoveFromCart');
    if (!btn) return;

    const id = btn.getAttribute('data-id');
    if (!id) return;
   
    let cartCars = getCart();
    cartCars = cartCars.filter(car => String(car.id) !== String(id));
    setCart(cartCars);
   window.renderCart && window.renderCart();
    updateCartCount();

   
  });

  document.addEventListener('DOMContentLoaded', renderCart);
  window.renderCart = renderCart;
})();
 function removeFromCart(name) {
  let cartCars = JSON.parse(localStorage.getItem('cartCars')) || [];
  cartCars = cartCars.filter(car => car.name !== name);
  localStorage.setItem('cartCars', JSON.stringify(cartCars));
 window.renderCart && window.renderCart();
 
 }


const themeColorPicker = document.getElementById('themeColorPicker');
themeColorPicker.addEventListener('input', (e) => {
  document.documentElement.style.setProperty('--accent-color', e.target.value);
});

//////////////////// doop down //////////////
document.querySelectorAll('.nav-item-dropdown').forEach(link => {
  link.addEventListener('click', (e) => {
    e.preventDefault();       
    e.stopPropagation();         
    const id   = link.dataset.id;
    const name = link.querySelector('.company-name')?.textContent.trim()
              || link.getAttribute('title')?.trim()
              || link.textContent.trim();
    if (id)   localStorage.setItem('modelId', id);
    if (name) localStorage.setItem('modelName', name);
    window.location.href = "../pages/filter.php";
  });
});
/////

// order ////////


document.addEventListener("click", async (e) => {
  const btn = e.target.closest(".btnBuyNow");
  if (!btn) return;

  const cart = JSON.parse(localStorage.getItem("cartCars") || "[]");
  const toast = {
    ok:  (m) => (window.iziToast ? iziToast.success({title:"Success",message:m,position:"topRight"}) : alert(m)),
    err: (m) => (window.iziToast ? iziToast.error({title:"Error",  message:m,position:"topRight"}) : alert(m)),
  };
  if (!cart.length) return toast.err("Your cart is empty!");

  btn.disabled = true;
  try {
    const res  = await fetch("../api/order.php", {
      method: "POST",
      headers: {"Content-Type": "application/json"},
      body: JSON.stringify({cars: cart})
    });

    let out, raw = await res.text();
    try { out = JSON.parse(raw); } catch { out = {success:false, message:"Invalid server response"}; }

    if (res.ok && out?.success) {
  localStorage.removeItem("cartCars");
  window.renderCart?.();
  toast.ok("Purchase completed successfully!");
  
  // update unseen orders counter
  let unseen = parseInt(localStorage.getItem("unnoticedOrders") || "0");
  unseen++;
  localStorage.setItem("unnoticedOrders", unseen);

  updateNotifications();
  updateCartCount();
}
else {
      toast.err(out?.message || "Something went wrong!");
    }
  } catch {
  } finally {
    btn.disabled = false;
  }
});

/////  cart ///// 
function getCart(){ try { return JSON.parse(localStorage.getItem('cartCars')) || []; } catch { return []; } }

function updateCartCount(){
  const count = getCart().length; 
  const el = document.getElementById('cartCount');
  if (!el) return;
  el.textContent = count;
  el.style.display = count > 0 ? 'inline-block' : 'none';
}

document.addEventListener('DOMContentLoaded', updateCartCount);


window.addEventListener('storage', (e) => {
  if (e.key === 'cartCars') updateCartCount();
});


///// /form another page to cart function besho //
(function () {
  const openTabFromURL = () => {
    const params = new URLSearchParams(window.location.search);
    const tab = (params.get('tab') || '').toLowerCase(); 
    if (!tab) return;
    const clickIf = (selector) => document.querySelector(selector)?.click();

    switch (tab) {
      case 'cart':
        clickIf('aside nav .cart');
        window.renderCart && window.renderCart();
        (typeof updateCartCount === 'function') && updateCartCount();
        break;
      case 'settings':
        clickIf('aside nav .Settings');
        break;
      case 'password':
        clickIf('aside nav .password');
        break;
      case 'orders':
        clickIf('aside nav .Orders');
        break;
      default:
        clickIf('aside nav .information');
    }
  };

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', openTabFromURL);
  } else {
    openTabFromURL();
  }
})();