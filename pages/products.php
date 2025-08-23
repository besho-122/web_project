<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Motor Yard - Product</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Audiowide&family=Bangers&family=Berkshire+Swash&family=Lobster&family=Molle&family=Orbitron:wght@400..900&family=Pacifico&family=Playwrite+DK+Uloopet:wght@100..400&family=Righteous&family=Ruslan+Display&family=Unbounded:wght@200..900&family=Warnes&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="https://js.stripe.com/v3"></script>
<style>
iframe.goog-te-banner-frame,
.VIpgJd-ZVi9od-ORHb-OEVmcd {
  top: auto !important;
  bottom: 0 !important;
  left: 0 !important;
  right: 0 !important;
  width: 100% !important;
  position: fixed !important;
  z-index: -100!important;
  display: none !important;
}
body {
  top: 0 !important; 
  z-index: 100 !important;
}
</style>
  <link href="../assets/css/product.css" rel="stylesheet">

</head>
<body>
   <?php require("../api/config.php"); ?>
<nav class="navbar navbar-expand-lg bg-body-tertiary navProduct">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><img src="../assets/photos/title.png" id="mainTitle" alt="" width="100px"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link " aria-current="page" href="../index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../pages/configure.php">Configure</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="#">Models</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="../pages/filter.php" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Products
          </a>
          <ul class="dropdown-menu">
  <?php
    $sql = "SELECT id, Name, imagepng FROM Company";
    $result = $dp->query($sql);
    if ($result && $result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $logo = !empty($row['imagepng'])
          ? htmlspecialchars($row['imagepng'], ENT_QUOTES)
          : "../assets/photos/companies/default.png"; 
        $name = htmlspecialchars($row["Name"], ENT_QUOTES);
        $id   = (int)$row["id"];

        echo '
          <li>
            <a class="dropdown-item nav-item-dropdown d-flex align-items-center gap-2"
               data-id="'.$id.'" href="#" title="'.$name.'">
              <img class="company-icon" src="'.$logo.'" alt="'.$name.' logo"
                   loading="lazy" decoding="async">
              <span class="company-name">'.$name.'</span>
            </a>
          </li>';
      }
    }
  ?>
</ul>
        </li>
       
      
      
      <form class="d-flex " role="search">
        <div class="searchDiv ">
        <input class="form-control me-2" type="search" id="searchInput" placeholder="Search" aria-label="Search"/>
        <i class="fa-solid fa-magnifying-glass fa-xl searchIcon" style="color: #000000;" type="submit" ></i>
        </div>
      </form>
      <a href="../pages/profile.php?tab=cart"><li class="nav-item"><i class="fa-solid fa-cart-shopping fa-xl" style="color: #ffffff;"></i><span id="cartCount"></span></li></a>
      
      <!-- Dropdown -->
<li class="nav-item dropdown" id="langDropdown">
  <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" id="langToggle">En</a>
  <ul class="dropdown-menu">
    <li><a class="dropdown-item" href="#" data-lang="en">English</a></li>
    <li><a class="dropdown-item" href="#" data-lang="ar">Arabic</a></li>
    <li><a class="dropdown-item" href="#" data-lang="es">Spanish</a></li>
    <li><a class="dropdown-item" href="#" data-lang="fr">French</a></li>
    <li><a class="dropdown-item" href="#" data-lang="it">Italian</a></li>
    <li><a class="dropdown-item" href="#" data-lang="de">German</a></li>
    <li><a class="dropdown-item" href="#" data-lang="tr">Turkish</a></li>
    
  </ul>
</li>





        </li>
        
         </ul>
         
          <a href="../pages/profile.php" > <i class="fa-solid fa-user fa-lg" id="logTitle" style="color: #ffffff;"></i></a>
      
    </div>
  </div>
</nav>



<!--ProductFirstSection-->
<div class="firstProduct">
<h3>Find your new or used <span>Car</span> at a Motor Center.</h3>
<p>Choose a model series.</p><br>
<div class="productCards">
<?php 
$sql = "SELECT * FROM `Company`";
$result = $dp->query($sql);
$modelseries = $result->fetch_all(MYSQLI_ASSOC);

foreach ($modelseries as $modelserie) {
    $imgSrc = !empty($modelserie['image']) 
              ? htmlspecialchars($modelserie['image'], ENT_QUOTES)  : "../assets/photos/bmwModel.webp"; 
    echo '<a href="filter.php"><div class="card" data-id="' . $modelserie['id'] . '" style="width:500px">
            <img class="cardImg" src="' . $imgSrc . '" alt="Card image">
            <div class="card-img-overlay">
              <h1 class="card-title">' . htmlspecialchars($modelserie['Name'], ENT_QUOTES) . '</h1>
              <p class="card-text">' . htmlspecialchars($modelserie['Description'], ENT_QUOTES) . '</p>
            </div>
          </div></a>';
}
?>

</div>
<a href="filter.php"><button class="btnProduct" >Browse all model series</button> </a>
<h4>Making it even easier to <span>find</span> your new or pre-owned Car.</h4>


</div>
<!--Second Section-->
<section class="homePageFourSection" id="thirdSection">
  <div class="homePageTwoSectionText">
    <div class="car-container fade-in">
      <div class="car-image">
        <img src="../assets/photos/new.jpg" alt="Car">
      </div>
      <div class="car-content">
        <h1>New vehicle inventory.</h1>
        <p>
          New and available. Find your new Porsche vehicle at a Porsche Center near you. Choose from a large selection of available new vehicles.
        </p>
        <a href="./filter.php"  class="newcars"> <button>Browse new vehicle inventory</button></a>
       
      </div>
    </div>
  </div><br>
   <div class="homePageTwoSectionText">
    <div class="car-container">
      <div class="car-image">
        <img src="../assets/photos/pre.jpg" alt="Car">
      </div>
      <div class="car-content">
        <h1>Porsche Approved Pre-owned vehicles.</h1>
        <p>
         Peace of mind comes as standard. Porsche Approved used vehicles come with a minimum 12 month warranty and have been prepared by Porsche Technicians using only Porsche Genuine Parts.
        </p>
        <a href="./filter.php" class="preownedcars"> <button>Browse Porsche Approved inventory</button></a>
       
      </div>
    </div>
  </div><br>
  <div class="homePageTwoSectionText">
    <div class="car-container">
      <div class="car-image">
        <img src="../assets/photos/used.jpg" alt="Car">
      </div>
      <div class="car-content">
        <h1>Used Vehicles.</h1>
        <p>
          Driving pleasure doesn't know an age. Find a pre-owned Porsche at one of our official Porsche Centres.
        </p>
        <a href="./filter.php" class="usedcars"> <button>Browse used Porsche inventory</button></a>
       
      </div>
    </div>
  </div>
</section>

 <div class="swiper swiper1">
  <div class ="swiperTitle"><h1>Popular <span>Models</span></h1></div>
  <div class="swiper-wrapper">

  <?php
  $sql = "SELECT * FROM `Product`";
  $result = $dp->query($sql);
  $products = $result->fetch_all(MYSQLI_ASSOC);

  foreach ($products as $product) {
      $imgSrc = $product['img5']; 
      $model = $product['Model'];
      $name=$product['Name'];

      echo '
    <div class="swiper-slide">
      <article class="model-card" >
      

        <div class="img-wrap" >
          <img src="' . $imgSrc . '" alt="Model A">
        </div>

        <h3 class="car-title"> ' . $name . '</h3>
        <p class="car-sub" >
          Fuel consumption combined: 9.7–8.9 l/100 km · CO₂ (WLTP): 201–220 g/km
        </p>

        <ul class="specs">
          <li><strong>5.1 s</strong><span>0–100 km/h</span></li>
          <li><strong>220 kW / 300 PS</strong><span>Power</span></li>
          <li><strong>275 km/h</strong><span>Top speed</span></li>
        </ul>

        <div class="card-actions" >
          <button class="btn btn-fill" onclick="window.location.href=\'../pages/model.php?id=' . $product['id'] . '\' ">Show Details</button>
        </div>

 
      </article>
    </div>
  ';
  }
  ?>

  </div>

 
  <div class="swiper-pagination"></div>
</div>

<section>
  <!--Footer-->
<footer class="footer">
  <h4>Overall, how satisfied are you with the <span>information</span> available on this page?</h4>
  <button class="btnProduct" onclick="showFeedback()">Give Feedback now</button>

  <div class="feedback-container" id="feedback">
    <div class="rating-scale">
      <span class="rating-label">Very dissatisfied</span>

      <div class="rating-option">
        <input type="radio" name="rating" id="rate1" value="1">
        <label for="rate1">1</label>
      </div>
      <div class="rating-option">
        <input type="radio" name="rating" id="rate2" value="2">
        <label for="rate2">2</label>
      </div>
      <div class="rating-option">
        <input type="radio" name="rating" id="rate3" value="3">
        <label for="rate3">3</label>
      </div>
      <div class="rating-option">
        <input type="radio" name="rating" id="rate4" value="4">
        <label for="rate4">4</label>
      </div>
      <div class="rating-option">
        <input type="radio" name="rating" id="rate5" value="5">
        <label for="rate5">5</label>
      </div>
      <span class="rating-label">Very satisfied</span>
    </div>
  </div>
  </div>
  <div class="underFooter">
     <p>© 2025 Porsche Sales & Marketplace GmbH General Privacy Policy. Imprint. Open Source Software Notice. Business & Human Rights. The illustrated vehicle images may contain automatically computer generated image material. The representation may differ in part from the actual appearance and/or the product substance of the vehicle.</p>
     <a href="../index.php"><img src="../assets/photos/title.png" id="mainTitle" alt="" width="200px"></a>
  </div>
</footer>
</section>
 <script>
 window.addEventListener('load', function() {
  const savedColor = localStorage.getItem('mainColor');
  if (savedColor) {
    document.documentElement.style.setProperty('--main-color', savedColor);
    colorPicker.value = savedColor; 
  }});
    const dark = localStorage.getItem('darkMode');
    if (dark === 'true') {
    document.documentElement.style.setProperty('--white-color', '#1e1e1e');
    document.documentElement.style.setProperty('--text-color', '#ffffffff');
    document.documentElement.style.setProperty('--gradient-color', 'linear-gradient( #222222ff,#000000,#000000)');
    document.documentElement.style.setProperty('--back-color', '#ffffffff');

    }
    else {
    }


 


  </script>
<script>
document.addEventListener('DOMContentLoaded', function () {
  new Swiper('.swiper1', {
    speed: 700,
    parallax: true,
    grabCursor: true,
    centeredSlides: true,
    slidesPerView: 'auto',
    spaceBetween: 20,
    loop: true,
    autoplay: { delay: 2400, disableOnInteraction: false },
    pagination: { el: '.swiper1 .swiper-pagination', clickable: true, dynamicBullets: true },
    navigation: { nextEl: '.swiper1 .swiper-button-next', prevEl: '.swiper1 .swiper-button-prev' }
  });
});
</script>





<!-- //translarer -->




<div id="google_translate_element" style="display:none;"></div>
<script>
  function googleTranslateElementInit() {
    new google.translate.TranslateElement({ pageLanguage: 'en' }, 'google_translate_element');
  }
</script>
<script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

<script>
document.addEventListener('DOMContentLoaded', () => {
  const langRoot   = document.getElementById('langDropdown');
  const langToggle = document.getElementById('langToggle');

  function getCookie(name) {
    const m = document.cookie.match(new RegExp('(?:^|; )' + name + '=([^;]*)'));
    return m ? decodeURIComponent(m[1]) : '';
  }

  function setTranslateCookie(lang) {
    const base = 'en';
    const val = `/${base}/${lang}`;
    const expires = new Date(Date.now() + 365*24*60*60*1000).toUTCString();
    document.cookie = `googtrans=${val}; expires=${expires}; path=/`;
    document.cookie = `googtrans=${val}; expires=${expires}; path=/; domain=${location.hostname}`;
    location.reload();
  }

  function refreshDropdownLabel() {
    const labels = {
      en: "English",
      ar: "Arabic",
      es: "Spanish",
      fr: "French",
      it: "Italian",
      de: "German",
      tr: "Turkish"
    };
    const current = getCookie('googtrans') || '/en/en';
    const parts = current.split('/');
    const code = (parts[2] || 'en').toLowerCase();
    if (langToggle) langToggle.textContent = labels[code] || code.toUpperCase();
  }

  if (langRoot) {
    langRoot.querySelectorAll('.dropdown-item[data-lang]').forEach(item => {
      item.addEventListener('click', (e) => {
        e.preventDefault();
        setTranslateCookie(item.getAttribute('data-lang'));
      });
    });
  }

  refreshDropdownLabel();
});
</script>


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/izitoast/dist/css/iziToast.min.css">
<script src="https://cdn.jsdelivr.net/npm/izitoast/dist/js/iziToast.min.js"></script>

<script>
document.querySelectorAll('input[name="rating"]').forEach((inp) => {
  inp.addEventListener('change', async (e) => {
    const rating = parseInt(e.target.value, 10);

    try {
      const res = await fetch('../api/rate.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ rating })
      });
      const data = await res.json();

      if (data.success) {
        iziToast.success({
          title: 'success',
          message: data.message || 'your rating has been saved.',
          position: 'topRight'
        });
      } else {
        iziToast.error({
          title: 'error',
          message: data.message || 'your rating has not been saved.',
          position: 'topRight'
        });
      }
    } catch (err) {
      iziToast.error({
        title: 'server error',
        message: 'something went wrong.',
        position: 'topRight'
      });
    }
  });
});
</script>




















<script src="../assets/js/product.js"></script>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>
</html>