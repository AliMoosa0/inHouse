<?php
include('header.php');

// Retrieve cart information for the logged-in user
$orders = new order();
$userOrder = $orders->initWithID();

// Display cart contents
if ($userOrder) {
    echo "<h1>Your Orders</h1>";

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
        echo "<div style='border: 1px solid #ccc; padding: 10px; margin-bottom: 20px;'>";
        echo "<h2 style='margin-bottom: 5px;'>Order ID: " . $orderID . "</h2>";

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
