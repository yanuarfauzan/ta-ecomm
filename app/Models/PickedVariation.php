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
        'variation_option_id'
    ];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function variationOption()
    {
        return $this->belongsTo(VariationOption::class);
    }
    public function variation()
    {
        return $this->belongsTo(Variation::class);
    }


}
