<?php
require_once 'config.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'mailer/src/Exception.php';
require 'mailer/src/PHPMailer.php';
require 'mailer/src/SMTP.php';

function sanitizeInput($input)
{
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}

function sendVerificationEmail($verificationLink, $gmail)
{
    $subject = "Email Verification";
    $message = "Please click the following link to verify your email address: $verificationLink";
    $headers = "From: your_email@example.com";

    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPAuth = true;
    $mail->Username = 'cpudining@gmail.com';
    $mail->Password = 'uginxxttjsnglaja';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;
    $mail->setFrom('cpudining@gmail.com');
    $mail->addAddress($gmail);
    $mail->isHTML(true);

    $mail->Subject = $subject;
    $mail->Body = $message;

    $mail->send();

    // mail($to, $subject, $message, $headers);
    echo '<script>We send you a Verification link </script>';
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input
    $name = sanitizeInput($_POST["name"]);
    $email = sanitizeInput($_POST["email"]);
    $schoolID = sanitizeInput($_POST["schoolID"]);
    $password = sanitizeInput($_POST["password"]);
    $mobilenumber = sanitizeInput($_POST["mobile_number"]);
    $role = "student";
    $status = "Pending";


    $verificationToken = bin2hex(random_bytes(16));


    $checkQuery = "SELECT * FROM users WHERE email = ?";
    $stmt = $connection->prepare($checkQuery);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 0) {
        $currentDate = date("Y-m-d");

        $insertQuery = "INSERT INTO users (name, email, schoolID, role, password, profile_image, mobile_number, datecreated, status, verification_token) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $connection->prepare($insertQuery);
        $stmt->bind_param("sssssbssss", $name, $email, $schoolID, $role, $password, $profileImage, $mobilenumber, $currentDate, $status, $verificationToken);
        $insertResult = $stmt->execute();

        if ($insertResult) {
            // Send verification email
            $verificationLink = "http://localhost/cpu_enterprise_inventory/verify.php?token=" . $verificationToken;
            sendVerificationEmail($verificationLink, $email);

            // Redirect to the homepage
            header("Location: signconfirm.php");
            exit();
        } else {
            die("Error: " . mysqli_error($connection));
        }
    } else {
        echo "Email already exists. Please use a different email.";
    }
}
?>