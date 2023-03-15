<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $fillable = [
        'name', 'balance', 'currency', 'user_id'
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
