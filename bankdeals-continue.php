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
	$Net_Salary = $_POST['IncomeAmount'];
	$Loan_Amount = $_POST['Loan_Amount'];
	$Type_Loan = $_POST['Type_Loan'];
	$source = $_POST['source'];
	$Creative = $_POST['creative'];
	$Section = $_POST['section'];
	$Accidental_Insurance = $_POST['Accidental_Insurance'];
	$Employment_Status = $_POST['Employment_Status'];
	
	$Referrer=$_REQUEST['referrer'];

	$lastURL = $_POST['URL'];
	if((strlen(strpos($lastURL, "bankdeals1.php")) > 0))
	{
		$bank_name_all = $_POST['bank_name_all'];
		$bank_name = $_POST['bank_name'];
		if($bank_name_all =="All" || count($bank_name)<1)
		{
			$bank_name = array("SBI", "HDFC", "LIC Housing", "ICICI", "Axis Bank", "Punjab National Bank", "Standard Chartered", "First Blue Home Finance");
		}
		
		$bankStr = implode(",", $bank_name);
	}	

	//$Reference_Code = generateNumber(4);
	$IP = getenv("REMOTE_ADDR");
	$IsPublic = 1;
	if($Activate>0)
	{
		$DeleteIncompleteSql = "Delete from Req_Incomplete_Lead where IncompeletID=".$Activate;		
		Maindeletefunc($DeleteIncompleteSql,$array = array());
	}
	
function Insert_clientlead($ProductValue, $Name, $City, $Phone, $Email, $mahindra_life)
	{
		$Dated=ExactServerdate();
		$data = array("product_type"=>'2' , "requestid"=>$Product_Name , "clientld_name"=>$Name , "clientld_email"=>$Email , "clientld_mobile"=>$Phone, "clientld_city"=>$City , "client_name"=> 'mahindra_lifespace' , "clientld_date"=>$Dated , "client_splcondition"=>$Mobile );
		$table = 'client_campaign_leads';
		$insert = Maininsertfunc ($table, $data);
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
			$myrowcontr = count($myrow)-1;
			$checkNum = $alreadyExist;

			if($alreadyExist>0)
			{
				$ProductValue = $myrow[$myrowcontr]["RequestID"];
				$_SESSION['Temp_LID'] = $ProductValue;
				echo "<script language=javascript>"." location.href='update-home-loan-lead.php'"."</script>";
			}
			else
			{
			$CheckSql = "select UserID from wUsers where Email = '".$Email."'";
			list($CheckNumRows,$myrow)=MainselectfuncNew($CheckSql,$array = array());
			$myrowcontr = count($myrow)-1;
			$Dated=ExactServerdate();
			if($CheckNumRows>0)
			{
				$UserID = $myrow[$myrowcontr]["UserID"];
			//	$InsertProductSql = "INSERT INTO ".$Type_Loan." (UserID, Name, Email, City, City_Other, Mobile_Number, Net_Salary, Loan_Amount, Dated, source,  Referrer, Creative, Section, IP_Address, Reference_Code,Updated_Date,Accidental_Insurance,PL_Bank,Employment_Status) VALUES ( '$UserID', '$Name', '$Email', '$City', '$City_Other', '$Phone', '$Net_Salary', '$Loan_Amount', Now(), '$source', '$Referrer', '$Creative' , '$Section', '$IP', '$Reference_Code', Now(),'$Accidental_Insurance', '".$bankStr."', '".$Employment_Status."' )"; 

				$data = array("UserID"=>$UserID, "Name"=>$Name, "Email"=>$Email, "City"=>$City, "City_Other"=>$City_Other, "Mobile_Number"=>$Phone, "Net_Salary"=>$Net_Salary, "Loan_Amount"=>$Loan_Amount, "Dated"=>$Dated, "source"=>$source, "Referrer"=>$Referrer, "Creative"=>$Creative, "Section"=>$Section, "IP_Address"=>$IP_Address, "Reference_Code"=>$Reference_Code,"Updated_Date"=>$Dated,"Accidental_Insurance"=>$Accidental_Insurance, 'PL_Bank'=>$bankStr,'Employment_Status'=>$Employment_Status);

			//	echo "<br>if".$InsertProductSql;
			}
			else
			{
					$wUsersdata = array("Email"=>$Email, "FName"=>$Name, "Phone"=>$Phone, "Join_Date"=>$Dated, "IsPublic"=>$IsPublic);
				$UserID = Maininsertfunc ('wUsers', $wUsersdata);
				$data = array("UserID"=>$UserID, "Name"=>$Name, "Email"=>$Email, "City"=>$City, "City_Other"=>$City_Other, "Mobile_Number"=>$Phone, "Net_Salary"=>$Net_Salary, "Loan_Amount"=>$Loan_Amount, "Dated"=>$Dated, "source"=>$source, "Referrer"=>$Referrer, "Creative"=>$Creative, "Section"=>$Section, "IP_Address"=>$IP_Address, "Reference_Code"=>$Reference_Code,"Updated_Date"=>$Dated,"Accidental_Insurance"=>$Accidental_Insurance, 'PL_Bank'=>$bankStr,'Employment_Status'=>$Employment_Status);
			}
			
				$ProductValue = Maininsertfunc ($Type_Loan, $data);		
			$_SESSION['Temp_LID'] = $ProductValue;
			//exit();

		if($hdfclife==1)
		{
			$Product=2;
			$DOB="1980-01-01";
			Insert_HdfcLife($Name, $City, $Phone, $DOB, $Email, $Net_Salary, $Product, $ProductValue );
		}

		if(strlen($mahindra_life)>0)
		{
			Insert_clientlead($ProductValue, $Name, $strcity, $Phone, $Email, $mahindra_life );
		}
			
			list($First,$Last) = split('[ ]', $Name);

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
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>  
<title>Home Loan | Interest Rates | Documents | Apply</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<meta name="verify-v1" content="iC5qAw9C0E3rRZYbtAKvnPHmBSQU3zWJu5Ooj8hO3Og=">
<link href="source.css" rel="stylesheet" type="text/css" />
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

<?php include "top-menu.php"; ?>
<!--top-->

<!--logo navigation-->
<?php include "main-menu.php"; ?>
<!--logo navigation-->


<div class="text12" style="margin:auto; width:970px; height:11px; margin-top:11px; color:#0a8bd9;"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> > <a href="home-loan-banks.php"  class="text12" style="color:#4c4c4c;">Compare Home loan Banks</a></u> >  <span  class="text12" style="color:#4c4c4c;"> Home Loan</span></div>
<div class="intrl_txt">
<div style="width:970px; height:33; margin-top:10px; float:left; clear:right;">
<h1 class="text3"  style="width:800px; height:33; margin-top:0px; float:left; clear:right; font-size:20px; text-transform:none; color:#88a943; "><strong><span style="color:#8dae48;">Step 2</span> - To Get Online quote from All Banks-Please Input further Details</strong></h1>
</div>
<div style=" float:left; width:800px; height:1px;; margin-top:1px; "><img src="images/point5.gif" width="800" height="1" /></div>

<div style="clear:both; height:5px;"></div>
<div id="txt" style="margin-left:2px;">

<?php
	//print_r($_SESSION);
 include "home_loan_form_continue.php";?>

<div style="margin-top:5px;">
  <p><br/>

    <span class="tbl_txt"><b>Disclaimer :</b> Please note that the interest rates and  eligibility criteria given here are based on the market research. To enable the  comparisons certain set of data has been reorganized / restructured / tabulated  .Users are advised to recheck the same with the individual companies /  organizations. This site does not take any responsibility for any sudden /  uninformed changes in interest rates.</span></div></div>

<div style="clear:both; height:15px;"></div>
</div>
<?php include "footer_hl.php"; ?>

</body>
</html>