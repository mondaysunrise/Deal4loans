<?php
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
$RequestID = $_REQUEST['Lid'];


	$getDocSql = "select * from fil_appointments where RequestID = '".$RequestID."'";
	 list($recordcount,$getrow)=MainselectfuncNew($getDocSql,$array = array());
		$jj=0;
	
//	$getDocQuery = ExecQuery($getDocSql);
	$jj=0;
	$id =$getrow[$jj]['id'];
	$address_apt  = $getrow[$jj]['address_apt'];
	$RequestID = $getrow[$jj]['RequestID'];
	$appdate  = $getrow[$jj]['appdate'];
	$changeapp_time  = $getrow[$jj]['changeapp_time'];
	$time = '';
				if($changeapp_time=="08:00:00")
				{
					$time =  "8(am)-9(am)";
				}	
				else if($changeapp_time=="09:00:00")
				{
					$time =  "9(am)-10(am)";
				}
				else if($changeapp_time=="10:00:00")
				{
					$time =  "10(am)-11(am)";
				}
				else if($changeapp_time=="11:00:00")
				{
					$time =  "11(am)-12(pm)";
				}
				else if($changeapp_time=="12:00:00")
				{
					$time =  "12(pm)-1(pm)";
				}
				else if($changeapp_time=="13:00:00")
				{
					$time =  "1(pm)-2(pm)";
				}
				else if($changeapp_time=="14:00:00")
				{
					$time =  "2(pm)-3(pm)";
				}
				else if($changeapp_time=="15:00:00")
				{
					$time =  "3(pm)-4(pm)";
				}
				else if($changeapp_time=="16:00:00")
				{
					$time =  "4(pm)-5(pm)";
				}
				else if($changeapp_time=="17:00:00")
				{
					$time =  "5(pm)-6(pm)";
				}
				else if($changeapp_time=="18:00:00")
				{
					$time =  "6(pm)-7(pm)";
				}
				else if($changeapp_time=="19:00:00")
				{
					$time =  "7(pm)-8(pm)";
				}
				
		
	$docs = $getrow[$jj]['docs'];
	$Reply_Type = $getrow[$jj]['Reply_Type'];	

	$getBiddersSql = "select Bidders_List.BidderID as BidderID, Req_Feedback_Bidder1.AllRequestID as AllRequestID from Req_Feedback_Bidder1 left join Bidders_List on Bidders_List.BidderID=Req_Feedback_Bidder1.BidderID where Req_Feedback_Bidder1.AllRequestID='".$RequestID."' and Bidders_List.BankID='17' and Req_Feedback_Bidder1.Reply_Type='1'";
	//$getBiddersQuery = ExecQuery($getBiddersSql);
	
	 list($recordcount,$Arrrow)=MainselectfuncNew($getBiddersSql,$array = array());
		$k=0;
	
	
	//echo "<br>".$getBiddersSql."<br>";	
	$BidID = $Arrrow[$k]['BidderID'];
	//echo "<br>".$BidderID;
	$getCustomerSql = "select * FROM Req_Loan_Personal where  RequestID = '".$RequestID."' ";
	 list($recordcount,$Myrow)=MainselectfuncNew($getCustomerSql,$array = array());
		$j=0;
	
	//$getCustomerQuery = ExecQuery($getCustomerSql);
	$Name = $Myrow[$j]['Name'];
	$Mobile_Number = $Myrow[$j]['Mobile_Number'];
	$City = $Myrow[$j]['City'];
	if($City=="Others")
	{
		$City = $Myrow[$j]['City_Other'];
	}
	
	$getBidderSql = "select * FROM Bidders where  BidderID = '".$BidID."' ";
	 list($recordcount,$getMyrow)=MainselectfuncNew($getBidderSql,$array = array());
		$m=0;
	
	
	//$getBidderQuery = ExecQuery($getBidderSql);
	$BidderName = $getMyrow[$m]['Bidder_Name'];
	$Bid_Email = $getMyrow[$m]['BidderEmailID'];
	
	
	$getSmsSql = "SELECT * FROM `Req_Compaign` where BidderID = '".$BidID."'";	
	list($recordcount,$ArrMyrow)=MainselectfuncNew($getSmsSql,$array = array());
		$p=0;

	//$getSmsQuery = ExecQuery($getSmsSql);
	$BidMobile_no = $ArrMyrow[$p]['Mobile_no'];
	$Sms_Flag =$ArrMyrow[$p]['Sms_Flag'];
	if($Sms_Flag==1)
	{
		$smsValid = "Send SMS";
	}
	else
	{
		$smsValid = "Cannot Send SMS";
	}
?>
<style>
.bidderclass
{
Font-family:Comic Sans MS;
font-size:13px;
}
.style1 {
	font-family: verdana;
	font-size: 12px;
	font-weight: bold;
	color:#084459;
}
.style2 {
	font-family: verdana;
	font-size: 11px;
	font-weight: bold;
	color:#084459;
}

.style3 {
	font-family: verdana;
	font-size: 11px;
	font-weight: normal;
	color:#084459;
	text-decoration:none;
}


.bluebtn{
font-family:Verdana, Arial, Helvetica, sans-serif; 
font-size:12px;
font-weight:bold;
color:#084459;
border:1px solid #084459;
background-color:#FFFFFF;
}

</style>

<form action="submit_editAppointment.php" method="post" name="appt">

<table width="560" border="0" align="center" cellpadding="3" cellspacing="4" bgcolor="#FFFFFF" >
   <tr>
     <td style="border-bottom:1px solid #45B2D8;" colspan="2" align="center"><strong>Appointment</strong></td>
  </tr>
<tr  bgcolor="#DFF6FF" class="style3">
		<td width="165" align="left" bgcolor="#DFF6FF" class="style3"><strong>BidderID</strong></td>
        <td width="388" align="left" bgcolor="#DFF6FF" class="style3"><?php echo $BidID; ?>&nbsp;</td>
   </tr>  <tr  bgcolor="#DFF6FF" class="style3">
      <td align="left" bgcolor="#DFF6FF" class="style3"><strong>BidderName</strong></td>
	 <td bgcolor="#DFF6FF" class="style3" align="left"><?php echo $BidderName; ?>&nbsp;&nbsp;&nbsp;<?php
		if($smsValid == "Send SMS")
		{
		 	echo $BidMobile_no;
		}
		else
		{
			echo '<b style="color:#FF0000;">SMS Inactive</b>';
		}
		  ?>&nbsp; </td>
</tr>
<tr  bgcolor="#DFF6FF" class="style3">
<td align="left" bgcolor="#DFF6FF" class="style3"><strong>Customer Name</strong></td>
	<td bgcolor="#DFF6FF" class="style3" align="left"><?php echo $Name; ?>&nbsp;&nbsp;&nbsp;<?php echo $Mobile_Number; ?>&nbsp;</td>
	      </tr>  <tr  bgcolor="#DFF6FF" class="style3">
          <td align="left" bgcolor="#DFF6FF" class="style3"><strong>City</strong></td>
    	<td bgcolor="#DFF6FF" class="style3" align="left"><?php echo $City; ?>&nbsp;</td>
      </tr>  <tr  bgcolor="#DFF6FF" class="style3">
      <td align="left" bgcolor="#DFF6FF" class="style3"><strong>Appointment Address</strong></td>
   		<td bgcolor="#DFF6FF" class="style3" align="left"><?php echo $address_apt; ?>&nbsp;</td>
		      </tr>  <tr  bgcolor="#DFF6FF" class="style3">
              <td align="left" bgcolor="#DFF6FF" class="style3"><strong>Date & Time</strong></td>
        <td bgcolor="#DFF6FF" class="style3" align="left"><?php echo $appdate.' - '.$time; ?>&nbsp;</td>
      </tr>
        <tr  bgcolor="#DFF6FF" class="style3">
        <td align="left" bgcolor="#DFF6FF" class="style3"><strong>Documents</strong></td>
		<td bgcolor="#DFF6FF" class="style3" align="left">
		<input type="hidden" name="RequestID" id="RequestID" value="<?php echo $RequestID; ?>">
        <input type="hidden" name="BidID" id="BidID" value="<?php echo $BidID; ?>">
        <input type="hidden" name="BidderName" id="BidderName" value="<?php echo $BidderName; ?>">
        <input type="hidden" name="Mobile_Number" id="Mobile_Number" value="<?php echo $Mobile_Number; ?>">
        <input type="hidden" name="Name" id="Name" value="<?php echo $Name; ?>">
        <input type="hidden" name="City" id="City" value="<?php echo $City; ?>">
        <input type="hidden" name="address_apt" id="address_apt" value="<?php echo $address_apt; ?>">
        <input type="hidden" name="appdate" id="appdate" value="<?php echo $appdate; ?>">
        <input type="hidden" name="time" id="time" value="<?php echo $time; ?>">
        <input type="hidden" name="docs" id="docs" value="<?php echo $docs; ?>">
		
		<?php echo $docs; ?></td>	
	</tr>
      <tr  bgcolor="#DFF6FF" class="style3">
      <td align="left" bgcolor="#DFF6FF" class="style3"><strong>Bidders Mobile</strong></td>
		<td bgcolor="#DFF6FF" class="style3" align="left"><input type="text" name="b_mobile" id="b_mobile" value="<?php echo $BidMobile_no; ?>"></td>	
	</tr>
      <tr  bgcolor="#DFF6FF" class="style3">
      <td align="left" bgcolor="#DFF6FF" class="style3"><strong>Bidders Email</strong></td>
		<td bgcolor="#DFF6FF" class="style3" align="left"><input type="text" name="b_email" id="b_email" value="<?php echo $Bid_Email; ?>"></td>	
	</tr>
     <tr  bgcolor="#DFF6FF" class="style3">
      <td align="left" bgcolor="#DFF6FF" class="style3" style="padding-left:20px;">&nbsp;</td>
		<td bgcolor="#DFF6FF" class="style3" align="left">&nbsp;&nbsp;&nbsp;<input type="checkbox" name="send_email" value="email"> Send Email &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="checkbox" name="send_sms" value="sms"> Send SMS</td>	
	</tr>
     <tr  bgcolor="#DFF6FF" class="style3">
      <td align="left" bgcolor="#DFF6FF" class="style3" style="padding-left:20px;">&nbsp;</td>
		<td bgcolor="#DFF6FF" class="style3" align="left"><input type="submit" name="submit" value="Submit" class="bluebtn"></td>	
	</tr>
    
    
    
    </table>
</form>