<?php
session_start();
include '../includes/dbconn.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $itemName = $_POST['item_name'] ?? '';
    $issuedQuantity = (int)$_POST['issued_quantity'] ?? 0;

    // Validate inputs
    if (empty($itemName) || $issuedQuantity <= 0) {
        echo json_encode(['success' => false, 'message' => 'Invalid input.']);
        exit;
    }

    // Start transaction
    $pdo->beginTransaction();
    try {
        // Prepare SQL statement to update issued quantity
        $stmt = $pdo->prepare("
            UPDATE grocery 
            SET issued = issued + :issued_quantity 
            WHERE item_name = :item_name
        ");
        $stmt->bindParam(':item_name', $itemName);
        $stmt->bindParam(':issued_quantity', $issuedQuantity);
        
        // Execute the query
        if ($stmt->execute()) {
            // Now update the in-stock quantity
            $stmt = $pdo->prepare("
                UPDATE grocery 
                SET in_stock = quantity - issued 
                WHERE item_name = :item_name
            ");
            $stmt->bindParam(':item_name', $itemName);
            $stmt->execute();

            // Commit the transaction
            $pdo->commit();
            echo json_encode(['success' => true, 'message' => 'Issued items updated successfully.']);
        } else {
            // Rollback the transaction on failure
            $pdo->rollBack();
            echo json_encode(['success' => false, 'message' => 'Failed to update.']);
        }
    } catch (Exception $e) {
        // Rollback the transaction on exception
        $pdo->rollBack();
        echo json_encode(['success' => false, 'message' => 'An error occurred: ' . $e->getMessage()]);
    }
    exit; // Important to exit after handling POST
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update Issued Items</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f6f9;
        }
        .container {
            margin-top: 50px;
        }
        .form-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
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
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="form-container">
                    <h2 class="text-center mb-4">Update Issued Items</h2>
                    <form id="updateForm" class="row g-3">
                        <div class="col-md-6">
                            <label for="item_name" class="form-label">Item Name</label>
                            <input type="text" class="form-control" id="item_name" name="item_name" placeholder="Enter item name" required>
                        </div>
                        <div class="col-md-6">
                            <label for="issued_quantity" class="form-label">Issued Quantity</label>
                            <input type="number" class="form-control" id="issued_quantity" name="issued_quantity" placeholder="Enter issued quantity" required>
                        </div>
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-dark w-50">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for notifications -->
    <div class="modal fade" id="notificationModal" tabindex="-1" aria-labelledby="notificationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="notificationModalLabel">Update Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="notificationMessage">
                    <!-- Message will be injected here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('updateForm').onsubmit = async function(e) {
            e.preventDefault(); // Prevent default form submission
            const formData = new FormData(this); // Collect form data
            const response = await fetch('mess_update_issued.php', {
                method: 'POST',
                body: formData // Send data to the server
            });
            const result = await response.json(); // Parse JSON response
            
            // Display notification modal with message
            document.getElementById('notificationMessage').textContent = result.message;
            const modal = new bootstrap.Modal(document.getElementById('notificationModal'));
            modal.show(); // Show the modal
        };
    </script>
</body>
</html>
