<?php

$servername = "localhost";
$username = "root"; // Ensure that this matches your MySQL username
$password = ""; // Leave this empty if you haven't set a password for the user
$database = "teamup";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
