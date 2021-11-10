<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Fornecedor;
use App\Models\Encomenda;
use App\Models\Venda;
use App\Models\Pagamento;

class EncomendaController extends Controller
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
        $encomendas = Encomenda::paginate(10);
        return view('encomendas.index', compact('encomendas'));
    }
    public function encomendasAguardando(){
        $encomendas = Encomenda::where('status','=','A')->paginate(10);
        return view('encomendas.aguardando', compact('encomendas'));
    }
    public function encomendasTransito(){
        $encomendas = Encomenda::where('status','=','T')->paginate(10);
        return view('encomendas.transito', compact('encomendas'));
    }  
    public function encomendasRecebidas(){
        $encomendas = Encomenda::where('status','=','R')->paginate(10);
        return view('encomendas.recebidas', compact('encomendas'));
    }    
  
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
     public function create()
    {
        $vendas = Venda::where('status','=','A')->get();
        return view('encomendas.encomendar', compact('vendas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
     public function criarEncomenda(Request $request)
    {
        $fornecedor = Fornecedor::find($request['fornecedorEncomenda']);
        $req = $request->all();

        if($request['enderecoEncomenda']==""){
            $endereco = ['endereco'=>'Rua Quito, 30', 'cidade'=>'Novo Hamburgo','estado'=>'RS', 'cep'=>'93320-660'];
        }
        else{
            $endereco = DB::select('select endereco, cidade, estado, cep from clientes c 
            inner join vendas v on v.cliente_id = c.id where v.id  = ? ', [$request['enderecoEncomenda']]);
        }
         $count = 0;

        foreach ($req as $r => $v){
            if(is_numeric($r)){
                $count++;
            }
        }
        
        return view('encomendas.novo', compact('req','fornecedor','endereco','count'));


    }

    public function encomendasIncluir(Request $request)
    {
        
        $req = $request->all();
        $encomenda_id = Request()->get('encomenda_id');
        $valorPedido = Request()->get('valorPedido');
        $encomenda = Encomenda::find($encomenda_id);
        $count = 0;

        foreach($req as $r => $v){
            if(is_numeric($r)){
                DB::table('vendas')
                ->where('id', $r)
                ->update(['encomenda_id' => $encomenda_id,'status'=>'E']);
                $count++;
            }
        }

        if($count==0){
            echo "<script>alert('Selecione ao menos um produto para ser encomendado!')</script>";
            echo "<script>window.location.assign('/encomendas/editar/".$encomenda_id."')</script>";
        }
        else{
            $encomenda->valor_encomenda = $encomenda->valor_encomenda + $valorPedido;
            $encomenda->save();

            $pag = new Pagamento();
            $pag->descricao = "Diferença Pedido";
            $pag->valor = $valorPedido;
            $pag->encomenda_id = $encomenda->id;
            $pag->tipo = "S";
            $pag->save();

            return redirect()->to('/encomendas/editar/'.$encomenda_id);
        }
    }

    public function store(Request $request)
    {
        $req = $request->all();
        $encomenda = new Encomenda();

        $encomenda->valor_encomenda=$request->input('valorEncomenda');
        $encomenda->fornecedor_id=$request->input('fornecedorEncomenda');
        $encomenda->codigo_encomenda =$request->input('codigoEncomenda');
        $encomenda->status = "A";
        $encomenda->save();


        $pag = new Pagamento();
        $pag->descricao = "Encomenda Pedido";
        $pag->valor = $request->input('valorEncomenda');
        $pag->encomenda_id = $encomenda->id;
        $pag->tipo = "S";
        $pag->save();

        foreach($req as $r => $v){
            echo "<h1>$r -> $v</h1>";
            if(is_numeric($r)){
                DB::table('vendas')
                ->where('id', $r)
                ->update(['encomenda_id' => $encomenda->id,'status'=>'E']);
            }
        }
        return redirect()->to('/encomendas/editar/'.$encomenda->id); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //$encomenda = Encomenda::find($id);
        //return view('encomendas.ver', compact('encomenda'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $venda = Venda::where('encomenda_id','=',$id)->get();
        $encomenda = Encomenda::find($id)->toArray();
        $fornecedor = DB::select('select nome from fornecedors f inner join encomendas e on e.fornecedor_id=f.id where e.id=?', [$encomenda['id']]);
        $vendas = Venda::where('status','=','A')->get();
        
        return view('encomendas.detalhar', compact('encomenda','venda', 'fornecedor','vendas'));
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
        $req = $request->all();
        $rastreio = Request()->get('rastreio');
        $codigo = Request()->get('codigo');
        $encomenda = Encomenda::find($id);

        if(isset($rastreio)){    
            $encomenda->codigo_encomenda = $codigo;
            $encomenda->rastreio = $rastreio;
            $encomenda->status="T";
            $encomenda->save();
        }
        else{
            $encomenda->rastreio = $rastreio;
            $encomenda->codigo_encomenda = $codigo;
            $encomenda->save();    
        }
        return redirect()->to('/encomendas/editar/'.$id); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $encomenda = Encomenda::find($id);

            DB::table('vendas')
                ->where('encomenda_id', $id)
                ->update(['encomenda_id' => NULL,'status'=>'A']);
                $encomenda->delete();
                return redirect()->to('/encomendas'); 

    }    
    
    public function encomendasRemover($id)
    {
        $venda = Venda::find($id);
        $encomenda_id = $venda->encomenda_id;

        $venda =  DB::table('vendas')
        ->where('id', $venda->id)
        ->update(['encomenda_id' => NULL,'status'=>'A']);

        return redirect()->to('/encomendas/editar/'.$encomenda_id); 
    }

    public function confirmarRecebimento($id){

        DB::table('vendas')
        ->where('encomenda_id',$id)
        ->update(['status'=>'P']);

        DB::table('encomendas')
        ->where('id', $id)
        ->update(['status'=>'R']);
        $encomendas = Encomenda::where('status','=','R')->paginate(10);
        return view('encomendas.recebidas',compact('encomendas')); 
    }
}
