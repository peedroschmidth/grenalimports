@extends('layouts.app', ["current" => "fornecedores"])

@section('body')
<h1>Editar Liga</h1>
<div class="card border">
    <div class="card-body">
        <form action="/fornecedores/{{$fornecedor->id}}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nomeFornecedor">Nome da Liga</label>
                <input type="text" class="form-control" name="nomeFornecedor" 
                       id="nomeFornecedor" placeholder="Fornecedor" value="{{$fornecedor->nome}}" required>
            </div>
            <div class="form-group">
                <label for="contatoFornecedor">Nome da Liga</label>
                <input type="text" class="form-control" name="contatoFornecedor" 
                       id="contatoFornecedor" placeholder="Contato" value="{{$fornecedor->contato}}" required>
            </div>
            <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
            <a class="btn btn-danger btn-sm" href="/fornecedores">Cancelar</a>
        </form>
    </div>
</div>

@if($errors->any())
<div class="card-footer">
    @foreach($errors->all() as $e)
        <div class="alert alert-danger" role="alert">
            {{$e}}
        </div>
    @endforeach
</div>
@endif

@endsection