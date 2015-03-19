<?php
$servername = "localhost";
$username = "root";
$password = "";
$rdbname = "dcms";

// Create connection
$conn_dcms = new mysqli($servername, $username, $password,$rdbname);

// Check connection
if ($conn_dcms->connect_error) {
    die("Error Contact Admin" . $conn->connect_error);
} 
echo "Connected successfully";
?>