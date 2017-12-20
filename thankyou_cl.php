<?php
ob_start();
require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	require 'hrAppFunction.php';


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

	
	$BiddID  = array(1825);
	//echo $ProductValue."-".$strcity;
	$Bidds = getBiddersListCL(3,$leadid,$strCity,$BiddID);
//	print_r($Bidds);	
	$strFinalBidders = implode(",", $Bidds[0]);
	

if($leadid>0)
{
	$getdetails="select Is_Valid From Req_Loan_Car  Where RequestID='".$leadid."'" ;
	list($numRows,$getdetailsQuery)=Mainselectfunc($getdetails,$array = array());
	$Is_Valid = $getdetailsQuery[0]['Is_Valid'];
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
  $BiddID  = array(1825);
	//echo $ProductValue."-".$strcity;
	
list($FinalBidder,$finalBidderName)= getBiddersListCL(3,$leadid,$strCity,$BiddID);

$Final_Bid = "";
			while (list ($key,$val) = @each($FinalBidder)) { 
				$Final_Bid[]= $val; 
			} 
			
$Final_Name = "";
			while (list ($key,$val) = @each($finalBidderName)) { 
				$Final_Name[]= $val; 
			} 			
	//print_r($Final_Bid);
	if((count($Final_Bid)>0) && ($Is_Valid==1) && (strlen($Final_Bid[0])>0))
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
			{  
				
			?>

    	<tr style="border-top:1px #dbf2ff solid; border-bottom:1px #dbf2ff solid;">
			<td class="fontbld10" align="center" height="45" style="font-size:12px;">
			HDFC Bank</td>
			<td class="fontbld10" align="center" style="font-size:12px;">11.50% - 14.25%</td>
			<td align="center"><form action="apply_cl_consent.php" method="POST" target="_blank" >
			 <input type="hidden" name="cl_requestid" value="<? echo $leadid; ?>" id="cl_requestid">
		    <input type="hidden" name="cl_bank_name" id="cl_bank_name" value="<? echo $Final_Bid[$i]; ?>">
			<input type="submit" style="width: 300px; height: 25px; border: 0px none ; cursor:pointer; background-image: url(/new-images/nego_bnk.jpg); margin-bottom: 0px; background-repeat:no-repeat; background-color:#FFFFFF;" value="" onClick="insertData(<? echo $i;?>);"/>
				  </form></td>
		  </tr>	

		<?	}
		?>
		
		</table>
		

	<? 
	 }
	else
	{
	?>
   <p>
 <div align="left" style="padding-bottom:20px;">
<span style="float:left; color:#000000; padding-left:4px;line-height:16px;" class="tbl_txt">
<strong>Dear Customer</strong>,<br />
Thank you for choosing Deal4Loans.com as your preferred Personal Financial Solution partner.<br />
We are sorry to inform you that currently there are no offers matching as per your profile.<br />
Our teams are continuously working towards getting better deals for our customers.<br />
</span></div>
</p>
	<?php
	}
	
	?>

 </div>


 </div>

 </div>
 
<?php include "footer1.php"; ?>


</body>
</html>