<head>
    <style>
        h1 {
            text-align: center;
            margin-top: 20px;
        }

        /* Style for each cart item */
        .cart-item {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            /* Align items with space in between */
            align-items: center;
        }

        img {
            width: 100px;
            /* Adjust the image size as needed */
            height: 100px;
            margin-right: 20px;
        }

        h2 {
            font-size: 18px;
            margin-bottom: 5px;
        }

        p {
            font-size: 14px;
            margin: 0;
        }

        /* Style for delete button */
        .delete-btn {
            background-color: #ff0000;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 4px;
            cursor: pointer;
        }

        .cart-total {
            border-top: 2px solid #ccc;
            padding-top: 20px;
            margin-top: 20px;
            text-align: right;
            font-size: 18px;
            color: #333;
        }
    </style>
</head>

<body>

    <?php

    include "header.php"; // Include your header file
    
    // Check if 'Delete' button for a specific cart item is clicked
    if (isset($_POST['deleteBtn']) && isset($_POST['cartID'])) {
        $cart = new Cart();
        $cartIDToDelete = $_POST['cartID'];
        if ($cart->deleteItem($cartIDToDelete)) {
            echo "Item deleted from cart";
            displayCart(); // Display the cart contents after deletion
            // Optionally, return a success message or an indicator of successful deletion
            exit(); // Ensure nothing else is executed after deletion
        } else {
            echo "Failed to delete item from cart";
        }
    }

    // Rest of your code to display the cart contents, including the foreach loop
    


    // Check if the user is logged in
    if (!isset($_SESSION['uid'])) {
        // Redirect or show a message indicating that the user needs to log in
        // Example: header("Location: login.php");
        echo "Please log in to view your cart.";
        exit();
    }

    //handel the place order button
    if (isset($_POST['checkoutBtn'])) {
        // echo "Order placed successfully*************************************";
        
        $order = new order();

        if ($order->insert()) {
            echo "Order placed successfully";
            exit();
        } else {
            echo "Failed to place order";
        }
    }

    function displayCart()
    {
        $userID = $_SESSION['uid'];
        // Retrieve cart information for the logged-in user
        $cart = new Cart();
        $userCart = $cart->getCart($userID); // Replace this with your method to get cart by user ID
    
        // Display cart contents
        if ($userCart) {
            echo "<h1>Your Cart</h1>";

            foreach ($userCart as $cartItem) {
                echo "<div class='cart-item' id='cartItem-" . $cartItem->cartID . "'>";
                echo "<img src='uploads/" . $cartItem->bookPic . "' />";
                echo "<h2>" . $cartItem->bookName . "</h2>";
                echo "<p>Price: " . $cartItem->price . "</p>";
                // Add a 'Delete' button for each item
                echo "<form method='post'>";
                echo "<input type='hidden' name='cartID' value='" . $cartItem->cartID . "'>";
                echo "<input type='submit' name='deleteBtn' value='Delete' onclick='updateCart(" . $cartItem->cartID . ")'>";
                echo "</form>";
                echo "</div>";
            }

        } else {
            echo "<p>Your cart is empty.</p>";
        }

        echo ' <div class="cart-total">';

        // Get total cost for the user's cart
        $cart = new Cart();
        $userID = $_SESSION['uid'];
        $total = $cart->getTotal($userID);

        if ($total) {
            // Display total cost
            echo "<p>Total Cost: BHD" . $total->total . "</p>";
            echo '<form method="POST">';
            echo '<input type="submit" name="checkoutBtn" value="Place Order">';
            echo '</form>';
        } else {
            // Handle the case when the cart is empty or total is not available
            echo "<p>No items in the cart or total not available.</p>";
        }

        echo '</div>';





    }
    displayCart();
    ?>


    <?php
    include "footer.html"; // Include your footer file
    ?>
    <script>
        function updateCart(cartItemId) {
            // AJAX call to update the cart content after deletion
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    // Replace 'cartItem-' with the ID or class of each cart item
                    document.getElementById("cartItem-" + cartItemId).remove();
                }
            };
            xmlhttp.open("GET", "cart_page.php", true); // Replace 'cart_page.php' with your file handling cart display
            xmlhttp.send();
        }
    </script>

</body>