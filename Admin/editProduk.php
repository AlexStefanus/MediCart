<?php

$title = 'Edit Produk';

require 'adminControl.php';
require 'template/headerAdmin.php';
require 'template/sidebarAdmin.php';


$idProduk = $_GET["id"];

$produk = query("SELECT * FROM produk WHERE idProduk = '$idProduk'")[0];

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

// memanggil function updateProduk() yang ada di adminControl.php
if (isset($_POST["submit"])) {
    if (updateProduk($_POST) > 0) {
        echo "
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Data berhasil diubah!',
                    showConfirmButton: false,
                    timer: 2000
                }).then(() => {
                    window.location.href = 'produkAdmin.php';
                });
            </script>
        ";
    } else {
        echo "
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Failed',
                    text: 'Data gagal diubah!',
                    showConfirmButton: false,
                    timer: 2000
                }).then(() => {
                    window.location.href = 'produkAdmin.php';
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
                    <h4 class="fw-bold py-3 custom-margin">Edit Product</h4>

                    <!-- Basic Layout & Basic with Icons -->
                    <div class="row">
                        <!-- Basic with Icons -->
                        <div class="col-xxl">
                            <div class="card mb-4">
                                <div class="card-header d-flex align-items-center justify-content-between">
                                    <h5 class="mb-0">Edit Product</h5>
                                    <small class="text-muted float-end">Edit Product</small>
                                </div>
                                <div class="card-body">
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="idProduk" value="<?= $produk["idProduk"]; ?>">
                                        <input type="hidden" name="beforeupdate" value="<?= $produk["gambarProduk"]; ?>">

                                        <div class="row mb-3">
                                            <label class="col-sm-2 col-form-label" for="namaProduk">Product Name</label>
                                            <div class="col-sm-10">
                                                <div class="input-group input-group-merge">
                                                    <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-package"></i></span>
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        id="namaProduk"
                                                        name="namaProduk"
                                                        aria-describedby="basic-icon-default-fullname2"
                                                        required value="<?= $produk["namaProduk"]; ?>" />

                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label class="col-sm-2 col-form-label" for="kategoriProduk">Category Product</label>
                                            <div class="col-sm-10">
                                                <div class="input-group input-group-merge">
                                                    <span id="basic-icon-default-fullname2" class="input-group-text" style="border-right: none;">
                                                        <i class="bx bx-clipboard"></i>
                                                    </span>
                                                    <select id="kategoriProduk" class="form-select" style="border-left: none;" name="kategoriProduk" required>
                                                        <option>-- Select Category --</option>
                                                        <?php foreach ($kategori as $k) : ?>
                                                            <?php if ($k == $produk["kategoriProduk"]) : ?>
                                                                <option value="<?= $k; ?>" selected><?= $k; ?></option>
                                                            <?php else : ?>
                                                                <option value="<?= $k; ?>"><?= $k; ?></option>
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label class="col-sm-2 col-form-label" for="hargaProduk">Product Price</label>
                                            <div class="col-sm-10">
                                                <div class="input-group input-group-merge">
                                                    <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-purchase-tag-alt"></i></span>
                                                    <input
                                                        type="number"
                                                        class="form-control"
                                                        id="hargaProduk"
                                                        name="hargaProduk"
                                                        aria-describedby="basic-icon-default-fullname2"
                                                        required value="<?= $produk["hargaProduk"]; ?>" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label class="col-sm-2 col-form-label" for="stokProduk">Product Stock</label>
                                            <div class="col-sm-10">
                                                <div class="input-group input-group-merge">
                                                    <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bxl-dropbox"></i></span>
                                                    <input
                                                        type="number"
                                                        class="form-control"
                                                        id="stokProduk"
                                                        name="stokProduk"
                                                        aria-describedby="basic-icon-default-fullname2"
                                                        required value="<?= $produk["stokProduk"]; ?>" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label class="col-sm-2 col-form-label" for="gambarProduk">Product Image</label>
                                            <div class="col-sm-10">
                                                <div class="input-group input-group-merge" style="border: 1px solid #ced4da; border-radius: 0.375rem; padding: 8px;">
                                                    <div style="border: 1px solid #ced4da; border-radius: 0.375rem; padding: 10px; background-color: #f8f9fa; margin-left: 10px;">
                                                        <img src="../img/<?= $produk["gambarProduk"]; ?>" width="200" class="mb-2" style="display: block; margin: auto;">
                                                    </div>
                                                </div>
                                                <div class="mb-3" style="margin-top: 10px;">
                                                    <input class="form-control" type="file" id="gambarProduk" name="gambarProduk" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row justify-content-end">
                                            <div class="col-sm-10">
                                                <button type="submit" name="submit" class="btn btn-primary">Update</button>
                                                <button type="reset" class="btn btn-secondary">Reset</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- / Content -->

                <!-- Footer -->
                <footer class="content-footer footer bg-footer-theme">
                    <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                        <div class="mb-2 mb-md-0">
                            ©
                            <script>
                                document.write(new Date().getFullYear());
                            </script>
                            , made by MediCart
                            <!-- <a href="https://www.instagram.com/syafiqghiffari__/" target="_blank" class="footer-link fw-bolder">Syafiq Al-Ghiffari</a> -->
                        </div>
                    </div>
                </footer>
                <!-- / Footer -->

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