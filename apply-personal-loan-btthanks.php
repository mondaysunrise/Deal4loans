<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	require 'getlistofeligiblebidders.php';
	require 'scripts/personal_loan_bt_eligibility.php';
	require 'show_quotecount.php';	

$leadid = $_SESSION['Temp_LID'];
//$leadid =10000;
$getpldetails="select Name,Employment_Status,City,City_Other,Existing_Loan,Existing_ROI,Net_Salary,source,Existing_Bank  From Req_Loan_Personal Where (RequestID='".$leadid."')";

list($CheckNumRows,$plrow)=MainselectfuncNew($getpldetails,$array = array());
$countr=count($plrow)-1;

$getCompany_Name = $plrow[$countr]['Company_Name'];
$OutstandingLoan = $plrow[$countr]['Existing_Loan'];
$City = $plrow[$countr]['City'];
$Other_City = $plrow[$countr]['City_Other'];
$full_name = $plrow[$countr]['Name'];
$Employment_Status = $plrow[$countr]['Employment_Status'];
$Existing_Rate = $plrow[$countr]['Existing_ROI'];
$NetIncome = $plrow[$countr]['Net_Salary']/12;
$source = $plrow[$countr]['source'];
$Existing_Bank = $plrow[$countr]['Existing_Bank'];
$hdfcsource="EML_HDFC_PLBT";
$str1= strrev($source);
$str2= strrev($hdfcsource);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>  
<title>Thank you</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
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
 <script type="text/javascript" src="scripts/mainmenu.js"></script>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
</head>
<body>
<?php include "top-menu.php"; ?>
<!--top-->
<!--logo navigation-->
<?php include "main-menu.php"; ?>
<!--logo navigation-->
<div class="text12" style="margin:auto; width:970px; height:11px; margin-top:11px; color:#0a8bd9;"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> > <a href="#"  class="text12" style="color:#0080d6;"><u>Personal Loan</u></a> <span class="text12" style="color:#4c4c4c;">> Apply for Personal Loan</span></div>
<div style="clear:both; height:15px;"></div>
<div class="text12" style="margin:auto; width:970px;">
<div id="bodyCenter" align="center">
   <div id="nwcontainer" align="center" style="color:#000000;">
  <p><strong>Dear <? echo $full_name; ?>, You are <? echo $total_homeloan_taken; ?> th customer , who have taken quote @deal4loans.com</strong></p>
<?php 
if($leadid>0)
 {$getcompany='select hdfc_bank,kotak,icici_bank from pl_company_list where company_name="'.$getCompany_Name.'"';
 list($recordcount,$grow)=Mainselectfunc($getcompany,$array = array());
$hdfccategory= $grow["hdfc_bank"];
$kotakcategory= $grow["kotak"];
$icici_bankcategory = $grow["icici_bank"]; 
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

	list($realbankiD,$bankID,$FinalBidder,$finalBidderName)= getBiddersList("Req_Loan_Personal",$leadid,$strCity);
	$Final_Bid = "";
			while (list ($key,$val) = @each($bankID)) { 
				$Final_Bid[]= $val; 
			} 

	$FinalBidder=implode(',',$FinalBidder);
	$realbankiD=implode(',',$realbankiD);
	if(count($FinalBidder)>0)
	 { ?>
	<div align="left">
<span style=" color:#000000; padding-left:4px;line-height:16px;">You are eligible for the below mentioned Banks, They will service you within 24hrs.<br />We at deal4loans.com believe that its big financial decision that you
are about to take.<br />
To get best deal, speak to 3 - 4 banks mentioned below and then decide
upon the best deal.<br />
This will help you get best deal & save on Emi & choose best product &
best service.</span></div>
<div id="data" align="center">
<table width="800" border="0" style="border-radius:20px 25px;" >
 <tr>
    <td bgcolor="#FFFFFF"><table width="800" border="0"  cellpadding="0" cellspacing="1" style="border-radius:25px 25px;">
      <tr>
        <td width="232" height="35" align="center" bgcolor="#93D1E6" class="quote-bank_text">Bank</td>
        <td width="300" align="center" bgcolor="#CDEBF3"><span class="quote-bank_text">Interest Rate</span></td>
        <td width="268" align="center" bgcolor="#E7F5FA" class="quote-bank_text">Processing  Fees</td>
      </tr>
	  <?php
	for($r=0;$r<count($Final_Bid);$r++)
	{ 
		if($Final_Bid[$r]=="HDFC")
		{
		 list($BTRate,$BTProcessingFee)=hdfcbt_plbt($OutstandingLoan,$Existing_Bank);
		if($BTRate>0)
			{
		?>
	 <tr>
        <td height="82" align="center" bgcolor="#F9F9F9" class="quote-bank_text"><img src="http://www.deal4loans.com/new-images/thnk-hdfc.jpg" /></td>
        <td align="center" bgcolor="#F9F9F9"><span class="quote-bank_text"><?php echo $BTRate; ?></span></td>
        <td align="center" bgcolor="#F9F9F9" class="quote-bank_text"><?php echo $BTProcessingFee; ?></td>
      </tr>
	  <?php 
		}
		}
		if((strncmp ($str1, $str2, 13)!=0))
		{
			if($Final_Bid[$r]=="ICICI Bank")
			{
			 list($iciciBTRate,$iciciBTProcessingFee)=icicibt_pl($OutstandingLoan,$Employment_Status,$Existing_Rate);
			if($iciciBTRate>0)
				{
			?>
		 <tr>
			<td height="82" align="center" bgcolor="#F9F9F9" class="quote-bank_text"><img src="http://www.deal4loans.com/new-images/icici_bkpl.jpg" /></td>
			<td align="center" bgcolor="#F9F9F9"><span class="quote-bank_text"><?php echo $iciciBTRate; ?></span></td>
			<td align="center" bgcolor="#F9F9F9" class="quote-bank_text"><?php echo $iciciBTProcessingFee; ?></td>
		  </tr>
		  <?php 
			}
			}
			if($Final_Bid[$r]=="Kotak Bank")
			{
			 list($kotakBTRate,$kotakBTProcessingFee)=kotakbt_pl($OutstandingLoan,$kotakcategory,$Existing_Rate,$NetIncome);
			if($kotakBTRate>0)
				{
			?>
		 <tr>
			<td height="82" align="center" bgcolor="#F9F9F9" class="quote-bank_text"><img src="http://www.deal4loans.com/new-images/thnk-ktk.gif" /></td>
			<td align="center" bgcolor="#F9F9F9"><span class="quote-bank_text"><?php echo $kotakBTRate; ?></span></td>
			<td align="center" bgcolor="#F9F9F9" class="quote-bank_text"><?php echo $kotakBTProcessingFee; ?></td>
		  </tr>
		  <?php 
			}
			}
		}

		} ?>
		<tr>
            <td colspan="3" align="right" style="font:bold 11px Arial, Helvetica, sans-serif; height:20px;"><a href="http://www.deal4loans.com/rate-disclaimer.php" target="_blank" >Disclaimer</a></td></tr>
        </table></td>
  </tr>
</table>
</div>
	<?php //for 
	 }
	 else
	 {?>
	 <p><strong> We will contact you, if we find any offer for you.</strong></p>
	 <?php } //We are not able to find any bank for you.Please contact your local bank.
}//if ?>
<table width="850" border="1" align="center" cellpadding="1" cellspacing="0" bgcolor="#e6edfd"><tr><td width="196" rowspan="2" align="center" style="color:#000000; font-size:18px; border:1px #FFFFFF solid;">Connect With Us</td><td width="208" height="30" align="center" style=" color:#000000; font-size:14px;"><b>Facebook</b></td><td width="169" align="center" style="color:#000000; font-size:14px;"><b>Google +</b></td><td width="117" align="center" style="color:#000000; font-size:14px;"><b>Twitter</b></td></tr><tr><td height="40" style="padding-left:20px; color:#000000;"><iframe src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2Fdeal4loans&amp;send=false&amp;layout=button_count&amp;width=100&amp;show_faces=false&amp;font=tahoma&amp;colorscheme=light&amp;action=like&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:100px; height:21px;" allowTransparency="true"></iframe></td><td align="center" style="padding-left:20px; color:#000000;"><!-- Place this tag where you want the +1 button to render. -->
<div class="g-plusone" data-size="medium" data-href="https://plus.google.com/117667049594254872720"></div>
</td><td align="center" height="40" style="padding-left:20px;"><a href="https://twitter.com/deal4loans" class="twitter-follow-button" data-show-count="false">Follow @deal4loans</a>
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
 
</div></div>
<div style="clear:both; height:15px;"></div>
<?php include "footer1.php"; ?>
</body>
</html>