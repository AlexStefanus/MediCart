<?php
require 'custControl.php';
require 'template/headerCust.php';

if (isset($_GET['id'])) {
    $idProduk = $_GET['id'];
    $username = $_SESSION["username"];

    // Tambahkan jumlah produk di keranjang
    $query = "UPDATE keranjang 
              SET jumlah = jumlah + 1, harga = harga + (SELECT hargaProduk FROM produk WHERE idProduk = '$idProduk')
              WHERE idProduk = '$idProduk' AND username = '$username' AND status = 'Belum Dibayar'";
    mysqli_query($connect, $query);

    // Redirect kembali ke halaman keranjang
    echo "
        <script>
            alert('Produk berhasil ditambahkan!');
            document.location.href = 'viewKeranjang.php';
        </script>
    ";
} else {
    // Redirect jika ID tidak ditemukan
    header("Location: viewKeranjang.php");
    exit;
}
