<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Liga;

class LigaController extends Controller
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
        $ligas = Liga::paginate(10);
        return view('ligas.index', compact('ligas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ligas.novo');
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
            'nomeLiga'  => 'unique:ligas',
        ];
        $mensagens = [ 
            'unique' => 'Já existe esta liga cadastrada.'
        ];

        $request->validate($regras, $mensagens);

        $liga = new Liga();
        $liga->nomeLiga = $request->input('nomeLiga');
        $liga->save();
        return redirect('/ligas');
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
        $liga = Liga::find($id);
        if(isset($liga)){
            return view('ligas.editar', compact('liga'));
        }
        return redirect('/ligas');
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


        $liga = Liga::find($id);
        
        if(isset($liga)){
            $liga->nomeLiga = $request->input('nomeLiga');
            $liga->save();
        }
        return redirect('/ligas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $liga = Liga::find($id);
        if (isset($liga)){
            $liga->delete();
        }
        return redirect('/ligas');
    }
}
