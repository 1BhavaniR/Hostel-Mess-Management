<?php
session_start();
include '../includes/dbconn.php';

// Fetch data from grocery table
$query = $pdo->query("
    SELECT item_name, in_stock, issued 
    FROM grocery
");
$records = $query->fetchAll(PDO::FETCH_ASSOC);
$itemNames = [];
$inStockQuantities = [];
$issuedQuantities = [];

foreach ($records as $record) {
    $itemNames[] = htmlspecialchars($record['item_name']);
    $inStockQuantities[] = (int)$record['in_stock'];
    $issuedQuantities[] = (int)$record['issued'];
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Admin - Stock and Issued Items</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
        }
        .chart-container {
            display: flex; /* Flexbox layout */

            flex-direction: column; 
            justify-content: space-between; /* Distribute space between charts */
            margin-bottom: 40px;
            flex-wrap: wrap; /* Allow wrapping of charts */
            gap: 20px; /* Space between charts */
        }
        .chart {
            flex: 1; /* Each chart takes equal width */
            min-width: 800px; 
            min-height:250px;
            max-height: 500px; /* Set a smaller fixed height */
            max-width: 100%; /* Ensure charts don't exceed container width */
            box-sizing: border-box; /* Include padding and border in the element's total width and height */
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
                    <a class="nav-link" href="admin_stock.php">Stock Records</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin_grocery.php">Grocery Records</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container my-4">
        <h2 class="mb-4">Stock and Issued Items</h2>
        
        <!-- Chart Container -->
      <h4>Overview</h4>
        <div class="chart-container">
            <h5>In-Stock Record</h5>
            <canvas id="inStockChart" class="chart"></canvas>

            <h5>Issued Record</h5>
            <canvas id="issuedChart" class="chart"></canvas>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Item Name</th>
                    <th>In Stock</th>
                    <th>Issued</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($records as $record): ?>
                    <tr>
                        <td><?= htmlspecialchars($record['item_name']); ?></td>
                        <td><?= htmlspecialchars($record['in_stock']); ?></td>
                        <td><?= htmlspecialchars($record['issued']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    const itemNames = <?= json_encode($itemNames); ?>;
    const inStockQuantities = <?= json_encode($inStockQuantities); ?>;
    const issuedQuantities = <?= json_encode($issuedQuantities); ?>;

    // Generate an array of colors for each item in In Stock chart
    const inStockColors = itemNames.map((item, index) => {
        return '#' + Math.floor(Math.random()*16777215).toString(16); // Generate random color
    });

    // In Stock Pie Chart
    const ctxInStock = document.getElementById('inStockChart').getContext('2d');
    const inStockChart = new Chart(ctxInStock, {
        type: 'pie',
        data: {
            labels: itemNames,
            datasets: [{
                label: 'In Stock',
                data: inStockQuantities,
                backgroundColor: inStockColors,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true, // Maintain aspect ratio
            plugins: {
                legend: {
                    position: 'top',
                }
            }
        }
    });

    // Generate an array of colors for each item in Issued chart
    const issuedColors = itemNames.map((item, index) => {
        return '#' + Math.floor(Math.random()*16777215).toString(16); // Generate random color
    });

    // Issued Pie Chart
    const ctxIssued = document.getElementById('issuedChart').getContext('2d');
    const issuedChart = new Chart(ctxIssued, {
        type: 'pie',
        data: {
            labels: itemNames,
            datasets: [{
                label: 'Issued',
                data: issuedQuantities,
                backgroundColor: issuedColors,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true, // Maintain aspect ratio
            plugins: {
                legend: {
                    position: 'top',
                }
            }
        }
    });
</script>
