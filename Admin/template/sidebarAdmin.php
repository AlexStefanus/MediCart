<!-- Menu SIDEBAR ADMIN -->
<aside id="layout-menu sidebar" class="layout-menu menu-vertical menu bg-menu-theme sidebar">
    <div class="app-brand demo">
        <a href="Admin/dashboard.php" class="app-brand-link">
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
        <!-- Dashboard -->
        <li class="menu-item <?php echo ($title == 'Dashboard') ? 'active' : ''; ?>">
            <a href="dashboard.php" class="menu-link nav-link <?php echo ($title == 'Dashboard') ? 'text-primary' : 'collapsed'; ?>">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>
        <!-- Menu -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Menu Admin</span></li>
        <!-- Product -->
        <li class="menu-item <?php echo ($title == 'Daftar Produk') ? 'active' : ''; ?>">
            <a href="produkAdmin.php" class="menu-link nav-link <?php echo ($title == 'Daftar Produk') ? 'text-primary' : 'collapsed'; ?>">
                <i class="menu-icon tf-icons bx bx-detail"></i>
                <div data-i18n="Form Elements">Product</div>
            </a>
        </li>
        <!-- Users -->
        <li class="menu-item <?php echo ($title == 'Customer') ? 'active' : ''; ?>">
            <a href="viewCustomer.php" class="menu-link nav-link <?php echo ($title == 'Customer') ? 'text-primary' : 'collapsed'; ?>">
                <i class="menu-icon tf-icons bx bxs-user-account"></i>
                <div data-i18n="Form Elements">Manage Customer</div>
            </a>
        </li>
        <!-- Shopping Transaction -->
        <li class="menu-item <?php echo ($title == 'Transaksi Belanja') ? 'active' : ''; ?>">
            <a href="viewTransaksi.php" class="menu-link nav-link <?php echo ($title == 'Transaksi Belanja') ? 'text-primary' : 'collapsed'; ?>">
                <i class="menu-icon tf-icons bx bx-package"></i>
                <div data-i18n="Form Elements">Shopping Transaction</div>
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
<!-- / Menu SIDEBAR ADMIN -->