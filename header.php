<?php
session_start();

?>


<header>

  <script src="https://kit.fontawesome.com/a9abc608fc.js"></script>
  <link rel="stylesheet" href="style.css" type="text/css" media="screen" />
  <meta charset="UTF-8">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
    integrity="..." crossorigin="anonymous">


  <nav>

    <!--logo image linked to the home page-->
    <div>
      <a href="home.php"> <img src="bp.png" height="140" width="170" alt="Logo" class="nav-logo" /> </a>
    </div>
    <nav class="navbar">
      <input type="checkbox" id="menu-toggle" />
      <label for="menu-toggle" id="hamburger-btn">
        <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
          <path d="M3 12h18M3 6h18M3 18h18" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
        </svg>
      </label>
      <ul class="links">
        <li><a href="home.php">Home Page</a></li>
        <!-- <li><a href="contactUs.php">Contact Us</a></li> -->
        <li><a href="discussions_page.php">Discussions</a></li>
        <li><a href="MyBooks.php">My Books</a></li>
        <li><a href="myOrders.php">My Orders</a></li>
        <?php if ($_SESSION['role'] == 'admin') { ?>
          <li><a href="admin_dashboard.php">Admin Panel</a></li>
        <?php } ?>
        <li><a href="cart_page.php"><i class="fa-solid fa-cart-shopping"></i></a></li>
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



      <!-- Google Website Translator -->
      <script type="text/javascript">
        function googleTranslateElementInit() {
          new google.translate.TranslateElement({ pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE }, 'google_translate_element');
        }
      </script>
      <script type="text/javascript"
        src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit&hl=en"></script>
      <div id="google_translate_element"></div>

    </nav>


  </nav>


</header>


<?php
//inculdin the important classes
include('connection.php');
include('debugging.php');
include('Comments.php');
include('users.php');
include('books.php');
include('discusstions.php');
include('cart.php');
include('order.php');
$db = new Connection();
$connection = $db->getConnection();
?>