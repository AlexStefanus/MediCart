<!-- Menu SIDEBAR CUSTOMER -->
<aside id="layout-menu sidebar" class="layout-menu menu-vertical menu bg-menu-theme sidebar">
    <div class="app-brand demo">
        <a href="produkCust.php" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="../img/logo1.png" alt="" style="max-width: 35px;">
            </span>
            <span class="app-brand-text demo menu-text fw-bolder ms-2 " style="text-transform: capitalize;">MediCart</span>
        </a>
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Menu -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Categories</span></li>
        
        <!-- All Categories -->
        <li class="menu-item">
            <a href="#" class="menu-link nav-link collapsed" onclick="filterKategori('all')">
                <div data-i18n="Form Elements">All Categories</div>
            </a>
        </li>
        
        <?php
        // Mengambil kategori unik dari database
        $query = "SELECT DISTINCT kategoriProduk FROM produk ORDER BY kategoriProduk ASC";
        $kategoriList = query($query);
        
        // Menampilkan setiap kategori
        foreach ($kategoriList as $kat) :
            $kategoriNama = $kat['kategoriProduk'];
        ?>
            <li class="menu-item">
                <a href="#" class="menu-link nav-link collapsed" onclick="filterKategori('<?= $kategoriNama; ?>')">
                    <div data-i18n="Form Elements"><?= $kategoriNama; ?></div>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</aside>

<style>
    .text-primary {
        color: #696bff !important;
    }

    .menu-item.active .menu-link {
        box-shadow: 0 4px 10px rgba(105, 107, 255, 0.5);
        background-color: rgba(105, 107, 255, 0.2);
        font-weight: bold;
    }
</style>
<!-- / Menu SIDEBAR CUSTOMER -->
