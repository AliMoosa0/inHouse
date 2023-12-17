<?php include "header.php"; ?>


<style>
    /* Additional styling */
    .wrapper {
        width: 80%;
        align-items: center;
        background-color: #9b9b9b;
        padding: 1%;
        border-radius: 5px;
        margin: 20px auto;
        /* Changed margin to auto for centering horizontally */
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
        text-align: center;
        /* Center text */
    }

    .nav-links ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
    }

    .nav-links ul li {
        display: inline;
        margin-right: 10px;
    }

    .searchBtn {
        text-decoration: none;
        padding: 5px 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #f0f0f0;
        color: #333;
        cursor: pointer;
    }

    .searchBtn a {
        text-decoration: none;

    }


    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    table th,
    table td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    .hidden-section {
        display: none;
    }
</style>

<h1 class="title">Admin Pannel</h1>
<div class="wrapper">
    <div class=" nav-links">
        <ul>
            <li><button class="searchBtn"><a href="#" onclick="showSection('manageComments')">Manage
                        Comments</a></button>
            </li>
            <li><button class="searchBtn"><a href="#" onclick="showSection('manageUsers')">Manage Users</a></button>
            </li>
        </ul>
    </div>
    <br>

    <section id="manageComments" class="hidden-section">
        <div class="data-type">
            <h2>Comments Management</h2>
        </div>
        <?php
        include "comments.php";
        $comments = new Comments();
        $commentRows = $comments->getAllComments();

        if (!empty($commentRows)) {
            echo "<table>";
            echo "<thead>";
            echo "<tr>";
            echo "<th>Comment ID</th>";
            echo "<th>Username</th>";
            echo "<th>Comment</th>";
            echo "<th>Action</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";

            foreach ($commentRows as $commentRow) {
                $commentID = $commentRow->commentID;
                $commentedBy = $commentRow->commentedBy;
                $comment = $commentRow->comment;

                echo "<tr>";
                echo "<td>$commentID</td>";
                echo "<td>$commentedBy</td>";
                echo "<td>$comment</td>";
                echo "<td>";
                echo "<a href='deleteComment.php?id=$commentID'><button class='searchBtn'>Delete Comment</button></a>";
                echo "</td>";
                echo "</tr>";
            }

            echo "</tbody>";
            echo "</table>";
        } else {
            echo "No comments found.";
        }
        ?>
    </section>

    <section id="manageUsers" class="hidden-section">
        <div class="data-type">
            <h2>Users Management</h2>
        </div>
        <?php
        include "Users.php";
        $users = new Users();
        $userRows = $users->getAllUsers();

        if (!empty($userRows)) {
            echo "<table>";
            echo "<thead>";
            echo "<tr>";
            echo "<th>User ID</th>";
            echo "<th>Username</th>";
            echo "<th>Role</th>";
            echo "<th>Action</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";

            foreach ($userRows as $userRow) {
                $userID = $userRow->uid;
                $userName = $userRow->username;
                $role = $userRow->role;

                echo "<tr>";
                echo "<td>$userID</td>";
                echo "<td>$userName</td>";
                echo "<td>$role</td>";
                echo "<td>";
                echo "<a href='delete_user.php?id=$userID'><button class='searchBtn' >Delete</button></a>";
                echo " | ";
                echo "<a href='change_password.php?username=$userName'><button class='searchBtn'>Change Password</button></a>";
                echo "</td>";
                echo "</tr>";
            }

            echo "</tbody>";
            echo "</table>";
        } else {
            echo "No users found.";
        }
        ?>
    </section>
</div>

<script>
    function hideAllSections() {
        const sections = document.querySelectorAll('.hidden-section');
        sections.forEach(section => {
            section.style.display = 'none';
        });
    }

    function showSection(sectionId) {
        hideAllSections();
        document.getElementById(sectionId).style.display = 'block';
    }

    hideAllSections();
</script>