

//hide title
  window.addEventListener('scroll', function() {
      const title = document.getElementById('mainTitle');
      const logIn = document.getElementById('logTitle');
      const scrollY = window.scrollY;
      const windowHeight = window.innerHeight;
 console.log('scrollY:', scrollY, 'windowHeight:', windowHeight);
      if (scrollY >= windowHeight/2) {
          title.classList.add('hidden');
          logIn.classList.add('hidden');
      } else {
          title.classList.remove('hidden');
          logIn.classList.remove('hidden');
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
  const secondSection = document.getElementById('secondSection');
  const thirdSection = document.getElementById('thirdSection');
  const contactSection = document.getElementById('contactSection'); 
  const titleDiscover = secondSection.querySelector('h2'); 
  const navbarLinks = document.querySelectorAll('.navbar__link'); 

  const scrollY = window.scrollY;
  const windowHeight = window.innerHeight;
  const secondTop = secondSection.offsetTop;
  const thirdTop = thirdSection.offsetTop;
  const contactTop = contactSection.offsetTop;
  const middleScreen = scrollY + windowHeight / 2;

  if (middleScreen >= secondTop && middleScreen < thirdTop) {
    document.body.style.backgroundColor = 'black';
    if (titleDiscover) titleDiscover.style.color = 'white';
    navbarLinks.forEach(link => {
      link.style.color = 'white';
      link.style.color = 'white';  
    });
  } 
  else if (middleScreen >= contactTop) {
    document.body.style.backgroundColor = '#222';
    navbarLinks.forEach(link => {
      link.style.color = 'white'; 
    });
  } 
  else {
    document.body.style.backgroundColor = 'white';
    if (titleDiscover) titleDiscover.style.color = 'black';
    navbarLinks.forEach(link => {
      link.style.color = 'black';
      link.style.color = 'black'; 
    });
  }
});


window.addEventListener('scroll', () => {
  const mainSection = document.querySelector('.homePageMainSection');
  const navbarLinks = document.querySelectorAll('.navbar__link');
  const scrollY = window.scrollY;
  const windowHeight = window.innerHeight;
  const mainTop = mainSection.offsetTop;
  const mainBottom = mainTop + mainSection.offsetHeight;
  const middleScreen = scrollY + windowHeight / 2;

  if (middleScreen >= mainTop && middleScreen < mainBottom) {
    navbarLinks.forEach(link => {
      link.style.color = 'white';
    });
  }
});



// menu
document.addEventListener("DOMContentLoaded", function () {
  feather.replace();
});

// play video
document.addEventListener("DOMContentLoaded", () => {
  const video = document.getElementById("bgVideo");
  const toggleBtn = document.getElementById("videoToggle");
  const icon = toggleBtn.querySelector("i");

  toggleBtn.addEventListener("click", () => {
    if (video.paused) {
      video.play();
      icon.classList.remove("fa-play");
      icon.classList.add("fa-pause");
    } else {
      video.pause();
      icon.classList.remove("fa-pause");
      icon.classList.add("fa-play");
    }
  });
});


// menu animation
(() => {
  const mq = window.matchMedia('(max-width: 767.98px)'); 
  let inSection = false;
  let isAnimating = false;

  const section = document.querySelector('.homePageTwoSection');
  const navbarItems = document.querySelectorAll('.navbar__item');
  if (!section || !navbarItems.length) return;

  const totalAnimTime = navbarItems.length * 400;

  function resetItems(){
    navbarItems.forEach(item => { item.style.transform = 'translateX(0)'; });
    inSection = false;
    isAnimating = false;
  }

  function onScroll(){
    if (mq.matches) return;

    const scrollY = window.scrollY;
    const windowHeight = window.innerHeight;
    const sectionTop = section.offsetTop;
    const sectionBottom = sectionTop + section.offsetHeight;
    const middleScreen = scrollY + windowHeight / 2;

    if (middleScreen >= sectionTop && middleScreen < sectionBottom) {
      if (!inSection && !isAnimating) {
        inSection = true;
        isAnimating = true;
        navbarItems.forEach((item, index) => {
          setTimeout(() => {
            item.style.transform = 'translateX(calc(100vw - 8rem))';
          }, index * 400);
        });
        setTimeout(() => isAnimating = false, totalAnimTime);
      }
    } else {
      if (inSection && !isAnimating) {
        inSection = false;
        isAnimating = true;
        navbarItems.forEach((item, index) => {
          setTimeout(() => {
            item.style.transform = 'translateX(0)';
          }, index * 400);
        });
        setTimeout(() => isAnimating = false, totalAnimTime);
      }
    }
  }
  function applyMode(){
    if (mq.matches) {
      window.removeEventListener('scroll', onScroll);
      resetItems();
    } else {
      window.addEventListener('scroll', onScroll, { passive: true });
      onScroll(); 
    }
  }

  applyMode();
  if (mq.addEventListener) mq.addEventListener('change', applyMode);
  else mq.addListener(applyMode);
})();




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


// select product video
document.querySelectorAll('.serviceCard3').forEach(serviceCard3 => {
  serviceCard3.addEventListener('click', () => {
    const modelId = serviceCard3.dataset.id; 
    const modelName = serviceCard3.dataset.name;
    localStorage.setItem("modelId", modelId);
    localStorage.setItem("modelName", modelName);
     window.location.href = "./pages/filter.php";
  });
});

