<?php
session_start();
?>


<header>

  <script src="https://kit.fontawesome.com/a9abc608fc.js"></script>
  <link rel="stylesheet" href="style.css" type="text/css" media="screen" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  <div class="navbar">
    <nav>

      <!--logo image linked to the home page-->
      <div class>
        <a href=""> <img src="2ndHand3 copy.png" height="60" width="170" alt="Logo" class="nav-logo" /> </a>
      </div>
      <nav class="navbar">
        <input type="checkbox" id="menu-toggle" />
        <label for="menu-toggle" id="hamburger-btn">
          <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
            <path d="M3 12h18M3 6h18M3 18h18" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
          </svg>
        </label>
        <ul class="links">
          <li><a href="home.php">Home</a></li>
          <li><a href="contactUs.php">Contact Us</a></li>
          <li><a href="discussions_page.php">discussions</a></li>
          <li><a href="cart.php"><i class="fa-solid fa-cart-shopping"></i></a></li>
          <div class="animation start-home"></div>
        </ul>

        <?php
        if ($_SESSION['uid'] != null) {

          echo '
            
            <div class="buttons">
            <a href="logout.php" class="signup">Log Out</a>
          </div>
            
            ';

        } else {
          echo '
            <div class="buttons">
            <a href="login.php" class="signin">Sign In</a>
            <a href="register.php" class="signup">Sign Up</a>
          </div>
            
            
            ';


        }

        ?>

  </div>

  </nav>

  </nav>
  <style>
    /* Importing Google font - Open Sans */
    @import url("https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700&display=swap");

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: "Open Sans", sans-serif;
    }

    body {
      height: 100vh;
      width: 100%;
      background: linear-gradient(to bottom, #175d69 23%, #330c43 95%);
    }

    .header {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
    }

    .navbar {
      display: flex;
      align-items: center;
      justify-content: space-between;
      max-width: 1200px;
      margin: 0 auto;
      padding: 20px 15px;
    }

    .navbar .logo a {
      font-size: 1.8rem;
      text-decoration: none;
      color: #fff;
    }

    .navbar .links {
      display: flex;
      align-items: center;
      list-style: none;
      gap: 35px;
    }

    .navbar .links a {
      font-weight: 500;
      text-decoration: none;
      color: #fff;
      padding: 10px 0;
      transition: 0.2s ease;
    }

    .navbar .links a:hover {
      color: #47b2e4;
    }

    .navbar .buttons a {
      text-decoration: none;
      color: #fff;
      font-size: 1rem;
      padding: 15px 0;
      transition: 0.2s ease;
    }

    .navbar .buttons a:not(:last-child) {
      margin-right: 30px;
    }

    .navbar .buttons .signin:hover {
      color: #47b2e4;
    }

    .navbar .buttons .signup {
      border: 1px solid #fff;
      padding: 10px 20px;
      border-radius: 0.375rem;
      text-align: center;
      transition: 0.2s ease;
    }

    .navbar .buttons .signup:hover {
      background-color: #47b2e4;
      color: #fff;
    }

    .hero-section {
      display: flex;
      justify-content: space-evenly;
      align-items: center;
      height: 95vh;
      padding: 0 15px;
      max-width: 1200px;
      margin: 0 auto;
    }

    .hero-section .hero {
      max-width: 50%;
      color: #fff;
    }

    .hero h2 {
      font-size: 2.5rem;
      margin-bottom: 20px;
    }

    .hero p {
      font-size: 1.2rem;
      margin-bottom: 20px;
      color: #c9c7c7;
    }

    .hero-section .img img {
      width: 517px;
    }

    .hero-section .buttons {
      margin-top: 40px;
    }

    .hero-section .buttons a {
      text-decoration: none;
      color: #fff;
      padding: 12px 24px;
      border-radius: 0.375rem;
      font-weight: 600;
      transition: 0.2s ease;
      display: inline-block;
    }

    .hero-section .buttons a:not(:last-child) {
      margin-right: 15px;
    }

    .buttons .join {
      background-color: #47b2e4;
    }

    .hero-section .buttons .learn {
      border: 1px solid #fff;
      border-radius: 0.375rem;
    }

    .hero-section .buttons a:hover {
      background-color: #47b2e4;
    }

    /* Hamburger menu styles */
    #menu-toggle {
      display: none;
    }

    #hamburger-btn {
      font-size: 1.8rem;
      color: #fff;
      cursor: pointer;
      display: none;
      order: 1;
    }

    @media screen and (max-width: 1023px) {
      .navbar .logo a {
        font-size: 1.5rem;
      }

      .links {
        position: fixed;
        left: -100%;
        top: 75px;
        width: 100%;
        height: 100vh;
        padding-top: 50px;
        background: #175d69;
        flex-direction: column;
        transition: 0.3s ease;
      }

      .navbar #menu-toggle:checked~.links {
        left: 0;
      }

      .navbar #hamburger-btn {
        display: block;
      }

      .header .buttons {
        display: none;
      }

      .hero-section .hero {
        max-width: 100%;
        text-align: center;
      }

      .hero-section img {
        display: none;
      }
    }


    /* 


    .navbar{
        display: flex;
        align-items: center;
        padding: 0%;
        margin: 0;
        padding: 0;
        user-select: none;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
    }
    nav{
        flex: 1;
        text-align: right;
    }
    nav ul {
        display: inline-block;
        list-style-type: none;
    }
    nav ul li {
        display: inline-block;
        margin-right: 20px;
    }
    nav a{
        line-height: 50px;
        height: 100%;
        position: relative;
        z-index: 1;
        text-decoration: none;
        text-transform: uppercase;
        text-align: center;
        color: #fff;
        cursor: pointer;
    }
    nav a:hover{
        color: #deaa45;
        text-shadow: 0 0 5px #deaa45;
        transform: scale(1.05);
    }
   
    a:nth-child(1){
        width: 100%;
    }
    a:nth-child(2){
        width: 100%;
    }
    a:nth-child(3){
        width: 100%;
    }
    a:nth-child(4){
        width: 100%;
    }
    a:nth-child(5){
        width: 100%;
    }
    nav .start-home, a:nth-child(1):hover~.animation{
        width: 100px;
        left: 0;
        background-color: #1abc9c;
    }
    nav .start-home, a:nth-child(2):hover~.animation{
        width: 110px;
        left: 100px;
        background-color: #e74c3c;
    }
    nav .start-home, a:nth-child(3):hover~.animation{
        width: 100px;
        left: 210px;
        background-color: #3498db;
    }
    nav .start-home, a:nth-child(4):hover~.animation{
        width: 160px;
        left: 310px;
        background-color: #9b59b6;
    }
    nav .start-home, a:nth-child(5):hover~.animation{
        width: 120px;
        left: 470px;
        background-color: #e67e22;
    }
    body{
        font-size: 12px;
        font-family: sans-serif;
        

    }
    span{
        color: #2bd6b4;
    } */
  </style>


  </style>

</header>


<?php
include('connection.php');  // Adjust the path accordingly
include('debugging.php');
include('users.php');
include('books.php');
$db = new Connection();
$connection = $db->getConnection();

?>