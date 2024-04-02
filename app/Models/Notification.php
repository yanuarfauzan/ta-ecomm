<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'notification';
    protected $fillable = [
        'content'  
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
        return $this->belongsToMany(User::class, 'notif_user', 'user_id', 'id');
    }
}
