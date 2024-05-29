<?php
$host = "localhost"; // Change if your MySQL server is running on a different host
$username = "root"; // Default username for XAMPP
$password = ""; // Default password for XAMPP
$database = "users"; // Change to the name of your database

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>
