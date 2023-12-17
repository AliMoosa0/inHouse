<?php include "header.php"; ?>

<style>
    /* Reset default margin and padding */
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
    }

    /* Container to limit width */
    .container {
        width: 80%;
        margin: 0 auto;
    }

    /* Navigation Links */
    .nav-links ul {
        list-style-type: none;
        padding: 0;
    }

    .nav-links li {
        display: inline;
        margin-right: 20px;
    }

    .nav-links a {
        text-decoration: none;
        color: #333;
        font-weight: bold;
    }

    /* Sections */
    .hidden-section {
        display: none;
        width: 100%;
    }

    /* Table Styling */
    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    th,
    td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }

    /* Button Styling */
    button {
        padding: 8px 12px;
        background-color: #4CAF50;
        color: white;
        border: none;
        cursor: pointer;
        border-radius: 4px;
    }

    button:hover {
        background-color: #45a049;
    }
</style>
<h1 class="title">Admin Pannel</h1>
<div class=" nav-links">
    <ul>
        <li><button class="searchBtn"><a href="#" onclick="showSection('manageComments')">Manage Comments</a></button>
        </li>
        <li><button class="searchBtn"><a href="#" onclick="showSection('manageUsers')">Manage Users</a></button></li>
    </ul>
    </div>

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
                echo "<a href='deleteComment.php?id=$commentID'><button>Delete Comment</button></a>";
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
                echo "<a href='delete_user.php?id=$userID'><button>Delete</button></a>";
                echo " | ";
                echo "<a href='change_password.php?id=$userID'><button>Change Password</button></a>";
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