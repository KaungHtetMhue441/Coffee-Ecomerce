<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h1>Checkout</h1>
    <form id="checkout-form">
        @csrf
        <div class="form-group">
            <label for="amount">Amount</label>
            <input type="number" name="amount" id="amount" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="card-element">Credit or debit card</label>
            <div id="card-element" class="form-control"></div>
            <div id="card-errors" role="alert"></div>
        </div>

        <button type="submit" class="btn btn-primary">Submit Payment</button>
    </form>
</div>

<script src="https://js.stripe.com/v3/"></script>
<script>
    var stripe = Stripe('{{ config('services.stripe.key') }}');
    var elements = stripe.elements();
    var card = elements.create('card');
    card.mount('#card-element');

    var form = document.getElementById('checkout-form');
    form.addEventListener('submit', function(event) {
        event.preventDefault();

        stripe.createPaymentMethod('card', card).then(function(result) {
            if (result.error) {
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;
            } else {
                fetch('{{ route('checkout.process') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        amount: document.getElementById('amount').value,
                        payment_method_id: result.paymentMethod.id
                    })
                })
                .then(function(response) {
                    return response.json();
                })
                .then(function(responseJson) {s
                    window.location.href = responseJson.checkout_url;
                });
            }
        });
    });
</script>
</body>
</html>
