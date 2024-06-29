<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PickedVariation extends Model
{
    use HasFactory, HasUuids;

    public function getIncrement()
    {
        return false;
    }
    public function getKeyType()
    {
        return 'string';
    }
    protected $table = 'picked_variation';
    protected $fillable = [
        'variation_id',
        'product_id',
        'cart_id',
        'variation_option_id',
        'order_id'
    ];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function variationOption()
    {
        return $this->hasOne(VariationOption::class, 'id', 'variation_option_id');
    }
    public function variation()
    {
        return $this->belongsTo(Variation::class);
    }
    public function cart()
    {
        return $this->belongsTo(Cart::class, 'cart_id', 'id');
    }

}
