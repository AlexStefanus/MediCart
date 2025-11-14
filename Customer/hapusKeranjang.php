<?php 

$title = 'Hapus Keranjang';

require 'custControl.php';
require 'template/headerCust.php';

$username = $_SESSION["username"];

// Pastikan idProduk dikirim melalui URL
if (isset($_GET['idProduk'])) {
    $idProduk = $_GET['idProduk'];

    // delete keranjang
    if (hapusKeranjang($username, $idProduk) > 0) {
        echo "
            <script>
                alert('Produk berhasil dihapus dari keranjang!');
                document.location.href = 'viewKeranjang.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Produk gagal dihapus dari keranjang!');
                document.location.href = 'viewKeranjang.php';
            </script>
        ";
    }
} else {
    // Jika idProduk tidak ada di URL
    echo "
        <script>
            alert('ID produk tidak ditemukan!');
            document.location.href = 'viewKeranjang.php';
        </script>
    ";
}

?>
