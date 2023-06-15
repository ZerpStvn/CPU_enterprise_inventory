<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $productId = $_GET['id'];
    $productName = $_POST['product_name'];
    $category = $_POST['category'];
    $sku = $_POST['sku'];
    $minimumQuantity = $_POST['minimum_quantity'];
    $onStock = $_POST['on_stock'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $status = $_POST['status'];

    // Handle file upload
    // $targetDirectory = 'uploads/'; // Folder to store uploaded images
    // $targetFile = $targetDirectory . basename($_FILES['imageFile']['name']);
    // $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // // Check if the file is a valid image
    // $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
    // if (!in_array($imageFileType, $allowedExtensions)) {
    //     echo 'Error: Invalid image file format.';
    //     exit();
    // }

    // // Move the uploaded file to the target directory
    // if (!move_uploaded_file($_FILES['imageFile']['tmp_name'], $targetFile)) {
    //     echo 'Error: Failed to upload image.';
    //     exit();
    // }

    // Prepare and execute the SQL query
    $sql = "UPDATE inventory SET product_name = ?, category = ?, sku = ?, minimum_quantity = ?, on_stock = ?, description = ?, price = ?, status = ? WHERE id = ?";
    $stmt = mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($stmt, "ssssssssi", $productName, $category, $sku, $minimumQuantity, $onStock, $description, $price, $status, $productId);
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        // Redirect back to the product list page with a success message
        header("Location: productlist.php?message=update_success");
        exit();
    } else {
        // Redirect back to the product list page with an error message
        header("Location: productlist.php?message=update_error");
        exit();
    }

} else {
    // Redirect back to the product list page if accessed directly without submitting the form
    header("Location: productlist.php");
    exit();
}
?>