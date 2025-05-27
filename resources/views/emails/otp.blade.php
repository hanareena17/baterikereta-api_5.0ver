<!DOCTYPE html>
<html>
<head>
    <title>OTP Verification</title>
</head>
<body>
    <h2>Hello {{ $name }},</h2>
    <p>Your OTP verification code is: <strong>{{ $otp }}</strong></p>
    <p>This code will expire in 5 minutes.</p>
    <p>If you didn't request this code, please ignore this email.</p>
    <br>
    <p>Best regards,<br>BateriKereta Team</p>
</body>
</html> 