<?php
include "includes/header.php";
if(!empty($_GET['page'])){
$page = $_GET['page'];
}else{
$page = 1;
}
$limit = 10;
$start = ($page - 1) * $limit;
$id = $_REQUEST['id'];
$Query = "select Req_Loan_Personal.RequestID as AllRequestID, Name,City, Mobile_Number, Company_Name, Net_Salary, special_remarks, docpickerid, id,Address, Pincode, Landmark, assigned_remark, caller_id, Reply_Type, leadlogid, apptdetailsid, IDProof, AddressProof, zexternal_appointment_docs.PanCard, SalSlip, BankStmnt, PassSizePhoto, IDProof_Status, AddressProof_Status, PanCard_Status, SalSlip_Status, BankStmnt_Status, PassSizePhoto, PassSizePhoto_Status, spoc_status from zexternal_appointment_docs LEFT OUTER JOIN Req_Loan_Personal ON Req_Loan_Personal.RequestID= zexternal_appointment_docs.RequestID where 1=1 and zexternal_appointment_docs.Reply_Type=1 and zexternal_appointment_docs.id='".$_REQUEST['id']."'";
$result = $obj->fun_db_query($Query);
$rowsCon = $obj->fun_db_fetch_rs_object($result);
//echo $Query;
if(isset($_POST['Submit']))
{
	$EditUser =  $objAdmin->processEditPickup($_REQUEST['id'],"EDIT");
	if($EditUser)
	{
		$rUrl = SITE_URL."doc-pick-user-details.php?id=".$_REQUEST['id']."&msg=edit";
		$objAdmin->redirectURL($rUrl);
	}
}
if(isset($_POST['submit_appdt']))
{
	 $EditUser =  $objAdmin->processReSchedule($_REQUEST['id'],"ADD");
//	exit();
	if($EditUser)
	{
		$rUrl = SITE_URL."document_picked_user_details.php?id=".$EditUser."&msg=edit";
		$objAdmin->redirectURL($rUrl);
	}
}
?>
<script language="javascript">
function loadDoc(id,ppVal,AssBy) {
	if (ppVal == "") {
        document.getElementById("PrintMsg").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("PrintMsg").innerHTML = xmlhttp.responseText;
            }
        };
		
        xmlhttp.open("GET","assignpick_ajax.php?id="+id+"&ppval="+ppVal+"&AssBy="+AssBy,true);
        xmlhttp.send();
    }
}

function loadSpocStatus(id,ppVal,AssBy) {
//alert(id);
	if (ppVal == "") {
        document.getElementById("PrintMsg").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("PrintMsg").innerHTML = xmlhttp.responseText;
            }
        };
		
        xmlhttp.open("GET","spocstatus_ajax.php?id="+id+"&ppval="+ppVal+"&AssBy="+AssBy,true);
        xmlhttp.send();
    }
}


</script>
<script language="javascript" type="text/javascript" src="/scripts/datetime.js"></script>
<div id="payment_container-dash_page">
  <?php //include "includes/left.php";?>
 
    <h1>Leads assign to Document Pickup User Details</h1>
      <?php 
	if($_REQUEST['msg']!="")
	{
	?><br />
    <div class="msg_payee" align="center"><img src="./images/approved-new.png" align="absmiddle"/><?php echo $_REQUEST['msg'];?></div>
    <?php }?>
    <div id="PrintMsg" style="float:right;  font-weight:bold;"></div>
    <table width="717" cellspacing="0"><tr><td>
      <form action="" method="post" name="frm" onsubmit="return valEditPickup();">
       <input type="hidden" name="id" value="<?php echo $id; ?>" />
    <table width="717" cellspacing="0" cellpadding="3" border="1" style="border:solid 1px #ccc;" class="table-prolist">

        <tr>
          <td ><strong>Bank Name</strong>&nbsp;&nbsp;<?php
		  
//		   $getBankSql = "select Associated_Bank from Bidders left join Req_Feedback_Bidder_PL on Bidders.BidderID=Req_Feedback_Bidder_PL.BidderID where Req_Feedback_Bidder_PL.AllRequestID='".$rowsCon->AllRequestID."' and Bidders.Associated_Bank in ('Tata Capital', 'ICICI Bank')";
		   
		    $getBankSql = "select Associated_Bank from Bidders where BidderID='".$rowsCon->caller_id."' and Bidders.Associated_Bank in ('Tata Capital', 'ICICI Bank')";
		   
			$getBankResult = $obj->fun_db_query($getBankSql);
			$rowsBank = $obj->fun_db_fetch_rs_object($getBankResult);
			
			echo $rowsBank->Associated_Bank; ?>
					
			</td>
          <td><?php $QueryExtraFields = "select cibil_reference_id from Req_Loan_Personal_Extra_Fields where RequestID='".$rowsCon->AllRequestID."'";
					$resultExtraFields = $obj->fun_db_query($QueryExtraFields);
					$rowsConExtraFields = $obj->fun_db_fetch_rs_object($resultExtraFields);
					$cibil_reference_id = $rowsConExtraFields->cibil_reference_id;
					if(strlen($cibil_reference_id)>4)
					{
						echo "<strong>CIBIL Reference ID</strong>&nbsp;&nbsp;&nbsp;&nbsp;".$cibil_reference_id;
					}
					
					
					?>
		</td>
        </tr>
        <tr>
          <td  width="269"><strong>Name</strong></td>
          <td width="430"><?php echo $rowsCon->Name;?></td>
        </tr>
        <tr>
          <td><strong>Mobile Number</strong></td>
          <td><?php echo $rowsCon->Mobile_Number;?></td>
        </tr>
        <tr>
          <td><strong>Address</strong></td>
          <td><?php echo $rowsCon->Address;?></td>
        </tr>
        <tr>
          <td><strong>Pincode</strong></td>
          <td><?php echo $rowsCon->Pincode;?></td>
        </tr>
        <tr>
          <td><strong>City</strong></td>
          <td><?php echo $rowsCon->City;?></td>
        </tr>
        
                <tr>
          <td><strong>Company Name</strong></td>
          <td><?php echo $rowsCon->Company_Name;?></td>
        </tr>
                <tr>
          <td><strong>Agents Remark</strong></td>
          <td><?php echo $rowsCon->special_remarks;?></td>
        </tr>
                <tr>
          <td><strong>Net Salary</strong></td>
          <td><?php echo "Rs. ".$rowsCon->Net_Salary;?></td>
        </tr>
              <tr>
          <td><strong>Documents</strong></td>
          <td><?php echo $rowsCon->IDProof.", ".$rowsCon->AddressProof.", ".$rowsCon->PanCard.", ".$rowsCon->SalSlip.", ".$rowsCon->BankStmnt.", ".$rowsCon->PassSizePhoto;?></td>
        </tr>
         <tr>
          <td ><strong>Landmark</strong></td>
          <td> <input type="text" name="Landmark" value="<?php echo $rowsCon->Landmark; ?>" /></td></tr>  
        <tr>
          <td><strong>Spoc Feedback</strong><?php //echo $rowsCon->spoc_status; ?></td>
          <td><select name="spoc_status" id="spoc_status" onchange="loadSpocStatus(<?php echo $rowsCon->id;?>,this.value,'<?php echo $_SESSION['UID'];?>')">
          <option value="">Please Select</option>
           <option value="Appointment - Rescheduled" <?php if($rowsCon->spoc_status== "Appointment - Rescheduled") { echo 'selected';} ?> >Appointment - Rescheduled</option>
           <option value="Appointment - Cancelled" <?php if($rowsCon->spoc_status== "Appointment - Cancelled") { echo 'selected';} ?> >Appointment - Cancelled</option>
           <option value="Assigned For Pick-up" <?php if($rowsCon->spoc_status== "Assigned For Pick-up") { echo 'selected';} ?> >Assigned For Pick-up</option>
            <option value="Ringing" <?php if($rowsCon->spoc_status== "Ringing") { echo 'selected';} ?> >Ringing</option>
             <option value="Followup" <?php if($rowsCon->spoc_status== "Followup") { echo 'selected';} ?> >Followup</option>
</select>

       <tr>
          <td><strong>Field Executive</strong></td>
          <td><select name="pickup_person" id="pickup_person" onchange="loadDoc(<?php echo $rowsCon->id;?>,this.value,'<?php echo $_SESSION['UID'];?>')">
          <option value="">Please Select</option>
		  <?php // Query for pickup Guy.
if($_SESSION['UserType']==1)
 {

	//write query for super admin
		$getPickupSql = "select * from zexternal_appointment_users where UserType =3 and City = '".$rowsCon->City."'  "; 
	
	
	}
else
{
		  	$getPickupSql = "select * from zexternal_appointment_users where Owner = '".$_SESSION['UID']."' "; 

}
$getPickupResult = $obj->fun_db_query($getPickupSql);
			$selected = '';
			while($rowsgetPickup = $obj->fun_db_fetch_rs_object($getPickupResult))
			{
				$selected = '';
				if($rowsgetPickup->id== $rowsCon->docpickerid) {$selected = 'selected';} 
				echo "<option value='".$rowsgetPickup->id."' ".$selected." >".$rowsgetPickup->Name."</option>";
			}
		  ?></select></td>
        </tr>  
       <tr>
          <td><strong>Remarks</strong></td>
          <td><textarea rows="2" cols="55" name="assigned_remark" id="assigned_remark" onchange="NosplcharComment(this);"><?php echo $rowsCon->assigned_remark; ?></textarea></td></tr>  
		<tr><td colspan="2"><input type="submit" name="Submit" id="btnSubmit" value="Submit"  /></td></tr>     
    </table>
   </form> 
   </td></tr><tr>
   <td>
   <form action="" name="frm1" method="post">
   <?php
 	$SQL1 = "select Feedback_ID from client_lead_allocate where AllRequestID='".$rowsCon->AllRequestID."' and BidderID='".$rowsCon->caller_id."'";
	$resultSQL1 = $obj->fun_db_query($SQL1);
	$rowsConSQL1 = $obj->fun_db_fetch_rs_object($resultSQL1);
	$Feedback_ID = $rowsConSQL1->Feedback_ID;
	 
	$SQL2 = "select BidderID from Req_Feedback_Bidder_PL where AllRequestID='".$rowsCon->AllRequestID."' and Feedback_ID='".$Feedback_ID."'";
	//echo "<br>".$SQL2;
	$resultSQL2 = $obj->fun_db_query($SQL2);
	$rowsConSQL2 = $obj->fun_db_fetch_rs_object($resultSQL2);
	$FinalBidderID = $rowsConSQL2->BidderID;

	$SQL3 = "select BankID from Bidders_List where BidderID='".$FinalBidderID."'";
	//echo "<br>".$SQL3;
	$resultSQL3 = $obj->fun_db_query($SQL3);
	$rowsConSQL3 = $obj->fun_db_fetch_rs_object($resultSQL3);
	$BankID= $rowsConSQL3->BankID;

   ?>
    <input type="hidden" name="caller_id" id="Feedback_ID" value="<? echo $Feedback_ID; ?>">
    <input type="hidden" name="caller_id" id="BidderID" value="<? echo $FinalBidderID; ?>">
    <input type="hidden" name="caller_id" id="BankID" value="<? echo $BankID; ?>">
    <input type="hidden" name="caller_id" id="caller_id" value="<? echo $rowsCon->caller_id; ?>">
    <input type="hidden" name="City" id="City" value="<? echo $rowsCon->City;?>">
    <input type="hidden" name="RequestID" id="RequestID" value="<? echo $rowsCon->AllRequestID;?>">
    <input type="hidden" name="Reply_Type" id="Reply_Type" value="<? echo $rowsCon->Reply_Type; ?>">  
     <table width="717" cellspacing="3" cellpadding="4" style="border:#00F dashed 2px;">
        <tr>  <td bgcolor="#DAEAF9" colspan="4"><strong>Re-Schedule Appointment</strong></td></tr>
        <tr>  <td bgcolor="#DAEAF9" colspan="2"><strong>Remarks</strong></td><td width="25%" bgcolor="#DAEAF9"><strong>Select Date</strong></td><td width="21%" bgcolor="#DAEAF9"><strong>Select Time Slab</strong></td></tr>
        <tr>  <td bgcolor="#FFFFFF" colspan="2"><textarea rows="2" cols="55" name="special_remarks" id="special_remarks_3" onchange="NosplcharComment(this);"></textarea></td>
          <td bgcolor="#FFFFFF" valign="top">
          
          <input type="Text" name="appointment_date" id="appointment_date" maxlength="25" value="<?php   echo $yesterdayDate = date('Y-m-d',strtotime("+1 days"))." ".date('H:i:s'); ?>" size="15" ><a href="javascript:NewCal('appointment_date','yyyymmdd',true,24)"><img src="/images/cal.gif" width="16" height="16" border="0" alt="Pick a date"></a></td>
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
         <tr><td colspan="1" ><b>Address -  </b></td><td colspan="3" align="left" ><textarea rows="1" cols="95" name="Address" id="Address" onchange="NosplcharComment(this);"></textarea></td></tr>
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
        <option value="Aadhar card" <?php if(trim($identification_proof)=="Aadhar card") {echo "Selected";} ?>>Aadhar card</option>
        <option value="Govt ID Card" <?php if(trim($identification_proof)=="Govt ID Card") {echo "Selected";} ?> >Govt ID Card (Govt Emp)</option>
  		<option value="Phone Bill" <?php if(trim($residence_proof)=="Phone Bill") {echo "Selected";} ?>>Phone Bill</option>
		<option value="Driving License" <?php if(trim($identification_proof)=="Driving License") {echo "Selected";} ?> >Driving License</option>
	</select></td>
</tr>
<tr>
	<td class="fontstyle"><b>PAN Card</b></td>
	<td class="fontstyle">    <table><tr><td>
    <input type="radio" name="PanCard" id="PanCard" value="PANCard" <?php if((strlen(strpos($income_proof, "PANCard")) > 0)) echo "checked"; ?>> Yes </td><td><input type="radio" name="PanCard" id="PanCard2" value=""> No </td></tr></table>
    
	</td>
	<td class="fontstyle"><b>3 Month Sal Slip</b></td>
	<td class="fontstyle"> <table><tr><td>
     <input type="radio" name="SalSlip" id="SalSlip" value="3 Month SalSlip" <?php if((strlen(strpos($income_proof, "3 Month SalSlip")) > 0)) echo "checked"; ?>> Yes</td><td><input type="radio" name="SalSlip" id="SalSlip2" value=""> No</td></tr></table>
   </td>
</tr>
<tr>
	<td class="fontstyle"><b>3 Month Bank Statement</b></td>
	<td> <table><tr><td>
    <input type="radio" name="BankStmnt" id="BankStmnt" value="3 Month Bank Statement" <?php if((strlen(strpos($income_proof, "3 Month Bank Statement")) > 0)) echo "checked"; ?>> Yes</td><td><input type="radio" name="BankStmnt" id="BankStmnt2" value=""> No </td></tr></table>   
	</td>
	<td class="fontstyle"><b>1 Passport Size Photo</b></td>
	<td class="fontstyle"> <table><tr><td>
      <input type="radio" name="PassSizePhoto" id="PassSizePhoto" value="1 Passport Size Photo" <?php if((strlen(strpos($income_proof, "1 Passport Size Photo")) > 0)) echo "checked"; ?>> Yes</td><td><input type="radio" name="PassSizePhoto" id="PassSizePhoto2" value=""> No</td></tr></table>
    </td>
</tr>    
       <tr><td colspan="3" align="left" class="fontstyle"><input type="hidden" value="1" name="rescheduled" id="rescheduled" /> Re-Schedule</td><td align="right"><input type="submit" name="submit_appdt" value="Save" style="background-color:#036; color:#fff; font-size:17px;"></td></tr> 
       </table>
   </form>    
       </td></tr></table>
   
  
</div>
</body></html>