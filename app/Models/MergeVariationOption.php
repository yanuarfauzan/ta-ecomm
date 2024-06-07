<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MergeVariationOption extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'merge_variation_option';
    protected $fillable = [
        'variation_option_id',
        'merge_stock'
    ];
    public function getIncement()
    {
        return false;
    }
    public function getKeyType()
    {
        return 'string';
    }
    public function variationOption()
    {
        return $this->hasMany(VariationOption::class, 'variation_option1_id', 'id');
    }
}
