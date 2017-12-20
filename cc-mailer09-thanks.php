<?php
	//require 'scripts/session_check_online.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

//$cc_bank=$_SESSION['CC_Bank'];
$cc_bank="Abn Ambro,Amex";
$cc_bank=trim($cc_bank);
$getcc_bank=explode(",", $cc_bank);



	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<style type="text/css">
input{
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size:11px;
	margin:0px;
	padding:0px;
}


</style>

</head>

<body>
<table width="605" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
  <td height="25" align="center" valign="middle"><span style="font-family:Arial, Helvetica, sans-serif; font-size:11px; text-decoration:none; color:#000000;">If you are not able to view this mailer properly, please <a href="http://deal4loans.com/emailer/cc-mailer09.php">Click here</a></span></td>
  </tr>
  <tr>
      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="116" height="194" align="left" valign="top"><img src="http://www.deal4loans.com/emailer/cc-mailer09/hdr-img1.gif" width="116" height="194" /></td>
        <td width="124" height="194" align="left" valign="top"><img src="http://www.deal4loans.com/emailer/cc-mailer09/hdr-img2.gif" width="124" height="194" /></td>
        <td width="110" align="left" valign="top"><img src="http://www.deal4loans.com/emailer/cc-mailer09/hdr-img3.gif" width="110" height="194" /></td>
        <td width="115" align="left" valign="top"><img src="http://www.deal4loans.com/emailer/cc-mailer09/hdr-img4.gif" width="115" height="194" /></td>
        <td valign="top"><img src="http://www.deal4loans.com/emailer/cc-mailer09/hdr-img5.gif" width="140" height="194" /></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="1" bgcolor="#bfd5f3"></td>
        <td width="603"><table width="603" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top" align="left"><table width="408" border="0" align="left" cellpadding="0" cellspacing="0">
			<tr><td>&nbsp;</td></tr>
              <tr><td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px;  color:#144a79; font-weight:bold; padding-left:3px; letter-spacing:-1px;" height="20">Dear Customer,</td></tr>
                   <tr>
                <td valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:11px; line-height:18px; color:#051e33; padding-left:3px;">Thanks for registering yourself with Deal4loans.com for the latest Credit card offers of (Bank name that the customer has chosen). The latest card offers will be sent to your email id on month to month bases.

See the current offers on your SBI (other bank name) credit card
</td>
              </tr>
<?php 
		for($i=0;$i<count($getcc_bank);$i++)
		{
		$getcc_data=ExecQuery("select * from monthly_creditcard_offer where compare_value='".$getcc_bank[$i]."'");
while($row = mysql_fetch_array($getcc_data))
{
	$cc_bankname=$row['ccbank_name'];
	$cc_content=$row['cc_content'];
?>
	<tr>
		<td><h4 align="left"><u><? echo $cc_bankname;?></u> </h4>
			
		</td>
	</tr>
	<tr><td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px;  color:#144a79; font-weight:bold; padding-left:3px; letter-spacing:-1px;"><? echo $cc_content;?></td></tr>
<?}
		}
?>
			  
                   
                   
            </table></td>
            <td width="192" height="101" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="190" height="110" align="left" valign="top"><img src="http://www.deal4loans.com/emailer/cc-mailer09/hdr-footer.gif" width="190" height="110" /></td>
              </tr>
              <tr>
                <td valign="top">
				<form  name="CC_offers_mailer" action="http://www.deal4loans.com/emailer/cc-mailer09.php" method="POST"><table width="190" border="0" align="left" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="1" bgcolor="#bfd5f3"></td>
                    <td valign="top"></td>
                    <td bgcolor="#bfd5f3" width="1"></td>
                  </tr>
                  
                </table></form></td>
              </tr>
              <tr>
                <td width="190" height="27" align="left" valign="top"><img src="http://www.deal4loans.com/emailer/cc-mailer09/testi.gif" width="190" height="27" /></td>
              </tr>
              
              <tr>
                <td><table width="190" border="0" align="left" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="1" bgcolor="#bfd5f3"></td>
                    <td valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:11px; line-height:17px; color:#051e33; padding:4px; text-align:left; "><p>The entire information  about loans &amp; credit card is really relevant. wish you good luck &amp; keep  going.</p>
                      <b style="float:right;"> - Saurabh Shukla</b></td>
                    <td width="1" bgcolor="#bfd5f3"></td>
                  </tr>
                </table></td>
              </tr>
			  <tr>
			  <td width="190" height="25" align="left" valign="top"><img src="http://www.deal4loans.com/emailer/cc-mailer09/ftr-brdr.gif" width="190" height="22" /></td>
			  </tr>
            </table></td>
          </tr>
        </table></td>
        <td width="1" bgcolor="#bfd5f3"></td>
      </tr>
    </table></td>
  </tr>
  <tr><td bgcolor="#2A84DA"><table width="100%"><tr><td style="color:#FFFFFF; font-family:Arial, Helvetica, sans-serif; font-size:12px; line-height:18px;" width="20" align="center">Deal4investments.com</td><td style="color:#FFFFFF; font-family:Arial, Helvetica, sans-serif; font-size:12px; line-height:18px;" width="15" align="center">|</td><td style="color:#FFFFFF; font-family:Arial, Helvetica, sans-serif; font-size:12px; line-height:18px;" width="20" align="center">Debt consolidation</td><td style="color:#FFFFFF; font-family:Arial, Helvetica, sans-serif; font-size:12px; line-height:18px;" width="15" align="center">|</td><td style="color:#FFFFFF; font-family:Arial, Helvetica, sans-serif; font-size:12px; line-height:18px;" width="20" align="center">Bimadeals.com</td><td style="color:#FFFFFF; font-family:Arial, Helvetica, sans-serif; font-size:12px; line-height:18px;" width="15" align="center">|</td></tr></table></td></tr>
  <tr>
    <td width="605" align="center" valign="top"><img src="http://www.deal4loans.com/emailer/cc-mailer09/ftr-brdr.gif" width="605" height="22" /></td>
  </tr>
</table>




</body>
</html>
