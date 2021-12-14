@extends('layouts.app', ["current" => "painel"])

@section('body')
<h1>Editar Tamanho</h1>
<div class="card border">
    <div class="card-body">
        <form action="/tamanhos/{{$tamanho->id}}" method="POST">
            @csrf
            <div class="form-group">
                <label for="tamanho">Tamanho</label>
                <input type="text" class="form-control" name="tamanho"
                       id="tamanho" placeholder="Tamanho" value="{{$tamanho->tamanho}}">
            </div>
            <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
            <a class="btn btn-danger btn-sm" href="/tamanhos">Cancelar</a>
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
