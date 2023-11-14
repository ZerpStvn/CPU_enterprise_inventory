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

        if ($user['status'] == 'Active') {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['schoolID'] = $user['schoolID'];
            $_SESSION['user_role'] = $user['role'];

            $stmt->close();
            $connection->close();

            if ($user['role'] == 'admin') {
                header("Location: home.php");
            } else {
                header("Location: student-productlist.php");
            }
            exit();
        }
        if ($user['status'] == "Pending") {
            header("Location: signconfirm.php");
            ;
        } else {
            echo "<script>alert('You are restricted to access. Please contact an administrator.');</script>";
        }
    } else {
        echo "<script>alert('Invalid Email and Password');</script>";
    }
}
?>