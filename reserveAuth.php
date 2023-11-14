<?php
session_start();
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = $_POST['productId'];

    if (isset($_SESSION['user_id'], $_SESSION['user_name'], $_SESSION['schoolID'])) {
        $userID = $_SESSION['user_id'];
        $userName = $_SESSION['user_name'];
        $schoolID = $_SESSION['schoolID'];
    } else {
        echo "Reservation failed. Session variables not set.";
        exit;
    }

    $status = 0;

    mysqli_begin_transaction($connection);

    try {
        $updateQuery = "UPDATE inventory SET on_stock = on_stock - 1 WHERE id = ?";
        $stmt = $connection->prepare($updateQuery);
        $stmt->bind_param('i', $productId);
        $stmt->execute();
        $stmt->close();
        $insertQuery = "INSERT INTO reservations (productid, date, name, category, sku, description, image, status, userID, userName, schoolID, product_name)
        SELECT id,NOW(), ?, category, sku, description, image, ?, ?, ?, ?, product_name
        FROM inventory
        WHERE id = ?";
        $stmt = $connection->prepare($insertQuery);
        $stmt->bind_param('siissi', $userName, $status, $userID, $userName, $schoolID, $productId);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $notificationQuery = "INSERT INTO notification (user_id, productid, status,datetime) VALUES (?, ?, 'reserve',NOW())";
            $stmt2 = $connection->prepare($notificationQuery);
            $stmt2->bind_param('ii', $userID, $productId);
            $stmt2->execute();
            $stmt2->close();

            mysqli_commit($connection);
            echo "Reservation successful";
        } else {
            mysqli_rollback($connection);
            echo "Reservation failed";
        }

        $stmt->close();
    } catch (Exception $e) {
        mysqli_rollback($connection);
        echo "Reservation failed";
    }
}
?>