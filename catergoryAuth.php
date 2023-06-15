<?php
// Include the database connection configuration
include 'config.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $categoryName = $_POST["category_name"];
    $categoryCode = $_POST["category_code"];
    $description = $_POST["description"];

    // Prepare and bind the statement
    $stmt = $connection->prepare("INSERT INTO category (category_name, category_code, description) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $categoryName, $categoryCode, $description);


    // Execute the statement
    if ($stmt->execute()) {
        header("Location: categorylist.php");
    } else {
        echo "Error storing category data: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}
?>