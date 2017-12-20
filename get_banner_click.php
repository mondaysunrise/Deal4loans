<?php
  require 'scripts/db_init.php';

$bnnr_nme = $_REQUEST['bnnr_nme'];
 $bnnr_click = $_REQUEST['bnnr_click'];

if((strlen(trim($bnnr_nme))>0))
{
	
	$slct= "select * from captute_banner_click Where (banner_name ='".$bnnr_nme."')";
	list($num_rows,$row)=Mainselectfunc($slct,$array = array());
	if(($row['capture_clicks'])>0)
	{
		
	$strcrd_nme=$row['capture_clicks'] + $bnnr_click;
	}
	else
	{
		$strcrd_nme=$bnnr_click;
	}

		$DataArray = array("capture_clicks"=>$strcrd_nme);
		$wherecondition ="(banner_name ='".$bnnr_nme."')";
		Mainupdatefunc ('captute_banner_click', $DataArray, $wherecondition);
	}

$PostURL ="http://www.creditsudhaar.com/credit_score_estimator.php";
			header("Location: $PostURL");
			exit();
?>
