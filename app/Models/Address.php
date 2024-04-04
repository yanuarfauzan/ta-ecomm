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
        'detail',
        'postal_code',
        'address',
        'city',
        'province',
        'is_default',
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

    public function usersAddress()
    {
        return $this->hasMany(Address::class);
    }
}
