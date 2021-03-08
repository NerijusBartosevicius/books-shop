<div>
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
          <thead>
            <tr>
              <th class="text-center">{{ __('Cover') }}</th>
              <th>{{ __('Title') }}</th>
              <th>{{ __('Price') }}</th>
              <th>{{ __('Discount') }}</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
        @forelse($books as $book)
            <tr>
              <th class="text-center">
                  <a href="{{ route('books',$book) }}">
                    <img class="card-img-top" style="max-width: 50px;" src="{{ $book->CoverFullPath }}" alt="{{ $book->title }}">
                  </a>
              </th>
              <td  class="align-middle">{{ $book->title }}</td>
              <td  class="align-middle">
                  {{ $book->price }} <i class="fas fa-euro-sign"></i>
                  @if($book->discount > 0)
                      <span class="badge badge-success">{{ $book->discount }}%</span>
                  @endif
              </td>
              <td  class="align-middle">{{ $book->discount_sum }} <i class="fas fa-euro-sign"></i></td>
              <td  class="align-middle text-center">
                  <button type="button"
                          class="btn btn-danger btn-sm"
                          data-toggle="tooltip"
                          data-placement="top"
                          wire:click="remove({{ $book->id }})">x</button>
              </td>
            </tr>
        @empty
            <tr>
               <td colspan="5">
                   <div class="alert alert-primary" role="alert">{{ __('Cart is empty') }}</div>
               </td>
            </tr>
        @endforelse
          </tbody>
        </table>
    </div>

    @if($books->count() > 0)
        <div class="row">
            <div class="col-6"></div>
            <div class="col-md-6 col-sm-12">
                <table class="table table-bordered">
                    <tr>
                        <td>{{ __('Sum:') }} </td>
                        <td>{{ $books->sum('price') }} <i class="fas fa-euro-sign"></i></td>
                    </tr>
                     <tr>
                        <td>{{ __('Discount:') }} </td>
                        <td>{{ $books->sum('discount_sum') }} <i class="fas fa-euro-sign"></i></td>
                    </tr>
                     <tr>
                        <td>{{ __('Total sum:') }} </td>
                        <td>{{ $books->sum('price_after_discount') }} <i class="fas fa-euro-sign"></i></td>
                    </tr>
                </table>

            </div>
        </div>
    @endif
</div>
