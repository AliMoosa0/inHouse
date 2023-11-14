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
        background-color: #4CAF50;
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
<?php
// $books = new Books();
// $allBooks = $books->getAllBooks();

// foreach ($allBooks as $book) {
//     echo "Book ID: " . $book['bookID'] . "<br>";
//     echo "Book Name: " . $book['bookName'] . "<br>";
//     echo "Book Author: " . $book['bookAuthor'] . "<br>";
//     // Display other book details as needed
//     echo "<hr>";
// }
?>



<?php include "header.php"; ?>

    <div class="container">
        <h1>Buy and sell your textbooks for the best price</h1>
        <div class="books">
            <div class="book">
                <img src="book1.jpg" alt="Book 1">
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
            
            <div class="book">
                <img src="book1.jpg" alt="Book 1">
                <div class="book-info">
                    <p>Book 1</p>
                    <p>Price: $10</p>
                    <button>Add to Cart</button>
                </div>
            </div>
        </div>
        <!-- Add more books as needed -->


        <div class="books">
            <div class="book">
                <img src="book1.jpg" alt="Book 1">
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
            <!-- Add more books as needed -->
            <div class="book">
                <img src="book1.jpg" alt="Book 1">
                <div class="book-info">
                    <p>Book 1</p>
                    <p>Price: $10</p>
                    <button>Add to Cart</button>
                </div>
            </div>
        </div>
    </div>

    
</body>
</html>
