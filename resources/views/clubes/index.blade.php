@extends('layouts.app', ["current" => "administrativo"])

@section('body')

<h1>Página de Clubes</h1>
<div class="card border">
    <div class="card-body">
    <a href="/clubes/novo" class="btn btn-sm btn-primary" role="button">Novo Clube</a>

@if(count($clubes) > 0)
        <table class="table table-ordered table-hover">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nome do Clube</th>
                    <th>Liga</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
    @foreach($clubes as $c)
                <tr>
                    <td>{{$c->id}}</td>
                    <td>{{$c->nome}}</td>
                    <td>{{$c->liga->nomeLiga}}</td>
                    <td>
                        <a href="/clubes/editar/{{$c->id}}" class="btn btn-sm btn-primary">Editar</a>
                        <a href="/clubes/apagar/{{$c->id}}" class="btn btn-sm btn-danger">Apagar</a>
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
        {{$clubes->links()}}
    </div>
</div>
@endsection