@extends('layouts.app', ['current' => "dashboard"])

@section('body')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<canvas id="myChart" width="100%" height="400"></canvas>

<script>
const ctx = document.getElementById('myChart').getContext('2d');
const myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: [$meses],
		datasets: [{
    		label: 'Entradas',
    		data: [$entradas],
    		fill: false,
    		borderColor: 'rgb(75, 192, 192)',
    		tension: 0.1
  		},
		  {
    		label: 'Saídas',
    		data: [$saidas],
    		fill: false,
    		borderColor: 'rgb(84, 8, 100)',
    		tension: 0.1
  		}],

    },
    options: { 
		responsive: true,
        maintainAspectRatio: false,
        scales: {
            y: {
                beginAtZero: true
            }
        }

    }
});
</script>
@endsection