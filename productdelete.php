<?php
include 'config.php';

if (isset($_GET['id'])) {
    $productId = $_GET['id'];

    // Prepare and execute the SQL query
    $sql = "DELETE FROM inventory WHERE id = ?";
    $stmt = mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($stmt, "i", $productId);
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        // Deletion successful
        header("Location: productlist.php?success=1");
        exit();
    } else {
        // Failed to delete product
        header("Location: productlist.php?error=1");
        exit();
    }

}

// Redirect back to the product list page if no product ID is provided
header("Location: productlist.php");
exit();
?>