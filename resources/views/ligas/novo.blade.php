@extends('layouts.app', ["current" => "painel"])

@section('body')
<h1>Nova Liga</h1>
<div class="card border">
    <div class="card-body">
        <form action="/ligas" method="POST">
            @csrf
            <div class="form-group">
                <label for="nomeLiga">Nome da Liga</label>
                <input type="text" class="form-control" name="nomeLiga"
                       id="nomeLiga" placeholder="Liga" required>
            </div>
            <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
            <a class="btn btn-danger btn-sm" href="/ligas">Cancelar</a>
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
