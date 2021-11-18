
@extends('layouts.app', ["current" => "estoque"])

@section('body')

<h1>Página de Estoque</h1>
<div class="card border">
    <div class="card-body">
    <a href="/vendas/novo" class="btn btn-sm btn-primary" role="button">Novo Produto</a>

@if(count($produtos) > 0)
        <table class="table table-ordered table-hover">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Descrição</th>
                    <th>Tamanho</th>
                    <th>Personalização</th>
                    <th>Observação</th>
                    <th>Clube</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
    @foreach($produtos as $p)
                <tr>
                    <td>{{$p->id}}</td>
                    <td>{{$p->descricao->descricao}}</td>
                    <td>{{$p->tamanho->tamanho}}</td>
                    <td>{{$p->personalizacao}}</td>
                    <td>{{$p->observacao}}</td>
                    <td>{{$p->clube->nome}}</td>
                    <td>
                        <a href="/vendas/editar/{{$p->id}}" class="btn btn-sm btn-primary">Editar</a>
                        <a href="/vendas/apagar/{{$p->id}}" class="btn btn-sm btn-danger">Apagar</a>
                        <a href="/estoque/vender/{{$p->id}}" class="btn btn-sm btn-success">Vender</a>
                    </td>
                </tr>
    @endforeach                
            </tbody>
        </table>
@else
<h5> Não há itens em estoque!</h5>
@endif        
    </div>
    <div class="card-footer">
        {{$produtos->links()}}
    </div>
</div>

@endsection