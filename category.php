<?php
session_start();
include('books.php');
include('connection.php');
include('debugging.php');
$db = new Connection();
$connection = $db->getConnection();
$book = new Books();

if (isset($_GET['category'])) {
    $category = $_GET['category'];
    $booksByCategory = $book->getBooksByCategory($category);
    echo "<div class='books'>";
    echo '
    <form action="" method="GET">
<label for="keyword" id="search">Search by Book ID or Name:</label>
<input type="text" id="keyword" name="keyword" placeholder="Enter Book ID or Name">
<button class="searchBtn" type="submit">Search</button>
 </form>'; 
    // Display books based on the category using AJAX
    if ($booksByCategory) {

        foreach ($booksByCategory as $bookInfo) {
            // Your code to display book information for each book in $books
            $bookId = $bookInfo->bookID;
            $bookName = $bookInfo->bookName;
            $bookPrice = $bookInfo->bookPrice;
            $publishDate = $bookInfo->publishDate;
            $bookPic = $bookInfo->bookPic;
            $publishedBY = $bookInfo->addedBy;

            echo "<div class='book'>";
            echo "<img src='uploads/" . $bookPic . "' />";
            echo "<div class='book-info'>";
            echo "<h2>" . $bookName . "</h2>";
            echo "<p>Price: " . $bookPrice . "</p>";
            echo "<p>Publish Date: " . $publishDate . "</p>";
            echo "<a href='viewBookDetails.php?bookId=" . $bookId . "'><button class='actionBtns'>View details</button></a>";
            echo "<br>";
            if ($publishedBY == $_SESSION['uid'] || ($_SESSION["role"] == "admin")) {
                echo '<a href="edit_books.php?id=' . $bookId . '"><button class="actionBtns">Edit Book</button></a>';
                echo "<br>";
                echo '<a href="delete_books.php?id=' . $bookId . '"><button class="actionBtns">Delete Book</button></a>';
            }
            if ($publishedBY != $_SESSION['uid']) {
                // Form for adding a book to the cart
                echo "<form method='post'>";
                echo "<input type='hidden' name='bookID' value='" . $bookId . "'>";
                echo "<input type='submit' class='btnCart' name='btnCart'  value='Add to Cart'>";
                echo "</form>";
            }
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

            echo "</div>"; // Closing div for 'book-info'
            echo "</div>"; // Closing div for 'book'
        }
        echo "</div>"; // Closing div for 'books'
    } else {
        echo "No books found.";
    }

} elseif (isset($_GET['keyword'])) {
    $keyword = $_GET['keyword'];
    $books = $book->initWithIdOrName($keyword);

    if ($books) {
        foreach ($books as $bookInfo) {
            // Display book information for each book in $books
            echo "<div class='book'>";
            echo "<img src='uploads/" . $bookInfo->bookPic . "' />";
            echo "<div class='book-info'>";
            echo "<h2>" . $bookInfo->bookName . "</h2>";
            echo "<p>Price: " . $bookInfo->bookPrice . "</p>";
            echo "<p>Publish Date: " . $bookInfo->publishDate . "</p>";
            echo "<button>Add to Cart</button>";
            echo "</div>";
            echo "</div>";
        }
    } else {
        echo "No books found.";
    }
}

?>