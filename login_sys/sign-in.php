<?php
require_once '../functions/functions.php';
session_start();

// Cek cookie
if (isset($_COOKIE['uniq']) && isset($_COOKIE['key'])) {
  $uniq = $_COOKIE['uniq'];
  $key = $_COOKIE['key'];

  // Select username berdasarkan id uniq
  $result = mysqli_query($link, "SELECT username FROM users WHERE id = $uniq");

  // Cek username dengan id uniq
  if (mysqli_num_rows($result) === 1) {
    $row = mysqli_fetch_assoc($result);

    // Cocokkan cookie key dan username dari db
    if ($key === hash('gost', $row['username'])) {
      $_SESSION['login'] = true;
    }
  }
}

// Cek session
if (isset($_SESSION['login'])) {
  header('Location: ../admin_page/index.php');
  exit;
}

// Validasi login
if (isset($_POST['signin'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $result = mysqli_query($link, "SELECT * FROM users WHERE username = '$username'");

  // Cek username
  if (mysqli_num_rows($result) === 1) {
    $row = mysqli_fetch_assoc($result);

    // Cek password
    if (password_verify($password, $row['password'])) {
      // Set session
      $_SESSION['login'] = true;

      // Cek remember me & set cookie
      if (isset($_POST['remember-me'])) {
        setcookie('uniq', $row['id'], time() + 120, '/');
        setcookie('key', hash('gost', $row['username']), time() + 120, '/');
      }

      header('Location: ../admin_page/index.php');
      exit;
    }
  }

  $error = true;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Sign In Page</title>

  <!-- Font Icon -->
  <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

  <!-- Favicon -->
  <link rel="shortcut icon" href="https://demo.learncodeweb.com/favicon.ico">

  <!-- Main css -->
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <!-- Sing in  Form -->
  <section class="sign-in">
    <div class="container">
      <div class="signin-content">
        <div class="signin-image">
          <figure><img src="images/signin-image.jpg" alt="sing up image"></figure>
          <a href="sign-up.php" class="signup-image-link">Create an account</a>
        </div>

        <div class="signin-form">
          <h2 class="form-title">Sign In</h2>
          <form method="POST" class="register-form" id="login-form">
            <div class="form-group">
              <label for="username"><i class="zmdi zmdi-account material-icons-name"></i></label>
              <input type="text" name="username" id="username" maxlength="15" placeholder="Username" autofocus required />
            </div>
            <div class="form-group">
              <label for="password"><i class="zmdi zmdi-lock"></i></label>
              <input type="password" name="password" id="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" placeholder="Password" required />
            </div>
            <div class="form-group">
              <input type="checkbox" name="remember-me" id="remember-me" class="agree-term" />
              <label for="remember-me" class="label-agree-term"><span><span></span></span>Remember me</label>
            </div>

            <?php if (isset($error)) { ?>
              <p style="color: red; font-size: 13px;">Invalid Username or Password</p>
            <?php } ?>

            <div class="form-group form-button">
              <input type="submit" name="signin" id="signin" class="form-submit" value="Log in" />
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

  <!-- JS -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="js/main.js"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>