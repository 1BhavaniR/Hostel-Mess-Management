<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mess Bill Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .table-container {
            padding: 20px;
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            animation: fadeIn 0.5s ease-in-out;
        }

        h2 {
            font-family: 'Arial', sans-serif;
            color: #343a40;
        }

        .status-paid {
            color: green;
            font-weight: bold;
        }

        .status-due {
            color: red;
            font-weight: bold;
        }

        .sms-btn {
            transition: transform 0.3s, background-color 0.3s;
        }

        .sms-btn:hover {
            transform: scale(1.1);
            background-color: #0069d9;
        }

        .btn-group {
            margin-top: 10px;
        }

        .select-all-btn {
            transition: background-color 0.3s, transform 0.3s;
        }

        .select-all-btn:hover {
            background-color: #343a40;
            transform: scale(1.05);
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(-20px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-container {
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            margin-top: 20px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
        }

        .animated-button {
            transition: background-color 0.3s, transform 0.3s;
        }

        .animated-button:hover {
            background-color: #343a40;
            transform: scale(1.1);
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
            <h2 class="mb-4">Mess Bill - Student Records</h2>
            <div class="table-container">
                <form id="smsForm">
                    <table class="table table-bordered table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th><input type="checkbox" id="selectAll"> Select All</th>
                                <th>Student Name</th>
                                <th>Profession</th>
                                <th>Status</th>
                                <th>Send SMS</th>
                            </tr>
                        </thead>
                        <tbody id="studentTableBody">
                            <!-- Sample data, replace with dynamic PHP data -->
                            <tr>
                                <td><input type="checkbox" class="student-checkbox"></td>
                                <td>John Doe</td>
                                <td>Engineering</td>
                                <td><span class="status-paid">Paid</span></td>
                                <td><button type="button" class="btn btn-primary sms-btn">Send SMS</button></td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" class="student-checkbox"></td>
                                <td>Jane Smith</td>
                                <td>Medicine</td>
                                <td><span class="status-due">Due</span></td>
                                <td><button type="button" class="btn btn-primary sms-btn">Send SMS</button></td>
                            </tr>
                            <!-- More rows will be dynamically added with PHP -->
                        </tbody>
                    </table>
                    <div class="btn-group">
                        <button type="button" class="btn btn-dark select-all-btn" id="sendAllSmsBtn">Send SMS to All</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Select/Deselect All functionality
        $('#selectAll').on('click', function () {
            $('.student-checkbox').prop('checked', this.checked);
        });

        // Send SMS to all selected students
        $('#sendAllSmsBtn').on('click', function () {
            const selectedStudents = [];
            $('.student-checkbox:checked').each(function () {
                selectedStudents.push($(this).closest('tr').find('td:nth-child(2)').text());
            });

            if (selectedStudents.length > 0) {
                alert('SMS will be sent to: ' + selectedStudents.join(', '));
            } else {
                alert('No students selected!');
            }
        });

        // Individual SMS button click
        $('.sms-btn').on('click', function () {
            const studentName = $(this).closest('tr').find('td:nth-child(2)').text();
            alert('SMS sent to ' + studentName);
        });
    </script>
</body>

</html>
