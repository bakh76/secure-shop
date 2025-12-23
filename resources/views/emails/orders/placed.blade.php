<!DOCTYPE html>
<html>
<head>
    <title>Order Confirmation</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <h2>Thank you for your order, {{ $order->user->name }}!</h2>
    
    <p>Your order <strong>#{{ $order->id }}</strong> has been placed successfully.</p>
    
    <h3 style="border-bottom: 2px solid #eee; padding-bottom: 10px;">Order Summary</h3>
    
    <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
        <thead>
            <tr style="background-color: #f8f8f8; text-align: left;">
                <th style="padding: 10px; border-bottom: 1px solid #ddd;">Product</th>
                <th style="padding: 10px; border-bottom: 1px solid #ddd;">Qty</th>
                <th style="padding: 10px; border-bottom: 1px solid #ddd;">Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
            <tr>
                <td style="padding: 10px; border-bottom: 1px solid #ddd;">{{ $item->product_name }}</td>
                <td style="padding: 10px; border-bottom: 1px solid #ddd;">{{ $item->quantity }}</td>
                <td style="padding: 10px; border-bottom: 1px solid #ddd;">${{ number_format($item->price, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    <h3>Total: ${{ number_format($order->total, 2) }}</h3>
    
    <p style="color: #666; font-size: 14px;">
        We will notify you when your order is shipped.<br>
        Shipping to: {{ $order->shipping_address }}
    </p>
</body>
</html>