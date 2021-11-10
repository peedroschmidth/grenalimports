<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    /*
    public function search($filter = null){
        $result = $hits->where(function($query) use($filter){
            if($filter){
                $query->where('nome','LIKE',"%{$filter}%");
            }
        })->paginate();
    return $results;
    }
    */
}
