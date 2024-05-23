<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;
    protected $table = 'voucher';
    protected $fillable = [
        'name',
        'voucher_icon',
        'voucher_code',
        'desc',
        'reuirement',
        'discount_value',
        'expired_at',
        'is_active',
    ];
}
