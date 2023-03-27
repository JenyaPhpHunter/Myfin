<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
        {
            return $this->belongsTo(Role::class);
        }

        public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function transaction()
        {
            return $this->hasMany(Transaction::class);
        }
    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
