<?php


include "header.php";


$comID = 0;

if (isset($_GET['id'])) {
    $comID = $_GET['id'];
} elseif (isset($_POST['id'])) {
    $comID = $_POST['id'];
}
// echo $comID;
include "comments.php";
$comm = new Comments();
$commentInfo = $comm->getCommentWithID($comID);
//  echo $commentInfo->comment;
?>


<style>
    /* Form container styles */
    .form-container {
        max-width: 400px;
        margin: 0 auto;
        padding: 20px;
        background-color: #f2f2f2;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    /* Form title styles */
    .form-title {
        margin-top: 0;
        margin-bottom: 20px;
        font-size: 24px;
    }

    /* Radio button styles */
    .form-radio {
        margin-bottom: 10px;
    }

    /* Submit button styles */
    .form-submit {
        background-color: #337ab7;
        color: #fff;
        border: none;
        padding: 10px 20px;
        cursor: pointer;
    }

    .form-submit:hover {
        background-color: #23527c;
    }
</style>


<?php
if (isset($_POST['submit'])) {

    //test the value of the radio button       
    if (isset($_POST['sure']) && ($_POST['sure'] == 'Yes')) { //delete the record
        
        //delete article 
        if ($comm->deleteComment($comID)) {
            $deleted = "Comment deleted successfully";
        }


    } else {
        $notDeleted = "comment deletion not confirmed";
    }
}
?>

<div id="main">


    <form method="post" class="form-container">
        <?php if (isset($error)): ?>
            <p style="color: red;">
                <?php echo $error; ?>
            </p>
        <?php endif; ?>

        <?php if (isset($deleted)): ?>
            <p style="color: green;">
                <?php echo $deleted; ?>
            </p>
        <?php endif; ?>

        <?php if (isset($notDeleted)): ?>
            <p style="color: red;">
                <?php echo $notDeleted; ?>

            </p>
        <?php endif; ?>
        <br />
        <h2 class="form-title">Delete a Comment</h2>
        <h2>Comment:
            <?php echo $commentInfo->comment ; ?>
        </h2>
        <p>Are you sure you want to delete this comment? <br /><br />
            <label class="form-radio">
                <input type="radio" name="sure" value="Yes" /> Yes
            </label>
            <label class="form-radio">
                <input type="radio" name="sure" value="No" /> No
            </label>
        </p>
        <input type="hidden" name="id" value="<?php echo $bookID; ?>" />
        <p><input type="submit" name="submit" value="Delete" class="form-submit" /></p>

    </form>

</div>