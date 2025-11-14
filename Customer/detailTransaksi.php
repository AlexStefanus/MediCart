<?php

$title = 'Transaksi Belanja'; // This title will be hidden in print mode

require 'custControl.php';
require 'template/headerCust.php';

// Add print stylesheet with specific rules to hide browser elements
echo '<link rel="stylesheet" href="print-style.css" media="print">';

// Add meta tag to prevent browsers from adding headers and footers
echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
echo '<style>
    @media print {
        @page { size: auto; margin: 0mm; }
        body { margin: 15mm 10mm 15mm 10mm; }
        .no-print { display: none !important; }
        .print-only { display: block !important; }
        /* Hide title text specifically */
        #title-text, .title-text { display: none !important; }
    }
</style>';

$idTransaksi = $_GET["id"];
$username = $_SESSION["username"];

$detailTransaksi = query("SELECT * FROM transaksi
JOIN customer ON transaksi.username = customer.username
WHERE transaksi.idTransaksi = '$idTransaksi' AND transaksi.username = '$username';
")[0];

$keranjangUser = query("SELECT * FROM keranjang
JOIN produk ON keranjang.idProduk = produk.idProduk
WHERE keranjang.username = '$username' AND keranjang.idTransaksi = '$idTransaksi';
");

$tanggalTransaksi = strtotime($detailTransaksi["tanggalTransaksi"]);
$tanggalFormatted = date("j F Y", $tanggalTransaksi);

// feedback
if (isset($_POST["submit"])) {
    if (feedback($_POST) > 0) {
        echo "
            <script>
                alert('Feedback berhasil dikirim!');
                document.location.href = 'viewTransaksi.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Feedback gagal dikirim!');
                document.location.href = 'viewTransaksi.php';
            </script>
        ";
    }
}


?>

<main id="main" class="main">
    <!-- Hidden title that only shows in print -->
    <div class="print-only" style="display: none;">
        <div class="container mt-3">
            <div class="row align-items-center">
                <div class="text-center">
                    <img src="../img/logo1.png" width="60px" class="mb-1">
                    <h2 class="mb-1"><strong style="color: black">MediCart</strong></h2>
                    <h4 class="mb-2">Laporan Belanja Anda</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="pagetitle d-print-none">
        <h1 class="text-danger">Detail Transaksi</h1>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="container-fluid">
            <div class="row">

                <div class="col">

                    <div class="container mt-3 d-print-none">
                        <div class="row align-items-center">
                            <center>
                                <img src="../img/logo1.png" width="60px" class="mb-1">
                                <div class="col-md-10">
                                    <h2 class="mb-1"><strong class="text" style="color: black">MediCart</strong></h2>
                                    <h4 class="mb-2 title-text">Laporan Belanja Anda</h4>
                                </div>
                            </center>
                        </div>
                    </div>

                    <div class="row print-section" style="text-align: center; margin: 0 auto; display: block !important;">
                        <div class="col-md-8 mx-auto customer-info" style="margin: 0 auto; float: none; display: block !important; visibility: visible !important;">
                            <h5 style="margin-bottom: 10px; text-align: center; font-weight: bold;">Informasi Pelanggan</h5>
                            <ul class="list-group" style="background-color: white; display: block !important; visibility: visible !important;">
                                <li class="list-group-item text-center" style="display: block !important; visibility: visible !important; border: 1px solid #ddd; margin-bottom: 2px; padding: 8px; font-size: 14px; font-weight: bold; color: #333; background-color: #f9f9f9;"><strong>Username:</strong> <?= $detailTransaksi["username"]; ?></li>
                                <li class="list-group-item text-center" style="display: block !important; visibility: visible !important; border: 1px solid #ddd; margin-bottom: 2px; padding: 8px; font-size: 14px; font-weight: bold; color: #333; background-color: #f9f9f9;"><strong>Nama:</strong> <?= $detailTransaksi["namaLengkap"]; ?></li>
                                <li class="list-group-item text-center" style="display: block !important; visibility: visible !important; border: 1px solid #ddd; margin-bottom: 2px; padding: 8px; font-size: 14px; font-weight: bold; color: #333; background-color: #f9f9f9;"><strong>Alamat:</strong> <?= $detailTransaksi["alamat"]; ?></li>
                                <li class="list-group-item text-center" style="display: block !important; visibility: visible !important; border: 1px solid #ddd; margin-bottom: 2px; padding: 8px; font-size: 14px; font-weight: bold; color: #333; background-color: #f9f9f9;"><strong>No. Telp:</strong> <?= $detailTransaksi["contact"]; ?></li>
                                <li class="list-group-item text-center" style="display: block !important; visibility: visible !important; border: 1px solid #ddd; margin-bottom: 2px; padding: 8px; font-size: 14px; font-weight: bold; color: #333; background-color: #f9f9f9;"><strong>Tanggal Transaksi:</strong> <?= $tanggalFormatted; ?></li>
                                <li class="list-group-item text-center" style="display: block !important; visibility: visible !important; border: 1px solid #ddd; margin-bottom: 2px; padding: 8px; font-size: 14px; font-weight: bold; color: #333; background-color: #f9f9f9;"><strong>ID Paypal:</strong> <?= $detailTransaksi["paypalID"]; ?></li>
                                <li class="list-group-item text-center" style="display: block !important; visibility: visible !important; border: 1px solid #ddd; margin-bottom: 2px; padding: 8px; font-size: 14px; font-weight: bold; color: #333; background-color: #f9f9f9;"><strong>Nama Bank:</strong> <?= $detailTransaksi["bank"]; ?></li>
                                <li class="list-group-item text-center" style="display: block !important; visibility: visible !important; border: 1px solid #ddd; margin-bottom: 2px; padding: 8px; font-size: 14px; font-weight: bold; color: #333; background-color: #f9f9f9;"><strong>Cara Bayar:</strong> <?= $detailTransaksi["caraBayar"]; ?></li>
                                <!-- Status Transaksi -->
                                <li class="list-group-item text-center" style="display: block !important; visibility: visible !important; border: 1px solid #ddd; margin-bottom: 2px; padding: 8px; font-size: 14px; font-weight: bold; color: #333; background-color: #f9f9f9;"><strong>Status Transaksi:</strong> <?= $detailTransaksi["statusTransaksi"]; ?></li>
                                <!-- Status Pengiriman -->
                                <li class="list-group-item text-center" style="display: block !important; visibility: visible !important; border: 1px solid #ddd; margin-bottom: 2px; padding: 8px; font-size: 14px; font-weight: bold; color: #333; background-color: #f9f9f9;"><strong>Status Pengiriman:</strong> <?= $detailTransaksi["statusPengiriman"]; ?></li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="row print-section product-table-section" style="text-align: center; margin: 0 auto;">
                        <div class="col-md-10 mx-auto" style="margin: 0 auto; float: none;">
                            <h5 style="margin-bottom: 10px; text-align: center; font-weight: bold;">Daftar Produk</h5>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="product-table" style="border-collapse: collapse; width: 100%; border: 1px solid #ddd; background-color: white;">
                                    <thead>
                                        <tr>
                                            <th style="border: 1px solid #ddd; padding: 5px; text-align: center; background-color: white;">No.</th>
                                            <th style="border: 1px solid #ddd; padding: 5px; background-color: white;">ID Produk</th>
                                            <th style="border: 1px solid #ddd; padding: 5px; background-color: white;">Nama Produk</th>
                                            <th style="border: 1px solid #ddd; padding: 5px; text-align: center; background-color: white;">Jumlah</th>
                                            <th style="border: 1px solid #ddd; padding: 5px; text-align: right; background-color: white;">Harga</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($keranjangUser as $keranjang) : ?>
                                            <tr>
                                                <td style="border: 1px solid #ddd; padding: 5px; text-align: center; background-color: white;"><?= $i; ?></td>
                                                <td style="border: 1px solid #ddd; padding: 5px; background-color: white;"><?= $keranjang["idProduk"]; ?></td>
                                                <td style="border: 1px solid #ddd; padding: 5px; background-color: white;"><?= $keranjang["namaProduk"]; ?></td>
                                                <td style="border: 1px solid #ddd; padding: 5px; text-align: center; background-color: white;"><?= $keranjang["jumlah"]; ?></td>
                                                <td style="border: 1px solid #ddd; padding: 5px; text-align: right; background-color: white;">Rp<?= number_format($keranjang["harga"], 0, ',', '.'); ?></td>
                                            </tr>
                                            <?php $i++; ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            
                            <div class="fw-bold total-price">Total Harga: Rp<?= number_format($detailTransaksi["totalHarga"], 0, ',', '.'); ?></div>
                            
                            <div class="mt-3 text-end print-tanda-tangan">
                                <h5>Tanda Tangan Toko</h5>
                                <img src="../img/TTD KU.jpg" style="width: 120px; height: auto;">
                                <p class="fw-bold">MediCart</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 d-print-none">
                        <div class="fw-bold">Feedback:</div>
                        <?= $detailTransaksi["feedBack"] ? $detailTransaksi["feedBack"] : "Belum ada feedback."; ?>
                    </div>

                    <?php if ($detailTransaksi["feedBack"] == NULL && $detailTransaksi["statusPengiriman"] == "Terkirim" && $detailTransaksi["statusTransaksi"] != 'Cancelled') : ?>
                        <!-- form feedback -->
                        <form action="" method="post" class="mt-3">
                            <input type="hidden" name="idTransaksi" value="<?= $detailTransaksi["idTransaksi"]; ?>">
                            <div class="mb-3">
                                <label for="feedbackInput" class="form-label">Berikan Feedback:</label>
                                <input type="text" class="form-control" id="feedbackInput" name="feedBack" required>
                            </div>
                            <button type="submit" name="submit" class="btn btn-danger">Kirim Feedback</button>
                        </form>
                    <?php endif; ?>

                    <div class="text-center mt-3">
                        <button id="printButton" class="btn btn-secondary mx-2">Cetak</button>
                        <a href="viewTransaksi.php" style="text-decoration: none;">
                            <button id="kembali" class="btn btn-warning mx-2">Kembali</button>
                        </a>
                    </div>

                </div>

            </div>
        </div>
    </section><!-- End Section -->

    <script>
        // Saat tombol cetak halaman ditekan
        document.getElementById("printButton").addEventListener("click", function() {
            // Sembunyikan tombol kembali dan cetak halaman
            document.getElementById("printButton").style.display = "none";
            document.getElementById("kembali").style.display = "none";
            
            // Hide elements that shouldn't appear in print
            // 1. Hide navbar
            const navbar = document.querySelector('.navbar');
            if (navbar) navbar.classList.add('d-print-none');
            
            // 2. Hide page title "Transaksi"
            const pagetitle = document.querySelector('.pagetitle');
            if (pagetitle) pagetitle.classList.add('d-print-none');
            
            // 3. Hide feedback section at bottom left
            const feedbackSection = document.querySelector('.mt-4');
            if (feedbackSection) feedbackSection.classList.add('d-print-none');
            
            // 4. Hide title text
            const titleText = document.querySelector('.title-text');
            if (titleText) titleText.classList.add('d-print-none');
            
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
                    .navbar, nav, header, footer { display: none !important; }
                    .title-text, #title-text { display: none !important; }
                    
                    /* Show all sections in print */
                    .print-section { display: block !important; }
                    
                    /* Ensure customer info is visible */
                    .customer-info { 
                        display: block !important; 
                        margin: 20px auto !important;
                        width: 90% !important;
                    }
                    
                    /* Make list group visible */
                    .list-group { 
                        display: block !important; 
                        width: 100% !important;
                        margin: 0 auto !important;
                        padding: 0 !important;
                        list-style: none !important;
                    }
                    
                    /* Style list items */
                    .list-group-item { 
                        display: block !important; 
                        border: 1px solid #ddd !important; 
                        margin-bottom: 5px !important; 
                        padding: 8px !important;
                        background-color: white !important;
                        text-align: center !important;
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
                    #product-table {
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
            const navbar = document.querySelector('.navbar');
            if (navbar) navbar.classList.remove('d-print-none');
            
            const pagetitle = document.querySelector('.pagetitle');
            if (pagetitle) pagetitle.classList.remove('d-print-none');
            
            // Show feedback section again
            const feedbackSection = document.querySelector('.mt-4');
            if (feedbackSection) feedbackSection.classList.remove('d-print-none');
            
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