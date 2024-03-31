<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'category';
    protected $fillable = [
        'name',
        'icon'
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
