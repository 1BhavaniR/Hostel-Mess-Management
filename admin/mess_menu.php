<?php
include '../includes/db.php'; // Adjust the path as needed

session_start();

if (!isset($_SESSION['admin_id'])) {
    header('Location: admin_login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
    $meal_times = ['Morning', 'Afternoon', 'Snacks', 'Dinner'];

    foreach ($days as $day) {
        foreach ($meal_times as $meal_time) {
            $menu = $_POST[$day . $meal_time] ?? '';

            $stmt = $pdo->prepare("REPLACE INTO mess_menu (day, meal_time, menu) VALUES (?, ?, ?)");
            $stmt->execute([$day, $meal_time, $menu]);
        }
    }

    echo "<script>alert('Menu updated successfully.'); window.location.href='admin_update_menu.php';</script>";
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin - College Mess Menu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
    <style>
        .update-btn {
            margin-top: 20px;
            transition: background-color 0.3s, transform 0.3s;
        }
        .update-btn:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }
        .meal-time {
            font-weight: bold;
        }
        .form-container {
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 20px;
            background-color: #f8f9fa;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .form-label {
            margin-top: 10px;
            font-weight: 600;
        }
        .card {
            margin-top: 20px;
        }
        .current-menu {
            border-top: 2px solid #007bff;
            padding-top: 10px;
        }
        .meal-table {
            display: grid;
            grid-template-columns: repeat(8, 1fr);
            gap: 1rem;
        }
        .meal-table .meal-time {
            text-align: center;
        }
        .meal-table .meal-input {
            width: 100%;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <a class="navbar-brand" href="#">Admin Dashboard</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="mess_bill.php"><i class="fas fa-wallet"></i> Mess Bill</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="grocery.php"><i class="fas fa-shopping-cart"></i> Grocery Bill</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="mess_menu.php"><i class="fas fa-utensils"></i> Mess Menu</a>
                </li>
                <li class="nav-item">
                   <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container my-4">
        <div class="form-container">
            <h2 class="mb-4">Update Mess Menu</h2>
            <form id="menuForm" method="post" action="admin_update_menu.php">
                <div class="meal-table">
                    <div class="meal-time"></div> <!-- Empty cell for header -->
                    <div class="meal-time">Monday</div>
                    <div class="meal-time">Tuesday</div>
                    <div class="meal-time">Wednesday</div>
                    <div class="meal-time">Thursday</div>
                    <div class="meal-time">Friday</div>
                    <div class="meal-time">Saturday</div>
                    <div class="meal-time">Sunday</div>

                    <div class="meal-time">Morning</div>
                    <input type="text" class="form-control meal-input" name="MondayMorning" placeholder="Enter Monday's morning menu">
                    <input type="text" class="form-control meal-input" name="TuesdayMorning" placeholder="Enter Tuesday's morning menu">
                    <input type="text" class="form-control meal-input" name="WednesdayMorning" placeholder="Enter Wednesday's morning menu">
                    <input type="text" class="form-control meal-input" name="ThursdayMorning" placeholder="Enter Thursday's morning menu">
                    <input type="text" class="form-control meal-input" name="FridayMorning" placeholder="Enter Friday's morning menu">
                    <input type="text" class="form-control meal-input" name="SaturdayMorning" placeholder="Enter Saturday's morning menu">
                    <input type="text" class="form-control meal-input" name="SundayMorning" placeholder="Enter Sunday's morning menu">

                    <div class="meal-time">Afternoon</div>
                    <input type="text" class="form-control meal-input" name="MondayAfternoon" placeholder="Enter Monday's afternoon menu">
                    <input type="text" class="form-control meal-input" name="TuesdayAfternoon" placeholder="Enter Tuesday's afternoon menu">
                    <input type="text" class="form-control meal-input" name="WednesdayAfternoon" placeholder="Enter Wednesday's afternoon menu">
                    <input type="text" class="form-control meal-input" name="ThursdayAfternoon" placeholder="Enter Thursday's afternoon menu">
                    <input type="text" class="form-control meal-input" name="FridayAfternoon" placeholder="Enter Friday's afternoon menu">
                    <input type="text" class="form-control meal-input" name="SaturdayAfternoon" placeholder="Enter Saturday's afternoon menu">
                    <input type="text" class="form-control meal-input" name="SundayAfternoon" placeholder="Enter Sunday's afternoon menu">

                    <div class="meal-time">Snacks</div>
                    <input type="text" class="form-control meal-input" name="MondaySnacks" placeholder="Enter Monday's snacks menu">
                    <input type="text" class="form-control meal-input" name="TuesdaySnacks" placeholder="Enter Tuesday's snacks menu">
                    <input type="text" class="form-control meal-input" name="WednesdaySnacks" placeholder="Enter Wednesday's snacks menu">
                    <input type="text" class="form-control meal-input" name="ThursdaySnacks" placeholder="Enter Thursday's snacks menu">
                    <input type="text" class="form-control meal-input" name="FridaySnacks" placeholder="Enter Friday's snacks menu">
                    <input type="text" class="form-control meal-input" name="SaturdaySnacks" placeholder="Enter Saturday's snacks menu">
                    <input type="text" class="form-control meal-input" name="SundaySnacks" placeholder="Enter Sunday's snacks menu">

                    <div class="meal-time">Dinner</div>
                    <input type="text" class="form-control meal-input" name="MondayDinner" placeholder="Enter Monday's dinner menu">
                    <input type="text" class="form-control meal-input" name="TuesdayDinner" placeholder="Enter Tuesday's dinner menu">
                    <input type="text" class="form-control meal-input" name="WednesdayDinner" placeholder="Enter Wednesday's dinner menu">
                    <input type="text" class="form-control meal-input" name="ThursdayDinner" placeholder="Enter Thursday's dinner menu">
                    <input type="text" class="form-control meal-input" name="FridayDinner" placeholder="Enter Friday's dinner menu">
                    <input type="text" class="form-control meal-input" name="SaturdayDinner" placeholder="Enter Saturday's dinner menu">
                    <input type="text" class="form-control meal-input" name="SundayDinner" placeholder="Enter Sunday's dinner menu">
                </div>
                <button type="submit" class="btn btn-primary update-btn">Update Menu</button>
            </form>
        </div>
        <div class="card current-menu mt-4">
            <div class="card-body">
                <h4>Current Menu</h4>
                <p id="currentMenu">No updates yet.</p>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('menuForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the default form submission
            let formData = new FormData(this);

            fetch('admin_update_menu.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                document.getElementById('currentMenu').innerHTML = 'Menu updated successfully!';
                console.log(data);
            })
            .catch(error => console.error('Error:', error));
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
