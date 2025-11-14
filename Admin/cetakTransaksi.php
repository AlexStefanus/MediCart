<?php

$title = 'Transaksi Belanja';

require 'adminControl.php';
require 'template/headerAdmin.php';
require 'template/sidebarAdmin.php';

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
                        <center>
                            <img src="../img/logo1.png" width="100px" class="mb-1 " style="margin-bottom: 10px;">
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
                                            <h5>Stempel Toko</h5>
                                            <img src="../img/TTD KU.jpg" alt="Stempel" style="width: 200px; height: 150px;">
                                            <p class="fw-bold">MediCart</p>
                                        </div>
                                    </div>
                                    <div class="mt-4">
                                        <div class="fw-bold">Feedback:</div>
                                        <?= $detailTransaksi["feedBack"] ? $detailTransaksi["feedBack"] : "Belum ada feedback."; ?>
                                    </div>
                                    <div class="text-center mt-3">
                                        <button id="printButton" type="submit" class="btn btn-primary mx-2">Cetak Transaksi</button>
                                        <button type="submit" name="kirimEmail" class="btn btn-primary mx-2">Kirim Email</button>
                                        <a href="viewTransaksi.php" style="text-decoration: none;">
                                            <button id="kembali" class="btn btn-secondary mx-2">Kembali</button>
                                        </a>
                                    </div>
                                </form>
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
                            , made by
                            <a href="https://www.instagram.com/agungsptr___/" target="_blank" class="footer-link fw-bolder">Agung Andhika</a>
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

<script>
    // Saat tombol cetak halaman ditekan
    document.getElementById("printButton").addEventListener("click", function() {
        // Sembunyikan tombol kembali dan cetak halaman
        document.getElementById("printButton").style.display = "none";
        document.getElementById("kembali").style.display = "none";

        // Cetak halaman
        window.print();
    });

    // Event yang dipicu setelah pencetakan selesai
    window.onafterprint = function() {
        // Kembalikan tata letak tombol-tombol cetak dan kembali ke posisi awal setelah pencetakan selesai
        document.getElementById("printButton").style.display = "inline-block";
        document.getElementById("kembali").style.display = "inline-block";
    };

    // Event yang dipicu sebelum pencetakan dimulai
    window.onbeforeprint = function() {
        // Sembunyikan tombol cetak dan kembali saat pencetakan dimulai
        document.getElementById("printButton").style.display = "none";
        document.getElementById("kembali").style.display = "none";
    };
</script>