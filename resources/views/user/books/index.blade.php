@extends('layouts.app')

@section('content')
    <div class="row">
        @forelse($books as $book)
        <div class="col-lg-2 col-md-4 col-sm-6 mb-3" style="min-width: 20%">
            <div class="card h-100">
              <a href="{{ route('books',['id' => $book->id]) }}">
                  @if( $book->cover_exist )
                    <img class="card-img-top" src="{{ asset('images/books/'.$book->cover) }}" alt="{{ $book->title }}">
                  @else
                    <img class="card-img-top" src="{{ asset('images/books/no-cover.png') }}" alt="{{ $book->title }}">
                  @endif
              </a>
              <div class="card-body">
                <h4 class="card-title">
                  <a href="{{ route('books',['id' => $book->id]) }}">{{ $book->title }}</a>
                </h4>
                @foreach($book->authors as $author)
                    <div>{{$author->name}}</div>
                @endforeach
                <h4 class="mt-2">
                    @if($book->discount > 0)
                        <div class="text-danger"><del>{{ $book->price }} <i class="fas fa-euro-sign"></i> </del></div>
                        {{ $book->price_after_discount }} <i class="fas fa-euro-sign"></i>
                    @else
                        {{ $book->price }} <i class="fas fa-euro-sign"></i>
                    @endif
                </h4>
                <p class="card-text">{{ \Str::of($book->description)->limit(50) }}</p>
              </div>
              <div class="card-footer">
                <small class="text-muted">
                    @if ($book->bookReviews->count() > 0)
                        @for ($i = 1; $i < 6; $i++)
                            @if ($i <= $book->reviews_average)
                                &#9733;
                            @else
                                &#9734;
                            @endif
                        @endfor
                    @else
                        &#9734;&#9734;&#9734;&#9734;&#9734;
                    @endif
                </small>
                @if( $book->is_new )
                    <div class="badge bg-success text-light ml-1">New</div>
                @endif
                @if($book->discount > 0)
                    <div class="badge bg-danger  text-light ml-1">-{{$book->discount}}%</div>
                @endif
                @isAdmin
                    <hr>
                    <div class="d-flex">
                    <a class="btn btn-sm btn-dark mr-1" href="{{ route('admin.books.confirmBook',$book) }}">{{ $book->is_confirmed == 0 ? __('Confirm') : __('Unconfirm') }}</a>
                    <form method="POST" action="{{ route('user.books.destroy',$book) }}">
                      @csrf
                      @method('DELETE')
                      <input type="submit" class="btn-danger btn btn-sm" value="{{__('Delete')}}">
                    </form>
                    </div>
                @endisAdmin
              </div>
            </div>
        </div>
        @empty
            <div>{{ __('No books') }}</div>
        @endforelse
     </div>
     <div class="float-right">
         @if ($books->previousPageUrl())
             <a class="btn btn-light" href="{{ $books->previousPageUrl() }}"><i class="fas fa-chevron-left"></i></a>
         @endif
         @if ($books->nextPageUrl())
             <a class="btn btn-light" href="{{ $books->nextPageUrl() }}"><i class="fas fa-chevron-right"></i></a>
         @endif
     </div>
@endsection
