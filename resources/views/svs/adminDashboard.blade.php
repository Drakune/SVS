@extends('layouts.app')
@section('content')
<?php 
	$shelf = new \App\Shelfspace();
    $key = new \App\ShelfKey();
?>
<script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawKeyChart);
      google.charts.setOnLoadCallback(drawShelfChart);
      function drawKeyChart() {
      	var valueEmpty = <?php echo $key->select('shelfspace_id')->whereNull('shelfspace_id')->count(); ?>;
      	var valueNotEmpty = <?php echo $key->select('shelfspace_id')->whereNotNull('shelfspace_id')->count(); ?>;
        var data = google.visualization.arrayToDataTable([
          ['Key', 'Out/in'],
          ['Schlüssel eingelagert', valueEmpty],
          ['Schlüssel in Benutzung', valueNotEmpty]
        ]);

        var options = {
          title: 'Schlüsselstatus',
          is3D: true,
          colors: ['#FF1493','#39ff14']
        };

        var chart = new google.visualization.PieChart(document.getElementById('pieChartKey'));
        chart.draw(data, options);
      }
      function drawShelfChart() {
      	var valueEmpty = <?php echo $shelf->select('shelf_key_id')->whereNull('shelf_key_id')->count(); ?>;
      	var valueNotEmpty = <?php echo $shelf->select('shelf_key_id')->whereNotNull('shelf_key_id')->count(); ?>;
        var data = new google.visualization.arrayToDataTable([
          ['Shelf', 'Space'],
          ['Leere Plätze', valueEmpty],
          ['Belegte Plätze', valueNotEmpty]
        ]);

        var options = {
          title: 'Regalstatus',
          is3D: true,
          colors: ['#FF1493','#39ff14']
        };

        var chart = new google.visualization.PieChart(document.getElementById('pieChartShelf'));
        chart.draw(data, options);
      }
</script>

<div class="text-center">
	<h1>Willkommen im Admin-Dashboard!</h1>
	<div style="display: flex;">
		<div id="pieChartKey" style="width: 1000px; height: 500px;"></div>
		<div id="pieChartShelf" style="width: 1000px; height: 500px;"></div>
	</div>
	<div class="m-3">
		<a href="/managerp">
			<button class="btn border-dark">
				Zur Regalplatzverwaltung
			</button>
		</a>
	</div>

	<div class="m-3">
		<a href="/managekey">
			<button class="btn border-dark">
				Zur Schlüsselverwaltung
			</button>
		</a>
	</div>
</div>
@endsection