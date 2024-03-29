<?php

include 'header.php';

$userID = 0;

if (isset($_GET['id'])) {
    $userID = $_GET['id'];
} elseif (isset($_POST['id'])) {
    $userID = $_POST['id'];
}
// echo $bookID;

$user = new Users();
$user->initWithUid($userID); 
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
        $user->setUid($userID);
        //delete article 
        if ($user->deleteUser()) {
            $deleted = "user deleted successfully";
        }


    } else {
        $notDeleted = "user deletion not confirmed";
    }
}
?>

<div id="main">

    <h1 class="title">Delete User</h1>
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
       
        <h2>Title:
            <?php echo $user->getUsername(); ?>
        </h2>
        <p>Are you sure you want to delete this User? <br /><br />
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