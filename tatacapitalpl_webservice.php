<?php
require 'scripts/db_init.php';

$pl_requestid = $_REQUEST['pl_requestid'];

$tataplqry="Select * from Req_Loan_Personal Where (RequestID=".$pl_requestid.")";
list($count,$row)=MainselectfuncNew($tataplqry,$array = array());

$Name = $row[0]["Name"];
list($first,$last) = split('[ ]',$Name);
$Email = $row[0]["Email"];
$Mobile_Number = $row[0]["Mobile_Number"];
$Pincode = $row[0]["Pincode"];
$Company_Name = $row[0]["Company_Name"];
$City = $row[0]["City"];
$City_Other = $row[0]["City_Other"];
if($City=="Others" && Strlen($City_Other)>0)
{
	$strcity=$City_Other;
}
else
{
	$strcity=$City;
}

if($last=="")
	{
		$last= $first;
		$first="Unknown";
	}
	
$xmlstr="<?xml version='1.0' encoding='utf-8'?>
<soap:Envelope xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance' xmlns:xsd='http://www.w3.org/2001/XMLSchema' xmlns:soap='http://schemas.xmlsoap.org/soap/envelope/'>
  <soap:Body>
    <createWebLeadInSage xmlns='http://tempuri.org/'>
      <strFirstName>".$first."</strFirstName>
      <strLastName>".$last."</strLastName>
      <strEmail>".$Email."</strEmail>
      <strGender>Male</strGender>
      <strMobileNo>".$Mobile_Number."</strMobileNo>
      <strHomePhone>NA</strHomePhone>
      <strAddLine1>NA</strAddLine1>
      <strAddLine2>NA</strAddLine2>
      <strCity>".$strcity."</strCity>
      <strPincode>".$Pincode."</strPincode>
      <strState>NA</strState>
      <strCompanyName>".$Company_Name."</strCompanyName>
      <strDesignation>NA</strDesignation>
      <strWorkEmail>NA</strWorkEmail>
      <strWorkPhone>NA</strWorkPhone>
      <strLeadDetails>NA</strLeadDetails>
      <strSalesOrg>NSO</strSalesOrg>
      <strLob>NSO</strLob>
      <strProduct>Personal Loans</strProduct>
      <strChannel>Deal4Loans</strChannel>
      <strLeadType>Individual</strLeadType>
      <strLeadTag>WarmLead</strLeadTag>
    </createWebLeadInSage>
  </soap:Body>
</soap:Envelope>"; 
//echo $xmlstr."<br>";
$url = 'https://apps2.tatacapital.com/WebServiceIntegration/SageWebServices.asmx';
// cURL's initialization
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 //curl_setopt($ch, CURLOPT_VERBOSE, 1); 
curl_setopt($ch, CURLOPT_TIMEOUT, 4);
curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlstr);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: text/xml','Content-Type: text/xml'));
$result = curl_exec($ch);
curl_close($ch);
$webfeedback=$result;
$expires = preg_split('/Lead id/', $webfeedback);
array_shift($expires);
$strcheck=implode(" ",$expires);
$check=explode(" ",$strcheck);
$Leadid=$check[0];
		$Dated = ExactServerdate();
	$data = array("leadid"=>$pl_requestid , "product"=>'1' , "feedback"=>$webfeedback, "bidderid"=>'TATA Capital' , "doe"=>$Dated);
		$table = 'webservice_bidder_details';
		$insert = Maininsertfunc ($table, $data);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Apply for Personal Loan  | Personal Loan Application | Personal Loans Comparison Chart</title>
<meta name="description" content="Apply for Credit Cards online: Get facility to apply directly for credit cards in all banks. Online Credit Card application form to get information about credit card schemes from all credit cards provider banks located in major cities of India like Mumbai, Delhi, Gurgaon, Bangalore, Ahmedabad, Chennai, Hyderabad, Navi Mumbai, Kochi etc.">
<meta name="keywords" content="Credit Card Application, Apply Credit Cards, Compare Credit Cards in Mumbai Hyderabad Pune kolkata Delhi Noida Bangalore">
<link href="source.css" rel="stylesheet" type="text/css" />
 <script type="text/javascript" src="scripts/mainmenu.js"></script>
 <script type="text/javascript" src="scripts/common.js"></script>
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
</style>
</head>
<body>
<?php include "top-menu.php"; ?>
<!--top-->
<!--logo navigation-->
<?php include "main-menu.php"; ?>
<!--logo navigation-->
<div class="text12" style="margin:auto; width:970px; height:11px; margin-top:11px; color:#0a8bd9;"><u><a href="index.html" class="text12" style="color:#0080d6;" >Home</a></u> > <a href="personal-loans.php"  class="text12" style="color:#0080d6;"><u>Personal Loan</u></a> <span class="text12" style="color:#4c4c4c;">> Apply for Personal Loan</span></div>
<div style="clear:both; height:1px;"></div>
<div style="clear:both; width:960px; margin:auto;  margin-top:2px;">
<div id="container">
  <div id="txt"  style="padding-top:15px; height:60px;">
   <h1 style="color:#ae4212 !important; margin:0px; padding:0px; font-size:13px !important; line-height:22px; padding-left:20px;" align="center"> Thanks for applying Personal Loan from Tata Capital through Deal4loans.com </h1>  <br>
   Your Reference ID <? echo $Leadid; ?>
</div>
</div>
<div style="clear:both; height:80px; width:964px; margin:auto; margin-top:10px;"></div>
</div>
<?php include "footer1.php"; ?>
</body>
</html>
