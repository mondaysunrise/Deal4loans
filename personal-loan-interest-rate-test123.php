<?php
//This file is not in use now.
ob_start( 'ob_gzhandler' );
require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';

# Function to get EMI according to amount #
function getEmiCalc($loanAmount,$interestRate,$term){
	
	$getloanamout = $loanAmount;
	$intr = $interestRate;
	
	$getemicalc=round($getloanamout * $intr / (1 - (pow(1/(1 + $intr), $term))));
	return($getemicalc);
}

$getbankname=ExecQuery("Select plintr_bank_name,plintr_url From personalloan_interest_rates_chart Where (plintr_flag=1) group by plintr_bank_name order by personalloan_interest_rates_chart.plintr_priorty ASC");
$bankname="";
$plintr_url="";
while($bnk=mysql_fetch_array($getbankname))
{
	$bankname[]=$bnk["plintr_bank_name"];
	$plintr_url[]=$bnk["plintr_url"];
}
$strBankName = implode(",",$bankname);
//echo "bank name string: ".$strBankName."<br/>";

# Rating Reviews
$session_id = session_id();
$page_name = $_SERVER['PHP_SELF'];

$showRatingQry = ExecQuery("select avg(rating),count(page_name) as total_review from product_rating where page_name='".$page_name."' and status=1");
$avg_rating = round(mysql_result($showRatingQry,0),1);
//$total_records = mysql_result($showRatingQry,1);
$showtotalReviewQry = ExecQuery("select id from product_rating where page_name='".$page_name."' and status=1");
$total_records = mysql_num_rows($showtotalReviewQry);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Personal loan Interest Rates | Compare Personal Loan Rates 2014</title>
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<meta name="keywords" content="Personal Loan Interest Rates, personal loan rates in India, Compare personal loan rates, "/>
<meta name="description" content="Personal Loan Interest rates: Instant quotes on Personal Loan Rates from various major banks in india through deal4loans which helps you to choose the best deal."/>
<link href="sourcenew.css" rel="stylesheet" type="text/css" />
<link href="/css/home-loan-emi-calculator.css" type="text/css" rel="stylesheet"/>

<style type="text/css">
.plntr_wrappper{ width:800px; margin:auto;}
.plntr_interest_wrappper{ width:320px; float:left;}
.plntr_scale_wrappper{ width:420px; float:left;}
.plntr_scale_wrappper_right{ width:350px; float:right; margin-top:25px;}
.table-banks_overflow{ width:100%;}

@media screen and (max-width:768px){
.plntr_wrappper{ width:100%; margin:auto;}
.plntr_interest_wrappper{ width:320px; float:none;}
.plntr_scale_wrappper{ width:320px;}
.plntr_scale_wrappper_right{width:320px; float:none; margin-top:10px;}

.table-banks_overflow{ width:350px; overflow:scroll; height: auto;}
}

</style>






<?php
if(strlen($_GET['source'])>0)
{
	echo '<link rel="canonical" href="http://www.deal4loans.com/personal-loan-interest-rate.php"/>';
}
?>
<script type="text/javascript" src="/scripts/mainmenu.js"></script>
<?php include "pl-form-jscalc.php"; ?>
<link href="source1.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="menu-style.css">

<!-- Code for Aggregate star rating -->
<link rel="stylesheet" href="jquery/jRating.jquery.css" type="text/css" />
<style type="text/css">
body {margin:15px;font-family:Arial;font-size:13px;}
a img{border:0;}
.datasSent, .serverResponse{margin-top:0px; color:#000000;height:20px;padding:5px;float:left;margin-right:5px}
.datasSent{float:left; padding:5px; font-family:Verdana, Geneva, sans-serif; font-size:13px; color:#000;}
.serverResponse{position:fixed;left:680px;top:100px}
.datasSent p, .serverResponse p {font-style:italic;font-size:12px; padding:0px 0px 0px 0px; margin:0px 0px 0px 0px; }
.exemple{float:left; margin-top:5px; width:150px; padding-left:5px; font-family:Verdana, Geneva, sans-serif; font-size:14px; color:#000;}
.clr{clear:both}
pre {margin:0;padding:0}
.notice {background-color:#F4F4F4;color:#666;border:1px solid #CECECE;padding:10px;font-weight:bold;width:600px;font-size:12px;margin-top:10px}

.review_wrapper{ width:970px; padding:5px 0px 5px 0px; background:#fff5d9;}
.review_text{ float:left; width:125px; padding-left:8px; font-family:Verdana, Geneva, sans-serif; font-size:13px; color:#000; margin-top:5px;}
.review_text-right{ float:right; margin-right:8px; padding:5px;  font-family:Verdana, Geneva, sans-serif; font-size:13px; color:#000;}
.review_star{ float:left; margin-top:5px; width:125px; padding-left:0px; font-family:Verdana, Geneva, sans-serif; font-size:14px; color:#000;}
</style>
<!--//-->



<script type="text/javascript">

function show_interest(bank_name,loan_amount){

	//alert("bank name: "+ bank_name +" - Loan Amount: "+ loan_amount);
	/*
	if (bank_name=="") {
		document.getElementById("txtHint").innerHTML="";
		return;
	}
	*/
	if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	} else { 
		// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function() {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			document.getElementById("show_interest_rate").style.display='none';
			document.getElementById("content_update").innerHTML=xmlhttp.responseText;
		}
	}
	xmlhttp.open("GET","ajax_interest_rate_perlac.php?value="+loan_amount+"&bankname="+bank_name,true);
	xmlhttp.send();
}

</script>

</head>
<body>
<div class="hide_top_menu"><?php include "top-menu.php"; ?></div>
<?php include "main-menu2.php"; ?>
<script type="text/javascript" src="script1.js"></script>
<div style="clear:both;"></div>
<? $tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"));
$currentdate=date('d F Y',$tomorrow);
$atag = '<img src="images/apl-yelo.gif" width="87" height="25" border="0"  />';	
$atagleft = '<img src="images/apl-yelo1.gif" width="87" height="25" border="0" />';
?>
<div class="text12" style="margin:auto; width:100%; max-width:970px; height:11px; margin-top:11px; color:#0a8bd9;"><u><a href="http://www.deal4loans.com/" class="text12" style="color:#0080d6;">Home</a></u> &raquo; <a href="personal-loans.php"  class="text12" style="color:#0080d6;"><u>Personal Loan</u></a> <span class="text12" style="color:#4c4c4c;"> &raquo; Personal Loan Interest Rates </span></div>
<div style="clear:both; height:5px;"></div>
<div class="intrl_txt">
<!--<table>
	<tr>
    	<td width="72%" >
<h1 class="text3" style="width:100%; max-width:800px; height:33; margin-top:0px; float:left; clear:right; font-size:33px; text-transform:none; color:#88a943;"><strong>Personal Loan Interest Rates</strong><br />
<span style="font-size:12px; font-weight:normal; ">(Last edited on : <? echo $currentdate; ?>)</span></h1>
		</td>
        <td width="28%">&nbsp;</td>
   </tr>
</table>-->

<!-- Code for Aggregate Star Rating Starts -->
<div class="pl_titile_wraper" style="width:100%;">
  	<div itemscope itemtype="http://schema.org/Product">
   	<h1 id="title_pl" itemprop="name"><strong>Personal Loan Interest Rates</strong></h1>
    <span style="font-size:12px; font-weight:normal;">(Last edited on : <?php echo $currentdate; ?>)</span>
    <div itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating" style="float:right; margin-top:5px;">
    Rated <span itemprop="ratingValue"><?php echo $avg_rating; ?></span>/5 based on <span itemprop="reviewCount"><?php echo $total_records; ?></span> reviews
    </div>
    
    <div style="clear:both;"></div>
    <div style="width:100%; border-bottom:thin solid #88a943; padding:0px 0px 0px 0px;"></div>
</div>
<div style="clear:both;"></div>

<div class="review_wrapper">
    <div class="review_text">Rate this product:</div>
    <div class="review_star">
        <div class="exemple5" data-average="<?php echo $avg_rating; ?>" data-id="<?php echo $page_name; ?>"></div>
    </div>
    <div class="datasSent">
        <p></p>
    </div>
    <div class="review_text-right"><a href="http://www.deal4loans.com/Contents_Feedback.php" rel="nofollow" target="_blank">Write review</a></div>
    <div style="clear:both;"></div>
</div>
<script type="text/javascript" src="jquery/jquery.js"></script>
<script type="text/javascript" src="jquery/jRating.jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	
	$('.exemple5').jRating({
		length:5,
		decimalLength:1,
		onSuccess : function(){
			//alert('Success : your rate has been saved :)');
		},
		onError : function(){
			//alert('Error : please retry');
		}
	});
});
</script>
</div>
<!-- Aggregate Star Rating Ends -->

<div style=" margin-left:5px; float:left; width:100%; max-width:970px; height:2px;; margin-top:1px; "><img src="images/point5.gif" style="width:100%; max-width:970px;" height="2" /></div>
 
<div class="text11" style="color:#4c4c4c; width:100%; max-width:950px; margin-left:8px; margin-top:10px;">
Personal loan rates in India depend on various criteria, one being the income level. Different banks have different classifications based on which interest rates are calculated. To start with whether you are working for an employer (salaried) or you are an employer yourself (self &ndash; employed). 
</p>

<p>
<table cellpadding="0" cellspacing="0" width="100%">
<tr>
<td width="39%" class="text11" style="color:#4c4c4c; !important">
<b>Interest Rates of personal loans for <?php echo date("F"); ?> Month:</b><br />

&bull; ING Vysya Special Schemes at 13.50% to 18.25%<br />
&bull; HDFC Bank offers Special Rates of 13.99% to 20.00 <br />

&bull; Kotak Mahindra Offers Loans at 13.60% to 18%<br />

&bull; ICICI Bank Personal loans offered at 13.49% to 17.50%
</td><td width="61%"><table align="center" border="0" style="width:100%; max-width:580px;"><tr><td align="center">    <?php include "special-offers_table.php"; ?></td></tr></table></td></tr></table>

</p>
<!--form start-->
<?php include "pl-formemicalc.php";?>
<!--form end-->
<br /><div style="clear:both;"></div>

<p><b>Read below how these factors effect your Interest rates</b> **<br>
  To help its customers get the best interest rates on personal loans deal4loans has consolidated all the information regarding latest rate of interests at one place. Please keep visiting this section to get updated rates of interests on personal loans.  <br /> </p>

<!-- Code for Range Slider Starts here -->
<!--
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
-->
<input type="hidden" id="str_bank_name" name="str_bank_name" value="<?php echo $strBankName; ?>" />
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$(function() {
		$("#slider-range-min").slider({
			range: "min",
			value: 1,
			//scale: [1, '|', 2, '|', 3, '|', 4, '|', 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15],
			min: 1,
			max: 15,
			slide: function( event, ui ) {
				$("#amount").val(ui.value + "00000");
			},
			stop: function(e){
				//alert(document.getElementById("amount").value);
				document.getElementById("show_interest_rate").style.display='none';
				$.ajax({
					type: "POST",
					url: "ajax_interest_rate_perlac.php",
					//data: "value="+value,
					data: "value=" + document.getElementById("amount").value + "&strbankname=" + document.getElementById("str_bank_name").value + "&bankname=" + document.getElementById("bank_name").value,
					cache: false,
					success: function(html){
						$("#content_update").html(html);
					}
				});
			}
		});
		$("#amount").val($("#slider-range-min").slider("value") + "00000");
	});
});	
</script>


<div class="plntr">
    <div class="plntr_interest_wrappper">
        <p>
            <label for="amount"><strong>Amount: Rs.</strong></label>
            <input type="text" id="amount" style="border:0; color:#f6931f; font-weight:bold;" readonly /><br />
            <div id="slider-range-min"></div>
        </p>
        <div class="plntr_scale_wrappper">
            <div style="margin-left:-3px; float:left; width:330px;"><img src="images/scale_bg_new.jpg" align="scale" border="0" width="329" height="40" /></div>
            <div style="float:left; width:80px; margin-top:20px; margin-left:5px;"><strong>(in lacs)</strong></div>
        </div>
    </div>
	<div class="plntr_scale_wrappper_right">
	Banks: 	<select id="bank_name" name="bank_name" onchange="show_interest(this.value,document.getElementById('amount').value)">
        		<option value="">Select Bank</option>
			<?php
            for($i=0;$i<count($bankname);$i++){
                echo "<option value=".str_replace(" ","-",$bankname[$i]).">".$bankname[$i]."</option>";
            }
            ?>    
        	</select>
    </div>
</div>



<div style="clear:both; height:10px;"></div>

<div id="content_update"></div>
<!-- Code for Range Slider Ends here -->
<div id="show_interest_rate">

<div class="table-banks_overflow">
 <table width="100%"  border="0" cellpadding="1" cellspacing="1" bgcolor="#d5cfb1">
      <tr bgcolor="#88a943">
        <td width="13%" rowspan="2" align="center" bgcolor="#88a943" class="tblwt_txt"><b>Banks/Rates</b></td>
        <td height="25" colspan="9" align="center" bgcolor="#88a943" class="tblwt_txt"><b>Salaried</b></td>
      </tr>
      <tr bgcolor="#88a943">
        <td width="19%" height="30" align="center" style="font-weight:bold; color:#FFFFFF; clear:both"><b>CAT A</b></td>
        <td width="19%" height="30" align="center" style="font-weight:bold; color:#FFFFFF; clear:both"><b>Per lac EMI</b><br />(For 4 yrs.)</td>
        <td width="19%" height="30" align="center" bgcolor="#88a943" style="font-weight:bold; color:#FFFFFF; clear:both"><b>CAT B</b></td>
        <td width="19%" height="30" align="center" style="font-weight:bold; color:#FFFFFF; clear:both"><b>Per lac EMI</b><br />(For 4 yrs.)</td>
        <td width="21%" align="center" style="font-weight:bold; color:#FFFFFF; clear:both"><b>Others</b></td>
        <td width="19%" height="30" align="center" style="font-weight:bold; color:#FFFFFF; clear:both"><b>Per lac EMI</b><br />(For others for 4 yrs.)</td>
        <td width="15%" align="center" style="font-weight:bold; color:#FFFFFF; clear:both"><b>Pre Payment Charges</b></td>
	    <td width="13%" align="center" style="font-weight:bold; color:#FFFFFF; clear:both"><b>Processing Fees</b></td>
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
$getcata=ExecQuery("Select plintr_min_rates,plintr_max_rates,plintr_description From personalloan_interest_rates_chart Where (plintr_category='A' and plintr_bank_name like '%".$bankname[$i]."%' and plintr_flag=1)");
$catadesr="";
while($rowa=mysql_fetch_array($getcata))
{
	list($main,$gen) = split('[.]', $rowa["plintr_min_rates"]);
	
	if($gen==00){
		$minintr = $main;		
	}else{
		$minintr = $rowa["plintr_min_rates"];
	}

	list($maxmain,$maxgen) = split('[.]', $rowa["plintr_max_rates"]);
	
	if($maxgen==00){
		$maxintr = $maxmain;		
	}else{
		$maxintr = $rowa["plintr_max_rates"];
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
	if(strlen($rowa["plintr_description"])>2)
	{
		echo $catadesr="<br>(".$rowa["plintr_description"].")<br>";
	}
} 
?>
</td>
<td align="center" bgcolor="#FFFFFF" class="tbl_txt">
<?php
$showEmiQry = ExecQuery("Select plintr_min_rates,plintr_max_rates,plintr_description From personalloan_interest_rates_chart Where (plintr_category='A' and plintr_bank_name='".$bankname[$i]."' and plintr_flag=1)");
while($showEmiRes=mysql_fetch_array($showEmiQry)){
	
	$interestRateMin = ($showEmiRes["plintr_min_rates"]/1200);
	$interestRateMax = ($showEmiRes["plintr_max_rates"]/1200);
	
	if($showEmiRes["plintr_min_rates"]>0 && $showEmiRes["plintr_max_rates"]>0){

		echo "Rs.".getEmiCalc(100000,$interestRateMin,48)." - Rs.".getEmiCalc(100000,$interestRateMax,48);
		echo "<br />";
		echo "(".$showEmiRes['plintr_description'].")<br />";
	}else{
	
		echo "Rs.".getEmiCalc(100000,$interestRateMin,48);
		echo "<br />";
		echo "(".$showEmiRes['plintr_description'].")<br />";
	}
} 
?>
</td>
<td align="center" bgcolor="#FFFFFF" class="tbl_txt"><? $getcatb=ExecQuery("Select plintr_min_rates,plintr_max_rates,plintr_description From personalloan_interest_rates_chart Where (plintr_category='B' and plintr_bank_name='".$bankname[$i]."' and plintr_flag=1)"); 
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
	if($minintr>1)
	{
	echo "<b>".$range_catb."</b>";
	
	}
	else
	{
 	echo "N.A";
}
	if(strlen($rowb["plintr_description"])>2)
	{
		echo $catbdesr="<br>(".$rowb["plintr_description"].")<br>";
	}

} 
?>
</td>
<td align="center" bgcolor="#FFFFFF" class="tbl_txt">
<?php
$showEmiQry = ExecQuery("Select plintr_min_rates,plintr_max_rates,plintr_description From personalloan_interest_rates_chart Where (plintr_category='B' and plintr_bank_name='".$bankname[$i]."' and plintr_flag=1)");
while($showEmiRes=mysql_fetch_array($showEmiQry)){

	$interestRateMin = ($showEmiRes["plintr_min_rates"]/1200);
	$interestRateMax = ($showEmiRes["plintr_max_rates"]/1200);
	
	if($showEmiRes["plintr_min_rates"]>0 && $showEmiRes["plintr_max_rates"]>0){

		echo "Rs.".getEmiCalc(100000,$interestRateMin,48)." - Rs.".getEmiCalc(100000,$interestRateMax,48);
		echo "<br />";
		echo "(".$showEmiRes['plintr_description'].")<br />";		
	}else{
	
		echo "Rs.".getEmiCalc(100000,$interestRateMin,48);
		echo "<br />";
		echo "(".$showEmiRes['plintr_description'].")<br />";
	}
} 
?>
</td>
<td align="center" bgcolor="#FFFFFF" class="tbl_txt">
<? $getcatc=ExecQuery("Select plintr_min_rates,plintr_max_rates,plintr_description From personalloan_interest_rates_chart Where (plintr_category='C' and plintr_bank_name='".$bankname[$i]."' and plintr_flag=1)"); 
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
	if($minintr>1)
	{
	echo "<b>".$range_catc."</b>";
	
	}
	else
	{
 echo "N.A";
}

	if(strlen($rowc["plintr_description"])>2)
	{
		echo $catcdesr="<br>(".$rowc["plintr_description"].")<br>";
	}
} 
?>
</td>
<td align="center" bgcolor="#FFFFFF" class="tbl_txt">
<?php
$showEmiQry = ExecQuery("Select plintr_min_rates,plintr_max_rates,plintr_description From personalloan_interest_rates_chart Where (plintr_category='C' and plintr_bank_name='".$bankname[$i]."' and plintr_flag=1)");
while($showEmiRes=mysql_fetch_array($showEmiQry)){

	$interestRateMin = ($showEmiRes["plintr_min_rates"]/1200);
	$interestRateMax = ($showEmiRes["plintr_max_rates"]/1200);
	
	if($showEmiRes["plintr_min_rates"]>0 && $showEmiRes["plintr_max_rates"]>0){

		echo "Rs.".getEmiCalc(100000,$interestRateMin,48)." - Rs.".getEmiCalc(100000,$interestRateMax,48);
		echo "<br />";
		echo "(".$showEmiRes['plintr_description'].")<br />";		
	}else{
	
		echo "Rs.".getEmiCalc(100000,$interestRateMin,48);
		echo "<br />";
		echo "(".$showEmiRes['plintr_description'].")<br />";
	}
} 
?>
</td>
<?php 
$chargesqry=ExecQuery("Select plintr_procfee,plintr_prepay From personalloan_interest_rates_chart Where (plintr_flag=1 and plintr_seq=1 and	plintr_bank_name='".$bankname[$i]."')");
$rowcchq=mysql_fetch_array($chargesqry);
?>
<td align="center" bgcolor="#FFFFFF" class="tbl_txt"><? echo $rowcchq["plintr_prepay"]; ?></td>
<td align="center" bgcolor="#FFFFFF" class="tbl_txt"><? echo $rowcchq["plintr_procfee"]; ?>	</td>        
</tr>

<? } ?>

<tr bgcolor="#EFEEEE">
        <td height="25" colspan="3" align="left" bgcolor="#FFFFFF" class="tbl_txt"><b>Transfer your personal loan to HDFC Bank</b><br /></td>
        <td height="35" colspan="5" align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt">As Low As 12.99%</td><td height="35" colspan="2" align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt">
Flat Processing Fee of Rs 999/-</td>
      </tr>  <!-------------------------------------------------MANUAL----------------------------------------------->
	  
    </table>
</div>
</div>
<table border="0" align="center" cellpadding="2" cellspacing="1" width="100%" >
<tr><td valign="top" style="font-size:11px;">*Terms & conditions apply</td></tr>
 <tr><td valign="top" style="width:100%; max-width:750px;">
  
	   <b>Where</b><br>
<table border="0" cellspacing="0" cellpadding="0" style="color:#333333;" width="50%">
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
<!--
<td valign="top" align="center">
<script language='JavaScript' type='text/javascript' src='http://ads.deal4loans.com/adx.js'></script>
<script language='JavaScript' type='text/javascript'>
-->
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
<!--
</script><noscript><a href='http://ads.deal4loans.com/adclick.php?n=a6c1d908' target='_blank'><img src='http://ads.deal4loans.com/adview.php?clientid=90&amp;source=intCampaign&amp;n=a6c1d908' border='0' alt=''></a></noscript>
</td>
-->
</tr>
</table>
<b>Disclaimer:</b> Please note that the interest rates given here are based on the market research. To enable the comparisons certain set of data has been reorganized / restructured / tabulated .Users are advised to recheck the same with the individual companies / organizations. This site does not take any responsibility for any sudden / uninformed changes in interest rates.<br />
Banks/ Financial Institutions can contact us at  <a href="mailto:customercare@deal4loans.com" style="color:#0F74D4;">customercare@deal4loans.com</a> for inclusions or updates.  
<div align="right"><a href="#pg_up">Top<img width="12" height="18" border="0" alt="Top" src="images/top.gif"/></a></div>
</div><?php include "responsive_footer.php"; ?></div>
<?php //include "personal_loan_footer_form.php"; ?> 
<div class="hide_top_menu">
<?php include "footer_sub.php"; ?>
</div>

</body>
</html>