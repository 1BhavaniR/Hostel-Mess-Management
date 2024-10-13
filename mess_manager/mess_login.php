<?php
session_start();
include '../includes/dbconn.php'; // Ensure this file initializes $pdo
<<<<<<< HEAD
=======

// Initialize variables for error and success messages
$error_message = '';
$success_message = '';
>>>>>>> dec93112b8f4ce964c7c64e369a2badaa0a811a8

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mess_username = $_POST['username'];
    $mess_password = $_POST['password'];

    // Prepare a SQL statement to check mess user credentials
    $stmt = $pdo->prepare("SELECT * FROM mess_users WHERE username = :username");
    $stmt->bindParam(':username', $mess_username);
    $stmt->execute();

    // Fetch the user data
    $mess_user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if the user exists and verify the password
    if ($mess_user) {
        if (password_verify($mess_password, $mess_user['password'])) {
            // Password matches, set session variables
            $_SESSION['mess_user_id'] = $mess_user['id'];
            $_SESSION['mess_username'] = $mess_user['username'];
            $_SESSION['mess_role'] = $mess_user['role'];

            // Set success message
            $success_message = "Login successful! Redirecting to your dashboard...";

            // Delay redirect by 2 seconds to allow the success message to display
            header("refresh:2;url=mess_dashboard.php");
            exit(); // Prevent further execution
        } else {
            // Error: Invalid password
            $error_message = "Invalid password. Please try again.";
        }
    // } else {
    //     // Error: Invalid username
    //     $error_message = "Invalid username. Please try again.";
    // }
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mess Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card shadow-lg p-4" style="width: 100%; max-width: 400px;">
            <h3 class="text-center mb-4">Mess Sign In</h3>

            <!-- Display the error message if there is one -->
            <?php if (!empty($error_message)) : ?>
                <div class="alert alert-danger"><?php echo $error_message; ?></div>
            <?php endif; ?>

            <!-- Display the success message if login is successful -->
            <?php if (!empty($success_message)) : ?>
                <div class="alert alert-success"><?php echo $success_message; ?></div>
            <?php endif; ?>

            <form action="" method="POST">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn bg-dark text-white btn-block">Sign In</button>
                <div class="text-center mt-3">
                    <a href="#" class="text-secondary">Forgot Password?</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Include jQuery, Popper.js, and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>