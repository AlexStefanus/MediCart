<?php

$title = 'Customer';

require 'adminControl.php';
require 'template/headerAdmin.php';
require 'template/sidebarAdmin.php';

$allCustomer = query("SELECT * FROM customer");

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
                    <h4 class="fw-bold py-3 custom-margin">Manage Customer</h4>
                    <!-- Basic Table -->
                    <div class="card">
                        <h5 class="card-header" style="margin-bottom: -20px;">Customers</h5>
                        <div class="card-header">
                            <div class="input-group">
                                <span class="input-group-text" id="search-addon" style="background-color: lightgrey; border: none;">
                                    <i class="fas fa-search"></i>
                                </span>
                                <input
                                    type="text"
                                    placeholder="Cari customer..."
                                    class="form-control"
                                    id="searchingTable"
                                    style="background-color: lightgrey; border: none; color: white;">
                            </div>
                        </div>
                        <div class="table-responsive text-nowrap">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Username</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">E-Mail</th>
                                        <th scope="col">Date Of Birth</th>
                                        <th scope="col">Gender</th>
                                        <th scope="col">Address</th>
                                        <th scope="col">City</th>
                                        <th scope="col">Contact</th>
                                        <th scope="col">Paypal ID</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    <?php $i = 1;
                                    foreach ($allCustomer as $customer) : ?>
                                        <tr>
                                            <td>
                                                <strong><?= $i++; ?></strong>
                                            </td>
                                            <td><?= $customer["username"]; ?></td>
                                            <td><?= $customer["namaLengkap"]; ?></td>
                                            <td><?= $customer["email"]; ?></td>
                                            <td><?= $customer["dob"]; ?></td>
                                            <td><?= $customer["gender"]; ?></td>
                                            <td><?= $customer["alamat"]; ?></td>
                                            <td><?= $customer["kota"]; ?></td>
                                            <td><?= $customer["contact"]; ?></td>
                                            <td><?= $customer["paypalID"]; ?></td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="editCustomer.php?username=<?= $customer["username"]; ?>">
                                                            <i class="bx bx-edit-alt me-2"></i> Edit
                                                        </a>
                                                        <a class="dropdown-item delete-btn" href="javascript:void(0);" data-username="<?= $customer["username"]; ?>">
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
<!-- Content -->

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Ambil semua tombol dengan class "delete-btn"
        const deleteButtons = document.querySelectorAll('.delete-btn');

        deleteButtons.forEach(button => {
            button.addEventListener('click', () => {
                const username = button.getAttribute('data-username');

                // Tampilkan popup SweetAlert
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    html: `
                        <p>Anda akan menghapus data customer berikut:</p>
                        <div style="margin-top: 10px; font-weight: bold;">Username: ${username}</div>
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
                        // Redirect ke halaman deleteCustomer dengan parameter username
                        window.location.href = `deleteCustomer.php?username=${username}`;
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