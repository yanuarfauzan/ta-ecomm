<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductAssessment extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'product_assessment';
    protected $fillable = [
        'order_id',
        'user_id',
        'product_id',
        'rating',
        'content',
        'response_operator',
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
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    public function attachments()
    {
        return $this->hasMany(Attachments::class, 'product_assessment_id', 'id');
    }
}
