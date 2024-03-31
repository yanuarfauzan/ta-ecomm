<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategoryVariation extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'product_category_variation';
    protected $fillable = [
        'product_id',
        'category_id',
        'vartiation_id'
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
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'category');
    }

    public function variation()
    {
        return $this->belongsTo(Variation::class, 'variation_id', 'id');
    }
}
