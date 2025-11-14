<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

function kirimEmail($data) {
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';

    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER; // Enable verbose debug output
        $mail->isSMTP();                      // Send using SMTP
        $mail->Host       = 'smtp.gmail.com'; // Set the SMTP server to send through
        $mail->SMTPAuth   = true;             // Enable SMTP authentication
        $mail->Username   = 'syafiqalghiffari03@gmail.com'; // SMTP username
        $mail->Password   = 'cbxk tjbs gtsu snuu';         // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;   // Enable implicit TLS encryption
        $mail->Port       = 465;                            // TCP port to connect to

        // Recipients
        $mail->setFrom('syafiqalghiffari03@gmail.com', 'SegerWaras Supplies');
        $mail->addAddress($data['email']); // Add recipient email

        // Content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = $data['subject'];
        $mail->Body    = $data['message'];

        $mail->send();
        echo "<script>alert('Pesan berhasil dikirim!')</script>";
    } catch (Exception $e) {
        echo "<script>alert('Pesan gagal dikirim. Error: {$mail->ErrorInfo}')</script>";
    }

    echo "<script type='text/javascript'>document.location = 'cetakTransaksi.php'</script>";
}

// Data POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $dataArr = [
        'email' => $email,
        'subject' => $subject,
        'message' => $message,
    ];

    kirimEmail($dataArr);
}
?>
