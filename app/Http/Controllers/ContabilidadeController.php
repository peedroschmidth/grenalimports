<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pagamento;
use App\Models\Venda;
use DB;
use PDF;


class ContabilidadeController extends Controller
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
        $pag = Pagamento::paginate(10);
        return view('contabilidades.index',compact('pag'));
    }

    public function adicionar(Request $request)
    {
        $req = $request->all();
        $pag = new Pagamento();
        $tipo = Request()->get('tipoPagamento');

        $pag->descricao = $request->input('descricaoPagamento');
        $pag->valor = $request->input('valorPagamento');
        
        if($tipo=="entrada"){
            $pag->tipo = "E";
        }
        else{
            $pag->tipo = "S";
        }
        $pag->save();

        return redirect('/contabilidade');
    }


    public function adicionarValor(Request $request, $id){
        $finalizada = $request->input('finalizada');
        $req = $request->all();
        $pag = new Pagamento();
        $venda = Venda::find($id);

        $valorRestante = $venda->valor_total - $venda->valor_pago;

        if(isset($finalizada)){
            if($valorRestante>0){
                $pag->descricao = "Venda - Recebido";
                $pag->valor = $valorRestante;
                $pag->tipo = "E";
                $pag->venda_id = $venda->id;
                $pag->save();
            }
            $venda->status = "F";
            $venda->valor_pago = $venda->valor_pago + $valorRestante;
            $venda->save();

        }else{
            $pag->descricao = "Venda - Recebido";
            $pag->valor = $request['valorPagamento'];
            $pag->tipo = "E";
            $pag->venda_id = $venda->id;
            $pag->save();
            $venda->valor_pago = $venda->valor_pago + $request['valorPagamento'];
            $venda->save();
        }
        return redirect('/vendas/editar/'.$venda->id);
    }

    public function relatorio(Request $request){

        $req = $request->all();
        $tipo = Request()->get('tipo');

        $dataIni = $request->input('dataInicio');
        $dataFim = $request->input('dataFim');

        if($tipo=="saidas"){
            $contab = DB::table('pagamentos')
            ->where('created_at', '>=', [$dataIni])
            ->where('created_at', '<=', [$dataFim])
            ->where('tipo','=','S')->get();
        }
        else if($tipo == "entradas"){
            $contab = DB::table('pagamentos')
            ->where('created_at', '>=', [$dataIni])
            ->where('created_at', '<=', [$dataFim])
            ->where('tipo','=', 'E')->get();

    
            }
        else if($tipo=="todos"){
            $contab = DB::table('pagamentos')
            ->where('created_at', '>=', [$dataIni])
            ->where('created_at', '<=', [$dataFim])->get();

        }
        $pdf = PDF::loadView('contabilidades.relatorio',compact('contab','dataIni','dataFim'));
        
        return $pdf->setPaper('a4')->stream('ContabilidadesRelatório.pdf');


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
        $pag = Pagamento::find($id);
        
        if (isset($pag)){
            $pag->delete();
        }
        return redirect('/contabilidade');
    }
}
