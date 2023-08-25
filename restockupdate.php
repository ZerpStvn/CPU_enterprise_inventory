<?php
include 'config.php';

function storeNotification($connection, $productId, $userId)
{
    $status = "restock"; // Set the status to "reserve"

    // Check if the notification data already exists
    $checkQuery = "SELECT * FROM notification WHERE user_id = ? AND productid = ? AND status = ?";
    $stmt = mysqli_prepare($connection, $checkQuery);
    mysqli_stmt_bind_param($stmt, "iis", $userId, $productId, $status);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) === 0) {
        // If the notification data does not exist, insert it
        $insertQuery = "INSERT INTO notification (user_id, productid, status) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($connection, $insertQuery);
        mysqli_stmt_bind_param($stmt, "iis", $userId, $productId, $status);
        $result = mysqli_stmt_execute($stmt);

        return $result;
    } else {
        // Notification data already exists, return false to indicate no new insertion
        return false;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $productId = $_GET['id'];
    $productName = $_POST['product_name'];
    $sku = $_POST['sku'];
    $minimumQuantity = $_POST['minimum_quantity'];
    $onStock = $_POST['on_stock'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $status = $_POST['status'];

    // Update the inventory table
    $sql = "UPDATE inventory SET product_name = ?, sku = ?, minimum_quantity = ?, on_stock = ?, description = ?, price = ?, status = ? WHERE id = ?";
    $stmt = mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($stmt, "sssssssi", $productName, $sku, $minimumQuantity, $onStock, $description, $price, $status, $productId);
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        // Check if user_id and productId are provided in the URL
        if (isset($_GET['userid'])) {
            $userId = $_GET['userid'];
            // Call the storeNotification function to store the notification data
            $notificationResult = storeNotification($connection, $productId, $userId);

            if ($notificationResult) {
                header("Location: restock.php?id=$productId&userid=$userId&message=update_success");
                exit();
            } else {
                header("Location: restock.php?id=$productId&userid=$userId&message=notification_exists");
                exit();
            }
        } else {
            header("Location: restock.php?id=$productId&message=update_success");
            exit();
        }
    } else {
        header("Location: restock.php?id=$productId&message=update_error");
        exit();
    }
}
?>