<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variation extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'variation';
    protected $fillable = [
        'name',
    ];
    public function getIncrement()
    {
        return false;
    }
    public function getKeyType()
    {
        return 'string';
    }
    public function variationOption()
    {
        return $this->hasMany(VariationOption::class, 'variation_id', 'id');
    }
    public function productCategoryVariation()
    {
        return $this->hasMany(ProductCategoryVariation::class, 'variation_id', 'id');
    }
    public function belongsToProduct()
    {
        return $this->belongsToMany(Product::class, 'picked_variation'); 
    }
    public function variationOptions()
    {
        return $this->hasMany(VariationOption::class);
    }
    public function order()
    {
        return $this->belongsToMany(Order::class, 'picked_variation');
    }
}

