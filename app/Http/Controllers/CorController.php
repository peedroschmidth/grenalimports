<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cor;
use DB;

class CorController extends Controller
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
        $cores = Cor::paginate(10);
        return view('cores.index', compact('cores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cores.novo');

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
            'cor'  => 'unique:cors',
        ];
        $mensagens = [
            'unique' => 'Já existe esta cor cadastrada.'
        ];

        $request->validate($regras, $mensagens);

        $cores = new Cor();
        $cores->cor = $request->input('cores');
        $cores->save();
        return redirect('/cores');
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
        $cores = Cor::find($id);

        if(isset($cores)){
            return view('cores.editar', compact('cores'));
        }
        return redirect('/cores');
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
        $cores = Cor::find($id);

        if(isset($cores)){
            $cores->cor = $request->input('cores');
            $cores->save();
        }
        return redirect('/cores');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cores = Cor::find($id);

        $produtos = 0;
        $produtos = DB::select('select count(*) from produtos where cor_id = ?', [$id]);


        if ($produtos>=1){
            return redirect()->back()->with('alert', 'Impossível de deletar, possuí produtos relacionados!');
        }
        if (isset($tamanho)){
            $tamanho->delete();
        }
        return redirect('/cores');
    }
}
