<?php
session_start();
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	
	$page_Name = "LandingPage_HL";

function getProductName($pKey){
	$titles = array(
		'Req_Loan_Personal' => 'Personal Loan',
		'Req_Loan_Home' => 'Home Loan',
		'Req_Loan_Car' => 'Car Loan',
		'Req_Credit_Card' => 'Credit Card',
		'Req_Loan_Against_Property' => ' Loan Against property',
		'Req_Life_Insurance' => 'Insurance',
	);

	foreach ($titles as $key=>$value)
	    if($pKey==$key)
		return $value;

	return "";
   }
	

	function getReqValue($pKey){
	$titles = array(
		'Req_Loan_Personal' => 'personal',
		'Req_Loan_Home' => 'home',
		'Req_Loan_Car' => 'car',
		'Req_Credit_Card' => 'cc',
		'Req_Loan_Against_Property' => 'property',
		'Req_Life_Insurance' => 'insurance'
	);

	foreach ($titles as $key=>$value)
	    if($pKey==$key)
		return $value;

	return "";
   }

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{

	$Name = $_POST['Name'];
	$Activate = $_POST['Activate'];
	$Phone = $_POST['Phone'];
	$Email = $_POST['Email'];
	$City = $_POST['City'];
	$City_Other = $_POST['City_Other'];
	$Net_Salary = $_POST['Net_Salary'];
	$Loan_Amount = $_POST['Loan_Amount'];
	$Type_Loan = $_POST['Type_Loan'];
	$source = $_POST['source'];
	$Creative = $_POST['creative'];
	$Section = $_POST['section'];
	$Accidental_Insurance = $_POST['Accidental_Insurance'];
	
	$Referrer=$_REQUEST['referrer'];

	$lastURL = $_POST['URL'];
		$bank_name_all = $_POST['bank_name_all'];
		$bank_name = $_POST['bank_name'];
		if($bank_name_all =="All" || count($bank_name)<1)
		{
			$bank_name = array("SBI", "HDFC", "LIC Housing", "ICICI", "Axis Bank", "Punjab National Bank", "Standard Chartered", "First Blue Home Finance");
		}
		
		$bankStr = implode(",", $bank_name);
	

	//$Reference_Code = generateNumber(4);
	$IP = getenv("REMOTE_ADDR");
	$IsPublic = 1;
	if($Activate>0)
	{
		$DeleteIncompleteSql = "Delete from Req_Incomplete_Lead where IncompeletID=".$Activate;		
		$deleterowcount=Maindeletefunc($DeleteIncompleteSql,$array = array());
	}
	
function InsertTataAig($RequestID, $ProductName)
	{
	$GetDateSql = "select Dated, City, City_Other, Mobile_Number from ".$ProductName." where RequestID = $RequestID";
		list($alreadyExist,$RowGetDate)=MainselectfuncNew($GetDateSql,$array = array());
		$RowGetDatecontr=count($RowGetDate)-1;
		$Dated = ExactServerdate();
		$TDated = $RowGetDate[$RowGetDatecontr]['Dated'];
		$TCity = $RowGetDate[$RowGetDatecontr]['City'];
		$Mobile = $RowGetDate[$RowGetDatecontr]['Mobile_Number'];
		$Product_Name = "2";
		
		$dataInsert = array("T_RequestID"=>$RequestID , "T_Product"=>$Product_Name , "T_City"=>$TCity , "Mobile_Number"=>$Mobile , "T_Dated"=>$Dated );
		$table = 'tataaig_leads';
		$insert = Maininsertfunc ($table, $dataInsert);

	}


		$crap = " ".$Name." ".$Email." ".$City_Other;
		//echo $crap,"<br>";
		$crapValue = validateValues($crap);
		$_SESSION['crapValue'] = $crapValue;
		//exit();
		if($crapValue=='Put')
		{
		$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-30, date("Y"));
			$days30date=date('Y-m-d',$tomorrow);
			$days30datetime = $days30date." 00:00:00";
			$currentdate= date('Y-m-d');
			$currentdatetime = date('Y-m-d')." 23:59:59";
			
			$getdetails="select RequestID From ".$Type_Loan."  Where (Mobile_Number not in (9971396361,9811215138,9891118553) and Mobile_Number='".$Phone."' and Updated_Date between '".$days30datetime."' and '".$currentdatetime."') order by RequestID DESC";
			list($alreadyExist,$myrow)=MainselectfuncNew($getdetails,$array = array());
			$myrowcontr=count($myrow)-1;
			if($alreadyExist>0)
			{
				$ProductValue = $myrow[$myrowcontr]["RequestID"];
				$_SESSION['Temp_LID'] = $ProductValue;
				echo "<script language=javascript>"." location.href='update-home-loan-lead.php'"."</script>";
			}
			else
			{
			$CheckSql = "select UserID from wUsers where Email = '".$Email."'";
			list($CheckNumRows,$CheckQuery)=MainselectfuncNew($CheckSql,$array = array());
			$CheckQuerycontr=count($CheckQuery)-1;
			$Dated = ExactServerdate();
			if($CheckNumRows>0)
			{
				$UserID = $CheckQuery[$CheckQuerycontr]['UserID'];
				$dataArray = array('UserID'=>$UserID, 'Name'=>$Name, 'Email'=>$Email, 'City'=>$City, 'City_Other'=>$City_Other, 'Mobile_Number'=>$Phone, 'Net_Salary'=>$Net_Salary, 'Loan_Amount'=>$Loan_Amount, 'Dated'=>$Dated, 'source'=>$source, 'Referrer'=>$Referrer, 'Creative'=>$Creative, 'Section'=>$Section, 'IP_Address'=>$IP, 'Reference_Code'=>$Reference_Code, 'Updated_Date'=>$Dated, 'Accidental_Insurance'=>$Accidental_Insurance, 'PL_Bank'=>$bankStr, 'Employment_Status'=>'1');
			//	echo "<br>if".$InsertProductSql;
			}
			else
			{
				$wUsersdata = array("Email"=>$Email, "FName"=>$Name, "Phone"=>$Phone, "Join_Date"=>$Dated, "IsPublic"=>$IsPublic);
				$UserID = Maininsertfunc("wUsers", $wUsersdata);
				$dataArray = array('UserID'=>$UserID, 'Name'=>$Name, 'Email'=>$Email, 'City'=>$City, 'City_Other'=>$City_Other, 'Mobile_Number'=>$Phone, 'Net_Salary'=>$Net_Salary, 'Loan_Amount'=>$Loan_Amount, 'Dated'=>$Dated, 'source'=>$source, 'Referrer'=>$Referrer, 'Creative'=>$Creative, 'Section'=>$Section, 'IP_Address'=>$IP, 'Reference_Code'=>$Reference_Code, 'Updated_Date'=>$Dated, 'Accidental_Insurance'=>$Accidental_Insurance, 'PL_Bank'=>$bankStr, 'Employment_Status'=>'1');
				//echo "<br>else".$InsertProductSql;
			}
			$ProductValue = Maininsertfunc ($$Type_Loan, $dataArray);
			$_SESSION['Temp_LID'] = $ProductValue;
			//exit();
			if($Accidental_Insurance=="1")
				{
					InsertTataAig($ProductValue, "Req_Loan_Home");
				}
			
			list($First,$Last) = split('[ ]', $Name);

			//echo "heelo";
			$SMSMessage = "Dear $First,Thanks for applying at Deal4loans for Home loan.";
			if(strlen(trim($Phone)) > 0)
				//SendSMS($SMSMessage, $Phone);
			NewAir2webSendSMS($SMSMessage, $Phone, 2, $ProductValue);
			
			
			//Code Added to mailtocommonscript.php
			$FName = $Name;
			$Checktosend="getthank_individual";
			include "scripts/mailatcommonscript.php";

			$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
			$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			
			if($FName)
				$SubjectLine = $FName.", Learn to get Best Deal on ".getProductName($Type_Loan);
			else
				$SubjectLine = "Learn to get Best Deal on ".getProductName($Type_Loan);
			//echo $Type_Loan;
			if(isset($Type_Loan))
			{
				mail($Email, $SubjectLine, $Message2, $headers);
			}
			
			}	
			

		}//$crap Check
		else if($crapValue=='Discard')
		{
			header("Location: Redirect.php");
			exit();
		}
		else
		{
			header("Location: Redirect.php");
			exit();
		}
	
}	

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>  
<title>Home Loan</title>
<meta name="verify-v1" content="iC5qAw9C0E3rRZYbtAKvnPHmBSQU3zWJu5Ooj8hO3Og=">
<link href="source.css" rel="stylesheet" type="text/css" />
<link href="css/sbi-home-loan-styles.css" type="text/css" rel="stylesheet" />
<link href="css/sbihl-cont.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="scripts/mainmenu.js"></script>
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
<style type="text/css">
<!--
.style1 {font-family: 'Droid Sans', sans-serif}
.style2 {font-size: 12px; font-variant: normal; color: #666666; text-decoration: none; @import url(http://fonts.googleapis.com/css?family=Droid+Sans);font-family: 'Droid Sans', sans-serif;}
-->
</style>
</head>
<body>
<!--top-->
<div class="sbi-hl_header">
<?php include "top-menu.php"; ?>
<!--top-->

<!--logo navigation-->
<?php include "main-menu.php"; ?>
<!--logo navigation-->
</div>
<div class="sbi-hl_wraper_box">
<div class="sbi-hl_logo"><img src="images/logo.gif" width="243" height="90" /></div>
<div style="clear:both;"></div>
<div class="text12" style="margin:auto; width:100%; height:11px; margin-top:11px; color:#0a8bd9;"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> > <a href="home-loan-banks.php"  class="text12" style="color:#4c4c4c;">Compare Home loan Banks</a></u> >  <span  class="text12" style="color:#4c4c4c;"> Home Loan</span></div>
<div class="intrl_txt">
<div style="width:100%; height:33; margin-top:10px; float:left; clear:right; border-bottom:thin solid #88a943; ">
<h1 class="text3"  style="width:100%; height:33; margin-top:0px; float:left; clear:right; font-size:20px; text-transform:none; color:#88a943; "><strong><span style="color:#8dae48;"></span>Step 2 - To Get Online quote from All Banks-Please Input further Details</strong></h1>
</div>

<div style="clear:both; height:5px;"></div>
<div id="txt" style="margin-left:2px;">

<?php
//print_r($_SESSION);
 	include "home_loan_form_continue1.php";?>

<div style="margin-top:5px;">
  <p><br/>

    <span class="tbl_txt"><b>Disclaimer :</b> Please note that the interest rates and  eligibility criteria given here are based on the market research. To enable the  comparisons certain set of data has been reorganized / restructured / tabulated  .Users are advised to recheck the same with the individual companies /  organizations. This site does not take any responsibility for any sudden /  uninformed changes in interest rates.</span></p></div></div>

<div style="clear:both; height:15px;"></div>
</div></div>
<!-- Google Code for sbi home loan Conversion Page -->

<script type="text/javascript">

/* <![CDATA[ */

var google_conversion_id = 1066264455;

var google_conversion_language = "en";

var google_conversion_format = "2";

var google_conversion_color = "ffffff";

var google_conversion_label = "nwPDCP3N0wEQh8-3_AM";

var google_conversion_value = 0;

/* ]]> */

</script>

<script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js">

</script>

<noscript>

<div style="display:inline;">

<img height="1" width="1" style="border-style:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/1066264455/?value=0&amp;label=nwPDCP3N0wEQh8-3_AM&amp;guid=ON&amp;script=0"/>

</div>

</noscript>
<div class="responsive_ad" align="center"><br />
<script type="text/javascript"><!--
google_ad_client = "ca-pub-6880092259094596";
/* Mobile Ad */
google_ad_slot = "5395826842";
google_ad_width = 234;
google_ad_height = 60;
//-->
</script>
<script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>

</div>
<div class="sbi-hl_header">
<?php include "footer_hl.php"; ?>
</div>
</body>
</html>