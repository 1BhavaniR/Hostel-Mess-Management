<?php
session_start(); // Start the session
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Raise Queries</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/user_profile.css">
    <style>
        body {
            background-color: #e9ecef;
            color: black;
        }
        .container {
            margin-top: 15px;
            max-width: 600px;
        }
        .form-group label {
            font-weight: bold;
        }
        .submit-btn {
            background-color: #007bff;
            border: none;
        }
        .submit-btn:hover {
            background-color: #0056b3;
        }
        .query-area {
            border: 1px solid #495057;
            border-radius: 5px;
            background-color: #fff;
            color: #ffffff;
        }
        .query-area::placeholder {
            color: #868e96;
        }
    </style>
</head>
<body>
<div class="sidebar">
        <h4 class="text-center">Student Dashboard</h4>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="student_dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="user_profile.php"><i class="fas fa-user-plus"></i> User Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="mess_bill.php"><i class="fas fa-wallet"></i> Mess Bill</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="mess_menu.php"><i class="fas fa-wallet"></i> Mess Menu</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="raise_queries.php"><i class="fas fa-question-circle"></i> Raise Queries</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="update_password.php"><i class="fas fa-lock"></i> Update Password</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="stulogout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </li>
        </ul>
    </div>
 <div class="content">
 <div class="container">
    <h2 class="text-center mb-4">Raise Your Query</h2>

    <!-- Display response message -->
    <?php if (isset($_SESSION['message'])): ?>
        <div class="alert alert-info">
            <?php 
                echo $_SESSION['message']; 
                unset($_SESSION['message']); // Clear the message after displaying
            ?>
        </div>
    <?php endif; ?>

    <form id="queryForm" action="submit_query.php" method="POST">
        <div class="form-group">
            <label for="name">Your Name</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Enter your name" required>
        </div>
        <div class="form-group">
            <label for="year">Year</label>
            <input type="text" class="form-control" name="year" id="year" placeholder="Enter your year" required>
        </div>
        <div class="form-group">
            <label for="department">Department</label>
            <input type="text" class="form-control" name="department" id="department" placeholder="Enter your department" required>
        </div>
        <div class="form-group">
            <label for="regnumber">Registration Number</label>
            <input type="text" class="form-control" name="regnumber" id="regnumber" placeholder="Enter your registration number" required>
        </div>
        <div class="form-group">
            <label for="queryArea">Select Area of Query</label>
            <select class="form-control" name="queryArea" id="queryArea" required>
                <option value="" disabled selected>Select an area</option>
                <option value="General Inquiry">General Inquiry</option>
                <option value="Billing Issues">Billing Issues</option>
                <option value="Room Issues">Room Issues</option>
                <option value="Food Quality">Food Quality</option>
                <option value="Other">Other</option>
            </select>
        </div>
        <div class="form-group">
            <label for="queryDescription">Describe Your Query</label>
            <textarea class="form-control query-area" name="queryDescription" id="queryDescription" rows="5" placeholder="Write your query here..." required></textarea>
        </div>
        <button type="submit" class="btn submit-btn btn-block">Submit Query</button>
    </form>
    <div id="responseMessage" class="mt-3"></div>
</div>
 </div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
