@extends('layouts.app', ["current" => "estoque"])

@section('body')

<h1>Nova Venda - Produto em Estoque</h1>
<div class="card border">
    <div class="card-body">

        <form action="/estoque/confirmar/{{$produto->id}}" method="POST">
        @csrf
            <table class="table table-ordered table-hover">
                <div class="form-group">
                <tr> 
                    <td>
                    <input type="checkbox" checked disabled name="estoque" id="estoque" value="1"></input>
                        <label for="descricaoProduto">Descrição</label>
                        <select name="descricaoProduto" id="descricaoProduto" label="selecione" class="selectpicker" disabled>
                            <option value="">Selecione</option>
                            @foreach($descricao as $d)
                            <option @if ($produto->descricao_id == $d->id) selected value="{{$d->id}}" @endif value="{{$d->id}}">
                            {{ $d->descricao }}
                            </option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input type="checkbox" checked disabled name="estoque" id="estoque" value="1">
                        <label for="estoque"> Estoque</label><br>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="personalizacaoProduto">Personalização</label>
                        <input type="text" class="form-control" name="personalizacaoProduto" 
                        id="personalizacaoProduto" placeholder="Personalização" value="{{$produto->personalizacao}}">
                    </td>  

                    <td>
                        <label for="observacaoProduto">Observação</label>
                        <input type="text" class="form-control" name="observacaoProduto" 
                        id="observacaoProduto" placeholder="Observação" value="{{$produto->observacao}}">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="clubeProduto">Clube: </label>
                        <select disabled name="clubeProduto" id="clubeProduto" label="selecione" class="selectpicker" disabled>
                            <option value="">Selecione</option>
                            @foreach($clube as $c)
                            <option @if ($produto->clube_id == $c->id) selected value="{{$c->id}}" @endif value="{{$c->id}}">
                            {{ $c->nome }}
                            </option>
                            @endforeach
                        </select>
                        <br>
                        <label>Gênero:</label>
                        <input disabled @if($produto->genero == 1) checked type="radio" id="masculino" name="generoProduto" value="masculino" @endif type="radio" id="masculino" name="generoProduto" value="masculino" >
                        <label for="masculino">Masculino</label>

                        <input disabled @if($produto->genero == 0) checked type="radio" id="feminino" name="generoProduto" value="feminino" @endif type="radio" id="feminino" name="generoProduto" value="feminino" >
                        <label for="feminino">Feminino</label><br>
                        
                        <label for="corProduto">Cor</label>
                        <select disabled name="corProduto" id="corProduto" label="selecione" class="selectpicker">
                            <option value="">Selecione</option>
                            @foreach($cor as $c)
                            <option @if ($produto->cor_id == $c->id) selected value="{{$c->id}}" @endif value="{{$c->id}}">
                            {{ $c->cor }}
                            </option>
                            @endforeach
                        </select>
                        <br>
                        <label for="anoProduto">Ano</label>
                        <input disabled type="number" min="1900" max="3000"step="1" value="2021" id="anoProduto" name="anoProduto">
                        <br>
                        <label for="tamanhoProduto">Tamanho</label>
                        <select disabled name="tamanhoProduto" id="tamanhoProduto" label="selecione" class="selectpicker">
                            <option value="">Selecione</option>
                            @foreach($tamanho as $t)
                            <option @if ($produto->tamanho_id == $t->id) selected value="{{$t->id}}" @endif value="{{$t->id}}">
                            {{ $t->tamanho }}
                            </option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <label for="clienteProduto">Cliente</label>
                        <select name="clienteProduto" id="clienteProduto" label="selecione" class="selectpicker">
                            <option value="">Selecione</option>
                            @foreach($cliente as $c)
                            <option value="{{ $c->id }}">{{ $c->nome }}</option>
                            @endforeach
                        </select>
                        <br>
                        <label for="valorTotal" >Valor Total: </label>
                        <input type="number" step="0.01" min="0" max="1000" id="valorTotal" name="valorTotal" placeholder="R$139.99">

                        <br>
                        <label for="valorSinal">Valor Sinal: </label>
                        <input type="number" step="0.01" min="0" max="1000" id="valorSinal" name="valorSinal" placeholder="R$49.99"> 
                </div>
                <br><br>
                <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
                <a class="btn btn-danger btn-sm" href="/estoque">Cancelar</a>
                </td>
            </form>
        </tr>
     </table>
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
</div>
@endsection