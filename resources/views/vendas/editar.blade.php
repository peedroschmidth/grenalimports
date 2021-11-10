@extends('layouts.app', ["current" => "vendas"])

@section('body')

<button id="btn_mostra" onClick="mostraDiv('adicionarContabilidade')" class="btn btn-sm btn-primary">Pagamento</button>
<div class="jumbotron bg-light border border-secondary" style="display:none;" id="adicionarContabilidade">
@component('contabilidades.pagamento', compact('venda'))
@endcomponent
</div>


<h1>Editar Venda</h1>
<div class="card border">


    <div class="card-body">
        <form action="/vendas/{{$venda->id}}" method="POST">
        <table class="table table-ordered table-hover">
            @csrf
            <div class="form-group">
            <tr> 
                    <td>
            <label for="descricaoProduto">Descrição</label>
                <select name="descricaoProduto" id="descricaoProduto" label="selecione" class="selectpicker">
                <option value="">Selecione</option>
                @foreach($descricao as $d)
                <option @if ($venda->produto->descricao_id == $d->id) selected value="{{$d->id}}" @endif value="{{$d->id}}">
                    {{ $d->descricao }}
                </option>
                @endforeach
                </select>
                </td>
                    <td>
                        <input type="checkbox" name="estoque" id="estoque" value="1" @if ($venda->produto->estoque == 1) checked @endif >
                        <label for="estoque"> Estoque</label></br>
                </td>
</tr>
<tr>
    <td>
                <label for="personalizacaoProduto">Personalização</label>
                <input type="text" class="form-control" name="personalizacaoProduto" 
                id="personalizacaoProduto" placeholder="Personalização" value="{{$venda->produto->personalizacao}}" >
            </td>
            <td>
                <label for="observacaoProduto">Observação</label>
                <input type="text" class="form-control" name="observacaoProduto" 
                id="observacaoProduto" placeholder="Observação" value="{{$venda->produto->observacao}}">
</td>
</tr>
<tr>
    <td>
                <label for="clubeProduto">Clube: </label>
                <select name="clubeProduto" id="clubeProduto" label="selecione" >
                <option value="">Selecione</option>
                @foreach($clube as $c)
                    <option @if ($venda->produto->clube_id == $c->id) selected value="{{$c->id}}" @endif value="{{$c->id}}">
                        {{ $c->nome }}
                    </option>
                @endforeach
                </select>

                <br>
                <label>Gênero:</label>

                <input type="radio" id="masculino" name="generoProduto" value="masculino" checked>
                <label for="masculino">Masculino</label>

                <input type="radio" id="feminino" name="generoProduto" value="feminino">
                <label for="feminino">Feminino</label><br>


                <label for="corProduto">Cor: </label>
                <select name="corProduto" id="corProduto" label="selecione" >
                <option value="">Selecione</option>
                @foreach($cor as $c)
                    <option @if ($venda->produto->cor_id == $c->id) selected value="{{$c->id}}" @endif value="{{$c->id}}">
                        {{ $c->cor }}
                    </option>
                @endforeach
                </select>

                <br>
                <label for="anoProduto">Ano</label>
                <input type="number" min="1900" max="3000"step="1" value="2021" id="anoProduto" name="anoProduto">
                <br>

                <label for="tamanhoProduto">Tamanho: </label>
                <select name="tamanhoProduto" id="tamanhoProduto" label="selecione" >
                <option value="">Selecione</option>
                @foreach($tamanho as $t)
                    <option @if ($venda->produto->tamanho_id == $t->id) selected value="{{$t->id}}" @endif value="{{$t->id}}">
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
                    <option @if ($venda->cliente_id == $c->id) selected value="{{$c->id}}" @endif value="{{$c->id}}">
                        {{ $c->nome }}
                    </option>
                    @endforeach
                </select>
                
                <br>
                <label for="valorTotal" >Valor Total: </label>
                <input type="number" step="0.01" min="0" max="1000" id="valorTotal" name="valorTotal" placeholder="R$139.99" value="{{$venda->valor_total}}">
                <br>
                
                <label for="valorSinal">Valor Sinal: </label>
                <input type="number" step="0.01" min="0" max="1000" id="valorSinal" name="valorSinal" placeholder="R$49.99" value="{{$venda->valor_sinal}}"> 
                <br>
            </div>
            <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
            <a class="btn btn-danger btn-sm" href="/vendas">Cancel</a>
</td>
        </form>
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

<script>
function mostraDiv(adicionarContabilidade) {
        var display = document.getElementById(adicionarContabilidade).style.display;
        if(display == 'none'){
            document.getElementById(adicionarContabilidade).style.display = 'block';
        }
        else{
            document.getElementById(adicionarContabilidade).style.display = 'none';
        }
}
</script>
