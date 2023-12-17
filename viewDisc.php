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
echo '<div class="like-section">';
echo "<div class='like-button'>";
echo "<h3 class='likeTit'>Likes</h3>";
echo "<form method='post' id='likeForm' action=''>
            <button name='likeButton' type='submit' id='likeButton' value='like'><i class='fas fa-thumbs-up' id='like-btn'></i></button>
        </form>";

echo '</div>';

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
// Display the comment section
echo "<div class='comment-section'>";
echo "<h3 class='comTit'>Comments</h3>";

// Display the comment form
echo "<form class='comment-form' id='comment-form' method='POST'>";
echo "<input type='hidden' name='discID' value='$discID'>";
echo '<input type="hidden" id="usernameField" name="username" value="' . (isset($_SESSION['username']) ? $_SESSION['username'] : '') . '">';
echo "<textarea id ='txtComment' name='comment' placeholder='Your Comment' required></textarea>";
echo "<button type='submit' class='submit-comment' name='submit-comment'>Submit Comment</button>";
echo "</form>";

// Check if the form is submitted
if (isset($_POST['submit-comment'])) {
    $author = $_SESSION['username'];
    $comment = $_POST['comment'];
    $notReply = 0;

    // Assign values to $discID and $uid
    $discID = $_POST['discID'];
    $uid = $_SESSION['uid'];

    // Prepare the query for adding a comment
    $insertQuery = "INSERT INTO comments (commentedBy, discID, uid, comment, replyTo, commentedAT) VALUES (?, ?, ?, ?, ?, NOW())";
    $stmt = mysqli_prepare($connection, $insertQuery);

    if ($stmt) {
        // Bind the parameters
        mysqli_stmt_bind_param($stmt, 'siisi', $author, $discID, $uid, $comment, $notReply);

        // Execute the statement
        $insertResult = mysqli_stmt_execute($stmt);

        if ($insertResult) {
            echo "<p class='success'>Comment added successfully.</p>";
        } else {
            echo "<p class='error'>Error adding comment: " . mysqli_stmt_error($stmt) . "</p>";
        }
    }
}

// Check if the form is submitted for replying to a comment
if (isset($_POST['submit-reply'])) {
    $author = $_SESSION['username'];
    $replyComment = $_POST['replyComment'];
    $parentCommentID = $_POST['parentCommentID']; // ID of the comment being replied to

    // Assign values to $discID and $uid
    $discID = $_POST['discID'];
    $uid = $_SESSION['uid'];

    // Prepare the query for inserting a reply
    $insertQuery = "INSERT INTO comments (commentedBy, discID, uid, comment, commentedAT, replyTo) VALUES (?, ?, ?, ?, NOW(), ?)";
    $stmt = mysqli_prepare($connection, $insertQuery);

    if ($stmt) {
        // Bind the parameters
        mysqli_stmt_bind_param($stmt, 'siisi', $author, $discID, $uid, $replyComment, $parentCommentID);

        // Execute the statement
        $insertResult = mysqli_stmt_execute($stmt);

        if ($insertResult) {
            echo "<p class='success'>Reply added successfully.</p>";
            // Redirect to avoid resubmission on page refresh
            header("Location: {$_SERVER['REQUEST_URI']}");
            exit();
        } else {
            echo "<p class='error'>Error adding reply: " . mysqli_stmt_error($stmt) . "</p>";
        }
    }
}

?>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const replyButtons = document.querySelectorAll('.reply-button');

        replyButtons.forEach(button => {
            button.addEventListener('click', function () {
                const commentID = this.getAttribute('data-comment-id');
                const replyForm = document.getElementById(`reply-form-${commentID}`);

                if (replyForm) {
                    if (replyForm.style.display === 'none' || replyForm.style.display === '') {
                        replyForm.style.display = 'block';
                    } else {
                        replyForm.style.display = 'none';
                    }
                }
            });
        });
    });
</script>


<?php




// Display the existing comments for the article
$commentQuery = "SELECT * FROM comments WHERE discID = $discID and replyTO = '0' ORDER BY commentedAT DESC";
$commentResult = mysqli_query($connection, $commentQuery);

if (mysqli_num_rows($commentResult) > 0) {
    echo "<ul class='comment-list'>";
    echo '<div class="comment-section-container">';



    while ($commentRow = mysqli_fetch_assoc($commentResult)) {
        $commentAuthor = $commentRow['commentedBy'];
        $commentContent = $commentRow['comment'];
        $commentCreatedAt = $commentRow['commentedAT'];
        $commentID = $commentRow['commentID'];
        // var_dump($commentID);
        // die();

        echo "<li class='comment'>";
        echo "<p class='comment-meta'>Comment by $commentAuthor on $commentCreatedAt</p>";
        echo "<p class='comment-content'>$commentContent</p>";

        // Add a Reply button for each comment
        echo "<button class='reply-button' data-comment-id='$commentID'>Reply</button>";

        // Add a hidden reply form for each comment
        echo "<div class='reply-form' id='reply-form-$commentID' style='display:none;'>";
        echo "<form class='comment-form' method='POST'>";
        echo "<input type='hidden' name='discID' value='$discID'>";
        echo "<input type='hidden' name='parentCommentID' value='$commentID'>";
        echo "<textarea name='replyComment' placeholder='Your Reply'></textarea>";
        echo "<button type='submit' name='submit-reply'>Submit Reply</button>";
        echo "</form>";
        echo "</div>";

        // Fetch and display replies for the current comment
        $replyQuery = "SELECT * FROM comments WHERE replyTo = $commentID ORDER BY commentedAT ASC";
        $replyResult = mysqli_query($connection, $replyQuery);

        if (mysqli_num_rows($replyResult) > 0) {
            echo "<ul class='reply-list'>";
            while ($replyRow = mysqli_fetch_assoc($replyResult)) {
                $replyAuthor = $replyRow['commentedBy'];
                $replyContent = $replyRow['comment'];
                $replyCreatedAt = $replyRow['commentedAT'];

                echo "<li class='reply'>";
                echo "<p class='reply-meta'>Reply by $replyAuthor on $replyCreatedAt</p>";
                echo "<p class='reply-content'>$replyContent</p>";
                echo "</li>";
            }
            echo "</ul>";
        }

        echo "</li>";
    }

    echo "</ul>";
    echo "</div>";
}


