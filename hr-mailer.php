<?php
session_start();
 /* If file_put_contents doesn't exists, let's make our own */
if( !function_exists('file_put_contents') ) {
  function file_put_contents($file_name, $file_contents) {
   /* Open the file */
   if( !$handle = fopen($file_name, 'w') ) {
    trigger_error("Cannot open file ($file_name)", E_USER_ERROR);
    return false;
   }
   /* Write to it */
   if( fwrite($handle, $file_contents) === FALSE ) {
    trigger_error("Cannot write to file ($file_name)", E_USER_ERROR);
    return false;
   }
   /* Close it */
   fclose($handle); 
   return true;
  } 
 }  
 
 function sendfileattachment($emailid,$session_id,$Message)
	{
	
	$to = "".$emailid.""; 
       $from = "Deal4loans <no-reply@deal4loans.com>"; 
      $subject = "HR Emailer"; 
	  
   		$fileatt = "emailer/mailer.html";
        $fileatttype = "application/html"; 
        $fileattname = "emailer/mailer.html";
        
       $file = fopen( $fileatt, 'r+' ); 
        $data = fread( $file, filesize( $fileatt ) ); 
        fclose( $file );
		
		$headers = "From: $from";
		
		
		 $semi_rand = md5( time() ); 
        $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 
   		//$headers .= 'MIME-Version: 1.0' . "\r\n";
		//$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= "\nMIME-Version: 1.0\n" . 
                    "Content-Type: multipart/mixed;\n" . 
                    " boundary=\"{$mime_boundary}\""."\n";

        $message = "This is a multi-part message in MIME format.\n\n" . 
                "--{$mime_boundary}\n" . 
                "Content-Type: text/plain; charset=\"iso-8859-1\"\n" . 
                "Content-Transfer-Encoding: 7bit\n\n" . 
                $message . "\n\n";
    
        $data = chunk_split( base64_encode( $data ) );
                 
        $message .= "--{$mime_boundary}\n" . 
                 "Content-Type: {$fileatttype};\n" . 
                 " name=\"{$fileattname}\"\n" . 
                 "Content-Disposition: attachment;\n" . 
                 " filename=\"{$fileattname}\"\n" . 
                 "Content-Transfer-Encoding: base64\n\n" . 
                 $data . "\n\n" . 
                 "--{$mime_boundary}--\n"; 
                 
  
       if( mail( $to, $subject, $message, $headers ) ) {
         
            echo "<p>The email was sent.</p>"; 
         
        }
        else { 
        
            echo "<p>There was an error sending the mail.</p>"; 
         
        }
   
    }
 
if($_POST['submit']=="CampaignName")
{
	$hName = $_POST['hName'];
	$_SESSION['hName'] = $hName;
}

if($_POST['submitm']=="GetMailer")
{
	
	$Name = $_SESSION['hName'];
	

	
		$message = '<table width="530" border="1" align="center" cellpadding="0" cellspacing="4" bordercolor="#CCCCCC">
  <tr><td><table width="530" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td width="160" height="166" align="left" valign="top"><img src="http://www.deal4loans.com/emailer/joint-mailer/joint-mlr-img1.jpg" width="160" height="166" /></td><td width="206" height="166" align="left" valign="top"><img src="http://www.deal4loans.com/emailer/joint-mailer/joint-mlr-img2.jpg" width="206" height="166" /></td><td width="164" height="166" align="left" valign="top"><img src="http://www.deal4loans.com/emailer/joint-mailer/joint-mlr-img3.jpg" width="164" height="166" /></td></tr></table></td> </tr> <tr><td style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#023B5D; text-align:center; padding-top:12px; ">With the special tie up for '.$Name.' employees, the Banks/Insurance<br />Companies will compete to Get the Best Deal.<br />.........................................................................................................................</td> </tr>  <tr>    <td><table width="100%" border="0" align="left" cellpadding="0" cellspacing="0"><tr><td width="321" height="23" align="center" valign="middle"><table width="98%" border="0" align="right" cellpadding="0" cellspacing="0"><tr><td height="40" colspan="2" align="center" valign="top" ><img src="http://www.deal4loans.com/emailer/joint-mailer/joint-mlr-prtner.gif" width="136" height="23" /></td></tr><tr><td width="24%" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#023B5D; text-align:left; ">Loans</td><td width="76%" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#79250B; text-align:left; ">ICICI Bank, Citibank, ABN AMRO,<br />LIC Housing, IDBI, HDFC Bank</td></tr><tr><td style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#023B5D; text-align:left; ">Insurance</td><td height="50" align="left" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#79250B; text-align:left; ">Tata AIG, Max New York Life, <br />Bajaj Allianz, Kotak, ICICI Lombard</td></tr> </table></td><td width="209" align="right" valign="top"><form action="http://www.deal4loans.com/hr-mailer-continue.php" method="post" name="mailer"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td align="center" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#FFFFFF; text-align:center;  ">&nbsp;</td></tr><tr><td height="22" align="center" bgcolor="#1F94D9" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#FFFFFF; text-align:center;  ">Apply</td></tr><tr><td align="right" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="3" bgcolor="#F2F9FD"><tr><td style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:normal; color:#023B5D; text-align:left; padding-left:5px; line-height:18px;">Product Type </td><td><select style="width:104px;" name="Type_Loan"><option value="1">Please select</option><option value="PersonalLoan">Personal Loan</option><option value="HomeLoan">Home Loan</option><option value="CreditCard">Credit Card</option><option value="LifeInsurance">Life Insurance</option><option value="HealthInsurance">Health Insurance</option></select></td></tr><tr><td style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:normal; color:#023B5D; text-align:left; padding-left:5px; line-height:18px;">FullName</td><td><input type="text" name="fullname" style="width:100px;" maxlength="30" /></td></tr><tr><td style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:normal; color:#023B5D; text-align:left; padding-left:5px; line-height:18px;">Mobile</td><td><input type="text" name="mobile" style="width:100px;" maxlength="10" /><input type="hidden" name="source" value="'.$Name.' HrMailer"></td></tr><tr><td style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:normal; color:#023B5D; text-align:left; padding-left:5px; line-height:18px;">Email Id </td><td><input type="text" name="email_id" style="width:100px;" maxlength="60" /></td></tr><tr><td height="30" colspan="2" align="center" valign="middle"><input name="submit" value="Submit" type="submit"/></td></tr></table></td></tr></table></form></td></tr></table></td></tr><tr><td height="20" valign="top" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:normal; color:#023B5D; text-align:left; padding-left:5px;"><span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#023B5D; text-align:left; padding-left:5px; ">How will this work?</span></td>  </tr>  <tr>    <td valign="top" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:normal; color:#023B5D; text-align:left; padding-left:5px; line-height:18px; padding-bottom:8px; ">i). Apply Online for your Loans/Insurance/Credit Cards needs<br />    ii). Get Offers from 4 banks/Insurance Companies in 24 hrs<br />    iii). Special pricing for your Company.<br />    iv). Choose your Best Deal.<br />    <br />    Also, <br />    Through <strong><a href="http://www.askamitoj.com/" target="_blank" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:normal; color:#023B5D; text-align:left; font-weight:bold; text-decoration:underline;">www.askamitoj.com</a></strong> we resolve your queries related to debt i.e. Loans &amp; Credit Card. You can receive advice from our Loan Guru and manage your debt.    We will also help to prepare a special debt consolidation plan if you need one.<br />    <br />    So, for the cheapest loan EMI&rsquo;s, Credit Cards, Lowest Premium for Insurance Policies we are just a click away.   Apply here<br />    <br />    &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;<a href="http://www.askamitoj.com/" target="_blank" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:normal; color:#023B5D; text-align:left; font-weight:bold; text-decoration:underline;">www.askamitoj.com</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="http://www.deal4loans.com" target="_blank" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:normal; color:#023B5D; text-align:left; font-weight:bold; text-decoration:underline;">www.deal4loans.com</a>&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="http://www.bimadeals.com/" target="_blank" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:normal; color:#023B5D; text-align:left; font-weight:bold; text-decoration:underline;"> www.bimadeals.com</a> </td>  </tr>  <tr>    <td height="22" bgcolor="#E1F3FE" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#023B5D; text-align:center;">Our portals have serviced more than four Lakhs customers in the last one year.</td>  </tr></table></td>  </tr></table>';
  
		 file_put_contents('emailer/mailer.html', $message);
		 	$session_id=session_id();
		
			sendfileattachment($mail,$session_id,$message);
  }

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>HR Mailer</title>
</head>

<body>
<form action="hr-mailer.php" method="post" name="mailer">
<table width="530" border="" align="center" cellpadding="4" cellspacing="4" >
<tr><td colspan="2" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#023B5D; text-align:center; padding-top:12px; " align="center">Build a E-mailer</td></tr>
<tr><td><?php if(isset($hName)) { ?> <input type="submit" name="submitm" value="GetMailer" /> <?php } ?></td><td align="right"><input type="text" name="hName" id="hName" />&nbsp;&nbsp;&nbsp;<input type="submit" name="submit" value="CampaignName" /></td></tr>
<tr><td colspan="2"><hr /></td></tr>
<tr><td colspan="2">
<table width="530" border="1" align="center" cellpadding="0" cellspacing="4" bordercolor="#CCCCCC">
  <tr>
    <td><table width="530" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="160" height="166" align="left" valign="top"><img src="http://www.deal4loans.com/emailer/joint-mailer/joint-mlr-img1.jpg" width="160" height="166" /></td>
        <td width="206" height="166" align="left" valign="top"><img src="http://www.deal4loans.com/emailer/joint-mailer/joint-mlr-img2.jpg" width="206" height="166" /></td>
        <td width="164" height="166" align="left" valign="top"><img src="http://www.deal4loans.com/emailer/joint-mailer/joint-mlr-img3.jpg" width="164" height="166" /></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#023B5D; text-align:center; padding-top:12px; ">With the special tie up for <?php if(isset($hName)) echo "&nbsp;".$hName."&nbsp;"; else { echo "......................"; }  ?> employees, the Banks/Insurance<br />
Companies will compete to Get the Best Deal.<br />
.........................................................................................................................</td>
  </tr>
  <tr>
    <td><table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
      
      <tr>
        <td width="321" height="23" align="center" valign="middle"><table width="98%" border="0" align="right" cellpadding="0" cellspacing="0">
          <tr>
           <td height="40" colspan="2" align="center" valign="top" ><img src="http://www.deal4loans.com/emailer/joint-mailer/joint-mlr-prtner.gif" width="136" height="23" /></td>
           </tr>
          <tr>
            <td width="24%" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#023B5D; text-align:left; ">Loans</td>
            <td width="76%" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#79250B; text-align:left; ">ICICI Bank, Citibank, ABN AMRO,<br />
              LIC Housing, IDBI, HDFC Bank</td>
          </tr>
          <tr>
            <td style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#023B5D; text-align:left; ">Insurance</td>
            <td height="50" align="left" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#79250B; text-align:left; ">Tata AIG, Max New York Life, <br />
              Bajaj Allianz, Kotak, ICICI Lombard</td>
          </tr>
          
          
        </table></td>
        <td width="209" align="right" valign="top">
		<!--<form>-->
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="center" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#FFFFFF; text-align:center;  ">&nbsp;</td>
          </tr>
          <tr>
            <td height="22" align="center" bgcolor="#1F94D9" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#FFFFFF; text-align:center;  ">Apply</td>
          </tr>
          <tr>
            <td align="right" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="3" bgcolor="#F2F9FD">
              <tr>
                <td style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:normal; color:#023B5D; text-align:left; padding-left:5px; line-height:18px;">Product Type </td>
                <td><select style="width:104px;" name="Type_Loan">
                  <option value="1">Please select</option>
                  <option value="Personal_Loan">Personal Loan</option>
                   <option value="Personal_Loan">Home Loan</option>
                   <option value="Personal_Loan">Credit Card</option>
                   <option value="Life_Insurance">Life Insurance</option>
                   <option value="Health_Insurance">Health Insurance</option>
			    </select></td>
              </tr>
              <tr>
                <td style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:normal; color:#023B5D; text-align:left; padding-left:5px; line-height:18px;">FullName</td>
                <td><input type="text" name="fullname" style="width:100px;" maxlength="30" /></td>
              </tr>
              <tr>
                <td style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:normal; color:#023B5D; text-align:left; padding-left:5px; line-height:18px;">Mobile</td>
                <td><input type="text" name="Mobile" style="width:100px;" maxlength="30" /></td>
              </tr>
              <tr>
                <td style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:normal; color:#023B5D; text-align:left; padding-left:5px; line-height:18px;">Email Id </td>
                <td><input type="text" name="fullname4" style="width:100px;" maxlength="30" /></td>
              </tr>
              <tr>
                <td height="30" colspan="2" align="center" valign="middle"><input name="submit" value="Submit" type="submit"/></td>
                </tr>
            </table></td>
          </tr>
        </table>
		<!--</form>--></td>
      </tr>
      
    </table></td>
  </tr>
  
  <tr>
    <td height="20" valign="top" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:normal; color:#023B5D; text-align:left; padding-left:5px;"><span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#023B5D; text-align:left; padding-left:5px; ">How will this work?</span></td>
  </tr>
  <tr>
    <td valign="top" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:normal; color:#023B5D; text-align:left; padding-left:5px; line-height:18px; padding-bottom:8px; ">i). Apply Online for your Loans/Insurance/Credit Cards needs<br />
    ii). Get Offers from 4 banks/Insurance Companies in 24 hrs<br />
    iii). Special pricing for your Company.<br />
    iv). Choose your Best Deal.<br />
    <br />
    Also, <br />
    Through <strong><a href="http://www.askamitoj.com/" target="_blank" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:normal; color:#023B5D; text-align:left; font-weight:bold; text-decoration:underline;">www.askamitoj.com</a></strong> we resolve your queries related to debt i.e. Loans &amp; Credit Card. You can receive advice from our Loan Guru and manage your debt.
    We will also help to prepare a special debt consolidation plan if you need one.<br />
    <br />
    So, for the cheapest loan EMI&rsquo;s, Credit Cards, Lowest Premium for Insurance Policies we are just a click away.   Apply here<br />
    <br />
    &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;<a href="http://www.askamitoj.com/" target="_blank" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:normal; color:#023B5D; text-align:left; font-weight:bold; text-decoration:underline;">www.askamitoj.com</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="http://www.deal4loans.com" target="_blank" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:normal; color:#023B5D; text-align:left; font-weight:bold; text-decoration:underline;">www.deal4loans.com</a>&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="http://www.bimadeals.com/" target="_blank" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:normal; color:#023B5D; text-align:left; font-weight:bold; text-decoration:underline;"> www.bimadeals.com</a> </td>
  </tr>
  <tr>
    <td height="22" bgcolor="#E1F3FE" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#023B5D; text-align:center;">Our portals have serviced more than four Lakhs customers in the last one year.</td>
  </tr>
</table></td>
  </tr>
</table>
</td></tr>
<tr><td></td></tr>
</table>
</form>
</body>
</html>
