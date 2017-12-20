<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	require 'eligiblebidderfuncLAP.php';
	
	$page_Name = "LandingPage_LAP";

$R_URL=$_REQUEST['r_url'];
	if(strlen($R_URL)>0)
	{
		Header("Refresh: 5 URL=".$R_URL);
	}

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
	$day = $_POST['day'];
	$month = $_POST['month'];
	$year = $_POST['year'];
	$DOB= $year."-".$month."-".$day;
	$Activate = $_POST['Activate'];
	$Phone = $_POST['Phone'];
	$Email = $_POST['Email'];
	$City = $_POST['City'];
	$Pincode = $_POST['Pincode'];
	$City_Other = $_POST['City_Other'];
	$IncomeAmount = $_POST['IncomeAmount'];
	$Loan_Amount = $_POST['Loan_Amount'];
	$Type_Loan = $_POST['Type_Loan'];
	$Employment_Status = $_POST['Employment_Status'];
	$source = $_POST['source'];
	$Accidental_Insurance = $_POST['Accidental_Insurance'];
	$Creative = $_POST['creative'];
	$Section = $_POST['section'];
	$Referrer=$_REQUEST['referrer'];
	$Property_Value = $_POST['Property_Value'];
	$surrogate = $_POST['surrogate'];
	$IP = getenv("REMOTE_ADDR");
	$hdfclife = $_POST['hdfclife'];
	$IsPublic = 1;
	$Reference_Code = generateNumberNEWc(5);

	if($Activate>0)
	{
		$DeleteIncompleteSql = "Delete from Req_Incomplete_Lead where RequestID=".$Activate;		
		$deleterowcount=Maindeletefunc($DeleteIncompleteSql,$array = array());
	}
	
		$crap = " ".$Name." ".$Email." ".$City_Other;
		//echo $crap,"<br>";
		$crapValue = validateValues($crap);
		$_SESSION['crapValue'] = $crapValue;
		
		if($crapValue=='Put')
		{		
			$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-30, date("Y"));
			$days30date=date('Y-m-d',$tomorrow);
			$days30datetime = $days30date." 00:00:00";
			$currentdate= date('Y-m-d');
			$currentdatetime = date('Y-m-d')." 23:59:59";
			
			$getdetails="select RequestID From Req_Loan_Against_Property  Where (Mobile_Number='".$Phone."' and Updated_Date between '".$days30datetime."' and '".$currentdatetime."' and Mobile_Number not in (9971396361,9811215138,9811555306) ) order by RequestID DESC";
			list($checkDupNum,$myrow)=MainselectfuncNew($getdetails,$array = array());
			$myrowcontr=count($myrow)-1;

			if($checkDupNum>0)
			{
				$ProductValue = $myrow[$myrowcontr]['RequestID'];
				$_SESSION['Temp_LID'] = $ProductValue;
				echo "<script language=javascript>"." location.href='update-property-loan-lead.php'"."</script>";
			}
			else
			{
		
		$validMobile = is_numeric($Phone);
		$validYear  = is_numeric($year);
		$validMonth = is_numeric($month);
		$validDay = is_numeric($day);
			
if(($validMobile==1) && ($validMonth==1) && ($validDay==1) && ($validYear==1) && ($Name!=""))
{			
	list($First,$Last) = split('[ ]', $Name);

			$CheckSql = "select UserID from wUsers where Email = '".$Email."'";
			list($alreadyExist,$myrow)=MainselectfuncNew($CheckSql,$array = array());
			$myrowcontr=count($myrow)-1;
			$CheckNumRows = $alreadyExist;
			$Dated = ExactServerdate();
			if($CheckNumRows>0)
			{
				$UserID = $myrow[$myrowcontr]["UserID"];
				$dataArray = array('UserID'=>$UserID, 'Name'=>$Name, 'Email'=>$Email, 'City'=>$City, 'City_Other'=>$City_Other, 'Mobile_Number'=>$Phone, 'Net_Salary'=>$IncomeAmount, 'Loan_Amount'=>$Loan_Amount, 'Dated'=>$Dated, 'source'=>$source, 'Referrer'=>$, 'Creative'=>$, 'Section'=>$, 'IP_Address'=>$, 'Reference_Code'=>$, 'Updated_Date'=>$Dated, 'Accidental_Insurance'=>$Accidental_Insurance, 'Property_Value'=>$Property_Value, 'Pincode'=>$Pincode, 'DOB'=>$DOB, 'Employment_Status'=>$Employment_Status, 'Any_Surrogate'=>$surrogate);
			}
			else
			{
			$wUsersdata = array("Email"=>$Email, "FName"=>$Name, "Phone"=>$Phone, "Join_Date"=>$Dated, "IsPublic"=>$IsPublic);
				$UserID = Maininsertfunc("wUsers", $wUsersdata);
				$dataArray = array('UserID'=>$UserID, 'Name'=>$Name, 'Email'=>$Email, 'City'=>$City, 'City_Other'=>$City_Other, 'Mobile_Number'=>$Phone, 'Net_Salary'=>$IncomeAmount, 'Loan_Amount'=>$Loan_Amount, 'Dated'=>$Dated, 'source'=>$source, 'Referrer'=>$, 'Creative'=>$, 'Section'=>$, 'IP_Address'=>$, 'Reference_Code'=>$, 'Updated_Date'=>$Dated, 'Accidental_Insurance'=>$Accidental_Insurance, 'Property_Value'=>$Property_Value, 'Pincode'=>$Pincode, 'DOB'=>$DOB, 'Employment_Status'=>$Employment_Status, 'Any_Surrogate'=>$surrogate);
			}
			$ProductValue = Maininsertfunc ($Type_Loan, $dataArray);
			$_SESSION['ProductValue'] = $ProductValue;
			
			
			$lastInserted = $ProductValue;
		$client_transaction_id = $lastInserted."_LAP";
		
			
			
			if($City=="Others")
		{
			$strCity = $City_Other;
		}
		else
		{
			$strCity = $City;
		}

if($hdfclife==1)
		{
			$Product=5;
			Insert_HdfcLife($Name, $strCity, $Phone, $DOB, $Email, $IncomeAmount, $Product, $ProductValue );
		}
if($lastInserted>0)
		{

		list($FinalBidder,$finalBidderName)= getBiddersList("Req_Loan_Against_Property",$lastInserted,$City);

		}
	if(count($FinalBidder)>0)
	{
			$SMSMessage = "Please use this code: ".$Reference_Code."  to activate you loan request at deal4loans.com";

			if(strlen(trim($Phone)) > 0)
				SendSMSforLMS($SMSMessage, $Phone);
	}
			
	if($City=="Others")
	{
		$strcity=$City_Other;
	}
	else
	{	
		$strcity=$City;
	}

	if(strlen($Ibibo_compaign)>0)
		{
			Insert_ibibo($ProductValue, $Name, $strcity, $Phone, $DOB, $Ibibo_compaign, $Email);
		}
			//exit();
			
			$SMSMessage = "Dear $Name,your activation code is: $Reference_Code.Use it in step 2 of loan app form to get banks contacts & quotes. And help us serve you better.";
			if(strlen(trim($Phone)) > 0)
				//SendSMS($SMSMessage, $Phone);
			
			
			//Code Added to mailtocommonscript.php
			$FName = $Name;
			$Checktosend="getthank_individual";
			include "scripts/mailatcommonscript.php";

			$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
			$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
			$headers .= "Bcc: testthankuse@gmail.com"."\n";
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
			

			
if(count($finalBidderName)==0)
		{
			header("Location: apply-loan-against-property-thanks.php");
				exit();
		}

}
		else
		{
			//echo "Track URI and redirect this to the same page";
			$msg = "NotAuthorised";
			$PostURL =$_POST["PostURL"]."?msg=".$msg;
			header("Location: $PostURL");
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
<title>Apply and Compare Loans Against Property India - Deal4loans</title>
<meta name="description" content="Apply Loans Against Property online. Know the schemes from all loans against property providing banks located in major cities of India like Mumbai, Delhi, Gurgaon, Bangalore, Ahmedabad, Chennai, Hyderabad, Navi Mumbai, Kochi, Pune etc. Compare Documents, EMI, Interest rates and Fees.">
<meta name="keywords" content="Loan Against Property India, Apply Loan Against Property, Compare Loan Against Property in Mumbai Hyderabad Pune kolkata Delhi Noida Bangalore">
<link href="source.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="scripts/mainmenu.js"></script>
<script type="text/javascript" src="js/dropdowntabs.js"></script>
<script type="text/javascript" src="scripts/common.js"></script>
<script type="text/javascript" src="scripts/jquery.js"></script>
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
<div class="text12" style="margin:auto; width:970px; height:11px; margin-top:11px; color:#0a8bd9;"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> > <a href="loan-against-property.php"  class="text12" style="color:#0080d6;"><u>Loan Against Property</u></a> <a href="#"  class="text12" style="color:#4c4c4c;">> Apply Loan Against Property</a></div>
<div style="clear:both; height:15px;"></div>
<div class="text12" style="margin:auto; width:970px;">    
<table width="100%"  border="0" align="center" cellpadding="2" cellspacing="3" >
      <tr>
     <td>

	  <form name="lap_verify" action="apply-loan-against-property-thanks.php" method="post">
         <input type="hidden" name="RequestID" id="RequestID"  value="<? echo $lastInserted; ?>" >
	 <input type="hidden" name="source" value="<? echo $retrivesource; ?>">
	 <input type="hidden" name="Reference_Code" id="Reference_Code" value="<? echo $Reference_Code; ?>">     
       <table width="663" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td  align="left" valign="top" ><table width="960" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="14" align="left" valign="top"><img src="images/bgtop1.jpg" width="960" height="14" /></td>
      </tr>
      <tr>
        <td height="55" align="left" valign="top" bgcolor="#21405F"><table width="955" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="24">&nbsp;</td>
            <td width="735"><div class="text3" style=" color:#FFF; font-size:16px; text-transform:none; font-weight:bold; line-height:25px;">To get quotes and Compare offers from all Banks and <span style="color: #D02037;"> Save Upto Rs. 1 lac * by comparison on your EMI</span>. Please verify your Mobile Number. <br />We have sent an activation code on <span style="color: #D02037;"><? echo $Phone; ?></span>
</div></td>
          </tr>
          </table></td>
      </tr>
      <tr>
        <td  align="center" valign="top" bgcolor="#21405F"><table width="895" border="0" cellpadding="0" cellspacing="0">
          <tr>
            
            <td width="600" align="left" valign="top"><table width="598" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="173" height="60">
                      <div class="text" style=" float:left; width:170px; height:auto; color:#FFF; font-size:14px; text-transform:none;">Activation Code:</div></td><td width="214" height="50"><div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">
                        <input name="activation_code" id="activation_code" type="text" style="width:100px; height:18px;" onkeydown="validateDiv('nameVal');"  maxlength="5"/>
  
                      </div></td><td width="211" align="center" valign="top">
  <div style=" width:114px; height:47px; margin-top:0px; margin-left:0px; margin-right:23px;">  <input type="submit" style="border: 0px none ; background-image: url(images/get1.gif); width: 114px; height: 52px; margin-bottom: 0px;" value=""/></div></td>
                </tr>
             </table></td>
         </tr>
       </table></td>
      </tr>
      <tr>
        <td height="14" align="center" valign="top"><img src="images/bgbottom1.jpg" width="960" height="14" /></td>
      </tr>
    </table></td>
  </tr>
</table></form>
     </td>
      </tr>
		   <tr>
            <td  height="25" align="center" class="frmbldtxt"  style="font-weight:normal; color:#000000;" colspan="2" >
			1) In next screen get Rates, EMI , Processing Fee information.<br />
			2) Compare EMI and <span style="color: #D02037;">Save upto Rs. 1lac on interest.</span><br />
			3) Help in processing your loan   faster.<br />
             4) Gives you best offer.                </td>
           
          </tr>
      <tr><td>&nbsp;</td></tr>
    </table>
</div>
<div style="clear:both; height:15px;"></div>
<?php include "footer1.php"; ?>
</body>
</html>
<? function generateNumberNEWc($plength)
{
	if(!is_numeric($plength) || $plength <= 0)
	{
	    $plength = 8;
	}
	if($plength > 32)
	{
	    $plength = 32;
	}

	$chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	mt_srand(microtime() * 1000000);
	for($i = 0; $i < $plength; $i++)
	{
	   $key = mt_rand(0,strlen($chars)-1);
	   $pwd = $pwd . $chars{$key};
	}
	   for($i = 0; $i < $plength; $i++)
	{
	    $key1 = mt_rand(0,strlen($pwd)-1);
	    $key2 = mt_rand(0,strlen($pwd)-1);

	    $tmp = $pwd{$key1};
	    $pwd{$key1} = $pwd{$key2};
	    $pwd{$key2} = $tmp;
	}

	return $pwd;
}
?>