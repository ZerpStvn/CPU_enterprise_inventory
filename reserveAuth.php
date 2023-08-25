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
        // Subtract the on_stock value by 1 in the inventory table
        $updateQuery = "UPDATE inventory SET on_stock = on_stock - 1 WHERE id = ?";
        $stmt = $connection->prepare($updateQuery);
        $stmt->bind_param('i', $productId);
        $stmt->execute();
        $stmt->close();

        // Insert the reservation data into the reservations table
        $insertQuery = "INSERT INTO reservations (productid, date, name, category, sku, description, image, status, userID, userName, schoolID, product_name)
        SELECT id,NOW(), ?, category, sku, description, image, ?, ?, ?, ?, product_name
        FROM inventory
        WHERE id = ?";
        $stmt = $connection->prepare($insertQuery);
        $stmt->bind_param('siissi', $userName, $status, $userID, $userName, $schoolID, $productId);
        $stmt->execute();

        // Check if the reservation was successfully inserted
        if ($stmt->affected_rows > 0) {
            // Insert data into the notification table
            $notificationQuery = "INSERT INTO notification (user_id, productid, status,datetime) VALUES (?, ?, 'reserve',NOW())";
            $stmt2 = $connection->prepare($notificationQuery);
            $stmt2->bind_param('ii', $userID, $productId);
            $stmt2->execute();
            $stmt2->close();

            // Commit the transaction if everything is successful
            mysqli_commit($connection);
            echo "Reservation successful";
        } else {
            // Rollback the transaction if the reservation failed
            mysqli_rollback($connection);
            echo "Reservation failed";
        }

        $stmt->close();
    } catch (Exception $e) {
        // Rollback the transaction on exception
        mysqli_rollback($connection);
        echo "Reservation failed";
    }
}
?>