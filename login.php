<?php
// Start the session (place this at the beginning of your script)
session_start();


include('header.php');
echo '*********' . $_SESSION['uid'];
echo '*********' . $_POST['Username'];
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

<head>
    <style>
        .login_form {
            background-color: #d7d7d9;
            padding: 20px;
        }

        .loginTitle {
            background-color: #d7d7d9;
            color: white;
            padding: 10px;
        }

        .input-box input {
            background-color: #d7d7d9;
            color: balck;
        }

        .input-box input::placeholder {
            color: balck;
        }

        .input-box button {
            background-color: #d7d7d9;
            color: balck;
        }

        .input-box button:disabled {
            background-color: #9e9e9e;
            color: #707070;
        }
        .wrapper h2 {
  position: relative;
  font-size: 22px;
  font-weight: 600;
  color: #333;
}
.wrapper h2::before {
  content: "";
  position: absolute;
  left: 0;
  bottom: 0;
  height: 3px;
  width: 28px;
  border-radius: 12px;
  background: #4070f4;
}
.wrapper form {
  margin-top: 30px;
}
.wrapper form .input-box {
  height: 52px;
  margin: 18px 0;
}
#main {
  width: 100%;
  clear: both;
  padding-bottom: 50px;
  padding-top: 50px;
}
    </style>
</head>

<body>
    <div id="main">
        <div class="wrapper">
            <h2 class="loginTitle">Login</h2>
            <form class="login_form" action="login.php" method="post">
                <div class="input-box">
                    <input type="text" id="Username" name="Username" placeholder="Enter your username" autofocus onblur="isValid(this);" required>
                    <label id="UsernameErr" style="color:red"></label>
                </div>
                <div class="input-box">
                    <input type="password" id="Password" name="Password" placeholder="Enter your password" autofocus onblur="isValid(this);" required>
                    <label id="PasswordErr" style="color:red"></label>
                </div>
                <div class="input-box button">
                    <input type="Submit" id="sub" name="submitted" value="Login" disabled>
                </div>
            </form>
        </div>
    </div>
</body>



<?php


if (isset($_POST['submitted'])) {
    include('Users.php');
    $lgnObj = new Users();
    $username = trim($_POST['Username']); // Note the capital 'U'
    $password = trim($_POST['Password']); // Note the capital 'P'

    if ($lgnObj->login($username, $password)) {
        if ($_SESSION['role'] == "admin") {
            header('Location: home.php');
            exit(); // Always exit after header redirection
        } elseif ($_SESSION['role'] == "student") {
            header('Location: discussions_page.php');
            exit(); // Always exit after header redirection
        }
    } else {
        echo "Invalid username or password";
    }
}
?>