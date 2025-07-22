
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

//Fade In
const faders = document.querySelectorAll('.fade-in');
const pargraphChange = mainSection.querySelector('P');
const options = {
  threshold: 0.1
};
const observer = new IntersectionObserver((entries) => {
  entries.forEach((entry, index) => {
    if (entry.isIntersecting) {
      entry.target.style.animation = `fadeInUp 0.8s ease forwards`;
      entry.target.style.animationDelay = `${index * 0.2}s`;
       observer.unobserve(entry.target);
    } else {
      entry.target.style.animation = 'none';
    }
  });
}, options);
faders.forEach((fader) => {
  observer.observe(fader);
});

//Color chaging
window.addEventListener('scroll', () => {
  const mainSection = document.getElementById('mainSection');
  const secondSection = document.getElementById('secondSection');
  const thirdSection = document.getElementById('thirdSection');
  const titleDiscover = secondSection.querySelector('h2'); 
  const pargraphChange = mainSection.querySelector('P');
  const scrollY = window.scrollY;
  const windowHeight = window.innerHeight;
  const secondTop = secondSection.offsetTop;
  const thirdTop = thirdSection.offsetTop;
  const middleScreen = scrollY + windowHeight / 2;
  if (middleScreen >= secondTop && middleScreen < thirdTop) {
    document.body.style.backgroundColor = 'black';
    if (titleDiscover || pargraphChange) {
        titleDiscover.style.color = 'white';
        pargraphChange.style.color = 'white'
    }
  } else {
    document.body.style.backgroundColor = 'white';
    if (titleDiscover || pargraphChange) {
        titleDiscover.style.color = 'black';
        pargraphChange.style.color = 'black';
    }
  }
});












 