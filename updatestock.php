<?php
// Include your database connection code from 'config.php'
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the product ID, current stock, and user input from the POST request
    $productId = $_POST["id"];
    $currentStock = $_POST["current_stock"];
    $userInput = $_POST["on_stock"];

    // Check if the input is a valid number
    if (!is_numeric($currentStock) || !is_numeric($userInput)) {
        echo "error: Invalid input.";
        exit;
    }

    // Calculate the total value
    $totalValue = $currentStock + $userInput;

    // Perform the database update
    // Replace the following lines with your database update code
    $sql = "UPDATE inventory SET on_stock = ? WHERE id = ?";

    $stmt = $connection->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("di", $totalValue, $productId);

        if ($stmt->execute()) {
            header("Location: productlist.php"); // Return success if the update was successful
        } else {
            echo "error: " . $stmt->error; // Return an error message if the update failed
        }

        $stmt->close();
    } else {
        echo "error: " . $connection->error; // Handle any prepare statement errors
    }
} else {
    // Handle invalid requests here
    echo "Invalid request!";
}