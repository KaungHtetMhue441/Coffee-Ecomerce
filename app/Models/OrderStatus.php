<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    protected $fillable = ['order_id', 'status', 'updated_at'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
