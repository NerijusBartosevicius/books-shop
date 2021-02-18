<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'price', 'discount', 'description', 'is_confirmed', 'user_id', 'cover'];

    protected $perPage = 25;

    protected $casts = [
        'is_confirmed' => 'boolean',
    ];

    public function authors()
    {
        return $this->belongsToMany(Author::class);
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bookReviews()
    {
        return $this->hasMany(BookReview::class)->latest();
    }

    public function scopeByRole($query)
    {
        return auth()->check() && auth()->user()->is_admin ? $query : $query->where('is_confirmed', 1);
    }

    public function getIsNewAttribute()
    {
        return $this->created_at > now()->subWeek();
    }

    public function getPriceAfterDiscountAttribute()
    {
        return number_format($this->price - ($this->discount * ($this->price / 100)), 2);
    }

    public function getCoverExistAttribute()
    {
        return !is_null($this->cover) && file_exists(public_path('images/books/' . $this->cover));
    }

    public function getReviewsAverageAttribute()
    {
        return round( $this->bookReviews()->average('rating') );
    }

}
