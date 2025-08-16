document.addEventListener('DOMContentLoaded', () => {
  const id = localStorage.getItem('modelId');
  if (id) {
    const cb = document.getElementById('checkbox' + id);
    if (cb) {
      cb.checked = true; 
      cb.dispatchEvent(new Event('change', { bubbles: true }));
    }
  }

  

  const modelName = localStorage.getItem('modelName');
  const nameEl = document.querySelector('.nameModel');
  if (nameEl && modelName) nameEl.textContent = modelName;

  const condition = localStorage.getItem('condition');
  if (condition) {
    const cb2 = document.getElementById(condition.toLowerCase()); 
    if (cb2) {
      cb2.checked = true;
      cb2.dispatchEvent(new Event('change', { bubbles: true }));
    }
  }
});

function filterCards() {
  const cards = document.querySelectorAll('.car-card');

  cards.forEach(card => {
    let show = true;

    for (const [group, values] of Object.entries(checkedGroups)) {
      if (!values || values.length === 0) continue;

      const cardValue = card.dataset[group.toLowerCase()] || '';

      // Numeric filters
      if (group === "Price" || group === "Mileage") {
        if (Number(cardValue) > Number(values[0])) {
          show = false;
          break;
        }
      } else if (group === "Company") {
        // CompanyId is numeric
        if (!values.includes(cardValue)) {
          show = false;
          break;
        }
      } else {
        // Text filters: Condition, Model, Exterior, Interior, Year
        const matched = values.some(value =>
          cardValue.toString().toLowerCase().includes(value.toString().toLowerCase())
        );
        if (!matched) {
          show = false;
          break;
        }
      }
    }

    card.style.display = show ? 'flex' : 'none';
  });
}



//Toggle + to - 
const items = document.querySelectorAll('.sidebar .condition');
const itemOne = document.querySelectorAll('.checkCondition');

function setupToggle(conditionSelector, checkConditionSelector) {
  const items = document.querySelectorAll(conditionSelector);

  items.forEach(item => {
    const checkCondition = item.querySelector(checkConditionSelector);
    item.addEventListener('click', (e) => {
      const rect = item.getBoundingClientRect();
      const clickX = e.clientX;
      if (clickX >= rect.right - 20) {
        item.classList.toggle('active');
        const isActive = item.classList.contains('active');
        if (checkCondition) {
          checkCondition.style.display = isActive ? 'block' : 'none';
        }
      }
    });
  });
}

setupToggle('.sidebar .condition', '.checkCondition');
setupToggle('.sidebar .modelSeries', '.SeriesSelect');
setupToggle('.sidebar .modelVarients', '.varientsChecked');
setupToggle('.sidebar .modelGeneration', '.generationChecked');
setupToggle('.sidebar .modelYear', '.yearSelection');
setupToggle('.sidebar .exteriorColour', '.exColor');
setupToggle('.sidebar .interiorColour', '.intColour');
setupToggle('.sidebar .price', '.priceField');
setupToggle('.sidebar .mileAge', '.mileField');
setupToggle('.sidebar .previousOwner', '.ownerField');
setupToggle('.sidebar .location', '.priceField');




// Sorting 
const checkedGroups = {};
function setupCheckboxSorting(checkboxSelector, pText, groupName) {
  const checkboxes = document.querySelectorAll(checkboxSelector);
  const sortingBy = document.querySelector('.sortingBy');
  checkboxes.forEach(checkbox => {
    checkbox.addEventListener('change', () => {
      checkedGroups[groupName] = Array.from(checkboxes)
        .filter(cb => cb.checked)
        .map(cb => cb.value);
      sortingBy.innerHTML = '';
      let totalChecked = 0;
      for (const [group, values] of Object.entries(checkedGroups)) {
        if (values.length === 0) continue; 
        totalChecked += values.length;
        values.forEach(value => {
          const sortingOne = document.createElement('div');
          sortingOne.classList.add('sortingOne');
          const divCondition = document.createElement('div');
          divCondition.classList.add('divCondition');
          const p = document.createElement('p');
          p.textContent = group === groupName ? pText : group; 
          const h5 = document.createElement('h5');
          h5.textContent = value;
          divCondition.appendChild(p);
          divCondition.appendChild(h5);
          const closeIcon = document.createElement('i');
          closeIcon.className = 'fa-solid fa-xmark';
          closeIcon.style = 'color: #000000; font-size: 17px; cursor:pointer;';
          closeIcon.addEventListener('click', () => {
            checkboxes.forEach(cb => {
              if (cb.value === value) {
                cb.checked = false;
                cb.dispatchEvent(new Event('change'));
              }
            });
          });
          sortingOne.appendChild(divCondition);
          sortingOne.appendChild(closeIcon);
          sortingBy.appendChild(sortingOne);
        });
      }
      sortingBy.style.display = totalChecked > 0 ? 'flex' : 'none';
      const resetBtn = document.querySelector('.resetButton');
    if (resetBtn) {
    resetBtn.style.display = totalChecked > 0 ? 'block' : 'none';
    filterCards();

}
    });
  });
}

//select
function setupSelectSorting(selectSelector, pText, groupName) {
  const selectElement = document.querySelector(selectSelector);
  const sortingBy = document.querySelector('.sortingBy');
  if (!selectElement) return;
  selectElement.addEventListener('change', () => {
    const selectedValue = selectElement.value;
    if (selectedValue) {
      checkedGroups[groupName] = [selectedValue];
    } else {
      checkedGroups[groupName] = [];
    }
    sortingBy.innerHTML = '';
    let totalChecked = 0;
    for (const [group, values] of Object.entries(checkedGroups)) {
      if (values.length === 0) continue;
      totalChecked += values.length;
      values.forEach(value => {
        const sortingOne = document.createElement('div');
        sortingOne.classList.add('sortingOne');
        const divCondition = document.createElement('div');
        divCondition.classList.add('divCondition');
        const p = document.createElement('p');
        p.textContent = group;
        const h5 = document.createElement('h5');
        h5.textContent = value;
        divCondition.appendChild(p);
        divCondition.appendChild(h5);
        const closeIcon = document.createElement('i');
        closeIcon.className = 'fa-solid fa-xmark';
        closeIcon.style = 'color: #000000; font-size: 17px; cursor:pointer;';
        closeIcon.addEventListener('click', () => {
          selectElement.selectedIndex = -1;
          checkedGroups[groupName] = [];
          selectElement.dispatchEvent(new Event('change'));
        });
        sortingOne.appendChild(divCondition);
        sortingOne.appendChild(closeIcon);
        sortingBy.appendChild(sortingOne);
      });
    }
    sortingBy.style.display = totalChecked > 0 ? 'flex' : 'none';
    const resetBtn = document.querySelector('.resetButton');
    if (resetBtn) {
    resetBtn.style.display = totalChecked > 0 ? 'block' : 'none';
    filterCards();

}
  });
}

//input
function setupInputSorting(inputSelector, pText, groupName) {
  const inputElement = document.querySelector(inputSelector);
  const sortingBy = document.querySelector('.sortingBy');
  if (!inputElement) return;
  inputElement.addEventListener('input', () => {
    const inputValue = inputElement.value.trim();
    if (inputValue) {
      checkedGroups[groupName] = [inputValue];
    } else {
      checkedGroups[groupName] = [];
    }
    sortingBy.innerHTML = '';
    let totalChecked = 0;
    for (const [group, values] of Object.entries(checkedGroups)) {
      if (values.length === 0) continue;
      totalChecked += values.length;
      values.forEach(value => {
        const sortingOne = document.createElement('div');
        sortingOne.classList.add('sortingOne');
        const divCondition = document.createElement('div');
        divCondition.classList.add('divCondition');
        const p = document.createElement('p');
        p.textContent = group;
        const h5 = document.createElement('h5');
        h5.textContent = value;
        divCondition.appendChild(p);
        divCondition.appendChild(h5);
        const closeIcon = document.createElement('i');
        closeIcon.className = 'fa-solid fa-xmark';
        closeIcon.style = 'color: #000000; font-size: 17px; cursor:pointer;';
        closeIcon.addEventListener('click', () => {
          inputElement.value = '';
          checkedGroups[groupName] = [];
          inputElement.dispatchEvent(new Event('input'));
        });
        sortingOne.appendChild(divCondition);
        sortingOne.appendChild(closeIcon);
        sortingBy.appendChild(sortingOne);
      });
    }
    sortingBy.style.display = totalChecked > 0 ? 'flex' : 'none';
    const resetBtn = document.querySelector('.resetButton');
    if (resetBtn) {
    resetBtn.style.display = totalChecked > 0 ? 'block' : 'none';
    filterCards();

}

  });
}


const select = document.createElement('select');
select.className = 'years-select';

const defaultOption = document.createElement('option');
defaultOption.value = '';
defaultOption.textContent = 'Select Year';
select.appendChild(defaultOption);

for (let year = 2000; year <= 2025; year++) {
  const option = document.createElement('option');
  option.value = year;
  option.textContent = year;
  select.appendChild(option);
}
document.querySelector('.yearSelection').appendChild(select);


//Call sorting
setupCheckboxSorting('.sidebar .condition input[type="checkbox"]', 'Condition', 'Condition');
setupSelectSorting('.sidebar .modelSeries select', 'Model', 'Model');
document.addEventListener("DOMContentLoaded", () => {
    setupCheckboxSorting('.sidebar .modelVarients input[type="checkbox"]', 'Company', 'data-name');
});
setupSelectSorting('.sidebar .modelYear select', 'Year', 'Year');
setupCheckboxSorting('.sidebar .interiorColour input[type="checkbox"]', 'Interior', 'Interior');
setupCheckboxSorting('.sidebar .exteriorColour input[type="checkbox"]', 'Exterior', 'Exterior');
setupSelectSorting('.sidebar .mileAge select', 'MileAge', 'MileAge');


// Select min and max inputs
const minInput = document.getElementById('priceMin');
const maxInput = document.getElementById('priceMax');
const carCards = document.querySelectorAll('.car-card');

function filterByPrice() {
    const min = parseInt(minInput.value) || 0;
    const max = parseInt(maxInput.value) || Infinity;

    carCards.forEach(card => {
        const price = parseInt(card.dataset.price) || 0;
        if (price >= min && price <= max) {
            card.style.display = '';
        } else {
            card.style.display = 'none';
        }
    });
}

// Add event listeners
minInput.addEventListener('input', filterByPrice);
maxInput.addEventListener('input', filterByPrice);
setupInputSorting('.sidebar .location input', 'Location', 'Location');




//Search Varient
const searchInput = document.getElementById('checkboxSearch');
  const labels = document.querySelectorAll('.varientsChecked label.custom-checkbox');

  searchInput.addEventListener('input', () => {
    const filter = searchInput.value.toLowerCase();

    labels.forEach(label => {
      const text = label.textContent.toLowerCase();

      if (text.includes(filter)) {
        label.style.display = ''; 
      } else {
        label.style.display = 'none'; 
      }
    });
  });


//Reset Filter
const resetBtn = document.querySelector('.resetButton');
if (resetBtn) {
  resetBtn.addEventListener('click', () => {
    for (const group in checkedGroups) {
      checkedGroups[group] = [];
    }
    document.querySelectorAll('.sidebar input[type="checkbox"]').forEach(cb => cb.checked = false);
    document.querySelectorAll('.sidebar select').forEach(sel => sel.selectedIndex = -1);
    document.querySelectorAll('.sidebar input:not([type="checkbox"]):not([type="radio"])').forEach(input => {
      input.value = '';
      input.dispatchEvent(new Event('input'));
    });
    document.querySelectorAll('.sidebar select').forEach(sel => sel.dispatchEvent(new Event('change')));
    document.querySelectorAll('.sidebar input[type="checkbox"]').forEach(cb => cb.dispatchEvent(new Event('change')));
    resetBtn.style.display = 'none';
    const sortingBy = document.querySelector('.sortingBy');
    if (sortingBy) sortingBy.innerHTML = '';
  });
}



//feedback
function showFeedback() {
      document.getElementById('feedback').style.display = 'block';
    }



document.addEventListener('click', (event) => {
  const btn = event.target.closest('.btnProduct.details');
  if (btn && btn.closest('.car-card')) {
    event.preventDefault();

    const card = btn.closest('.car-card');
    const modelNameElem = card.querySelector('h2');
    if (!modelNameElem) return;

    const modelName = modelNameElem.textContent.trim();
    console.log('Show Details clicked:', modelName);

    localStorage.setItem('carName', modelName);
    window.location.href = "../pages/model.html";
  }
});


document.addEventListener("DOMContentLoaded", () => {
  const saveButtons = document.querySelectorAll('.btnProduct.two');
  const cartCount = document.getElementById('cartCount');

  let count = 0;

  saveButtons.forEach(btn => {
    btn.addEventListener('click', () => {
      if (btn.classList.contains('saved')) {
        return;
      }
      btn.classList.add('saved'); 
      count++;
      cartCount.textContent = count;

      if (count > 0) {
        cartCount.style.display = 'inline-block';

        cartCount.classList.remove('animate-count');
        void cartCount.offsetWidth; // force reflow
        cartCount.classList.add('animate-count');
      }
    });
  });
});


document.querySelectorAll('.btnProduct.two').forEach(btn => {
  btn.addEventListener('click', () => {
    let cartCars = JSON.parse(localStorage.getItem('cartCars')) || [];

    const card = btn.closest('.car-card');
    const img = card.querySelector('.car-image img').src;
    const name = card.querySelector('h2').textContent.trim();
    const description = card.querySelector('.car-info p').textContent.trim();

      cartCars.push({name, image: img, description});
      localStorage.setItem('cartCars', JSON.stringify(cartCars));
      console.log('Added to cart:', name);
      console.log('Current cart:', cartCars);
    
  });
});




//////////////////// doop down //////////////
document.querySelectorAll('.nav-item-dropdown').forEach(card => {
  card.addEventListener('click', () => {
    const modelId = card.dataset.id; 
    localStorage.setItem("modelId", modelId);
     window.location.href = "../pages/filter.php";
  });
});





