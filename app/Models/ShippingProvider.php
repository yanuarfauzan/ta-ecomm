<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingProvider extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'shipping_provider';
    protected $fillable = [
        'name',
        'desc',
        'base_rate'
    ];

    public function getIncrement()
    {
        return false;
    }
    public function getKeyType()
    {
        return 'string';
    }
    public function shipping()
    {
        return $this->belongsTo(Shipping::class, 'id', 'shipping_provider_id');
    }
}
