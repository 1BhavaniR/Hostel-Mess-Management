<?php
$servername = "localhost";   // Typically "localhost" for local development
$username = "root";          // Default username for XAMPP is "root"
$password = "";              // Default password for XAMPP is empty (no password)
$database = "mess_management"; // Replace with the actual database name

// Create connection
$dbconn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($dbconn->connect_error) {
    die("Connection failed: " . $dbconn->connect_error);
}
?>
