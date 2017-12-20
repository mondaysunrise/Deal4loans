<?php     
    require 'scripts/session_check_online.php';
	require 'scripts/db_init.php';
	
	$id = $_REQUEST['id'];
	

		
	if(isset($_POST['submit_appdt']))
	{
		$id = $_POST['id'];
		$special_remarks = $_POST['special_remarks'];
		$appointment_date = $_POST['appointment_date'];
		$appointment_time = $_POST['appointment_time'];
		$Address = $_POST['Address'];
		$IDProof = $_POST['IDProof'];
		$AddressProof = $_POST['AddressProof'];
		$PanCard = $_POST['PanCard'];
		$SalSlip = $_POST['SalSlip'];
		$BankStmnt = $_POST['BankStmnt'];
		$PassSizePhoto = $_POST['PassSizePhoto'];
		$AgentFeedback = 1; 
		
		$updateSql = "update zexternal_appointment_docs set special_remarks='".$special_remarks."', appt_date='".$appointment_date."', Address='".$Address."', IDProof='".$IDProof."', AddressProof='".$AddressProof."', PanCard='".$PanCard."', SalSlip='".$SalSlip."', BankStmnt='".$BankStmnt."', PassSizePhoto='".$PassSizePhoto."', appt_time='".$appointment_time."',  AgentFeedback='".$AgentFeedback."'  where id='".$id."' ";
		ExecQuery($updateSql);
		$msg = "edited";
	}	
	$getApptDetailsSql = "select * from zexternal_appointment_docs where id='".$id."' order by id asc";
	$getApptDetailsQry = ExecQuery($getApptDetailsSql);
	$getApptDetailsresCount =mysql_num_rows($getApptDetailsQry);
	$rowApptDetails = mysql_fetch_object($getApptDetailsQry);
	
	$IDProof =$rowApptDetails->IDProof;
	$AddressProof =$rowApptDetails->AddressProof; 
	$PanCard =$rowApptDetails->PanCard; 
	$SalSlip =$rowApptDetails->SalSlip; 
	$BankStmnt =$rowApptDetails->BankStmnt; 
	$PassSizePhoto =$rowApptDetails->PassSizePhoto; 
	$Address =$rowApptDetails->Address;
	$special_remarks = $rowApptDetails->special_remarks;
	$identification_proof = $rowApptDetails->IDProof;
	$residence_proof = $rowApptDetails->AddressProof;
	$appointment_date = $rowApptDetails->appt_date;
	$appointment_time = $rowApptDetails->appt_time;
		
?>
<script language="javascript" type="text/javascript" src="scripts/datetime.js"></script>	 
      <form method="POST" action="" name="sendform">
				<input type="hidden" name="id" id="id" value="<? echo $_REQUEST['id']; ?>">    
        <table width="630" border="0" cellspacing="1" cellpadding="0" style="border:#333 0px solid;" align="center" >
  <?php 
	if($msg!="")
	{
	?>
<tr><td colspan="4"> <div class="msg_payee" align="center"><img src="http://www.deal4loans.com/docmanagement/images/approved-new.png" align="absmiddle"/> Edited</div></td></tr>
<?php } ?>
        <tr>
          <td colspan="4" align="center">
          <table width="100%" cellspacing="3" cellpadding="4" style="border:#00F dashed 2px;">
        <tr>  <td bgcolor="#DAEAF9" colspan="4" align="center"><strong>Edit Appointment</strong></td></tr>          
        <tr>  <td bgcolor="#DAEAF9" colspan="2"><strong>Remarks</strong></td><td width="25%" bgcolor="#DAEAF9"><strong>Select Date</strong></td><td width="21%" bgcolor="#DAEAF9"><strong>Select Time Slab</strong></td></tr>
        <tr>  <td bgcolor="#FFFFFF" colspan="2"><textarea rows="2" cols="55" name="special_remarks" id="special_remarks_3" onchange="NosplcharComment(this);"><?php echo $special_remarks ?></textarea></td>
          <td bgcolor="#FFFFFF" valign="top"><input type="Text" name="appointment_date" id="appointment_date" maxlength="25" value="<?php echo $appointment_date; ?>" size="15" ><a href="javascript:NewCal('appointment_date','yyyymmdd',true,24)"><img src="/images/cal.gif" width="16" height="16" border="0" alt="Pick a date"></a></td>
          <td bgcolor="#FFFFFF" valign="top"><select name="appointment_time" id="appointment_time"  class="inputsms" style="width:170px;">
		    <option value="please select">Time slab</option>
		    <option value="8(am)-9(am)" <?php if(trim($appointment_time)=="8(am)-9(am)") {echo "Selected";} ?>>8(am)-9(am)</option>
		    <option value="9(am)-10(am)" <?php if(trim($appointment_time)=="9(am)-10(am)") {echo "Selected";} ?>>9(am)-10(am)</option>
		    <option value="10(am)-11(am)" <?php if(trim($appointment_time)=="10(am)-11(am)") {echo "Selected";} ?> >10(am)-11(am)</option>
		    <option value="11(am)-12(am)" <?php if(trim($appointment_time)=="11(am)-12(am)") {echo "Selected";} ?>>11(am)-12(am)</option>
		    <option value="12(am)-1(pm)" <?php if(trim($appointment_time)=="12(am)-1(pm)") {echo "Selected";} ?>>12(am)-1(pm)</option>
		    <option value="1(pm)-2(pm)" <?php if(trim($appointment_time)=="1(pm)-2(pm)") {echo "Selected";} ?>>1(pm)-2(pm)</option> 
		    <option value="2(pm)-3(pm)" <?php if(trim($appointment_time)=="2(pm)-3(pm)") {echo "Selected";} ?>>2(pm)-3(pm)</option>
		    <option value="3(pm)-4(pm)" <?php if(trim($appointment_time)=="3(pm)-4(pm)") {echo "Selected";} ?>>3(pm)-4(pm)</option>
		    <option value="4(pm)-5(pm)" <?php if(trim($appointment_time)=="4(pm)-5(pm)") {echo "Selected";} ?>>4(pm)-5(pm)</option>
		    <option value="5(pm)-6(pm)" <?php if(trim($appointment_time)=="5(pm)-6(pm)") {echo "Selected";} ?>>5(pm)-6(pm)</option>
		    <option value="6(pm)-7(pm)" <?php if(trim($appointment_time)=="6(pm)-7(pm)") {echo "Selected";} ?>>6(pm)-7(pm)</option>
		    <option value="7(pm)-8(pm)" <?php if(trim($appointment_time)=="7(pm)-8(pm)") {echo "Selected";} ?>>7(pm)-8(pm)</option>
	    </select></td>
        </tr>
         <tr><td colspan="1" ><b>Address -  </b></td><td colspan="3" ><textarea rows="2" cols="55" name="Address" id="Address" onchange="NosplcharComment(this);"><?php echo $Address; ?></textarea></td></tr>
         <tr><td colspan="4" bgcolor="#DAEAF9"  ><b>Documents List -  </b></td></tr>
<tr>
	<td width="24%" class="fontstyle"><b>ID Proof</b></td>
	<td width="30%" class="fontstyle">   
    <select name="IDProof" id="IDProof">
    	<option value="">Please Select</option>
		<option value="Passport" <?php if(trim($identification_proof)=="Passport") {echo "Selected";} ?> >Passport</option>
		<option value="PanCard" <?php if(trim($identification_proof)=="PanCard") {echo "Selected";} ?>>Pan Card</option>
		<option value="VoterID Card" <?php if(trim($identification_proof)=="VoterID Card") {echo "Selected";} ?>>Voter ID Card</option>
		<option value="ElectionID Card" <?php if(trim($identification_proof)=="ElectionID Card") {echo "Selected";} ?>>Election ID Card</option>
        <option value="Aadhar card" <?php if(trim($identification_proof)=="Aadhar card") {echo "Selected";} ?>>Aadhar card</option>
        		<option value="Driving License" <?php if(trim($identification_proof)=="Driving License") {echo "Selected";} ?> >Driving License</option>
                		<option value="Govt ID Card" <?php if(trim($identification_proof)=="Govt ID Card") {echo "Selected";} ?> >Govt ID Card (Govt Emp)</option>

		
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
        <option value="Aadhar card" <?php if(trim($residence_proof)=="Aadhar card") {echo "Selected";} ?>>Aadhar card</option>
        <option value="Govt ID Card" <?php if(trim($residence_proof)=="Govt ID Card") {echo "Selected";} ?> >Govt ID Card (Govt Emp)</option>
  		<option value="Phone Bill" <?php if(trim($residence_proof)=="Phone Bill") {echo "Selected";} ?>>Phone Bill</option>
		<option value="Driving License" <?php if(trim($residence_proof)=="Driving License") {echo "Selected";} ?> >Driving License</option>
	</select></td>
</tr>
<tr>
	<td class="fontstyle"><b>PAN Card</b></td>
	<td class="fontstyle">    
    <input type="radio" name="PanCard" id="PanCard" value="PANCard" <?php if((strlen(strpos($PanCard, "PANCard")) > 0)) echo "checked"; ?>> Yes &nbsp;&nbsp;<input type="radio" name="PanCard" id="PanCard2" value="">No
    
	</td>
	<td class="fontstyle"><b>3 Month Sal Slip</b></td>
	<td class="fontstyle">
     <input type="radio" name="SalSlip" id="SalSlip" value="3 Month SalSlip" <?php if((strlen(strpos($SalSlip, "3 Month SalSlip")) > 0)) echo "checked"; ?>> Yes &nbsp;&nbsp;<input type="radio" name="SalSlip" id="SalSlip2" value="">No
   </td>
</tr>
<tr>
	<td class="fontstyle"><b>6 Month Bank Statement</b></td>
	<td>
    <input type="radio" name="BankStmnt" id="BankStmnt" value="3 Month Bank Statement" <?php if((strlen(strpos($BankStmnt, "3 Month Bank Statement")) > 0)) echo "checked"; ?>> Yes &nbsp;&nbsp;<input type="radio" name="BankStmnt" id="BankStmnt2" value="">No    
	</td>
	<td class="fontstyle"><b>2 Passport Size Photo</b></td>
	<td class="fontstyle">
      <input type="radio" name="PassSizePhoto" id="PassSizePhoto" value="1 Passport Size Photo" <?php if((strlen(strpos($PassSizePhoto, "1 Passport Size Photo")) > 0)) echo "checked"; ?>> Yes &nbsp;&nbsp;<input type="radio" name="PassSizePhoto" id="PassSizePhoto2" value="">No
    </td>
</tr>    
       <tr><td colspan="3" align="left" class="fontstyle">&nbsp;</td><td align="right"><input type="submit" name="submit_appdt" value="Save" style="background-color:#036; color:#fff; font-size:17px;"></td></tr> 
       </table></td></tr></table></form>