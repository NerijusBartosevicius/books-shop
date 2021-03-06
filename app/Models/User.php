<?php

namespace App\Models;

use Carbon\Traits\Timestamp;
use DateTimeInterface;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, Timestamp;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'birthday',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'birthday' => 'date',
    ];

    public function getBirthdayAttribute($value)
    {
        return date('Y-m-d', strtotime($value));
    }

    public function isAdmin()
    {
        return $this->is_admin;
    }

    public function books()
    {
        return $this->hasMany(Book::class);
    }

    public function bookreviews()
    {
        return $this->hasMany(BookReview::class);
    }
}
