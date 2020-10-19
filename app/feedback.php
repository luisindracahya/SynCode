<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class feedback extends Model
{
    protected $fillable = ['message'];
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
