<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotifUser extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'notif_user';
    protected $fillable = [
        'user_id',
        'notification_id',
        'is_read'
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
    public function notification()
    {
        return $this->belongsTo(Notification::class, 'notification_id', 'id');
    }
}
