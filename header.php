<header>

    <script src="https://kit.fontawesome.com/a9abc608fc.js" ></script>
    <link rel="stylesheet" href="style.css" type="text/css" media="screen" />
    <div class="navbar">
    <nav>

         <!--logo image linked to the home page-->
         <div>
            <a href=""> <img src="2ndHand3 copy.png" height="60" width="170" alt="Logo" class="nav-logo" /> </a>
        </div>
        <?php
        if ($_SESSION['uid'] != null ){

            echo'
            ?>
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="contactUs.php">Contact Us</a></li>
                <li><a href="discussions_page.php">discussions</a></li>
                <li><a href="logout.php">logOut</a></li>
                <li><a href="cart.php"><i class="fa-solid fa-cart-shopping"></i></a></li>
                <div class="animation start-home"></div>
            </ul>
            
            
            ';

        }else{
            echo'
            <ul>
            <li><a href="home.php">Home</a></li>
            <li><a href="contactUs.php">Contact Us</a></li>
            <li><a href="discussions_page.php">discussions</a></li>
            <li><a href="login.php">Login</a></li>
            <li><a href="register.php">Register</a></li>
            <li><a href="cart.php"><i class="fa-solid fa-cart-shopping"></i></a></li>
            <div class="animation start-home"></div>
        </ul>
            
            
            ';


        }
        
        ?>

    </nav>
    </div>
    <style>

    .navbar{
        display: flex;
        align-items: center;
        padding: 0px;
        background-color: #323232;
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
        background: #606161;
    }
    span{
        color: #2bd6b4;
    }

</style>

</header>


<?php
include('connection.php');  // Adjust the path accordingly
include('debugging.php');
include('users.php');
$db = new Connection();
$connection = $db->getConnection();

?>