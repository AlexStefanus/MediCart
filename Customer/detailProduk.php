<?php

$title = 'Detail Produk';

require 'custControl.php';
require 'template/headerCust.php';

$id = $_GET["id"];

$produk = query("SELECT * FROM produk WHERE idProduk = '$id'")[0];

?>

<!-- Shop Detail Start -->
<div class="container-fluid" style="padding-top: 100px; padding-bottom: 50px;">
    <div class="row px-xl-5">
        <div class="col-lg-5 pb-5">
            <div class="border">
                <img class="w-100 h-100" src="../img/<?= $produk["gambarProduk"]; ?>" alt="Image">
            </div>
        </div>
        <div class="col-lg-7 pb-5">
            <h3 class="font-weight-semi-bold"><?= $produk["namaProduk"]; ?></h3>
            <div class="d-flex mb-3">
                <div class="mr-2" style="color: #696bff;">
                    <small class="fas fa-list"></small>
                </div>
                <small class="pt-1">Category : </small>
                <small class="pt-1 d-inline mx-2"><?= $produk["kategoriProduk"]; ?></small>
            </div>
            <h3 class="font-weight-semi-bold mb-4" style="color: #696bff;">Rp<?= number_format($produk["hargaProduk"], 0, ',', '.'); ?>/-</h3>
            <p class="mb-4">Volup erat ipsum diam elitr rebum et dolor. Est nonumy elitr erat diam stet sit clita ea. Sanc invidunt ipsum et, labore clita lorem magna lorem ut. Erat lorem duo dolor no sea nonumy. Accus labore stet, est lorem sit diam sea et justo, amet at lorem et eirmod ipsum diam et rebum kasd rebum.</p>
            <div class="d-flex mb-3">
                <div class="mr-2" style="color: #696bff;">
                    <p class="fas fa-boxes"></p>
                </div>
                <p class="d-inline">Stok Produk :</p>
                <p class="d-inline mx-2"><?= $produk["stokProduk"]; ?></p>
            </div>

            <div class="d-flex align-items-center mb-4 pt-2">
                <!-- Tombol untuk kembali ke halaman sebelumnya -->
                <a href="produkCust.php" class="btn btn-minus" style="margin-right: 20px; background-color: #696bff; border-color: #696bff; color: white;">
                    <i class="fa fa-arrow-left"></i>
                </a>
                <!-- Tombol untuk menambahkan ke keranjang -->
                <a href="tambahKeranjang.php?idProduk=<?= $produk["idProduk"]; ?>" class="btn px-3" style="background-color: #696bff; border-color: #696bff; color: white;">
                    <i class="fa fa-shopping-cart me-1"></i> Add To Cart
                </a>

            </div>
        </div>
    </div>
    <div class="row px-xl-5">
        <div class="col">
            <div class="nav nav-tabs justify-content-center border-secondary mb-4">
                <a class="nav-item nav-link active" data-toggle="tab" href="#tab-pane-1" style="color: #696bff;">Description</a>
            </div>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="tab-pane-1">
                    <p>Eos no lorem eirmod diam diam, eos elitr et gubergren diam sea. Consetetur vero aliquyam invidunt duo dolores et duo sit. Vero diam ea vero et dolore rebum, dolor rebum eirmod consetetur invidunt sed sed et, lorem duo et eos elitr, sadipscing kasd ipsum rebum diam. Dolore diam stet rebum sed tempor kasd eirmod. Takimata kasd ipsum accusam sadipscing, eos dolores sit no ut diam consetetur duo justo est, sit sanctus diam tempor aliquyam eirmod nonumy rebum dolor accusam, ipsum kasd eos consetetur at sit rebum, diam kasd invidunt tempor lorem, ipsum lorem elitr sanctus eirmod takimata dolor ea invidunt.</p>
                    <p>Dolore magna est eirmod sanctus dolor, amet diam et eirmod et ipsum. Amet dolore tempor consetetur sed lorem dolor sit lorem tempor. Gubergren amet amet labore sadipscing clita clita diam clita. Sea amet et sed ipsum lorem elitr et, amet et labore voluptua sit rebum. Ea erat sed et diam takimata sed justo. Magna takimata justo et amet magna et.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Shop Detail End -->