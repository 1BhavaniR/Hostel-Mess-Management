<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="icon" href="assets/images/logos/tpgit_logo.png" type="image/png" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="..\assets\css\user_profile.css">
    
</head>
<body>
    <div class="sidebar">
        <h4 class="text-center">Student Dashboard</h4>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="student_dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link  active" href="user_profile.php"><i class="fas fa-user-plus"></i> User Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="mess_bill.php"><i class="fas fa-wallet"></i> Mess Bill</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="mess_bill.php"><i class="fas fa-question-circle"></i> <!-- Question circle icon -->
                Raise Queries</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="mess_bill.php"><i class="fas fa-lock"></i>
                Update Password</a>
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
                    <span>John Doe</span>
                </div>
                <div class="profile-info">
                    <label>Registration No.:</label>
                    <span>20241011234</span>
                </div>
                <div class="profile-info">
                    <label>Email:</label>
                    <span>johndoe@example.com</span>
                </div>
                <div class="profile-info">
                    <label>Year of Study:</label>
                    <span>Final Year</span>
                </div>
                <div class="profile-info">
                    <label>Department:</label>
                    <span>Computer Science</span>
                </div>
                <div class="profile-info">
                    <label>Mess Bill Status:</label>
                    <span>Unpaid</span>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
