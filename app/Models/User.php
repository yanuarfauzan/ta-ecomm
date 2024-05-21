<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Notification;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasUuids;

    protected $table = 'user';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'phone_number',
        'is_verified',
        'gender',
        'birtdate',
        'profile_image',
        'role',
        'otp',
        'token_reset'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getIncrement()
    {
        return false;
    }

    public function getKeyType()
    {
        return 'string';
    }

    public function userAddresses()
    {
        return $this->hasMany(Address::class, 'user_id', 'id');
    }

    public function product()
    {
        return $this->belongsToMany(Product::class, 'cart', 'product_id', 'id');
    }

    public function bank()
    {
        return $this->hasMany(BankUser::class, 'user_id', 'id');
    }

    public function creditCard()
    {
        return $this->hasOne(CreditCard::class, 'id', 'user_id');
    }

    public function notification()
    {
        return $this->belongsToMany(Notification::class, 'notif_user', 'notification_id', 'id');
    }
    public function cart()
    {
        return $this->hasMany(Cart::class, 'user_id', 'id');
    }
    public function favouriteProduct()
    {
        return $this->belongsToMany(Product::class, 'has_been_favourite_product')->withPivot('id');
    }
    public function order()
    {
        return $this->hasOne(Order::class, 'user_id', 'id');
    }
}
