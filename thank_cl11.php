<?php
ob_start();
require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	require 'getlistofeligiblebidders.php';

$city = $_SESSION['City'];
$leadid = $_SESSION['Temp_LID'];
$other_city = $_SESSION['City_Other'];
$rchtime = $_REQUEST['rchtime'];
$currenttm =  Date('H:i:s');

$tomorrow  = mktime(date("H"), date("i")+5, date("s"), date("m")  , date("d"), date("Y"));
$currentdate=date('H:i:s',$tomorrow);


if($city == "Others" && strlen($other_city)>0)
{
	$strCity = $other_city;
}
else
{
		$strCity = $city;
}


if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	
		$RequestID = $_POST['RequestID'];
		$activation_code = $_POST['activation_code'];
		$getdetails="select Reference_Code From Req_Loan_Car  Where RequestID='".$RequestID."'" ;
		list($numRows,$getdetailsQuery)=Mainselectfunc($getdetails,$array = array());
		$Reference_Code = $getdetailsQuery[0]['Reference_Code'];
		
		if($Reference_Code==$activation_code)
		{
			$Is_Valid = 1;
		}
		else
		{
			$Is_Valid = 0;
		}	
	
		$DataArray = array("Is_Valid"=>$Is_Valid);
		$wherecondition ="(RequestID = '".$RequestID."')";
		Mainupdatefunc ('Req_Loan_Car', $DataArray, $wherecondition);

		
		
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Thank you</title>
<link href="style/new-bima.css" rel="stylesheet"  type="text/css" />
<link href="style/glowing.css" rel="stylesheet"  type="text/css" />
<script type="text/javascript" src="js/dropdowntabs.js"></script>
<style type="text/css">
.fontbld10 {
font-size:10px;
font-weight:bold;
line-height:12px;
}
</style>
</head>
<body>
<?php include '~Top-new.php';?>
<?php include '~menu.php';?>
<div id="container">
  <div id="txt" style="padding-top:15px;">
  <div align="center"><b><font color="#3366CC">Thanks for applying Car Loan through Deal4loans.com. </font></b></div>
  <?
list($realbankiD,$bankID,$FinalBidder,$finalBidderName)= getBiddersList("Req_Loan_Car",$leadid,$strCity);
$arrFinal_Bid = "";
		while (list ($key,$val) = @each($realbankiD)) { 
			$arrFinal_Bid[]= $val; 
		} 

$Final_Bid = "";
			while (list ($key,$val) = @each($bankID)) { 
				$Final_Bid[]= $val; 
			} 
$strFinalBidder = implode(",",$FinalBidder);

	if(count($Final_Bid)>0 && $Is_Valid==1)
	{ 
		$Dated = ExactServerdate();
		$DataArray = array("Bidderid_Details"=>$strFinalBidder, 'Allocated'=>'2', 'Dated'=>$Dated);
		$wherecondition ="(RequestID = '".$leadid."')";
		Mainupdatefunc ('Req_Loan_Car', $DataArray, $wherecondition);
		?>
		 <div align="center"><b><font color="#3366CC">You will get a call from the below mentioned Banks.</font></b> </div>
	<form name="CLallocate" method="POST" action="thank_cl_continue.php">
	<input type="hidden" name="leadid" id="leadid" value="<? echo $leadid; ?>">
	<input type="hidden" name="city" id="city" value="<? echo $strCity; ?>">
		<table cellpadding="0" cellspacing="0" width="550" align="center" style="border:1px #dbf2ff solid;">
			<tr>
			<td bgcolor="#dbf2ff" class="fontbld10" align="center" height="30" style="border-right:1px #000000 solid;">Bank Name</td>
			<td bgcolor="#dbf2ff"></td>
				</tr>
		<? for($i=0;$i<count($Final_Bid);$i++)
			{ ?>
		<tr style="border-top:1px #dbf2ff solid;">
			<td class="fontbld10" align="center" height="45"><? echo $Final_Bid[$i]; ?></td>
			<td class="fontbld10" align="center">Get Quote on call from Bank</td>
			
			</tr>	
		<?	}
		?>
		<!--<tr><td colspan="3" align="center" height="45" style="border-top:1px #dbf2ff solid;"><input type="Submit" name="submit" value="Submit" class="btnclr"/></td></tr>-->
		
		<tr><td colspan="3" class="fontbld10" align="center" height="45" style="border-top:1px #dbf2ff solid;">Do not wish to get quote from above mentioned Banks <input type="Submit" name="submit" value="Click Here" style="width:80px; height:20px; background-color: #dbf2ff; color:#663366;"/></td></tr>
		<!--<tr><td colspan="3" align="center" height="45" style="border-top:1px #dbf2ff solid;">Do not wish to get quote from above mentioned Banks - Click Here</td></tr>-->
		</table>
		</form>

	<? 
		$rchtime= Date('H:i:s');

		$R_URL="thank_cl_direct.php?leadid=$leadid&city=$strCity";

	if(strlen($R_URL)>0)

	{

		Header("Refresh: 55 URL=".$R_URL);

	}
	 }

	
	?>

 </div>
 
      
  <? if ((($_REQUEST['flag'])!=1))
	{ ?>
  <?php include '~Bottom-new.php';?><?php } ?>
</div><!-- </div>-->
<? // }?>


<?  if((strlen(strpos($_SESSION['final_url'], "honda_car_loan.php")) > 0))
	 { ?>	 

<!-- Google Code for hnd-CL Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 1066264455;
var google_conversion_language = "en";
var google_conversion_format = "2";
var google_conversion_color = "999999";
var google_conversion_label = "bItDCJ2a2QEQh8-3_AM";
var google_conversion_value = 0;
/* ]]> */
</script>
<script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/1066264455/?label=bItDCJ2a2QEQh8-3_AM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>

	 <?  }
 elseif((strlen(strpos($_SESSION['final_url'], "sbi_car_loan.php")) > 0))
	 {?>

<!-- Google Code for SBI Car Loan Conversion Page -->
<script type="text/javascript">
<!--
var google_conversion_id = 1066264455;
var google_conversion_language = "en";
var google_conversion_format = "2";
var google_conversion_color = "ffffff";
var google_conversion_label = "z6kFCP2g0wEQh8-3_AM";
var google_conversion_value = 0;
//-->
</script>
<script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/1066264455/?label=z6kFCP2g0wEQh8-3_AM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>


	 <?  }
 elseif((strlen(strpos($_SESSION['final_url'], "maruti_car_loan.php")) > 0))
	 {?>

<!-- Google Code for Maruti Car Loan Conversion Page -->
<script type="text/javascript">
<!--
var google_conversion_id = 1066264455;
var google_conversion_language = "en";
var google_conversion_format = "2";
var google_conversion_color = "ffffff";
var google_conversion_label = "QL6JCPWh0wEQh8-3_AM";
var google_conversion_value = 0;
//-->
</script>
<script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/1066264455/?label=QL6JCPWh0wEQh8-3_AM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>


	 <?  }
 elseif((strlen(strpos($_SESSION['final_url'], "hyundai_car_loan.php")) > 0))
	 {?>

<!-- Google Code for hund-CL Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 1066264455;
var google_conversion_language = "en";
var google_conversion_format = "2";
var google_conversion_color = "666600";
var google_conversion_label = "GTqlCJWb2QEQh8-3_AM";
var google_conversion_value = 0;
/* ]]> */
</script>
<script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/1066264455/?label=GTqlCJWb2QEQh8-3_AM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>





	 <?  }
 elseif((strlen(strpos($_SESSION['final_url'], "gen_car_loan.php")) > 0))
	 {?>

<!-- Google Code for Gen-Car-Loan Conversion Page -->
<script type="text/javascript">
<!--
var google_conversion_id = 1066264455;
var google_conversion_language = "en";
var google_conversion_format = "2";
var google_conversion_color = "ffffff";
var google_conversion_label = "Jp4bCOWj0wEQh8-3_AM";
var google_conversion_value = 0;
//-->
</script>
<script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/1066264455/?label=Jp4bCOWj0wEQh8-3_AM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>



	 <?  }
 elseif((strlen(strpos($_SESSION['final_url'], "tata_car_loan.php")) > 0))
	 {?>

<!-- Google Code for Tata-Car-Loan Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 1066264455;
var google_conversion_language = "en";
var google_conversion_format = "2";
var google_conversion_color = "ffffff";
var google_conversion_label = "KO4dCIWd2QEQh8-3_AM";
var google_conversion_value = 0;
/* ]]> */
</script>
<script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/1066264455/?label=KO4dCIWd2QEQh8-3_AM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>

	 <?  }
 elseif((strlen(strpos($_SESSION['final_url'], "car_loan.php")) > 0))
	 {?>

<!-- Google Code for Car Loan Conversion Page -->
<script type="text/javascript">
<!--
var google_conversion_id = 1066264455;
var google_conversion_language = "en";
var google_conversion_format = "2";
var google_conversion_color = "ffffff";
var google_conversion_label = "e7cHCIWg0wEQh8-3_AM";
var google_conversion_value = 0;
//-->
</script>
<script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/1066264455/?label=e7cHCIWg0wEQh8-3_AM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>

<? } ?>

</body>
</html>