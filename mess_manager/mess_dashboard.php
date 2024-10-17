<?php
session_start();
require '../includes/dbconn.php'; // Adjust path to dbconn.php

// Check if user is logged in
if (!isset($_SESSION['mess_user_id'])) {
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
            $stmt->bindParam(':id', $_SESSION['mess_user_id']);
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            background-color: #343a40; /* Dark background for the body */
            color: #ffffff; /* White text color */
        }
        .sidebar {
            height: 100vh;
            background-color: #212529; /* Dark sidebar */
            padding: 20px;
            position: fixed; /* Fixed position for the sidebar */
            width: 250px; /* Fixed width for the sidebar */
        }
        .sidebar h4 {
            color: #ffffff; /* White text for sidebar heading */
        }
        .sidebar a {
            color: #ffffff; /* White text for sidebar links */
        }
        .sidebar a:hover {
            background-color: #495057; /* Darker background on hover */
        }
        .content {
            margin-left: 250px; /* Margin to leave space for the sidebar */
            padding: 20px; /* Padding for the content */
        }
        .card {
            background-color: #495057; /* Dark card background */
            color: #ffffff; /* White text for cards */
        }
        .card-icon {
            font-size: 3rem; /* Size for card icons */
            color: #ffffff; /* Yellow color for icons */
        }
        .btn-custom {
            background-color: #ffffff; /* Yellow button background */
            color: #212529; /* Dark text for buttons */
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h4 class="text-center">Mess Dashboard</h4>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="mess_dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="update_password.php"><i class="fas fa-key"></i> Update Password</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="mess_grocery.php"><i class="fas fa-shopping-cart"></i> Grocery Bill</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="mess_menu.php"><i class="fas fa-utensils"></i> Mess Menu</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="mess_bill.php"><i class="fas fa-wallet"></i> Mess Bill</a>
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

                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card shadow">
                        <div class="card-body text-center">
                            <i class="card-icon fas fa-shopping-cart"></i>
                            <h5 class="card-title">Grocery Bill</h5>
                            <p class="card-text">View and manage grocery bills for the hostel.</p>
                            <a href="mess_grocery.php" class="btn btn-custom w-100">Update Grocery Bill</a>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card shadow">
                        <div class="card-body text-center">
                            <i class="card-icon fas fa-utensils"></i>
                            <h5 class="card-title">Mess Menu</h5>
                            <p class="card-text">View and manage the mess menu.</p>
                            <a href="mess_menu.php" class="btn btn-custom w-100">Update Mess Menu</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card shadow">
                        <div class="card-body text-center">
                            <i class="card-icon fas fa-wallet"></i>
                            <h5 class="card-title">Mess Bill</h5>
                            <p class="card-text">View and manage mess bills for students.</p>
                            <a href="mess_bill.php" class="btn btn-custom w-100">Update Mess Bill</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card shadow">
                        <div class="card-body text-center">
                            <i class="card-icon fas fa-box-open"></i>
                            <h5 class="card-title">In Stock</h5>
                            <p class="card-text">Check current stock status of items.</p>
                            <a href="mess_update_issued.php" class="btn btn-custom w-100">Update Stock Issued</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
