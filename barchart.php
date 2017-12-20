<script src="http://code.jquery.com/jquery-1.8.3.js"></script>
<script src="http://code.jquery.com/ui/1.10.0/jquery-ui.js"></script>
<script src="http://code.highcharts.com/highcharts.js"></script>

<script>
    var chart;
    $(document).ready(function() {
	var catxAxis = new Array('Year 1','Year 2','Year 3','Year 4');
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'barChart',
                type: 'bar',
				height:300,
            },
            title: {
                text: false
            },
            xAxis: {
                categories: catxAxis, labels:{rotation:-25}
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Principal + Interest'
                }
            },
            legend: {
                backgroundColor: '#FFFFFF',
                reversed: true
            },
            tooltip: {
                formatter: function() {
                    return ''+
                        this.series.name +': '+ number_format(this.y) +'';
                }
            },
            plotOptions: {
                series: {
                    stacking: 'normal'
                }
            },
                series: [{
                name: 'Principal',
                data: [39766, 45930, 53054, 61316]
            }, {
               name: 'Interest',
                data: [26426, 20262, 13138, 4914]
            }]
        });
    });
    
});
</script>
<!--<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>-->
<div id="barChart"></div>
<table id="datatable">
	<thead>
		<tr>
			<th></th>
			<th>Jane</th>
			<th>John</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<th>Apples</th>
			<td>3</td>
			<td>4</td>
		</tr>
		<tr>
			<th>Pears</th>
			<td>2</td>
			<td>0</td>
		</tr>
		<tr>
			<th>Plums</th>
			<td>5</td>
			<td>11</td>
		</tr>
		<tr>
			<th>Bananas</th>
			<td>1</td>
			<td>1</td>
		</tr>
		<tr>
			<th>Oranges</th>
			<td>2</td>
			<td>4</td>
		</tr>
	</tbody>
</table>