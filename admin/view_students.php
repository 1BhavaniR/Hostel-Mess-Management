<?php
include('../includes/header.php');
include('../includes/db.php');

$sql = "SELECT * FROM students";
$stmt = $conn->prepare($sql);
$stmt->execute();
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container mt-5">
    <h2>Students & Mess Bill Management</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Reg No</th>
                <th>Name</th>
                <th>Mobile</th>
                <th>Department</th>
                <th>Year</th>
                <th>Mess Bill Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($students as $student): ?>
            <tr>
                <td><?php echo htmlspecialchars($student['regno']); ?></td>
                <td><?php echo htmlspecialchars($student['name']); ?></td>
                <td><?php echo htmlspecialchars($student['mobile']); ?></td>
                <td><?php echo htmlspecialchars($student['dept']); ?></td>
                <td><?php echo htmlspecialchars($student['year']); ?></td>
                <td>
                    <form action="update_bill_status.php" method="post">
                        <input type="hidden" name="student_id" value="<?php echo $student['id']; ?>">
                        <select name="bill_status" class="form-control">
                            <option value="paid">Paid</option>
                            <option value="unpaid">Unpaid</option>
                        </select>
                        <button type="submit" class="btn btn-success mt-2">Update</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include('../includes/footer.php'); ?>
