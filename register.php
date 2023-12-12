<?php
ob_start();


include('header.php');

if (isset($_POST['submitted'])) {


  $user = new Users();
  $user->setEmail(trim($_POST['Email']));
  $user->setPassword(trim($_POST['Password']));
  $user->setUsername(trim($_POST['UserName']));
  $user->setPhoneNumber(trim($_POST['PhoneNumber']));
  $user->setRole($_POST['role']);

  if ($user->initWithUsername()) {
    if ($user->registerUser()) {
      header('Location: login.php?registration=success');
      exit(); // Always exit after header redirection
    } else {
      echo '<p style="color:red">Registration not successful</p>';
    }
  } else {
    echo '<p style="color:red">Username already exists</p>';
  }
}
?>



<script>

  function isValid(obj) {
    var errField = obj.id + 'Err';
    var valid = false;

    var value = obj.value.trim();

    if (value == '') {
      //obj.style.backgroundColor = "yellow";
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

<html>

<meta charset="utf-8">
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
</head>

<body>
  <br><br><br>


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

          <input type="text" id="PhoneNumber" name="PhoneNumber" placeholder="Enter your Phone numebr" autofocus
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
        <div class="data">
          <label>Role</label> <br>
          <select id="role" name="role" class="styled-select">
            <option value="admin">admin</option>
            <option value="student">student</option>
          </select>
        </div>
        <div class="btn">
          <div class="inner"></div>
          <button type="submit" name="submitted">Register</button>

        </div>
        <div class="signup-link">
          Alradey a Member? <a href="login.php">Login now</a>
        </div>
      </form>
    </div>
  </div>

</body>

</html>