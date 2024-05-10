<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'cart';
    protected $fillable = [
        'user_id',
        'product_id',
        'qty',
        'total_price',
        'total_price_after_discount',
        'total_discount'
    ];
    public function getIncrement()
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

    public function hasProduct()
    {
        return $this->belongsToMany(Product::class, 'cart_product')->withPivot('id', 'is_locked');
    }
    public function pickedVariation()
    {
        return $this->hasMany(PickedVariation::class, 'cart_id', 'id');
    }
}
