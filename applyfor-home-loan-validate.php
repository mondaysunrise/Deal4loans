<?php
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
//print_r($_POST);
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{

	$Name = FixString($_POST['Name']);
	$Activate = FixString($_POST['Activate']);
	$Phone = FixString($_POST['Phone']);
	$Email = FixString($_POST['Email']);
	$City = FixString($_POST['City']);
	$City_Other = FixString($_POST['City_Other']);
	$Net_Salary = FixString($_POST['IncomeAmount']);
	$Loan_Amount = FixString($_POST['Loan_Amount']);
	$Type_Loan = FixString($_POST['Type_Loan']);
	$source = FixString($_POST['source']);
	$Creative = FixString($_POST['creative']);
	$Section = FixString($_POST['section']);
	$Accidental_Insurance = FixString($_POST['Accidental_Insurance']);
	$Referrer=FixString($_REQUEST['referrer']);
	//$Reference_Code = generateNumber(4);
	$IP_Remote = getenv("REMOTE_ADDR");
	if($IP_Remote=='192.99.32.74') { $IP= $_SERVER['HTTP_X_REAL_IP']; }
	else { $IP=$IP_Remote;	}
	$hdfclife = FixString($_REQUEST['hdfclife']);
	$mahindra_life = FixString($_REQUEST["mahindra_life"]);
	$Reference_Code = generateNumber(4);
	$Dated=ExactServerdate();

	

	$IsPublic = 1;
	if($Activate>0)
	{
		$DeleteIncompleteSql = "Delete from Req_Incomplete_Lead where IncompeletID=".$Activate;		
		$deleterowcount=Maindeletefunc($DeleteIncompleteSql,$array = array());
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
			
			$getdetails="select RequestID From ".$Type_Loan."  Where (Mobile_Number not in (9811215138,9811555306) and Mobile_Number='".$Phone."' and Updated_Date between '".$days30datetime."' and '".$currentdatetime."') order by RequestID DESC";
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
			list($alreadyExist,$myrow)=MainselectfuncNew($CheckSql,$array = array());
			$myrowcontr = count($myrow)-1;
			$CheckNumRows = $alreadyExist;
			$Dated=ExactServerdate();
			if($CheckNumRows>0)
			{
				$UserID = $myrow[$myrowcontr]["UserID"];
				$data = array("UserID"=>$UserID, "Name"=>$Name, "Email"=>$Email, "City"=>$City, "City_Other"=>$City_Other, "Mobile_Number"=>$Phone, "Net_Salary"=>$Net_Salary, "Loan_Amount"=>$Loan_Amount, "Dated"=>$Dated, "source"=>$source, "Referrer"=>$Referrer, "Creative"=>$Creative, "Section"=>$Section, "IP_Address"=>$IP_Address, "Reference_Code"=>$Reference_Code,"Updated_Date"=>$Dated,"Accidental_Insurance"=>$Accidental_Insurance);
			//	echo "<br>if".$InsertProductSql;
			}
			else
			{
				$wUsersdata = array("Email"=>$Email, "FName"=>$Name, "Phone"=>$Phone, "Join_Date"=>$Dated, "IsPublic"=>$IsPublic);
				$UserID = Maininsertfunc ('wUsers', $wUsersdata);
				$data = array("UserID"=>$UserID, "Name"=>$Name, "Email"=>$Email, "City"=>$City, "City_Other"=>$City_Other, "Mobile_Number"=>$Phone, "Net_Salary"=>$Net_Salary, "Loan_Amount"=>$Loan_Amount, "Dated"=>$Dated, "source"=>$source, "Referrer"=>$Referrer, "Creative"=>$Creative, "Section"=>$Section, "IP_Address"=>$IP_Address, "Reference_Code"=>$Reference_Code,"Updated_Date"=>$Dated,"Accidental_Insurance"=>$Accidental_Insurance);
				//echo "<br>else".$InsertProductSql;
			}
			
			$ProductValue = Maininsertfunc ($Type_Loan, $data);	

		if(strlen($Phone)>1)
		{
			$SMScampMessage = "Please use this code: ".$Reference_Code." to activate your loan request at deal4loans.com";

		if(strlen(trim($Phone)) > 0)
				SendSMSforLMS($SMScampMessage, $Phone);
		}


if($City=="Others")
		{
			$strcity = $City_Other;
		}
		else
		{
			$strcity=$City;
		}
	
			list($First,$Last) = split('[ ]', $Name);

			//echo "heelo";
			$SMSMessage = "Dear $First,Thanks for applying at Deal4loans for Home loan.";
			if(strlen(trim($Phone)) > 0)
				//SendSMS($SMSMessage, $Phone);
			//NewAir2webSendSMS($SMSMessage, $Phone, 2, $ProductValue);
					
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
<html>
<head>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
</head>
<body>
<div id="pagewrap">
<header id="header_continue">
<div id="continue_logo"><img src="new-images/pl/deal4loans-continue-logo.jpg"></div></header>
<div style="clear:both;"></div>
<br><br>
<div class="pl_cont_text" style="color:#136071;" align="center">Get comparison on your EMI and Save</span>. Please verify your Mobile Number. <br />
  We have sent an activation code on <span style="color: #D02037;"><? echo $Phone; ?></div>
  <div id="continue_form" style="margin-top:10px;">
 <table width="60%" border="0" align="center" cellpadding="2" cellspacing="0">     
      <tr>
      <td colspan="2" align="center">
      <form name="bnrvalidate" method="POST" action="applyfor-home-loan-continue.php">
      <input type="hidden" value="<? echo $ProductValue;?>" name="hlrequestid" id="hlrequestid">
       <input type="hidden" value="<? echo $Reference_Code;?>" name="reference_code" id="reference_code">
	   <input type="hidden" value="<? echo $Name; ?>" name="name" id="name">
	   <input type="hidden" value="<? echo $Phone; ?>" name="Phone" id="Phone">
	   <input type="hidden" value="<? echo $City; ?>" name="City" id="City">
	   <input type="hidden" value="<? echo $Net_Salary; ?>" name="Net_Salary" id="Net_Salary">
	   <input type="hidden" value="<? echo $Loan_Amount; ?>" name="Loan_Amount" id="Loan_Amount">
	   <input type="hidden" value="<? echo $City_Other; ?>" name="City_Other" id="City_Other">
	   <input type="hidden" value="<? echo $source; ?>" name="source" id="source">
      <table cellpadding="5">
      <tr>
      	<td height="35">Activation Code</td>
        <td><input type="text" name="activation_code" id="activation_code"></td>
      </tr>
      <tr>
      	<td colspan="2" align="center" height="50"><input type="image" name="Submit"  src="new-images/pl/quote.gif"  style="width:115px; height:29px; border:none; " tabindex="13" /></td>
      </tr>
      </table>
      </form></td></tr>
  </table>
</div>
</div>
</body>
</html>