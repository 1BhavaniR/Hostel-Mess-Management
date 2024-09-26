<?php
session_start();
include('student_dbconn.php'); // Ensure this points to your correct connection file

// Debugging: Check if the session variable is set correctly
if (!isset($_SESSION['regnumber'])) {
    echo "Session variable regnumber is not set.";
    exit(); // Stop execution if not set
}

$regNumber = $_SESSION['regnumber'];

// Fetch user details from the database
$query = "SELECT * FROM student_approved WHERE regnumber = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $regNumber);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Fetch the user data
    $user = $result->fetch_assoc();
} else {
    echo "User not found for regnumber: " . htmlspecialchars($regNumber); // Show the reg number for debugging
    exit(); // Stop execution if user is not found
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/user_profile.css">
</head>
<body>
    <div class="sidebar">
        <h4 class="text-center">Student Dashboard</h4>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="student_dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="user_profile.php"><i class="fas fa-user-plus"></i> User Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="mess_bill.php"><i class="fas fa-wallet"></i> Mess Bill</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="raise_queries.php"><i class="fas fa-question-circle"></i> Raise Queries</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="update_password.php"><i class="fas fa-lock"></i> Update Password</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </li>
        </ul>
    </div>
    <div class="content">
        <div class="container">
            <div class="profile-card">
                <div class="profile-header">
                    <h2><i class="fas fa-user-circle"></i> User Profile</h2>
                    <p>View your details</p>
                </div>
                <div class="profile-info">
                    <label>Full Name:</label>
                    <span><?php echo htmlspecialchars($user['firstname'] . ' ' . $user['lastname']); ?></span>
                </div>
                <div class="profile-info">
                    <label>Registration Number:</label>
                    <span><?php echo htmlspecialchars($user['regnumber']); ?></span>
                </div>
                <div class="profile-info">
                    <label>Email:</label>
                    <span><?php echo htmlspecialchars($user['email']); ?></span>
                </div>
                <div class="profile-info">
                    <label>Year of Study:</label>
                    <span><?php echo htmlspecialchars($user['year']); ?></span>
                </div>
                <div class="profile-info">
                    <label>Department:</label>
                    <span><?php echo htmlspecialchars($user['department']); ?></span>
                </div>
                <div class="profile-info">
                    <label>Room Number</label>
                    <span><?php echo htmlspecialchars($user['roomno']); ?></span>
                </div>
                <div class="profile-info">
                    <label>Block:</label>
                    <span><?php echo htmlspecialchars($user['block']); ?></span>
                </div>
                <!-- <div class="profile-info">
                    <label>Fees:</label>
                    <span><?php echo htmlspecialchars($user['fees']); ?></span>
                </div> -->
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
