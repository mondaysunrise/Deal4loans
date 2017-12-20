<?php
//session_start();
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<?
$Query="SELECT * FROM Req_Credit_Card WHERE RequestID=210547";
//echo $Query."<br>";
//$Query="Select RequestID From Req_Credit_Card Where ((Req_Credit_Card.Net_Salary>=300000 and (Req_Credit_Card.DOB!='' and DATE_SUB(CURDATE(),INTERVAL 21 YEAR) >= Req_Credit_Card.DOB) and Req_Credit_Card.Employment_Status=1 ) and City in ('Ahmedabad','Bangalore','Chandigarh','Chennai','Delhi','Gurgaon','Noida','Hyderabad','Kolkata','Mumbai','Navi Mumbai','Pune') and Dated between '2009-08-13 00:00:00' and '2009-08-20 23:59:59' ) ";

//echo $Query;
//$Result = ExecQuery($Query);
	//$recordcount = mysql_num_rows($Result);
 //$NumRows = mysql_num_rows($Result);
 
    list($rowscount,$Arrrow)=MainselectfuncNew($Query,$array = array());
		$cntr=0;

//$NumRows=1;
  while($cntr<count($Arrrow))
        {

$EmailID= trim($Arrrow[$cntr]['Email']);
$Name = trim($Arrrow[$cntr]['Name']);
$ProductValue = trim($Arrrow[$cntr]['RequestID']);
$City = trim($Arrrow[$cntr]['City']);



$subject="Apply Credit Cards in 2 Minutes";

$Message2.="<table width='560' border='0' align='center' cellpadding='0' cellspacing='0'>
 
  <tr>
    <td><table width='100%' border='0' cellspacing='0' cellpadding='0'>
      <tr>
        <td width='174' height='185'><img src='http://www.deal4loans.com/emailer/cc-mailer09/hdr-lft.gif' width='174' height='185' /></td>
        <td width='187' height='185'><img src='http://www.deal4loans.com/emailer/cc-mailer09/hdr-mdl.gif' width='187' height='185' /></td>
        <td width='199' height='185'><img src='http://www.deal4loans.com/emailer/cc-mailer09/hdr-rgt.gif' width='199' height='185' /></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td bgcolor='#3680b9'><table width='558' border='0' align='center' cellpadding='0' cellspacing='0' bgcolor='#FFFFFF'>
      
      <tr>
        <td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; text-align:justify; color:#032241;'><table width='546' border='0' align='center' cellpadding='0' cellspacing='0'>
          <tr bgcolor='#FFFFFF'>
            <td height='58' valign='middle' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; text-align:justify; color:#032241; line-height:14px;'>Dear Customer,<br />
			Hope your experience in choosing your credit cards has been good @deal4loans.com.
Have you applied your Credit cards on the offers we sent you? If you have missed or want to apply for more, listed below are all offers.
Then ask him Yes Or no. If he says yes then which card.
</td>
          </tr>
          
          <tr bgcolor='#FFFFFF'>
            <td height='38' bgcolor='#FFFFFF' style='font-family:Verdana, Arial, Helvetica, sans-serif;  font-size:11px; font-weight:bold; text-align:justify; color:#032241;'>At Deal4loans you can apply for a Credit Card according to  your need. Check the features and apply accordingly.</td>
          </tr>
          
          <tr bgcolor='#FFFFFF'>
            <td  ><table width='100%' border='0' align='center' cellpadding='0' cellspacing='0'>
              <tr>
                <td><table width='100%' border='0' cellspacing='0' cellpadding='0'>
                  <tr>
                    <td height='25' colspan='2' align='left' valign='middle' bgcolor='#c2e5ff'  style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; color:#032241; text-indent:5px;'><b>Kotak Bank Range of Credit Card</b><br />
<img src='http://www.deal4loans.com/images/spacer.gif' width='200' height='1' border='0' /></td>
                    <td width='1' rowspan='23'   align='center' bgcolor='#92c3e8'><img src='http://www.deal4loans.com/images/spacer.gif' width='1' height='250' border='0' /></td>
					<td height='25' colspan='2' align='left' valign='middle' bgcolor='#c2e5ff' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; color:#032241; text-indent:5px;'> Citibank<b> Range of </b> Credit Card<br />
<img src='http://www.deal4loans.com/images/spacer.gif' width='250' height='1' border='0' /></td>
                  </tr>
                  <tr>
                    <td width='120' align='center' valign='middle' bgcolor='#ecf7ff'><img src='http://www.deal4loans.com/emailer/cc-mailer09/ktk-crd.jpg' width='82' height='100' /></td>
                    <td width='138' align='left' valign='top' bgcolor='#ecf7ff' style='font-family:Arial, Helvetica, sans-serif; font-size:12px; text-align:left; color:#032241;'>Requires 2 minutes to fill application</td>
                    <td width='161' align='center' bgcolor='#ecf7ff'><img src='http://www.deal4loans.com/emailer/cc-mailer09/ctbnk-crd.jpg' width='123' height='87' /></td>
                    <td width='117' align='left' valign='top' bgcolor='#ecf7ff' style='font-family:Arial, Helvetica, sans-serif; font-size:12px; text-align:left; color:#032241;'>Completely online application.
No calls, No Docs!</td>
                  </tr>
                  
                
                   
                   <tr>
                    <td height='22' colspan='2' align='left' valign='middle' bgcolor='#ecf7ff' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; text-align:justify; color:#032241; text-indent:5px;'>Kotak  Trump Gold Card</td>
                    <td height='22' colspan='2' align='left' valign='middle' bgcolor='#ecf7ff' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; text-align:justify; color:#032241; text-indent:5px;'>Citibank IndianOil Gold Credit Card</td>
                  </tr>
                  <tr>
                    <td colspan='2' align='left' valign='top' bgcolor='#ecf7ff'  style='font-family:Arial, Helvetica, sans-serif; font-size:12px; text-align:left; color:#032241;'>1). Life time free Credit Card.
                      <br />
                      2).	10% cash back on movies, plays and on food & drinks.
                      <br />
                      3).	2.5% Surcharge wavier on filling petrol across all petrol pumps.
                      <br />
                      4).	1.8% Railway Surcharge Waiver for offline & online transactions.</td>
                    <td colspan='2' valign='top' bgcolor='#ecf7ff' style='font-family:Arial, Helvetica, sans-serif; font-size:12px; text-align:left; color:#032241;'>1). Life time free Credit Card.<br />
2).	Earn 4 Turbo Reward Points for every Rs. 150 of fuel purchase at select IndianOil Retail Outlets.<br />
3).	Earn 1 Turbo Reward Point for every Rs. 150 of spend every time.<br />
4).	2.5% surcharge waived off on filling petrol from Indian Oil.</td>
                    </tr>
                   <tr>
                     <td height='35' colspan='2' align='right' valign='top' bgcolor='#92c3e8'><table width='100%' border='0' align='right' cellpadding='0' cellspacing='0' bgcolor='#ecf7ff'>
                         <tr>
                           <td height='34' align='right'><a href='https://www.kotakcards.com/kotak/px/kotak/applyonline.do?csmcode=VE02'><img src='http://www.deal4loans.com/emailer/cc-mailer09/apl-btn.gif' width='80' height='25' style='border:none;' /></a></td>
                         </tr>
                     </table></td>
                    <td height='35' colspan='2' align='right' valign='top' bgcolor='#92c3e8'><table width='100%' border='0' align='right' cellpadding='0' cellspacing='0' bgcolor='#ecf7ff'>
                      <tr>
                        <td height='34' align='right'><a href='https://www.online.citibank.co.in/products-services/credit-cards/apply-online.htm?category=fuel&site=DEAL4LOANS&creative=HANDLE150x244&section=D4FGHA15&agencyCode=DDB&campaignCode=CARDS0&productCode=CARDS&eOfferCode=D4FGHA15'><img src='http://www.deal4loans.com/emailer/cc-mailer09/apl-btn.gif' width='80' height='25' style='border:none;' /></a></td>
                      </tr>
                    </table>                      </td></tr>
                 
                   <tr>
                    <td height='22' colspan='2' align='left' valign='middle' bgcolor='#ecf7ff' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; text-align:justify; color:#032241; text-indent:5px;'>Kotak  League Platinum Card</td>
                    <td height='22' colspan='2' align='left' valign='middle' bgcolor='#ecf7ff' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; text-align:justify; color:#032241; text-indent:5px;'>Citibank  Titanium Cash Reward Credit Card</td>
                  </tr>
                  <tr>
                    <td colspan='2' align='left' valign='top' bgcolor='#ecf7ff'  style='font-family:Arial, Helvetica, sans-serif; font-size:12px; text-align:left; color:#032241;'>1). Annual Fee Rs.3,000 to 12,000/-<br />
2). 10% savings on spends at Taj Restaurants and Bars.<br />
3).	On spend of Rs.100 get 1 reward points and 1 point = 1 rupees.<br />
4).	2.5% fuel surcharge wavier across all petrol pumps.</td>
                    <td colspan='2' valign='top' bgcolor='#ecf7ff' style='font-family:Arial, Helvetica, sans-serif; font-size:12px; text-align:left; color:#032241;'>1). Annual fee of Rs.500/-<br />
2).	5 times the rewards on weekend spend.<br />
3).	Redeem Reward Points for Cash, Air travel, Shopping or Gifts.<br />
4).	Enjoy the benefits of a special interest rate of 2.5% p.m.</td>
                    </tr>
                   <tr>
                     <td height='35' colspan='2' align='right' valign='top' bgcolor='#92c3e8'><table width='100%' border='0' align='right' cellpadding='0' cellspacing='0' bgcolor='#ecf7ff'>
                         <tr>
                           <td height='34' align='right'><a href='https://www.kotakcards.com/kotak/px/kotak/applyonline.do?csmcode=VE02'><img src='http://www.deal4loans.com/emailer/cc-mailer09/apl-btn.gif' width='80' height='25' style='border:none;' /></a></td>
                         </tr>
                     </table></td>
                    <td height='35' colspan='2' align='right' valign='top' bgcolor='#92c3e8'><table width='100%' border='0' align='right' cellpadding='0' cellspacing='0' bgcolor='#ecf7ff'>
                      <tr>
                        <td height='34' align='right'><a href='https://www.online.citibank.co.in/products-services/credit-cards/apply-online.htm?category=shopping&site=DEAL4LOANS&creative=CART150x244&section=D4STCA15&agencyCode=DDB&campaignCode=CARDSO&productCode=CARDS&eOfferCode=D4STCA15'><img src='http://www.deal4loans.com/emailer/cc-mailer09/apl-btn.gif' width='80' height='25' style='border:none;' /></a></td>
                      </tr>
                    </table>                      </td></tr>
                    
                     <tr>
                    <td height='22' colspan='2' align='left' valign='middle' bgcolor='#ecf7ff' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; text-align:justify; color:#032241; text-indent:5px;'>Kotak Royale Signature Card</td>
                    <td height='22' colspan='2' align='left' valign='middle' bgcolor='#ecf7ff' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; text-align:justify; color:#032241; text-indent:5px;'> Citibank Jet Airways Platinum Credit Card</td>
                  </tr>
                   <tr>
                    <td colspan='2' align='left' valign='top' bgcolor='#ecf7ff'  style='font-family:Arial, Helvetica, sans-serif; font-size:12px; text-align:left; color:#032241;'>1). 	Annual Fee Rs.25,000/-<br />
2).	25% savings on spends at Taj Restaurants and Bars.<br />
3).	On spend of Rs.100 get 1 reward points and 1 point = 1 rupees.<br />
4).	If card is stolen or lost a fraudulent charges cover of Rs. 50,000/-, upto 12 hours pre- reporting.   <td colspan='2' valign='top' bgcolor='#ecf7ff'  style='font-family:Arial, Helvetica, sans-serif; font-size:12px; text-align:left; color:#032241;'>1). Annual fee of Rs.2,000/-<br />
2).	Get 4 JPmiles on every spent of Rs. 100.<br />
3).	Earn 3000 JPMiles on booking and 4000 JPMiles on renewal.<br />
4).	2.5% surcharge waived off on filling petrol from Indian Oil</td>
                    </tr>
                   <tr>
                     <td height='35' colspan='2' align='right' valign='top' bgcolor='#92c3e8'><table width='100%' border='0' align='right' cellpadding='0' cellspacing='0' bgcolor='#ecf7ff'>
                         <tr>
                           <td height='34' align='right'><a href='https://www.kotakcards.com/kotak/px/kotak/applyonline.do?csmcode=VE02'><img src='http://www.deal4loans.com/emailer/cc-mailer09/apl-btn.gif' width='80' height='25' style='border:none;' /></a></td>
                         </tr>
                     </table></td>
                    <td height='35' colspan='2' align='right' valign='top' bgcolor='#92c3e8'><table width='100%' border='0' align='right' cellpadding='0' cellspacing='0' bgcolor='#ecf7ff'>
                      <tr>
                        <td height='34' align='right'><a href='https://www.online.citibank.co.in/products-services/credit-cards/apply-online.htm?category=Travel&site=DEAL4LOANS&creative=FLY150x244&section=D4TGFL15&agencyCode=DDB&campaignCode=CARDSO&productCode=CARDS&eOfferCode=D4TGFL15'><img src='http://www.deal4loans.com/emailer/cc-mailer09/apl-btn.gif' width='80' height='25' style='border:none;' /></a></td>
                      </tr>
                    </table>                      </td></tr>
                    
                    
                </table></td>
              </tr>
              
            </table></td>
          </tr>
          <tr bgcolor='#FFFFFF'>
            <td  >&nbsp;</td>
          </tr>
          
        </table></td>
      </tr>
      
    </table></td>
  </tr>
  
  <tr>
    <td width='560' height='22'><img src='http://www.deal4loans.com/emailer/cc-mailer09/crd-btmline.gif' width='560' height='22' /></td>
  </tr>
 
</table>";
echo $Message2."<br>";


//echo $getcontent."<br>";
$headers  = 'MIME-Version: 1.0' . "\r\n";				
				$headers  = 'From: Credit Card Offers <no-reply@deal4loans.com>' . "\r\n";
				$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

	echo "count".$j."name ".$Name."Email:  ".$EmailID."banks ".$cc_bank."LeadID ".$LID."<br>";
	//if(strlen($email)>0)
	//{
	//$EmailID="";
//$EmailID ="ranjana5chauhan@gmail.com,ranjana.chauhan@rediffmail.com,ranjanachauhan5@yahoo.com,ranjana5chauhan@hotmail.com";
	mail($EmailID,$subject, $Message2, $headers);
	//}
	echo "done";
	$cntr = $cntr+1;
}
?>
</body>
</html>
