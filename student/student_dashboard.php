<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="icon" href="assets/images/logos/tpgit_logo.png" type="image/png" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="..\assets\css\admin_dashboard.css">
    
</head>
<body>
    <div class="sidebar">
        <h4 class="text-center">Student Dashboard</h4>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="student_dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="user_profile.php"><i class="fas fa-user-plus"></i> User Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="mess_bill.php"><i class="fas fa-wallet"></i> Mess Bill</a>
            </li>
        </ul>
    </div>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card shadow">
                        <div class="card-body text-center">
                            <i class="card-icon fas fa-user-plus"></i>
                            <h5 class="card-title">User Profile</h5>
                            <p class="card-text"> View and Manage Your Profile flawlessly</p>
                            <a href="add_student.php" class="btn bg-dark text-white btn-primary">View</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card shadow">
                        <div class="card-body text-center">
                            <i class="card-icon fas fa-wallet"></i>
                            <h5 class="card-title">Mess Bill</h5>
                            <p class="card-text">View mess bills.</p>
                            <a href="mess_bill.php" class="btn bg-dark text-white btn-primary">View</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card shadow">
                        <div class="card-body text-center">
                            <i class="card-icon fas fa-wallet"></i>
                            <h5 class="card-title">Mess Menu</h5>
                            <p class="card-text">View and manage your mess bills.</p>
                            <a href="mess_menu.php" class="btn bg-dark text-white btn-primary">View</a>
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
