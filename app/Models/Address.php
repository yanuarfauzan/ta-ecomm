<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'address';

    protected $fillable = [
        'user_id',
        'unit_number',
        'postal_code',
        'street_name',
        'city',
        'province',
        'is_verified',
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
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
