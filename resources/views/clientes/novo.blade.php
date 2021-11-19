@extends('layouts.app', ["current" => "clientes"])

@section('body')
<h1>Novo Cliente</h1>
<div class="card border">
    <div class="card-body">
        <form action="/clientes" method="POST">
            @csrf
            <div class="form-group">
                <label for="nomeCliente">Nome do Cliente</label>
                <input type="text" class="form-control" name="nomeCliente" id="nomeCliente" placeholder="Nome" required>

                <label for="apelidoCliente">Apelido</label>
                <input type="text" class="form-control" name="apelidoCliente" id="apelidoCliente" placeholder="Apelido">

                <label for="emailCliente">E-mail</label>
                <input type="mail" class="form-control" name="emailCliente" id="emailCliente" placeholder="E-mail">

                <label for="telefoneCliente">Telefone</label>
                <input type="text" class="form-control" name="telefoneCliente" id="telefoneCliente" placeholder="Telefone" required>

                <label for="enderecoCliente">Endereço</label>
                <input type="text" class="form-control" name="enderecoCliente" id="enderecoCliente" placeholder="Rua da Figuera,30">

                <label for="cidadeCliente">Cidade</label>
                <input type="text" class="form-control" name="cidadeCliente" id="cidadeCliente" placeholder="Cidade" required>

                <label for="estadoCliente">Estado</label>
                <br>
                <select name="estadoCliente" label="Selecione" required>
                    <option value="">Selecione o estado</option>
                    <option value="AC">AC</option>
                    <option value="AL">AL</option>
                    <option value="AP">AP</option>
                    <option value="AM">AM</option>
                    <option value="BA">BA</option>
                    <option value="CE">CE</option>
                    <option value="DF">DF</option>
                    <option value="ES">ES</option>
                    <option value="GO">GO</option>
                    <option value="MA">MA</option>
                    <option value="MT">MT</option>
                    <option value="MS">MS</option>
                    <option value="MG">MG</option>
                    <option value="PA">PA</option>
                    <option value="PB">PB</option>
                    <option value="PR">PR</option>
                    <option value="PE">PE</option>
                    <option value="PI">PI</option>
                    <option value="RJ">RJ</option>
                    <option value="RN">RN</option>
                    <option value="RS">RS</option>
                    <option value="R0">RO</option>
                    <option value="RR">RR</option>
                    <option value="SC">SC</option>
                    <option value="SP">SP</option>
                    <option value="SE">SE</option>
                    <option value="TO">TO</option>
                </select>
                <br>

                <label for="cepCliente">CEP</label>
                <input type="text" class="form-control" name="cepCliente" id="cepCliente" placeholder="CEP">            
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