@extends('layouts.app', ["current" => "encomendas"])

@section('body')


<h1>Página de Encomendas - Em Trânsito</h1>
<div class="card border">
    <div class="card-body">
    <a href="/encomendas/novo" class="btn btn-sm btn-primary" role="button">Nova Encomenda</a>

@if(count($encomendas) > 0)
        <table class="table table-ordered table-hover">
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
                    <td>{{$e->updated_at}}</td>
                    <td>
                        <a href="/encomendas/editar/{{$e->id}}" class="btn btn-sm btn-primary">Detalhar</a>
                        <a href="/encomendas/confirmarRecebimento/{{$e->id}}" class="btn btn-sm btn-success">Receber</a>
                    </td>
                </tr>
    @endforeach                
            </tbody>
        </table>
@else
<h4>Você não possuí encomendas em trânsito!</h4>
@endif   
   </div>
<div class="card-footer">
        {{$encomendas->links()}}
    </div>
</div>

@endsection