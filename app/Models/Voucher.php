<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Voucher extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'voucher';
    protected $fillable = [
        'name',
        'type',
        'voucher_icon',
        'voucher_code',
        'desc',
        'requirement',
        'min_value',
        'discount_value',
        'is_active',
        'expired_at'
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
        return $this->belongsToMany(Product::class, 'product_vouchers');
    }
}
