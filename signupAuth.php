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
    $message = "<table style=\"font-family: sans-serif; margin: auto\">
    <thead>
      <tr>
        <th>
          <p style=\"font-size: 54px; color: #1f1750; font-weight: bolder\">
            CPU
            <span style=\"color: #fcc60c; font-weight: bolder\">ENTERPRISE</span>
          </p>
        </th>
      </tr>
    </thead>
    <tbody>
      <tr style=\"text-align: center\">
        <td>
          <p style=\"margin-bottom: 20px\">
             Verify this email: $gmail <br />
          </p>
        </td>
      </tr>
      <tr style=\"text-align: center\">
        <td>
          <a
            style=\"
              text-decoration: none;
              color: white;
              background-color: #1f1750;
              padding: 10px 20px;
            \"
            href=\"" . htmlspecialchars($verificationLink) . "\"
          >
            VERIFY</a
          >
        </td>
      </tr>
    </tbody>
  </table>";

    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPAuth = true;
    $mail->Username = 'enterprisecpu@gmail.com';
    $mail->Password = 'olrp tvtf vvaf xrdk';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;
    $mail->setFrom('enterprisecpu@gmail.com');
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
            $verificationLink = "https://cpuenterprise.store/verify.php?token=" . $verificationToken;
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