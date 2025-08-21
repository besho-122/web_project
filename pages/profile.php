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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/izitoast/dist/css/iziToast.min.css">
  <script src="https://cdn.jsdelivr.net/npm/izitoast/dist/js/iziToast.min.js"></script>
  <link href="../assets/css/profile.css" rel="stylesheet">
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

    <title>Motor Yard - Profile</title>
</head>
<body >

<?php session_start();
 require("../api/config.php"); 
 if (!isset($_SESSION['userName'])) {
    header("Location: ../login.php");
    exit;
}

$currentUsername = $_SESSION['userName'];
$user = [
    'userName'     => '',
    'Email'        => '',
    'Password'     => '',
    'FirstName'    => '',
    'LastName'     => '',
    'Phone'        => '',
    'Organization' => '',
    'Country'      => '',
    'role'         => '',
];


if (isset($_POST['saveProfile'])) {
    $firstName    = trim($_POST['firstName'] ?? '');
    $lastName     = trim($_POST['lastName'] ?? '');
    $username     = trim($_POST['userName'] ?? '');
    $email        = trim($_POST['email'] ?? '');
    $phone        = trim($_POST['phone'] ?? '');
    $country      = trim($_POST['country'] ?? '');
    $organization = trim($_POST['organization'] ?? '');

    $stmt = $dp->prepare("
        UPDATE Users
           SET FirstName = ?, LastName = ?, userName = ?, Email = ?, Phone = ?, Country = ?, Organization = ?
         WHERE userName = ?
    ");
    if ($stmt) {
        $stmt->bind_param(
            "ssssssss",
            $firstName, $lastName, $username, $email, $phone, $country, $organization, $currentUsername
        );
   if ($stmt->execute()) {
    $_SESSION['userName'] = $username;
    $currentUsername = $username;
    echo "
    <script>
         iziToast.success({
            title: 'Success',
            message: 'Profile updated successfully!',
            position: 'topRight'
        });
    </script>
    ";
} else {
    echo "  <script>
    iziToast.error({
            title: 'Error',
            message: 'Error updating profile.',
            position: 'topRight'
        });  </script>
    ";
}
$stmt->close();
} else {
    echo "
    <script>
           iziToast.warning({
            title: 'Warning',
            message: 'Failed to prepare statement.',
            position: 'topRight'
        });
    </script>
    ";
}
}
/// pass change 
if (isset($_POST['savePassword'])) {
    $oldPassword = trim($_POST['oldpassword'] ?? '');
    $newPassword = trim($_POST['newpassword'] ?? '');

    $stmt = $dp->prepare("SELECT Password FROM Users WHERE userName = ?");
    $stmt->bind_param("s", $currentUsername);
    $stmt->execute();
    $result = $stmt->get_result();
    $user   = $result->fetch_assoc();
    $stmt->close();

    if ($user && $user['Password'] === $oldPassword) { 
        $stmt = $dp->prepare("UPDATE Users SET Password=? WHERE userName=?");
        $stmt->bind_param("ss", $newPassword, $currentUsername);

        if ($stmt->execute()) {
             echo "  <script>
    iziToast.success({
            title: 'Success',
            message: 'Password updated successfully.',
            position: 'topRight'
        });  </script>    $stmt->close();
    ";
          
        } else {
                echo "  <script>
    iziToast.error({
            title: 'Error',
            message: 'Error updating password.',
            position: 'topRight'
        });  </script>    $stmt->close();
    ";
         
            
        }
    } else {
        echo "
        <script>
               iziToast.warning({
                title: 'Warning',
                message: 'Incorrect old password.',
                position: 'topRight'
            });
        </script>    $stmt->close();
        ";

      
    }
}
/// get item for user 

  $sql = "SELECT * FROM Users WHERE userName = '" . $_SESSION['userName'] . "'";
  $result = $dp->query($sql);

  if ($result && $result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $userName = $row['userName'];
      $email = $row['Email'];
      $password = $row['Password'];
      $firstName = $row['FirstName'];
      $lastName = $row['LastName'];
      $phone = $row['Phone'];
      $organization = $row['Organization'];
      $role = $row['role'];
      $country = $row['Country'] ?? '';
  }

  ?>

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
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" disabled/>
        <i class="fa-solid fa-magnifying-glass fa-xl searchIcon" style="color: #000000;" type="submit" ></i>
        </div>
      </form>
      <li class="nav-item">
   <li class="nav-item"> <i class="fa-solid fa-cart-shopping fa-xl" style="color: #ffffff;"></i><span id="cartCount"></span></li>
</li>
      
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
      <h2>Welcome, <?php echo $userName; ?></h2>
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
   <a class="Orders">
         <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
  <path d="M7 18a2 2 0 100 4 2 2 0 000-4zm10 0a2 2 0 100 4 2 2 0 000-4zM6.31 6l1.2 2.68L9.4 13h8.1a1 1 0 00.93-.64l1.6-4.16A1 1 0 0019.1 6H6.31zM3 4h2l3.6 7.59-1.35 2.44A1 1 0 007.9 17h8.72a1 1 0 00.9-.55L21 8H6"/>
</svg>
          Orders
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
   

     
   
    
   <form id="profile-form"  method="POST">

  <!-- Personal Info -->
  <div id="personal-info" class="profile-form active">
    <h1 id="form-title">Your Profile Informations</h1>
    <div class="row">
      <label for="firstName">First name</label>
      <input id="firstName" type="text" placeholder="Name" name="firstName" value="<?php echo $firstName; ?>" />
    </div>
    <div class="row">
      <label for="lastName">Last name</label>
      <input id="lastName" type="text" placeholder="Surname" name = "lastName" value="<?php echo $lastName; ?>" />
    </div>
    <div class="row">
      <label for="username">Username</label>
      <input id="username" type="text" placeholder="Username"  name="userName" value="<?php echo $userName; ?>" />
    </div>
    <div class="row">
      <label for="email">Email</label>
      <input id="email" type="email" placeholder="mail@example.com" name="email" value="<?php echo $email; ?>" />
    </div>
    <div class="row">
      <label for="phone">Phone number</label>
      <input id="phone" type="tel" placeholder="+123 456 789" name="phone" value="<?php echo $phone; ?>"/>
    </div>
    <div class="row">
      <label for="country">Country, City</label>
<select id="country" name="country">
    <option value="" <?php if ($country == '') echo 'selected'; ?> disabled>-- Select a country --</option>
    <option value="palestine" <?php if ($country == 'usa') echo 'selected'; ?>>Palestine, Nablus</option>
    <option value="uk" <?php if ($country == 'uk') echo 'selected'; ?>>UK, London</option>
    <option value="germany" <?php if ($country == 'germany') echo 'selected'; ?>>Germany, Berlin</option>
    <option value="france" <?php if ($country == 'france') echo 'selected'; ?>>France, Paris</option>
    <option value="spain" <?php if ($country == 'spain') echo 'selected'; ?>>Spain, Madrid</option>
    <option value="italy" <?php if ($country == 'italy') echo 'selected'; ?>>Italy, Rome</option>

</select>
    </div>
    <div class="row">
      <label for="organization">Organization</label>
      <input id="organization" type="text" placeholder="Organization name" name="organization" value="<?php echo $organization; ?>" />
    </div>
    <button type="submit" class="buttonForm" name="saveProfile">Save</button>
  </div>

  <!-- Cart -->
  <div id="cart-section" class="profile-form">
  </div>
  

  <!-- Orders -->
<div id="orders-section" class="profile-form">
  <?php 
   
    $sel = $dp->prepare('SELECT id, ProductId, ProductName, ProductPrice, Status FROM `Order` WHERE userName = ? ORDER BY id DESC');
    $sel->bind_param('s', $userName);
    $sel->execute();
    $res = $sel->get_result();
    $orders = $res->fetch_all(MYSQLI_ASSOC);

    if (count($orders) > 0):
  ?>
    <section class="ordersSection">
      <div class="ordersBox">
        <h1 class="ordersTitle">Orders</h1>
        <div class="ordersWrap">
          <table class="ordersTable">
            <thead class="ordersHead">
              <tr class="ordersRow">
                <th class="ordersCell">Order ID</th>
                <th class="ordersCell">Product ID</th>
                <th class="ordersCell">Product Name</th>
                <th class="ordersCell">Product Price</th>
                <th class="ordersCell">Status</th>
              </tr>
            </thead>
            <tbody class="ordersBody">
              <?php foreach ($orders as $order): ?>
              <tr class="ordersRow">
                <td class="ordersCell"><?php echo htmlspecialchars($order['id']); ?></td>
                <td class="ordersCell"><?php echo htmlspecialchars($order['ProductId']); ?></td>
                <td class="ordersCell"><?php echo htmlspecialchars($order['ProductName']); ?></td>
                <td class="ordersCell"><?php echo htmlspecialchars($order['ProductPrice']); ?></td>
                <td class="ordersCell"><?php echo htmlspecialchars($order['Status']); ?></td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </section>
  <?php else: ?>
    <section class="ordersSection">
      <div class="ordersBox">
        <h1 class="ordersTitle title2">You have no orders yet</h1>
        <script>
const title = document.querySelector(".title2");
title.innerHTML = title.textContent
  .split(" ")
  .map(word => `<span class="word">${word}</span>`)
  .join(" ");
</script>
      </div>
    </section>
  <?php endif; ?>
</div>

  <!-- Change Password -->
  <div id="password-section" class="profile-form">
    <h1 id="form-title">Change Your Password</h1>
    <div class="row">
      <label for="oldPass">Old Password</label>
      <input id="oldPass" type="password" placeholder="Old Password" name="oldpassword" />
    </div>
    <div class="row">
      <label for="newPass">New Password</label>
      <input id="newPass" type="password" placeholder="New Password"  name="newpassword"/>
    </div>
    <button type="submit" class="buttonForm"  name="savePassword" >Save</button>
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
      <h2>Reset Settings</h2>
      <p>Reset all your settings</p>
      <button type="button" class="reset-button" id="resetSettings">Reset</button>
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
  <script>


const colorPicker = document.getElementById('themeColorPicker');
colorPicker.addEventListener('input', function() {
  const color = this.value;
  document.documentElement.style.setProperty('--main-color', color);
  localStorage.setItem('mainColor', color);
});

window.addEventListener('load', function() {
  const savedColor = localStorage.getItem('mainColor');
  if (savedColor) {
    document.documentElement.style.setProperty('--main-color', savedColor);
    colorPicker.value = savedColor; 
  }
});



////////////////////////// reset button //////////

document.addEventListener('DOMContentLoaded', () => {
    const resetBtn = document.getElementById('resetSettings');
    if (!resetBtn) return;

    resetBtn.addEventListener('click', (e) => {
      e.preventDefault(); 
      const defaultColor = '#B80000';
      document.documentElement.style.setProperty('--main-color', defaultColor);
      localStorage.setItem('mainColor', defaultColor);
      const picker = document.getElementById('themeColorPicker');
      picker.value = defaultColor;
      localStorage.setItem('darkMode', 'false');
      document.body.style.background = '#f5f6fa';
      document.body.style.color = '#222';
      const darkToggle = document.getElementById('darkModeToggle');
      if (darkToggle) darkToggle.classList.remove('active');

      if (window.iziToast) {
        iziToast.success({
          title: 'Settings Reset',
          message: 'All settings have been reset to default.',
          position: 'topRight'
        });
      }
    });
  });

//////////////////////
























document.addEventListener('DOMContentLoaded', () => {
  const darkToggle = document.getElementById('darkModeToggle');

  const applyDarkMode = (isDark) => {
    if (isDark) {
      document.body.style.background = '#1e1e1e';
      document.body.style.color = '#eee';
      darkToggle.classList.add('active');
    } else {
      document.body.style.background = '#f5f6fa';
      document.body.style.color = '#222';
      darkToggle.classList.remove('active');
    }
  };
  const savedMode = localStorage.getItem('darkMode');
  if (savedMode === 'true') {
    applyDarkMode(true);
  } else {
    applyDarkMode(false);
  }

  darkToggle.addEventListener('click', () => {
    const isDark = !darkToggle.classList.contains('active');
    localStorage.setItem('darkMode', isDark ? 'true' : 'false');
    applyDarkMode(isDark);
  });
});
</script>
    <script >
      function logout(e){
    e.preventDefault();
    localStorage.removeItem('isLoggedIn');
    window.location.href = '../api/logout.php';
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












<!-- /////// notification -->
<script>
document.addEventListener('DOMContentLoaded', () => {
  const notifToggle = document.getElementById('notificationsToggle');
  if (!notifToggle) return;

  const applyNotif = (on) => {
    if (on) notifToggle.classList.add('active');
    else    notifToggle.classList.remove('active');
  };

  const initialStr = (notifToggle.getAttribute('data-value') || 'No');
  let isOn = initialStr === 'Yes';
  applyNotif(isOn);
  notifToggle.addEventListener('click', async () => {
    const next = !isOn;
    const nextStr = next ? 'Yes' : 'No';
    applyNotif(next);
    try {
      const res = await fetch('../api/updatenotification.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ value: nextStr })
      });
      const data = await res.json();
      if (!data.success) throw new Error(data.message || 'Failed');
      isOn = next;
      notifToggle.setAttribute('data-value', nextStr);

      window.iziToast && iziToast.success({
        title: 'Saved',
        message: 'Notification preference updated.',
        position: 'topRight'
      });
    } catch (err) {
      applyNotif(isOn);
      window.iziToast && iziToast.error({
        title: 'Error',
        message: err.message || 'Could not update notifications.',
        position: 'topRight'
      });
    }
  });
});
</script>














    
    <script src="../assets/js/profile.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>
</html>