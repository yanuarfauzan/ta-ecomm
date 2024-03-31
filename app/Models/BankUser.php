<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BankUser extends Model
{
    use HasFactory, HasUuids;
    
    protected $table = 'bank_user';
    protected $fillable = [
        'bank_id',
        'user_id',
        'rek_number'
    ];

    public function getIncrement()
    {
        return false;
    }

    public function getKeyType() 
    {
        return 'string';
    }

    public function bank() 
    {
        return $this->hasOne(Bank::class, 'id', 'bank_id');
    }
}
