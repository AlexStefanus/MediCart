<?php

$title = 'Transaksi Belanja';

require 'custControl.php';
require 'template/headerCust.php';

$username = $_SESSION["username"];
$allTransaksi = query("SELECT * FROM transaksi WHERE username = '$username' ORDER BY idTransaksi DESC");

?>

<!-- Main Content with Top Navbar -->
<div class="main-content-with-navbar">
    <div class="container-fluid" style="padding-top: 80px;">
        <div class="row">
            <div class="col-12">
                <h4 class="fw-bold mb-4">Transaction History</h4>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-file-invoice-dollar mr-1"></i>
                Informasi Transaksi
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">ID Transaksi</th>
                                <th scope="col">Username</th>
                                <th scope="col">Tanggal Transaksi</th>
                                <th scope="col">Cara Bayar</th>
                                <th scope="col">Bank</th>
                                <th scope="col">Status Transaksi</th>
                                <th scope="col">Status Pengiriman</th>
                                <th scope="col">Total Harga</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($allTransaksi as $transaksi) : ?>
                                <tr>
                                    <td><?= $i; ?></td>
                                    <td><?= $transaksi["idTransaksi"]; ?></td>
                                    <td><?= $transaksi["username"]; ?></td>
                                    <td><?= $transaksi["tanggalTransaksi"]; ?></td>
                                    <td><?= $transaksi["caraBayar"]; ?></td>
                                    <td><?= $transaksi["bank"]; ?></td>
                                    <td><?= $transaksi["statusTransaksi"]; ?></td>
                                    <td><?= $transaksi["statusPengiriman"]; ?></td>
                                    <td>Rp<?= number_format($transaksi["totalHarga"], 0, ',', '.'); ?></td>
                                    <td>
                                        <a href="detailTransaksi.php?id=<?= $transaksi["idTransaksi"]; ?>" class="btn btn-primary btn-sm">
                                            <i class="fas fa-info-circle"></i> Detail
                                        </a>
                                        <?php if ($transaksi["statusTransaksi"] == 'Pending') : ?>
                                            <a href="batalkanTransaksi.php?id=<?= $transaksi["idTransaksi"]; ?>" class="btn btn-primary btn-sm">
                                                <i class="fas fa-times-circle"></i> Batalkan
                                            </a>
                                        <?php elseif (($transaksi["statusTransaksi"] == 'Accepted') && ($transaksi["statusPengiriman"] != 'Terkirim')) : ?>
                                            <a href="selesaikanTransaksi.php?id=<?= $transaksi["idTransaksi"]; ?>" class="btn btn-primary btn-sm">
                                                <i class="fas fa-check-circle"></i> Terima
                                            </a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php $i++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>


<!-- Back to Top -->
<a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>
