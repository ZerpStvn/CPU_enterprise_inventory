<?php
include 'config.php';

// Retrieve form data
$productName = $_POST['product_name'];
$category = $_POST['category'];
$sku = $_POST['sku'];
$minimumQuantity = $_POST['minimum_quantity'];
$onStock = $_POST['on_stock'];
$description = $_POST['description'];
$price = 0;
$status = $_POST['status'];

// Add the current date
$date = date("Y-m-d");

// Handle file upload
$targetDirectory = 'uploads/'; // Folder to store uploaded images
$targetFile = $targetDirectory . basename($_FILES['imageFile']['name']);
$imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

// Check if the file is a valid image
$allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
if (!in_array($imageFileType, $allowedExtensions)) {
    echo 'Error: Invalid image file format.';
    exit();
}

// Move the uploaded file to the target directory
if (!move_uploaded_file($_FILES['imageFile']['tmp_name'], $targetFile)) {
    echo 'Error: Failed to upload image.';
    exit();
}

// Prepare and execute the SQL query
$sql = "INSERT INTO inventory (product_name, category, sku, minimum_quantity, on_stock, description, image, price, status, date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($connection, $sql);
mysqli_stmt_bind_param($stmt, "sssiisssss", $productName, $category, $sku, $minimumQuantity, $onStock, $description, $targetFile, $price, $status, $date);
$result = mysqli_stmt_execute($stmt);

if ($result) {
    // Image uploaded and data stored successfully
    header("Location: productlist.php ");
} else {
    // Failed to store image and data
    echo "Error: " . mysqli_error($connection);
}

mysqli_stmt_close($stmt);
mysqli_close($connection);
?>