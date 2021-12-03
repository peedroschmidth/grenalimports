@extends('layouts.app', ['current' => "painel"])

@section('body')
@if (session('alert'))
    <div class="alert alert-danger">
        {{ session('alert') }}
    </div>
@endif
<h1>Página de Ligas</h1>
<div class="card border">
    <div class="card-body">
    <a href="/ligas/novo" class="btn btn-sm btn-primary" role="button">Nova Liga</a>

@if(count($ligas) > 0)
        <table class="table table-ordered table-hover">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nome da Liga</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
    @foreach($ligas as $l)
                <tr>
                    <td>{{$l->id}}</td>
                    <td>{{$l->nomeLiga}}</td>
                    <td>
                        <a href="/ligas/editar/{{$l->id}}" class="btn btn-sm btn-primary">Editar</a>
                        <a href="/ligas/apagar/{{$l->id}}" class="btn btn-sm btn-danger">Apagar</a>
                    </td>
                </tr>
    @endforeach
            </tbody>
        </table>
@else
    <h4>Você não possuí ligas cadastradas, comece cadastrando uma!</h4>
@endif
    </div>
    <div class="card-footer">
        {{$ligas->links()}}
    </div>
</div>

@endsection
