<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/png" sizes="512x512" href="./assets/photos/MY.png">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Audiowide&family=Bangers&family=Berkshire+Swash&family=Lobster&family=Molle&family=Orbitron:wght@400..900&family=Pacifico&family=Playwrite+DK+Uloopet:wght@100..400&family=Righteous&family=Ruslan+Display&family=Unbounded:wght@200..900&family=Warnes&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  <link href="./assets/css/homePage.css" rel="stylesheet">
 

  <title>Motor Yard</title>
<?php
session_start();
$isLoggedIn = isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] === true ? 'true' : 'false';
?>
<script>
    localStorage.setItem('isLoggedIn', '<?php echo $isLoggedIn; ?>');
</script>

</head>


<body>
  <!-- nav section --->
  <nav class=" fixed-top homePageNavbar">
    <div class="container-fluid px-5 behind">
      <a class="brand" href="#">
        <img src="./assets/photos/title.png" id="mainTitle" alt="" width="200px">
      </a>
      <button class="navbar-toggler"  type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar"
        aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
       <a onclick="return profileOrLogin(event)" > <i class="fa-solid fa-user fa-lg" id="logTitle" style="color: #ffffff;"></i></a>
      </button>

    </div>
  </nav>
  <nav class="navbar">
  <ul class="navbar__menu">
    <li class="navbar__item">
      <a href="#" class="navbar__link"><i data-feather="home"></i><span>Home</span></a>
    </li>
    <li class="navbar__item">
      <a href="./pages/products.php" class="navbar__link" onclick="return checkLogin(event)" ><i class="fa-solid fa-car fa-lg" style="color: #ffffff;"></i><span>Cars</span></a>        
    </li>
    <li class="navbar__item">
      <a href="./pages/filter.php" class="navbar__link"  onclick="return checkLogin(event)"><i class="fa-solid fa-magnifying-glass fa-lg" style="color: #ffffff;"></i><span>FindYourCar</span></a>        
    </li>
    <li class="navbar__item">
      <a href="./pages/products.php" class="navbar__link"  onclick="return checkLogin(event)"><i data-feather="archive"></i><span>Resources</span></a>        
    </li>
    <li class="navbar__item">
      <a href="#contactSection" class="navbar__link"><i data-feather="help-circle"></i><span>Help</span></a>        
    </li>
    <li class="navbar__item">
      <a href="#" class="navbar__link"  onclick="return checkLogin(event)"><i data-feather="settings"></i><span>Settings</span></a>        
    </li>
  </ul>
</nav>
  <!-- main section -->
  <section class="homePageMainSection ">
    <video id="bgVideo" src="./assets/videos/homePage/main.mp4" autoplay muted loop ></video>
    <div class="homePageMainSectionText ">
      <button id="videoToggle" class="video-btn"><i class="fas fa-pause"></i></button>
      <h2 class="fade-in-home-text">Motors <span class="highlight">For</span> Sells.</h2>
      <h3 class="fade-in-home-text">Discover the new Deadpool Edition</h3>
      
      <!--<a herf="#"><button type="button" class="btn btn-primary">Learn more</button></a>-->
    </div>
    <p class="fade-in-home-text">Electric energy consumption combined (model range): 20.3 – 18.0 kWh/100 km, CO₂-emissions combined (model range): 0 g/km</p>
  </section>


<div class="homePageMainSectionOverlay">
<div class="overlay">
<img src="./assets/photos/videoSlider/Alloy-Wheel-Black-Rims-PNG.png" class="item"style="--position: 1" alt="" width=auto>
<img src="./assets/photos/videoSlider/Alloy-Wheel-Black-Rims-PNG.png" class="item"style="--position: 2" alt="" width=auto>
<img src="./assets/photos/videoSlider/Alloy-Wheel-Black-Rims-PNG.png" class="item"style="--position: 3" alt="" width=auto>
<img src="./assets/photos/videoSlider/Alloy-Wheel-Black-Rims-PNG.png"class="item"style="--position: 4" alt="" width=auto>
<img src="./assets/photos/videoSlider/Alloy-Wheel-Black-Rims-PNG.png" class="item"style="--position: 5" alt="" width=auto>
<img src="./assets/photos/videoSlider/Alloy-Wheel-Black-Rims-PNG.png" class="item"style="--position: 6" alt="" width=auto>
<img src="./assets/photos/videoSlider/Alloy-Wheel-Black-Rims-PNG.png" class="item"style="--position: 7" alt="" width=auto>
<img src="./assets/photos/videoSlider/Alloy-Wheel-Black-Rims-PNG.png"class="item"style="--position: 8" alt="" width=auto>
<img src="./assets/photos/videoSlider/Alloy-Wheel-Black-Rims-PNG.png"class="item"style="--position: 9" alt="" width=auto>
<img src="./assets/photos/videoSlider/Alloy-Wheel-Black-Rims-PNG.png" class="item"style="--position: 10" alt="" width=auto> 

</div>
  </div>
  <!-- homePageTwoSection  -->
  <section class="homePageTwoSection " id="mainSection">
    <div class="homePageTwoSectionText">
      <div class="servicesGrid">
        <div class="serviceCard homePageTwoSectionCard fade-in" >
          <div class="cardOverlay">
          <h3 class="cardTitle">The Macan Turbo.</h3>
          <span class="cardIcon">➜</span>
       </div>
          <img src="./assets/photos/sectionTwo/car1blue.jpg" alt="">
        </div>
        <div class="serviceCard homePageTwoSectionCard fade-in" >
          <div class="cardOverlay">
          <h3 class="cardTitle">The Cayenne.</h3>
          <span class="cardIcon">➜</span>
       </div>
          <img src="./assets/photos/sectionTwo/2025-Mercedes-AMG.jpg" alt=""> 
        </div>
        <div class="serviceCard homePageTwoSectionCard fade-in" >
          <div class="cardOverlay">
          <h3 class="cardTitle">The 911 Carrera T.</h3>
          <span class="cardIcon">➜</span>
       </div>
          <img src="./assets/photos/sectionTwo/2025-Lamborghini-Temerario-003-2160.jpg" alt="">
        </div>
      </div>
    </div>
    <p>Macan Turbo Electric: Electrical consumption combined (WLTP): 20.7 – 18.9 kWh/100 km, CO₂-emissions combined (WLTP): 0 g/km | Cayenne: Fuel consumption combined (model range): 11.7 – 10.7 l/100 km, CO₂-emissions combined (model range): 267 – 243 g/km | 911 Carrera T: Fuel consumption combined (model range): 10.9 – 10.4 l/100 km, CO₂-emissions combined (model range): 248 – 237 g/km</p>
  </section>
  <!-- contact section -->
   

  <!-- second section -->

  <section class="homePageSecondSection" id="secondSection">
    <div class="secondSectionContent container3">
      
      <h2 class="yourJourney">Your journey starts now.</h2> 
     
      <div class="servicesGrid3 ">
         <div class="servicesGrid2rows">
        <div class="serviceCard3 homePagethreeSectionCard fade-in" >
          <div class="cardOverlay2">
          <h3 class="cardTitle2">Panamera</h3>
          <div class="cardOverlay gas">
            <p class="type">Gasoline</p>
            <p class="cardTitle describe">Iconic sports car with real engine: 2 doors, 2+2 seats</p>
          </div>
          <span class="cardIcon2">➜</span>
       </div>
          <img src="./assets/photos/sectionThree/gtr.jpg" alt="">
          <video src="./assets/videos/homePage/videos for section 3/gtr.mp4" autoplay muted loop></video>
        
        </div>
        <div class="serviceCard3 homePagethreeSectionCard fade-in" >
          <div class="cardOverlay2">
          <h3 class="cardTitle2">911</h3>
           <div class="cardOverlay gas">
            <p class="type">Gasoline</p>
            <p class="cardTitle describe">Iconic sports car with real engine: 2 doors, 2+2 seats</p>
          </div>
          <span class="cardIcon2">➜</span>
       </div>
           <img src="./assets/photos/sectionThree/gtr.jpg" alt="">
           <video src="./assets/videos/homePage/videos for section 3/gtr.mp4" autoplay muted loop></video>
         

        </div>
        </div>
        <div class="servicesGrid2rows">
        <div class="serviceCard3 homePagethreeSectionCard fade-in" >
          <div class="cardOverlay2">
          <h3 class="cardTitle2">BMW</h3>
           <div class="cardOverlay gas">
            <p class="type">Gasoline</p>
            <p class="cardTitle describe">Iconic sports car with real engine: 2 doors, 2+2 seats</p>
          </div>
          <span class="cardIcon2">➜</span>
       </div>
          <img src="./assets/photos/sectionThree/gtr.jpg" alt="">
           <video src="./assets/videos/homePage/videos for section 3/gtr.mp4" autoplay muted loop></video>
        </div>
        <div class="serviceCard3 homePagethreeSectionCard fade-in" >
          <div class="cardOverlay2">
          <h3 class="cardTitle2">BMW</h3>
           <div class="cardOverlay gas">
            <p class="type">Gasoline</p>
            <p class="cardTitle describe">Iconic sports car with real engine: 2 doors, 2+2 seats</p>
          </div>
          <span class="cardIcon2">➜</span>
       </div>
          <img src="./assets/photos/sectionThree/gtr.jpg" alt="">
           <video src="./assets/videos/homePage/videos for section 3/gtr.mp4" autoplay muted loop></video>
        </div>

      </div>
   </div>
   
      
       <!---  <div class="swiper">
    <div class="swiper-wrapper">
      <div class="swiper-slide" style="background-image:url(./assets/photos/bmw.png)"></div>
     <div class="swiper-slide" style="background-image:url(./assets/photos/audi.png )"></div>
      <div class="swiper-slide" style="background-image:url(./assets//photos/porsche.png )"></div>
     <div class="swiper-slide" style="background-image:url(./assets//photos/Volkswagen.png )"></div>
     <div class="swiper-slide" style="background-image:url(./assets//photos/lamborghini.png )"></div>
       <div class="swiper-slide" style="background-image:url(./assets//photos/ford.png )"></div>
     <div class="swiper-slide" style="background-image:url(./assets//photos/toyota.png )"></div>
     <div class="swiper-slide" style="background-image:url(./assets//photos/jeep.png )"></div>
     <div class="swiper-slide" style="background-image:url(./assets//photos/kia.png )"></div>
     <div class="swiper-slide" style="background-image:url(./assets//photos/mercedes.png )"></div>
     <div class="swiper-slide" style="background-image:url(./assets//photos/nissan.png )"></div>
     <div class="swiper-slide" style="background-image:url(./assets//photos/Opel.png )"></div>
    -->
    </div>
  </section>
<section class="homePageFourSection" id="thirdSection">
  <div class="homePageTwoSectionText">
    <div class="car-container">
      <div class="car-image">
        <img src="./assets/photos/sectionTwo/building.jpg" alt="Car">
      </div>
      <div class="car-content">
        <h1>Find your new or pre-owned Car.</h1>
        <p>
          A Porsche is as individual as its owner. It is always an expression of one's own personality.
          We help you find your personal dream vehicle from authorised Porsche Centres.
        </p>
        <a href="./pages/products.html"> <button>Find your Car</button></a>
       
      </div>
    </div>
  </div>
</section>


<!-- homePageDiscover -->
<section class="homePageTwoSection " id="discoverSection">
    <div class="homePageTwoSectionText">
      <h2>Discover</h2>
      <div class="servicesGrid">
        <div class="serviceCard homePageTwoSectionCard fade-in cardDiscover" >
          <div class="cardOverlay">
          <h3 class="cardTitle">E-Performance - Sustainable Mobility</h3>
          <span class="cardIcon">➜</span>
       </div>
          <img src="./assets/photos/discover2.jpg" alt="">
        </div>
        <div class="serviceCard homePageTwoSectionCard fade-in cardDiscover" >
          <div class="cardOverlay">
          <h3 class="cardTitle">Car Tequipment</h3>
          <span class="cardIcon">➜</span>
       </div>
          <img src="./assets/photos/discover1.jpeg" alt=""> 
        </div>
        <div class="serviceCard homePageTwoSectionCard fade-in cardDiscover" >
          <div class="cardOverlay">
          <h3 class="cardTitle">Exclusive Manufaktur</h3>
          <span class="cardIcon">➜</span>
       </div>
          <img src="./assets/photos/discover3.jpg" alt="">
        </div>
      </div>
    </div>
  </section>

  

  <section class="homePageContactSection" id="contactSection">
    <h2 class="followUs">Follow US</h2>
    <div class="containerContact">
    <div class="card">
  <div class="image">
    <img src="./assets/photos/yousef.jpg" alt="Profile Photo">
  </div>
  <div class="link">
    <a class="icon-circle icon1" href="https://www.facebook.com/yousef.hajeer.3"><i class="fa-brands fa-facebook"></i></a>
    <a class="icon-circle icon2" href="https://x.com/yousefh2004"><i class="fa-brands fa-twitter"></i></a>
    <a class="icon-circle icon3" href="https://www.instagram.com/yousefh2004.n/?__pwa=1"><i class="fa-brands fa-instagram"></i></a>
  </div>
</div>


<div class="card">
  <div class="image">
    <img src="./assets/photos/besho.jpg" alt="Profile Photo">
  </div>
  <div class="link">
    <a class="icon-circle icon1" href="https://www.facebook.com/MOMO38322"><i class="fa-brands fa-facebook"></i></a>
    <a class="icon-circle icon2" href="https://www.instagram.com/mohammad_n_bish/?__pwa=1"><i class="fa-brands fa-twitter"></i></a>
    <a class="icon-circle icon3" href="https://www.instagram.com/mohammad_n_bish/?__pwa=1"><i class="fa-brands fa-instagram"></i></a>
  </div>
</div>

    </div>

    <!-- Footer -->
    <footer class="footer">
      <p>© 2025 Porsche Middle East and Africa FZE. Legal Notice.Privacy Policy.Open Source Software Notice.Whistleblower System.</p>
      <img src="./assets/photos/title.png" id="mainTitle" alt="" width="200px">
    </footer>
  </section>

  
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>

  toastr.options = {
    positionClass: "toast-bottom-right",
    closeButton: true,
    progressBar: true,
    timeOut: "3000"
  };


  function checkLogin(event) {
    const isLoggedIn = localStorage.getItem('isLoggedIn');
    if (isLoggedIn === 'true') {
      return true;
    } else {
      if (event) event.preventDefault();
      toastr.error('Please log in to access this page.', 'You are not logged in!');
      return false;
    }
  }

  function profileOrLogin(event){
    const isLoggedIn = localStorage.getItem('isLoggedIn');
    if (isLoggedIn === 'true') {
      window.location.href = './pages/profile.php';
    } else {
      if (event) event.preventDefault();
      window.location.href = './pages/login.html';
    }

  }
</script>



<script type="module" src="https://unpkg.com/feather-icons">
  import Swiper from 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.mjs'
  var swiper = new Swiper('.swiper', {
    effect: 'coverflow',
      grabCursor: true,
      autoplay: {
        delay: 2000,
      },
      centeredSlides: true,
      slidesPerView: 'auto',            
      initialSlide: 3,
      coverflowEffect: {
        rotate: 0,
        stretch: 132,
        depth: 100,
        modifier:5,
        slideShadows: false,
      },
      pagination: {
        el: '.swiper-pagination',
      },
    });


    

 
</script>

<script src="./assets/js/homePage.js" defer></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
</body>

</html>