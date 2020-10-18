<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tag extends Model
{
    public function rooms()
    {
        return $this->belongsToMany(room::class,'detail_tags');
    }
}
