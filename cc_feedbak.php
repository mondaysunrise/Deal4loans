<?php

require 'scripts/db_init.php';
require 'scripts/functions_nw.php';

$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-4, date("Y"));
$currentdate=date('Y-m-d',$tomorrow);
$min_date=$currentdate." 00:00:00";
$max_date=$currentdate." 23:59:59";

$Query="SELECT * FROM Req_Credit_Card WHERE (Dated between '".$min_date."' and '".$max_date."' and Net_Salary>=240000 and Employment_Status=1 ) group by Email";

//$Query="SELECT * FROM Req_Credit_Card WHERE ( Req_Credit_Card.RequestID in (645186) ) group by Email";
echo $Query;
$Result = ExecQuery($Query);

 $NumRows = mysql_num_rows($Result);

  
for($r=0;$r<$NumRows;$r++)
{ 
$EmailID= trim(mysql_result($Result, $r, 'Email'));
$Name = trim(mysql_result($Result, $r, 'Name'));
$city = trim(mysql_result($Result, $r, 'City'));
$Mobile_Number = trim(mysql_result($Result, $r, 'Mobile_Number'));
$net_salary = trim(mysql_result($Result, $r, 'Net_Salary'));
$last_inserted_id = trim(mysql_result($Result, $r, 'RequestID'));
$ProductValue=$last_inserted_id;
$full_name = $Name;
$Net_Salary = $net_salary;
$Pincode = trim(mysql_result($Result, $r, 'Pincode')); 
$Email = $EmailID;
$City = $city;



if($City=="Chandigarh")
	{	$cityid=1 ; }
if($City=="Gurgaon")
	{ $cityid=3; }
if($City=="Ahmedabad")
	{ $cityid=8; }
if($City=="Bangalore")
	{ $cityid=12; }
if($City=="Chennai")
	{ $cityid=13;} 
if($City=="Hyderabad" || $City=="Secunderabad")
	{ $cityid=14; }
if($City=="Mumbai" ||$City=="Navi Mumbai" || $City=="Thane")
	{ $cityid=15; }
if($City=="Pune")
	{ $cityid=16; } 
if($City=="Coimbatore")
	{ $cityid=34; }
if($City=="Jaipur")
	{ $cityid=49; }
if($City=="Kolkata")
	{ $cityid=58; }
if($City=="Noida" || $City=="Greater Noida")
	{ $cityid=71; }
if($City=="Surat")
		{ $cityid=91; }
if($City=="Delhi")
	{ $cityid=157; }
if($City=="Baroda")
		{ $cityid=351; }


$selectcc="Select * From credit_card_banks_eligibility where (cc_bank_citylist like '%".$city."%' and cc_bank_flag=1 and bank_income<= '".$net_salary."') order by cc_bank_fee ASC";
	echo "query1 ".$selectcc."<br><br>";
	$selectccresult = ExecQuery($selectcc);
	$cc_name="";
while($ccexist=mysql_fetch_array($selectccresult))
{
	$cc_name[] = $ccexist['cc_bank_name'];

}

//$strccexist = implode(',',$cc_name);
//echo $strccexist;

$message="<table width='560' border='0' align='center' cellpadding='0' cellspacing='0'>

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
<table width='546' border='0' align='center' cellpadding='0' cellspacing='0'>
          <tr bgcolor='#FFFFFF'>
            <td height='55' valign='middle' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; text-align:justify; color:#032241; line-height:14px;'>Dear Customer,<br />
			Hope your experience in choosing your credit cards has been good @deal4loans.com.
			</td></tr>
			   <tr bgcolor='#FFFFFF'>
            <td height='58' valign='middle' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; text-align:justify; color:#032241; line-height:14px; border:1px solid #c2e5ff; padding:5px;'><form action='http://www.deal4loans.com/emailer/citinkotak_thank.php' method='POST' name='citinkotak'><input type='hidden' name='city' value='".$city."'>
			<input type='hidden' name='requestid' value='".$last_inserted_id."'>
			<input type='hidden' name='net_salary' value='".$net_salary."'>
1) Have you applied your Credit cards on the offers we sent you? <br><input type='radio' name='applied_cc' value='Yes'>Yes <br><input type='radio' name='applied_cc' value='No'>No<br><br>
2) If yes then which card? <br><br>
Card Name <select name='card_name' style='font-size:11px; '><option value='' selected>Please select</option>";
for($i=0;$i<count($cc_name);$i++)
{ 
	//echo $cc_name[$i];
	$message.="<option value='".$cc_name[$i]."'>".$cc_name[$i]."</option>";
}
$message.="</select>
<br><br><input type='submit' value='submit' style='float:right; font-family: Verdana, Arial, Helvetica, sans-serif;	font-size: 12px;	color: #FFFFFF;	background-color: #157097;	border: 1px solid #157097;
	font-weight: bold;'>
</form>
 </td>
          </tr></table>
<tr bgcolor='#FFFFFF'>
<td  ><table width='100%' border='0' align='center' cellpadding='0' cellspacing='0'>
<tr>
<td>"; 
$selectccbanks="Select * From credit_card_banks_eligibility where (cc_bank_citylist like '%".$city."%' and cc_bank_flag=1 and bank_income<= '".$net_salary."') order by cc_bank_fee ASC";
	//echo "query1 ".$selectccbanks."<br><br>";
	$ccbankresult = ExecQuery($selectccbanks);
	$rowscount = mysql_num_rows($ccbankresult);
if($rowscount >0)
{
  $message.="<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; ' align='center'> <table width='100%' border='1' cellspacing='0' cellpadding='0'>
		<tr>
		<td width='65' height='40' bgcolor='#197ad6' style='color: #FFFFFF; text-align:center;font-weight:bold; border-bottom:1px #FFFFFF; font-size:11px;' >Name</td>
		<td width='45' height='40'bgcolor='#197ad6' class='txt-hd' style='color: #FFFFFF; text-align:center;font-weight:bold; border-bottom:1px #FFFFFF; font-size:11px;'>Fee</td>
		
		<td  width='55' height='40' bgcolor='#197ad6' class='txt-hd' style='color: #FFFFFF; text-align:center;font-weight:bold; border-bottom:1px #FFFFFF; font-size:11px;' >Interest Rates</td>
		<td width='235' height='40'bgcolor='#197ad6' class='txt-hd' style='color: #FFFFFF; text-align:center;font-weight:bold; border-bottom:1px #FFFFFF; font-size:11px;' >Features</td>
		<td  width='87' height='40' bgcolor='#197ad6' class='txt-hd' style='color: #FFFFFF; text-align:center;font-weight:bold; border-bottom:1px #FFFFFF; font-size:11px;'  >&nbsp;</td>
			  
			  </tr>";
   
	 while ($row = mysql_fetch_array($ccbankresult))
    { 
        $cc_bank_query  = $row['cc_bank_query'];
		$cc_bankid  = $row['cc_bankid'];
		$cc_bank_url  = $row['cc_bank_url'];
		  $qry2 = $cc_bank_query.' and Req_Credit_Card.RequestID ='.$last_inserted_id;
		 // echo 'query2 '.$qry2.'<br><br>';
		  $result1=ExecQuery($qry2);
        $recordcount = mysql_num_rows($result1);
		if($recordcount>0)
		 {
		 	$i=0;
			while($getrow = mysql_fetch_array($result1))
			 {
			$get_Bank='Select * From credit_card_banks_eligibility Where cc_bankid='.$cc_bankid.' order by cc_bank_fee ASC';
			$get_Bankresult=ExecQuery($get_Bank);
			$getrecordcount = mysql_num_rows($get_Bankresult);
for($j=0;$j<$getrecordcount;$j++)
 { 
	  $message.="<input type='hidden' name='prdct_id' id='prdct_id' value='".$ProductValue."'>
	     <tr>
           <td width='125' height='85' align='center' class='crd_colm_txt' style='border-right:1px solid #fe7e00; color:#000000; font-size:11px;'>";
		   $cc_bank_name = mysql_result($get_Bankresult,$j,'cc_bank_name');
       	    if (strlen($cc_bank_url)>0) { 
		$message.=$cc_bank_name; } else 
		  { 
			$message.=$cc_bank_name;
		  } $message.="</b><td height='85' align='center'  class='crd_colm_txt' style='border-right:1px solid #fe7e00; color:#000000; font-size:11px;'>";
		  $cc_bank_fee =mysql_result($get_Bankresult,$j,'cc_bank_fee');	
	  if($cc_bankid==25)
	  {
	  	$message.="<div style='float:left;'><b>Option I</b> </div><div style='font-size:9px; float:right; padding-left:2px; background-color:#FFFF00; width:20px; color:#FF0000; width:80px;' >*Limited offer</div><br><b>Joining fee</b>: Rs.<span style='text-decoration:line-through;'>1,000</span> Rs.500* <br> <b>Annual fee:</b>  Rs.".$cc_bank_fee."<br><b>Welcome Gift:</b> Satya Paul gifts worth Rs.5,000 <br><br> <b>Option II:</b> Lifetime fee Rs.5,000 <br> <b>Welcome Gift:</b> Bose Headphones";
	  }
	  else if($cc_bankid==26)
	  {
	  $message.="<b>Option I:</b> Rs.".$cc_bank_fee." + Joining fee Rs.5,000 <br><b>Welcome Gift:</b> Bose Headphones  <br><br> <b>Option II:</b> Lifetime fee Rs.25,000 <br> <b>Welcome Gift:</b> Apple iPad2";
	  }
	  else if($cc_bankid==27)
	  {
	  $message.="<b>Option I:</b> Rs.".$cc_bank_fee." + Joining fee Rs.25,000 <br><b>Welcome Gift:</b> Apple iPad2 <br><br> <b>Option II:</b> Lifetime fee Rs.75,000 <br> <b>Welcome Gift:</b>Apple Macbook Air ";
	  	
	  }
	  else if($cc_bankid==29)
		  {
		 $message.="<div style='font-size:9px; padding-left:2px; background-color:#FFFF00; width:20px; color:#FF0000; width:80px;' >*Exclusive offer</div><br><b>Joining fee</b>: Rs.<span style='text-decoration:line-through;'>199</span> Nil* <br> <b>Annual fee:</b>  Rs.".$cc_bank_fee."<br><br />
*Only for Deal4loans customer";
		  }
	  else
	  {
	  $message.="<b>Rs.".$cc_bank_fee."</b>"; }
	  $message.="</td>    <td height='85' align='center'  class='crd_colm_txt' style='border-right:1px solid #fe7e00; color:#000000;font-size:11px;'><b>";
	  $cc_bank_rates =mysql_result($get_Bankresult,$j,'cc_bank_rates');	
	   $message.=$cc_bank_rates;	
	   $message.="</b></td>     <td height='85' align='left' valign='middle' class='crd_colm_txt' style='border-right:1px solid #fe7e00; color:#000000; padding-left:0px; font-size:11px; !important'>
	   ".$cc_bank_features = mysql_result($get_Bankresult,$j,'cc_bank_new_features')."</td>
	 <td width='143' height='85' align='center' >";	
	 
		if($cc_bankid==13)
		  {	
			
		  $message.="<a href='https://apply.standardchartered.co.in/credit-card?selectedCardId=5&se=deal4loans&cp=SCB_CreditCards_Display_SCB&ag=SCB_EM&kd=rx_mailer&complete_name=".$full_name."&cityId=".$cityid."&employmentTypeId=1&dateOfBirth=".$Dobn."&annualIncome=".$Net_Salary."&mobileNo=".$Mobile_Number."&pincode=".$Pincode."&emailId=".$Email."&employerName=wrsinfo' target='_blank'><img src='http://www.deal4loans.com/new-images/apl-yelo.gif'  width='87' height='25' border='0' onClick='insertData(".$i.");'/></a>";
			}
			else if($cc_bankid==19)
			{
			$message.="<a href='https://apply.standardchartered.co.in/credit-card?selectedCardId=4&se=deal4loans&cp=SCB_CreditCards_Display_SCB&ag=SCB_EM&kd=rx_mailer&complete_name=".$full_name."&cityId=".$cityid."&employmentTypeId=1&dateOfBirth=".$Dobn."&annualIncome=".$Net_Salary."&mobileNo=".$Mobile_Number."&pincode=".$Pincode."&emailId=".$Email."&employerName=wrsinfo' target='_blank'><img src='http://www.deal4loans.com/new-images/apl-yelo.gif'  width='87' height='25' border='0' onClick='insertData(".$i.");'/></a>";
			}
else if($cc_bankid==21)
			{
		$message.="<a href='https://apply.standardchartered.co.in/credit-card?selectedCardId=6&se=deal4loans&cp=SCB_CreditCards_Display_SCB&ag=SCB_EM&kd=rx_mailer&complete_name=".$full_name."&cityId=".$cityid."&employmentTypeId=1&dateOfBirth=".$Dobn."&annualIncome=".$Net_Salary."&mobileNo=".$Mobile_Number."&pincode=".$Pincode."&emailId=".$Email."&employerName=wrsinfo' target='_blank'><img src='http://www.deal4loans.com/new-images/apl-yelo.gif'  width='87' height='25' border='0' onClick='insertData(".$i.");'/></a>";
			}
			else if (($cc_bankid==10 || $cc_bankid==16 || $cc_bankid==15 || $cc_bankid==28 || $cc_bankid==22 || $cc_bankid==15 || $cc_bankid==30))
		  {
			$message.="<form action='http://www.deal4loans.com/apply-hdfc-credit-card1.php' method='POST' target='_blank' >
			<input type='hidden' name='crd_nme' id='crd_nme' value='".$cc_bank_name."'>
			 <input type='hidden' name='cc_bankid' value='".$cc_bankid."' id='cc_bankid'>
		    <input type='hidden' name='RequestID' id='RequestID' value='".$ProductValue."'>
			<input type='image' name='Submit' src='http://www.deal4loans.com/new-images/apl-yelo.gif' style='width:87px; height:25px; border:none;' onClick='insertData(".$i.");'>			    </form>";
		 }
		else if ($cc_bankid==20)
		  {
			$message.="<form action='http://www.deal4loans.com/dcb_payless_credit_card.php' method='POST' target='_blank' >
			<input type='hidden' name='crd_nme' id='crd_nme' value='".$cc_bank_name."'>
			 <input type='hidden' name='cc_bankid' value='".$cc_bankid."' id='cc_bankid'>
		    <input type='hidden' name='RequestID' id='RequestID' value='".$ProductValue."'>
					  <input type='image' name='Submit' src='http://www.deal4loans.com/new-images/apl-yelo.gif' style='width:87px; height:25px; border:none;' onClick='insertData(".$i.");'> </form>";
		 }
		  else if ($cc_bankid==23 || $cc_bankid==24 || $cc_bankid==25 || $cc_bankid==26 || $cc_bankid==27 || $cc_bankid==29)
		  {
			$message.="<form action='http://www.deal4loans.com/apply-icici-credit-card1.php' method='POST' target='_blank' >
			<input type='hidden' name='crd_nme' id='crd_nme' value='".$cc_bank_name."'>
			 <input type='hidden' name='cc_bankid' value='".$cc_bankid."' id='cc_bankid'>
		    <input type='hidden' name='cityval' id='cityval' value='".$City."'>			<input type='hidden' name='RequestID' id='RequestID' value='".$ProductValue."'>					  <input type='image' name='Submit' src='http://www.deal4loans.com/new-images/apl-yelo.gif' style='width:87px; height:25px; border:none;' onClick='insertData(".$i.");'>			    </form>";
		  }
			else
		  {
		  if($cc_bankid==32 || $cc_bankid==33)
			  { 
$message.="<a href='".$cc_bank_url."?RequestID=".$ProductValue."' target='_blank'><img src='http://www.deal4loans.com/new-images/apl-yelo.gif' width='87' height='25' border='0' onClick='insertData(".$i.");'/></a>";
			 }
			else
			{
		  	$message.="<a href='".$cc_bank_url."' target='_blank'><img src='http://www.deal4loans.com/new-images/apl-yelo.gif' width='87' height='25' border='0' onClick='insertData(".$i.");'/></a>";
			 	}
				} 
				$message.="</td>   </tr> <tr><td height='3' colspan='8' align='center' valign='middle' style='background:url(http://www.deal4loans.com/new-images/cc/crd-line.jpg);'></td>
	  <td width='1' height='3' align='left' valign='middle' style='background:url(http://www.deal4loans.com/new-images/cc/crd-line.jpg);'></td>
    </tr>";
}
			  }
    
	  }
	}
	 $message.="</table></td></tr>";
	 $message.="<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '>
			  If you havent applied them,Click on the above links to apply for your set of Credit Cards.It will Just take two minutes to apply for your Credit card.Just make sure you have your Pan card number handy with you.<br><br></td></tr>";

	  }
  $message.="</td>
</tr>
</table></td>
</tr>
<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '>Regards,<br>Deal4loans.com</td></tr>
</table></td>
</tr>
<tr>
<td width='560' height='22' ><img src='http://www.deal4loans.com/emailer/cc-mailer09/crd-btmline.gif' width='560' height='22' /></td>
</tr>
</table></td>
</tr>

</table>";
//echo $message;


$subject ="Your Credit Card Application!";

	$headers = "From: deal4loans <live@loansbychoice.com>";
	$semi_rand = md5( time() ); 
	$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 
	$headers .= "\nMIME-Version: 1.0\n" . 
	"Content-Type: multipart/mixed;\n" . 
	" boundary=\"{$mime_boundary}\""."\n";
	//$headers .= "Bcc: extra4testing@gmail.com "."\n";
	$messagecc = "This is a multi-part message in MIME format.\n\n" . 
	"--{$mime_boundary}\n" . 
	"Content-Type: text/html; charset=\"iso-8859-1\"\n" . 
	"Content-Transfer-Encoding: 7bit\n\n" . 
	$message . "\n\n";
if($NumRows>0 && strlen($EmailID)>0)
	{
	echo $r."ranjana<br>";
//mail($EmailID,$subject, $messagecc, $headers);
	}
}
?>