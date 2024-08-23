<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'en_name',
        'code',
        'image',
        'price',
        'description',
        'category_id'
    ];

    public function GetshortDescAttribute()
    {
        return Str::words($this->description, 5, '...');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function getImageUrlAttribute()
    {
        return '/storage/products/' . $this->image;
    }

    public function sales()
    {
        return $this->belongsToMany(Sale::class);
    }
}
