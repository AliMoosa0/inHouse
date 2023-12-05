<?php

include 'header.php';

$bookID = 0;

if (isset($_GET['id'])) {
    $bookID = $_GET['id'];
} elseif (isset($_POST['id'])) {
    $bookID = $_POST['id'];
}
// echo $bookID;



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


$book = new Books();
$book->initWithId($bookID);
?>

<?php
if (isset($_POST['submitted'])) {
    $book = new Books();
    $book->setBookName($_POST['name']);
    $book->setBookAuthor($_POST['auth']);
    $book->setBookCategory($_POST['cat']);
    $book->setBookPrice($_POST['price']);
    $book->setPublishDate($_POST['publish_date']);
    $book->setBookCondition($_POST['condition']);
    $book->setInStock("1");
    $imgFile = uploadImg();
    $book->setBookPic($imgFile);
    $book->setAddedBy($_SESSION['uid']);
    $book->setBookID($bookID);



    if ($book->updateDB()) {
        echo '<p style="color:green"><b>Edited Successfully</b></p>';
    } else {
        echo '<p class="error"> Not Successfull </p>';
    }

}

?>



<style>
    /* Reset */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    /* Body Styles */
    body {
        font-family: Arial, sans-serif;
        background-color: #f5f5f5;
        color: #333;
        line-height: 1.6;
    }

    /* Content Styles */
    #content {
        width: 80%;
        margin: 20px auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    /* Form Styles */
    form {
        width: 100%;
    }

    label {
        font-weight: bold;
        display: block;
        margin-bottom: 5px;
    }

    input[type="text"],
    input[type="date"],
    select {
        width: 100%;
        padding: 8px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
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



<?php if (isset($error)): ?>
    <p style="color: red;">
        <?php echo $error; ?>
    </p>
<?php endif; ?>

<?php if (isset($saved)): ?>
    <p style="color: green;">
        <?php echo $saved; ?>
    </p>
<?php endif; ?>
<?php
$listBookInfo = new Books();
$listBookInfo->initWithId($bookID);

?>


<body>
    <div id="content">
        <div id="content-inner">
            <nav id="sidebar">
                <h1>Edit a Book</h1>'
                <table cellpadding="" width="80%" align="center">
                    <tr>
                        <td>
                            <form name="" method="post" action="" enctype="multipart/form-data">
                                <fieldset>
                                    <br>
                                    <p>
                                        <label><b> Book Name </b></label>
                                        <input type="text" name="name" size="50"
                                            value="<?php echo $listBookInfo->getBookName() ?>" /><br>

                                        <label><b>Book Author </b></label>
                                        <input type="text" name="auth" size="50"
                                            value="<?php echo $listBookInfo->getBookAuthor() ?>" /><br>


                                        <b>Category </b><br>
                                        <select name="cat">
                                            <option value="<?php echo $listBookInfo->getBookCategory(); ?>">

                                                selected:
                                                <?php echo $listBookInfo->getBookCategory(); ?>
                                            </option>
                                            <option value="ICT">ICT</option>
                                            <option value="WEBMEDIA">Web Media</option>
                                            <option value="ENGINEERING">Engineering</option>
                                            <option value="LOGISTiCS">Logistercs</option>
                                            <option value="BUSINESS">business</option>
                                            <option value="VISUALDESIGN">Visual Design</option>
                                            <option value="ANIME">Anime</option>
                                            <option value="others">Others</option>
                                        </select>
                                        <br>

                                        <b>condition </b><br>
                                        <select name="condition">
                                            <option value="<?php echo $listBookInfo->getBookCondition(); ?>">

                                                selected:
                                                <?php echo $listBookInfo->getBookCondition(); ?>
                                            </option>
                                            <option value="New">New</option>
                                            <option value="Used">Used</option>
                                            <option value="UnUsable">UnUsable</option>

                                        </select>
                                        <br>
                                        <label><b>Price </b></label>
                                        <input type="text" name="price"
                                            value="<?php echo $listBookInfo->getBookPrice(); ?>" /><br>

                                        <label><b>Book Image </b></label>
                                        <input type="file" name="picture"
                                            value="<?php echo $listBookInfo->getBookPic(); ?>" /><br>

                                        <label><b>Publish Date </b></label>
                                        <input type="date" name="publish_date"
                                            value="<?php echo $listBookInfo->getPublishDate(); ?>" /><br>



                                        <br /><br />
                                        <input type="submit" class="button" value="Save Changes" />
                                    </p>
                                    <input type="hidden" name="submitted" value="1" />
                                </fieldset>
                            </form>
                        </td>
                    </tr>
                </table>
                </form>
        </div>

        <div class="clr"></div>
    </div>
    </div>
</body>