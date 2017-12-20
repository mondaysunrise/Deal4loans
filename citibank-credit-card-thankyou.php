<?php

require 'scripts/db_init.php';
require 'scripts/functions.php';

//print_r($_POST);

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$requestID = $_POST["requestID"];
	
	$Gender = $_POST["Gender"];
	$panno = $_POST["panno"];
	$City = $_POST["City"];
	$City_Other = $_POST["City_Other"];
	$housename = $_POST["housename"];
	$streeRoad = $_POST["streeRoad"]; //resi
	$areaLocality = $_POST["areaLocality"];//resi
	$landmark = $_POST["landmark"];//resi
	$resiaddress1 = $_POST["resiaddress1"];//resi
	$pincode = $_POST["pincode"];
	$Residence_Address = trim($housename)." ".trim($streeRoad)." ".trim($areaLocality)." ".trim($landmark);
	$buildingName = $_POST["buildingName"];
	$OffiStreet = $_POST["OffiStreet"];
	$OffiArea = $_POST["OffiArea"];
	$OffiLandmark = $_POST["OffiLandmark"];
	$Office_Address = trim($buildingName)." ".trim($OffiStreet)." ".trim($OffiArea)." ".trim($OffiLandmark);
	$OfficePin = $_POST["OfficePin"];
	$Land_linenumber = $_POST["Land_linenumber"];
	$OfficeCity = $_POST["OfficeCity"];
	$Phone_Number = $_POST["Phone_Number"];	
	$Qualification = FixString($_POST["Qualification"]);	
	$Designation = FixString($_POST["Designation"]);
	$CompanyName = FixString($_POST["company_name"]);
	$Mailing_Address = $_POST["mailAddr"];
	$card_name = $_POST["card_name"];
	$STD = "0".$_POST["STD"];
	$first_name = $_POST["first_name"];
	$middle_name = $_POST["middle_name"];
	$last_name = $_POST["last_name"];
	$full_name=$first_name." ".$middle_name."".$last_name;
	if($Land_linenumber=="Residence")
	{
		$Std_Code = $STD;
		$Landline = $Phone_Number;	
		$Std_Code_O=0;
		$Landline_O = 0;	
	}
	else
	{
		$Std_Code_O = $STD;
		$Landline_O = $Phone_Number;	
		$Std_Code = 0;
		$Landline = 0;	
	}
$getdetails='select compid From citibankcards_negative_complist Where ( company_name like "'.$CompanyName.'%")';
	list($alreadyExist,$myrow)=Mainselectfunc($getdetails,$array = array());
 	$compid=$myrow['compid'];

//for resi
$getpindetails="select citi_pincode From citibank_pincode_6250 Where ( citi_pincode='".$pincode."')";
	list($alreadyExist,$mypinrow)=Mainselectfunc($getpindetails,$array = array());
	 $citi_pincoderesi=$mypinrow['citi_pincode'];

//for offi
$getpinoffdetails="select citi_pincode From citibank_pincode_6250 Where ( citi_pincode='".$OfficePin."')";
	list($alreadyExist,$mypinofrow)=Mainselectfunc($getpinoffdetails,$array = array());
	 $citi_pincodeoff=$mypinofrow['citi_pincode'];

if($Designation=="Others" || $Designation=="Other" || $compid>0)
	{
	$send_status=0;
	}
	else
	{
		if($citi_pincoderesi>0 && $citi_pincodeoff>0)
		{
		$send_status=1;
		}
	}
//	echo "ff ".$send_status;
	$Dated=ExactServerdate();

$InsertProductSql= array("Name"=>$full_name, "Gender" => $Gender, "Pancard" => $panno, "Residence_Address" => $Residence_Address, "Office_Address" => $Office_Address, "Std_Code"=>$Std_Code, "Landline"=>$Landline, "Std_Code_O"=>$Std_Code_O, "Landline_O"=>$Landline_O);
$wherecondition ="(RequestID='".$requestID."')";
Mainupdatefunc("Req_Credit_Card", $InsertProductSql, $wherecondition);

//print_r($InsertProductSql);

if($requestID>0)
	{ 
$InsertProduct6250Sql= array("RequestID" => $requestID, "ResiHouseNo"=> $housename, "ResiStreetNo"=> $streeRoad, "ResiArea"=> $areaLocality, "ResiLandmark"=> $landmark, "OfficePin" => $OfficePin, "OfficeCity" => $OfficeCity, "OffiBuildingNo"=> $buildingName, "OffiStreetNo"=> $OffiStreet, "OffiArea"=> $OffiArea, "CardName" => $card_name, "Designation" => $Designation, "Dated" =>$Dated, "send_status"=>$send_status, "Mailing_Address"=> $Mailing_Address, "Qualification"=>$Qualification, "CompanyName"=>$CompanyName, "lms_flag"=>'0');
$Product6250Value = Maininsertfunc("citibank_credit_card_6250", $InsertProduct6250Sql);
	}

	//print_r($InsertProduct6250Sql);
}
?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Instant E Apply Credit Cards Online in India</title>
<meta name="keywords" content="online credit cards, online credit cards applications, Credit card comparison, online application of credit card, apply online credit cards, online credit card application" />
<meta name="description" content="Fill Application form for credit cards. Instant Apply & get Approval for Credit cards such as HDFC, ICICI, Citibank, Standard Chartered, SBI and American express Online in India." />
<meta name="verify-v1" content="iC5qAw9C0E3rRZYbtAKvnPHmBSQU3zWJu5Ooj8hO3Og=">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<link href="css/credit-card-styles.css" type="text/css" rel="stylesheet"  />
</head>
<body>
<?php include "middle-menu.php"; ?>
<div style="clear:both;"></div>
<div class="cc_inner_wrapper">
<div style="clear:both;"></div>
<div class="common-bread-crumb" style="margin:auto; width:100%; margin-top:70px; color:#0a8bd9;"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> > <a href="credit-cards.php"  class="text12" style="color:#0080d6;"><u>Credit Card</u></a> <span style="color:#4c4c4c;">> CitiBank Credit Card</span></div>
<div style="clear:both; height:10px;"></div>
<div style="clear:both; height:20px; width:100%; margin:auto; margin-top:10px; padding-top:10px; font-size:18px; color:#000; height:400px;">
Thank you for applying  for <? echo $card_name; ?>  through deal4loans, we will get back to you soon.

</div>
</div>
</div>
<div style="clear:both; height:100px;"></div>
<!--partners-->
<?php include("footer_sub_menu.php"); ?>
</body>
</html>
</body>
</html>
	