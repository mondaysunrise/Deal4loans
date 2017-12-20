<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	require 'scripts/home_loan_eligibility_function.php';
	require 'getlistofeligiblebidders1.php';
//cho "uh";
	error_reporting();

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
 
//print_r($_SESSION);
 	$ProductValue = $_SESSION['ProductValue'];
	$strCity=$_SESSION['strcity'];
	$Name=$_SESSION['Name'];
	
$selectresult=("select Amount,countr_amt From totalLoans Where (Name='Totalcountr' and flag=1)");
	list($recordcount,$hlamtcnt)=Mainselectfunc($selectresult,$array = array());
$hlamtcnt['Amount'];

	$sql = "select Email,Mobile_Number,Name,ABMMU_flag, Net_Salary, Co_Applicant_Income, Co_Applicant_Obligation, Total_Obligation, Loan_Amount, DOB, Property_Value, Property_Identified, City, City_Other from Req_Loan_Home where RequestID='".$ProductValue."'";
	list($recordcount,$query)=MainselectfuncNew($sql,$array = array());
	$Net_Salary = $query[0]['Net_Salary'];
	$monthly_income = ($Net_Salary /12);
	$co_monthly_income = $query[0]['Co_Applicant_Income'];
	$Co_Applicant_Obligation = $query[0]['Co_Applicant_Obligation'];
	$obligations = $query[0]['Total_Obligation'];
	$getnetAmount = ($monthly_income + $co_monthly_income);
	$loan_amount = $query[0]['Loan_Amount'];
	$dateofbirth = $query[0]['DOB'];
	$DOB = str_replace("-","", $dateofbirth);
	$age = DetermineAgeFromDOB($DOB);
	$total_obligation  = $obligations + $co_obligations;
	$property_value = $query[0]['Property_Value'];
	$Property_Identified = $query[0]['Property_Identified'];
	$netAmount=($getnetAmount - $total_obligation);
	$City =  $query[0]['City'];
	$Other_City =  $query[0]['City_Other'];
	$ABMMU_flag =  $query[0]['ABMMU_flag'];
	$Mobile_Number =  $query[0]['Mobile_Number'];
	$Email =  $query[0]['Email'];
	$full_name =  $query[0]['Name'];
	

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

list($strFirst,$strLast) = split('[ ]', $full_name);
if(strlen($strFirst)>25)
		{
			$shrtfname=strlen($strFirst)-25;
			$First = substr(trim($strFirst), 0, strlen(trim($strFirst))-$shrtfname);

		}
		else
		{
			$First =$strFirst;
		}
if(strlen($strLast)>25)
		{
			$shrtlname=strlen($strLast)-25;
			$Last = substr(trim($strLast), 0, strlen(trim($strLast))-$shrtlname);

		}
		else
		{
			$Last =$strLast;
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

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>  
<title>Apply Home Loan - Compare interest Rates, Eligibility, Banks and Apply Home Loans online</title>
<meta name="keywords" content="apply home loan, housing loan, Apply Home Loans, online home loans, online home loan, Housing Loans, apply Home loans India,">
<meta name="description" content="Home Loan apply : Apply for home loans Online and get quotes from all home loan provider of India like Mumbai, Delhi, Noida, Kolkata, Gurgaon, Bangalore, Chennai, Hyderabad, Pune etc.">
<link rel="canonical" href="http://www.deal4loans.com/apply-home-loans.php"/>
<link href="source.css" rel="stylesheet" type="text/css" />
 <script type="text/javascript" src="scripts/mainmenu.js"></script>
 <script type="text/javascript" src="scripts/common.js"></script>
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
<link href="source.css" rel="stylesheet" type="text/css" />
 
  <style>
html, body, div, span, applet, object, iframe, h1, h2, h3, h4, h5, h6, p, blockquote, pre, a, abbr, acronym, address, big, cite, code, del, dfn, em, font, img, ins, kbd, q, s, samp, small, strike, sub, sup, tt, var, b, u, i, center, dl, dt, dd, ol, ul, li, fieldset, form, label, legend, table, caption, tbody, tfoot, thead, tr, th, td {margin:0;padding:0;border:0;outline:0;vertical-align:baseline; outline:none;}
body {line-height:1; }
ol, ul {list-style:none;}
blockquote, q {quotes:none;}
blockquote:before, blockquote:after, q:before, q:after {content:'';content:none;}
:focus {outline:0;}
ins {text-decoration:none;}
del{text-decoration:line-through;}
table {border-collapse:collapse;border-spacing:0;}

#bodyCenter #nwcontainer{background:url("http://www.deal4loans.com/new-images/container-bg.png") repeat-x; clear:both; width:850px; min-height:437px; padding:29px 10px 10px 10px;}
#bodyCenter #nwcontainer p strong{font:bold 14px Arial, Helvetica, sans-serif; color:#000; line-height:18px; clear:both; text-align:center;}
#bodyCenter #nwcontainer p{font:normal 12px Arial, Helvetica, sans-serif; color:#5c5e5e; line-height:18px; clear:both; text-align:center;}

#bodyCenter #nwcontainer #data{clear:both; margin:28px 0 15px 0;}
#bodyCenter #nwcontainer #data table{width:846px; margin:0 auto; position:relative;}
#bodyCenter #nwcontainer #data table tr{}
#bodyCenter #nwcontainer #data table tr th{font:bold 12px Arial, Helvetica, sans-serif; color:#3b5586; background:url("http://www.deal4loans.com/new-images/li-bg.jpg") repeat-x; height:33px; padding:3px 0 0 0;}
#bodyCenter #nwcontainer #data table tr th.bank{background:url("http://www.deal4loans.com/new-images/bank-name.png") no-repeat; width:116px;}
#bodyCenter #nwcontainer #data table tr td{border-bottom:2px solid #fff!important; height:80px;}
#bodyCenter #nwcontainer #data table tr td.banks{background:#f1f1f1; width:116px; text-align:center; padding:30px 0 0 0; height:50px; font:bold 10px Arial, Helvetica, sans-serif;}
#bodyCenter #nwcontainer #data table tr td.i-rate{background:#e7e6e6; text-align:center; font:bold 11px Arial, Helvetica, sans-serif; color:#706f6f; width:149px; }
#bodyCenter #nwcontainer #data table tr td.emi{background:#ececec; text-align:center;font:bold 11px Arial, Helvetica, sans-serif; color:#706f6f; width:161px; padding:0 0 0 5px;}
#bodyCenter #nwcontainer #data table tr td.tenure{text-align:center; font:bold 12px Arial, Helvetica, sans-serif; color:#706f6f; width:61px; padding:0 0 0 5px; background:url("http://www.deal4loans.com/new-images/tenure-bg.jpg") repeat-y; text-align:center; }
#bodyCenter #nwcontainer #data table tr td.loan{text-align:left; font:bold 12px Arial, Helvetica, sans-serif; color:#706f6f; width:134px; padding:0 0 0 5px; background:url("http://www.deal4loans.com/new-images/loan-bg.jpg") repeat-y; text-align:center;}
#bodyCenter #nwcontainer #data table tr td.info{text-align:left; font:bold 13px Arial, Helvetica, sans-serif; color:#bf2228; width:100px; padding:0 0 0 5px; background:url("http://www.deal4loans.com/new-images/information.jpg") repeat-y; text-align:center; }
</style>
</head>

<body>
<!--top-->
<?php include "top-menu.php"; ?>
<!--top-->

<!--logo navigation-->
<?php include "main-menu.php"; ?>
<!--logo navigation-->


<div class="text12" style="margin:auto; width:970px; height:11px; margin-top:11px; color:#0a8bd9;"><u><a href="index.html" class="text12" style="color:#0080d6;" >Home</a></u> > <a href="home-loans.php"  class="text12" style="color:#0080d6;"><u>Home Loan</u></a> <span class="text12" style="color:#4c4c4c;">> Apply for Home Loan</span></div>
<div style="clear:both; height:1px;"></div>

  <?php
//echo $getnetAmount." - ".$loan_amount." - ".$age." - ".$total_obligation." - ".$strCity." - ".$property_value;
	list($realbankiD,$bankID,$FinalBidder,$finalBidderName)= getBiddersList("Req_Loan_Home",$ProductValue,$strCity);

	$Final_Bid = "";
	while (list ($key,$val) = @each($bankID)) { 
	$Final_Bid[]= $val; 
	} 

	$FinalBidder=implode(',',$FinalBidder);
	$realbankiD=implode(',',$realbankiD);
	
	?>

<div style="clear:both; width:960px; margin:auto;  margin-top:2px;">


<div style="clear:both; height:40px; width:960px; margin:auto; padding-top:2px;">
<div class="text3" style="float:left; width:960px; font-size:15px; color:#0000CC; text-transform:none; margin-top:10px; text-align:center;">
<strong>Dear <? echo $full_name; ?>, You are <? echo $total_homeloan_taken; ?> th customer , who have taken quote @deal4loans.com<br /><br /></strong>
<?php
	if(count($FinalBidder)>0)
	{ ?>
<strong>Thanks for applying Home Loan through deal4Loans.com. You will soon receive call from us to help you to find the best deal.</strong><br />
<?php } else { ?>
<strong>Thanks for applying Home Loan through deal4Loans.com. <br />As per your profile, Currently we cannot service any offer from any Bank</strong><br />
<?php } ?>
</div>

</div>

<div style=" float:left; width:881px; height:auto; margin-left:15px; margin-top:7px; background-color:#FFFFFF;" >
<div id="bodyCenter">
 <div id="nwcontainer" >
   
<?php
	if(count($FinalBidder)>0)
	{ ?>
<div style="text-align:left; float:left; font-size:12px; " class="tbl_txt" >
<table height="74" cellpadding="2" cellspacing="2" class="tbl_txt" style=" font-size:11px;">
  <tr><td height="20">
  The below mentioned banks are eager to give you a Home loan.</td></tr>
<tr><td height="20"> We at deal4loans.com believe that its big financial decision that you
are about to take.</td></tr>
<tr><td height="20"> To get best deal, speak to 3 - 4 banks mentioned below and then decide
upon the best deal.</td></tr>
<tr><td height="20">This will help you get best deal & save on Emi & choose best product &
best service.</td></tr></table><br />
</div>

<div id="data" align="center">
<table border="0" cellpadding="2" cellspacing="0" align="center">
  <tr>
    <th width="50" class="bank">&nbsp;</th>
    <th width="167">Interest Rate</th>
    <th width="189">Emi (per Month)</th>
    <th width="46">Tenure</th>
    <th width="83">Eligible Loan<br /> 
      Amount</th>
    <th width="154">Request for more<br /> 
      Information</th>
  </tr>
        <?
for($i=0;$i<count($Final_Bid);$i++)
	{
	 if($Final_Bid[$i]=="Axis Bank" || $Final_Bid[$i]=="Axis")
	{		 list($axisactualemi,$axisemi,$axisinter,$axisprint_term,$axisloan_amount,$axisviewLoanAmt,$axisperlacemi,$axisperlacemifortwo,$axisterm,$axissemi)=Axis_Homeloan($getnetAmount,$loan_amount,$age,$total_obligation,$strCity,$property_value);
	if($axisviewLoanAmt>0)
		{
	
		?>
		<tr>
		 <td class="banks"><img src="new-images/thnk-axis.gif" width="86" height="20" /><br /> 	  <? echo $Final_Bid[$i]; ?></td>		  
		  <td class="i-rate"><?php echo $axisinter; ?> %</td>
		   <td class="emi">Rs. <?php echo $axisemi; ?> </td>
		  <td class="tenure"><?php echo abs($axisprint_term); ?> yrs.</td>
		  <td class="loan">Rs. <?php echo abs($axisviewLoanAmt); ?></td>
		 <td class="info">
          <form action="apply_hl_consent.php" method="POST" target="_blank" >
		 <input type="hidden" name="pl_requestid" value="<? echo $ProductValue; ?>" id="pl_requestid">
		<input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $Final_Bid[$i]; ?>">
		<input type="submit" style="width: 49px; height:20px; border: 0px none ; cursor:pointer; background-image: url(http://www.deal4loans.com/new-images/apl-yelo-nw.jpg); margin-bottom: 0px; margin-top:10px; background-repeat:no-repeat; background-color:#FFFFFF;" value=""  />
		</form>
          </td>
		  </tr>
  <? }
  else
		{ ?>
		<tr>
		<td class="banks"><img src="new-images/thnk-axis.gif" width="86" height="20" /><br /> 
              <? echo $Final_Bid[$i]; ?></td>
			  <td colspan="4" class="i-rate">Check this bank offer via phone</td>
		<td class="info"><b><form action="apply_hl_consent.php" method="POST" target="_blank" >
			<input type="hidden" name="pl_requestid" value="<? echo $ProductValue; ?>" id="pl_requestid">
			<input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $Final_Bid[$i]; ?>">
			<input type="submit" style="width: 49px; height:20px; border: 0px none ; cursor:pointer; background-image: url(http://www.deal4loans.com/new-images/apl-yelo-nw.jpg); margin-bottom: 0px; margin-top:10px; background-repeat:no-repeat; background-color:#FFFFFF;" value=""  />
		</form></b></td>
		</tr>
	<? 	}
	}
	elseif(($Final_Bid[$i]=="IDBI Housing Finance" || $Final_Bid[$i]=="IDBI Bank"))
	{ ?>
	
<tr>
		<td class="banks"><br /> 
		<? echo $Final_Bid[$i]; ?></td>
		<td class="i-rate" colspan="4">Check this bank offer via phone</td>		
		<td class="info"><form action="apply_hl_consent.php" method="POST" target="_blank" >
		<input type="hidden" name="pl_requestid" value="<? echo $ProductValue; ?>" id="pl_requestid">
		<input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $Final_Bid[$i]; ?>">
		<input type="submit" style="width: 49px; height:20px; border: 0px none ; cursor:pointer; background-image: url(http://www.deal4loans.com/new-images/apl-yelo-nw.jpg); margin-bottom: 0px; margin-top:10px; background-repeat:no-repeat; background-color:#FFFFFF;" value=""  />
		</form></td>
		</tr>
		<? 
	}
	
	elseif(($Final_Bid[$i]=="LIC" || $Final_Bid[$i]=="LIC Housing"))
	{ ?>
<tr>
	  <td class="banks"><? echo $Final_Bid[$i]; ?></td>		
	  <td class="i-rate" colspan="4">Check this bank offer via phone</td>
	   <td class="info"><form action="apply_hl_consent.php" method="POST" target="_blank" >
		<input type="hidden" name="pl_requestid" value="<? echo $ProductValue; ?>" id="pl_requestid">
		<input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $Final_Bid[$i]; ?>">
		<input type="submit" style="width: 49px; height:20px; border: 0px none ; cursor:pointer; background-image: url(http://www.deal4loans.com/new-images/apl-yelo-nw.jpg); margin-bottom: 0px; margin-top:10px; background-repeat:no-repeat; background-color:#FFFFFF;" value=""  />
		</form></td>
		</tr>
	<? 	
	}
	elseif($Final_Bid[$i]=="PNB Housing Finance" || $Final_Bid[$i]=="Punjab National Bank")
		{
			list($pnbemi,$pnbinter,$pnbterm,$pnbloanamt) = PNB_Homeloan($getnetAmount,$age,$total_obligation,$property_value);
			if($pnbloanamt>0)
			{
				?>
				<tr>
		<td class="banks"><img src="http://www.deal4loans.com/new-images/pnbhfl-logo.jpg" width="105" height="20" /><br /> 
		<? echo $Final_Bid[$i]; ?><br></td>
		<td class="i-rate"><?php echo $pnbinter; ?> %</td>
		<td class="emi">Rs.<?php echo $pnbemi; ?></td>
		<td class="tenure"><?php echo $pnbterm; ?> yrs.</td>
		<td class="loan">Rs. <?php echo $pnbloanamt; ?></td>
		<td class="info"><form action="apply_hl_consent.php" method="POST" target="_blank" >
		<input type="hidden" name="pl_requestid" value="<? echo $ProductValue; ?>" id="pl_requestid">
		<input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $Final_Bid[$i]; ?>">
		<input type="submit" style="width: 49px; height: 20px; border: 0px none ; cursor:pointer; background-image: url(http://www.deal4loans.com/new-images/apl-yelo-nw.jpg); margin-bottom: 0px; margin-top:10px; background-repeat:no-repeat; background-color:#FFFFFF;" value=""  />
		  </form></td>
		  </tr>
			<? }
			else
			{ ?>
				<tr>
		<td class="banks"><img src="http://www.deal4loans.com/new-images/pnbhfl-logo.jpg" width="105" height="20" /><br /> 
		<? echo $Final_Bid[$i]; ?></td>
		<td class="i-rate" colspan="4">Check this bank offer via phone</td>
		<td class="info"><form action="apply_hl_consent.php" method="POST" target="_blank" >
		<input type="hidden" name="pl_requestid" value="<? echo $ProductValue; ?>" id="pl_requestid">
		<input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $Final_Bid[$i]; ?>">
		<input type="submit" style="width: 49px; height: 20px; border: 0px none ; cursor:pointer; background-image: url(http://www.deal4loans.com/new-images/apl-yelo-nw.jpg); margin-bottom: 0px; margin-top:10px; background-repeat:no-repeat; background-color:#FFFFFF;" value=""  />
		  </form></td>
		  </tr>
<?
			}

		}
	elseif($Final_Bid[$i]=="ICICI" || $Final_Bid[$i]=="ICICI Bank")
	{
list($iciciactualemi,$iciciemi,$iciciinter,$iciciprint_term,$iciciloan_amount,$iciciviewLoanAmt,$iciciperlacemi,$perlacemifortwo,$iciciterm,$icicisemi)=ICICI_Homeloan($netAmount,$loan_amount,$age,$total_obligation,$strCity,$property_value); 
if($iciciviewLoanAmt>0)
		{
?>
<tr>
		<td class="banks"><img src="http://www.deal4loans.com/new-images/thnk-icici-h.gif" width="86" height="20" /><br /> 
		<? echo $Final_Bid[$i]; ?></td>	
		<td class="i-rate"><b><? echo $iciciinter; ?> %</b></td>
		<td class="emi"><b> <?php echo $iciciactualemi; ?></b></td>
		 <td class="tenure"><?php echo abs($iciciprint_term); ?> yrs.</td>
		<td class="loan">Rs. <?php echo abs($iciciviewLoanAmt); ?></td>
		 <td class="info"><form action="apply_hl_consent.php" method="POST" target="_blank" >
		<input type="hidden" name="pl_requestid" value="<? echo $ProductValue; ?>" id="pl_requestid">
		<input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $Final_Bid[$i]; ?>">
		<input type="submit" style="width: 49px; height:20px; border: 0px none ; cursor:pointer; background-image: url(http://www.deal4loans.com/new-images/apl-yelo-nw.jpg); margin-bottom: 0px; margin-top:10px; background-repeat:no-repeat; background-color:#FFFFFF;" value=""  />
		</form></td>
		</tr>
	  <?
		}
else
		{ ?>
<tr>
		<td class="banks"><img src="http://www.deal4loans.com/new-images/thnk-icici-h.gif" width="86" height="20" /><br /> 
		<? echo $Final_Bid[$i]; ?></td>	
		<td colspan="4" class="i-rate">Check this bank offer via phone</td>
		 <td class="info"><form action="apply_hl_consent.php" method="POST" target="_blank" >
		<input type="hidden" name="pl_requestid" value="<? echo $ProductValue; ?>" id="pl_requestid">
		<input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $Final_Bid[$i]; ?>">
		<input type="submit" style="width: 49px; height: 20px; border: 0px none ; cursor:pointer; background-image: url(http://www.deal4loans.com/new-images/apl-yelo-nw.jpg); margin-bottom: 0px; margin-top:10px; background-repeat:no-repeat; background-color:#FFFFFF;" value=""  />
		</form></td>
		</tr>

		<? }
	}
elseif($Final_Bid[$i]=="Fedbank" || (strncmp ("Fedbank", $Final_Bid[$i],7))==0)
		{
			list($federalemi,$federalinter,$federalterm,$federalloanamt) = federal_Homeloannew($getnetAmount,$age,$obligation,$property_value,$loan_amount);
			if($federalloanamt>0)
			{
				?>
				<tr>
		<td class="banks"><img src="http://www.deal4loans.com/new-images/federal_bnksmll.jpg" width="86" height="20" /><br><span style="color:#004c9a;">A FEDERAL BANK SUBSIDIARY</span><br /> 
		<? echo $Final_Bid[$i]; ?></td>
		<td class="i-rate"><?php echo $federalinter; ?> %</td>
		<td class="emi">Rs.<?php echo $federalemi; ?></td>
		<td class="tenure"><?php echo $federalterm; ?> yrs.</td>
		<td class="loan">Rs. <?php echo $federalloanamt; ?></td>
		<td class="info"><form action="apply_hl_consent.php" method="POST" target="_blank" >
		<input type="hidden" name="pl_requestid" value="<? echo $ProductValue; ?>" id="pl_requestid">
		<input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $Final_Bid[$i]; ?>">
		<input type="submit" style="width: 49px; height: 20px; border: 0px none ; cursor:pointer; background-image: url(http://www.deal4loans.com/new-images/apl-yelo-nw.jpg); margin-bottom: 0px; margin-top:10px; background-repeat:no-repeat; background-color:#FFFFFF;" value=""  />
		  </form></td>
		  </tr>
			<? }
			else
			{ ?>
				<tr>
		<td class="banks"><img src="http://www.deal4loans.com/new-images/federal_bnksmll.jpg" width="86" height="20" /><br /> 
		<? echo $Final_Bid[$i]; ?></td>
		<td class="i-rate" colspan="4">Check this bank offer via phone</td>
		<td class="info"><form action="apply_hl_consent.php" method="POST" target="_blank" >
		<input type="hidden" name="pl_requestid" value="<? echo $ProductValue; ?>" id="pl_requestid">
		<input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $Final_Bid[$i]; ?>">
		<input type="submit" style="width: 49px; height: 20px; border: 0px none ; cursor:pointer; background-image: url(http://www.deal4loans.com/new-images/apl-yelo-nw.jpg); margin-bottom: 0px; margin-top:10px; background-repeat:no-repeat; background-color:#FFFFFF;" value=""  />
		  </form></td>
		  </tr>
<?
			}
		}
elseif($Final_Bid[$i]=="HDFC" || $Final_Bid[$i]=="HDFC Bank" || $Final_Bid[$i]=="HDFC Ltd")
	{
		list($hdfcactualemi,$hdfcemi,$hdfcinter,$hdfcprint_term,$hdfcloan_amount,$hdfcviewLoanAmt,$hdfcperlacemi,$hdfcperlacemifortwo,$hdfcterm,$hdfcsemi)=HDFC_Homeloan($getnetAmount,$loan_amount,$age,$total_obligation,$strCity,$property_value);
		if($hdfcviewLoanAmt>0)
		{
?>
<tr>
		<td class="banks"><img src="http://www.deal4loans.com/new-images/thnk-hdfc-l.jpg" width="86" height="20" /><br /> 
		<? echo $Final_Bid[$i]; ?></td>
		<td class="i-rate"><?php echo $hdfcinter; ?></td>
		<td class="emi"><?php echo $hdfcemi; ?></td>
		<td class="tenure"><?php echo abs($hdfcprint_term); ?> yrs.</td>
		<td class="loan">Rs. <?php echo $hdfcviewLoanAmt; ?></td>
		<td class="info"><form action="apply_hl_consent.php" method="POST" target="_blank" >
		<input type="hidden" name="pl_requestid" value="<? echo $ProductValue; ?>" id="pl_requestid">
		<input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $Final_Bid[$i]; ?>">
		<input type="submit" style="width: 49px; height: 20px; border: 0px none ; cursor:pointer; background-image: url(http://www.deal4loans.com/new-images/apl-yelo-nw.jpg); margin-bottom: 0px; margin-top:10px; background-repeat:no-repeat; background-color:#FFFFFF;" value=""  />
		  </form></td>
		  </tr>
		  <?
		}
else
		{ ?>
<tr>
		<td class="banks"><img src="http://www.deal4loans.com/new-images/thnk-hdfc-l.jpg" width="86" height="20" /><br /> 
		<? echo $Final_Bid[$i]; ?></td>
		<td class="i-rate" colspan="4">Check this bank offer via phone</td>
		<td class="info"><form action="apply_hl_consent.php" method="POST" target="_blank" >
		<input type="hidden" name="pl_requestid" value="<? echo $ProductValue; ?>" id="pl_requestid">
		<input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $Final_Bid[$i]; ?>">
		<input type="submit" style="width: 49px; height: 20px; border: 0px none ; cursor:pointer; background-image: url(http://www.deal4loans.com/new-images/apl-yelo-nw.jpg); margin-bottom: 0px; margin-top:10px; background-repeat:no-repeat; background-color:#FFFFFF;" value=""  />
		  </form></td>
		  </tr>
		<? }
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
		<td class="banks"><img src="http://www.deal4loans.com/new-images/first-blue-logo.jpg" width="95"  /></td>
		<td class="i-rate"><?php echo $frstblinter; ?> %</td>
		<td class="emi">Rs. <?php echo  $frstblactualemi; ?></td>
		<td class="tenure"><?php echo $frstblterm; ?> yrs.</td>
		<td class="loan">Rs. <?php echo $frstblloan_amount; ?></td>
		<td class="info"><form action="apply_hl_consent.php" method="POST" target="_blank" >
		<input type="hidden" name="pl_requestid" value="<? echo $ProductValue; ?>" id="pl_requestid">
		<input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $Final_Bid[$i]; ?>">
		<input type="submit" style="width: 49px; height: 20px; border: 0px none ; cursor:pointer; background-image: url(http://www.deal4loans.com/new-images/apl-yelo-nw.jpg); margin-bottom: 0px; margin-top:10px; background-repeat:no-repeat; background-color:#FFFFFF;" value=""  />
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
		<tr><td class="banks"><? echo $bankwimg;?><br /> 
              <? echo $Final_Bid[$i]; ?></td>
               <td colspan="4" class="i-rate">Check this bank offer via phone</td>
                           
<td class="info"><form action="apply_hl_consent.php" method="POST" target="_blank" >
		<input type="hidden" name="pl_requestid" value="<? echo $ProductValue; ?>" id="pl_requestid">
		<input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $Final_Bid[$i]; ?>">
		<input type="submit" style="width: 49px; height: 20px; border: 0px none ; cursor:pointer; background-image: url(/new-images/apl-yelo-nw.jpg); margin-bottom: 0px; margin-top:10px; background-repeat:no-repeat; background-color:#FFFFFF;" value=""  />
		</form></td>
	<? }
	 } //for ends here 

?>
		    </td>
          </tr>
</table>

	<span style="float:right; font:bold 11px Arial, Helvetica, sans-serif;" ><a href="http://www.deal4loans.com/rate-disclaimer.php" target="_blank">Disclaimer</a></span>
	</div>
	</div>
</div>
          
<? }
		else
		{ ?>
		

		<? } ?>
 <table width="850" border="1" align="center" cellpadding="2" cellspacing="0" bgcolor="#e6edfd"><tr><td width="196" rowspan="2" align="center" style="border:1px #FFFFFF solid;" ><table ><tr><td height="10">&nbsp;</td></tr><tr><td style="color:#000000; font-size:18px; ">Connect With Us</td></tr></table></td><td width="208" height="30" align="center" style=" color:#000000; font-size:14px; border:1px #666666 solid; border-top:1px #FFFFFF solid;"><b>Facebook</b></td><td width="169" align="center" style="color:#000000; font-size:14px; border-bottom:1px #666666 solid; "><b>Google +</b></td><td width="117" align="center" style="color:#000000; font-size:14px; border:1px #666666 solid; border-top:1px #FFFFFF solid; border-right:1px #FFFFFF solid;"><b>Twitter</b></td></tr><tr><td height="40" style="padding-left:20px; padding-top:10px; color:#000000; border:1px #666666 solid;"><iframe src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2Fdeal4loans&amp;send=false&amp;layout=button_count&amp;width=100&amp;show_faces=false&amp;font=tahoma&amp;colorscheme=light&amp;action=like&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:100px; height:21px;" allowTransparency="true"></iframe></td><td align="center" style="padding-left:20px; color:#000000; border:1px #666666 solid;"><!-- Place this tag where you want the +1 button to render. -->
<div class="g-plusone" data-size="medium" data-href="https://plus.google.com/117667049594254872720"></div>
</td><td align="center" height="40" style="padding-left:20px; border:1px #666666 solid; border-right:1px #FFFFFF solid;"><a href="https://twitter.com/deal4loans" class="twitter-follow-button" data-show-count="false">Follow @deal4loans</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script></td></tr></table>
<!-- Place this tag where you want the +1 button to render. -->


<!-- Place this tag after the last +1 button tag. -->
<script type="text/javascript">
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>
</div>
</div>

<div style="clear:both; height:20px; width:964px; margin:auto; margin-top:10px;"></div>

<?php include "footer1.php"; ?>

</body>
</html>
