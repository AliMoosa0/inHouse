<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Discussions Page</title>

    <style>
        .container2 {
            max-width: 90%;
            max-height: 100%;
            margin: 0 auto;
            padding: 20px;
        }

        .container2 h1 {
            color: #fff;
        }

        .discussion {
            display: flex;
            border: 1px solid #ccc;
            background-color: rgba(1, 1, 2, 0.5);

            margin-bottom: 20px;
            padding: 10px;
            color: #fff;
        }

        .discImg {
            width: 20%;
            height: 30%;
        }

        .discussion-content {
            flex: 1;
        }

        .discH2 {
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

        .discBtns {
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;

        }

        .discBtn {
            margin: 0 10px;
            width: 90%;
            padding: 10%;
            background-color: #8c7ceb;
            color: #fff;
        }

        .discBtn:hover {
            background-color: #9A8CEF;
        }

        .addDiscBtn {
            margin: 0 10px;
            width: 10%;
            padding: 1%;
            background-color: #8c7ceb;
            color: #fff;
            margin-bottom: 1%;
        }

        .addDiscBtn:hover {
            background-color: #9A8CEF;

        }
    </style>
</head>

<body>
    <?php
    include "header.php";
    $disc = new Discussions();

    // Check if the search form is submitted with a keyword
    if (isset($_GET['keyword'])) {
        $keyword = $_GET['keyword'];
        $discussions = $disc->searchForDisc($keyword); // Retrieve discussions based on the keyword
    } else {
        $discussions = $disc->getAllDisc(); // If no keyword, fetch all discussions
    }
    ?>



    <body>
        <div class="container2">
            <h1>Discussions Page</h1>

            <form action="" method="GET">
                <label for="keyword">Search By Name:</label>
                <input type="text" id="keyword" name="keyword" placeholder="Enter Book ID or Name">
                <button type="submit">Search</button>
            </form>

            <?php
            if (isset($_SESSION['username'])) {
                echo '<a href="addDisc.php"><button class="addDiscBtn">Add a Discussion</button></a>';
            }

            foreach ($discussions as $discussion) {
                $addedBy = $discussion->createdBy;
                echo '
                    <div class="discussion">
                        <img class="discImg" src="uploads/' . $discussion->discBookPic . '" alt="Book Image">
                        <div class="discussion-content">
                            <h2 class="discH2">' . $discussion->discTitle . '</h2>
                            <p><strong>Book:</strong> ' . $discussion->discBookName . '</p>
                            <p class="article-description"><strong>Title: </strong>' . substr($discussion->discBody, 0, 100) . "..." . '</p>
                            <br>
                            <div class="discBtns">';
                            
                            if($addedBy == $_SESSION["uid"]) {
                                echo '
                                    <a href="editDisc.php?discid=' . $discussion->discID . '"><button class="discBtn">Edit Discussion</button></a>
                                    <br>
                                    <a href="deleteDisc.php?discid=' . $discussion->discID . '"><button class="discBtn">Delete Discussion</button></a>
                                    <br>';
                            }
                            
                            echo '
                                <a href="viewDisc.php?discid=' . $discussion->discID . '"><button class="discBtn">View Discussion</button></a>
                            </div>
                        </div>
                    </div>
                ';
            }
            
            ?>
        </div>

        <?php include "footer.html"; ?>
    </body>

</html>