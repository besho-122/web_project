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



////////////////////////////////charts/////////////////////////////////////



    //chart2 
    const data2 = {
      labels: ['BMW', 'GOLF', 'Audi', 'Porsche', 'Opel', 'VW'],
      datasets: [{
        label: '# of Votes',
        data: [12, 19, 3, 5, 2, 3],
        borderWidth: 1,
        backgroundColor: ['#bbbbbbff', '#5a5a5aff', '#333333ff', '#94290eff', '#000000ff', '#8b8b8bff'],
      }]
    };


    function handleHover(evt, item, legend) {
      const colors = legend.chart.data.datasets[0].backgroundColor;
      colors.forEach((color, index) => {
        colors[index] = (index === item.index || color.length === 9) ? color : color + '4D';
      });
      legend.chart.update();
    }

    function handleLeave(evt, item, legend) {
      const colors = legend.chart.data.datasets[0].backgroundColor;
      colors.forEach((color, index) => {
        colors[index] = (color.length === 9) ? color.slice(0, -2) : color;
      });
      legend.chart.update();
    }

   const config2 = {
  type: 'doughnut',
  data: data2,
  options: {
    responsive: false,
    plugins: {
      legend: {
        labels: {
          font: {
            size: 10, 
            weight: 'bold' 
          },
          color: '#000' 
        }
      },
      tooltip: {
        bodyFont: {
          size: 10 
        }
      }
    }
  }
};

    const ctx2 = document.getElementById('lineChart');
    const myChart2 = new Chart(ctx2, config2);


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

  function closeProduct() {
    document.querySelector('.productShow').style.display = 'none';
    document.querySelector('.productShowDiscription').style.display = 'none';
    document.querySelector('.toMakeItBlur').style.filter = 'blur(0px)';
  }
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
            // Remove the card from the DOM
            const card = document.querySelector(`.productCard[data-id='${productId}']`);
            if (card) card.remove();
        } else {
            alert('Delete failed: ' + data);
            console.error(data);
        }
    })
    .catch(err => console.error(err));
}


 function addProduct() {
    const modal = document.querySelector('.productShow');
    modal.style.display = 'block';
    const modalContent = modal.querySelector('.productShowDiscription');
    if (modalContent) modalContent.style.display = 'flex';
    const blurLayer = document.querySelector('.toMakeItBlur');
    if (blurLayer) blurLayer.style.filter = 'blur(16px)';

    const form = document.getElementById('productForm');
    form.action = "../api/addProduct.php"; 
    form.reset(); 
    const hiddenId = form.querySelector('input[name="id"]');
    if (hiddenId) hiddenId.remove();
    const heading = modal.querySelector('.productShowDiscriptionInner h1');
    if (heading) heading.textContent = "Add Product";
    const submitBtn = modal.querySelector('.btnProductShowDiscriptionInnerList');
    if (submitBtn) submitBtn.textContent = "Add";
    for (let i = 1; i <= 5; i++) {
        const input = form.querySelector(`[name="img${i}"]`);
        if (!input) continue;
        const label = input.parentElement;
        const span = label.querySelector('span');
        if (span) span.style.display = 'block';
        const preview = label.querySelector(`#imgPreview${i}`);
        if (preview) preview.remove();
    }

    ['Condition','MileAge','Exterior','Interior','CompanyId','Model'].forEach(name => {
        const sel = form.querySelector(`[name="${name}"]`);
        if (sel) sel.selectedIndex = 0;
    });
}

function editProduct(productId) {
    const modal = document.getElementById('productModal');
    if (!modal) return;
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
        const companyValue = card.dataset.company || '';
        companySelect.value = companyValue;
        const event = new Event('change');
        companySelect.dispatchEvent(event);
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
        const span = label.querySelector('span');
        if (span) span.style.display = 'none';
        let preview = label.querySelector(`#imgPreview${index+1}`);
        if (!preview) {
            preview = document.createElement('img');
            preview.id = `imgPreview${index+1}`;
            preview.classList.add('preview');
            preview.style.width = (imgName === 'img1' || imgName === 'img5') ? '100%' : '120px';
            preview.style.height = (imgName === 'img1' || imgName === 'img5') ? '100%' : '90px';
            preview.style.objectFit = 'cover';
            preview.style.borderRadius = '8px';
            label.appendChild(preview);
        }
        preview.src = card.dataset[imgName] || '';
    });
    const heading = modal.querySelector('.productShowDiscriptionInner h1');
    if (heading) heading.textContent = "Edit Product";
    const submitBtn = modal.querySelector('.btnProductShowDiscriptionInnerList');
    if (submitBtn) submitBtn.textContent = "Update";
    const form = document.getElementById('productForm');
    if (form) form.action = "../api/updateProduct.php";
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
        .then(res => res.text())
        .then(data => {
            if (data.trim() === 'success') {
                alert('Product updated successfully!');
                closeProduct();
                card.dataset.name = formData.get('Name');
                card.dataset.price = formData.get('Price');
                card.dataset.year = formData.get('Year');
                card.dataset.condition = formData.get('Condition');
                card.dataset.mileage = formData.get('MileAge');
                card.dataset.exterior = formData.get('Exterior');
                card.dataset.interior = formData.get('Interior');
                card.dataset.company = formData.get('CompanyId');
                card.dataset.model = formData.get('Model');
                ['img1','img2','img3','img4','img5'].forEach(img => {
                    if (formData.get(img)) card.dataset[img] = card.dataset[img]; 
                });
            } else {
                alert('Update failed: ' + data);
                console.error(data);
            }
        })
        .catch(err => console.error(err));
    };
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
            const label = input.parentElement; // the label element
            const span = label.querySelector("span");

            // Hide the "+ Choose" text
            if (span) {
                span.style.display = "none";
            }

            // Check if preview already exists
            let preview = label.querySelector("img.preview");
            if (!preview) {
                preview = document.createElement("img");
                preview.classList.add("preview");

                // Style the image
                preview.style.width = "100%";
                preview.style.height = "100%";
                preview.style.objectFit = "cover";
                preview.style.borderRadius = "8px";

                // Add the preview inside the label
                label.appendChild(preview);
            }

            // Set the image source
            preview.src = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
    }
}


function showProductForm(product = null) {
    const container = document.getElementById("productShowContainer");

    // Create unique form id (important when editing multiple products)
    const formId = product ? `productForm_${product.id}` : "productForm_new";

    // Build HTML dynamically
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






    function closeCompany() {
    document.querySelector('.companyShow').style.display = 'none';
    document.querySelector('.companyShowDiscription').style.display = 'none';
    document.querySelector('.toMakeItBlur').style.filter = 'blur(0px)';
  }


  function editCompany() {
    document.querySelector('.companyShow').style.display = 'block';
    document.querySelector('.companyShowDiscription').style.display = 'block';
    document.querySelector('.toMakeItBlur').style.filter = 'blur(16px)';

  }


    function addCompany() {
    document.querySelector('.addCompany').style.display = 'block';
    document.querySelector('.toMakeItBlur').style.filter = 'blur(16px)';
  }

    function closeAddCompany() {
    document.querySelector('.addCompany').style.display = 'none';
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

}
function applyVideo(){
  
}
function cancelVideo(){
    document.querySelector('.btnVideoApply').style.display = 'none';
  document.querySelector('.btnVideoCancel').style.display = 'none';
  document.querySelector('#videoInput').style.display = 'none';
  
}






//////////////////page two /////////////////
function changeImagesTwo(){
  document.querySelector('.btnImagesApply').style.display = 'block';
  document.querySelector('.btnImagesCancel').style.display = 'block';
  document.querySelector('#imageInput1').style.display = 'block';
  document.querySelector('#imageInput2').style.display = 'block';
  document.querySelector('#imageInput3').style.display = 'block';
}
function applyImagesTwo(){
  
}
function cancelImagesTwo(){
  document.querySelector('.btnImagesApply').style.display = 'none';
  document.querySelector('.btnImagesCancel').style.display = 'none';
  document.querySelector('#imageInput1').style.display = 'none';
  document.querySelector('#imageInput2').style.display = 'none';
  document.querySelector('#imageInput3').style.display = 'none';
}

//////////page 3////////////////////////
function changeImagesThree(){
  document.querySelector('.btnImagesThreeApply').style.display = 'block';
  document.querySelector('.btnImagesThreeCancel').style.display = 'block';
  document.querySelector('#imageInputThree1').style.display = 'block';
  document.querySelector('#imageInputThree2').style.display = 'block';
  document.querySelector('#imageInputThree3').style.display = 'block';
}
function applyImagesThree(){
  
}
function cancelImagesThree(){
  document.querySelector('.btnImagesThreeApply').style.display = 'none';
  document.querySelector('.btnImagesThreeCancel').style.display = 'none';
  document.querySelector('#imageInputThree1').style.display = 'none';
  document.querySelector('#imageInputThree2').style.display = 'none';
  document.querySelector('#imageInputThree3').style.display = 'none';
}






















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








