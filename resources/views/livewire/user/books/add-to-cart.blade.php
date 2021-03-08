<div>
    <button
        wire:click="addRemoveToCart({{ $bookId }})"
        class="btn btn-sm @if(!$in_cart) btn-success @else btn-danger @endif w-100">
        @if(!$in_cart) {{ __('Add to cart') }} @else {{ __('Remove from cart') }} @endif
    </button>
</div>
