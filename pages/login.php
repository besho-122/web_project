<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login / Signup Form</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Audiowide&family=Bangers&family=Berkshire+Swash&family=Lobster&family=Molle&family=Orbitron:wght@400..900&family=Pacifico&family=Playwrite+DK+Uloopet:wght@100..400&family=Righteous&family=Ruslan+Display&family=Unbounded:wght@200..900&family=Warnes&display=swap" rel="stylesheet">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/izitoast/dist/css/iziToast.min.css">
  <script src="https://cdn.jsdelivr.net/npm/izitoast/dist/js/iziToast.min.js"></script>
<link href="../assets/css/login.css" rel="stylesheet">
</head>
<body>
    <div class="container" id="container">
      <div class="form-container sign-up">
        <form id="signUpForm" action="../api/signup.php" method="post">
          <h1 class="headCeate">Create Account</h1>
          <div class="social-icons">
            <a href="javascript:void(0)" id="googleBtn" class="icon" type="button"
              ><i class="fa-brands fa-google-plus-g"></i
            ></a>
            <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
            <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
            <a href="#" class="icon"
              ><i class="fa-brands fa-linkedin-in"></i
            ></a>
          </div>
          <span>or use your email for registeration</span>
          <input type="text" name="nameCreate" placeholder="Name" />
          <input type="email" name="emailCreate" placeholder="Email" />
          <input type="password" name="passwordCreate" placeholder="Password" />
          <button>Sign Up</button>
        </form>
      </div>
      <div class="form-container sign-in">
        <form id="signInForm" action="../api/signin.php" method="post">
          <h1>Sign In</h1>
          <div class="social-icons">
            <a href="#" class="icon"
              ><i class="fa-brands fa-google-plus-g"></i
            ></a>
            <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
            <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
            <a href="#" class="icon"
              ><i class="fa-brands fa-linkedin-in"></i
            ></a>
          </div>
          <span>or use your email password</span>
          <input type="email"   name="emailLogin" placeholder="Email" />
          <input type="password" name="passwordLogin" placeholder="Password" />
          <a href="#" onclick="forgetPassword()">Forget Your Password?</a>
          <button>Sign In</button>
        </form>
      </div>
      <div class="toggle-container">
        <div class="toggle">
          <div class="toggle-panel toggle-left">
            <h1>Welcome Back!</h1>
            <p>Enter your personal details to use all of site features</p>
            <button class="hidden" id="login">Sign In</button>
          </div>
          <div class="toggle-panel toggle-right">

            <h1>Hello, Friend!</h1>
            <p>
              Register with your personal details to use all of site features
            </p>
            <button class="hidden" id="register">Sign Up</button>
          </div>
        </div>
      </div>
    </div>
    

    <section class="homePageContactSection" id="contactSection">
    <h2 class="followUs">Follow US</h2>
    <div class="containerContact">
    <div class="card">
  <div class="image">
    <img src="../assets/photos/yousef.jpg" alt="Profile Photo">
  </div>
  <div class="link">
    <a class="icon-circle icon1" href="https://www.facebook.com/yousef.hajeer.3"><i class="fa-brands fa-facebook"></i></a>
    <a class="icon-circle icon2" href="https://x.com/yousefh2004"><i class="fa-brands fa-twitter"></i></a>
    <a class="icon-circle icon3" href="https://www.instagram.com/yousefh2004.n/?__pwa=1"><i class="fa-brands fa-instagram"></i></a>
  </div>
</div>


<div class="card">
  <div class="image">
    <img src="../assets/photos/besho.jpg" alt="Profile Photo">
  </div>
  <div class="link">
    <a class="icon-circle icon1" href="https://www.facebook.com/MOMO38322"><i class="fa-brands fa-facebook"></i></a>
    <a class="icon-circle icon2" href="https://www.instagram.com/mohammad_n_bish/?__pwa=1"><i class="fa-brands fa-twitter"></i></a>
    <a class="icon-circle icon3" href="https://www.instagram.com/mohammad_n_bish/?__pwa=1"><i class="fa-brands fa-instagram"></i></a>
  </div>
</div>

    </div>

    <!-- Footer -->
    <footer class="footer">
      <p>© 2025 Porsche Middle East and Africa FZE. Legal Notice.Privacy Policy.Open Source Software Notice.Whistleblower System.</p>
      <a href="../index.php"><img src="../assets/photos/title.png" id="mainTitle" alt="" width="200px"></a>
    </footer>
  </section>






<script type="text/javascript"
        src="https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js">
</script>


<script>
  (function(){
    emailjs.init({ publicKey: "ApeL9b3oz5PynbXsm" });
  })();
</script>




<script>
function forgetPassword() {
  const email = document.querySelector('input[name="emailLogin"]')?.value.trim() || "";
  if (!email) {
    iziToast.error({ title: 'Error', message: 'Please enter your email address.', position: 'topRight' });
    return;
  }
  passcode = Math.floor(Math.random() * 1000000);
  sessionStorage.setItem('resetEmail', email);
  emailjs.send("service_ohhju66","template_zaqhu6b",{
  passcode: passcode,
  email: email,
});
 sessionStorage.setItem('resetEmail', email);
 sessionStorage.setItem('otp', passcode);
  window.location.href = '../pages/code.php?email=' + encodeURIComponent(email);
}

// google
  


  
</script>

  
<!-- Firebase App + Auth SDK -->
<!-- Firebase Classic (Compat) -->
<script src="https://www.gstatic.com/firebasejs/9.23.0/firebase-app-compat.js"></script>
<script src="https://www.gstatic.com/firebasejs/9.23.0/firebase-auth-compat.js"></script>

<script>
  const firebaseConfig = {
    apiKey: "AIzaSyAi0zXMAMmNo7goaD0SMoL69Y7mNoH2qjY",
    authDomain: "motor-yard.firebaseapp.com",
    projectId: "motor-yard",
    storageBucket: "motor-yard.firebasestorage.app",
     messagingSenderId: "1075442899321",
     appId: "1:1075442899321:web:300a4cbf75d0310612b7a8"
  };

  firebase.initializeApp(firebaseConfig);
  const auth = firebase.auth();


 function sendToBackend(user) {
  console.log("Firebase user:", user); // للتحقق من البيانات في الكونسول

  fetch('../api/signup.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
    body: new URLSearchParams({
      userName: user.displayName || "NoName",  // تطابق عمود userName في DB
      Email: user.email || "noemail@firebase.com",                        // تطابق عمود email في DB
      Password: user.uid                         // تطابق عمود Password في DB
    })
  })
  .then(res => res.text())
  .then(data => {
    console.log("PHP Response:", data);       // عرض الرد من PHP
    alert("تم التسجيل بنجاح! سيتم تحويلك إلى صفحة تسجيل الدخول.");
    window.location.href = "../pages/login.php";
  })
  .catch(err => {
    console.error(err);
    alert("حدث خطأ أثناء التسجيل. حاول مرة أخرى.");
  });
}



    // Google login
    document.getElementById('googleBtn').addEventListener('click', () => {
      const provider = new firebase.auth.GoogleAuthProvider();
      auth.signInWithPopup(provider)
        .then(result => sendToBackend(result.user))
        .catch(console.error);
    });

</script>
<script src="../assets/js/login.js"></script>
</body>
</html>