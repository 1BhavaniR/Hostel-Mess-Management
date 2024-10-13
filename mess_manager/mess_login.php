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

    $mess_user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if the user exists and password matches (assumed plain text for now)
    if ($mess_user) {
        if ($mess_password === $mess_user['password']) { // Use `password_verify` if passwords are hashed
            // Set session variables
            $_SESSION['mess_user_id'] = $mess_user['id'];
            $_SESSION['mess_email'] = $mess_user['email'];

            // Debugging - Ensure session data is set
            // var_dump($_SESSION);

            // Redirect to the mess dashboard
            header("Location: mess_dashboard.php");
            exit(); // Stop further code execution after redirect
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
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card shadow-lg p-4" style="width: 100%; max-width: 400px;">
            <h3 class="text-center mb-4">Mess Sign In</h3>
            <?php if (isset($error_message)) : ?>
                <div class="alert alert-danger"><?php echo $error_message; ?></div>
            <?php endif; ?>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
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
