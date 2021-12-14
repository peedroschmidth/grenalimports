@extends('layouts.app', ['current' => "painel"])

@section('body')
@if (session('alert'))
    <div class="alert alert-danger">
        {{ session('alert') }}
    </div>
@endif
<h1>Página de Cores</h1>
<div class="card border">
    <div class="card-body">
    <a href="/cores/novo" class="btn btn-sm btn-primary" role="button">Nova Cor</a>

@if(count($cores) > 0)
        <table class="table table-ordered table-hover">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Cor</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
    @foreach($cores as $c)
                <tr>
                    <td>{{$c->id}}</td>
                    <td>{{$c->cor}}</td>
                    <td>
                        <a href="/cores/editar/{{$c->id}}" class="btn btn-sm btn-primary">Editar</a>
                        <a href="/cores/apagar/{{$c->id}}" class="btn btn-sm btn-danger">Apagar</a>
                    </td>
                </tr>
    @endforeach
            </tbody>
        </table>
@else
    <h4>Você não possuí cores cadastradas, comece cadastrando uma!</h4>
@endif
    </div>
    <div class="card-footer">
        {{$cores->links()}}
    </div>
</div>

@endsection
