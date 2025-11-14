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
                <i class="menu-icon tf-icons bx bx-category"></i>
                <div data-i18n="Form Elements">All Categories</div>
            </a>
        </li>
        
        <!-- Peralatan Medis -->
        <li class="menu-item">
            <a href="#" class="menu-link nav-link collapsed" onclick="filterKategori('Peralatan Medis')">
                <i class="menu-icon tf-icons bx bx-plus-medical"></i>
                <div data-i18n="Form Elements">Peralatan Medis</div>
            </a>
        </li>
        
        <!-- Obat dan Suplemen -->
        <li class="menu-item">
            <a href="#" class="menu-link nav-link collapsed" onclick="filterKategori('Obat dan Suplemen')">
                <i class="menu-icon tf-icons bx bx-capsule"></i>
                <div data-i18n="Form Elements">Obat dan Suplemen</div>
            </a>
        </li>
        
        <!-- Alat Bantu Jalan -->
        <li class="menu-item">
            <a href="#" class="menu-link nav-link collapsed" onclick="filterKategori('Alat Bantu Jalan')">
                <i class="menu-icon tf-icons bx bx-walk"></i>
                <div data-i18n="Form Elements">Alat Bantu Jalan</div>
            </a>
        </li>
        
        <!-- Alat Ukur Kesehatan -->
        <li class="menu-item">
            <a href="#" class="menu-link nav-link collapsed" onclick="filterKategori('Alat Ukur Kesehatan')">
                <i class="menu-icon tf-icons bx bx-tachometer"></i>
                <div data-i18n="Form Elements">Alat Ukur Kesehatan</div>
            </a>
        </li>
        
        <!-- Alat Pemantau Kesehatan -->
        <li class="menu-item">
            <a href="#" class="menu-link nav-link collapsed" onclick="filterKategori('Alat Pemantau Kesehatan')">
                <i class="menu-icon tf-icons bx bx-heart"></i>
                <div data-i18n="Form Elements">Alat Pemantau Kesehatan</div>
            </a>
        </li>
        
        <!-- Alat Terapi dan Rehabilitasi -->
        <li class="menu-item">
            <a href="#" class="menu-link nav-link collapsed" onclick="filterKategori('Alat Terapi dan Rehabilitasi')">
                <i class="menu-icon tf-icons bx bx-dumbbell"></i>
                <div data-i18n="Form Elements">Alat Terapi dan Rehabilitasi</div>
            </a>
        </li>
        
        <!-- Perlengkapan Rumah Sakit -->
        <li class="menu-item">
            <a href="#" class="menu-link nav-link collapsed" onclick="filterKategori('Perlengkapan Rumah Sakit')">
                <i class="menu-icon tf-icons bx bx-clinic"></i>
                <div data-i18n="Form Elements">Perlengkapan Rumah Sakit</div>
            </a>
        </li>
        
        <!-- Perlengkapan Dokter -->
        <li class="menu-item">
            <a href="#" class="menu-link nav-link collapsed" onclick="filterKategori('Perlengkapan Dokter')">
                <i class="menu-icon tf-icons bx bx-user-plus"></i>
                <div data-i18n="Form Elements">Perlengkapan Dokter</div>
            </a>
        </li>
        
        <!-- Perlengkapan Perawat -->
        <li class="menu-item">
            <a href="#" class="menu-link nav-link collapsed" onclick="filterKategori('Perlengkapan Perawat')">
                <i class="menu-icon tf-icons bx bx-first-aid"></i>
                <div data-i18n="Form Elements">Perlengkapan Perawat</div>
            </a>
        </li>
        
        
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
