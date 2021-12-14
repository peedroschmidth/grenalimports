@extends('layouts.app', ["current" => "painel"])

@section('body')
<h1>Editar Descrição</h1>
<div class="card border">
    <div class="card-body">
        <form action="/descricao/{{$descricao->id}}" method="POST">
            @csrf
            <div class="form-group">
                <label for="descricao">Descrição</label>
                <input type="text" class="form-control" name="descricao"
                       id="descricao" placeholder="Descrição" value="{{$descricao->descricao}}">
            </div>
            <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
            <a class="btn btn-danger btn-sm" href="/descricao">Cancelar</a>
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
