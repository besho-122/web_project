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
  <link href="../assets/css/profile.css" rel="stylesheet">
    <title>Motor Yard - Profile</title>
</head>
<body >
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
          <a class="nav-link" href="">Link</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../pages/products.php">Models</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle " href="../pages/filter.php" role="button" data-bs-toggle="dropdown" aria-expanded="false" >
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
         <div class="searchDiv ">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"/>
        <i class="fa-solid fa-magnifying-glass fa-xl searchIcon" style="color: #000000;" type="submit" ></i>
        </div>
      </form>
      <li class="nav-item">
  <i id="cartIcon" class="fa-solid fa-cart-shopping fa-xl"></i>
  <span id="cartCount">0</span>
</li>
      
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
         
          <a href="#" > <i class="fa-solid fa-user fa-lg firstUserIcon " id="logTitle" style="color: #ffffff;"></i></a>
      
    </div>
  </div>
</nav>
<div class="image-form-container smallBody">
   <aside >
    <div>
      <div class="profile-icon" aria-label="User Icon" title="User Profile">
        <i class="fa-solid fa-user fa-sm" id="logTitle" style="color: #ffffffbe;"></i>
      </div>
      <h2>Welcome, CarFan</h2>
      <nav>
        <a class="information">
          <svg viewBox="0 0 24 24"><path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8v-10h-8v10zm0-18v6h8V3h-8z"/></svg>
          Personal.Inf
        </a>
        <a class="cart">
         <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
  <path d="M7 18a2 2 0 100 4 2 2 0 000-4zm10 0a2 2 0 100 4 2 2 0 000-4zM6.31 6l1.2 2.68L9.4 13h8.1a1 1 0 00.93-.64l1.6-4.16A1 1 0 0019.1 6H6.31zM3 4h2l3.6 7.59-1.35 2.44A1 1 0 007.9 17h8.72a1 1 0 00.9-.55L21 8H6"/>
</svg>
          Cart
</a>
        <a class="password">
          <svg viewBox="0 0 24 24"><path d="M20 6h-3V4H7v2H4v14h16V6zm-9 8h-2v-4h2v4zm6-4h-2v4h2v-4z"/></svg>
          Change Password
        </a>
        <a class="Settings">
          <svg viewBox="0 0 24 24"><path d="M12 8a4 4 0 100 8 4 4 0 000-8zm0-6v2.09a8 8 0 014.44 1.76l1.48-1.48 1.41 1.41-1.48 1.48A8 8 0 0120.91 12H23v2h-2.09a8 8 0 01-1.76 4.44l1.48 1.48-1.41 1.41-1.48-1.48A8 8 0 0112 20.91V23h-2v-2.09a8 8 0 01-4.44-1.76l-1.48 1.48-1.41-1.41 1.48-1.48A8 8 0 013.09 14H1v-2h2.09a8 8 0 011.76-4.44L2.36 6.09l1.41-1.41 1.48 1.48A8 8 0 0110 4.09V2h2z"/></svg>
          Settings
        </a>
      </nav>
    </div>
    <div class="logout" role="button" tabindex="0" aria-label="Log out" title="Log Out" onclick="return logout(event)">
      <svg viewBox="0 0 24 24"><path d="M16 13v-2H7V8l-5 4 5 4v-3h9zM20 19h-7v-2h7v-6h-7v-2h7v10z"/></svg>
      Log Out
    </div>
  </aside>
 <img src="../assets/photos/sectionTwo/car1blue.jpg" alt="Profile Background" width="700px" />
   

     
   
    
   <form id="profile-form">

  <!-- Personal Info -->
  <div id="personal-info" class="profile-form active">
    <h1 id="form-title">Your Profile Informations</h1>
    <div class="row">
      <label for="firstName">First name</label>
      <input id="firstName" type="text" placeholder="Name" />
    </div>
    <div class="row">
      <label for="lastName">Last name</label>
      <input id="lastName" type="text" placeholder="Surname" />
    </div>
    <div class="row">
      <label for="username">Username</label>
      <input id="username" type="text" placeholder="Username" />
    </div>
    <div class="row">
      <label for="email">Email</label>
      <input id="email" type="email" placeholder="mail@example.com" />
    </div>
    <div class="row">
      <label for="phone">Phone number</label>
      <input id="phone" type="tel" placeholder="+123 456 789" />
    </div>
    <div class="row">
      <label for="country">Country, City</label>
      <select id="country">
        <option value="usa">USA, New York</option>
        <option value="uk">UK, London</option>
        <option value="germany">Germany, Berlin</option>
        <option value="france">France, Paris</option>
      </select>
    </div>
    <div class="row">
      <label for="organization">Organization</label>
      <input id="organization" type="text" placeholder="Organization name" />
    </div>
    <button type="submit" class="buttonForm">Save</button>
  </div>

  <!-- Cart -->
  <div id="cart-section" class="profile-form">
  </div>

  <!-- Change Password -->
  <div id="password-section" class="profile-form">
    <h1 id="form-title">Change Your Password</h1>
    <div class="row">
      <label for="oldPass">Old Password</label>
      <input id="oldPass" type="password" placeholder="Old Password" />
    </div>
    <div class="row">
      <label for="newPass">New Password</label>
      <input id="newPass" type="password" placeholder="New Password" />
    </div>
    <button type="submit" class="buttonForm">Save</button>
  </div>

  <!-- Settings -->
  <div id="settings-section" class="profile-form">
  <h1>Your Settings</h1>

  <div class="settings-grid">
    <!-- Dark Mode Card -->
    <div class="setting-card">
      <h2>Dark Mode</h2>
      <p>Switch your interface to dark theme</p>
      <div class="toggle-button" id="darkModeToggle"></div>
    </div>

    <!-- Notifications Card -->
    <div class="setting-card">
      <h2>Notifications</h2>
      <p>Enable or disable app notifications</p>
      <div class="toggle-button active" id="notificationsToggle"></div>
    </div>

    <!-- Language Card -->
    <div class="setting-card">
      <h2>Language</h2>
      <p>Choose your preferred language</p>
      <select>
        <option>English</option>
        <option>Arabic</option>
        <option>French</option>
      </select>
    </div>

    <!-- Privacy Card -->
   <div class="setting-card">
      <h2>Theme Color</h2>
      <p>Pick your favorite accent website color</p>
      <input type="color" id="themeColorPicker" value="#970c0c">
    </div>
  </div>
</div>

</form>
</div>
    <script >
      function logout(e){
    e.preventDefault();
    localStorage.removeItem('isLoggedIn');
    window.location.href = '../api/logout.php';
  }

    </script>

    
    <script src="../assets/js/profile.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>
</html>