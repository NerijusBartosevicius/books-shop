@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-3">
    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
      <a class="nav-link active" id="v-pills-account-tab" data-toggle="pill" href="#v-pills-account" role="tab" aria-controls="v-pills-account" aria-selected="true">{{ __('Account') }}</a>
      <a class="nav-link" id="v-pills-password-tab" data-toggle="pill" href="#v-pills-password" role="tab" aria-controls="v-pills-password" aria-selected="false">{{ __('Password') }}</a>
    </div>
  </div>
  <div class="col-9">
    <div class="tab-content" id="v-pills-tabContent">
      <div class="tab-pane fade show active" id="v-pills-account" role="tabpanel" aria-labelledby="v-pills-account-tab">
        <form method="POST" action="{{ route('user.updateUserData') }}">
                @csrf
            <div class="row">
                    <div class="col-md-6">
                        <label for="password">{{ __('Name') }}</label>
                        <input id="name" type="text" class="form-control" name="name" value="{{ old('name',auth()->user()->name) }}" required autocomplete="name" autofocus>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label for="password">{{ __('E-Mail Address') }}</label>
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email',auth()->user()->email) }}" required autocomplete="email">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label for="password">{{ __('Birthday') }}</label>
                        <input id="birthday" type="text" class="datepicker form-control" name="birthday" value="{{ old('birthday',auth()->user()->birthday) }}" required  autocomplete="Birthday">

                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-dark">{{ __('Update data') }}</button>
                    </div>
                </div>

            </form>
      </div>
      <div class="tab-pane fade" id="v-pills-password" role="tabpanel" aria-labelledby="v-pills-password-tab">
            <form method="POST" action="{{ route('user.updateUserPassword') }}">
                @csrf

                <div class="row">
                    <div class="col-md-6">
                        <label for="password">{{ __('Current Password') }}</label>
                        <input id="password" type="password" class="form-control" name="current_password" autocomplete="current-password">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label for="password">{{ __('New Password') }}</label>
                        <input id="new_password" type="password" class="form-control" name="new_password" autocomplete="current-password">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label for="password">{{ __('New Confirm Password') }}</label>
                        <input id="new_confirm_password" type="password" class="form-control" name="new_confirm_password" autocomplete="current-password">
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-dark">{{ __('Update Password') }}</button>
                    </div>
                </div>

            </form>
      </div>
    </div>
  </div>
</div>
@endsection

@section('style')
<style>
.nav-pills .nav-link.active{
    background-color: #23272b;
    color:#fff;
}
.nav-pills .nav-link:not(.active) {
    color:#23272b;
}
</style>
@endsection
