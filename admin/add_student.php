<?php
include('../includes/header.php');
include('../includes/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $regno = $_POST['regno'];
    $name = $_POST['name'];
    $mobile = $_POST['mobile'];
    $dept = $_POST['dept'];
    $year = $_POST['year'];

    $sql = "INSERT INTO students (regno, name, mobile, dept, year) VALUES (:regno, :name, :mobile, :dept, :year)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':regno', $regno);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':mobile', $mobile);
    $stmt->bindParam(':dept', $dept);
    $stmt->bindParam(':year', $year);

    if ($stmt->execute()) {
        echo "Student added successfully!";
    } else {
        echo "Error: " . $stmt->errorInfo()[2];
    }
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

<?php include('../includes/footer.php'); ?>
