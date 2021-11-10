@extends('layouts.app', ['current' => "home"])

@section('body')
<div class="jumbotron bg-light border border-secondary">
<table width="100%">
    <td><a href="/clientes" class="btn btn-primary">Cadastrar Cliente</a></td>
    <td><a href="/vendas/novo" class="btn btn-primary">Realizar Venda</a></td>
    <td><a href="/clubes" class="btn btn-primary">Cadastrar Clubes</a></td>
    <td><a href="/dashboard" class="btn btn-primary">Dashboard</a></td>

</table>    
        <?php
            $vendas_mes = DB::table('vendas')->where('created_at','>',date('Y-m'))->count(); 
            $vendas_aberto = DB::table('vendas')->where('status','A')->count();
        ?>
        <h4>Total de vendas este mês: {{$vendas_mes}} </h4>
        <h4>Total de vendas em aberto: {{$vendas_aberto}} </h4>
</div>

<div class="jumbotron bg-light border border-secondary">
@component('vendas.listar', compact('vendas'))
@endcomponent
</div>
@endsection