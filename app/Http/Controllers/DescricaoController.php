<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Descricao;
use DB;

class DescricaoController extends Controller
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
        $descricao = Descricao::paginate(10);
        return view('descricao.index', compact('descricao'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('descricao.novo');

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
            'descricao'  => 'unique:descricaos',
        ];
        $mensagens = [
            'unique' => 'Já existe esta descrição cadastrada.'
        ];

        $request->validate($regras, $mensagens);

        $descricao = new Descricao();
        $descricao->descricao = $request->input('descricao');
        $descricao->save();
        return redirect('/descricao');
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
        $descricao = Descricao::find($id);

        if(isset($descricao)){
            return view('descricao.editar', compact('descricao'));
        }
        return redirect('/descricao');
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
        $descricao = Descricao::find($id);

        if(isset($descricao)){
            $descricao->descricao = $request->input('descricao');
            $descricao->save();
        }
        return redirect('/descricao');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $descricao = Descricao::find($id);

        $produtos = 0;
        $produtos = DB::select('select count(*) from produtos where cor_id = ?', [$id]);


        if ($produtos>=1){
            return redirect()->back()->with('alert', 'Impossível de deletar, possuí produtos relacionados!');
        }
        if (isset($tamanho)){
            $tamanho->delete();
        }
        return redirect('/descricao');
    }
}
