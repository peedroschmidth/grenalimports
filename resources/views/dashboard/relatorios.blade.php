@extends('layouts.app', ['current' => "dashboard"])

@section('body')
	<div style= "width:75%;">
		{!! $chartjs->render() !!}
	</div>

@endsection