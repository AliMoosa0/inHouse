<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Second-Hand Book Store</title>


</head>

<body>


    <?php
    include "header.php";

    $book = new Books();
    if (isset($_GET['bookId'])) {
        $bookId = $_GET['bookId'];
        $bookInfo = $book->initWithId($bookId);

        if ($bookInfo) {
            $bookId = $bookInfo->bookID;
            $bookName = $bookInfo->bookName;
            $bookPrice = $bookInfo->bookPrice;
            $publishDate = $bookInfo->publishDate;
            $bookPic = $bookInfo->bookPic;

            echo "<div class='book'>";
            echo "<img src='uploads/$bookPic' alt='$bookPic'>";
            echo "<div class='book-info'>";
            echo "<h2>" . $bookName . "</h2>";
            echo "<p>Price: " . $bookPrice . "</p>";
            echo "<p>Publish Date: " . $publishDate . "</p>";
            echo "<button>Add to Cart</button>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
        } 

    } else {
        // Code for displaying multiple books
        $books = new Books();
        $row = $books->getBooks();
        echo "<h1>Welcome to Our Second-Hand Book Store</h1>";
        echo '
            <form action="" method="GET">
                <label for="bookId">Search by Book ID:</label>
                <input type="text" id="bookId" name="bookId">
                <button type="submit">Search</button>
            </form>
        ';

        if (isset($_SESSION['username'])) {
            // Displaying user-specific content if logged in
            echo "<h1>Welcome, " . $_SESSION['username'] . "</h1>";
            echo '<a href="addBooks.php"><button>Add a Book</button></a>';
        }

        // Displaying multiple books with an 'Add to Cart' button for each
        echo "<div class='books'>";
        for ($i = 0; $i < count($row); $i++) {
            echo "<div class='book'>";
            echo "<img src='uploads/" . $row[$i]->bookPic . "' />";
            echo "<div class='book-info'>";
            echo "<h2>" . $row[$i]->bookName . "</h2>";
            echo "<p>Price: " . $row[$i]->bookPrice . "</p>";
            echo "<p>Publish Date: " . $row[$i]->publishDate . "</p>";
            
            // Form for adding a book to the cart
            echo "<form method='post'>";
            echo "<input type='hidden' name='bookID' value='" . $row[$i]->bookID . "'>";
            echo "<input type='submit' name='btnCart' value='Add to Cart'>";
            echo "</form>";

            // Check if 'Add to Cart' button for a specific book is clicked
            if (isset($_POST['btnCart']) && isset($_POST['bookID']) && $_POST['bookID'] == $row[$i]->bookID) {
                $cart = new Cart();
                $cart->initWith($_SESSION['uid'], $row[$i]->bookID, $row[$i]->bookName, $row[$i]->bookPrice, $row[$i]->bookPic);
                if ($cart->addToCart($_SESSION['uid'])) { // Pass the necessary argument (in this case, user ID)
                    echo "Book added to cart";
                } else {
                    echo "Failed to add book to cart";
                }
            }
            
            echo "</div>"; // Closing div for 'book-info'
            echo "</div>"; // Closing div for 'book'
        }
        echo "</div>"; // Closing div for 'books'
    }
        include "footer.html";
    
    ?>
</body>

</html>