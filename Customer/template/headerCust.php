<?php

session_start();

//cek apakah username ada di database customer
$userLogin = $_SESSION["username"];
$namaLengkap = query("SELECT namaLengkap FROM customer WHERE username = '$userLogin'")[0]["namaLengkap"];
$checkLogin = query("SELECT username FROM customer WHERE username = '$userLogin'");

if (count($checkLogin) === 0) {
    header("Location: ../logout.php");
    exit;
}

// cek login
if (!isset($_SESSION["login"]) && $checkLogin > 0) {
    header("Location: ../login.php");
    exit;
}

?>

<!DOCTYPE html>
<html
    lang="en"
    class="light-style layout-menu-fixed"
    dir="ltr"
    data-theme="theme-default"
    data-assets-path="../Asset_Admin/assets/"
    data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title><?= $title; ?></title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../Asset_Admin/assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="../Asset_Admin/assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="../Asset_Admin/assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../Asset_Admin/assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../Asset_Admin/assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../Asset_Admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <link rel="stylesheet" href="../Asset_Admin/assets/vendor/libs/apex-charts/apex-charts.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="../Asset_Admin/assets/vendor/js/helpers.js"></script>

    <!-- Config -->
    <script src="../Asset_Admin/assets/js/config.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.25/dist/sweetalert2.min.css" rel="stylesheet">

    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.25/dist/sweetalert2.all.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>

<body>
    <!-- TOP NAVIGATION BAR -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom fixed-top" style="z-index: 1050; padding: 0.5rem 1rem;">
        <div class="container-fluid">
            <!-- Logo -->
            <a class="navbar-brand d-flex align-items-center" href="produkCust.php" style="margin-right: 2rem;">
                <img src="../img/logo1.png" alt="MediCart" style="height: 40px; margin-right: 0.5rem;">
                <span class="fw-bold" style="color: #696bff; font-size: 1.25rem;">MediCart</span>
            </a>

            <!-- Search Bar (Center) -->
            <div class="flex-grow-1 mx-4" style="max-width: 500px;">
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0">
                        <i class="bx bx-search" style="color: #696bff;"></i>
                    </span>
                    <input
                        type="text"
                        class="form-control border-start-0 bg-light"
                        placeholder="Search products..."
                        id="searchingTable"
                        style="border-color: #e3e6f0;">
                </div>
            </div>

            <!-- Right Side Icons -->
            <div class="d-flex align-items-center">
                <!-- Shopping Cart -->
                <a href="viewKeranjang.php" class="nav-link me-3">
                    <i class="fas fa-shopping-cart fa-lg" style="color: #696bff;"></i>
                </a>

                <!-- Orders -->
                <a href="viewTransaksi.php" class="nav-link me-3">
                    <i class="fas fa-clipboard-list fa-lg" style="color: #696bff;"></i>
                </a>

                <!-- User Account -->
                <div class="dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user-circle fa-lg me-1" style="color: #696bff;"></i>
                        <span class="d-none d-md-inline" style="color: #696bff;"><?= $userLogin; ?></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <div class="dropdown-header">
                                <strong><?= $namaLengkap; ?></strong>
                                <small class="text-muted d-block"><?= $userLogin; ?></small>
                            </div>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item" href="detailAkun.php">
                                <i class="bx bx-user me-2"></i>Profile
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="javascript:void(0)" id="logoutButton">
                                <i class="bx bx-power-off me-2"></i>Log Out
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Mobile Menu Toggle -->
            <button class="navbar-toggler d-lg-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#mobileNav">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>

        <!-- Mobile Navigation -->
        <div class="collapse navbar-collapse" id="mobileNav">
            <div class="navbar-nav ms-auto d-lg-none">
                <a class="nav-link" href="viewKeranjang.php">
                    <i class="fas fa-shopping-cart me-2"></i>Shopping Cart
                </a>
                <a class="nav-link" href="viewTransaksi.php">
                    <i class="fas fa-clipboard-list me-2"></i>My Orders
                </a>
                <a class="nav-link" href="detailAkun.php">
                    <i class="bx bx-user me-2"></i>Profile
                </a>
                <a class="nav-link" href="javascript:void(0)" id="logoutButtonMobile">
                    <i class="bx bx-power-off me-2"></i>Log Out
                </a>
            </div>
        </div>
    </nav>
    <!-- / TOP NAVIGATION BAR -->

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome JS (Optional if icons need to work offline) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="../Asset_Admin/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../Asset_Admin/assets/vendor/libs/popper/popper.js"></script>
    <script src="../Asset_Admin/assets/vendor/js/bootstrap.js"></script>
    <script src="../Asset_Admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="../Asset_Admin/assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="../Asset_Admin/assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="../Asset_Admin/assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="../Asset_Admin/assets/js/dashboards-analytics.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <script>
        // Menampilkan SweetAlert2 saat tombol logout diklik
        document.getElementById("logoutButton").addEventListener("click", function() {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda akan logout dari sistem.",
                icon: 'warning',
                iconColor: '#db1514',
                showCancelButton: true,
                confirmButtonColor: '#db1514',
                cancelButtonColor: '#696bff',
                confirmButtonText: 'Logout',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "../logout.php";
                }
            });
        });

        // Mobile logout button
        if (document.getElementById("logoutButtonMobile")) {
            document.getElementById("logoutButtonMobile").addEventListener("click", function() {
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Anda akan logout dari sistem.",
                    icon: 'warning',
                    iconColor: '#db1514',
                    showCancelButton: true,
                    confirmButtonColor: '#db1514',
                    cancelButtonColor: '#696bff',
                    confirmButtonText: 'Logout',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "../logout.php";
                    }
                });
            });
        }
        
        // Real-time search functionality
        $(document).ready(function() {
            // Initialize with All Categories selected
            $('.list-group-item[onclick="filterKategori(\'all\')"]').addClass('active');
            
            // Handle search input in real-time
            $("#searchingTable").on("input", function() {
                var searchValue = $(this).val().toLowerCase().trim();
                
                // Get current category from global variable if available
                var currentCat = 'all';
                if (typeof currentCategory !== 'undefined') {
                    currentCat = currentCategory;
                }
                
                // Apply both filters
                if (typeof applyFilters === 'function') {
                    applyFilters(currentCat, searchValue);
                } else {
                    // Fallback if applyFilters function is not available
                    if (searchValue === '') {
                        $(".produk-item").show();
                        $('#no-results').hide();
                        return;
                    }
                    
                    // Filter products in real-time
                    let visibleCount = 0;
                    $(".produk-item").each(function() {
                        var productName = $(this).find(".card-title").text().toLowerCase();
                        var productCategory = $(this).find(".card-text").text().toLowerCase();
                        var productContent = productName + ' ' + productCategory;
                        
                        // Check if product matches search
                        if (productContent.indexOf(searchValue) > -1) {
                            $(this).show();
                            visibleCount++;
                        } else {
                            $(this).hide();
                        }
                    });
                    
                    // Show or hide no results message if it exists
                    if ($('#no-results').length > 0) {
                        if (visibleCount === 0) {
                            $('#no-results').show();
                        } else {
                            $('#no-results').hide();
                        }
                    }
                }
            });
        });
    </script>

    <style>
        /* Pastikan sidebar tidak menabrak header */
        .sidebar {
            position: fixed;
            /* Tetap di sisi kiri */
            top: 0;
            left: 0;
            width: 250px;
            /* Lebar sidebar */
            height: 100vh;
            /* Tinggi penuh */
            z-index: 1;
            overflow-y: auto;
            /* Scroll jika konten lebih panjang */
        }

        /* Konten utama */
        .main-content {
            margin-left: 250px;
            /* Berikan ruang sesuai lebar sidebar */
            padding: 20px;
            /* Jarak konten dari tepi */
        }

        /* Header */
        header {
            position: fixed;
            top: 0;
            left: 250px;
            /* Berikan ruang sesuai lebar sidebar */
            width: calc(100% - 250px);
            /* Sesuaikan lebar agar tidak menabrak sidebar */
            z-index: 2;
        }

        /* Untuk memastikan responsif */
        @media (max-width: 768px) {
            .sidebar {
                width: 200px;
                /* Lebar lebih kecil untuk perangkat kecil */
            }

            .main-content {
                margin-left: 200px;
            }

            header {
                left: 200px;
                width: calc(100% - 200px);
            }
        }
    </style>

</body>

</html>