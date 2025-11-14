<!-- Menu SIDEBAR ADMIN -->
<aside id="layout-menu sidebar" class="layout-menu menu-vertical menu bg-menu-theme sidebar">
    <div class="app-brand demo">
        <a href="dashboard.php" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="../img/logo1.png" alt="MediCart Logo" style="max-width: 35px;">
            </span>
            <span class="app-brand-text demo menu-text fw-bolder ms-2" style="text-transform: capitalize;">MediCart</span>
        </a>
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>
    
    <!-- Profile Section -->
    <div class="profile-menu">
        <div class="user-info">
            <i class="fas fa-user-circle fa-3x" style="color: #696bff;"></i>
            <div class="user-name"><?= $userLogin; ?></div>
            <div class="text-muted small">Administrator</div>
        </div>
        <div class="text-center mt-3">
            <button id="logoutButton" class="btn btn-sm btn-outline-danger">
                <i class="bx bx-power-off me-1"></i> Logout
            </button>
        </div>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        
       
        <!-- Menu -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Menu Admin</span></li>
        <!-- Product -->
        <li class="menu-item <?php echo ($title == 'Daftar Produk') ? 'active' : ''; ?>">
            <a href="produkAdmin.php" class="menu-link nav-link <?php echo ($title == 'Daftar Produk') ? 'text-primary' : 'collapsed'; ?>">
                <i class="menu-icon tf-icons bx bx-detail"></i>
                <div data-i18n="Form Elements">Manage Product</div>
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
                <div data-i18n="Form Elements">Manage Transaction</div>
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
    
    /* Adjust sidebar positioning without header */
    #layout-menu.sidebar {
        margin-top: 0;
        height: 100vh;
        overflow-y: auto;
        padding-top: 0;
    }
    
    /* Ensure sidebar is visible */
    .layout-menu {
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    
    /* Profile menu styles */
    .profile-menu {
        padding: 15px;
        border-bottom: 1px solid #e9ecef;
        background-color: #f8f9fa;
    }
    
    .profile-menu .user-info {
        text-align: center;
        margin-bottom: 10px;
    }
    
    .profile-menu .user-name {
        font-weight: bold;
        margin: 5px 0;
        color: #333;
    }
    
    /* Adjust menu spacing */
    .menu-inner {
        padding-top: 10px;
    }
</style>

<!-- Logout Script -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Menampilkan SweetAlert2 saat tombol logout diklik
        document.getElementById("logoutButton").addEventListener("click", function() {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda akan logout dari sistem.",
                icon: 'warning',
                iconColor: '#db1514',
                showCancelButton: true,
                confirmButtonColor: '#db1514',
                cancelButtonColor: '#696bff',
                confirmButtonText: 'Logout',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "../logout.php";
                }
            });
        });
    });
</script>
<!-- / Menu SIDEBAR ADMIN -->