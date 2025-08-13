//Profile Sections
let password = document.getElementById('password-section');
let settings = document.getElementById('settings-section');
let cart = document.getElementById('cart-section');
let profile = document.getElementById('personal-info');
document.querySelectorAll('aside nav .password').forEach(button => {
  button.addEventListener('click', () => {
    profile.classList.add('hidden');
    password.style.display = 'block';
    settings.style.display = 'none';
    cart.style.display = 'none';
  });
});
document.querySelectorAll('aside nav .cart').forEach(button => {
  button.addEventListener('click', () => {
     profile.classList.add('hidden');
    cart.style.display = 'block';
    password.style.display = 'none';
    settings.style.display = 'none';
  });
});
document.querySelectorAll('aside nav .Settings').forEach(button => {
  button.addEventListener('click', () => {
     profile.classList.add('hidden');
    settings.style.display = 'block';
      cart.style.display = 'none';
    password.style.display = 'none';
  });
});
document.querySelectorAll('aside nav .information').forEach(button => {
  button.addEventListener('click', () => {
     profile.classList.remove('hidden');
    settings.style.display = 'none';
      cart.style.display = 'none';
    password.style.display = 'none';
  });
});



//Cart Reception
document.addEventListener("DOMContentLoaded", () => {
  const cartSection = document.getElementById('cart-section');
  let currentPage = 1;
  const itemsPerPage = 2;
  function renderCart() {
    let cartCars = JSON.parse(localStorage.getItem('cartCars')) || [];
    if (cartCars.length === 0) {
      cartSection.innerHTML = `<p>No cars in cart.</p>`;
      return;
    }
    const startIndex = (currentPage - 1) * itemsPerPage;
    const endIndex = startIndex + itemsPerPage;
    const displayedCars = cartCars.slice(startIndex, endIndex);
    const carsHtml = displayedCars.map(car => `
      <div class="car-card-small">
        <img src="${car.image}" alt="${car.name}" />
        <h3>${car.name}</h3>
        <p>${car.description}</p>
        <a class="btnShowDetails" href="../pages/model.html" data-name="${car.name}">Show Details</a>
      </div>
    `).join('');
    const totalPages = Math.ceil(cartCars.length / itemsPerPage);
    let paginationHtml = `<ul class="pagination">`;
    paginationHtml += `
      <li class="page-item">
        <a class="page-link" href="#" data-page="${currentPage - 1}" aria-label="Previous" ${currentPage === 1 ? 'style="pointer-events:none;opacity:0.5;"' : ''}>
          <span aria-hidden="true">&laquo;</span>
        </a>
      </li>
    `;
    let startPage = Math.max(1, currentPage - 1);
    let endPage = Math.min(totalPages, startPage + 1);
    if (endPage - startPage < 1 && startPage > 1) {
      startPage--;
    }
    for (let i = startPage; i <= endPage; i++) {
      paginationHtml += `
        <li class="page-item ${i === currentPage ? 'active' : ''}">
          <a class="page-link" href="#" data-page="${i}">${i}</a>
        </li>
      `;
    }
    paginationHtml += `
      <li class="page-item">
        <a class="page-link" href="#" data-page="${currentPage + 1}" aria-label="Next" ${currentPage === totalPages ? 'style="pointer-events:none;opacity:0.5;"' : ''}>
          <span aria-hidden="true">&raquo;</span>
        </a>
      </li>
    `;
    paginationHtml += `</ul>`;
    cartSection.innerHTML = `
      <div class="cart-items-container">${carsHtml}</div>
      ${paginationHtml}
    `;
    document.querySelectorAll('.page-link').forEach(link => {
      link.addEventListener('click', (e) => {
        e.preventDefault();
        const page = parseInt(link.getAttribute('data-page'));
        if (page >= 1 && page <= totalPages) {
          currentPage = page;
          renderCart();
        }
      });
    });
  }

  renderCart();
});

//Settings
document.querySelectorAll('.toggle-button').forEach(toggle => {
  toggle.addEventListener('click', () => {
    toggle.classList.toggle('active');
    if(toggle.id === 'darkModeToggle'){
      if(toggle.classList.contains('active')){
        document.body.style.background = '#1e1e1e';
        document.body.style.color = '#eee';
      } else {
        document.body.style.background = '#f5f6fa';
        document.body.style.color = '#222';
      }
    }
  });
});
const themeColorPicker = document.getElementById('themeColorPicker');
themeColorPicker.addEventListener('input', (e) => {
  document.documentElement.style.setProperty('--accent-color', e.target.value);
});
