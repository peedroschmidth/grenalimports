<?php
$fornecedores = DB::select('select * from fornecedors');
        
$clientes = DB::table('clientes')
->join('vendas','vendas.cliente_id','=','clientes.id')
->where('vendas.status','=', 'A')
->select('clientes.*')
->groupBy('clientes.id');

?>

@if(count($vendas) > 0)
<div>
  <h3>Encomendar</h3>
<form action="/encomendasCriar" method="POST">
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
            <td><input type="checkbox" value="{{$v->valor_total}}" id="{{$v->id}}" name="{{$v->id}}" class="valores" ></input></td> 
            <td>{{$v->cliente->nome}}</td>
            <td>{{$v->produto->descricao->descricao}}</td>
            <td>{{$v->produto->tamanho->tamanho}}</td>
            <td>{{$v->produto->cor->cor}}</td>
            <td>{{$v->produto->personalizacao}}</td>
            <td>{{$v->produto->clube->nome}}</td>
            <td>R$ {{number_format($v->valor_sinal,2,",",".")}}</td>
        </tr>
@endforeach
        </tbody>
</table>
<table class="table table-ordered">
    <tr>
        <td> Fornecedor: </td>
        <td>
            <select name="fornecedorEncomenda" label="Selecione" id="fornecedorEncomenda">
                <option value="">Selecione um fornecedor</option>  
                @foreach($fornecedores as $f)
                <option value="{{$f->id}}">{{$f->nome}}</option>
                @endforeach
            </select> 
        </td>
        <td> Endereço: </td>
        <td>
            <select name="enderecoEncomenda" label="Selecione" id="enderecoEncomenda">
                <option value="">Selecione o endereço</option>
                @foreach($vendas as $v)
                <option value="{{$v->id}}">{{$v->cliente->nome}}</option>
                @endforeach
            </select> 
        </td>
    </tr>
    <tr>
        <td>Valor do pedido: </td>
        <td>
            <input type="number" step="0.01" min="0" max="1000" id="valorPedido" name="valorPedido">    
        </td>
        <td>Valor projetado: </td>
        <td><input type="text" id="resultado" value="0" name="valorProjetado" readonly></td>
    </tr>
    <tr>
      <td>Código da encomenda: </td>
      <td><input type="text" id="codigoEncomenda" name="codigoEncomenda"></td>
      <td><button type="submit" class="btn btn-sm btn-primary" role="button">Encomendar</button></td>
    </tr>
</table>


</form>
</div>
@else
<h5> Não há itens para serem encomendados! que tal cadastrar uma nova venda!?</h5>
<a href="/vendas/novo" class="btn btn-sm btn-primary" role="button">Nova Venda</a>

@endif
<div>
    <!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

</div>
<script>
jQuery(function() {
  $(document).ready(function() {
    $(".valores").change(function() {
      var total = $('input[class="valores"]:checked').get().reduce(function(tot, el) {
        return tot + Number(el.value);
      }, 0);
      $('#resultado').val(total);
    });
  });
});
$('#myModal').on('shown.bs.modal', function () {
  $('#myInput').trigger('focus')
})
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
