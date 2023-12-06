<?php
    include "header.php";
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
         echo "<a href='viewBookDetails.php?bookId=" . $row[$i]->bookID . "'><button>View details</button></a>";
         echo "<br>";
         echo '<a href="edit_books.php?id=' . $row[$i]->bookID . '"><button>edit Book</button></a>';
         echo "<br>";
         echo '<a href="delete_books.php?id=' . $row[$i]->bookID . '"><button>Delete Book</button></a>';
         
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
 
     include "footer.html";
 
 ?>
</body>