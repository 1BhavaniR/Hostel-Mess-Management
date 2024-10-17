<?php
session_start();
include '../includes/dbconn.php';

// Check if request is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Read the JSON data from the request
    $data = json_decode(file_get_contents("php://input"), true);

    if ($data) {
        foreach ($data as $item) {
            // Validate item data
            if (empty($item['seller']) || empty($item['itemName']) || empty($item['quantity']) || empty($item['rate']) || empty($item['totalPrice']) || empty($item['purchasedDate'])) {
                echo json_encode(['success' => false, 'message' => 'All fields are required.']);
                return;
            }

            // Prepare the SQL statement to update the database
            $stmt = $pdo->prepare("
                INSERT INTO grocery (seller_name, item_name, quantity, rate, total_price, purchased_date) 
                VALUES (:seller, :itemName, :quantity, :rate, :totalPrice, :purchasedDate)
                ON DUPLICATE KEY UPDATE
                    quantity = quantity + :quantity,
                    total_price = total_price + :totalPrice
            ");

            $stmt->bindParam(':seller', $item['seller']);
            $stmt->bindParam(':itemName', $item['itemName']);
            $stmt->bindParam(':quantity', $item['quantity']);
            $stmt->bindParam(':rate', $item['rate']);
            $stmt->bindParam(':totalPrice', $item['totalPrice']);
            $stmt->bindParam(':purchasedDate', $item['purchasedDate']);

            if (!$stmt->execute()) {
                $errorInfo = $stmt->errorInfo();
                echo json_encode(['success' => false, 'message' => $errorInfo[2]]);
                return;
            }
        }
        
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'No data received']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>
