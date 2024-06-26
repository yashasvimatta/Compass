<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
</head>
<body>
    <p>Hello {{ $user->first_name }},</p>
    
    <p>Thank you for registering with Course Compass. Please click the link below to verify your email address:</p>

    <a href="{{ route('verify.email', ['token' => $user->verification_token]) }}">Verify Email</a>

    <p>If you did not create an account on Course Compass, you can safely ignore this email.</p>

    <p>Best regards,<br>The Course Compass Team</p>
</body>
</html>
