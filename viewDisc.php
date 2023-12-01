<style>
    /* Resetting default margins and paddings */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        color: #333;
        margin: 0;
        padding: 20px;
    }

    .discussion {
        background-color: #fff;
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .discussion h1 {
        font-size: 24px;
        margin-bottom: 10px;
    }

    .discussion h2 {
        font-size: 20px;
        margin-bottom: 10px;
    }

    .discussion p {
        font-size: 16px;
        margin-bottom: 10px;
    }

    .discussion img {
        max-width: 100%;
        height: auto;
        margin-bottom: 10px;
        border-radius: 4px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .discussion img {
        max-width: 100%;
        /* Ensures the image resizes responsively */
        height: auto;
        /* Maintains the image's aspect ratio */
        display: block;
        /* Removes any extra space below the image */
        margin-bottom: 10px;
        /* Adds space below the image */
    }
</style>
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
        $discVoteUps = $discInfo->voteUps;
        $discCreatedBy = $discInfo->createdBy;
        $discPublishDate = $discInfo->publishDate;

        ?>

        <!-- Displaying the information -->
        <div class="discussion">
            <h1>Discussion ID:
                <?php echo $discID; ?>
            </h1>
            <h2>Discussion Name:
                <?php echo $discName; ?>
            </h2>
            <p>Book Name:
                <?php echo $discBookName; ?>
            </p>
            <img src="uploads/<?php echo $discBookPic; ?>" alt="Book Picture" width="400px">
            <p>Discussion Body:
                <?php echo $discBody; ?>
            </p>
            <p>Vote Ups:
                <?php echo $discVoteUps; ?>
            </p>
            <p>Created By:
                <?php echo $discCreatedBy; ?>
            </p>
            <p>Publish Date:
                <?php echo $discPublishDate; ?>
            </p>
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
// Check if the user has already liked the article
$sessionid = $_SESSION['uid'];
$query = "SELECT COUNT(*) AS liked FROM likes WHERE discID = $discID AND likeBY = $uid";
$allLikeQry = "SELECT COUNT(*) AS liked FROM likes WHERE discID = $discID";
$result = mysqli_query($connection, $query);
$theresult = mysqli_query($connection, $allLikeQry);
$row = mysqli_fetch_assoc($result);
$therow = mysqli_fetch_assoc($theresult);

$theliked = $therow['liked'];
echo '<div class="bigdiv">';
echo "<div class='like-button'>";
echo "<h3 class='likeTit'>likes</h3>";
echo "<form method='post' id ='likeForm' action=''>
    <button name='likeButton' type='submit' id='likeButton' value='like'><i class='fa-solid fa-thumbs-up' id='like-btn' data-article-id='$articleId'>&#128077;</i></button>
</form>";

echo "<div class='like-count' id ='likebuttonid'><span id='like-count'>Likes: $theliked</span></div>";
$liked = $row['liked'];

// Check if the like button is pressed
if (isset($_POST['likeButton'])) {
    $userId = $_SESSION['uid'];

    // Check if the user has already liked the article
    $query = "SELECT * FROM likes WHERE likeON = $diskID AND likeBY = $userId";
    $result = mysqli_query($connection, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        // User has already liked, so unlike the article
        $deleteQuery = "DELETE FROM ProjectLikes WHERE artical_id = $diskID AND likeBY = $userId";
        $deleteResult = mysqli_query($connection, $deleteQuery);

        if ($deleteResult) {
            // Refresh the page to reflect the updated like count
            // header("Refresh:0");
        } else {
            echo "<p class='error'>Error unliking the article: " . mysqli_error($connection) . "</p>";
        }
    } else {
        if ($userId == null) {
            echo "<p class='error'>Please login to like the article.</p>";
        } else {
            // Normal user like operation
            $insertQuery = "INSERT INTO likes (likeON, likeBY) VALUES (?, ?)";
            $stmt = mysqli_prepare($connection, $insertQuery);

            if ($stmt) {
                mysqli_stmt_bind_param($stmt, 'ii', $userId, $discID);
                $insertResult = mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);

                if ($insertResult) {
                    // Refresh the page to reflect the updated like count
                    //header("Refresh:0");
                } else {
                    echo "<p class='error'>Error liking the article: " . mysqli_error($connection) . "</p>";
                }
            } else {
                echo "<p class='error'>Error preparing the like statement: " . mysqli_error($connection) . "</p>";
            }
        }
    }
}

echo "</div>";
echo "</div>";