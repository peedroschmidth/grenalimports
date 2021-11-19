<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Fornecedor;


class FornecedorController extends Controller
{    
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fornecedor = Fornecedor::paginate(5);
        return view('fornecedores.index',compact('fornecedor'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('fornecedores.novo');
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
            'nomeFornecedor'  => 'unique:fornecedors,nome',
        ];
        $mensagens = [ 
            'unique' => 'Já existe este fornecedor cadastrado.'
        ];

        $request->validate($regras, $mensagens);

        $fornecedor = new Fornecedor();
        $fornecedor->nome = $request->input('nomeFornecedor');
        $fornecedor->contato = $request->input('contatoFornecedor');
        $fornecedor->save();
        return redirect('/fornecedores');
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
        $fornecedor = Fornecedor::find($id);
        if(isset($fornecedor)){
            return view('fornecedores.editar',compact('fornecedor'));
        }
        return redirect('/fornecedores');
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


        $fornecedor = Fornecedor::find($id);
        
        if(isset($fornecedor)){
            $fornecedor->nome = $request->input('nomeFornecedor');
            $fornecedor->contato = $request->input('contatoFornecedor');
            $fornecedor->save();
        }
        return redirect('/fornecedores');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $enc = 0;
        $enc = DB::select('select count(*) from encomendas where fornecedor_id = ?', [$id]);

        if ($enc>0){
            return redirect()->back()->with('alert', 'Impossível de deletar, possuí encomendas relacionadas!');
        }

        $fornecedor = Fornecedor::find($id);
        if (isset($fornecedor)){
            $fornecedor->delete();
        }
        return redirect('/fornecedores');
    }
}
