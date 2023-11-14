<?php
session_start();
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the reservation data from the AJAX request
    $productId = $_POST['productId'];

    // Check if the necessary session variables are set
    if (isset($_SESSION['user_id'], $_SESSION['user_name'], $_SESSION['schoolID'])) {
        $userID = $_SESSION['user_id'];
        $userName = $_SESSION['user_name'];
        $schoolID = $_SESSION['schoolID'];
    } else {
        // Handle the case when session variables are not set
        echo "Reservation failed. Session variables not set.";
        exit;
    }

    $status = 0; // Default status is 1

    // Start a transaction
    mysqli_begin_transaction($connection);

    try {

        $insertRequestQuery = "INSERT INTO request (productid, date, name, category, sku, description, image, status, userID, userName, schoolID, product_name)
        SELECT id, NOW(), ?, category, sku, description, image, ?, ?, ?, ?, product_name
        FROM inventory
        WHERE id = ?";
        $stmt = $connection->prepare($insertRequestQuery);
        $stmt->bind_param('siissi', $userName, $status, $userID, $userName, $schoolID, $productId);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            // Now insert into the notification table
            $insertNotificationQuery = "INSERT INTO notification (user_id, productid, status, datetime) VALUES (?, ?, 'request', NOW())";
            $stmt2 = $connection->prepare($insertNotificationQuery);
            $stmt2->bind_param('ii', $userID, $productId, );
            $stmt2->execute();

            if ($stmt2->affected_rows > 0) {
                mysqli_commit($connection);
            } else {
                mysqli_rollback($connection);
                echo "Request failed";
            }

            $stmt2->close();
        } else {
            // Rollback the transaction if the reservation failed
            mysqli_rollback($connection);
            echo "Request failed";
        }

        $stmt->close();
    } catch (Exception $e) {
        // Rollback the transaction on exception
        mysqli_rollback($connection);
        echo "Request failed";
    }
}
?>