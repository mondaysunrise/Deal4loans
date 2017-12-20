<?php
ob_start();
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	require 'getlistofeligiblebidders.php';
	require 'scripts/personal_loan_eligibility_function_form.php';
	
	
	$Msg = "";
	if($_SESSION['UserType']== "bidder")
	{
	$Msg = getAlert("Sorry!!!! You are not Authorised to Apply for Loan.", TRUE, "index.php");
	echo $Msg;
	}

	function getProductCode($pKey){
	$titles = array(
		'Req_Loan_Personal' => '1',
		'Req_Loan_Home' => '2',
		'Req_Loan_Car' => '3',
		'Req_Credit_Card' => '4',
		'Req_Loan_Against_Property' => '5',
		'Req_Business_Loan' => '6',
	);

	foreach ($titles as $key=>$value)
	    if($pKey==$key)
		return $value;

	return "";
   }

	
function DetermineAgeGETDOB ($YYYYMMDD_In)
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

	
$getCompany_Name = $Company_Name;
		list($year,$month,$day) = split('[-]', $DOB);

$currentyear=date('Y');
$age=$currentyear-$year;

	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		    $leadid = $_REQUEST['leadid'];
			
			$_SESSION['leadid'] = $leadid;
			
			$PL_EMI_Amt = $_REQUEST['PL_EMI_Amt'];
			$Company_Type = $_REQUEST['Company_Type'];
			$Residential_Status = $_REQUEST['Residential_Status'];
			$Primary_Acc= $_REQUEST['Primary_Acc'];
			$Loan_Any = $_REQUEST['Loan_Any'];
			$EMI_Paid = $_REQUEST['EMI_Paid'];
			$Credit_Limit = $_REQUEST['Credit_Limit'];
			$Total_Experience = $_REQUEST['Total_Experience'];
			$Years_In_Company = $_REQUEST['Years_In_Company'];
			$Document_proof=$_REQUEST['Document_proof'];
			$Document_proof_doc=implode(",",$Document_proof);
			
	
			$nn = count($Loan_Any);
			 $ii  = 0;
			while ($ii < $nn)
			{
			  $Loan_A .= "$Loan_Any[$ii], ";
			 $ii++;
			 }
		
	$getpldetails="select Loan_Amount,Annual_Turnover,City_Other,City,Company_Name,Name,Net_Salary,DOB From Req_Loan_Personal Where (RequestID='".$leadid."')";
	list($alreadyExist,$plrow)=MainselectfuncNew($getpldetails,$array = array());
	$plrowcontr = count($plrow)-1;
$getCompany_Name = $plrow[$plrowcontr]['Company_Name'];
$City = $plrow[$plrowcontr]['City'];
$Name = $plrow[$plrowcontr]['Name'];
$DOB = $plrow[$plrowcontr]['DOB'];
$Net_Salary = $plrow[$plrowcontr]['Net_Salary'];
$Other_City = $plrow[$plrowcontr]['City_Other'];	
$Annual_Turnover = $plrow[$plrowcontr]['Annual_Turnover'];	
$Loan_Amount = $plrow[$plrowcontr]['Loan_Amount'];	

if($City=="Others" && strlen($Other_City)>0)
		{
			$strcity=$Other_City;
		}
	else
		{
			$strcity=$City;
		}

$getDOB = str_replace("-","", $DOB);
$age = DetermineAgeGETDOB($getDOB);
//echo $age."<br>";
$agecalc="50";
$exactage = $agecalc- $age;

//get inflation amount
$getinflation = $Net_Salary *(5/100);
$getinflationage = $getinflation * $exactage;
$getexactvalue = $getinflationage + $Net_Salary;
$getexactvaluemonthly = $getexactvalue/12;
//echo "Net_Salary: ".$Net_Salary."<br>";
$monthsalary =$Net_Salary/12;
	
				
			$crap = $City_Other." ".$Primary_Acc." ".$Years_In_Company." ".$Total_Experience;
		//echo $crap,"<br>";
			$crapValue = validateValues($crap);
		
			//exit();
			if($crapValue=="Put")
			{	
	
	if($leadid>0)
				{							
					$dataUpdte = array('Company_Type'=>$Company_Type, 'PL_EMI_Amt'=>$PL_EMI_Amt, 'Primary_Acc'=>$Primary_Acc, 'Residential_Status'=>$Residential_Status, 'Card_Limit'=>$Credit_Limit, 'Years_In_Company'=>$Years_In_Company, 'Total_Experience'=>$Total_Experience, 'EMI_Paid'=>$EMI_Paid, 'Loan_Any'=>$Loan_A, 'identification_proof'=>$Document_proof_doc);
					$wherecondition = "(RequestID=".$leadid.")";
					Mainupdatefunc ('Req_Loan_Personal', $dataUpdte, $wherecondition);
					//echo $qry;
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
		
	}//$_POST
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>  
<title>Thank you</title>
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
#bodyCenter #nwcontainer{background:url("/new-images/container-bg.png") repeat-x; clear:both; width:850px; min-height:437px; padding:29px 10px 10px 10px;}
#bodyCenter #nwcontainer p strong{font:bold 14px Arial, Helvetica, sans-serif; color:#000; line-height:18px; clear:both; text-align:center;}
#bodyCenter #nwcontainer p{font:normal 12px Arial, Helvetica, sans-serif; color:#5c5e5e; line-height:18px; clear:both; text-align:center;}
-->
.tblhd{
text-align:center; font:bold 13px Arial, Helvetica, sans-serif; color:#333333;  padding:5px;}
.tbltxt{
text-align:center; font:12px Arial, Helvetica, sans-serif; color:#333333;  padding:5px; }
</style>
<link href="source.css" rel="stylesheet" type="text/css" />
 <script type="text/javascript" src="scripts/mainmenu.js"></script>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
</head>
<body>
<?php include "top-menu.php"; ?>
<!--top-->
<!--logo navigation-->
<?php include "main-menu-credit-card.php"; ?>
<!--logo navigation-->
<div class="text12" style="margin:auto; width:970px; height:11px; margin-top:11px; color:#0a8bd9;"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> > <a href="#"  class="text12" style="color:#0080d6;"><u>Personal Loan</u></a> <span class="text12" style="color:#4c4c4c;">> Apply for Business Loan</span></div>
<div style="clear:both; height:15px;"></div>
<div class="text12" style="margin:auto; width:1000px;">
<div id="bodyCenter" align="center">
   <div id="nwcontainer" align="center" style="width:998px;">
  <p><strong>Thanks for applying Business Loan through Deal4loans.com. You will soon receive a call from us to negotiate better.</strong></p>
  <? 
  //echo $strcity."-".$Net_Salary."-".$Annual_Turnover."-".$Total_Experience."-".$Years_In_Company."-".$Loan_Amount."<br>";

  if(($strcity=="Hyderabad" || $strcity=="Chennai" || $strcity=="Bangalore" || $strcity=="Mumbai" || $strcity=="Thane" || $strcity=="Navi Mumbai" || $strcity=="Pune" || $strcity=="Delhi" || $strcity=="Noida" || $strcity=="Gurgaon" || $strcity=="Gaziabad" || $strcity=="Faridabad" || $strcity=="Ahmedabad") && $Net_Salary>=300000 && ($Annual_Turnover==2 || $Annual_Turnover==3) && $Total_Experience>=5 && $Years_In_Company>=3 && ($Loan_Amount>=1500000 && $Loan_Amount<=3500000 ))
  { ?>
<table border="1" cellpadding="2" cellspacing="0" align="center" width="70%">
<tr>
<td class="tblhd">Bank Name</td><td class="tblhd">ROI</td><td class="tblhd">Processing Fee</td><td class="tblhd">Loan Amount</td><td class="tblhd"></td></tr>
<tr><td class="tbltxt"><img src="images/rblbnk_bl.jpg" width="90" height="27" border="0" /></td><td class="tbltxt">18% - 19%</td><td class="tbltxt">2%</td><td class="tbltxt">15 Lacs - 35 Lacs </td><td class="tbltxt"><form action="/apply_bl_consent.php" method="POST" target="_blank" >
			 <input type="hidden" name="pl_requestid" value="<? echo $leadid; ?>" id="pl_requestid">
		    <input type="hidden" name="pl_bank_name" id="pl_bank_name" value="RBL Bank">
			<input type="submit" style="width: 49px; height: 20px; border: 0px none ; cursor:pointer; background-image: url(/new-images/apl-yelo-nw.jpg); margin-bottom: 0px; margin-top:10px; background-repeat:no-repeat; background-color:#FFFFFF;" value=""  />
	 </form></td></tr></table>
	 <? } ?>
  </div> 
</div></div>
<div style="clear:both; height:15px;"></div>
<?php include "footer1.php"; ?>
</body>
</html>