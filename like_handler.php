<?php
session_start();
include 'Database.php'; // Include your database connection file
$connection = Database::getInstance();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_SESSION['uid'])) {
        $discID = $_POST['discID'];
        $userID = $_SESSION['uid'];

        // Check if the user has already liked the discussion
        $checkQuery = "SELECT * FROM likes WHERE likeON = '$discID' AND likeBY = '$userID'";
        $checkResult = mysqli_query($connection, $checkQuery);

        if (mysqli_num_rows($checkResult) > 0) {
            // User has already liked, delete the like
            $deleteQuery = "DELETE FROM likes WHERE likeON = '$discID' AND likeBY = '$userID'";
            mysqli_query($connection, $deleteQuery);
        } else {
            // User hasn't liked, add the like
            $insertQuery = "INSERT INTO likes (likeON, likeBY) VALUES ('$discID', '$userID')";
            mysqli_query($connection, $insertQuery);
        }

        // Get total likes for this discussion
        $likeCountQuery = "SELECT COUNT(*) AS totalLikes FROM likes WHERE likeON = '$discID'";
        $likeCountResult = mysqli_query($connection, $likeCountQuery);
        $totalLikes = mysqli_fetch_assoc($likeCountResult)['totalLikes'];

        // Return the total likes as JSON response
        $response = ['likes' => $totalLikes];
        echo json_encode($response);
        exit;
    }
}
?>
