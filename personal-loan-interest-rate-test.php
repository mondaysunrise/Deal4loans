<?php
	ob_start( 'ob_gzhandler' );
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	
$getbankname=ExecQuery("Select plintr_bank_name From personalloan_interest_rates_chart Where (plintr_flag=1)  group by plintr_bank_name order by plintr_priorty ASC");
$bankname="";
while($bnk=mysql_fetch_array($getbankname))
{
	$bankname[]=$bnk["plintr_bank_name"];
}
//print_r($bankname);

	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
 <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Personal loan Interest Rates | Personal Loan Rates | Deal4loans</title>
<meta name="keywords" content="Personal Loan Interest Rates, Personal Loans Interest Rates, Best Interest Rates, personal loans, personal loan, personal loan rates in India, Compare personal loan rates, personal loans at least interest rate">
<meta name="description" content="Personal Loan Interest rates: Instant quotes of Personal Loan Rates. Compare personal loans interest rate of Sbi, ICICI, HDFC, Citibank, Abn Amro Bank, Axis Bank, Bank of Baroda, Barclays Finance, Canara Bank, Citibank, Citifinancial, Corporation Bank, Reliance finance">
<link href="sourcenew.css" rel="stylesheet" type="text/css" />
<?php
if(strlen($_GET['source'])>0)
{
echo '<link rel="canonical" href="http://www.deal4loans.com/personal-loan-interest-rate.php"/>';

}

?>
<script type="text/javascript" src="/scripts/mainmenu.js"></script>
<style type="text/css">
.pltbl_text{ font-family:Verdana, Geneva, sans-serif; font-size:22px; color:#093058;}
.pltbl_text2{ font-family:Verdana, Geneva, sans-serif; font-size:14px; color: #FFF;}

.pltbl_text3{ font-family:Verdana, Geneva, sans-serif; font-size:12px; color: #FFF; }
.pltbl_text4{ font-family:Verdana, Geneva, sans-serif; font-size:10px; color: #093058; padding-top:5px; padding-bottom:5px;}
.icici_text{ font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#972a27;}
</style>
</head>
<body>
<!--top-->
<?php include "top-menu.php"; ?>
<!--top-->
<!--logo navigation-->
<?php include "main-menunew.php"; ?>
<!--logo navigation-->
<? $tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"));
$currentdate=date('d F Y',$tomorrow);
$atag = '<img src="images/apl-yelo.gif" width="87" height="25" border="0"  />';	
$atagleft = '<img src="images/apl-yelo1.gif" width="87" height="25" border="0" />';
?>
<div class="text12" style="margin:auto; width:970px; height:11px; margin-top:11px; color:#0a8bd9;"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> > <a href="personal-loans.php"  class="text12" style="color:#0080d6;"><u>Personal Loan</u></a> <span class="text12" style="color:#4c4c4c;">> Personal Loan Interest Rates </span></div>
<div style="clear:both; height:5px;"></div>
<div class="intrl_txt">
<table ><tr><td width="72%" >
<h1 class="text3" style="width:500px; height:33; margin-top:0px; float:left; clear:right; font-size:36px; text-transform:none; color:#88a943;"><strong>Personal Loan Interest Rates</strong><br />
<span style="font-size:12px; font-weight:normal; ">(Last edited on : <? echo $currentdate; ?>)</span></h1></td><td width="28%">&nbsp;</td>
   </tr></table>
<div style=" margin-left:5px; float:left; width:970px; height:2px;; margin-top:1px; "><img src="images/point5.gif" width="970" height="2" /></div>
 
<div class="text11" style="color:#4c4c4c; width:950px; margin-left:8px; margin-top:10px;">
Personal loan rates in India depend on various criteria, one being the income level. Different banks have different classifications based on which interest rates are calculated. To start with whether you are working for an employer (salaried) or you are an employer yourself (self &ndash; employed). The factors which determine your <a href="http://deal4loans.com/personal-loans.php">Personal Loan</a> interest rates are as follows: -<br>
<table cellpadding="0" cellspacing="0" width="100%">
<tr>
<td width="38%" class="text11" style="color:#4c4c4c; !important">
&bull; Income<br>
&bull; Your Company Status<br>
&bull; Credit and Payment history.<br>
&bull; Relationship with the Bank you intend to take loan from.<br>
&bull; Individual&rsquo;s Negotiating Ability.
</td><td width="62%"><table align="center" border="0" width="580"><tr><td align="center"><table width="100%" cellpadding="2" cellspacing="0" bgcolor="#EDF8FC" style="border:1px solid #ADE4F8;"><tr><td width="22%" rowspan="2" style="color:#FF6600; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px;" align="right"><b>Festive Offer :</b></td><td width="78%" align="center" style="color:#4E4D4D; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px;"><b>Get gifts upto Rs 13,500 on disbursal.</b></td></tr><tr><td align="center" style="color:#4E4D4D; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px;">Refer to T & C - www.deal4loans.com/personal-loan-offers.php 
</td></tr></table></td></tr></table></td></tr></table>
</p>
<p>
<b>Interest Rates of personal loans Changed Every Month, Some Bank Offers Special Interest Rate Schemes for festive seasons :</b><br />

&bull; ING Vysya Special Schemes at 14.50 % to 18.25 %<br />

&bull; Nil Foreclosure charges on ING Vysya Valid till 31st March�13<br />

&bull; HDFC Bank offers Special Rates of 13.99 % to 18.25 %<br />

&bull; Kotak Mahindra Offers Loans at 15.00 % to 19.00 %<br />

&bull; ICICI Bank Personal loans offered at 14.00 % to 18.00 %

</p>
    <p><b>Read below how these factors effect your Interest rates</b> **<br>
  To help its customers get the best interest rates on personal loans <a href="http://www.deal4loans.com/">deal4loans</a> has consolidated all the information regarding latest rate of interests at one place. Please keep visiting this section to get updated rates of interests on personal loans.  <br /> <span style="color:#FF0000;">* Never pay any fee/cash upfront to any person to get loan sanctioned. Processing fee are deducted from Loan amount.</span></p>

 <table width="967" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="74" height="78" rowspan="2" align="center" bgcolor="#88a943" class="pltbl_text2">Banks/<br />
    Rates</td>
    <td width="898" height="38" align="center" class="pltbl_text">Salaried</td>
  </tr>
  <tr>
    <td height="40" bgcolor="#FFFFFF"><table width="885" border="0" cellpadding="00" cellspacing="0">
      <tr>
        <td width="120" height="40" align="center" bgcolor="#88A943" class="pltbl_text3" style="border-right:thin solid #ffffff;">CAT A</td>
        <td width="110" align="center" bgcolor="#88A943" class="pltbl_text3" style="border-right:thin solid #ffffff;">EMI <br />
          Per lac *</td>
        <td width="147" align="center" bgcolor="#88A943" class="pltbl_text3" style="border-right:thin solid #ffffff;">CAT B</td>
        <td width="82" align="center" bgcolor="#88A943" class="pltbl_text3" style="border-right:thin solid #ffffff;">EMI<br />
          Per lac *</td>
        <td width="150" align="center" bgcolor="#88A943" class="pltbl_text3" style="border-right:thin solid #ffffff;">Others</td>
        <td width="81" align="center" bgcolor="#88A943" style="border-right:thin solid #ffffff;"><span class="pltbl_text2">EMI<br />
Per lac *</span></td>
        <td width="67" align="center" bgcolor="#88A943" class="pltbl_text3" style="font-size:10px; border-right:thin solid #FFF;" >Pre Payment <br />
          Charges</td>
        <td width="79" align="center" bgcolor="#88A943" class="pltbl_text3" style="font-size:11px; border-right: #FFF solid thin;">Processing<br />
Fees</td>
        <td width="49" align="center" bgcolor="#88A943" class="pltbl_text3">Apply</td>
      </tr>
    </table></td>
  </tr>
<? for($i=0;$i<count($bankname);$i++)
{
	?>
 <tr>
    <td colspan="2" valign="top" bgcolor="#FFFFFF">
    <div style="margin-top:-5px; margin-left:-3px;">
    <table width="963" border="0" cellpadding="0" cellspacing="3">
      <tr>
<td width="74" height="40" align="center" bgcolor="#FFFFFF" class="icici_text" style="border:#88a943 thin solid;"><? echo $bankname[$i]; ?></td>
<td width="222" align="center" class="pltbl_text4" style="border:#88a943 thin solid;"><table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td align="center"><? $getcata=ExecQuery("Select plintr_min_rates,plintr_max_rates,plintr_description From personalloan_interest_rates_chart Where (plintr_category='A' and plintr_bank_name='".$bankname[$i]."' and plintr_flag=1)");
			$catadesr="";
while($rowa=mysql_fetch_array($getcata))
{
	list($main,$gen) = split('[.]', $rowa["plintr_min_rates"]);
	if($gen==00)	{			$minintr = $main;		}
		else		{$minintr = $rowa["plintr_min_rates"];		}

	list($maxmain,$maxgen) = split('[.]', $rowa["plintr_max_rates"]);
	if($maxgen==00)	{			$maxintr = $maxmain;		}
		else		{$maxintr = $rowa["plintr_max_rates"];		}

	if($maxmain>2)
	{
		$range_cata=$minintr."% - ".$maxintr."%";
	}
	else
	{
		$range_cata=$minintr."%";
	}
	echo $range_cata;
	if(strlen($rowa["plintr_description"])>2)
	{
		echo $catadesr="<br>(".$rowa["plintr_description"].")<br>";
	}


} ?>
</td>
  <td width="1%" align="center" style="border-right:thin solid #e7eed9;">&nbsp;</td>
 <td align="center"><? $getcataperlac=ExecQuery("Select plintr_min_rates,plintr_max_rates,plintr_description From personalloan_interest_rates_chart Where (plintr_category='A' and plintr_bank_name='".$bankname[$i]."' and plintr_flag=1)"); 
$catadesrperlac="";
while($rowprlac_a=mysql_fetch_array($getcataperlac))
{
	list($main,$gen) = split('[.]', $rowprlac_a["plintr_min_rates"]);
	if($gen==00)	{			$minintr = $main;		}
		else		{$minintr = $rowprlac_a["plintr_min_rates"];		}

	list($maxmain,$maxgen) = split('[.]', $rowprlac_a["plintr_max_rates"]);
	if($maxgen==00)	{			$maxintr = $maxmain;		}
		else		{$maxintr = $rowprlac_a["plintr_max_rates"];		}

	if($maxmain>2)
	{
		$minintrclc=$minintr/1200;
		$maxintrclc=$maxintr/1200;
		$minemicalc=round(100000 * $minintrclc / (1 - (pow(1/(1 + $minintrclc), 48))));
		$maxemicalc=round(100000 * $maxintrclc / (1 - (pow(1/(1 + $maxintrclc), 48))));
		$range_perlac = "Rs.".$minemicalc." - Rs.".$maxemicalc ;
	}
	else
	{
		$minintrclc=$minintr/1200;
		$minemicalc=round(100000 * $minintrclc / (1 - (pow(1/(1 + $minintrclc), 48))));
		$range_perlac = "Rs.".$minemicalc;
	}
	echo $range_perlac;
	if(strlen($rowprlac_a["plintr_description"])>2)
	{
		echo $catadesrperlac="<br>(".$rowprlac_a["plintr_description"].")<br>";
	}

} 
?> </tr>
          
        </table></td>
<td width="228" align="center" class="pltbl_text4" style="border:#88a943 thin solid;"><table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="61%" align="center">
<? $getcatb=ExecQuery("Select plintr_min_rates,plintr_max_rates,plintr_description From personalloan_interest_rates_chart Where (plintr_category='B' and plintr_bank_name='".$bankname[$i]."' and plintr_flag=1)"); 
$catbdesr="";
while($rowb=mysql_fetch_array($getcatb))
{
	list($main,$gen) = split('[.]', $rowb["plintr_min_rates"]);
	if($gen==00)	{			$minintr = $main;		}
		else		{$minintr = $rowb["plintr_min_rates"];		}

	list($maxmain,$maxgen) = split('[.]', $rowb["plintr_max_rates"]);
	if($maxgen==00)	{			$maxintr = $maxmain;		}
		else		{$maxintr = $rowb["plintr_max_rates"];		}

	if($maxmain>2)
	{
		$range_catb=$minintr."% - ".$maxintr."%";
	}
	else
	{
		$range_catb=$minintr."%";
	}
echo $range_catb;
	if(strlen($rowb["plintr_description"])>2)
	{
		echo $catbdesr="<br>(".$rowb["plintr_description"].")<br>";
	}

} ?>
</td>
<td width="2%" align="center" style="border-right:thin solid #e7eed9;">&nbsp;</td>
<td width="37%" align="center">
<? $getcatb=ExecQuery("Select plintr_min_rates,plintr_max_rates,plintr_description From personalloan_interest_rates_chart Where (plintr_category='B' and plintr_bank_name='".$bankname[$i]."' and plintr_flag=1)"); 
$catbdesrperlac="";
while($rowb=mysql_fetch_array($getcatb))
{
	list($main,$gen) = split('[.]', $rowb["plintr_min_rates"]);
	if($gen==00)	{			$minintr = $main;		}
		else		{$minintr = $rowb["plintr_min_rates"];		}

	list($maxmain,$maxgen) = split('[.]', $rowb["plintr_max_rates"]);
	if($maxgen==00)	{			$maxintr = $maxmain;		}
		else		{$maxintr = $rowb["plintr_max_rates"];		}

	if($maxmain>2)
	{
		$minintrclc=$minintr/1200;
		$maxintrclc=$maxintr/1200;
		$minemicalc=round(100000 * $minintrclc / (1 - (pow(1/(1 + $minintrclc), 48))));
		$maxemicalc=round(100000 * $maxintrclc / (1 - (pow(1/(1 + $maxintrclc), 48))));
		$range_perlac = "Rs.".$minemicalc." - Rs.".$maxemicalc ;
	}
	else
	{
		$minintrclc=$minintr/1200;
		$minemicalc=round(100000 * $minintrclc / (1 - (pow(1/(1 + $minintrclc), 48))));
		$range_perlac = "Rs.".$minemicalc;
	}

	if(strlen($rowb["plintr_description"])>2)
	{
		$catbdesrperlac="<br>(".$rowb["plintr_description"].")<br>";
	}
echo $range_perlac."".$catbdesrperlac;
} ?>
</td>
</tr>
          
        </table></td>
<td width="230" align="center" bgcolor="#FFFFFF" class="pltbl_text4" style="border:#88a943 thin solid;"><table width="100%" height="61" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="64%" align="center" bgcolor="#FFFFFF"><? $getcatc=ExecQuery("Select plintr_min_rates,plintr_max_rates,plintr_description From personalloan_interest_rates_chart Where (plintr_category='C' and plintr_bank_name='".$bankname[$i]."' and plintr_flag=1)"); 
			$catcdesr="";
while($rowc=mysql_fetch_array($getcatc))
{
	list($main,$gen) = split('[.]', $rowc["plintr_min_rates"]);
	if($gen==00)	{			$minintr = $main;		}
		else		{$minintr = $rowc["plintr_min_rates"];		}

	list($maxmain,$maxgen) = split('[.]', $rowc["plintr_max_rates"]);
	if($maxgen==00)	{			$maxintr = $maxmain;		}
		else		{$maxintr = $rowc["plintr_max_rates"];		}

	if($maxmain>2)
	{
		$range_catc=$minintr."% - ".$maxintr."%";
	}
	else
	{
		$range_catc=$minintr."%";
	}
echo $range_catc;
	if(strlen($rowc["plintr_description"])>2)
	{
		echo $catcdesr="<br>(".$rowc["plintr_description"].")<br>";
	}

} ?></td>
<td width="2%" align="center" bgcolor="#FFFFFF" style="border-right:thin solid #e7eed9;">&nbsp;</td>
<td width="34%" align="center" bgcolor="#FFFFFF"><? $getcatcprl=ExecQuery("Select plintr_min_rates,plintr_max_rates,plintr_description From personalloan_interest_rates_chart Where (plintr_category='C' and plintr_bank_name='".$bankname[$i]."' and plintr_flag=1)"); 
$catcdesrperlac="";
while($rowcprl=mysql_fetch_array($getcatcprl))
{
	list($main,$gen) = split('[.]', $rowcprl["plintr_min_rates"]);
	if($gen==00)	{			$minintr = $main;		}
		else		{$minintr = $rowcprl["plintr_min_rates"];		}

	list($maxmain,$maxgen) = split('[.]', $rowcprl["plintr_max_rates"]);
	if($maxgen==00)	{			$maxintr = $maxmain;		}
		else		{$maxintr = $rowcprl["plintr_max_rates"];		}

	if($maxmain>2)
	{
		$minintrclc=$minintr/1200;
		$maxintrclc=$maxintr/1200;
		$minemicalc=round(100000 * $minintrclc / (1 - (pow(1/(1 + $minintrclc), 48))));
		$maxemicalc=round(100000 * $maxintrclc / (1 - (pow(1/(1 + $maxintrclc), 48))));
		$range_perlac_c = "Rs.".$minemicalc." - Rs.".$maxemicalc ;
	}
	else
	{
		$minintrclc=$minintr/1200;
		$minemicalc=round(100000 * $minintrclc / (1 - (pow(1/(1 + $minintrclc), 48))));
		$range_perlac_c = "Rs.".$minemicalc;
	}

	if(strlen($rowcprl["plintr_description"])>2)
	{
		$catcdesrperlac="<br>(".$rowcprl["plintr_description"].")<br>";
	}
echo $range_perlac_c."".$catcdesrperlac;
} ?></td>
 </tr>
          
        </table></td>
		<? $chargesqry=ExecQuery("Select plintr_procfee,plintr_prepay,plintr_url From personalloan_interest_rates_chart Where (plintr_flag=1 and plintr_seq=1 and	plintr_bank_name='".$bankname[$i]."')");
		$rowcchq=mysql_fetch_array($chargesqry);
		?>
 <td width="65" align="center" class="pltbl_text4" style="border:#88a943 thin solid;"><? echo $rowcchq["plintr_prepay"]; ?></td>
        <td width="74" align="center" class="pltbl_text4" style="border:#88a943 thin solid;"><? echo $rowcchq["plintr_procfee"]; ?>	</td>
        <td width="45" align="center" style="border:#88a943 thin solid;">
		<? if(strlen($rowcchq["plintr_url"])>2) { ?><a href="<? echo $rowcchq["plintr_url"]; ?>" target="_blank" ><img src="/images/apply-btn_pl.jpg" width="35" height="16" /></a> <? } ?></td>

  </tr>
    </table>
    </div>
    </td>
  </tr>
  
<? } ?>
    <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
</table>
* Per lac EMI calculated on 4 yrs of Tenure.
<table border="0" align="center" cellpadding="2" cellspacing="1" width="950" >
 <tr><td valign="top" width="780">
  
	   <b>Where</b><br>
<table border="0" cellspacing="0" cellpadding="0" style="color:#333333;">
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

<br>
<b>Income :</b> If your Income is above a certain limit, Banks believe that your chances of not paying are lesser as you have Income to pay. Income above 75 per month usually gets some discounts from all <a href="http://www.deal4loans.com/personal-loan-banks.php">personal loan Banks</a>.<br>
    <b>Your Company Status :</b> If the company you are working with is a well known corporate, the Banks feel that you are less likely to shift from your job and will result in lesser defaults.<br>
    <b>Credit and Payment History :</b> Banks follows Cibil scores/rating before deciding giving loans. If your payments for <a href="http://www.deal4loans.com/credit-cards.php">Credit Cards</a> and Loans is not upto mark , you have the most likely chance of being rejected for the loan or the Bank will give you at a much higher rate.<br>
    <b>Relationship with Bank :</b> The Bank where you have your Salary account/Savings account is likely to pass on you to some special rate for your <a href="http://www.deal4loans.com/personal-loans.php">personal Loans</a> or Processing fee.<br>
    <b>Individuals Negotiating Skills :</b> Based on your above points you can always ask Bank to give you waivers on Rates, Fees Etc.<br />
    
	<div style="height:25px; padding-top:10px;">Before apply for personal loan, Calculate your personal loan emi with <a href="/Contents_Calculators.php">EMI Calculator</a></div>
	
    
        </td><td valign="top" align="center">
<script language='JavaScript' type='text/javascript' src='http://ads.deal4loans.com/adx.js'></script>
<script language='JavaScript' type='text/javascript'>
<!--
   if (!document.phpAds_used) document.phpAds_used = ',';
   phpAds_random = new String (Math.random()); phpAds_random = phpAds_random.substring(2,11);
   
   document.write ("<" + "script language='JavaScript' type='text/javascript' src='");
   document.write ("http://ads.deal4loans.com/adjs.php?n=" + phpAds_random);
   document.write ("&amp;clientid=90&amp;source=intCampaign&amp;target=_blank");
   document.write ("&amp;exclude=" + document.phpAds_used);
   if (document.referrer)
      document.write ("&amp;referer=" + escape(document.referrer));
   document.write ("'><" + "/script>");
//-->
</script><noscript><a href='http://ads.deal4loans.com/adclick.php?n=a6c1d908' target='_blank'><img src='http://ads.deal4loans.com/adview.php?clientid=90&amp;source=intCampaign&amp;n=a6c1d908' border='0' alt=''></a></noscript>
</td></tr></table>
    <b>Disclaimer:</b> Please note that the interest rates given here are based on the market research. To enable the comparisons certain set of data has been reorganized / restructured / tabulated .Users are advised to recheck the same with the individual companies / organizations. This site does not take any responsibility for any sudden / uninformed changes in interest rates.<br>
Banks/ Financial Institutions can contact us at  <a href="mailto:customercare@deal4loans.com" style="color:#0F74D4;">customercare@deal4loans.com</a> for inclusions or updates.  
<div align="right"><a href="#pg_up">Top<img width="12" height="18" border="0" alt="Top" src="images/top.gif"/></a></div>
</div></div>
<?php //include "personal_loan_footer_form.php"; ?> 
<?php include "footer_pl.php"; ?>

</body>
</html>
