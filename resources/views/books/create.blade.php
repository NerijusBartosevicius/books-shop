@extends('layouts.app')

@section('content')
<h1>{{ __('Add new book') }}</h1>
<form method="post" enctype="multipart/form-data" action="{{ route('books.store') }}">
  @csrf
  <div class="form-group">
    <label for="exampleFormControlSelect2">{{ __('Title') }}</label>
    <input type="text" class="form-control" name="title" required maxlength="100" placeholder="{{ __('Title') }}">
  </div>
  <div class="form-group">
    <label for="exampleFormControlSelect2">{{ __('Description') }}</label>
    <textarea class="form-control" name="description" required rows="5" placeholder="{{ __('Description') }}"></textarea>
  </div>
  <div class="form-group">
    <label for="exampleFormControlSelect2">{{ __('Genre') }} <i class="fas fa-info-circle"></i></label>
    <select multiple class="form-control" name="genre[]" required size="7">
       @foreach($genres as $genre)
        <option value="{{ $genre->id }}">{{ $genre->name }}{{ !empty($genre->description) ? ' - ' . $genre->description : '' }}</option>
       @endforeach
    </select>
  </div>
  <div class="row">
    <div class="col">
        <label for="exampleFormControlSelect2">{{ __('Author') }}</label>
        <div class="input-group control-group after-add-more mb-3">
            <input type="text" name="author[]" required class="form-control" placeholder="{{ __('Author') }}">
            <div class="input-group-btn">
                <button class="btn btn-success add-more" type="button"><i class="fas fa-plus"></i></button>
            </div>
        </div>
    </div>

    <div class="copy d-none">
        <div class="control-group input-group mb-3">
            <input type="text" name="author[]" class="form-control" placeholder="{{ __('Author') }}">
            <div class="input-group-btn">
                <button class="btn btn-danger remove" type="button"><i class="fas fa-minus"></i></button>
            </div>
        </div>
    </div>
</div>


  <div class="row mb-3">
    <div class="col">
      <label for="exampleFormControlSelect2">{{ __('Price') }}</label>
      <input type="number" class="form-control" name="price" min="0.00" step="0.01" placeholder="{{ __('Price') }}">
    </div>
    <div class="col">
      <label for="exampleFormControlSelect2">{{ __('Discount') }}</label>
      <input type="number" class="form-control" name="discount" max="100" min="0" value="0" placeholder="{{ __('Discount') }}">
    </div>
  </div>
  <div class="custom-control custom-switch mb-3">
      <input type="checkbox" class="custom-control-input" name="is_confirmed">
      <label class="custom-control-label" for="customSwitch1">{{ __('Is confirmed') }}</label>
  </div>
  <div class="custom-file mb-3">
      <input type="file" class="custom-file-input" name="cover">
      <label class="custom-file-label" for="customFile">{{ __('Add cover') }}</label>
  </div>


  <button type="submit" class="btn btn-primary">{{ __('Add') }}</button>
</form>

@endsection

@section('script')

@endsection
