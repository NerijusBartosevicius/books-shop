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
                    {{ $reviews->links() }}
                </div>
            </div>
        </div>
        @auth
            <div class="row mt-3">
              <div class="col-12">
                @if ($success)
                    <div class="alert alert-success" role="alert">
                      {{ __('Review created successfully!!') }}
                    </div>
                @endif
               <form wire:submit.prevent="store_review">
                @csrf
                   <div class="rating">
                  <input type="radio" id="star5" name="rating" value="5" wire:model.defer="rating" checked /><label for="star5" title="Meh">5 stars</label>
                  <input type="radio" id="star4" name="rating" value="4" wire:model.defer="rating" /><label for="star4" title="Not bad">4 stars</label>
                  <input type="radio" id="star3" name="rating" value="3" wire:model.defer="rating" /><label for="star3" title="Kinda bad">3 stars</label>
                  <input type="radio" id="star2" name="rating" value="2" wire:model.defer="rating" /><label for="star2" title="Very bad">2 stars</label>
                  <input type="radio" id="star1" name="rating" value="1" wire:model.defer="rating" /><label for="star1" title="Sucks big time">1 star</label>
                </div>
                <div class="form-group">
                    <textarea class="form-control {{ $errors->has('message') ? 'is-invalid' : ''}}" name="message" rows="5" wire:model.defer="message"></textarea>
                    @if($errors->has('message'))
                        <div class="invalid-feedback">{{ $errors->first('message') }}</div>
                    @endif
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
