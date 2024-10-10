<?php
// Include database connection (adjust the path as needed)
include '../includes/dbconn.php'; // Make sure $pdo is initialized correctly

// Plain text password
$plainPassword = 'staff123';

// Hash the password using password_hash() function
$hashedPassword = password_hash($plainPassword, PASSWORD_DEFAULT);

// Prepare an SQL statement to insert the user with the hashed password
$stmt = $pdo->prepare("INSERT INTO mess_users (username, password, role) VALUES (:username, :password, :role)");

// Bind values to the SQL statement
$stmt->bindParam(':username', $username);
$stmt->bindParam(':password', $hashedPassword); // Store the hashed password
$stmt->bindParam(':role', $role);

// Set values for username and role
$username = 'messstaff';
$role = 'staff';

// Execute the statement to insert the user
if ($stmt->execute()) {
    echo "User inserted successfully!";
} else {
    echo "Failed to insert user.";
}
?>
