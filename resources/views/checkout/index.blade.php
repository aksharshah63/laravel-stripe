<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
</head>

<body>
    <form action="{{ route('order.store') }}" method="POST">
        @csrf
        <select name="payment_method">
            @foreach ($paymentMethods as $method)
                <option value="{{ $method }}">{{ $method }}</option>
            @endforeach
        </select>
        <button type="submit">Checkout</button>
    </form>
</body>

</html>
