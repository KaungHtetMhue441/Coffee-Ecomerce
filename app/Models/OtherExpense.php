<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherExpense extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'price',
        'incurred_at',
    ];

    protected $casts = [
        'incurred_at' => 'datetime',
    ];
}
