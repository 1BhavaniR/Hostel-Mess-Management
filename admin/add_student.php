<?php
include 'includes/db.php';

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

    echo "Student added successfully.";
}
?>

<div class="container mt-5">
    <h2>Add Student</h2>
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
        <button type="submit" class="btn btn-primary">Add Student</button>
    </form>
</div>

