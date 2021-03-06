<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use PDF;
use DB;

class ClienteController extends Controller
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
        $clientes = Cliente::paginate(10);
        return view('clientes.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clientes.novo');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $cliente = new Cliente();
        $cliente->nome = $request->input('nomeCliente');
        $cliente->apelido = $request->input('apelidoCliente');
        $cliente->email = $request->input('emailCliente');
        $cliente->telefone = $request->input('telefoneCliente');
        $cliente->endereco = $request->input('enderecoCliente');
        $cliente->cidade = $request->input('cidadeCliente');
        $cliente->estado = $request->input('estadoCliente');
        $cliente->cep = $request->input('cepCliente');
        $cliente->save();

        return redirect('/clientes');
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
        $cliente = Cliente::find($id);
        if(isset($cliente)){
            return view('clientes.editar',compact('cliente'));
        }
        return redirect('/clientes');
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
        $cliente = Cliente::find($id);
        if(isset($cliente)){

            $cliente->nome = $request->input('nomeCliente');
            $cliente->apelido = $request->input('apelidoCliente');
            $cliente->email = $request->input('emailCliente');
            $cliente->telefone = $request->input('telefoneCliente');
            $cliente->endereco = $request->input('enderecoCliente');
            $cliente->cidade = $request->input('cidadeCliente');
            $cliente->estado = $request->input('estadoCliente');
            $cliente->cep = $request->input('cepCliente');
            $cliente->save();
        }
        return redirect('/clientes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vendas = 0;
        $vendas = DB::select('select count(*) from vendas where cliente_id = ?', [$id]);

        if ($vendas>0){
            return redirect()->back()->with('alert', 'Imposs??vel de deletar, cliente possu?? vendas relacionadas!');
        }
        else{
            $cliente = Cliente::find($id);
            if (isset($cliente)){
                $cliente->delete();
            }
            return redirect('/clientes');
        }
    }


}
