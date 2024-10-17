<?php
session_start();
include '../includes/dbconn.php'; // Ensure this file initializes $pdo

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mess_email = $_POST['email'];
    $mess_password = $_POST['password'];

    // Prepare a SQL statement to check mess user credentials
    $stmt = $pdo->prepare("SELECT * FROM mess_users WHERE email = :email");
    $stmt->bindParam(':email', $mess_email);
    $stmt->execute();

    // Fetch the user data
    $mess_user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if the user exists and verify the password
    if ($mess_user) {
        if (password_verify($mess_password, $mess_user['password'])) {  // Use password_verify
            // Password matches, set session variables
            $_SESSION['mess_user_id'] = $mess_user['id'];
            $_SESSION['mess_username'] = $mess_user['email'];
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
    } else {
        // Error: Invalid email
        $error_message = "Invalid email. Please try again.";
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="password" name="password" required>
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <i class="toggle-password fas fa-eye" id="togglePassword" onclick="togglePassword()"></i>
                            </span>
                        </div>
                    </div>
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
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('togglePassword');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>
