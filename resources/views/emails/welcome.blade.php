<!DOCTYPE html>
<html>
<head>
    <title>Welcome to SecureShop</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <h2>Welcome, {{ $user->name }}!</h2>
    
    <p>Thank you for registering with <strong>SecureShop</strong>. We are excited to have you on board.</p>
    
    <p>You can now browse our products, add items to your cart, and make secure purchases.</p>
    
    <p style="margin-top: 20px;">
        <a href="{{ route('login') }}" style="background-color: #4f46e5; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">Login to your account</a>
    </p>
    
    <p style="color: #666; font-size: 14px; margin-top: 30px;">
        If you did not create this account, please contact our support team immediately.
    </p>
</body>
</html>