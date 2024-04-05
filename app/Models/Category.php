<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'category';
    protected $fillable = [
        'name',
        'icon'
    ];

    public function getIncrement()
    {
        return false;
    }

    public function getKeyType()
    {
        return 'string';
    }
    public function product()
    {
        return $this->belongsToMany(Product::class, 'product_category_variation', 'product_id', 'id')->withPivot('variation_id');
    }
}
