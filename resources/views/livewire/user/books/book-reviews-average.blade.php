<div class="col-3 pt-2">
    @if ($book->bookReviews->count() > 0)
        <div class="text-right"><i class="fas fa-star"></i>
            {{ round($book->book_reviews_avg_rating,1) }}
        </div>
    @endif
</div>
