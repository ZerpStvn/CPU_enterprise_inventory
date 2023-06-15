<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the user ID and current status from the AJAX request
    $userId = $_POST['userId'];
    $currentStatus = $_POST['currentStatus'];

    // Determine the new status based on the current status
    $newStatus = ($currentStatus == 'Active') ? 'Restricted' : 'Active';

    // Perform the update in the database
    $updateQuery = "UPDATE users SET status = ? WHERE id = ?";
    $stmt = $connection->prepare($updateQuery);
    $stmt->bind_param('si', $newStatus, $userId);
    $stmt->execute();
    $stmt->close();

    // Return the updated status as the response
    echo $newStatus;
}
?>