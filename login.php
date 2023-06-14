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
    $email = sanitizeInput($_POST["email"]);
    $password = sanitizeInput($_POST["password"]);

    $query = "SELECT * FROM users WHERE email = ? AND password = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        // Store user data in session variables for access in other pages
        session_start();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_role'] = $user['role'];

        // Close the statement and database connection
        $stmt->close();
        $connection->close();

        // Redirect user based on their role
        if ($user['role'] == 'admin') {
            header("Location: home.php");
        } else {
            header("Location: home.php");
        }
        exit();
    } else {
        echo "<script>alert('Invalid email or password.');</script>";
    }
}
?>