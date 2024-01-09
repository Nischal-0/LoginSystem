<?php
session_start(); // Start session

include('db_connection.php');

$recaptchaError = ''; // Initialize reCAPTCHA error message

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $recaptchaSecretKey = "6LcGTUQpAAAAAPNr4CXX_RDm8MF4DWOZ2GyjpB6g";  
    $recaptchaResponse = $_POST['g-recaptcha-response'];

    $recaptchaUrl = "https://www.google.com/recaptcha/api/siteverify";
    $recaptchaData = [
        'secret' => $recaptchaSecretKey,
        'response' => $recaptchaResponse
    ];

    $recaptchaOptions = [
        'http' => [
            'method' => 'POST',
            'header' => 'Content-type: application/x-www-form-urlencoded',
            'content' => http_build_query($recaptchaData),
        ]
    ];

    $recaptchaContext = stream_context_create($recaptchaOptions);
    $recaptchaResult = json_decode(file_get_contents($recaptchaUrl, false, $recaptchaContext), true);

    if (!$recaptchaResult['success']) {
        $recaptchaError = "reCAPTCHA verification failed. Please try again.";
    }


    if (isset($_POST["username"]) && isset($_POST["password"]) ) {
        // Rest of your code
       
        $username = $_POST["username"];
        $password = $_POST["password"];
        // $email = $_POST["email"];

        $sql = "SELECT * FROM users WHERE username='$username'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row["password"])) {
                // Store username and email in session
                $_SESSION['username'] = $row['username'];
                $_SESSION['email'] = $row['email'];

                $_SESSION['login_success'] = true;

                header("Location: dashboard.php");
                exit();
            } else {
                echo "Invalid password";
            }
        } else {
            echo "User not found";
        }
    } elseif (isset($_POST["forgot"])) {
        // Forgot Password attempt
        $forgotEmail = $_POST["email"];

        if (filter_var($forgotEmail, FILTER_VALIDATE_EMAIL)) {
            // Check if the email exists in the database
            $checkEmailQuery = "SELECT * FROM users WHERE email = ?";
            $stmtCheckEmail = $conn->prepare($checkEmailQuery);
            $stmtCheckEmail->bind_param("s", $forgotEmail);
            $stmtCheckEmail->execute();
            $resultCheckEmail = $stmtCheckEmail->get_result();

            if ($resultCheckEmail->num_rows > 0) {
                // Email exists, proceed with password reset

                // Generate a random token
                $token = bin2hex(random_bytes(32));

                // Update the user's record with the token
                $updateQuery = "UPDATE userss SET reset_token = ? WHERE email = ?";
                $stmt = $conn->prepare($updateQuery);
                $stmt->bind_param("ss", $token, $forgotEmail);
                $stmt->execute();

                // Send an email with the reset link containing the token
                $resetLink = "http://localhost/LoginSystem/reset_password_process.php?token=$token";
                $subject = "Password Reset";
                $message = "Click the following link to reset your password: $resetLink";
                mail($forgotEmail, $subject, $message);

                echo "An email has been sent with instructions to reset your password.";
            } else {
                echo "Email not found.";
            }

            $stmtCheckEmail->close();
        } else {
            echo "Invalid email address.";
        }
    }
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="login.css" rel="stylesheet">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>

<?php
    if (isset($_SESSION['login_success']) && $_SESSION['login_success'] === true) {

        echo '<div class="welcome-message">Welcome, ' . $_SESSION['username'] . '! You have successfully logged in.</div>';

        $_SESSION['login_success'] = false;
    }
    ?>

<div class="login_form">
        <div class="container content">
            <h2>Log In</h2>
            <br>
            <?php if (!empty($recaptchaError)) : ?>
                <p class="error-message"><?php echo $recaptchaError; ?></p>
            <?php endif; ?>
            <form method="POST" action="login.php" class="login-form">
                <input type="text" name="username" placeholder="Username" required autofocus>
                <input type="password" name="password" placeholder="Password" required autofocus>

                <div class="g-recaptcha" data-sitekey="6LcGTUQpAAAAABTfOzPl28hznrAlgVqjoiqzu2rS"></div>

                <button class="btn" type="submit">Login</button>
            </form>

            <p class="account">Don't have an account? <a href="signup.php">Register</a></p>
            <p class="forget-password"><a href="forget_password.php">Forgot Password?</a></p>
        </div>
    </div>
</body>

</html>