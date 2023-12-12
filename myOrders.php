<?php
ob_start();
include('header.php');

// Retrieve cart information for the logged-in user
$orders = new order();
$userOrder = $orders->initWithID();

// Retrieve incoming orders
$incomingOrders = $orders->getOrders(); // Assuming this function fetches incoming orders
echo "<div class='ordersDiv'>"; // Opening .ordersDiv here
// Display user orders
if ($userOrder) {
    echo "<h1 class='title'>Your Orders</h1>";

    // Group orders by their IDs
    $uniqueOrders = [];
    foreach ($userOrder as $orderItem) {
        $orderID = $orderItem->orderID;
        if (!isset($uniqueOrders[$orderID])) {
            $uniqueOrders[$orderID] = [];
        }
        $uniqueOrders[$orderID][] = $orderItem;
    }

    // Display unique orders along with book names and statuses
    foreach ($uniqueOrders as $orderID => $orders) {
        echo "<div  class'ordersDiv' style='border: 1px solid #ccc; padding: 10px; margin-bottom: 20px;'>";
        echo "<h2  style='margin-bottom: 5px;'>Order ID: " . $orderID . "</h2>";

        $firstIteration = true;

        foreach ($orders as $orderItem) {
            if (!$firstIteration) {
                // echo "<hr>";
            }

            $bookNameQuery = 'SELECT bookName FROM carts WHERE cartID = ' . $orderItem->cartID;
            $db = Database::getInstance();
            $bookNames = $db->multiFetch($bookNameQuery);

            if ($bookNames) {

                echo "<ul style='list-style: none; padding-left: 0;'>";
                foreach ($bookNames as $book) {
                    echo "<li> Book Name: " . $book->bookName . "</li>";
                }
                echo "</ul>";
                echo "<p>Order Status: " . $orderItem->orderStatus . "</p>";
                echo '<br>';
            } else {
                echo "<p>No book information found for this order.</p>";
            }

            $firstIteration = false;
        }
        echo "</div>";

    }
} else {
    echo "<p>You Have No Orders.</p>";
}
echo "</div>"; // Close .ordersDiv here

// Verify if the form was submitted using POST method

// Check if the required fields are present
if (isset($_POST['bookID']) && isset($_POST['state'])) {
    // Sanitize and validate the incoming data
    $bookID = $_POST['bookID'];
    $state = $_POST['state'];

    // Update the order status using the changeStatus method from your Orders class
    $orders = new order();

    // Call the changeStatus method to update the order status
    $orders->changeState($bookID, $state);
    // Redirect to the myOrders.php page to display updated information

    header("Location: myOrders.php");

}

// Display incoming orders
function displayOrders($incomingOrders)
{
    echo "<div class='inOrdersDiv'>"; // Opening .inOrdersDiv here
    if ($incomingOrders) {
        echo "<h1 class='title'>Incoming Orders</h1>";
        foreach ($incomingOrders as $incomingOrder) {
            // Display incoming order details as needed
            echo "<div style='border: 1px solid #ccc; padding: 10px; margin-bottom: 20px;'>";
            echo "<h2 style='margin-bottom: 5px;'>Incoming Book Name: " . $incomingOrder->bookName . "</h2>";

            $stat = $incomingOrder->orderStatus;

            $bookID = $incomingOrder->bookID;
            switch ($stat) {
                case 'Placed':
                    $state = 'Ready for Collection';
                    echo "<form method='POST' action=''>";
                    echo "<input type='hidden' name='bookID' value='$bookID'>";
                    echo "<input type='hidden' name='state' value='$state'>";
                    echo "<input  class='searchBtn' type='submit' value='Ready for Collection'>";
                    echo "</form>";
                    break;
                case 'Ready for Collection':
                    $state = 'Collected';
                    echo "<form method='POST' action=''>";
                    echo "<input type='hidden' name='bookID' value='$bookID'>";
                    echo "<input type='hidden' name='state' value='$state'>";
                    echo "<input class='searchBtn' type='submit' value='Collected'>";
                    echo "</form>";
                    break;
                case 'Collected':
                    echo "Order Complete";
                    break;
                default:
                    echo "Unhandled state";
                    break;
            }

            echo "</div>";
        }
    } else {
        echo "<p>No Incoming Orders.</p>";
    }
    echo "</div>"; // Close .inOrdersDiv here

}
displayOrders($incomingOrders);




?>