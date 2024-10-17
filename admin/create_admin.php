<?php
include '../includes/dbconn.php'; // Ensure the path is correct

// Define the admin data to insert
$admins = [
    ['username' => 'admin1', 'email' => 'admin1@example.com', 'password' => 'adminpass1'],
    ['username' => 'admin2', 'email' => 'admin2@example.com', 'password' => 'adminpass2'],
    ['username' => 'admin3', 'email' => 'admin3@example.com', 'password' => 'adminpass3'],
    ['username' => 'admin4', 'email' => 'admin4@example.com', 'password' => 'adminpass4']
];

try {
    // Prepare the SQL statement to check for existing username or email
    $checkStmt = $pdo->prepare("SELECT COUNT(*) FROM admins WHERE username = :username OR email = :email");

    // Prepare the SQL statement for inserting a new admin
    $insertStmt = $pdo->prepare("INSERT INTO admins (username, email, password) VALUES (:username, :email, :password)");

    foreach ($admins as $admin) {
        // Check if the username or email already exists
        $checkStmt->bindValue(':username', $admin['username']);
        $checkStmt->bindValue(':email', $admin['email']);
        $checkStmt->execute();
        
        if ($checkStmt->fetchColumn() > 0) {
            echo "Username or email " . $admin['username'] . " / " . $admin['email'] . " already exists. Skipping insertion for this record.<br>";
            continue; // Skip this iteration if duplicate found
        }
        
        // Hash the password
        $hashed_password = password_hash($admin['password'], PASSWORD_DEFAULT);

        // Bind values for the insert statement
        $insertStmt->bindValue(':username', $admin['username']);
        $insertStmt->bindValue(':email', $admin['email']);
        $insertStmt->bindValue(':password', $hashed_password);
        
        // Execute the insert statement
        if ($insertStmt->execute()) {
            echo "Admin account created for: " . $admin['email'] . "<br>";
        } else {
            echo "Error inserting admin account for: " . $admin['email'] . "<br>";
        }
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
