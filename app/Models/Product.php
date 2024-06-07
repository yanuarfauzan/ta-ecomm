<?php

namespace App\Models;

use App\Models\ProductImage;
use App\Models\ProductAssessment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'product';
    protected $fillable = [
        'name',
        'SKU',
        'product_image',
        'price',
        'stock',
        'weight',
        'dimensions',
        'price_after_discount',
        'price_after_additional',
        'desc',
        'discount',
    ];

    public function getIncrement()
    {
        return false;
    }

    public function getKeyType()
    {
        return 'string';
    }

    public function hasCategory()
    {
        return $this->belongsToMany(Category::class, 'product_category_variation')->withPivot('variation_id', 'id');
    }

    public function variation()
    {
        return $this->belongsToMany(Variation::class, 'product_category_variation')->withPivot('variation_id', 'id');
    }

    public function user()
    {
        return $this->belongsToMany(User::class, 'cart', 'user_id', 'id');
    }

    public function cart()
    {
        return $this->belongsToMany(Cart::class, 'cart_product')->withPivot('id', 'is_locked');
    }
    public function pickedVariation()
    {
        return $this->belongsToMany(Variation::class, 'picked_variation')->withPivot('variation_option_id', 'id');
    }
    public function pickedVariationOption()
    {
        return $this->belongsToMany(VariationOption::class, 'picked_variation')->withPivot('variation_option_id', 'id');
    }
    public function favouriteByUser()
    {
        return $this->belongsToMany(User::class, 'has_been_favourite_product');
    }

    public function hasImages()
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }
    public function productImages()
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }
    public function order()
    {
        return $this->belongsTo(Order::class, 'id', 'product_id');
    }
    public function productAssessment()
    {
        return $this->hasMany(ProductAssessment::class, 'product_id', 'id');
    }
    public function productAssessments()
    {
        return $this->hasMany(ProductAssessment::class, 'product_id', 'id');
    }
    public function voucher()
    {
        return $this->belongsToMany(Voucher::class, 'product_voucher');
    }
    public function variationOptions()
    {
        return $this->hasMany(VariationOption::class);
    }
}
