<?php
	require 'scripts/db_init.php';
	require 'scripts/functions_nw.php';

sendMails2626();
sendMails2627();
sendMails2628();
sendMails2629();

function sendMails2626()
{
	$getSql = "select * from Req_Compaign where Compaign_ID='2217'";
	 list($recordcount,$Getrow)=MainselectfuncNew($getSql,$array = array());
	
	$Feedback_ID = $Getrow[0]['RequestID'];
	$email = "Anuradha.Vijayan@hdfcbank.com";
	getCityMails(2626,$Feedback_ID,$email,2217);
}

function sendMails2627()
{
	$getSql = "select * from Req_Compaign where Compaign_ID='2218'";
	 list($recordcount,$Getrow)=MainselectfuncNew($getSql,$array = array());
	$Feedback_ID = $Getrow[0]['RequestID'];
	$email = "Chandra.Erappa@hdfcbank.com";
	getCityMails(2627,$Feedback_ID,$email,2218);
}

function sendMails2628()
{
	$getSql = "select * from Req_Compaign where Compaign_ID='2219'";
	list($recordcount,$Getrow)=MainselectfuncNew($getSql,$array = array());
	$Feedback_ID = $Getrow[0]['RequestID'];
	$email = "BEUHL.PBChennai@hdfcbank.com";
	getCityMails(2628,$Feedback_ID,$email,2219);
}

function sendMails2629()
{
	$getSql = "select * from Req_Compaign where Compaign_ID='2220'";
	list($recordcount,$Getrow)=MainselectfuncNew($getSql,$array = array());
	$Feedback_ID = $Getrow[0]['RequestID'];
	$email = "Response.South@hdfcbank.com";
	getCityMails(2629,$Feedback_ID,$email,2220);
}

function DetermineAgeGETDOB ($YYYYMMDD_In)
{
  $yIn=substr($YYYYMMDD_In, 0, 4);
  $mIn=substr($YYYYMMDD_In, 4, 2);
  $dIn=substr($YYYYMMDD_In, 6, 2);
  $ddiff = date("d") - $dIn;
  $mdiff = date("m") - $mIn;
  $ydiff = date("Y") - $yIn;
  if ($mdiff < 0)
  {
	    $ydiff--;
  } 
  elseif ($mdiff==0)
  {
  	 if ($ddiff < 0)
     {
     	 $ydiff--;
     }
  }
  return $ydiff;
}

function getCityMails($getBidderID,$Feedback_ID,$getEmail,$id)
{
echo	$BidderID = $getBidderID;
	echo "<br>";
	echo $bEmail = $getEmail;
	
	$citifinquery="SELECT Name,DOB,Email, Mobile_Number,Std_Code, Landline,Company_Name,City, City_Other,Pincode, Net_Salary, Loan_Any, Loan_Amount, IP_Address,Add_Comment,Allocation_Date, Employment_Status,EMI_Paid,CC_Holder, Primary_Acc, Feedback_ID FROM Req_Feedback_Bidder1,Req_Loan_Personal WHERE Req_Feedback_Bidder1.AllRequestID=Req_Loan_Personal.RequestID and Req_Feedback_Bidder1.BidderID in (".$BidderID.") and Req_Feedback_Bidder1.Reply_Type=1 and Req_Feedback_Bidder1.Feedback_ID>'".$Feedback_ID."'  ";
list($recordcount,$row_result)=MainselectfuncNew($citifinquery,$array = array());

	
	echo "i m in else".$citifinquery."<br><br>";
 
			$cntr=0;

while($cntr<count($row_result))
        {	
		$Feedback_ID = $row_result[$cntr]["Feedback_ID"];
		$name = $row_result[$cntr]["Name"];
		$DOB = $row_result[$cntr]["DOB"];

		$expDOB = explode("-", $DOB);
		$ageFormat = $expDOB[2]."".$expDOB[1]."".$expDOB[0]; 
		$dtFormat = $expDOB[2]."/".$expDOB[1]."/".$expDOB[0];

		$age = DetermineAgeGETDOB($ageFormat);
		$email = $row_result[$cntr]["Email"];
		$mobile_number = $row_result[$cntr]["Mobile_Number"];
		$company_name = $row_result[$cntr]["Company_Name"];
		$city = $row_result[$cntr]["City"];
		$net_salary = $row_result[$cntr]["Net_Salary"];
		$primary_acc = $row_result[$cntr]["Primary_Acc"];
		$eligible_loanAmt = $row_result[$cntr]["Loan_Amount"];
		$termMonths = $eligible_term * 12;
		$Employment_Status = $row_result[$cntr]["Employment_Status"];
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

<tr><td colspan='2'>&nbsp;</td></tr>
<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; font-weight:bold;' colspan='2'><u>Detailed Application</u></td>
</tr>
<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '><strong>Requested Loan Type :</strong></td>
<td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '>Personal Loan</td></tr>
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
			
			
			mail($bEmail, $SubjectLine, $Message, $headers);

		$Now = date("Y-m-d H:i:s");
		$startTime = date("Y-m-d")." 08:15:00";
		$endTime = date("Y-m-d")." 17:00:00";
//		echo "<br>";
	echo $updSql = "update Req_Compaign set RequestID='".$Feedback_ID."' where (Compaign_ID=".$id." and Reply_Type=1 and Sms_Flag=0)";
	
		//echo "<br>";
			$updateSql = mysql_query($updSql);	
$cntr = $cntr +1;	}
	
}


?>