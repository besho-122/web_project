

/*let isAtLeft = false;
function toggleForm() {
  const signupForm = document.querySelector('.signupForm');
  const signinForm = document.querySelector('.signinForm');
  const swiper = document.querySelector('.swiper');
  const swiperImage = document.getElementById('swiperImage');
  const toggleText = document.getElementById('toggleText');

  if (isAtLeft) {
    swiper.classList.remove('leftswiper');
    swiper.classList.add('rightswiper');
    signupForm.classList.add('signupvisible');
    signupForm.classList.remove('signuphidden');
    signinForm.classList.add('signinhidden');
    signinForm.classList.remove('signinvisible');
    fadeImage(swiperImage, "../assets/photos/discover2.jpg"); 
    toggleText.textContent = "Already have an account? Sign In";
  } else {
    swiper.classList.remove('rightswiper');
    swiper.classList.add('leftswiper');
    signupForm.classList.add('signuphidden');
    signupForm.classList.remove('signupvisible');
    signinForm.classList.add('signinvisible');
    signinForm.classList.remove('signinhidden');
    fadeImage(swiperImage, "../assets/photos/discover1.jpeg");
    toggleText.textContent = "Don't have an account? Sign Up";
  }

  isAtLeft = !isAtLeft;
}

function fadeImage(imgElement, newSrc) {
  imgElement.classList.remove('fade');
  void imgElement.offsetWidth;
  imgElement.src = newSrc;
  imgElement.classList.add('fade');
}*/




const container = document.getElementById("container");
const registerBtn = document.getElementById("register");
const loginBtn = document.getElementById("login");

registerBtn.addEventListener("click", () => {
  container.classList.add("active");
});

loginBtn.addEventListener("click", () => {
  container.classList.remove("active");
});


// Import the functions you need from the SDKs you need

// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
// For Firebase JS SDK v7.20.0 and later, measurementId is optional
