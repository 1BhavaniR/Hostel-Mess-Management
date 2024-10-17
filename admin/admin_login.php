<?php
session_start();
include '../includes/dbconn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $admin_email = $_POST['email'];
    $admin_password = $_POST['password'];

    try {
        // Prepare a SQL statement to check admin credentials
        $stmt = $pdo->prepare("SELECT * FROM admins WHERE email = :email");
        $stmt->bindParam(':email', $admin_email);
        $stmt->execute();
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verify if the admin exists and password matches
        if ($admin && password_verify($admin_password, $admin['password'])) {
            // Set session variables
           $_SESSION['admin_id'] = $admin['id']; // Assuming $admin['id'] contains the admin's ID from the database
            $_SESSION['admin_email'] = $admin['email'];

            // Redirect to admin dashboard
            header("Location: admin_dashboard.php");
            exit();
        } else {
            $error_message = "Invalid login credentials";
        }
    } catch (PDOException $e) {
        $error_message = "Database error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card shadow-lg p-4" style="width: 100%; max-width: 400px;">
            <h3 class="text-center mb-4">Admin Sign In</h3>
            <?php if (isset($error_message)) : ?>
                <div class="alert alert-danger"><?php echo htmlspecialchars($error_message); ?></div>
            <?php endif; ?>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
                        <div class="input-group-append">
                            <span class="input-group-text toggle-password" toggle="#password">
                                <i class="fas fa-eye"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn bg-dark text-white btn-block">Sign In</button>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
    $(document).ready(function() {
        $(".toggle-password").click(function() {
            let input = $($(this).attr("toggle"));
            let icon = $(this).find("i");

            if (input.attr("type") === "password") {
                input.attr("type", "text");
                icon.removeClass("fa-eye").addClass("fa-eye-slash");
            } else {
                input.attr("type", "password");
                icon.removeClass("fa-eye-slash").addClass("fa-eye");
            }
        });
    });
    </script>
</body>
</html>
