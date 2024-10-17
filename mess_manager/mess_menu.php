<?php
include '../includes/dbconn.php';
session_start();

// Check if the mess user is logged in
if (!isset($_SESSION['mess_user_id'])) {
    header('Location: mess_login.php');
    exit;
}

// Fetch the current menu from the database
$current_menu = [];
$days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
$meal_times = ['Morning', 'Afternoon', 'Snacks', 'Dinner'];

foreach ($days as $day) {
    foreach ($meal_times as $meal_time) {
        $stmt = $pdo->prepare("SELECT menu FROM mess_menu WHERE day = ? AND meal_time = ?");
        $stmt->execute([$day, $meal_time]);
        $current_menu[$day][$meal_time] = $stmt->fetchColumn() ?: '';
    }
}

// Handle menu update form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    foreach ($days as $day) {
        foreach ($meal_times as $meal_time) {
            $menu = $_POST[$day . $meal_time] ?? '';

            $stmt = $pdo->prepare("REPLACE INTO mess_menu (day, meal_time, menu) VALUES (?, ?, ?)");
            $stmt->execute([$day, $meal_time, $menu]);
        }
    }

    echo "<script>alert('Menu updated successfully.'); window.location.href='mess_menu.php';</script>";
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mess Manager - Update Mess Menu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .update-btn { margin-top: 20px; transition: background-color 0.3s, transform 0.3s; }
        .update-btn:hover { background-color: #0056b3; transform: scale(1.05); }
        .meal-time { font-weight: bold; }
        .form-container { border: 1px solid #e0e0e0; border-radius: 8px; padding: 20px; background-color: #f8f9fa; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
        .meal-table { display: grid; grid-template-columns: repeat(8, 1fr); gap: 1rem; }
        .meal-table .meal-time { text-align: center; }
        .meal-table .meal-input { width: 100%; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <a class="navbar-brand" href="#">Mess Dashboard</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="mess_grocery.php"><i class="fas fa-shopping-cart"></i> Grocery Bill</a></li>
                <li class="nav-item"><a class="nav-link" href="mess_menu.php"><i class="fas fa-utensils"></i> Mess Menu</a></li>
                <li class="nav-item"><a class="nav-link" href="mess_update_issued.php"><i class="fas fa-shopping-cart"></i> Issued</a></li>
                <li class="nav-item"><a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </div>
    </nav>

    <div class="container my-4">
        <div class="form-container">
            <h2 class="mb-4">Update Mess Menu</h2>
            <form id="menuForm" method="post" action="mess_menu.php">
                <div class="meal-table">
                    <div class="meal-time"></div>
                    <div class="meal-time">Monday</div>
                    <div class="meal-time">Tuesday</div>
                    <div class="meal-time">Wednesday</div>
                    <div class="meal-time">Thursday</div>
                    <div class="meal-time">Friday</div>
                    <div class="meal-time">Saturday</div>
                    <div class="meal-time">Sunday</div>

                    <!-- Morning Meals -->
                    <div class="meal-time">Morning</div>
                    <?php foreach ($days as $day): ?>
                        <input type="text" class="form-control meal-input" name="<?= $day ?>Morning" placeholder="Enter <?= $day ?>'s morning menu" value="<?= htmlspecialchars($current_menu[$day]['Morning']) ?>">
                    <?php endforeach; ?>

                    <!-- Afternoon Meals -->
                    <div class="meal-time">Afternoon</div>
                    <?php foreach ($days as $day): ?>
                        <input type="text" class="form-control meal-input" name="<?= $day ?>Afternoon" placeholder="Enter <?= $day ?>'s afternoon menu" value="<?= htmlspecialchars($current_menu[$day]['Afternoon']) ?>">
                    <?php endforeach; ?>

                    <!-- Snacks -->
                    <div class="meal-time">Snacks</div>
                    <?php foreach ($days as $day): ?>
                        <input type="text" class="form-control meal-input" name="<?= $day ?>Snacks" placeholder="Enter <?= $day ?>'s snacks menu" value="<?= htmlspecialchars($current_menu[$day]['Snacks']) ?>">
                    <?php endforeach; ?>

                    <!-- Dinner -->
                    <div class="meal-time">Dinner</div>
                    <?php foreach ($days as $day): ?>
                        <input type="text" class="form-control meal-input" name="<?= $day ?>Dinner" placeholder="Enter <?= $day ?>'s dinner menu" value="<?= htmlspecialchars($current_menu[$day]['Dinner']) ?>">
                    <?php endforeach; ?>
                </div>
                <button type="submit" class="btn btn-primary update-btn">Update Menu</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
