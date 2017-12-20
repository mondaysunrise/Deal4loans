<?php
ob_start('ob_gzhandler');
require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';
	
$getbankname="Select plintr_bank_name,plintr_url From personalloan_interest_rates_chart Where (plintr_flag=1) group by plintr_bank_name order by personalloan_interest_rates_chart.plintr_priorty ASC";
$bankname="";
$plintr_url="";
list($recordcount,$bnk)=MainselectfuncNew($getbankname,$array = array());
for($i=0;$i<$recordcount;$i++)
{
	$bankname[]=$bnk[$i]["plintr_bank_name"];
	$plintr_url[]=$bnk[$i]["plintr_url"];
}

function getEmiCalc($loanAmount,$interestRate,$term){
	
	$getloanamout = $loanAmount;
	$intr = $interestRate;
	
	$getemicalc=round($getloanamout * $intr / (1 - (pow(1/(1 + $intr), $term))));
	return($getemicalc);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Personal loan Interest Rates | Compare Personal Loan Rates 2017</title>
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<meta name="keywords" content="Personal Loan Interest Rates, personal loan rates in India, Compare personal loan rates, compare personal loan rate, personal loan interest rate, personal loan rate, personal loan interest rate"/>
<meta name="description" content="Compare Personal loan rates of all major banks of India. Check Personal Loan Interest Rates ✓ Processing fee ✓ Per lakh EMI ✓ ROI Floating Rates ✓ lowest Fixed rates for salaried, women and self-employed/professionals from Nationalised / Government Banks / Private Banks through Deal4loans."/>
<link href="css/common-d4l-styles.css" type="text/css" rel="stylesheet"  />
<link href="css/personal-loan-styles.css" type="text/css" rel="stylesheet" />
<?php
if(strlen($_GET['source'])>0)
{
	echo '<link rel="canonical" href="http://www.deal4loans.com/personal-loan-interest-rate.php"/>';
}
?>
</head>
<body>
<?php include "middle-menu.php"; ?>

<?php 
$tomorrow  = mktime(0, 0, 0, date("m"), date("d"), date("Y"));
$currentdate=date('d F Y',$tomorrow);

?>
<div class="d4l_inner_wrapper">
   
  <div class="text12" style="margin:auto; width:100%; max-width:970px; height:11px; margin-top:70px; margin-bottom:11px; color:#0a8bd9;"><strong style="font-size:12px;"> </strong> <a href="http://www.deal4loans.com/"  class="text12" style="color:#0080d6; font-size:14px;">Home </a>» <a href="personal-loans.php" class="text12" style="color:#0080d6; font-size:14px;">Personal Loan</a><strong style="font-size:14px; font-weight:normal;" class="text12"> » </strong> <span  class="text12" style="color:#4c4c4c; font-size:14px;">Personal Loan Interest Rates </span></div>
  
<div style="clear:both; height:5px;"></div>
 <h1 class="pl-h1">Personal Loan Interest Rates</h1>
<span style="font-size:12px;">(Last updated on : <? echo $currentdate; ?>)</span>
<div style="clear:both; height:5px;"></div>
 
<div>Comparison of Personal loan interest rates. Instant compare all major government & private banks personal loan rates in India at deal4loans which helps you to choose the lowest rates online.<br /><br />
<b>Latest Trend <?php echo DATE('F'); ?> 2017</b>: Last month some banks offered special schemes for higher income salaried employees. Due to holidays in <?php echo DATE('F'); ?> 2017, most of the customers are looking for loans for travel with family so may be this month major banks comes with special schemes for travelling at lowest interest rates. Standard chartred bank currently offered personal loan at 10.99% interest rates which is the lowest in market.</div><br />
Personal loan interest rates in India depend on various criteria, among which major is the income level. Different banks have different classifications based on which interest rates are calculated. To start with whether you are working for an employer (salaried) or you are an employer yourself (self – employed).
<br /><br />
<div><?php include "special-offers_table.php"; ?></div>
<br />

<div> <?php
$source = "pl interest rate page";
$TagLine = "Get instant quotes on Interest Rates & EMI on personal loan from top 10 banks of India";
$PostURL = "/personal-loan-interest-rate.php";
$TypeLoan = "Req_Loan_Personal";
  
 include "personal-loan-widget.php"; ?></div>
<div style="clear:both;"></div>

    <p><b>Read below the factors effecting Interest Rates</b> **<br>
    To help its customers get the  best interest rates on personal loans, deal4loans has consolidated all the  information regarding latest rate of interests at one place. To get updated  rate of interest on personal loan, keep visiting this section.<br /> </p>
<div class="common-div-overflow">
 <table width="100%"  border="0" cellpadding="1" cellspacing="1" bgcolor="#d7d7d7">
      <tr bgcolor="#f0cc86">
        <td width="13%" rowspan="2" align="center" bgcolor="#eceffa"><b>Banks/Rates</b></td>
        <td height="25" colspan="9" align="center" bgcolor="#eceffa"><b>Salaried</b></td>
      </tr>
      <tr bgcolor="#88a943">
        <td width="19%" height="30" align="center" bgcolor="#eceffa"><b>CAT A</b></td>
        <td width="19%" height="30" align="center" bgcolor="#eceffa"><b>Per lac EMI</b><br />
        (For 4 yrs.)</td>
        <td width="19%" height="30" align="center" bgcolor="#eceffa"><b>CAT B</b></td>
        <td width="19%" height="30" align="center" bgcolor="#eceffa"><b>Per lac EMI</b><br />
        (For 4 yrs.)</td>
        <td width="21%" align="center" bgcolor="#eceffa"><b>Others</b></td>
        <td width="19%" height="30" align="center" bgcolor="#eceffa"><b>Per lac EMI</b><br />
        (For others for 4 yrs.)</td>
        <td width="15%" align="center" bgcolor="#eceffa"><b>Pre Payment Charges</b></td>
	    <td width="13%" align="center" bgcolor="#eceffa"><b>Processing Fees</b></td>
      </tr>
     <!--------------------------------------------------------------DATABASE-------------------------------------------> 
    <?php 
	for($i=0;$i<count($bankname);$i++)
	{
	?>
    <tr bgcolor="#EFEEEE">
     <td height="25" align="left" bgcolor="#FFFFFF" style="color:#0066CC!important; font-size:14px !important;">
	 <? if(strlen($plintr_url[$i])>0) { ?>
	 <a href="<? echo $plintr_url[$i]; ?>" target="_blank" style=" color:#0066CC!important;"><b><? echo $bankname[$i]; ?></b></a>
	 <? } 
	 else
	{ 
	?>
	<b><? echo $bankname[$i]; ?></b>
	<? }
	?>
	 </td>
        <td height="17" align="center" bgcolor="#FFFFFF" style="font-size:14px !important; padding:5px 0px 5px 0px;">
<?php 
if($bankname[$i]=="ICICI Bank")
		{
			$qryapend="order by plintr_seq ASC";
		}
$getcata="Select plintr_min_rates,plintr_max_rates,plintr_description From personalloan_interest_rates_chart Where (plintr_category='A' and plintr_bank_name='".$bankname[$i]."' and plintr_flag=1) ".$qryapend;
list($alreadyExist,$rowa)=MainselectfuncNew($getcata,$array = array());

$catadesr="";
for($ca=0;$ca<$alreadyExist;$ca++)
{
	list($main,$gen) = split('[.]', $rowa[$ca]["plintr_min_rates"]);
	
	if($gen==00){
		$minintr = $main;		
	}else{
		$minintr = $rowa[$ca]["plintr_min_rates"];
	}

	list($maxmain,$maxgen) = split('[.]', $rowa[$ca]["plintr_max_rates"]);
	
	if($maxgen==00){
		$maxintr = $maxmain;		
	}else{
		$maxintr = $rowa[$ca]["plintr_max_rates"];
	}

	if($maxmain>2)
	{
		$range_cata=$minintr."% - ".$maxintr."%";
	}
	else
	{
		$range_cata=$minintr."%";
	}
	if($minintr>1)
	{
		echo "<b>".$range_cata."</b>";
	}
	else
	{
		echo "N.A";
	}
	if(strlen($rowa[$ca]["plintr_description"])>2)
	{
		echo $catadesr="<br>(".$rowa[$ca]["plintr_description"].")<br>";
	}
} 
?>
</td>
<td align="center" bgcolor="#FFFFFF" style="font-size:14px !important; padding:5px 0px 5px 0px;">
<?php
if($bankname[$i]=="ICICI Bank")
		{
			$qryapend="order by plintr_seq ASC";
		}
$showEmiQry = "Select plintr_min_rates,plintr_max_rates,plintr_description From personalloan_interest_rates_chart Where (plintr_category='A' and plintr_bank_name='".$bankname[$i]."' and plintr_flag=1)  ".$qryapend;
list($alreadyExist,$showEmiRes)=MainselectfuncNew($showEmiQry,$array = array());
for($ca=0;$ca<$alreadyExist;$ca++){

	$interestRateMin = ($showEmiRes[$ca]["plintr_min_rates"]/1200);
	$interestRateMax = ($showEmiRes[$ca]["plintr_max_rates"]/1200);
	
	if($showEmiRes[$ca]["plintr_min_rates"]>0 && $showEmiRes[$ca]["plintr_max_rates"]>0){

		echo "Rs.".getEmiCalc(100000,$interestRateMin,48)." - Rs.".getEmiCalc(100000,$interestRateMax,48);
		echo "<br />";
		if(strlen($showEmiRes[$ca]['plintr_description'])>2)
		{
		echo "(".$showEmiRes[$ca]['plintr_description'].")<br />";
		}
	}else{
	
		echo "Rs.".getEmiCalc(100000,$interestRateMin,48);
		echo "<br />";
		if(strlen($showEmiRes[$ca]['plintr_description'])>2)
		{
		echo "(".$showEmiRes[$ca]['plintr_description'].")<br />";
		}
	}
} 
?>
</td>
<td align="center" bgcolor="#FFFFFF" style="font-size:14px !important; padding:5px 0px 5px 0px;">
<? 
if($bankname[$i]=="ICICI Bank")
		{
			$qryapend="order by plintr_seq ASC";
		}

$getcatb="Select plintr_min_rates,plintr_max_rates,plintr_description From personalloan_interest_rates_chart Where (plintr_category='B' and plintr_bank_name='".$bankname[$i]."' and plintr_flag=1) ". $qryapend; 
list($alreadyExist,$rowb)=MainselectfuncNew($getcatb,$array = array());
$catbdesr="";
for($ca=0;$ca<$alreadyExist;$ca++){

	list($main,$gen) = split('[.]', $rowb[$ca]["plintr_min_rates"]);
	if($gen==00)	{			$minintr = $main;		}
		else		{$minintr = $rowb[$ca]["plintr_min_rates"];		}

	list($maxmain,$maxgen) = split('[.]', $rowb[$ca]["plintr_max_rates"]);
	if($maxgen==00)	{			$maxintr = $maxmain;		}
		else		{$maxintr = $rowb[$ca]["plintr_max_rates"];		}

	if($maxmain>2)
	{
		$range_catb=$minintr."% - ".$maxintr."%";
	}
	else
	{
		$range_catb=$minintr."%";
	}
	if($minintr>1)
	{
	echo "<b>".$range_catb."</b>";
	
	}
	else
	{
 echo "N.A";
}
	if(strlen($rowb[$ca]["plintr_description"])>2)
	{
		echo $catbdesr="<br>(".$rowb[$ca]["plintr_description"].")<br>";
	}

} ?>
</td>
<td align="center" bgcolor="#FFFFFF" style="font-size:14px !important; padding:5px 0px 5px 0px;">
<?php
if($bankname[$i]=="ICICI Bank")
		{
			$qryapend="order by plintr_seq ASC";
		}
$showEmiQry = "Select plintr_min_rates,plintr_max_rates,plintr_description From personalloan_interest_rates_chart Where (plintr_category='B' and plintr_bank_name='".$bankname[$i]."' and plintr_flag=1) ".$qryapend;

list($alreadyExist,$showEmiRes)=MainselectfuncNew($showEmiQry,$array = array());
for($ca=0;$ca<$alreadyExist;$ca++){

	$interestRateMin = ($showEmiRes[$ca]["plintr_min_rates"]/1200);
	$interestRateMax = ($showEmiRes[$ca]["plintr_max_rates"]/1200);
	
	if($showEmiRes[$ca]["plintr_min_rates"]>0 && $showEmiRes[$ca]["plintr_max_rates"]>0){

		echo "Rs.".getEmiCalc(100000,$interestRateMin,48)." - Rs.".getEmiCalc(100000,$interestRateMax,48);
		echo "<br />";
		if(strlen($showEmiRes[$ca]['plintr_description'])>0)
		{
		echo "(".$showEmiRes[$ca]['plintr_description'].")<br />";		
		}
	}else{
	
		echo "Rs.".getEmiCalc(100000,$interestRateMin,48);
		echo "<br />";
		if(strlen($showEmiRes[$ca]['plintr_description'])>0)
		{
		echo "(".$showEmiRes[$ca]['plintr_description'].")<br />";
		}
	}
} 
?>
</td>
<td align="center" bgcolor="#FFFFFF" style="font-size:14px !important; padding:5px 0px 5px 0px;">
<? 
if($bankname[$i]=="ICICI Bank")
		{
			$qryapend="order by plintr_seq ASC";
		}

$getcatc="Select plintr_min_rates,plintr_max_rates,plintr_description,plintr_priorty From personalloan_interest_rates_chart Where (plintr_category='C' and plintr_bank_name='".$bankname[$i]."' and plintr_flag=1) ".$qryapend; 
			$catcdesr="";
list($alreadyExist,$rowc)=MainselectfuncNew($getcatc,$array = array());
for($ca=0;$ca<$alreadyExist;$ca++){

list($main,$gen) = split('[.]', $rowc[$ca]["plintr_min_rates"]);
	if($gen==00)	{			$minintr = $main;		}
		else		{$minintr = $rowc[$ca]["plintr_min_rates"];		}

	list($maxmain,$maxgen) = split('[.]', $rowc[$ca]["plintr_max_rates"]);
	if($maxgen==00)	{			$maxintr = $maxmain;		}
		else		{$maxintr = $rowc[$ca]["plintr_max_rates"];		}

	if($maxmain>2)
	{
		$range_catc=$minintr."% - ".$maxintr."%";
	}
	else
	{
		$range_catc=$minintr."%";
	}
	if($minintr>1)
	{
	echo "<b>".$range_catc."</b>";
	
	}
	else
	{
 echo "N.A";
}

	if(strlen($rowc[$ca]["plintr_description"])>2)
	{
		echo $catcdesr="<br>(".$rowc[$ca]["plintr_description"].")<br>";
	}
} 
?>
</td>
<td align="center" bgcolor="#FFFFFF" style="font-size:14px !important; padding:5px 0px 5px 0px;">
<?php
if($bankname[$i]=="ICICI Bank")
		{
			$qryapend="order by plintr_seq ASC";
		}

$showEmiQry = "Select plintr_min_rates,plintr_max_rates,plintr_description From personalloan_interest_rates_chart Where (plintr_category='C' and plintr_bank_name='".$bankname[$i]."' and plintr_flag=1) ".$qryapend;
list($alreadyExist,$showEmiRes)=MainselectfuncNew($showEmiQry,$array = array());
for($ca=0;$ca<$alreadyExist;$ca++){

	$interestRateMin = ($showEmiRes[$ca]["plintr_min_rates"]/1200);
	$interestRateMax = ($showEmiRes[$ca]["plintr_max_rates"]/1200);
	
	if($showEmi[$ca]["plintr_min_rates"]>0 && $showEmiRes[$ca]["plintr_max_rates"]>0){

		echo "Rs.".getEmiCalc(100000,$interestRateMin,48)." - Rs.".getEmiCalc(100000,$interestRateMax,48);
		echo "<br />";
		if(strlen($showEmiRes[$ca]["plintr_description"])>2)
		{
		echo "(".$showEmiRes[$ca]['plintr_description'].")<br />";		
		}
	}else{
	
		echo "Rs.".getEmiCalc(100000,$interestRateMin,48);
		echo "<br />";
	if(strlen($showEmiRes[$ca]["plintr_description"])>2)
		{
		echo "(".$showEmiRes[$ca]['plintr_description'].")<br />";
		}
	}
} 
?>
</td>
<?php 
$chargesqry = "Select plintr_procfee,plintr_prepay From personalloan_interest_rates_chart Where (plintr_flag=1 and plintr_seq=1 and	plintr_bank_name='".$bankname[$i]."')";
list($alreadyExist,$rowcchq)=MainselectfuncNew($chargesqry,$array = array());

?>
<td align="center" bgcolor="#FFFFFF" style="font-size:14px !important; padding:5px 0px 5px 0px;"><? echo $rowcchq[0]["plintr_prepay"]; ?></td>
<td align="center" bgcolor="#FFFFFF" style="font-size:14px !important; padding:5px 0px 5px 0px;"><? echo $rowcchq[0]["plintr_procfee"]; ?>	</td>        
</tr>

<? } ?> 
<tr bgcolor="#EFEEEE">
  <td height="35" colspan="10" align="left" bgcolor="#d5cfb1"><table width="100%"  border="0" cellpadding="0" cellspacing="0">
    <!--------------------------------------------------------------DATABASE------------------------------------------->
    <?php 
	for($i=0;$i<count($bankname);$i++)
	{
	?>
    <? } ?>
    <tr bgcolor="#EFEEEE">
      <td width="12%" height="25" align="left" bgcolor="#FFFFFF" style=" color:#0066CC!important; font-size:14px !important;"><b>Citibank</b><br /></td>
      <td height="35" colspan="6" align="center" valign="middle" bgcolor="#FFFFFF" style="font-size:14px !important;">11.49% - 16.50%</td>
      <td width="20%" height="35" align="center" valign="middle" bgcolor="#FFFFFF" style="font-size:14px !important;">Upto 3%</td>
      <td width="9%" height="35" align="center" valign="middle" bgcolor="#FFFFFF" style="font-size:14px !important;">Upto 2.00%</td>
    </tr>
    <!-------------------------------------------------MANUAL----------------------------------------------->
  </table></td>
</tr>
<tr bgcolor="#EFEEEE">
  <td height="35" colspan="10" align="left" bgcolor="#d5cfb1"><table width="100%" border="0" cellspacing="1" cellpadding="0">
    <tr>
      <td width="32%" colspan="3" rowspan="2" align="left" bgcolor="#FFFFFF" style=" color:#0066CC!important;"><b>Transfer your personal loan to HDFC Bank</b><br /></td>
      <td height="35" colspan="5" align="center" valign="middle" bgcolor="#FFFFFF">Salary&gt;=35,000</td>
      <td colspan="5" align="center" valign="middle" bgcolor="#FFFFFF">11.69%</td>
      <td width="9%" align="center" valign="middle" bgcolor="#FFFFFF">Rs.999</td>
     
      </tr>
    <tr>
      <td height="35" colspan="5" align="center" valign="middle" bgcolor="#FFFFFF">Salary&lt;35,000</td>
      <td colspan="5" align="center" valign="middle" bgcolor="#FFFFFF">11.99%</td>
      <td align="center" valign="middle" bgcolor="#FFFFFF">Rs.999</td>
    </tr>
  </table></td>
</tr> 
<tr bgcolor="#EFEEEE">
  <td height="35" colspan="10" align="left" bgcolor="#d5cfb1"><table width="100%" border="0" cellspacing="1" cellpadding="0">
    <tr>
      <td width="32%" colspan="3" rowspan="2" align="left" bgcolor="#FFFFFF" style=" color:#0066CC!important;"><b>
	  Transfer your personal loan to Kotak Bank<br /></td>
      <td height="35" colspan="5" align="center" valign="middle" bgcolor="#FFFFFF">Salary&gt;=35,000</td>
      <td colspan="5" align="center" valign="middle" bgcolor="#FFFFFF">11.79%</td>
      <td width="9%" align="center" valign="middle" bgcolor="#FFFFFF">0.5%</td>
     
      </tr>
    <tr>
      <td height="35" colspan="5" align="center" valign="middle" bgcolor="#FFFFFF">Salary&lt;35,000</td>
      <td colspan="5" align="center" valign="middle" bgcolor="#FFFFFF">12.99%</td>
      <td align="center" valign="middle" bgcolor="#FFFFFF">0.5%</td>
    </tr>
  </table></td>
</tr>  
 <!-------------------------------------------------MANUAL----------------------------------------------->
	  
    </table>
    </div>
    <div style="clear:both;"></div>
<div>
<table border="0" align="center" cellpadding="2" cellspacing="1" width="100%" >
<tr><td valign="top" style="font-size:11px;">*Terms & conditions apply</td></tr>
 <tr><td valign="top" style="width:100%;">
  
	   <b>Where</b><br>
<table width="80%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="20">CAT A refers to</td>
    <td>- Top 1000 companies</td>
  </tr>
  <tr>
    <td height="20">CAT B refers to</td>
    <td>- Multi National Companies( MNC's )</td>
  </tr>
  <tr>
    <td height="20">CAT C refers to</td>
    <td>- Small companies</td>
  </tr>
    <tr>
    <td height="20">Non Listed refers to</td>
    <td>- Smaller companies with 100 emloyees.</td>
  </tr>
    <tr>
    <td height="20">Loan Surrogates refers to </td>
    <td>- Any running loan from any bank</td>
  </tr>
</table>
<br />
<p>
<h3>Top 5 factors that effect your  Personal Loan Interest Rates:</h3>
<strong>1.Income:</strong>
<p><strong>:</strong> If your Income is above a certain limit, Banks believe that your  chances of paying are higher as you have a regular income. Most Banks have  categories according to income where they give different rates.<br />
As your monthly  income goes higher, the rate of interest on your personal loan will be lesser.  The rates are defined for customers who have income between Rs. 20,000 to Rs.  50,000 and Rs. 50,000 to Rs. 75,000. On the other hand, if you have income  above Rs. 75,000 you will get lower rate of interest. </p>
<br />
<strong>2.Company Status:</strong> Banks define Companies in 3-4 categories namely<br />
<li>Cat A or Elite or Top 500 companies</li>
&bull;Cat B<br />
&bull;Cat C<br />
&bull;Others<br /><br />

Anyone working in these companies can take a Personal loan from Banks. The better the category of your company, the lesser rate of interest you get. Banks classify these companies on the size of company and reputation.<br /><br />
Banks give a lesser rate of interest to CAT A company customers as they are less likely to default. So, if your company (start-ups) is new and not categorized in the Banks you are likely to get a higher rate or no loan from the banks.<br /><br />
<strong>3.Credit and Payment History:</strong> Banks follow Cibil scores/rating before giving personal loans. If your payments for Credit Cards and Loans is not up to mark, there is a chance for you of getting rejected by the bank or getting a higher rate of interest. Cibil score for a personal loan is in the range of 0-900 and most banks prefer customers with the score above 750. Also, if your Cibil score is more than 800, you can get 0.25% basis drop on your personal loan rate of interest<br />
<strong>4.Relationship with  your Bank:</strong>The bank where you have your  Saving account/Salary account is most likely to give you some special rate of  interest or processing fees on personal loans. Banks make sure that their  personal loan and credit card customers get better options as compared to other  banks. So, before applying to other banks for a personal loan, check your own  bank rate of interests<br />
<strong>5.Individuals Negotiation Skills:</strong>Keeping in mind the above  information, you can always negotiate and ask Banks for special waivers on  Interest Rates, Processing Fees, etc.<br /><br /><br />

Factors effecting Self Employed customer for Personal loan Interst Rates:
<ol>
<li>Annual Income Tax Return- If your income is high and you are a large company you can expect rates to be lower for you.</li>
<li>Type of Business- Banks are ready to give lower rates to sound business .So all Manufacturing and sound business professionals get a better rate of Interest on the personal loan.</li>
<li>Special rates to Self employed professionals- Banks really like to fund Doctors/Engineers/CA and Architects as they believe these set of  customers are rarely  default and hence there rates are better from others.</li>
</ol>

</p>
</td>
</tr>
</table></div>
    <b>Disclaimer:</b> Please note that the interest rates given here are based on the market research. To enable the comparisons certain set of data has been reorganized / restructured / tabulated .Users are advised to recheck the same with the individual companies / organizations. This site does not take any responsibility for any sudden / uninformed changes in interest rates.<br>
Banks/ Financial Institutions can contact us at  <a href="mailto:customercare@deal4loans.com" style="color:#0F74D4;">customercare@deal4loans.com</a> for inclusions or updates.  
<div align="right"><a href="#">Top<img width="12" height="18" border="0" alt="Top" src="images/top.gif"/></a></div>
</div>
</div>
<?php include("footer_sub_menu.php"); ?>
</body>
</html>