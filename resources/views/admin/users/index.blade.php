@extends('layouts.app')

@section('content')
  <div class="table-responsive-sm">

  <table class="table">
    <thead>
    <tr>
      <th scope="col">{{ __('Name') }}</th>
      <th scope="col">{{ __('E-Mail') }}</th>
      <th scope="col">{{ __('Birthday') }}</th>
      <th scope="col">{{ __('Actions') }}</th>
    </tr>
  </thead>
  <tbody>
    @forelse($users as $user)
        <tr>
          <td>{{ $user->name }}</td>
          <td>{{ $user->email }}</td>
          <td>{{ $user->birthday }}</td>
          <th class="d-flex">
              <a href="{{ route('admin.users.edit',$user) }}" class="btn btn-dark btn-sm">{{ __('Edit') }}</a>
              <form method="POST" action="{{ route('admin.users.destroy',$user) }}">
                @csrf
                  @method('DELETE')
                  <input type="submit" class="btn-dark btn btn-sm" value="{{__('Delete')}}">
              </form>
          </th>
        </tr>
    @empty
        <div class="mb-2">{{ __('You are the only user!') }}</div>
    @endforelse
  </tbody>
  </table>
      {{ $users->links() }}
</div>
@endsection
