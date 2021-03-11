@extends('layouts.app')

@section('content')

    <div class="jumbotron">
      <h1 class="display-4">Thanks, we received your payment!</h1>
      <p class="lead">You will receive the cover of the book by e-mail.</p>
      <hr class="my-4">
      <p>While you wait for the cover, please search for books you like.</p>
      <p class="lead">
        <a class="btn btn-dark btn-lg" href="{{ route('home') }}" role="button">Go to the list</a>
      </p>
    </div>

@endsection
