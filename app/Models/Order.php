<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'order';
    protected $fillable = [
        'user_id',
        'cart_id',
        'shipping_id',
        'order_number',
        'order_date',
        'total_price',
        'order_status',
    ];

    public function getIncement()
    {
        return false;
    }

    public function getKeyType()
    {
        return 'string';
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function cartProduct()
    {
        return $this->belongsTo(CartProduct::class, 'cart_product_id', 'id');
    }
    public function shipping()
    {
        return $this->hasOne(Shipping::class, 'id', 'shipping_id');
    }
}