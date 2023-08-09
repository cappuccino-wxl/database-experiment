<?php
$hostname = "127.0.0.1:3316";
$database = "leasing_luxury";
$username = "root";
$password = "lC908omlZNUGgmXk";
$conn = mysqli_connect($hostname, $username, $password);
$db = mysqli_select_db($conn, $database);
?>