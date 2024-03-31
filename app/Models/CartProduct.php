<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartProduct extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'cart_product';
    protected $fillable = [
        'product_id',
        'cart_id',
        'is_locked'
    ];
    public function getIncrement()
    {
        return false;
    }
    public function getKeyType()
    {
        return 'string';
    }
    public function cart()
    {
        return $this->belongsTo(Cart::class, 'cart_id', 'id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
    public function order()
    {
        return $this->belongsTo(Order::class, 'cart_product_id', 'id');
    }
}
