<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'price', 'discount', 'description', 'is_confirmed', 'user_id','cover'];

    public function setUserIdAttribute($value)
    {
        $this->attributes['user_id'] = strtolower($value);
    }

    public function authors()
    {
        return $this->belongsToMany(Author::class);
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }
}
