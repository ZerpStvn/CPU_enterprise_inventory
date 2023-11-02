<?php
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productId = $_POST["id"];
    $currentStock = $_POST["current_stock"];
    $userInput = $_POST["on_stock"];
    $userrole = $_POST["stockinuserrole"];
    $userstock = $_POST["stockinuser"];
    $prodid = $_POST["prodid"];
    // Check if the input is a valid number
    if (!is_numeric($currentStock) || !is_numeric($userInput)) {
        echo "error: Invalid input.";
        exit;
    }

    $totalValue = $currentStock + $userInput;

    // Update the 'inventory' table
    $updateSql = "UPDATE inventory SET on_stock = ? WHERE id = ?";
    $stmt = $connection->prepare($updateSql);

    if ($stmt) {
        $stmt->bind_param("di", $totalValue, $productId);

        if ($stmt->execute()) {
            $stmt->close();

            $stockinSql = "INSERT INTO stockin (stockdate, stockin, stockuser,productid,userrole) VALUES (NOW(), ?, ?,?,?)";
            $stmt = $connection->prepare($stockinSql);

            if ($stmt) {
                $stmt->bind_param("ssis", $userInput, $userstock, $prodid, $userrole);

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
            echo "error: " . $stmt->error;
        }
    } else {
        echo "error: " . $connection->error;
    }
} else {
    echo "Invalid request!";
}
