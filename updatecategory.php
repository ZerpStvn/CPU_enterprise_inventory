<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $categoryId = $_POST['category_id'];
    $categoryName = $_POST['category_name'];
    $categoryCode = $_POST['category_code'];
    $description = $_POST['description'];

    // Update the category in the database
    $sql = "UPDATE category SET category_name = '$categoryName', category_code = '$categoryCode', description = '$description' WHERE id = $categoryId";
    $result = mysqli_query($connection, $sql);

    if ($result) {
        // Category updated successfully
        header("Location: categorylist.php");
        exit();
    } else {
        echo "Error updating category: " . mysqli_error($connection);
        exit();
    }
} else {
    echo "Invalid request";
    exit();
}
?>