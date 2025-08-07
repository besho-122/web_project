document.querySelectorAll('.nav-link').forEach(link => {
  link.addEventListener('click', function () {
    document.querySelectorAll('.nav-link').forEach(el => el.classList.remove('active'));
    this.classList.add('active');
  });
});

function showFeedback() {
      document.getElementById('feedback').style.display = 'block';
    }

 // Select all cards
document.querySelectorAll('.card').forEach(card => {
  card.addEventListener('click', () => {
    const modelName = card.querySelector('h1').textContent;
    localStorage.setItem("modelName", modelName);
    window.location.href = "../pages/filter.html";
  });
});

