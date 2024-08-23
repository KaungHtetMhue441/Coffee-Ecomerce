<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "order_id",
        "sale_id",
        "payment_type",
        "total_amount",
        "last4",
        "application_type"
    ];
    // Define the relationship with user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define the relationship with order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Define the relationship with sale
    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }
}
