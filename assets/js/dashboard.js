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

    const data = {
      labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
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

   const config = {
  type: 'polarArea',
  data: data,
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

    const ctx = document.getElementById('pieChart');
    const myChart = new Chart(ctx, config);


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


  function editProduct() {
    document.querySelector('.productShow').style.display = 'block';
    document.querySelector('.productShowDiscription').style.display = 'block';
    document.querySelector('.toMakeItBlur').style.filter = 'blur(16px)';

  }


  //////show company////////////
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


  /////////////////////cutomer //////

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








