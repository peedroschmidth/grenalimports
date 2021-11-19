<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Cliente;
use App\Models\Clube;
use App\Models\Venda;
use App\Models\Cor;
use App\Models\Descricao;
use App\Models\Tamanho;
use App\Models\Pagamento;
use DB;

class EstoqueController extends Controller
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
        $produtos = Produto::where('estoque','=','1')->paginate(10);
        return view('estoque.index',compact('produtos'));
    }

    public function vender($id){
        $cliente = Cliente::all()->sortBy('nome');
        $clube = Clube::all()->sortBy('nome');
        $descricao = Descricao::all()->sortBy('descricao');
        $cor = Cor::all()->sortBy('cor');
        $tamanho = Tamanho::all();
        $produto = Produto::find($id);

        return view('estoque.vender',compact('produto','cliente','clube','descricao','cor','tamanho'));
    }

    public function confirmarVenda(Request $request, $id){

        
        $req = $request->all();
        $venda = Venda::find($id);

        $venda->cliente_id = $req['clienteProduto'];
        $venda->valor_total = $req['valorTotal'];
        $venda->valor_sinal = $req['valorSinal'];
        $venda->valor_pago = $req['valorSinal'];

        $venda->save();

        $pag =  new Pagamento();
        $pag->venda_id = $venda->id;
        $pag->descricao = "Venda - Estoque";
        $pag->tipo = "E";
        $pag->valor = $venda->valor_pago;
        $pag->save();


        DB::update('update clientes set qtdcompras=qtdcompras+1 where id= ?',[$req['clienteProduto']]);
        DB::update('update produtos set estoque="0" where id=?', [$venda->produto_id]);
        $produtos = Produto::where('estoque','=','1')->paginate(10);
        return view('estoque.index',compact('produtos'));

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
