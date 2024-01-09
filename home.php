<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login or Register</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            position: relative;
            height: 100vh;
            background: linear-gradient(to right, #3494e6, #ec6ead);
            overflow: hidden;
        }

        h1 {
            position: absolute;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            color: #fff;
            font-size: 36px;
            text-align: center;
        }

        .buttons-container {
            text-align: center;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .login-button,
        .signup-button {
            display: inline-block;
            padding: 15px 30px;
            margin: 10px;
            text-decoration: none;
            color: #fff;
            background: linear-gradient(to right, #ff7e5f, #feb47b);
            border: none;
            border-radius: 50px;
            font-size: 18px;
            cursor: pointer;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .login-button:hover,
        .signup-button:hover {
            transform: scale(1.05);
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        }

        .homepage-content {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            color: #fff;
            text-align: center;
            font-size: 24px;
        }

        .content-item {
            margin: 10px;
        }
    </style>
</head>
<body>
    <h1>Advance Cyber Security Assignment</h1>

    <div class="buttons-container">
        <a href="login.php" class="login-button">Login</a>
        <a href="signup.php" class="signup-button">Signup</a>
    </div>

    <div class="homepage-content">
        <div class="content-item">Login & Registration System with Cybersecurity Measures</div>
        <div class="content-item"> <b>Nischal Dhamala</b> <br> Std Id: 239587644</div>
        <!-- Add more content items as needed -->
    </div>

</body>
</html>
