<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include the Composer autoloader
require __DIR__ . '/vendor/autoload.php';
// Function to send email confirmation
function sendConfirmationEmail($to, $recipient_name)
{
    // Create a new PHPMailer instance
    $mail = new PHPMailer();

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com'; // SMTP server
        $mail->SMTPAuth   = true; // Enable SMTP authentication
        $mail->Username   = ''; // SMTP username (your Gmail email address)
        $mail->Password   = ''; // SMTP password (your Gmail password)
        $mail->SMTPSecure = 'tls'; // Enable TLS encryption; `ssl` also accepted
        $mail->Port       = 587; // TCP port to connect to

        // Sender and recipient settings
        $mail->setFrom('', 'Team Up');
        $mail->addAddress($to, $recipient_name);

        // Content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = 'Your Account has been Created'; // Subject of the email

        // Constructing the email body
        $email_body = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Confirmation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom Styles */
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f1f3fc;
        }
        .header h2 {
            text-align: center;
            color: #192323;
        }
        .content__body {
            background-color: #fff;
            padding: 20px;
            margin-top: 20px;
            border-radius: 5px;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
        }
        .footer a {
            margin-right: 10px;
            color: #333;
        }
        /* Button Styles */
        .button {
        display: block;
        width: 200px;
        margin: 0 auto;
        padding: 10px 20px;
        background-color: #1a237e; /* Dark blue background */
        color: #ffffff; /* White text */
        text-align: center;
        text-decoration: none;
        border-radius: 5px;
        }

    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Registration Successful!</h2>
        </div>
        <div class="content__body">
            <p><strong>Dear ' . $recipient_name . ',</strong></p>
            <p>Your registration was successful. Thank you!</p>
            <p>Rgs,<br>Kimutai</p>
            <!-- Button for Login -->
            <a href="https://codewithkim.com/pay/" class="button">Login</a>
        </div>
        <div class="footer">
            <p>Lets connect!</p>
            <a href="https://twitter.com/codewithkim" target="_blank">Twitter</a>
            <a href="https://portfolio.codewithkim.com" target="_blank">Blog</a>
        </div>
    </div>
</body>
</html>

        ';

        $mail->Body = $email_body;

        // Send email
        if ($mail->send()) {
            echo 'Message has been sent successfully';
        } else {
            throw new Exception($mail->ErrorInfo);
        }
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$e->getMessage()}";
    }
}

?>
