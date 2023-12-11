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

    // Display books based on the category using AJAX
    if ($booksByCategory) {
        foreach ($booksByCategory as $bookInfo) {
            // Display book information for each book in $booksByCategory
            echo "<div class='book'>";
            echo "<img src='uploads/" . $bookInfo->bookPic . "' />";
            echo "<div class='book-info'>";
            echo "<h2>" . $bookInfo->bookName . "</h2>";
            echo "<p>Price: " . $bookInfo->bookPrice . "</p>";
            echo "<p>Publish Date: " . $bookInfo->publishDate . "</p>";
            echo "<a href='viewBookDetails.php?bookId=" . $bookInfo->bookID . "'><button>View details</button></a>";
            echo "<br>";
            echo '<a href="edit_books.php?id=' . $bookInfo->bookID . '"><button>Edit Book</button></a>';
            echo "<br>";
            echo '<a href="delete_books.php?id=' . $bookInfo->bookID . '"><button>Delete Book</button></a>';

            // Form for adding a book to the cart
            echo "<form method='post'>";
            echo "<input type='hidden' name='bookID' value='" . $bookInfo->bookID . "'>";
            echo "<input type='submit' name='btnCart' value='Add to Cart'>";
            echo "</form>";

            // Check if 'Add to Cart' button for a specific book is clicked
            if (isset($_POST['btnCart']) && isset($_POST['bookID']) && $_POST['bookID'] == $bookInfo->bookID) {
                $cart = new Cart();
                $cart->initWith($_SESSION['uid'], $bookInfo->bookID, $bookInfo->bookName, $bookInfo->bookPrice, $bookInfo->bookPic, "show");
                if ($cart->addToCart($_SESSION['uid'])) { // Pass the necessary argument (in this case, user ID)
                    echo "Book added to cart";
                } else {
                    echo "Failed to add book to cart";
                }
            }

            echo "</div>"; // Closing div for 'book-info'
            echo "</div>"; // Closing div for 'book'
        }
    } else {
        echo "No books available for this category.";
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