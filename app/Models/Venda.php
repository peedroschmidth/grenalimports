<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    function cliente(){
        return $this->belongsTo('App\Models\Cliente');
    }
    function produto(){
        return $this->belongsTo('App\Models\Produto');
    }
    function clube(){
        return $this->belongsTo('App\Models\Clube');
    }
    function encomenda(){
        return $this->belongsTo('App\Models\Encomenda');
    }
}
