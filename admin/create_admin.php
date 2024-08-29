<?php
// Include the database connection
include('includes/db.php');

// Define the admin credentials
$username = 'admin';
$email = 'admin@example.com';
$password = '12345'; // Replace this with the desired password

// Hash the password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Prepare SQL statement to insert the admin user
$sql = "INSERT INTO admins (username, email, password) VALUES (:username, :email, :password)";
$stmt = $conn->prepare($sql);

// Bind the parameters
$stmt->bindParam(':username', $username);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':password', $hashedPassword);

// Execute the statement
if ($stmt->execute()) {
    echo "Admin user created successfully!";
} else {
    echo "Error: " . $stmt->errorInfo()[2];
}
?>
