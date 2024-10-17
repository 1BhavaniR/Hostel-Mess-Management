<?php
// Include database connection
include('dbconn.php');

// Fetch approved students with optional filters
$filters = [];
$sql = "SELECT * FROM student_approved WHERE 1=1";

if (!empty($_POST['year'])) {
    $year = $_POST['year'];
    $sql .= " AND year = :year";
    $filters['year'] = $year;
}

if (!empty($_POST['department'])) {
    $department = $_POST['department'];
    $sql .= " AND department = :department";
    $filters['department'] = $department;
}

$stmt = $dbconn->prepare($sql);
$stmt->execute($filters);
$approvedStudents = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Approved Students List</title>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Approved Students List</h2>
        <form method="POST" class="mb-3">
            <div class="row">
                <div class="col-md-4">
                    <select name="year" class="form-select">
                        <option value="">All Years</option>
                        <option value="1year">I year</option>
                        <option value="2year">II year</option>
                        <option value="3year">III year</option>
                        <option value="4year">IV year</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <select name="department" class="form-select">
                        <option value="">All Departments</option>
                        <option value="Mechanical Engineering">Mechanical Engineering</option>
                        <option value="Electronics and Communication Engineering">Electronics and Communication Engineering</option>
                        <option value="Electrical and Electronics Engineering">Electrical and Electronics Engineering</option>
                        <option value="Computer Science Engineering">Computer Science Engineering</option>
                        <option value="Civil Engineering">Civil Engineering</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </div>
        </form>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Registration Number</th>
                    <th>Department</th>
                    <th>Year</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($approvedStudents as $student): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($student['firstname']); ?></td>
                        <td><?php echo htmlspecialchars($student['lastname']); ?></td>
                        <td><?php echo htmlspecialchars($student['regnumber']); ?></td>
                        <td><?php echo htmlspecialchars($student['department']); ?></td>
                        <td><?php echo htmlspecialchars($student['year']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
