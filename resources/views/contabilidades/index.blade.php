

@extends('layouts.app', ["current" => "contabilidade"])

@section('body')
<style>
    .circulo{
        color: green;
    }
    .circulo2{
        color: red;
    }
</style>
<h1>Página de Contabilidade</h1>
<div class="card border">

<div class="card-body">
<button id="btn_mostra" onClick="mostraDiv('adicionarContabilidade')" class="btn btn-sm btn-success">Adicionar</button>

<form action="/contabilidade/relatorio" method="POST" target="_blank">
@csrf
    Data Início: <input type="date" id="dataInicio" name="dataInicio" min="2021-01-01" max="2050-04-30" required>
    Data Fim: <input type="date" id="dataFim" name="dataFim" min="2021-01-01" max="2050-04-30"  required>
    <input type="radio" id="todos" name="tipo" value="todos" checked> <label for="todos"> Todos</label>
    <input type="radio" id="entradas" name="tipo" value="entradas"> <label for="entradas">Entradas</label>
    <input type="radio"  id="saidas" name="tipo" value="saidas" > <label for="saidas">Saídas</label>
    <button type="submit" class="btn btn-sm btn-primary">Gerar Relatório</button>
</form>

<div class="jumbotron bg-light border border-secondary" style="display:none;" id="adicionarContabilidade">
@component('contabilidades.novo')
@endcomponent
</div>


@if(count($pag) > 0)

        <table class="table table-ordered table-hover" id="minhaTabela">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Descrição</th>
                    <th>Valor</th>
                    <th>Tipo</th>
                    <th>Cliente</th>
                    <th>Encomenda</th>
                    <th>Data</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
    @foreach($pag as $p)
<?php
    $date = date_create ($p->created_at);
?>
                <tr>
                    <td>{{$p->id}}</td>
                    <td>{{$p->descricao}}</td>
                    <td>R$ {{number_format($p->valor,2,",",".")}}</td>
                    <td @if ($p->tipo=="E") class="circulo" @endif class="circulo2" > {{$p->tipo}}</td>
                    <td>
                        @isset($p->venda->cliente->nome) 
                            {{$p->venda->cliente->nome}}
                        @endisset
                        @empty($p->venda->cliente->nome)
                            -
                        @endempty
                    </td>
                    <td>
                        @isset($p->encomenda_id) 
                            {{$p->encomenda->fornecedor->nome}}
                        @endisset
                        @empty($p->encomenda_id)
                            -
                        @endempty
                    </td>
                    <td>{{date_format($p->created_at,"d/m/Y")}}</td>
                    <td>
                        <a href="/contabilidade/editar/{{$p->id}}" class="btn btn-sm btn-primary">Detalhar</a>
                        <a href="/contabilidade/apagar/{{$p->id}}" class="btn btn-sm btn-danger">Apagar</a>
                    </td>
                </tr>
    @endforeach                
            </tbody>
        </table>
@else
<h4> Você não possuí contabilidades!</h4>
@endif   
    </div>
    <div class="card-footer">
        {{$pag->links()}}
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

<script>
function mostraDiv(adicionarContabilidade) {
        var display = document.getElementById(adicionarContabilidade).style.display;
        if(display == 'none'){
            document.getElementById(adicionarContabilidade).style.display = 'block';
        }
        else{
            document.getElementById(adicionarContabilidade).style.display = 'none';
        }
}


</script>