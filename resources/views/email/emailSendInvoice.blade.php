<!DOCTYPE html>
<html>
<head>
    <title>Payment Confirmation</title>
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
        .payment-details {
            margin-top: 20px;
        }
        .payment-details p {
            margin-bottom: 5px;
        }
        .payment-details .amount {
            font-size: 18px;
            color: #27ae60;
            font-weight: bold;
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
        }
        .logo img {
            max-width: 90px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="{{asset('storage/'.(setting('site.logo')))}}" alt="Logo">
        </div>
        
        <h1>Payment Confirmation</h1>
        <p>Dear Customer, <b>{{$name}}</b></p>
        <p>Thank you for your payment. We are pleased to confirm that your payment has been received and processed successfully.</p>
        
        <div class="payment-details">
            <p>Payment Details:</p>
            <p>Amount Paid: <span class="amount">${{$total}}</span></p>
            <p>Payment Date: {{$paymentDate}}</p>
        </div>
        <p>For your reference, we have attached the invoice to this email. Please review it and keep it for your records.</p>
        <p>For any questions or concerns, please feel free to contact our support team.</p>
        
        <div class="contact-info">
            <p>Contact Information:</p>
            <p>Email: contact@elitechit.com</p>
        </div>
        
        <p>Thank you for choosing <strong>{{setting('site.company_name')}} .</strong>
    </div>
</body>
</html>
