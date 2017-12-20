<?php
	ob_start( 'ob_gzhandler' );
	require 'scripts/functions.php';
	require 'scripts/db_init.php';
	require 'scripts/personal_loan_eligibility_function_form.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		foreach($_POST as $a=>$b)
			$$a=$b;
$lead_type = $_POST["lead_type"];
if($lead_type=="employee_referral")
	{
		$employee_id = $_POST["referral_id"];
		$employee_name = $_POST["referral_name"];
		$employee_contact = $_POST["referral_contact"];
		$employee_emailid = $_POST["referral_emailid"];
		$employee_city = $_POST["referral_city"];
		$employee_pincode = $_POST["referral_pincode"];
		$referral_income = $_POST["referral_income"];
		$referral_company = $_POST["referral_company"];
		$referral_loanamount = $_POST["referral_loanamount"];
		$referral_occupation = $_POST["referral_occupation"];
		$CC_Holder = $_POST["CC_Holder"];
		$day = $_POST["day"];
		$month = $_POST["month"];
		$year = $_POST["year"];
		$dob = $year."-".$month."-".$day;
		$getDOB = str_replace("-","", $dob);
	$age = DetermineAgeGETDOB($getDOB);
	$monthsalary =$referral_income/12;
	
	$Dated = ExactServerdate();

	}
	else
	{
		$employee_id = $_POST["employ_id"];
		$employee_name = $_POST["employ_name"];
		$employee_contact = $_POST["employ_contact"];
		$employee_emailid = $_POST["employ_emailid"];
		$employee_city = $_POST["employ_city"];
		$employee_pincode = $_POST["employ_pincode"];

	}

$dataInsert = array("employ_id"=>$employee_id, "employee_name"=>$employee_name, "employ_contact"=>$employee_contact, "employee_email"=>$employee_emailid, "employee_city"=>$employee_city, "employee_pincode"=>$employee_pincode, "referral_income"=>$referral_income, "referral_occupation"=>$referral_occupation, "referral_company_name"=>$referral_company, "referral_loan_amount"=>$referral_loanamount, "referral_dob"=>$dob, "referral_ccholder"=>$CC_Holder, "icici_leadtype"=>$lead_type, "icicipl_dated"=>$Dated);
$table = 'icici_pl_referral_leads';
$insert = Maininsertfunc ($table, $dataInsert);

//echo $iciciplqry."<br>";

}
?>
<html>
<head>
<link href="css/icici-pl-referral-lp-styles.css" type="text/css" rel="stylesheet" />
</head>
<body>
<div id="icici_pl-header">
<div class="icici_pl-header_inn">
<div class="logo"><img src="images/icici_logo_refer.png" width="176" height="36"></div>
</div>
</div>
<div class="banner-icici-refer">
<div class="banner_text_bx">
<div class="text_head_banner">Apply for Your Personal Loan or Refer a Friend <br>
  & </div>
  <div class="text_subhead_banner">Win exciting gifts on every successful Referral Personal loan disbursal</div>
</div>
<div class="right_img_box"><img src="images/icici-pl-referral-pig_bank.png" width="141" height="171"></div>
</div>
<div class="second_container" >
<div class="ttxt_box" align="center">
<span style="font-family:Arial, Helvetica, sans-serif; font-size:20px; color:#000000; margin-top:10px; margin-bottom:10px;" >
Thank you for applying.Your loan request is submitted successfully. <br>

<? 
if($referral_income>=360000 && $age>=23 && $lead_type=="employee_referral")
{
	echo "Below is the personal loan eligibility for your referral request.</span></div>";
$getcompany='select hdfc_bank,fullerton,citibank,barclays,standard_chartered,hdbfs,ingvyasya,bajajfinserv,icici_bank from pl_company_list where company_name="'.$referral_company.'"';
 //echo $getcompany;
list($recordcount,$grow)=MainselectfuncNew($getcompany,$array = array());
$cntr=0;
$icici_bankcategory = $grow[$cntr]["icici_bank"]; 

list($iciciinterestrate,$icicigetloanamout,$icicigetemicalc,$iciciterm,$iciciperlacemi)=icicibank($monthsalary,$referral_company,$icici_bankcategory,$age,$Company_Type,$Primary_Acc);

		if($icicigetloanamout>0)
		{
	?>
	<table width="100%" border="1" cellpadding="2" cellspacing="0"><tr>
    <th width="100" class="bank">&nbsp;</th>
    <th width="100">Interest Rate</th>
    <th width="100">Emi (per Month)</th>
    <th width="80">Tenure</th>
    <th width="120">Eligible Loan<br /> 
      Amount</th>
    
  </tr><tr>
	<td class="banks" align="center"><b>ICICI Bank</b></td>
	<td align="center"><? echo $iciciinterestrate; ?></td>
		<td align="center">Rs. <? echo $icicigetemicalc; ?></td>
		<td align="center"><? echo $iciciterm; ?> yrs.</td>
		<td align="center">Rs. <? echo $icicigetloanamout; ?></td>
				</tr></table> 
	<?
		}
	else
	{
		echo "thank you";
	}
	
} else
{
	echo "You will shortly receive a call for further assistance.</span></div>";
}?></div>

</body>
</html>
<? function DetermineAgeGETDOB ($YYYYMMDD_In)
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
?>