@extends('layouts.app')

@section('content')
<h1>{{ __('Edit book') }}</h1>
<form method="post" enctype="multipart/form-data" action="{{ route('user.books.update',$book) }}">
  @csrf
  @method('PUT')
  <div class="form-group">
    <label for="title">{{ __('Title') }}</label>
    <input type="text" class="form-control" name="title" required maxlength="100" value="{{old('title', $book->title)}}" placeholder="{{ __('Title') }}">
  </div>

  <div class="form-group">
    <label for="description">{{ __('Description') }}</label>
    <textarea class="form-control" name="description" required rows="5" placeholder="{{ __('Description') }}" >{{old('description', $book->description)}}</textarea>
  </div>

  <div class="form-group">
    <label for="genre">{{ __('Genre') }}</label>
    <select multiple class="form-control" name="genres[]" required size="7">
       @foreach($genres as $genre)
            <option
                    value="{{ $genre->id }}"
                    @if(count(old('genres',[])) > 0)
                        {{ (collect(old('genres'))->contains($genre->id)) ? 'selected' : ''}}
                    @else
                        {{( $book->genres->contains($genre->id) ? 'selected' : '') }}
                @endif
        >
        {{ $genre->name }}{{ !empty($genre->description) ? ' - ' . $genre->description : '' }}
            </option>
       @endforeach
    </select>
  </div>

  <div class="row">
    <div class="col">
        <label for="author">{{ __('Author') }}</label>
        @foreach($book->authors as $author)
            @if ($loop->first)
            <div class="input-group control-group after-add-more mb-3">
                <input type="text" name="authors[]" class="form-control" value="{{ $author->name }}" placeholder="{{ __('Author') }}">
                <div class="input-group-btn">
                    <button class="btn btn-success add-more" required type="button"><i class="fas fa-plus"></i></button>
                </div>
            </div>
            @else
            <div class="control-group input-group mb-3">
                <input type="text" name="authors[]" class="form-control" value="{{ $author->name }}" placeholder="{{ __('Author') }}">
                <div class="input-group-btn">
                    <button class="btn btn-danger remove" type="button"><i class="fas fa-minus"></i></button>
                </div>
            </div>
            @endif

        @endforeach
    </div>

    <div class="copy d-none">
        <div class="control-group input-group mb-3">
            <input type="text" name="authors[]" class="form-control" placeholder="{{ __('Author') }}">
            <div class="input-group-btn">
                <button class="btn btn-danger remove" type="button"><i class="fas fa-minus"></i></button>
            </div>
        </div>
    </div>
  </div>

  <div class="row mb-3">
    <div class="col">
      <label for="price">{{ __('Price') }}</label>
      <input type="number" class="form-control" name="price" min="0.00" step="0.01" required value="{{old('price', $book->price)}}" placeholder="{{ __('Price') }}">
    </div>
    <div class="col">
      <label for="discount">{{ __('Discount') }}</label>
      <input type="number" class="form-control" name="discount"  value="{{old('discount', $book->discount)}}" placeholder="{{ __('Discount') }}">
    </div>
  </div>

  @if( !is_null($book->cover) && file_exists(public_path('images/books/'.$book->cover)) )
     <img class="card-img-top w-25 mb-3 cover-img" src="{{ asset('images/books/'.$book->cover) }}" alt="{{ $book->title }}">
     <div class="custom-control custom-switch mb-3">
          <input type="checkbox" class="custom-control-input" id="customSwitch1" name="remove_cover" value="1">
          <label class="custom-control-label" for="customSwitch1">{{ __('Remove cover') }}</label>
         </div>
  @endif
  <div class="custom-file mb-3">
      <input type="file" class="custom-file-input" name="cover">
      <label class="custom-file-label" for="cover">{{ __('Add new cover') }}</label>
  </div>

  <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
</form>

@endsection

@section('script')
    <script>
$(document).ready(function() {
  $(".add-more").click(function(){
      var html = $(".copy").html();
      $(".after-add-more").after(html);
  });
  $("body").on("click",".remove",function(){
      $(this).parents(".control-group").remove();
  });
     $("#customSwitch1").click(function() {
        if($(this).is(":checked")) {
            $(".cover-img").hide(200);
        } else {
            $(".cover-img").show(200);
        }
    });
});

</script>
@endsection
