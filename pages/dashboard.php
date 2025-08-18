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
</head>

<body>
  <?php  require("../api/config.php"); 
  $sql = "SELECT Name,id FROM Company";
$result = $dp->query($sql);

$labels = [];
$values = [];

if ($result && $result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $labels[] = $row['Name'];
    $values[] = (int)$row['id'];
  }
}

$labels_escaped = array_map(function($s){
  return str_replace(["\\", "'"], ["\\\\", "\\'"], $s);
}, $labels);
$labels_js = "'" . implode("','", $labels_escaped) . "'";
$values_js = implode(",", $values);
  
  
  
  ?>
  <div class="toMakeItBlur">
  <div class="menu-icon" onclick="openSidebar()">
    <span class="material-icons-outlined">menu</span>
  </div>
  <aside id="sidebar">
    <div class="sidebar-title">
      <div class="sidebarBrand">
        <img src="../assets/photos/yousef.jpg">
        <h4>Welcome Yousef</h4>
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
     
      <i class="fa-solid fa-bell fa-xl" style="color: #ffffff;"></i>
      <i class="fa-solid fa-envelope fa-xl" style="color: #ffffff;"></i>
    </div>
    
  </aside>
  <nav class="navbar">

  </nav>
  
  <main class="main-container">
    <section id="dashboard" class="dashboard">
      <h1 class="pagetitles">DASHBOARD</h1>
      <div class="card2 p-4" style="background: linear-gradient(135deg, #4e1106ff, #8a150bff);">
          <h3>Manage your project in one touch</h3>
          <p>Let Fillow manage your project automatically with our best AI systems</p>
  
          <div class="mt-3 text-end">
            <img src="https://img.icons8.com/ios-filled/100/ffffff/combo-chart.png" width="60">
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
            $sql = "SELECT COUNT(*) as count FROM Users";
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
            $sql = "SELECT COUNT(*) as count FROM Users";
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
$sql = "SELECT COUNT(*) as count FROM `Order`"; // note the backticks
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
        <canvas id="lineChart"></canvas>
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
            <video id="bgVideo" src="../assets/videos/homePage/main.mp4" autoplay muted loop ></video>
            <button class="btnpagecard1" onclick="changeVideo()">Change Video</button>
            <input type="file" id="videoInput" accept="video/*" class="videoInput">
            <button class="btnVideoApply" onclick="applyVideo()">Apply</button>
            <button class="btnVideoCancel" onclick="cancelVideo()">Cancel</button>
          </div>
          <div class="pagecard2">
            <h1>News</h1>
            <img id="newsImage" src="../assets/photos/sectionTwo/2025-Mercedes-AMG.jpg" alt="Discover Image">
            <button class="btnpagecard2" onclick="changeImagesTwo()">Change Images</button>
            <input type="file" id="imageInput1" accept="image/*" class="imgInput">
            <input type="file" id="imageInput2" accept="image/*" class="imgInput">
            <input type="file" id="imageInput3" accept="image/*" class="imgInput">
            <button class="btnImagesApply" onclick="applyImagesTwo()">Apply</button>
            <button class="btnImagesCancel" onclick="cancelImagesTwo()">Cancel</button>
          </div>
          <div class="pagecard3">
            <h1>Discover</h1>
            <img id="discoverImage" src="../assets/photos/discover2.jpg" alt="Discover Image">
            <button class="btnpagecard3" onclick="changeImagesThree()">Change Images</button>
             <input type="file" id="imageInputThree1" accept="image/*" class="imgInputThree">
            <input type="file" id="imageInputThree2" accept="image/*" class="imgInputThree">
            <input type="file" id="imageInputThree3" accept="image/*" class="imgInputThree">
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
// Event delegation: click status to update DB and class
document.getElementById('orders-tbody').addEventListener('click', function(e){
    if(e.target && e.target.classList.contains('status')){
        let elem = e.target;
        let orderId = elem.getAttribute('data-id');
        let currentStatus = elem.textContent.trim();
        let newStatus = (currentStatus.toLowerCase() === 'pending') ? 'Delivered' : 'Pending';

        // === Immediate UI update ===
        elem.textContent = newStatus;
        if(newStatus.toLowerCase() === 'delivered'){
            elem.classList.remove('pending');
            elem.classList.add('delivered');
        } else {
            elem.classList.remove('delivered');
            elem.classList.add('pending');
        }

        // === Send AJAX to update DB ===
        let formData = new FormData();
        formData.append('update_status', 1);
        formData.append('id', orderId);
        formData.append('status', newStatus);

        fetch(window.location.href, {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => console.log('DB response:', data))
        .catch(err => console.error('AJAX error:', err));
    }
});


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
  <script>
 const labels = [<?= $labels_js ?>];
  const values = [<?= $values_js ?>];

const palette = [
  '#341c1cff',    
  '#294533ff',   
  '#a3a1a1ff',    
  '#580606ff' ,
  '#0b6864ff',
  '#151816ff'
];

const colors = Array.from({length: labels.length}, (_, i) => palette[i % palette.length]);
  const data = {
    labels: labels,
    datasets: [{
      label: '# of Votes',
      data: values,
      borderWidth: 1,
      backgroundColor: colors
    }]
  };
  

  function handleHover(evt, item, legend) {
    const colors = legend.chart.data.datasets[0].backgroundColor;
    colors.forEach((color, index) => {
  
      colors[index] = (index === item.index || color.length === 9) ? color : color + '4D';
    });
    legend.chart.update();
  }

  function handleLeave(evt, item, legend) {
    const colors = legend.chart.data.datasets[0].backgroundColor;
    colors.forEach((color, index) => {
      colors[index] = (color.length === 9) ? color.slice(0, -2) : color;
    });
    legend.chart.update();
  }

  const config = {
    type: 'polarArea',
    data: data,
    options: {
      responsive: false,
      plugins: {
        legend: {
          onHover: handleHover,
          onLeave: handleLeave,
          labels: {
            font: { size: 10, weight: 'bold' },
            color: '#a3a1a1ff'
          }
        },
        tooltip: {
          bodyFont: { size: 10 }
        }
      }
    }
  };

  const ctx = document.getElementById('pieChart');
  const myChart = new Chart(ctx, config);
    function logout(e){
    e.preventDefault();
    localStorage.removeItem('isLoggedIn');
    window.location.href = '../api/logout.php';
  }


  </script>
</body>

</html>