<?php include "header.php"; ?>

<div class="nav-links">
    <ul>
        <li><a href="#" onclick="showSection('manageComments')">Manage Comments</a></li>
        <li><a href="#" onclick="showSection('manageUsers')">Manage Users</a></li>
    </ul>
</div>

<section id="manageComments" class="hidden">
    <!-- Manage Comments content -->
    <div class="data type">
        <span class="data-title">This is the Comments management section</span>
    </div>
    <?php
    include "comments.php";
    $comm = new Comments();
    $row = $comm->getAllComments();

    // Display the existing comments in a table
    if (!empty($row)) {
        echo "<table>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>comment ID</th>";
        echo "<th>Username</th>";
        echo "<th>comment</th>";
        echo "<th>Action</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";

        foreach ($row as $commentRow) {
            $commentID = $commentRow->commentID;
            $commentedBY = $commentRow->commentedBy;
            $comment = $commentRow->comment;

            echo "<tr>";
            echo "<td>$commentID</td>";
            echo "<td>$commentedBY</td>";
            echo "<td>$comment</td>";
            echo "<td>";
            echo "<a href='deleteComment.php?id=$commentID'><button> Delete Comment</button></a>";
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

<section id="manageUsers" class="hidden">
    <!-- Manage Users content -->
    <div class="data type">
        <span class="data-title">This is the Users management section</span>
    </div>
    <?php
    include "Users.php";
    $users = new Users();
    $row = $users->getAllUsers();

    // Display the existing users in a table
    if (!empty($row)) {
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

        foreach ($row as $userRow) {
            $userID = $userRow->uid;
            $userName = $userRow->username;
            $Role = $userRow->role;

            echo "<tr>";
            echo "<td>$userID</td>";
            echo "<td>$userName</td>";
            echo "<td>$Role</td>";
            echo "<td>";
            echo "<a href='delete_user.php?id=$userID'><button> Delete</button></a>";
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
    // Function to hide all sections
    function hideAllSections() {
        document.getElementById('manageComments').classList.add('hidden');
        document.getElementById('manageUsers').classList.add('hidden');
    }

    // Function to show a specific section
    function showSection(sectionId) {
        hideAllSections();
        document.getElementById(sectionId).classList.remove('hidden');
    }

    // Initially hide all sections
    hideAllSections();

    // Get references to menu items
    const manageCommentsLink = document.querySelector('.nav-links li:nth-child(1) a');
    const manageUsersLink = document.querySelector('.nav-links li:nth-child(2) a');

    // Event listeners for menu items
    manageCommentsLink.addEventListener('click', function (event) {
        event.preventDefault();
        showSection('manageComments');
    });

    manageUsersLink.addEventListener('click', function (event) {
        event.preventDefault();
        showSection('manageUsers');
    });
</script>