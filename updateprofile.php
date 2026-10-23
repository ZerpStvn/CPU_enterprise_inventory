<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['userid'];
    $name = $_POST['fname'];
    $mobile_number = $_POST['phone'];
    $password = $_POST['password'];

    $updateSql = "UPDATE users SET name = ?, mobile_number = ?, password = ? WHERE id = ?";
    $updateStmt = mysqli_prepare($connection, $updateSql);

    if ($updateStmt === false) {
        die("Prepare failed: " . htmlspecialchars(mysqli_error($connection)));
    }

    mysqli_stmt_bind_param($updateStmt, "sssi", $name, $mobile_number, $password, $user_id);
    $updateResult = mysqli_stmt_execute($updateStmt);

    if ($updateResult) {
        header("Location: profile.php?user_id=$user_id");
        exit();
    } else {
        echo "Update failed: " . htmlspecialchars(mysqli_stmt_error($updateStmt));
    }

    mysqli_stmt_close($updateStmt);
}
?>