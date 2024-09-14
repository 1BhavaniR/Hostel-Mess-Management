
    <style>
        body {
            padding-top: 20px;
            background-color: #f8f9fa;
        }
        .container {
            max-width: 1200px;
        }
        .card {
            margin-bottom: 20px;
        }
        .table td, .table th {
            vertical-align: middle;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <header class="mb-4">
            <h1 class="text-center">Mess Provisions Dashboard</h1>
        </header>

        <!-- Form to Add Provision -->
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Add Provision</h4>
            </div>
            <div class="card-body">
                <form id="provisionForm">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="provisionName">Provision Name</label>
                            <input type="text" class="form-control" id="provisionName" placeholder="e.g. Milk, Groceries">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="quantity">Quantity</label>
                            <input type="number" class="form-control" id="quantity" placeholder="e.g. 10">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="takenToday">Quantity Taken Today</label>
                            <input type="number" class="form-control" id="takenToday" placeholder="e.g. 2">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="remaining">Quantity Remaining</label>
                            <input type="number" class="form-control" id="remaining" placeholder="e.g. 8" readonly>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary" onclick="addProvision()">Add Provision</button>
                </form>
            </div>
        </div>

        <!-- Table to Display Provisions -->
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Provision Records</h4>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Provision Name</th>
                            <th>Total Quantity</th>
                            <th>Quantity Taken Today</th>
                            <th>Quantity Remaining</th>
                        </tr>
                    </thead>
                    <tbody id="provisionTableBody">
                        <!-- Rows will be added dynamically here -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and Dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Custom JS -->
    <script>
        function addProvision() {
            // Get form values
            var provisionName = document.getElementById('provisionName').value;
            var quantity = document.getElementById('quantity').value;
            var takenToday = document.getElementById('takenToday').value;
            var remaining = quantity - takenToday;

            // Validation
            if (!provisionName || !quantity || !takenToday) {
                alert('Please fill all fields.');
                return;
            }
            if (remaining < 0) {
                alert('Taken quantity cannot be more than total quantity.');
                return;
            }

            // Create a new row
            var tableBody = document.getElementById('provisionTableBody');
            var newRow = tableBody.insertRow();
            newRow.insertCell(0).textContent = provisionName;
            newRow.insertCell(1).textContent = quantity;
            newRow.insertCell(2).textContent = takenToday;
            newRow.insertCell(3).textContent = remaining;

            // Clear form
            document.getElementById('provisionForm').reset();
            document.getElementById('remaining').value = remaining;
        }
    </script>
</body>
</html>
