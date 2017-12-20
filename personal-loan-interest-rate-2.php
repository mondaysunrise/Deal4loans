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
<title>Personal loan Interest Rates | Compare Personal Loan Rates 2015</title>
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<meta name="keywords" content="Personal Loan Interest Rates, personal loan rates in India, Compare personal loan rates, compare personal loan "/>
<meta name="description" content="Comparison of Personal Loan Interest rates. Instant compare Personal Loan Rates from various major banks in india through deal4loans which helps you to choose the lowest rates online.">
<link href="source.css" rel="stylesheet" type="text/css" />
<link href="css/common-d4l-styles.css" type="text/css" rel="stylesheet"  />
<link href="css/home-loan-emi-calculator.css" type="text/css" rel="stylesheet"/>
<?php
if(strlen($_GET['source'])>0)
{
	echo '<link rel="canonical" href="http://www.deal4loans.com/personal-loan-interest-rate.php"/>';
}
?>
<?php include "pl-form-jscalc.php"; ?>

</head>
<body>
<?php include "middle-menu.php"; ?>
<div style="clear:both;"></div>
<?php 
$tomorrow  = mktime(0, 0, 0, date("m"), date("d"), date("Y"));
$currentdate=date('d F Y',$tomorrow);
$atag = '<img src="images/apl-yelo.gif" width="87" height="25" border="0"  />';
$atagleft = '<img src="images/apl-yelo1.gif" width="87" height="25" border="0" />';
?>
<div class="text12 breadcrum-common" style="margin-top:70px;  max-width:970px; height:11px; color:#0a8bd9;"><u><a href="http://www.deal4loans.com/" class="text12" style="color:#0080d6;">Home</a></u> &raquo; <a href="personal-loans.php"  class="text12" style="color:#0080d6;"><u>Personal Loan</u></a> <span class="text12" style="color:#4c4c4c;"> &raquo; Personal Loan Interest Rates </span></div>
<div style="clear:both; height:5px;"></div>
<div class="lac-main-wrapper">
<table width="100%">
	<tr>
    	<td width="72%" >
<h1 class="lac-head-text" style="width:100%; max-width:800px; height:33; margin-top:0px; float:left; clear:right; font-size:33px; text-transform:none; color:#88a943;"><strong>Personal Loan Interest Rates</strong><br />
<span style="font-size:12px; font-weight:normal; ">(Last updated on : <? echo $currentdate; ?>)</span></h1>
		</td>
        <td width="28%">&nbsp;</td>
   </tr>
</table>
<div style=" margin-left:5px; float:left; width:100%; max-width:970px; height:2px; margin-top:1px;"><img src="images/point5.gif" style="width:100%; max-width:970px;" height="2" /></div>
<div class="common-body-text" style="color:#4c4c4c; width:100%; max-width:950px; margin-left:8px; margin-top:10px;">
Personal loan rates in India depend on various criteria, one being the income level. Different banks have different classifications based on which interest rates are calculated. To start with whether you are working for an employer (salaried) or you are an employer yourself (self &ndash; employed). <br /><br />
RBI Cuts Repo Rates by .25% on Thursday (15 January 2015), New Repo Rates are 7.75%. Hope In coming 2 or 3 days all niche banks cuts its Personal loan interest rates by .25 percent.
</p>

<p>
<div class="common-boxinteres-rate"><b>Interest Rates of personal loans for <?php echo date("F"); ?> Month:</b><br />
&bull; ING Vysya Special Schemes at 13.50% to 18.25%<br />
&bull; HDFC Bank offers Special Rates of 13.99% to 20.00 <br />
&bull; Kotak Mahindra Offers Loans at 12.99% to 18%<br />
&bull; ICICI Bank Personal loans offered at 13.49% to 17.50%</div>
<div class="common-boxinteres-rate2"><?php include "special-offers_table.php"; ?></div>
</p>
<!--form start-->
<?php include "pl-formemicalc.php";?>
<!--form end-->
<div style="clear:both;"></div>

    <p><b>Read below how these factors effect your Interest rates</b> **<br>
  To help its customers get the best interest rates on personal loans deal4loans has consolidated all the information regarding latest rate of interests at one place. Please keep visiting this section to get updated rates of interests on personal loans.  <br /> </p>
<div class="common-div-overflow">
 <table width="100%"  border="0" cellpadding="1" cellspacing="1" bgcolor="#d5cfb1">
      <tr bgcolor="#88a943">
        <td width="13%" rowspan="2" align="center" bgcolor="#88a943" class="common-white-body-text" ><b>Banks/Rates</b></td>
        <td height="25" colspan="6" align="center" bgcolor="#88a943" class="common-white-body-text"><b>Salaried</b></td>
      </tr>
      <tr bgcolor="#88a943">
        <td width="19%" height="30" align="center" class="common-white-body-text" style="font-weight:bold; color:#FFFFFF; clear:both"><b>CAT A</b></td>
        <td width="19%" height="30" align="center" bgcolor="#88a943" class="common-white-body-text" style="font-weight:bold; color:#FFFFFF; clear:both"><b>CAT B</b></td>
        <td width="21%" align="center" class="common-white-body-text" style="font-weight:bold; color:#FFFFFF; clear:both"><b>Others</b></td>
        <td width="15%" align="center" class="common-white-body-text" style="font-weight:bold; color:#FFFFFF; clear:both"><b>Pre Payment Charges</b></td>
	    <td width="13%" align="center" class="common-white-body-text" style="font-weight:bold; color:#FFFFFF; clear:both"><b>Processing Fees</b></td>
      </tr>
     <!--------------------------------------------------------------DATABASE-------------------------------------------> 
    <?php 
	for($i=0;$i<count($bankname);$i++)
	{
	?>
    <tr bgcolor="#EFEEEE">
     <td height="25" align="left" bgcolor="#FFFFFF" class="tbl_txt">
	 <? if(strlen($plintr_url[$i])>0) { ?>
	 <a href="<? echo $plintr_url[$i]; ?>" target="_blank" ><b><? echo $bankname[$i]; ?></b></a>
	 <? } 
	 else
	{ 
	?>
	<b><? echo $bankname[$i]; ?></b>
	<? }
	?>
	 </td>
        <td height="17" align="center" bgcolor="#FFFFFF" class="tbl_txt">
<?php 
$getcata="Select plintr_min_rates,plintr_max_rates,plintr_description From personalloan_interest_rates_chart Where (plintr_category='A' and plintr_bank_name='".$bankname[$i]."' and plintr_flag=1)";
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
<td align="center" bgcolor="#FFFFFF" class="tbl_txt"><? 
$getcatb="Select plintr_min_rates,plintr_max_rates,plintr_description From personalloan_interest_rates_chart Where (plintr_category='B' and plintr_bank_name='".$bankname[$i]."' and plintr_flag=1)";
list($alreadyExist,$rowa)=MainselectfuncNew($getcatb,$array = array());
$catbdesr="";
for($ca=0;$ca<$alreadyExist;$ca++)
{
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
<td align="center" bgcolor="#FFFFFF" class="tbl_txt">
<? $getcatc="Select plintr_min_rates,plintr_max_rates,plintr_description From personalloan_interest_rates_chart Where (plintr_category='C' and plintr_bank_name='".$bankname[$i]."' and plintr_flag=1)";
list($alreadyExist1,$rowc)=MainselectfuncNew($getcatc,$array = array());
$catcdesr="";
for($catc=0;$catc<$alreadyExist1;$catc++)
{
	list($main,$gen) = split('[.]', $rowc[$catc]["plintr_min_rates"]);
	if($gen==00)	{			$minintr = $main;		}
		else		{$minintr = $rowc[$catc]["plintr_min_rates"];		}

	list($maxmain,$maxgen) = split('[.]', $rowc[$catc]["plintr_max_rates"]);
	if($maxgen==00)	{			$maxintr = $maxmain;		}
		else		{$maxintr = $rowc[$catc]["plintr_max_rates"];		}

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

	if(strlen($rowc[$catc]["plintr_description"])>2)
	{
		echo $catcdesr="<br>(".$rowc[$catc]["plintr_description"].")<br>";
	}
} 
?>
</td>
<?php 
$chargesqry= "Select plintr_procfee,plintr_prepay From personalloan_interest_rates_chart Where (plintr_flag=1 and plintr_seq=1 and	plintr_bank_name='".$bankname[$i]."')";
list($alreadyExist2,$rowcchq)=MainselectfuncNew($chargesqry,$array = array());

?>
<td align="center" bgcolor="#FFFFFF" class="tbl_txt"><? echo $rowcchq[0]["plintr_prepay"]; ?></td>
<td align="center" bgcolor="#FFFFFF" class="tbl_txt"><? echo $rowcchq[0]["plintr_procfee"]; ?>	</td>        
</tr>

<? } ?>
<tr bgcolor="#EFEEEE">
        <td height="25" align="left" bgcolor="#FFFFFF" class="common-sub-body-text"><b>Citibank</b><br /></td>
        <td height="35" colspan="3" align="center" valign="middle" bgcolor="#FFFFFF" class="common-body-text">14% - 16.50%</td><td height="35" align="center" valign="middle" bgcolor="#FFFFFF" class="common-sub-body-text">Upto 3%</td><td height="35" align="center" valign="middle" bgcolor="#FFFFFF" class="common-sub-body-text">Upto 2.5%</td>
      </tr> 
<tr bgcolor="#EFEEEE">
        <td height="25" colspan="2" align="left" bgcolor="#FFFFFF" class="common-sub-body-text"><b>Transfer your personal loan to HDFC Bank</b><br /></td>
        <td height="35" colspan="3" align="center" valign="middle" bgcolor="#FFFFFF" class="common-sub-body-text">As Low As 12.99%</td><td height="35" colspan="2" align="center" valign="middle" bgcolor="#FFFFFF" class="common-sub-body-text">
Flat Processing Fee of Rs 999/-</td>
      </tr>  <!-------------------------------------------------MANUAL----------------------------------------------->
	  
    </table>
    </div>
    <div style="clear:both;"></div>
<div class="lac-main-wrapper">
<table border="0" align="center" cellpadding="2" cellspacing="1" width="100%" >
<tr><td valign="top" style="font-size:11px;">*Terms & conditions apply</td></tr>
 <tr><td valign="top" style="width:100%; max-width:750px;">
  
	   <b>Where</b><br>
<table width="80%" border="0" cellpadding="0" cellspacing="0" style="color:#333333;">
  <tr>
    <td width="191" height="20">CAT A refers to</td>
    <td width="239">- Top 1000 companies</td>
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
<h3>Top 5 factors that effect your  Personal Loan interest rates:</h3>
<strong>1.Income:</strong> If your Income is above a certain limit, Banks believe that your chances of not paying are lesser as you have Income to pay. Most Banks have categories according to income where they give different rates.
<br />
As your monthly income goes higher the rate of interest on your personal loan will be lesser.The rates are defined for customers who have income between twenty thousand to fifty thousand and fifty thousand to seventy five thousand.If you have income above seventy five thousand you will get lower rates.
<br /><br />
<strong>2.Your Company Status:</strong> Banks define Companies in 3-4 categories.These are<br />
Cat A or Elite or Top 500 companies<br />
Cat B<br />
Cat C<br />
Others<br /><br />

Anyone working in these companies can take Personal loan from Banks.The better category of your company will mean lower rate of interest. Banks classifies these companies on the size of company and reputation.<br /><br />

Banks believe working customers with better category companies are less likely to default so they give lesser rates to Cat A companies.<br /><br />
So if your company is new and not Categorized in the Banks you are likely to get a higher rate or no loan from the Banks.<br />
So all start up company employees expect that your Personal loan will come at a higher rate or you can be refuse.<br />

<strong>3.Credit and Payment History:</strong>Banks follows Cibil scores/rating before deciding giving loans. If your payments for Credit Cards and Loans is not upto mark , you have the most likely chance of being rejected for the loan or the Bank will give you at a much higher rate.<br />
Cibil score is in the range of 0-900. Most Banks prefer customers for Personal loan with score above 750 and if your score is above 800 you can expect a .25% basis drop on your rate for the Personal loan.<br /><br />

<strong>4.Relationship with  your Bank:</strong>The Bank where you have your Salary account/Savings account is likely to pass on you to some special rate for your personal Loans or Processing fee.<br />
Banks want to retain there customers and will go all out to give lower rates for Personal loan customers who have accounts or Credit Card with them.<br /><br />
Banks have special schemes for rates of interest for Personal loan for all it customers. So when you are considering to take the lowest rate Personal loan you should always check with your bank who do you have your salaried account.<br /><br />

<strong>5.Individuals Negotiating Skills:</strong>Based on your above points you can always ask Bank to give you waivers on Rates, Fees Etc.<br /><br /><br />

Factors effecting Self Employed customer for Personal loan rates:
<ol>
<li>Annual Income tax return- If your income is high and you are a large company you can expect rates to be lower for you.</li>
<li>Type of Business- Banks are ready to give lower rates to sound business .So all Manufacturing and sound business professionals get a better rate of Interest on the personal loan.</li>
<li>Special rates to Self employed professionals- Banks really likely to fund Doctors/Engineers/Ca and Architects. Banks believe these set of customers very rarely default and hence there rates are better from others.</li>
</ol>

</p>
</td>
</tr>
</table></div>
    <b>Disclaimer:</b> Please note that the interest rates given here are based on the market research. To enable the comparisons certain set of data has been reorganized / restructured / tabulated .Users are advised to recheck the same with the individual companies / organizations. This site does not take any responsibility for any sudden / uninformed changes in interest rates.<br>
Banks/ Financial Institutions can contact us at  <a href="mailto:customercare@deal4loans.com" style="color:#0F74D4;">customercare@deal4loans.com</a> for inclusions or updates.  
<div align="right"><a href="#pg_up">Top<img width="12" height="18" border="0" alt="Top" src="images/top.gif"/></a></div>
</div>
</div>
<?php include("footer_sub_menu.php"); ?>
</body>
</html>