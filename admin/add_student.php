<?php
include '../includes/db.php';

session_start();

if (!isset($_SESSION['admin_id'])) {
    header('Location: admin_login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    $stmt = $pdo->prepare("INSERT INTO students (email, password) VALUES (?, ?)");
    $stmt->execute([$email, $hashed_password]);

    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Student added successfully.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .form-container {
            margin-top: 50px;
        }
        .form-container .card {
            transition: transform 0.3s ease-in-out;
        }
        .form-container .card:hover {
            transform: scale(1.02);
        }
        .form-group input {
            transition: border-color 0.3s ease;
        }
        .form-group input:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(38, 143, 255, 0.25);
        }
    </style>
</head>
<body>
    <div class="container form-container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow-lg">
                    <div class="card-header text-center bg-dark text-white">
                        <h4>Add Student</h4>
                    </div>
                    <div class="card-body">
                        <form action="add_student.php" method="post">
                            <div class="form-group">
                                <label for="regno">Registration Number:</label>
                                <input type="text" class="form-control" id="regno" name="regno" required>
                            </div>
                            <div class="form-group">
                                <label for="name">Student Name:</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="mobile">Mobile Number:</label>
                                <input type="text" class="form-control" id="mobile" name="mobile" required>
                            </div>
                            <div class="form-group">
                                <label for="dept">Department:</label>
                                <input type="text" class="form-control" id="dept" name="dept" required>
                            </div>
                            <div class="form-group">
                                <label for="year">Year:</label>
                                <input type="text" class="form-control" id="year" name="year" required>
                            </div>
                            <button type="submit" class="btn btn-dark btn-block">Add Student</button>
                        </form>
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
