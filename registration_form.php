<?php
include("dbconn.php");

if (isset($_POST['register'])) {
    // Collect and sanitize form data
    $firstname = mysqli_real_escape_string($dbconn, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($dbconn, $_POST['lastname']);
    $regnumber = mysqli_real_escape_string($dbconn, $_POST['regnumber']);
    $department = mysqli_real_escape_string($dbconn, $_POST['department']);
    $year = mysqli_real_escape_string($dbconn, $_POST['year']);
    $roomno = mysqli_real_escape_string($dbconn, $_POST['roomno']);
    $block = mysqli_real_escape_string($dbconn, $_POST['block']);
    $email = mysqli_real_escape_string($dbconn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Handle file upload
    $photo = $_FILES['photo']['name'];
    $photo_tmp = $_FILES['photo']['tmp_name'];
    $photo_size = $_FILES['photo']['size'];
    $photo_error = $_FILES['photo']['error'];

    // Allowed file types
    $allowed_types = ['image/jpeg', 'image/png', 'application/pdf'];

    // Check file size (maximum 5MB)
    if ($photo_size > 5 * 1024 * 1024) { // 5MB in bytes
        echo "<script>alert('File size exceeds 5MB.');</script>";
        exit;
    }

    // Check file type
    $file_type = mime_content_type($photo_tmp);
    if (!in_array($file_type, $allowed_types)) {
        echo "<script>alert('Invalid file format. Only PDF, JPEG, and PNG files are allowed.');</script>";
        exit;
    }

    // Move the uploaded file
    if ($photo_error === UPLOAD_ERR_OK) {
        // Generate a unique filename to avoid overwriting
        $target_file = "images/" . uniqid() . "-" . basename($photo);
        
        if (move_uploaded_file($photo_tmp, $target_file)) {
            // Insert data into the database
            $query = "INSERT INTO student_requests (firstname, lastname, regnumber, department, year, roomno, block, email, password, photo, is_approved) 
                      VALUES ('$firstname', '$lastname', '$regnumber', '$department', '$year', '$roomno', '$block', '$email', '$password', '$target_file', 0)";

            if (mysqli_query($dbconn, $query)) {
                echo "<script>alert('Your account was registered. You can login once the admin approves your account.');</script>";
            } else {
                echo "<script>alert('Error: " . mysqli_error($dbconn) . "');</script>";
            }
        } else {
            echo "<script>alert('Error moving uploaded file.');</script>";
        }
    } else {
        echo "<script>alert('Error with file upload: $photo_error');</script>";
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hostel Registration Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            margin-top: 50px;
            background-color: #e9ecef;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .registration-container {
            background-color: #f5f7fa;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 1200px;
        }
        .form-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .form-header h2 {
            font-size: 32px;
            font-weight: bold;
            color: #343a40;
        }
        .form-group label {
            font-weight: bold;
            color: #495057;
        }
        .form-control {
            margin-bottom: 15px;
        }
        .file-input {
            padding: 5px;
            background-color: #f1f1f1;
            border: 1px solid #ced4da;
            border-radius: 5px;
        }
        .form-section {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
        }
        .form-section h4 {
            margin-bottom: 20px;
            color: #007bff;
        }
        .btn-submit {
    float: right; /* Aligns the button to the right */
    padding: 10px 20px; /* Adjust padding to control size */
    border-radius: 00px;
    font-size: 18px;
    font-weight: bold;
    background-color: #007bff;
    border: none;
    transition: background-color 0.3s ease;
}

.btn-submit:hover {
    background-color: #0056b3;
}
    </style>
</head>
<body>
    
    <div class="container registration-container">
    <img src="assets/images/logos/tpgit_logo.png" alt="logo" style= "margin-left:400px; height: 70px;">
    <img src="assets/images/logos/tpgit_hostel3.png" alt="logo" style="margin-left:10px; height: 50px;">
        <div class="form-header">
            <h2>Student Hostel Registration Form</h2>
        </div>
        <form action="registration_form.php" method="POST" enctype="multipart/form-data">
            <div class="row">
                <!-- Personal Information Section -->
                <div class="col-md-6">
                    <div class="form-section">
                        <h4>Personal Information</h4>
                        <!-- First Name -->
                        <div class="form-group">
                            <label for="firstName">First Name</label>
                            <input type="text" class="form-control" id="firstName" name="firstname" required>
                        </div>
                        <!-- Last Name -->
                        <div class="form-group">
                            <label for="lastName">Last Name</label>
                            <input type="text" class="form-control" id="lastName" name="lastname" required>
                        </div>
                        <!-- Registration Number -->
                        <div class="form-group">
                            <label for="regNumber">Registration Number</label>
                            <input type="text" class="form-control" id="regNumber" name="regnumber" required>
                        </div>
                        <!-- Department -->
                        <div class="form-group">
                            <label for="department">Department</label>
                            <select class="form-control" id="department" name="department" required>
                                <option value="">Select Department</option>
                                <option value="Mechanical Engineering">Mechanical Engineering</option>
                                <option value="Electronics and Communication Engineering">Electronics and Communication Engineering</option>
                                <option value="Electrical and Electronics Engineering">Electrical and Electronics Engineering</option>
                                <option value="Computer Science Engineering">Computer Science Engineering</option>
                                <option value="Civil Engineering">Civil Engineering</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="year">Year of Study</label>
                            <select class="form-control" name="year" id="year">
                                <option value="">Select year</option>
                                <option value="1year">I year</option>
                                <option value="2year">II year</option>
                                <option value="3year">III year</option>
                                <option value="4year">IV year</option>
                            </select>

                        </div>
                    </div>
                </div>

                <!-- Accommodation Details Section -->
                <div class="col-md-6">
                    <div class="form-section">
                        <h4>Accommodation Details</h4>
                        <!-- Room Number -->
                        <div class="form-group">
                            <label for="roomNumber">Room Number</label>
                            <input type="text" class="form-control" id="roomNumber" name="roomno" required>
                        </div>
                        <!-- Block -->
                        <div class="form-group">
                            <label for="block">Block</label>
                            <select class="form-control" id="block" name="block" required>
                                <option value="">Select Block</option>
                                <option value="A Block">A Block</option>
                                <option value="B Block">B Block</option>
                                <option value="C Block">C Block</option>
                            </select>
                        </div>
                        <!-- Upload Image -->
                        <div class="form-group">
                            <label for="image">Upload Profile Image</label>
                            <br>
                            <input type="file" class="file-input" id="image" name="photo" accept="image/*" >
                        </div>
                        <!-- Email -->
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="phnnum">Contact Number</label>
                            <input type="tel" class="form-control" id="phnnum" name="phnnum" required>
                        </div>
                    </div>
                </div>

                <!-- Account Information Section -->
                <div class="col-md-12">
                    <div class="form-section">
                        <h4>Account Information</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <!-- User ID -->
                                <div class="form-group">
                                    <label for="userId">User ID</label>
                                    <input type="text" class="form-control" id="userId" name="userId" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- Password -->
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- Confirm Password -->
                                <div class="form-group">
                                    <label for="confirmPassword">Confirm Password</label>
                                    <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <button type="submit" name="register" class="btn btn-dark btn-submit">Register</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>