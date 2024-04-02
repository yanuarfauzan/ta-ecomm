<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'product';
    protected $fillable = [
        'name',
        'SKU',
        'stock',
        'product_image',
        'price',
        'desc',
        'discount',
        'weight',
        'dimensions'
    ];

    public function getIncrement()
    {
        return false;
    }

    public function getKeyType()
    {
        return 'string';
    }

    public function category()
    {
        return $this->belongsToMany(Category::class, 'product_category_variation', 'category_id', 'id');
    }

    public function variation()
    {
        return $this->belongsToMany(Variation::class, 'product_category_variation', 'variation_id', 'id');
    }

    public function user()
    {
        return $this->belongsToMany(User::class, 'cart', 'user_id', 'id');
    }

    public function cart()
    {
        return $this->belongsToMany(Cart::class, 'cart_product', 'cart_id', 'id');
    }


}
