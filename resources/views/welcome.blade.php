@extends('layouts.app')

@section('content')
    <form>
      <script
        src="https://checkout.stripe.com/checkout.js"
        data-key="pk_test_51ISOBVI06idiXrXIaSe9j301CgsqQii35xmS00KVu4e7puRuwGFLCJROcmUqPvumZmNW1iHsJoHAGkMQujo9E4qh00hV134cEr"
        data-amount="10000"
        data-name="Nerijus Bartoševičius"
        data-descripption="Example charge"
        data-image="Example charge"
        data-locale="auto"
        data-currency="eur"
      >
      </script>
    </form>




@endsection

@section('script')
    <script src="https://js.stripe.com/v3/" defer></script>
    <script>
    const stripe = Stripe('stripe-public-key');

    const elements = stripe.elements();
    const cardElement = elements.create('card');

    cardElement.mount('#card-element');
    </script>
@endsection
