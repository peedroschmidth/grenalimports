<?php
$pag = DB::select('select * from pagamentos where venda_id = ? order by created_at desc', [$venda->id]);
$valorRestante = $venda->valor_total - $venda->valor_pago;
?>

<div>

    <h3> Informações Pagamento </h3>
    <table class="table table-ordered ">
        <td><b>Valor Total:</b> R$ {{$venda->valor_total}}</td>
        <td><b>Valor Sinal:</b>  R$ {{$venda->valor_sinal}}</td>
        <td><b>Valor Pago:</b>  R$ {{$venda->valor_pago}}</td>
        <td style="color:red">Valor Restante:  R$ {{$valorRestante}}</td>
    </table>
    @if($venda->status=="F")
        <h1></h1>
    @else
    <form action="/contabilidade/adicionar/{{$venda->id}}" method="POST">
    @csrf
    <h3> Receber Pagamento </h3>
        <table class="table table-ordered table-hover">
            <td>Valor: <input type="number" name="valorPagamento" id="valorPagamento" step="0.01" min="0" max="1000"> </input></td>
            
            <td>
            <input type="checkbox" id="finalizada" name="finalizada" value="finalizada">
            <label for="finalizada">Finalizar</label>
            </td>
            
            <td><button type="submit" class="btn btn-sm btn-primary" role="button">Receber</button></td>
        </table>
    </form>
    @endif

    <h3>Histórico Pagamento</h3>
    <table class="table table-ordered ">
    @foreach($pag as $p)
        <tr>
            <td><b>Data:</b> {{$p->created_at}}</td>
            <td><b>Valor:</b> R$ {{number_format($p->valor,2,",",".")}}</td>
            <td><b>Descrição:</b> {{$p->descricao}}</td>
        </tr>
    @endforeach
    </table>
</div>