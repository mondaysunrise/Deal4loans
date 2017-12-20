<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$Name= $_REQUEST['Name'];
		$URL=$_REQUEST['Geturl'];
		$send_to =$_REQUEST['send_to'];
		$message= $_REQUEST['content'];

		$explodeUrl = explode("/" , $URL);
			$URLPostion = count($explodeUrl)-1;
			$MidURL = $explodeUrl[$URLPostion];
			$explodeMidUrl = explode("?" , $MidURL);
			$FinalURL = $explodeMidUrl[0];
			$SendEmail = $_REQUEST['SendEmail'];
		
$newsletter="<table width='650' border='0' align='center' cellpadding='0' cellspacing='0' bgcolor='#EAEAEA' style='border-collapse:collapse;'>
  <tr>
    <td height='25' align='center' bgcolor='#FFFFFF' style='font-family:Arial, Helvetica, sans-serif; font-size:11px; text-decoration:none; color:#000000;'>If you are not able to view this mailer properly, please <a href='http://www.deal4loans.com/emailer/may09.php'>Click here</a> </td>
  </tr>
  <tr>
    <td><table width='630' align='center' cellpadding='0' cellspacing='0' bgcolor='#FFFFFF' style='border:1px solid #CCCCCC;'>
      <tr>
        <td><table width='615' align='center' cellpadding='0' cellspacing='0'>
            <tr>
              <td  align='left' valign='middle'><img src='http://www.deal4loans.com/emailer/newsletter09may/d4l-logo.gif' width='325' height='80'></td>
              <td width='210' height='87' background='http://www.deal4loans.com/emailer/newsletter09may/tp-contbg.gif' style='background-repeat:no-repeat; '><table width='100%' border='0' cellspacing='0' cellpadding='0'>
                <tr>
                  <td height='65' align='center' style='font-size:14px; font-weight:bold; color:#FFFFFF; text-align:center; font-family:Verdana, Arial, Helvetica, sans-serif;'>Newsletter for May 2009</td>
                </tr>
                <tr>
                  <td align='center'><a href='http://www.deal4loans.com' style='font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif; font-weight:bold; color:#FFFFFF; text-decoration:underline;'>www.deal4loans.com</a></td>
                </tr>
              </table>                </td>
            </tr>
        </table></td>
      </tr>
      <tr>
        <td ><table width='615' align='center' cellpadding='0' cellspacing='0'>
		<tr>
		<td>&nbsp;</td>
		<td width='220'>&nbsp;</td>
		</tr>
            <tr>
              <td align='left' valign='top' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#505050;  line-height:18px; text-align:justify;'><div style='font-size:13px; font-weight:bold; color:#2E2E2E;'>Your Cibil Score</div>
                The Credit Information Bureau India Ltd and TransUnion have initiated a new process to help lenders to know about their customers. They have launched a 'personal loan score' process which will help them sanction loans and avoid defaulters. Currently CIBIL has 135 million borrower accounts in their database and 165 customers.Also a home repository and central registry will be launched in the second quarter of the financial year '09. <br>
                    <br>
                  Besides help to the lenders CIBIL is also going to have a system from December 2009 where consumers will also be able to get information about their credit history. This would come at a nominal charge of Rs100.<br>
                  Home repository: Will benefit buyers by getting information of the property on sale. By this information there will not be duplication of sale of the same property and reduce frauds.<br>
                  <br>
                  Central registry: Will benefit the lenders like banks, financial institutions and non-banking finance companies to get information about their customers. <br>
                  Fraud repository: Is a list where people who have tried to commit frauds or cheat the lenders so they are cautioned for future transactions.<br>
                  The Personal Loan Score: Provides information on customers who are  91 days delinquent. These are either on a personal or consumer loan which is completed a year. This will be indicated by a score level between 300-900.<br>
                  <br>
                Hence with such information both for lenders and buyers it will help reduce frauds in the future. 
                <hr size='1' color='#2E2E2E'><div style='font-size:13px; font-weight:bold;'>Union Bank – Home Loan interest rate 8% for 1 year </div>
                  After SBI and Central bank of India and other public sector banks, Union Bank of India has followed suite by freezing their home loan interest rates. They are now offering an 8% interest rate for the first year of 20 year tenure and up to Rs50 lakh loan amount. This is an attractive rate which is valid only till the 30th September 2009 and only for the new borrowers.<br>                    <br>
                  Post completion of one year, the interest rate would again change to floating interest rates until the whole loan is paid back. They have launched this scheme which is identical to which SBI had offered some months back. <br>
                  <br>
                  Besides private banks even public sector banks are now being lucrative in their schemes and interest rates. This is a very good offer for availing a home loan as the initial first year EMI would be lesser, which is a benefit in this time of recession. <br>
                  <br>                  <b>Rate of Interest Offered by Union Bank of India (Floating rate)                    </b>
                  <table border='1' cellpadding='0' cellspacing='0' bordercolor='#999999' style='border-collapse:collapse;'>
                    <tr>
                      <td colspan='4' align='center' valign='middle'  style='font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif;' >Special rate of interest of 8%    for new home loan appliers for one year only</td>
                    </tr>
                    <tr>
                      <td width='70' align='center' valign='middle' style='font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif;'><b>Years</b></td>
                      <td width='80' align='center' valign='middle' style='font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif;'><b>Up to Rs30Lakh</b></td>
                      <td width='105' align='center' valign='middle' style='font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif;'><b>Above Rs30Lakh to Rs.50Lakh</b></td>
                      <td width='122' align='center' valign='middle' style='font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif;'><b>Above Rs50Lakh</b></td>
                    </tr>
                    <tr>
                      <td width='70' align='center' valign='middle' style='font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif;'>Upto 5yrs</td>
                      <td width='80' align='center' valign='middle' style='font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif;'>9.25%</td>
                      <td width='105' align='center' valign='middle' style='font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif;'>9.50%</td>
                      <td width='122' align='center' valign='middle' style='font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif;'>9.75%</td>
                    </tr>
                    <tr>
                      <td width='70' align='center' valign='middle' style='font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif;'>From 5yrs    to 10yrs</td>
                      <td width='80' align='center' valign='middle' style='font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif;'>9.50%</td>
                      <td width='105' align='center' valign='middle' style='font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif;'>9.75%</td>
                      <td width='122' align='center' valign='middle' style='font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif;'>10.25%</td>
                    </tr>
                    <tr>
                      <td width='70' align='center' valign='middle' style='font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif;'>From    10yrs to 15yrs</td>
                      <td width='80' align='center' valign='middle' style='font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif;'>9.75%</td>
                      <td width='105' align='center' valign='middle' style='font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif;'>10.00%</td>
                      <td width='122' align='center' valign='middle' style='font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif;'>10.50%</td>
                    </tr>
                    <tr>
                      <td width='70' align='center' valign='middle' style='font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif;'>From    15Yrs to 20yrs</td>
                      <td width='80' align='center' valign='middle' style='font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif;'>9.75%</td>
                      <td width='105' align='center' valign='middle' style='font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif;'>10.00%</td>
                      <td width='122' align='center' valign='middle' style='font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif;'>10.50%</td>
                    </tr>
                  </table>
                  <hr size='1' color='#2E2E2E'>
                  <div style='font-size:13px; font-weight:bold; color:#2E2E2E;'>RBI ensures control of online Credit Card frauds.</div>
                 While  making payments for online transactions through your credit card, one is always  hesitant as hackers can get your information and misuse your card. But RBI has  ensured that from August 1, 2009 you can safely make purchases online. Since  one would have to give more data which would be a security code to transact  online. Currently for online transactions you just need to key in your card  number, expiry date of the card and the CVV number. This information becomes  easily accessible as it is on the face of the card hence there would be a  security code generated. Banks will have to provide extra authentication codes  or data to the customer which does not appear on the card.<br>                    <br>
                  Banks have also taken steps to increase the security for customers through  MasterCard's secure code and Visa's Verified by Visa. This secure code has to  be entered by the customer online in a window on their PC before starting the  transaction. As this is a secure number know only to the card holder it is safe  as even if someone has the card details without this security code a  transaction will not be approved.<br>
                  <br>
                  But for these security measures to be carried out for the customer the card-issuing bank, the retailer and the retailer's acquiring bank all will have to take part in this activity. Banks have already stopped customers to transact if they do not key in the security code for their online transactions. <br>
                  <br>
                  So, now you can securely make online transactions without worrying about any fraud or misuse to take place. Happy shopping!! </td>
              <td align='left' valign='top' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#505050;  line-height:18px;'><table width='210' align='right' cellpadding='2' cellspacing='0' bgcolor='#f5f4f4'>
                <tr>
                  <td height='70' align='center' valign='top' ><table width='100%' border='0' cellspacing='0' cellpadding='0'>
                      <tr>
                        <td colspan='3' align='center' valign='middle' style=' font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; color:#2E2E2E; font-weight:bold; line-height:25px;'>Click Here</td>
                      </tr>
                      <tr>
                        <td width='60' align='center' valign='middle'><a href='mailto: ?body=http://www.deal4loans.com/emailer/may09.php'><img src='http://www.deal4loans.com/emailer/newsletter09may/frwrd-btn.gif' width='17' height='17' border='0' /></a></td>
                        <td width='50' align='center'><a href='http://www.deal4loans.com/emailer/may09.php'><img src='http://www.deal4loans.com/emailer/newsletter09may/prnt-btn.gif' width='17' height='17' border='0' /></a></td>
                        <td align='center'><a href='http://www.deal4loans.com/emailer/may09.php'><img src='http://www.deal4loans.com/emailer/newsletter09may/cmnt-btn.gif' width='19' height='17' border='0' /></a></td>
                      </tr>
                      <tr>
                        <td align='center'><a href='mailto: ?body=http://www.deal4loans.com/emailer/may09.php' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:normal; color:#2E2E2E; line-height:19px;'>Forward</a></td>
                        <td align='center'><a href='http://www.deal4loans.com/emailer/may09.html'  style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:normal; color:#2E2E2E; line-height:19px; cursor:pointer;' target='_blank'>Print</a></td>
                        <td align='center'><a href='http://www.deal4loans.com/add_comment.php' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:normal; color:#2E2E2E; line-height:19px; cursor:pointer;' target='_blank'>Your Comment</a></td>
                      </tr>
                  </table></td>
                </tr>
                <tr>
                  <td align='center' bgcolor='#FFFFFF' >&nbsp;</td>
                </tr>
                <tr>
                  <td align='center' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; color:#2E2E2E; font-weight:bold; line-height:25px; text-align:center;'>Trends</td>
                </tr>
                <tr>
                  <td align='left'  style=' font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#2E2E2E; line-height: 18px;'>&bull; <a href='http://www.deal4loans.com/Interest-Rate-Personal-Loans.php?source=deal4loans-may09' target='_blank' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:normal; color:#2E2E2E; line-height:19px;'>Best Personal Loan Rates</a><br />                    &bull; <a href='http://www.deal4loans.com/Interest-Rate-Home-Loans.php?source=deal4loans-may09' target='_blank' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:normal; color:#2E2E2E; line-height:19px;'>Best Home Loan Rates</a><br />                    &bull; <a href='http://www.deal4loans.com/credit-card-offers-may-09.php?source=deal4loans-may09' target='_blank' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:normal; color:#2E2E2E; line-height:19px;'>Latest Offers on Credit Card</a> </td>
                </tr>
                <tr>
                  <td align='center' bgcolor='#FFFFFF' >&nbsp;</td>
                </tr>
                <tr>
                  <td align='center' style=' font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; color:#2E2E2E; font-weight:bold; line-height:25px; text-align:center;'>Apply for</td>
                </tr>
                <tr>
                  <td align='left'  style=' font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#2E2E2E; line-height: 18px;'>&bull; <a href='http://www.deal4loans.com/applyhere.php?source=deal4loans-may09' target='_blank' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:normal; color:#2E2E2E; line-height:19px;'>Loans/Credit Card</a><br />
                    &bull; <a href='http://www.bimadeals.com/compareinsurance.php?source=deal4loans-may09' target='_blank' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:normal; color:#2E2E2E; line-height:19px;'>Life/Health Insurance</a><br />
                    &bull; <a href='http://www.deal4investments.com/investments-deal.php?source=deal4loans-may09' target='_blank' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:normal; color:#2E2E2E; line-height:19px;'>Fixed Deposit</a><br />
                    &bull; <a href='http://www.deal4loans.com/AskAmitoj.php?source=deal4loans-may09' target='_blank' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:normal; color:#2E2E2E; line-height:19px;'>A Debt Consolidation Plan</a></td>
                </tr>
                <tr>
                  <td align='left' bgcolor='#FFFFFF' >&nbsp;</td>
                </tr>
                <tr>
                  <td align='left'  style=' font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; color:#2E2E2E; font-weight:bold; line-height:25px; text-align:center;'>Read More About</td>
                </tr>
                <tr>
                  <td align='left'  style=' font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#2E2E2E; line-height: 18px;'>&bull; <a href='http://www.deal4loans.com/home-loans.php?source=deal4loans-may09' target='_blank' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:normal; color:#2E2E2E;line-height:19px;'>Home Loan</a><br />
                    &bull; <a href='http://www.deal4loans.com/personal-loans.php?source=deal4loans-may09' target='_blank' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:normal; color:#2E2E2E;line-height:19px;'>Personal Loan</a><br />
                    &bull; <a href='http://www.bimadeals.com/life-insurance-india/life-insurance-companies.php?source=deal4loans-may09' target='_blank' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:normal; color:#2E2E2E;line-height:19px;'>Life Insurance Companies</a></td>
                </tr>
                <tr>
                  <td align='left' bgcolor='#FFFFFF' >&nbsp;</td>
                </tr>
                <tr>
                  <td align='left'  style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; color:#2E2E2E; font-weight:bold; line-height:25px; text-align:center;'>Test you Knowledge</td>
                </tr>
                <tr>
                  <td align='left'  style=' font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#2E2E2E; line-height: 18px;'>&bull; <a href='http://www.deal4loans.com/quiz.php?source=deal4loans-may09' target='_blank' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:normal; color:#2E2E2E;line-height:19px;'>Play the  Loan Quiz</a><br />
                    &bull; <a href='http://www.bimadeals.com/quiz.php?source=deal4loans-may09' target='_blank' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:normal; color:#2E2E2E;line-height:19px;'>Play the Insurance Quiz</a></td>
                </tr>
                <tr>
                  <td align='left' bgcolor='#FFFFFF' >&nbsp;</td>
                </tr>
                <tr>
                  <td align='left' style=' font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; color:#2E2E2E; font-weight:bold; line-height:25px; text-align:center;'>Testimonial</td>
                </tr>
                <tr>
                  <td align='left'  style=' font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#2E2E2E; line-height: 18px;'>Good to see the information provided here.... 
                    
                    Good luck &amp; keep doing the good work
                    <div style='float: right; font-weight:bold;'>By Lokesh</div></td>
                </tr>
                <tr>
                  <td align='left' bgcolor='#FFFFFF'>&nbsp;</td>
                </tr>
                <tr>
                  <td align='left' style=' font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; color:#2E2E2E; font-weight:bold; line-height:25px; text-align:center;'>Advertisement</td>
                </tr>
                <tr>
                  <td align='center' ><a href='http://bimadeals.net/health-insurance/health-insurance.php'><img src='http://www.deal4loans.com/emailer/newsletter09may/helth-insurban.gif' width='160' height='600' border='0'></a></td>
                </tr>
                <tr>
                  <td align='center' bgcolor='#FFFFFF'>&nbsp;</td>
                </tr>
                
              </table></td>
            </tr>
            <tr>
              <td align='left' valign='top' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#505050;  line-height:18px; text-align:justify;'>&nbsp;</td>
              <td align='left' valign='top' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#505050;  line-height:18px;'>&nbsp;</td>
            </tr>           
            
        </table>
          </td>
      </tr>
      <tr>
        <td ><table width='100%' border='0' cellpadding='0' cellspacing='0' bgcolor='#EAEAEA' style='font-family:Verdana; font-size:11px; font-weight:bold; color:#116DA7; line-height:19px;'>
          <tr>
            <td align='center' valign='middle' ><a href='http://www.deal4loans.com/index.php?source=deal4loans-may09' target='_blank' style='font-family:Verdana; font-size:10px; font-weight:bold; color:#333333; line-height:19px;'>www.deal4loans.com</a></td>
            <td align='center' valign='middle'><a href='http://www.deal4loans.com/Contents_Blogs.php?source=deal4loans-may09' target='_blank' style='font-family:Verdana; font-size:10px; font-weight:bold; color:#333333; line-height:19px;'>Blogs</a></td>
            <td align='center' valign='middle'><a href='http://www.deal4loans.com/Contents_Feedback.php?source=deal4loans-may09' target='_blank' style='font-family:Verdana; font-size:10px; font-weight:bold; color:#333333; line-height:19px;'>Feedback</a></td>
            <td align='center' valign='middle'><a href='http://www.deal4loans.com/Contact_Us.php?source=deal4loans-may09' target='_blank' style='font-family:Verdana; font-size:10px; font-weight:bold; color:#333333; line-height:19px;'>Contact us</a></td>
            <td align='center' valign='middle'><a href='http://www.deal4loans.com/Contents_Disclaimer.php?source=deal4loans-may09' target='_blank' style='font-family:Verdana; font-size:10px; font-weight:bold; color:#333333; line-height:19px;'>Disclaimer</a></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>";

	$headers = 'From: '.$Name.' <'.$SendEmail.'>' . "\r\n";
	$headers .= "Return-Path: <".$SendEmail.">\r\n";  // Return path for errors
	$headers .= 'Bcc: extra4testing@gmail.com' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$to = $send_to;
	mail($to,'Deal4loans Newsletter', $newsletter, $headers);


  

echo '
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>
<body>
<table style="border:1px solid #0E74D9;" width="450" align="center"><tr><td>
<p style="font-family: Verdana, Arial, Helvetica, sans-serif;	font-size: 12px;">
Dear '.$Name.'<br />
We have Emailed this newsletter to '.$send_to.'.<br />
Thanks for choosing Deal4loans.com</p>
</td></tr></table>
</body>
</html>
';
	echo "<script>window.close()"."</script>";
	}
	else
	{
?> 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Deal4loans.com </title>

<style>
.pp_text{
	font-family:Verdana, Arial, Helvetica, sans-serif; 
	font-size:11px; 
	line-height:18px; 
	color:#1F0C03; 
	padding-left:5px;
}
.pp_text b{
	font-family:Verdana, Arial, Helvetica, sans-serif; 
	font-size:11px; 
	line-height:18px; 
	color:#1F0C03; 
	padding-left:5px;
}
.pp_hdng{
	font-family:Verdana, Arial, Helvetica, sans-serif; 
	font-size:13px; 
	line-height:10px;
	font-weight:bold; 
	color:#C45A17;
	padding-top:8px; 
}

</style>

<form name="loan_form" method="post" action="<? echo $_SERVER['PHP_SELF'] ; ?>" >
<table width="400" height="250"  align="center" cellpadding="0" cellspacing="0" bgcolor="#F1F0F0" style='border:0px solid #C9C7C7;'>

<tr>
<td colspan="2" class="pp_hdng" align="center">Email An Article</td>
  </tr>

<tr>
<td width="125" height="26" align="left" class="pp_text"><b>Your Name</b></td>
    <td width="279" class="pp_text"><input type="hidden" value="<?php echo $url; ?>" name="Geturl">
<input type='text' name='Name' ></td>
</tr>
<tr>
    <td height="26" class="pp_text" ><b>Your Email</b></td>
    <td class="pp_text"><input type='text' name='SendEmail' ></td>
</tr>
<tr>
    <td class="pp_text"><b>Receiver E-mail Id</b></td>
    <td class="pp_text"><textarea rows='2' cols='30' name='send_to'></textarea><br>(Fill in comma separated email ids)</td>
</tr>

<!--<tr>
    <td colspan="2" class="pp_text"><b>You are going to email the following:</b><br>
    <?php //echo $url; ?></td>
</tr>-->
<tr>
    <td class="pp_text"><b >Write Message</b></td>
    <td class="pp_text"><textarea rows='2' cols='30' name='content'></textarea></td>
</tr>
<tr>
<td colspan="2" align="center" height="30"><input type='submit' value='submit' class='bluebutton'></td>
</tr>
</table></form>
<?php
}
?>
