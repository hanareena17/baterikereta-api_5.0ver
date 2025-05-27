<!DOCTYPE html>
<html>
<head>
    <title>Password Reset Request</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px;">
        <h2 style="color: #2c3e50;">Password Reset Request</h2>
        
        <p>Hello,</p>
        
        <p>We received a request to reset your password. If you did not make this request, please ignore this email.</p>
        
        <p>To reset your password, click the button below:</p>
        
        <div style="text-align: center; margin: 30px 0;">
            <a href="http://localhost:8100/reset-password?token={{ $token }}" 
               style="background-color: #3498db; color: white; padding: 12px 24px; text-decoration: none; border-radius: 4px; display: inline-block;">
                Reset Password
            </a>
        </div>
        
        <p>Or copy and paste this link into your browser:</p>
        <p style="word-break: break-all;">http://localhost:8100/reset-password?token={{ $token }}</p>
        
        <p>This password reset link will expire in 60 minutes.</p>
        
        <p>If you have any questions, please contact our support team.</p>
        
        <p>Best regards,<br>BateriKereta Team</p>
    </div>
</body>
</html>