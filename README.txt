# Complete-Login With Google Verification reCaptcha
# Pashword Hashing Algorithm (BCRYPT) used
# Password Reset with reset link sent to registered mail


Step 1: Installation of XAMPP Control Panel 
Step 2: Copy LoginSystem folder to C:\xampp\htdocs 
Step 3: Start Xampp 
Step 4: Start Apache and MySQL module in xampp 
Step 5: Open localhost/phpmyadmin/ in browser
Step 6: Import SQL query provided below to make the database 
Step 7: Open folder LoginSystem in IDE 
Step 8: Open localhost/LoginSystem/ in browser



============ Login System =========================== 
Version: 1.0.0 
Last Updated: [2024 January 5] 
Author: [Nischal Dhamala] 



Description:
------------ 
The Login System is a web-based application designed to provide a secure and user-friendly registration process for online platforms. The system includes features such as password strength criteria, password hashing algorithm and captcha implementation to protect user information and pprevet from brute force attacks as well as other cyber security threats. 



Features: 
--------- 
- User-friendly interface for account creation 
- Real-time password strength evaluation 
- Text-based captcha implementation 
- Server-side processing using PHP



Requirements: 
------------- 
- Web server with PHP support (e.g., Apache, Nginx) 
- PHP 7.4 or higher 
- A modern web browser (e.g., Chrome, Safari, Edge) 
- Phpmailer and Composer installed



Database (SQL Query):
---------------------
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `reset_token` varchar(255) NOT NULL,
  `token_expiration` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


Installation: 
------------- 
1. Download and extract the LoginSystem files. 
2. Upload the extracted files to your web server. 
3. Ensure the server is configured to support PHP. 
4. Open a web browser and navigate to the URL where the LoginSystem files were uploaded.



Usage: 
------ 
1. Open the LoginSystem in a web browser. 
2. Enter a username and password for the new account. 
3. Complete the captcha challenge to verify that you are a human user. 
4. Click the "Register" button to submit the registration form. 
5. If the user forgets the password, after verifying the mail a reset linkwith token willbe sent to the registered mail for reset password 


Support: 
-------- 
For questions, issues, or suggestions, please contact [nischaldhamala@ismt.edu.np].