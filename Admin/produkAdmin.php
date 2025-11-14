<?php

$title = "Daftar Produk";

require 'adminControl.php';
require 'template/headerAdmin.php';
require 'template/sidebarAdmin.php';

$allProduk = query("SELECT * FROM produk");

?>

<head>
    <!-- Live Search -->
    <script>
        $(document).ready(function() {
            $("#searchingTable").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $(".table tbody tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
</head>

<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <!-- Layout container -->
        <div class="layout-page">
            <!-- Content wrapper -->
            <div class="content-wrapper">
                <!-- Content -->
                <div class="container-xxl flex-grow-1 container-p-y">
                    <h4 class="fw-bold py-3 custom-margin">Manage Product</h4>
                    <!-- Basic Table -->
                    <div class="card">
                        <h5 class="card-header" style="margin-bottom: -30px;">All Product</h5>
                        <div class="card-header">
                            <div class="input-group">
                                <div class="demo-inline-spacing d-flex w-100">
                                    <!-- Tombol Tambah Produk -->
                                    <a href="tambahProduk.php" class="btn btn-success flex-grow-1" style="max-width: 200px;">
                                        <span class="tf-icons bx bx-list-plus"></span>&nbsp; Tambah Produk
                                    </a>


                                    <!-- Kolom Pencarian -->
                                    <div class="input-group flex-grow-1" style="max-width: calc(100% - 200px);">
                                        <span class="input-group-text" id="search-addon" style="background-color: lightgrey; border: none; border-top-left-radius: 5px; border-bottom-left-radius: 5px;">
                                            <i class="fas fa-search"></i>
                                        </span>
                                        <input
                                            type="text"
                                            placeholder="Cari Product..."
                                            class="form-control"
                                            id="searchingTable"
                                            style="background-color: lightgrey; border: none; color: white;">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive text-nowrap">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">ID Product</th>
                                        <th scope="col">Product Name</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Stock</th>
                                        <th scope="col">Image</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    <?php $i = 1; ?>
                                    <?php foreach ($allProduk as $produk) : ?>
                                        <tr>
                                            <td>
                                                <strong><?= $i++; ?></strong>
                                            </td>
                                            <td><?= $produk["idProduk"]; ?></td>
                                            <td><?= $produk["namaProduk"]; ?></td>
                                            <td><?= $produk["kategoriProduk"]; ?></td>
                                            <td>Rp<?= number_format($produk["hargaProduk"], 0, ',', '.'); ?>/-</td>
                                            <td><?= $produk["stokProduk"]; ?></td>
                                            <td><img src="../img/<?= $produk["gambarProduk"]; ?>" width="100px"></td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="editProduk.php?id=<?= $produk["idProduk"]; ?>">
                                                            <i class="bx bx-edit-alt me-2"></i> Edit
                                                        </a>
                                                        <a class="dropdown-item delete-btn" href="javascript:void(0);" data-product="<?= $produk["idProduk"]; ?>">
                                                            <i class="bx bx-trash me-2"></i> Delete
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!--/ Basic Bootstrap Table -->
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
<!-- Content -->

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Ambil semua tombol dengan class "delete-btn"
        const deleteButtons = document.querySelectorAll('.delete-btn');

        deleteButtons.forEach(button => {
            button.addEventListener('click', () => {
                const productId = button.getAttribute('data-product');

                // Tampilkan popup SweetAlert
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    html: `
                        Anda akan menghapus produk berikut:
                        <div style="margin-top: 10px; font-weight: bold;">ID Produk: ${productId}</div>
                    `,
                    icon: 'warning',
                    iconColor: '#db1514',
                    showCancelButton: true,
                    confirmButtonColor: '#db1514',
                    cancelButtonColor: '#696bff',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Redirect ke halaman deleteProduk dengan parameter idProduk
                        window.location.href = `deleteProduk.php?id=${productId}`;
                    }
                });
            });
        });
    });
</script>


<style>
    .custom-margin {
        margin-top: 60px;
    }

    #searchingTable::placeholder {
        color: #576a80;
        opacity: 1;
    }
</style>