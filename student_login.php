<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TPGIT STUDENT PORTAL</title>
    <link rel="icon" href="assets/images/logos/tpgit_logo.png" type="image/png" />
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f5f7fa;
        }
        .title{
            margin: 15px;
            justify-content: center;
            align-items: center;
            color: black;
            font-size: 40px;
            font-weight: 600;
        }
        .login-container {
            margin-top: 90px;
            display: flex;
            justify-content: start;
            align-items: start;
        }

        .form-box {
            background-color: white;
            width: 500px;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .form-title {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .form-box .form-control {
            margin-bottom: 20px;
        }

        .form-box .form-control:focus {
            box-shadow: none;
            border-color: #007bff;
        }

        .form-box .captcha {
            font-size: 24px;
            font-weight: bold;
            color: #d9534f;
        }

        .form-box .btn-primary {
            width: 100%;
        }

        .forgot-password {
            text-align: right;
        }
    </style>
</head>
<body>
    <!-- Corrected logo image path -->
    <img src="assets/images/logos/tpgit_logo.png" alt="logo" style= " margin-left:600px; height: 70px;">
    <img style="margin-left:10px; height: 50px;" src="assets/images/logos/tpgit_hostel3.png" alt="logo">

<div class="container login-container">
  
    <div class="row">
        <!-- Left Section -->
        <div class="col-md-6 d-none d-md-block">
            <h4>Dear Student,</h4>
            <p>Welcome to TPGIT STUDENT PORTAL.</p>
            <p>You can access the student portal to know your Mess Bill details.</p>
            <p>TPGIT students can log in with the username provided to them.</p>
        </div>

        <!-- Right Section (Login Form) -->
        <div class="col-md-6">
            <div class="form-box">
                <h5 class="form-title">Student Portal</h5>
                <form action="student/student_dashboard.php" method="POST">
                    <div class="form-group">
                        <label for="username">Register Number</label>
                        <input type="text" class="form-control" id="register-number" placeholder="Register Number" name="username">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" placeholder="Password" name="password">
                    </div>
                    <div class="form-group">
                        <label for="captcha">Captcha</label>
                        <input type="text" class="form-control" id="captcha" placeholder="Captcha">
                        <span class="captcha">Cmd7gw</span>
                    </div>
                    <div class="forgot-password">
                        <a href="#">Forgot Password?</a>
                        <br>
                    </div>
                    <button type="submit" class="btn btn-secondary">Login</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
