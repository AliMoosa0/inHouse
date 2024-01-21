<?php
ob_start();
include('header.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
$email = $_GET['email'];
?>



<body>
    <div class="center">
        <div class="container">
            <div class="text">
                Reset Password With Email
            </div>
            <div class="message-container">
                <?php
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])) {
                    $useremail = $_POST['email'];
                   
                



                    $user = new Users();
                    $userExists = $user->isEmailExists($useremail);

                    if ($userExists) {
                        $resetToken = $user->generateUniqueToken(); // Generate a unique token

                        

                        $expiration = date('Y-m-d H:i:s', strtotime('+3 minutes'));
                        


                        // Save the token in the database for this user (associate it with the user's email or ID)
                        $user->saveResetToken($useremail, $resetToken, $expiration);

                        // Construct the password reset link with the token
                        $passwordResetLink = "http://inhousevm.westeurope.cloudapp.azure.com/~u201902206/inHouse/change_password.php?token=$resetToken";

                        $mail = new PHPMailer(true);
                        try {
                            // SMTP configuration for Gmail
                            $mail->isSMTP();
                            $mail->Host = 'smtp.gmail.com';
                            $mail->SMTPAuth = true;
                            $mail->Username = '';  //enter your email in the empty field
                            $mail->Password = '';  //enter your password in the empty field
                            $mail->SMTPSecure = 'tls'; // Enable TLS encryption
                            $mail->Port = 587; // TCP port to connect to
                
                            // Sender information
                            $mail->setFrom('', 'Polytechnic Second Hand Shop'); //enter your email in the empty field

                            // Add a recipient
                            $mail->addAddress($useremail); // User's email address
                
                            // Email content
                            $mail->isHTML(true);
                            $mail->Subject = 'Password Reset';
                            $mail->Body = "Hello,<br><br>Please click on the following link to reset your password: <a href=\"$passwordResetLink\">Reset Password</a><br><br>Please note theat the link will Expier in 3 Mins<br><br>If you didn't request a password reset, please ignore this email.<br>Thank you.";


                            $mail->send();
                            $message = "An email has been sent to $useremail with instructions to reset your password.";
                            $error = false;
                        } catch (Exception $e) {
                            $message = "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
                            $error = true;
                        }
                    } else {
                        $message = "The email entered does not exist in our database.";
                        $error = true;
                    }

                    // Display the message
                    echo '<div class="' . ($error ? 'error-message' : 'success-message') . '">' . $message . '</div>';
                }
                ?>
            </div>
            <form action="" method="post">
                <div class="data">
                    <label>Email</label>
                    <input type="email" name="email" value="<?php echo $email ?>" placeholder="Enter your Email"
                        autofocus required>
                </div>
                <div class="btn">
                    <div class="inner"></div>
                    <button type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>