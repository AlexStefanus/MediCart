<?php

require '../connect.php';

// ===================== INSERT =====================
// Funtion untuk tambah produk ke keranjang

function tambahKeranjang($idProduk)
{
    global $connect;

    $username = $_SESSION["username"];
    $idProduk = $idProduk;
    $jumlah = 1;

    // Ambil harga produk dari database
    $harga = query("SELECT hargaProduk FROM produk WHERE idProduk = '$idProduk'")[0]["hargaProduk"];

    // Cek apakah produk sudah ada di keranjang
    $cekProduk = mysqli_query($connect, "SELECT * FROM keranjang WHERE idProduk = '$idProduk' AND username = '$username' AND status = 'Belum Dibayar'");
    if (mysqli_num_rows($cekProduk) > 0) {
        $row = mysqli_fetch_assoc($cekProduk);
        $jumlah = $row["jumlah"] + 1;
        $totalHarga = $harga * $jumlah;

        // Update jumlah dan harga di keranjang
        mysqli_query($connect, "UPDATE keranjang SET jumlah = '$jumlah', harga = '$totalHarga' WHERE idProduk = '$idProduk' AND username = '$username' AND status = 'Belum Dibayar'");
        // Kurangi stok produk
        mysqli_query($connect, "UPDATE produk SET stokProduk = stokProduk - 1 WHERE idProduk = '$idProduk'");
        return mysqli_affected_rows($connect);
    } else {
        $totalHarga = $harga * $jumlah;

        // Masukkan produk baru ke keranjang
        $query = "INSERT INTO keranjang (username, idProduk, jumlah, harga, status, idTransaksi) 
                    VALUES ('$username', '$idProduk', '$jumlah', '$totalHarga', 'Belum Dibayar', '')";
        // Kurangi stok produk
        mysqli_query($connect, "UPDATE produk SET stokProduk = stokProduk - 1 WHERE idProduk = '$idProduk'");
        mysqli_query($connect, $query);
        return mysqli_affected_rows($connect);
    }
}


// Hapus produk dari keranjang
function hapusKeranjang($username, $idProduk)
{
    global $connect;

    // Dapatkan jumlah produk di keranjang
    $keranjang = query("SELECT * FROM keranjang WHERE username = '$username' AND idProduk = '$idProduk' AND status = 'Belum Dibayar'");
    
    if ($keranjang) {
        // Ambil jumlah produk
        $jumlah = $keranjang[0]["jumlah"];

        // Tambahkan jumlah produk ke stok
        mysqli_query($connect, "UPDATE produk SET stokProduk = stokProduk + '$jumlah' WHERE idProduk = '$idProduk'");

        // Hapus produk dari keranjang
        $query = "DELETE FROM keranjang WHERE username = '$username' AND idProduk = '$idProduk' AND status = 'Belum Dibayar'";
        mysqli_query($connect, $query);
        return mysqli_affected_rows($connect);
    }
    
    return 0; // Jika produk tidak ditemukan
}


// ===========================================================

// function untuk checkout
function checkout($data)
{
    global $connect;

    $idTransaksi = 'TRS-' . time();
    $username = $data["username"];
    $tanggalTransaksi = date("Y-m-d");
    $caraBayar = $data["caraBayar"];
    $bank = $data["bank"];
    $statusTransaksi = "Pending";
    $totalHarga = $data["totalHarga"];

    $queryTransaksi = "INSERT INTO transaksi VALUES('$idTransaksi', '$username', '$tanggalTransaksi', '$caraBayar', '$bank', '$statusTransaksi', '$totalHarga', 'Pending','')";
    mysqli_query($connect, $queryTransaksi);

    $queryKeranjang = "UPDATE keranjang SET status = 'Dibayar', idTransaksi='$idTransaksi' WHERE username = '$username' && status = 'Belum Dibayar'";
    mysqli_query($connect, $queryKeranjang);

    return mysqli_affected_rows($connect);
}

// ===========================================================
// Function untuk batalkan transaksi
function batalkanTransaksi($idTransaksi)
{
    global $connect;

    $statusTransaksi = query("SELECT statusTransaksi FROM transaksi WHERE idTransaksi = '$idTransaksi'")[0]["statusTransaksi"];
    $username = $_SESSION["username"];

    //jika status transaksi sudah accepted maka tidak bisa dibatalkan
    if ($statusTransaksi == 'Accepted') {
        return 0;
    } else {
        //dapatkan semua jumlah produk di keranjang lalu tambahkan ke stok produk
        $allKeranjang = query("SELECT * FROM keranjang WHERE idTransaksi = '$idTransaksi' && username = '$username' && status = 'Dibayar'");
        foreach ($allKeranjang as $keranjang) {
            $idProduk = $keranjang["idProduk"];
            $jumlah = $keranjang["jumlah"];
            mysqli_query($connect, "UPDATE produk SET stokProduk = stokProduk + '$jumlah' WHERE idProduk = '$idProduk'");
        }
        //update status transaksi menjadi cancelled
        mysqli_query($connect, "UPDATE transaksi SET statusTransaksi = 'Cancelled', statusPengiriman = 'Dibatalkan' WHERE idTransaksi = '$idTransaksi' AND username = '$username'");
        //update status keranjang menjadi dibatalkan
        mysqli_query($connect, "UPDATE keranjang SET status = 'Dibatalkan' WHERE idTransaksi = '$idTransaksi'");
        return mysqli_affected_rows($connect);
    }
}

// ===========================================================
// Function untuk selesaikan transaksi
function selesaikanTransaksi($idTransaksi)
{
    global $connect;
    //update statusPengiriman

    $statusTransaksi = query("SELECT statusTransaksi FROM transaksi WHERE idTransaksi = '$idTransaksi'")[0]["statusTransaksi"];
    $username = $_SESSION["username"];

    //jika status transaksi sudah rejected maka tidak bisa diterima
    if ($statusTransaksi == 'Rejected' || $statusTransaksi == 'Cancelled') {
        return 0;
    } else {
        $query = "UPDATE transaksi SET statusPengiriman = 'Terkirim' WHERE idTransaksi = '$idTransaksi' && username = '$username'";
        mysqli_query($connect, $query);
        return mysqli_affected_rows($connect);
    }
}

// Function untuk feedback
function feedback($data)
{
    global $connect;

    $idTransaksi = $data["idTransaksi"];
    $feedBack = htmlspecialchars($data["feedBack"]);

    $query = "UPDATE transaksi SET feedBack = '$feedBack' WHERE idTransaksi = '$idTransaksi'";
    mysqli_query($connect, $query);
    return mysqli_affected_rows($connect);
}

// Function untuk update profile customer
function updateProfile($data)
{
    global $connect;

    // Escape all input data
    $username = mysqli_real_escape_string($connect, $data["username"]);
    $namaLengkap = mysqli_real_escape_string($connect, $data["namaLengkap"]);
    $email = mysqli_real_escape_string($connect, $data["email"]);
    $dob = mysqli_real_escape_string($connect, $data["dob"]);
    $gender = mysqli_real_escape_string($connect, $data["gender"]);
    $kota = mysqli_real_escape_string($connect, $data["kota"]);
    $contact = mysqli_real_escape_string($connect, $data["contact"]);
    $alamat = mysqli_real_escape_string($connect, $data["alamat"]);
    
    // Start building query with prepared statement approach
    $updates = array();
    $updates[] = "namaLengkap = '$namaLengkap'";
    $updates[] = "email = '$email'";
    $updates[] = "dob = '$dob'";
    $updates[] = "gender = '$gender'";
    $updates[] = "kota = '$kota'";
    $updates[] = "contact = '$contact'";
    $updates[] = "alamat = '$alamat'";

    // Add PayPal ID if provided
    if (isset($data["paypalID"]) && !empty($data["paypalID"])) {
        $paypalID = mysqli_real_escape_string($connect, $data["paypalID"]);
        $updates[] = "paypalID = '$paypalID'";
    }

    // Add password if provided
    if (isset($data["password"]) && !empty($data["password"])) {
        $password = password_hash($data["password"], PASSWORD_DEFAULT);
        $password = mysqli_real_escape_string($connect, $password);
        $updates[] = "password = '$password'";
    }

    // Build final query
    $query = "UPDATE customer SET " . implode(", ", $updates) . " WHERE username = '$username'";

    // Execute query
    $result = mysqli_query($connect, $query);
    
    if (!$result) {
        // Log error for debugging
        error_log("MySQL Error in updateProfile: " . mysqli_error($connect));
        error_log("Query was: " . $query);
        return 0;
    }
    
    return mysqli_affected_rows($connect);
}
