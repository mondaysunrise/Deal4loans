<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';
$model = $_REQUEST['model'];
$model = "Maruti";
if($model=="Nissan"){	$getCar = 'Nissan';	}
else if($model=="Mahindra") {	$getCar = 'Mahindra & Mahindra Ltd';	}
else if($model=="Renault") {	$getCar = 'Renault';	}
else if($model=="Tata") {	$getCar = 'Tata Motors Ltd';	}
else if($model=="Maruti") {	$getCar = 'Maruti Suzuki India Ltd';	}
else if($model=="Hyundai") {	$getCar = 'Hyundai Motors India Ltd';	}
else if($model=="Honda") {	$getCar = 'Honda Seil Cars India Ltd';	}
else if($model=="Toyota") {	$getCar = 'Toyota Kirlosker Motors Ltd';	}
else if($model=="Chevrolet") {	$getCar = 'Chevrolet';	}



$getCarSql = "select hdfc_car_name from hdfc_car_list_category where hdfc_car_manufacturer='".$getCar."'";
$getCarQuery = ExecQuery($getCarSql);
$getCarNumRows = mysql_num_rows($getCarQuery);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>HDFC Car Loan App</title>
<style type="text/css">
.body_text{ font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight: bold; line-height:18px; color:#7d7a7a;}
</style>
	<style type="text/css">
	<!--
		
		a:link,a:visited,a:hover{color:#fff;}
		.links{margin:10px 0 0 10px;}
		.links a{display:inline-block; padding:2px 10px; margin:10px; background:#C30; text-decoration:none; -webkit-border-radius:15px; -moz-border-radius:15px; border-radius:15px;}
		.links a:hover{background:#de4816;}
		.content{ width:290px; height:460px; overflow:auto; background:#000;}
		.content p:nth-child(even){color:#999; font-family:Georgia,serif; font-size:17px; font-style:italic;}
	
	-->
	</style>
	<!-- Custom scrollbars CSS -->
	<link href="flip/jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css" />
</head>
<body>
<table cellpadding="0" cellspacing="0" border="0" >
<tr><td style="float:right; background-image:url(images/carhdfc/bg3.png); width:330px; height:600px; background-repeat:no-repeat; padding-left:35px; padding-bottom:35px; padding-right:35px; padding-top:95px;" valign="top">
<table cellpadding="0" cellspacing="0" border="0" width="290"  >
<tr><td align="left" valign="middle" height="30"  class="body_text" style="color:#FFFFFF; font-size:18px; padding-bottom:2px;">
<a href="hdfc-car-loan_app.php" style="margin-left: 10px"><img src='images/carhdfc/left.png' border="0"></a><img src="images/carhdfc/spacer.gif" width="164" height="1"  /><b style="text-align:right;"><?php echo $model; ?></b></td></tr>
<tr><td align="left" bgcolor="#000">
<!--<div style="height:480px; width:280px; padding:0px 0px 0px 5px; overflow-y: scroll;"> -->
<div id="content_1" class="content">
<table cellpadding="0" cellspacing="0" border="0"  >

<?php
$carM = array('Maruti ', 'Nissan ','Renault ', 'Honda ', 'Mahindra ', 'Toyota', 'Hyundai ', 'Tata ', 'Chevrolet ' );
for($i=0;$i<$getCarNumRows;$i++)
{
	$hdfc_car_name = mysql_result($getCarQuery,$i,'hdfc_car_name');
	echo '<tr><td class="body_text"><a href="hdfc-car-loan-app-offers_nw.php?car_name='.$hdfc_car_name.'" class="body_text" style="text-decoration:none;">';
	echo str_replace($carM, "", $hdfc_car_name);
//	echo $hdfc_car_name;	
	echo "</a></td></tr>";
}
?>
</table>
</div>
</td></tr>
</table>
</td></tr>

</table>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
	<script>!window.jQuery && document.write(unescape('%3Cscript src="flip/jquery-1.7.2.min.js"%3E%3C/script%3E'))</script>
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
	<script>!window.jQuery.ui && document.write(unescape('%3Cscript src="flip/jquery-ui-1.8.21.custom.min.js"%3E%3C/script%3E'))</script>
	<!-- mousewheel plugin -->
	<script src="flip/jquery.mousewheel.min.js"></script>
	<!-- custom scrollbars plugin -->
	<script src="flip/jquery.mCustomScrollbar.js"></script>
	<script>
		(function($){
			$(window).load(function(){
				$("#content_1").mCustomScrollbar({
					scrollButtons:{
						enable:true
					}
				});
			});
		})(jQuery);
	</script>
</body>
</html>