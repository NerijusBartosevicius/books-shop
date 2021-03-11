@extends('layouts.app')

@section('content')

<div class="table-responsive-sm">

  <table class="table">
    <thead>
    <tr>
      <th scope="col">{{ __('Name') }}</th>
      <th scope="col">{{ __('E-Mail') }}</th>
      <th scope="col">{{ __('Stripe id') }}</th>
      <th scope="col">{{ __('Amount') }}</th>
    </tr>
  </thead>
  <tbody>
    @forelse($payments as $payment)
        <tr>
          <td>{{ $payment->name }}</td>
          <td>{{ $payment->email }}</td>
          <td>{{ $payment->stripe_id }}</td>
          <td>{{ $payment->total_amount }} <i class="fas fa-euro-sign"></i></td>
        </tr>
    @empty
        <div class="mb-2">{{ __('You are the only user!') }}</div>
    @endforelse
  </tbody>
  </table>
  {{ $payments->links() }}
</div>

@endsection
