<?php 
$title = 'Detail Akun';

require 'custControl.php';
require 'template/headerCust.php';

$username = $_SESSION["username"];
$customer = query("SELECT * FROM customer WHERE username = '$username'")[0];

$tanggalLahir = strtotime($customer["dob"]);
$tanggalFormatted = date("j F Y", $tanggalLahir);
?>

<!-- Konten Utama -->
<div class="main-content-with-navbar">
    <div class="container-fluid" style="padding-top: 80px;">
        <div class="row">
            <div class="col-12">
                <h4 class="fw-bold mb-4">Account Profile</h4>
                
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-user-circle mr-1"></i>
                        Informasi Profil
                    </div>
            <div class="card-body">
                <form>
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for="nama">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama" value="<?= $customer["namaLengkap"]; ?>" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" value="<?= $customer["username"]; ?>" readonly>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" value="<?= $customer["email"]; ?>" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="dob">Tanggal Lahir</label>
                            <input type="text" class="form-control" id="dob" value="<?= $tanggalFormatted; ?>" readonly>
                        </div>
                    </div>
                    
                    <div class="form-row">
                    <div class="col-md-6 mb-3">
                            <label for="gender">Jenis Kelamin</label>
                            <input type="text" class="form-control" id="gender" value="<?= htmlspecialchars($customer['gender']); ?>" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="Kota">Kota</label>
                            <input type="text" class="form-control" id="kota" value="<?= $customer["kota"]; ?>" readonly>
                        </div>
                    </div>

                    <div class="form-row">
                    <div class="col-md-6 mb-3">
                            <label for="contact">Contact</label>
                            <input type="text" class="form-control" id="contact" value="<?= $customer["contact"]; ?>" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="paypalID">Paypal ID</label>
                            <input type="text" class="form-control" id="paypalID" value="<?= isset($customer["paypalID"]) ? $customer["paypalID"] : 'Not Set'; ?>" readonly>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea class="form-control" id="alamat" rows="3" readonly><?= $customer["alamat"]; ?></textarea>
                    </div>
                    
                    <div class="text-right">
                        <a href="editProfil.php" class="btn" style="background-color: #696bff; border-color: #696bff; color: white;">
                            <i class="fas fa-edit me-1"></i>Edit Profile
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>