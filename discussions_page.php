<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Discussions Page</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;

        }

        header {

            color: #fff;
            padding: 10px 0;
        }

        nav ul {
            list-style: none;
            padding: 0;
            display: flex;
            justify-content: space-around;
        }

        nav ul li {
            margin: 0 20px;
        }

        nav a {
            text-decoration: none;
            color: #fff;
            font-weight: bold;
        }

        .container2 {
            max-width: 80%;
            max-height: 100%;
            margin: 0 auto;
            padding: 20px;
        }

        .discussion {
            display: flex;
            border: 1px solid #ccc;
            background-color: #fff;
            margin-bottom: 20px;
            padding: 10px;
        }

        .discussion img {
            max-width: 100px;
            margin-right: 20px;
        }

        .discussion-content {
            flex: 1;
        }

        h2 {
            margin-top: 0;
        }

        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .pagination a {
            padding: 10px;
            margin: 0 5px;
            text-decoration: none;
            background-color: #333;
            color: #fff;
            border-radius: 5px;
        }

        footer {
            /* background-color: #333; */
            color: #fff;
            text-align: center;
            padding: 10px 0;
        }
    </style>
</head>

<body>
    <?php include "header.php";

    echo '

     <a href="addDisc.php">
     <button>Add a Book</button>
      </a>


     ';

    $disc = new Discussions();
    $row = $disc->getAllDisc();
    ?>
    <div class="container2">
        <h1>Discussions Page</h1>
        <?php
        echo "<div class='books'>";
        for ($i = 0; $i < count($row); $i++) {
            echo '
        
            <div class="discussion">
                <img src="uploads/' . $row[$i]->discBookPic . '" alt="Book 1">
                <div class="discussion-content">
                    <h2>' . $row[$i]->discTitle . '</h2>
                    <p><strong>Book:</strong> ' . $row[$i]->discBookName . '</p>
                    <p class="article-description"><strong>Title: </strong>' . substr($row[$i]->discBody, 0, 100) . "..." . '</p>
                    </div>
            </div>
       
    ';
        }
        ?>
    </div>

    <?php
    echo '

    <!-- Repeat similar discussion blocks for other discussions -->

    <div class="pagination">
        <a href="#">1</a>
        <a href="#">2</a>
        <a href="#">3</a>
        <!-- Add more pagination links as needed -->
    </div>
    </div>

    </div>';
    ?>



    <?php include "footer.php"; ?>

</body>

</html>







<body>