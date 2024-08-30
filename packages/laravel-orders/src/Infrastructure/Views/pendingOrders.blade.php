<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pending Orders</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://www.paypal.com/sdk/js?client-id={{ env('PAYPAL_CLIENT_ID') }}&currency=EUR"></script>

</head>
<body>
<div class="container">
    <h2>Orders List</h2>
    <table border="1">
        <thead>
        <tr>
            <th>ID</th>
            <th>Total Amount</th>
            <th>Currency</th>
            <th>Payment Status</th>
            <th>Paypal Payment</th>
        </tr>
        </thead>
        <tbody>
        @foreach($orders as $order)
            <tr>
                <td>{{ $order['id'] }}</td>
                <td>{{ $order['total_amount'] }}</td>
                <td>{{ $order['currency'] }}</td>
                <td>{{ $order['payment_status'] }}</td>
                <td>
                    <form action="{{ route('paypal.create') }}" method="get">
                        <input type="hidden" name="orderId" id="orderId" value="{{ $order['id'] }}">
                        <input type="hidden" name="userId" id="userId" value="{{ $order['user_id'] }}">
                        <input type="hidden" name="currency" id="currency" value="{{ $order['currency'] }}">
                        <input type="hidden" name="amount" id="amount" value="{{ $order['total_amount'] }}">
                        <button type="submit">Pay with PayPal</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

</body>
</html>
