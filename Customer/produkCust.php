<?php

$title = 'Daftar Produk';

require 'custControl.php';
require 'template/headerCust.php';

$allProduk = query("SELECT * FROM produk");

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
                                All Categories
                            </a>
                            <?php
                            // Mengambil kategori unik dari database
                            $query = "SELECT DISTINCT kategoriProduk FROM produk ORDER BY kategoriProduk ASC";
                            $kategoriList = query($query);
                            
                            // Menampilkan setiap kategori
                            foreach ($kategoriList as $kat) :
                                $kategoriNama = $kat['kategoriProduk'];
                            ?>
                                <a href="#" class="list-group-item list-group-item-action" onclick="filterKategori('<?= $kategoriNama; ?>')">
                                    <?= $kategoriNama; ?>
                                </a>
                            <?php endforeach; ?>
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
                                
                                <!-- No Results Message -->
                                <div id="no-results" class="col-12 text-center py-5" style="display: none;">
                                    <div class="alert alert-info">
                                        <i class="bx bx-search-alt me-2"></i>
                                        <span>Tidak ada produk yang sesuai dengan pencarian Anda.</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
    // Variable to track current category filter
    let currentCategory = 'all';
    
    function filterKategori(kategori) {
        // Update current category
        currentCategory = kategori;
        
        // Get search value
        const searchValue = $('#searchingTable').val().toLowerCase().trim();
        
        // Apply both filters
        applyFilters(currentCategory, searchValue);
        
        // Update active category in sidebar
        $('.list-group-item').removeClass('active');
        $(`.list-group-item[onclick="filterKategori('${kategori}')"]`).addClass('active');
    }
    
    // Function to apply both category and search filters
    function applyFilters(category, search) {
        // Get all products
        const products = document.querySelectorAll('.produk-item');
        let visibleCount = 0;
        
        // Apply both filters
        products.forEach(product => {
            const productCategory = product.getAttribute('data-kategori');
            const productName = $(product).find('.card-title').text().toLowerCase();
            const productCategoryText = $(product).find('.card-text').text().toLowerCase();
            const productContent = productName + ' ' + productCategoryText;
            
            // Check if product matches both category and search
            const matchesCategory = (category === 'all' || productCategory === category);
            const matchesSearch = (search === '' || productContent.indexOf(search) > -1);
            
            if (matchesCategory && matchesSearch) {
                product.style.display = 'block';
                visibleCount++;
            } else {
                product.style.display = 'none';
            }
        });
        
        // Show or hide no results message
        if (visibleCount === 0) {
            $('#no-results').show();
        } else {
            $('#no-results').hide();
        }
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