<?php

	require 'scripts/db_init.php';
	require 'scripts/functions.php';

	$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-4, date("Y"));
$currentdate=date('Y-m-d',$tomorrow);
$min_date=$currentdate." 00:00:00";
$max_date=$currentdate." 23:59:59";


$Query="SELECT * FROM Req_Credit_Card WHERE (Dated between '".$min_date."' and '".$max_date."' and City in ('Bangalore','Chandigarh','Chennai','Delhi','Gurgaon','Hyderabad','Kolkata','Mumbai','Noida','Pune') and Net_Salary>=350000 ) group by Email";

 list($NumRows,$getrow)=MainselectfuncNew($Query,$array = array());
		$cntr=0;

  
while($cntr<count($getrow))
        {
$EmailID= trim($getrow[$cntr]['Email']);
$Name = trim($getrow[$cntr]['name']);
$City = trim($getrow[$cntr]['City']);
$Mobile_Number = trim($getrow[$cntr]['Mobile_Number']);
$ProductValue = trim($getrow[$cntr]['RequestID']);

$subject="Your Credit Card Application!";
$Message2="<table width='560' border='0' align='center' cellpadding='0' cellspacing='0'>
 
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
            <td height='55' valign='middle' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; text-align:justify; color:#032241; line-height:14px;'>Dear Customer,<br />
			Hope your experience in choosing your credit cards has been good @deal4loans.com.
			</td></tr>
			   <tr bgcolor='#FFFFFF'>
            <td height='58' valign='middle' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; text-align:justify; color:#032241; line-height:14px; border:1px solid #c2e5ff; padding:5px;'><form action='http://www.deal4loans.com/emailer/citinkotak_thank.php' method='POST' name='citinkotak'><input type='hidden' name='city' value='".$City."'>
			<input type='hidden' name='requestid' value='".$ProductValue."'>
1) Have you applied your Credit cards on the offers we sent you? <br><input type='radio' name='applied_cc' value='Yes'>Yes <br><input type='radio' name='applied_cc' value='No'>No<br><br>
2) If yes then which card? <br><br>
Card Name <select name='card_name' style='font-size:11px; '><option value='' selected>Please select</option>
<option value='Kotak Trump Gold Card'>Kotak Trump Gold Card</option>
<option value='Citibank IndianOil Gold Credit Card'>Citibank IndianOil Gold Credit Card</option>
<option value='Kotak League Platinum Card'>Kotak League Platinum Card</option>
<option value='Citibank Titanium Cash Reward Credit Card'>Citibank Titanium Cash Reward Credit Card</option>
<option value='Kotak Royale Signature Card'>Kotak Royale Signature Card</option>

</select>
<br><br><input type='submit' value='submit' style='float:right; font-family: Verdana, Arial, Helvetica, sans-serif;	font-size: 12px;	color: #FFFFFF;	background-color: #157097;	border: 1px solid #157097;
	font-weight: bold;'>
</form>
 </td>
          </tr></table>
  </td></tr>
   <tr bgcolor='#FFFFFF'>
            <td height='38' bgcolor='#FFFFFF' style='font-family:Verdana, Arial, Helvetica, sans-serif;  font-size:11px; font-weight:bold; text-align:justify; color:#032241;'><br>If you have missed or want to apply for more, listed below are all offers.<br>At Deal4loans you can apply for a Credit Card according to  your need. Check the features and apply accordingly.<br></td>
          </tr>";
		  
		 /*   <tr bgcolor='#FFFFFF'>
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
				  </table></td></tr>
  </table></td></tr>
  
  $Message2.=" <tr><td>
  		<table width='100%' border='0' align='center' cellpadding='0' cellspacing='0'>
		<tr><td colspan='2' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '><b>The following Credit Card companies are interested in your profile:</b></td>
		</tr>";*/
				
			if($ProductValue>0)
  {
$selectccbanks="Select * From credit_card_banks_eligibility where (cc_bank_citylist like '%".$City."%' and cc_bank_flag=1 and cc_bankid in (3,4)) order by cc_bank_fee ASC";
	//echo "query1 ".$selectccbanks."<br><br>";
	
	 list($rowscount,$Arrrow)=MainselectfuncNew($selectccbanks,$array = array());
		$j=0;
if($rowscount >0)
{
 
  $Message2.="<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '> <table  border='1' cellspacing='0' cellpadding='0'>
		<tr>
		<td  height='40' bgcolor='#c2e5ff'  style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; color:#032241; text-indent:5px;' >Name</td>
		<td height='40'bgcolor='#c2e5ff'  style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; color:#032241; text-indent:5px;' >Age</td>
		<td height='40'bgcolor='#c2e5ff'  style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; color:#032241; text-indent:5px;'>Fee</td>
		<td height='40'bgcolor='#c2e5ff'  style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; color:#032241; text-indent:5px;' >Features</td>
		<td  height='40' bgcolor='#c2e5ff'  style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; color:#032241;' >Interest Rates</td>
		
		 <td  height='40'bgcolor='#c2e5ff'  style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; color:#032241; text-indent:5px;'  >&nbsp;</td>
			  
			  </tr>";
   
	while($j<count($Arrrow))
        {
        $cc_bank_query  = $row[$j]['cc_bank_query'];
		$cc_bankid  = $row[$j]['cc_bankid'];
		$cc_bank_url  = $row[$j]['cc_bank_url'];
		  $qry2 = $cc_bank_query.' and Req_Credit_Card.RequestID ='.$ProductValue;

		list($recordcount,$getrow2)=MainselectfuncNew($qry2,$array = array());
		if($recordcount>0)
		 {
			//echo "$recordcount:".$recordcount."<br>";
		 	$i=0;
	for($ii=0;$ii<$recordcount;$ii++)
			 {
			$get_Bank='Select * From credit_card_banks_eligibility Where cc_bankid='.$cc_bankid.' order by cc_bank_fee ASC';
			list($offerrecordcount,$myrow)=MainselectfuncNew($get_Bank,$array = array());
				$getexactcount=  $offerrecordcount;

			for($jj=0;$jj<$offerrecordcount;$jj++)
			{
			  if($myrow[$jj]['cc_bank_fee']==0)
			 {
				  $cardfee="free";
			 }
			 else
			 {
				$cardfee=$myrow[$jj]['cc_bank_fee'];
			 }

			 $Message2.=" <tr>
			  <td  bgcolor='#ecf7ff' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; color:#032241;' ><a href='".$cc_bank_url."' target='_blank'>".$myrow[$jj]['cc_bank_name']."</a></td>
			  <td  bgcolor='#ecf7ff' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; text-align:justify; color:#032241; text-indent:5px;' >".$myrow[$jj]['cc_bank_age']."</td>
			  <td bgcolor='#ecf7ff' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; color:#032241; text-indent:5px;' >".$cardfee."</td>
			  <td valign='top'  style='padding-left:5px;' class='tblpdng_txt' bgcolor='#ecf7ff'>".$myrow[$jj]['cc_bank_features']."</td>
			  <td bgcolor='#ecf7ff' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; text-align:justify; color:#032241; text-indent:5px;' >". $myrow[$jj]['cc_bank_rates']."</td>
			    <td  bgcolor='#ecf7ff' align='center' style='font-size:11px; text-align:center;font-weight:bold; '><a href='".$cc_bank_url."' target='_blank' ><img src='http://www.deal4loans.com/emailer/cc-mailer09/apl-btn.gif' width='80' height='25' style='border:none;' /></a></td>
			  </tr>";
			 
			
			  }
			  }
    
	  }
	$j = $j+1;}
	 $Message2.="</table></td></tr>";
	 $Message2.="<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '>Regards,<br>Deal4loans.com</td></tr>";
	/* $Message2.="<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '>
			  If you havent applied them,Click on the above links to apply for your set of Credit Cards.It will Just take two minutes to apply for your Credit card.Just make sure you have your Pan card number handy with you.<br><br></td></tr>";*/

	  }
					}
			//}
		$Message2.="</table>
	</td></tr><tr>    <td align='center'><img src='http://www.deal4loans.com/images/tp_bl-line.gif' width='558' height='20' /></td>

  </tr>
  
  </table></td></tr>
  
  
  </table>";

  //echo $Message2;
 echo "<br><br>hello:".$offerrecordcount."<br>".$recordcount."<br>";
if($getexactcount>0 )
	{
	echo "hello: ".$getexactcount;

//echo $getcontent."<br>";
$headers  = 'MIME-Version: 1.0' . "\r\n";				
				$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
				$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers .= 'Bcc: extra4testing@gmail.com' . "\r\n";

	echo "count".$j."name ".$Name."Email:  ".$EmailID."LeadID ".$ProductValue."<br>";

	
//		$EmailID="extra4testing@gmail.com";
	mail($EmailID,$subject, $Message2, $headers);
	echo "sent";

	if(strlen($Mobile_Number)>0)
		{
			$SMSMessage="Thanks for ur Credit card request @ Deal4loans.Hope that you have applied at one of the offers.If you have missed, we have sent them again at your email.Apply!";
			SendSMS($SMSMessage, $Mobile_Number);
		}

	}
	
	
  $cntr=$cntr+1;
}
?>
