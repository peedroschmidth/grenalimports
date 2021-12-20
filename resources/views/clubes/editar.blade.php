@extends('layouts.app', ["current" => "painel"])

@section('body')

<h1>Editar Clube</h1>
<div class="card border">
    <div class="card-body">
        <form action="/clubes/{{$clube->id}}" method="POST">
            @csrf
            <div class="form-group">

                <label for="nomeClube">Nome do Clube</label>
                <input type="text" class="form-control" name="nomeClube"
                       id="nomeClube" placeholder="Clube" value="{{$clube->nome}}" required>

                <label for="ligaClube">Liga do Clube</label>
                <select name="ligaClube" label="Selecione" required>
                @foreach($liga as $l)
                    <option @if ($clube->liga_id==$l->id) selected value="{{$l->id}}" @endif value="{{$l->id}}">
                        {{ $l->nomeLiga }}
                    </option>
                @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
            <a class="btn btn-danger btn-sm" href="/clubes">Cancel</a>
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
