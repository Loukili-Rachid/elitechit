<!DOCTYPE html>
<html>
<head>
    <title>Email Verification</title>
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
        .verification-message {
            margin-top: 20px;
        }
        .verification-message p {
            margin-bottom: 5px;
        }
        .verification-button {
            margin-top: 20px;
            text-align: center;
        }
        .verification-button a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #27ae60;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
        }
        .verification-button a:hover {
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
        
        <h1>Email Verification</h1>
        <p>Dear User,</p>
        <p>Thank you for signing up with <b>{{setting('site.company_name')}} </b>! Please click the button below to verify your email address:</p>
        
        <div class="verification-button">
            <a href="{{ route('client.verify', $token) }}">Verify Email Address</a>
        </div>
        
        <div class="verification-message">
            <p>If you did not sign up for an account or did not request this verification, please ignore this email.</p>
        </div>
        
        <p>For any questions or concerns, please feel free to contact our support team.</p>
        
        <div class="contact-info">
            <p>Contact Information:</p>
            <p>Email: contact@elitechit.com</p>
        </div>
        
        <p>Thank you!</p>
    </div>
</body>
</html>
