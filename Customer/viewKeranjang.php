<?php

$title = 'Keranjang Belanja';

require 'custControl.php';
require 'template/headerCust.php';

$username = $_SESSION["username"];
$allKeranjang = query("SELECT * FROM keranjang JOIN produk ON keranjang.idProduk = produk.idProduk WHERE username = '$username' && status = 'Belum Dibayar'");

// memanggil function checkout() yang ada di custControl.php
if (isset($_POST["submit"])) {
    if (checkout($_POST) > 0) {
        echo "
            <script>
                alert('Checkout berhasil!');
                document.location.href = 'viewTransaksi.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Checkout gagal!');
                document.location.href = 'produkCust.php';
            </script>
        ";
    }
}

$totalHarga = query("SELECT SUM(harga) AS totalHarga FROM keranjang WHERE username = '$username' && status = 'Belum Dibayar'")[0]["totalHarga"] ?? 0;


?>

<body>

    <!-- Main Content with Top Navbar -->
    <div class="main-content-with-navbar">
        <div class="container-fluid" style="padding-top: 80px;">
            <div class="row">
                <div class="col-12">
                    <h4 class="fw-bold mb-4">Shopping Cart</h4>
                    
                    <!-- Cart Start -->
                    <div class="container-fluid pt-5">
                        <div class="row px-xl-5">
                            <div class="col-lg-8 table-responsive mb-5">
                                <table class="table table-bordered text-center mb-0">
                                    <thead class="bg-secondary text-dark">
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">ID Product</th>
                                            <th scope="col">Product Name</th>
                                            <th scope="col">Amount</th>
                                            <th scope="col">Price PerItem</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Action</th> <!-- Kolom baru untuk tombol aksi -->
                                        </tr>
                                    </thead>
                                    <tbody class="align-middle">
                                        <?php $i = 1; ?>
                                        <?php foreach ($allKeranjang as $keranjang) : ?>
                                            <tr>
                                                <td><?= $i; ?></td>
                                                <td><?= $keranjang["idProduk"]; ?></td>
                                                <td>
                                                    <img src="../img/<?= $keranjang['gambarProduk']; ?>" alt="<?= $keranjang['namaProduk']; ?>"
                                                        style="width: 50px; height: 50px; object-fit: cover; margin-right: 10px;">
                                                    <?= $keranjang["namaProduk"]; ?>
                                                </td>
                                                <td><?= $keranjang["jumlah"]; ?></td>
                                                <td>Rp<?= number_format($keranjang["harga"] / $keranjang["jumlah"], 0, ',', '.') ?></td>
                                                <td>Rp<?= number_format($keranjang["harga"], 0, ',', '.') ?></td>
                                                <td>
                                                    <!-- Tombol Tambah Produk -->
                                                    <a href="tambahProduk.php?id=<?= $keranjang['idProduk']; ?>"
                                                        class="btn btn-sm text-white"
                                                        style="background-color: #17a2b8; border-color: #17a2b8;"
                                                        onclick="return confirm('Yakin ingin menambahkan produk ini?')">
                                                        <i class="fa fa-plus"></i>
                                                    </a>

                                                    <!-- Tombol Kurangi Produk -->
                                                    <a href="kurangiProduk.php?id=<?= $keranjang['idProduk']; ?>"
                                                        class="btn btn-sm text-white"
                                                        style="background-color: #17a2b8; border-color: #17a2b8;"
                                                        onclick="return confirm('Yakin ingin mengurangi jumlah produk ini?')">
                                                        <i class="fa fa-minus"></i>
                                                    </a>
                                                    <!-- Tombol Hapus Produk -->
                                                    <a href="hapusKeranjang.php?idProduk=<?= $keranjang['idProduk']; ?>"
                                                        class="btn btn-sm text-white"
                                                        style="background-color: #17a2b8; border-color: #17a2b8;"
                                                        onclick="return confirm('Yakin ingin menghapus produk ini?')">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php $i++; ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-lg-4">
                                <div class="card border-secondary mb-5">
                                    <div class="card-header bg-secondary border-0">
                                        <h4 class="font-weight-semi-bold m-0">Order Total</h4>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="font-weight-medium mb-3">Products</h5>
                                        <?php foreach ($allKeranjang as $keranjang) : ?>
                                            <div class="d-flex justify-content-between">
                                                <p><?= $keranjang["namaProduk"]; ?></p>
                                                <p>Rp<?= number_format($keranjang["harga"], 0, ',', '.') ?></p>
                                            </div>
                                        <?php endforeach; ?>
                                        <hr class="mt-0">
                                        <div class="d-flex justify-content-between mb-3 pt-1">
                                            <h6 class="font-weight-medium">Subtotal</h6>
                                            <h6 class="font-weight-medium">Rp<?= number_format($totalHarga, 0, ',', '.'); ?></h6>
                                        </div>
                                    </div>
                                    <div class="card-footer border-secondary bg-transparent">
                                        <div class="d-flex justify-content-between mt-2">
                                            <h5 class="font-weight-bold">Total</h5>
                                            <h5 class="font-weight-bold">Rp<?= number_format($totalHarga, 0, ',', '.'); ?></h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="card border-secondary mb-5">
                                    <form method="post" action="">
                                        <input type="hidden" name="username" value="<?= $username; ?>">
                                        <input type="hidden" name="totalHarga" value="<?= $totalHarga; ?>">

                                        <div class="card-header bg-secondary border-0">
                                            <h5 class="font-weight-semi-bold mb-3">Metode Pembayaran</h5>
                                        </div>
                                        <div class="p-3">
                                            <label for="pembayaran" class="form-label font-weight-medium">Pilih Bank</label>
                                            <select name="bank" class="form-select border-secondary shadow-sm" id="pembayaran" required>
                                                <option value="" disabled selected>Pilih Bank</option>
                                                <option value="BCA">BCA</option>
                                                <option value="BNI">BNI</option>
                                                <option value="BRI">BRI</option>
                                                <option value="Mandiri">Mandiri</option>
                                                <option value="Bayar Ditempat">Bayar Ditempat</option>
                                            </select>
                                        </div>
                                        <div class="card-footer border-secondary bg-transparent">
                                            <h5 class="font-weight-semi-bold mb-3">Payment Method</h5>
                                            <div class="form-group">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" name="caraBayar" id="prepaid" value="Prepaid" required>
                                                    <label class="custom-control-label" for="prepaid">Prepaid</label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" name="caraBayar" id="postpaid" value="Postpaid">
                                                    <label class="custom-control-label" for="postpaid">Postpaid</label>
                                                </div>
                                            </div>

                                            <div class="card-footer border-secondary bg-transparent p-0 pt-3">
                                                <button type="submit" name="submit" class="btn btn-lg btn-block btn-info font-weight-bold my-3 py-3">
                                                    Place Order
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Cart End -->

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>