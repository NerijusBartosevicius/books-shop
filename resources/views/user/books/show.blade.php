@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-4">
       <img class="card-img-top" src="{{ $book->CoverFullPath }}" alt="{{ $book->title }}">
    </div>
    <div class="col-8">
        <div class="mb-3 d-flex">
          @can('update', $book)
              <a class="btn btn-sm btn-dark" href="{{ route('user.books.edit',$book) }}">{{__('Edit')}}</a>
          @endcan
          @can('delete', $book)
              <form method="POST" action="{{ route('user.books.destroy',$book) }}">
                @csrf
                @method('DELETE')
                <input type="submit" class="btn-dark btn btn-sm" value="{{__('Delete')}}">
              </form>
          @endcan
          @isAdmin
              <form method="POST" action="{{ route('admin.books.confirmBook',$book) }}">
               @csrf
               @method('PUT')
                  <input type="submit" class="btn-dark btn btn-sm" value="{{ $book->is_confirmed == 0 ? __('Confirm') : __('Unconfirm') }}">
              </form>
          @endisAdmin
          @auth
             <a class="btn btn-sm btn-dark {{ empty(env('MAIL_HOST')) ? 'disabled' : '' }}" href="{{ route('user.books.reportBook',$book) }}">{{__('Report')}}</a>
          @endauth
        </div>

        <div class="row">
            <div class="col-9">
                <h1>{{ $book->title }}</h1>
            </div>

            @livewire('user.books.book-reviews-average',[
                'bookId' => $book->id,
                'avgRating' => $book->book_reviews_avg_rating,
            ])

        </div>

        <hr>
        <div>
            <b>{{ __('Author:') }}</b>
            @foreach($book->authors as $author)
                <span>{{$author->name}}</span>
            @endforeach
        </div>
        <div>
            <b>{{ __('Genre:') }}</b>
            @foreach($book->genres as $genres)
                <span>{{$genres->name}}</span>
            @endforeach
        </div>
        <div class="mt-5">
            <b>{{ __('Description:') }}</b>
            {{ $book->description }}
        </div>
        <div class="mt-2">
            <b>{{ __('Price:') }}</b>
            @if($book->discount > 0)
                <span class="text-danger">
                    <del>{{ $book->price }} <i class="fas fa-euro-sign"></i></del>
                </span>
                <span class="ml-2">
                    {{ $book->price_after_discount }} <i class="fas fa-euro-sign"></i>
                </span>
                <span class="badge bg-success text-light">{{ __('Discount: -').$book->discount }}</span>
            @else
                {{ $book->price }} <i class="fas fa-euro-sign"></i>
            @endif
        </div>
    </div>
</div>

@livewire('user.books.book-reviews', ['book' => $book])

@endsection

