<?php
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
 $tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"));
$currentdate=date('d F Y',$tomorrow);
?><div style="width:250px; float:right; top:auto;">
        <table width="250" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="44" align="center" valign="top" background="http://www.deal4loans.com/new-images/rgt-int-tpbg.gif"  style=" color:#333333; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; text-align:center; line-height:10px; padding-top:5px; " ><b style="font-size:11px; ">Car Loan Rate of Interest</b><br />

( Last edited on : <? echo $currentdate; ?> )</td>
    </tr>
    <tr>
      <td style="border-left:3px solid #f5e77d; border-right:3px solid #f5e77d; ">
      
      <table width="235" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#f4f3eb">
        <tr bgcolor="#FFFFFF">
          <td width="118" height="22" align="center" valign="middle" style="color: #373737; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 11px; padding: 2px;"><b>Bank</b> </td>
          <td width="114" align="center" valign="middle" style="width:95px; color: #373737; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 11px; padding: 2px;"><b>Interest 
      Rates</b></td>
         
        </tr>
 <? //$gethlrates=ExecQuery_w("Select ndtv_rates,bank_name,bank_url,processing_fee From home_loan_interest_rate_chart where (tenure=1 and hlrateid in (5,102,105,151,10,203,115,3,8) and flag=1) order by  priority ASC  limit 5");
	//while($hlrow=mysql_fetch_array($gethlrates))
	//{
	?>
        <!--<tr bgcolor="#FFFFFF">
          <td height="35" align="center" valign="middle" style="font-size:10px;"><a href="<?  //echo $hlrow['bank_url'];?>" style="color:#335599;line-height:13px; text-decoration:none; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 10px;" ><?// echo $hlrow["bank_name"]; ?></a></td>
          <td align="center" valign="middle"  style="color: #373737; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 10px; padding: 2px;"><? //echo $hlrow["ndtv_rates"]; ?></td>
 
       </tr> -->
       
               <tr bgcolor="#FFFFFF">
          <td height="35" align="center" valign="middle" style="font-size:10px;"><a href="http://www.deal4loans.com/loans/car-loan/icici-bank-car-loans/" style="color:#335599;line-height:13px; text-decoration:none; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 10px;" >ICICI Bank</a></td>
          <td align="center" valign="middle"  style="color: #373737; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 10px; padding: 2px;">11.50% - 17%</td>
 
       </tr>
               <tr bgcolor="#FFFFFF">
          <td height="35" align="center" valign="middle" style="font-size:10px;"><a href="http://www.deal4loans.com/loans/car-loan/hdfc-car-loan-eligibility-interest-rates-and-documents-requirement-for-apply-hdfc-bank-car-loans/" style="color:#335599;line-height:13px; text-decoration:none; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 10px;" >HDFC Bank</a></td>
          <td align="center" valign="middle"  style="color: #373737; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 10px; padding: 2px;">10.50% - 11.75%</td>
 
       </tr>
               <tr bgcolor="#FFFFFF">
          <td height="35" align="center" valign="middle" style="font-size:10px;"><a href="http://www.deal4loans.com/loans/car-loan/kotak-car-loans-eligibility-documents-interest-rates-apply/" style="color:#335599;line-height:13px; text-decoration:none; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 10px;" >Kotak Mahindra</a></td>
          <td align="center" valign="middle"  style="color: #373737; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 10px; padding: 2px;">11.50% - 13.50%</td>
 
       </tr>
               <tr bgcolor="#FFFFFF">
          <td height="35" align="center" valign="middle" style="font-size:10px;"><a href="http://www.deal4loans.com/loans/car-loan/sbi-advantage-car-loans-car-loan-scheme-sbi/" style="color:#335599;line-height:13px; text-decoration:none; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 10px;" >SBI</a></td>
          <td align="center" valign="middle"  style="color: #373737; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 10px; padding: 2px;">10.45%</td>
 
       </tr>
                <tr bgcolor="#FFFFFF">
          <td height="35" align="center" valign="middle" style="font-size:10px;"><a href="http://www.deal4loans.com/loans/car-loan/magma-fincorp-car-loan-interest-rates-documents-eligibility/" style="color:#335599;line-height:13px; text-decoration:none; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 10px;" >Magma Fincorp</a></td>
          <td align="center" valign="middle"  style="color: #373737; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 10px; padding: 2px;">10.75% - 12.00%</td>
 
       </tr>
          <? //}?>
          
          
      </table>
      
      </td>
    </tr>
    <tr>
      <td height="16" valign="top"><img src="http://www.deal4loans.com/new-images/rgt-int-btbg.gif" width="250" height="16" /></td>
    </tr>
  </table>
  
</div>