@extends('layouts.app')

@section('content')
    <div class="row">
        @forelse($books as $book)
        <div class="col-lg-2 col-md-4 col-sm-6 mb-3" style="min-width: 20%">
            <div class="card h-100">
              <a href="{{ route('books',$book) }}">
                 <img class="card-img-top" src="{{ $book->cover_full_path }}" alt="{{ $book->title }}">
              </a>
              <div class="card-body position-relative">
                <h4 class="card-title">
                  <a href="{{ route('books',$book) }}">{{ $book->title }}</a>
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
                <div class="position-absolute w-100" style="bottom:0px; left:0px;">
                    @livewire('user.books.add-to-cart', ['bookId' => $book->id])
                </div>
              </div>
              <div class="card-footer">
                <small class="text-muted">
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= $book->book_reviews_avg_rating)
                                &#9733;
                            @else
                                &#9734;
                            @endif
                        @endfor
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
                    <form method="POST" action="{{ route('admin.books.confirmBook',$book) }}">
                      @csrf
                        @method('PUT')
                        <input type="submit" class="btn-dark btn btn-sm" value="{{ $book->is_confirmed == 0 ? __('Confirm') : __('Unconfirm') }}">
                    </form>
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
     <div class="float-right mt-3 mb-3">
         {{ $books->links() }}
     </div>
@endsection
