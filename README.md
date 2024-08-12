Login System

Version: 1.0.0
Last Updated: January 5, 2024
Author: Nischal Dhamala (nischaldhamala0@gmail.com)

## Description

The Login System is a web-based application designed to provide a secure and user-friendly registration and login process for online platforms. This system includes advanced features such as password strength criteria, password hashing (using BCRYPT), and CAPTCHA implementation to protect user information and prevent brute-force attacks as well as other cybersecurity threats.

## Features

- **User-friendly Interface:** Easy-to-navigate interface for account creation and login.
- **Real-time Password Strength Evaluation:** Provides instant feedback on the strength of the password.
- **CAPTCHA Implementation:** Text-based CAPTCHA to verify human users.
- **Password Hashing:** BCRYPT algorithm used for securely storing passwords.
- **Password Reset Functionality:** Users can reset their passwords via a link sent to their registered email address.

## Requirements

- **Web Server:** Apache, Nginx, or any server with PHP support.
- **PHP:** Version 7.4 or higher.
- **Web Browser:** Modern browsers such as Chrome, Safari, or Edge.
- **Dependencies:**
  - PHPMailer
  - Composer

## Installation

1. **Download and Install XAMPP:**
   - Install XAMPP Control Panel from [Apache Friends](https://www.apachefriends.org/index.html).

2. **Setup the Login System:**
   - Copy the `LoginSystem` folder to `C:\xampp\htdocs`.

3. **Start XAMPP:**
   - Launch the XAMPP Control Panel.
   - Start the Apache and MySQL modules.

4. **Create the Database:**
   - Open your web browser and navigate to [localhost/phpmyadmin/](http://localhost/phpmyadmin/).
   - Import the SQL query provided below to create the necessary database table:

   ```sql
   CREATE TABLE `users` (
     `id` int(11) NOT NULL,
     `username` varchar(100) NOT NULL,
     `email` varchar(255) NOT NULL,
     `password` varchar(255) NOT NULL,
     `reset_token` varchar(255) NOT NULL,
     `token_expiration` varchar(255) NOT NULL
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

5. **Open the Login System:**
   - Open your IDE and navigate to the LoginSystem folder.
   - In your web browser, go to [localhost/LoginSystem/]([url](http://localhost/LoginSystem/)).

**Usage**
1. Register a New Account:
   - Navigate to the Login System in your browser.
   - Enter a username and a strong password.
   - Complete the CAPTCHA challenge.
   - Click the "Register" button to create your account.

2. Password Reset:
   - If a user forgets their password, they can request a reset link.
   - After verifying their email, a reset link with a token will be sent to the registered email for resetting the password.

**Support**
For questions, issues, or suggestions, please contact the author via email: nischaldhamala0@gmail.com.

Note: This project is for educational purposes. Always ensure to secure sensitive data and update dependencies regularly.

```css
This `README.md` provides a clear and professional overview of your project, its features, installation instructions, usage, and support contact information.
