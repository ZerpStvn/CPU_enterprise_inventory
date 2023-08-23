<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the data sent via POST
    $user_id = $_POST['user_id'];
    $name = $_POST['name'];
    $role = $_POST['role'];
    $email = $_POST['email'];
    $phone = $_POST['mobile_number'];
    $status = $_POST['status'];
    $password = $_POST['password'];

    // Perform the database update using prepared statements
    $sql = "UPDATE users SET name=?, role=?, email=?, mobile_number=?, status=?, password=? WHERE id=?";
    $stmt = mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($stmt, "ssssssi", $name, $role, $email, $phone, $status, $password, $user_id);

    if (mysqli_stmt_execute($stmt)) {
        // Update successful
        echo "success";
    } else {
        // Update failed
        echo "error";
    }

    mysqli_stmt_close($stmt);
}
?>
