<?php

include 'header.php';

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

    // Validate the price as a double value
    $price = $_POST['price'];

    // Check if the entered price is a valid double value
    if (!is_numeric($price) || !filter_var($price, FILTER_VALIDATE_FLOAT)) {
        echo '<p class="error">Please enter a valid price as a numeric value.</p>';
    } else {
        $book->setBookPrice($price);

        // Attempt to add the book only if the price validation is successful
        if ($book->addBook()) {
            echo '<p style="color:green"><b>Added Successfully</b></p>';
        } else {
            echo '<p class="error">Not Successful</p>';
        }
    }
}


?>



<body>
    <h1 class="title">Add a Book</h1>
    <div id="content">

        <div id="content-inner">


            <table cellpadding="" width="80%" align="center">
                <tr>
                    <td>
                        <form name="" method="post" action="" enctype="multipart/form-data">
                            <fieldset>
                                <br>
                                <p>
                                    <label><b> Book Name </b></label>
                                    <input class="addEdit" type="text" name="name" size="50" /><br>

                                    <label><b>Book Author </b></label>
                                    <input class="addEdit" type="text" name="auth" /> <br>

                                    <label><b>Price </b></label>
                                    <input class="addEdit" type="text" name="price" /><br>

                                    <label><b>Publish Date </b></label>
                                    <input class="addEdit" type="date" name="publish_date" /><br>

                                    <b>Category </b><br>
                                    <select name="cat">
                                        <option value="ICT">ICT</option>
                                        <option value="Web Media">Web Media</option>
                                        <option value="Engineering">Engineering</option>
                                        <option value="Logistercs">Logistercs</option>
                                        <option value="business">business</option>
                                        <option value="Visual Design">Visual Design</option>
                                        <option value="Anime">Anime</option>
                                        <option value="Others">Others</option>
                                    </select>
                                    <br>

                                    <b>condition </b><br>
                                    <select name="condition">
                                        <option value="New">New</option>
                                        <option value="Used">Used</option>
                                        <option value="UnUsable">UnUsable</option>

                                    </select>
                                    <br>


                                    <label><b>Book Image </b></label>
                                    <input class="addEdit" type="file" name="picture" /><br>


                                    <br /><br />
                                    <input type="submit" class="saveBtn" value="Add" />
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