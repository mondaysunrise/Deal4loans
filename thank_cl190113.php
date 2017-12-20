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
$Reference_Code = $_REQUEST["Reference_Code"];
$activation_code = $_REQUEST["activation_code"];
if($Reference_Code == $activation_code)
{
	$Is_Valid=1;
}
else
{
	$Is_Valid=0;
}

$DataArray = array("Is_Valid"=>$Is_Valid);
		$wherecondition ="(RequestID = '".$leadid."')";
		Mainupdatefunc ('Req_Loan_Car', $DataArray, $wherecondition);
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

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>  
<title>Thank you Car Loan</title>
<meta name="keywords" content="apply car loan, car loans online, apply online car loans, Car Motor loans India, Apply Car Motor Loans, Compare Car Loans in Mumbai Hyderabad Pune kolkata Delhi Noida Bangalore">
<meta name="description" content="Car Loans – Compare and Choose Best car loans schemes from all loan provider banks of India."><link href="source.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="scripts/mainmenu.js"></script>
<script type="text/javascript" src="js/dropdowntabs.js"></script>
<script type="text/javascript" src="scripts/mootools.js"></script>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #203f5f;
	overflow-x:hidden;
	background-color:#FFF;
}
.red {
	color: #F00;
}
-->
.fontbld10 {
font-size:10px;
font-weight:bold;
line-height:12px;
color:#000000;
}
</style>
</head>
<body>
<?php include "top-menu.php"; ?>
<!--top-->

<!--logo navigation-->
<?php include "main-menu.php"; ?>
<!--logo navigation-->
<div class="text12" style="margin:auto; width:970px; height:11px; margin-top:11px; color:#0a8bd9;"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> > <a href="car-loans.php"  class="text12" style="color:#0080d6;"><u>Car Loan</u></a> <span class="text12" style="color:#4c4c4c;">> Apply Car Loan</span></div>
<div class="intrl_txt" style="margin:auto;">
<div style="clear:both; height:15px;"></div>
<div class="text12" style="margin:auto; width:970px;">
  <div align="center"><b><font color="#3366CC">Thanks for applying Car Loan through Deal4loans.com. </font></b></div>
  <?
  if($leadid>0)
{
$getdetails="select Name,Email,Mobile_Number,ABMMU_flag,Is_Valid From Req_Loan_Car  Where RequestID='".$leadid."'" ;
	list($numRows,$getdetailsQuery)=Mainselectfunc($getdetails,$array = array());

		$Is_Valid = $getdetailsQuery[0]['Is_Valid'];
		$ABMMU_flag = $getdetailsQuery[0]['ABMMU_flag'];
		$full_name = $getdetailsQuery[0]['Name'];
		$Email = $getdetailsQuery[0]['Email'];
		$Mobile_Number = $getdetailsQuery[0]['Mobile_Number'];

		list($strFirst,$strLast) = split('[ ]', $full_name);
if(strlen($strFirst)>25)
		{
			$shrtfname=strlen($strFirst)-25;
			$First = substr(trim($strFirst), 0, strlen(trim($strFirst))-$shrtfname);

		}
		else
		{
			$First =$strFirst;
		}
if(strlen($strLast)>25)
		{
			$shrtlname=strlen($strLast)-25;
			$Last = substr(trim($strLast), 0, strlen(trim($strLast))-$shrtlname);

		}
		else
		{
			$Last =$strLast;
		}

}
list($realbankiD,$bankID,$FinalBidder,$finalBidderName)= getBiddersList("Req_Loan_Car",$leadid,$strCity);
$arrFinal_Bid = "";
		while (list ($key,$val) = @each($realbankiD)) { 
			$arrFinal_Bid[]= $val; 
		} 
		


$Final_Bid = "";
			while (list ($key,$val) = @each($bankID)) { 
				$Final_Bid[]= $val; 
			} 
	
	if((count($Final_Bid)>0) && ($Is_Valid==1))
	{ //echo "enter";

		?>
		 <div align="center"><b><font color="#3366CC">You will get a call from the below mentioned Banks.</font></b><br /><br /> </div>
	
		<table cellpadding="0" cellspacing="0" width="650" align="center" style="border:1px #dbf2ff solid;">
			<tr>
			<td bgcolor="#dbf2ff" class="fontbld10" align="center" height="30" style="border-right:1px #000000 solid; font-size:12px;" width="150">Bank Name</td>
			<td bgcolor="#dbf2ff" class="fontbld10" align="center" height="30" style="border-right:1px #000000 solid; font-size:12px;" width="200">Interest Rate</td>
			<td bgcolor="#dbf2ff" class="fontbld10" align="center" height="30" style="border-right:1px #000000 solid; font-size:12px;" width="350"></td>
		  </tr>
		<? for($i=0;$i<count($Final_Bid);$i++)
			{  ?>
		<tr style="border-top:1px #dbf2ff solid; border-bottom:1px #dbf2ff solid;">
			<td class="fontbld10" align="center" height="45" style="font-size:12px;"><? if($Final_Bid[$i] =="HDFC")
			{ echo "HDFC Bank";} else { echo $Final_Bid[$i];} ?></td>
		<?	if($Final_Bid[$i] =="HDFC")
			{?>
			<td class="fontbld10" align="center" style="font-size:12px;">11.50% - 14.25%</td>
			<? }
			else if ($Final_Bid[$i]=="SBI")
			{ ?>
			<td class="fontbld10" align="center" style="font-size:12px;">11.25% - 14%</td>
			<? }
			else if ($Final_Bid[$i]=="Kotak Bank")
			{ ?>
			<td class="fontbld10" align="center" style="font-size:12px;">12% - 14.50%</td>
			<? }
			else
			{?>
			<td class="fontbld10" align="center" style="font-size:12px;">Get Quote on call from Bank</td>
			<? } ?>
		
			<td align="center"><form action="apply_cl_consent.php" method="POST" target="_blank" >
			 <input type="hidden" name="cl_requestid" value="<? echo $leadid; ?>" id="cl_requestid">
		    <input type="hidden" name="cl_bank_name" id="cl_bank_name" value="<? echo $Final_Bid[$i]; ?>">
			<input type="submit" style="width: 300px; height: 25px; border: 0px none ; cursor:pointer; background-image: url(/new-images/nego_bnk.jpg); margin-bottom: 0px; background-repeat:no-repeat; background-color:#FFFFFF;" value="" onClick="insertData(<? echo $i;?>);"/>
				  </form></td>
		  </tr>	
		  <tr style="border-top:1px #000000 solid;"><td colspan="3" style="border-top:1px #000000 solid;">&nbsp;</td>
		  </tr>
		<?	}
		?>
		<!--<tr style="border-top:1px #dbf2ff solid; border-bottom:1px #dbf2ff solid;">
			<td class="fontbld10" align="center" height="45" style="font-size:12px;">Allhabad Bank
</td>
<td class="fontbld10" align="center" style="font-size:12px;">13.75%</td>
			<td align="center"><form action="apply_cl_consent.php" method="POST" target="_blank" >
			 <input type="hidden" name="cl_requestid" value="<? //echo $leadid; ?>" id="cl_requestid">
		    <input type="hidden" name="cl_bank_name" id="cl_bank_name" value="Allhabad Bank">
			<input type="submit" style="width: 300px; height: 25px; border: 0px none ; cursor:pointer; background-image: url(/new-images/nego_bnk.jpg); margin-bottom: 0px; background-repeat:no-repeat; background-color:#FFFFFF;" value="" onClick="insertData(<? //echo $i;?>);"/>
				  </form></td>
		  </tr>	-->
		  <!--<tr style="border-top:1px #000000 solid;"><td colspan="3" style="border-top:1px #000000 solid;">&nbsp;</td>
		  </tr>
		  <tr style="border-top:1px #dbf2ff solid; border-bottom:1px #dbf2ff solid;">
			<td class="fontbld10" align="center" height="45" style="font-size:12px;">Bank Of Baroda
</td>
<td class="fontbld10" align="center" style="font-size:12px;">13.25%</td>
			<td align="center"><form action="apply_cl_consent.php" method="POST" target="_blank" >
			 <input type="hidden" name="cl_requestid" value="<? //echo $leadid; ?>" id="cl_requestid">
		    <input type="hidden" name="cl_bank_name" id="cl_bank_name" value="Bank Of Baroda">
			<input type="submit" style="width: 300px; height: 25px; border: 0px none ; cursor:pointer; background-image: url(/new-images/nego_bnk.jpg); margin-bottom: 0px; background-repeat:no-repeat; background-color:#FFFFFF;" value="" />
				  </form></td>
		  </tr>	
		  <tr style="border-top:1px #000000 solid;"><td colspan="3" style="border-top:1px #000000 solid;">&nbsp;</td>
		  </tr>
		 

  <tr style="border-top:1px #dbf2ff solid; border-bottom:1px #dbf2ff solid;">
	<td class="fontbld10" align="center" height="45" style="font-size:12px;">Canara Bank</td>
<td class="fontbld10" align="center" style="font-size:12px;">13.75%</td>
			<td align="center"><form action="apply_cl_consent.php" method="POST" target="_blank" >
			 <input type="hidden" name="cl_requestid" value="<? //echo $leadid; ?>" id="cl_requestid">
		    <input type="hidden" name="cl_bank_name" id="cl_bank_name" value="Canara Bank">
			<input type="submit" style="width: 300px; height: 25px; border: 0px none ; cursor:pointer; background-image: url(/new-images/nego_bnk.jpg); margin-bottom: 0px; background-repeat:no-repeat; background-color:#FFFFFF;" value="" />
				  </form></td>
		  </tr>	
		  <tr style="border-top:1px #000000 solid;"><td colspan="3" style="border-top:1px #000000 solid;">&nbsp;</td>
		  </tr>
		<tr style="border-top:1px #dbf2ff solid; border-bottom:1px #dbf2ff solid;">
		<td class="fontbld10" align="center" height="45" style="font-size:12px;">Central Bank
		</td>
		<td class="fontbld10" align="center" style="font-size:12px;">13.75%</td>
		<td align="center"><form action="apply_cl_consent.php" method="POST" target="_blank" >
		<input type="hidden" name="cl_requestid" value="<? //echo $leadid; ?>" id="cl_requestid">
		<input type="hidden" name="cl_bank_name" id="cl_bank_name" value="Central Bank">
		<input type="submit" style="width: 300px; height: 25px; border: 0px none ; cursor:pointer; background-image: url(/new-images/nego_bnk.jpg); margin-bottom: 0px; background-repeat:no-repeat; background-color:#FFFFFF;" value="" />
		</form></td>
		</tr>	
		<tr style="border-top:1px #000000 solid;"><td colspan="3" style="border-top:1px #000000 solid;">&nbsp;</td>
		</tr>

		<tr style="border-top:1px #dbf2ff solid; border-bottom:1px #dbf2ff solid;">
		<td class="fontbld10" align="center" height="45" style="font-size:12px;">Corporation Bank
		</td>
		<td class="fontbld10" align="center" style="font-size:12px;">12.75% - 13.25%</td>
		<td align="center"><form action="apply_cl_consent.php" method="POST" target="_blank" >
		<input type="hidden" name="cl_requestid" value="<? //echo $leadid; ?>" id="cl_requestid">
		<input type="hidden" name="cl_bank_name" id="cl_bank_name" value="Corporation Bank">
		<input type="submit" style="width: 300px; height: 25px; border: 0px none ; cursor:pointer; background-image: url(/new-images/nego_bnk.jpg); margin-bottom: 0px; background-repeat:no-repeat; background-color:#FFFFFF;" value="" />
		</form></td>
		</tr>	
		<tr style="border-top:1px #000000 solid;"><td colspan="3" style="border-top:1px #000000 solid;">&nbsp;</td>
		</tr>
		<tr style="border-top:1px #dbf2ff solid; border-bottom:1px #dbf2ff solid;">
		<td class="fontbld10" align="center" height="45" style="font-size:12px;">Dena Bank
		</td>
		<td class="fontbld10" align="center" style="font-size:12px;">13.75% - 14.25%</td>
		<td align="center"><form action="apply_cl_consent.php" method="POST" target="_blank" >
		<input type="hidden" name="cl_requestid" value="<? //echo $leadid; ?>" id="cl_requestid">
		<input type="hidden" name="cl_bank_name" id="cl_bank_name" value="Dena Bank">
		<input type="submit" style="width: 300px; height: 25px; border: 0px none ; cursor:pointer; background-image: url(/new-images/nego_bnk.jpg); margin-bottom: 0px; background-repeat:no-repeat; background-color:#FFFFFF;" value="" />
		</form></td>
		</tr>	
		<tr style="border-top:1px #000000 solid;"><td colspan="3" style="border-top:1px #000000 solid;">&nbsp;</td>
		</tr>-->

		
		</table>
		

	<? 
		$rchtime= Date('H:i:s');

		$R_URL="thank_cl_direct.php?leadid=$leadid&city=$strCity";

	if(strlen($R_URL)>0)

	{

		Header("Refresh: 7 URL=".$R_URL);

	}
	 }

	
	?>

 </div>
 <div align="center" style="padding-top:30px;">
 		<?php if($ABMMU_flag==1)
  { 
	 
	  $inptstr="Id=".$leadid."&Lead=Deal&fname=".$First."&lname=".$Last."&emailid=".$Email."&dob=&ext=extra&no=".$Mobile_Number;
$outputstr = base64_encode($inptstr);

	  ?>
  <table align="center">
  <tr>
    <td valign='top'  class='tbl_txt' style='font-weight:bold;font-size:14px; padding-top:10px;' align="center" >Please Continue to complete the Registeration Process (30 days free trial of MyUniverse)</td>
  </tr>
  <tr><td align="center">  <img src="../new-images/ajax-loader.gif" width="220" height="19" /></td></tr></table>

  	<iframe width="955" height="800" src="https://www.myuniverse.co.in/sitepages/newregistration.aspx?otptstr=<? echo $outputstr; ?>" frameborder="1"> </iframe>
  <? } ?>
  </div>
 <div style="clear:both; height:15px;"></div>
 </div>
 
<?php include "footer1.php"; ?>

<?
if((strlen(strpos($_SESSION['final_url'], "honda_car_loan.php")) > 0))
{
?>	 

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