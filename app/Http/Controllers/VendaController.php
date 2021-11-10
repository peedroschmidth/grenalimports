<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Clube;
use App\Models\Cliente;
use App\Models\Produto;
use App\Models\Venda;
use App\Models\Cor;
use App\Models\Descricao;
use App\Models\Tamanho;
use App\Models\Pagamento;

class VendaController extends Controller
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
        $vendas = Venda::paginate(10);
        return view('vendas.index', compact('vendas'));
    }
    public function vendasAberto(){
        $vendas = Venda::where('status','=','A')->paginate(10);
        return view('vendas.vendasAberto',compact('vendas'));
    }
    public function vendasPendentes(){
        $vendas = Venda::where('status','=','P')->orWhere('status','=','E')->paginate(10);
        return view('vendas.vendasPendentes',compact('vendas'));
    }
    public function vendasFinalizadas(){
        $vendas = Venda::where('status','=','F')->paginate(10);
        return view('vendas.vendasFinalizadas',compact('vendas'));
    }    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cliente = Cliente::all()->sortBy('nome');
        $clube = Clube::all()->sortBy('nome');
        $descricao = Descricao::all()->sortBy('descricao');
        $cor = Cor::all()->sortBy('cor');
        $tamanho = Tamanho::all();

        return view('vendas.novo',compact('clube','cliente','cor','descricao','tamanho'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $cli = $request->input('clienteProduto');
        $gen = Request()->get('generoProduto');
        $est = $request->input('estoque');
        
        $regras = [
            'descricaoProduto'  => 'required',
            'clubeProduto' => 'required',
            'generoProduto' => 'required',
            'corProduto' =>'required',
            'anoProduto' => 'required',
            'tamanhoProduto' => 'required',
            'valorTotal' => 'required',

        ];
        $mensagens = [ 
            'required' => 'O atributo :attribute não pode estar em branco.'
        ];

        $request->validate($regras, $mensagens);

        $produto = new Produto();

        if($gen=="masculino"){
            $produto->genero = 1;
        }
        else{
            $produto->genero = 0;
        }

        if(isset($est)){
            $produto->estoque = "1";
        }else{
            $produto->estoque = "0";
        }

        $produto->descricao_id = $request->input('descricaoProduto');
        $produto->personalizacao = $request->input('personalizacaoProduto');
        $produto->observacao = $request->input('observacaoProduto');
        $produto->cor_id = $request->input('corProduto');
        $produto->ano = $request->input('anoProduto');
        $produto->tamanho_id = $request->input('tamanhoProduto');
        $produto->clube_id = $request->input('clubeProduto');
        

        $produto->save();

        $venda = new Venda();
        $venda->produto_id = $produto->id;
        $venda->cliente_id = $cli;
        $venda->valor_total = $request->input('valorTotal');
        $venda->valor_sinal = $request->input('valorSinal');
        $venda->valor_pago = $request->input('valorSinal');
        //$venda->encomenda_id = NULL;
        $venda->save();

        $cliente = Cliente::find($cli);
        $cliente->qtdcompras++;
        $cliente->save();

        $pag = new Pagamento();

        if($request->input('valorSinal')>0){
            $pag->descricao = "Venda - Sinal";
            $pag->valor = $request['valorSinal'];
            $pag->tipo = "E";
            $pag->venda_id = $venda->id;
            $pag->save();
        }
        
        return redirect('/vendas');
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
        $cliente = Cliente::all()->sortBy('nome');
        $clube = Clube::all()->sortBy('nome');
        $descricao = Descricao::all()->sortBy('descricao');
        $cor = Cor::all()->sortBy('cor');
        $tamanho = Tamanho::all();
        $venda = Venda::find($id);
        
        if(isset($venda)){
            return view('vendas.editar', compact('venda','clube','cliente','cor','descricao','tamanho'));
        }
        return redirect('/vendas');
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
        $gen = Request()->get('generoProduto');
        $est = $request->input('estoque');

        $regras = [
            'descricaoProduto'  => 'required',
            'clubeProduto' => 'required',
            'generoProduto' => 'required',
            'corProduto' =>'required',
            'anoProduto' => 'required',
            'tamanhoProduto' => 'required',
            'clienteProduto' => 'required',
            'valorTotal' => 'required',

        ];
        $mensagens = [ 
            'required' => 'O atributo :attribute não pode estar em branco.'
        ];

        $request->validate($regras, $mensagens);

        $venda = Venda::find($id);
        $produto = Produto::find($venda->produto->id);
        
        if(isset($venda)){


            $produto->descricao_id = $request->input('descricaoProduto');
            $produto->personalizacao = $request->input('personalizacaoProduto');
            $produto->observacao = $request->input('observacaoProduto');
            $produto->cor_id = $request->input('corProduto');
            $produto->ano = $request->input('anoProduto');
            $produto->tamanho_id = $request->input('tamanhoProduto');
            $produto->clube_id = $request->input('clubeProduto');
           
            
            if(isset($est)){
                $produto->estoque = "1";
            }else{
                $produto->estoque = "0";
            }

            if($gen=="masculino"){
                $produto->genero = 1;
            }
            else{
                $produto->genero = 0;
            }
            
            $produto->save();
            
            $clienteAtual = Cliente::find($venda->cliente_id); //cliente cadastrado no banco
            $clienteNovo = $request->input('clienteProduto'); //cliente novo, que veio do request

            if($clienteAtual <> $clienteNovo){
                $clienteAtual->qtdcompras--;
                $clienteAtual->save();
            }
            
            $cliente = Cliente::find($clienteNovo);
            $cliente->qtdcompras++;
            $cliente->save();

            $venda->produto_id = $produto->id;
            $venda->cliente_id = $clienteNovo;
            $venda->valor_total = $request->input('valorTotal');
            $venda->valor_sinal = $request->input('valorSinal');
            $venda->valor_pago = $request->input('valorSinal');
            //$venda->encomenda_id = NULL;
            $venda->save();
    
        }
        return redirect('/vendas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $venda = Venda::find($id);
        $produto = Produto::find($venda->produto_id);
        if (isset($venda)){
            $venda->delete();
            $produto->delete();
        }
        return redirect('/vendas');
    }
}
