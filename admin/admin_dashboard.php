<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="..\assets\css\admin_dashboard.css">
    
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
                <a class="nav-link" href="grocery_bill.php"><i class="fas fa-wallet"></i> Grocery Bill</a>
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
                            <a href="mess.php" class="btn bg-dark text-white btn-primary">Go to Mess Bill</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card shadow">
                        <div class="card-body text-center">
                            <i class="card-icon fas fa-wallet"></i>
                            <h5 class="card-title">Grocery Bill</h5>
                            <p class="card-text">View and manage grocery bills for Hostel.</p>
                            <a href="grocery.php" class="btn bg-dark text-white btn-primary">Go to Grocery Bill</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card shadow">
                        <div class="card-body text-center">
                            <i class="card-icon fas fa-wallet"></i>
                            <h5 class="card-title"></h5>
                            <p class="card-text">View and manage mess menu for Hostel.</p>
                            <a href="mess_menu.php" class="btn bg-dark text-white btn-primary">Go to Mess Menu</a>
                        </div>
                    </div>
                </div>
                <!-- Add more cards as needed -->
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
