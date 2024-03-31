<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAssessment extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'product_assessment';
    protected $fillable = [
        'cart_id',
        'product_id',
        'rating',
        'content',
        'attachment',
    ];

    public function getIncrement()
    {
        return false;
    }
    public function getKeyType()
    {
        return 'string';
    }
    public function cart()
    {
        return $this->belongsTo(Cart::class, 'cart_id', 'id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
