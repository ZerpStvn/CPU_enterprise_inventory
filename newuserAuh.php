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
    $role = sanitizeInput($_POST["role"]);
    $status = "Active"; // Default value for status

    $checkQuery = "SELECT * FROM users WHERE email = '$email'";
    $checkResult = mysqli_query($connection, $checkQuery);

    if (!empty($_FILES["profile_image"]["tmp_name"])) {
        $profileImage = file_get_contents($_FILES["profile_image"]["tmp_name"]);
    } else {
        $profileImage = null;
    }

    $currentDate = date("Y-m-d"); // Get the current date

    $insertQuery = "INSERT INTO users (name, email, schoolID, role, password, profile_image, mobile_number, datecreated, status) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $connection->prepare($insertQuery);
    $stmt->bind_param("sssssbsss", $name, $email, $schoolID, $role, $password, $profileImage, $mobilenumber, $currentDate, $status);
    $insertResult = $stmt->execute();

    if ($insertResult) {
        header("Location: userlists.php");
        exit();
    } elseif (!$stmt) {
        die("Error: " . mysqli_error($connection));
    }
}
?>