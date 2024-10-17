<?php
session_start();
require '../includes/dbconn.php'; // Adjust the path as necessary

// Check for a POST request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the JSON input from the request body
    $data = json_decode(file_get_contents('php://input'), true);

    // Prepare SQL statement for inserting data
    $stmt = $pdo->prepare("INSERT INTO grocery (seller_name, item_name, quantity, rate, total_price, purchased_date, in_stock, issued) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

    // Loop through the data and execute insert for each item
    foreach ($data as $item) {
        // Fetch the current stock from the database (if applicable)
        $currentStockStmt = $pdo->prepare("SELECT in_stock FROM grocery WHERE item_name = ? LIMIT 1");
        $currentStockStmt->execute([$item['itemName']]);
        $currentStock = $currentStockStmt->fetchColumn();

        // Check if current stock exists
        if ($currentStock === false) {
            // If the item does not exist, you may want to handle this case (e.g., log an error, skip the item, etc.)
            continue; // Skip to the next item if the stock doesn't exist
        }

        // Calculate new stock based on issued quantity
        $issuedQuantity = $item['quantity']; // Assuming quantity is the issued amount
        $newStock = $currentStock - $issuedQuantity; // Update in_stock based on quantity issued

        // Ensure new stock does not go below zero
        if ($newStock < 0) {
            echo json_encode(['status' => 'error', 'message' => 'Insufficient stock for item: ' . $item['itemName']]);
            exit;
        }

        // Insert the new grocery entry
        $stmt->execute([
            $item['sellerName'],
            $item['itemName'],
            $item['quantity'],
            $item['rate'],
            $item['totalPrice'],
            $item['purchasedDate'],
            $newStock, // Set in_stock
            $issuedQuantity // Set issued
        ]);
    }

    // Return a JSON response
    echo json_encode(['status' => 'success']);
    exit;
}

// If not a POST request, respond with an error
echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
