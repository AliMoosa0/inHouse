<?php
include "header.php";

$discID = 0;

if (isset($_GET['discid'])) {
    $discID = $_GET['discid'];
} elseif (isset($_POST['discid'])) {
    $discID = $_POST['discid'];

}
// echo $discID;

if ($discID != 0) {
    $disc = new Discussions();
    $discInfo = $disc->getDiscWithID($discID);

    if ($discInfo) {

        $discName = $discInfo->discTitle;
        $discBookName = $discInfo->discBookName;
        $discBookPic = $discInfo->discBookPic;
        $discBody = $discInfo->discBody;
        $discCreatedBy = $discInfo->createdBy;
        $discPublishDate = $discInfo->publishDate;

        ?>
        <h1 class="title">Book Details</h1>
        <br>
        <!-- Displaying the information -->
        <div class="discussion">
            <img src="uploads/<?php echo $discBookPic; ?>" alt="Book Picture" width="400px">

            <div class="discDetails">
                <h2>Discussion Name:
                    <?php echo $discName; ?>
                </h2>
                <p>Book Name:
                    <?php echo $discBookName; ?>
                </p>

                <p>Discussion Body:
                    <?php echo $discBody; ?>
                </p>

                <p>Created By:
                    <?php echo $discCreatedBy; ?>
                </p>
                <p>Publish Date:
                    <?php echo $discPublishDate; ?>
                </p>
            </div>
        </div>

        <?php
    }
}

// Display the comment section
echo "<div class='comment-section'>";
echo "<h3 calss ='comTit' >Comments</h3>";

// Display the comment form

echo "<form class='comment-form' id='comment-form' method='POST'>";
echo "<input type='hidden' name='discID' value=' $discID'>";
echo '<input type="text" id="usernameField" name="username" value="' . (isset($_SESSION['username']) ? $_SESSION['username'] : '') . '" disabled>';
echo "<textarea id ='txtComment' name='comment' placeholder='Your Comment' required></textarea>";
echo "<button type='submit' class='submit-comment' name='submit-comment'>Submit Comment</button>";
echo "</form>";



// Check if the form is submitted
if (isset($_POST['submit-comment'])) {
    // Get the values from the form
    $author = $_SESSION['username'];
    // var_dump($author);
    $comment = $_POST['comment'];

    // Prepare the query using prepared statements
    $insertQuery = "INSERT INTO comments (commentedBy, discID, uid, comment, commentedAT) VALUES (?, ?, ?, ?, NOW())";
    $stmt = mysqli_prepare($connection, $insertQuery);

    if ($stmt) {
        // Bind the parameters
        mysqli_stmt_bind_param($stmt, 'siss', $author, $discID, $uid, $comment);

        // Assign values to $discID and $uid
        $discID = $_GET['discid'];
        $uid = $_SESSION['uid'];

        // Execute the statement
        $insertResult = mysqli_stmt_execute($stmt);

        if ($insertResult) {
            echo "<p class='success'>Comment added successfully.</p>";
        } else {
            echo "<p class='error'>Error adding comment: " . mysqli_stmt_error($stmt) . "</p>";
        }
    }


}
echo "</div>";






// Display the existing comments for the article
$commentQuery = "SELECT * FROM comments WHERE discID = $discID ORDER BY 'createdAT' DESC";
$commentResult = mysqli_query($connection, $commentQuery);

if (mysqli_num_rows($commentResult) > 0) {
    echo "<ul class='comment-list'>";

    while ($commentRow = mysqli_fetch_assoc($commentResult)) {
        $commentAuthor = $commentRow['commentedBy'];
        $commentContent = $commentRow['comment'];
        $commentCreatedAt = $commentRow['commentedAT'];

        echo "<li class='comment'>";
        echo "<p class='comment-meta'>Comment by $commentAuthor on $commentCreatedAt</p>";
        echo "<p class='comment-content'>$commentContent</p>";
        echo "</li>";
    }


    echo "</ul>";
}



$uid = $_SESSION['uid'];
// Display the thumbs-up button and count
// Check if the user has already liked the discussion
$sessionid = $_SESSION['uid'];
$query = "SELECT COUNT(*) AS liked FROM likes WHERE likeON = $discID AND likeBY = $uid";
$allLikeQry = "SELECT COUNT(*) AS liked FROM likes WHERE likeON = $discID";
$result = mysqli_query($connection, $query);
$theresult = mysqli_query($connection, $allLikeQry);
$row = mysqli_fetch_assoc($result);
$therow = mysqli_fetch_assoc($theresult);

$theliked = $therow['liked'];
echo '<div class="bigdiv">';
echo "<div class='like-button'>";
echo "<h3 class='likeTit'>likes</h3>";
echo "<form method='post' id ='likeForm' action=''>
    <button name='likeButton' type='submit' id='likeButton' value='like'><i class='fa-solid fa-thumbs-up' id='like-btn' data-article-id=''>&#128077;</i></button>
</form>";


// Check if the like button is pressed
if (isset($_POST['likeButton'])) {
    $userId = $_SESSION['uid'];
    $liked = $row['liked'];
    $discID = $_GET['discid'];

    // Check if the user has already liked the discussion
    $query = "SELECT * FROM likes WHERE likeON = $discID AND likeBY = $userId";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) > 0) {
        // User has already liked, so unlike the discussion
        $deleteQuery = "DELETE FROM likes WHERE likeON = $discID AND likeBY = $userId";
        $deleteResult = mysqli_query($connection, $deleteQuery);
    } else {
        if ($userId == null) {
            echo "<p class='error'>Please login to like the discussion.</p>";
        } else {
            // Normal user like operation
            $insertQuery = "INSERT INTO likes (likeON, likeBY) VALUES (?, ?)";
            $stmt = mysqli_prepare($connection, $insertQuery);

            if ($stmt) {
                mysqli_stmt_bind_param($stmt, 'ii', $discID, $userId);
                $insertResult = mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
            }
        }
    }

    // Update the like count after performing the like or unlike action
    $likeCountQuery = "SELECT COUNT(*) AS liked FROM likes WHERE likeON = $discID";
    $likeCountResult = mysqli_query($connection, $likeCountQuery);
    $likeCountRow = mysqli_fetch_assoc($likeCountResult);
    $updatedLikeCount = $likeCountRow['liked'];

    if ($updatedLikeCount !== null) {
        $theliked = $updatedLikeCount;
    }
}

// Update the like count display
echo "<div class='like-count' id='likebuttonid'><span id='like-count'>Likes: $theliked</span></div>";

echo "</div>";
echo "</div>";