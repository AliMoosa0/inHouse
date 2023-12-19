<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


// Create a PHPMailer instance
$mail = new PHPMailer(true);

try {
    // SMTP configuration for Gmail
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'alm9ly@gmail.com'; // Your Gmail address
    $mail->Password = 'sncv cgdv qsex jvux'; // Your Gmail password or app-specific password
    $mail->SMTPSecure = 'tls'; // Enable TLS encryption
    $mail->Port = 587; // TCP port to connect to

    // Sender information
    $mail->setFrom('alm9ly@gmail.com', 'Poly Second Hand Shop');

    // Add a recipient
    $mail->addAddress($userEmail); // User's email address

    // Email content
    $mail->isHTML(true);
    $mail->Subject = 'Password Reset';
    $mail->Body = 'Click the link to reset your password: <a href="https://example.com/reset_password.php?token=' . $resetToken . '">Reset Password</a>';

    $mail->send();
    echo 'Password reset email has been sent.';
} catch (Exception $e) {
    echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
