<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <title>Admin Dashboard</title>
  <link
    href="https://fonts.googleapis.com/css2?family=Audiowide&family=Bangers&family=Berkshire+Swash&family=Lobster&family=Molle&family=Orbitron:wght@400..900&family=Pacifico&family=Playwrite+DK+Uloopet:wght@100..400&family=Righteous&family=Ruslan+Display&family=Unbounded:wght@200..900&family=Warnes&display=swap"
    rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <link rel="stylesheet" href="../assets/css/dashboard.css">
  
<style>
  #prog1 > svg { filter: drop-shadow(0 8px 22px rgba(0,0,0,.35)); }
  #prog1 span { 
      font: 900 18px 'Orbitron', sans-serif; color:white !important; 
  }
  .progressbar-text{
    font: 900 18px 'Orbitron', sans-serif; color:white !important;
  }

    #prog2 > svg { filter: drop-shadow(0 8px 22px rgba(0,0,0,.35)); }
  #prog2 span { 
      font: 900 18px 'Orbitron', sans-serif; color:white !important; 
  }
 
</style>
</head>

<body>
  
<?php  require("../api/config.php"); 
session_start();
$isLoggedIn = isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] === true ? 'true' : 'false';
$user_id = isset($_SESSION['userName']) ? $_SESSION['userName'] : null;

?>
<script>
    localStorage.setItem('isLoggedIn', '<?php echo $isLoggedIn; ?>');
    localStorage.setItem('userName', '<?php echo $user_id; ?>');
</script>

<?php
  $sql = "SELECT Name,id FROM Company";
$result = $dp->query($sql);

$labels = [];
$values = [];

if ($result && $result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $labels[] = $row['Name'];
    $sql = "SELECT COUNT(*) as count FROM Product WHERE CompanyId = " . $row['id'];
    $result2 = $dp->query($sql);
    $row2 = $result2->fetch_assoc();
    $values[] = (int)$row2['count'];
  }
}

$labels_escaped = array_map(function($s){
  return str_replace(["\\", "'"], ["\\\\", "\\'"], $s);
}, $labels);
$labels_js = "'" . implode("','", $labels_escaped) . "'";
$values_js = implode(",", $values);

// chart two data feedback // bishawi //
$sql = "
SELECT 
  `Value`,
  CASE `Value`
    WHEN 1 THEN 'Very dissatisfied'
    WHEN 2 THEN 'Dissatisfied'
    WHEN 3 THEN 'Neutral'
    WHEN 4 THEN 'Satisfied'
    WHEN 5 THEN 'Very satisfied'
    ELSE 'Unknown'
  END AS label,
  COUNT(*) AS cnt
FROM `FeedBack`
GROUP BY `Value`
ORDER BY `Value` ASC
";

$result = $dp->query($sql);

$labels2 = [];
$values2 = [];

if ($result && $result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $labels2[] = $row['label'] ?? 'Unknown';
    $values2[] = (int)($row['cnt'] ?? 0);
  }
} else {
  $labels2 = ['Very dissatisfied','Dissatisfied','Neutral','Satisfied','Very satisfied'];
  $values2 = [0,0,0,0,0];
}

$labels_escaped2 = array_map(function($s){
  return str_replace(["\\", "'"], ["\\\\", "\\'"], (string)$s);
}, $labels2);
$labels_js2 = "'" . implode("','", $labels_escaped2) . "'";
$values_js2 = implode(",", array_map('intval', $values2));
  
  ?>
  <div class="toMakeItBlur">
  <div class="menu-icon" onclick="openSidebar()">
    <span class="material-icons-outlined">menu</span>
  </div>
  <aside id="sidebar">
    <div class="sidebar-title">
      <div class="sidebarBrand">
        <?php
        $sql = "SELECT image FROM Users WHERE userName = '$user_id'";
        $result = $dp->query($sql);
        $row = $result->fetch_assoc();
        $image = $row['image'];
        ?>
        <img src="<?php echo $image; ?>" alt="User Image">
        <h4>Welcome <?php echo htmlspecialchars($user_id ?? 'Guest', ENT_QUOTES); ?></h4>
      </div>
      <span class="material-icons-outlined" onclick="closeSidebar()">close</span>
    </div>

    <ul class="sidebar-list">
      <li class="sidebaritem"><a href="#dashboard"><i class="fa-solid fa-chart-simple" style="color: #d8d8d8ff;"></i>Dashboard</a></li>
      <li class="sidebaritem"><a href="#products"><i class="fa-solid fa-car-side" style="color: #d8d8d8ff;"></i>Products</a></li>
      <li class="sidebaritem"><a href="#companies"><i class="fa-solid fa-copyright" style="color: #d8d8d8ff;"></i>Companies</a></li>
      <li class="sidebaritem"><a href="#customers"><i class="fa-solid fa-people-group" style="color: #d8d8d8ff;"></i>Customers</a></li>
      <li class="sidebaritem"><a href="#pages"><i class="fa-solid fa-pen-to-square" style="color: #d8d8d8ff;"></i>Pages</a></li>
      <li class="sidebaritem"><a href="#settings"><i class="fa-solid fa-bars-staggered" style="color: #d8d8d8ff;"></i>Orders</a></li>
    </ul>
    <div class="flexBar">
     
      <i class="fa-solid fa-bell fa-xl" style="color: #ffffff;" class="notIcon"></i><span class="cartCount notifications">1</span></li>
     <a href="../api/logout.php"> <i class="fa-solid fa-right-from-bracket fa-xl" style="color: #ffffff;" ></i></a>
    </div>
 
  </aside>
  <nav class="navbar">

  </nav>
  
  <main class="main-container">
    <section id="dashboard" class="dashboard">
      <h1 class="pagetitles">DASHBOARD</h1>
      <div class="card-container">
      <div class="card2 p-4" style="background: linear-gradient(135deg, #4e1106ff, #8a150bff);">
          <h3 class="manage">Manage your project in one touch</h3>

  
          <div class="mt-0 text-end">
            <img src="https://img.icons8.com/ios-filled/100/ffffff/combo-chart.png" width="50">
          </div>
        </div>
<div class="card2 p-4" style="  background-color: #20202094;">
          <h3 class="manage2">Orders to Users</h3>
         <div id="prog1" style="width:100px;height:100px;"></div>
        </div>
        <div class="card2 p-4" style="  background-color: #20202094;">
           <h3 class="manage2">Deliverd Orders</h3>
            <div id="prog2" style="width:100px;height:100px;"></div>
        </div>

       </div>
      <div class="cards">

        <div class="main-cards">

          <div class="card1">
            <div class="carditem1">
              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="none" 
     stroke="green" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
  <polyline points="3 17 9 11 13 15 21 7"></polyline>
  <polyline points="14 7 21 7 21 14"></polyline>
</svg>

              <h3>PRODUCTS</h3>
              
            </div>
            <?php
            $sql = "SELECT COUNT(*) as count FROM Product";
            $result = $dp->query($sql);
            $row = $result->fetch_assoc();
            $count = $row['count'];
            echo "<h1 class='odometer-stat' data-value='$count'></h1>";
            ?>
        
          </div>

          <div class="card1">
            <div class="carditem1">
               <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="none" 
     stroke="green" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
  <polyline points="3 17 9 11 13 15 21 7"></polyline>
  <polyline points="14 7 21 7 21 14"></polyline>
</svg>
              <h3>COMPANIES</h3>
            </div>
            <?php
            $sql = "SELECT COUNT(*) as count FROM Company";
            $result = $dp->query($sql);
            $row = $result->fetch_assoc();
            $count = $row['count'];
            echo "<h1 class='odometer-stat' data-value='$count'></h1>";
            ?>
          </div>

          <div class="card1">
            <div class="carditem1">
               <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="none" 
     stroke="green" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
  <polyline points="3 17 9 11 13 15 21 7"></polyline>
  <polyline points="14 7 21 7 21 14"></polyline>
</svg>
              <h3>Customers</h3>
            </div>
           <?php
            $sql = "SELECT COUNT(*) as count FROM Users where role = 'user'";
            $result = $dp->query($sql);
            $row = $result->fetch_assoc();
            $count = $row['count'];
            echo "<h1 class='odometer-stat' data-value='$count'></h1>";
            ?>
          </div>

          <div class="card1">
            <div class="carditem1">
               <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="none" 
     stroke="green" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
  <polyline points="3 17 9 11 13 15 21 7"></polyline>
  <polyline points="14 7 21 7 21 14"></polyline>
</svg>
              <h3>ORDERS</h3>
              <?php
$sql = "SELECT COUNT(*) as count FROM `Order`"; 
$result = $dp->query($sql);
$row = $result->fetch_assoc();
$count = $row['count'];
echo "<h1 class='odometer-stat' data-value='$count'></h1>";
?>

            </div>
            
          </div>
        </div>
      </div>
      <div class="charts">
        <canvas id="pieChart"></canvas>
        <div class="lineChart">
        <canvas id="lineChart"></canvas></div>
      </div>
    </section>

  <section id="products" class="products">
    <h1 class="pagetitles">Products</h1>

    <div class="productsList">
        <!-- Search & Add -->
        <div class="productSearch">
            <input type="text" id="searchInput" placeholder="Search for a product">
            <button class="btncomponies2" onclick="addProduct()">Add</button>
        </div>

        <!-- Products cards -->
       <div class="productCards">
<?php
$sql = "SELECT * FROM Product";
$result = $dp->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $id        = $row['id'] ?? '';
        $name      = htmlspecialchars($row['Name'] ?? '');
        $price     = htmlspecialchars($row['Price'] ?? '');
        $year      = htmlspecialchars($row['Year'] ?? '');
        $condition = htmlspecialchars($row['Condition'] ?? '');
        $mileage   = htmlspecialchars($row['MileAge'] ?? '');
        $exterior  = htmlspecialchars($row['Exterior'] ?? '');
        $interior  = htmlspecialchars($row['Interior'] ?? '');
        $company   = htmlspecialchars($row['CompanyId'] ?? '');
        $model     = htmlspecialchars($row['Model'] ?? '');
        $img1      = htmlspecialchars($row['img1'] ?? '');
        $img2      = htmlspecialchars($row['img2'] ?? '');
        $img3      = htmlspecialchars($row['img3'] ?? '');
        $img4      = htmlspecialchars($row['img4'] ?? '');
        $img5      = htmlspecialchars($row['img5'] ?? '');

        echo '
        <div class="productCard" 
             data-id="' . $id . '" 
             data-name="' . $name . '" 
             data-price="' . $price . '" 
             data-year="' . $year . '" 
             data-condition="' . $condition . '" 
             data-mileage="' . $mileage . '" 
             data-exterior="' . $exterior . '" 
             data-interior="' . $interior . '" 
             data-company="' . $company . '" 
             data-model="' . $model . '" 
             data-img1="' . $img1 . '"
             data-img2="' . $img2 . '"
             data-img3="' . $img3 . '"
             data-img4="' . $img4 . '"
             data-img5="' . $img5 . '">
             
            <div class="productCardInfo">
                <img src="' . $img1 . '" alt="Product Image">
                <div class="productCardDiscription">
                    <h1 class="productName">' . $name . '</h1>
                    <ul>
                        <li>Price: ' . $price . ' NIS</li>
                    </ul>
                </div>
            </div>
            <div class="productCardText">
                <button class="btnProductCardEdit" type="button" onclick="editProduct(' . $id . ')">Edit</button>
                <button class="btnProductCardDelete" type="button" onclick="deleteProduct(' . $id . ')">Delete</button>
            </div>
        </div>
        ';
    }
} else {
    echo "<p>No products found.</p>";
}
?>
</div>

    </div>
</section>




<script>
function addProduct() {
    window.location.href = "addProductForm.php"; 
}



const searchInput = document.getElementById('searchInput');
const cards = document.querySelectorAll('.productCard');

searchInput.addEventListener('input', () => {
    const searchTerm = searchInput.value.toLowerCase();
    cards.forEach(card => {
        const name = card.querySelector('.productName').textContent.toLowerCase();
        card.style.display = name.includes(searchTerm) ? "" : "none";
    });
});


</script>

    <section id="companies" class="companies">
      <h1 class="pagetitles">Companies</h1>
      <div class="companiesList">
        <div class="companySearch">
          <input type="text" placeholder="Search for a Company" id="searchCompany" >
          <button  class="btncomponies2 " onclick="addCompany()">Add</button>
  
        </div>
        <div class="companiesCards" id="companyCards" data-delete-url="../api/deleteCompany.php">
<?php
$sql = "SELECT id, Name, Description, image, imagepng FROM Company";
$result = $dp->query($sql);

if ($result && $result->num_rows > 0):
  while ($row = $result->fetch_assoc()):
    $companyId   = (int)$row['id'];
    $companyName = htmlspecialchars($row['Name'], ENT_QUOTES);
    $companyDesc = htmlspecialchars($row['Description'], ENT_QUOTES);
    $image       = !empty($row['image']) ? htmlspecialchars($row['image'], ENT_QUOTES) : "../assets/photos/Companies/Logos/default.png";
    $imagePng    = !empty($row['imagepng']) ? htmlspecialchars($row['imagepng'], ENT_QUOTES) : "../assets/photos/Companies/Pngs/default.png";
?>
<div class="companyCard" 
     data-id="<?php echo $companyId; ?>" 
     data-companyname="<?php echo $companyName; ?>" 
     data-companydescription="<?php echo $companyDesc; ?>"
     data-image="<?php echo $image; ?>"
     data-imagepng="<?php echo $imagePng; ?>">
    <img src="<?php echo $imagePng; ?>" alt="PNG image">
    <div class="companyCardDiscription">
      <h1 class="nameCompany"><?php echo $companyName; ?></h1>
      <div class="companyCardButtons">
        <button class="btncompanyCardEdit" onclick="editCompany(<?php echo $companyId; ?>)">Edit</button>
        <button class="btncompanyCardDelete">Delete</button>
      </div>
    </div>
</div>
<?php
  endwhile;
endif;
?>

<script>
  const inputSearch = document.getElementById('searchCompany');
const cardes = document.querySelectorAll('.companyCard');

inputSearch.addEventListener('input', () => {
    const termSerach = inputSearch.value.toLowerCase();
    cardes.forEach(card => {
        const names = card.querySelector('.nameCompany').textContent.toLowerCase();
        card.style.display = names.includes(termSerach) ? "" : "none";
    });
});

</script>


</div>

      </div>
</section>


<section id="customers" class="customers">
  <h1 class="pagetitles">Customers</h1>

  <div class="customersList">

    <div class="customersCards" id="customerCards" data-delete-url="../api/deleteCustomer.php">
      <?php
        $sql = "SELECT userName FROM Users WHERE role = 'user'";
        $result = $dp->query($sql);

        if ($result && $result->num_rows > 0):
          while($row = $result->fetch_assoc()):
            $userName = htmlspecialchars($row['userName'], ENT_QUOTES);
      ?>
        <div class="customerCard" data-username="<?php echo $userName; ?>">
          <img src="../assets/photos/ProfileDash.png" alt="Card image">
          <div class="customerCardDiscription">
            <h1><?php echo $userName; ?></h1>
            <div class="customerCardButtons">
            
              <button class="btncustomerCardDelete">Delete</button>
            </div>
          </div>
        </div>
      <?php
          endwhile;
        else:
          echo "<p>No customers found</p>";
        endif;
      ?>
    </div>

  </div>
</section>

    <section id="pages" class="pages">
      <h1 class="pagetitles">Main Page</h1>
      <div class="pagesList">
        <div class="pagecards">
          <div class="pagecard1">
            <h1>Video</h1>
              <video id="bgVideo"
  src="../assets/videos/homePage/main.mp4?v=<?= filemtime(__DIR__ . '/../assets/videos/homePage/main.mp4') ?>"
  autoplay muted loop></video>
            
            <button class="btnpagecard1" onclick="changeVideo()">Change Video</button>
            <input hidden type="file" id="videoInput" accept="video/*" class="videoInput">
            <label for="videoInput" style="text-align: center;" class="btnVideoCancel">select Video</label>
            <button class="btnVideoApply" onclick="applyVideo()">Apply</button>
            <button class="btnVideoCancel22" onclick="cancelVideo()">Cancel</button>
          </div>
          <div class="pagecard2">
            <h1>News</h1>
            <img id="newsImage" src="../assets/photos/sectionTwo/img1.jpg" alt="Discover Image">
            <button class="btnpagecard2" onclick="changeImagesTwo()">Change Images</button>
            <input hidden type="file" id="imageInput1" accept="image/jpg" class="imgInput">
    <label for="imageInput1" style="text-align: center;" class="imgLabel">Left Image</label>

    <input hidden type="file" id="imageInput2" accept="image/jpg" class="imgInput">
    <label for="imageInput2" style="text-align: center;" class="imgLabel2">Center Image</label>

  <input hidden type="file" id="imageInput3" accept="image/jpg" class="imgInput">
  
  <label for="imageInput3" style="text-align: center;" class="imgLabel3">Right Image</label>

  <button class="btnImagesApply" onclick="applyImage1()">Apply</button>
  <button class="btnImagesCancel" onclick="cancelImagesTwo()">Cancel</button>
          </div>
       <div class="pagecard3">
  <h1>Discover</h1>
  <img id="discoverImage" src="../assets/photos/discover/img2.jpg" alt="Discover Image">

  <button class="btnpagecard3" onclick="changeImagesThree()">Change Images</button>
  <input hidden type="file" id="imageInputThree1" accept="image/jpg" >
  <label for="imageInputThree1" style="text-align: center;" class="imgLabel4">Left Image</label>
  <input  hidden type="file" id="imageInputThree2" accept="image/jpg" >
  <label for="imageInputThree2" style="text-align: center;" class="imgLabel5">Center Image</label>
  <input  hidden type="file" id="imageInputThree3" accept="image/jpg"  >
  <label for="imageInputThree3" style="text-align: center;" class="imgLabel6">Right Image</label>

  <button class="btnImagesThreeApply" onclick="applyImagesThree()">Apply</button>
  <button class="btnImagesThreeCancel" onclick="cancelImagesThree()">Cancel</button>
</div>
        </div>
        
      </div>
    </section>

<?php
// Database connection
$DB_HOST = 'trolley.proxy.rlwy.net';   
$DB_PORT = 56657;                  
$DB_NAME = 'webproject';              
$DB_USER = 'root';
$DB_PASS = 'NEtoTHvxITFQeGQLDaBHMwDsSfFcwfFy';

$dp = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME, $DB_PORT);
if ($dp->connect_error) {
    die("Connection failed: " . $dp->connect_error);
}

// ----------------- Handle AJAX update -----------------
if(isset($_POST['update_status'])){
    $id = intval($_POST['id']);       // use order ID, not product ID
    $status = $_POST['status'];

    if($stmt = $dp->prepare("UPDATE `Order` SET `Status`=? WHERE id=?")) {
        $stmt->bind_param("si", $status, $id);
        if($stmt->execute()){
            echo "Status updated successfully";
        } else {
            echo "Error: ".$stmt->error;
        }
        $stmt->close();
    } else {
        echo "Prepare failed: ".$dp->error;
    }
    exit; // stop further output for AJAX
}

// ----------------- Fetch orders for the table -----------------
$orderSql = "SELECT id, userName, ProductId, ProductName, ProductPrice, `Status` FROM `Order` ORDER BY id DESC";
$orderResult = $dp->query($orderSql);
$orders = [];
if ($orderResult && $orderResult->num_rows > 0) {
    while($row = $orderResult->fetch_assoc()) {
        $orders[] = $row;
    }
}
?>

<section id="settings" class="settings">
    <h1 class="pagetitles">Orders</h1>
    <div class="details">
        <div class="recentOrders">
            <div class="cardHeader">
                <h2>Recent Orders</h2>
                <span><i class="fa-solid fa-list fa-xl" style="color: #ffffff;position:absolute;left:18vw;top:8vh;"></i></span>
                <a href="#" class="btn" id="viewAllBtn">View All</a>
            </div>

            <div id="orders-container" style="max-height:400px; overflow:hidden; transition: all 0.3s;">
                <table cellpadding="10" cellspacing="0" style="width:100%; border-collapse:collapse;">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody id="orders-tbody">
                        <?php foreach(array_slice($orders, 0, 10) as $row): ?>
                            <?php $statusClass = strtolower(str_replace(" ", "", $row['Status'])); ?>
                            <tr>
                                <td><?= htmlspecialchars($row['userName']); ?></td>
                                <td><?= htmlspecialchars($row['ProductName']); ?></td>
                                <td>$<?= number_format($row['ProductPrice'], 2); ?></td>
                                <td>
                                    <span class="status <?= $statusClass ?>" data-id="<?= $row['id'] ?>">
                                        <?= htmlspecialchars($row['Status']); ?>
                                    </span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<script>


// "View All" button: load all orders dynamically
document.getElementById('viewAllBtn')?.addEventListener('click', function(e){
    e.preventDefault();
    const tbody = document.getElementById('orders-tbody');
    tbody.innerHTML = '';

    const allOrders = <?= json_encode($orders); ?>;

    allOrders.forEach(row => {
        const statusClass = row.Status.toLowerCase() === 'delivered' ? 'delivered' : 'pending';
        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td>${row.userName}</td>
            <td>${row.ProductName}</td>
            <td>$${parseFloat(row.ProductPrice).toFixed(2)}</td>
            <td>
                <span class="status ${statusClass}" data-id="${row.id}">
                    ${row.Status}
                </span>
            </td>
        `;
        tbody.appendChild(tr);
    });

    document.getElementById('orders-container').style.overflowY = 'auto';
});

</script>






                </div>
      </div>
      
    </section>
  </main>
  </div>






<div class="productShow" id="addProductModal" style="display:none;">
  <div class="productShowDiscription">
    <button type="button" class="closeProduct" onclick="closeProduct()">X</button>
    <div class="productShowDiscriptionList">
      <h1>Product Name</h1>
      <div class="productShowContainer">

        <!-- Hidden form that won’t affect layout -->
        <form id="productForm" action="../api/addProduct.php" method="POST" enctype="multipart/form-data" style="display:none;"></form>

        <div class="productShowImages">
          <label class="uploadBox">
            <input type="file" name="img1" form="productForm" accept="image/*" onchange="showImage(this)" hidden>
            <span>+ Choose Image</span>
          </label>
          <div class="productShowImagesthree">
            <label class="uploadBoxSmall">
              <input type="file" name="img2" form="productForm" accept="image/*" onchange="showImage(this)" hidden>
              <span>+ Choose</span>
            </label>
            <label class="uploadBoxSmall">
              <input type="file" name="img3" form="productForm" accept="image/*" onchange="showImage(this)" hidden>
              <span>+ Choose</span>
            </label>
            <label class="uploadBoxSmall">
              <input type="file" name="img4" form="productForm" accept="image/*" onchange="showImage(this)" hidden>
              <span>+ Choose</span>
            </label>
          </div>
          <div>
             <label class="uploadBox2">
               <input type="file" name="img5" form="productForm"  accept="image/*" onchange="showImage(this)" hidden>
           <span>+ Choose Image</span> </label>
           </div>
        </div>

        <div class="productShowDiscriptionInner">
          <h1>Product Name</h1>
          <input type="text" name="Name" form="productForm" placeholder="Product Name">

          <div class="fatherFilter">
            <h1>Condition</h1>
            <select name="Condition" form="productForm"  class="selection">
              <option value="" disabled selected>Condition</option>
              <option value="new">New</option>
              <option value="used">Used</option>
              <option value="preowned">Pre-Owned</option>
            </select>

            <h1>Price</h1>
            <input type="text" name="Price" form="productForm" placeholder="Product Price">

            <h1>Year</h1>
            <input type="text" name="Year" form="productForm" placeholder="Year">
          </div>

          <div class="fatherFilter2">
            <h1> Speed</h1> 
            <select name="Speed" form="productForm"  class="selection">
               <option value="" disabled selected>Max. Speed</option>
                <option value="1">1</option> <option value="1.5">1.5</option>
                 <option value="2">2</option>
                 <option value="2.5">2.5</option>
                 <option value="3">3</option>
                 <option value="3.5">3.5</option>
                 <option value="4">4</option>
                 <option value="4.5">4.5</option>
                 <option value="5">5</option>
                 <option value="5.5">5.5</option>
                 <option value="6">6</option>
                 </select>
            <h1> MileAge</h1> 
            <select name="MileAge" form="productForm"  class="selection">
               <option value="" disabled selected>Max. mileage</option>
                <option value="5000">5000</option> <option value="10000">10000</option>
                 <option value="20000">20000</option>
                 </select>
                 
          </div>

          <div class="fatherFilter2">
            <h1>Exterior</h1>
            <select name="Exterior" form="productForm" id="ExteriorSelect" class="selection">
              <option value="" disabled selected>Exterior Color</option>
              <option value="black">Black</option>
              <option value="white">White</option>
              <option value="silver">Silver</option>
              <option value="crayon">Crayon</option>
              <option value="grey">Grey</option>
              <option value="blue">Blue</option>
              <option value="red">Red</option>
              <option value="yellow">Yellow</option>
              <option value="brown">Brown</option>
              <option value="green">Green</option>
              <option value="violet">Violet</option>
              <option value="gold">Gold</option>
              <option value="orange">Orange</option>
              <option value="pink">Pink</option>
              <option value="beige">Beige</option>
            </select>

            <h1>Interior</h1>
            <select name="Interior" form="productForm" id="interiorSelect" class="selection">
              <option value="" disabled selected>Interior Color</option>
              <option value="black">Black</option>
              <option value="beige">Beige</option>
              <option value="brown">Brown</option>
              <option value="grey">Grey</option>
              <option value="blue">Blue</option>
              <option value="red">Red</option>
              <option value="purple">Purple</option>
              <option value="green">Green</option>
              <option value="white">White</option>
            </select>
          </div>

          <div class="fatherFilter3">
    <h1>Company</h1>
    <select name="CompanyId" form="productForm" id="companySelect" class="selection">
        <option value="" disabled selected>Select Company</option>
        <?php
        $sql = "SELECT id, Name FROM Company ORDER BY Name ASC";
        $result = $dp->query($sql);
        if ($result && $result->num_rows > 0):
            while ($row = $result->fetch_assoc()):
                $companyId = (int)$row['id'];
                $companyName = htmlspecialchars($row['Name']);
        ?>
        <option value="<?= $companyId ?>"><?= $companyName ?></option>
        <?php
            endwhile;
        endif;
        ?>
    </select>

    <h1>Model</h1>
    <select name="Model" form="productForm" id="modelSelect" class="selection">
        <option value="" disabled selected>Select Model</option>
    </select>
</div>

          <button type="submit" form="productForm" class="btnProductShowDiscriptionInnerList">Add</button>
        </div>

      </div>
    </div>
  </div>
</div>










<script>
document.addEventListener("DOMContentLoaded", () => {
    const carModels = {
        toyota: ["Corolla", "Camry", "RAV4", "Hilux", "Land Cruiser"],
        ford: ["Mustang", "Focus", "F-150", "Explorer", "Ranger"],
        bmw: ["X5", "X3", "3 Series", "5 Series", "i8"],
        mercedes: ["C-Class", "E-Class", "S-Class", "GLA", "GLE"],
        audi: ["A3", "A4", "A6", "Q5", "Q7"],
        honda: ["Civic", "Accord", "CR-V", "HR-V", "Pilot"],
        nissan: ["Altima", "Sentra", "Maxima", "Rogue", "X-Trail"],
        hyundai: ["Elantra", "Sonata", "Tucson", "Santa Fe", "Kona"],
        kia: ["Rio", "Cerato", "Sportage", "Sorento", "Stinger"],
        mazda: ["Mazda3", "Mazda6", "CX-3", "CX-5", "MX-5"],
        porsche: ["911", "Cayenne", "Macan", "Panamera", "Taycan"]
    };

    // Generate companyMap dynamically from the database (top 12 now)
    const companyMap = {
        <?php
        $sql = "SELECT id, Name FROM Company ORDER BY Name ASC LIMIT 12"; 
        $result = $dp->query($sql);
        if ($result && $result->num_rows > 0):
            $map = [];
            while ($row = $result->fetch_assoc()):
                $id = (int)$row['id'];
                $key = strtolower(preg_replace('/\s+/', '', $row['Name'])); // remove spaces & lowercase
                $map[] = "\"$id\": \"$key\"";
            endwhile;
            echo implode(",\n", $map);
        endif;
        ?>
    };

    const companySelect = document.getElementById("companySelect");
    const modelSelect = document.getElementById("modelSelect");

    companySelect.addEventListener("change", function () {
        modelSelect.innerHTML = '<option value="" disabled selected>Select Model</option>';
        const selectedCompanyId = this.value;
        const selectedCompany = companyMap[selectedCompanyId];

        if (selectedCompany && carModels[selectedCompany]) {
            carModels[selectedCompany].forEach(model => {
                const option = document.createElement("option");
                option.value = model.toLowerCase().replace(/\s+/g, '-');
                option.textContent = model;
                modelSelect.appendChild(option);
            });
        }
    });
});
</script>



<!--Update Product-->





   <div class="addCompany" id="editNotAdd">
    <div class="addCompanyDiscription">
        <button class="closeAddCompany" onclick="closeCompany()">X</button>
        <div class="addCompanyDiscriptionList">
            <h1>Update Company</h1>
            <form id="editCompanyForm" action="../api/editCompany.php" method="post" class="addCompanyDiscriptionInnerList" enctype="multipart/form-data">

                <!-- Hidden inputs for current images (added, nothing else changed) -->
                <input type="hidden" name="currentImage" id="currentImageInput" form="editCompanyForm">
                <input type="hidden" name="currentImagePng" id="currentImagePngInput" form="editCompanyForm">

                <input type="hidden" name="companyId" id="companyIdInputHidden" form="editCompanyForm">

                <h1>Company Name</h1>
                <input type="text" placeholder="Company Name" id="companyNameInput" required name="companyName" form="editCompanyForm">

                <h1>Company Description</h1>
                <input type="text" placeholder="Company Description" id="companyDescriptionInput" required name="companyDescription" form="editCompanyForm"> 

                <input type="file" placeholder="img" accept="image/*" id="imageInput" hidden name="imagecompany" form="editCompanyForm">
                <label for="imageInput" class="btnProductShowDiscriptionInnerList" style="cursor: pointer; text-align: center; padding: 5px;">Update Image</label>

                <input type="file" placeholder="img" accept="image/*" id="imagepngInput" hidden name="imagepngcompany" form="editCompanyForm">
                <label for="imagepngInput" class="btnProductShowDiscriptionInnerList" style="cursor: pointer; text-align: center; padding: 5px;">Update Png</label>

                <button class="btnProductShowDiscriptionInnerList" type="submit" form="editCompanyForm">Update</button>
            </form>
        </div>
    </div>
</div>


     


    <div class="customerShow">
      <div class="customerShowDiscription">
       <button class="closeCustomer" onclick="closeCustomer()">X</button>
       <div class="customerShowDiscriptionList">
        <h1>Mohammad Bishawi</h1>
        <div class="customerShowDiscriptionInner">
          <img src="../assets/photos/besho.jpg" alt="besho">
          <div class="customerShowDiscriptionInnerList">
          <h1>Customer Name</h1>
          <input type="text" placeholder="Customer Name">
          <h1>Customer Email</h1>
          <input type="text" placeholder="Customer email">
          <h1>Customer orders</h1>
          <button class="btnProductShowDiscriptionInnerList">Orders</button>
          <button class="btnProductShowDiscriptionInnerList">Update</button>
          <button class="btnProductShowDiscriptionInnerList">Delete</button>
          </div>
        </div>
       </div>
      </div>
     
    </div>
  </div>
  <div class="addCompany" id="addNotEdit">
    <div class="addCompanyDiscription">
      <button class="closeAddCompany" onclick="closeAddCompany()">X</button>
      <div class="addCompanyDiscriptionList">
        <h1>Add Company</h1>
     <form id="addCompanyForm" action="../api/addCompany.php" method="post" class="addCompanyDiscriptionInnerList"  enctype="multipart/form-data">
          <h1>Company Name</h1>
          <input type="text" placeholder="Company Name" id="companyNameInput" required name="companyName" >
          <h1>Company Discription</h1>
          <input type="text" placeholder="Company Name" id="companyDescriptionInput" required name="companyDescription" > 
          <input type="file" placeholder="img" accept="image/*" id="imageInput" hidden  required name="imagecompany" >
          <label for="imageInput" class="btnProductShowDiscriptionInnerList" style="cursor: pointer; text-align: center; padding: 5px;">Upload Image</label>
          <input type="file" placeholder="img" accept="image/*" id="imagepngInput" hidden  required name="imagepngcompany" >
          <label for="imagepngInput" class="btnProductShowDiscriptionInnerList" style="cursor: pointer; text-align: center; padding: 5px;">Upload Png</label>
          <button class="btnProductShowDiscriptionInnerList">Add</button>

      </form>

      
        </div>
       </div>
    </div>


    


  <



  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.35.5/apexcharts.min.js"></script>
  <script src="../assets/js/dashboard.js"></script>



<!-- chart 1 data gives  -->
<script>
  const labels = [<?= $labels_js ?>];
  const values = [<?= $values_js ?>];
  const palette = ['#006416','#2bb900','#7fad00','#c78100','#b91c00','#c90000'];
  const hexWithAlpha = (hex, aa) => (hex.length===7 ? hex+aa : hex.slice(0,7)+aa);
  const ringColors   = palette.map(c => hexWithAlpha(c, 'FF'));
  const fillColors   = palette.map(c => hexWithAlpha(c, '55')); 

  const data = {
    labels,
    datasets: [{
      label: 'Number of Products',
      data: values,
      backgroundColor: fillColors,
      borderWidth: 0               
    }]
  };


  const arcOuterGlow = {
    id: 'arcOuterGlow',
    afterDatasetsDraw(chart){
      const {ctx} = chart, meta = chart.getDatasetMeta(0);
      if (!meta) return;
      ctx.save();
      meta.data.forEach((arc, i) => {
        const c = ringColors[i % ringColors.length];
        const {x,y,startAngle,endAngle,outerRadius} =
          arc.getProps(['x','y','startAngle','endAngle','outerRadius'], true);

        ctx.beginPath();
        ctx.arc(x, y, outerRadius + 2, startAngle, endAngle);
        ctx.strokeStyle = c;
        ctx.lineWidth = 6;
        ctx.shadowColor = c;
        ctx.shadowBlur  = 50;   
        ctx.stroke();
      });
      ctx.restore();
    }
  };

  const arcInnerDarkBorder = {
    id: 'arcInnerDarkBorder',
    afterDatasetsDraw(chart){
      const {ctx} = chart, meta = chart.getDatasetMeta(0);
      if (!meta) return;
      ctx.save();
      meta.data.forEach((arc) => {
        const {x,y,startAngle,endAngle,innerRadius} =
          arc.getProps(['x','y','startAngle','endAngle','innerRadius'], true);

        ctx.beginPath();
        ctx.arc(x, y, innerRadius + 1, startAngle, endAngle);
        ctx.strokeStyle = 'rgba(0,0,0,0.6)'; // أغمق شوي
        ctx.lineWidth = 3;
        ctx.stroke();
      });
      ctx.restore();
    }
  };

  function handleHover(evt, item, legend) {
    const colors = legend.chart.data.datasets[0].backgroundColor;
    colors.forEach((color, index) => {
      colors[index] = (index === item.index || color.length === 9) ? color : hexWithAlpha(color, '80');
    });
    legend.chart.update();
  }
  function handleLeave(evt, item, legend) {
    const dsColors = legend.chart.data.datasets[0].backgroundColor;
    dsColors.forEach((color, index) => {
      dsColors[index] = hexWithAlpha(palette[index % palette.length], '55');
    });
    legend.chart.update();
  }

  const config = {
    type: 'doughnut',
    data,
    options: {
      responsive: false,
      cutout: '50%',                       
      layout: { padding: { top: 12, right: 16, bottom: 36, left: 16 } },
      plugins: {
        legend: {
          onHover: handleHover,
          onLeave: handleLeave,
          labels: { font: { size: 10, weight: 'bold' }, color: '#a3a1a1ff' }
        },
        tooltip: { bodyFont: { size: 10 } }
      }
    },
    plugins: [arcOuterGlow, arcInnerDarkBorder]
  };

  const ctx = document.getElementById('pieChart');
  const myChart = new Chart(ctx, config);
  (function ensureOverflowVisible(){
    const el = ctx && ctx.parentNode;
    if (el) el.style.overflow = 'visible';
  })();

  function logout(e){
    e.preventDefault();
    localStorage.removeItem('isLoggedIn');
    window.location.href = '../api/logout.php';
  }
</script>


<!-- chart two give data  -->

<script>
const labels2 = [<?= $labels_js2 ?>];
const values2 = [<?= $values_js2 ?>];
const BASE = ['#b80202','#6e0101','#7e4b00','#005e00','#1ba300','#00ff00'];
const glassBg = {
  id: 'glassBg',
  beforeDraw(chart, args, opts) {
    const {ctx, chartArea} = chart;
    if (!chartArea) return;
    const {left, right, top, bottom, width, height} = chartArea;
    const g = ctx.createLinearGradient(left, top, right, bottom);
    g.addColorStop(0, 'rgba(10,10,20,0.55)');
    g.addColorStop(1, 'rgba(10,10,20,0.25)');
    ctx.save();
    ctx.fillStyle = g;
    ctx.fillRect(left, top, width, height);
    ctx.strokeStyle = 'rgba(255,255,255,0.06)';
    ctx.lineWidth = 1;
    const step = Math.max(40, Math.floor(height / 6));
    for (let y = bottom; y >= top; y -= step) {
      ctx.beginPath(); ctx.moveTo(left, y); ctx.lineTo(right, y); ctx.stroke();
    }
    ctx.restore();
  }
};

const neonGlow = {
  id: 'neonGlow',
  afterDatasetsDraw(chart) {
    const {ctx} = chart;
    const meta = chart.getDatasetMeta(0);
    ctx.save();
    meta.data.forEach((bar, i) => {
      const c = BASE[i % BASE.length];
      ctx.shadowColor = c; ctx.shadowBlur = 24;
      ctx.strokeStyle = c; ctx.lineWidth = 6;
      ctx.beginPath(); bar.draw(ctx); ctx.stroke();
      ctx.shadowBlur = 0;
    });
    ctx.restore();
  }
};

const valueLabels = {
  id: 'valueLabels',
  afterDatasetsDraw(chart, args, pluginOpts) {
    const {ctx, scales} = chart; const meta = chart.getDatasetMeta(0);
    const prog = Math.min(1, (chart.getDatasetMeta(0).controller?._cachedMeta?._parsed?.length ? 1 : 1)); 
    ctx.save();
    ctx.font = '600 12px ui-sans-serif, system-ui, -apple-system';
    ctx.fillStyle = 'rgba(255,255,255,0.95)';
    ctx.textBaseline = 'middle';
    meta.data.forEach((el, i) => {
      const val = chart.data.datasets[0].data[i];
      const {x, y} = el.tooltipPosition();
      const bounce = 8 * Math.sin((performance.now()/300) + i) * 0.08; 
      ctx.globalAlpha = 0.85;
      ctx.fillText(val, x + 14, y + bounce);
    });
    ctx.restore();
  }
};

let hoverRipple = {i: -1, t: 0};
const ripple = {
  id: 'ripple',
  afterDatasetsDraw(chart) {
    if (hoverRipple.i < 0) return;
    const meta = chart.getDatasetMeta(0);
    const el = meta.data[hoverRipple.i];
    if (!el) return;
    const {ctx} = chart;
    const c = BASE[hoverRipple.i % BASE.length];
    const pos = el.tooltipPosition();
    const radius = 6 + hoverRipple.t * 22;
    const alpha = Math.max(0, 0.35 - hoverRipple.t * 0.35);
    ctx.save();
    ctx.beginPath();
    ctx.arc(pos.x, pos.y, radius, 0, Math.PI*2);
    ctx.strokeStyle = c; ctx.globalAlpha = alpha; ctx.lineWidth = 3;
    ctx.stroke();
    ctx.restore();
    hoverRipple.t += 0.04;
    if (hoverRipple.t < 1) requestAnimationFrame(() => chart.draw());
  }
};

function barGradient(ctx, area, i) {
  const g = ctx.createLinearGradient(area.left, area.top, area.right, area.bottom);
  const c = BASE[i % BASE.length];
  g.addColorStop(0, c + 'CC');   
  g.addColorStop(0.5, c + '88'); 
  g.addColorStop(1, c + '22');   
  return g;
}

const data2 = {
  labels: labels2,
  datasets: [{
    label: 'Feedback votes',
    data: values2,
    borderColor: (ctx) => BASE[(ctx.dataIndex ?? 0) % BASE.length],
    borderWidth: 1.5,
    borderRadius: 12,
    barPercentage: 0.72,
    categoryPercentage: 0.68,
    backgroundColor: (ctx) => {
      const {chart, dataIndex} = ctx; const area = chart.chartArea;
      if (!area) return BASE[dataIndex % BASE.length];
      return barGradient(chart.ctx, area, dataIndex);
    },
    hoverBackgroundColor: (ctx) => BASE[(ctx.dataIndex ?? 0) % BASE.length]
  }]
};

const config2 = {
  type: 'bar',
  data: data2,
  options: {
    indexAxis: 'x', 
    responsive: true,
    maintainAspectRatio: false,
    layout: {padding: {left: 10, right: 10, top: 8, bottom: 8}},
    plugins: {
      legend: {
        labels: {color: '#cfcfcf', font: {size: 11, weight: '600'}}
      },
      tooltip: {
        backgroundColor: 'rgba(0,0,0,0.75)',
        borderColor: 'rgba(255,255,255,0.12)',
        borderWidth: 1,
        bodyFont: {size: 12},
        callbacks: {
          label: (ctx) => `Votes: ${ctx.parsed.x}`
        }
      }
    },
    interaction: {mode: 'nearest', intersect: true},
    scales: {
      y: {
        beginAtZero: true,
        grid: {color: 'rgba(255,255,255,0.07)'},
        ticks: {color: '#bfbdbd', font: {size: 11}, precision: 0}
      },
      x: {
        grid: {display: false},
        ticks: {color: '#e3e3e3', font: {size: 12, weight: '600'}}
      }
    },
    animations: {
      y: {
        easing: 'easeOutElastic',
        duration: 1400,
        from: (ctx) => 0,
        delay: (ctx) => ctx.dataIndex * 110
      }
    },
    hover: {
      mode: 'nearest',
      onHover: (evt, activeEls, chart) => {
        const canvas = evt.native?.target;
        if (canvas) canvas.style.cursor = activeEls.length ? 'pointer' : 'default';
        if (activeEls.length) {
          hoverRipple = {i: activeEls[0].index, t: 0};
          requestAnimationFrame(() => chart.draw());
        }
      }
    }
  },
  plugins: [glassBg, neonGlow, valueLabels, ripple]
};

const chartId = 'lineChart'; 
const ctx2 = document.getElementById(chartId).getContext('2d');
const myChart2 = new Chart(ctx2, config2);
</script>















<script type="text/javascript"
        src="https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js">
</script>
<!--                 email code                                  -->
<script>
  (function(){
    emailjs.init({ publicKey: "3C2Muw3ickuu0FrEq" });
  })();
</script>

<script>
document.getElementById('orders-tbody').addEventListener('click', async (e) => {
  const el = e.target.closest('.status');
  if (!el) return;
  const orderId = el.getAttribute('data-id');
  const cur     = (el.textContent || '').trim().toLowerCase();
  const next    = (cur === 'pending') ? 'Delivered' : 'Pending';

  el.textContent = next;
  el.classList.toggle('delivered', next.toLowerCase() === 'delivered');
  el.classList.toggle('pending',   next.toLowerCase() !== 'delivered');

  const fd = new FormData();
  fd.append('order_id', orderId);
  fd.append('new_status', next);
  await fetch('../api/updateStatus.php', { method: 'POST', body: fd });
  if (next.toLowerCase() === 'delivered') {
    const fd2 = new FormData();
    fd2.append('order_id', orderId);
    const r  = await fetch('../api/getUserData.php', { method: 'POST', body: fd2 });
    const d  = await r.json();
    if (d && d.success) {
      await emailjs.send("service_rj120g6","template_n0bpv6v",{
name: d.userName,
car: d.productName,
email: d.email,
});
    }
  }
});
</script>

 <!-- / /// / / change video main ////// -->

<script>
function applyVideo() {
  const fileInput = document.getElementById("videoInput");
  const file = fileInput.files[0];
  if (!file) {
    alert("Please choose a video file first");
    return;
  }

  const formData = new FormData();
  formData.append("video", file);
  fetch("../api/uploadVideo.php", {
    method: "POST",
    body: formData
  })
  .then(res => res.text())
  .then(msg => {
    alert(msg);
    const video = document.getElementById("bgVideo");
    video.src = "../assets/videos/homePage/main.mp4?ts=" + Date.now(); 
    video.load();
    video.play();
  })
  .catch(err => console.error("Upload failed:", err));
}
</script>




<script>
function applyImage1() {
  const input = document.getElementById('imageInput1'); 
  if (!input || !input.files.length) {
    alert("Choose an image first");
    return;
  }

  const formData = new FormData();
  formData.append('img1', input.files[0]);

  fetch("../api/uploadImages.php", { method: "POST", body: formData })
    .then(res => res.json())
    .then(data => {
      if (data.success && data.img1) {
        const img = document.getElementById('newsImage');
        img.src = data.img1 + "?ts=" + Date.now();
        alert("Image updated!");
      } else {
        alert("Upload failed: " + (data.message || ''));
      }
    })
    .catch(err => console.error("Upload error:", err));
}
</script>



<script>
function applyImagesThree() {
  const input1 = document.getElementById('imageInputThree1');
  const input2 = document.getElementById('imageInputThree2');
  const input3 = document.getElementById('imageInputThree3');

  const formData = new FormData();
  if (input1.files.length) formData.append('discover1', input1.files[0]);
  if (input2.files.length) formData.append('discover2', input2.files[0]);
  if (input3.files.length) formData.append('discover3', input3.files[0]);

  if (![...formData.keys()].length) {
    alert("Choose at least one image");
    return;
  }

  fetch("../api/uploadDiscover.php", { method: "POST", body: formData })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        if (data.discover1) {
          document.getElementById('discoverImage').src = data.discover1 + "?t=" + Date.now();
        }
        alert("Discover images updated!");
      } else {
        alert("Upload failed: " + (data.message || ''));
      }
    })
    .catch(err => console.error("Upload error:", err));
}


</script>





<script src="https://cdn.jsdelivr.net/npm/progressbar.js"></script>
<?php   

$sql = "SELECT ROUND(100 * COUNT(DISTINCT o.userName) / COUNT(DISTINCT u.userName)) AS p
        FROM Users u
        LEFT JOIN `Order` o ON o.userName = u.userName";

$stmt = $dp->prepare($sql);
$stmt->execute();
$stmt->bind_result($p);
$stmt->fetch();
$stmt->close();
?>

<script>
  const percent = <?php echo $p; ?>;

  const bar = new ProgressBar.Circle('#prog1', {
    strokeWidth: 20,
    trailWidth: 20,
    color: '#8a150bff',
    trailColor: '#8a160b6e',
    easing: 'easeInOut',
    duration: 3200,
    text: { autoStyleContainer: true }
  });

  bar.set(0);
  bar.animate(percent/100, {
    step: (state, circle) => circle.setText(Math.round(circle.value()*100) + '%')
  });
</script>


<?php
$sql = "
  SELECT
    CASE WHEN t.total = 0 THEN 0
         ELSE ROUND(100 * d.deliv / t.total)
    END AS p
  FROM
    (SELECT COUNT(*) AS deliv FROM `Order` WHERE Status='Delivered') d,
    (SELECT COUNT(*) AS total FROM `Order`) t
";

$stmt = $dp->prepare($sql);
$stmt->execute();
$stmt->bind_result($p2);
$stmt->fetch();
$stmt->close();
?>





<script type="module">
  const percent = <?php echo $p2; ?>;
  const bar = new ProgressBar.Circle('#prog2', {
    strokeWidth: 20, trailWidth: 20,
    color: '#004d00ff', trailColor: '#004d009f',
    easing: 'easeInOut', duration: 3200,
    text: { autoStyleContainer: true }
  });
  bar.set(0);
  bar.animate(percent/100, {
    step: (s, c) => c.setText(Math.round(c.value()*100) + '%')
  });
</script>























</body>

</html>
