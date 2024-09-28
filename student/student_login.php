<?php
session_start();
include("student_dbconn.php"); // Make sure to update this path as necessary

if (isset($_POST['login'])) {
    $regnumber = $_POST['regnumber']; // Use the same name as in the input field
    $password = $_POST['password'];
    // $captchaResponse = $_POST['g-recaptcha-response'];
    // // Check CAPTCHA
    // $secretKey = "6Lel704qAAAAALIfLoxoiZ9ibdYCzWS4xqJQTnR5"; // Replace with your secret key
    // $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secretKey}&response={$captchaResponse}");
    // $responseKeys = json_decode($response, true);

    
    // if (intval($responseKeys["success"]) !== 1) {
    //     echo "<script>alert('Please complete the CAPTCHA.');</script>";
    // } else{
    if (empty($regnumber) || empty($password)) {
        echo "<script>alert('Please enter both username and password.');</script>";
    } else {
        // Use a prepared statement to prevent SQL injection
        $sql = "SELECT * FROM student_approved WHERE regnumber = ?";
        $stmt = mysqli_prepare($dbconn, $sql);
        mysqli_stmt_bind_param($stmt, 's', $regnumber);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($result)) {
            // Check if the passwords match
            if (password_verify($password, $row['password'])) {
                // Success: Store userId in session and redirect to dashboard
                $_SESSION['regnumber'] = $regnumber;
                echo "<script>alert('Login successful!'); window.location.href='student_dashboard.php';</script>";
            } else {
                // Incorrect password
                echo "<script>alert('Invalid credentials: Incorrect password.');</script>";
            }
        } else {
            // User not found
            echo "<script>alert('Invalid credentials: You do not have an account. Please create one.');</script>";
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }
    }

// Debugging: Check if session variable is set after login
// if (isset($_SESSION['regnumber'])) {
//     echo "Session variable 'regnumber' is set to: " . $_SESSION['regnumber'];
// } else {
//     echo "Session variable 'regnumber' is NOT set.";
// }
// Close connection
mysqli_close($dbconn);
?>

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
        .title {
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
<img src="assets/images/logos/tpgit_logo.png" alt="logo" style= "margin-left:600px; height: 70px;">
<img src="assets/images/logos/tpgit_hostel3.png" alt="logo" style="margin-left:10px; height: 50px;">

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
                    <form action="" method="POST"> <!-- Action set to empty for same-page submission -->
                        <div class="form-group">
                            <label for="username">Register Number</label>
                            <input type="text" class="form-control" id="register-number" placeholder="Register Number" name="regnumber" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" placeholder="Password" name="password" required>
                        </div>
                       
                        <div class="forgot-password">
                            <a href="#">Forgot Password?</a>
                            
                        </div>
                        <!-- Inside your form, add this before the submit button -->
                        <!-- <div class="form-group">
                            <div class="g-recaptcha" data-sitekey="6Lel704qAAAAAOVJQijicRRTgBl0XnScTUt9ng7X"></div>
                        </div> -->

                        <button type="submit" name="login" class="btn btn-secondary">Login</button> <!-- Correct button type -->
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- <script src="https://www.google.com/recaptcha/api.js" async defer></script> -->

</body>
</html>
