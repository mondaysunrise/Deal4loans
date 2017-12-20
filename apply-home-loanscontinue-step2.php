<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	require 'scripts/home_loan_eligibility_function.php';

function DetermineAgeFromDOB ($YYYYMMDD_In)
{
  $yIn=substr($YYYYMMDD_In, 0, 4);
  $mIn=substr($YYYYMMDD_In, 4, 2);
  $dIn=substr($YYYYMMDD_In, 6, 2);

  $ddiff = date("d") - $dIn;
  $mdiff = date("m") - $mIn;
  $ydiff = date("Y") - $yIn;

  // Check If Birthday Month Has Been Reached
  if ($mdiff < 0)
  {
    // Birthday Month Not Reached
    // Subtract 1 Year From Age
    $ydiff--;
  } elseif ($mdiff==0)
  {
    // Birthday Month Currently
    // Check If BirthdayDay Passed
    if ($ddiff < 0)
    {
      //Birthday Not Reached
      // Subtract 1 Year From Age
      $ydiff--;
    }
  }
  return $ydiff;
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
 
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	
	
	foreach($_POST as $a=>$b)
	$$a=$b;

		$cf_campaign = FixString($cf_campaign);
		$City = FixString($City);
		$Property_Identified= FixString($Property_Identified);
		$Property_Loc= FixString($Property_loc);
		$Name = FixString($Name);
		$Phone = FixString($Phone);
		$Email = FixString($Email);
		$dob_arr[] = FixString($year);
		$dob_arr[] = FixString($month);
		$dob_arr[] = FixString($day);
		$Age = FixString($Age);
		$CoAge = FixString($CoAge);
		$company_name = FixString($company_name);
		$Employment_Status = FixString($Employment_Status);
		$Net_Salary = FixString($Net_Salary);
		$monthly_income = ($Net_Salary /12);
		$obligations = FixString($obligations);
		$loan_amount = FixString($Loan_Amount);
		$co_appli = FixString($co_appli);
		$co_name = FixString($co_name);
		$dob_arr_co[] = FixString($co_year);
		$dob_arr_co[] = FixString($co_month);
		$dob_arr_co[] = FixString($co_day);
		$co_monthly_income = FixString($co_monthly_income);
		$co_obligations = FixString($co_obligations);
		$property_value = FixString($property_value);
		$Pincode = FixString($Pincode);
		$City_Other = FixString($City_Other);
		$hdfclife = FixString($hdfclife);
		$getnetAmount = ($monthly_income + $co_monthly_income);
		$total_obligation = $obligations + $co_obligations;
		$Activate = FixString($Activate);
		$Type_Loan = "Req_Loan_Home";
		$source = FixString($source);
		$Creative = FixString($creative);
		$Section = FixString($section);
		$Accidental_Insurance = FixString($Accidental_Insurance);
		$Referrer=FixString($referrer);
		$netAmount=($getnetAmount - $total_obligation);
		$accept = FixString($accept);	
		$mahindra_life = FixString($mahindra_life);
		$Dated=ExactServerdate();
		$Updated_Date=ExactServerdate();
		$validMobile = is_numeric($Phone);
		if(strlen($Age)>0)
		{
			$date=date('m-d');
			$year = date('Y')-$Age;
			$dateofbirth = $year."-".$date;
		}
		else
		{
			$dateofbirth = implode("-", $dob_arr);
		}

		if(strlen($CoAge)>0)
		{
			$date=date('m-d');
			$year = date('Y')-$CoAge;
			$DOB_co = $year."-".$date;
		}
		else
		{
			$DOB_co = implode("-", $dob_arr_co);
		}

	$DOB = str_replace("-","", $dateofbirth);
		$DOB = DetermineAgeFromDOB($DOB);
		$tenorPossible = 60 - $DOB;
	$age =$DOB;

$agecalc="50";
$exactage = $agecalc- $age;
$getinflation = $Net_Salary *(5/100);
$getinflationage = $getinflation * $exactage;
$getexactvalue = $getinflationage + $Net_Salary;
$getexactvaluemonthly = $getexactvalue/12;

$Gender = FixString($Gender);	
$Residence_Address = FixString($Residence_Address);	
$Pancard = FixString(strtoupper($Pancard));	

	$IsPublic = 1;
	
if(strlen($Name)>0 && (preg_match("/1/", $Name)==1 || preg_match("/0/", $Name)==1) || preg_match("/!/", $Name)==1 || preg_match("/@/", $Name)==1)
{
	$validname=0;
}
else
		{
	$validname=1;
		}

	
	
		$crap = " ".$Name." ".$Email." ".$City;
		//echo $crap,"<br>";
		$crapValue = validateValues($crap);
		$_SESSION['crapValue'] = $crapValue;
		
		//exit();
		
		if($crapValue=='Put'  && $City!='Please Select' && $validname==1 && $validMobile==1)
		{
			$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-30, date("Y"));
			$days30date=date('Y-m-d',$tomorrow);
			$days30datetime = $days30date." 00:00:00";
			$currentdate= date('Y-m-d');
			$currentdatetime = date('Y-m-d')." 23:59:59";
			
			
			
						
			$CheckSql = "select UserID from wUsers where Email = '".$Email."'";
			list($CheckNumRows,$myrow1)=Mainselectfunc($CheckSql,$array = array());

			if($CheckNumRows>0)
			{

				$UserID = $myrow1['UserID'];
				$InsertProductSql = array("Property_Identified"=>$Property_Identified, "DOB"=>$dateofbirth , "Property_Loc"=>$Property_Loc , "Co_Applicant_Name"=>$co_name , "Co_Applicant_DOB"=>$DOB_co , "Co_Applicant_Income"=>$co_monthly_income , "Co_Applicant_Obligation"=>$co_obligations , "Property_Value"=>$property_value , "Total_Obligation"=>$obligations ,  "Pincode"=>$Pincode, "Gender"=> $Gender, "Residence_Address"=> $Residence_Address, "Pancard"=> $Pancard, "Privacy"=> $accept);
		
			}
			else
			{
				
				$InsertProductSql = array("Property_Identified"=>$Property_Identified, "DOB"=>$dateofbirth , "Property_Loc"=>$Property_Loc , "Co_Applicant_Name"=>$co_name , "Co_Applicant_DOB"=>$DOB_co , "Co_Applicant_Income"=>$co_monthly_income , "Co_Applicant_Obligation"=>$co_obligations , "Property_Value"=>$property_value , "Total_Obligation"=>$obligations , "Pincode"=>$Pincode, "Gender"=> $Gender, "Residence_Address"=> $Residence_Address, "Pancard"=> $Pancard, "Privacy"=> $accept);
				
				
			}
			//echo $ProductValue;
			$wherecondition ="(RequestID=".$_REQUEST['ProductValue'].")";
			 $ProductValue = Mainupdatefunc("Req_Loan_Home", $InsertProductSql, $wherecondition);
			//echo "tests";die;
			 //Send SMS
			//ProductSendSMStoRegis($Phone);
			
			//$ProductValue = mysql_insert_id();
			$_SESSION['ProductValue'] = $ProductValue;
			$_SESSION['Name'] = $Name;	

			if($City=="Others")
		{
			$strcity = $City_Other;
		}
		else
		{
			$strcity=$City;
		}
		$_SESSION['strcity'] = $strcity; 

		if($cf_campaign==1)
				{
			$cfSqldata = array("cf_name"=>$Name, "cf_mobile_number"=>$Phone, "cf_email_id"=>$Email, "cf_city"=>$City, "cf_property_value"=>$property_value, "cf_dated"=>$Dated);
				$cfS1 = Maininsertfunc("commonfloor_hlcampaign", $cfSqldata);
				}
 
			list($First,$Last) = split('[ ]', $Name);
			
			$SMSMessage = "Dear $First,Thanks for applying at Deal4loans for Home loan";
			
			if(strlen(trim($Phone)) > 0)
			{
				//SendSMS($SMSMessage, $Phone);
				NewAir2webSendSMS($SMSMessage, $Phone, 2, $ProductValue);
			}
			//Code Added to mailtocommonscript.php
			$FName = $Name;
			$Checktosend="getthank_individual";
			include "scripts/mailatcommonscript.php";

			$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
			$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
			$headers .= "Bcc: newtestthankuse@gmail.com"."\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$FName=$Name;
			if($Name)
				$SubjectLine = $Name.", Learn to get Best Deal on Home Loan";
			else
				$SubjectLine = "Learn to get Best Deal on Home Loan";
			//echo $Type_Loan;
			if(isset($Type_Loan))
			{
				mail($Email, $SubjectLine, $Message2, $headers);
			}
				if($source=="Hl_testpage_1july")
				{
					header("Location: apply-homeloanscontinue-16-09.php");
					exit();
				}
				else
				{
					header("Location: apply-homeloanscontinue1.php?ProductValue=".$_REQUEST['ProductValue']."&strcity=".$strcity."&Name=".$Name."");
					exit();
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
<title>Apply Home Loan - Compare interest Rates, Eligibility, Banks and Apply Home Loans online</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<meta name="keywords" content="apply home loan, housing loan, Apply Home Loans, online home loans, online home loan, Housing Loans, apply Home loans India,">
<meta name="description" content="Home Loan apply : Apply for home loans Online and get quotes from all home loan provider of India like Mumbai, Delhi, Noida, Kolkata, Gurgaon, Bangalore, Chennai, Hyderabad, Pune etc.">
<link rel="canonical" href="http://www.deal4loans.com/apply-home-loans.php"/>
<link href="css/common-d4l-styles.css" type="text/css" rel="stylesheet"  />
<link href="css/home-loan-styles.css" type="text/css" rel="stylesheet"  />
<style type="text/css">
.auto-style1 {
	line-height: 120%;
	font-size: 12.0pt;
	font-family: "Liberation Serif", serif;
	margin-left: 0in;
	margin-right: 0in;
	margin-top: 0in;
	margin-bottom: 7.0pt;
}
</style>
</head>

<body>
<?php include "middle-menu.php"; ?>
<div  class="hl_inner_wrapper">
  <div style="clear:both;"></div>
  <div class="d4l_inner_wrapper">
    <div style="margin:auto; width:100%; margin-top:70px; color:#0a8bd9;"><a href="index.html" class="text12" style="color:#0080d6;" >Home</a></u> > <a href="home-loans.php"  class="text12" style="color:#0080d6;"><u>Home Loan</u></a> <a href="#"  class="text12" style="color:#4c4c4c;">> Apply for Home Loan</a></div>
<div style="clear:both; height:15px;"></div>
<div style="clear:both; height:396px; width:960px; margin:auto; margin-top:15px;">

<div style=" float:left; width:881px; height:auto; margin-left:25px; margin-top:7px; background-color:#FFFFFF;" >


     <table width="100%"  border="0" align="center" cellpadding="5" cellspacing="3" class="brdr5">
       <tr>
         <td><form action="apply-homeloanscontinue1.php" method="post" name="hl">
             <input type="hidden" name="ProductValue" id="ProductValue"  value="<? echo $_REQUEST['ProductValue']; ?>" />
             <input type="hidden" name="strcity" id="strcity"  value="<? echo $strcity; ?>" />
             <input type="hidden" name="Name" id="Name"  value="<? echo $Name; ?>" />
             <table width="100%"  border="0" cellspacing="0" cellpadding="0">
               
               <tr valign="middle">
                 <td height="28" class="frmbldtxt" style="padding-top:3px; ">Dear <?php echo $Name ; ?>, </td>
                 <td width="24%" height="28" class="frmbldtxt"  style="padding-top:3px; ">&nbsp;</td>
               </tr>
               <tr valign="middle">
                 <td height="28" colspan="2" class="frmbldtxt" style="padding-top:3px; font-weight:normal; " align="center">To get quotes and Compare offers from all Banks and <span style="color: #D02037;"> Save Upto Rs. 50000* by comparison on your EMI</span>. Please verify your Mobile Number. </td>
               </tr>
               <tr>
                 <td colspan="2" style="color: #D02037; font-size:12px;" height="20" align="center"><b>To Verify, Please Initiate A Miss Call From your Mobile "<span style="color:#000000;" ><? echo $Phone; ?></span>" , To The Below Mentioned TOLL-FREE Number</b></td>
               </tr>
               <tr>
                 <td colspan="2" align="center"><?php
				   $client_transaction_id = $ProductValue."_HL";
				   	$zipdimage = mobile_verify($Phone,$client_transaction_id);
				   
                   ?>
                     <img src="<? echo $zipdimage; ?>" /></td>
               </tr>
               <tr>
                 <td style="color: #D02037; font-size:12px; padding-left:250px;" height="30" align="center">Will auto disconnect after 1 ring </td>
                 <td colspan="3"><input name="submit" type="submit" style="width:240px; background-color: #D02037; color:#FFFFFF; font-weight:700" value="Click After 10 secs of Missed Call" /></td>
               </tr>
             </table>
         </form></td>
       </tr>
       <tr>
         <td  height="25" class="frmbldtxt"  style="font-weight:normal;" colspan="2" > 1) Get call back assistance on <span style="color: #D02037;">verified mobile number</span>. <br />
           2) Compare EMI and <span style="color: #D02037;">save Upto Rs. 50000 on interest</span>.<br />
           3) Provides you with the best suitable offers.<br />
           4) Help in processing your loan faster. </td>
       </tr>
       <tr>
         <td>&nbsp;</td>
       </tr>
       <tr>
         <td>&nbsp;</td>
       </tr>
     </table>

</div>
</div>
<div style="clear:both; height:309px; width:964px; margin:auto; background-image:url(images/form3_bg.gif); margin-top:35px;">


<div class="text3" style="margin:auto; width:905px; height:47px; color:#FFF; text-transform:none; font-size:18px;">

<div style="padding:16px; float:left; clear:right;"><strong>Banks</strong></div>
<div style="padding:16px; float:left; clear:right; margin-left:90px;"><strong>ICICI Bank</strong></div>
<div style="padding:16px; float:left; clear:right; margin-left:90px;"><strong>HDFC Ltd.</strong></div>
<div style="padding:16px; float:left; clear:right; margin-left:80px;"><strong>HSBC Bank</strong></div>
<div style="padding:16px; float:right; clear:right; margin-right:20px;"><strong>Axis Bank</strong></div>
</div>
<div class="text" style="margin:auto; width:905px; height:auto; color:#666666; text-transform:none; font-size:12px;  clear:both; margin-top:-50px;"></div>
<table width="928" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="160" height="49" align="center" valign="middle" class="font2"><strong>Rate of Interest<br />
      <br />
      </strong></td>
    <td width="203" align="center" valign="middle" class="font">      10.5% - 11.5%<br />
      <br /></td>
    <td width="198" align="center" valign="middle" class="font">10.75% - 11.75%</td>
    <td width="200" align="center" valign="middle" class="font">11% - Regular Home Loan<br />
      11.50% - Smart Home</td>
    <td width="167" align="center" valign="middle" class="font">10.75% - 11.25%</td>
  </tr>
  <tr>
    <td height="48" align="center" valign="middle" class="font2"><strong>Processing Fee<br />
      <br />
      </strong></td>
    <td align="center" valign="middle" class="font"> 0.50%<br />
      <br /></td>
    <td align="center" valign="middle" class="font">0.5% plus applicable service tax <br />
      and cess</td>
    <td align="center" valign="middle" class="font">10,000 plus service tax &amp; cess</td>
    <td align="center" valign="middle" class="font">1%</td>
  </tr>
  <tr>
    <td height="60" align="center" valign="middle" class="font2"><strong>Loan Amount<br />
      <br />
      </strong></td>
    <td align="center" valign="middle" class="font"> Rs.8,00,000 - Maximum 80% of <br />
      the Cost of the Property <br />
      (Subject to Income Eligibility)<br /></td>
    <td align="center" valign="middle" class="font">80% of the Cost of the Property <br />
      (Subject to Income Eligibility)</td>
    <td align="center" valign="middle" class="font">Maximum upto 10 crores <br />
      (Subject to Income Eligibility)</td>
    <td align="center" valign="middle" class="font">Rs.1,00,000 -<br />
Rs.2,00,00,000</td>
  </tr>
  <tr>
    <td height="60" align="center" valign="middle" class="font2"><strong>Prepayment<br />
      Charges<br />
      <br />
    </strong></td>
    <td align="center" valign="middle" class="font"> Rs.10,000 - or 2%<br />
      <br /></td>
    <td align="center" valign="middle" class="font">If 25% of outstanding amount is paid within 3 years- No Penalty, otherwise 2% of outstanding amount</td>
    <td align="center" valign="middle" class="font">NIL upto 25% of the loan amount sanctioned in every financial year &amp; at a pre-payment charge of 3% for any excess amount</td>
    <td align="center" valign="middle" class="font">Nil</td>
  </tr>
  </table>
<br />
<br />
</div>
<div style="clear:both; height:20px; width:964px; margin:auto; margin-top:10px;"><a href="/Contents_Calculators.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image3','','images/emi2.gif',1)"><img src="images/emi1.gif" alt="EMI Calculator" name="Image3" width="95" height="20" border="0" id="Image3" hspace="5px" /></a></div>
<!--partners-->
<div class="text" style="margin:auto; width:962px; height:auto; margin-top:25px; color:#8dae48;">Loan Partners</div>
<div style="margin:auto; width:949px; height:85px;; margin-top:20px;"><img src="images/loan_partners.jpg" width="949" height="56" /></div>
<!--partners-->
</div>
</div>
<div class="hide_top_menu">
  <?php 
#include "footer_pl.php";
include("footer_sub_menu.php");
?>
</div>

</body>
</html>
