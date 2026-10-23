<?php
require_once 'config.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['returnid']) && isset($_POST['productid'])) {
    $returnID = $_POST['returnid'];
    $productID = $_POST['productid'];
    $qnty = $_POST['qnty'];
    // Start a transaction
    $connection->begin_transaction();

    // Update the 'reservations' table
    $updateQuery = "UPDATE reservations SET returned = 1, returndate = NOW() WHERE id = ?";
    $stmt = $connection->prepare($updateQuery);
    $stmt->bind_param('i', $returnID);
    $updateResult = $stmt->execute();

    $inventoryUpdateQuery = "UPDATE inventory SET  on_stock = on_stock + ? WHERE id = ?";
    $stmt = $connection->prepare($inventoryUpdateQuery);
    $stmt->bind_param('ii', $qnty, $productID);
    $inventoryUpdateResult = $stmt->execute();

    if ($updateResult && $inventoryUpdateResult) {
        $connection->commit();

        echo json_encode(['status' => 'success']);
    } else {
        $connection->rollback();

        echo json_encode(['status' => 'error']);
    }

    $stmt->close();
    exit;
}
