<?php

$title = 'Transaksi Belanja';

require 'adminControl.php';
require 'template/headerAdmin.php';
require 'template/sidebarAdmin.php';

$allTransaksi = query("SELECT * FROM transaksi ORDER BY idTransaksi DESC");

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
                    <h4 class="fw-bold py-3 custom-margin">Manage Transaction</h4>
                    <!-- Basic Table -->
                    <div class="card">
                        <h5 class="card-header" style="margin-bottom: -20px;">Transaction Data</h5>
                        <div class="card-header">
                            <div class="input-group">
                                <span class="input-group-text" id="search-addon" style="background-color: lightgrey; border: none;">
                                    <i class="fas fa-search"></i>
                                </span>
                                <input
                                    type="text"
                                    placeholder="Cari data transaksi..."
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
                                        <th scope="col">ID Transaction</th>
                                        <th scope="col">Username</th>
                                        <th scope="col">Transaction Date</th>
                                        <th scope="col">Method Payment</th>
                                        <th scope="col">Bank</th>
                                        <th scope="col">Transaction Status</th>
                                        <th scope="col">Delivery Status</th>
                                        <th scope="col">Total Price</th>
                                        <th scope="col">Action</th>
                                        <th scope="col">Transaction Details</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    <?php $i = 1; ?>
                                    <?php foreach ($allTransaksi as $transaksi) : ?>
                                        <tr>
                                            <td>
                                                <strong><?= $i++; ?></strong>
                                            </td>
                                            <td><?= $transaksi["idTransaksi"]; ?></td>
                                            <td><?= $transaksi["username"]; ?></td>
                                            <td><?= $transaksi["tanggalTransaksi"]; ?></td>
                                            <td><?= $transaksi["caraBayar"]; ?></td>
                                            <td><?= $transaksi["bank"]; ?></td>
                                            <td><?= $transaksi["statusTransaksi"]; ?></td>
                                            <td><?= $transaksi["statusPengiriman"]; ?></td>
                                            <td>Rp<?= number_format($transaksi["totalHarga"], 0, ',', '.'); ?>/-</td>
                                            <td>
                                                <?php if ($transaksi["statusTransaksi"] == 'Accepted' || $transaksi["statusTransaksi"] == 'Rejected' || $transaksi["statusTransaksi"] == 'Cancelled') : ?>
                                                    <div class="text-center">
                                                        <?php if ($transaksi["statusTransaksi"] == 'Accepted') : ?>
                                                            <span class="badge bg-success">Accepted ✓</span>
                                                        <?php elseif ($transaksi["statusTransaksi"] == 'Rejected') : ?>
                                                            <span class="badge bg-danger">Rejected ✗</span>
                                                        <?php elseif ($transaksi["statusTransaksi"] == 'Cancelled') : ?>
                                                            <span class="badge bg-warning">Cancelled</span>
                                                        <?php endif; ?>
                                                    </div>
                                                <?php else : ?>
                                                    <div style="display: flex; flex-direction: column; gap: 8px;">
                                                        <a href="acceptTransaksi.php?idTransaksi=<?= $transaksi["idTransaksi"]; ?>"
                                                            class="btn btn-primary accept-btn"
                                                            data-id-transaksi="<?= $transaksi["idTransaksi"]; ?>"
                                                            style="display: flex; align-items: center; justify-content: center; gap: 8px;">
                                                            <i class="fas fa-check"></i><span>Accept</span>
                                                        </a>
                                                        <a href="rejectTransaksi.php?idTransaksi=<?= $transaksi["idTransaksi"]; ?>"
                                                            class="btn btn-danger reject-btn"
                                                            data-id-transaksi="<?= $transaksi["idTransaksi"]; ?>"
                                                            style="display: flex; align-items: center; justify-content: center; gap: 8px;">
                                                            <i class="fas fa-times"></i><span>Reject</span>
                                                        </a>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <a href="cetakTransaksi.php?idTransaksi=<?= $transaksi["idTransaksi"]; ?> &username=<?= $transaksi["username"]; ?>" class="btn btn-primary">Detail</a>
                                            </td>
                                        </tr>
                                        <?php $i++; ?>
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
        // Ambil semua tombol Accept dan Reject
        const acceptButtons = document.querySelectorAll('.accept-btn');
        const rejectButtons = document.querySelectorAll('.reject-btn');

        // Konfirmasi dan Notifikasi untuk Accept
        acceptButtons.forEach(button => {
            button.addEventListener('click', (e) => {
                e.preventDefault(); // Mencegah pengalihan langsung
                const href = button.getAttribute('href');
                const idTransaksi = button.getAttribute('data-id-transaksi');

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    html: `
                        <p>Yakin menerima pesanan dengan ID Transaksi berikut?</p>
                        <div style="margin-top: 10px; font-weight: bold;"> ID Transaksi: ${idTransaksi}</div>
                    `,
                    icon: 'warning',
                    iconColor: '#db1514',
                    showCancelButton: true,
                    confirmButtonColor: '#696bff',
                    cancelButtonColor: '#db1514',
                    confirmButtonText: 'Ya, terima!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Redirect ke halaman acceptTransaksi
                        window.location.href = href;
                    }
                });
            });
        });

        // Konfirmasi dan Notifikasi untuk Reject
        rejectButtons.forEach(button => {
            button.addEventListener('click', (e) => {
                e.preventDefault(); // Mencegah pengalihan langsung
                const href = button.getAttribute('href');
                const idTransaksi = button.getAttribute('data-id-transaksi');

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    html: `
                        <p>Yakin menolak pesanan dengan ID Transaksi berikut?</p>
                        <div style="margin-top: 10px; font-weight: bold;"> ID Transaksi: ${idTransaksi}</div>
                    `,
                    icon: 'warning',
                    iconColor: '#db1514',
                    showCancelButton: true,
                    confirmButtonColor: '#db1514',
                    cancelButtonColor: '#696bff',
                    confirmButtonText: 'Ya, tolak!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Redirect ke halaman rejectTransaksi
                        window.location.href = href;
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