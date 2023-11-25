<?php

include 'header.php';

$bookID = 0;

if (isset($_GET['id'])) {
    $bookID = $_GET['id'];
} elseif (isset($_POST['id'])) {
    $bookID = $_POST['id'];
}
// echo $bookID;

$book = new Books();
$book->initWithId($bookID);
?>

<?php
if (isset($_POST["saved"])) {
    $category = $_POST['category'];
    $title = $_POST['title'];
    $body = $_POST['body'];
    // Validate form data
    if (empty($category) || empty($bookName) || empty($author) || empty($price) || empty($date) || empty($condition)) {
        $error = "Please fill in all fields.";
    } else {
        // Create instances of the classes
        $book = new Books();
        // Save article data and get the article ID
        $book->setBookName($bookName);
        $book->setBookAuthor($author);
        $book->setBookCategory($category);
        $book->setBookPrice($_POST['price']);
        $book->setPublishDate($_POST['publish_date']);
        $book->setBookCondition($_POST['condition']);
        $book->setInStock("1");
        $imgFile = $book->getBookPicWithID($bookID);
        $book->setBookPic($imgFile);
        $book->setAddedBy($_SESSION['uid']);
        $book->updateDB();

        $saved = "book saved successfully!";


    }
}

?>

<div id="main">
    <div class="container">
        <h2>Edit Book</h2>

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
        $books = new Books();
        $article->initWithId($bookID);


        ?>



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
                                            <input type="text" name="name" size="50"
                                                value="<?php echo $article->getBookName(); ?>" /><br>

                                            <label><b>Book Author </b></label>
                                            <input type="text" name="auth"
                                                value="<?php echo $article->getBookAuthor(); ?>" /> <br>


                                            <b>Category </b><br>
                                            <select name="cat">
                                                <option value="<?php echo $book->getBookCategory(); ?>">
                                                    <?php echo $book->getBookCategory(); ?>
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
                                                <option value="<?php echo $book->getBookCondition(); ?>">
                                                    <?php echo $book->getBookCondition(); ?>
                                                </option>
                                                <option value="New">New</option>
                                                <option value="Used">Used</option>
                                                <option value="UnUsable">UnUsable</option>

                                            </select>
                                            <br>
                                            <label><b>Price </b></label>
                                            <input type="text" name="price"
                                                value="<?php echo $article->getBookPrice(); ?>" /><br>

                                            <label><b>Book Image </b></label>
                                            <input type="file" name="picture"
                                                value="<?php echo $article->getBookPic(); ?>" /><br>

                                            <label><b>Publish Date </b></label>
                                            <input type="date" name="publish_date"
                                                value="<?php echo $article->getPublishDate(); ?>" /><br>



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