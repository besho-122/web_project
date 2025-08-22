<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
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
$user_id = isset($_SESSION['userName']) ? $_SESSION['userName'] : null;

?>
<script>
    localStorage.setItem('isLoggedIn', '<?php echo $isLoggedIn; ?>');
    localStorage.setItem('userName', '<?php echo $user_id; ?>');
</script>
<?php
require './api/config.php'; 

$sql = "SELECT id, Name, Description
        FROM Company
        ORDER BY id DESC
        LIMIT 4";

$stmt = $dp->prepare($sql);
$stmt->execute();
$res = $stmt->get_result();
$companies = $res->fetch_all(MYSQLI_ASSOC);
$comp1=$companies[0]['id'];
$comp2=$companies[1]['id'];
$comp3=$companies[2]['id'];
$comp4=$companies[3]['id'];
$compName1=$companies[0]['Name'];
$compName2=$companies[1]['Name'];
$compName3=$companies[2]['Name'];
$compName4=$companies[3]['Name'];
$compdis1=$companies[0]['Description'];
$compdis2=$companies[1]['Description'];
$compdis3=$companies[2]['Description'];
$compdis4=$companies[3]['Description'];

$stmt->close();

?>





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
      <a href="./pages/products.php" class="navbar__link" title="Cars" onclick="return checkLogin(event)" ><i class="fa-solid fa-car fa-lg" ></i><span>Cars</span></a>        
    </li>
    <li class="navbar__item">
      <a href="./pages/filter.php" class="navbar__link"  title="FindYourCar" onclick="return checkLogin(event)"><i class="fa-solid fa-magnifying-glass fa-lg"></i><span>FindYourCar</span></a>        
    </li>
    <li class="navbar__item">
      <a href="./pages/configure.php" class="navbar__link" title="Configure" onclick="return checkLogin(event)"><i data-feather="sun"></i><span>Configure</span></a>        
    </li>
    <li class="navbar__item">
      <a href="#contactSection" class="navbar__link" title="Contact"><i data-feather="help-circle"></i><span>Help</span></a>        
    </li>
    <li class="navbar__item">
      <a href="../pages/profile.php?tab=settings" class="navbar__link"  title="Settings" onclick="return checkLogin(event)"><i data-feather="settings"></i><span>Settings</span></a>        
    </li>
  </ul>
</nav>
  <!-- main section -->
  <section class="homePageMainSection ">
   <video id="bgVideo"
  src="./assets/videos/homePage/main.mp4?v=<?= filemtime(__DIR__ . '/assets/videos/homePage/main.mp4') ?>"
  autoplay muted loop>
</video>
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
  <?php 
   $sql = "SELECT id FROM Product ORDER BY id DESC LIMIT 1";
   $result = $dp->query($sql);
   $row = $result->fetch_assoc();
   $id = $row['id'];
   $sql = "SELECT id FROM Product ORDER BY Price DESC LIMIT 1";
   $result = $dp->query($sql);
   $row = $result->fetch_assoc();
   $id2 = $row['id']; 
    $sql = "SELECT ProductId FROM `Order` ORDER BY id DESC LIMIT 1";
   $result = $dp->query($sql);
   $row = $result->fetch_assoc();
   $id3 = $row['ProductId'];


   ?>
  <!-- homePageTwoSection  -->
  <section class="homePageTwoSection " id="mainSection">
    <div class="homePageTwoSectionText">
      <div class="servicesGrid">
        <a href="../pages/model.php?id=<?php echo $id; ?>" onClick="return checkLogin(event)">
        <div class="serviceCard homePageTwoSectionCard fade-in" >
          <div class="cardOverlay">
          <h3 class="cardTitle">The Newest Model.</h3>
          <span class="cardIcon">➜</span>
       </div>
          <img src="./assets/photos/sectionTwo/img1.jpg?v=<?= filemtime(__DIR__ . '/assets/photos/sectionTwo/img1.jpg') ?>" alt="">
        </div>
        </a>
          <a href="../pages/model.php?id=<?php echo $id2; ?>" onClick="return checkLogin(event)">
        <div class="serviceCard homePageTwoSectionCard fade-in" >
          <div class="cardOverlay">
          <h3 class="cardTitle">The Chepest Model.</h3>
          <span class="cardIcon">➜</span>
       </div>
         <img src="./assets/photos/sectionTwo/img2.jpg?v=<?= filemtime(__DIR__ . '/assets/photos/sectionTwo/img2.jpg') ?>" alt="">
        </div>
        </a>
          <a href="../pages/model.php?id=<?php echo $id3; ?>" onClick="return checkLogin(event)">
        <div class="serviceCard homePageTwoSectionCard fade-in" >
          <div class="cardOverlay">
          <h3 class="cardTitle">The Last Orederd Model.</h3>
          <span class="cardIcon">➜</span>
       </div>
         <img src="./assets/photos/sectionTwo/img3.jpg?v=<?= filemtime(__DIR__ . '/assets/photos/sectionTwo/img3.jpg') ?>" alt="">
        </div>
        </a>
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
          
        <div class="serviceCard3 homePagethreeSectionCard fade-in"  data-id=<?php echo $comp1 ?> data-name=<?php echo $compName1 ?> onClick="return checkLogin(event)">
          <div class="cardOverlay2">
          <h3 class="cardTitle2"><?php echo $compName1 ?></h3>
          <div class="cardOverlay gas">
            <p class="type"><?php echo $compName1 ?></p>
            <p class="cardTitle describe"><?php echo $compdis1 ?></p>
          </div>
          <span class="cardIcon2">➜</span>
       </div>
          <img src="./assets/photos/sectionThree/gtr.jpg" alt="">
          <video src="./assets/videos/homePage/videos for section 3/gtr.mp4" autoplay muted loop></video>

</div>
       
        <div class="serviceCard3 homePagethreeSectionCard fade-in"data-id=<?php echo $comp2 ?> data-name=<?php echo $compName2 ?> onClick="return checkLogin(event)" >
          <div class="cardOverlay2">
          <h3 class="cardTitle2"><?php echo $compName2 ?></h3>
           <div class="cardOverlay gas">
            <p class="type"><?php echo $compName2 ?></p>
            <p class="cardTitle describe"><?php echo $compdis2 ?></p>
          </div>
          <span class="cardIcon2">➜</span>
       </div>
           <img src="./assets/photos/sectionThree/amg.jpg" alt="">
           <video src="./assets/videos/homePage/videos for section 3/amg.mp4" autoplay muted loop></video>
         

        </div>
        </div>
        <div class="servicesGrid2rows">
        <div class="serviceCard3 homePagethreeSectionCard fade-in" data-id=<?php echo $comp3 ?> data-name=<?php echo $compName3 ?> onClick="return checkLogin(event)">
          <div class="cardOverlay2">
          <h3 class="cardTitle2"><?php echo $compName3 ?></h3>
           <div class="cardOverlay gas">
            <p class="type"><?php echo $compName3 ?></p>
            <p class="cardTitle describe"><?php echo $compdis3 ?></p>
          </div>
          <span class="cardIcon2">➜</span>
       </div>
          <img src="./assets/photos/sectionThree/bmw.jpg" alt="" >
           <video src="./assets/videos/homePage/videos for section 3/bmw.mp4" autoplay muted loop></video>
        </div>
        <div class="serviceCard3 homePagethreeSectionCard fade-in" data-id=<?php echo $comp4 ?> data-name=<?php echo $compName4 ?> onClick="return checkLogin(event)">
          <div class="cardOverlay2">
          <h3 class="cardTitle2"><?php echo $compName4 ?></h3>
           <div class="cardOverlay gas">
            <p class="type"><?php echo $compName4 ?></p>
            <p class="cardTitle describe"><?php echo $compdis4 ?></p>
          </div>
          <span class="cardIcon2">➜</span>
       </div>
          <img src="./assets/photos/sectionThree/r34.jpg" alt="">
           <video src="./assets/videos/homePage/videos for section 3/r34.mp4" autoplay muted loop></video>
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
        <a href="./pages/products.php" onclick="return checkLogin(event)"> <button>Find your Car</button></a>
       
      </div>
    </div>
  </div>
</section>


<!-- homePageDiscover -->
<section class="homePageTwoSection " id="discoverSection">
  <div class="homePageTwoSectionText">
    <h2>Discover</h2>
    <div class="servicesGrid">
        <a  onClick="return checkLogin(event)" href="../pages/filter.php"  class="newcars" > 
      <div class="serviceCard homePageTwoSectionCard fade-in cardDiscover">
        <div class="cardOverlay">
          <h3 class="cardTitle">New Cars - Filter Options</h3>
          <span class="cardIcon">➜</span>
        </div>
        <img src="./assets/photos/discover/img1.jpg?v=<?= filemtime(__DIR__ . '/assets/photos/discover/img1.jpg') ?>" alt="">
      </div>
      </a>
  <a onClick="return checkLogin(event)" href="../pages/filter.php"  class="usedcars"> 
      <div class="serviceCard homePageTwoSectionCard fade-in cardDiscover">
        <div class="cardOverlay">
          <h3 class="cardTitle">Used Cars - Filter Options</h3>
          <span class="cardIcon">➜</span>
        </div>
        <img src="./assets/photos/discover/img2.jpg?v=<?= filemtime(__DIR__ . '/assets/photos/discover/img2.jpg') ?>" alt="">
      </div>
      </a>
       <a onClick="return checkLogin(event)" href="../pages/filter.php"  class="preownedcars"> 
      <div class="serviceCard homePageTwoSectionCard fade-in cardDiscover">
        <div class="cardOverlay">
          <h3 class="cardTitle">Pre-Owned Cars - Options</h3>
          <span class="cardIcon">➜</span>
        </div>
        <img src="./assets/photos/discover/img3.jpg?v=<?= filemtime(__DIR__ . '/assets/photos/discover/img3.jpg') ?>" alt="">
      </div>
      </a>
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
      if (event) {event.preventDefault();
           event.preventDefault();
    event.stopPropagation();
    event.stopImmediatePropagation(); 
      }
      toastr.error('Please log in to access this page.', 'You are not logged in!');
      return false;
    }
  }

  function profileOrLogin(event){
    const isLoggedIn = localStorage.getItem('isLoggedIn');
    if (isLoggedIn === 'true') {
      window.location.href = './pages/profile.php';
    } else {
      if (event)
         event.preventDefault();
      window.location.href = './pages/login.php';
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