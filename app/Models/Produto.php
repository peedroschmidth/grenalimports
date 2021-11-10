<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    function clube(){
        return $this->belongsTo('App\Models\Clube');
    }
    function cor(){
        return $this->belongsTo('App\Models\Cor');
    }
    function tamanho(){
        return $this->belongsTo('App\Models\Tamanho');
    }    
    function descricao(){
        return $this->belongsTo('App\Models\Descricao');
    }
}
