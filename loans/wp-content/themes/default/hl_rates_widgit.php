<?php
/*
function db_connect_w(){
$dbuser	= "root"; 
	$dbserver= "localhost"; 
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
$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"));
$currentdate=date('d F Y',$tomorrow);
?>
<div style="width:250px; float:right; top:auto;">
        <table width="250" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="44" align="center" valign="top" background="http://www.deal4loans.com/new-images/rgt-int-tpbg.gif"  style=" color:#333333; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; text-align:center; line-height:10px; padding-top:5px; " ><b style="font-size:11px; ">Latest Home loan Interest Rates</b><br />

( Last updated on : <? echo $currentdate; ?> )</td>
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
$gethlrates=mysql_query("Select ndtv_rates,bank_name,bank_url,processing_fee From home_loan_interest_rate_chart where (tenure=1 and hlrateid in (5,111,12,10,3,8,190) and flag=1) order by  priority ASC  limit 7") or die(''. mysql_error());
while($hlrow=mysql_fetch_array($gethlrates))
{
?>
        <tr bgcolor="#FFFFFF">
          <td height="35" align="center" valign="middle" style="font-size:10px;"><a href="<?  echo $hlrow['bank_url'];?>" style="color:#335599;line-height:13px; text-decoration:none; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 10px;" ><? echo $hlrow["bank_name"]; ?></a></td>
          <td align="center" valign="middle"  style="color: #373737; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 10px; padding: 2px;"><? echo $hlrow["ndtv_rates"]; ?></td>
 
       </tr>
<?php
}
?>
          
         <tr bgcolor="#FFFFFF">
          <td height="35" align="center" valign="middle" style="font-size:10px;">For Other Banks</td><td align="center" valign="middle"  style="color: #373737; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 10px; padding: 2px;"><a href="/home-loans-interest-rates.php">Click Here</a></td></tr>  
      </table>
      
      </td>
    </tr>
    <tr>
      <td height="16" valign="top"><img src="http://www.deal4loans.com/new-images/rgt-int-btbg.gif" width="250" height="16" /></td>
    </tr>
  </table>
  
</div>