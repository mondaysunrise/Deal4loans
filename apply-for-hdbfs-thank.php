 <?php
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	
function filter_blank($var) 
{
	return !(empty($var) || is_null($var));
}
	
	function DetermineAgeFromDOB ($YYYYMMDD_In)
	{
	  $yIn=substr($YYYYMMDD_In, 0, 4);
	  $mIn=substr($YYYYMMDD_In, 4, 2);
	  $dIn=substr($YYYYMMDD_In, 6, 2);
	  $ddiff = date("d") - $dIn;
	  $mdiff = date("m") - $mIn;
	  $ydiff = date("Y") - $yIn;
	  if ($mdiff < 0)
	  {
		$ydiff--;
	  } elseif ($mdiff==0)
	  {
		if ($ddiff < 0)
		{
		  $ydiff--;
		}
	  }
	  return $ydiff;
	}
	
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$full_name = $_POST["full_name"];
	$mobile_number = $_POST["Phone"];
	$email_id = $_POST["email_id"];
	$year = $_POST['year'];
	$month = $_POST['month'];
	$day = $_POST['day'];
	$DOB=$year."-".$month."-".$day;
	$getDOB = $year."".$month."".$day;
	$age = DetermineAgeFromDOB($getDOB);
	$city = $_POST["City"];
	$other_city = $_POST["other_city"];
	$Employment_Status = $_POST["Employment_Status"];
	$Company_Name = $_POST["company_name"];
	$source = $_POST["source"];
	$salary = $_POST["net_salary"];
	$reqd_loan_amt = $_POST["Loan_Amount"];
	$panno = $_POST["panno"];
		
if($Company_Name=="Type slowly for autofill")
	{
		$strCompany_Name="";
	}
	else
	{
		$strCompany_Name=$Company_Name;
	}

if(strlen($strCompany_Name)>1)
	{
$getcompany='select hdbfs from pl_company_list where company_name="'.$strCompany_Name.'"';
	$getcompanyresult = ExecQuery($getcompany);
	$grow=mysql_fetch_array($getcompanyresult);
$hdbfscomp = $grow["hdbfs"];
	}

$todayDate = date("Y-m-d")." 23:59:59";
$lastmonth = mktime(0, 0, 0, date("m"), date("d")-30, date("Y"));
$days30ago = date("Y-m-d",$lastmonth)." 00:00:00";

$checkDupSql = "select * from hdbfs_mailer_leads where hdbfs_mobileno = '".$mobile_number."' and hdbfs_mobileno not in (9971396361,9811555306,9873678914,9811215138) and ( hdbfs_dated between '".$days30ago."' and '".$todayDate."')";
$checkDupQuery = ExecQuery($checkDupSql);
$checkDupNum = mysql_num_rows($checkDupQuery);
if($checkDupNum>0)
{
	//header("Location: get-quote-ingvysya-thanks.php");
	//exit();	
}
else
{
	$hdbfspl="INSERT INTO hdbfs_mailer_leads (hdbfs_name, hdbfs_email, hdbfs_mobileno, hdbfs_dob, hdbfs_occupation, hdbfs_company_name, hdbfs_net_salary, hdbfs_loan_amount, hdbfs_city, hdbfs_dated, hdbfs_othercity, hdbfs_source, hdbfs_panno ) VALUES ('".$full_name."', '".$email_id."', '".$mobile_number."', '".$DOB."', '".$Employment_Status."', '".$strCompany_Name."', '".$salary."', '".$reqd_loan_amt."', '".$city."',  NOW(),'".$other_city."', '".$source."','".$panno."' )";
	$hdbfsresult=ExecQuery($hdbfspl);
	$last_inserted_id = mysql_insert_id();
	//echo $hdbfspl."<br>";
}	

	$Annual_Salary = $salary * 12;
	if(($city=="Mumbai" || $city=="Thane" || $city=="Navi Mumbai" || $city=="Bangalore" || $city=="Chennai" || $city=="Hyderabad") && (($Annual_Salary>=360000 &&  strlen($hdbfscomp)>1) || $Annual_Salary>=480000))
	{
		if($city=="Mumbai" || $city=="Thane" || $city=="Navi Mumbai")
		{
			$bidderid=2475;
			$contactno="9004031559";
			$append="Exclusive";
		}
		else if($city=="Bangalore")
		{
			$bidderid=2472;
			$contactno="9538121214";
			$append="Exclusive";
		}
		else if($city=="Chennai")
		{
			$bidderid=2473;
			$contactno="9789042844";
			$append="Exclusive";
		}
		else if($city=="Hyderabad")
		{
			$bidderid=2471;
			$contactno="7799533334";
			$append="Exclusive";
		}
	//	 –          Email id -thirugnana.m@hdbfs.com ,                                     Mobile - 
// – 2471   Email id -  vijay.podipireddy@hdbfs.com                            Mobile -
		$updatehdbfs=ExecQuery("Update hdbfs_mailer_leads set hdbfs_eligible_bidder=".$bidderid." Where (hdbfsid=".$last_inserted_id.")");
		$currentdate=date('d-m-Y');
		//select sms number
		$contactsms ="Select Mobile_no from Req_Compaign Where (BidderID=".$bidderid." and Sms_Flag=1)";
		$contactsmsresult = ExecQuery($contactsms);
		while($hdbfs=mysql_fetch_array($contactsmsresult))
		{
			$smsnumber=$hdbfs["Mobile_no"];
			//$smsnumber="9811215138";
		$message ="Your Personal loan Leads on (".$currentdate.") : ";
		$SMSMessage=$SMSMessage."(1) ".$full_name."-".$mobile_number.",Sal- ".$Annual_Salary.",Co- ".$strCompany_Name.",Acc-".$append;

		if(strlen($smsnumber)>0)
			{
			//SendSMSforLMS($message.$SMSMessage, $smsnumber);
			}
		}
}
}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>HDBFS Personal Loan</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<link href="css/hdbfs-landing-page-styles.css" type="text/css" rel="stylesheet" />
</head>
<body>
<div class="wrapper">
<div class="gray-box">
<div class="logo"><img src="images/hdb-financial-logo-lp.png" width="225" height="57"></div>
<div class="com"><img src="images/hdbfs-com.jpg" width="163" height="29"></div>
<div style="clear:both;"></div>
</div>
<div style="clear:both;"></div>
<div class="form-box" style="font-family:Arial, Helvetica, sans-serif;">
  Thank you for submitting details. Our executive will get in touch with you shortly.
</div>
<div class="right-box"><span class="font-right-head">Special Offer:
</span>
<div class="text-list">
<ul style="color:red;">
<li>50% off on Processing fee, save upto Rs 20,000*</li>
<li>Loan up to Rs.20 Lacs</li>
<li>Zero Foreclosure charges**</li>
<li>Part prepayment facility**</li>
</ul></div>
<div class="font-right-head" style="margin-top:10px;">Features of HDBFS PL:</div>
<div class="text-list">
<ul>
<li>Attractive interest rate and processing charges</li>
<li>Simple documentation.</li>
<li>Speedy processing.</li>
<li>Easy repayment through EMIs</li>
<li>No guarantor/security required.</li>
<li>Convenience of doorstep service.</li>
<li>Special offer for employees of select companies.</li>
</ul>
</div>
</div>
<div style="clear:both;"></div>
</div>
<div class="bottom">
<div class="disc">Disclaimer<br />
*   Offer valid on Login till 31st March 2014<br />
** Conditions apply. Credit at sole discretion of HDBFS.</div>
<div class="poweredby">Powered by: <span style="color:#0e8cc6;">Deal4loans.com</span></div>
</div>
</body>
</html>