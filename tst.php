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
        echo "<div class='ordersDiv' style='border: 1px solid #ccc; padding: 10px; margin-bottom: 20px;'>";
        echo "<div  id='order_$orderID' '>";
        echo "<h2 style='margin-bottom: 5px;'>Order ID: " . $orderID . "</h2>";

        foreach ($orders as $orderItem) {
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
        }
        echo "</div>";

        echo '<button onclick="printOrder(\'order_' . $orderID . '\')" class="print-button">Print Order</button>';
        echo "</div>";

    }

} else {
    echo "<p>You Have No Orders.</p>";
}

include('footer.php');
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