<?php
ob_start();
include('header.php');

// Retrieve cart information for the logged-in user
$orders = new order();
$userOrder = $orders->initWithID();

// Retrieve incoming orders
$incomingOrders = $orders->getOrders(); // Assuming this function fetches incoming orders
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
        echo "<div style='width: 80%; margin: 0 auto; background-color: rgba(255, 255, 255, 0.8); border-radius: 10px; padding: 10px;'>"; // Set width to 80%, center horizontally, apply transparent background, and rounded edges
        echo "<div class='ordersDiv' style='border: 1px solid #ccc; padding: 10px; margin-bottom: 20px;'>";
        echo "<div id='order_$orderID'>"; 
        
        echo "<h2 style='margin-bottom: 5px;'>Order ID: " . $orderID . "</h2>";
        
        foreach ($orders as $orderItem) {
            $cartID = $orderItem->cartID;
            $bookNameQuery = "SELECT c.bookName, b.bookPrice 
                              FROM carts c 
                              INNER JOIN books b ON c.bookID = b.bookID 
                              WHERE c.cartID = $cartID";
        
            $db = Database::getInstance();
            $booksInfo = $db->multiFetch($bookNameQuery);
        
            if ($booksInfo) {
                echo "<ul style='list-style: none; padding-left: 0;'>";
                foreach ($booksInfo as $book) {
                    echo "<li> Book Name: " . $book->bookName . "</li>";
                    echo "<li> Book Price: " . $book->bookPrice . "</li>";
                }
                echo "</ul>";
                echo "<p>Order Status: " . $orderItem->orderStatus . "</p>";
                echo '<br>';
            } else {
                echo "<p>No book information found for this order.</p>";
            }
        }
        
        echo "</div>";
        
        echo '<button onclick="printOrder(\'order_' . $orderID . '\')" class="searchBtn">Print Order</button>';
        echo "</div>";
        echo "</div>"; // Closing the added div with 80% width
        
    }

} else {
    echo "<p>You Have No Orders.</p>";
}
echo "</div>"; // Close .OrdersDiv here


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
    echo "<div class='inOrdersDiv' style='width: 80%; margin: 0 auto; background-color: rgba(255, 255, 255, 0.8); border-radius: 10px; padding: 10px;'>"; // Opening .inOrdersDiv with styling
    if ($incomingOrders) {
        foreach ($incomingOrders as $incomingOrder) {
            // Display incoming order details as needed
            echo "<div style='border: 1px solid #ccc; padding: 10px; margin-bottom: 20px;'>";
            echo "<h2 style='margin-bottom: 5px;'> Book Name: " . $incomingOrder->bookName . "</h2>";
    
            $stat = $incomingOrder->orderStatus;
    
            $bookID = $incomingOrder->bookID;
            $phoneNumber = $incomingOrder->phoneNumber;
            $theorderUsername = $incomingOrder->username;
    
            switch ($stat) {
                case 'Placed':
                    $state = 'Ready for Collection';
                    echo "<form method='POST' action=''>";
                    echo "<input type='hidden' name='bookID' value='$bookID'>";
                    echo "<p> Name: " . $theorderUsername . "</p>";
                    echo "<p> Phone Number: " . $phoneNumber . "</p>";
                    echo "<input type='hidden' name='state' value='$state'>";
                    echo "<input class='searchBtn' type='submit' value='Ready for Collection'>";
                    echo "</form>";
                    break;
                case 'Ready for Collection':
                    $state = 'Collected';
                    echo "<form method='POST' action=''>";
                    echo "<input type='hidden' name='bookID' value='$bookID'>";
                    echo "<p> Name: " . $theorderUsername . "</p>";
                    echo "<p> Phone Number: " . $phoneNumber . "</p>";
                    echo "<input type='hidden' name='state' value='$state'>";
                    echo "<input class='searchBtn' type='submit' value='Collected'>";
                    echo "</form>";
                    break;
                case 'Collected':
                    echo "<p> Name: " . $theorderUsername . "</p>";
                    echo "<p> Phone Number: " . $phoneNumber . "</p>";
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
    echo "</div>"; // Close .inOrdersDiv
    
}
echo "<br>";
echo "<h1 class='title'>Incoming Orders</h1>";
echo "<br>";


displayOrders($incomingOrders);




?>
<script>
    function printOrder(orderID) {
        var printContent = document.getElementById(orderID).innerHTML;
        var originalContent = document.body.innerHTML;
        document.body.innerHTML = printContent;
        window.print();
        document.body.innerHTML = originalContent;
    }
</script>