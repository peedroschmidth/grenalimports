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
        <h3>Data: De {{$dataIni}} à {{$dataFim}}</h3>
        
        <h5>Total de vendas: {{$total}}</h5>
        <h5>Total a receber: R$ {{$totalReceber}}</h5>
        <h5>Total recebido: R$ {{$totalRecebido}}</h5>
        <h5>Total em haver: R$ {{$haver}}</h5>
        
        
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
                        echo "<td>$v->created_at</td>";

                    ?>
                </tr>

            </tbody>
            
                       
            <thead>
                <tr>
                    <th>Valor Pago:</th> <th>R$ {{$v->valor_pago}} </th>
                    <th>Valor Total:</th> <th>R$ {{$v->valor_total}} </th>
                    <th style="color:red">Valor Restante:</th> <th style="color: red">R$ {{$v->valor_total - $v->valor_pago}}</th>
                </tr>
                    </thead>

                    <thead>
                    <tr>
                        <th>Histórico: </th>
                    </tr>
            </thead>
            @foreach($pag as $p)
                <tr width="100%">
                    <td><b>Data:</b></td> <td>{{$p->created_at}}</td>
                    <td><b>Valor:</b></td> <td>R$ {{$p->valor}}</td>
                    <td><b>Descrição:</b></td> <td> {{$p->descricao}}</td>
                </tr>
            @endforeach
            </table>
            <br>
            @endforeach
            
            
        
    </body>
</html>