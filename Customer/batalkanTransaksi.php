<?php 

$title = 'Batalkan Transaksi';

require 'custControl.php';
require 'template/headerCust.php';

$idTransaksi = $_GET["id"];

if(batalkanTransaksi($idTransaksi) > 0){
    echo "<script>
            alert('Transaksi Berhasil Dibatalkan!');
            document.location.href = 'viewTransaksi.php';
        </script>";
} else {
    echo "<script>
            alert('Transaksi Gagal Dibatalkan!');
            document.location.href = 'viewTransaksi.php';
        </script>";
}



?>