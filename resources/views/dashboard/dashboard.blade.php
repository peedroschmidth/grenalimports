@extends('layouts.app', ['current' => "dashboard"])

@section('body')

<div class="jumbotron bg-light border border-secondary">
@component('dashboard.relatorios')
@endcomponent
</div>

<div class="jumbotron bg-light border border-secondary">
@component('dashboard.anual')
@endcomponent
</div>

@endsection