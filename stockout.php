<?php
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productId = $_POST["id"];
    $currentStock = $_POST["current_stock"];
    $userInput = $_POST["on_stock"];

    if (!is_numeric($currentStock) || !is_numeric($userInput)) {
        echo "error: Invalid input.";
        exit;
    }

    $totalValue = $currentStock - $userInput;

    $sql = "UPDATE inventory SET on_stock = ? WHERE id = ?";

    $stmt = $connection->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("di", $totalValue, $productId);

        if ($stmt->execute()) {
            header("Location: productlist.php");
        } else {
            echo "error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "error: " . $connection->error;
    }
} else {
    echo "Invalid request!";
}