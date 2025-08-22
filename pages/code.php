<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Enter Verification Code</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #000;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      color: white;
      margin: 0;
    }
    .code-container {
      background: rgba(255, 255, 255, 0.05);
      padding: 30px 40px;
      border-radius: 15px;
      text-align: center;
      backdrop-filter: blur(10px);
    }
    h2 {
      margin-bottom: 20px;
      font-size: 24px;
      letter-spacing: 1px;
    }
    .code-inputs {
      display: flex;
      justify-content: center;
      gap: 15px;
      margin-bottom: 25px;
    }
    .code-inputs input {
      width: 50px;
      height: 60px;
      font-size: 26px;
      text-align: center;
      border: none;
      border-radius: 10px;
      background: rgba(255,255,255,0.1);
      color: white;
      outline: none;
      transition: all 0.2s ease-in-out;
    }
    .code-inputs input:focus {
      background: rgba(155, 5, 5, 0.2);
      box-shadow: 0 0 10px rgba(255, 0, 0, 0.45);
    }
    .buttons {
      display: flex;
      justify-content: center;
      gap: 15px;
    }
    button {
      padding: 10px 25px;
      font-size: 16px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      transition: all 0.3s ease;
    }
    .btn-submit {
      background-color:  rgba(155, 5, 5, 1);
      color: #ffffffff;
      font-weight: bold;
    }
    .btn-submit:hover {
      background-color:  rgba(104, 1, 1, 1);
    }
    .btn-cancel {
      background-color: #eeeeee;
      color: #000000;
      font-weight: bold;
    }
    .btn-cancel:hover {
      background-color:  #eeeeeeb0;;
    }
  </style>
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/izitoast/dist/css/iziToast.min.css">
 <script src="https://cdn.jsdelivr.net/npm/izitoast/dist/js/iziToast.min.js"></script>

  </head>
<body>

  <div class="code-container">
    <h2>Enter the Verification Code</h2>
    <div class="code-inputs">
      <input type="text" maxlength="1" />
      <input type="text" maxlength="1" />
      <input type="text" maxlength="1" />
      <input type="text" maxlength="1" />
      <input type="text" maxlength="1" />
      <input type="text" maxlength="1" />
    </div>
    <div class="buttons">
      <button class="btn-submit" onclick="submitCode()">Submit</button>
      <a href="../pages/login.php"><button class="btn-cancel">Cancel</button></a>
    </div>
  </div>

<script type="text/javascript"
        src="https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js">
</script>

<script>
  (function(){
    emailjs.init({ publicKey: "YRHV_6c89sUTJv5FF" });
  })();
</script>

<script>
async function submitCode() {
  const urlParams = new URLSearchParams(window.location.search);
  const email = urlParams.get('email')?.trim() || "";
  if (!email) {
    iziToast.error({ title: 'Error', message: 'Email not found in URL.', position: 'topRight' });
    return;
  }


  const inputs = document.querySelectorAll('.code-inputs input');
  let entered = '';
  inputs.forEach(i => entered += (i.value || ''));
  if (entered.length !== 6) {
    iziToast.error({ title: 'Error', message: 'Please enter the 6-digit code.', position: 'topRight' });
    return;
  }

  const expected = sessionStorage.getItem('otp') || '';
  if (entered !== expected) {
    iziToast.error({ title: 'Error', message: 'Invalid verification code.', position: 'topRight' });
    return;
  }

  try {
    const formData = new FormData();
    formData.append('email', email);

    const res = await fetch('../api/sendEmail.php', { method: 'POST', body: formData });
    const text = await res.text();

    if (text === 'NOT_FOUND') {
      iziToast.error({ title: 'Error', message: 'Email not found.', position: 'topRight' });
      return;
    }

    let data;
    try {
      data = JSON.parse(text);
    } catch {
      iziToast.error({ title: 'Error', message: 'Invalid server response.', position: 'topRight' });
      return;
    }

    const templateParams = {
      user_name: data.userName,
      password: data.password,
      email: email
    };

    await emailjs.send("service_ohhju66","template_4cn0cjn", templateParams);

    iziToast.success({
      title: 'Account Found',
      message: `We sent an email to ${email} with your password.`,
      position: 'topRight'
    });
     setTimeout(() => {
      window.location.href = '../pages/login.php';
    }, 3000);
    sessionStorage.removeItem('resetEmail');
    sessionStorage.removeItem('otp');

  } catch (err) {
    console.error(err);
    iziToast.error({ title: 'Error', message: 'Something went wrong. Please try again.', position: 'topRight' });
  }
}
</script>




<script>
 const urlParams = new URLSearchParams(window.location.search);
  const email = urlParams.get('email')?.trim() || "";
  window.addEventListener('DOMContentLoaded', () => {
    if (email) {
      iziToast.info({
        title: 'Info',
        message: `We sent a verification code to ${email}.`,
        position: 'topRight'
      });
    } else {
      iziToast.error({
        title: 'Error',
        message: 'Email not found in URL.',
        position: 'topRight'
      });
    }
  });
  </script>














  <script>
    const inputs = document.querySelectorAll('.code-inputs input');

    inputs.forEach((input, index) => {
      input.addEventListener('input', () => {
        if (input.value && index < inputs.length - 1) {
          inputs[index + 1].focus();
        }
      });
      input.addEventListener('keydown', (e) => {
        if (e.key === 'Backspace' && !input.value && index > 0) {
          inputs[index - 1].focus();
        }
      });
    });
  </script>


</body>
</html>
