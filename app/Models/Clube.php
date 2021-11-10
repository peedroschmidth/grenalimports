<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clube extends Model
{
    function liga(){
        return $this->belongsTo('App\Models\Liga');
    }
}
