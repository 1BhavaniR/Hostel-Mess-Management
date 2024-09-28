<?php
session_start();
require '../includes/db.php'; // Adjust path to db.php

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header('Location: admin_login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    if ($newPassword === $confirmPassword) {
        $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
        try {
            $stmt = $conn->prepare("UPDATE admins SET password = :password WHERE id = :id");
            $stmt->bindParam(':password', $hashedPassword);
            $stmt->bindParam(':id', $_SESSION['admin_id']);
            $stmt->execute();

            $success = "Password updated successfully.";
        } catch (PDOException $e) {
            $error = "Database error: " . $e->getMessage();
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
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/admin_dashboard.css">
</head>
<body>
    <div class="sidebar">
        <h4 class="text-center">Admin Dashboard</h4>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="admin_dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="add_student.php"><i class="fas fa-user-plus"></i> Add Student</a>
            </li>
            <li class="nav-item">
                    <a class="nav-link" href="mess_bill.php"><i class="fas fa-wallet"></i> Mess Bill</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="grocery.php"><i class="fas fa-shopping-cart"></i> Grocery Bill</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="mess_menu.php"><i class="fas fa-utensils"></i> Mess Menu</a>
                </li>
            <li class="nav-item">
                <a class="nav-link" href="update_password.php"><i class="fas fa-key"></i> Update Password</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </li>
        </ul>
    </div>
    <div class="content">
        <div class="container">
            <div class="row">
                <?php if (isset($success)): ?>
                    <div class="alert alert-success"><?php echo htmlspecialchars($success); ?></div>
                <?php endif; ?>
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
                <?php endif; ?>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card shadow">
                            <div class="card-body text-center">
                                <i class="card-icon fas fa-user-plus"></i>
                                <h5 class="card-title">Add Student</h5>
                                <p class="card-text">Manage student records by adding new students.</p>
                                <a href="add_student.php" class="btn bg-dark text-white btn-primary">Go to Add Student</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card shadow">
                            <div class="card-body text-center">
                                <i class="card-icon fas fa-wallet"></i>
                                <h5 class="card-title">Mess Bill</h5>
                                <p class="card-text">View and manage mess bills for students.</p>
                                <a href="mess_bill.php" class="btn bg-dark text-white btn-primary">Go to Mess Bill</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card shadow">
                            <div class="card-body text-center">
                                <i class="card-icon fas fa-shopping-cart"></i>
                                <h5 class="card-title">Grocery Bill</h5>
                                <p class="card-text">View and manage grocery bills for Hostel.</p>
                                <a href="grocery.php" class="btn bg-dark text-white btn-primary">Go to Grocery Bill</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card shadow">
                            <div class="card-body text-center">
                                <i class="card-icon fas fa-utensils"></i>
                                <h5 class="card-title">Mess Menu</h5>
                                <p class="card-text">View and manage mess menu for Hostel.</p>
                                <a href="mess_menu.php" class="btn bg-dark text-white btn-primary">Go to Mess Menu</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card shadow">
                            <div class="card-body text-center">
                                <i class="card-icon fas fa-box-open"></i>
                                <h5 class="card-title">Purchase Item Record</h5>
                                <p class="card-text">View the new items from the inventory.</p>
                                <a href="purchase_record.php" class="btn bg-dark text-white btn-primary">Go to Purchase Item</a>
                            </div>
                        </div>
</div>

<div class="col-lg-4 col-md-6 mb-4">
    <div class="card shadow">
        <div class="card-body text-center">
            <i class="card-icon fas fa-dolly"></i>
            <h5 class="card-title">Issue Item Record</h5>
            <p class="card-text">View the Issue items from inventory.</p>
            <a href="issue_record.php" class="btn bg-dark text-white btn-primary">Go to Issue Item</a>
        </div>
    </div>
</div>

<div class="col-lg-4 col-md-6 mb-4">
    <div class="card shadow">
        <div class="card-body text-center">
            <i class="card-icon fas fa-warehouse"></i>
            <h5 class="card-title">Stock in Inventory</h5>
            <p class="card-text">View current stock levels of inventory items.</p>
            <a href="stock_inventory.php" class="btn bg-dark text-white btn-primary">Go to Stock Inventory</a>
        </div>
    </div>
</div>

                
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
