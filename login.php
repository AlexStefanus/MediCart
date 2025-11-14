<?php

$title = 'Login - MediCart';

session_start();
require 'connect.php';

// SET COOKIE
if (isset($_COOKIE['username']) && isset($_COOKIE['key'])) {
  $username = $_COOKIE['username'];
  $key = $_COOKIE['key'];

  $result = mysqli_query($connect, "SELECT username FROM customer WHERE username = '$username'");
  $row = mysqli_fetch_assoc($result);

  if ($key === hash('sha256', $row['username'])) {
    $_SESSION['login'] = true;
  }
}

// SET SESSION DAN REDIRECT LOGIN
if (isset($_SESSION["login"])) {
  header("Location: index.php");
  exit;
}

$errorMessage = ""; // Variabel untuk menyimpan pesan error

if (isset($_POST["login"])) {
  $username = $_POST["username"];
  $password = $_POST["password"];

  // Cek di tabel admin terlebih dahulu
  $adminResult = mysqli_query($connect, "SELECT * FROM admin WHERE username = '$username'");
  
  if (mysqli_num_rows($adminResult) === 1) {
    // Login sebagai admin
    $row = mysqli_fetch_assoc($adminResult);
    if (password_verify($password, $row["password"])) {
      $_SESSION['username'] = $row["username"];
      $_SESSION["login"] = true;
      $_SESSION["user_type"] = "admin";

      if (isset($_POST['remember'])) {
        setcookie('username', $row['username'], time() + 60);
        setcookie('key', hash('sha256', $row['username']));
      }
      header("Location: Admin/dashboard.php");
      exit;
    } else {
      $errorMessage = "Username / Password salah!";
    }
  } else {
    // Cek di tabel customer
    $customerResult = mysqli_query($connect, "SELECT * FROM customer WHERE username = '$username'");
    
    if (mysqli_num_rows($customerResult) === 1) {
      // Login sebagai customer
      $row = mysqli_fetch_assoc($customerResult);
      if (password_verify($password, $row["password"])) {
        $_SESSION['username'] = $row["username"];
        $_SESSION["login"] = true;
        $_SESSION["user_type"] = "customer";

        if (isset($_POST['remember'])) {
          setcookie('username', $row['username'], time() + 60);
          setcookie('key', hash('sha256', $row['username']));
        }
        header("Location: Customer/produkCust.php");
        exit;
      } else {
        $errorMessage = "Username / Password salah!";
      }
    } else {
      $errorMessage = "Username / Password salah!";
    }
  }
}

?>

<!DOCTYPE html>
<html
  lang="en"
  class="light-style customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="Asset_Admin/assets/"
  data-template="vertical-menu-template-free">

<head>
  <meta charset="utf-8" />
  <meta
    name="viewport"
    content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title><?= $title; ?></title>

  <meta name="description" content="" />

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="Asset_Admin/assets/img/favicon/favicon.ico" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
    rel="stylesheet" />

  <!-- Icons. Uncomment required icon fonts -->
  <link rel="stylesheet" href="Asset_Admin/assets/vendor/fonts/boxicons.css" />

  <!-- Core CSS -->
  <link rel="stylesheet" href="Asset_Admin/assets/vendor/css/core.css" class="template-customizer-core-css" />
  <link rel="stylesheet" href="Asset_Admin/assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="Asset_Admin/assets/css/demo.css" />

  <!-- Vendors CSS -->
  <link rel="stylesheet" href="Asset_Admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

  <!-- Page CSS -->
  <!-- Page -->
  <link rel="stylesheet" href="Asset_Admin/assets/vendor/css/pages/page-auth.css" />

  <!-- Helpers -->
  <script src="Asset_Admin/assets/vendor/js/helpers.js"></script>

  <!-- Config -->
  <script src="Asset_Admin/assets/js/config.js"></script>
</head>

<body>


  <!-- Content -->
  <div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
      <div class="authentication-inner">
        <!-- Register -->
        <div class="card">
          <div class="card-body">
            <!-- Logo -->
            <div class="app-brand justify-content-center">
              <a href="" class="app-brand-link gap-2">
                <span class="app-brand-logo demo">
                  <img src="img/logo1.png" alt="" style="max-width: 60px;">
                </span>
                <span class="app-brand-text demo text-body fw-bolder" style="text-transform: capitalize;">MediCart</span>
              </a>
            </div>
            <!-- /Logo -->
            <h4 class="mb-2">Selamat Datang Di MediCart!</h4>
            <p class="mb-4">Please sign-in to your account and start the adventure</p>

            <form id="formAuthentication" class="mb-3" method="POST">
              <div class="mb-3">
                <label for="yourUsername" class="form-label">Username</label>
                <input
                  type="text"
                  class="form-control"
                  id="yourUsername"
                  name="username"
                  placeholder="Enter your username"
                  autofocus
                  required />
              </div>
              <div class="mb-3 form-password-toggle">
                <div class="d-flex justify-content-between">
                  <label class="form-label" for="yourPassword">Password</label>
                </div>
                <div class="input-group input-group-merge">
                  <input
                    type="password"
                    id="yourPassword"
                    class="form-control"
                    name="password"
                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                    aria-describedby="password"
                    required />
                  <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                </div>
              </div>


              <div class="mb-3">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="remember-me" />
                  <label class="form-check-label" for="remember-me"> Remember Me </label>
                </div>
              </div>
              <div class="mb-3">
                <button class="btn btn-primary d-grid w-100" type="submit" name="login">Sign in</button>
              </div>
            </form>

            <p class="text-center" style="margin: 0;">
              <span>New on our platform?</span>
              <a href="registrasi.php">
                <span>Create an account</span>
              </a>
            </p>

          </div>
        </div>
        <!-- /Register -->
      </div>
    </div>
  </div>

  <!-- / Content -->

  <!-- Modal untuk menampilkan pesan error -->
  <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="errorModalLabel">
            <i class="bi bi-exclamation-triangle-fill text-danger"></i> Warning
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="errorMessage">
          <?php if (!empty($errorMessage)) : ?>
            <?= $errorMessage; ?>
          <?php endif; ?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap Icons CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <!-- Core JS -->
  <!-- build:js assets/vendor/js/core.js -->
  <script src="Asset_Admin/assets/vendor/libs/jquery/jquery.js"></script>
  <script src="Asset_Admin/assets/vendor/libs/popper/popper.js"></script>
  <script src="Asset_Admin/assets/vendor/js/bootstrap.js"></script>
  <script src="Asset_Admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

  <script src="Asset_Admin/assets/vendor/js/menu.js"></script>
  <!-- endbuild -->

  <!-- Vendors JS -->

  <!-- Main JS -->
  <script src="Asset_Admin/assets/js/main.js"></script>

  <!-- Page JS -->

  <!-- Place this tag in your head or just before your close body tag. -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>

  <script>
    // Menampilkan modal jika ada pesan error
    <?php if (!empty($errorMessage)) : ?>
      $(document).ready(function() {
        $('#errorModal').modal('show');
      });
    <?php endif; ?>
  </script>
</body>

</html>