<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pagamento;
use chartjs;
use DB;

class DashboardController extends Controller
{   
     public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard(){
        $meses = ['Jan', 'Fev'];
        $entradas = DB::select("select sum(valor) from controleestoquegrenal.pagamentos where tipo='e' group by MONTH(created_at)");
        $saidas =  DB::select("select sum(valor) from controleestoquegrenal.pagamentos where tipo='s' group by MONTH(created_at)");
        

        return view('dashboard.relatorios', compact('meses', 'entradas','saidas'));
    }
}
