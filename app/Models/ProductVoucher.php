<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVoucher extends Model
{
    use HasFactory;
    protected $table = 'product_voucher';
    protected $fillable = [
        'product_id',
        'voucher_id',
    ];
    public function getIncrement()
    {
        return false;
    }
    public function getKeyType()
    {
        return 'string';
    }
}
