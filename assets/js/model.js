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


//COUNT UP
class RollingNumber {
  constructor(element) {
    this.element = element;
    this.digits = [];
    this.currentValue = "";
    this.decimals = parseInt(element.dataset.decimals) || 0;
    this.offsets = [];
    this._initDigits("0");
  }

  _initDigits(value) {
    this.element.innerHTML = "";
    this.digits = [];
    this.offsets = [];

    value = Number(value).toFixed(this.decimals);
    for (let i = 0; i < value.length; i++) {
      const char = value[i];
      if (char === ".") {
        const dot = document.createElement("span");
        dot.textContent = ".";
        dot.style.width = "0.5ch";
        this.element.appendChild(dot);
        continue;
      }
      const digitContainer = document.createElement("div");
      digitContainer.className = "digit-container";
      const digitStrip = document.createElement("div");
      digitStrip.className = "digit-strip";

      for (let d = 0; d <= 9; d++) {
        const digit = document.createElement("div");
        digit.className = "digit";
        digit.textContent = d;
        digitStrip.appendChild(digit);
      }
      digitContainer.appendChild(digitStrip);
      this.element.appendChild(digitContainer);
      this.digits.push(digitStrip);
      this.offsets.push(0);
    }
    this.currentValue = value;
  }
  

  updateTarget(newValue) {
    if (newValue.length !== this.currentValue.length) {
      this._initDigits(newValue);
    }
    this.targetOffsets = [];
    let j = 0;
    for (let i = 0; i < newValue.length; i++) {
      const char = newValue[i];
      if (char === ".") continue;
      const digit = parseInt(char, 10);
      this.targetOffsets[j] = -digit * 1.2;
      j++;
    }
    this.currentValue = newValue;
  }

  animateStep() {
    let moving = false;
    for (let i = 0; i < this.digits.length; i++) {
      let diff = this.targetOffsets[i] - this.offsets[i];
      if (Math.abs(diff) > 0.01) {
        this.offsets[i] += diff * 0.2;
        moving = true;
      } else {
        this.offsets[i] = this.targetOffsets[i];
      }
      this.digits[i].style.transform = `translateY(${this.offsets[i]}em)`;
    }
    return moving;
  }
}

function countUpRolling(rollingNum, target, duration) {
  let startTime = null;

  function animate(time) {
    if (!startTime) startTime = time;
    let elapsed = time - startTime;
    let progress = Math.max(elapsed / duration, 1);

    let value = (progress * target).toFixed(rollingNum.decimals);

    rollingNum.updateTarget(value);
    let moving = rollingNum.animateStep();

    if (progress < 0 || moving) {
      requestAnimationFrame(animate);
    }
  }

  requestAnimationFrame(animate);
}


const acceleration = new RollingNumber(document.getElementById("acceleration"));
const powerKW = new RollingNumber(document.getElementById("powerKW"));
const powerPS = new RollingNumber(document.getElementById("powerPS"));
const speed = new RollingNumber(document.getElementById("speed"));

countUpRolling(acceleration, 4.7, 2000);
countUpRolling(powerKW, 320, 2000);
countUpRolling(powerPS, 435, 2000);
countUpRolling(speed, 220, 2000);

