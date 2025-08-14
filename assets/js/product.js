
localStorage.removeItem('modelId');
localStorage.removeItem('modelName');
localStorage.removeItem('condition');

document.querySelectorAll('.nav-link').forEach(link => {
  link.addEventListener('click', function () {
    document.querySelectorAll('.nav-link').forEach(el => el.classList.remove('active'));
    this.classList.add('active');
  });
});
document.addEventListener('DOMContentLoaded', () => {


  document.querySelectorAll('.productCards a').forEach((link) => {
    link.addEventListener('click', (e) => {
      const card = link.querySelector('.card');
      const id   = card?.dataset.id;
      const name = card?.querySelector('.card-title')?.textContent.trim();
      if (id)   localStorage.setItem('modelId', id);
      if (name) localStorage.setItem('modelName', name);
      e.preventDefault();
      window.location.href = link.href; 
    });
  });
});

function showFeedback() {
      document.getElementById('feedback').style.display = 'block';
    }

 // Select all cards
document.querySelectorAll('.card').forEach(card => {
  card.addEventListener('click', () => {
    const modelId = card.dataset.id; 
    localStorage.setItem("modelId", modelId);
     window.location.href = "../pages/filter.php";
  });
});




// used button  //


document.querySelectorAll('.usedcars').forEach(card => {
  card.addEventListener('click', () => {
    localStorage.setItem("condition", "used");
     window.location.href = "../pages/filter.php";
  });
});

// new button //
document.querySelectorAll('.newcars').forEach(card => {
  card.addEventListener('click', () => {
    localStorage.setItem("condition", "new");
     window.location.href = "../pages/filter.php";
  });
});

// pre owned button //
document.querySelectorAll('.preownedcars').forEach(card => {
  card.addEventListener('click', () => {
    localStorage.setItem("condition", "preowned");
     window.location.href = "../pages/filter.php";
  });
});

//////////////////// doop down //////////////
//////////////////// doop down //////////////
document.querySelectorAll('.nav-item-dropdown').forEach(card => {
  card.addEventListener('click', () => {
    const modelId = card.dataset.id; 
    localStorage.setItem("modelId", modelId);
     window.location.href = "../pages/filter.php";
  });
});
