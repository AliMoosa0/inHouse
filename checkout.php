<?php
include "header.php"; // Include your header file   

// Check if the user is logged in
if(!isset($_SESSION['uid'])) {
    // Redirect or show a message indicating that the user needs to log in
    header("Location: login.php");
    exit();
}

?>

<head>
    <title>Checkout</title>
    <!-- Add your stylesheets, scripts, and meta tags here -->
</head>

<body>
    <h1>Checkout</h1>





    
    <?php
    // Display total cost
    if($total) {
        echo "<p>Total Cost: BHD".$total->total."</p>";
    }
    ?>

    <!-- Display a form to confirm checkout -->
    <form method="post" action="">
        


        <input type="submit" name="checkoutBtn" value="Proceed to Checkout">
    </form>

    <?php include "footer.html"; // Include your footer file ?>
</body>

</html>