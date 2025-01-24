<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;
    protected $fillable = ['item_name', 'supplier', 'quantity', 'price', 'purchased_at'];
    protected function casts(): array
    {
        return [
            'purchased_at' => 'datetime',
        ];
    }
    public function scopeWithinDateRange($query, $start, $end)
    {
        return $query->whereBetween('created_at', [$start, $end]);
    }
}
