document.addEventListener('DOMContentLoaded', () => {
  setupCheckboxSorting(
    '.sidebar .modelVarients input[type="checkbox"]',
    'Company',
    'company'     
  );
  const savedCompany = localStorage.getItem('modelName');
  if (savedCompany) {
    const cb = [...document.querySelectorAll('.sidebar .modelVarients input[type="checkbox"]')]
                  .find(el => el.value === savedCompany);
    if (cb) {
      cb.checked = true;
      cb.dispatchEvent(new Event('change', { bubbles: true }));
    }
  }
  const savedCondition = localStorage.getItem('condition');
  if (savedCondition) {
    const cb2 = [...document.querySelectorAll('.sidebar .condition input[type="checkbox"]')]
                   .find(el => el.value.toLowerCase() === savedCondition.toLowerCase());
    if (cb2) {
      cb2.checked = true;
      cb2.dispatchEvent(new Event('change', { bubbles: true }));
    }
  }
  const nameEl = document.querySelector('.nameModel');
  if (nameEl && savedCompany) nameEl.textContent = savedCompany;
  setTimeout(() => updatePagination(), 0);
});


function toNum(v){
  const s = String(v ?? '').replace(/[^\d.-]/g, ''); 
  return s ? Number(s) : NaN;
}

function filterCards() {
  const cards = Array.from(document.querySelectorAll('.car-card'));
  const filteredCards = [];
  cards.forEach(card => {
    let show = true;
    for (const [group, values] of Object.entries(checkedGroups)) {
      if (!values || values.length === 0) continue;

      const key = group.toLowerCase();              
      const cardValueRaw = card.dataset[key] || '';  

      if (key === "price" || key === "mileage") {
        const limit   = toNum(values[0]);
        const cardNum = toNum(cardValueRaw);
        if (!isNaN(limit) && !isNaN(cardNum) && cardNum > limit) {
          show = false;
          break;
        }
      } else if (group === "Company") {
        if (!values.includes(cardValueRaw)) {
          show = false;
          break;
        }
      } else {
        const cardValue = String(cardValueRaw).toLowerCase();
        const matched = values.some(value =>
          cardValue.includes(String(value).toLowerCase())
        );
        if (!matched) {
          show = false;
          break;
        }
      }
    }

    card.style.display = show ? 'flex' : 'none';
    if (show) filteredCards.push(card);
  });

  return filteredCards;
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
            const savedCompany = localStorage.getItem('modelName');
     const nameEl = document.querySelector('.nameModel');
   nameEl.textContent = "";
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
    updatePagination();

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
    updatePagination();

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
    updatePagination();

}

  });
}
function setupCheckboxSortingCompany(selector, checkboxKey, cardKey) {
    const checkboxes = document.querySelectorAll(selector);
    const cards = document.querySelectorAll('.car-card');

    checkboxes.forEach(cb => {
        cb.addEventListener('change', () => {
            const checked = [...checkboxes].filter(c => c.checked).map(c => c.value);

            cards.forEach(card => {
                const company = card.dataset[cardKey]; // ← this matches data-company
                if (checked.length === 0 || checked.includes(company)) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });
        });
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
    setupCheckboxSorting(
        '.sidebar .modelVarients input[type="checkbox"]',
        'Company', 
        'company'     
    );
    

});
 

setupSelectSorting('.sidebar .modelYear select', 'Year', 'Year');
setupCheckboxSorting('.sidebar .interiorColour input[type="checkbox"]', 'Interior', 'Interior');
setupCheckboxSorting('.sidebar .exteriorColour input[type="checkbox"]', 'Exterior', 'Exterior');
setupSelectSorting('.sidebar .mileAge select', 'Max. Mileage', 'Mileage');


// Select min and max inputs
const carCards = document.querySelectorAll('.car-card');
const minInput = document.getElementById('priceMax');
const maxInput = document.getElementById('priceMin');

function pushPriceToFilters(){
  checkedGroups['Price'] = [
    minInput?.value || '',
    maxInput?.value || ''
  ];
  filterCards();
  if (document.querySelector('.pagination')) updatePagination();
}
minInput.addEventListener('input', pushPriceToFilters);
maxInput.addEventListener('input', pushPriceToFilters);

// Add event listeners

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
    document.querySelectorAll('.sidebar input[type="checkbox"]').forEach(cb => {
      cb.checked = false;
    });
    document.querySelectorAll('.sidebar select').forEach(sel => {
      sel.selectedIndex = -1;
    });
    document.querySelectorAll('.sidebar input:not([type="checkbox"]):not([type="radio"])').forEach(input => {
      input.value = '';
    });
    const sortingBy = document.querySelector('.sortingBy');
    if (sortingBy) sortingBy.innerHTML = '';
    resetBtn.style.display = 'none';
     const savedCompany = localStorage.getItem('modelName');
     const nameEl = document.querySelector('.nameModel');
   nameEl.textContent = "";
    filterCards();    
    updatePagination(); 
    
  });
}





//feedback
function showFeedback() {
      document.getElementById('feedback').style.display = 'block';
    }






function getCart(){ try { return JSON.parse(localStorage.getItem('cartCars')) || []; } catch { return []; } }
function setCart(c){ localStorage.setItem('cartCars', JSON.stringify(c)); }

function updateCartCount(){
  const count = getCart().length; 
  const el = document.getElementById('cartCount');
  if (!el) return;
  el.textContent = count;
  el.style.display = count > 0 ? 'inline-block' : 'none';
}

const toast = {
  success(msg){ if (window.iziToast) iziToast.success({title:'Success', message:msg, position:'topRight'}); else miniToast(msg, 'success'); },
  info(msg){ if (window.iziToast) iziToast.info({title:'Info', message:msg, position:'topRight'}); else miniToast(msg, 'info'); },
  error(msg){ if (window.iziToast) iziToast.error({title:'Error', message:msg, position:'topRight'}); else miniToast(msg, 'error'); }
};
function miniToast(msg, type='info'){
  const box = document.createElement('div');
  box.textContent = msg;
  box.style.cssText = `
    position:fixed; right:16px; top:16px; z-index:9999;
    padding:10px 14px; border-radius:10px; color:#fff; font:600 14px/1.3 sans-serif;
    box-shadow:0 6px 18px rgba(0,0,0,.25); opacity:.98;`;
  box.style.background = type==='success' ? '#00cf0aff' : type==='error' ? '#d40000ff' : '#0062d1ff';
  document.body.appendChild(box);
  setTimeout(()=>{ box.style.transition='opacity .3s'; box.style.opacity='0'; setTimeout(()=>box.remove(), 300); }, 1500);
}
document.addEventListener('DOMContentLoaded', updateCartCount);


document.addEventListener('click', (e) => {
  const btn = e.target.closest('.btnProduct.two');
  if (!btn) return;

  if (btn.dataset.lock === '1') return;
  btn.dataset.lock = '1';
  setTimeout(()=>{ btn.dataset.lock = '0'; }, 250);

  const card = btn.closest('.car-card');
  if (!card) return;

  const id   = (card.dataset.id || '').trim();
  if (!id){ toast.error('Missing product id'); return; }

  const img  = card.dataset.image || '';
  const name = (card.querySelector('h2')?.textContent || '').trim();
  const desc = (card.querySelector('.car-info p')?.textContent || '').trim();

  const cart = getCart();
  const exists = cart.some(it => String(it.id) === String(id));

  if (exists){
    toast.info(`${name || 'Item'} is already in your cart`);
  } else {
    cart.push({ id, name, image: img, description: desc });
    setCart(cart);
    updateCartCount();
    toast.success(`${name || 'Item'} added to cart`);
  }
});




//////////////////// doop down //////////////
document.querySelectorAll('.nav-item-dropdown').forEach(link => {
  link.addEventListener('click', (e) => {
    e.preventDefault();
    const companyName = link.textContent.trim(); 
    const cb = [...document.querySelectorAll('.sidebar .modelVarients input[type="checkbox"]')]
                  .find(el => el.value === companyName);
    if (cb) {
      document.querySelectorAll('.sidebar .modelVarients input[type="checkbox"]').forEach(box => box.checked = false);
      cb.checked = true;
      cb.dispatchEvent(new Event('change', { bubbles: true }));
      localStorage.setItem('modelName', companyName);
    }
    
  const savedCompany = localStorage.getItem('modelName');
     const nameEl = document.querySelector('.nameModel');
  if (nameEl && savedCompany) nameEl.textContent = savedCompany;
  });
  updatePagination();
});




//Pagination 
document.addEventListener('DOMContentLoaded', function () {
  const cards = Array.from(document.querySelectorAll('.car-card'));
  const itemsPerPage = 3;
  const paginationUl = document.querySelector('.pagination');
  if (!paginationUl) return;
  const totalCards = cards.length;
  const totalPages = Math.max(1, Math.ceil(totalCards / itemsPerPage));
  let currentPage = 1;
  function renderPagination() {
    paginationUl.innerHTML = '';
    const prevLi = document.createElement('li');
    prevLi.className = 'page-item';
    prevLi.innerHTML = '<a class="page-link" href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a>';
    paginationUl.appendChild(prevLi);
    for (let i = 1; i <= totalPages; i++) {
      const li = document.createElement('li');
      li.className = 'page-item';
      li.innerHTML = `<a class="page-link" href="#" data-page="${i}">${i}</a>`;
      paginationUl.appendChild(li);
    }
    const nextLi = document.createElement('li');
    nextLi.className = 'page-item';
    nextLi.innerHTML = '<a class="page-link" href="#" aria-label="Next"><span aria-hidden="true">&raquo;</span></a>';
    paginationUl.appendChild(nextLi);
  }
  function showPage(page) {
    if (page < 1) page = 1;
    if (page > totalPages) page = totalPages;
    currentPage = page;
    const start = (page - 1) * itemsPerPage;
    const end = start + itemsPerPage;
    cards.forEach((card, idx) => {
      card.style.display = (idx >= start && idx < end) ? '' : 'none';
    });
    paginationUl.querySelectorAll('.page-item').forEach(li => li.classList.remove('active', 'disabled'));
    const activeLink = paginationUl.querySelector(`.page-link[data-page="${page}"]`);
    if (activeLink) activeLink.parentElement.classList.add('active');
    const prev = paginationUl.querySelector('.page-link[aria-label="Previous"]');
    const next = paginationUl.querySelector('.page-link[aria-label="Next"]');
    if (prev) {
      if (page === 1) prev.parentElement.classList.add('disabled'); else prev.parentElement.classList.remove('disabled');
    }
    if (next) {
      if (page === totalPages) next.parentElement.classList.add('disabled'); else next.parentElement.classList.remove('disabled');
    }
  }
  paginationUl.addEventListener('click', (e) => {
    const link = e.target.closest('.page-link');
    if (!link) return;
    e.preventDefault();
    if (link.getAttribute('aria-label') === 'Previous') {
      if (currentPage > 1) showPage(currentPage - 1);
      return;
    }
    if (link.getAttribute('aria-label') === 'Next') {
      if (currentPage < totalPages) showPage(currentPage + 1);
      return;
    }
    const p = Number(link.dataset.page);
    if (p) showPage(p);
  });
  renderPagination();
  showPage(1);
});

function updatePagination() {
  const filteredCards = filterCards();
  const itemsPerPage = 3;
  const totalCards = filteredCards.length;
  const totalPages = Math.max(1, Math.ceil(totalCards / itemsPerPage));
  let currentPage = 1;


  let paginationUl = document.querySelector('.pagination');
  if (!paginationUl) return;

  const fresh = paginationUl.cloneNode(false); 
  paginationUl.parentNode.replaceChild(fresh, paginationUl);
  paginationUl = fresh;

  function renderPagination() {
    paginationUl.innerHTML = '';
    const prevLi = document.createElement('li');
    prevLi.className = 'page-item';
    prevLi.innerHTML = '<a class="page-link" href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a>';
    paginationUl.appendChild(prevLi);
    for (let i = 1; i <= totalPages; i++) {
      const li = document.createElement('li');
      li.className = 'page-item';
      li.innerHTML = `<a class="page-link" href="#" data-page="${i}">${i}</a>`;
      paginationUl.appendChild(li);
    }
    const nextLi = document.createElement('li');
    nextLi.className = 'page-item';
    nextLi.innerHTML = '<a class="page-link" href="#" aria-label="Next"><span aria-hidden="true">&raquo;</span></a>';
    paginationUl.appendChild(nextLi);
  }

  function showPage(page) {
    if (page < 1) page = 1;
    if (page > totalPages) page = totalPages;
    currentPage = page;
    const start = (page - 1) * itemsPerPage;
    const end = start + itemsPerPage;

    filteredCards.forEach((card, idx) => {
      card.style.display = (idx >= start && idx < end) ? 'flex' : 'none';
    });

    paginationUl.querySelectorAll('.page-item').forEach(li => li.classList.remove('active', 'disabled'));
    const activeLink = paginationUl.querySelector(`.page-link[data-page="${page}"]`);
    if (activeLink) activeLink.parentElement.classList.add('active');

    const prev = paginationUl.querySelector('.page-link[aria-label="Previous"]');
    const next = paginationUl.querySelector('.page-link[aria-label="Next"]');
    if (prev) prev.parentElement.classList.toggle('disabled', page === 1);
    if (next) next.parentElement.classList.toggle('disabled', page === totalPages);
  }

 
  paginationUl.addEventListener('click', e => {
    const link = e.target.closest('.page-link');
    if (!link) return;
    e.preventDefault();

    if (link.getAttribute('aria-label') === 'Previous') { showPage(currentPage - 1); return; }
    if (link.getAttribute('aria-label') === 'Next')     { showPage(currentPage + 1); return; }

    const p = Number(link.dataset.page);
    if (p) showPage(p);
  });

  renderPagination();
  showPage(1);
}

const input = document.getElementById('searchInput');
let matches = [];
let currentIndex = -1;

// Find and highlight matches without breaking layout
function highlightMatches(text) {
    removeHighlights();
    matches = [];
    currentIndex = -1;
    if (!text) return;

    const walker = document.createTreeWalker(document.body, NodeFilter.SHOW_TEXT, null);
    while (walker.nextNode()) {
        const node = walker.currentNode;
        const regex = new RegExp(text, 'gi');
        let match;
        while ((match = regex.exec(node.textContent)) !== null) {
            matches.push({ node, start: match.index, end: match.index + match[0].length });
        }
    }

    matches.forEach((m, i) => {
        const span = document.createElement('span');
        span.textContent = m.node.textContent.slice(m.start, m.end);
        span.classList.add('highlight');
        const parent = m.node.parentNode;

        const after = m.node.splitText(m.start);
        after.textContent = after.textContent.slice(m.end - m.start);
        parent.insertBefore(span, after);
        m.node = span; 
    });

    if (matches.length > 0) {
        currentIndex = 0;
        scrollToCurrent();
    }
}

// Remove all highlights
function removeHighlights() {
    document.querySelectorAll('.highlight').forEach(span => {
        const parent = span.parentNode;
        parent.replaceChild(document.createTextNode(span.textContent), span);
        parent.normalize();
    });
}

// Scroll to the current match
function scrollToCurrent() {
    document.querySelectorAll('.current').forEach(c => c.classList.remove('current'));
    if (currentIndex >= 0 && matches[currentIndex]) {
        matches[currentIndex].node.classList.add('current');
        matches[currentIndex].node.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
}

// Navigate with arrows
input.addEventListener('keydown', e => {
    if (!matches.length) return;
    if (e.key === 'ArrowDown' || e.key === 'Enter') {
        currentIndex = (currentIndex + 1) % matches.length;
        scrollToCurrent();
        e.preventDefault();
    } else if (e.key === 'ArrowUp') {
        currentIndex = (currentIndex - 1 + matches.length) % matches.length;
        scrollToCurrent();
        e.preventDefault();
    }
});

// Listen to typing
input.addEventListener('input', () => {
    highlightMatches(input.value);
});


