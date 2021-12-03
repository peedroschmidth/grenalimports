@extends('layouts.app', ["current" => "painel"])

@section('body')
@if (session('alert'))
    <div class="alert alert-danger">
        {{ session('alert') }}
    </div>
@endif
<h1>Página de Clubes</h1>
<div class="card border">
    <div class="card-body">
    <a href="/clubes/novo" class="btn btn-sm btn-primary" role="button">Novo Clube</a>

@if(count($clubes) > 0)
        <table class="table table-ordered table-hover" id="minhaTabela">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nome do Clube</th>
                    <th>Liga</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
    @foreach($clubes as $c)
                <tr>
                    <td>{{$c->id}}</td>
                    <td>{{$c->nome}}</td>
                    <td>{{$c->liga->nomeLiga}}</td>
                    <td>
                        <a href="/clubes/editar/{{$c->id}}" class="btn btn-sm btn-primary">Editar</a>
                        <a href="/clubes/apagar/{{$c->id}}" class="btn btn-sm btn-danger">Apagar</a>
                    </td>
                </tr>
    @endforeach
            </tbody>
        </table>
@else
    <h4>Você não possuí ligas cadastradas, comece cadastrando uma!</h4>
@endif
    </div>
    <div class="card-footer">
        {{$clubes->links()}}
    </div>
</div>


<script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>

  <script>
  $(document).ready(function(){
      $('#minhaTabela').DataTable({
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
