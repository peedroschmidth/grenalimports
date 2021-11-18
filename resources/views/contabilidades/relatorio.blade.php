<?php
$entradas = 0;
$saidas = 0;
    foreach($contab as $c){
        if($c->tipo == "E"){
            $entradas = $entradas + $c->valor;
        } else{
            $saidas = $saidas + $c->valor;
        }
    }
    $lucro = $entradas - $saidas;
?>

<html>
    <head></head>
    <style>
        tr{
            border: 1px solid black;
        }
        img{
            width:70px;
            float: right;
        }
    </style>
    <body>
    <img src="https://i.ibb.co/bKMTnxg/C-pia-de-1623463367144-3.png" alt="Imagem" border="0"><br>

        <h1>Grenal Imports - Relatório de Contabilidades</h1>
        <h3>Data: De {{$dataIni}} à {{$dataFim}}</h3>
        <table class="table table-ordered" style="border: 1px solid black" align="center">
            <thead>
                <tr align='center'>
                    <th>Código</th>
                    <th>Descrição</th>
                    <th>Valor</th>
                    <th>Tipo</th>
                    <th>Cliente</th>
                    <th>Encomenda</th>
                    <th>Data</th>
                </tr>
            </thead>
            <tbody>
            @foreach($contab as $c)
                <tr align="center" >
                <td>{{$c->id}}</td>
                    <td>{{$c->descricao}}</td>
                    <td>R$ {{number_format($c->valor,2,",",".")}}</td>
                    <td @if ($c->tipo=="E") class="circulo" @endif class="circulo2" > {{$c->tipo}}</td>
                    @isset($c->venda_id) 
                        <?php 
                            $cliente = DB::select('select nome from clientes c inner join vendas v on c.id = v.cliente_id where v.id = ?', [$c->venda_id]);
                            foreach($cliente as $cli){
                                echo "<td>$cli->nome</td>";
                            } 
                        ?>
                    @endisset
                    @empty($c->venda_id)
                        <td>-</td>
                    @endempty
                    @isset($c->encomenda_id) 
                        <?php 
                            $fornecedor = DB::select('select nome from fornecedors f inner join encomendas e on e.fornecedor_id = f.id where e.id = ?', [$c->encomenda_id]);
                            foreach($fornecedor as $f){
                                echo "<td>$f->nome</td>";
                            } 
                        ?>
                    @endisset
                    @empty($c->encomenda_id)
                        <td>-</td>
                    @endempty

                    <td>{{$c->created_at}}</td>
                </tr>
            @endforeach
            </tbody>            
        </table>
<table>
<tr>
    <td><b>Entradas:</b> R$ {{number_format($entradas,2,",",".")}} </td>
</tr>
<tr>
    <td><b>Saídas:</b> R$ {{number_format($saidas,2,",",".")}} </td>
</tr>
<tr>
    <td><b>Lucro:</b> R$ {{number_format($lucro,2,",",".")}} </td>
</tr>
</table>
    </body>
</html>