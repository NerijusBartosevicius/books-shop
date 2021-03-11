<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'name',
        'stripe_id',
        'total'
    ];

    protected $perPage = 20;

    public function getTotalAmountAttribute()
    {
        return ($this->total > 0) ? $this->total / 100 : 0;
    }
}
