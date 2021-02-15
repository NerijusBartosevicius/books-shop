@extends('layouts.app')

@section('content')
    <div class="row">
        @foreach($books as $book)
        <div class="col-lg-2 col-md-4 col-sm-6 mb-3" style="min-width: 20%">
            <div class="card h-100">
              <a href="{{ route('books',['id' => $book->id]) }}">
                  @if( !is_null($book->cover) && file_exists(public_path('images/books/'.$book->cover)) )
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
                <h4>
                    @if($book->discount > 0)
                        <div class="text-danger"><del>{{ $book->price }} <i class="fas fa-euro-sign"></i> </del></div>
                        {{ number_format($book->price - ($book->discount * ($book->price/100)),2) }} <i class="fas fa-euro-sign"></i>
                    @else
                        {{ $book->price }} <i class="fas fa-euro-sign"></i>
                    @endif
                </h4>
                <p class="card-text">{{ \Str::of($book->description)->limit(20) }}</p>
              </div>
              <div class="card-footer">
                <small class="text-muted">
                    @if ($book->bookReviews->count() > 0)
                        @for ($i = 1; $i < 6; $i++)
                            @if ($i <= round($book->bookReviews->sum('rating') / $book->bookReviews->count()))
                                &#9733;
                            @else
                                &#9734;
                            @endif
                        @endfor
                    @else
                        &#9734;&#9734;&#9734;&#9734;&#9734;
                    @endif
                </small>
                @if($book->created_at >= date('Y-m-d', strtotime("-1 weeks")))
                    <div class="badge bg-success text-light ml-1">New</div>
                @endif
                @if($book->discount > 0)
                    <div class="badge bg-danger  text-light ml-1">-{{$book->discount}}%</div>
                @endif
              </div>
            </div>
        </div>
        @endforeach
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
