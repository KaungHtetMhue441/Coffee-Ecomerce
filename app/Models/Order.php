<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        "user_id",
        "admin_id",
        "total_amount",
        "status",
        "payment_type",
        "order_date",
        "image"
    ];
    // protected 
    protected function casts(): array
    {
        return [
            'order_date' => 'datetime',
        ];
    }
    // Define the relationship with user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
    // Define the relationship with transactions
    public function transaction()
    {
        return $this->hasOne(Transaction::class);
    }
    public function comment()
    {
        return $this->hasOne(Comment::class);
    }
    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot(["quantity", "price", "status"]);
    }
}
