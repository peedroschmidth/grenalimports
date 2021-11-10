@extends('layouts.app', ["current" => "encomendas"])

@section('body')

<?php
 $encomenda_id = $encomenda['id'];
 $rastreio = $encomenda['rastreio'];
 $codigo = $encomenda['codigo_encomenda'];
?>
<h1>Detalhes da Encomenda</h1>
<table class="table table-ordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Rastreio</th>
            <th>Código</th>
            <th>Valor Encomenda</th>
            <th>Status</th>
            <th>Fornecedor</th>
        </tr>
    </thead>
<?php

echo "<tbody><tr>";    

    echo "<td>".$encomenda['id'];
    echo "</td><td>".$encomenda['rastreio'];
    echo "</td><td>".$encomenda['codigo_encomenda'];
    echo "</td><td>".$encomenda['valor_encomenda'];
    echo "</td><td>".$encomenda['status'];
    echo"</td><td>";
    foreach($fornecedor as $f){
        echo $f->nome;
    }
    echo "</td></tr/</tbody></table>"
?>
<h5> Editar encomenda: </h5>
<form action="/encomendas/{{$encomenda_id}}" method="POST">
@csrf
    <table class="table table-ordered">
        <td><label for="rastreio">Rastreio: </label></td>
        <td><input type="text" value="{{$rastreio}}" id="rastreio" name="rastreio"></input></td>
        <td><label for="codigo">Código: </label></td>
        <td><input type="numeric" value="{{$codigo}}" id="codigo" name="codigo"></input></td>
        <td><button type="submit" class="btn btn-primary">Atualizar</a></td>
    </table>
</form>

@if(count($venda) > 0)
<h3>Detalhes dos itens:</h3>
<table class="table table-ordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Cliente</th>
            <th>Descrição</th>
            <th>Tamanho</th>
            <th>Personalização</th>
            <th>Clube</th>
            <th>Valor Sinal</th>
            <th>Valor Total</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
@foreach($venda as $v)
    <tr>
        <td>{{$v->id}}</td>
        <td>{{$v->cliente->nome}}</td>
        <td>{{$v->produto->descricao->descricao}}</td>
        <td>{{$v->produto->tamanho->tamanho}}</td>
        <td>{{$v->produto->personalizacao}}</td>
        <td>{{$v->produto->clube->nome}}</td>
        <td>{{$v->valor_sinal}}</td>
        <td>{{$v->valor_total}}</td>
        <td>
            <a href="/vendas/editar/{{$v->id}}" class="btn btn-sm btn-primary">Editar</a>
            <a href="/encomendas/removerItem/{{$v->id}}" class="btn btn-sm btn-danger">Remover</a>
        </td>
    </tr>
@endforeach
        
    </tbody>
</table>
@else
<h4>Não há itens encomendados nesta encomenda, comece adicionando um!</h4>
@endif


<button id="btn_mostra" onClick="mostraDiv('listaVendas')" class="btn btn-sm btn-primary">Adicionar Item</button>
<br>
<div class="jumbotron bg-light border border-secondary" style='display:none;"' id="listaVendas">
@component('vendas.listarEdicao', compact('vendas','encomenda'))
@endcomponent
</div>
@endsection 

<script>
function mostraDiv(listaVendas) {
        var display = document.getElementById(listaVendas).style.display;
        if(display == "none")
            document.getElementById(listaVendas).style.display = 'block';
            //document.getElementById('btn_mostra').text = "Fechar";
            
        else
            
            document.getElementById(listaVendas).style.display = 'none';
    }
</script>