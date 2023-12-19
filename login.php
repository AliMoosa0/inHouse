<?php
ob_start();


include('header.php');

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

      document.getElementById('sub').disabled = false; \

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
      Sign In
      </div>
      <form action="login.php" method="post">
        <div class="data">
          <label>Username</label>

          <input type="text" id="Username" name="Username" placeholder="Enter your username" autofocus
            onblur="isValid(this);" required>
        </div>
        <div class="data">
          <label>Password</label>
          <input type="password" id="Password" name="Password" placeholder="Enter your password" autofocus
            onblur="isValid(this);" required>
        </div>
        <div class="forgot-pass">
          <a href="changeWithEmail.php">Forgot Password?</a>
        </div>
        <div class="btn">
          <div class="inner"></div>
          <button type="submit" name="submitted">Sign In</button>

        </div>
        <div class="signup-link">
          Not a member? <a href="register.php">Sign Up</a>
        </div>
      </form>
    </div>
  </div>
</body>

</html>





<?php


if (isset($_POST['submitted'])) {
  include('Users.php');
  $lgnObj = new Users();
  $username = trim($_POST['Username']);
  $password = trim($_POST['Password']);

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