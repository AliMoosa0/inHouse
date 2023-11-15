<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Second-Hand Book Store</title>
    <style>
  
    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    h1 {
        text-align: center;
        color: #333;
    }

    .books {
        display: flex;
        justify-content: space-between;
        flex-wrap: nowrap;
        overflow: auto;
        white-space: nowrap;
    }

    .book {
        width: 33.33%;
        border: 1px solid #ccc;
        background-color: #fff;
        padding: 10px;
        text-align: center;
        position: relative;
        transition: transform 0.3s ease;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .book img {
        max-width: 100%;
    }

    .book:hover {
        transform: scale(1.05);
    }

    .book-info {
        background-color: rgba(0, 0, 0, 0.7);
        color: #fff;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .book:hover .book-info {
        opacity: 1;
    }

    .book-info p {
        margin: 5px;
    }

    .book-info button {
        background-color: #DEAA45;
        color: #fff;
        border: none;
        padding: 5px 10px;
        cursor: pointer;
    }

    footer {
        background-color: #333;
        color: #fff;
        text-align: center;
        padding: 10px 0;
    }
</style>



</head>
<body>
<?php include "header.php"; 
$db = new Connection();
$connection = $db->getConnection();

?>
<div class="container">
<?php
require_once('books.php');  
require_once('Database.php');  
$books = new Books();
// $allBooks = $books->getAllBooks();

// Retrieve books from the database in reverse chronological order
$query = "SELECT * FROM books where inStock = 1 ORDER BY publishDate DESC";
$result = mysqli_query($connection, $query);

echo "<h1>Welcome to Our Second-Hand Book Store</h1>";

//loop to get get the books and store them in the variables + display each book
while ($row = mysqli_fetch_assoc($result)) {
    $bookId = $row['bookID'];
    $bookName = $row['bookName'];
    $bookPrice = $row['bookPrice'];
    $publishDate = $row['publishDate'];
    $bookPic = $row['bookPic'];

    // Display book with price and add to cart button 
    echo "<div class='books'>";
    echo "<div class='book'>";
    echo "<img src='uploads/$bookPic' alt='$bookPic'>";

    echo "<h2 class='book-title'>$bookName</h2>";
    echo "<p>Price: ". $bookPrice .  " </p>";
    echo "<button>Add to Cart</button>";


    echo "</div>"; // Close the book container
    echo "</div>"; // Close the books container
}
?>

    <!-- <div class="container">
        <h1>Welcome to Our Second-Hand Book Store</h1>


        <div class="books">
            <div class="book">
                <img src="book1.jpg" alt="Book 1">
                <br>Book 1
                <div class="book-info">
                    <p>Book 1</p>
                    <p>Price: $10</p>
                    <button>Add to Cart</button>
                </div>
            </div>


            <div class="book">
                <img src="book2.jfif" alt="Book 2">
                <div class="book-info">
                    <p>Book 2</p>
                    <p>Price: $12</p>
                    <button>Add to Cart</button>
                </div>
            </div>
            <div class="book">
                <img src="book3.jfif" alt="Book 3">
                <div class="book-info">
                    <p>Book 3</p>
                    <p>Price: $15</p>
                    <button>Add to Cart</button>
                </div>
            </div>
            
        </div>
    </div> -->

    <?php include "footer.html"; ?>
</body>
</html>
