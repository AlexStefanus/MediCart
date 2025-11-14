<?php

$title = 'Customer';

require 'adminControl.php';
require 'template/headerAdmin.php';
require 'template/sidebarAdmin.php';

$username = $_GET["username"];
$customer = query("SELECT * FROM customer WHERE username = '$username'")[0];

// memanggil function updateCustomer() yang ada di adminControl.php
if (isset($_POST["submit"])) {
    if (updateCustomer($_POST) > 0) {
        echo "
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: 'Customer berhasil diupdate!',
                    }).then(() => {
                        window.location.href = 'viewCustomer.php';
                    });
                });
            </script>
        ";
    } else {
        echo "
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: 'Customer gagal diupdate!',
                    }).then(() => {
                        window.location.href = 'viewCustomer.php';
                    });
                });
            </script>
        ";
    }
}

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
                    <h4 class="fw-bold py-3 custom-margin">Edit Customer</h4>

                    <!-- Basic Layout & Basic with Icons -->
                    <div class="row">
                        <!-- Basic with Icons -->
                        <div class="col-xxl">
                            <div class="card mb-4">
                                <div class="card-header d-flex align-items-center justify-content-between">
                                    <h5 class="mb-0">Edit Customer <strong><?= $customer["username"]; ?></strong></h5>
                                    <small class="text-muted float-end">Edit Customer</small>
                                </div>
                                <div class="card-body">
                                    <form action="" method="post">
                                        <div class="row mb-3">
                                            <label class="col-sm-2 col-form-label" for="username">Username</label>
                                            <div class="col-sm-10">
                                                <div class="input-group input-group-merge">
                                                    <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-user"></i></span>
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        id="username"
                                                        name="username"
                                                        aria-describedby="basic-icon-default-fullname2"
                                                        required readonly value="<?= $customer["username"]; ?>"
                                                        style="background-color: white;" />

                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label class="col-sm-2 col-form-label" for="password">Password</label>
                                            <div class="col-sm-10">
                                                <div class="input-group input-group-merge">
                                                    <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-key"></i></span>
                                                    <input
                                                        type="password"
                                                        class="form-control"
                                                        id="password"
                                                        name="password"
                                                        aria-describedby="basic-icon-default-fullname2" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label class="col-sm-2 col-form-label" for="namaLengkap">Name</label>
                                            <div class="col-sm-10">
                                                <div class="input-group input-group-merge">
                                                    <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-rename"></i></span>
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        id="namaLengkap"
                                                        name="namaLengkap"
                                                        aria-describedby="basic-icon-default-fullname2"
                                                        required value="<?= $customer["namaLengkap"]; ?>"
                                                        style="background-color: white;" />

                                                </div>
                                            </div>
                                        </div>

                                        <input type="hidden" name="passwordOLD" value="<?= $customer["password"]; ?>">

                                        <div class="row mb-3">
                                            <label class="col-sm-2 col-form-label" for="email">Email</label>
                                            <div class="col-sm-10">
                                                <div class="input-group input-group-merge">
                                                    <span class="input-group-text"><i class="bx bx-envelope"></i></span>
                                                    <input
                                                        type="text"
                                                        id="email"
                                                        name="email"
                                                        class="form-control"
                                                        aria-describedby="basic-icon-default-email2"
                                                        required value="<?= $customer["email"]; ?>" />
                                                    <span id="basic-icon-default-email2" class="input-group-text">@example.com</span>
                                                </div>
                                                <div class="form-text">You can use letters, numbers & periods</div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label class="col-sm-2 col-form-label" for="dob">Date Of Birth</label>
                                            <div class="col-sm-10">
                                                <div class="input-group input-group-merge">
                                                    <span class="input-group-text"><i class="bx bx-calendar"></i></span>
                                                    <input
                                                        type="date"
                                                        id="dob"
                                                        name="dob"
                                                        class="form-control"
                                                        aria-describedby="basic-icon-default-email2"
                                                        required value="<?= $customer["dob"]; ?>" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label class="col-sm-2 col-form-label" for="dob">Gender</label>
                                            <div class="col-sm-10">
                                                <div class="d-flex align-items-center gap-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" id="male" name="gender" value="male" <?php echo ($customer["gender"] == "male") ? 'checked' : ''; ?>>
                                                        <label class="form-check-label" for="male">Male</label>
                                                    </div>

                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" id="female" name="gender" value="female" <?php echo ($customer["gender"] == "female") ? 'checked' : ''; ?>>
                                                        <label class="form-check-label" for="female">Female</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label class="col-sm-2 col-form-label" for="alamat">Address</label>
                                            <div class="col-sm-10">
                                                <div class="input-group input-group-merge">
                                                    <span class="input-group-text"><i class="bx bx-building-house"></i></span>
                                                    <input
                                                        type="text"
                                                        id="alamat"
                                                        name="alamat"
                                                        class="form-control"
                                                        aria-describedby="basic-icon-default-email2"
                                                        required value="<?= $customer["alamat"]; ?>" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label class="col-sm-2 col-form-label" for="kota">City</label>
                                            <div class="col-sm-10">
                                                <div class="input-group input-group-merge">
                                                    <span class="input-group-text"><i class="bx bxs-city"></i></span>
                                                    <input
                                                        type="text"
                                                        id="kota"
                                                        name="kota"
                                                        class="form-control"
                                                        aria-describedby="basic-icon-default-email2"
                                                        required value="<?= $customer["kota"]; ?>" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label class="col-sm-2 form-label" for="contact">Contact</label>
                                            <div class="col-sm-10">
                                                <div class="input-group input-group-merge">
                                                    <span id="basic-icon-default-phone2" class="input-group-text"><i class="bx bx-phone"></i></span>
                                                    <input
                                                        type="text"
                                                        id="contact"
                                                        name="contact"
                                                        class="form-control phone-mask"
                                                        aria-describedby="basic-icon-default-phone2"
                                                        required pattern="[0-9]*" value="<?= $customer["contact"]; ?>" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label class="col-sm-2 form-label" for="paypalID">Paypal ID</label>
                                            <div class="col-sm-10">
                                                <div class="input-group input-group-merge">
                                                    <span id="basic-icon-default-phone2" class="input-group-text"><i class="bx bxl-paypal"></i></span>
                                                    <input
                                                        type="text"
                                                        id="paypalID"
                                                        name="paypalID"
                                                        class="form-control phone-mask"
                                                        aria-describedby="basic-icon-default-phone2"
                                                        required pattern="[0-9]*" value="<?= $customer["paypalID"]; ?>" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row justify-content-end">
                                            <div class="col-sm-10">
                                                <button type="submit" name="submit" class="btn btn-primary">Update</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- / Content -->
                
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

<style>
    .custom-margin {
        margin-top: 60px;
    }
</style>