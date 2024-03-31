<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditCard extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'credit_card';
    protected $fillable = [
        'card_number',
        'expired_date',
        'cvv',
        'name_on_card',
        'billing_address',
        'postal_code',
        'user_id'
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
