<header>
    <link rel="stylesheet" href="style.css" type="text/css" media="screen" />
    <nav class="navbar">

         <!--logo image linked to the home page-->
         <div class="logo">
            <a href=""> <img src="book1.jpg" height="150" width="170" alt="Logo" /> </a>
        </div>

        <ul id="MenuItems">
            <li><a href="home.php">Home</a></li>
            <li><a href="contactUs.php">Contact Us</a></li>
            <li><a href="discussions_page.php">discussions</a></li>
            <li><a href="login.php">Login</a></li>
            <li><a href="register.php">Register</a></li>
            <li><a href="cart.php">Shopping Cart</a></li>
        </ul>
    </nav>
</header>


<?php
require_once('connection.php');  // Adjust the path accordingly

$db = new Connection();
$connection = $db->getConnection();

?>