@extends('layouts.app')

@section('content')
    <h1>{{ __('Cart') }}</h1>
    @livewire('user.cart.cart')
@endsection
