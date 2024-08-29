<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mess Bill Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        .container {
            margin-top: 60px; /* Adjust based on your header height */
        }
        .card {
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            border-radius: 10px;
            transition: transform 0.3s ease-in-out;
        }
        .card:hover {
            transform: scale(1.03);
        }
        .table-responsive {
            animation: fadeIn 1s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        .table {
            border-collapse: separate;
            border-spacing: 0;
        }
        .table thead th {
            background-color: #343a40;
            color: #ffffff;
            font-weight: bold;
            text-align: center;
        }
        .table tbody tr {
            background-color: #ffffff;
            transition: background-color 0.3s;
        }
        .table tbody tr:hover {
            background-color: #f1f1f1;
        }
        .table tbody td {
            vertical-align: middle;
        }
        .btn-action {
            transition: background-color 0.3s, color 0.3s;
        }
        .btn-action:hover {
            background-color: #007bff;
            color: #fff;
        }
        .badge-due {
            background-color: #dc3545;
            color: #fff;
        }
        .badge-paid {
            background-color: #28a745;
            color: #fff;
        }
        .icon-button {
            border: none;
            background: none;
            cursor: pointer;
            transition: color 0.3s;
        }
        .icon-button:hover {
            color: #007bff;
        }
    </style>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card shadow-lg p-4" style="width: 100%; max-width: 800px;">
            <h3 class="text-center mb-4">Student Mess Bill Dashboard</h3>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Reg No</th>
                            <th>Name</th>
                            <th>Mess Bill Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>12345</td>
                            <td>John Doe</td>
                            <td><span class="badge badge-due">Due</span></td>
                            <td>
                                <button class="btn btn-action btn-sm me-2"><i class="fas fa-edit"></i></button>
                                <button class="btn btn-action btn-sm"><i class="fas fa-sms"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>67890</td>
                            <td>Jane Smith</td>
                            <td><span class="badge badge-paid">Paid</span></td>
                            <td>
                                <button class="btn btn-action btn-sm me-2"><i class="fas fa-edit"></i></button>
                                <button class="btn btn-action btn-sm"><i class="fas fa-sms"></i></button>
                            </td>
                        </tr>
                        <!-- Add more rows as needed -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Include jQuery first, then Popper.js, and then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
</body>
</html>
