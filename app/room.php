<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class room extends Model
{
    protected $fillable = [
        'question','img_url'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function tags()
    {
        return $this->belongsToMany(tag::class,'detail_tags');
    }

    public function comments()
    {
        return $this->hasMany(comment::class,'room_id');
    }
}
