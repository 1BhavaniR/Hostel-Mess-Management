<?php
include '../includes/db.php';

// Predefined default password
$default_password = 'admin123';

// Hash the default password
$hashed_password = password_hash($default_password, PASSWORD_DEFAULT);

// Insert default admin credentials into the database (if they don't already exist)
$admin_email = 'admin@example.com'; // Use a default admin email

$stmt = $pdo->prepare("INSERT INTO admins (email, password) VALUES (:email, :password) ON DUPLICATE KEY UPDATE password = :password");
$stmt->bindParam(':email', $admin_email);
$stmt->bindParam(':password', $hashed_password);
$stmt->execute();

echo "Admin account with default password created.";
?>
