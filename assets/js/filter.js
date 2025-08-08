const message = localStorage.getItem("modelName");
document.querySelector('.nameModel').innerHTML = message;


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
setupSelectSorting('.sidebar .modelSeries select', 'Series', 'Series');
setupCheckboxSorting('.sidebar .modelVarients input[type="checkbox"]', 'Varients', 'Varients');
setupCheckboxSorting('.sidebar .modelGeneration input[type="checkbox"]', 'Generation', 'Generation');
setupSelectSorting('.sidebar .modelYear select', 'Model Year', 'Model Year');
setupCheckboxSorting('.sidebar .interiorColour input[type="checkbox"]', 'In Color', 'In Color');
setupCheckboxSorting('.sidebar .exteriorColour input[type="checkbox"]', 'Ex Color', 'Ex Color');
setupSelectSorting('.sidebar .mileAge select', 'Mileage', 'Mileage');
setupSelectSorting('.sidebar .previousOwner select', 'Prev. Owner', 'Prev. Owner');
setupInputSorting('.sidebar .price input', 'Price', 'Price');
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



const resetBtn = document.querySelector('.resetButton');
if (resetBtn) {
  resetBtn.addEventListener('click', () => {
    // Clear checkedGroups object
    for (const group in checkedGroups) {
      checkedGroups[group] = [];
    }

    // Clear checkboxes
    document.querySelectorAll('.sidebar input[type="checkbox"]').forEach(cb => cb.checked = false);

    // Reset selects
    document.querySelectorAll('.sidebar select').forEach(sel => sel.selectedIndex = -1);

    // Clear all other inputs (text, number, search, etc.)
    document.querySelectorAll('.sidebar input:not([type="checkbox"]):not([type="radio"])').forEach(input => {
      input.value = '';
      input.dispatchEvent(new Event('input'));
    });

    // Dispatch change/input events to update UI
    document.querySelectorAll('.sidebar select').forEach(sel => sel.dispatchEvent(new Event('change')));
    document.querySelectorAll('.sidebar input[type="checkbox"]').forEach(cb => cb.dispatchEvent(new Event('change')));

    // Hide reset button and clear sorting display
    resetBtn.style.display = 'none';
    const sortingBy = document.querySelector('.sortingBy');
    if (sortingBy) sortingBy.innerHTML = '';
  });
}






