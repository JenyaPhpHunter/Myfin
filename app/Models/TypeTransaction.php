<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeTransaction extends Model
{
    protected $fillable = [
        'name'
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
