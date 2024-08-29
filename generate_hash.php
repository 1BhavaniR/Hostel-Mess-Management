<?php
$plainPassword = 'yourPasswordHere'; // Replace with your desired password
$hashedPassword = password_hash($plainPassword, PASSWORD_DEFAULT);
echo $hashedPassword;
?>
