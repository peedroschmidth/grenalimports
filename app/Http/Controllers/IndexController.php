<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venda;
 
class IndexController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $vendas = Venda::where('status','A')->get();
        return view('welcome', compact('vendas'));
    }
}
