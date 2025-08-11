let cartCars = [
      {
        id: 1,
        name: "Porsche Taycan",
        description: "Electric sports car",
        image: "https://cdn.pixabay.com/photo/2017/01/06/21/06/porsche-1950019_1280.jpg"
      },
      {
        id: 2,
        name: "Tesla Model S",
        description: "Electric luxury sedan",
        image: "https://cdn.pixabay.com/photo/2018/05/08/08/50/tesla-3382347_1280.jpg"
      },
      {
        id: 3,
        name: "BMW i8",
        description: "Hybrid sports car",
        image: "https://cdn.pixabay.com/photo/2016/02/19/11/30/bmw-1209992_1280.jpg"
      }
    ];

    const cartListEl = document.getElementById('cart-list');

    // Render the cart items
    function renderCart() {
      cartListEl.innerHTML = '';
      if(cartCars.length === 0) {
        cartListEl.innerHTML = '<p>Your cart is empty.</p>';
        return;
      }
      cartCars.forEach(car => {
        const li = document.createElement('li');
        li.className = 'cart-item';

        li.innerHTML = `
          <img src="${car.image}" alt="${car.name}" />
          <div class="cart-item-info">
            <h3>${car.name}</h3>
            <p>${car.description}</p>
          </div>
          <button class="cart-remove-btn" aria-label="Remove ${car.name} from cart" data-id="${car.id}">Remove</button>
        `;
        cartListEl.appendChild(li);
      });

      // Add event listeners to remove buttons
      document.querySelectorAll('.cart-remove-btn').forEach(btn => {
        btn.addEventListener('click', e => {
          const id = parseInt(e.target.getAttribute('data-id'));
          cartCars = cartCars.filter(car => car.id !== id);
          renderCart();
        });
      });
    }

    // Initial render
    renderCart();

    // Handle profile form submission (just prevent default here)
    document.getElementById('profile-form').addEventListener('submit', e => {
      e.preventDefault();
      alert('Profile saved!');
    });