<?php

$title = 'Daftar Produk';

require 'custControl.php';
require 'template/headerCust.php';

$allProduk = query("SELECT * FROM produk");

$kategori = array(
    "Peralatan Medis",
    "Obat dan Suplemen",
    "Alat Bantu Jalan",
    "Alat Ukur Kesehatan",
    "Alat Pemantau Kesehatan",
    "Alat Terapi dan Rehabilitasi",
    "Perlengkapan Rumah Sakit",
    "Perlengkapan Dokter",
    "Perlengkapan Perawat",
    "lain-lain"
);

?>

<!-- Main Content with Top Navbar -->
<div class="main-content-with-navbar">
    <div class="container-fluid" style="padding-top: 80px;">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-lg-3 d-none d-lg-block">
                <div class="card sticky-top" style="top: 90px;">
                    <div class="card-header">
                        <h6 class="mb-0">Categories</h6>
                    </div>
                    <div class="card-body p-0">
                        <div class="list-group list-group-flush">
                            <a href="#" class="list-group-item list-group-item-action" onclick="filterKategori('all')">
                                <i class="bx bx-category me-2" style="color: #696bff;"></i>All Categories
                            </a>
                            <a href="#" class="list-group-item list-group-item-action" onclick="filterKategori('Peralatan Medis')">
                                <i class="bx bx-plus-medical me-2" style="color: #696bff;"></i>Peralatan Medis
                            </a>
                            <a href="#" class="list-group-item list-group-item-action" onclick="filterKategori('Obat dan Suplemen')">
                                <i class="bx bx-capsule me-2" style="color: #696bff;"></i>Obat dan Suplemen
                            </a>
                            <a href="#" class="list-group-item list-group-item-action" onclick="filterKategori('Alat Bantu Jalan')">
                                <i class="bx bx-walk me-2" style="color: #696bff;"></i>Alat Bantu Jalan
                            </a>
                            <a href="#" class="list-group-item list-group-item-action" onclick="filterKategori('Alat Ukur Kesehatan')">
                                <i class="bx bx-ruler me-2" style="color: #696bff;"></i>Alat Ukur Kesehatan
                            </a>
                            <a href="#" class="list-group-item list-group-item-action" onclick="filterKategori('Alat Pemantau Kesehatan')">
                                <i class="bx bx-pulse me-2" style="color: #696bff;"></i>Alat Pemantau Kesehatan
                            </a>
                            <a href="#" class="list-group-item list-group-item-action" onclick="filterKategori('Alat Terapi dan Rehabilitasi')">
                                <i class="bx bx-dumbbell me-2" style="color: #696bff;"></i>Alat Terapi dan Rehabilitasi
                            </a>
                            <a href="#" class="list-group-item list-group-item-action" onclick="filterKategori('Perlengkapan Rumah Sakit')">
                                <i class="bx bx-clinic me-2" style="color: #696bff;"></i>Perlengkapan Rumah Sakit
                            </a>
                            <a href="#" class="list-group-item list-group-item-action" onclick="filterKategori('Perlengkapan Dokter')">
                                <i class="bx bx-user-pin me-2" style="color: #696bff;"></i>Perlengkapan Dokter
                            </a>
                            <a href="#" class="list-group-item list-group-item-action" onclick="filterKategori('Perlengkapan Perawat')">
                                <i class="bx bx-user-check me-2" style="color: #696bff;"></i>Perlengkapan Perawat
                            </a>
                            <a href="#" class="list-group-item list-group-item-action" onclick="filterKategori('lain-lain')">
                                <i class="bx bx-dots-horizontal me-2" style="color: #696bff;"></i>Lain-lain
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Products -->
            <div class="col-lg-9">
                <h4 class="fw-bold mb-4">Our Products</h4>
                    
                    <!-- Products Section -->
                    <div class="card">
                        <div class="card-body">
                            <div class="row" id="product-list">
                                <?php foreach ($allProduk as $produk) : ?>
                                    <div class="col-lg-3 col-md-6 col-sm-12 mb-4 produk-item"
                                        data-kategori="<?= htmlspecialchars($produk['kategoriProduk']); ?>">
                                        <div class="card h-100">
                                            <img class="card-img-top" src="../img/<?= $produk["gambarProduk"]; ?>" alt="<?= htmlspecialchars($produk["namaProduk"]); ?>"
                                                style="height: 200px; object-fit: cover;">
                                            <div class="card-body d-flex flex-column">
                                                <h6 class="card-title text-truncate mb-2"><?= htmlspecialchars($produk["namaProduk"]); ?></h6>
                                                <p class="card-text text-muted small mb-2"><?= htmlspecialchars($produk["kategoriProduk"]); ?></p>
                                                <h6 class="text-primary mb-3">Rp<?= number_format($produk["hargaProduk"], 0, ',', '.'); ?></h6>
                                                <div class="mt-auto">
                                                    <div class="btn-group w-100" role="group">
                                                        <?php if ($produk["stokProduk"] == 0) : ?>
                                                            <button class="btn btn-danger btn-sm flex-fill" disabled>Stok Kosong</button>
                                                        <?php else : ?>
                                                            <a href="tambahKeranjang.php?idProduk=<?= $produk["idProduk"]; ?>"
                                                                class="btn btn-primary btn-sm flex-fill">
                                                                <i class="fas fa-shopping-cart me-1"></i>Buy
                                                            </a>
                                                        <?php endif; ?>
                                                        <a href="detailProduk.php?id=<?= $produk["idProduk"]; ?>"
                                                            class="btn btn-outline-primary btn-sm flex-fill">
                                                            <i class="fas fa-eye me-1"></i>Detail
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                
                    <!-- Footer -->
                    <footer class="mt-5 py-4 bg-light">
                        <div class="container">
                            <div class="text-center">
                                &copy;
                                <script>
                                    document.write(new Date().getFullYear());
                                </script>
                                , made by MediCart
                            </div>
                        </div>
                    </footer>
                </div>
            </div>
        </div>
    </div>

<script>
    function filterKategori(kategori) {
        // Dapatkan semua produk
        const products = document.querySelectorAll('.produk-item');

        // Periksa kategori
        products.forEach(product => {
            if (kategori === 'all' || product.getAttribute('data-kategori') === kategori) {
                product.style.display = 'block'; // Tampilkan produk
            } else {
                product.style.display = 'none'; // Sembunyikan produk
            }
        });
    }
</script>

<style>
    .custom-margin {
        margin-top: 70px;
    }
    
    .text-primary {
        color: #696bff !important;
    }
</style>

</body>