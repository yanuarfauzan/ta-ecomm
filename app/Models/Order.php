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
        'product_id',
        'address_id',
        'order_id',
        'cart_id',
        'shipping_id',
        'order_number',
        'order_date',
        'total_price',
        'order_status',
        'note',
        'qty',
        'snap_token'
    ];

    public function getIncement()
    {
        return false;
    }

    public function getKeyType()
    {
        return 'string';
    }
    public function cartProduct()
    {
        return $this->hasMany(CartProduct::class, 'order_id', 'id');
    }
    public function cartProducts()
    {
        return $this->hasMany(CartProduct::class, 'order_id', 'id');
    }
    public function shipping()
    {
        return $this->hasOne(Shipping::class, 'id', 'shipping_id');
    }
    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function productAssessment()
    {
        return $this->hasMany(ProductAssessment::class, 'order_id', 'id');
    }
    public function products()
    {
        return $this->belongsTo(Product::class);
    }
    public function shippingMethod()
    {
        return $this->belongsTo(Shipping::class, 'shipping_id', 'id');
    }
    public function shipped()
    {
        return $this->hasOne(Shipping::class, 'order_id');
    }
    // public function address()
    // {
    //     return $this->belongsTo(Address::class);
    // }
    public function pickedVariation()
    {
        return $this->belongsToMany(Variation::class, 'picked_variation');
    }
    public function pickedVariationOption()
    {
        return $this->belongsToMany(VariationOption::class, 'picked_variation');
    }
    public function address()
    {
        return $this->hasOne(Address::class, 'id', 'address_id');
    }
}
