const message = localStorage.getItem("carName");
document.querySelector('.titleCar').innerHTML = message;



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