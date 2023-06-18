<!DOCTYPE html>
<html>
<head>
    <title>Password Reset</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        h1 {
            font-size: 24px;
            color: #333333;
            margin-top: 0;
        }
        p {
            margin: 0 0 10px;
        }
        .reset-message {
            margin-top: 20px;
        }
        .reset-message p {
            margin-bottom: 5px;
        }
        .reset-button {
            margin-top: 20px;
            text-align: center;
        }
        .reset-button a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #27ae60;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
        }
        .reset-button a:hover {
            background-color: #1f8c4e;
        }
        .contact-info {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #cccccc;
        }
        .contact-info p {
            margin-bottom: 5px;
        }
        .logo {
            text-align: center;
            margin-bottom: 20px;
        }
        .logo img {
            max-width: 200px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="{{asset('storage/'.(setting('site.logo')))}}" alt="Logo">
        </div>
        
        <h1>Password Reset</h1>
        <p>Hi there,</p>
        <p>We received a request to reset your password. If you initiated this request, please click the button below to reset your password:</p>
        
        <div class="reset-button">
            <a href="{{ route('showResetForm', $token) }}">Reset Password</a>
        </div>
        
        <div class="reset-message">
            <p>If you did not request a password reset, no further action is required.</p>
        </div>
        
        <p>If you have any questions or need assistance, please contact our support team.</p>
        
        <div class="contact-info">
            <p>Contact Information:</p>
            <p>Email: contact@elitechit.com</p>
        </div>
        
        <p>Thank you!</p>
    </div>
</body>
</html>
