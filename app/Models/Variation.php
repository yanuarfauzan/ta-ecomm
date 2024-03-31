<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variation extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'variation';
    protected $fillable = [
        'name'
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
