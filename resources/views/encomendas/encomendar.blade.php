@extends('layouts.app', ['current' => "encomendas"])

@section('body')
<div class="jumbotron bg-light border border-secondary">
@component('vendas.listar', compact('vendas'))
@endcomponent
</div>
@endsection