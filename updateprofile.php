<?php
include 'config.php';

// Check if user_id is provided
if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];

    // Retrieve the user details from the database
    $sql = "SELECT * FROM users WHERE id = ?";
    $stmt = mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Check if the user exists
    if (mysqli_num_rows($result) > 0) {
        $userdata = mysqli_fetch_assoc($result);
    } else {
        // Redirect back to the product list page if the user doesn't exist
        header("Location: adminRequest.php");
        exit();
    }

    mysqli_stmt_close($stmt);
} else {
    // Redirect back to the product list page if no user_id is provided
    header("Location: adminRequest.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve user input
    $name = $_POST['name'];
    $role = $_POST['role'];
    $email = $_POST['email'];
    $mobile_number = $_POST['mobile_number'];
    $status = $_POST['status'];
    $password = $_POST['password']; // Note: This should be securely hashed in a real application

    // Update the user data in the database
    $updateSql = "UPDATE users SET name = ?, role = ?, email = ?, mobile_number = ?, status = ?, password = ? WHERE id = ?";
    $updateStmt = mysqli_prepare($connection, $updateSql);
    mysqli_stmt_bind_param($updateStmt, "ssssssi", $name, $role, $email, $mobile_number, $status, $password, $user_id);
    $updateResult = mysqli_stmt_execute($updateStmt);

    if ($updateResult) {
        // Redirect to a success page or display a success message
        header("Location: profile.php");
        exit();
    } else {
        // Handle the update failure (e.g., display an error message)
        echo "Update failed.";
    }

    mysqli_stmt_close($updateStmt);
}
?>