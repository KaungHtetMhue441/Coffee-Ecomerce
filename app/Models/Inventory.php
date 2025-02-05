<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_name',
        'quantity',
        'description',
    ];

    protected $casts = [
        'date_added' => 'datetime',
        'date_retrieved' => 'datetime',
    ];
}
