<?php
session_start();
include '../includes/dbconn.php';

// Fetch grocery records including seller names
$query = $pdo->query("
    SELECT seller_name, item_name, quantity, rate, total_price, purchased_date 
    FROM grocery
");
$records = $query->fetchAll(PDO::FETCH_ASSOC);

$itemNames = [];
$totalQuantities = [];

// Prepare data for the pie chart
foreach ($records as $record) {
    $itemNames[] = htmlspecialchars($record['item_name']);
    $totalQuantities[] = (int)$record['quantity']; // Ensure it's an integer
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin - Grocery Records</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Set a specific size for the pie chart canvas */
        #stockChart {
            max-width: 200px; /* Set max width */
            height: 200px;    /* Set fixed height */
            margin: auto;     /* Center the canvas */
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <a class="navbar-brand" href="#">Admin Dashboard</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="admin_dashboard.php">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin_grocery.php">Grocery Records</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin_mess_bill.php">Mess Bills</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container my-4">
        <h2 class="mb-4">Grocery Records</h2>
        
        <!-- Data Visualization Chart -->
        <h4>Stock Overview</h4>
        <canvas id="stockChart"></canvas>
        
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Seller Name</th>
                    <th>Item Name</th>
                    <th>Quantity</th>
                    <th>Rate</th>
                    <th>Total Price</th>
                    <th>Purchased Date</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($records): ?>
                    <?php foreach ($records as $record): ?>
                        <tr>
                            <td><?= htmlspecialchars($record['seller_name']); ?></td>
                            <td><?= htmlspecialchars($record['item_name']); ?></td>
                            <td><?= htmlspecialchars($record['quantity']); ?></td>
                            <td><?= htmlspecialchars($record['rate']); ?></td>
                            <td><?= htmlspecialchars($record['total_price']); ?></td>
                            <td><?= htmlspecialchars($record['purchased_date']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6">No records found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const itemNames = <?= json_encode($itemNames); ?>;
        const totalQuantities = <?= json_encode($totalQuantities); ?>;

        const ctx = document.getElementById('stockChart').getContext('2d');
        const stockChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: itemNames,
                datasets: [{
                    label: 'Stock Overview',
                    data: totalQuantities,
                    backgroundColor: ['#4caf50', '#f44336', '#2196F3', '#FFC107', '#9C27B0'],
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function (tooltipItem) {
                                return `${tooltipItem.label}: ${tooltipItem.raw}`;
                            }
                        }
                    }
                }
            }
        });
    </script>
</body>

</html>
