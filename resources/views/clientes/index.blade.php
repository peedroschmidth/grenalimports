@extends('layouts.app', ['current' => "clientes"])

@section('body')

<h1>Página de Clientes</h1>
<div class="card border">
    <div class="card-body">
    <a href="/clientes/novo" class="btn btn-sm btn-primary" role="button">Novo Cliente</a>
    <br>

@if(count($clientes) > 0)
        <table class="table table-ordered table-hover" id="minhaTabela">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Apelido</th>
                    <th>Telefone</tb>
                    <th>Endereço</tb>
                    <th>Cidade</th>
                    <th>Quantidade Compras</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
    @foreach($clientes as $c)
                <tr>
                    <td>{{$c->nome}}</td>
                    <td>{{$c->apelido}}</td>
                    <td>{{$c->telefone}}</td>
                    <td>{{$c->endereco}}</td>
                    <td>{{$c->cidade}}</td>
                    <td>{{$c->qtdcompras}}</td>
                    <td>
                        <a href="/clientes/editar/{{$c->id}}" class="btn btn-sm btn-primary">Editar</a>
                        <a href="/clientes/apagar/{{$c->id}}" class="btn btn-sm btn-danger">Apagar</a>
                    </td>
                </tr>
    @endforeach                
            </tbody>
        </table>
@else
<h4>Você não possuí clientes cadastrados!</h4>
@endif 

</div>
    <div class="card-footer">
        {{$clientes->links()}}
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
