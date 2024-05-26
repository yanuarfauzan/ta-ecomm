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
        'type',
        'voucher_icon',
        'voucher_code',
        'desc',
        'requirement',
        'discount_value',
        'expired_at',
        'expired_at'
    ];
    
}
