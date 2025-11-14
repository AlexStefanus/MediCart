<?php
session_start();

// Jika menggunakan Composer
// require '../vendor/autoload.php';

// Import PHPMailer classes
require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

// Import Dompdf
require '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
use Dompdf\Dompdf;
use Dompdf\Options;

// Include database connection
require 'adminControl.php';

// Pastikan idTransaksi dan username tersedia
if (!isset($_GET['idTransaksi']) || !isset($_GET['username'])) {
    die("Error: Parameter tidak lengkap.");
}

$idTransaksi = $_GET['idTransaksi'];
$username = $_GET['username'];

// Validasi isi parameter
if (empty($idTransaksi) || empty($username)) {
    die("Error: Parameter tidak valid.");
}

// Fetch transaction details with error handling
$result = query("SELECT * FROM transaksi 
    JOIN customer ON transaksi.username = customer.username 
    WHERE transaksi.idTransaksi = '$idTransaksi' AND transaksi.username = '$username'");

if (empty($result)) {
    die("Error: Detail transaksi tidak ditemukan.");
}

$detailTransaksi = $result[0];
$tanggalFormatted = date("j F Y", strtotime($detailTransaksi["tanggalTransaksi"]));

// Fetch cart items
$keranjangUser = query("SELECT * FROM keranjang
    JOIN produk ON keranjang.idProduk = produk.idProduk
    WHERE keranjang.username = '$username' AND keranjang.idTransaksi = '$idTransaksi'");

// Generate PDF
function generateTransactionPDF($detailTransaksi, $keranjangUser)
{
    $options = new Options();
    $options->set('defaultFont', 'Courier');
    $dompdf = new Dompdf($options);

    $html = '<h1>Transaction Summary</h1>';
    $html .= '<p>Username: ' . htmlspecialchars($detailTransaksi["username"]) . '</p>';
    $html .= '<p>Name: ' . htmlspecialchars($detailTransaksi["namaLengkap"]) . '</p>';
    $html .= '<p>Address: ' . htmlspecialchars($detailTransaksi["alamat"]) . '</p>';
    $html .= '<p>Date: ' . htmlspecialchars(date("j F Y", strtotime($detailTransaksi["tanggalTransaksi"]))) . '</p>';
    
    // Add cart items to PDF
    $html .= '<h2>Items Purchased</h2>';
    $html .= '<table border="1" cellpadding="5">';
    $html .= '<tr><th>No.</th><th>Product Name</th><th>Quantity</th><th>Price</th></tr>';
    
    $i = 1;
    foreach ($keranjangUser as $item) {
        $html .= '<tr>';
        $html .= '<td>' . $i . '</td>';
        $html .= '<td>' . htmlspecialchars($item["namaProduk"]) . '</td>';
        $html .= '<td>' . htmlspecialchars($item["jumlah"]) . '</td>';
        $html .= '<td>Rp' . number_format($item["harga"], 0, ',', '.') . '</td>';
        $html .= '</tr>';
        $i++;
    }
    
    $html .= '</table>';

    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();

    $pdfPath = 'transaction_summary_' . $detailTransaksi["idTransaksi"] . '.pdf';
    file_put_contents($pdfPath, $dompdf->output());
    return $pdfPath;
}

// PHPMailer classes sudah diimpor di atas

// Send email with PDF
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pdfPath = generateTransactionPDF($detailTransaksi, $keranjangUser);
    $recipientEmail = $detailTransaksi["email"];
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'syafiqalghiffari03@gmail.com';
        $mail->Password = 'cbxk tjbs gtsu snuu';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('syafiqalghiffari03@gmail.com', 'SegerWaras Supplies');
        $mail->addAddress($recipientEmail);
        $mail->Subject = 'Your Transaction Summary #' . $idTransaksi;
        $mail->Body = 'Dear ' . $detailTransaksi["namaLengkap"] . ",\n\n";
        $mail->Body .= 'Please find your transaction summary attached.' . "\n\n";
        $mail->Body .= 'Thank you for shopping with us!' . "\n\n";
        $mail->Body .= 'SegerWaras Supplies';
        $mail->addAttachment($pdfPath);

        if ($mail->send()) {
            // Delete the PDF after sending
            unlink($pdfPath);
            $successMessage = "Email has been sent successfully.";
        } else {
            $errorMessage = "Failed to send email.";
        }
    } catch (Exception $e) {
        $errorMessage = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Transaction Summary</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        h1 { color: #333; }
        .transaction-details { margin-bottom: 20px; }
        .success { color: green; }
        .error { color: red; }
    </style>
</head>
<body>
    <h1>Transaction Details</h1>
    
    <?php if (isset($successMessage)): ?>
        <p class="success"><?= $successMessage ?></p>
    <?php elseif (isset($errorMessage)): ?>
        <p class="error"><?= $errorMessage ?></p>
    <?php endif; ?>
    
    <div class="transaction-details">
        <p><strong>Transaction ID:</strong> <?= htmlspecialchars($idTransaksi) ?></p>
        <p><strong>Username:</strong> <?= htmlspecialchars($detailTransaksi["username"]) ?></p>
        <p><strong>Name:</strong> <?= htmlspecialchars($detailTransaksi["namaLengkap"]) ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($detailTransaksi["email"]) ?></p>
        <p><strong>Transaction Date:</strong> <?= htmlspecialchars($tanggalFormatted) ?></p>
    </div>
    
    <h2>Items Purchased</h2>
    <table border="1" cellpadding="5">
        <tr>
            <th>No.</th>
            <th>Product Name</th>
            <th>Quantity</th>
            <th>Price</th>
        </tr>
        <?php $i = 1; ?>
        <?php foreach ($keranjangUser as $item): ?>
        <tr>
            <td><?= $i ?></td>
            <td><?= htmlspecialchars($item["namaProduk"]) ?></td>
            <td><?= htmlspecialchars($item["jumlah"]) ?></td>
            <td>Rp<?= number_format($item["harga"], 0, ',', '.') ?></td>
        </tr>
        <?php $i++; ?>
        <?php endforeach; ?>
    </table>
    
    <form method="POST" style="margin-top: 20px;">
        <input type="submit" value="Send Email with PDF">
    </form>
</body>
</html>