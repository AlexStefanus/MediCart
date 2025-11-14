<?php
require 'custControl.php';
require 'template/headerCust.php';

if (isset($_GET['id'])) {
    $idProduk = $_GET['id'];
    $username = $_SESSION["username"];

    // Cek jumlah produk di keranjang
    $keranjang = query("SELECT jumlah, harga FROM keranjang WHERE idProduk = '$idProduk' AND username = '$username' AND status = 'Belum Dibayar'")[0];

    if ($keranjang['jumlah'] > 1) {
        // Kurangi jumlah produk dan harga total
        $hargaPerItem = $keranjang['harga'] / $keranjang['jumlah'];
        $query = "UPDATE keranjang 
                  SET jumlah = jumlah - 1, harga = harga - $hargaPerItem
                  WHERE idProduk = '$idProduk' AND username = '$username' AND status = 'Belum Dibayar'";
        mysqli_query($connect, $query);
    } else {
        // Hapus produk dari keranjang jika jumlah tinggal 1
        $query = "DELETE FROM keranjang 
                  WHERE idProduk = '$idProduk' AND username = '$username' AND status = 'Belum Dibayar'";
        mysqli_query($connect, $query);
    }

    // Redirect kembali ke halaman keranjang
    echo "
        <script>
            alert('Produk berhasil dikurangi!');
            document.location.href = 'viewKeranjang.php';
        </script>
    ";
} else {
    // Redirect jika ID tidak ditemukan
    header("Location: viewKeranjang.php");
    exit;
}
