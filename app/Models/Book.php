<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'price', 'discount', 'description', 'is_confirmed', 'user_id', 'cover'];

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

}
