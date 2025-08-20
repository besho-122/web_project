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
  <link href="../assets/css/model.css" rel="stylesheet">
</head>
<body>
    <?php require("../api/config.php"); 
    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
  http_response_code(400);
  exit('Invalid car id');
}

$sql = "SELECT * FROM Product WHERE id = ?";
$stmt = $dp->prepare($sql);
if (!$stmt) {
  http_response_code(500);
  exit('DB prepare failed: ' . $dp->error);
}

$stmt->bind_param("i", $id);
$stmt->execute();

$res = $stmt->get_result();
$car = $res->fetch_assoc();

if (!$car) {
  http_response_code(404);
  exit('Car not found');
}
$companyID = $car['CompanyId'];
$sql = "SELECT * FROM Company WHERE id = ?";
$stmt = $dp->prepare($sql);
if (!$stmt) {
  http_response_code(500);
  exit('DB prepare failed: ' . $dp->error);
}
$stmt->bind_param("i", $companyID);
$stmt->execute();
$res = $stmt->get_result();
$company = $res->fetch_assoc();
$companyName = $company['Name'];
$name=$car['Name'];
$model=$car['Model'];
$Img1 = $car['img1'];
$Img2 = $car['img2'];
$Img3 = $car['img3'];
$Img4 = $car['img4'];
$Img5 = $car['img5'];
$speed = $car['speed'];
    ?>
     <nav class=" fixed-top homePageNavbar">
    <div class="container-fluid px-5 behind">
        <button class="navbar-toggler"  type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar"
        aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
       <a href="../pages/profile.php" > <i class="fa-solid fa-user fa-lg" id="logTitle" style="color: #ffffff;"></i></a>
      </button>
      <a class="brand" href="#">
        <img src="..//assets/photos/title.png" id="mainTitle" alt="" width="100px">
      </a>



   

    </div>
  </nav>
      <!-- main section -->
  <section class="homePageMainSection ">
    <video id="bgVideo" src="../assets/videos/modelPage/Buggati.mp4" autoplay muted loop ></video>
    <div class="homePageMainSectionText ">
      <button id="videoToggle" class="video-btn"><i class="fas fa-pause"></i></button>
      <h2 class="fade-in-home-text"><?= $companyName ?></h2>
    </div>
  </section>
<img src="<?= $Img5 ?>"
     alt="" 
     class="modelImage" 
     width="1000px">

<style>
@media (min-width: 1600px) {
  .modelImage {
    position: absolute;
    top: 305px !important;
    left: 290px;
    width: 1150px;
  }
  .homePageMainSectionText h2 {
    font-size: 7vw;
    margin-left: 290px;
    top: 160px;

}
}
@media (min-width: 1700px) {
  .modelImage {
    position: absolute;
    top: 335px !important;
    left: 350px;
    width: 1200px;
  }
  .homePageMainSectionText h2 {
    font-size: 7vw;
    margin-left: 340px;
    top: 170px;

}
}
</style>


  <section>
    <div class="typeCar">
        <p>Sport Saloon</p>
        <p>Cross Torismo</p>
        <p>Sport Torismo</p>
    </div>
    <h2 class="titleCar"> <?= $name ?></h2>
    <div class="Buttons">
        <a href="../pages/products.php" style="text-decoration: none;color: white;">
            <button class="btnProduct firstButton">
                Change model
            </button>
        </a>
        
        <a href="../pages/configure.php"><button class="btnProduct editButton secondButton">Configure</button></a>
        <a href="../pages/filter.php">
            <button class="btnProduct editButton">Find new or used</button>
        </a>
        
    </div>

    <div class="technical">
       <div class="number-container">
  <h2>
    <span id="acceleration" class="rolling-number" data-decimals="1"></span><sub>s</sub>
  </h2>
  <p>Acceleration 0 - 100 km/h with Launch Control</p>

  <h2>
    <span id="powerKW" class="rolling-number" data-decimals="0"></span><sub>kW / </sub>
    <span id="powerPS" class="rolling-number" data-decimals="0"></span><sub>PS</sub>
  </h2>
  <p>Power up to (kW)/Power up to (PS)
     Details of the measuring method can be found at www.porsche.com/gtr21</p>

  <h2>
    <span id="speed" class="rolling-number" data-decimals="0"></span><sub>km/h</sub>
  </h2>
  <p class="decMarginButton">Max speed</p>

  <button class="btnProduct editButton2">Add to cart </button>
</div>


        <div>
            <img src="<?= $Img4 ?>" alt="">
        </div>
        
        
    </div>
  </section>
  <section class="threePictureSection">
    <h1>Learn more about the <?= $model ?></h1>
    <h1 class="nameModel"><?= $model ?></h1>
    <div class="threePicture">
      <div class="firstPicture" >
        <img class="firstPicture" src="<?= $Img1 ?>" alt="">
      </div>
      <div class="secondPicture"> 
         <div class="secondPictureText">
          <h1>Porsche Approved Pre-Owned</h1>
          <p>Jet Black Metallic · Black
            Electric · 12,356 km · 01/2024 · 1 previous owner
            No accidents · 300 kW / 408 hp · Rear-wheel-drive
            Range combined (WLTP): 442 km
          </p>
        </div>
        <img  src="<?= $Img2 ?>" alt="">
      
      </div>
      <div class="thirdPicture">
        <img  src="<?= $Img3 ?>" alt="">
      </div>
    </div>
  </section>


<section class="carsound2">
  <div class="carsound"> 
    <div class="carsound__bg"></div>
    <div class="carsound__overlay"></div>

    <div class="carsound__content">
      <div>
        <h1 class="carsound__title">It doesn't just sound good. It also feels good.</h1>
        <p class="carsound__subtitle">Experience the unique mid-engine sound.</p>
      </div>
      <button id="holdBtn" class="soundbtn" aria-label="Hold for sound">
        <span class="icon-play" aria-hidden="true"></span>
        <span class="icon-pause" aria-hidden="true"></span>
        <span class="soundbtn__text">Hold for sound</span>
        <span class="soundbtn__progress" id="btnProgress"></span>
      </button>
    </div>

  <audio id="audio" preload="metadata">
       <source src="https://assets-v2.porsche.com/int/-/media/Project/PCOM/SharedSite/Models/718/718-Boxster/718-Boxster-Cabriolet/052_Engine-Sound/718-cayman-gts-40-iccr" type="audio/mpeg" />
  </audio>
  </div>
</section>





  <section class="panoramaSection">
    <h1>Panorama</h1>
    <div id="panorama"></div>
  </section>



 <div class="swiper swiper1">
  <div class ="swiperTitle"><h1>Other Models</span></h1></div>
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
          <button class="btn3 btn-fill3" onclick="window.location.href=\'../pages/model.php?id=' . $product['id'] . '\' ">Show Details</button>
        </div>

 
      </article>
    </div>
  ';
  }
  ?>

  </div>

 
  <div class="swiper-pagination"></div>
</div>




























 <section class="exteriorSection">
  <div class="sketchfab-embed-wrapper exterior" >
    <h1 style="color:rgb(0, 0, 0); text-align:center;">Exterior</h1>
    <iframe id="api-frame"
  title="Porsche 911 Carrera 4S"
  allow="autoplay; fullscreen; xr-spatial-tracking"
  src="https://sketchfab.com/models/d01b254483794de3819786d93e0e1ebf/embed?autostart=1&preload=1&transparent=0&ui_theme=light&ui_animations=0&ui_infos=0&ui_stop=0&ui_inspector=0&ui_watermark_link=0&ui_watermark=0&ui_hint=0&ui_ar=0&ui_help=0&ui_settings=0&ui_vr=0&ui_annotations=0&dnt=1"
  style="width:100%;;border-radius: 10px;">
</iframe>
  </div>
</section>





  <section>
  <!--Footer-->
<footer class="footer">
  <h4>Overall, how satisfied are you with the <span>information</span> available on this page?</h4>
  <button class="btnProduct" onclick="showFeedback()">Give Feedback now</button>

  <div class="feedback-container" id="feedback" style="height: 750px;">
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
(function(){
  const audio = document.getElementById('audio');
  const holdBtn = document.getElementById('holdBtn');
  const btnProgress = document.getElementById('btnProgress');

  let raf = null, holding = false;

  function getDuration(){

    const d = audio.duration;
    if (Number.isFinite(d) && d > 0) return d;
  
    try{
      if (audio.seekable && audio.seekable.length) {
        return audio.seekable.end(audio.seekable.length - 1);
      }
    }catch(e){}
    return 0;
  }

  function updateUI(){
    const dur = getDuration();
    const cur = audio.currentTime || 0;
    const p = dur ? (cur / dur) * 100 : 0; 
    btnProgress.style.width = p + '%';
    if (!audio.paused) raf = requestAnimationFrame(updateUI);
  }

  function startHold(){
    holding = true;
    holdBtn.classList.add('is-playing');    
    audio.play().then(() => { updateUI(); }).catch(()=>{ });
  }
  function endHold(){
    if(!holding) return;
    holding = false;
    audio.pause();
    cancelAnimationFrame(raf);
    holdBtn.classList.remove('is-playing'); 
    updateUI(); 
  }
  holdBtn.addEventListener('mousedown', startHold);
  document.addEventListener('mouseup', endHold);
  holdBtn.addEventListener('mouseleave', endHold);
  holdBtn.addEventListener('touchstart', e => { e.preventDefault(); startHold(); }, {passive:false});
  document.addEventListener('touchend', endHold);
  audio.addEventListener('ended', () => { endHold(); audio.currentTime = audio.duration || audio.currentTime; updateUI(); });
})();
</script>

<script>
(() => {
  const section = document.querySelector('.panoramaSection');
  if (!section) return;

  let darkOn = false;

  const addDark = () => {
    if (darkOn) return;
    darkOn = true;
    document.body.classList.add('bg-dark');
    section.classList.add('is-active');
  };

  const removeDark = () => {
    if (!darkOn) return;
    darkOn = false;
    document.body.classList.remove('bg-dark');
    section.classList.remove('is-active');
  };


  const io = new IntersectionObserver(([entry]) => {
    const r = entry.intersectionRatio;
    if (r >= 0.45) addDark();
    else if (r <= 0.4) removeDark();
  }, {
    threshold: [0, 0.4, 0.45, 1]
  });

  io.observe(section);
})();
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

<script>
document.addEventListener('DOMContentLoaded', () => {
  const iframe = document.getElementById('api-frame');
  if (!iframe) return;
  const client = new Sketchfab(iframe);
  const dbColor = <?php echo json_encode($car['Exterior'] ?? ''); ?>;
  const toRGB01 = (name) => {
    const n = String(name||'').trim().toLowerCase();
    if (/^#([0-9a-f]{6})$/i.test(n)) {
      const r = parseInt(n.slice(1,3),16)/255, g = parseInt(n.slice(3,5),16)/255, b = parseInt(n.slice(5,7),16)/255;
      return [r,g,b];
    }
    if (n.includes('black')) return [0,0,0];
    if (n.includes('white')) return [1,1,1];
    if (n.includes('silver')) return [0.75,0.75,0.75];
    if (n.includes('gray') || n.includes('grey')) return [0.5,0.5,0.5];
    if (n.includes('red')) return [1,0,0];
    if (n.includes('blue')) return [0,0,1];
    if (n.includes('green')) return [0,1,0];
    if (n.includes('yellow')) return [1,1,0];
    if (n.includes('orange')) return [1,0.5,0];
    if (n.includes('beige')) return [0.96,0.96,0.86];
    if (n.includes('gold')) return [1,0.84,0];
    if (n.includes('crayon') || n.includes('chalk')) return [224/255,221/255,215/255];
    return [0.2,0.2,0.2]; 
  };
  client.init('d01b254483794de3819786d93e0e1ebf', {
     autostart: 1,
    preload: 1,
    transparent: 1, 
    ui_theme: 'light',
    ui_animations: 0,
    ui_infos: 0,
    ui_stop: 0,
    ui_inspector: 0,
    ui_watermark_link: 0,
    ui_watermark: 0,
    ui_hint: 0,
    ui_ar: 0,
    ui_help: 0,
    ui_settings: 0,
    ui_vr: 0,
    ui_annotations: 0,
    dnt: 1,
    success(api){
      api.start();
      api.addEventListener('viewerready', () => {
        if (api.setBackground) api.setBackground({ transparent: true });
        api.getMaterialList((err, mats) => {
          if (err) return;
          const paint = mats.find(m => /paint|carpaint|body/i.test(m.name || ''));
          if (!paint || !paint.channels || !paint.channels.AlbedoPBR) return;
          paint.channels.AlbedoPBR.color = toRGB01(dbColor);
          api.setMaterial(paint);
        });
      });
    },
    error(){ console.error('Sketchfab init error'); }
  });
});
</script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/izitoast/dist/css/iziToast.min.css">
<script src="https://cdn.jsdelivr.net/npm/izitoast/dist/js/iziToast.min.js"></script>
<script>
  window.toast = window.toast || {
    success: (m) => (window.iziToast ? iziToast.success({title:'Success', message:m, position:'topRight'}) : alert(m)),
    info:    (m) => (window.iziToast ? iziToast.info({title:'Info', message:m, position:'topRight'}) : alert(m)),
    error:   (m) => (window.iziToast ? iziToast.error({title:'Error', message:m, position:'topRight'}) : alert(m)),
  };
</script>


<?php 
$id = $_GET['id'] ?? 0;
$sql = "SELECT * FROM Product WHERE id = ?";
$stmt = $dp->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$car = $result->fetch_assoc();
$name = $car['Name'] ?? '';
$Img5 = $car['img5'] ?? '';
?>

<script>
const PRODUCT = {
  id:     <?= (int)$id ?>,
  name:   <?= json_encode($name ?? '') ?>,
  image:  <?= json_encode($Img5 ?? '') ?>,
  description: (document.querySelector('.secondPictureText p')?.textContent || '').trim()
};

function getCart(){ try { return JSON.parse(localStorage.getItem('cartCars')) || []; } catch { return []; } }
function setCart(c){ localStorage.setItem('cartCars', JSON.stringify(c)); }

function updateCartCount(){
  const count = getCart().length; 
  const el = document.getElementById('cartCount');
  if (!el) return;
  el.textContent = count;
  el.style.display = count > 0 ? 'inline-block' : 'none';
}

(function(){
  const btn = document.querySelector('.btnProduct.editButton2');
  if (!btn) return;

  btn.addEventListener('click', () => {
    if (btn.dataset.lock === '1') return;
    btn.dataset.lock = '1'; setTimeout(()=>btn.dataset.lock='0', 250);

    const id = String(PRODUCT.id || '').trim();
    if (!id){ toast.error('Missing product id'); return; }

    const cart = getCart();
    if (cart.some(it => String(it.id) === id)){
      toast.info(`${PRODUCT.name || 'Item'} is already in your cart`);
      return;
    }
    cart.push({
      id,
      name: PRODUCT.name || 'Item',
      image: PRODUCT.image || '',
      description: PRODUCT.description || ''
    });
    setCart(cart);
    updateCartCount();
    toast.success(`${PRODUCT.name || 'Item'} added to cart`);
  });

  updateCartCount();
})();
</script>










<script src="https://static.sketchfab.com/api/sketchfab-viewer-1.12.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/pannellum/build/pannellum.js"></script>
    <script src="../assets/js/model.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
    
</body>
</html>