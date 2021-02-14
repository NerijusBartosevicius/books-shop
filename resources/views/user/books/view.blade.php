@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-4">

        @if( !is_null($book->cover) && file_exists(public_path('images/books/'.$book->cover)) )
            <img class="card-img-top" src="{{ asset('images/books/'.$book->cover) }}" alt="{{ $book->title }}">
        @else
            <img class="card-img-top" src="{{ asset('images/books/no-cover.png') }}" alt="{{ $book->title }}">
        @endif
    </div>
    <div class="col-8">
        <div class="mb-3 d-flex">
          @can('update', $book)
              <a class="btn btn-sm btn-dark" href="{{ route('user.books.edit',$book) }}">Edit</a>
          @endcan
          @can('delete', $book)
              <form method="POST" action="{{ route('user.books.destroy',$book) }}">
                @csrf
                @method('DELETE')
                <input type="submit" class="btn-dark btn btn-sm" value="{{__('Delete')}}">
              </form>
          @endcan
          @isAdmin
            <a class="btn btn-sm btn-dark" href="{{ route('confirmBook',$book->id) }}">{{ $book->is_confirmed == 0 ? __('Confirm') : __('Unconfirm') }}</a>
          @endisAdmin

        </div>
        <h1>{{ $book->title }}</h1>
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
    <div class="col-3">

    </div>
    <div class="col-9">
        <h3>{{ __('Reviews:') }}</h3>
        <hr>
        <form>
        @csrf
        <fieldset class="rating">
            <input type="radio" id="star5" name="rating" value="5" /><label for="star5" title="Rocks!">5 stars</label>
            <input type="radio" id="star4" name="rating" value="4" /><label for="star4" title="Pretty good">4 stars</label>
            <input type="radio" id="star3" name="rating" value="3" /><label for="star3" title="Meh">3 stars</label>
            <input type="radio" id="star2" name="rating" value="2" /><label for="star2" title="Kinda bad">2 stars</label>
            <input type="radio" id="star1" name="rating" value="1" /><label for="star1" title="Sucks big time">1 star</label>
        </fieldset>
        <div class="form-group">
            <textarea class="form-control" name="description" rows="5"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">{{ __('Rate') }}</button>
        </form>
    </div>
</div>

@endsection

