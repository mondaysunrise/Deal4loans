<?php
	$dbuser	= "root"; 
	$dbserver = "localhost"; 
	$dbpass	= "";
	$conn = mysql_connect($dbserver, $dbuser, $dbpass) or die ('I cannot connect to the database because: ' . mysql_error());
	$dbb = mysql_select_db("deal4loans_primary",$conn);
	
/*
function db_connect_w(){
	$dbuser	= "root"; 
	$dbserver = "localhost"; 
	$dbpass	= "";
	$dbname	= "deal4loans_primary"; 

	$conn = mysql_connect($dbserver, $dbuser, $dbpass) or die ('I cannot connect to the database because: ' . mysql_error());

	if($conn && mysql_select_db($dbname))
	    	return $conn;

	return (FALSE);
   }

   ////////////////////////////////////////
   function ExecQuery_w($sql){

	/////////////////////////Connect to the db
	db_connect_w();

	/////////////////////////Return the resultset
	return (mysql_query($sql));
}
*/
//require 'http://www.deal4loans.com/scripts/db_init.php';
$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"));
$currentdate=date('d F Y',$tomorrow);
?>
<div style="width:250px; float:right; top:auto;">
        <table width="250" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="44" align="center" valign="top" background="http://www.deal4loans.com/new-images/rgt-int-tpbg.gif"  style=" color:#333333; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; text-align:center; line-height:10px; padding-top:3px; " ><b style="font-size:11px; ">Latest Personal loan Interest Rates</b><br />
( Last updated on : <?php echo $currentdate; ?> )</td>
    </tr>
    <tr>
      <td style="border-left:3px solid #f5e77d; border-right:3px solid #f5e77d; ">
      
      <table width="235" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#f4f3eb">
        <tr bgcolor="#FFFFFF">
          <td width="113" height="22" align="center" valign="middle" style="color: #373737; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 11px; padding: 2px;"><b>Bank</b> </td>
          <td width="119" align="center" valign="middle" style="width:95px; color: #373737; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 11px; padding: 2px;"><b>Interest<br />
      Rates</b></td>
         
        </tr>
 <?php 
$getplrates = mysql_query("Select rateid,cat_a,bank_name,others,bank_url,processing_fee From personal_loan_interest_rate_chart where (flag=1) limit 5") or die('Error: '. mysql_error());
while($plrow = mysql_fetch_array($getplrates))
{
?>        <tr bgcolor="#FFFFFF">
          <td height="35" align="center" valign="middle" style="font-size:10px;"><a href="<?  echo $plrow['bank_url'];?>" style="color:#335599;line-height:13px; text-decoration:none; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 10px;"><? echo $plrow["bank_name"]; ?></a></td>
          <td align="center" valign="middle" style="color: #373737; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 10px; padding: 2px;"><? echo $plrow["cat_a"]."-".$plrow["others"]; ?></td>
</tr>
          <? }?>
           <tr bgcolor="#FFFFFF">
          <td height="35" align="center" valign="middle" style="font-size:10px;">For Other Banks</td>
          <td align="center" valign="middle" style="color: #373737; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 10px; padding: 2px;"><a href="/personal-loan-interest-rate.php">Click Here</a></td>
</tr>
          
      </table>
      
      </td>
    </tr>
    <tr>
      <td height="16" valign="top"><img src="http://www.deal4loans.com/new-images/rgt-int-btbg.gif" width="250" height="16" /></td>
    </tr>
  </table>
  
</div>