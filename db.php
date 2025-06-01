<?php
$connection = 'localhost';
$username = 'phpgoof';
$password = 'password';
$database = 'phpgoof'; // Use a constant or variable instead of a string literal

session_start();

$conn = mysqli_connect($connection, $username, $password, $database);

?>