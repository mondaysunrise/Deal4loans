<?php
	ob_start( 'ob_gzhandler' );
	require 'scripts/session_check.php';
	require 'scripts/functions.php';
	require 'scripts/db_init.php';
if(strlen($_REQUEST['source'])>0)
{
	$retrivesource=$_REQUEST['source'];
}
else
{
	$retrivesource="PL emi calc";
}
$page_Name = "PersonalLoan";
$maxage=date('Y')-62;
$minage=date('Y')-18;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script src="http://code.jquery.com/jquery-1.8.3.js"></script>
<script src="http://code.jquery.com/ui/1.10.0/jquery-ui.js"></script>
<script src="scripts/highcharts.js"></script>
<script>
$(function () {
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

<link href="source1.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="menu-style.css">
<link href="css/home-loan-emi-calculator.css" type="text/css" rel="stylesheet"/>
</head>
<body>
<script type="text/javascript" src="script1.js"></script>
<div style="clear:both;"></div>

<div style="clear:both;"></div>
<div class="hl_emi_chart"><div id="barChart"></div></div>
<div class="hl_emi_tbl_dis">
</div>

</div>
<div style="clear:both;"></div>
<div class="pl_emi_cal_table" style="margin-top:15px;"></div> 

</div>


<div style="clear:both;"></div>


</div>

</body>
</html>