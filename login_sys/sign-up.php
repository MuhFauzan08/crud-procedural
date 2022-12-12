<?php
require_once '../functions/functions.php';

if (isset($_POST['signup'])) {
  if (register($_POST) > 0) {
    echo
    "<script>
      alert('User berhasil ditambahkan!');
      document.location.href = 'sign-in.php';
    </script>";
  } else {
    echo
    "<script>
      alert('User gagal ditambahkan!');
    </script>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Sign Up Page</title>

  <!-- Font Icon -->
  <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

  <!-- Favicon -->
  <link rel="shortcut icon" href="https://demo.learncodeweb.com/favicon.ico">

  <!-- Main css -->
  <link rel="stylesheet" href="css/style.css">
</head>

<body>

  <!-- Sign up form -->
  <section class="signup">
    <div class="container">
      <div class="signup-content">
        <div class="signup-form">
          <h2 class="form-title">Sign Up</h2>
          <form method="POST" class="register-form" id="register-form">
            <div class="form-group">
              <label for="username"><i class="zmdi zmdi-account material-icons-name"></i></label>
              <input type="text" name="username" id="username" placeholder="Username" maxlength="15" autofocus required />
            </div>
            <div class="form-group">
              <label for="password"><i class="zmdi zmdi-lock"></i></label>
              <input type="password" name="password" id="password" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required />
            </div>
            <div class="form-group">
              <label for="re_password"><i class="zmdi zmdi-lock-outline"></i></label>
              <input type="password" name="re_password" id="re_password" placeholder="Repeat your password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required />
            </div>
            <div class="form-group">
              <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" required />
              <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all statements in <a href="#" class="term-service">Terms of service</a></label>
            </div>
            <div class="form-group form-button">
              <input type="submit" name="signup" id="signup" class="form-submit" value="Register" />
            </div>
          </form>
        </div>
        <div class="signup-image">
          <figure><img src="images/signup-image.jpg" alt="sing up image"></figure>
          <a href="sign-in.php" class="signup-image-link">I am already member</a>
        </div>
      </div>
    </div>
  </section>

  <!-- JS -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="js/main.js"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>