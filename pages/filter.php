<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Motor Yard - Filter</title>
     <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Audiowide&family=Bangers&family=Berkshire+Swash&family=Lobster&family=Molle&family=Orbitron:wght@400..900&family=Pacifico&family=Playwrite+DK+Uloopet:wght@100..400&family=Righteous&family=Ruslan+Display&family=Unbounded:wght@200..900&family=Warnes&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <link href="../assets/css/filter.css" rel="stylesheet">
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
          <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="../pages/products.php">Models</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle active" href="../pages/filter.php" role="button" data-bs-toggle="dropdown" aria-expanded="false" >
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



<section class="filterFirst">
    <h1 class="nameModel"></h1>
    <h4>New and used cars for sale.</h4>
   


</section>
 <div class="page-container">
  <aside class="sidebar">
    <ul>
      <li class="condition">
        Condition
        <div class="checkCondition">
            <label class="custom-checkbox ">
                New
         <input type="checkbox"  value="New" id="new">
         <span class="checkmark"></span>
         </label>

           <label class="custom-checkbox" >
                Used
            <input type="checkbox"value="Used" id="used" >
            <span class="checkmark"></span>
          </label>

          <label class="custom-checkbox" >
                Approved Pre Owened
            <input type="checkbox" value="Pre Owened" id="preowned" >
            <span class="checkmark"></span>
          </label>
        </div>
    </li>
      <li class="modelSeries">
        Model Series
        <div class="SeriesSelect">
            <select id="sort" class="selection selectionEdit">
        <option>Recommended</option>
        <option>Newest</option>
        <option>Price (Low to High)</option>
        
      </select>
        </div>
    </li>
      <li class="modelVarients">
        Model
      <div class="varientsChecked">
  <div class="searchGrandDad">
    <i class="fa-solid fa-magnifying-glass fa-lg searchIcon editSearchIcon" style="color: #000000;" type="submit"></i>
    <div class="searchDad">
      <form class="d-flex" role="search" onsubmit="return false;">
        <input id="checkboxSearch" class="form-control" type="search" placeholder="Search" aria-label="Search">
      </form>
    </div>
  </div>
  <?php
  $sql = "SELECT id, Name FROM Company"; 
  $result = $dp->query($sql);

  if ($result && $result->num_rows > 0):
      while($row = $result->fetch_assoc()):
          $companyId = (int)$row['id']; 
          $companyName = htmlspecialchars($row['Name'], ENT_QUOTES);
  ?>
  <label class="custom-checkbox">
    <?php echo $companyName; ?>
    <input type="checkbox" value="<?php echo $companyName; ?> " id="checkbox<?php echo $companyId; ?>">
    <span class="checkmark"></span>
  </label>
  <?php
      endwhile;
  else:
      echo "<p>No companies found</p>";
  endif;

  ?>

</div>
    </li>
      <li class="modelGeneration">
        Model Generations
        <div class="generationChecked">
            <label class="custom-checkbox">
    E3
    <input type="checkbox" value="E3">
    <span class="checkmark"></span>
  </label>

  <label class="custom-checkbox">
    E2
    <input type="checkbox" value="E2">
    <span class="checkmark"></span>
  </label>
  <label class="custom-checkbox">
    E0
    <input type="checkbox" value="E0">
    <span class="checkmark"></span>
  </label>
  <label class="custom-checkbox">
    E1
    <input type="checkbox" value="E1">
    <span class="checkmark"></span>
  </label>
  <label class="custom-checkbox">
    E11
    <input type="checkbox" value="E11">
    <span class="checkmark"></span>
  </label>
  <label class="custom-checkbox">
    E12
    <input type="checkbox" value="E12">
    <span class="checkmark"></span>
  </label>
        </div>
         
    </li>
      <li class="modelYear">
        Model Year
        <div class="yearSelection">
            
        </div>
    </li>
      <li class="exteriorColour">
        Exterior Colour
        <div class="exColor">
           <label class="custom-checkbox">
            <span class="colorFirst colorType">2</span> Black (4)<input type="checkbox" value="Black"><span class="checkmark"></span>
           </label>
           <label class="custom-checkbox">
            <span class="colorSecond colorType">2</span> White (5)<input type="checkbox" value="White"><span class="checkmark"></span>
           </label>
           <label class="custom-checkbox">
            <span class="colorThird colorType">2</span> Silver (8)<input type="checkbox" value="Silver"><span class="checkmark"></span>
           </label>
           <label class="custom-checkbox">
            <span class="colorFourth colorType">2</span> Crayon (2)<input type="checkbox" value="Crayon"><span class="checkmark"></span>
           </label>
           <label class="custom-checkbox">
            <span class="colorFifth colorType">2</span> Grey (22)<input type="checkbox" value="Grey"><span class="checkmark"></span>
           </label>
           <label class="custom-checkbox">
            <span class="colorSixth colorType">2</span> Blue (0)<input type="checkbox" value="Blue"><span class="checkmark"></span>
           </label>
           <label class="custom-checkbox">
            <span class="colorSeventh colorType">2</span> Red (2)<input type="checkbox" value="Red"><span class="checkmark"></span>
           </label>
           <label class="custom-checkbox">
            <span class="colorEight colorType">2</span> Yellow (0)<input type="checkbox" value="Yellow"><span class="checkmark"></span>
           </label>
           <label class="custom-checkbox">
            <span class="colorNine colorType">2</span> Brown (0)<input type="checkbox" value="Brown"><span class="checkmark"></span>
           </label>
           <label class="custom-checkbox">
            <span class="colorTen colorType">2</span> Green (3)<input type="checkbox" value="Green"><span class="checkmark"></span>
           </label>
           <label class="custom-checkbox">
            <span class="colorEleven colorType">2</span> Violet (4)<input type="checkbox" value="Violet"><span class="checkmark"></span>
           </label>
           <label class="custom-checkbox">
            <span class="colorTwelve colorType">2</span> Gold (0)<input type="checkbox" value="Gold"><span class="checkmark"></span>
           </label>
           <label class="custom-checkbox">
            <span class="colorThirteen colorType" >2</span> Orange (1)<input type="checkbox" value="Orange"><span class="checkmark"></span>
           </label>
           <label class="custom-checkbox">
            <span class="colorFourteen colorType">2</span> Pink (3)<input type="checkbox" value="Pink"><span class="checkmark"></span>
           </label>
           <label class="custom-checkbox">
            <span class="colorFifteen colorType">2</span> Beige (0)<input type="checkbox" value="Beige"><span class="checkmark"></span>
           </label>
        </div>
    </li>
      <li class="interiorColour">
        Interior Colour
        <div class="intColour">
             <label class="custom-checkbox">
            <span class="colorFirst colorType">2</span> Black (4)<input type="checkbox" value="Black"><span class="checkmark"></span>
           </label>
           <label class="custom-checkbox">
            <span class="colorSecond colorType">2</span> Beige (5)<input type="checkbox" value="Beige"><span class="checkmark"></span>
           </label>
           <label class="custom-checkbox">
            <span class="colorThird colorType">2</span> Brown (8)<input type="checkbox" value="Brown"><span class="checkmark"></span>
           </label>
           <label class="custom-checkbox">
            <span class="colorFourth colorType">2</span> Grey (2)<input type="checkbox" value="Grey"><span class="checkmark"></span>
           </label>
           <label class="custom-checkbox">
            <span class="colorFifth colorType">2</span> Blue (22)<input type="checkbox" value="Blue"><span class="checkmark"></span>
           </label>
           <label class="custom-checkbox">
            <span class="colorSixth colorType">2</span> Red (0)<input type="checkbox" value="Red"><span class="checkmark"></span>
           </label>
           <label class="custom-checkbox">
            <span class="colorSeventh colorType">2</span> Purple (2)<input type="checkbox" value="Purple"><span class="checkmark"></span>
           </label>
           <label class="custom-checkbox">
            <span class="colorEight colorType">2</span> Green (0)<input type="checkbox" value="Green"><span class="checkmark"></span>
           </label>
           <label class="custom-checkbox">
            <span class="colorNine colorType">2</span> White (0)<input type="checkbox" value="White"><span class="checkmark"></span>
           </label>
        </div>
    </li>
      <li class="price">
        Price
        <div class="priceField">
            <p>Max. Price</p>
            <div class="arrowPrice">
            <input list="sortList" id="sortInput" class="selection selectionEdit inputSelection" placeholder="Any">
            <div class="sideArrow"><img src="../assets/photos/arrow.webp" alt=""  width="20px"></div>
            </div>

        </div>
    </li>
      <li class="mileAge">
        Mile Age
        <div class="mileField">
            <p>Max. Mileage</p>
            <div class="SeriesSelect2 sort-bar">
           <select id="sort" class="selection milesSelect">
        <option>Any</option>
        <option>5,000 km</option>
        <option>10,000 km</option>
         <option>20,000 km</option>
          <option>30,000 km</option>
           <option>40,000 km</option>
            <option>50,000 km</option>
      </select>
       <img src="../assets/photos/arrow.webp" alt="" class="arrow" width="20px">
        </div>

        </div>
    </li>
      <li class="previousOwner">
        Previous Owner
         <div class="ownerField">
            <p>Max. Owners</p>
            <div class="SeriesSelect2 sort-bar">
           <select id="sort" class="selection milesSelect">
        <option>Any</option>
        <option>Max. 1</option>
        <option>Max. 2</option>
         <option>Max. 3</option>
          <option>Max. 4</option>
           <option>Max. 5</option>
            <option>Max. 6</option>
      </select>
       <img src="../assets/photos/arrow.webp" alt="" class="arrow" width="20px">
        </div>

        </div>
    </li>
      <li class="location">
        Location
        <div class="priceField">
            <p>City or ZIP Code</p>
            <div class="arrowPrice">
            <input list="sortList" id="sortInput" class="selection selectionEdit inputSelection" placeholder="Any">
            <div class="sideArrow2"><i class="fa-solid fa-magnifying-glass fa-xl searchIcon" style="color: #000000;" type="submit" ></i></div>
            </div>
        </div>
    </li>
    </ul>

    <button class="resetButton">
        <span><i class="fa-regular fa-trash-can fa-lg" style="color: #000000;"></i></span>
        Resest all filters
    </button>
  </aside>

  <section class="content-area">
    <div class="sort-bar-two ">
         <div class="sortingBy">
            <div class="sortingOne">
                <div class="divCondition">
                <p>Condition</p>
                <h5>New</h5>
                </div>
               <i class="fa-solid fa-xmark " style="color: #000000; font-size: 17px; "></i>
            </div>
        </div>
    <div class="sort-bar">
       
      <strong for="sort">Sort By:</strong>
      <select id="sort" class="selection">
        <option>Recommended</option>
        <option>Newest</option>
        <option>Price (Low to High)</option>
        
      </select>
      <img src="../assets/photos/arrow.webp" alt="" class="arrow" width="20px">
    </div>
    </div>
     <div class="car-card">
      <div class="car-image">
        <img src="../assets/photos/discover2.jpg" alt="Porsche Taycan" />
        <div class="sons">
            <img src="../assets/photos/discover1.jpeg" alt="">
        <img src="../assets/photos/discover3.jpg" alt="">
        <img src="../assets/photos/discover2.webp" alt="">
        </div>
        
      </div>
      <div class="car-info">
        <div class="oneCar">
            <h2>2023 Porsche Panamera (MY23)</h2>
        <p>Porsche Approved Pre-Owned</p>
        </div>
        <div class="twoCar">
            <p>Jet Black Metallic · Black</p>
        <p>Electric · 12,356 km · 01/2024 · 1 previous owner</p>
        <p>No accidents · 300 kW / 408 hp · Rear-wheel-drive</p>
        <p>Range combined (WLTP): 442 km</p>
        </div>
        <div class="threeCar">
            <strong>Price on request</strong>
        <button class="btnProduct details">Show Details</button>
        <button class="btnProduct two"><span><i class="fa-regular fa-bookmark fa-xl" style="color: #000000;"></i></span>Save</button>
        <strong class="motor">Motor Center Nablus</strong>
        </div>
        
        
        <p>19.6 kWh/100 km Electrical consumption combined (WLTP) 0 g/km CO2 emissions combined (WLTP)</p>
      </div>
    </div>
 <div class="car-card">
      <div class="car-image">
        <img src="../assets/photos/discover2.jpg" alt="Porsche Taycan" />
        <div class="sons">
            <img src="../assets/photos/discover1.jpeg" alt="">
        <img src="../assets/photos/discover3.jpg" alt="">
        <img src="../assets/photos/discover2.webp" alt="">
        </div>
        
      </div>
      <div class="car-info">
        <div class="oneCar">
            <h2>2023 Porsche Panamera (MY23)</h2>
        <p>Porsche Approved Pre-Owned</p>
        </div>
        <div class="twoCar">
            <p>Jet Black Metallic · Black</p>
        <p>Electric · 12,356 km · 01/2024 · 1 previous owner</p>
        <p>No accidents · 300 kW / 408 hp · Rear-wheel-drive</p>
        <p>Range combined (WLTP): 442 km</p>
        </div>
        <div class="threeCar">
            <strong>Price on request</strong>
        <button class="btnProduct details">Show Details</button>
        <button class="btnProduct two"><span><i class="fa-regular fa-bookmark fa-xl" style="color: #000000;"></i></span>Save</button>
        <strong class="motor">Motor Center Nablus</strong>
        </div>
        
        
        <p>19.6 kWh/100 km Electrical consumption combined (WLTP) 0 g/km CO2 emissions combined (WLTP)</p>
      </div>
    </div>
 <div class="car-card">
      <div class="car-image">
        <img src="../assets/photos/discover2.jpg" alt="Porsche Taycan" />
        <div class="sons">
            <img src="../assets/photos/discover1.jpeg" alt="">
        <img src="../assets/photos/discover3.jpg" alt="">
        <img src="../assets/photos/discover2.webp" alt="">
        </div>
        
      </div>
      <div class="car-info">
        <div class="oneCar">
            <h2>2023 Porsche Panamera (MY23)</h2>
        <p>Porsche Approved Pre-Owned</p>
        </div>
        <div class="twoCar">
            <p>Jet Black Metallic · Black</p>
        <p>Electric · 12,356 km · 01/2024 · 1 previous owner</p>
        <p>No accidents · 300 kW / 408 hp · Rear-wheel-drive</p>
        <p>Range combined (WLTP): 442 km</p>
        </div>
        <div class="threeCar">
            <strong>Price on request</strong>
        <button class="btnProduct details">Show Details</button>
        <button class="btnProduct two"><span><i class="fa-regular fa-bookmark fa-xl" style="color: #000000;"></i></span>Save</button>
        <strong class="motor">Motor Center Nablus</strong>
        </div>
        
        
        <p>19.6 kWh/100 km Electrical consumption combined (WLTP) 0 g/km CO2 emissions combined (WLTP)</p>
      </div>
    </div>
   <div class="car-card">
      <div class="car-image">
        <img src="../assets/photos/discover2.jpg" alt="Porsche Taycan" />
        <div class="sons">
            <img src="../assets/photos/discover1.jpeg" alt="">
        <img src="../assets/photos/discover3.jpg" alt="">
        <img src="../assets/photos/discover2.webp" alt="">
        </div>
        
      </div>
      <div class="car-info">
        <div class="oneCar">
            <h2>2023 Porsche Panamera (MY23)</h2>
        <p>Porsche Approved Pre-Owned</p>
        </div>
        <div class="twoCar">
            <p>Jet Black Metallic · Black</p>
        <p>Electric · 12,356 km · 01/2024 · 1 previous owner</p>
        <p>No accidents · 300 kW / 408 hp · Rear-wheel-drive</p>
        <p>Range combined (WLTP): 442 km</p>
        </div>
        <div class="threeCar">
            <strong>Price on request</strong>
        <button class="btnProduct details">Show Details</button>
        <button class="btnProduct two"><span><i class="fa-regular fa-bookmark fa-xl" style="color: #000000;"></i></span>Save</button>
        <strong class="motor">Motor Center Nablus</strong>
        </div>
        
        
        <p>19.6 kWh/100 km Electrical consumption combined (WLTP) 0 g/km CO2 emissions combined (WLTP)</p>
      </div>
    </div>
     <div class="car-card">
      <div class="car-image">
        <img src="../assets/photos/discover2.jpg" alt="Porsche Taycan" />
        <div class="sons">
            <img src="../assets/photos/discover1.jpeg" alt="">
        <img src="../assets/photos/discover3.jpg" alt="">
        <img src="../assets/photos/discover2.webp" alt="">
        </div>
        
      </div>
      <div class="car-info">
        <div class="oneCar">
            <h2>2023 Porsche Panamera (MY23)</h2>
        <p>Porsche Approved Pre-Owned</p>
        </div>
        <div class="twoCar">
            <p>Jet Black Metallic · Black</p>
        <p>Electric · 12,356 km · 01/2024 · 1 previous owner</p>
        <p>No accidents · 300 kW / 408 hp · Rear-wheel-drive</p>
        <p>Range combined (WLTP): 442 km</p>
        </div>
        <div class="threeCar">
            <strong>Price on request</strong>
        <button class="btnProduct details">Show Details</button>
        <button class="btnProduct two"><span><i class="fa-regular fa-bookmark fa-xl" style="color: #000000;"></i></span>Save</button>
        <strong class="motor">Motor Center Nablus</strong>
        </div>
        
        
        <p>19.6 kWh/100 km Electrical consumption combined (WLTP) 0 g/km CO2 emissions combined (WLTP)</p>
      </div>
    </div>

  <ul class="pagination">
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>
    <li class="page-item"><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>

  </section>

  

</div>

<section>
  <!--Footer-->
<footer class="footer">
  <h4>Overall, how satisfied are you with the <span>information</span> available on this page?</h4>
  <button class="btnProduct2" onclick="showFeedback()">Give Feedback now</button>

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
     <a href="../index.html"><img src="../assets/photos/title.png" id="mainTitle" alt="" width="200px"></a>
  </div>
</footer>
</section>


    <script src="../assets/js/filter.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
    

</body>
</html>