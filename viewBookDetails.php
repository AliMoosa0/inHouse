<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    include "header.php";


    if (isset($_GET['bookId'])) {
        $bookId = $_GET['bookId'];

        // Fetch book details using the provided ID
        $book = new Books();
        $bookInfo = $book->initWithId($bookId);

        if ($bookInfo) {
            // Retrieve all book details using the object properties
            $bookId = $bookInfo->bookID;
            $bookName = $bookInfo->bookName;
            $bookAuthor = $bookInfo->bookAuthor;
            $bookCategory = $bookInfo->bookCategory;
            $bookPrice = $bookInfo->bookPrice;
            $publishDate = $bookInfo->publishDate;
            $bookCondition = $bookInfo->bookCondition;
            $bookPic = $bookInfo->bookPic;
            $inStock = $bookInfo->inStock;
            if ($inStock == 1) {
                $inStock = "Yes";
            } else {
                $inStock = "No";
            }
            $addedBy = $bookInfo->addedBy;
            $publishedBY = $bookInfo->addedBy;
            $db = Database::getInstance();
            $q = 'SELECT username FROM users WHERE uid = \'' . $addedBy . '\'';
            $data = $db->singleFetch($q);
            $addedBy = $data->username;
            
            // Check if 'Add to Cart' button for a specific book is clicked
            if (isset($_POST['btnCart']) && isset($_POST['bookID']) && $_POST['bookID'] == $bookId) {
                $cart = new Cart();
                $cart->initWith($_SESSION['uid'], $bookId, $bookName, $bookPrice, $bookPic, "show");
                if ($cart->addToCart($_SESSION['uid'])) { // Pass the necessary argument (in this case, user ID)
                    echo "Book added to cart";
                } else {
                    echo "Failed to add book to cart";
                }
            }
            //TODO: add a button to add to cart
            echo "<h1 class='title'>Book Details</h1>  ";
            // Display book details
            echo "<div class='book-details'>";
            echo "<img src='uploads/" . $bookPic . "' alt='Book Cover'>";
            echo "<div class='bookDetails'>"; // book-details div
            echo "<h2>" . $bookName . "</h2>";
            echo "<p><strong>Book Number:</strong> " . $bookId . "</p>";
            echo "<p><strong>Author:</strong> " . $bookAuthor . "</p>";
            echo "<p><strong>Category:</strong> " . $bookCategory . "</p>";
            echo "<p><strong>Price:</strong> " . $bookPrice . "</p>";
            echo "<p><strong>Publish Date:</strong> " . $publishDate . "</p>";
            echo "<p><strong>Condition:</strong> " . $bookCondition . "</p>";
            echo "<p><strong>In Stock:</strong> " . $inStock . "</p>";
            echo "<p><strong>Added By:</strong> " . $addedBy . "</p>";
            if ($publishedBY != $_SESSION['uid'] && $_SESSION['username'] != "") {
                // Form for adding a book to the cart
                echo "<form method='post'>";
                echo "<input type='hidden' name='bookID' value='" . $bookId . "'>";
                echo "<input type='submit' class='btnCart' name='btnCart'  value='Add to Cart'>";
                echo "</form>";
            }



            echo "</div>";


            echo "</div>";
        } else {
            echo "<p>No book found with ID: " . $bookId . "</p>";
        }
    } else {
        echo "<p>No book ID provided.</p>";
    }

    include "footer.html";
    ?>

</body>

</html>