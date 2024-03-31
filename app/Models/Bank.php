<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'bank';
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

    public function bankUser()
    {
        return $this->belongsTo(BankUser::class, 'id', 'bank_id');
    }
}
