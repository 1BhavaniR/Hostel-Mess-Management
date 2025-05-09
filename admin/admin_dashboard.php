<?php
session_start();
require '../includes/dbconn.php'; // Adjust path to dbconn.php

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
                <a class="nav-link  active" href="admin_dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="add_student.php"><i class="fas fa-user-plus"></i> Add Student</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="admin_approval.php"><i class="fas fa-user-plus"></i>View Requests</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="mess_bill.php"><i class="fas fa-wallet"></i> Mess Bill</a>
            </li>
           
            <li class="nav-item">
                <a class="nav-link" href="mess_menu.php"><i class="fas fa-utensils"></i> Mess Menu</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="update_password.php"><i class="fas fa-key"></i> Update Password</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="admin_grocery.php"><i class="fas fa-shopping-cart"></i> Grocery Bill</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="stock.php"><i class="fas fa-shopping-cart"></i> Stock Status</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="view_queries.php"><i class="fas fa-question-circle"></i> View Queries</a>
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
                                <i class="card-icon fas fa-clipboard-list fa-2x"></i> <!-- Changed icon to clipboard -->
                                <h5 class="card-title">Students Request</h5>
                                <p class="card-text">Approve and manage the students</p>
                                <a href="admin_approval.php" class="btn bg-dark text-white btn-primary">Go to Students Request</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card shadow">
                            <div class="card-body text-center">
                                <i class="card-icon fas fa-user-graduate fa-2x"></i> <!-- Changed icon to user graduate -->
                                <h5 class="card-title">Hostel Students</h5>
                                <p class="card-text">View and manage the students</p>
                                <a href="students_list.php" class="btn bg-dark text-white btn-primary">Go to Students</a>
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
                                <a href="admin_grocery.php" class="btn bg-dark text-white btn-primary">Go to Grocery Bill</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card shadow">
                            <div class="card-body text-center">
                                <i class="card-icon fas fa-warehouse"></i>
                                <h5 class="card-title">Stock in Inventory</h5>
                                <p class="card-text">View current stock levels of inventory items.</p>
                                <a href="admin_stock.php" class="btn bg-dark text-white btn-primary">Go to Stock Inventory</a>
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
