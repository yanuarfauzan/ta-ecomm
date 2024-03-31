<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

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
        'birthdate',
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

    public function address()
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
        return $this->hasMany(CreditCard::class, 'user_id', 'id');
    }
}
