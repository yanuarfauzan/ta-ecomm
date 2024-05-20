<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProvinciesAndCities extends Model
{
    use HasFactory;
    protected $table = 'provincies_and_cities';
    protected $fillable = [
        'city_id',
        'province_id',
        'province',
        'type',
        'city_name',
        'postal_code'
    ];

}
