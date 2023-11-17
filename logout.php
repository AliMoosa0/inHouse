<?php

include 'debugging.php';

$lgnObject = new Users();
$lgnObject->logout();

header('Location: home.php');

?>