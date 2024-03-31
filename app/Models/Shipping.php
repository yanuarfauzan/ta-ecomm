<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Shipping extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'shipping';
    protected $fillable = [
        'shipping_provider_id',
        'shipping_type',
        'shipping_status',
        'resi_number',
        'shipping_address',
        'shipping_cost'
    ];

    public function getIncrement()
    {
        return false;
    }
    public function getKeyType()
    {
        return 'string';
    }

    public function shippingProvider()
    {
        return $this->hasOne(ShippingProvider::class, 'id', 'shipping_provider_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'id', 'shipping_id');
    }
}
