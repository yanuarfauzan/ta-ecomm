<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $table = 'notification';
    protected $fillable = [
        'content'  
    ];
    public function user()
    {
        return $this->belongsToMany(User::class, 'notif_user', 'user_id', 'id')->withPivot('is_read');
    }
}
