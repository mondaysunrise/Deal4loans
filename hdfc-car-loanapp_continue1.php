<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';
$model = $_REQUEST['model'];
//$model = "Maruti";
if($model=="Nissan"){	$getCar = 'Nissan';	}
else if($model=="Mahindra") {	$getCar = 'Mahindra & Mahindra Ltd';	}
else if($model=="Renault") {	$getCar = 'Renault';	}
else if($model=="Tata") {	$getCar = 'Tata Motors Ltd';	}
else if($model=="Maruti") {	$getCar = 'Maruti Suzuki India Ltd';	}
else if($model=="Hyundai") {	$getCar = 'Hyundai Motors India Ltd';	}
else if($model=="Honda") {	$getCar = 'Honda Seil Cars India Ltd';	}
else if($model=="Toyota") {	$getCar = 'Toyota Kirlosker Motors Ltd';	}
else if($model=="Chevrolet") {	$getCar = 'Chevrolet';	}

else if($model=="Porsche") {	$getCar = 'Porsche';	}
else if($model=="Mercedes") {	$getCar = 'Mercedes';	}
else if($model=="Force") {	$getCar = 'Force';	}
else if($model=="Land Rover") {	$getCar = 'Land Rover';	}
else if($model=="Premier") {	$getCar = 'Premier';	}
else if($model=="Jaguar") {	$getCar = 'Jaguar';	}
else if($model=="Mitsubishi") {	$getCar = 'Mitsubishi Motors Ltd';	}

else if($model=="Ford") {	$getCar = 'Ford India Pvt Ltd';	}
else if($model=="Audi") {	$getCar = 'Audi';	}
else if($model=="Bmw") {	$getCar = 'Bmw';	}
else if($model=="Skoda") {	$getCar = 'Skoda Auto India Pvt Ltd';	}
else if($model=="Fiat") {	$getCar = 'Fiat India Automobiles Ltd';	}
else if($model=="Premier") {	$getCar = 'Premier';	}
else if($model=="Volvo") {	$getCar = 'Volvo Auto India Pvt. Ltd';	}
else if($model=="Hindustan Motors") {	$getCar = 'Hindustan Motors';	}
else if($model=="Volkswagen") {	$getCar = 'Volkswagen';	}
else { $model="Maruti";	$getCar = 'Maruti Suzuki India Ltd';	}

$getCarSql = "select hdfc_car_name from hdfc_car_list_category where hdfc_car_manufacturer='".$getCar."'";
$getCarQuery = ExecQuery($getCarSql);
$getCarNumRows = mysql_num_rows($getCarQuery);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>HDFC Car Loan App</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="images/car_hdfc/style.css"/>
<style type="text/css">
	<!--
		.body_text{ padding-left:10px; font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight: bold; line-height:18px; color:#7d7a7a;}

		a:link,a:visited,a:hover{color:#000;}
		.links{margin:10px 0 0 10px;}
		.links a{display:inline-block; padding:2px 10px; margin:10px; background:#C30; text-decoration:none; -webkit-border-radius:15px; -moz-border-radius:15px; border-radius:15px;}
		.links a:hover{background:#de4816;}
		.content{ width:400px; height:340px; overflow:auto; background:#fff;}
		.content p:nth-child(even){color:#000; font-family:Georgia,serif; font-size:17px; font-style:italic;}

	#scrollbar1 { width: 520px; margin: 20px 0 10px; }
	#scrollbar1 .viewport { width: 500px; height: 200px; overflow: hidden; position: relative; }
	#scrollbar1 .overview { list-style: none; position: absolute; left: 0; top: 0; padding: 0; margin: 0; }
	#scrollbar1 .scrollbar{ background: transparent url(http://www.deal4loans.com/lib/images/bg-scrollbar-track-y.png) no-repeat 0 0; position: relative; background-position: 0 0; float: right; width: 15px; }
	#scrollbar1 .track { background: transparent url(http://www.deal4loans.com/lib/images/bg-scrollbar-trackend-y.png) no-repeat 0 100%; height: 100%; width:13px; position: relative; padding: 0 1px; }
	#scrollbar1 .thumb { background: transparent url(http://www.deal4loans.com/lib/images/bg-scrollbar-thumb-y.png) no-repeat 50% 100%; height: 20px; width: 25px; cursor: pointer; overflow: hidden; position: absolute; top: 0; left: -5px; }
	#scrollbar1 .thumb .end { background: transparent url(http://www.deal4loans.com/lib/images/bg-scrollbar-thumb-y.png) no-repeat 50% 0; overflow: hidden; height: 5px; width: 25px; }
	#scrollbar1 .disable { display: none; }
	.noSelect { user-select: none; -o-user-select: none; -moz-user-select: none; -khtml-user-select: none; -webkit-user-select: none; }

	-->
	
	</style>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script type="text/javascript" src="lib/jquery.tinyscrollbar.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#scrollbar1').tinyscrollbar();	
		});
	</script>	
	</head>
	<body>
	<table width="952"  height="380" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#260930">
      <tr>
        <td bgcolor="#260930">&nbsp;</td>
        <td height="50" valign="middle" bgcolor="#260930" class="contunue_head-text"><?php echo $getCar; ?></td>
        <td bgcolor="#260930">&nbsp;</td>
      </tr>
      <tr>
        <td height="50" valign="middle" bgcolor="#260930">&nbsp;</td>
        <td valign="top" bgcolor="#260930" class="contunue_text" height="0"><table height="400" cellpadding="0" cellspacing="0" border="0"  >
          <tr>
            <td class="contunue_head-text-img " style="color:#ffffff; border-bottom:#1060ba 1px solid; padding-bottom:3px;" >Select Car Model</td>
          </tr>
          <tr>
            <td  bgcolor="#FFFFFF" >
          <!--  <div id="content_1" class="content">
                <div style="height:443px; width:409px; padding:0px 0px 0px 5px; overflow-y: scroll;"> -->
                	<div id="scrollbar1">
		<div class="scrollbar"><div class="track"><div class="thumb"><div class="end"></div></div></div></div>
		<div class="viewport">
			 <div class="overview">
                  <table cellpadding="0" cellspacing="0" border="0"  >
                    <?php
$carM = array('Maruti ', 'Nissan ','Renault ', 'Honda ', 'Mahindra ', 'Toyota', 'Hyundai ', 'Tata ', 'Chevrolet ', 'Porsche ', 'Mercedes ', 'Force ', 'Land Rover ', 'Premier ', 'Jaguar ', 'Mitsubishi ', 'Ford ', 'Audi ', 'Bmw ', 'Skoda ', 'Fiat ', 'Volvo ' );
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
		</div>
	</div>	</td>
          </tr>
        </table></td>
       
        <td valign="top" bgcolor="#260930" style="padding-left:10px;"><table width="525" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="223"><div id="box_a"><a href="hdfc-car-loanapp_continue.php?model=Porsche"><img src="images/car_hdfc/porsche.jpg" width="215" height="102" border="0" /></a></div></td>
            <td colspan="2" rowspan="2" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td><table width="100%" border="0" cellpadding="0" cellspacing="0">
                      <tr>
                        <td width="150" valign="top"><div id="box_c"><a href="hdfc-car-loanapp_continue.php?model=Force"><img src="images/car_hdfc/Force.png" width="140" height="65" border="0" /></a></div></td>
                        <td width="151" valign="top"><div id="box_c"><a href="hdfc-car-loanapp_continue.php?model=Volkswagen"><img src="images/car_hdfc/Volkswagen.png" width="140" height="65" border="0" /></a></div></td>
                      </tr>
                  </table></td>
                </tr>
                <tr>
                  <td><div id="box_d"><a href="hdfc-car-loanapp_continue.php?model=Land Rover"><img src="images/car_hdfc/jlr.jpg" width="290" height="140" border="0" /></a></div></td>
                </tr>
            </table></td>
          </tr>
          <tr>
            <td><div id="box_b"><a href="hdfc-car-loanapp_continue.php?model=Mercedes"><img src="images/car_hdfc/mercedes-benz.jpg" width="215" height="102" border="0" /></a></div></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td width="214">&nbsp;</td>
            <td width="88">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="3"><table width="525" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="224"><div id="box_a2"><a href="hdfc-car-loanapp_continue.php?model=Tata"><img src="images/car_hdfc/tatamotors.png" width="215" height="102" border="0" /></a></div></td>
                  <td rowspan="2" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                      <tr>
                        <td><table width="100%" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                              <td width="150" valign="top"><div id="box_c2"><a href="hdfc-car-loanapp_continue.php?model=Ford"><img src="images/car_hdfc/FordIndia.jpg" width="140" height="65" border="0" /></a></div></td>
                              <td width="151" valign="top"><div id="box_c2"><a href="hdfc-car-loanapp_continue.php?model=Bmw"><img src="images/car_hdfc/Bmw.png" width="140" height="65" border="0" /></a></div></td>
                            </tr>
                        </table></td>
                      </tr>
                      <tr>
                        <td><div id="box_d"><a href="hdfc-car-loanapp_continue.php?model=Skoda"><img src="images/car_hdfc/Skoda.png" width="290" height="140" border="0" /></a></div></td>
                      </tr>
                  </table></td>
                </tr>
                <tr>
                  <td><div id="box_b"><a href="hdfc-car-loanapp_continue.php?model=Hindustan Motors"><img src="images/car_hdfc/Hindustan-Motors.jpg" width="215" height="102" border="0" /></a></div></td>
                </tr>
            </table></td>
          </tr>
          <tr>
            <td colspan="3">&nbsp;</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td height="0" valign="middle" bgcolor="#260930">&nbsp;</td>
        <td height="0" valign="top" bgcolor="#260930" class="contunue_text">&nbsp;</td>
        <td valign="top" bgcolor="#260930">&nbsp;</td>
      </tr>
    </table>
   
</body>
</html>