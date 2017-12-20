<div style="width:250px; float:right;">
<?php
require '/scripts/db_init.php';
$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"));
$currentdate=date('d F Y',$tomorrow);
?>
<style>
.tbl_txt {
    color: #373737;
    font-family: Verdana,Arial,Helvetica,sans-serif;
    font-size: 11px;
    padding: 2px;
}
</style>
<table width="250" border="0" cellpadding="0" cellspacing="0"  id="bgclr">
       <tr>
         <td  align="center" valign="middle" bgcolor="#FFFFFF"><table width="250" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="44" align="center" valign="middle" background="http://www.deal4loans.com/new-images/rgt-int-tpbg.gif"  style=" color:#333333; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; text-align:center; line-height:15px;" ><b style="font-size:12px; ">Home Loan Rate of Interest</b><br />

( Last edited on : <? echo $currentdate; ?> )</td>
    </tr>
    <tr>
      <td style="border-left:3px solid #f5e77d; border-right:3px solid #f5e77d; "><table width="235" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#f4f3eb">
        <tr bgcolor="#FFFFFF">
          <td height="22" align="center" valign="middle" class="tbl_txt"><b>Bank</b> </td>
          <td width="95" align="center" valign="middle" class="tbl_txt" style="width:95px; "><b>Interest<br />
      Rates</b></td>
          <td align="center" valign="middle" class="tbl_txt"><b>Apply</b></td>
        </tr>
 <? $gethlrates=("Select ndtv_rates,bank_name,bank_url,processing_fee From home_loan_interest_rate_chart where (tenure=1 and hlrateid in (5,111,12,10,3,8,190) and flag=1) order by  priority ASC  limit 7");
	list($numRows,$hlrow)=MainselectfuncNew($gethlrates,$array = array());

	for($i=0;$i<$numRows;$i++)
	{
	?>
        <tr bgcolor="#FFFFFF">
          <td height="35" align="center" valign="middle" style="font-size:10px;"><a href="<?  echo $hlrow[$i]['bank_url'];?>" style="color:#335599;line-height:13px; text-decoration:none;" class="tbl_txt"><? echo $hlrow[$i]["bank_name"]; ?></a></td>
          <td align="center" valign="middle"  class="tbl_txt"><? echo $hlrow[$i]["ndtv_rates"]; ?></td>
 
          <td align="center" valign="middle" class="tbl_txt" style="font-size:10px;"><a href="http://www.deal4loans.com/apply-for-home-loans.php" target="_blank"><img src="new-images/apl-sml.gif" width="46" height="16" border="0" /></a> </td></tr>
          <? }?>
          
          
      </table></td>
    </tr>
    <tr>
      <td height="16" valign="top"><img src="http://www.deal4loans.com/new-images/rgt-int-btbg.gif" width="250" height="16" /></td>
    </tr>
  </table></td>
       </tr>
        <tr>
         <td  align="center" valign="middle" bgcolor="#FFFFFF" height="10" ></td>
      </tr>
    <td valign="top" style="padding-top:10px;">
	</td>
  </tr>
</table>
</div>