<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use PDF;

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
        $regras = [
            'nomeCliente'  => 'required',
        ];
        $mensagens = [ 
            'required' => 'O atributo :attribute não pode estar em branco.'
        ];

        $request->validate($regras, $mensagens);

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

            $regras = [
                'nomeCliente'  => 'required',
            ];
            $mensagens = [ 
                'required' => 'O atributo :attribute não pode estar em branco.'
            ];

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
        $cliente = Cliente::find($id);
        if (isset($cliente)){
            $cliente->delete();
        }
        return redirect('/clientes');
    }

    public function search(Request $request){
        $clientes = $this->search($request->filter);
        return view('clientes.index',compact('clientes'));
    }
    
    public function teste(){

        $cliente = Cliente::all();
        $pdf = PDF::loadView('clientes.pdf',compact('cliente'));
        
        return $pdf->setPaper('a4')->stream('Tds_clientes.pdf');

    }
}
