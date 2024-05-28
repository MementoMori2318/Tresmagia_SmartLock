<?php
$host = "localhost"; // Change if your MySQL server is running on a different host
$username = "tresmagia"; // Default username for XAMPP
$password = "tresmagia"; // Default password for XAMPP
$database = "tresmagia_smartlock"; // Change to the name of your database

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($conn) {
    echo "Connected successfully";
}

?>
