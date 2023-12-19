<?php
ob_start();


include('header.php');


$userID = 'enter your username';
if (isset($_GET['token'])) {
    $userID = $_GET['token'];
} elseif (isset($_POST['token'])) {
    $userID = $_POST['token'];
}


?>

<script>
    function isValid(obj) {
        var errField = obj.id + 'Err';
        var valid = false;

        var value = obj.value.trim();

        if (value == '') {

            document.getElementById(errField).innerHTML = obj.id + ' field may not be blank';
            document.getElementById('sub').disabled = true;
        } else {
            //obj.style.backgroundColor = "#fff";
            document.getElementById(errField).innerHTML = '';
            valid = true;
            enableButton();
        }

        return valid;
    }

    function enableButton() {
        if (document.getElementById('Username').value != '' &&
            document.getElementById('Password').value != '') {

            document.getElementById('sub').disabled = false;
        }
    }
</script>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />


    <?php
    // Check for the registration success message in the URL
    if (isset($_GET['registration']) && $_GET['registration'] === 'success') {
        // Generate JavaScript code to show an alert
        echo '<script>alert("Registration was successful! You can now log in.");</script>';
    }
    ?>
  
</head>

<body>


    <div class="center">
        <div class="container">
            <!-- <label for="show" class="close-btn fas fa-times"  title="close"></label> -->
            <div class="text">
                Reset password
            </div>
            <form action="" method="post">
                <div class="data" style="display: none;">
                    <label>Username</label>

                    <input type=" text" id="token" name="token" placeholder="Enter your Username" autofocus
                        onblur="isValid(this);" required value="<?php echo $userID; ?>">

                </div>
                <div class="data">
                    <label>Password </label>
                    <input type="password" id="Password" name="Password1" placeholder="Enter your New password"
                        autofocus onblur="isValid(this);" required>
                </div>
                <div class="data">
                    <label>Password confirmation</label>
                    <input type="password" id="Password" name="Password2" placeholder="Re Enter your password" autofocus
                        onblur="isValid(this);" required>
                </div>

                <div class="btn">
                    <div class="inner"></div>
                    <button type="submit" name="submitted">Change Password</button>

                </div>
                <div class="signup-link">
                    Not a member? <a href="register.php">Sign In</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>





<?php


if (isset($_POST['submitted'])) {
    include('Users.php');
    $user = new Users();
    if (trim($_POST['password1']) == trim($_POST['password2'])) {
        $token = trim($_POST['token']);
        $password = trim($_POST['Password1']);
        // var_dump($username);
        // var_dump($password);
        // die();
        if ($user->changePassword($token, $password)) {
            echo '<script>alert("Password changed successfully!");</script>';
        } else {
            echo '<script>alert("Password change failed!");</script>';
        }


    }

}
?>