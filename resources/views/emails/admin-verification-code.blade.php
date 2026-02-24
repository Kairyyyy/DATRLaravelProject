<!DOCTYPE html>
<html>
<head>
    <title>Email Verification Code</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .container {
            background: #f4f4f4;
            border-radius: 8px;
            padding: 30px;
            text-align: center;
        }
        .code {
            font-size: 32px;
            font-weight: bold;
            color: #4CAF50;
            letter-spacing: 5px;
            margin: 20px 0;
            padding: 10px;
            background: #fff;
            border-radius: 5px;
            display: inline-block;
        }
        .footer {
            margin-top: 30px;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Email Verification Code</h2>
        <p>Hello {{ $admin->name }},</p>
        <p>Please use the following 6-digit code to verify your email address:</p>
        
        <div class="code">{{ $verificationCode }}</div>
        
        <p>This code will expire in 30 minutes.</p>
        
        <p>If you didn't request this verification, please ignore this email.</p>
        
        <div class="footer">
            &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
        </div>
    </div>
</body>
</html>