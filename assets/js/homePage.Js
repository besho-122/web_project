
//hide title
  window.addEventListener('scroll', function() {
      const title = document.getElementById('mainTitle');
      const scrollY = window.scrollY;
      const windowHeight = window.innerHeight;
 console.log('scrollY:', scrollY, 'windowHeight:', windowHeight);
      if (scrollY >= windowHeight/2) {
          title.classList.add('hidden');
      } else {
          title.classList.remove('hidden');
      }
  });



window.addEventListener('scroll', function () {
    const elements = document.querySelectorAll('.fade-in');
    const windowHeight = window.innerHeight;

    elements.forEach(el => {
      const position = el.getBoundingClientRect().top;
      if (position < windowHeight - 100) { 
        el.classList.add('appear');
      }
    });
  });