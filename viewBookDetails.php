<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        .book-details {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 5px;
            margin: 20px 0;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
        }

        .book-details h2 {
            font-size: 24px;
            margin-bottom: 10px;
        }
    </style>
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
            $addedBy = $bookInfo->addedBy;

            // Display book details
            echo "<div class='book-details'>";
            echo "<img src='uploads/" . $bookPic . "' alt='Book Cover'>";
            echo "<h2>" . $bookName . "</h2>";
            echo "<p><strong>ID:</strong> " . $bookId . "</p>";
            echo "<p><strong>Author:</strong> " . $bookAuthor . "</p>";
            echo "<p><strong>Category:</strong> " . $bookCategory . "</p>";
            echo "<p><strong>Price:</strong> " . $bookPrice . "</p>";
            echo "<p><strong>Publish Date:</strong> " . $publishDate . "</p>";
            echo "<p><strong>Condition:</strong> " . $bookCondition . "</p>";
            echo "<p><strong>In Stock:</strong> " . $inStock . "</p>";
            echo "<p><strong>Added By:</strong> " . $addedBy . "</p>";



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