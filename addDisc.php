<?php

include "header.php";


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
    echo $_FILES['picture']['name'];
    return $_FILES['picture']['name'];
}




if (isset($_POST['submitted'])) {

    $Disc = new Discussions();
    $Disc->setDiscTitle($_POST['discTitle']);
    $Disc->setDiscBookName($_POST['discBookName']);
    $Disc->setDiscBody($_POST['discBody']);
    $imgFile = uploadImg();
    $Disc->setDiscBookPic($imgFile);
    $Disc->setCreatedBy($_SESSION['uid']);
    $Disc->setVoteUps("0");
    if ($Disc->addDisc()) {
        echo '<p style="color:green"><b>Added Successfully</b></p>';
    } else {
        echo '<p class="error"> Not Successfull </p>';
    }

}
// echo $_SESSION['uid'];
?>



<head>
    <meta charset="UTF-8">
    <title>Add Discussion</title>
    <style>
        /* Form Container */
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


        label {
            display: block;
            margin-bottom: 5px;
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

<body>
    <h1 class="title">Add a Discussion</h1>
    <div class="form-container">

        <form action="addDisc.php" method="POST" enctype="multipart/form-data">
            <fieldset>
                <label for="discTitle"><b>Discussion Title:</b></label>
                <input type="text" id="discTitle" name="discTitle" required>

                <label for="discBookName"><strong>Book Name:</strong></label>
                <input type="text" id="discBookName" name="discBookName" required>

                <label><b>Book picture </b></label>
                <input type="file" name="picture" /><br>

                <label for="discBody"><b>Discussion Body:</b></label>
                <textarea id="discBody" name="discBody" required></textarea>
                <br /><br />
                <input type="submit" class="saveBtn" value="Add" />
                </p>
                <input type="hidden" name="submitted" value="1" />

            </fieldset>
        </form>
    </div>
</body>

</html>