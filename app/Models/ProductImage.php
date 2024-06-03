<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;

    protected $table = 'product_image';
    protected $fillable = [
        'id',
        'product_id',
        'filepath_image'
    ];

    public function getIncrement(){
        return false;
    }
    public function getKeyType(){
        return 'string';
    }

    public function hasProduct()
    {
        return $this->belongsToMany(Product::class, 'product_id', 'id');
    }
    public function variationOption()
    {
        return $this->hasMany(VariationOption::class, 'product_image_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }   
}
