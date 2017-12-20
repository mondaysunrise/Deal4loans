<?php
//ob_start();
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';

	$urltype=$_REQUEST["urltype"];

	if($urltype=="httpsurl")
{	require 'scripts/functionshttps.php'; 

}
else
{	require 'scripts/functions.php'; }

	//require 'soapservice_cfl_pl.php';

//print_r($_POST);
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		foreach($_POST as $a=>$b)
			$$a=$b;
		$first_name = FixString($first_name);
		$middle_name = FixString($middle_name);
		$last_name = FixString($last_name);
		$full_name = $first_name." ".$last_name;
		$day = FixString($day);
		$month = FixString($month);
		$year = FixString($year);
		$dob= $year."-".$month."-".$day;
		$Gender = FixString($Gender);
		$marital_status = FixString($MaritalStatus);
		$annual_income = FixString($annual_income);
		$company_name = FixString($company_name);
		$resiaddress = FixString($resiaddress1);
		$pincode = FixString($pincode);
		$office_address = FixString($OfficeAddress1);
		$OfficePin = FixString($OfficePin);
		$requestid = FixString($requestid);
		$panno = FixString($panno);
		$Dated=ExactServerdate();

if(strlen($full_name)>0 && $requestid>0)
	{
	$getdetails="select capitalfirstid From apply_pl_capitalfirst Where (capitalfirst_requestid='".$requestid."') order by capitalfirstid DESC";
	list($alreadyExist,$myrow)=MainselectfuncNew($getdetails,$array = array());
	if($alreadyExist>0)
	{
	}
	else
	{
$data = array("capitalfirst_name" => $full_name, "capitalfirst_dob" => $dob, "capitalfirst_marital_stat" => $marital_status, "capitalfirst_current_address" => $resiaddress, "capitalfirst_annual_income" => $annual_income, "capitalfirst_company_name" => $company_name, "capitalfirst_office_address" => $office_address, "capitalfirst_panno" => $panno, "capitalfirst_requestid" => $requestid, "capitalfirst_dated"=> $Dated, "direct_flag"=>'1', "capitalfirst_officepincode"=> $OfficePin, "capitalfirst_gender"=>$Gender, "capitalfirst_resipincode"=>$pincode);
//print_r($data);
 $ProductValue = Maininsertfunc("apply_pl_capitalfirst", $data);
if($requestid>0)
		{
			$getpldetails="select City,City_Other,Mobile_Number,Email,Employment_Status From Req_Loan_Personal Where ( RequestID='".$requestid."') order by RequestID DESC";
			list($plalreadyExist,$plrow)=MainselectfuncNew($getpldetails,$array = array());
			$myrowcontr=count($plrow)-1;
			$Mobile_Number = $plrow[$myrowcontr]['Mobile_Number'];
			$Email = $plrow[$myrowcontr]['Email'];
			$City = $plrow[$myrowcontr]['City'];
			$City_Other = $plrow[$myrowcontr]['City_Other'];
			$Employment_Status = $plrow[$myrowcontr]['Employment_Status'];
			if($City=="Others" && strlen($City_Other)>0)
			{				$strcity=$City_Other;			}
			else
			{				$strcity=$City;			}
		}
if($ProductValue>0)	{
	//echo $strcity." - ".$full_name." - ".$pincode." - ".$Gender." - ".$marital_status." - ".$dob." - ".$Email." - ".$panno." - ".$resiaddress."-".$Mobile_Number."<br><br>";
//$firststatus=cflfirstserv($strcity,$full_name,$pincode,$gender,$marital_status,$dob,$Email,$panno,$resiaddress, $Mobile_Number);
if($ProductValue>0)
	{
	if($Employment_Status==1)
		{
			$stroccupation="Salaried";
		}else {$stroccupation="Self Employed";}
		if(strlen($company_name)>2) {$companyname=$company_name;}else	{ $companyname="Self Employed";		}
		$DataArray = array("first_webservice" => $firststatus,"first_webdated"=> $Dated, "direct_webserviceflag"=>'1',"capitalfirst_occupation"=>$stroccupation,"capitalfirst_company_name" => $companyname);
		$wherecondition ="(capitalfirst_requestid=".$requestid.")";
//print_r($DataArray);
		Mainupdatefunc ('apply_pl_capitalfirst', $DataArray, $wherecondition);
	}
	}

	}
}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>
<style type="text/css">
.heading_text{font: bold 18px/100% Arial, Helvetica, sans-serif; color:#AE1518; margin-left:15px; }
.capital-first{ color:#0199cd; font-family:Arial, Helvetica, sans-serif; font-size:13px; font-weight:bold;}
#sidebar {
	width: 340px;
	float: right;
	margin: 30px 0 30px;
}
#content {
	background: #fff;
	margin: 30px 0 30px 20px;
	padding: 10px;
	width: 570px;
	float: left;
	/* rounded corner */
	-webkit-border-radius: 8px;
	-moz-border-radius: 8px;
	border-radius: 8px;
	/* box shadow */
	-webkit-box-shadow: 0 1px 3px rgba(0,0,0,.4);
	-moz-box-shadow: 0 1px 3px rgba(0,0,0,.4);
	box-shadow: 0 1px 3px rgba(0,0,0,.4);
}
.widget {
	background: #fff;
	margin: 0 0 30px;
	padding: 10px 20px;
	/* rounded corner */
	-webkit-border-radius: 8px;
	-moz-border-radius: 8px;
	border-radius: 8px;
	/* box shadow */
	-webkit-box-shadow: 0 1px 3px rgba(0,0,0,.4);
	-moz-box-shadow: 0 1px 3px rgba(0,0,0,.4);
	box-shadow: 0 1px 3px rgba(0,0,0,.4);
}
.capital-first_txtinput{width:100%;  border-radius:5px 5px 5px 5px; border: 1px solid #AE1518;}
.capital-first_input{width:100%; height:25px; border-radius:5px 5px 5px 5px; border: solid 2px #0199cd;}
.capital-first_input{width:100%;  border-radius:5px 5px 5px 5px; border: solid 2px #0199cd;}

.sbi_text_bullet ul{ padding:0px 0px 0px 0px; margin:0px 0px 0px 0px}
.sbi_text_bullet li{color:#AE1518; font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; list-style: url(/new-images/sbi_bullet1.jpg); margin-left:15px; line-height:25px; }
.sbi_text_bullet li a{color:#AE1518; font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold;}

.capital-first {
    color: #333;
    font-family: Arial, Helvetica, sans-serif;
    font-size: 13px;
    font-weight: bold;
}
.capital-first_input {
    width: 100%;
    height: 25px;
    border-radius: 5px 5px 5px 5px;
    border: solid 1px #AE1518;}
	
	.capital-first_input-one {
    width:31%;
    height: 25px;
    border-radius: 5px 5px 5px 5px;
    border: solid 1px #AE1518;}
	.capital-first_select-one {
    width:31.5%;
    height: 27px;
    border-radius: 5px 5px 5px 5px;
    border: solid 1px #AE1518;}
	
	.capital-first_input{
    width: 100%;
    border-radius: 5px 5px 5px 5px;
    border:solid 1px #AE1518;}
	
	@media screen and (max-width: 800px){
.heading_text{font: bold 18px/100% Arial, Helvetica, sans-serif; color:#AE1518; margin-left:15px; }
.capital-first{ color:#0199cd; font-family:Arial, Helvetica, sans-serif; font-size:13px; font-weight:bold;}
#sidebar {
	width:90%;
	float:none;
	margin: 30px 0 30px;
}
#content {
	background: #fff;
	margin: 30px 0 30px 20px;
	padding: 10px;
	width:90%;
	float:none;
	/* rounded corner */
	-webkit-border-radius: 8px;
	-moz-border-radius: 8px;
	border-radius: 8px;
	/* box shadow */
	-webkit-box-shadow: 0 1px 3px rgba(0,0,0,.4);
	-moz-box-shadow: 0 1px 3px rgba(0,0,0,.4);
	box-shadow: 0 1px 3px rgba(0,0,0,.4);
}

.widget {
	background: #fff;
	margin: 0 0 30px;
	padding: 10px 20px;
	/* rounded corner */
	-webkit-border-radius: 8px;
	-moz-border-radius: 8px;
	border-radius: 8px;
	/* box shadow */
	-webkit-box-shadow: 0 1px 3px rgba(0,0,0,.4);
	-moz-box-shadow: 0 1px 3px rgba(0,0,0,.4);
	box-shadow: 0 1px 3px rgba(0,0,0,.4);
}
.capital-first_input{width:100%; height:25px; border-radius:5px 5px 5px 5px; border: solid 2px #0199cd;}
.capital-first_txtinput{width:100%;  border-radius:5px 5px 5px 5px; border:1px solid #AE1518;}

.sbi_text_bullet ul{ padding:0px 0px 0px 0px; margin:0px 0px 0px 0px}
.sbi_text_bullet li{color:#AE1518; font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; list-style: url(/new-images/sbi_bullet1.jpg); margin-left:15px; line-height:25px; }
.sbi_text_bullet li a{color:#AE1518; font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold;}

.capital-first {
    color: #333;
    font-family: Arial, Helvetica, sans-serif;
    font-size: 13px;
    font-weight: bold;
}
.capital-first_input {
    width: 100%;
    height: 25px;
    border-radius: 5px 5px 5px 5px;
    border: solid 1px #AE1518;}
	
	.capital-first_input-one {
    width:98%;
    height: 25px;
    border-radius: 5px 5px 5px 5px;
    border: solid 1px #AE1518;}
	.capital-first_select-one {
    width:98%;
    height: 27px;
    border-radius: 5px 5px 5px 5px;
    border: solid 1px #AE1518;}
	
	.capital-first_input{
    width: 100%;
    border-radius: 5px 5px 5px 5px;
    border:solid 1px #AE1518;}
	
	}
</style>
<style type="text/css">
.heading_text1 {font: bold 20px/100% Arial, Helvetica, sans-serif; color:#AE1518; margin-left:20px; }
</style>
<script type="text/javascript" src="scripts/mainmenu.js"></script>
</head>
<body>
<?php include "middle-menu.php"; ?>
<div style="clear:both;"></div>
<div class="cc_inner_wrapper">
<div style="clear:both;"></div>
<div class="common-bread-crumb" style="margin:auto; width:74%; margin-top:70px; color:#0a8bd9;"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> > <a href="#"  class="text12" style="color:#0080d6;"><u>Personal Loan</u></a> <span class="text12" style="color:#4c4c4c;">> Apply for Capital First</span></div>
<div style="clear:both; height:15px;"></div>
<div style="max-width:995px;  margin:auto;">
<div id="content">
<table align="center"  cellpadding="5" cellspacing="0"  width="100%">
<tr><td width="478" align="left" height="200"  valign="top" bgcolor="#FFFFFF" class="heading_text">Thank you for applying Capital first.</td></tr>
    </table></div>    
    <div id="sidebar">
    <div class="widget">
      <table width="100%" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td width="58%" height="40" class="heading_text1" style="font-size:18px;"><span class="heading_text_b">Why Capital First?</span></td>
          <td width="42%" align="right" class="heading_text1" style="font-size:18px;"><img src="http://www.deal4loans.com/homeimages/capital-first-logo-index.png" /></td>
        </tr>
        <tr>
          <td colspan="2" style="color:#999; font-family:Verdana, Geneva, sans-serif; font-size:12px;">&nbsp;</td>
        </tr>
      </table>
      <div class="sbi_text_bullet">
  <ul>
  <li>Only KYC Documents required <br> <div style="font-size:11px; color:#999; font-weight:normal; line-height:15px;">Get loan basis your KYC documents only, no need to submit any financial documents like salary slip, ITR, form 16 etc.</div></li>
<li>Get online in-principle approval <br><div style="font-size:11px; color:#999; font-weight:normal; line-height:15px;"> Just provide your basic Personal/Professional details to get instant approval on your Personal Loan</div></li>
<li>Loans up to Rs.4 lacs<br/></li>
<li>Disbursal in 3 working days</li>
</ul>  
</div>
    </div>
    </div>
</div>
<div style="clear:both;"></div>
<!--partners-->
<?php include("footer_sub_menu.php"); ?>
</body>
</html>