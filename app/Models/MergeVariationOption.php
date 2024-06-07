<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MergeVariationOption extends Model
{
    use HasFactory, HasUuids;
    public $incrementing = false;
    protected $table = 'merge_variation_option';
    protected $fillable = [
        'product_id',
        'variation_option_1_id',
        'variation_option_2_id',
        'merge_stock',
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
        return $this->hasMany(VariationOption::class, 'variation_option_1_id', 'id');
    }
    public function variationOptions()
    {
        return $this->belongsToMany(VariationOption::class, 'merge_variation_option_variation_option', 'merge_variation_option_id', 'variation_option_id');
    }
    public function getVariationOptionsAttribute()
    {
        if ($this->variation_option_ids && is_string($this->variation_option_ids)) {
            return VariationOption::whereIn('id', unserialize($this->variation_option_ids))->get();
        } else {
            return collect();
        }
    }

    public function variationOption1()
    {
        return $this->belongsTo(VariationOption::class, 'variation_option_1_id');
    }

    public function variationOption2()
    {
        return $this->belongsTo(VariationOption::class, 'variation_option_2_id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
