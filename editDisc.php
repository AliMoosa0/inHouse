<?php

include "header.php";


$discID = 0;

if (isset($_GET['id'])) {
    $discID = $_GET['id'];
} elseif (isset($_POST['id'])) {
    $discID = $_POST['id'];
}
// echo $discID;

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


$Disc = new Discussions();
$Disc->getDiscWithID($discID);
$discVoteUps = $Disc->getVoteUpsWithID($discID);


if (isset($_POST['submitted'])) {

    $Disc = new Discussions();
    $Disc->setDiscTitle($_POST['discTitle']);
    $Disc->setDiscBookName($_POST['discBookName']);
    $Disc->setDiscBody($_POST['discBody']);
    $imgFile = uploadImg();
    $Disc->setDiscBookPic($imgFile);
    $Disc->setCreatedBy($_SESSION['uid']);
    $Disc->setVoteUps($discVoteUps);
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
        /* Basic Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            color: #333;
            line-height: 1.6;
        }

        /* Form Container */
        .form-container {
            width: 80%;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        textarea {
            resize: vertical;
            min-height: 100px;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>


<?php
$listDiscInfo = new Discussions();
$listDiscInfo->getDiscWithID($discID);
?>

<body>
    <div class="form-container">
        <h1>Edit Discussion</h1>
        <form action="editDisc.php" method="POST" enctype="multipart/form-data">
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
                <input type="submit" class="button" value="Edit" />
                </p>
                <input type="hidden" name="submitted" value="1" />

            </fieldset>
        </form>
    </div>
</body>

</html>