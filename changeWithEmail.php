<?php
ob_start();



include('header.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';




?>


<body>
    <?php

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])) {
        $useremail = $_POST['email'];

        $user = new Users();
        $userExists = $user->isEmailExists($useremail);


        if ($userExists) {
            $resetToken = $user->generateUniqueToken(); // Generate a unique token
    
            // Save the token in the database for this user (associate it with the user's email or ID)
            $user->saveResetToken($useremail, $resetToken);

            // Construct the password reset link with the token
            $passwordResetLink = "http://inhousevm.westeurope.cloudapp.azure.com/~u201902206/inHouse/change_password.php?token=$resetToken";



            // $mail = require __DIR__ . "/mailer.php";
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
                $mail->setFrom('alm9ly@gmail.com', 'Polytechnic Second Hand Shop');

                // Add a recipient
                $mail->addAddress($useremail); // User's email address
    
                // Email content
                $mail->isHTML(true);
                $mail->Subject = 'Password Reset';
                $mail->Body = "Hello,<br><br>Please click on the following link to reset your password: <a href=\"$passwordResetLink\">Reset Password</a><br><br>If you didn't request a password reset, please ignore this email.<br>Thank you.";

                $mail->send();
                echo "An email has been sent to $useremail with instructions to reset your password.";
            } catch (Exception $e) {
                echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        } else {
            echo "The email entered does not exist in our database.";
        }
    }

    ?>



    <!-- HTML form for entering email -->
    <form action="" method="post">
        <div class="data">
            <label>Email</label>
            <input type="email" name="email" placeholder="Enter your Email" autofocus required>
        </div>
        <div class="btn">
            <div class="inner"></div>
            <button type="submit">Submit</button>
        </div>
    </form>
</body>

</html>





<?php



?>