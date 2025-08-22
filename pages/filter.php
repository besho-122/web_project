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
          <a class="nav-link" href="../pages/configure.php">Configure</a>
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
       
      
      
      <form class="d-flex" role="search">
  <div class="searchDiv">
    <input class="form-control me-2" type="search" id="searchInput" placeholder="Search" aria-label="Search"/>
    <i class="fa-solid fa-magnifying-glass fa-xl searchIcon" style="color: #000000;"></i>
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



<section class="filterFirst">
    <h1 class="nameModel"></h1>
    <h4>New and used cars for sale.</h4>
   


</section>
<div class="filterMain">
 <div class="page-container">
  <aside class="sidebar">
    <ul>
      <li class="condition">
    Condition
    <div class="checkCondition">
        <?php
        $conditions = ['New', 'Used', 'preowned'];
        foreach ($conditions as $cond):
        ?>
        <label class="custom-checkbox">
            <?= htmlspecialchars($cond) ?>
            <input type="checkbox" value="<?= htmlspecialchars($cond) ?>">
            <span class="checkmark"></span>
        </label>
        <?php endforeach; ?>
    </div>
</li>


      <li class="modelSeries">
    Model Series
    <div class="SeriesSelect">
        <select id="modelSeriesSelect" class="selection selectionEdit">
            <option value="">Any</option>
            <?php
            $sql = "SELECT DISTINCT Model FROM Product ORDER BY Model ASC";
            $result = $dp->query($sql);
            if ($result && $result->num_rows > 0):
                while($row = $result->fetch_assoc()):
                    $model = htmlspecialchars($row['Model']);
            ?>
            <option value="<?= $model ?>"><?= $model ?></option>
            <?php endwhile; endif; ?>
        </select>
    </div>
</li>

      <li class="modelVarients">
    Company
    <div class="varientsChecked">
        <div class="searchGrandDad">
            <i class="fa-solid fa-magnifying-glass fa-lg searchIcon editSearchIcon"></i>
            <div class="searchDad">
                <form class="d-flex" role="search" onsubmit="return false;">
                    <input id="checkboxSearch" class="form-control" type="search" placeholder="Search" aria-label="Search">
                </form>
            </div>
        </div>

        <?php
        $sql = "SELECT id, Name FROM Company ORDER BY Name ASC"; 
        $result = $dp->query($sql);

        if ($result && $result->num_rows > 0):
            while($row = $result->fetch_assoc()):
                $companyId = (int)$row['id']; 
                $companyName = htmlspecialchars($row['Name'], ENT_QUOTES);
        ?>
        <label class="custom-checkbox">
            <?= $companyName ?>
            <input type="checkbox" 
                   value="<?= $companyName ?>" 
                   data-name="<?= $companyName ?>" 
                   id="checkbox<?= $companyId ?>">
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



      <li class="modelYear">
        Model Year
        <div class="yearSelection">
            
        </div>
    </li>
      <li class="exteriorColour">
    Exterior Colour
    <div class="exColor">
        <?php
        $sql = "SELECT Exterior, COUNT(*) AS Count FROM Product GROUP BY Exterior ORDER BY Exterior ASC";
        $result = $dp->query($sql);
        $spanClasses = [
            'colorFirst', 'colorSecond', 'colorThird', 'colorFourth', 'colorFifth',
            'colorSixth', 'colorSeventh', 'colorEight', 'colorNine', 'colorTen',
            'colorEleven', 'colorTwelve', 'colorThirteen', 'colorFourteen', 'colorFifteen'
        ];
        $i = 0;
       
        if ($result && $result->num_rows > 0):
            while ($row = $result->fetch_assoc()):
                $colorName = htmlspecialchars($row['Exterior']);
                $colorCount = (int)$row['Count'];
        ?>
        <label class="custom-checkbox">
            <span class="<?= $spanClasses[$i] ?> colorType">2</span> <?= $colorName ?> (<?= $colorCount ?>)
            <input type="checkbox" value="<?= $colorName ?>" class="exteriorFilter">
            <span class="checkmark"></span>
        </label>
        <?php
                $i++;
            endwhile;
        endif;
        ?>
    </div>
</li>

<li class="interiorColour">
    Interior Colour
    <div class="intColour">
        <?php
        $sql = "SELECT Interior, COUNT(*) AS Count FROM Product GROUP BY Interior";
        $result = $dp->query($sql);
        $spanClasses = [
            'colorFirst', 'colorSecond', 'colorThird', 'colorFourth', 'colorFifth',
            'colorSixth', 'colorSeventh', 'colorEight', 'colorNine', 'colorTen'
        ];
        $i = 0;
        if ($result && $result->num_rows > 0):
            while ($row = $result->fetch_assoc()):
                $colorName = htmlspecialchars($row['Interior']);
                $colorCount = (int)$row['Count'];
        ?>
        <label class="custom-checkbox">
            <span class="<?= $spanClasses[$i] ?> colorType">2</span> <?= $colorName ?> (<?= $colorCount ?>)
            <input type="checkbox" value="<?= $colorName ?>"><span class="checkmark"></span>
        </label>
        <?php
                $i++;
            endwhile;
        endif;
        ?>
    </div>
</li>

    <li class="price">
    Price
    <div class="priceField">
        <div class="priceInputs" style="display: flex; gap: 8px; align-items: center; justify-content:center;">
            <input type="number" id="priceMin" class="priceInput minPriceInput" placeholder="Min" step="10000" style="width: 100px;border-radius:5px;text-align:center;">
            <p style="margin-top:13px;">to</p>
            <input type="number" id="priceMax" class="priceInput maxPriceInput" placeholder="Max" step="10000" style="width: 100px;border-radius:5px;text-align:center;">
        <p style="margin-top:14px;">NIS.</p>
          </div>
    </div>
</li>


      <li class="mileAge">
    Mile Age
    <div class="mileField">
        <p>Max. Mileage</p>
        <div class="SeriesSelect2 sort-bar">
           <select id="maxMileage" class="selection milesSelect">
               <option value="">Any</option>
                <?php
                // Fetch distinct mileage values from the database, ordered ascending
                $sql = "SELECT DISTINCT MileAge FROM Product ORDER BY MileAge ASC";
                $result = $dp->query($sql);

                if ($result && $result->num_rows > 0):
                    while($row = $result->fetch_assoc()):
                        $mileage = (int)$row['MileAge'];
                        $formattedMileage = number_format($mileage) . ' km';
                ?>
                <option value="<?= $mileage ?>"><?= $formattedMileage ?></option>
                <?php
                    endwhile;
                endif;
                ?>
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

    <button type="button" class="resetButton">
  <span><i class="fa-regular fa-trash-can fa-lg" style="color: #000000;"></i></span>
  Reset all filters
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
       
      
   <?php
$sortOption = $_GET['sort'] ?? 'original'; 
$sql = "SELECT p.*, c.Name AS CompanyName 
        FROM Product p
        LEFT JOIN Company c ON p.CompanyId = c.id";
if ($sortOption === 'newest') {
    $sql .= " ORDER BY CAST(p.Year AS UNSIGNED) DESC";
} elseif ($sortOption === 'priceLowHigh') {
    $sql .= " ORDER BY CAST(p.Price AS DECIMAL(10,2)) ASC";
}

$result = $dp->query($sql);
?>

<strong for="sort">Sort By:</strong>
<select id="sort" class="selection" onchange="window.location.href='?sort='+this.value;">
    <option value="original" <?= ($_GET['sort'] ?? 'original') === 'original' ? 'selected' : '' ?>>Recommended</option>
    <option value="newest" <?= ($_GET['sort'] ?? '') === 'newest' ? 'selected' : '' ?>>Newest</option>
    <option value="priceLowHigh" <?= ($_GET['sort'] ?? '') === 'priceLowHigh' ? 'selected' : '' ?>>Price (Low to High)</option>
</select>
<script>
window.addEventListener('beforeunload', () => {
    localStorage.setItem('sort', document.getElementById('sort').value);
    localStorage.setItem('scroll', window.scrollY);
});
window.addEventListener('load', () => {
    const sortValue = localStorage.getItem('sort');
    if (sortValue) document.getElementById('sort').value = sortValue;
    const scrollY = localStorage.getItem('scroll');
    if (scrollY) window.scrollTo(0, scrollY);
    localStorage.removeItem('sort');
    localStorage.removeItem('scroll');
});

</script>
<img src="../assets/photos/arrow.webp" alt="" class="arrow" width="20px">
    </div>
    </div>
<?php
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $name = htmlspecialchars($row['Name'] ?? '');
        $companyName = htmlspecialchars($row['CompanyName'] ?? '');
        $imgs = htmlspecialchars($row['img4'] ?? '');
?>

<div class="car-card"
      data-id="<?= $row['id'] ?>"
      data-image="<?= htmlspecialchars($row['img5'] ?? '') ?>"
      data-condition="<?= htmlspecialchars($row['Condition'] ?? '') ?>"
      data-model="<?= htmlspecialchars($row['Model'] ?? '') ?>"
      data-company="<?= htmlspecialchars($row['CompanyName'] ?? '') ?>"   
      data-year="<?= htmlspecialchars($row['Year'] ?? '') ?>"
      data-exterior="<?= htmlspecialchars($row['Exterior'] ?? '') ?>"
      data-interior="<?= htmlspecialchars($row['Interior'] ?? '') ?>"
      data-price="<?= htmlspecialchars($row['Price'] ?? '') ?>"
      data-mileage="<?= htmlspecialchars($row['MileAge'] ?? '') ?>"
>

    <div class="car-image">
        <img src="<?= $imgs ?>" alt="<?= $name ?>" />
    </div>

    <div class="car-info">
        <div class="oneCar">
            <h2><?= $name ?></h2>
            <p>Car condition: <?= htmlspecialchars($row['Condition'] ?? '') ?></p>
        </div>
        <div class="twoCar">
            <p>Exterior color: <?= htmlspecialchars($row['Exterior'] ?? '') ?></p>
            <p>Electric · <?= htmlspecialchars($row['MileAge'] ?? '') ?> km · <?= htmlspecialchars($row['Year'] ?? '') ?></p>
            <p>No accidents · 300 kW / 408 hp · Rear-wheel-drive</p>
            <p>Range combined (WLTP): 442 km</p>
        </div>
        <div class="threeCar">
            <strong>$<?= htmlspecialchars($row['Price'] ?? '') ?></strong>
            <button class="btnProduct details"
                    onclick="window.location.href='../pages/model.php?id=<?= $row['id'] ?>'">
                Show Details
            </button>
            <button class="btnProduct two">
                <span><i class="fa-regular fa-bookmark fa-xl" style="color: #000000;"></i></span>
                Save
            </button>
            <strong class="motor"><?= htmlspecialchars($row['CompanyName'] ?? '') ?></strong>
        </div>
        <p>19.6 kWh/100 km Electrical consumption combined (WLTP) · 0 g/km CO2 emissions combined (WLTP)</p>
    </div>
</div>

<?php
    }
} else {
    echo "<p>No cars found.</p>";
}
?>
<!-- your car cards HTML ends here -->

<script>
const sortSelect = document.getElementById('sort');
if (sortSelect) {
    sortSelect.addEventListener('change', () => {
        const selected = sortSelect.value;
        let url = window.location.href;
        url = url.replace(/([?&])sort=[^&]*/,'').replace(/&$/,'');
        url += (url.includes('?') ? '&' : '?') + 'sort=' + encodeURIComponent(selected);
        window.location.href = url;
    });
} else {
    console.error('Sort select not found!');
}
</script>
</body>


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
    document.documentElement.style.setProperty('--black-color', '#ffffffff');
    document.documentElement.style.setProperty('--gradient-color', 'linear-gradient( #222222ff,#000000,#000000)');
  

    }
    else {
    }
  </script>



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















    <script src="../assets/js/filter.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>





    

</body>
</html>