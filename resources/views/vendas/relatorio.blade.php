<?php
    $total = 0;
    $totalReceber = 0;
    $totalRecebido = 0;
    $haver = 0;

    foreach($vendas as $v){
        $total ++;
        $totalReceber = $totalReceber + $v->valor_total;
        $totalRecebido = $totalRecebido + $v->valor_pago;
    }
    $haver = $totalReceber - $totalRecebido;

    $dIni=date_create($dataIni);
    $dFim=date_create($dataFim);

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

        <h1>Grenal Imports - Relatório de Vendas</h1>
        <h3>Data: De {{date_format($dIni,"d/m/Y")}} à {{date_format($dFim,"d/m/Y")}}</h3>

        <h5>Total de vendas: {{$total}}</h5>
        <h5>Total a receber: R$ {{number_format($totalReceber,2,",",".")}}</h5>
        <h5>Total recebido: R$ {{number_format($totalRecebido,2,",",".")}}</h5>
        <h5>Total em haver: R$ {{number_format($haver,2,",",".")}}</h5>


        @foreach($vendas as $v)


        <?php
            $cliente = DB::select('select nome from clientes c where c.id = ?', [$v->cliente_id]);
            $pag = DB::select('select * from pagamentos p where p.venda_id = ?', [$v->id]);
        ?>

        <table class="table table-sm" style="border: 1px solid black" align="center" width="98%">
        <thead>
            <tr width="100%" ><th><h4>Cliente: </th><th>{{$cliente[0]->nome}}</h4></th></tr>
                <tr align='center' style="align:center">

                    <th>Clube</th>
                    <th>Personalização</th>
                    <th>Descrição</th>
                    <th>Cor</th>
                    <th>Tamanho</th>
                    <th>Data Venda</th>
                </tr>

            </thead>

            <tbody>
                <tr align="center" width="100%">

                    <?php
                        $produto = DB::select('select * from vendas v where v.id = ?', [$v->id]);
                        //dd($produto);

                        foreach($produto as $p){
                            $prod = DB::select("select * from produtos where id=?",[$produto[0]->produto_id]);

                            $clube = DB::select('select nome from clubes where id = ?',[$prod[0]->clube_id]);
                            $descricao = DB::select('select descricao from descricaos where id = ?', [$prod[0]->descricao_id]);
                            $tamanho = DB::select('select tamanho from tamanhos where id = ?', [$prod[0]->tamanho_id]);
                            $cor = DB::select('select cor from cors where id = ?', [$prod[0]->cor_id]);


                        }
                        echo "<td>".$clube[0]->nome."</td>";
                        echo "<td>".$prod[0]->personalizacao."</td>";
                        echo "<td>".$descricao[0]->descricao."</td>";
                        echo "<td>".$cor[0]->cor."</td>";
                        echo "<td>".$tamanho[0]->tamanho."</td>";
                        $date=date_create($v->created_at);
                        echo "<td>".date_format($date,"d/m/Y")."</td>";

                    ?>
                </tr>

            </tbody>


            <thead>
                <tr>
                    <th>Valor Pago:</th> <th>R$ {{number_format($v->valor_pago,2,",",".")}} </th>
                    <th>Valor Total:</th> <th>R$ {{number_format($v->valor_total,2,",",".")}} </th>
                    <th style="color:red">Valor Restante:</th> <th style="color: red">R$ {{number_format($v->valor_total - $v->valor_pago,2,",",".")}}</th>
                </tr>
                    </thead>

                    <thead>
                    <tr>
                        <th>Histórico: </th>
                    </tr>
            </thead>
            @foreach($pag as $p)
            <?php
                $date=date_create($p->created_at);
            ?>
                <tr width="100%">
                    <td><b>Data:</b></td> <td>{{date_format($date,"d/m/Y")}}</td>
                    <td><b>Valor:</b></td> <td>R$ {{number_format($p->valor,2,",",".")}}</td>
                    <td><b>Descrição:</b></td> <td> {{$p->descricao}}</td>
                </tr>
            @endforeach
            </table>
            <br>
            @endforeach



    </body>
</html>
