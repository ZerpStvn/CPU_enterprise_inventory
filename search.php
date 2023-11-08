<?php
require_once 'config.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['returnid']) && isset($_POST['productid'])) {
    $returnID = $_POST['returnid'];
    $productID = $_POST['productid'];

    // Start a transaction
    $connection->begin_transaction();

    // Update the 'reservations' table
    $updateQuery = "UPDATE reservations SET returned = 1, returndate = NOW() WHERE id = ?";
    $stmt = $connection->prepare($updateQuery);
    $stmt->bind_param('i', $returnID);
    $updateResult = $stmt->execute();

    // Increment the 'on_stock' column in the 'inventory' table
    $inventoryUpdateQuery = "UPDATE inventory SET on_stock = on_stock + 1 WHERE id = ?"; // Adjust this query if needed
    $stmt = $connection->prepare($inventoryUpdateQuery);
    $stmt->bind_param('i', $productID);
    $inventoryUpdateResult = $stmt->execute();

    if ($updateResult && $inventoryUpdateResult) {
        // Commit the transaction
        $connection->commit();

        // Output the updated status
        echo json_encode(['status' => 'success']);
    } else {
        // Rollback the transaction in case of an error
        $connection->rollback();

        echo json_encode(['status' => 'error']);
    }

    $stmt->close();
    exit;
}
