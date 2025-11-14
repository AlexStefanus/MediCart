<?php

$title = 'Registrasi';

require 'connect.php';

$errorMessage = "";
$successMessage = "";

if (isset($_POST["submit"])) {
    if (registrasi($_POST) > 0) {
        $successMessage = "User  baru berhasil ditambahkan";
    } else {
        $errorMessage = "User  baru gagal ditambahkan";
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
                <!-- Register Card -->
                <div class="card">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center">
                            <a href="index.html" class="app-brand-link gap-2">
                                <span class="app-brand-logo demo">
                                    <img src="img/logo1.png" alt="" style="max-width: 60px;">
                                </span>
                                <span class="app-brand-text demo text-body fw-bolder" style="text-transform: capitalize;">MediCart</span>
                            </a>
                        </div>
                        <!-- /Logo -->
                        <h4 class="mb-2">Form Registrasi</h4>
                        <p class="mb-4">Make your Account! 🚀</p>

                        <form id="formAuthentication" class="mb-3" method="POST">
                            <!--Username-->
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
                            <!--Password-->
                            <div class="mb-3 form-password-toggle">
                                <label class="form-label" for="yourPassword">Password</label>
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
                            <!-- Retype Password -->
                            <div class="mb-3 form-password-toggle">
                                <label class="form-label" for="yourPassword">Retype Password</label>
                                <div class="input-group input-group-merge">
                                    <input
                                        type="password"
                                        id="yourPassword"
                                        class="form-control"
                                        name="password2"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                        aria-describedby="password"
                                        required />
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                            </div>
                            <!--Name-->
                            <div class="mb-3">
                                <label for="yourName" class="form-label">Name</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="yourName"
                                    name="namaLengkap"
                                    placeholder="Enter your name"
                                    autofocus
                                    required />
                            </div>
                            <!--Email-->
                            <div class="mb-3">
                                <label for="yourEmail" class="form-label">Email</label>
                                <input type="email" class="form-control" id="yourEmail" name="email" placeholder="Enter your email" required>
                            </div>
                            <!-- Date of Birth -->
                            <div class="mb-3">
                                <label class="form-label" for="dob">Date of Birth</label>
                                <input type="date" class="form-control" id="dob" name="dob" required>
                            </div>
                            <!-- Gender -->
                            <div class="mb-3">
                                <label class="form-label" for="gender">Gender</label>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input
                                            class="form-check-input"
                                            type="radio"
                                            name="gender"
                                            id="gender"
                                            value="male"
                                            required />
                                        <label class="form-check-label" for="male">Male</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input
                                            class="form-check-input"
                                            type="radio"
                                            name="gender"
                                            id="gender"
                                            value="female"
                                            required />
                                        <label class="form-check-label" for="female">Female</label>
                                    </div>
                                </div>
                            </div>
                            <!-- Address -->
                            <div class="mb-3">
                                <label class="form-label" for="alamat">Address</label>
                                <textarea class="form-control" id="alamat" name="alamat" rows="2" placeholder="Enter your address"></textarea>
                            </div>
                            <!-- City -->
                            <div class="mb-3">
                                <label class="form-label" for="kota">City</label>
                                <input type="text" class="form-control" id="kota" name="kota" placeholder="Enter your city" />
                            </div>
                            <!-- Contact No -->
                            <div class="mb-3">
                                <label class="form-label" for="contact">Contact No</label>
                                <input type="text" class="form-control" id="contact" name="contact" placeholder="Enter your contact number" />
                            </div>
                            <!-- PayPal ID -->
                            <div class="mb-3">
                                <label class="form-label" for="paypalID">PayPal ID</label>
                                <input type="number" class="form-control" id="paypalID" name="paypalID" placeholder="Enter your PayPal ID" />
                            </div>

                            <!-- Buttons -->
                            <div class="d-flex justify-content-between">
                                <button type="submit" class="btn btn-primary  w-50 me-2" name="submit">Sign up</button>
                                <button type="reset" class="btn btn-secondary w-50">Clear</button>
                            </div>
                        </form>

                        <p class="text-center" style="margin: 0;">
                            <span>Already have an account?</span>
                            <a href="login.php">
                                <span>Sign in instead</span>
                            </a>
                        </p>
                    </div>
                </div>
                <!-- Register Card -->
            </div>
        </div>
    </div>
    <!-- / Content -->

    <!-- Modal untuk menampilkan pesan sukses -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">
                        <i class="bi bi-check-circle-fill text-success"></i> Sukses
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?= $successMessage; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal untuk menampilkan pesan error -->
    <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="errorModalLabel">
                        <i class="bi bi-exclamation-triangle-fill text-danger"></i> Peringatan
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?= $errorMessage; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
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
        // Menampilkan modal jika ada pesan sukses
        <?php if (!empty($successMessage)) : ?>
            $(document).ready(function() {
                $('#successModal').modal('show');
            });
        <?php endif; ?>

        // Menampilkan modal jika ada pesan error
        <?php if (!empty($errorMessage)) : ?>
            $(document).ready(function() {
                $('#errorModal').modal('show');
            });
        <?php endif; ?>
    </script>

</body>

</html>