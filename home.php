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
        } else {
            echo "<p>No book found with ID: " . $bookId . "</p>";
        }

    } else {
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
        echo '

        <a href="addBooks.php">
        <button>Add a Book</button>
         </a>


        ';


        echo "</div>";
        echo "<div class='books'>";
        for ($i = 0; $i < count($row); $i++) {

            "<div class='book'>";
            echo "<div class='book'>";
            echo "<img src='uploads/" . $row[$i]->bookPic . "' />";
            echo "<div class='book-info'>";
            echo "<h2>" . $row[$i]->bookName . "</h2>";
            echo "<p>Price: " . $row[$i]->bookPrice . "</p>";
            echo "<p>Publish Date: " . $row[$i]->publishDate . "</p>";
            echo "<a href='viewBookDetails.php?bookId=" . $row[$i]->bookID . "'><button>View details</button></a>";
            echo "<br>";
            echo '<a href="edit_books.php?id=' . $row[$i]->bookID . '"><button>edit Book</button></a>';
            echo "<br>";
            echo '<a href="delete_books.php?id=' . $row[$i]->bookID . '"><button>Delete Book</button></a>';
            echo "</div>";
            echo "</div>";

        }


        echo "</div>";
    }


    include "footer.html";
    ?>

</body>

</html>