@extends('layouts.app', ['current' => "dashboard"])

@section('body')
<div class="jumbotron bg-light border border-secondary">
@component('dashboard.relatorios')
@endcomponent
</div>
@endsection