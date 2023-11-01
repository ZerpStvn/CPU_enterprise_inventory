<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['acceptReservation'])) {
    $reservationId = $_POST['acceptReservation'];

    // Update the status to 1
    $updateQuery = "UPDATE reservations SET status = 1,dateclaimed = NOW() WHERE id = ?";
    $stmt = $connection->prepare($updateQuery);
    $stmt->bind_param('i', $reservationId);
    $stmt->execute();
    $stmt->close();

    // Output the updated status
    echo json_encode(['status' => 'success']);
    exit;
}