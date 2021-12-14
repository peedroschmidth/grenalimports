
@extends('layouts.app', ['current' => "painel"])

@section('body')
@if (session('alert'))
    <div class="alert alert-danger">
        {{ session('alert') }}
    </div>
@endif
<h1>Página de Descrições</h1>
<div class="card border">
    <div class="card-body">
    <a href="/descricao/novo" class="btn btn-sm btn-primary" role="button">Nova Descrição</a>

@if(count($descricao) > 0)
        <table class="table table-ordered table-hover">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Descrição</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
    @foreach($descricao as $d)
                <tr>
                    <td>{{$d->id}}</td>
                    <td>{{$d->descricao}}</td>
                    <td>
                        <a href="/descricao/editar/{{$d->id}}" class="btn btn-sm btn-primary">Editar</a>
                        <a href="/descricao/apagar/{{$d->id}}" class="btn btn-sm btn-danger">Apagar</a>
                    </td>
                </tr>
    @endforeach
            </tbody>
        </table>
@else
    <h4>Você não possuí descrições cadastradas, comece cadastrando uma!</h4>
@endif
    </div>
    <div class="card-footer">
        {{$descricao->links()}}
    </div>
</div>

@endsection
