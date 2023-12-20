<?php
include('header.php');

$users = new Users();
$users->deleteExpiredTokens();
?>
