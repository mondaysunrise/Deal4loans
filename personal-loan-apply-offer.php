<?php
ob_start( 'ob_gzhandler' );
require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Personal Loan | Personal Loan India | Deal4loans</title>
<link href="http://www.deal4loans.com/sourcenew.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.prprrprp{ width:970px;}

@media screen and (max-width:768px){
.prprrprp{ width:100%;}}

</style>
</head>
<body>
<!--top-->
<div style="position:absolute; top:0px; left:0px; width:100%; height:30px; background-image:url(http://www.deal4loans.com/images/top_bg.gif); background-position:center top; z-index:1;">
</div>
<!--top-->
<!--logo navigation-->
<div style="margin:auto; height:105px; padding-top:28px;" class="prprrprp">
<div style="float:left; clear:right; width:243px; height:94px;"><a href="http://www.deal4loans.com/index.php"><img src="http://www.deal4loans.com/images/logo.gif" width="243" height="90" border="0" /></a></div>
</div>
<div style="margin:auto; width:100%;  margin-top:1px;">

<div style="clear:both;"></div>
<div class="pl_form_box">
<?php include "pl_form.php"; ?>
</div>
<div style="margin:auto;  margin-top:1px;" class="prprrprp">
<div class="apply_pl_table_wrapper_new">
<?php
/* Getting Bank's total information regarding loan */
$showBankInfoSql = "select * from personal_loan_banks_eligibility where (pl_bank_flag=1) order by pl_bank_roi ASC";
list($totalBankRecords,$showBankInfoQry)=MainselectfuncNew($showBankInfoSql,$array = array());
?>
<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr>
        <td height="47" width="13%" align="center" bgcolor="#ffb738" class="apply_pl_table_text_new" style="border-right:#fbf9f6 solid thin; padding-left:5px; padding-right:5px;">Banks</td>
        <td height="47" width="10%" align="center" bgcolor="#ffb738" class="apply_pl_table_text_new" style="border-right:#fbf9f6 solid thin; padding-left:5px; padding-right:5px;" nowrap="nowrap">Rate of Interest</td>
        <td height="47" width="17%" align="center" bgcolor="#ffb738" class="apply_pl_table_text_new" style="border-right:#fbf9f6 solid thin; padding-left:5px; padding-right:5px;" nowrap="nowrap">Processing Fee</td>
        <td height="47" width="18%" align="center" bgcolor="#ffb738" class="apply_pl_table_text_new" style="border-right:#fbf9f6 solid thin; padding-left:5px; padding-right:5px;" nowrap="nowrap">Loan Amount</td>
        <td height="47" width="18%" align="center" bgcolor="#ffb738" class="apply_pl_table_text_new" style="border-right:#fbf9f6 solid thin; padding-left:5px; padding-right:5px;" nowrap="nowrap">Prepayment Charges</td>
        <td height="47" width="13%" align="center" bgcolor="#ffb738" class="apply_pl_table_text_new" style="border-right:#fbf9f6 solid thin; padding-left:5px; padding-right:5px;" nowrap="nowrap">Disbursal Time</td>
        <td height="47" width="10%" align="center" bgcolor="#ffb738" class="apply_pl_table_text_new" style="border-right:#fbf9f6 solid thin; padding-left:5px; padding-right:5px;">Part Payment Option</td>
    </tr>
	<?php
	if($totalBankRecords > 0){
		
		$cntr = 1;
		for($i=0;$i<$totalBankRecords;$i++)	
		{
		
		if($cntr%2==0){
			$addBgcolor = 'bgcolor="#e0f0fb"';
		}else{
			$addBgcolor = 'bgcolor="#fafdff"';
		}
		$cntr++;
	?>    
    <tr>
        <td height="64" align="center" <?php echo $addBgcolor; ?> class="apply_pl_table_text_new-c" style="border-right:#fbf9f6 solid thin; font-size:14px;"><strong><?php echo $showBankInfoResult[$i]['pl_bank_name']; ?></strong></td>
        <td height="64" align="center" <?php echo $addBgcolor; ?> class="apply_pl_table_text_new-c" style="border-right:#fbf9f6 solid thin;"><?php echo $showBankInfoResult[$i]['pl_bank_roi']; ?></td>
        <td height="64" align="center" <?php echo $addBgcolor; ?> class="apply_pl_table_text_new-c" style="border-right:#fbf9f6 solid thin;"><?php echo nl2br($showBankInfoResult[$i]['pl_bank_processing_fee']); ?></td>
        <td height="64" align="center" <?php echo $addBgcolor; ?> class="apply_pl_table_text_new-c" style="border-right:#fbf9f6 solid thin;"><?php echo $showBankInfoResult[$i]['pl_bank_loan_amt']; ?></td>
        <td height="64" align="center" <?php echo $addBgcolor; ?> class="apply_pl_table_text_new-c" style="border-right:#fbf9f6 solid thin;"><?php echo nl2br($showBankInfoResult[$i]['pl_bank_prepayment']); ?></td>
        <td height="64" align="center" <?php echo $addBgcolor; ?> class="apply_pl_table_text_new-c" style="border-right:#fbf9f6 solid thin;"><?php echo $showBankInfoResult[$i]['pl_bank_disbursal_time']; ?></td>
        <td height="64" align="center" <?php echo $addBgcolor; ?> class="apply_pl_table_text_new-c"><?php echo $showBankInfoResult[$i]['part_payment_option']; ?></td>
    </tr>
    <?php 
		}
	}else{ 
	?>
    <tr>
    	<td colspan="100%" height="64" align="center" bgcolor="#e0f0fb" class="apply_pl_table_text_new-c" style="color:#AE0000; font-size:16px;"> Records not found !</td>
    </tr>
    <?php } ?>
</table>
<div style="clear:both; height:15px;"></div>

<div class="terms_c_wrapper_new"><span style="font-size:11px;">*Terms & conditions apply</span><br />
<strong><br />
Tips for Best Personal loan deal</strong>
<br />
1) Compare exact Emi|Processing fee |Tenure|Documents before choosing bank|
<br />
2) Never pay any fee to any person to get loan sanctioned.Processing fee are deducted from Loan amount.
<br />
3) Only give documents to one bank and check whether he is authorized Bank employee or vendor. </div>
<div class="emi_calcy_box_new"><a href="/Contents_Calculators.php" target="_blank"><img src="images/emi1.gif" width="95" height="20" alt="emi calculator" border="0" /></a></div>
<br /><br />
</div>  	
</div>
</div>

<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-1312775-1");
pageTracker._trackPageview();
} catch(err) {}</script>
</body>
</html>
