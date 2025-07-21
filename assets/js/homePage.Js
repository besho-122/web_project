
//hide title
  window.addEventListener('scroll', function() {
      const title = document.getElementById('mainTitle');
      const scrollY = window.scrollY;
      const windowHeight = window.innerHeight;
 console.log('scrollY:', scrollY, 'windowHeight:', windowHeight);
      if (scrollY >= windowHeight) {
          title.classList.add('hidden');
      } else {
          title.classList.remove('hidden');
      }
  });



