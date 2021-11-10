<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Encomenda extends Model
{
    function venda(){
        return $this->hasMany('App\Models\Venda');
    }
    function fornecedor(){
        return $this->belongsTo('App\Models\Fornecedor');
    }
}
