<?php

$title = 'Dashboard';

require 'adminControl.php';
require 'template/headerAdmin.php';
require 'template/sidebarAdmin.php';

$totalTransaksiSelesai = count(query("SELECT * FROM transaksi WHERE statusPengiriman = 'Terkirim'"));
$totalTransaksiBelumSelesai = count(query("SELECT * FROM transaksi WHERE statusPengiriman = 'Dalam Perjalanan' AND statusPengiriman = 'Pending'"));
$totalTransaksiReject = count(query("SELECT * FROM transaksi WHERE statusTransaksi = 'Rejected'"));
$totalCancelTransaksi = count(query("SELECT * FROM transaksi WHERE statusTransaksi = 'Cancelled'"));
$totalProduk = count(query("SELECT * FROM produk"));
$totalCustomer = count(query("SELECT * FROM customer"));
$totalKeuangan = query("SELECT SUM(totalHarga) FROM transaksi WHERE statusPengiriman = 'Terkirim'")[0]['SUM(totalHarga)'];

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

    <title>Admin Dashboard</title>

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
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Layout container -->
            <div class="layout-page">
                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <h4 class="fw-bold py-3 custom-margin">Dashboard</h4>
                        <div class="row">
                            <!-- Card Group Row 1 -->
                            <div class="col-lg-3 col-md-6 mb-4">
                                <div class="card h-100 d-flex align-items-center justify-content-center">
                                    <div class="card-body text-center">
                                        <div class="card-title d-flex align-items-center justify-content-center mb-3">
                                            <div class="avatar flex-shrink-0">
                                                <img
                                                    src="../img/pending.png"
                                                    alt="chart success"
                                                    class="rounded" />
                                            </div>
                                        </div>
                                        <span class="fw-semibold d-block mb-1">Pending Order</span>
                                        <h3 class="card-title mb-2"><?= $totalTransaksiBelumSelesai; ?></h3>
                                        <small class="fw-semibold" style="color: #696bff;">Total Transaksi Belum Selesai</small>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6 mb-4">
                                <div class="card h-100 d-flex align-items-center justify-content-center">
                                    <div class="card-body text-center">
                                        <div class="card-title d-flex align-items-center justify-content-center mb-3">
                                            <div class="avatar flex-shrink-0">
                                                <img
                                                    src="../img/complate_order.png"
                                                    alt="Credit Card"
                                                    class="rounded" />
                                            </div>
                                        </div>
                                        <span class="fw-semibold d-block mb-1">Complate Order</span>
                                        <h3 class="card-title text-nowrap mb-1"><?= $totalTransaksiSelesai; ?></h3>
                                        <small class="fw-semibold" style="color: #696bff;">Total Transaksi Selesai</small>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6 mb-4">
                                <div class="card h-100 d-flex align-items-center justify-content-center">
                                    <div class="card-body text-center">
                                        <div class="card-title d-flex align-items-center justify-content-center mb-3">
                                            <div class="avatar flex-shrink-0">
                                                <img src="../img/order_reject.png" alt="Credit Card" class="rounded" />
                                            </div>
                                        </div>
                                        <span class="fw-semibold d-block mb-1">Order Rejected</span>
                                        <h3 class="card-title text-nowrap mb-1"><?= $totalTransaksiReject; ?></h3>
                                        <small class="fw-semibold" style="color: #696bff;">Total Transaksi Ditolak</small>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6 mb-4">
                                <div class="card h-100 d-flex align-items-center justify-content-center">
                                    <div class="card-body text-center">
                                        <div class="card-title d-flex align-items-center justify-content-center mb-3">
                                            <div class="avatar flex-shrink-0">
                                                <img src="../img/order_canceled.png" alt="Credit Card" class="rounded" />
                                            </div>
                                        </div>
                                        <span class="fw-semibold d-block mb-1">Order Canceled</span>
                                        <h3 class="card-title mb-2"><?= $totalCancelTransaksi; ?></h3>
                                        <small class="fw-semibold" style="color: #696bff;">Total Transaksi Dibatalkan</small>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6 mb-4">
                                <div class="card h-100 d-flex align-items-center justify-content-center">
                                    <div class="card-body text-center">
                                        <div class="card-title d-flex align-items-center justify-content-center mb-3">
                                            <div class="avatar flex-shrink-0">
                                                <img src="../img/product_added.png" alt="Credit Card" class="rounded" />
                                            </div>
                                        </div>
                                        <span class="fw-semibold d-block mb-1">Product Added</span>
                                        <h3 class="card-title mb-2"><?= $totalProduk; ?></h3>
                                        <small class="fw-semibold" style="color: #696bff;">Total Produk</small>
                                    </div>
                                </div>
                            </div>

                            <!-- Card Group Row 2 -->
                            <div class="col-lg-3 col-md-6 mb-4">
                                <div class="card h-100 d-flex align-items-center justify-content-center">
                                    <div class="card-body text-center">
                                        <div class="card-title d-flex align-items-center justify-content-center mb-3">
                                            <div class="avatar flex-shrink-0">
                                                <img
                                                    src="../img/user.png"
                                                    alt="chart success"
                                                    class="rounded" />
                                            </div>
                                        </div>
                                        <span class="fw-semibold d-block mb-1">Users</span>
                                        <h3 class="card-title mb-2"><?= $totalCustomer; ?></h3>
                                        <small class="fw-semibold" style="color: #696bff;">Total Customer</small>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6 mb-4">
                                <div class="card h-100 d-flex align-items-center justify-content-center">
                                    <div class="card-body text-center">
                                        <div class="card-title d-flex align-items-center justify-content-center mb-3">
                                            <div class="avatar flex-shrink-0">
                                                <img src="../img/income_money.png" alt="Credit Card" class="rounded" />
                                            </div>
                                        </div>
                                        <span class="fw-semibold d-block mb-1">Income Money</span>
                                        <h3 class="card-title mb-2">Rp<?= number_format($totalKeuangan, 0, ',', '.'); ?>/-</h3>
                                        <small class="fw-semibold" style="color: #696bff;">Total Pemasukan</small>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- / Content -->

                    <!-- Footer -->
                    <footer class="content-footer footer bg-footer-theme">
                        <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                            <div class="mb-2 mb-md-0">
                                ©
                                <script>
                                    document.write(new Date().getFullYear());
                                </script>
                                , made by MediCart
                                <!-- <a href="https://www.instagram.com/syafiqghiffari__/" target="_blank" class="footer-link fw-bolder">Syafiq Al-Ghiffari</a> -->
                            </div>
                        </div>
                    </footer>
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

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

    <style>
        .custom-margin {
            margin-top: 70px;
        }
    </style>

</body>

</html>