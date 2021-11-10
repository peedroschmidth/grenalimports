<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Pagamento extends Model
{
    use HasFactory;

    function encomenda(){
        return $this->belongsTo('App\Models\Encomenda');
    }
    function venda(){
        return $this->belongsTo('App\Models\Venda');
    }
}
