<?php

include 'header.php';
// echo $_SESSION['uid'] . empty($_SESSION['uid']);
// echo"<br>";
// echo $_POST['name'];
// echo"<br>";
// echo $_POST['auth'];
// echo"<br>";
// echo $_POST['cat'];
// echo"<br>";
// echo $_POST['publish_date'];
// echo"<br>";
// echo $imgFile;
// echo"<br>";
// echo $_POST['price'];
// echo"<br>";
// echo $_POST['condition'];
// echo"<br>";

// foreach ($_FILES as $file) {
// echo $file['name'];
// echo "<img src='uploads/" . $file['name'] . "' />";
// }
// echo $_FILES['picture'];
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


    if ($book->addBook()) {
        echo '<p style="color:green"><b>Added Successfully</b></p>';
    } else {
        echo '<p class="error"> Not Successfull </p>';
    }

}

?>


<body>
    <div id="content">
        <div id="content-inner">
            <nav id="sidebar">
                <h1>Add a Book</h1>'
                <table cellpadding="" width="80%" align="center">
                    <tr>
                        <td>
                            <form name="" method="post" action="" enctype="multipart/form-data">
                                <fieldset>
                                    <br>
                                    <p>
                                        <label><b> Book Name </b></label>
                                        <input type="text" name="name" size="50" /><br>

                                        <label><b>Book Author </b></label>
                                        <input type="text" name="auth" /> <br>


                                        <b>Category </b><br>
                                        <select name="cat">
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
                                            <option value="New">New</option>
                                            <option value="Used">Used</option>
                                            <option value="UnUsable">UnUsable</option>

                                        </select>
                                        <br>
                                        <label><b>Price </b></label>
                                        <input type="text" name="price" /><br>

                                        <label><b>Book Image </b></label>
                                        <input type="file" name="picture" /><br>

                                        <label><b>Publish Date </b></label>
                                        <input type="date" name="publish_date" /><br>



                                        <br /><br />
                                        <input type="submit" class="button" value="Add" />
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
<?php
include 'footer.html';
?>