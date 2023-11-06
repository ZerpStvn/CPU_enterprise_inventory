<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['returnid'])) {
    $returnID = $_POST['returnid'];

    // Update the status to 1
    $updateQuery = "UPDATE reservations SET returned = 1,returndate = NOW() WHERE id = ?";
    $stmt = $connection->prepare($updateQuery);
    $stmt->bind_param('i', $returnID);
    $stmt->execute();
    $stmt->close();

    // Output the updated status
    echo json_encode(['status' => 'success']);
    exit;
}