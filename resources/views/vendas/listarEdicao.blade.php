<?php
    $status = $encomenda['status'];
?>

@if(count($vendas) > 0)
@if($status<>'A')
<h5> Não é possível incluir itens com a venda nesse status.</h5>
@else
<div>
<form action="/encomendasIncluir" method="POST">
@csrf
<table class="table table-ordered table-hover">
    <thead>
        <tr>
            <th>Selecione</th>
            <th>Cliente</th>
            <th>Descrição</th>
            <th>Tamanho</th>
            <th>Cor</th>
            <th>Personalização</th>
            <th>Clube</th>
            <th>Valor Sinal</th>
        </tr>
        </thead>
        <tbody>
@foreach($vendas as $v)
        <tr>
            <td><input type="checkbox" value="{{$v->id}}" id="{{$v->id}}" name="{{$v->id}}" class="valores" > {{$v->id}}</input></td> 
            <td>{{$v->cliente->nome}}</td>
            <td>{{$v->produto->descricao->descricao}}</td>
            <td>{{$v->produto->tamanho->tamanho}}</td>
            <td>{{$v->produto->cor->cor}}</td>
            <td>{{$v->produto->personalizacao}}</td>
            <td>{{$v->produto->clube->nome}}</td>
            <td>{{$v->valor_sinal}}</td>
        </tr>
@endforeach
        </tbody>
</table>
<table class="table table-ordered">
    <tr>
        <td>Valor diferença:</td>
        <td>
            <input type="number" step="0.01" min="0" max="1000" id="valorPedido" name="valorPedido">    
        </td>
        <td>
            <input type="checkbox" checked style="display:none" id="encomenda_id" name="encomenda_id" value="{{$encomenda['id']}}">
        </td>
        <td>
            <button type="submit" class="btn btn-sm btn-primary" role="button">Encomendar</button>            
        </td>
    </tr>
</table>

</form>
</div>
@endif
@else
<h5> Não há itens para serem encomendados! que tal cadastrar uma nova venda!?</h5>
<a href="/vendas/novo" class="btn btn-sm btn-primary" role="button">Nova Venda</a>

@endif