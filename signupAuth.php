<?php
require_once 'config.php';

function sanitizeInput($input)
{
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = sanitizeInput($_POST["name"]);
    $email = sanitizeInput($_POST["email"]);
    $schoolID = sanitizeInput($_POST["schoolID"]);
    $password = sanitizeInput($_POST["password"]);
    $mobilenumber = sanitizeInput($_POST["mobile_number"]);

    $role = "student";

    $checkQuery = "SELECT * FROM users WHERE email = '$email'";
    $checkResult = mysqli_query($connection, $checkQuery);

    if (!empty($_FILES["profile_image"]["tmp_name"])) {
        $profileImage = file_get_contents($_FILES["profile_image"]["tmp_name"]);
    } else {
        $profileImage = null;
    }

    $insertQuery = "INSERT INTO users (name, email, schoolID, role, password, profile_image, mobile_number) 
                    VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $connection->prepare($insertQuery);
    $stmt->bind_param("sssssbs", $name, $email, $schoolID, $role, $password, $profileImage, $mobilenumber);
    $insertResult = $stmt->execute();

    if ($insertResult) {
        header("Location: index.php");
        exit();
    } elseif (!$stmt) {
        die("Error: " . mysqli_error($connection));
    }

}
?>