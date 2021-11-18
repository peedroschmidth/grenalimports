@extends('layouts.app', ["current" => "vendas"])

@section('body')


<h1>Página de Vendas - Todas</h1>
<div class="card border">
    <div class="card-body">
    <a href="/vendas/novo" class="btn btn-sm btn-success" role="button">Nova Venda</a>

    <form action='/vendasRelatorio' method='POST' target='_blank'>
    @csrf
        Data Início: <input type="date" id="dataInicio" name="dataInicio" min="2021-01-01" max="2050-04-30" required>
        Data Fim: <input type="date" id="dataFim" name="dataFim" min="2021-01-01" max="2050-04-30"  required>
        <input type="radio" id="todos" name="tipo" value="todos" checked> <label for="todos"> Todos</label>
        <input type="radio" id="pendentes" name="tipo" value="pendentes"> <label for="pendentes ">Pendentes</label>
        <input type="radio"  id="finalizadas" name="tipo" value="finalizadas"> <label for="finalizadas">Finalizadas</label>
        <button type="submit" class="btn btn-sm btn-primary">Gerar Relatório</button>
    </form>
    
@if(count($vendas) > 0)
        <table class="table table-ordered table-hover" id="minhaTabela2">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Cliente</th>
                    <th>Descrição</th>
                    <th>Tamanho</th>
                    <th>Personalização</th>
                    <th>Clube</th>
                    <th>Valor Pago</th>
                    <th>Valor Total</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
    @foreach($vendas as $v)
                <tr>
                    <td>{{$v->id}}</td>
                    <td>{{$v->cliente->nome}}</td>
                    <td>{{$v->produto->descricao->descricao}}</td>
                    <td>{{$v->produto->tamanho->tamanho}}</td>
                    <td>{{$v->produto->personalizacao}}</td>
                    <td>{{$v->produto->clube->nome}}</td>
                    <td>R$ {{number_format($v->valor_pago,2,",",".")}}</td>
                    <td>R$ {{number_format($v->valor_total,2,",",".")}}</td>
                    <td>
                        <a href="/vendas/editar/{{$v->id}}" class="btn btn-sm btn-primary">Detalhar</a>
                        <a href="/vendas/apagar/{{$v->id}}" class="btn btn-sm btn-danger">Apagar</a>
                    </td>
                </tr>
    @endforeach                
            </tbody>
        </table>
@endif        
    </div>
    <div class="card-footer">
        {{$vendas->links()}}
    </div>
</div>
<script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script>
  $(document).ready(function(){
      $('#minhaTabela2').DataTable({
        "oLanguage": {
            "sLengthMenu": "Mostrar _MENU_ registros por página",
            "sZeroRecords": "Nenhum registro encontrado",
            "sInfo": "Mostrando _START_ / _END_ de _TOTAL_ registro(s)",
            "sInfoEmpty": "Mostrando 0 / 0 de 0 registros",
            "sInfoFiltered": "(filtrado de _MAX_ registros)",
            "sSearch": "Pesquisar: ",
            "oPaginate": {
                "sFirst": "Início",
                "sPrevious": "Anterior",
                "sNext": "Próximo",
                "sLast": "Último"
            }
        },

        });
  });
  </script>
  
@endsection