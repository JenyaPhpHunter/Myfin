<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeTransaction extends Model
{
    protected $fillable = [
        'name'
    ];

    public function transaction()
    {
        return $this->hasMany(Transaction::class);
    }
}

