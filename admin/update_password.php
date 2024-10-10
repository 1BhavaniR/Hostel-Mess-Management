<?php
// Include database connection
include '../includes/dbconn.php';


// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['admin_email']) && !empty($_POST['current_password']) && !empty($_POST['new_password'])) {
        $admin_email = $_POST['admin_email'];
        $current_password = $_POST['current_password'];
        $new_password = $_POST['new_password'];

        // Fetch the current password from the database
        $stmt = $pdo->prepare("SELECT password FROM admins WHERE email = :email");
        $stmt->bindParam(':email', $admin_email);
        $stmt->execute();
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($admin && password_verify($current_password, $admin['password'])) {
            // Hash the new password
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

            try {
                // Update the admin's password in the database
                $update_stmt = $pdo->prepare("UPDATE admins SET password = :password WHERE email = :email");
                $update_stmt->bindParam(':password', $hashed_password);
                $update_stmt->bindParam(':email', $admin_email);
                $update_stmt->execute();

                echo "<div class='alert alert-success'>Password updated successfully.</div>";
            } catch (PDOException $e) {
                echo "<div class='alert alert-danger'>Error updating password: " . $e->getMessage() . "</div>";
            }
        } else {
            echo "<div class='alert alert-danger'>Current password is incorrect.</div>";
        }
    } else {
        echo "<div class='alert alert-warning'>Please fill in all fields.</div>";
    }
}
?>

<!-- HTML Password Update Form -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Password</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/update_password.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>
<body>
<div class="form-container">
    <h2 class="text-center mb-4">Update Password</h2>
    <form method="POST" action="">
        <div class="form-group">
            <input type="email" class="form-control" name="admin_email" placeholder="Enter admin email" required>
        </div>
        <div class="form-group position-relative">
            <input type="password" class="form-control" id="current_password" name="current_password" placeholder="Enter current password" required>
            <span class="toggle-password" toggle="#current_password">
                <i class="fas fa-eye"></i>
            </span>
        </div>
        <div class="form-group position-relative">
            <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Enter new password" required>
            <span class="toggle-password" toggle="#new_password">
                <i class="fas fa-eye"></i>
            </span>
        </div>
        <button type="submit" class="btn btn-dark btn-block">Update Password</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
