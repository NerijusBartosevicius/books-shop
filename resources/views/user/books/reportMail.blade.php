<body>
<div>Book: <a target="_blank" href="{{ route('books',['id' => $book->id]) }}">{{$book->title}}</a></div>
    <div>Book: {{$book->description}}</div>
    <div>Book: {{$book->price}}</div>
    <div>Book: {{$book->discount}}</div>
</body>
