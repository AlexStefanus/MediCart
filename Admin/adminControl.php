<?php 

require '../connect.php';

// Funtion untuk tambah produk
function tambahProduk($data){
    global $connect;
    $idProduk = 'PRD-' . time();
    $namaProduk = htmlspecialchars($data["namaProduk"]);
    
    // Cek apakah kategori yang dipilih adalah "lain-lain"
    if ($data["kategoriProduk"] === "lain-lain" && isset($data["kategoriBaruProduk"]) && !empty($data["kategoriBaruProduk"])) {
        // Gunakan kategori baru yang diinput user
        $kategoriProduk = htmlspecialchars($data["kategoriBaruProduk"]);
    } else {
        // Gunakan kategori yang dipilih dari dropdown
        $kategoriProduk = htmlspecialchars($data["kategoriProduk"]);
    }
    
    $hargaProduk = htmlspecialchars($data["hargaProduk"]);
    $stokProduk = htmlspecialchars($data["stokProduk"]);
    $gambarProduk = upload();
    if (!$gambarProduk){
        die;
        return false;
        die;
    }
    $query = "INSERT INTO produk VALUES ('$idProduk','$namaProduk','$kategoriProduk','$hargaProduk','$stokProduk','$gambarProduk')";   
    mysqli_query($connect, $query);
    return mysqli_affected_rows($connect);
}

// Function untuk upload gambar
function upload(){
    $namaFile = $_FILES['gambarProduk']['name'];
    $ukuranFile = $_FILES['gambarProduk']['size'];
    $error = $_FILES['gambarProduk']['error'];
    $tmpName = $_FILES['gambarProduk']['tmp_name'];

    if($error === 4){
        echo "<script>
                alert('Pilih Gambar Dahulu!');
            </script>";
        return false;
    }

    $ekstensiGambarValid = ['jpg', 'jpeg', 'png', 'jfif', 'webp'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if(!in_array($ekstensiGambar, $ekstensiGambarValid)){
        echo "<script>
                alert('Ekstensi Gambar Tidak Valid!');
            </script>";
        return false;
        die;
    }

    if($ukuranFile > 1000000){
        echo "<script>
                alert('Ukuran Gambar Terlalu Besar!');
            </script>";
        return false;
        die;
    }

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;
    move_uploaded_file($tmpName, '../img/' . $namaFileBaru);
    return $namaFileBaru;
}

// Function untuk update produk
function updateProduk($data){
    global $connect;
    $idProduk = $data["idProduk"];
    $namaProduk = htmlspecialchars($data["namaProduk"]);
    $kategoriProduk = htmlspecialchars($data["kategoriProduk"]);
    $hargaProduk = htmlspecialchars($data["hargaProduk"]);
    $stokProduk = htmlspecialchars($data["stokProduk"]);
    $beforeupdate = htmlspecialchars($data["beforeupdate"]);
    if($_FILES['gambarProduk']['error'] === 4){
        $gambarProduk = $beforeupdate;
    } else {
        $gambarProduk = upload();
        //delete file lama
        unlink('../img/' . $beforeupdate);
    }
    $query = "UPDATE produk SET 
                namaProduk = '$namaProduk',
                kategoriProduk = '$kategoriProduk',
                hargaProduk = '$hargaProduk',
                stokProduk = '$stokProduk',
                gambarProduk = '$gambarProduk'
                WHERE idProduk = '$idProduk'
                ";
    mysqli_query($connect, $query);
    return mysqli_affected_rows($connect);
}

// Function untuk delete produk bersama gambar
function deleteProduk($id){
    global $connect;
    $query = "SELECT * FROM produk WHERE idProduk = '$id'";
    $result = mysqli_query($connect, $query);
    $row = mysqli_fetch_assoc($result);
    mysqli_query($connect, "DELETE FROM produk WHERE idProduk = '$id'");
    $gambarProduk = $row["gambarProduk"];

    if(mysqli_affected_rows($connect) > 0) {
        unlink('../img/' . $gambarProduk);
    }

    return mysqli_affected_rows($connect);
}

// ====================================================================================================

// Function untuk hapus customer
function deleteCustomer($username){
    global $connect;
    
    // Begin transaction to ensure data integrity
    mysqli_begin_transaction($connect);
    
    try {
        // First delete related records from keranjang table
        mysqli_query($connect, "DELETE FROM keranjang WHERE username = '$username'");
        
        // Then delete related records from transaksi table if any
        mysqli_query($connect, "DELETE FROM transaksi WHERE username = '$username'");
        
        // Finally delete the customer
        $result = mysqli_query($connect, "DELETE FROM customer WHERE username = '$username'");
        
        // If everything went well, commit the transaction
        mysqli_commit($connect);
        
        // Always return success (1) if the transaction was committed successfully
        // This fixes the issue where mysqli_affected_rows might return 0 if no rows were affected
        // in the last query but the transaction as a whole was successful
        return 1;
    } catch (Exception $e) {
        // If there was an error, roll back the transaction
        mysqli_rollback($connect);
        
        // Return error message
        echo "<script>alert('Error: " . $e->getMessage() . "');</script>";
        return 0;
    }
}

// Function untuk update customer
function updateCustomer($data){
    global $connect;
    $username = $data["username"];
    $password = htmlspecialchars($data["password"]);
    $namaLengkap = htmlspecialchars($data["namaLengkap"]);
    $email = htmlspecialchars($data["email"]);
    $dob = htmlspecialchars($data["dob"]);
    $gender = htmlspecialchars($data["gender"]);
    $alamat = htmlspecialchars($data["alamat"]);
    $kota = htmlspecialchars($data["kota"]);
    $contact = htmlspecialchars($data["contact"]);
    $paypalID = htmlspecialchars($data["paypalID"]);

    //if no password input
    if($password == ''){
        $password = $data["passwordOLD"];
    }
    else {
        $password = password_hash($password, PASSWORD_DEFAULT);
    }

    $query = "UPDATE customer SET 
            password = '$password',
            namaLengkap = '$namaLengkap',
            email = '$email',
            dob = '$dob',
            gender = '$gender',
            alamat = '$alamat',
            kota = '$kota',
            contact = '$contact',
            paypalID = '$paypalID'
            WHERE username = '$username'
            ";
    mysqli_query($connect, $query);
    return mysqli_affected_rows($connect);
}

// ====================================================================================================

// Function untuk accept transaksi
function acceptTransaksi($idTransaksi){
    global $connect;
    $query = "UPDATE transaksi SET 
                statusTransaksi = 'Accepted',
                statusPengiriman = 'Dalam Perjalanan'
                WHERE idTransaksi = '$idTransaksi'
                ";
    mysqli_query($connect, $query);
    return mysqli_affected_rows($connect);
}

// Function untuk reject transaksi
function rejectTransaksi($idTransaksi){
    global $connect;
    $query = "UPDATE transaksi SET 
                statusTransaksi = 'Rejected',
                statusPengiriman = 'Dibatalkan'
                WHERE idTransaksi = '$idTransaksi'
                ";
    mysqli_query($connect, $query);

    //dapatkan semua jumlah produk di keranjang lalu tambahkan ke stok produk
    $allKeranjang = query("SELECT * FROM keranjang WHERE idTransaksi = '$idTransaksi'");
    foreach($allKeranjang as $keranjang) {
        $idProduk = $keranjang["idProduk"];
        $jumlah = $keranjang["jumlah"];
        mysqli_query($connect, "UPDATE produk SET stokProduk = stokProduk + '$jumlah' WHERE idProduk = '$idProduk'");
    }
    return mysqli_affected_rows($connect);
}


?>