@extends('layouts.app', ['current' => "fornecedores"])

@section('body')

@if (session('alert'))
    <div class="alert alert-danger">
        {{ session('alert') }}
    </div>
@endif
<h1>Página de Fornecedores</h1>
<div class="card border">
    <div class="card-body">
    <a href="/fornecedores/novo" class="btn btn-sm btn-primary" role="button">Novo Fornecedor</a>

@if(count($fornecedor) > 0)
        <table class="table table-ordered table-hover">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nome</th>
                    <th>Contato</th>
                    <th>Quantidade Compras</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
    @foreach($fornecedor as $f)
                <tr>
                    <td>{{$f->id}}</td>
                    <td>{{$f->nome}}</td>
                    <td>{{$f->contato}}</td>
                    <td>{{$f->qtdcompras}}</td>
                    <td>
                        <a href="/fornecedores/editar/{{$f->id}}" class="btn btn-sm btn-primary">Editar</a>
                        <a href="/fornecedores/apagar/{{$f->id}}" class="btn btn-sm btn-danger">Apagar</a>
                    </td>
                </tr>
    @endforeach                
            </tbody>
        </table>
@else
<h4>Você não possuí fornecedores cadastrados!</h4>
@endif 
    </div>
    <div class="card-footer">
        {{$fornecedor->links()}}
    </div>
</div>

@endsection