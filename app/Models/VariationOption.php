<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VariationOption extends Model
{
    use HasFactory;
    protected $table = 'variation_option';
    protected $fillable = [
        'variation_id',
        'product_image_id',
        'name'
    ];

    public function getIncrement()
    {
        return false;
    }
    public function getKeyType()
    {
        return 'string';
    }
    public function variation()
    {
        return $this->belongsTo(Variation::class, 'variation_id', 'id');
    }
    public function belongsToVariation()
    {
        return $this->belongsTo(PickedVariation::class, 'id', 'variation_option_id');
    }
    public function productImage()
    {
        return $this->hasOne(ProductImage::class, 'id', 'product_image_id');
    }
}
