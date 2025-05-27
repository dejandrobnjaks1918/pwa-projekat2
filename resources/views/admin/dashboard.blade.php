@extends('layouts.app')

@section('content')
<div class="container">
    <br>
    <h2 class="mb-4">Broj rezervacija po danima</h2>

    <div id="chart_div" style="width: 100%; height: 400px;"></div>
</div>

{{-- Google Chart --}}
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        const data = google.visualization.arrayToDataTable([
            ['Datum', 'Broj rezervacija'],
            @foreach ($data as $row)
                ['{{ \Carbon\Carbon::parse($row->date)->format("d.m.") }}', {{ $row->count }}],
            @endforeach
        ]);

        const options = {
            title: 'Rezervacije po danima',
            curveType: 'function',
            legend: { position: 'bottom' }
        };

        const chart = new google.visualization.LineChart(document.getElementById('chart_div'));
        chart.draw(data, options);
    }
</script>
@endsection
