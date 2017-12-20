<?php
ob_start();
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	require 'afiliate_eligiblebidders.php';
	require 'scripts/personal_loan_eligibility_function.php';
	
	//print_r($_POST);
	
	$Msg = "";
	

	function getProductCode($pKey){
	$titles = array(
		'Req_Partner_PL' => '1',
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

//	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	//{
		    $leadid = $_REQUEST['leadid'];
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
		
	$getpldetails=("select Referral_Flag,City_Other,City,Company_Name,Name,Net_Salary,DOB From Req_Partner_PL Where (RequestID='".$leadid."')");
	//echo "select Other_City,City,Company_Name,Name,Net_Salary,DOB From Req_Partner_PL Where (RequestID='".$leadid."')";
	
	 list($recordcount,$plrow)=MainselectfuncNew($getpldetails,$array = array());
		$cntr=0;
	
$getCompany_Name = $plrow[$cntr]['Company_Name'];
$Referral_Flag = $plrow[$cntr]['Referral_Flag'];
$City = $plrow[$cntr]['City'];
$Name = $plrow[$cntr]['Name'];
$DOB = $plrow[$cntr]['DOB'];
$Net_Salary = $plrow[$cntr]['Net_Salary'];
$Other_City = $plrow[$cntr]['City_Other'];	

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
		  $DataArray = array("Company_Type"=>$Company_Type, "PL_EMI_Amt"=>$PL_EMI_Amt, "Primary_Acc"=>$Primary_Acc, " Residential_Status"=>$Residential_Status, "Card_Limit"=>$Credit_Limit, "Years_In_Company"=>$Years_In_Company, " Total_Experience"=>$Total_Experience, "EMI_Paid"=>$EMI_Paid, "Loan_Any"=>$Loan_A, "identification_proof"=>$Document_proof_doc);
		$wherecondition ="RequestID=".$leadid;
		Mainupdatefunc ('Req_Partner_PL', $DataArray, $wherecondition);
		
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
		
//	}//$_POST
	
	
	

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Thank you</title>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script type="text/javascript" src="scripts/calendardateinput.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<link href="style/new-bima.css" rel="stylesheet"  type="text/css" />
<link href="style/glowing.css" rel="stylesheet"  type="text/css" />
<link href="style/slider.css" rel="stylesheet" type="text/css" />
<style>
body{	
background-color:#FFFFFF!important;
background-image:none!important;
}
</style>

<script type="text/javascript" src="js/dropdowntabs.js"></script>
<?php 
	 if(isset($_SESSION['UserType']))
	{
echo "<table width='100%' border='0' cellspacing='0' cellpadding='0'><tr><td width='323' height='93' align='left' valign='top'  ><img src='http://www.deal4loans.com/rnew/images/login-logo.gif' width='323' height='93' /></td><td align='left' valign='top' style='color:#0B6FCC;' ><table width='100%' border='0' cellspacing='0' cellpadding='0' bgcolor='#0A92C0'><tr><td height='67' align='right' valign='middle' bgcolor='#C8E3F3' style='padding-right:10px;'><table border='0' align='right' cellpadding='0' cellspacing='0' bgcolor='#0A92C0'><tr><td width='6' height='32' align='left' valign='top'><img  src='http://www.deal4loans.com/rnew/images/login-form-logut-lft.gif' width='6' height='32' /></td><td  background='http://www.deal4loans.com/images/logutbg.gif' style=' background-repeat:repeat-x; height:32px;'><table width='100%' border='0' align='center' cellpadding='0' cellspacing='0'><tr><td align='left' valign='middle' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#FFFFFF; font-weight:bold; padding-right:15px;' > Welcome ".ucwords($_SESSION['UserType'])." ".$_SESSION['UName']."</td><td align='left' style='padding-right:2px;' width='22'><img src='http://www.deal4loans.com/rnew/images/login-logut-btn.gif' /></td><td align='right' class='style1' style='color:#FFFFFF; font-weight:bold;'><div align='right' class='style1' style='color:#FFFFFF; font-weight:bold;'> <a href='Logout.php' style='color:#FFFFFF; font-size:13px; text-decoration:none; font-family:Verdana, Arial, Helvetica, sans-serif;'>Logout</a></div></td></tr></table></td><td width='6' height='32'><img src='http://www.deal4loans.com/rnew/images/login-form-logut-rgt.gif' width='6' height='32' /></td></tr></table></td></tr><tr><td bgcolor='#FFFFFF'>&nbsp;</td></tr></table></td></tr></table>";
	}
?>


</head>
<body>
<table width="100%" border="0"  align="center" cellpadding="0" cellspacing="0" >
<tr>

    <td align="center">
	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#45B2D8">
      <tr>
	  <td  width="200" valign="top"><?php include '~Partners_Left.php';?></td>
        <td   valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table   border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#45B2D8" >
			
              <tr>
                <td valign="top" ><br /><br />
<h1 style="color:#FFFFFF; font-size:14px;">Thanks for applying.<br /> This will be processed soon.</h1>
</td></tr></table>
</td></tr></table></td></tr></table>

 
</body>
</html>