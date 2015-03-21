<?php
$servername = "localhost";
$username = "tl_manager";
$password = "Naruto1996!";
$rdbname = "tl_manager";

// Create connection
$conn = new mysqli($servername, $username, $password,$rdbname);

// Check connection
if ($conn->connect_error) {
    die("Error Contact Admin" . $conn->connect_error);
} 
//echo "Connected successfully";
?>