@extends('layouts.app', ["current" => "encomendas"])

@section('body')

@if (session('alert'))
    <div class="alert alert-danger">
        {{ session('alert') }}
    </div>
@endif

<h1>Página de Encomendas - Todas</h1>
<div class="card border">
    <div class="card-body">
    <a href="/encomendas/novo" class="btn btn-sm btn-primary" role="button">Nova Encomenda</a>

@if(count($encomendas) > 0)
        <table class="table table-ordered table-hover" id="minhaTabela2">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Fornecedor</th>
                    <th>Valor</th>
                    <th>Rastreio</th>
                    <th>Código</th>
                    <th>Status</th>
                    <th>Data</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
    @foreach($encomendas as $e)
                <tr>
                    <td>{{$e->id}}</td>
                    <td>{{$e->fornecedor->nome}}</td>
                    <td>R$ {{number_format($e->valor_encomenda,2,",",".")}}</td>
                    <td>{{$e->rastreio}}</td>
                    <td>{{$e->codigo_encomenda}}</td>
                    <td>{{$e->status}}</td>
                    <td>{{$e->created_at}}</td>
                    <td>
                        <a href="/encomendas/editar/{{$e->id}}" class="btn btn-sm btn-primary">Detalhar</a>
                        <a href="/encomendas/apagar/{{$e->id}}" class="btn btn-sm btn-danger">Apagar</a>
                    </td>
                </tr>
    @endforeach
            </tbody>
        </table>
@else
<h4>Você não possuí encomendas!</h4>
@endif
   </div>
<div class="card-footer">
        {{$encomendas->links()}}
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
