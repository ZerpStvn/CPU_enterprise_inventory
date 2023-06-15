<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    // Retrieve the user ID from the URL parameter
    $userId = $_GET['id'];

    // Perform the deletion of the user based on the provided user ID
    $deleteQuery = "DELETE FROM users WHERE id = ?";
    $stmt = $connection->prepare($deleteQuery);
    $stmt->bind_param('i', $userId);
    $stmt->execute();
    $stmt->close();

    // Redirect to the user list page after deletion
    header("Location: userlists.php");
    exit();
} else {
    // If no user ID is provided or the request method is not GET, redirect to the user list page
    header("Location: userlists.php");
    exit();
}
?>