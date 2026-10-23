<?php
require_once 'config.php';

function verifyEmail($verificationToken)
{
    global $connection;

    $checkQuery = "SELECT * FROM users WHERE verification_token = ?";
    $stmt = $connection->prepare($checkQuery);
    $stmt->bind_param("s", $verificationToken);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $updateQuery = "UPDATE users SET status = 'Active' WHERE verification_token = ?";
        $stmt = $connection->prepare($updateQuery);
        $stmt->bind_param("s", $verificationToken);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

$verificationToken = $_GET['token'];


if (!empty($verificationToken)) {
    if (verifyEmail($verificationToken)) {
        header("Location: index.php");
    } else {
        echo "Email verification failed. The token is either invalid or has already been used.";
    }
}
?>