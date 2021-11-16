@extends('layouts.app', ["current" => "vendas"])

@section('body')


<h1>Página de Vendas - Todas</h1>
<div class="card border">
    <div class="card-body">
    <a href="/vendas/novo" class="btn btn-sm btn-success" role="button">Nova Venda</a>

    <form action='/vendasRelatorio' method='POST' target='_blank'>
    @csrf
        Data Início: <input type="date" id="dataInicio" name="dataInicio" min="2021-01-01" max="2050-04-30" required>
        Data Fim: <input type="date" id="dataFim" name="dataFim" min="2021-01-01" max="2050-04-30"  required>
        <input type="radio" id="todos" name="tipo" value="todos" checked> <label for="todos"> Todos</label>
        <input type="radio" id="pendentes" name="tipo" value="pendentes"> <label for="pendentes ">Pendentes</label>
        <input type="radio"  id="finalizadas" name="tipo" value="finalizadas"> <label for="finalizadas">Finalizadas</label>
        <button type="submit" class="btn btn-sm btn-primary">Gerar Relatório</button>
    </form>
    
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
                    <td>R$ {{$v->valor_pago}}</td>
                    <td>R$ {{$v->valor_total}}</td>
                    <td>
                        <a href="/vendas/editar/{{$v->id}}" class="btn btn-sm btn-primary">Detalhar</a>
                        <a href="/vendas/apagar/{{$v->id}}" class="btn btn-sm btn-danger">Apagar</a>
                    </td>
                </tr>
    @endforeach                
            </tbody>
        </table>
@endif        
    </div>
    <div class="card-footer">
        {{$vendas->links()}}
    </div>
</div>

@endsection