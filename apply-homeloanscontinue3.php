<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	require 'scripts/hlrates.php';
	require 'scripts/home_loan_eligibility_function.php';
	require 'getlistofeligiblebidders1.php';
	error_reporting();
function getNumberFormat($number) {
	if($number > 10000000)	{		$num = ((float)$number) / 10000000;	$num = $num.' Crores';	}
	else if($number > 100000)	{	$num = ((float)$number) / 100000;	$num = $num.' Lacs';	}
	else if($number > 1000)	{		$num = ((float)$number) / 1000;		$num = $num.' Thousands';}
	return $num;
}   
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

 	$ProductValue = $_POST['ProductValue'];
	$strCity=$_POST['strcity'];
	$Name=$_POST['Name'];
	if(strlen($ProductValue)>1)
	{
		$ProductValue = $_POST['ProductValue'];
		$strCity=$_POST['strcity'];
		$Name=$_POST['Name'];
	}
	else
	{
		$ProductValue = $_SESSION['ProductValue'];
		$strCity=$_SESSION['strcity'];
		$Name=$_SESSION['Name'];
	}
	$ProductValue = 879254;
	$strCity='Delhi';
	$Name='Upendra';

$hlamtcnt="select Amount,countr_amt From totalLoans Where (Name='Totalcountr' and flag=1)";
list($Getnum,$row)=Mainselectfunc($hlamtcnt,$array = array());
$ttl_hltaken = $row['Amount'];

$sql = "select Mobile_Number,Email,Name,ABMMU_flag, Net_Salary, Co_Applicant_Income, Co_Applicant_Obligation, Total_Obligation, Loan_Amount, DOB, Property_Value, Property_Identified, City, City_Other from Req_Loan_Home where RequestID='".$ProductValue."'";
list($Getnum,$ArrRow)=Mainselectfunc($sql,$array = array());
	
	$Net_Salary = $ArrRow['Net_Salary'];
	$monthly_income = ($Net_Salary /12);
	$co_monthly_income = $ArrRow['Co_Applicant_Income'];
	$Co_Applicant_Obligation = $ArrRow['Co_Applicant_Obligation'];
	$obligations = $ArrRow['Total_Obligation'];
	$getnetAmount = ($monthly_income + $co_monthly_income);
	$loan_amount = $ArrRow['Loan_Amount'];
	$dateofbirth = $ArrRow['DOB'];
	$DOB = str_replace("-","", $dateofbirth);
	$age = DetermineAgeFromDOB($DOB);
	$total_obligation  = $obligations + $co_obligations;
	$property_value = $ArrRow['Property_Value'];
	$Property_Identified = $ArrRow['Property_Identified'];
	$netAmount=($getnetAmount - $total_obligation);
	$City =  $ArrRow['City'];
	$Other_City =  $ArrRow['City_Other'];
	$ABMMU_flag =  $ArrRow['ABMMU_flag'];
	$full_name =  $ArrRow['Name'];
	$Mobile_Number  =  $ArrRow['Mobile_Number'];
	$Email  =  $ArrRow['Email'];
if($City=="Others")
{
	if(strlen($Other_City)>0)
	{
		$strCity=$Other_City;
	}
	else
	{
		$strCity=$City;
	}
}
else
{
	$strCity=$City;
}

$_SESSION['ProductValueHL'] = $ProductValue;
//code the view total loan amount text
$revarrnumber=str_split($ttl_hltaken);
$contstr=count($revarrnumber);
//for($i=count($revarrnumber);$i>-1;$i--)
for($i=0;$i<$contstr;$i++)
{
if($i == $contstr-3 || $i== ($contstr-1) || $i==($contstr-2))
	{
	$lasttxt.='<span style="color:#954D03; font-family:Arial, Helvetica, sans-serif; font-size:19px; font-weight:bold;">'.$revarrnumber[$i].'</span>';
	 }
	else if($i == $contstr-4 || $i== ($contstr-5))
	{	
		$middletxt.='<span style="color:#FEAB0D; font-family:Arial, Helvetica, sans-serif; font-size:26px; font-weight:bold;">'.$revarrnumber[$i].'</span>';

	}
	else
	{
		$starttxt.='<span style="color:#148FD5; font-family:Arial, Helvetica, sans-serif; font-size:24px; font-weight:bold;">'.$revarrnumber[$i].'</span>';
	 }

}
$linkup='<span style="color:#FEAB0D; font-family:Arial, Helvetica, sans-serif; font-size:26px; font-weight:bold;">,</span>';
$linkup2='<span style="color:#148FD5; font-family:Arial, Helvetica, sans-serif; font-size:26px; font-weight:bold;">,</span>';
$total_homeloan_taken= $starttxt."".$linkup2."".$middletxt."".$linkup."".$lasttxt;
//END code the view total loan amount text
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
<link href="source.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="scripts/mainmenu.js"></script>
<script type="text/javascript" src="scripts/common.js"></script>
<style type="text/css">
<!-- 
body {margin-left:0px; margin-top:0px;	margin-right:0px;margin-bottom:0px;	background-color:#203f5f;overflow-x:hidden;	background-color:#FFF;}
.red{color:#F00;}
.data-middle_wrapper{ width:995px; margin:auto; background:#f0f0f0; padding:5px; border:#bababa solid thin; border-radius:10px;}
.inbox-text{width:99%; margin:auto; background:#0f8eda; padding:10px 5px 10px 5px; font-family:Verdana, Geneva, sans-serif; font-size:12px; color:#FFF; line-height:18px;}
.data-middle_wrapper2{width:99%; margin:5px auto; padding:5px 0px 0px 5px; background:#fcfbfb;}
.head-font-text{font-family:Verdana, Geneva, sans-serif; font-size:12px; color:#FFF;}
.head-font-text-b{font-family:Verdana, Geneva, sans-serif; font-size:12px; color:#000;}
-->
</style>
<link href="check_styles.css" type="text/css" rel="stylesheet"  />
<link href="check_styles2.css" type="text/css" rel="stylesheet"  />
</head>
<body>
<!--top-->
<?php include "top-menu.php"; ?>
<!--top-->
<!--logo navigation-->
<?php include "main-menu.php"; ?>
<!--logo navigation-->
<div style="clear:both; height:1px;"></div>
<div style="clear:both; width:1000px; margin:auto;  margin-top:2px;">
<div style="clear:both; height:40px; width:1000px; margin:auto; padding-top:5px;">
<div class="text3" style="float:left; width:1000px; font-size:15px; color:#706F6F; text-transform:none; margin-top:10px; text-align:center;"><strong>Dear <? echo $full_name; ?>, You are <? echo $total_homeloan_taken; ?> th customer , who have taken quote @deal4loans.com<br /><br />
    Thanks for applying Home Loan through deal4Loans.com. You will soon receive call from us to help you to find the best deal.</strong><br />
</div>
</div>
<div style="clear:both;"></div>
<div style="width:1000px; height:auto; margin-left:25px; margin-top:7px; background-color:#FFFFFF;" >
<div id="bodyCenter">
 <div id="nwcontainer">
 <div class="data-middle_wrapper">
<?php
	list($realbankiD,$bankID,$FinalBidder,$finalBidderName)= getBiddersList("Req_Loan_Home",$ProductValue,$strCity);
	$Final_Bid = "";
	while (list ($key,$val) = @each($bankID)) { 
	$Final_Bid[]= $val; 
	} 
	$FinalBidder=implode(',',$FinalBidder);
	$realbankiD=implode(',',$realbankiD);
	if(count($FinalBidder)>0)
	{ ?>
    
<div class="inbox-text">The below mentioned banks are eager to give you a Home Loan.<br>
  We at deal4loans.com believe that its big financial decision that you are about to take.<br>
  To get best deal, speak to 3-4 banks mentioned below and then decide upon the best deal<br>
  This will help you get best deal &amp; save on Emi &amp; choose best product &amp; best service.<br>
</div>
<?php 
} ?>
<div class="data-middle_wrapper2">
<?php	if(count($FinalBidder)>0)
	{ ?>
<div class="check_table_left">
<table border="0" cellpadding="2" cellspacing="0" align="center" width="100%">
<tr>
  <td width="179" height="41" align="center" bgcolor="#88a943" class="head-font-text">Bank Name</td>
  <td width="214" height="41" align="center" bgcolor="#0172b2" class="head-font-text">Interest Rate</td>
  <td width="147" height="41" align="center" bgcolor="#0172b2" class="head-font-text">EMI(Per Month)</td>
  <td width="99" height="41" align="center" bgcolor="#0172b2" class="head-font-text">Tenure</td>
  <td width="141" height="41" align="center" bgcolor="#0172b2" class="head-font-text">Eligible Loan Amount</td>
  <td width="146" height="41" align="center" bgcolor="#0172b2" class="head-font-text">Request for more <br>
    Information</td>
</tr>
        <?
			$eligibileLoanAmtArr = '';
for($i=0;$i<count($Final_Bid);$i++)
	{
	 if($Final_Bid[$i]=="Axis Bank" || $Final_Bid[$i]=="Axis")
	{		 list($axisactualemi,$axisemi,$axisinter,$axisprint_term,$axisloan_amount,$axisviewLoanAmt,$axisperlacemi,$axisperlacemifortwo,$axisterm,$axissemi)=Axis_Homeloan($getnetAmount,$loan_amount,$age,$total_obligation,$strCity,$property_value);
		$eligibileLoanAmtArr[] = $axisviewLoanAmt;
	if($axisviewLoanAmt>0)
		{
		?>
      	<tr>
		 <td height="67" align="center" bgcolor="#f1f1f1" class="head-font-text-b"><img src="new-images/thnk-axis.gif" width="86" height="20" /></td>		  
		  <td align="center" bgcolor="#e6e6e6" class="head-font-text-b"><?php echo $axisinter; ?> %</td>
		   <td align="center" bgcolor="#ececec" class="head-font-text-b">Rs. <?php echo $axisemi; ?> </td>
		  <td align="center" bgcolor="#dedede" class="head-font-text-b"><?php echo abs($axisprint_term); ?> yrs.</td>
		  <td align="center" bgcolor="#d1d1d1" class="head-font-text-b">Rs. <?php echo abs($axisviewLoanAmt); ?></td>
		 <td align="center" bgcolor="#e2e2e2">
          <form action="apply_hl_consent.php" method="POST" target="_blank" >
		 <input type="hidden" name="pl_requestid" value="<? echo $ProductValue; ?>" id="pl_requestid">
		<input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $Final_Bid[$i]; ?>">
		<input name="image" type="image" src="/new-images/th-apply-btn.png" width="75" height="28" tabindex="14"/>
		</form>
          </td>
		  </tr>
  <? }
  else
		{ ?>
   	<tr>
	<td height="67" align="center" bgcolor="#f1f1f1" class="head-font-text-b"><img src="new-images/thnk-axis.gif" width="86" height="20" /></td>
	 <td align="center" bgcolor="#e6e6e6" class="head-font-text-b"><? list($axishlrates)=bankrates($Final_Bid[$i],$loan_amount,$age);
		  echo $axishlrates; ?></td>
		<td align="center" bgcolor="#ececec" class="head-font-text-b">N.A</td>
		  <td align="center" bgcolor="#dedede" class="head-font-text-b">N.A</td>
		  <td align="center" bgcolor="#d1d1d1" class="head-font-text-b">N.A</td>
		<td align="center" bgcolor="#e2e2e2"><b><form action="apply_hl_consent.php" method="POST" target="_blank" >
			<input type="hidden" name="pl_requestid" value="<? echo $ProductValue; ?>" id="pl_requestid">
			<input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $Final_Bid[$i]; ?>">
	<input name="image" type="image" src="/new-images/th-apply-btn.png" width="75" height="28" tabindex="14"/>
		</form></b></td>
		</tr>
	<? 	}
	}
	elseif(($Final_Bid[$i]=="IDBI Housing Finance" || $Final_Bid[$i]=="IDBI Bank"))
	{
	list($idbiactualemi,$idbiemi,$idbiinter,$idbiprint_term,$idbiloan_amount,$idbiviewLoanAmt,$idbiperlacemi,$idbiperlacemifortwo,$idbiterm,$idbisemi)=IDBI_Homeloan($getnetAmount,$loan_amount,$age,$total_obligation,$strCity,$property_value);
		$eligibileLoanAmtArr[] = $idbiviewLoanAmt;
	if($idbiviewLoanAmt>0)
		{
		
		?>
    	<tr>
		<td height="67" align="center" bgcolor="#f1f1f1" class="head-font-text-b"><img src="http://www.deal4loans.com/new-images/thnk-idbi.gif" width="86" height="20" /></td>
		<td align="center" bgcolor="#e6e6e6" class="head-font-text-b"><?php echo $idbiinter; ?> %</td>
		<td align="center" bgcolor="#ececec" class="head-font-text-b">Rs. <?php echo $idbiemi; ?></td>
		<td align="center" bgcolor="#dedede" class="head-font-text-b"><?php echo abs($idbiprint_term); ?> yrs.</td>
		<td align="center" bgcolor="#d1d1d1" class="head-font-text-b">Rs. <?php echo abs($idbiviewLoanAmt); ?></td>
		<td align="center" bgcolor="#e2e2e2"><form action="apply_hl_consent.php" method="POST" target="_blank" >
		<input type="hidden" name="pl_requestid" value="<? echo $ProductValue; ?>" id="pl_requestid">
		<input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $Final_Bid[$i]; ?>">
		<input name="image" type="image" src="/new-images/th-apply-btn.png" width="75" height="28" tabindex="14"/>
		</form></td>
		</tr>
		<?
		}
		else
		{ ?>
             	<tr>
		<td height="67" align="center" bgcolor="#f1f1f1" class="head-font-text-b"><img src="http://www.deal4loans.com/new-images/thnk-idbi.gif" width="86" height="20" /></td>
		 <td align="center" bgcolor="#e6e6e6" class="head-font-text-b"><? list($idbihlrates)=bankrates($Final_Bid[$i],$loan_amount,$age);
		  echo $idbihlrates; ?></td>
		<td align="center" bgcolor="#ececec" class="head-font-text-b">N.A</td>
		  <td align="center" bgcolor="#dedede" class="head-font-text-b">N.A</td>
		  <td align="center" bgcolor="#d1d1d1" class="head-font-text-b">N.A</td>	
		<td align="center" bgcolor="#e2e2e2"><form action="apply_hl_consent.php" method="POST" target="_blank" >
		<input type="hidden" name="pl_requestid" value="<? echo $ProductValue; ?>" id="pl_requestid">
		<input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $Final_Bid[$i]; ?>">
		<input name="image" type="image" src="/new-images/th-apply-btn.png" width="75" height="28" tabindex="14"/>
		</form></td>
		</tr>
		<? }
	}
	elseif($Final_Bid[$i]=="LIC Housing" || $Final_Bid[$i]=="LIC")
	{
	?>
     <tr>
	  <td height="67" align="center" bgcolor="#f1f1f1" class="head-font-text-b"> <? echo $Final_Bid[$i]; ?></td>		
	  <td align="center" bgcolor="#e6e6e6" class="head-font-text-b"><? list($lichlrates)=bankrates($Final_Bid[$i],$loan_amount,$age);
		  echo $lichlrates; ?></td>
		<td align="center" bgcolor="#ececec" class="head-font-text-b">N.A</td>
		  <td align="center" bgcolor="#dedede" class="head-font-text-b">N.A</td>
		  <td align="center" bgcolor="#d1d1d1" class="head-font-text-b">N.A</td>	
	   <td align="center" bgcolor="#e2e2e2"><form action="apply_hl_consent.php" method="POST" target="_blank" >
		<input type="hidden" name="pl_requestid" value="<? echo $ProductValue; ?>" id="pl_requestid">
		<input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $Final_Bid[$i]; ?>">
		<input name="image" type="image" src="/new-images/th-apply-btn.png" width="75" height="28" tabindex="14"/>
		</form></td>
		</tr>
	<?
	}
	elseif($Final_Bid[$i]=="Citibank")
		{ ?> 
        
<tr>
	  <td height="67" align="center" bgcolor="#f1f1f1" class="head-font-text-b"><img src="http://www.deal4loans.com/new-images/citybank-logo.jpg" width="63" height="24" /></td>		
	  <td align="center" bgcolor="#e6e6e6" class="head-font-text-b" colspan="4">10.10% p.a. (Fixed till Sep 30, 2015)<br />
Base Rate + 1.00% p.a. (from October 1, 2015 onwards)<br /><br />Semi Fixed Rates for bookings till Apr 30, 2014 only
<br />
</td>
	   <td align="center" bgcolor="#e2e2e2"><form action="apply_hl_consent.php" method="POST" target="_blank" >
		<input type="hidden" name="pl_requestid" value="<? echo $ProductValue; ?>" id="pl_requestid">
		<input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $Final_Bid[$i]; ?>">
		<input name="image" type="image" src="/new-images/th-apply-btn.png" width="75" height="28" tabindex="14"/>
		</form></td>
		</tr>
		<?php }
	elseif($Final_Bid[$i]=="ICICI" || $Final_Bid[$i]=="ICICI Bank")
	{
list($iciciactualemi,$iciciemi,$iciciinter,$iciciprint_term,$iciciloan_amount,$iciciviewLoanAmt,$iciciperlacemi,$perlacemifortwo,$iciciterm,$icicisemi)=ICICI_Homeloan($netAmount,$loan_amount,$age,$total_obligation,$strCity,$property_value); 
$eligibileLoanAmtArr[] = $iciciviewLoanAmt;
if($iciciviewLoanAmt>0)
		{
?>
<tr>
<td height="67" align="center" bgcolor="#f1f1f1" class="head-font-text-b"><img src="http://www.deal4loans.com/new-images/thnk-icici-h.gif" width="86" height="20" /></td>	
		<td align="center" bgcolor="#e6e6e6" class="head-font-text-b"><? echo $iciciinter; ?> %</td>
		<td align="center" bgcolor="#ececec" class="head-font-text-b"><?php echo $iciciactualemi; ?></td>
		 <td align="center" bgcolor="#dedede" class="head-font-text-b"><?php echo abs($iciciprint_term); ?> yrs.</td>
		<td align="center" bgcolor="#d1d1d1" class="head-font-text-b">Rs. <?php echo abs($iciciviewLoanAmt); ?></td>
		 <td align="center" bgcolor="#e2e2e2"><form action="apply_hl_consent.php" method="POST" target="_blank" >
		<input type="hidden" name="pl_requestid" value="<? echo $ProductValue; ?>" id="pl_requestid">
		<input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $Final_Bid[$i]; ?>">
		<input name="image" type="image" src="/new-images/th-apply-btn.png" width="75" height="28" tabindex="14"/>
		</form></td>
		</tr>
	  <?
		}
else
		{ ?>
<tr>
		<td height="67" align="center" bgcolor="#f1f1f1" class="head-font-text-b"><img src="http://www.deal4loans.com/new-images/thnk-icici-h.gif" width="86" height="20" /></td>	
		 <td align="center" bgcolor="#e6e6e6" class="head-font-text-b"><? list($icicihlrates)=bankrates($Final_Bid[$i],$loan_amount,$age);
		  echo $icicihlrates; ?></td>
		<td align="center" bgcolor="#ececec" class="head-font-text-b">N.A</td>
		  <td align="center" bgcolor="#dedede" class="head-font-text-b">N.A</td>
		  <td align="center" bgcolor="#d1d1d1" class="head-font-text-b">N.A</td>	
		 <td align="center" bgcolor="#e2e2e2"><form action="apply_hl_consent.php" method="POST" target="_blank" >
		<input type="hidden" name="pl_requestid" value="<? echo $ProductValue; ?>" id="pl_requestid">
		<input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $Final_Bid[$i]; ?>">
		<input name="image" type="image" src="/new-images/th-apply-btn.png" width="75" height="28" tabindex="14"/>
		</form></td>
		</tr>
		<? }
	}
elseif($Final_Bid[$i]=="HDFC" || $Final_Bid[$i]=="HDFC Bank" || $Final_Bid[$i]=="HDFC Ltd")
	{
		list($hdfcactualemi,$hdfcemi,$hdfcinter,$hdfcprint_term,$hdfcloan_amount,$hdfcviewLoanAmt,$hdfcperlacemi,$hdfcperlacemifortwo,$hdfcterm,$hdfcsemi)=HDFC_Homeloan($getnetAmount,$loan_amount,$age,$total_obligation,$strCity,$property_value);
		$eligibileLoanAmtArr[] = $hdfcviewLoanAmt;
		if($hdfcviewLoanAmt>0)
		{
?>
<tr>
		<td height="67" align="center" bgcolor="#f1f1f1" class="head-font-text-b"><img src="http://www.deal4loans.com/new-images/thnk-hdfc-l.jpg" width="86" height="20" /></td>
		<td align="center" bgcolor="#e6e6e6" class="head-font-text-b"><?php echo $hdfcinter; ?></td>
		<td align="center" bgcolor="#ececec" class="head-font-text-b"><?php echo $hdfcemi; ?></td>
		<td align="center" bgcolor="#dedede" class="head-font-text-b"><?php echo abs($hdfcprint_term); ?> yrs.</td>
		<td align="center" bgcolor="#d1d1d1" class="head-font-text-b">Rs. <?php echo $hdfcviewLoanAmt; ?></td>
		<td align="center" bgcolor="#e2e2e2"><form action="apply_hl_consent.php" method="POST" target="_blank" >
		<input type="hidden" name="pl_requestid" value="<? echo $ProductValue; ?>" id="pl_requestid">
		<input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $Final_Bid[$i]; ?>">
		<input name="image" type="image" src="/new-images/th-apply-btn.png" width="75" height="28" tabindex="14"/>
		  </form></td>
		  </tr>
		  <?
		}
else
		{ ?>
<tr>
		<td height="67" align="center" bgcolor="#f1f1f1" class="head-font-text-b"><img src="http://www.deal4loans.com/new-images/thnk-hdfc-l.jpg" width="86" height="20" /></td>
		<td align="center" bgcolor="#e6e6e6" class="head-font-text-b"><? list($hdfchlrates)=bankrates($Final_Bid[$i],$loan_amount,$age);
		  echo $hdfchlrates; ?></td>
		<td align="center" bgcolor="#ececec" class="head-font-text-b">N.A</td>
		  <td align="center" bgcolor="#dedede" class="head-font-text-b">N.A</td>
		  <td align="center" bgcolor="#d1d1d1" class="head-font-text-b">N.A</td>	
		<td align="center" bgcolor="#e2e2e2"><form action="apply_hl_consent.php" method="POST" target="_blank" >
		<input type="hidden" name="pl_requestid" value="<? echo $ProductValue; ?>" id="pl_requestid">
		<input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $Final_Bid[$i]; ?>">
		<input name="image" type="image" src="/new-images/th-apply-btn.png" width="75" height="28" tabindex="14"/>
		  </form></td>
		  </tr>
		<? }
}
elseif($Final_Bid[$i]=="Fedbank" || (strncmp ("Fedbank", $Final_Bid[$i],7))==0)
		{
			list($federalemi,$federalinter,$federalterm,$federalloanamt) = federal_Homeloannew($getnetAmount,$age,$obligation,$property_value,$loan_amount);
			$eligibileLoanAmtArr[] = $federalloanamt;
			if($federalloanamt>0)
			{
				?>
				<tr>
		<td height="67" align="center" bgcolor="#f1f1f1" class="head-font-text-b"><img src="http://www.deal4loans.com/new-images/federal_bnksmll.jpg" width="86" height="20" /><br>A FEDERAL BANK SUBSIDIARY<br></td>
		<td align="center" bgcolor="#e6e6e6" class="head-font-text-b"><?php echo $federalinter; ?> %</td>
		<td align="center" bgcolor="#ececec" class="head-font-text-b">Rs.<?php echo $federalemi; ?></td>
		<td align="center" bgcolor="#dedede" class="head-font-text-b"><?php echo $federalterm; ?> yrs.</td>
		<td align="center" bgcolor="#d1d1d1" class="head-font-text-b">Rs. <?php echo $federalloanamt; ?></td>
		<td align="center" bgcolor="#e2e2e2"><form action="apply_hl_consent.php" method="POST" target="_blank" >
		<input type="hidden" name="pl_requestid" value="<? echo $ProductValue; ?>" id="pl_requestid">
		<input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $Final_Bid[$i]; ?>">
		<input name="image" type="image" src="/new-images/th-apply-btn.png" width="75" height="28" tabindex="14"/>
		  </form></td>
		  </tr>
			<? }
			else
			{ ?>
				<tr>
		<td height="67" align="center" bgcolor="#f1f1f1" class="head-font-text-b"><img src="http://www.deal4loans.com/new-images/federal_bnksmll.jpg" width="86" height="20" /><br>A FEDERAL BANK SUBSIDIARY<br></td>
		<td align="center" bgcolor="#e6e6e6" class="head-font-text-b" colspan="4">Check this bank offer via phone</td>
		<td align="center" bgcolor="#e2e2e2"><form action="apply_hl_consent.php" method="POST" target="_blank" >
		<input type="hidden" name="pl_requestid" value="<? echo $ProductValue; ?>" id="pl_requestid">
		<input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $Final_Bid[$i]; ?>">
		<input name="image" type="image" src="/new-images/th-apply-btn.png" width="75" height="28" tabindex="14"/>
		  </form></td>
		  </tr>
<?
			}
		}
		elseif($Final_Bid[$i]=="PNB Housing Finance" || $Final_Bid[$i]=="Punjab National Bank" || $Final_Bid[$i]=="PNB housing")
		{
			list($pnbemi,$pnbinter,$pnbterm,$pnbloanamt) = PNB_Homeloan($getnetAmount,$age,$obligation,$property_value);
			$eligibileLoanAmtArr[] = $pnbloanamt;
			if($pnbloanamt>0)
			{
				?>
				<tr>
		<td height="67" align="center" bgcolor="#f1f1f1" class="head-font-text-b"><img src="http://www.deal4loans.com/new-images/pnbhfl-logo.jpg" width="105" height="20" /></td>
		<td align="center" bgcolor="#e6e6e6" class="head-font-text-b"><?php echo $pnbinter; ?> %</td>
		<td align="center" bgcolor="#ececec" class="head-font-text-b">Rs.<?php echo $pnbemi; ?></td>
		<td align="center" bgcolor="#dedede" class="head-font-text-b"><?php echo $pnbterm; ?> yrs.</td>
		<td align="center" bgcolor="#d1d1d1" class="head-font-text-b">Rs. <?php echo $pnbloanamt; ?></td>
		<td align="center" bgcolor="#e2e2e2"><form action="apply_hl_consent.php" method="POST" target="_blank" >
		<input type="hidden" name="pl_requestid" value="<? echo $ProductValue; ?>" id="pl_requestid">
		<input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $Final_Bid[$i]; ?>">
		<input name="image" type="image" src="/new-images/th-apply-btn.png" width="75" height="28" tabindex="14"/>
		  </form></td>
		  </tr>
			<? }
			else
			{ ?>
				<tr>
		<td height="67" align="center" bgcolor="#f1f1f1" class="head-font-text-b"><img src="http://www.deal4loans.com/new-images/pnbhfl-logo.jpg" width="105" height="20" /></td>
		<td align="center" bgcolor="#e6e6e6" class="head-font-text-b"><? list($pnbhlrates)=bankrates($Final_Bid[$i],$loan_amount,$age);
		  echo $pnbhlrates; ?></td>
		<td align="center" bgcolor="#ececec" class="head-font-text-b">N.A</td>
		  <td align="center" bgcolor="#dedede" class="head-font-text-b">N.A</td>
		  <td align="center" bgcolor="#d1d1d1" class="head-font-text-b">N.A</td>	
		<td align="center" bgcolor="#e2e2e2"><form action="apply_hl_consent.php" method="POST" target="_blank" >
		<input type="hidden" name="pl_requestid" value="<? echo $ProductValue; ?>" id="pl_requestid">
		<input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $Final_Bid[$i]; ?>">
		<input name="image" type="image" src="/new-images/th-apply-btn.png" width="75" height="28" tabindex="14"/>
		  </form></td>
		  </tr>
<?			}
		}
elseif($Final_Bid[$i]=="First Blue Home Finance" || $Final_Bid[$i]=="First Blue" || (strncmp ("First", $Final_Bid[$i],5))==0)
	{
		if($Employment_Status==0)
		{
		list($perlacemi,$viewLoanAmt,$frstblloan_amount,$frstblinter,$frstblactualemi,$frstblterm)=firstblue_HomeloanSE($getnetAmount,$age,$total_obligation,$property_value,$Property_Identified);
		}
		else
		{
			list($perlacemi,$viewLoanAmt,$frstblloan_amount,$frstblinter,$frstblactualemi,$frstblterm)=firstblue_HomeloanSal($getnetAmount,$age,$total_obligation,$property_value,$Property_Identified);
		}
?>
<tr>
<td height="67" align="center" bgcolor="#f1f1f1" class="head-font-text-b"><img src="http://www.deal4loans.com/new-images/first-blue-logo.jpg" width="95"  /></td>
		<td align="center" bgcolor="#e6e6e6" class="head-font-text-b"><?php echo $frstblinter; ?> %</td>
		<td align="center" bgcolor="#ececec" class="head-font-text-b">Rs. <?php echo  $frstblactualemi; ?></td>
		<td align="center" bgcolor="#dedede" class="head-font-text-b"><?php echo $frstblterm; ?> yrs.</td>
		<td align="center" bgcolor="#d1d1d1" class="head-font-text-b">Rs. <?php echo $frstblloan_amount; ?></td>
		<td align="center" bgcolor="#e2e2e2"><form action="apply_hl_consent.php" method="POST" target="_blank" >
		<input type="hidden" name="pl_requestid" value="<? echo $ProductValue; ?>" id="pl_requestid">
		<input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $Final_Bid[$i]; ?>">
		<input name="image" type="image" src="/new-images/th-apply-btn.png" width="75" height="28" tabindex="14"/>
		</form></td>
		</tr>
	  <?
}
else
	{
	if($Final_Bid[$i]=="Citibank" || $Final_Bid[$i]=="Citi Bank")
	{
		$bankwimg='';
	}
	elseif($Final_Bid[$i]=="DHFL")
	{
	$bankwimg='';
	}
	elseif($Final_Bid[$i]=="Standard Chartered" || (strncmp ("Standard", $Final_Bid[$i],8))==0 )
	{
		$bankwimg='<img src="http://www.deal4loans.com/new-images/hl-thnk-stantc.jpg" width="86" height="20" />';
	}
	elseif($Final_Bid[$i]=="Reliance capital" || (strncmp ("Reliance", $Final_Bid[$i],8))==0)
	{
		$bankwimg='';
	}
	elseif($Final_Bid[$i]=="ING VYSYA" || $Final_Bid[$i]=="Ing Vysya" || (strncmp ("ING", $Final_Bid[$i],3))==0)
	{
		$bankwimg='<img src="http://www.deal4loans.com/new-images/thnk-ing.gif" width="86" height="20" />';
	}
	elseif($Final_Bid[$i]=="India Bulls")
	{
		$bankwimg='';
	}
	elseif($Final_Bid[$i]=="Kotak Bank" || (strncmp ("Kotak", $Final_Bid[$i],5))==0)
	{
	$bankwimg='<img src="http://www.deal4loans.com/new-images/thnk-ktk.gif" width="86" height="20" />';
	}
	elseif((strncmp ("Barclays", $Final_Bid[$i],8))==0)
	{	
		$bankwimg='';
	}
	elseif($Final_Bid[$i]=="Citifinancial")
	{
	$bankwimg='';
	}
	elseif($Final_Bid[$i]=="SBI")
	{		
		$bankwimg='';
		}
	else
		{
			$bankwimg='&nbsp;';
		}
		?>
<tr><td height="67" align="center" bgcolor="#f1f1f1" class="head-font-text-b"><? echo $bankwimg;?><br /> 
<? echo $Final_Bid[$i]; ?></td>
<td align="center" bgcolor="#e6e6e6" class="head-font-text-b"><? list($anybnkhlrates)=bankrates($Final_Bid[$i],$loan_amount,$age);
  echo $anybnkhlrates; ?></td>
<td align="center" bgcolor="#ececec" class="head-font-text-b">N.A</td>
  <td align="center" bgcolor="#dedede" class="head-font-text-b">N.A</td>
  <td align="center" bgcolor="#d1d1d1" class="head-font-text-b">N.A</td>              
<td align="center" bgcolor="#e2e2e2"><form action="apply_hl_consent.php" method="POST" target="_blank" >
		<input type="hidden" name="pl_requestid" value="<? echo $ProductValue; ?>" id="pl_requestid">
		<input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $Final_Bid[$i]; ?>">
		<input name="image" type="image" src="/new-images/th-apply-btn.png" width="75" height="28" tabindex="14"/>
		</form></td>
        </tr>
	<? }
	?>
	<tr>
      <td colspan="6" height="2"></td>
      </tr>
	 <? } //for ends here 
//list($sbiemi,$sbiinter,$sbiprint_term,$sbiloan_amount,$sbiviewLoanAmt,$sbiperlacemi,$sbiterm)=@sbi_homeloan($getnetAmount,$loan_amount,$age,$total_obligation,$strCity,$property_value);
		if($sbiloan_amount>0)
		{}
		?>
		</table>
		<span style="float:right; font:bold 11px Arial, Helvetica, sans-serif;" ><a href="http://www.deal4loans.com/rate-disclaimer.php" target="_blank">Disclaimer</a></span>
	   
        
	<? }
		else
		{ ?>
		<? }?>
<?php 
 $getCitySql = "select sub_city from property_details_city where sub_city like '%".$City."%' or city like '%".$City."%'";
list($getCityNum,$CityArrRow)=Mainselectfunc($getCitySql,$array = array());

$sub_city = $CityArrRow['sub_city'];
$explode_city = explode(",", $sub_city);
$implode_city = implode("','", $explode_city);
if($getCityNum>0) {} else { $sub_city = $City; }

$MAXvAL = max($eligibileLoanAmtArr);
$totalEligibleAmt = round($MAXvAL + ($MAXvAL * 15/100));

$getPageSql = "select * from property_details_hl where City  in ('".$implode_city."') and Price<= ".$totalEligibleAmt." and Title!='' and Status =1 order by AgentID desc  limit 0,5";
list($num,$getPageQuery)=Mainselectfunc($getPageSql,$array = array());
$pid_arr = '';
for($i=0;$i<$num;$i++)
{
	$pid_arr[] = ucwords($getPageQuery[$i]['PID']);
}
$arrFirst = '';
$arrSecond = '';
for($cou=0;$cou<count($pid_arr);$cou++)
{
	if($cou>2)
	{
		$arrSecond[] = $pid_arr[$cou];
	}
	else
	{
		$arrFirst[] = $pid_arr[$cou];
	}
}

$strFirst = implode(',' , $arrFirst);
$strSecond = implode(',' , $arrSecond);
?>

  <div style="margin-top:15px;">
         
     <?php
$getPageSql = "select * from property_details_hl where PID in (".$strSecond.")  order by Dated desc";
list($num,$getPageQuery)=Mainselectfunc($getPageSql,$array = array());
for($i=0;$i<$num;$i++)
{
$PID = ucwords($getPageQuery[$i]['PID']);
$State = ucwords($getPageQuery[$i]['State']);
$City = ucfirst($getPageQuery[$i]['City']);
$Price = $getPageQuery[$i]['Price'];
$TitleContent = $getPageQuery[$i]['Title'];
$Rate = $getPageQuery[$i]['Rate'];
$CoveredArea = $getPageQuery[$i]['CoveredArea'];
$Facilities = $getPageQuery[$i]['Facilities'];
$Description = $getPageQuery[$i]['Description'];
$ApprovedBy = $getPageQuery[$i]['ApprovedBy'];
$BuilderName = $getPageQuery[$i]['BuilderName'];
$Status = $getPageQuery[$i]['Status'];
$AgentID = $getPageQuery[$i]['AgentID'];
$AgentName = $getPageQuery[$i]['AgentName'];
$AgentEmail = $getPageQuery[$i]['AgentEmail'];
$AgentMobile = $getPageQuery[$i]['AgentMobile'];
$AgentPwd = $getPageQuery[$i]['AgentPwd'];

?>
<?php if(strlen($TitleContent)>1) { ?>
<div class="right_continuedinnsecond_new">
<div class="right_continuedinnhead"><?php echo $TitleContent; echo $PID; ?></div>
<div class="right_continuedinnbelow">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
  
    <tr>
      <td width="5%" height="25" valign="middle" class="righttexbx"><strong><img src="new-images/ruppesmbl.png" width="9" height="13"></strong></td>
      <td width="95%" valign="middle" class="righttexbx"><strong><?php echo getNumberFormat($Price); ?></strong></td>
    </tr>
    <tr>
      <td colspan="2">  <?php if(strlen($Rate)>1) { ?>      <strong>Price per Sq-ft.:</strong> <img src="/new-images/rupees.gif" border="0" width="8" height="10" /><?php echo $Rate; ?> <br> <?php } ?>
       <?php if(strlen($CoveredArea)>1) { ?> <strong>Covered Area -</strong> <?php echo $CoveredArea; ?> Sq-ft.<br><?php } ?>
       <?php if(strlen($BuilderName)>1) { ?> <strong>Builder -</strong> <?php echo $BuilderName; ?> <br><?php } ?>
       <?php  $ApprovedBy='HDFC'; if(strlen($ApprovedBy)>1) { ?> <strong>Approved By</strong> - <?php echo $ApprovedBy; ?><?php } ?>
        
        </td>
    </tr>
    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2">
	     <form action="get-property-submit.php" method="POST" target="_blank" >
       	 <input type="hidden" name="Reply_Type" value="2" id="Reply_Type">
		 <input type="hidden" name="RequestID" value="<? echo $ProductValue; ?>" id="RequestID">
		 <input type="hidden" name="PropertyID" value="<?php echo $PID ; ?>" />
   		 <input type="hidden" name="AgentID" value="<?php echo $AgentID ; ?>" />
         <input type="submit" name="button" id="button" value="Contact Agent" class="buttonmag" >
       </form>
  </td>
    </tr>
  </table>
</div>
<div><img src="new-images/shadow12121new.jpg" width="100%" height="16"></div>
</div>

<?php
} 
}
?>
     
     
         </div>


         </div>
        
         
         
        <div class="right_continued">

<?php
//echo $getPageSql;
$getPageSql = "select * from property_details_hl where PID in (".$strFirst.")  order by Dated desc";
list($num,$getPageQuery)=Mainselectfunc($getPageSql,$array = array());
for($i=0;$i<$num;$i++)
{
$PID = ucwords($getPageQuery[$i]['PID']);
$State = ucwords($getPageQuery[$i]['State']);
$City = ucfirst($getPageQuery[$i]['City']);
$Price = $getPageQuery[$i]['Price'];
$TitleContent = $getPageQuery[$i]['Title'];
$Rate = $getPageQuery[$i]['Rate'];
$CoveredArea = $getPageQuery[$i]['CoveredArea'];
$Facilities = $getPageQuery[$i]['Facilities'];
$Description = $getPageQuery[$i]['Description'];
$ApprovedBy = $getPageQuery[$i]['ApprovedBy'];
$BuilderName = $getPageQuery[$i]['BuilderName'];
$Status = $getPageQuery[$i]['Status'];
$AgentID = $getPageQuery[$i]['AgentID'];
$AgentName = $getPageQuery[$i]['AgentName'];
$AgentEmail = $getPageQuery[$i]['AgentEmail'];
$AgentMobile = $getPageQuery[$i]['AgentMobile'];
$AgentPwd = $getPageQuery[$i]['AgentPwd'];

?>
<?php if(strlen($TitleContent)>1) { ?>
<div class="right_continuedinnsecond">
<div class="right_continuedinnhead"><?php echo $TitleContent; echo $PID; ?></div>
<div class="right_continuedinnbelow">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
  
    <tr>
      <td width="5%" height="25" valign="middle" class="righttexbx"><strong><img src="new-images/ruppesmbl.png" width="9" height="13"></strong></td>
      <td width="95%" valign="middle" class="righttexbx"><strong><?php echo getNumberFormat($Price); ?></strong></td>
    </tr>
    <tr>
      <td colspan="2">  <?php if(strlen($Rate)>1) { ?>      <strong>Price per Sq-ft.:</strong> <img src="/new-images/rupees.gif" border="0" width="8" height="10" /><?php echo $Rate; ?> <br> <?php } ?>
       <?php if(strlen($CoveredArea)>1) { ?> <strong>Covered Area -</strong> <?php echo $CoveredArea; ?> Sq-ft.<br><?php } ?>
       <?php if(strlen($BuilderName)>1) { ?> <strong>Builder -</strong> <?php echo $BuilderName; ?> <br><?php } ?>
       <?php  $ApprovedBy='HDFC'; if(strlen($ApprovedBy)>1) { ?> <strong>Approved By</strong> - <?php echo $ApprovedBy; ?><?php } ?>
        
        </td>
    </tr>
    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2">
	     <form action="get-property-submit.php" method="POST" target="_blank" >
       	 <input type="hidden" name="Reply_Type" value="2" id="Reply_Type">
		 <input type="hidden" name="RequestID" value="<? echo $ProductValue; ?>" id="RequestID">
		 <input type="hidden" name="PropertyID" value="<?php echo $PID ; ?>" />
   		 <input type="hidden" name="AgentID" value="<?php echo $AgentID ; ?>" />
         <input type="submit" name="button" id="button" value="Contact Agent" class="buttonmag" >
       </form>
  </td>
    </tr>
  </table>
</div><div style="clear:both;"></div>
<div><img src="new-images/shadow12121new.jpg" width="100%" height="16"></div>
</div>

<?php
} 
}
?>


</div>

<div style="clear:both;"></div>

         </div>
         
 </div>      
         
         
<!-- Place this tag where you want the +1 button to render. -->
<!-- Place this tag after the last +1 button tag. -->

</div>
</div>
</div><div style="clear:both;"></div>
<script type="text/javascript">
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>
<div align="center" style="padding-top:20px;">     
<span style="font-size:10px;">Advertisment</span><br />
<div align="center" style="padding-top:10px;"><a href="http://www.americanexpressindia.co.in/platinumTravel.aspx?siteid=Deal4loanPlatinumTravelCard&adunit=PlatinumTravelCard_728x90SeptDec&banner=PlatinumTravelCard_SeptDec&campaign=PlatinumTravelCard&marketingagency=interactive" target="_blank" style="text-decoration:none;"><img src="new-images/cc/Amex_banner728x90oct12.jpg" width="728" height="90" border="0" /></a></div>
</div>
<div style="clear:both; width:964px; margin:auto; margin-top:1px;"></div>
</div>
<?php include "footer1.php"; ?>
</body>
</html>