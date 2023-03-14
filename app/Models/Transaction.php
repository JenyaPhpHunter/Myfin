<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'amount', 'user_id', 'type', 'description'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
