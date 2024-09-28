<?php
session_start();
require '../includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: mess_login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['new_password'])) {
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    if ($newPassword === $confirmPassword) {
        $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
        try {
            $stmt = $conn->prepare("UPDATE mess_users SET password = :password WHERE id = :id");
            $stmt->bindParam(':password', $hashedPassword);
            $stmt->bindParam(':id', $_SESSION['user_id']);
            $stmt->execute();
            $success = "Password updated successfully.";
        } catch (PDOException $e) {
            $error = "Error updating password: " . $e->getMessage();
        }
    } else {
        $error = "Passwords do not match.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mess Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h3>Welcome, <?php echo htmlspecialchars($_SESSION['email']); ?></h3>

        <?php if (isset($success)): ?>
            <div class="alert alert-success"><?php echo htmlspecialchars($success); ?></div>
        <?php elseif (isset($error)): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <!-- Update Password Form -->
        <h4>Update Password</h4>
        <form method="POST" action="mess_dashboard.php">
            <div class="mb-3">
                <label for="new_password" class="form-label">New Password</label>
                <input type="password" class="form-control" id="new_password" name="new_password" required>
            </div>
            <div class="mb-3">
                <label for="confirm_password" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Password</button>
        </form>

        <hr>

        <!-- Inventory Dashboard -->
        <div class="row mt-4">
            <div class="col-md-4">
                <a href="purchase_item.php" class="btn btn-dark w-100">Purchase Item</a>
            </div>
            <div class="col-md-4">
                <a href="issue_item.php" class="btn btn-dark w-100">Issue Item</a>
            </div>
            <div class="col-md-4">
                <a href="stock_inventory.php" class="btn btn-dark w-100">Stock Inventory</a>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
