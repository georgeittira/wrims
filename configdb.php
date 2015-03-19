<?php
$servername = "localhost";
$username = "root";
$password = "";
$rdbname = "tl_manager";

// Create connection
$conn = new mysqli($servername, $username, $password,$rdbname);

// Check connection
if ($conn->connect_error) {
    die("Error Contact Admin" . $conn->connect_error);
} 
//echo "Connected successfully";
?>