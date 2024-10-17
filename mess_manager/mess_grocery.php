<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mess - Grocery Bill</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .update-btn {
            margin-top: 20px;
            transition: background-color 0.3s, transform 0.3s;
        }

        .update-btn:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

        .form-container {
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 20px;
            background-color: #f8f9fa;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card {
            margin-top: 20px;
        }

        .remove-item {
            cursor: pointer;
            color: red;
        }

        .remove-item:hover {
            text-decoration: underline;
        }

        .item-other {
            display: none;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <a class="navbar-brand" href="#">Mess Dashboard</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav">
                
                <li class="nav-item">
                    <a class="nav-link" href="mess_grocery.php"><i class="fas fa-shopping-cart"></i> Grocery Bill</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="mess_menu.php"><i class="fas fa-utensils"></i> Mess Menu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="mess_update_issued.php"><i class="fas fa-shopping-cart"></i> Issued</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container my-4">
        <!-- Grocery Bill Table -->
        <div class="form-container">
            <h2 class="mb-4">Update Grocery Bill</h2>
            <form id="groceryForm">
                <div class="table-responsive">
                    <table class="table table-bordered" id="groceryTable">
                        <thead>
                            <tr>
                                <th>Seller Name</th>
                                <th>Item Name</th>
                                <th>Quantity</th>
                                <th>Rate</th>
                                <th>Total Price</th>
                                <th>Purchased Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Rows will be added dynamically -->
                        </tbody>
                    </table>
                </div>
                <button type="button" class="btn btn-primary update-btn" id="updateBtn">Update Bill</button>
                <button type="button" class="btn btn-secondary update-btn" id="addRowBtn">Add Item</button>
            </form>
        </div>
    </div>
    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Add new row to the table
        document.getElementById('addRowBtn').addEventListener('click', function () {
            const tableBody = document.querySelector('#groceryTable tbody');
            const newRow = document.createElement('tr');
            newRow.innerHTML = `
                <td><input type="text" class="form-control" placeholder="Enter seller name"></td>
                <td>
                    <select class="form-select item-select">
                        <option value="Rice">Rice</option>
                        <option value="Wheat">Wheat</option>
                        <option value="Pulses">Pulses</option>
                        <option value="Vegetables">Vegetables</option>
                        <option value="Other">Other</option>
                    </select>
                    <input type="text" class="form-control item-other" placeholder="Enter item name">
                </td>
                <td>
                    <div class="input-group">
                        <input type="number" class="form-control quantity-value" placeholder="Enter quantity">
                        <select class="form-select quantity-unit">
                            <option value="kg">Kg</option>
                            <option value="litre">Litre</option>
                            <option value="gram">Gram</option>
                            <option value="pack">Pack</option>
                        </select>
                    </div>
                </td>
                <td>
                    <div class="input-group">
                        <input type="number" class="form-control rate-value" placeholder="Enter rate">
                        <select class="form-select rate-unit">
                            <option value="/kg">/Kg</option>
                            <option value="/litre">/Litre</option>
                            <option value="/gram">/Gram</option>
                            <option value="/pack">/Pack</option>
                        </select>
                    </div>
                </td>
                <td><input type="number" class="form-control total-price" placeholder="Total Price" readonly></td>
                <td><input type="date" class="form-control" placeholder="mm/dd/yyyy"></td>
                <td><span class="remove-item">Remove</span></td>
            `;
            tableBody.appendChild(newRow);

            const itemSelect = newRow.querySelector('.item-select');
            const itemOtherInput = newRow.querySelector('.item-other');
            const quantityValue = newRow.querySelector('.quantity-value');
            const rateValue = newRow.querySelector('.rate-value');
            const totalPriceInput = newRow.querySelector('.total-price');

            // Show textbox when "Other" is selected for item
            itemSelect.addEventListener('change', function () {
                if (itemSelect.value === 'Other') {
                    itemOtherInput.style.display = 'block';
                } else {
                    itemOtherInput.style.display = 'none';
                }
            });

            // Calculate Total Price when quantity or rate is updated
            function calculateTotalPrice() {
                const quantity = parseFloat(quantityValue.value) || 0;
                const rate = parseFloat(rateValue.value) || 0;
                const totalPrice = (quantity * rate).toFixed(2);
                totalPriceInput.value = totalPrice;
            }

            quantityValue.addEventListener('input', calculateTotalPrice);
            rateValue.addEventListener('input', calculateTotalPrice);

            // Remove row functionality
            newRow.querySelector('.remove-item').addEventListener('click', function () {
                newRow.remove();
            });
        });

        // Update Bill Functionality
        document.getElementById('updateBtn').addEventListener('click', function () {
            const tableRows = document.querySelectorAll('#groceryTable tbody tr');
            const groceryData = [];

            tableRows.forEach(row => {
                const seller = row.querySelector('input[placeholder="Enter seller name"]').value;
                const itemName = row.querySelector('.item-select').value === 'Other' ? 
                    row.querySelector('.item-other').value :
                    row.querySelector('.item-select').value;
                const quantity = row.querySelector('.quantity-value').value;
                const rate = row.querySelector('.rate-value').value;
                const totalPrice = row.querySelector('.total-price').value;
                const purchasedDate = row.querySelector('input[type="date"]').value;

                groceryData.push({ seller, itemName, quantity, rate, totalPrice, purchasedDate });
            });

            console.log(groceryData); // For testing purposes; replace with AJAX call to save data to the server
            alert('Bill Updated Successfully!');
        });
    </script>
</body>

</html>
