<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Clube;
use App\Models\Liga;

class ClubeController extends Controller
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
        $clubes = Clube::paginate(10);
        return view('clubes.index', compact('clubes')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $liga = Liga::all();
        return view('clubes.novo', compact('liga'));
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
            'nomeClube'  => 'required',
            'ligaClube' => 'required'
        ];
        $mensagens = [ 
            'required' => 'O atributo :attribute não pode estar em branco.'
        ];

        $request->validate($regras, $mensagens);

        $clube = new Clube();
        $clube->nome = $request->input('nomeClube');
        $clube->liga_id = $request->input('ligaClube');
        $clube->save();

        return redirect ('/clubes');
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
        $clube = Clube::find($id);
        $liga = Liga::all();

        if(isset($clube)){
            return view ('clubes.editar', compact('clube','liga'));
        }
        return redirect('clubes');
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
        $regras = [
            'nomeClube'  => 'required',
        ];
        $mensagens = [ 
            'required' => 'O atributo :attribute não pode estar em branco.'
        ];

        $request->validate($regras, $mensagens);

        $clube = Clube::find($id);
        
        if(isset($clube)){
            $clube->nome = $request->input('nomeClube');
            $clube->liga_id = $request->input('ligaClube');
            $clube->save();
        }
        return redirect('/clubes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $clube = Clube::find($id);
        if (isset($clube)){
            $clube->delete();
        }
        return redirect('/clubes');
    }
}