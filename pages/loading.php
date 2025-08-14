<?php
session_start();
$action = $_GET['action'] ?? 'login';
$status = $_GET['status'] ?? 'success';
$next   = $_GET['next'] ?? '../index.php';
if ($action === 'signup') {
    $title   = ($status === 'success') ? 'Account created successfully' : 'Account creation failed';
    $message = ($status === 'success')
        ? 'You will be redirected to the home page in 2 sec'
        : 'An error occurred while creating your account. You will be redirected in 2 sec';
} else { 
    $title   = ($status === 'success') ? 'Signed in successfully' : 'Login failed';
    $message = ($status === 'success')
        ? 'You will be redirected to your page in 2 sec'
        : 'Invalid email or password. You will be redirected in 2 sec';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Loading…</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>

  <style>
    :root { --bg:#111; --card:#1a1a1a; --text:#fff; --muted:#bdbdbd; --ok:#22c55e; --err:#ef4444; }
    *{box-sizing:border-box}
    body{
      margin:0; height:100vh; display:grid; place-items:center;
      background:var(--bg); color:var(--text); font-family:system-ui, Arial, sans-serif;
    }
    .wrap{ width:min(92vw, 440px); }
    .brand{
      display:flex; align-items:center; justify-content:center;
      margin-bottom:16px; padding:8px 0;
    }
    .brand img{ height:42px; width:auto; display:block; }
    .card{
      background:var(--card);
      border:1px solid #2a2a2a;
      border-radius:14px;
      padding:22px;
    }
    .title{ font-size:18px; font-weight:700; margin:0 0 4px; }
    .muted{ color:var(--muted); margin:0 0 14px; font-size:14px; }
    .bar{ height:8px; background:#232323; border-radius:999px; overflow:hidden; border:1px solid #2a2a2a; }
    .bar > span{
      display:block; height:100%; width:0%;
      background:linear-gradient(90deg, <?= $status === 'success' ? '#22c55e,#4ade80' : '#ef4444,#f87171' ?>);
      animation:fill 2s linear forwards;
    }
    @keyframes fill{ to{ width:100%; } }
    .swiper{ width:100%; }
    .swiper-slide{ display:flex; }
  </style>
</head>
<body>

  <div class="wrap">
    <div class="brand">
      <img src="../assets/photos/title.png" style="width: 200px; height: auto;" alt="Motor Yard Logo">
    </div>

    <div class="swiper">
      <div class="swiper-wrapper">
        <div class="swiper-slide">
          <div class="card" style="width:100%">
            <h3 class="title"><?= htmlspecialchars($title) ?></h3>
            <p class="muted"><?= htmlspecialchars($message) ?></p>
            <div class="bar"><span></span></div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script type="module">
    import Swiper from 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.mjs';
    const next = <?= json_encode($next) ?>;
    new Swiper('.swiper', {
      allowTouchMove: false,
      effect: 'fade',
      speed: 400
    });
    setTimeout(() => { window.location.href = next; }, 2000);
  </script>

  <noscript><meta http-equiv="refresh" content="2;url=<?= htmlspecialchars($next) ?>"></noscript>
</body>
</html>
