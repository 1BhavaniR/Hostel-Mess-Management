<?php
include '../includes/dbconn.php';

$stmt = $pdo->prepare("SELECT email, password FROM mess_users");
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($users as $user) {
    $email = $user['email'];
    $plain_password = $user['password'];

    // Hash the password
    $hashed_password = password_hash($plain_password, PASSWORD_DEFAULT);

    $update_stmt = $pdo->prepare("UPDATE mess_users SET password = :hashed_password WHERE email = :email");
    $update_stmt->bindParam(':hashed_password', $hashed_password);
    $update_stmt->bindParam(':email', $email);
    $update_stmt->execute();
}

echo "Passwords have been hashed and updated successfully.";
?>
