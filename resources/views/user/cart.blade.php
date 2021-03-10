@extends('layouts.app')

@section('content')
    <h1>{{ __('Cart') }}</h1>
    @livewire('user.cart.cart')
@endsection

@section('script')
    <script src="https://js.stripe.com/v3/"></script>
    <script type="text/javascript">

      var stripe = Stripe('pk_test_51ISOBVI06idiXrXIaSe9j301CgsqQii35xmS00KVu4e7puRuwGFLCJROcmUqPvumZmNW1iHsJoHAGkMQujo9E4qh00hV134cEr');
      var checkoutButton = document.getElementById('checkout-button');

      checkoutButton.addEventListener('click', function() {

        fetch('/payment/payment-charge', {
          method: 'POST',
          headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        })
        .then(function(response) {
          return response.json();
        })
        .then(function(session) {
          return stripe.redirectToCheckout({ sessionId: session.id });
        })
        .then(function(result) {
          if (result.error) {
            alert(result.error.message);
          }
        })
        .catch(function(error) {
          console.error('Error:', error);
        });
      });
    </script>
@endsection
