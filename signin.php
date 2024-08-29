<!-- <?php
include('includes/header.php');
include('includes/db.php');

$type = $_GET['type'];
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($type == 'admin') {
        $stmt = $conn->prepare('SELECT * FROM admins WHERE email = :email');
    } else {
        $stmt = $conn->prepare('SELECT * FROM students WHERE email = :email');
    }
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        session_start();
        $_SESSION['user_id'] = $user['id'];
        header('Location: ' . ($type == 'admin' ? 'admin/dashboard.php' : 'student/dashboard.php'));
        exit();
    } else {
        $error = 'Invalid email or password.';
    }
}
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="text-center mb-4"><?php echo ucfirst($type); ?> Sign In</h2>
            <?php if ($error): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>
            <form action="signin.php?type=<?php echo $type; ?>" method="POST">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Sign In</button>
            </form>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?> -->
