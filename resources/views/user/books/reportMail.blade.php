<body>
<div>Book: <a target="_blank" href="{{ route('books',$book) }}">{{$book->title}}</a></div>
    <div>Description: {{$book->description}}</div>
    <div>Price: {{$book->price}}</div>
    <div>Discount: {{$book->discount}}</div>
</body>
