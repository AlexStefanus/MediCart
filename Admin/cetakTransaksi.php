<?php

$title = 'Transaksi Belanja';

require 'adminControl.php';
require 'template/headerAdmin.php';
require 'template/sidebarAdmin.php';

// Add meta tag to prevent browsers from adding headers and footers
echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
echo '<style>
    @media print {
        @page { size: A4; margin: 10mm; }
        body { margin: 0; padding: 0; background-color: white; }
        
        /* Hide all navigation and UI elements */
        .layout-wrapper, .layout-container, .layout-page, .layout-menu, .navbar, 
        .layout-navbar, .layout-overlay, .content-backdrop, .content-wrapper,
        .container-xxl, .fw-bold.py-3.mb-4, .card, .card-header, .card-body,
        .screen-view, .no-print, #printButton, #kembali, form, .mt-4, .text-center.mt-3 {
            display: none !important;
        }
        
        /* Show only the print container */
        .print-container {
            display: block !important;
            visibility: visible !important;
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            width: 100% !important;
            height: 100% !important;
            z-index: 9999 !important;
            background-color: white !important;
            padding: 20mm !important;
            margin: 0 !important;
            overflow: visible !important;
        }
        
        /* Make sure all print elements are visible */
        .print-header, .customer-info, .print-table, .signature-section {
            display: block !important;
            visibility: visible !important;
            color: black !important;
        }
        
        /* Format the header */
        .print-header {
            text-align: center !important;
            margin-bottom: 20px !important;
        }
        
        /* Format the table */
        .print-table {
            width: 100% !important;
            border-collapse: collapse !important;
            margin: 20px 0 !important;
            page-break-inside: avoid !important;
        }
        
        .print-table th, .print-table td {
            border: 1px solid #000 !important;
            padding: 8px !important;
            text-align: left !important;
            color: black !important;
        }
        
        /* Format customer info */
        .customer-info {
            margin: 20px 0 !important;
            padding: 0 !important;
        }
        
        /* Format signature */
        .signature-section {
            text-align: right !important;
            margin-top: 30px !important;
        }
        
        /* Force showing images */
        img {
            display: block !important;
            max-width: 100% !important;
            visibility: visible !important;
        }
    }
</style>';

$idTransaksi = $_GET["idTransaksi"];
$username = $_GET["username"];

$detailTransaksi = query("SELECT * FROM transaksi 
JOIN customer ON transaksi.username = customer.username 
WHERE transaksi.idTransaksi = '$idTransaksi' AND transaksi.username = '$username'")[0];

$keranjangUser = query("SELECT * FROM keranjang
JOIN produk ON keranjang.idProduk = produk.idProduk
WHERE keranjang.username = '$username' AND keranjang.idTransaksi = '$idTransaksi'");

$tanggalTransaksi = strtotime($detailTransaksi["tanggalTransaksi"]);
$tanggalFormatted = date("j F Y", $tanggalTransaksi);

?>

<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">

        <!-- Layout container -->
        <div class="layout-page">

            <!-- Content wrapper -->
            <div class="content-wrapper">
                <!-- Content -->

                <div class="container-xxl flex-grow-1 container-p-y">
                    <h4 class="fw-bold py-3 mb-4">Transaction Detail</h4>

                    <div class="card mb-4">
                        <!-- Normal view for screen -->
                        <div class="screen-view">
                            <center>
                                <img src="../img/logo1.png" width="100px" class="mb-1" style="margin-bottom: 10px;">
                                <div class="col-md-10">
                                    <h2 class="mb-1">
                                        <strong class="text" style="color:#696bff;">MediCart</strong>
                                    </h2>
                                    <h4 class="mb-2" style="margin-top: 5px;">Laporan Belanja <?= $detailTransaksi["username"]; ?></h4>
                                </div>
                            </center>
                            <hr class="m-0" />
                            <div class="card-body">
                                <div class="row">
                                    <form action="summary.php?idTransaksi=<?= $idTransaksi ?>&username=<?= $username ?>" method="post">
                                        <input type="hidden" name="email" value="<?= $detailTransaksi['email'] ?>">
                                        <div class="col-lg-12">
                                            <small class="text-light fw-semibold">Laporan Belanja</small>
                                            <div class="row mt-3">
                                                <!-- Kolom Kiri -->
                                                <div class="col-md-6">
                                                    <ul class="list-group">
                                                        <li class="list-group-item d-flex align-items-center">
                                                            <i class="bx bxs-user-account me-2"></i>
                                                            Username: <?= $detailTransaksi["username"]; ?>
                                                        </li>
                                                        <li class="list-group-item d-flex align-items-center">
                                                            <i class="bx bxs-user me-2"></i>
                                                            Nama: <?= $detailTransaksi["namaLengkap"]; ?>
                                                        </li>
                                                        <li class="list-group-item d-flex align-items-center">
                                                            <i class="bx bx-building-house me-2"></i>
                                                            Alamat: <?= $detailTransaksi["alamat"]; ?>
                                                        </li>
                                                        <li class="list-group-item d-flex align-items-center">
                                                            <i class="bx bxs-contact me-2"></i>
                                                            No. Telp: <?= $detailTransaksi["contact"]; ?>
                                                        </li>
                                                        <li class="list-group-item d-flex align-items-center" name="tanggalTransaksi">
                                                            <i class="bx bx-clipboard me-2"></i>
                                                            Tanggal Transaksi: <?= $tanggalFormatted; ?>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <!-- Kolom Kanan -->
                                                <div class="col-md-6">
                                                    <ul class="list-group">
                                                        <li class="list-group-item d-flex align-items-center">
                                                            <i class="bx bxl-paypal me-2"></i>
                                                            ID Paypal: <?= $detailTransaksi["paypalID"]; ?>
                                                        </li>
                                                        <li class="list-group-item d-flex align-items-center">
                                                            <i class="bx bxs-bank me-2"></i>
                                                            Nama Bank: <?= $detailTransaksi["bank"]; ?>
                                                        </li>
                                                        <li class="list-group-item d-flex align-items-center">
                                                            <i class="bx bx-wallet me-2"></i>
                                                            Cara Bayar: <?= $detailTransaksi["caraBayar"]; ?>
                                                        </li>
                                                        <li class="list-group-item d-flex align-items-center">
                                                            <i class="bx bx-money me-2"></i>
                                                            Status Transaksi: <?= $detailTransaksi["statusTransaksi"]; ?>
                                                        </li>
                                                        <li class="list-group-item d-flex align-items-center">
                                                            <i class="bx bxs-truck me-2"></i>
                                                            Status Pengiriman: <?= $detailTransaksi["statusPengiriman"]; ?>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/ List group Icons -->
                                        <div class="table-responsive text-nowrap" style="margin-top: 20px;">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">No.</th>
                                                        <th scope="col">ID Produk</th>
                                                        <th scope="col">Nama Produk</th>
                                                        <th scope="col">Jumlah</th>
                                                        <th scope="col">Harga</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="table-border-bottom-0">
                                                    <?php $i = 1; ?>
                                                    <?php foreach ($keranjangUser as $keranjang) : ?>
                                                        <tr>
                                                            <td><?= $i; ?></td>
                                                            <td><?= $keranjang["idProduk"]; ?></td>
                                                            <td><?= $keranjang["namaProduk"]; ?></td>
                                                            <td><?= $keranjang["jumlah"]; ?></td>
                                                            <td>Rp<?= number_format($keranjang["harga"], 0, ',', '.'); ?></td>
                                                        </tr>
                                                        <?php $i++; ?>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                            <div class="fw-bold text-end" style="margin-top: 20px; margin-bottom: 10px;">Total Harga: Rp<?= number_format($detailTransaksi["totalHarga"], 0, ',', '.'); ?></div>
                                            <div class="mt-3 text-end">
                                                <h5>Tanda Tangan Toko</h5>
                                                <img src="../img/TTD KU.jpg" alt="Tanda Tangan" style="width: 200px; height: 150px;">
                                                <p class="fw-bold">MediCart</p>
                                            </div>
                                        </div>
                                        <div class="mt-4">
                                            <div class="fw-bold">Feedback:</div>
                                            <?= $detailTransaksi["feedBack"] ? $detailTransaksi["feedBack"] : "Belum ada feedback."; ?>
                                        </div>
                                    </orm>
                                </div>
                                </form>
                            </div>
                        </div>
                        
                        <!-- Special container for printing only -->
                        <div class="print-container d-none d-print-block">
                            <div class="print-header">
                                <img src="../img/logo1.png" width="80" style="margin-bottom: 10px;">
                                <h2 style="color:#696bff; margin: 10px 0;">MediCart</h2>
                                <h3 style="margin: 10px 0;">Transaction Detail</h3>
                                <hr style="border: 1px solid #000; margin: 15px 0;">
                            </div>
                            
                            <div class="customer-info">
                                <table style="width: 100%; margin-bottom: 20px;">
                                    <tr>
                                        <td style="width: 50%; vertical-align: top;">
                                            <p><strong>Username:</strong> <?= $detailTransaksi["username"]; ?></p>
                                            <p><strong>Nama:</strong> <?= $detailTransaksi["namaLengkap"]; ?></p>
                                            <p><strong>Alamat:</strong> <?= $detailTransaksi["alamat"]; ?></p>
                                            <p><strong>No. Telp:</strong> <?= $detailTransaksi["contact"]; ?></p>
                                            <p><strong>Tanggal Transaksi:</strong> <?= $tanggalFormatted; ?></p>
                                        </td>
                                        <td style="width: 50%; vertical-align: top;">
                                            <p><strong>ID Paypal:</strong> <?= $detailTransaksi["paypalID"]; ?></p>
                                            <p><strong>Nama Bank:</strong> <?= $detailTransaksi["bank"]; ?></p>
                                            <p><strong>Cara Bayar:</strong> <?= $detailTransaksi["caraBayar"]; ?></p>
                                            <p><strong>Status Transaksi:</strong> <?= $detailTransaksi["statusTransaksi"]; ?></p>
                                            <p><strong>Status Pengiriman:</strong> <?= $detailTransaksi["statusPengiriman"]; ?></p>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            
                            <table class="print-table" style="width: 100%; border-collapse: collapse; margin: 20px 0;">
                                <thead>
                                    <tr>
                                        <th style="border: 1px solid #000; padding: 8px; text-align: left;">No.</th>
                                        <th style="border: 1px solid #000; padding: 8px; text-align: left;">ID Produk</th>
                                        <th style="border: 1px solid #000; padding: 8px; text-align: left;">Nama Produk</th>
                                        <th style="border: 1px solid #000; padding: 8px; text-align: left;">Jumlah</th>
                                        <th style="border: 1px solid #000; padding: 8px; text-align: left;">Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($keranjangUser as $keranjang) : ?>
                                        <tr>
                                            <td style="border: 1px solid #000; padding: 8px;"><?= $i; ?></td>
                                            <td style="border: 1px solid #000; padding: 8px;"><?= $keranjang["idProduk"]; ?></td>
                                            <td style="border: 1px solid #000; padding: 8px;"><?= $keranjang["namaProduk"]; ?></td>
                                            <td style="border: 1px solid #000; padding: 8px;"><?= $keranjang["jumlah"]; ?></td>
                                            <td style="border: 1px solid #000; padding: 8px;">Rp<?= number_format($keranjang["harga"], 0, ',', '.'); ?></td>
                                        </tr>
                                        <?php $i++; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            
                            <div style="text-align: right; margin-top: 20px;">
                                <p style="font-weight: bold;">Total Harga: Rp<?= number_format($detailTransaksi["totalHarga"], 0, ',', '.'); ?></p>
                            </div>
                            
                            <div class="signature-section" style="text-align: right; margin-top: 40px;">
                                <h5>Tanda Tangan Toko</h5>
                                <img src="../img/TTD KU.jpg" alt="Tanda Tangan" style="width: 150px; height: auto;">
                                <p style="font-weight: bold; margin-top: 5px;">MediCart</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="text-center mt-3">
                        <button id="printButton" type="button" class="btn btn-primary mx-2">Cetak Transaksi</button>
                        <a href="viewTransaksi.php" style="text-decoration: none;">
                            <button id="kembali" type="button" class="btn btn-secondary mx-2">Kembali</button>
                        </a>
                    </div>
                </div>
                <!-- / Content -->

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

<script>
    // Saat tombol cetak halaman ditekan
    document.getElementById("printButton").addEventListener("click", function() {
        // Sembunyikan tombol kembali dan cetak halaman
        document.getElementById("printButton").style.display = "none";
        document.getElementById("kembali").style.display = "none";
        
        // Hide elements that shouldn't appear in print
        // 1. Hide sidebar
        const sidebar = document.querySelector('.layout-menu');
        if (sidebar) sidebar.classList.add('d-print-none');
        
        // 2. Hide navbar
        const navbar = document.querySelector('.layout-navbar');
        if (navbar) navbar.classList.add('d-print-none');
        
        // 3. Hide other layout elements
        const layoutElements = document.querySelectorAll('.layout-overlay, .content-backdrop');
        layoutElements.forEach(el => {
            if (el) el.classList.add('d-print-none');
        });
        
        // Add a style tag to hide browser-added elements and ensure table is visible
        const styleTag = document.createElement('style');
        styleTag.id = 'print-style-js';
        styleTag.innerHTML = `
            @media print {
                @page { margin: 0; }
                body { 
                    margin: 15mm auto !important;
                    background-color: white !important;
                    width: 80% !important;
                    max-width: 800px !important;
                }
                .layout-menu, .layout-navbar, .navbar, nav, header, footer { display: none !important; }
                
                /* Show all sections in print */
                .print-section { display: block !important; }
                
                /* Ensure customer info is visible */
                .customer-info { 
                    display: block !important; 
                    margin: 20px auto !important;
                    width: 90% !important;
                }
                
                /* Ensure table is visible */
                table { display: table !important; border-collapse: collapse !important; width: 100% !important; }
                thead { display: table-header-group !important; }
                tbody { display: table-row-group !important; }
                tr { display: table-row !important; }
                th, td { 
                    display: table-cell !important; 
                    border: 1px solid #ddd !important;
                    padding: 5px !important;
                    background-color: white !important;
                }
                
                /* Prevent page breaks inside table */
                table, tr, td, th, tbody, thead, tfoot {
                    page-break-inside: avoid !important;
                }
                
                /* Make sure table has proper borders */
                table {
                    border-collapse: collapse !important;
                    margin-bottom: 20px !important;
                }
            }
        `;
        document.head.appendChild(styleTag);
        
        // Cetak halaman
        window.print();
    });

    // Event yang dipicu setelah pencetakan selesai
    window.onafterprint = function() {
        // Kembalikan tata letak tombol-tombol cetak dan kembali ke posisi awal setelah pencetakan selesai
        document.getElementById("printButton").style.display = "inline-block";
        document.getElementById("kembali").style.display = "inline-block";
        
        // Restore elements that were hidden for print
        const sidebar = document.querySelector('.layout-menu');
        if (sidebar) sidebar.classList.remove('d-print-none');
        
        const navbar = document.querySelector('.layout-navbar');
        if (navbar) navbar.classList.remove('d-print-none');
        
        const layoutElements = document.querySelectorAll('.layout-overlay, .content-backdrop');
        layoutElements.forEach(el => {
            if (el) el.classList.remove('d-print-none');
        });
        
        // Remove temporary style tag
        const styleTag = document.getElementById('print-style-js');
        if (styleTag) styleTag.remove();
    };

    // Event yang dipicu sebelum pencetakan dimulai
    window.onbeforeprint = function() {
        // Sembunyikan tombol cetak dan kembali saat pencetakan dimulai
        document.getElementById("printButton").style.display = "none";
        document.getElementById("kembali").style.display = "none";
    };
</script>