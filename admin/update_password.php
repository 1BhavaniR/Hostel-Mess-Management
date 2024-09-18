<?php
// Include database connection
include '../includes/db.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_password = $_POST['new_password'];
    $admin_email = 'admin@example.com'; // Assuming only one admin

    // Hash the new password
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    // Update the admin's password in the database
    $stmt = $pdo->prepare("UPDATE admins SET password = :password WHERE email = :email");
    $stmt->bindParam(':password', $hashed_password);
    $stmt->bindParam(':email', $admin_email);
    $stmt->execute();

    echo "Password updated successfully.";
}
?>

<!-- HTML Password Update Form -->
<form method="POST" action="update_password.php">
    <input type="password" name="new_password" placeholder="Enter new password" required>
    <button type="submit">Update Password</button>
</form>