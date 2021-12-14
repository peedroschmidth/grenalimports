<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tamanho;
use DB;

class TamanhoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $tamanho = Tamanho::paginate(10);
        return view('tamanhos.index', compact('tamanho'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tamanhos.novo');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $regras = [
            'tamanho'  => 'unique:tamanhos',
        ];
        $mensagens = [
            'unique' => 'Já existe este tamanho cadastrada.'
        ];

        $request->validate($regras, $mensagens);

        $tamanho = new Tamanho();
        $tamanho->tamanho = $request->input('tamanho');
        $tamanho->save();
        return redirect('/tamanhos');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tamanho = Tamanho::find($id);
        if(isset($tamanho)){
            return view('tamanhos.editar', compact('tamanho'));
        }
        return redirect('/tamanhos');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $tamanho = Tamanho::find($id);

        if(isset($tamanho)){
            $tamanho->tamanho = $request->input('tamanho');
            $tamanho->save();
        }
        return redirect('/tamanhos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tamanho = Tamanho::find($id);

        $produtos = 0;
        $produtos = DB::select('select count(*) from produtos where tamanho_id = ?', [$id]);


        if ($produtos>=1){
            return redirect()->back()->with('alert', 'Impossível de deletar, possuí produtos relacionados!');
        }
        if (isset($tamanho)){
            $tamanho->delete();
        }
        return redirect('/tamanhos');
    }
}
