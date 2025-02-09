<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;
    protected $fillable = [
        "admin_id",
        "customer",
        "total_cost",
        "payment_type",
        "table_name",
        "status"
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot("quantity", "price");
    }
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
    public function transactions()
    {
        return $this->hasOne(Transaction::class);
    }
}
