<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Motor Yard - Model</title>
     <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Audiowide&family=Bangers&family=Berkshire+Swash&family=Lobster&family=Molle&family=Orbitron:wght@400..900&family=Pacifico&family=Playwrite+DK+Uloopet:wght@100..400&family=Righteous&family=Ruslan+Display&family=Unbounded:wght@200..900&family=Warnes&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playwrite+HU:wght@100..400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pannellum/build/pannellum.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <link href="../assets/css/configure.css" rel="stylesheet">
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
          <a class="nav-link active" href="#">Configure</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="../pages/products.php">Models</a>
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
        <input class="form-control me-2 " type="search" placeholder="Search" aria-label="Search"/>
        <i class="fa-solid fa-magnifying-glass fa-xl searchIcon" style="color: #000000;" type="submit" ></i>
        </div>
      </form>
     <a href="../pages/profile.php?tab=cart"><li class="nav-item"> <i class="fa-solid fa-cart-shopping fa-xl" style="color: #ffffff;"></i><span id="cartCount"></span></li></a>
      
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
         </ul>
         
          <a href="../pages/profile.php" > <i class="fa-solid fa-user fa-lg" id="logTitle" style="color: #ffffff;"></i></a>
      
    </div>
  </div>
</nav>




 <section class="exteriorSection">
    <h1 style="color:rgb(0, 0, 0); text-align:center; margin-bottom: 50px;">Configure Your Model</h1>
  <div class="sketchfab-embed-wrapper exterior" >
  
<iframe id="api-frame"
  src="https://sketchfab.com/models/d01b254483794de3819786d93e0e1ebf/embed?autostart=1&preload=1&transparent=1&ui_theme=light&ui_animations=0&ui_infos=0&ui_stop=0&ui_inspector=0&ui_watermark_link=0&ui_watermark=0&ui_hint=0&ui_ar=0&ui_help=0&ui_settings=0&ui_vr=0&ui_annotations=0&dnt=1"
  allow="autoplay; fullscreen; xr-spatial-tracking"
  style="width:100%;background:transparent">
</iframe>
  <div class="controls" style="background-color:black;">
  <div class="title" style="color:white; margin-bottom: 10px; margin-top: 10px; text-align: center; width: 100%;" >Exterior Color</div>
  <div class="color-btn" style="background:black;display:inline-block;cursor:pointer;" onclick="changeColor([0,0,0])"></div>
  <div class="color-btn" style="background:white;display:inline-block;cursor:pointer;border:1px solid #ccc;" onclick="changeColor([1,1,1])"></div>
  <div class="color-btn" style="background:silver;display:inline-block;cursor:pointer;" onclick="changeColor([0.75,0.75,0.75])"></div>
  <div class="color-btn" style="background:#e0cfc4;display:inline-block;cursor:pointer;" onclick="changeColor([0.88,0.81,0.77])" title="Crayon"></div>
  <div class="color-btn" style="background:grey;display:inline-block;cursor:pointer;" onclick="changeColor([0.5,0.5,0.5])"></div>
  <div class="color-btn" style="background:blue;display:inline-block;cursor:pointer;" onclick="changeColor([0,0,1])"></div>
  <div class="color-btn" style="background:red;display:inline-block;cursor:pointer;" onclick="changeColor([1,0,0])"></div>
  <div class="color-btn" style="background:yellow;display:inline-block;cursor:pointer;" onclick="changeColor([1,1,0])"></div>
  <div class="color-btn" style="background:brown;display:inline-block;cursor:pointer;" onclick="changeColor([0.6,0.3,0.2])"></div>
  <div class="color-btn" style="background:green;display:inline-block;cursor:pointer;" onclick="changeColor([0,1,0])"></div>
  <div class="color-btn" style="background:violet;display:inline-block;cursor:pointer;" onclick="changeColor([0.93,0.51,0.93])"></div>
  <div class="color-btn" style="background:gold;display:inline-block;cursor:pointer;" onclick="changeColor([1,0.84,0])"></div>
  <div class="color-btn" style="background:orange;display:inline-block;cursor:pointer;" onclick="changeColor([1,0.5,0])"></div>
  <div class="color-btn" style="background:pink;display:inline-block;cursor:pointer;" onclick="changeColor([1,0.75,0.8])"></div>
  <div class="color-btn" style="background:beige;display:inline-block;cursor:pointer;" onclick="changeColor([0.96,0.96,0.86])"></div>
</div>
  </div>


</section>











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
<script src="https://static.sketchfab.com/api/sketchfab-viewer-1.12.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/pannellum/build/pannellum.js"></script>
    <script src="../assets/js/configure.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
    <!-- //translarer -->





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
// main color
 window.addEventListener('load', function() {
  const savedColor = localStorage.getItem('mainColor');
  if (savedColor) {
    document.documentElement.style.setProperty('--main-color', savedColor);
    colorPicker.value = savedColor; 
  }});

</script>

 <script>
   window.addEventListener('load', function() {
  const savedColor = localStorage.getItem('mainColor');
  if (savedColor) {
    document.documentElement.style.setProperty('--main-color', savedColor);
    colorPicker.value = savedColor; 
  }});
    const dark = localStorage.getItem('darkMode');
   if (dark === 'true') {
  // Apply dark background + white text to multiple elements
  document.querySelectorAll('.sidebar, .sort-bar, .sort-bar-two, .car-card, .car-card p, .pagination, .page-link')
    .forEach(el => {
      el.style.setProperty('background-color', '#202020ff', 'important');
      el.style.setProperty('color', '#ffffff', 'important');
    });

  // h1 → only color (no background)
  document.querySelectorAll('h1').forEach(h1 => {
    h1.style.setProperty('color', '#ffffff', 'important');
  });

  // Update CSS variables
  document.documentElement.style.setProperty('--black-color', '#ffffffff');
  document.documentElement.style.setProperty('--gradient-color', 'linear-gradient(#111111ff, #111111ff, #111111ff)');
}

    else {
    }
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


    
</body>
</html>