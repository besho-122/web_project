// SIDEBAR TOGGLE

let sidebarOpen = false;
const sidebar = document.getElementById('sidebar');

function openSidebar() {
  if (!sidebarOpen) {
    sidebar.classList.add('sidebar-responsive');
    sidebarOpen = true;
  }
}

function closeSidebar() {
  if (sidebarOpen) {
    sidebar.classList.remove('sidebar-responsive');
    sidebarOpen = false;
  }
}


document.addEventListener('DOMContentLoaded', () => {
  const container = document.querySelector('.main-container');
  const sections = Array.from(document.querySelectorAll('main section'));
  const items = Array.from(document.querySelectorAll('.sidebar-list .sidebaritem'));
  const linkById = new Map(
    items.map(li => {
      const a = li.querySelector('a');
      const id = a && a.getAttribute('href') ? a.getAttribute('href').replace('#', '') : null;
      return [id, li];
    })
  );

  items.forEach(li => {
    const a = li.querySelector('a');
    if (!a) return;
    a.addEventListener('click', (e) => {
      e.preventDefault();
      const id = a.getAttribute('href').replace('#', '');
      const target = document.getElementById(id);
      if (target) {
        target.scrollIntoView({ behavior: 'smooth', block: 'start' });
      }
    });
  });
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        const id = entry.target.id;
        items.forEach(li => li.classList.remove('active'));
        const li = linkById.get(id);
        if (li) li.classList.add('active');
      }
    });
  }, {
    root: container,       
    threshold: 0.6
  });

  sections.forEach(sec => observer.observe(sec));
  if (!location.hash) {
    const first = sections[0];
    if (first) {
      first.scrollIntoView({ block: 'start' });
      const li = linkById.get(first.id);
      if (li) li.classList.add('active');
    }
  } else {
    const id = location.hash.replace('#', '');
    const li = linkById.get(id);
    if (li) li.classList.add('active');
  }
});  










      function makeWheel(fontSize) {
    const wheel = document.createElement('span');
    wheel.className = 'wheel';
    const digits = document.createElement('span');
    digits.className = 'digits';
    const arr = [...Array(20)].map((_,i)=> String(i%10));
    arr.forEach(n => {
      const d = document.createElement('span');
      d.className = 'digit';
      d.textContent = n;
      digits.appendChild(d);
    });
    wheel.appendChild(digits);
    return { wheel, digits };
  }

  function formatWithSep(numStr) {
    return numStr.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
  }

  function buildOdometer(el, value, options = {}) {
    const {
      duration = 1200,     
      spinTurns = 10,      
      stagger = 70,        
      useThousandsSep = true
    } = options;

    const targetStr = String(value);
    const formatted = useThousandsSep ? formatWithSep(targetStr) : targetStr;

  
    const fs = window.getComputedStyle(el).fontSize;

   
    const box = document.createElement('span');
    box.className = 'odometer';
    el.textContent = '';
    el.appendChild(box);

    let index = 0;
    for (const ch of formatted) {
      if (ch === ',') {
        const sep = document.createElement('span');
        sep.className = 'sep';
        sep.textContent = ',';
        box.appendChild(sep);
        continue;
      }
      const { wheel, digits } = makeWheel(fs);
      box.appendChild(wheel);
      const digitHeight = wheel.clientHeight || parseFloat(fs);
      const n = parseInt(ch, 10);
      const stopIndex = spinTurns + n; 
      const translateY = -(stopIndex * digitHeight);
      digits.style.transition = `transform ${duration}ms cubic-bezier(.2,.8,.2,1)`;
      setTimeout(() => {
        digits.style.transform = `translateY(${translateY}px)`;
      }, index * stagger);

      index++;
    }
  }

  function initOdometers(){
    const stats = document.querySelectorAll('.odometer-stat');
    if (!stats.length) return;

    const io = new IntersectionObserver(entries => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          const el = entry.target;
          const val = parseInt(el.getAttribute('data-value'), 10) || 0;
          buildOdometer(el, val, {
            duration: 1200,
            spinTurns: 10,
            stagger: 90,
            useThousandsSep: true
          });
          io.unobserve(el);
        }
      });
    }, { threshold: 0.2 });

    stats.forEach(el => io.observe(el));
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initOdometers);
  } else {
    initOdometers();
  }








  /////////////////////////// show product ////////////

 
// delete product
function deleteProduct(productId) {
    if (!confirm("Are you sure you want to delete this product?")) return;
    const formData = new FormData();
    formData.append('id', productId);
    fetch('../api/deleteProduct.php', {
        method: 'POST',
        body: formData
    })
    .then(res => res.text())
    .then(data => {
        if (data.trim() === 'success') {
            alert('Product deleted successfully!');
            const card = document.querySelector(`.productCard[data-id='${productId}']`);
            if (card) card.remove();
            const counter = document.querySelector('.odometer-stat');
            if (counter) {
                let value = parseInt(counter.dataset.value) || 0;
                value = Math.max(value - 1, 0);
                counter.dataset.value = value;
                counter.textContent = value; 
            }
        } else {
            alert('Delete failed: ' + data);
            console.error(data);
        }
    })
    .catch(err => console.error(err));
}



//reset images
function resetImages(form) {
    for (let i = 1; i <= 5; i++) {
        const input = form.querySelector(`[name="img${i}"]`);
        if (!input) continue;
        const label = input.parentElement;
        const existingPreview = label.querySelector(`#imgPreview${i}`);
        if (existingPreview) existingPreview.remove();
        const span = label.querySelector('span');
        if (span) span.style.display = 'block';
        input.value = '';
    }
}

// reset form
function resetSelects(form) {
    ['Condition','MileAge','Exterior','Interior','CompanyId','Model'].forEach(name => {
        const sel = form.querySelector(`[name="${name}"]`);
        if (sel) sel.selectedIndex = 0;
        if (name === 'Model' && sel) while (sel.options.length > 1) sel.remove(1);
    });
}

// add product

function addProduct() {
    const form = document.getElementById('productForm');
    const form2 = document.querySelector('.productShowImages');
    form.reset();
    resetImages(form2);
    resetSelects(form);

    const modal = document.querySelector('.productShow');
    if (!modal) return;
    modal.style.display = 'block';

    const modalContent = modal.querySelector('.productShowDiscription');
    if (modalContent) modalContent.style.display = 'flex';

    const blurLayer = document.querySelector('.toMakeItBlur');
    if (blurLayer) blurLayer.style.filter = 'blur(16px)';

    form.action = "../api/addProduct.php";

    const hiddenId = form.querySelector('input[name="id"]');
    if (hiddenId) hiddenId.remove();

    const heading = modal.querySelector('.productShowDiscriptionInner h1');
    if (heading) heading.textContent = "Add Product";

    const submitBtn = modal.querySelector('.btnProductShowDiscriptionInnerList');
    if (submitBtn) submitBtn.textContent = "Add";

   form.onsubmit = function(e) {
    e.preventDefault();
    const formData = new FormData(form);

    fetch(form.action, { method: 'POST', body: formData })
        .then(res => res.json())
        .then(resp => {
            console.log("Response from server:", resp);
            if (resp.success) {
                sendEmailsAfterAdd(resp.id);    
                alert("Product added successfully!");
            } else {
                alert("Add failed: " + resp.message);
            }
        })
        .catch(err => console.error("Fetch Error:", err))
        .finally(() => location.reload());
};
}

// edit product
function editProduct(productId) {
    const modal = document.querySelector('.productShow'); 
    if (!modal) return;
    modal.id = 'productModal'; 
    modal.style.display = 'block';
    const modalContent = modal.querySelector('.productShowDiscription');
    if (modalContent) modalContent.style.display = 'flex';
    const blurLayer = document.querySelector('.toMakeItBlur');
    if (blurLayer) blurLayer.style.filter = 'blur(16px)';
    const card = document.querySelector(`.productCard[data-id='${productId}']`);
    if (!card) return;
    ['Name', 'Price', 'Year'].forEach(name => {
        const input = document.querySelector(`[name="${name}"]`);
        if (input) input.value = card.dataset[name.toLowerCase()] || card.dataset[name] || '';
    });
    ['Condition', 'MileAge', 'Exterior', 'Interior'].forEach(name => {
        const select = document.querySelector(`[name="${name}"]`);
        if (select) {
            const value = card.dataset[name.toLowerCase()] || card.dataset[name] || '';
            if (value) select.value = value;
        }
    });
    const companySelect = document.querySelector('[name="CompanyId"]');
    if (companySelect) {
        companySelect.value = card.dataset.company || '';
        companySelect.dispatchEvent(new Event('change'));
    }
    const modelSelect = document.querySelector('[name="Model"]');
    if (modelSelect) {
        const modelValue = card.dataset.model || '';
        const optionExists = Array.from(modelSelect.options).some(opt => opt.value == modelValue.toLowerCase().replace(/\s+/g, '-'));
        if (optionExists) {
            modelSelect.value = modelValue.toLowerCase().replace(/\s+/g, '-');
        } else if (modelValue) {
            const newOption = document.createElement('option');
            newOption.value = modelValue.toLowerCase().replace(/\s+/g, '-');
            newOption.textContent = modelValue;
            newOption.selected = true;
            modelSelect.appendChild(newOption);
        }
    }
    ['img1','img2','img3','img4','img5'].forEach((imgName, index) => {
        const input = document.querySelector(`[name="${imgName}"]`);
        if (!input) return;
        const label = input.parentElement;
        const existingPreview = label.querySelector(`#imgPreview${index+1}`);
        if (existingPreview) existingPreview.remove();
        const span = label.querySelector('span');
        if (span) span.style.display = 'none';
        const preview = document.createElement('img');
        preview.id = `imgPreview${index+1}`;
        preview.classList.add('preview');
        preview.style.width = (imgName === 'img1' || imgName === 'img5') ? '100%' : '120px';
        preview.style.height = (imgName === 'img1' || imgName === 'img5') ? '100%' : '90px';
        preview.style.objectFit = 'cover';
        preview.style.borderRadius = '8px';
        preview.src = card.dataset[imgName] || '';
        label.appendChild(preview);
    });
    const heading = modal.querySelector('.productShowDiscriptionInner h1');
    if (heading) heading.textContent = "Edit Product";
    const submitBtn = modal.querySelector('.btnProductShowDiscriptionInnerList');
    if (submitBtn) submitBtn.textContent = "Update";
    const form = document.getElementById('productForm');
    if (!form) return;
    form.action = "../api/updateProduct.php";
    let hiddenId = form.querySelector('input[name="id"]');
    if (!hiddenId) {
        hiddenId = document.createElement('input');
        hiddenId.type = 'hidden';
        hiddenId.name = 'id';
        form.appendChild(hiddenId);
    }
    hiddenId.value = productId;
  form.onsubmit = function(e) {
    e.preventDefault();
    const formData = new FormData(form);
    fetch(form.action, {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            return fetch(`../api/getProduct.php?id=${formData.get('id')}`)
                     .then(res => res.json());
        } else {
            throw new Error(data.message || "Update failed");
        }
    })
    .then(product => {
        const card = document.querySelector(`.productCard[data-id='${product.id}']`);
        if (!card) return;
        card.dataset.name = product.Name;
        card.dataset.price = product.Price;
        card.dataset.year = product.Year;
        card.dataset.condition = product.Condition;
        card.dataset.mileage = product.MileAge;
        card.dataset.exterior = product.Exterior;
        card.dataset.interior = product.Interior;
        card.dataset.company = product.CompanyId;
        card.dataset.model = product.Model;
        card.dataset.img1 = product.img1;
        card.dataset.img2 = product.img2;
        card.dataset.img3 = product.img3;
        card.dataset.img4 = product.img4;
        card.dataset.img5 = product.img5;
        const nameEl = card.querySelector('.productName');
        if (nameEl) nameEl.textContent = product.Name;
        const priceEl = card.querySelector('.productCardDiscription ul li');
        if (priceEl) priceEl.textContent = `Price: ${product.Price} NIS`;
        const imgEl = card.querySelector('img');
        if (imgEl) imgEl.src = product.img1 || '';
        closeProduct();
    })
    .catch(err => {
        console.error(err);
        alert("An error occurred while updating the product.");
    });
};

}


// close product
function closeProduct() {

    const modal = document.querySelector('.productShow');
    const modalContent = document.querySelector('.productShowDiscription');
    const blurLayer = document.querySelector('.toMakeItBlur');
    if (modal) modal.style.display = 'none';
    if (modalContent) modalContent.style.display = 'none';
    if (blurLayer) blurLayer.style.filter = 'blur(0px)';
    
}


 //select year
  document.addEventListener("DOMContentLoaded", () => {
    const select = document.createElement('select');
    select.className = 'years-select';
    select.classList.add('selection');

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

    const container = document.querySelector('.yearSelection');
    if(container) container.appendChild(select);
});





function showImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const label = input.parentElement;
            const span = label.querySelector("span");
            if (span) {
                span.style.display = "none";
            }
            let preview = label.querySelector("img.preview");
            if (!preview) {
                preview = document.createElement("img");
                preview.classList.add("preview");
                preview.style.width = "100%";
                preview.style.height = "100%";
                preview.style.objectFit = "cover";
                preview.style.borderRadius = "8px";
                label.appendChild(preview);
            }
            preview.src = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
    }
}


function showProductForm(product = null) {
    const container = document.getElementById("productShowContainer");
    const formId = product ? `productForm_${product.id}` : "productForm_new";
    container.innerHTML = `
    <div class="productShow">
      <div class="productShowDiscription">
        <button type="button" class="closeProduct" onclick="closeProduct()">X</button>
        <div class="productShowDiscriptionList">

          <!-- Hidden form -->
          <form id="${formId}" action="${product ? "../api/updateProduct.php" : "../api/addProduct.php"}" method="POST" enctype="multipart/form-data" style="display:none;"></form>

          <div class="productShowContainer">

            <div class="productShowImages">
              <label class="uploadBox">
                <input type="file" name="img1" form="${formId}" accept="image/*" onchange="showImage(this)" hidden>
                <span>+ Choose Image</span>
              </label>

              <div class="productShowImagesthree">
                ${[2,3,4].map(i => `
                  <label class="uploadBoxSmall">
                    <input type="file" name="img${i}" form="${formId}" accept="image/*" onchange="showImage(this)" hidden>
                    <span>+ Choose</span>
                  </label>
                `).join("")}
              </div>

              <label class="uploadBox2">
                <input type="file" name="img5" form="${formId}" accept="image/*" onchange="showImage(this)" hidden>
                <span>+ Choose Image</span>
              </label>
            </div>
            <div class="productShowDiscriptionInner">
              <h1>Product Name</h1>
              <input type="text" name="Name" form="${formId}" placeholder="Product Name" value="${product ? product.Name : ''}">

              <div class="fatherFilter">
                <h1>Condition</h1>
                <select name="Condition" form="${formId}" class="selection">
                  <option value="" disabled ${!product ? 'selected' : ''}>Condition</option>
                  <option value="new" ${product?.Condition === "new" ? "selected" : ""}>New</option>
                  <option value="used" ${product?.Condition === "used" ? "selected" : ""}>Used</option>
                  <option value="preowned" ${product?.Condition === "preowned" ? "selected" : ""}>Pre-Owned</option>
                </select>

                <h1>Price</h1>
                <input type="text" name="Price" form="${formId}" placeholder="Product Price" value="${product ? product.Price : ''}">

                <h1>Year</h1>
                <input type="text" name="Year" form="${formId}" placeholder="Year" value="${product ? product.Year : ''}">
              </div>

              <div class="fatherFilter2">
                <h1>Mileage</h1>
                <select name="MileAge" form="${formId}" class="selection">
                  <option value="" disabled ${!product ? 'selected' : ''}>Max. mileage</option>
                  <option value="5000" ${product?.MileAge == "5000" ? "selected" : ""}>5000</option>
                  <option value="10000" ${product?.MileAge == "10000" ? "selected" : ""}>10000</option>
                  <option value="20000" ${product?.MileAge == "20000" ? "selected" : ""}>20000</option>
                </select>
              </div>

              <div class="fatherFilter2">
                <h1>Exterior</h1>
                <select name="Exterior" form="${formId}" class="selection">
                  <option value="" disabled ${!product ? 'selected' : ''}>Exterior Color</option>
                  ${["black","white","silver","crayon","grey","blue","red","yellow","brown","green","violet","gold","orange","pink","beige"]
                    .map(c => `<option value="${c}" ${product?.Exterior === c ? "selected" : ""}>${c}</option>`).join("")}
                </select>

                <h1>Interior</h1>
                <select name="Interior" form="${formId}" class="selection">
                  <option value="" disabled ${!product ? 'selected' : ''}>Interior Color</option>
                  ${["black","beige","brown","grey","blue","red","purple","green","white"]
                    .map(c => `<option value="${c}" ${product?.Interior === c ? "selected" : ""}>${c}</option>`).join("")}
                </select>
              </div>

              <div class="fatherFilter3">
                <h1>Company</h1>
                <select name="CompanyId" id="companySelect" form="${formId}" class="selection">
                  <option value="" disabled ${!product ? 'selected' : ''}>Select Company</option>
                  <option value="74" ${product?.CompanyId == 74 ? "selected" : ""}>Toyota</option>
                  <option value="73" ${product?.CompanyId == 73 ? "selected" : ""}>Ford</option>
                  <option value="75" ${product?.CompanyId == 75 ? "selected" : ""}>BMW</option>
                </select>

                <h1>Model</h1>
                <select name="Model" id="modelSelect" form="${formId}" class="selection">
                  <option value="" disabled ${!product ? 'selected' : ''}>Select Model</option>
                  ${product ? `<option selected>${product.Model}</option>` : ""}
                </select>
              </div>

              <button type="submit" form="${formId}" class="btnProductShowDiscriptionInnerList">
                ${product ? "Update" : "Add"}
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
    `;
}


  


  //////show company////////////
document.addEventListener('click', function (e) {
  if (!e.target.classList.contains('btncompanyCardDelete')) return;

  const card = e.target.closest('.companyCard');
  if (!card) return;

  const id   = card.dataset.id;   
  const name = card.dataset.name || card.querySelector('h1')?.textContent || '';

  if (!id) return;

  if (!confirm('Are you sure you want to delete ' + name + ' ?')) return;

  fetch('../api/deleteCompany.php', {
    method: 'POST',
    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
    body: 'id=' + encodeURIComponent(id)
  })
  .then(res => res.text())
  .then(txt => {
    if (txt.trim() === 'success') {
      card.remove();
    } else {
      alert('Error: ' + txt);
    }
  })
  .catch(err => {
    alert('Connection error');
    console.error(err);
  });
});

function editCompany(companyId) {
    const modal = document.querySelector('#editNotAdd'); 
    if (!modal) return;
    modal.style.display = 'block';

    const blurLayer = document.querySelector('.toMakeItBlur');
    if (blurLayer) blurLayer.style.filter = 'blur(16px)';

    const card = document.querySelector(`.companyCard[data-id='${companyId}']`);
    if (!card) return;

    // Fill text fields
    document.querySelector('#companyNameInput').value = card.dataset.companyname || '';
    document.querySelector('#companyDescriptionInput').value = card.dataset.companydescription || '';
    document.querySelector('#companyIdInputHidden').value = companyId;

    // Prefill hidden inputs with current images
    document.querySelector('#currentImageInput').value = card.dataset.image || '';
    document.querySelector('#currentImagePngInput').value = card.dataset.imagepng || '';
}










    function closeCompany() {
    document.querySelector('#editNotAdd').style.display = 'none';
    document.querySelector('.toMakeItBlur').style.filter = 'blur(0px)';
  }



    function addCompany() {
    document.querySelector('#addNotEdit').style.display = 'block';
    document.querySelector('.toMakeItBlur').style.filter = 'blur(16px)';
  }

    function closeAddCompany() {
    document.querySelector('#addNotEdit').style.display = 'none';
    document.querySelector('.toMakeItBlur').style.filter = 'blur(0px)';
  }



  /////////////////////cutomer //////

document.addEventListener('click', function (e) {
  if (!e.target.classList.contains('btncustomerCardDelete')) return;
  const card = e.target.closest('.customerCard');
  if (!card) return;
  const userName = card.dataset.username;
  if (!userName) return;

  if (!confirm ('are you sure you want to delete ' + userName + '?')) return;

  fetch('../api/deleteCustomer.php', {
    method: 'POST',
    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
    body: 'userName=' + encodeURIComponent(userName)
  })
  .then(res => res.text())
  .then(txt => {
    if (txt.trim() === 'success') {
      card.remove(); 
    } else {
      alert('error' + txt);
    }
  })
  .catch(err => {
    alert('connection error');
    console.error(err);
  });
});



    function closeCustomer() {
    document.querySelector('.customerShow').style.display = 'none';
    document.querySelector('.customerShowDiscription').style.display = 'none';
    document.querySelector('.toMakeItBlur').style.filter = 'blur(0px)';
  }


  function editCustomer() {
    document.querySelector('.customerShow').style.display = 'block';
    document.querySelector('.customerShowDiscription').style.display = 'block';
    document.querySelector('.toMakeItBlur').style.filter = 'blur(16px)';

  }





//////// main page ///////////////


///page one ////video////
function changeVideo(){
  document.querySelector('.btnVideoApply').style.display = 'block';
  document.querySelector('.btnVideoCancel').style.display = 'block';
  document.querySelector('#videoInput').style.display = 'block';
    document.querySelector('.btnVideoCancel22').style.display = 'block';

}

function cancelVideo(){
    document.querySelector('.btnVideoApply').style.display = 'none';
  document.querySelector('.btnVideoCancel').style.display = 'none';
  document.querySelector('#videoInput').style.display = 'none';
    document.querySelector('.btnVideoCancel22').style.display = 'none';
  
}






//////////////////page two /////////////////
function changeImagesTwo(){
  document.querySelector('.btnImagesApply').style.display = 'block';
  document.querySelector('.btnImagesCancel').style.display = 'block';
  document.querySelector('.imgLabel').style.display = 'block';
  document.querySelector('.imgLabel2').style.display = 'block';
  document.querySelector('.imgLabel3').style.display = 'block';
}
function applyImagesTwo(){
  
}
function cancelImagesTwo(){
  document.querySelector('.btnImagesApply').style.display = 'none';
  document.querySelector('.btnImagesCancel').style.display = 'none';
  document.querySelector('.imgLabel').style.display = 'none';
  document.querySelector('.imgLabel2').style.display = 'none';
  document.querySelector('.imgLabel3').style.display = 'none';
}

//////////page 3////////////////////////s
function changeImagesThree(){
  document.querySelector('.btnImagesThreeApply').style.display = 'block';
  document.querySelector('.btnImagesThreeCancel').style.display = 'block';
 document.querySelector('.imgLabel4').style.display = 'block';
  document.querySelector('.imgLabel5').style.display = 'block';
  document.querySelector('.imgLabel6').style.display = 'block';

}
function applyImagesThree(){
  
}
function cancelImagesThree(){
  document.querySelector('.btnImagesThreeApply').style.display = 'none';
  document.querySelector('.btnImagesThreeCancel').style.display = 'none';
  document.querySelector('.imgLabel4').style.display = 'none';
  document.querySelector('.imgLabel5').style.display = 'none';
  document.querySelector('.imgLabel6').style.display = 'none';
}



function updateNotifications() {
  const count = parseInt(localStorage.getItem("unnoticedOrders") || "0");
  const badge = document.querySelector(".cartCount.notifications");
  const bell  = document.querySelector(".fa-bell");

  if (badge) {
    if (count > 0) {
      badge.textContent = count;
      badge.style.display = "inline-block";
      if (bell) bell.style.color = "#ffff"; // red if new orders
    } else {
      badge.textContent = "";
      badge.style.display = "none";
      if (bell) bell.style.color = "#bfbdbdff"; // white if no orders
    }
  }
}

// run once when page loads
updateNotifications();
document.querySelector(".fa-bell").addEventListener("click", () => {
   window.location.hash = "#settings";
  localStorage.setItem("unnoticedOrders", 0);
  updateNotifications();
});

window.addEventListener("storage", (e) => {
  if (e.key === "unnoticedOrders") {
    updateNotifications();
  }
});























///////////////////////////////////setting ///////////////////////////

function editName() {
  document.querySelector('#nameInput').style.display = 'block';
  document.querySelector('.btnSettings1').style.display = 'block';
  document.querySelector('.btnSettings2').style.display = 'none';
  document.querySelector('.btnSettings3').style.display = 'none';
  document.querySelector('.btnSettings4').style.display = 'none';
  document.querySelector('.btnSettings5').style.display = 'block';
  document.querySelector('.btnSettings6').style.display = 'block';
}
function applyEditName() {
    
}

function cancelEditName() {
  document.querySelector('#nameInput').style.display = 'none';
  document.querySelector('.btnSettings1').style.display = 'block';
  document.querySelector('.btnSettings2').style.display = 'block';
  document.querySelector('.btnSettings3').style.display = 'block';
  document.querySelector('.btnSettings4').style.display = 'block';
  document.querySelector('.btnSettings5').style.display = 'none';
  document.querySelector('.btnSettings6').style.display = 'none';
}

///////////////////////////////////////////////////

function editPassword() {
  document.querySelector('#passwordInput').style.display = 'block';
  document.querySelector('.btnSettings1').style.display = 'none';
  document.querySelector('.btnSettings2').style.display = 'block';
  document.querySelector('.btnSettings3').style.display = 'none';
  document.querySelector('.btnSettings4').style.display = 'none';
  document.querySelector('.btnSettings7').style.display = 'block';
  document.querySelector('.btnSettings8').style.display = 'block';
}

function applyEditPassword() {
    
}

function cancelEditPassword() {
  document.querySelector('#passwordInput').style.display = 'none';
  document.querySelector('.btnSettings1').style.display = 'block';
  document.querySelector('.btnSettings2').style.display = 'block';
  document.querySelector('.btnSettings3').style.display = 'block';
  document.querySelector('.btnSettings4').style.display = 'block';
   document.querySelector('.btnSettings7').style.display = 'none';
  document.querySelector('.btnSettings8').style.display = 'none';
}

////////////////////////////////////////////////////////////
function editEmail() {
  document.querySelector('#emailInput').style.display = 'block';
  document.querySelector('.btnSettings1').style.display = 'none';
  document.querySelector('.btnSettings2').style.display = 'none';
  document.querySelector('.btnSettings3').style.display = 'block';
  document.querySelector('.btnSettings4').style.display = 'none';
  document.querySelector('.btnSettings9').style.display = 'block';
  document.querySelector('.btnSettings10').style.display = 'block';
}

function applyEditEmail() {
    
}

function cancelEditEmail() {
  document.querySelector('#emailInput').style.display = 'none';
  document.querySelector('.btnSettings1').style.display = 'block';
  document.querySelector('.btnSettings2').style.display = 'block';
  document.querySelector('.btnSettings3').style.display = 'block';
  document.querySelector('.btnSettings4').style.display = 'block';
  document.querySelector('.btnSettings9').style.display = 'none';
  document.querySelector('.btnSettings10').style.display = 'none';
}





// email sent on add product -->

import("https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js")    
.then(() => {
  emailjs.init("3C2Muw3ickuu0FrEq");
});

function sendEmailsAfterAdd(productId) {
    fetch(`../api/getProduct.php?id=${productId}`)
        .then(res => res.json())
        .then(car => {
            if (!car || !car.id) return;
            fetch("../api/emailsForProducts.php")
                .then(res => res.json())
                .then(users => {
                    users.forEach(user => {
                        emailjs.send("service_rj120g6","template_qrz5kgz", {
                            company: car.CompanyId,
                            carName: car.Name,
                            model: car.Model,
                            year: car.Year,
                            color: car.Exterior,
                            color2: car.Interior,
                            price: car.Price,
                            image_url: "https://i.pinimg.com/1200x/17/df/ad/17dfad2fa9be615b06fbe31af9f92ba0.jpg",
                            email: user.Email
                        }).then(() => {
                            console.log("Email sent to:", user.Email);
                        }).catch(err => {
                            console.error("EmailJS error:", err);
                        });
                    });
                });
        });
}