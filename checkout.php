<?php
include "header.php"; // Include your header file   

// Check if the user is logged in
if(!isset($_SESSION['uid'])) {
    // Redirect or show a message indicating that the user needs to log in
    header("Location: login.php");
    exit();
}

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['checkoutBtn'])) {
    // Process checkout here
    // Retrieve user ID and total cost from session or database
    $userID = $_SESSION['uid'];
    $totalCost = 0; // Replace this with the actual total cost calculation

    // Assuming you have a method to create orders in your system
    $cart = new Cart(); // Replace with your Cart class
    // $orderID = $cart->createOrder($userID, $totalCost); // Implement this method

    if($orderID) {
        // Redirect to order confirmation page with the newly created order ID
        header("Location: order_confirmation.php?orderID=".$orderID);
        exit();
    } else {
        // Handle failure to create order
        echo "<p>Failed to place the order. Please try again.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

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