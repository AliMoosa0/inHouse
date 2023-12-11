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
        <!-- TODO: Display ALL books  -->
        
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
    <?php
    if (isset($_GET['category'])) {
        $category = $_GET['category'];
        $booksByCategory = $book->getBooksByCategory($category);

    }

    if (isset($_GET['keyword'])) {
        $keyword = $_GET['keyword'];
        $books = $book->initWithIdOrName($keyword);
        if ($books) {
            foreach ($books as $bookInfo) {
                // Your code to display book information for each book in $books
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
            echo "No books found.";
        }
    } 
    include "footer.html";

    ?>
</body>

</html>