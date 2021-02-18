@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-4">

        @if( $book->cover_exist )
            <img class="card-img-top" src="{{ asset('images/books/'.$book->cover) }}" alt="{{ $book->title }}">
        @else
            <img class="card-img-top" src="{{ asset('images/books/no-cover.png') }}" alt="{{ $book->title }}">
        @endif
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
            <a class="btn btn-sm btn-dark" href="{{ route('admin.books.confirmBook',$book) }}">{{ $book->is_confirmed == 0 ? __('Confirm') : __('Unconfirm') }}</a>
          @endisAdmin
          @auth
             <a class="btn btn-sm btn-dark {{ empty(env('MAIL_HOST')) ? 'disabled' : '' }}" href="{{ route('user.books.reportBook',$book) }}">{{__('Report')}}</a>
          @endauth
        </div>

        <div class="row">
            <div class="col-9">
                <h1>{{ $book->title }}</h1>
            </div>
            <div class="col-3 pt-2">
                @if ($book->bookReviews->count() > 0)
                    <div class="text-right"><i class="fas fa-star"></i> {{ $book->reviews_average }} </div>
                @endif
            </div>
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
            {{ $book->description }}
        </div>
    </div>
</div>

<div class="row mt-3">

    <div class="col-12">
        <div class="row mt-3">
              <div class="col-12">
                <h3>{{ __('Reviews:') }}</h3>
                <hr>
             </div>
        </div>
        @forelse($reviews as $review)

        <div class="row mt-1 border p-3 rounded">
             <div class="col-12 col-md-2">
                <div>{{$review->user->name}}</div>
                <div>{{$review->created_at}}</div>
             </div>
             <div class="col-12 col-md-10">
                  <div>
                      <i class="fas fa-star"></i> {{$review->rating}}
                      @if( auth()->check() && $review->user_id == auth()->user()->id )
                         <span class="badge bg-info text-light">{{ __('My review') }}</span>
                      @endif
                  </div>
                  <div>{!! nl2br($review->message) !!}</div>
             </div>

        </div>
        @empty
            @auth
                <div>{{ __('Be the first to rate the book!') }}</div>
            @endauth
            @guest
                <div>{{ __('Login and be the first to rate the book!') }}</div>
            @endguest
        @endforelse
        <div class="row mt-3">
            <div class="col-12">
                <div class="float-right">
                     @if ($reviews->previousPageUrl())
                        <a class="btn btn-primary" href="{{ $reviews->previousPageUrl() }}"><i class="fas fa-chevron-left"></i></a>
                    @endif
                    @if ($reviews->nextPageUrl())
                        <a class="btn btn-primary" href="{{ $reviews->nextPageUrl() }}"><i class="fas fa-chevron-right"></i></a>
                    @endif
                </div>
            </div>
        </div>
        @auth
            <div class="row mt-3">
              <div class="col-12">
               <form method="post" action="{{ route('user.review') }}">
                @csrf
                   <div class="rating">
                  <input type="radio" id="star5" name="rating" checked value="{{old('rating',5)}}" /><label for="star5" title="Meh">5 stars</label>
                  <input type="radio" id="star4" name="rating" value="{{old('rating',4)}}" /><label for="star4" title="Not bad">4 stars</label>
                  <input type="radio" id="star3" name="rating" value="{{old('rating',3)}}" /><label for="star3" title="Kinda bad">3 stars</label>
                  <input type="radio" id="star2" name="rating" value="{{old('rating',2)}}" /><label for="star2" title="Very bad">2 stars</label>
                  <input type="radio" id="star1" name="rating" value="{{old('rating',1)}}" /><label for="star1" title="Sucks big time">1 star</label>
                </div>
                <div class="form-group">
                    <textarea class="form-control" name="message" required rows="5">{{old('message')}}</textarea>
                    <input type="hidden" name="book_id" value="{{ $book->id }}">
                </div>
                <button type="submit" class="btn btn-primary">{{ __('Rate') }}</button>
                </form>
             </div>
        </div>
        @endAuth
        @guest
            <div class="alert alert-info mt-3" role="alert">{{ __('Only registered users can leave review') }}</div>
        @endguest
    </div>

</div>

@endsection

