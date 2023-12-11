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
    function displayBooks($books)
    {
        if ($books) {
            echo "<div class='books'>";
            foreach ($books as $bookInfo) {
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
                echo "<a href='viewBookDetails.php?bookId=" . $bookId . "'><button>View details</button></a>";
                echo "<br>";
                if ($publishedBY == $_SESSION['uid']){
                    echo '<a href="edit_books.php?id=' . $bookId . '"><button>edit Book</button></a>';
                    echo "<br>";
                    echo '<a href="delete_books.php?id=' . $bookId . '"><button>Delete Book</button></a>';
                }

                // Form for adding a book to the cart
                echo "<form method='post'>";
                echo "<input type='hidden' name='bookID' value='" . $bookId . "'>";
                echo "<input type='submit' name='btnCart' value='Add to Cart'>";
                echo "</form>";

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
    }
    ?>
    <div>


        <button onclick="filterBooks('ICT')">ICT</button>
        <button onclick="filterBooks('Web Media')">Web Media</button>
        <button onclick="filterBooks('Engineering')">Engineering</button>
        <button onclick="filterBooks('Logistics')">Logistics</button>
        <button onclick="filterBooks('Business')">Business</button>
        <button onclick="filterBooks('Visual Design')">Visual Design</button>
        <button onclick="filterBooks('Anime')">Anime</button>
        <button onclick="filterBooks('Others')">Others</button>
    </div>

    <div id="bookDisplay">
        <!-- Book display area -->
        <!-- Display books based on the selected category using AJAX -->
        <!-- display all books  -->
        <?php
        if (isset($_GET['keyword'])) {
            echo '
            <form action="" method="GET">
            <label for="keyword">Search by Book ID or Name:</label>
            <input type="text" id="keyword" name="keyword" placeholder="Enter Book ID or Name">
            <button type="submit">Search</button>
             </form>';

            $keyword = $_GET['keyword'];
            $books = $book->initWithIdOrName($keyword);
            displayBooks($books);
        } else {
            // Code for displaying multiple books
        
            $books = $book->getBooks();

            echo "<h1>Welcome to Our Second-Hand Book Store</h1>";
            echo '
        <form action="" method="GET">
        <label for="keyword">Search by Book ID or Name:</label>
        <input type="text" id="keyword" name="keyword" placeholder="Enter Book ID or Name">
        <button type="submit">Search</button>
         </form>';

            if (isset($_SESSION['username'])) {
                // Displaying user-specific content if logged in
                echo "<h1>Welcome, " . $_SESSION['username'] . "</h1>";
                echo '<a href="addBooks.php"><button>Add a Book</button></a>';
            }


            // Displaying multiple books with an 'Add to Cart' button for each
            displayBooks($books);
        }

        include "footer.php";

        ?>

    </div>

    <script>
        // JavaScript function to filter books based on category without page reload
        function filterBooks(category) {
            // AJAX call to fetch books based on category
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState === 4 && this.status === 200) {
                    document.getElementById("bookDisplay").innerHTML = this.responseText;
                }
            };
            xhttp.open("GET", "category.php?category=" + category, true);
            xhttp.send();
        }
    </script>

</body>

</html>