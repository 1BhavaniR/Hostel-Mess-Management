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
        </ul>
    </div>
    <div class="content">
    <div class="container">
        <div class="profile-card">
            <div class="profile-header">
                <h2><i class="fas fa-user-circle"></i> User Profile</h2>
                <p>View your details</p>
            </div>
            <form>
                <!-- Name -->
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" class="form-control" id="name" value="John Doe" readonly>
                </div>

                <!-- Registration Number -->
                <div class="form-group">
                    <label for="regNo">Registration No.</label>
                    <input type="text" class="form-control" id="regNo" value="20241011234" readonly>
                </div>

                <!-- Email -->
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" value="johndoe@example.com" readonly>
                </div>

                <!-- Year of Study (Dropdown) -->
                <div class="form-group">
                    <label for="year">Year of Study</label>
                    <select class="form-select form-control" id="year" disabled>
                        <option value="1st Year">1st Year</option>
                        <option value="2nd Year">2nd Year</option>
                        <option value="3rd Year">3rd Year</option>
                        <option value="Final Year" selected>Final Year</option>
                    </select>
                </div>

                <!-- Department (Dropdown) -->
                <div class="form-group">
                    <label for="department">Department</label>
                    <select class="form-select form-control" id="department" disabled>
                        <option value="Computer Science" selected>Computer Science</option>
                        <option value="Information Technology">Information Technology</option>
                        <option value="Electronics Engineering">Electronics Engineering</option>
                        <option value="Mechanical Engineering">Mechanical Engineering</option>
                    </select>
                </div>

                <!-- Mess Bill Status -->
                <div class="form-group">
                    <label>Mess Bill Status</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="messBillStatus" id="paid" value="paid" disabled>
                        <label class="form-check-label" for="paid">
                            Paid
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="messBillStatus" id="unpaid" value="unpaid" checked disabled>
                        <label class="form-check-label" for="unpaid">
                            Unpaid
                        </label>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
