<?php

include "header.php";


$discID = 0;

if (isset($_GET['discid'])) {
    $discID = $_GET['discid'];
} elseif (isset($_POST['discid'])) {
    $discID = $_POST['discid'];
    //  echo $discID;
}

echo '<br>';

function uploadImg()
{

    if (isset($_FILES['picture'])) {
        $name = "uploads//" . $_FILES['picture']['name'];
        move_uploaded_file($_FILES['picture']['tmp_name'], $name);
        if ($_FILES['picture']['error'] > 0) {
            echo "<p>There was an error</p>";
            echo $_FILES['picture']['error'];
        } else {
            return $_FILES['picture']['name'];
        }
    }
    return $_FILES['picture']['name'];
}




if (isset($_POST['submitted'])) {


    $Disc = new Discussions();
    $discVoteUps = $Disc->getVoteUpsWithID($discID);
    $Disc->setDiscTitle($_POST['discTitle']);
    $Disc->setDiscBookName($_POST['discBookName']);
    $Disc->setDiscBody($_POST['discBody']);
    $imgFile = uploadImg();
    $Disc->setDiscBookPic($imgFile);
    $Disc->setCreatedBy($_SESSION['uid']);
    $Disc->setVoteUps('0');
    $Disc->setDiscID($discID);


    if ($Disc->updateDB()) {
        echo '<p style="color:green"><b>edited Successfully</b></p>';
    } else {
        echo '<p class="error"> Not Successfull </p>';
    }

}
// echo $_SESSION['uid'];
?>



<head>
    <meta charset="UTF-8">
    <title>Edit Discussion</title>
    <style>
        .form-container {
            margin: auto;
            width: 30%;
            padding: 3%;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #9b9b9b;
            margin-top: 2%;
            border: none;
            /* Remove border */
        }

        /* Form Style */
        form {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border-radius: 3px;
            border: 1px solid #ccc;
        }

        textarea {
            resize: vertical;
            min-height: 100px;
            margin-bottom: 10%;
        }
    </style>
</head>


<?php
$listDiscInfo = new Discussions();
$listDiscInfo->getDiscWithID($discID);
?>

<body>
    <h1 class="title">Edit Discussion</h1>
    <div class=" form-container">
        <form action="" method="POST" enctype="multipart/form-data">
            <fieldset>
                <label for="discTitle">Discussion Title:</label>
                <input type="text" id="discTitle" name="discTitle" value="<?php echo $listDiscInfo->getDiscTitle() ?>"
                    required>

                <label for="discBookName">Book Name:</label>
                <input type="text" id="discBookName" name="discBookName"
                    value="<?php echo $listDiscInfo->getDiscBookName() ?>" required>

                <label><b>Book picture </b></label>
                <input type="file" name="picture" /><br>

                <label for="discBody">Discussion Body:</label>
                <textarea id="discBody" name="discBody" required><?php echo $listDiscInfo->getDiscBody() ?></textarea>
                <br /><br />
                <input type="submit" class="saveBtn" value="Edit" />
                </p>
                <input type="hidden" name="submitted" value="1" />

            </fieldset>
        </form>
    </div>
</body>

</html>