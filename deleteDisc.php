<?php

include "header.php";


$discID = 0;

if (isset($_GET['discid'])) {
    $discID = $_GET['discid'];
} elseif (isset($_POST['discid'])) {
    $discID = $_POST['discid'];
}
// echo $discID;
// die();
$disc = new Discussions();
$discInfo = $disc->getDiscWithID($discID);
// $disc->getDiscTitle();
// var_dump($discInfo->discID);
// die();
?>


<style>
    /* Form container styles */
    .form-container {
        text-align: center;
        margin: 0 auto;
        padding: 1%;
        background-color: #9b9b9b;
        border-radius: 5px;
        width: 40%;
        height: 25%;
        margin-top: 4%;
    }

    /* Radio button styles */
    .form-radio {
        margin-bottom: 2%;
    }

    /* Submit button styles */
    .form-submit {
        background-color: #337ab7;
        color: #fff;
        border: none;
        padding: 10px 20px;
        cursor: pointer;
    }
</style>
<?php
$Disk = new Discussions();
$discInfo = $Disk->getDiscWithID($discID);
//     var_dump($discID);
// die();
if (isset($_POST['submit'])) {

    //test the value of the radio button       
    if (isset($_POST['sure']) && ($_POST['sure'] == 'Yes')) { //delete the record
        $Disk->getDiscWithID($discID);


        //delete discussion 
        if ($Disk->deleteDisc()) {
            $deleted = "Discussion deleted successfully";
        }


    } else {
        $notDeleted = "Discussion deletion not confirmed";
    }
}
?>

<div id="main">
    <h1 class="title">Delete Discussion</h1>
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

        <h2 class="delteTitle">Title:
            <?php echo $discInfo->discTitle; ?>
        </h2>
        <br>
        <p>Are you sure you want to delete this Discussion? <br /><br />
        <DIV class="form-radio">
            <label>
                <input type="radio" name="sure" value="Yes" /> Yes
            </label>
            <label class="form-radio">
                <input type="radio" name="sure" value="No" /> No
            </label>
        </DIV>
        </p>
        <input type="hidden" name="id" value="<?php echo $discID; ?>" />
        <p><input type="submit" name="submit" value="Delete" class="searchBtn" /></p>

    </form>

</div>