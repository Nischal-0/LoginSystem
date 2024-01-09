<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        fieldset {
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
            border-radius: 10px;
            width: 400px;
            text-align: center;
        }

        legend {
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
            text-align: center;
        }

        label {
            display: block;
            margin-top: 15px;
            margin-bottom: 5px;
            color: #555;
        }

        input {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            background-color: #4CAF50;
            color: #fff;
            padding: 15px 25px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #45a049;
        }

        .email-icon {
            font-size: 40px;
            color: #3498db;
        }

        .reset-link {
            color: #3498db;
            text-decoration: none;
            font-weight: bold;
        }

        .reset-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<?php
include('db_connection.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

function generateToken() {
    return bin2hex(random_bytes(32));
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["email"])) {
    $email = $_POST["email"];

    // Validate the email
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Check if the email exists in the database
        $checkEmailQuery = "SELECT * FROM users WHERE email = ?";
        $stmtCheckEmail = $conn->prepare($checkEmailQuery);
        $stmtCheckEmail->bind_param("s", $email);
        $stmtCheckEmail->execute();
        $resultCheckEmail = $stmtCheckEmail->get_result();

        if ($resultCheckEmail->num_rows > 0) {

            $token = generateToken();

            // Calculate expiration time (2 minutes from here)
            $expirationTime = date('Y-m-d H:i:s', strtotime('+2 minutes'));

            // Update the user's record with the token and expiration time
            $updateQuery = "UPDATE users SET reset_token = ?, token_expiration = ? WHERE email = ?";
            $stmtUpdateToken = $conn->prepare($updateQuery);
            $stmtUpdateToken->bind_param("sss", $token, $expirationTime, $email);
            $stmtUpdateToken->execute();

            // Set up PHPMailer
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'To_recieve_mail_id'; 
            $mail->Password = 'Passcode_not_Password'; 
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            // Set additional headers for the email
            $headers = "To_recieve_mail_id\r\n";
            $headers .= "To_reply_mail_id\r\n"; 
            $headers .= "To_recieve_mail_id\r\n";
            $headers .= "X-Mailer: PHP/" . phpversion();

            // Send an email with the reset link containing the token
            $resetLink = "http://localhost/LoginSystem/reset_password.php?token=$token";
            
            $subject = "Password Reset Link";
            
            $message = "Greetings,

            Click the password reset link below to reset your password for the LoginSystem.
            
            Reset Link: $resetLink
            
            Don't forget your password again. 🧠";

            // Use the updated headers in the mail function
            $mail->setFrom('To_recieve_mail_id');
            $mail->addReplyTo('To_send_reply_mail_id'); 
            $mail->addAddress($email);
            $mail->Subject = $subject;
            $mail->Body = $message;

            // Enable debugging for detailed information
            $mail->SMTPDebug = 0;

            try {
                $mail->send();
                echo "Password reset email sent to " . $email;
                echo "Please check your email. Token expiry time: 2 minutes";
            } catch (Exception $e) {
                echo "Error sending password reset email. Please check your email settings. Error: " . $mail->ErrorInfo;
            }
        } else {
            echo "Email not found.";
        }

        $stmtCheckEmail->close();
    } else {
        echo "Invalid email address.";
    }
}

$conn->close();
?>

<fieldset>
        <legend>Password Reset</legend>
        <div class="email-icon">📧</div>
        <p>Enter your email address to receive a password reset link.</p>
        <form id="reset-form" method="post" action="forget_password.php">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>
            <button type="submit">Reset Password</button>
        </form>
    </fieldset>
</body>
</html>