<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HasBeenFavouriteProduct extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'has_been_favourite_product';
    protected $fillable = [
        'user_id',
        'product_id'
    ];
    public function getIncrement()
    {
        return false;
    }
    public function getKeyType()
    {
        return 'string';
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
