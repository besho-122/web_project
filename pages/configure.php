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
            $sql = "SELECT * FROM Company";
            $result = $dp->query($sql);
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                  echo '<li ><a class="dropdown-item nav-item-dropdown" data-id="' . $row["id"] . '" href="#">' . $row["Name"] . '</a></li>';
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
      <li class="nav-item"> <i class="fa-solid fa-cart-shopping fa-xl" style="color: #ffffff;"></i></li>
      
       <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            En
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
        
         </ul>
         
          <a href="../pages/profile.php" > <i class="fa-solid fa-user fa-lg" id="logTitle" style="color: #ffffff;"></i></a>
      
    </div>
  </div>
</nav>




 <section class="exteriorSection">
  <div class="sketchfab-embed-wrapper exterior" >
    <h1 style="color:rgb(0, 0, 0); text-align:center;">Configure Your Model</h1>
<iframe id="api-frame"
  src="https://sketchfab.com/models/d01b254483794de3819786d93e0e1ebf/embed?autostart=1&preload=1&transparent=1&ui_theme=light&ui_animations=0&ui_infos=0&ui_stop=0&ui_inspector=0&ui_watermark_link=0&ui_watermark=0&ui_hint=0&ui_ar=0&ui_help=0&ui_settings=0&ui_vr=0&ui_annotations=0&dnt=1"
  allow="autoplay; fullscreen; xr-spatial-tracking"
  style="width:100%;border-radius:10px;background:transparent">
</iframe>
  </div>
</section>


<div class="controls" style="background-color:black; margin-bottom: 70px;">
  <div class="color-btn" style="width:40px;height:40px;background:black;display:inline-block;cursor:pointer;" onclick="changeColor([0,0,0])"></div>
  <div class="color-btn" style="width:40px;height:40px;background:white;display:inline-block;cursor:pointer;border:1px solid #ccc;" onclick="changeColor([1,1,1])"></div>
  <div class="color-btn" style="width:40px;height:40px;background:silver;display:inline-block;cursor:pointer;" onclick="changeColor([0.75,0.75,0.75])"></div>
  <div class="color-btn" style="width:40px;height:40px;background:#e0cfc4;display:inline-block;cursor:pointer;" onclick="changeColor([0.88,0.81,0.77])" title="Crayon"></div>
  <div class="color-btn" style="width:40px;height:40px;background:grey;display:inline-block;cursor:pointer;" onclick="changeColor([0.5,0.5,0.5])"></div>
  <div class="color-btn" style="width:40px;height:40px;background:blue;display:inline-block;cursor:pointer;" onclick="changeColor([0,0,1])"></div>
  <div class="color-btn" style="width:40px;height:40px;background:red;display:inline-block;cursor:pointer;" onclick="changeColor([1,0,0])"></div>
  <div class="color-btn" style="width:40px;height:40px;background:yellow;display:inline-block;cursor:pointer;" onclick="changeColor([1,1,0])"></div>
  <div class="color-btn" style="width:40px;height:40px;background:brown;display:inline-block;cursor:pointer;" onclick="changeColor([0.6,0.3,0.2])"></div>
  <div class="color-btn" style="width:40px;height:40px;background:green;display:inline-block;cursor:pointer;" onclick="changeColor([0,1,0])"></div>
  <div class="color-btn" style="width:40px;height:40px;background:violet;display:inline-block;cursor:pointer;" onclick="changeColor([0.93,0.51,0.93])"></div>
  <div class="color-btn" style="width:40px;height:40px;background:gold;display:inline-block;cursor:pointer;" onclick="changeColor([1,0.84,0])"></div>
  <div class="color-btn" style="width:40px;height:40px;background:orange;display:inline-block;cursor:pointer;" onclick="changeColor([1,0.5,0])"></div>
  <div class="color-btn" style="width:40px;height:40px;background:pink;display:inline-block;cursor:pointer;" onclick="changeColor([1,0.75,0.8])"></div>
  <div class="color-btn" style="width:40px;height:40px;background:beige;display:inline-block;cursor:pointer;" onclick="changeColor([0.96,0.96,0.86])"></div>
</div>









<section>
  <!--Footer-->
<footer class="footer">
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
    
</body>
</html>