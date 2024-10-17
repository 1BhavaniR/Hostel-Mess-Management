<?php
session_start();
include("dbconn.php");

if (isset($_GET['action']) && isset($_GET['id'])) {
    $studentId = $_GET['id'];
    $action = $_GET['action'];

    if ($action == 'approve') {
        // Move student from student_requests to student_approved
        $query = "INSERT INTO student_approved (firstname, lastname, regnumber, department, year, roomno, block, email, password, photo) 
                  SELECT firstname, lastname, regnumber, department, year, roomno, block, email, password, photo 
                  FROM student_requests WHERE id = '$studentId'";
        if (mysqli_query($dbconn, $query)) {
            // After inserting to approved table, delete from requests table
            mysqli_query($dbconn, "DELETE FROM student_requests WHERE id = '$studentId'");
            echo "<script>alert('Student approved successfully.');</script>";
        } else {
            echo "<script>alert('Failed to approve student.');</script>";
        }
    } elseif ($action == 'reject') {
        $query = "DELETE FROM student_requests WHERE id = '$studentId'";
        if (mysqli_query($dbconn, $query)) {
            echo "<script>alert('Student rejected and deleted.');</script>";
        } else {
            echo "<script>alert('Failed to reject student.');</script>";
        }
    }
}

// Fetch Unapproved Registrations
$sql = "SELECT * FROM student_requests WHERE is_approved = 0";
$result = mysqli_query($dbconn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Approval Panel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/admin_dashboard.css">
</head>
<body>
    <div class="sidebar">
        <h4 class="text-center">Admin Dashboard</h4>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="admin_dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="add_student.php"><i class="fas fa-user-plus"></i> Add Student</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="admin_approval.php"><i class="fas fa-user-plus"></i>View Requests</a>
            </li>
            <li class="nav-item">
                    <a class="nav-link" href="mess_bill.php"><i class="fas fa-wallet"></i> Mess Bill</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="grocery_bill.php"><i class="fas fa-shopping-cart"></i> Grocery Bill</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="mess_menu.php"><i class="fas fa-utensils"></i> Mess Menu</a>
                </li>
            <li class="nav-item">
                <a class="nav-link" href="admin_dashboard.php?action=update_password"><i class="fas fa-key"></i> Update Password</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="admin_dashboard.php?action=update_password"><i class="fas fa-key"></i> View Queries</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </li>
        </ul>
    </div>
    <div class="content">
    <div class="container mt-5">
        <h2>Pending Student Registrations</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Reg Number</th>
                    <th>Department</th>
                    <th>Year</th>
                    <th>Room Number</th>
                    <th>Block</th>
                    <th>Email</th>
                    <th>Photo</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['firstname']; ?></td>
                        <td><?php echo $row['lastname']; ?></td>
                        <td><?php echo $row['regnumber']; ?></td>
                        <td><?php echo $row['department']; ?></td>
                        <td><?php echo $row['year']; ?></td>
                        <td><?php echo $row['roomno']; ?></td>
                        <td><?php echo $row['block']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><img src="images/<?php echo $row['photo']; ?>" height="50px"></td>
                        <td>
                            <a href="admin_approval.php?action=approve&id=<?php echo $row['id']; ?>" class="btn btn-success btn-sm">Approve</a>
                            <a href="admin_approval.php?action=reject&id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">Reject</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    </div>
</body>
</html>

<?php
// Close the connection
mysqli_close($dbconn);
?>