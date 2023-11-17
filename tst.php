<?php
// Establish database connection
$db = new mysqli('localhost', 'u201902206', 'u201902206', 'db201902206');

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

// Retrieve users' passwords
$query = $db->query("SELECT uid, password FROM users");

while ($row = $query->fetch_assoc()) {
    $hashed_password = password_hash($row['password'], PASSWORD_DEFAULT);
    $uid = $row['uid'];

    // Update the database with hashed password
    $db->query("UPDATE users SET password = '$hashed_password' WHERE uid = '$uid'");
}

echo "Passwords hashed successfully!";
?>