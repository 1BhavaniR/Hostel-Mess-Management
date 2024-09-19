<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hostel Mess Management</title>
    <link rel="icon" href="assets/images/hostels/tpgit_logo.png" type="image/png" />
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@100..700&family=Raleway:wght@100..900&family=Roboto+Condensed:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/home.css">
    <link rel="stylesheet" href="assets/css/about.css">
    <link rel="stylesheet" href="assets/css/contact.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/admin.css">
    <style>
        /* Custom styles */
        body {
            margin: 0;
            padding: 0;
        }
        header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 60px;
            background-color: #343a40; 
            z-index: 1000; 
        }
        .navbar-nav .nav-link {
            font-family: 'Raleway', sans-serif;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            font-size: 14px;
            padding: 10px 20px;
            transition: color 0.3s ease, background-color 0.3s ease, letter-spacing 0.3s ease;
            position: relative;
        }
        .navbar-nav .nav-link:hover {
            color: #ffc107;
            background-color: #444444;
            letter-spacing: 2px;
        }
        .navbar-nav .nav-link:before {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            background-color: #ffc107;
            bottom: 0;
            left: 50%;
            transition: width 0.3s ease-in-out, left 0.3s ease-in-out;
        }
        .navbar-nav .nav-link:hover:before {
            width: 100%;
            left: 0;
        }
        .navbar-nav .nav-item.active .nav-link {
            color: #ffc107;
            font-weight: bold;
        }
        .dropdown-menu {
            background-color: #343a40;
            border: none;
        }
        .dropdown-menu .dropdown-item {
            color: white;
            transition: background-color 0.3s ease;
        }
        .dropdown-menu .dropdown-item:hover {
            background-color: #ffc107;
            color: black;
        }
        .content {
            padding-top: 60px; 
            padding-bottom: 60px; 
        }
    </style>
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a style="margin-left:125px" class="navbar-brand" href="home.php">
            <img src="assets/images/hostels/tpgit_logo.png" alt="logo" style="height: 50px;">
            <img style="margin-left:10px" src="assets/images/hostels/TPGIT_HOSTELS.png" alt="logo" style="height: 50px; margin-right:15px;">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a style="margin: 0px 25px;" class="nav-link" href="home.php">Home</a>
                </li>
                <li class="nav-item">
                    <a style="margin: 0px 25px;" class="nav-link" href="about.php">About</a>
                </li>
                <li class="nav-item">
                    <a style="margin: 0px 25px;" class="nav-link" href="contact.php">Contact</a>
                </li>
                <li class="nav-item">
                    <a style="margin: 0px 25px;" class="nav-link" href="User Guide.php">Reimbursement</a>
                </li>
                <li style="margin: 0px 125px 0px 25px " class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Log In
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="student_login.php">Student Login</a></li>
                        <li><a class="dropdown-item" href="admin/admin_login.php">Admin Login</a></li>
                        <li><a class="dropdown-item" href="mess_manager/mess_dashboard.php">Mess Login</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Highlight the active navbar item dynamically
    document.addEventListener("DOMContentLoaded", function () {
        const navLinks = document.querySelectorAll('.nav-link');
        const locationPath = window.location.pathname;

        navLinks.forEach(link => {
            if (locationPath.includes(link.getAttribute('href'))) {
                document.querySelectorAll('.nav-item').forEach(item => item.classList.remove('active'));
                link.parentElement.classList.add('active');
            }
        });
    });
</script>
</body>
</html>
