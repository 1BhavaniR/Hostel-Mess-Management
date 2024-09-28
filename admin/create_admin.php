<?php
// Include database connection
include '../includes/db.php';

// Define default admin credentials
$admins = [
    ['username' => 'admin1', 'email' => 'admin1@example.com', 'password' => 'adminpass1'],
    ['username' => 'admin2', 'email' => 'admin2@example.com', 'password' => 'adminpass2'],
    ['username' => 'admin3', 'email' => 'admin3@example.com', 'password' => 'adminpass3'],
    ['username' => 'admin4', 'email' => 'admin4@example.com', 'password' => 'adminpass4'],
];

try {
    // Insert default admin users with hashed passwords
    $stmt = $pdo->prepare("INSERT INTO admins (username, email, password) VALUES (:username, :email, :password)");

    foreach ($admins as $admin) {
        // Hash the password
        $hashed_password = password_hash($admin['password'], PASSWORD_DEFAULT);
        
        // Bind parameters and execute the query
        $stmt->bindParam(':username', $admin['username']);
        $stmt->bindParam(':email', $admin['email']);
        $stmt->bindParam(':password', $hashed_password);
        $stmt->execute();
    }

    echo "Admin accounts with default passwords have been created.";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
