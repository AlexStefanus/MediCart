<?php

$title = 'Tambah Produk';

require 'adminControl.php';
require 'template/headerAdmin.php';
require 'template/sidebarAdmin.php';

// Cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {
    if (tambahProduk($_POST) > 0) {
        echo "
            <script>
                Swal.fire({
                    title: 'Berhasil!',
                    text: 'Data berhasil ditambahkan!',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'produkAdmin.php';
                    }
                });
            </script>
        ";
    } else {
        echo "
            <script>
                Swal.fire({
                    title: 'Gagal!',
                    text: 'Data gagal ditambahkan!',
                    icon: 'error',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'produkAdmin.php';
                    }
                });
            </script>
        ";
    }
}


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

<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">

        <!-- Layout container -->
        <div class="layout-page">

            <!-- Content wrapper -->
            <div class="content-wrapper">
                <!-- Content -->
                <div class="container-xxl flex-grow-1 container-p-y">
                    <h4 class="fw-bold py-3 custom-margin">Add Product</h4>
                    <!-- Basic Layout & Basic with Icons -->
                    <div class="row">
                        <!-- Basic with Icons -->
                        <div class="col-xxl">
                            <div class="card mb-4">
                                <div class="card-header d-flex align-items-center justify-content-between">
                                    <h5 class="mb-0">Add Product</h5>
                                    <small class="text-muted float-end">Add Product</small>
                                </div>
                                <div class="card-body">
                                    <form action="" method="post" enctype="multipart/form-data">

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
                                                        placeholder="Input Product Name"
                                                        aria-describedby="basic-icon-default-fullname2"
                                                        required />

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
                                                            <option value="<?= $k; ?>"><?= $k; ?></option>
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
                                                        placeholder="Input Product Price"
                                                        aria-describedby="basic-icon-default-fullname2"
                                                        required />
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
                                                        placeholder="Input Product Stock"
                                                        aria-describedby="basic-icon-default-fullname2"
                                                        required />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label class="col-sm-2 col-form-label" for="gambarProduk">Product Image</label>
                                            <div class="col-sm-10">
                                                <div class="mb-3">
                                                    <input class="form-control" type="file" id="gambarProduk" name="gambarProduk" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row justify-content-end">
                                            <div class="col-sm-10">
                                                <button type="submit" name="submit" class="btn btn-primary">Add Product</button>
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