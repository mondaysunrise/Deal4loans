<?php     
    require 'scripts/session_check_online.php';
	require 'scripts/db_init.php';
	
	
	if(isset($_POST['submit_appdt']))
	{
	//echo "<pre>";
	//print_r($_POST);
		$id = $_POST['id'];
		$special_remarks = $_POST['special_remarks'];
		$appointment_date = $_POST['appointment_date'];
		$appointment_time = $_POST['appointment_time'];
		$Address = $_POST['Address'];
		$IDProof = $_POST['IDProof'];
		$AddressProof = $_POST['AddressProof'];
		$PanCard = $_POST['PanCard'];
		$SalSlip = implode(',',$_REQUEST["SalSlip"]);//
		$BankStmnt = implode(',',$_REQUEST["BankStmnt"]);//
		$PassSizePhoto = $_POST['PassSizePhoto'];
		
		$updateSql = "update zexternal_appointment_docs set special_remarks='".$special_remarks."', appt_date='".$appointment_date."', Address='".$Address."', IDProof='".$IDProof."', AddressProof='".$AddressProof."', PanCard='".$PanCard."', SalSlip='".$SalSlip."', BankStmnt='".$BankStmnt."', PassSizePhoto='".$PassSizePhoto."', appt_time='".$appointment_time."'  where id='".$id."' ";
		ExecQuery($updateSql);
		$msg = "edited";
	}	
	
		
	$id = $_REQUEST['id'];
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
        <table width="830" border="0" cellspacing="1" cellpadding="0" style="border:#333 0px solid;" align="center" >
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
        <tr>  <td bgcolor="#DAEAF9" colspan="2"><!--<strong>Remarks</strong>--></td><td width="25%" bgcolor="#DAEAF9"><strong>Select Date</strong></td><td width="21%" bgcolor="#DAEAF9"><strong>Select Time Slab</strong></td></tr>
        <tr>  <td bgcolor="#FFFFFF" colspan="2"><!--<textarea rows="2" cols="55" name="special_remarks" id="special_remarks_3" onchange="NosplcharComment(this);"><?php echo $special_remarks ?></textarea>--></td>
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
	<td class="fontstyle" style="width: 120px"><b>Property Documents:</b></td>
	<td class="fontstyle" colspan="3">    
    <select name="PassSizePhoto" id="PassSizePhoto" style="width:670px;">
    <option value="">Please Select</option>
   <?php
   
		$GetDocs_Sql = "select * from zexternal_lap_documents where (Parent_Key =3  and Status=1)";
		$GetDocs_Query = ExecQuery($GetDocs_Sql);
		$GetDocsNumRows = mysql_num_rows($GetDocs_Query);
		$selected  = '';
		for($i=0;$i<$GetDocsNumRows;$i++)
		{
			$docs_id = mysql_result($GetDocs_Query,$i,'docs_id');
			$Name_Caption = mysql_result($GetDocs_Query,$i,'Name_Caption');
			if($PassSizePhoto == $docs_id)
			{
				$selected = 'selected';
			}


			?>
			<option value="<?php echo $docs_id; ?>" <?php echo $selected; ?> ><?php echo $Name_Caption; ?> </option>
			<?php
		}
		?>
       </select>
	</td>
	</tr>
	<tr></tr>
	<tr>
	<td class="fontstyle" style="width: 120px"><b>KYC Documents</b></td>
	<td class="fontstyle" colspan="3">
    <select name="BankStmnt[]" id="BankStmnt" style="width:790px; height:170px;" multiple>
    <option value="">Please Select</option>
    <?php
  		$expKYC = explode(',', $BankStmnt);
		$GetDocs_Sql = "select * from zexternal_lap_documents where (Parent_Key =1  and Status=1)";
		$GetDocs_Query = ExecQuery($GetDocs_Sql);
		$GetDocsNumRows = mysql_num_rows($GetDocs_Query);
		for($i=0;$i<$GetDocsNumRows;$i++)
		{
			$docs_id = mysql_result($GetDocs_Query,$i,'docs_id');
			$Name_Caption = mysql_result($GetDocs_Query,$i,'Name_Caption');
			?>
			<option value="<?php echo $docs_id; ?>" <?php if(in_array($docs_id, $expKYC ))  {echo "selected";} ?>><?php echo $Name_Caption; ?> </option>
			<?php
		}
		?>
      </select></td>
</tr>
<tr>
	<td class="fontstyle" style="width: 120px"><b>Financial Documents</b></td>
	<td colspan="3"> <select name="SalSlip[]" id="SalSlip" style="width:790px; height:140px;" multiple>
    <option value="">Please Select</option>
    <?php
  		$expIP = explode(',', $SalSlip);    
		$GetDocs_Sql = "select * from zexternal_lap_documents where (Parent_Key =2  and Status=1)";
		$GetDocs_Query = ExecQuery($GetDocs_Sql);
		$GetDocsNumRows = mysql_num_rows($GetDocs_Query);
		for($i=0;$i<$GetDocsNumRows;$i++)
		{
			$docs_id = mysql_result($GetDocs_Query,$i,'docs_id');
			$Name_Caption = mysql_result($GetDocs_Query,$i,'Name_Caption');
			?>
			<option value="<?php echo $docs_id; ?>" <?php if(in_array($docs_id, $expIP))  {echo "selected";} ?> ><?php echo $Name_Caption; ?> </option>
			<?php
		}
		?>
    </select>
	</td>
  </tr>

       <tr><td colspan="3" align="left" class="fontstyle">&nbsp;</td><td align="right"><input type="submit" name="submit_appdt" value="Save" style="background-color:#036; color:#fff; font-size:17px;"></td></tr> 
       </table></td></tr></table></form>