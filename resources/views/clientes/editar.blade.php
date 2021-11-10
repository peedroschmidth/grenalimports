@extends('layouts.app', ["current" => "clientes"])

@section('body')
<h1>Editar Cliente</h1>
<div class="card border">
    <div class="card-body">
        <form action="/clientes/{{$cliente->id}}" method="POST">
            @csrf
            <div class="form-group">
            <label for="nomeCliente">Nome do Cliente</label>
                <input type="text" class="form-control" name="nomeCliente" id="nomeCliente" placeholder="Nome" value="{{$cliente->nome}}">

                <label for="apelidoCliente">Apelido</label>
                <input type="text" class="form-control" name="apelidoCliente" id="apelidoCliente" placeholder="Apelido" value="{{$cliente->apelido}}">

                <label for="emailCliente">E-mail</label>
                <input type="mail" class="form-control" name="emailCliente" id="emailCliente" placeholder="E-mail" value="{{$cliente->email}}">

                <label for="telefoneCliente">Telefone</label>
                <input type="text" class="form-control" name="telefoneCliente" id="telefoneCliente" placeholder="Telefone" value="{{$cliente->telefone}}">

                <label for="enderecoCliente">Endereço</label>
                <input type="text" class="form-control" name="enderecoCliente" id="enderecoCliente" placeholder="Rua da Figuera,30" value="{{$cliente->endereco}}">

                <label for="cidadeCliente">Cidade</label>
                <input type="text" class="form-control" name="cidadeCliente" id="cidadeCliente" placeholder="Cidade" value="{{$cliente->cidade}}">

                <label for="estadoCliente">Estado</label>
                <br>
                <select name="estadoCliente" label="Selecione">

                    <option @if ($cliente->estado=="AC") value="AC" selected @endif value="AC">AC</option>
                    <option @if ($cliente->estado=="AL") value="AL" selected @endif value="AL">AL</option>
                    <option @if ($cliente->estado=="AP") value="AP" selected @endif value="AP">AP</option>
                    <option @if ($cliente->estado=="AM") value="AM" selected @endif value="AM">AM</option>
                    <option @if ($cliente->estado=="BA") value="BA" selected @endif value="BA">BA</option>
                    <option @if ($cliente->estado=="CE") value="CE" selected @endif value="CE">CE</option>
                    <option @if ($cliente->estado=="DF") value="DF" selected @endif value="DF">DF</option>
                    <option @if ($cliente->estado=="ES") value="ES" selected @endif value="ES">ES</option>
                    <option @if ($cliente->estado=="GO") value="GO" selected @endif value="GO">GO</option>
                    <option @if ($cliente->estado=="MA") value="MA" selected @endif value="MA">MA</option>
                    <option @if ($cliente->estado=="MT") value="MT" selected @endif value="MT">MT</option>
                    <option @if ($cliente->estado=="MS") value="MS" selected @endif value="MS">MS</option>
                    <option @if ($cliente->estado=="MG") value="MG" selected @endif value="MG">MG</option>
                    <option @if ($cliente->estado=="PA") value="PA" selected @endif value="PA">PA</option>
                    <option @if ($cliente->estado=="PB") value="PB" selected @endif value="PB">PB</option>
                    <option @if ($cliente->estado=="PR") value="PR" selected @endif value="PR">PR</option>
                    <option @if ($cliente->estado=="PE") value="PE" selected @endif value="PE">PE</option>
                    <option @if ($cliente->estado=="PI") value="PI" selected @endif value="PI">PI</option>
                    <option @if ($cliente->estado=="RJ") value="RJ" selected @endif value="RJ">RJ</option>
                    <option @if ($cliente->estado=="RN") value="RN" selected @endif value="RN">RN</option>
                    <option @if ($cliente->estado=="RS") value="RS" selected @endif value="RS">RS</option>
                    <option @if ($cliente->estado=="R0") value="R0" selected @endif value="R0">RO</option>
                    <option @if ($cliente->estado=="RR") value="RR" selected @endif value="RR">RR</option>
                    <option @if ($cliente->estado=="SC") value="SC" selected @endif value="SC">SC</option>
                    <option @if ($cliente->estado=="SP") value="SP" selected @endif value="SP">SP</option>
                    <option @if ($cliente->estado=="SE") value="SE" selected @endif value="SE">SE</option>
                    <option @if ($cliente->estado=="TO") value="TO" selected @endif value="TO">TO</option>
                </select>
                <br>

                <label for="cepCliente">CEP</label>
                <input type="text" class="form-control" name="cepCliente" id="cepCliente" placeholder="CEP" value="{{$cliente->cep}}">            
            </div>
            <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
            <a class="btn btn-danger btn-sm" href="/clientes">Cancelar</a>
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