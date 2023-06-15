<?php
include 'config.php';

if (isset($_GET['id'])) {
    $categoryId = $_GET['id'];

    $sql = "DELETE FROM category WHERE id = $categoryId";
    $result = mysqli_query($connection, $sql);

    if ($result) {
        header("Location: categorylist.php");
        exit();
    } else {
        echo "Error deleting category: " . mysqli_error($connection);
        exit();
    }
} else {
    echo "Category ID not provided";
    exit();
}
?>