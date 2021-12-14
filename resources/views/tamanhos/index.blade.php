@extends('layouts.app', ['current' => "painel"])

@section('body')
@if (session('alert'))
    <div class="alert alert-danger">
        {{ session('alert') }}
    </div>
@endif
<h1>Página de Tamanhos</h1>
<div class="card border">
    <div class="card-body">
    <a href="/tamanhos/novo" class="btn btn-sm btn-primary" role="button">Novo Tamanho</a>

@if(count($tamanho) > 0)
        <table class="table table-ordered table-hover">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Tamanho</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
    @foreach($tamanho as $t)
                <tr>
                    <td>{{$t->id}}</td>
                    <td>{{$t->tamanho}}</td>
                    <td>
                        <a href="/tamanhos/editar/{{$t->id}}" class="btn btn-sm btn-primary">Editar</a>
                        <a href="/tamanhos/apagar/{{$t->id}}" class="btn btn-sm btn-danger">Apagar</a>
                    </td>
                </tr>
    @endforeach
            </tbody>
        </table>
@else
    <h4>Você não possuí tamanhos cadastradas, comece cadastrando um!</h4>
@endif
    </div>
    <div class="card-footer">
        {{$tamanho->links()}}
    </div>
</div>

@endsection
