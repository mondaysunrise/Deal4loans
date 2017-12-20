<?php
function getCityMails($city,$leadID)
{
	$sql_1 = "select * from hdfc_bidders where location ='".$city."' and status=1";
	
	 list($num_1,$getrow)=MainselectfuncNew($sql_1,$array = array());
		$cntr=0;
	if($num_1>0) //Send Mail and SMS
	{
		$bName = $getrow[$cntr]['Name']; 	
		$bEmail = $getrow[$cntr]['Email'];
		$bMobile = $getrow[$cntr]['Mobile'];
		
			
		//echo $bName."-".$bEmail."-".$bMobile;

		$custIDSql = "select * from hdfc_pl_calc_leads where hdfcplid ='".$leadID."'";
		list($custIDNum,$Myrow)=MainselectfuncNew($custIDSql,$array = array());
		$i=0;
		
		$name = $Myrow[$i]['name'];
		$age = $Myrow[$i]['age'];
		$email = $Myrow[$i]['email_id'];
		$mobile_number = $Myrow[$i]['mobile_number'];
		$company_name = $Myrow[$i]['company_name'];
		$city = $Myrow[$i]['city'];
		$net_salary = $Myrow[$i]['net_salary'];
		$primary_acc = $Myrow[$i]['primary_acc'];
		$eligible_loanAmt = $Myrow[$i]['eligible_loanAmt'];
		$eligible_interestRate = $Myrow[$i]['eligible_interestRate'];
		$eligible_emi = $Myrow[$i]['eligible_emi'];
		$eligible_term = $Myrow[$i]['eligible_term'];
		$AppID = $Myrow[$i]['AppID'];
		$DOB = $Myrow[$i]['DOB'];
		$expDOB = explode("-", $DOB);
		$dtFormat = $expDOB[2]."/".$expDOB[1]."/".$expDOB[0];

		$termMonths = $eligible_term * 12;
		$Employment_Status = $Myrow[$i]['Employment_Status'];
		if($Employment_Status==1)
		{
			$empStatus = "Salaried";
		}
		else
		{
			$empStatus = "Self Employed";
		}
		if($primary_acc=="HDFC Bank")
		{
			$existingCustomer = "Yes";
		}
		else
		{
			$existingCustomer = "No";
		}
		
		$Total_cost = $eligible_emi * $eligible_term * 12;
		$interest_charged =  $Total_cost - $eligible_loanAmt;
		$taxCal = ($eligible_loanAmt * 2.5) / 100;
		$taxServicedAmt = (($taxCal * 10.3) / 100) + $taxCal;
				
		$eligible_loanAmt = number_format($eligible_loanAmt);
		$eligible_emi = number_format($eligible_emi);
		$interest_charged = number_format($interest_charged);
		$taxServicedAmt = number_format($taxServicedAmt);
		$Total_cost = number_format($Total_cost);
				
	//	echo $Total."--".$interest_charged."--".$taxCal."--".$taxServicedAmt;


		$Message = "<table width='560' border='0' align='center' cellpadding='0' cellspacing='0'>
  <tr>
    <td height='101' align='center' valign='top'><img src='http://www.deal4loans.com/images/mlr-hdr.jpg' width='560' height='101' /></td>
  </tr>
  <tr>
    <td width='560'><table width='560' border='0' align='center' cellpadding='0' cellspacing='0'>
      <tr>
        <td width='1' bgcolor='#7cabda'><img src='http://www.deal4loans.com/images/spacer.gif' width='1'  height='1' border='0' /></td>
        <td><table width='98%' border='0' align='center' cellpadding='0' cellspacing='0'>
          <tr><td align='left'>
<table width='88%' border='0' align='center' cellpadding='0' cellspacing='0'>
<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; ' colspan='2'><hr></td></tr>

<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#061c33; line-height:18px; font-weight:bold;' colspan='2'>Deal4Loans Eligible PL Lead:</td></tr>
<tr><td colspan='2'>&nbsp;</td></tr>
<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; font-weight:bold;' colspan='2'><u>Application Summary</u></td></tr>
<tr><td width='55%' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '><strong>City/Country of residence:</strong></td><td width='45%' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '>".$city."</td>
  </tr>
<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '><strong>Customer mobile number:</strong></td>
<td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '>".$mobile_number."</td></tr>
<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '><strong>Customer landline number:</strong></td>
<td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '> - </td></tr>

<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '><strong>Loan amount:</strong></td>
<td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '>Rs. ".$eligible_loanAmt."</td></tr>

<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '><strong>Total interest charged:</strong></td>
<td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '>".$interest_charged."</td></tr>

<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '><strong>Total fees incl. service tax:</strong></td>
<td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '>Rs. ".$taxServicedAmt."</td></tr>
<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '><strong>Total cost:</strong></td>
<td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '>Rs. ".$Total_cost."</td></tr>
<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '><strong>Tenure:</strong></td>
<td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '>".$eligible_term." years</td></tr>
<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '><strong>Interest rate:<br />
</strong></td><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '>".$eligible_interestRate."</td></tr>
<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '><strong>EMI:<br />
</strong></td><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '>Rs. ".$eligible_emi."</td></tr>

<tr><td colspan='2'>&nbsp;</td></tr>
<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; font-weight:bold;' colspan='2'><u>Detailed Application</u></td>
</tr>
<tr><td width='55%' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '><strong>Application ID :</strong></td>
<td width='45%' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '>".$AppID."</td>
  </tr>
<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '><strong>Requested Loan Type :</strong></td>
<td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '>Personal Loan</td></tr>
<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '><strong>Requested Loan Amount(in Rs.) :</strong></td>
<td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '>Rs. ".$eligible_loanAmt."</td></tr>

<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '><strong>Requested Loan Tenure(in Months) :</strong></td>
<td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '>".$termMonths."</td></tr>

<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '><strong>Interest Rate % :</strong><br>(Monthly Reducing Balance) </td>
<td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '>".$eligible_interestRate."</td></tr>

<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '><strong>Processing Charge inclusive of ST (Rs.) :</strong></td>
<td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '>Rs. ".$taxServicedAmt."</td></tr>
<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '><strong>EMI(in Rs.) :</strong></td>
<td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '>Rs. ".$eligible_emi."</td></tr>
<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '><strong> Name :</strong></td>
<td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '>".$name."</td></tr>
<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '><strong>Gender  :</strong></td>
<td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '> - </td></tr>

<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '><strong>Date Of Birth :</strong></td>
<td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '>".$dtFormat."</td></tr>
<tr><td width='55%' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '><strong>Mobile :</strong></td>
<td width='45%' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '>".$mobile_number."</td>
  </tr><tr>
  <td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '><strong>Time in city(in Months) :</strong></td>
  <td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '> - </td></tr>
<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '><strong>Time in residence(in Months):</strong></td>
<td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '> - </td></tr>

<tr>
  <td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '><strong>Work Email :</strong></td>
  <td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '>".$email."</td></tr>

<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '><strong>Employment Type :</strong></td>
<td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '>".$empStatus."</td></tr>

<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '><strong>Employer (or Company) Name :</strong></td>
<td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '>".$company_name."</td></tr>
<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '><strong>Net Monthly Income :</strong></td>
<td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '>Rs. ".$net_salary."</td></tr>
<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '><strong>Gross Monthly Income :</strong></td>
<td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '> - </td></tr>
<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '><strong>Designation :<br />
</strong></td>
<td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '> - </td></tr>
<tr><td width='55%' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '><strong>Total Work Experience :</strong></td>
<td width='45%' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '> - </td>
  </tr>
<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '><strong>Office Address State :</strong></td>
<td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '> - </td></tr>
<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '><strong>Office Address City :</strong></td>
<td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '>-</td>
</tr>

<tr>
  <td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '><strong>Office Phone :</strong></td>
  <td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '>-</td>
</tr>

<tr>
  <td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '><strong>Current Address :</strong></td>
  <td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '>-</td>
</tr>

<tr>
  <td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '><strong>Current Address State :</strong></td>
  <td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '>-</td>
</tr>
<tr>
  <td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '><strong>Current Address City :</strong></td>
  <td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '>-</td>
</tr>
<tr>
  <td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '><strong>Current Address Pincode :</strong></td>
  <td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '>-</td>
</tr>
<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '><strong>Current Address Phone :<br />
</strong></td>
<td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '>-</td>
</tr>

<tr>
  <td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '><strong>Permanent Address :<br />
</strong></td>
<td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '>-</td>
</tr>
<tr><td width='55%' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '><strong>Permanent Address State :</strong></td>
<td width='45%' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '>-</td>
  </tr>
<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '><strong>Permanent Address City :</strong></td>
<td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '>-</td>
</tr>
<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '><strong>Permanent Address Pincode :</strong></td>
<td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '>-</td>
</tr>

<tr>
  <td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '><strong>Permanent Address Phone :</strong></td>
  <td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '>-</td>
</tr>

<tr>
  <td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '><strong>Pan Number :</strong></td>
  <td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '>-</td>
</tr>

<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '><strong>Existing Customer? :</strong></td>
<td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '>".$existingCustomer."</td>
</tr>

<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; ' colspan='2'><hr></td></tr>
</table> 
</td>
</tr>
<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '>
<b>Regards</b> <br />
Team Deal4loans.com<br />
Loans by choice not by chance!!<br />
</td>
          </tr>
          </table></td>
        <td width='1' bgcolor='#7cabda'><img src='http://www.deal4loans.com/images/spacer.gif' width='1'  height='1' border='0' /></td>
      </tr>
    </table></td>
  </tr>
  <tr>    <td><img src='http://www.deal4loans.com/images/tp_bl-line.gif' width='560' height='20' /></td>

  </tr>
</table>";

//echo $Message;
	//echo $bName."-".$bEmail."-".$bMobile;

			$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
			$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= 'Bcc: neha.gupta@deal4loans.com' . "\r\n";
			$SubjectLine = "Eligible PL Lead @ Deal4Loans.com";
		

$Now = date("Y-m-d H:i:s");
$startTime = date("Y-m-d")." 08:15:00";
$endTime = date("Y-m-d")." 17:00:00";

if($Now > $startTime && $Now < $endTime)
	{		
			$SMSMessage = "Deal4Loans Lead: Cust Name: ".$name." City: ".$city." Net Salary: Rs. ".$net_salary." Eligible Loan Amt: Rs. ".$eligible_loanAmt." MobileNo: ".$mobile_number."";
			
			if(strlen(trim($bMobile)) > 0)
			{
				//$mNumber = 9971396361;
				$mNumber = $bMobile;
	//			SendSMSforLMS($SMSMessage, $mNumber);
			}	
	}
	}
}


?>