<?php
ob_start();
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	require 'getlistofeligiblebidders.php';
	error_reporting();
	$page_Name = "LandingPage_PL";

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


if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	foreach($_POST as $a=>$b)
			$$a=$b;

	$UserID = $_SESSION['UserID'];
		$Full_Name = FixString($Full_Name);
		//$LName = FixString($LName);
		$Name= $Full_Name;
		$Email = FixString($Email);
		$Phone = FixString($Phone);
		$Pancard = FixString($Pancard);
		$CC_Holder = FixString($CC_Holder);
		$Card_Vintage = FixString($Card_Vintage);
		$City = FixString($City);
		$City_Other = FixString($City_Other);
		$Company_Name = FixString($Company_Name);
		$Net_Salary =FixString($Net_Salary);
		$IsPublic =1;
		$Day=FixString($day);
		$Month=FixString($month);
		$Year=FixString($year);
		$DOB=$Year."-".$Month."-".$Day;
		$Type_Loan = "CreditCard";
			$source = "SBI-Redemption";
		$Reference_Code = FixString($Reference_Code);
		$Employment_Status = FixString($Employment_Status);
		$Accidental_Insurance = FixString($Accidental_Insurance);
		$Referrer=$_REQUEST['referrer'];
		$source=$_REQUEST['source'];
		$Section=$_REQUEST['section'];
		$Creative=$_REQUEST['creative'];
		
		
if($_SESSION=="")
		{
			$_SERVER['Temp_Type'] = "CreditCard";
			$_SERVER['Temp_Type_Loan']="Req_Credit_Card";
			$_SERVER['Temp_Name'] = $Name;
			$_SERVER['Temp_FName'] = $Name;
			$_SERVER['Temp_Phone'] = $Phone;
			$_SERVER['Temp_Pancard'] = $Pancard;
			$_SERVER['Temp_DOB'] = $DOB;
			$_SERVER['Temp_Email'] = $Email;
			$_SERVER['Temp_Company_Name'] = $Company_Name;
			$_SERVER['Temp_Employment_Status'] = $Employment_Status;
			$_SERVER['Temp_City'] = $City;
			$_SERVER['Temp_City_Other'] = $City_Other;
			$_SERVER['Temp_Net_Salary'] = $Net_Salary;
			$_SERVER['Temp_IsPublic'] = $IsPublic;
			 $_SERVER['Temp_CC_Holder'] = $CC_Holder;
			 $_SERVER['Temp_Reference_Code'] = $Reference_Code;
			 $_SERVER['Temp_Phone'] = $Phone;

		}
	else
		{
			$_SESSION['Temp_Type'] = "CreditCard";
			$_SESSION['Temp_Type_Loan']="Req_Credit_Card";
			$_SESSION['Temp_Name'] = $Name;
			$_SESSION['Temp_Pancard'] = $Pancard;
			$_SESSION['Temp_FName'] = $Name;
			$_SESSION['Temp_Phone'] = $Phone;
			$_SESSION['Temp_DOB'] = $DOB;
			$_SESSION['Temp_Employment_Status'] = $Employment_Status;
			$_SESSION['Temp_Email'] = $Email;
			$_SESSION['Temp_Company_Name'] = $Company_Name;
			$_SESSION['Temp_City'] = $City;
			$_SESSION['Temp_City_Other'] = $City_Other;
			$_SESSION['Temp_Net_Salary'] = $Net_Salary;
			$_SESSION['Temp_CC_Holder'] = $CC_Holder;
			$_SESSION['Temp_Reference_Code'] = $Reference_Code;
			$_SESSION['Temp_Phone'] = $Phone;
		}

$IP = getenv("REMOTE_ADDR");

	if($Activate>0)
	{
		$DeleteIncompleteSql = "Delete from Req_Incomplete_Lead where IncompeletID=".$Activate;		
		$DeleteIncompleteQuery=Maindeletefunc($DeleteIncompleteSql,$array = array());
	}
	
function InsertTataAig($RequestID, $ProductName)
	{
	//	echo "select Dated, City, City_Other from ".$ProductName." where RequestID = $RequestID";
		$GetDateSql = "select Dated, City, City_Other, Mobile_Number from ".$ProductName." where RequestID = $RequestID";
			list($alreadyExist,$myrow)=MainselectfuncNew($GetDateSql,$array = array());
		$myrowcontr=count($myrow)-1;
		
		$TDated = $myrow[$myrowcontr]["Dated"];
		$TCity = $myrow[$myrowcontr]["City"];
		$Mobile = $myrow[$myrowcontr]["Mobile_Number"];
		$Dated=ExactServerdate();
		$Product_Name = "4";
		
		$data = array("T_RequestID"=>$RequestID , "T_Product"=>$Product_Name , "T_City"=>$TCity , "Mobile_Number"=>$Mobile , "T_Dated"=>$Dated );
		$table = 'tataaig_leads';
		$insert = Maininsertfunc ($table, $data);
		//echo "tataaig:".$Sql."<br>";
		//exit();

	}

		$crap = " ".$Name." ".$Email." ".$Company_Name;
		$crapValue = validateValues($crap);
		$_SESSION['crapValue'] = $crapValue;
		if($crapValue=='Put')
		{
			$validMobile = is_numeric($Phone);
		$validYear  = is_numeric($Year);
		$validMonth = is_numeric($Month);
		$validDay = is_numeric($Day);
			
if(($validMobile==1) && ($validMonth==1) && ($validDay==1) && ($validYear==1) && ($Name!=""))
{		
			$CheckSql = "select UserID from wUsers where Email = '".$Email."'";
			list($alreadyExist,$myrow)=MainselectfuncNew($CheckSql,$array = array());
			$myrowcontr = count($myrow)-1;
			$CheckNumRows = $alreadyExist;
			$Dated=ExactServerdate();
			if($CheckNumRows>0)
			{
				$UserID = $myrow[$myrowcontr]["UserID"];
				$Pincode = $_POST['Pincode'];
				

				$dataInsert = array("UserID"=>$UserID, "Name"=>$Name, "Email"=>$Email, "City"=>$City, "City_Other"=>$City_Other, "Mobile_Number"=>$Phone, "Net_Salary"=>$Net_Salary, "DOB"=>$DOB, "Dated"=>$Dated, "IsPublic"=>$IsPublic, 'Reference_Code'=>$Reference_Code, 'source'=>$source, 'Pancard'=>$Pancard, 'CC_Holder'=>$CC_Holder, 'Card_Vintage'=>$Card_Vintage, 'IP_Address'=>$IP, "Referrer"=>$Referrer, "Creative"=>$Creative, "Section"=>$Section, 'Updated_Date'=>$Dated, 'Accidental_Insurance'=>$Accidental_Insurance, 'Pincode'=>$Pincode);
				
			//	echo "<br>if".$InsertProductSql;
			}
			else
			{
				$wUsersdata = array("Email"=>$Email, "FName"=>$Name, "Phone"=>$Phone, "Join_Date"=>$Dated, "IsPublic"=>$IsPublic);
				$UserID = Maininsertfunc ('wUsers', $wUsersdata);	
			
				$dataInsert = array("UserID"=>$UserID, "Name"=>$Name, "Email"=>$Email, "City"=>$City, "City_Other"=>$City_Other, "Mobile_Number"=>$Phone, "Net_Salary"=>$Net_Salary, "DOB"=>$DOB, "Dated"=>$Dated, "IsPublic"=>$IsPublic, 'Reference_Code'=>$Reference_Code, 'source'=>$source, 'Pancard'=>$Pancard, 'CC_Holder'=>$CC_Holder, 'Card_Vintage'=>$Card_Vintage, 'IP_Address'=>$IP, "Referrer"=>$Referrer, "Creative"=>$Creative, "Section"=>$Section, 'Updated_Date'=>$Dated, 'Accidental_Insurance'=>$Accidental_Insurance, 'Pincode'=>$Pincode);
				//echo "<br>else".$InsertProductSql;
$SMSMessage = "Thanks for your Credit Card Application.Please apply at the choices given to you .If any chance you are busy, the offers have been sent to your email.Keep your Pan Number handy when you apply.";
					//if(strlen(trim($Phone)) > 0)
					//SendSMS($SMSMessage, $Phone);
				
			}
					
			$ProductValue = Maininsertfunc ('Req_Credit_Card', $dataInsert);		
			$_SESSION['Temp_LID'] = $ProductValue;


			if($Accidental_Insurance=="1")
				{
					InsertTataAig($ProductValue, "Req_Credit_Card");
				}
			//exit();
			  if($Net_Salary>=300000)
   {
			//$SMSMessage = "Thanks for ur application@ Credit Cards.Choose your type of Credit Card. Get your Pan number handy.Offers are in ur mail also.Apply now";
			$SMSMessage = "Thanks for your Credit Card Application.Please apply at the choices given to you .If any chance you are busy, the same offers have been sent to your email.Keep your Pan Number handy when you apply.";
					//if(strlen(trim($Phone)) > 0)
					//SendSMS($SMSMessage, $Phone);
   }
			}
			
			
			
			//Code Added to mailtocommonscript.php
			$FName = $Name;
			$Checktosend="getthank_individual";
			include "scripts/mailatcommonscript.php";

			$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
			$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			
			if($Name)
				$SubjectLine = $Name.", Learn to get Best Deal on Credit Card";
			else
				$SubjectLine = "Learn to get Best Deal on Credit Card";
			//echo $Type_Loan;
			if(isset($Type_Loan))
			{
				mail($Email, $SubjectLine, $Message2, $headers);
			}
			
			

		//}
		else
		{
			//echo "Track URI and redirect this to the same page";
			$msg = "NotAuthorised";
			$PostURL ="http://www.deal4loans.com/".$_POST["PostURL"]."?msg=".$msg;
			header("Location: $PostURL");
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
<title>Thank you</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script type="text/javascript" src="scripts/calendardateinput.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<link href="style/new-bima.css" rel="stylesheet"  type="text/css" />
<link href="style/glowing.css" rel="stylesheet"  type="text/css" />
<link href="style/slider.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/dropdowntabs.js"></script>
</head>
<body>
<?php include '~Top-new.php';?>
<?php include '~menu.php';?>
<div id="container" align="center">
  <div id="txt" style="text-align:center; font-weight:bold; line-height:18px; " align="center">
 <table cellpadding="0" cellspacing="0" width="100%" >
 <tr><td align="center">
 
 <table cellpadding="0" cellspacing="0"  width="100%" >
 <tr><td align="center" valign="top" height="350" style="text-align:center; font-weight:bold; line-height:18px; padding-bottom:15px;">
Thanks for registering yourself with Deal4loans.com. Our representative will call you shortly.
 </td></tr>
 </table>
 </td></tr></table>
  </div>
  
  
<div align="center"><script type="text/javascript"><!--
google_ad_client = "pub-6880092259094596";
/* deal4loan */
google_ad_slot = "8793338166";
google_ad_width = 728;
google_ad_height = 90;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
</div>
      <?
  //include '~Right2.php';

  ?>
  <? if ((($_REQUEST['flag'])!=1))
	{ ?>
  <?php include '~Bottom-new.php';?><?php } ?>
</div><!-- </div> -->


</body>
</html>
