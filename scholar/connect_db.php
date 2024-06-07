<?php
// Database configuration
$host = "localhost"; // Your database host (usually "localhost" or IP address)
$username = "root"; // Your database username
$password = ""; // Your database password
$database = "scholarship"; // Your database name

// Establishing a connection to the database
$conn = mysqli_connect($host, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
