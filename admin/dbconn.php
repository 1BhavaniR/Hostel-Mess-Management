<?php
$host = 'localhost';  // Database host
$dbname = 'mess_management';  // Database name
$username = 'root';  // Database username
$password = '';  // Database password

try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    
    // Set the PDO error mode to exception for better error handling
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Handle connection error
    die("Connection failed: " . $e->getMessage());
}


$dbServername="localhost";
$dbUsername="root";
$dbPassword="";
$dbName="mess_management";
$dbconn = mysqli_connect($dbServername,$dbUsername,$dbPassword,$dbName);


?>