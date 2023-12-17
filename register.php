<?php
ob_start();
include('header.php');

$formDisplayed = true; // Variable to control form display

if (isset($_POST['submitted'])) {

  $user = new Users();
  $user->setEmail(trim($_POST['Email']));
  $user->setPassword(trim($_POST['Password']));
  $user->setUsername(trim($_POST['UserName']));
  $user->setPhoneNumber(trim($_POST['PhoneNumber']));

  // Check for password complexity
  $password = trim($_POST['Password']);
  if (!preg_match('/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/', $password)) {
    echo '<p style="color:red">Password should be at least 8 characters and contain at least one letter and one number.</p>';
    $formDisplayed = true; // Set to true to display the form again
  } else {
    // Extract domain from email to set the role
    $email = $_POST['Email'];
    $domain = substr(strrchr($email, "@"), 1);

    // Set role based on domain
    switch ($domain) {
      case 'student.polytechnic.bh':
        $user->setRole('student');
        break;
      case 'polytechnic.bh':
        $user->setRole('admin');
        break;
      // default role
      default:
        // Handle unknown domains set a default role
        $user->setRole('Guest');
        break;
    }

    if ($user->initWithUsername()) {
      if ($user->registerUser()) {
        header('Location: login.php?registration=success');
        exit(); // Always exit after header redirection
      } else {
        echo '<p style="color:red">Registration not successful</p>';
        $formDisplayed = true; // Set to true to display the form again
      }
    } else {
      echo '<p style="color:red">Username already exists</p>';
      $formDisplayed = true; // Set to true to display the form again
    }
  }
}
?>

<html>

<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  <script>
    function isValid(obj) {
      var errField = obj.id + 'Err';
      var valid = false;

      var value = obj.value.trim();

      if (value == '') {
        document.getElementById(errField).innerHTML = obj.id + ' field may not be blank';
        document.getElementById('sub').disabled = true;
      } else {
        obj.style.backgroundColor = "#fff";
        document.getElementById(errField).innerHTML = '';
        valid = true;
        enableButton();
      }

      return valid;
    }

    function enableButton() {
      if (document.getElementById('UserName').value != ''
        && document.getElementById('Email').value != ''
        && document.getElementById('Password').value != ''
        && document.getElementById('PhoneNumber').value != '') {
        document.getElementById('sub').disabled = false;
      }
    }
  </script>
</head>

<body>
  <br><br><br>

  <?php if ($formDisplayed): ?> <!-- Show the form if $formDisplayed is true -->
    <div class="center">
      <div class="container">
        <div class="text">
          Register Form
        </div>
        <form action="register.php" method="post">
          <div class="data">
            <label>Username</label>
            <input type="text" id="UserName" name="UserName" placeholder="Enter your username" autofocus
              onblur="isValid(this);" required>
          </div>
          <div class="data">
            <label>Phone Number</label>
            <input type="text" id="PhoneNumber" name="PhoneNumber" placeholder="Enter your Phone number" autofocus
              onblur="isValid(this);" required>
          </div>
          <div class="data">
            <label>Email</label>
            <input type="email" id="Email" name="Email" placeholder="Enter your email" autofocus onblur="isValid(this);"
              required>
          </div>
          <div class="data">
            <label>Password</label>
            <input type="password" id="Password" name="Password" placeholder="Enter your password" autofocus
              onblur="isValid(this);" required>
          </div>
          <div class="btn">
            <div class="inner"></div>
            <button type="submit" name="submitted">Register</button>
          </div>
          <div class="signup-link">
            Already a Member? <a href="login.php">Login now</a>
          </div>
        </form>
      </div>
    </div>
  <?php endif; ?>

</body>

</html>