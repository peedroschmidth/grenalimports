@if($count==0)

<script>alert("Selecione ao menos um produto para ser encomendado!")</script>
<script>window.location.assign("/")</script>
@else

@extends('layouts.app', ['current' => "encomendas"])
@section('body')

<?php
echo "<form action='/encomendas' method='POST'>".
        "<div> ";
    ?>
    @csrf
    <?php

    $idendereco = $req['enderecoEncomenda'];
    $valorPedido = $req['valorPedido'];
    $codigoEncomenda = $req['codigoEncomenda'];
    $forn = $req['fornecedorEncomenda'];
    $fornecedor = DB::select('select nome from fornecedors where id= ?', [$forn]);
 
    echo "<table class='table table-ordered table-hover' style='border:1px solid black'>".
    "<thead>".
        "<tr>".
            "<th>ID</th>".
            "<th>Valor Sinal</th>".
            "<th>Valor Total</th>".
            "<th>Cliente</th>".
            "<th>Descrição</th>".
            "<th>Tamanho</th>".
            "<th>Cor</th>".
            "<th>Personalização</th>".
            "<th>Clube</th>".
        "</tr>".
        "</thead>".
        "<tbody>";
    foreach($req as $r => $v){
        if (is_numeric($r)) {
            $result = DB::select('select * from vendas where id=?', [$r]);
            foreach($result as $res){
                echo "<tr>";
                echo "<td><input type='checkbox' checked style='display: none;' id ='$res->id' value='$res->id' name='$res->id' >".$res->id."</input></td>";
                echo "<td>R$ ".number_format($res->valor_sinal,2,",",".")."</td>";
                echo "<td>R$ ".number_format($res->valor_total,2,",",".")."</td>";
                $cliente = DB::select('select * from clientes where id=?', [$res->cliente_id]);
                $produto = DB::select('select * from produtos where id=?', [$res->produto_id]);
                foreach($cliente as $cli){{
                    echo "<td>".$cli->nome."</td>";
                }
                foreach($produto as $prod){
                    $descricao = DB::select('select * from descricaos where id=?', [$prod->descricao_id]);
                    $cor = DB::select('select * from cors where id=?', [$prod->cor_id]);
                    $tamanho = DB::select('select * from tamanhos where id=?', [$prod->tamanho_id]);
                    $clube = DB::select('select * from clubes where id=?', [$prod->clube_id]);
                    
                    foreach ($descricao as $d){
                        echo "<td>".$d->descricao."</td>";
                    }
                    foreach ($tamanho as $t){
                        echo "<td>".$t->tamanho."</td>";
                    }
                    foreach ($cor as $c){
                        echo "<td>".$c->cor."</td>";

                    echo "<td>".$prod->personalizacao."</td>";
                    foreach ($clube as $c){
                        echo "<td>".$c->nome."</td>";
                    }
                }
                echo "</tr>";
            }
            }
        }
    }
}
echo "</table></div>";
//<p> QUANDO CLICAR NO CONFIRMAR, DEVERÁ DISPARAR A AÇÃO DE REALIZAR A ENCOMENDA E PREENCHER A COLUNA ENCOMENDA_ID NAS LINHAS "$V" MESMA COISA DO SELECT E DEPOIS REDIRECIONAR PARA UMA TELA TIPO "SHOW", PARA SER POSSÍVEL VALIDAR AS INFORMAÇÕES DA COMPRA . DETALHE, DEVE SER PRIMEIRO FEITO A ENCOMENDA, E COM O ENCOMEDA->ID PREENCHER A TABELA VENDAS (ENCMENDA_ID)</p>

?>

<table class="table table-ordered align-center">
<tr>
    <td>Fornecedor: </td>
    <td><input type="checkbox" style="display:none;" id ="fornecedorEncomenda" name="fornecedorEncomenda" value="{{$forn}}" checked>{{$fornecedor[0]->nome}}</input></td>
</tr>
<tr>
    <td>Valor do pedido(com desconto): </td> 
    <td><input type="text" style="display:none;" id="valorEncomenda" name="valorEncomenda" value="{{$valorPedido}}">R$ {{number_format($valorPedido,2,",",".")}}</td>
    
</tr>
<tr>
    <td>Código da encomenda: </td> 
    <td><input type="text" style="display:none;" checked id="codigoEncomenda" name="codigoEncomenda" value="{{$codigoEncomenda}}">{{$codigoEncomenda}}</td>
</tr>
<tr>
    <td>Endereço de entrega:</td>
    <td>
@isset($idendereco)
@foreach($endereco as $e)
    Endereço: {{$e->endereco}} | Cidade: {{$e->cidade}} | Estado: {{$e->estado}} | CEP: {{$e->cep}}
@endforeach
@endisset

@empty($idendereco)
<?php 
    echo "<p> Endereço: ".$endereco['endereco']." | Cidade: ".$endereco['cidade']." | Estado: ".$endereco['estado']." | CEP: ".$endereco['cep']."<p>"; //| Cidade: {{$e->cidade}} | Estado: {{$e->estado}} | CEP: {{$e->cep}}
?>
@endempty
    </td>
</tr>
<tr>
<td>
<h3> Confirmação de Encomenda:</h3>
<h5> Você realmente confirma a encomenda dos itens acima?</h5>
</td>
<td>
<br>
<center>
<button type="submit" class="btn btn-sm btn-primary" style=" margin: 0 auto; width:140px ">Confirmar</button>
<a center class="btn btn-danger btn-sm" href="/" style=" margin: 0 auto; width:140px ">Voltar</a>
</center>
</td>
</table>
</form>
@endsection
@endif