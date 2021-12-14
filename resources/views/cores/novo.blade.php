@extends('layouts.app', ["current" => "painel"])

@section('body')
<h1>Nova Cor</h1>
<div class="card border">
    <div class="card-body">
        <form action="/cores" method="POST">
            @csrf
            <div class="form-group">
                <label for="cores">Cor</label>
                <input type="text" class="form-control" name="cores"
                       id="cores" placeholder="Cor" required>
            </div>
            <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
            <a class="btn btn-danger btn-sm" href="/cores">Cancelar</a>
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
