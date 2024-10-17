<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header('Location: admin_login.php'); // Redirect to login if not logged in
    exit();
}


// Database connection
$conn = new mysqli('localhost', 'root', '', 'mess_management');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve all queries along with the student's name
$sql = "SELECT student_name, query_area, query_text, created_at FROM queries ORDER BY created_at DESC";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Queries</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/admin_dashboard.css">
</head>
<body>
<div class="sidebar">
        <h4 class="text-center">Admin Dashboard</h4>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link " href="admin_dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
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
                    <a class="nav-link" href="grocery_bill.php"><i class="fas fa-shopping-cart"></i> Grocery Bill</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="mess_menu.php"><i class="fas fa-utensils"></i> Mess Menu</a>
                </li>
            <li class="nav-item">
                <a class="nav-link" href="admin_dashboard.php?action=update_password"><i class="fas fa-key"></i> Update Password</a>
            </li>
            <li class="nav-item">
                <a class="nav-link  active" href="view_queries.php"><i class="fas fa-question-circle"></i> View Queries</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </li>
        </ul>
    </div>
    <div class="content">
    <div class="container mt-5">
    <h2 class="text-center">Student Queries</h2>
    <?php if ($result->num_rows > 0): ?>
        <div class="list-group">
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="list-group-item">
                    <strong>Name:</strong> <?php echo htmlspecialchars($row['student_name']); ?><br>
                    <strong>Area:</strong> <?php echo htmlspecialchars($row['query_area']); ?><br>
                    <strong>Query:</strong> <?php echo nl2br(htmlspecialchars($row['query_text'])); ?><br>
                    <strong>Submitted on:</strong> <?php echo htmlspecialchars($row['created_at']); ?><br>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <div class="alert alert-info">No queries found.</div>
    <?php endif; ?>
</div>
    </div>

</body>
</html>

<?php
$conn->close();
?>
