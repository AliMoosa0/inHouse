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

        .discussion2 {
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
            margin-left: 3%;
        }

        .discH2 {
            margin-top: 0;
        }


        .discBtns {
            display: block;
            flex-direction: left;

        }

        .discBtn {
            background-color: #e1ecf4;
            border-radius: 3px;
            border: 1px solid #7aa7c7;
            box-shadow: rgba(255, 255, 255, .7) 0 1px 0 0 inset;
            box-sizing: border-box;
            color: #39739d;
            cursor: pointer;
            display: inline-block;
            font-family: -apple-system, system-ui, "Segoe UI", "Liberation Sans", sans-serif;
            font-size: 13px;
            font-weight: 400;
            line-height: 1.15385;
            margin: 1%;
            outline: none;
            padding: 8px .8em;
            position: relative;
            text-align: center;
            text-decoration: none;
            user-select: none;
            -webkit-user-select: none;
            touch-action: manipulation;
            vertical-align: baseline;
            white-space: nowrap;
        }

        .discBtn:hover,
        .discBtn:focus {
            background-color: #b3d3ea;
            color: #2c5777;
        }

        .discBtn:focus {
            box-shadow: 0 0 0 4px rgba(0, 149, 255, .15);
        }

        .discBtn:active {
            background-color: #a0c7e4;
            box-shadow: none;
            color: #2c5777;
        }

        .addDiscBtn {
            background-color: #e1ecf4;
            border-radius: 3px;
            border: 1px solid #7aa7c7;
            box-shadow: rgba(255, 255, 255, .7) 0 1px 0 0 inset;
            box-sizing: border-box;
            color: #39739d;
            cursor: pointer;
            display: inline-block;
            font-family: -apple-system, system-ui, "Segoe UI", "Liberation Sans", sans-serif;
            font-size: 13px;
            font-weight: 400;
            line-height: 1.15385;
            margin: 2%;
            outline: none;
            padding: 8px .8em;
            position: relative;
            text-align: center;
            text-decoration: none;
            user-select: none;
            -webkit-user-select: none;
            touch-action: manipulation;
            vertical-align: baseline;
            white-space: nowrap;
        }

        .addDiscBtn:hover,
        .addDiscBtn:focus {
            background-color: #b3d3ea;
            color: #2c5777;
        }

        .addDiscBtn:focus {
            box-shadow: 0 0 0 4px rgba(0, 149, 255, .15);
        }

        .addDiscBtn:active {
            background-color: #a0c7e4;
            box-shadow: none;
            color: #2c5777;
        }
    </style>
</head>

<body>
    <?php
    include "header.php";
    $disc = new Discussions();
    $discussionsPerPage = 2; // Adjust as needed
    // Check if the search form is submitted with a keyword
    if (isset($_GET['keyword'])) {
        $keyword = $_GET['keyword'];
        $discussions = $disc->searchForDisc($keyword); // Retrieve discussions based on the keyword
    } else {
        $discussions = $disc->getAllDisc(); // If no keyword, fetch all discussions
    }



    $totalDiscussions = count($discussions);

    // Determine current page
    if (!isset($_GET['page'])) {
        $currentPage = 1;
    } else {
        $currentPage = $_GET['page'];
    }

    // Calculate offset and get paginated discussions
    $offset = ($currentPage - 1) * $discussionsPerPage;
    $paginatedDiscussions = array_slice($discussions, $offset, $discussionsPerPage);

    ?>




    <div class="container2">
        <h1>Discussions Page</h1>

        <form action="" method="GET">
            <label for="keyword">Search By Name:</label>
            <input type="text" id="keyword" name="keyword" placeholder="Enter Book ID or Name">
            <button class="searchBtn" type="submit">Search</button>
        </form>

        <?php
        if (isset($_SESSION['username'])) {
            echo '<a href="addDisc.php"><button class="addDiscBtn">Add a Discussion</button></a>';
        }

        foreach ($paginatedDiscussions as $discussion) {
            $addedBy = $discussion->createdBy;
            


            echo '
                    <div class="discussion2">
                        <img class="discImg" src="uploads/' . $discussion->discBookPic . '" alt="Book Image">
                        <div class="discussion-content">
                            <h2 class="discH2">' . $discussion->discTitle . '</h2>
                            <p><strong>Book:</strong> ' . $discussion->discBookName . '</p>
                            <p class="article-description"><strong>Body: </strong>' . substr($discussion->discBody, 0, 100) . "..." . '</p>
                            <br>
                            <div class="discBtns">';

            if ($addedBy == $_SESSION["uid"] || ($_SESSION["role"] == "admin")) {
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
        <!-- Pagination links -->
        <?php
        $totalPages = ceil($totalDiscussions / $discussionsPerPage);
        for ($i = 1; $i <= $totalPages; $i++) {
            echo '<a href="?page=' . $i . '"><button class="searchBtn" >' . $i . '</button></a>';
        }
        ?>
        <br>

<?php include "footer.html"; ?>

    </div>


</body>

</html>

