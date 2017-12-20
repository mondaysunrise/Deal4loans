<?php
error_reporting('E_ALL');
require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';

$bankId = $_REQUEST['bank_id'];
$getplrates = "Select rateid,cat_a,bank_name,others,bank_url,processing_fee From personal_loan_interest_rate_chart where (flag=1) and rateid='".$bankId."' order by bankwise_priority ASC";
list($alreadyExist,$plrow)=MainselectfuncNew($getplrates,$array = array());

?>
<div class="table-banks_overflow">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#e0eaf1">
<tr bgcolor="#FFFFFF">
<td height="22" align="center" valign="middle" class="tbl_txt" width="200" style="font-size:15px;"><b>Bank</b> </td>
<td width="300" align="center" valign="middle" class="tbl_txt" style="width:95px;font-size:15px;"><b>Interest Rates</b></td>
<td align="center" valign="middle" class="tbl_txt" width="100" style="font-size:15px;"><b>Apply</b></td>
</tr>
<?php 
while($plrow=mysql_fetch_array($getplrates))
for($i=0;$i<$alreadyExist;$i++)
{
	$maxrate="";
if(strlen($plrow[$i]["others"])>1)
{
$maxrate="-".$plrow[$i]["others"];
}
?>        
<tr bgcolor="#FFFFFF">
<?php if($plrow[$i]["rateid"]==5) 
{
?>
<td height="35" align="center" valign="middle" style="color:#335599;line-height:13px; text-decoration:none;font-size:14px;" class="tbl_txt"><a href="<?  echo $plrow[$i]['bank_url'];?>" style="color:#335599;line-height:13px; text-decoration:none;" class="tbl_txt"><? echo $plrow[$i]["bank_name"]; ?></a></td>
<? 	  }
else
{ ?>
<td height="35" align="center" valign="middle" style="font-size:10px;font-size:14px;"><a href="<?  echo $plrow[$i]['bank_url'];?>" style="color:#335599;line-height:13px; text-decoration:none;font-size:16px;" class="tbl_txt"><? echo $plrow[$i]["bank_name"]; ?></a></td>
<? } ?>
<td align="center" valign="middle"  class="tbl_txt" style="font-size:14px;"><? echo $plrow[$i]["cat_a"]."".$maxrate; ?></td>
<td align="center" valign="middle" class="tbl_txt" style="font-size:14px;">
<? if($plrow[$i]["rateid"]==2) 
{
?>
<!--<a href="http://www.deal4loans.com/hdfc-personal-loan-new.php" target="_blank"><img src="images/apply1.gif" width="45" height="20" border="0" /></a>-->
<img src="images/apply1.gif" width="45" height="20" border="0" onclick="show_bank_intr_personal_details(); ga('send', 'event', 'PL <?php echo $plrow[$i]["bank_name"]; ?> Int Rate Apply', 'PL <?php echo $plrow[$i]["bank_name"]; ?> Int Rate Apply Button');" />
<? }
elseif($plrow[$i]["rateid"]==5) 
{
?>

<? }
else if($plrow[$i]["rateid"]==9) 
{ ?>
<!--<a href="http://www.deal4loans.com/get-quote-ingvysya.php" target="_blank"><img src="images/apply1.gif"  width="45" height="20" border="0" /></a>-->
<img src="images/apply1.gif" width="45" height="20" border="0" onclick="show_bank_intr_personal_details(); ga('send', 'event', 'PL <?php echo $plrow[$i]["bank_name"]; ?> Int Rate Apply', 'PL <?php echo $plrow[$i]["bank_name"]; ?> Int Rate Apply Button');" />
<? }
else if($plrow[$i]["rateid"]==10) 
{ ?>
<!--<a href="http://www.deal4loans.com/loans/personal-loan/bajaj-finserv-lending-personal-loan-eligibility-documents-interest-rates-apply/" target="_blank"><img src="images/apply1.gif"  width="45" height="20" border="0" /></a> -->
<img src="images/apply1.gif" width="45" height="20" border="0" onclick="show_bank_intr_personal_details(); ga('send', 'event', 'PL <?php echo $plrow[$i]["bank_name"]; ?> Int Rate Apply', 'PL <?php echo $plrow[$i]["bank_name"]; ?> Int Rate Apply Button');" />
<? }
else if($plrow[$i]["rateid"]==11) 
{ ?>
<!--<a href="http://www.deal4loans.com/personal-loan-hdb-financial-services.php" target="_blank"><img src="images/apply1.gif"  width="45" height="20" border="0" /></a> -->
<img src="images/apply1.gif" width="45" height="20" border="0" onclick="show_bank_intr_personal_details(); ga('send', 'event', 'PL <?php echo $plrow[$i]["bank_name"]; ?> Int Rate Apply', 'PL <?php echo $plrow[$i]["bank_name"]; ?> Int Rate Apply Button');" />
<? }

else
{?>
<!--<a href="<? echo $plrow[$i]['bank_url']; ?>" target="_blank"><img src="images/apply1.gif"  width="45" height="20" border="0" /></a> -->
<img src="images/apply1.gif" width="45" height="20" border="0" onclick="show_bank_intr_personal_details(); ga('send', 'event', 'PL <?php echo $plrow[$i]["bank_name"]; ?> Int Rate Apply', 'PL <?php echo $plrow[$i]["bank_name"]; ?> Int Rate Apply Button');" />
<? } ?>
</td>
<? }?>
</tr>
</table>
</div>