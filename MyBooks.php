<?php
include "header.php";
// Code for displaying multiple books
$books = new Books();
$userID = $_SESSION['uid'];
$row = $books->getBooksByAddedBy($userID);
echo "<h1 class='title'>My Books</h1>";


if (isset($_SESSION['username'])) {
    echo '<a href="addBooks.php"><button class="addbBtn">Add a Book</button></a>';
} else {
    echo "<h1>you are not logged in</h1>";
}




if (isset($_GET['keyword'])) {


    $keyword = $_GET['keyword'];
    $book = new Books();
    $books = $book->initWithIdOrNameMy($keyword);
    echo "<div class='books'>";
    for ($i = 0; $i < count($row); $i++) {
        echo "<div class='book'>";
        echo "<img src='uploads/" . $row[$i]->bookPic . "' />";
        echo "<div class='book-info'>";
        echo "<h2>" . $row[$i]->bookName . "</h2>";
        echo "<p>Price: " . $row[$i]->bookPrice . "</p>";
        echo "<p>Publish Date: " . $row[$i]->publishDate . "</p>";
        echo "<a href='viewBookDetails.php?bookId=" . $row[$i]->bookID . "'><button class='actionBtns'>View details</button></a>";
        echo "<br>";
        echo '<a href="edit_books.php?id=' . $row[$i]->bookID . '"><button class="actionBtns">Edit Book</button></a>';
        echo "<br>";
        echo '<a href="delete_books.php?id=' . $row[$i]->bookID . '"><button class="actionBtns">Delete Book</button></a>';

        // Form for adding a book to the cart
        echo "<form method='post'>";
        echo "<input type='hidden' name='bookID' value='" . $row[$i]->bookID . "'>";
        echo "</form>";

       

        echo "</div>"; // Closing div for 'book-info'
        echo "</div>"; // Closing div for 'book'
    }
    echo "</div>"; // Closing div for 'books'

} else {
    // Displaying multiple books with an 'Add to Cart' button for each
    echo "<div class='books'>";
    for ($i = 0; $i < count($row); $i++) {
        echo "<div class='book'>";
        echo "<img src='uploads/" . $row[$i]->bookPic . "' />";
        echo "<div class='book-info'>";
        echo "<h2>" . $row[$i]->bookName . "</h2>";
        echo "<p>Price: " . $row[$i]->bookPrice . "</p>";
        echo "<p>Publish Date: " . $row[$i]->publishDate . "</p>";
        echo "<a href='viewBookDetails.php?bookId=" . $row[$i]->bookID . "'><button class='actionBtns'>View details</button></a>";
        echo "<br>";
        echo '<a href="edit_books.php?id=' . $row[$i]->bookID . '"><button class="actionBtns">Edit Book</button></a>';
        echo "<br>";
        echo '<a href="delete_books.php?id=' . $row[$i]->bookID . '"><button class="actionBtns">Delete Book</button></a>';

        // Form for adding a book to the cart
        echo "<form method='post'>";
        echo "<input type='hidden' name='bookID' value='" . $row[$i]->bookID . "'>";
        echo "</form>";


        echo "</div>"; // Closing div for 'book-info'
        echo "</div>"; // Closing div for 'book'
    }
    echo "</div>"; // Closing div for 'books'
}

include "footer.html";

?>
</body>