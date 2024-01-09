<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Register</title>
</head>
<body>

<<div class="signup-container">
    <button id="back-button" onclick="window.location.href='login.php'">&#8592; Login</button>
    <h2>Register</h2>
    <form id="signup-form" action="signup_process.php" method="post">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" placeholder="Enter User Name" required oninput="checkPasswordValidity()">
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Enter Your Email" required oninput="checkPasswordValidity()">
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Enter Your Password" required oninput="checkPasswordMatch(); checkPasswordStrength(); checkPasswordValidity()">
            <p id="password-strength" class="error-message"></p>
        </div>
    
        <div class="form-group">
            <label for="confirm-password">Confirm Password:</label>
            <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirm Your password" required oninput="checkPasswordMatch()">
            <p id="password-match-error" class="error-message"></p>
        </div>

        <p id="password-validation-error" class="error-message"></p>

        <button type="submit">Sign Up</button>
    </form>
</div>

<script>
    function submitForm() {
        var username = document.getElementById('username').value;
        var email = document.getElementById('email').value;
        var password = document.getElementById('password').value;
        var confirmPassword = document.getElementById('confirm-password').value;
        var errorMessageElement = document.getElementById('password-validation-error');

        if (!username || !email || !password || !confirmPassword) {
            errorMessageElement.innerHTML = '<span style="color: red;">Please fill out all required fields before submitting.</span>';
            return false;
        }

        if (password !== confirmPassword) {
            errorMessageElement.innerHTML = '<span style="color: red;">Passwords do not match.</span>';
            return false;
        }

        if (password.includes(username) || password.includes(email)) {
            errorMessageElement.innerHTML = '<span style="color: red;">Password cannot contain username or email.</span>';
            return false;
        }

        if (!checkPasswordCriteria(password)) {
            errorMessageElement.innerHTML = '<span style="color: red;">Password does not meet criteria.</span>';
            return false;
        }

        // Display registration successful popup
        var popup = document.createElement("div");
        popup.innerHTML = '<div style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background: #4CAF50; color: #fff; padding: 15px; border-radius: 5px; text-align: center;">Registration successful!</div>';
        document.body.appendChild(popup);

        // Countdown timer
        var countdown = 5;
        var countdownElement = document.createElement("div");
        countdownElement.innerHTML = '<div style="position: fixed; top: 10px; right: 10px; background: #333; color: #fff; padding: 10px; border-radius: 5px; text-align: center;">Redirecting in <span id="countdown">' + countdown + '</span> seconds</div>';
        document.body.appendChild(countdownElement);

        // Update countdown every second
        var countdownInterval = setInterval(function () {
            countdown--;
            document.getElementById('countdown').innerText = countdown;

            if (countdown <= 0) {
                clearInterval(countdownInterval);
                window.location.href = 'login.php';
            }
        }, 1000);

        return false; // Prevent the form from actually submitting
    }


    function checkPasswordCriteria(password) {
        // Define criteria
        var minLength = 8;
        var hasUppercase = /[A-Z]/.test(password);
        var hasLowercase = /[a-z]/.test(password);
        var hasNumber = /\d/.test(password);
        var hasSpecialChar = /[!@#$%^&*(),.?":{}|<>]/.test(password);

        return (
            password.length >= minLength &&
            hasUppercase &&
            hasLowercase &&
            hasNumber &&
            hasSpecialChar
        );
    }

    function checkPasswordMatch() {
        var password = document.getElementById('password').value;
        var confirmPassword = document.getElementById('confirm-password').value;
        var matchErrorElement = document.getElementById('password-match-error');

        if (password === confirmPassword) {
            matchErrorElement.innerHTML = '';
        } else {
            matchErrorElement.innerHTML = '<span style="color: red;">Passwords do not match.</span>';
        }
    }

    function checkPasswordStrength() {
        var password = document.getElementById('password').value;
        var strengthMeter = document.getElementById('password-strength');

        // Reset the meter
        strengthMeter.innerHTML = '';

        // Define criteria
        var minLength = 8;
        var hasUppercase = /[A-Z]/.test(password);
        var hasLowercase = /[a-z]/.test(password);
        var hasNumber = /\d/.test(password);
        var hasSpecialChar = /[!@#$%^&*(),.?":{}|<>]/.test(password);

        // Check each criterion and update the meter
        if (password.length >= minLength) {
            strengthMeter.innerHTML += '<span style="color: green;">&#9989; Length is at least ' + minLength + ' characters.</span><br>';
        } else {
            strengthMeter.innerHTML += '<span style="color: red;">&#10060; Length should be at least ' + minLength + ' characters.</span><br>';
        }

        if (hasUppercase) {
            strengthMeter.innerHTML += '<span style="color: green;">&#9989; Contains uppercase letters.</span><br>';
        } else {
            strengthMeter.innerHTML += '<span style="color: red;">&#10060; Should contain at least one uppercase letter.</span><br>';
        }

        if (hasLowercase) {
            strengthMeter.innerHTML += '<span style="color: green;">&#9989; Contains lowercase letters.</span><br>';
        } else {
            strengthMeter.innerHTML += '<span style="color: red;">&#10060; Should contain at least one lowercase letter.</span><br>';
        }

        if (hasNumber) {
            strengthMeter.innerHTML += '<span style="color: green;">&#9989; Contains numbers.</span><br>';
        } else {
            strengthMeter.innerHTML += '<span style="color: red;">&#10060; Should contain at least one number.</span><br>';
        }

        if (hasSpecialChar) {
            strengthMeter.innerHTML += '<span style="color: green;">&#9989; Contains special characters.</span><br>';
        } else {
            strengthMeter.innerHTML += '<span style="color: red;">&#10060; Should contain at least one special character.</span><br>';
        }
    }

    function checkPasswordValidity() {
        var username = document.getElementById('username').value.toLowerCase();
        var email = document.getElementById('email').value.toLowerCase();
        var password = document.getElementById('password').value;
        var validityErrorElement = document.getElementById('password-validation-error');

        if (password.includes(username) || password.includes(email)) {
            validityErrorElement.innerHTML = '<span style="color: red;">Password cannot contain username or email.</span>';
        } else {
            validityErrorElement.innerHTML = '';
        }
    }
</script>

</body>
</html>