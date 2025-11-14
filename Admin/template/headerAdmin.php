<?php

session_start();

//cek apakah username ada di database admin
$userLogin = $_SESSION["username"];
$checkLogin = query("SELECT username FROM admin WHERE username = '$userLogin'");

if (count($checkLogin) === 0) {
    header("Location: ../logout.php");
    exit;
}

// cek login
if (!isset($_SESSION["login"])) {
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

    <!-- Live Search -->
    <script>
        $(document).ready(function() {
            $("#searchingTable").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $(".table tbody tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
</head>

<body>
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
    </script>

    <style>
        /* Sidebar styles without header */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            height: 100vh;
            z-index: 990;
            overflow-y: auto;
            padding-top: 0;
        }

        /* Adjust content area */
        .layout-page {
            padding-top: 0;
        }
        
        .content-wrapper {
            margin-left: 250px;
            padding: 20px;
        }
        
        /* Custom margin for dashboard heading */
        .custom-margin {
            margin-top: 20px !important;
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .sidebar {
                width: 200px;
            }
            
            .content-wrapper {
                margin-left: 200px;
            }
        }
        
        /* For mobile view */
        @media (max-width: 576px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }
            
            .sidebar.show {
                transform: translateX(0);
            }
            
            .content-wrapper {
                margin-left: 0;
            }
        }
        
        /* Profile menu styles */
        .profile-menu {
            padding: 15px;
            border-bottom: 1px solid #e9ecef;
        }
        
        .profile-menu .user-info {
            text-align: center;
            margin-bottom: 10px;
        }
        
        .profile-menu .user-name {
            font-weight: bold;
            margin: 5px 0;
        }
    </style>

</body>

</html>