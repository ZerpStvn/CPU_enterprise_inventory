<?php
require_once 'config.php';

// Function to sanitize user input
function sanitizeInput($input)
{
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}

// Check if the signup form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user input from the signup form
    $name = sanitizeInput($_POST["name"]);
    $email = sanitizeInput($_POST["email"]);
    $schoolID = sanitizeInput($_POST["schoolID"]);
    $password = sanitizeInput($_POST["password"]);

    // Default role
    $role = "student";

    // Check if the email already exists in the database
    $checkQuery = "SELECT * FROM users WHERE email = '$email'";
    $checkResult = mysqli_query($connection, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        // Email already exists, display an alert message
        echo "<script>alert('Email already exists. Please use a different email.');</script>";
    } else {
        // Insert user data into the database
        $insertQuery = "INSERT INTO users (name, email, schoolID, role,password) VALUES ('$name', '$email', '$schoolID', '$role','$password')";
        $insertResult = mysqli_query($connection, $insertQuery);

        if ($insertResult) {
            // Signup successful, redirect the user to the desired page
            header("Location: index.php");
            exit();
        } else {
            // Signup failed, display an error message
            echo "Error: " . mysqli_error($connection);
        }
    }
}
?>