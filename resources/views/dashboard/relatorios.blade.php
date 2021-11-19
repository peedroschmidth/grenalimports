@extends('layouts.app', ['current' => "dashboard"])

@section('body')
<?php dd($saidas); ?>;

<?php dd($entradas); ?>;
<?php dd($meses); ?>;

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<canvas id="myChart" width="100%" height="400"></canvas>

<script>
const ctx = document.getElementById('myChart').getContext('2d');
const s = <?php echo $saidas; ?>;
const e = <?php echo $entradas; ?>;
const m = <?php echo $meses; ?>;

const myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: m,
		datasets: [{
    		label: 'Entradas',
    		data: e,
    		fill: false,
    		borderColor: 'rgb(75, 192, 192)',
    		tension: 0.1
  		},
		  {
    		label: 'Saídas',
    		data: s,
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