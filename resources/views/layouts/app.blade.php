<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style></style>

</head>
<body>
    <div id="app">
        @include('layouts.nav')

        <main class="container">

            <div class="row mt-3 mb-3">
                <div class="col-6">
                    <form class="form-inline">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></span>
                          </div>
                          <input type="text" class="form-control" placeholder="{{ __('Search') }}">
                        </div>
                      </form>
                  </div>
                   <div class="col-6">
                        @auth()
                            <a href="{{ route('books.create') }}" class="btn btn-dark float-right">{{ __('Add Book to Listing') }}</a>
                        @endauth
                  </div>
            </div>
            @include('layouts.message')
            @yield('content')
        </main>
    </div>
   <script src="{{ asset('js/app.js') }}"></script>
    @yield('script')
</body>
</html>
