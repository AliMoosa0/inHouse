<?php
// Assuming you've included or required necessary files and initialized classes
include "books.php";
// Check if the book ID is provided in the URL
if (isset($_GET['id'])) {
    $bookId = $_GET['id'];

    // Assuming $booksInstance is an instance of the Books class
    $booksInstance = new Books();
        // Assuming the deleteBook function doesn't take any arguments
        if ($booksInstance->deleteBook()) {
            // Deletion successful
            // Perform actions after successful deletion (redirect, display a message, etc.)
            // For example:
            header("Location: home.php"); // Redirect to book listing page
            exit();
        } else {
            // Deletion failed
            // Handle the failure (display an error message, log the error, etc.)
            echo "Failed to delete the book.";
        }
   
}
else {
    // No book ID provided in the URL
    // Handle the error (display an error message, log the error, etc.)
    echo "No book ID provided.";
}
?>
