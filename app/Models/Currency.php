<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $fillable = [
        'name', 'symbol'
    ];
//    public function transaction()
//    {
//        return $this->belongsTo(Transaction::class);
//    }
}
