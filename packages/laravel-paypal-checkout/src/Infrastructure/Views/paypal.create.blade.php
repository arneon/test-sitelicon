<!DOCTYPE html>
<html>
<head>
    <title>PayPal Payment</title>
</head>
<body>
<form action="{{ route('paypal.create') }}" method="get">
    <button type="submit">Pay with PayPal</button>
</form>
</body>
</html>
