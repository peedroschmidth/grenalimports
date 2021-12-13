<div>
    <form action="/contabilidade/adicionar" method="POST">
    @csrf
        <table class="table table-ordered table-hover">
            <td>Descrição: <input type="text" name="descricaoPagamento" id="descricaoPagamento"> </input></td>
            <td>Valor: <input type="number" name="valorPagamento" id="valorPagamento" step="0.01" min="0" max="1000"> </input></td>

            <td>
            <input type="radio" id="entrada" name="tipoPagamento" value="entrada" checked>
            <label for="entrada">Entrada</label>

            <input type="radio" id="saida" name="tipoPagamento" value="saida">
            <label for="saida">Saída</label><br>
            </td>

            <td><button type="submit" class="btn btn-sm btn-primary" role="button">Confirmar</button></td>
        </table>
    </form>
</div>
