<?php
//require 'scripts/session_check_online.php';
require 'scripts/db_init.php';
//edit-personal-details.php?postid=2030280&biddt=5060
$requestid = $_REQUEST["postid"];
$bidderid = $_REQUEST["biddt"];
//$requestid =1114214;
//$bidderid = 1037;
$pldetails = "select  	Company_Type,Salary_Drawn,Employment_Status,Residential_Status,EMI_Paid,Card_Vintage,CC_Holder,Dated,DOB,Name,Email,Company_Name,City,City_Other,Years_In_Company,Total_Experience,Mobile_Number,Net_Salary,Loan_Any,Loan_Amount,PL_EMI_Amt,Pincode,Card_Limit,IP_Address,Add_Comment from Req_Loan_Personal Where (RequestID=".$requestid.")";
//echo $pldetails."<br>";
$pldetailsresult = ExecQuery($pldetails);
$plrow=mysql_fetch_array($pldetailsresult);


$pl_alldetails = ExecQuery("select * from Req_Feedback_Bidder_PL Where (AllRequestID=".$requestid." and BidderID=".$bidderid.")");
//echo $pldetails."<br>";
$plrowal=mysql_fetch_array($pl_alldetails);

if($plrow["Annual_Turnover"]==1) { $annual_turnover="0-40 Lacs"; } 
else if($plrow["Annual_Turnover"]==2) { $annual_turnover="1Cr - 3Crs"; } 
else if($plrow["Annual_Turnover"]==3) { $annual_turnover="3Crs & above"; } 
else if($plrow["Annual_Turnover"]==4) { $annual_turnover="40Lacs To 1 Cr"; } 
else { $annual_turnover="";  }

if($plrow["Employment_Status"]==0) { $emp_status="Self Employed"; } else { $emp_status="Salaried"; }

if($plrow["CC_Holder"]==1) { $cc_holder="Yes"; }  if($plrow["CC_Holder"]==0) { $cc_holder="No"; }
		
			if($plrow["EMI_Paid"]==1){ $emi_paid="Less than 6 months";}
			elseif($plrow["EMI_Paid"]==2) {  $emi_paid="6 to 9 months"; }
			elseif($plrow["EMI_Paid"]==3){  $emi_paid="9 to 12 months"; }
			elseif($plrow["EMI_Paid"]==4){  $emi_paid="more than 12 months"; }
			else
			{ $emi_paid="";
			}
			if($plrow["Card_Vintage"]==1)	{	$card_vintage="Less than 6 months";}
			elseif($plrow["Card_Vintage"]==2)	{	$card_vintage="6 to 9 months";}
		elseif($plrow["Card_Vintage"]==3)	{	$card_vintage="9 to 12 months";}
		elseif($plrow["Card_Vintage"]==4)		{	$card_vintage="more than 12 months";}
		else
			{
				$card_vintage="";
			}

if($plrow["Company_Type"]==0)	{	$Company_Type="";}
if($plrow["Company_Type"]==1)	{	$Company_Type="Pvt Ltd";}
if($plrow["Company_Type"]==2)	{	$Company_Type="MNC Pvt Ltd";}
if($plrow["Company_Type"]==3)	{	$Company_Type="Limited";}
if($plrow["Company_Type"]==4)	{	$Company_Type="Govt.( Central/State )";}
if($plrow["Company_Type"]==5)	{	$Company_Type="PSU (Public sector Undertaking)";}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Personal Loan</title>
<style type="text/css">
<!--
.style2 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold;}
.style21 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size:12px;}
-->
</style>
<? if($bidderid==5108)
{
}
else
{ ?>
<script type="text/JavaScript">
function killCopy(e){ return false; }
function reEnable(){return true; }
document.onselectstart=new Function ("return false");
if (window.sidebar){ document.onmousedown=killCopydocument.onclick=reEnable }
function clickIE4(){if (event.button==2){ return false; } }
function clickNS4(e){ if (document.layers||document.getElementById&&!document.all){ if (e.which==2||e.which==3){ return false;} } }
if (document.layers){ document.captureEvents(Event.MOUSEDOWN); document.onmousedown=clickNS4; } else if (document.all&&!document.getElementById){ document.onmousedown=clickIE4; }
document.oncontextmenu=new Function("return false")
</script>
<? } ?>
</head>

<body>
<table style='border:1px dotted #9C9A9C;' cellspacing="2" cellpadding="5" width="841" height="80%" align="center" border="0" >
  <tr>
      <td colspan="4" align="center" bgcolor="#F0F0F0" class="heading" style="border-top:1px solid #CCC; border-bottom:1px solid #CCC;"><strong>Personal Details</strong></td>
    </tr>
 <tr>
      <td width="202" valign="top"> <strong>Customer Name</strong></td>
   <td  width="181" align="left" valign="top"><? echo $plrow["Name"]; ?></span></td>
<td  width="178" valign="top"><strong> DOB: </strong></td>
     <td  width="228"><? echo $plrow["DOB"]; ?></td>
  </tr>
     <tr>
       <td valign="top" bgcolor="#F0F0F0" ><strong> Email: </strong></td>
       <td align="left" valign="top" bgcolor="#F0F0F0" ><? echo $plrow["Email"]; ?></td>
  <td valign="top" bgcolor="#F0F0F0" ><strong> Mobile No:</strong></td>
      <td bgcolor="#F0F0F0" ><? echo $plrow["Mobile_Number"]; ?></td>
  </tr>
     <tr>
        <td><span class="style2"> Occupation: </span></td>
       <td><span class="style21"><? echo $emp_status; ?></span></td>
         <td><span class="style2"> City: </span></td>
    <td><span class="style21"><? echo $plrow["City"]; ?></span></td>
  </tr>
     <tr>
        <td  valign="top" bgcolor="#F0F0F0"><span class="style2"> Other City: </span></td>
       <td align="left" valign="top" bgcolor="#F0F0F0"><span class="style21"><? echo $plrow["City_Other"]; ?></span></td>
 
        <td  valign="top" bgcolor="#F0F0F0"><span class="style2"> Pincode: </span></td>
       <td align="left" valign="top" bgcolor="#F0F0F0"><span class="style21"><? echo $plrow["Pincode"]; ?></span></td>
  </tr>
     <tr>
        <td><span class="style2"> Company Name: </span></td>
       <td><span class="style21"><? echo $plrow["Company_Name"]; ?></span></td>
        <td><span class="style2"> Company Type: </span></td>
        <td><span class="style21"><? echo $Company_Type;?></span></td>
     </tr>

    
     <tr>
        <td valign="top" bgcolor="#F0F0F0"><strong> Card Holder:</strong> </td>
        <td  valign="top" bgcolor="#F0F0F0"><? echo $cc_holder; ?></td>
        <td  valign="top" bgcolor="#F0F0F0"><strong>Card Vintage:</strong> </td>
        <td valign="top" bgcolor="#F0F0F0"><? echo $card_vintage; ?></td>
     </tr>
     
      <tr>
        <td><span class="style2"> Annual Income: </span></td>
        <td><span class="style21"><? echo $plrow["Net_Salary"]; ?></span></td>
 
        <td><span class="style2"> Annual Turnover: </span></td>
        <td><span class="style21"><? echo $annual_turnover; ?></span></td>

     <tr>
        <td valign="top" bgcolor="#F0F0F0"><strong> Loan Running:</strong> </td>
        <td valign="top" bgcolor="#F0F0F0"><? echo $plrow["Loan_Any"]; ?></td>
        <td valign="top" bgcolor="#F0F0F0"><strong>Total EMI Paid: </strong></td>
        <td valign="top" bgcolor="#F0F0F0"><? echo $emi_paid; ?></td>
    
     </tr>
      <tr>
        <td><span class="style2">Required Loan Amount: </span></td>
        <td><span class="style21"><? echo $plrow["Loan_Amount"]; ?></span></td>
          <td><span class="style2">Current Account Bank: </span></td>
        <td><span class="style21"><? echo $plrow["Primary_Acc"]; ?></span></td>
     </tr>
     <tr>
        <td valign="top" bgcolor="#F0F0F0"><span class="style2">Comments: </span></td>
        <td valign="top" bgcolor="#F0F0F0"><span class="style21"><? echo $plrow["Add_Comment"]; ?></span></td>
    
        <td valign="top" bgcolor="#F0F0F0"><span class="style2">Date of entry: </span></td>
        <td valign="top" bgcolor="#F0F0F0"><span class="style21"><? echo $plrowal["Allocation_Date"]; ?></span></td>
  </tr>
  <tr><td colspan="4"></td></tr>
  <tr><td colspan="4">
  
  
        <form method="POST" action="/editbllead_continue.php" name="sendform_<? echo  $FinalBidder[$i];?>" target="_blank">
				<input type="hidden" name="callerid" id="callerid" value="<? echo $bidid;?>">
				<input type="hidden" name="reqcity" id="reqcity" value="<? echo $City;?>">
				<input type="hidden" name="plrequestid" id="plrequestid" value="<? echo $post;?>">
				<input type='hidden' value='<?php echo $plsmsld["Mobile_no"]; ?>' name='Bidder_Number' id='Bidder_Number'>

        <table width="100%" border="0" cellspacing="1" cellpadding="0" style="border:#333 2px solid;" >
      
           <tr>
      <td colspan="4">&nbsp;</td>
    </tr>
     
        <tr>
          <td colspan="4">
          <table width="100%" style="border:#00F dashed 2px;">
        <tr>  <td bgcolor="#DAEAF9" colspan="2"><strong>Remarks</strong></td><td width="28%" bgcolor="#DAEAF9"><strong>Select Date</strong></td><td width="23%" bgcolor="#DAEAF9"><strong>Select Time Slab</strong></td></tr>
        <tr>  <td bgcolor="#FFFFFF" colspan="2"><textarea rows="2" cols="55" name="special_remarks" id="special_remarks_3" onchange="NosplcharComment(this);"></textarea></td>
          <td bgcolor="#FFFFFF" valign="top"><input type="Text" name="appointment_date" id="appointment_date_3" maxlength="25" value="" size="15" ><a href="javascript:NewCal('appointment_date_3','yyyymmdd',true,24)"><img src="/images/cal.gif" width="16" height="16" border="0" alt="Pick a date"></a></td>
          <td bgcolor="#FFFFFF" valign="top"><select name="appointment_time" id="appointment_time"  class="inputsms" style="width:170px;">
		    <option value="please select">Time slab</option>
		    <option value="8(am)-9(am)">8(am)-9(am)</option>
		    <option value="9(am)-10(am)">9(am)-10(am)</option>
		    <option value="10(am)-11(am)">10(am)-11(am)</option>
		    <option value="11(am)-12(am)">11(am)-12(am)</option>
		    <option value="12(am)-1(pm)">12(am)-1(pm)</option>
		    <option value="1(pm)-2(pm)">1(pm)-2(pm)</option> 
		    <option value="2(pm)-3(pm)">2(pm)-3(pm)</option>
		    <option value="3(pm)-4(pm)">3(pm)-4(pm)</option>
		    <option value="4(pm)-5(pm)">4(pm)-5(pm)</option>
		    <option value="5(pm)-6(pm)">5(pm)-6(pm)</option>
		    <option value="6(pm)-7(pm)">6(pm)-7(pm)</option>
		    <option value="7(pm)-8(pm)">7(pm)-8(pm)</option>
	    </select></td>
        </tr>
         <tr><td colspan="4" bgcolor="#DAEAF9"  ><b>Documents for <?php echo $finalBidderName[$i]; ?> </b></td></tr>
<tr>
	<td width="11%" class="fontstyle"><b>ID Proof</b></td>
	<td width="38%" class="fontstyle">   
    <select name="IDProof" id="IDProof">
    	<option value="">Please Select</option>
		<option value="Passport" <?php if(trim($identification_proof)=="Passport") {echo "Selected";} ?> >Passport</option>
		<option value="PANCard" <?php if(trim($identification_proof)=="PANCard") {echo "Selected";} ?>>PAN Card</option>
		<option value="VoterID Card" <?php if(trim($identification_proof)=="VoterID Card") {echo "Selected";} ?>>Voter ID Card</option>
		<option value="ElectionID Card" <?php if(trim($identification_proof)=="ElectionID Card") {echo "Selected";} ?>>Election ID Card</option>
		
	</select>
	</td>
	<td class="fontstyle"><b>Address proof</b></td>
	<td class="fontstyle"><select name="AddressProof" id="AddressProof">
    <option value="">Please Select</option>
		<option value="Passport" <?php if(trim($residence_proof)=="Passport") {echo "Selected";} ?>>Passport</option>
		<option value="Bank Statement" <?php if(trim($residence_proof)=="Bank Statement") {echo "Selected";} ?>>Bank Statement</option>
		<option value="Utility Bill" <?php if(trim($residence_proof)=="Utility Bill") {echo "Selected";} ?>>Utility Bill</option>
		<option value="Gas Receipt" <?php if(trim($residence_proof)=="Gas Receipt") {echo "Selected";} ?>>Gas Receipt</option>
		<option value="Rent Agreement" <?php if(trim($residence_proof)=="Rent Agreement") {echo "Selected";} ?>>Rent Agreement</option>
       
	</select></td>
</tr>
<tr>
	<td class="fontstyle"><b>PAN Card</b></td>
	<td class="fontstyle">    
    <input type="radio" name="PanCard" id="PanCard" value="PANCard" <?php if((strlen(strpos($income_proof, "PANCard")) > 0)) echo "checked"; ?>> Yes &nbsp;&nbsp;<input type="radio" name="PanCard" id="PanCard2" value="">No
    
	</td>
	<td class="fontstyle"><b>3 Month Sal Slip</b></td>
	<td class="fontstyle">
     <input type="radio" name="SalSlip" id="SalSlip" value="3 Month SalSlip" <?php if((strlen(strpos($income_proof, "3 Month SalSlip")) > 0)) echo "checked"; ?>> Yes &nbsp;&nbsp;<input type="radio" name="SalSlip" id="SalSlip2" value="">No
   </td>
</tr>
<tr>
	<td class="fontstyle"><b>6 Month Bank Statement</b></td>
	<td>
    <input type="radio" name="BankStmnt" id="BankStmnt" value="6 Month Bank Statement" <?php if((strlen(strpos($income_proof, "6 Month Bank Statement")) > 0)) echo "checked"; ?>> Yes &nbsp;&nbsp;<input type="radio" name="BankStmnt" id="BankStmnt2" value="">No    
	</td>
	<td class="fontstyle"><b>2 Passport Size Photo</b></td>
	<td class="fontstyle">
      <input type="radio" name="PassSizePhoto" id="PassSizePhoto" value="2 Passport Size Photo" <?php if((strlen(strpos($income_proof, "2 Passport Size Photo")) > 0)) echo "checked"; ?>> Yes &nbsp;&nbsp;<input type="radio" name="PassSizePhoto" id="PassSizePhoto2" value="">No
    </td>
</tr>    
       <tr><td colspan="4" align="right"><input type="submit" name="submit_appdt" value="Save" style="background-color:#036; color:#fff; font-size:17px;"></td></tr> 
       </table></td></tr>
        <tr>
          <td colspan="4">
          <table width="100%" style="border:#00F groove 1px;">
          <tr>
          <td colspan="4">
       <?php
	    $getApptDetailsSql = "select * from zexternal_appointment_details where AllRequestID='".$post."' and BidderID  = '".$FinalBidder[$i]."'";
		$getApptDetailsresCount = $objAdmin->fun_get_num_rows($getApptDetailsSql);
		$getApptDetailsQry = $obj->fun_db_query($getApptDetailsSql);
		$DocsArr = '';
		if($getApptDetailsresCount>0)
		{
		$DocsArr = '';
		while($rowApptDetails = $obj->fun_db_fetch_rs_object($getApptDetailsQry))			
	   	{
			$DocsArr = '';
			
			if(strlen($rowApptDetails->IDProof)>0) { $DocsArr[] =$rowApptDetails->IDProof; }
			if(strlen($rowApptDetails->AddressProof)>0) { $DocsArr[] =$rowApptDetails->AddressProof; }
			if(strlen($rowApptDetails->PanCard)>0) { $DocsArr[] =$rowApptDetails->PanCard; }
			if(strlen($rowApptDetails->SalSlip)>0) { $DocsArr[] =$rowApptDetails->SalSlip; }
			if(strlen($rowApptDetails->BankStmnt)>0) { $DocsArr[] =$rowApptDetails->BankStmnt; }
			if(strlen($rowApptDetails->PassSizePhoto)>0) { $DocsArr[] =$rowApptDetails->PassSizePhoto; }
	   ?>
     <table width="100%" style="border:#000 1px solid;" >
        <tr>  <td bgcolor="#DAEAF9" colspan="2"><strong>Remarks</strong></td><td width="27%" bgcolor="#DAEAF9"><strong>Select Date</strong></td><td width="15%" bgcolor="#DAEAF9"><strong>Select Time Slab</strong></td></tr>
        <tr>  <td bgcolor="#FFFFFF" colspan="2"><?php echo $rowApptDetails->special_remarks; ?></td>
          <td bgcolor="#FFFFFF" valign="top"><?php echo $rowApptDetails->appt_date; ?></td>
          <td bgcolor="#FFFFFF" valign="top"><?php echo $rowApptDetails->appt_time; ?></td>
        </tr>
         <tr><td colspan="4" bgcolor="#DAEAF9"  ><b>Documents - <?php echo implode(' , ', $DocsArr); ?> </b></td></tr>
          
          </table>
     <?php } } ?>
    </td></tr>
      </table>
       
     </td></tr>      
     
      </table></form>
  
  
  
  
  
  
  </td></tr>
  
 
</table>

</body>
</html>
