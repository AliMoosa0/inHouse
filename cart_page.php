<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container66 {
            width: 60%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
        }

        .cart-item {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #fff;
            border-radius: 5px;
        }

        .theImg {
            width: 220px;
            height: 300px;
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
    echo '<h1 class="title">Your Cart</h1>';
    // Check if 'Delete' button for a specific cart item is clicked
    if (isset($_POST['deleteBtn']) && isset($_POST['cartID'])) {
        $cart = new Cart();
        $cartIDToDelete = $_POST['cartID'];
        if ($cart->deleteItem($cartIDToDelete)) {
            echo "Item deleted from cart";
            displayCart(); // Display the cart contents after deletion
            exit(); // Ensure nothing else is executed after deletion
        } else {
            echo "Failed to delete item from cart";
        }
    }





    // Check if the user is logged in
    if (!isset($_SESSION['uid'])) {
        // Redirect or show a message indicating that the user needs to log in
        // Example: header("Location: login.php");
        echo "Please log in to view your cart.";
        exit();
    }

    //handel the place order button
    ?>
    <div class=" container66">
        <?php
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


                foreach ($userCart as $cartItem) {
                    echo "<div class='cart-item' id='cartItem-" . $cartItem->cartID . "'>";
                    echo "<img class='theImg' src='uploads/" . $cartItem->bookPic . "' />";
                    echo "<h2>" . $cartItem->bookName . "</h2>";
                    echo "<p>Price: " . $cartItem->price . "</p>";
                    // Add a 'Delete' button for each item
                    echo "<form method='post'>";
                    echo "<input type='hidden' name='cartID' value='" . $cartItem->cartID . "'>";
                    echo "<button type='submit' name='deleteBtn' class='btnCart' onclick='updateCart(" . $cartItem->cartID . ")'>Delete</button>";

                    echo "</form>";
                    echo "</div>";
                }

            } else {
                echo "<p>Your cart is empty.</p>";
                exit();
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
                echo '<br>';
                echo '<button type="submit" name="checkoutBtn" class="actionBtns">Place Order</button>';
                echo '</form>';
            } else {
                // Handle the case when the cart is empty or total is not available
                
                echo "<p>No items in the cart or total not available.</p>";
            }
            echo '<br>';
            echo '</div>';

        }
        displayCart();
        echo '</div>';
        ?>
    </div>

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