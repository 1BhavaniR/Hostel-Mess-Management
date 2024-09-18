<?php
// Specify the password you want to hash
$password = 'admin123'; // Change this to your desired password

// Hash the password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Output the hashed password
echo $hashed_password;
?>
