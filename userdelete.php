<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    $userId = $_GET['id'];

    // Delete the user from the database
    $sql = "DELETE FROM users WHERE id = ?";
    $stmt = mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($stmt, "i", $userId);
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        // User deleted successfully
        header("Location: userlist.php?message=delete_success");
        exit();
    } else {
        // Failed to delete the user
        header("Location: userlist.php?message=delete_error");
        exit();
    }

} else {
    // Invalid request or user ID not provided
    header("Location: userlist.php");
    exit();
}