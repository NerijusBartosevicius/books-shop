<div class="col-3 pt-2">
    @if ($avgRating > 0)
        <div class="text-right"><i class="fas fa-star"></i>
            {{ round($avgRating,1) }}
        </div>
    @endif
</div>
