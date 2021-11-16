@extends('layouts.app', ["current" => "vendas"])

@section('body')


<h1>Página de Vendas - Finalizadas</h1>
<div class="card border">
    <div class="card-body">
    <a href="/vendas/novo" class="btn btn-sm btn-primary" role="button">Nova Venda</a>

@if(count($vendas) > 0)
        <table class="table table-ordered table-hover">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Cliente</th>
                    <th>Descrição</th>
                    <th>Tamanho</th>
                    <th>Personalização</th>
                    <th>Clube</th>
                    <th>Valor Pago</th>
                    <th>Valor Total</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
    @foreach($vendas as $v)
                <tr>
                    <td>{{$v->id}}</td>
                    <td>{{$v->cliente->nome}}</td>
                    <td>{{$v->produto->descricao->descricao}}</td>
                    <td>{{$v->produto->tamanho->tamanho}}</td>
                    <td>{{$v->produto->personalizacao}}</td>
                    <td>{{$v->produto->clube->nome}}</td>
                    <td>{{$v->valor_pago}}</td>
                    <td>{{$v->valor_total}}</td>
                    <td>
                        <a href="/vendas/editar/{{$v->id}}" class="btn btn-sm btn-primary">Detalhar</a>
                        <a href="/vendas/apagar/{{$v->id}}" class="btn btn-sm btn-danger">Apagar</a>
                    </td>
                </tr>
    @endforeach                
            </tbody>
        </table>
@else
<h4>Você não possuí vendas finalizadas!</h4>
@endif
    </div>
    <div class="card-footer">
        {{$vendas->links()}}
    </div>
</div>

@endsection