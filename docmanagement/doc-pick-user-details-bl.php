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
function BusinessDetailsValue($i)
{
	$BusinessDetails = array("1"=>"Business continuity proof – 3 years  and  more income tax return & income statements", "2"=>"Last 2/3year audit re port and audited Financials", "3"=>"Last 6-12 months bank statements", "4"=>"In the case of transfer of a loan: Last 12 months of  loans statement  along with the Sanction Letter of your previous bank", "5"=>"Any other loan statements on books of companies along with Sanction Letters", "6"=>"Last 12 months loan statement with Sanction Letter of any other existing loans", "7"=>"Business incorporation date proof – PAN Card",    "8"=>"MOA(Memorandum of Association) and AOA (Articles of Association)", "9"=>"Latest shareholding pattern on company letterhead", "10"=>"List of current Directors on company letterhead", "11"=>"Certificate of Incorporation", "12"=>"Partnership Deed", "13"=>"Certificate of Registration", "14"=>"Proof of continuation:  Trade license /Establishment /Sales Tax certificate", "15"=>"Proof of continuation: Trade license /Establishment /Sales Tax certificate/ SSI Registration", "16"=>"Brief Business Profile on the Letter Head of the firm by the applicant", "17"=>"Copy of Tax Deduction Certificate 26 AS  / Form – 16A (if applicable)", "18"=>"Copy of Advance Tax paid / Self Assessment Tax paid challan", "19"=>"Copy of Educational Qualification Certificate ( professional  loans ) ", "20"=>"Copy of Professional Practice Certificate", "21"=>"Salary Certificate (in case of doctors having salaried income)");
	return $BusinessDetails[$i];
}


function GrossTurnoverValue($i)
{
	$GrossTurnover = array("1"=>"Latest 2  Years ITRs' , Computation of Income, P&L, Balance sheet with all schedules with CA seal and sign", "2"=>"Tax Audit Report (Where Gross Turnover Exceeds Rs 1 Crs for Non Professional Self Employed and Gross Receipts Exceeds 25 Lacs incase of Professionals and )", "3"=>"Last 1 Year bank statements (with logo and Bank name) both Current and SB Account", "4"=>"Business Continuity Proof for 3 Yrs", "5"=>"Existing loan details and 6 months emi reflecting bank statement", "6"=>"Latest LOD,OS Letter and Last 12 Months SOA in case of BT Proposal", "7"=>"Partnership Deed & Latest list of partners & NOC as per Bank  bank format", "8"=>"In case applicant is a Partner- Partnership firm's audited ITR along with complete financials to be collected", "9"=>"Partnership Authority Letter on Letterhead of the Firm signed by all partners in case Firm to stand as guarantor", "10"=>"Incase applicant is a Director, then the company's  audited ITR along with complete financials to be collected", "11"=>"Board Resolution as per Bank  bank format- Incase company is applicant/guarantor", "12"=>"Certificate of Incorporation", "13"=>"MOA and AOA", "14"=>"DIN of all Directors to be collected where company is applicant,Co_Applicant or Guarantor to the Loan", "15"=>"Latest Share Holding Pattern");	
	return $GrossTurnover[$i];
}
$Query = "select Req_Loan_Personal.RequestID as AllRequestID, Req_Loan_Personal.Dated as LeadDate, Name,City, Mobile_Number, Company_Name, Net_Salary, special_remarks, docpickerid, id,Address, Pincode, Landmark, assigned_remark, caller_id, Reply_Type, leadlogid, apptdetailsid, IDProof, AddressProof, zexternal_appointment_docs.PanCard, SalSlip, BankStmnt, PassSizePhoto, IDProof_Status, AddressProof_Status, PanCard_Status, SalSlip_Status, BankStmnt_Status, PassSizePhoto, PassSizePhoto_Status, appt_date, appt_time from zexternal_appointment_docs LEFT OUTER JOIN Req_Loan_Personal ON Req_Loan_Personal.RequestID= zexternal_appointment_docs.RequestID where 1=1 and zexternal_appointment_docs.Reply_Type=6 and zexternal_appointment_docs.id='".$_REQUEST['id']."'";
$result = $obj->fun_db_query($Query);
$rowsCon = $obj->fun_db_fetch_rs_object($result);

if(isset($_POST['Submit']))
{
	$EditUser =  $objAdmin->processEditPickup($_REQUEST['id'],"EDIT");
	if($EditUser)
	{
		$rUrl = SITE_URL."doc-pick-user-details-bl.php?id=".$_REQUEST['id']."&msg=edit";
		$objAdmin->redirectURL($rUrl);
	}
}
if(isset($_POST['submit_appdt']))
{
	$EditUser =  $objAdmin->processReSchedule($_REQUEST['id'],"ADD");
//	exit();
	if($EditUser)
	{
		$rUrl = SITE_URL."doc-pick-user-details-bl.php?id=".$EditUser."&msg=Rescheduled";
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
          <td width="269" height="33"><strong>Caller Id</strong></td>
          <td width="430"><? echo $rowsCon->caller_id; ?></td>
        </tr>
        <tr>
          <td><strong>Name</strong></td>
          <td><?php echo $rowsCon->Name;?></td>
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
          <td><strong>Lead Date and Time</strong></td>
          <td><?php echo $rowsCon->LeadDate; ?></td>
        </tr>
        <tr>
          <td><strong>Appointment Date and Time</strong></td>
          <td><?php echo $rowsCon->appt_date; echo "&nbsp;&nbsp;"; echo $rowsCon->appt_time;?></td>
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
          <td><?php echo $rowsCon->IDProof.", ".$rowsCon->AddressProof.", ".$rowsCon->PassSizePhoto;
		  
		  
				$arrSalSlip = explode(',', $rowsCon->SalSlip);
				$arrSS = '';
				for($arrSCnt=0;$arrSCnt<count($arrSalSlip);$arrSCnt++)
				{
					$arrSS[]=GrossTurnoverValue($arrSalSlip[$arrSCnt]);
				}
				 echo implode(', ', $arrSS).", ";
				 $arrBankStmnt = explode(',', $rowsCon->BankStmnt);
				$arrBS = '';
				for($arrS=0;$arrS<count($arrBankStmnt);$arrS++)
				{
					$arrBS[]=BusinessDetailsValue($arrBankStmnt[$arrS]);
				}
				 echo implode(', ', $arrBS); 
		  
		  
		  ?></td>
        </tr>
         <tr>
          <td ><strong>Landmark</strong></td>
          <td> <input type="text" name="Landmark" value="<?php echo $rowsCon->Landmark; ?>" /></td></tr>  
        
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
   	<input type="hidden" name="caller_id" id="caller_id" value="<? echo $rowsCon->caller_id; ?>">
    <input type="hidden" name="City" id="City" value="<? echo $rowsCon->City;?>">
    <input type="hidden" name="RequestID" id="RequestID" value="<? echo $rowsCon->AllRequestID;?>">
    <input type="hidden" name="Reply_Type" id="Reply_Type" value="<? echo $rowsCon->Reply_Type; ?>">  
   <table width="100%" style="border:#00F dashed 2px;">
        <tr>  <td bgcolor="#DAEAF9" colspan="2"><!--<strong>Remarks</strong>--></td><td width="27%" bgcolor="#DAEAF9"><strong>Select Date</strong></td><td width="15%" bgcolor="#DAEAF9"><strong>Select Time Slab</strong></td></tr>
        <tr>  <td bgcolor="#FFFFFF" colspan="2"><!--<textarea rows="2" cols="75" name="special_remarks" id="special_remarks_3" onchange="NosplcharComment(this);"><? echo $Add_Comment; ?></textarea>--></td>
          <td bgcolor="#FFFFFF" valign="top"><input type="Text" name="appointment_date" id="appointment_date_3" maxlength="25" value="" size="15" ><a href="javascript:NewCal('appointment_date_3','yyyymmdd',true,24)"><img src="/images/cal.gif" width="16" height="16" border="0" alt="Pick a date"></a></td>
          <td bgcolor="#FFFFFF" valign="top"><select name="appointment_time" id="appointment_time"  class="inputsms" style="width:170px;">
		    <option value="please select">Time slab</option>
		      <option value="8(am)-9(am)" <?php if($appointment_time=='8(am)-9(am)') { echo "selected"; }?>>8(am)-9(am)</option>
		    <option value="9(am)-10(am)" <?php if($appointment_time=='9(am)-10(am)') { echo "selected"; }?>>9(am)-10(am)</option>
		    <option value="10(am)-11(am)" <?php if($appointment_time=='10(am)-11(am)') { echo "selected"; }?>>10(am)-11(am)</option>
		    <option value="11(am)-12(am)" <?php if($appointment_time=='11(am)-12(am)') { echo "selected"; }?>>11(am)-12(am)</option>
		    <option value="12(am)-1(pm)" <?php if($appointment_time=='12(am)-1(pm)') { echo "selected"; }?>>12(am)-1(pm)</option>
		    <option value="1(pm)-2(pm)" <?php if($appointment_time=='1(pm)-2(pm)') { echo "selected"; }?>>1(pm)-2(pm)</option> 
		    <option value="2(pm)-3(pm)" <?php if($appointment_time=='2(pm)-3(pm)') { echo "selected"; }?>>2(pm)-3(pm)</option>
		    <option value="3(pm)-4(pm)" <?php if($appointment_time=='3(pm)-4(pm)') { echo "selected"; }?>>3(pm)-4(pm)</option>
		    <option value="4(pm)-5(pm)" <?php if($appointment_time=='4(pm)-5(pm)') { echo "selected"; }?>>4(pm)-5(pm)</option>
		    <option value="5(pm)-6(pm)" <?php if($appointment_time=='5(pm)-6(pm)') { echo "selected"; }?>>5(pm)-6(pm)</option>
		    <option value="6(pm)-7(pm)" <?php if($appointment_time=='6(pm)-7(pm)') { echo "selected"; }?>>6(pm)-7(pm)</option>
		    <option value="7(pm)-8(pm)" <?php if($appointment_time=='7(pm)-8(pm)') { echo "selected"; }?>>7(pm)-8(pm)</option>
	    </select></td>
        </tr>
           <tr><td colspan="1" ><b>Address -  </b></td><td colspan="3" align="left" ><textarea rows="1" cols="95" name="Address" id="Address" onChange="NosplcharComment(this);"><?php echo $Address; ?></textarea></td></tr>
         <tr><td colspan="4" bgcolor="#DAEAF9"  ><b>Documents for <?php echo $finalBidderName[$i]; ?> </b></td></tr>
<tr>
	<td width="21%" class="fontstyle"><b>Age & ID Proof</b></td>
	<td width="37%" class="fontstyle">   
    <select name="IDProof" id="IDProof" style="width:170px;">
    	<option value="">Please Select</option>
		<option value="Passport" <?php if(trim($identification_proof)=="Passport") {echo "Selected";} ?> >Passport</option>
		<option value="PANCard" <?php if(trim($identification_proof)=="PANCard") {echo "Selected";} ?>>PAN Card</option>
		<option value="Drivers License" <?php if(trim($identification_proof)=="Drivers License") {echo "Selected";} ?>>Drivers License</option>
		<option value="Aadhar Card" <?php if(trim($identification_proof)=="Aadhar Card") {echo "Selected";} ?>>Aadhar Card</option>
		
	</select>
	</td>
	<td class="fontstyle"><b>Address proof</b></td>
	<td class="fontstyle"><select name="AddressProof" id="AddressProof" style="width:170px;">
    <option value="">Please Select</option>
		<option value="Passport" <?php if(trim($AddressProof)=="Passport") {echo "Selected";} ?>>Passport</option>
		<option value="Bank Statement" <?php if(trim($AddressProof)=="Bank Statement") {echo "Selected";} ?>>Last 12 months Bank Statement</option>
		<option value="LIC Premium" <?php if(trim($AddressProof)=="LIC Premium") {echo "Selected";} ?>>LIC Premium (not over two months old)</option>
<option value="Utility Bill" <?php if(trim($residence_proof)=="Utility Bill") {echo "Selected";} ?>>Utility Bill (not over two months old)</option>
<option value="Phone Bill" <?php if(trim($residence_proof)=="Phone Bill") {echo "Selected";} ?>>Mobile Bill (not over two months old)</option>
		<option value="Any other loan statements" <?php if(trim($AddressProof)=="Any other loan statements") {echo "Selected";} ?>>Any other loan statements on books of individuals/partners/directors along with sanction letters</option>
		<option value="Rent Agreement" <?php if(trim($residence_proof)=="Rent Agreement") {echo "Selected";} ?>>Rent Agreement</option>
  	</select></td>
</tr>
<tr>
	<td class="fontstyle"><b>Residence/Office Ownership (any of the below):</b></td>
	<td class="fontstyle">    
    <select name="PassSizePhoto" id="PassSizePhoto" style="width:170px;">
    <option value="">Please Select</option>
    <option value="Electricity Bill" <?php if(trim($ResidenceProof)=="Electricity Bill") {echo "Selected";} ?>>Electricity Bill</option>
      <option value="Sales Deed copy" <?php if(trim($ResidenceProof)=="Sales Deed copy") {echo "Selected";} ?>>Sales Deed copy</option>
      </select>
	</td>
	<td class="fontstyle"><b>Business Details</b></td>
	<td class="fontstyle">
    <select name="BankStmnt[]" id="BankStmnt" style="width:170px;" multiple="multiple">
    <option value="">Please Select</option>
    <option value="1" <?php if(trim($BusinessDetails)=="1") {echo "Selected";} ?>>Business continuity proof – 3 years  and  more income tax return & income statements</option>
      <option value="2" <?php if(trim($BusinessDetails)=="2") {echo "Selected";} ?>>Last 2/3year audit re port and audited Financials</option>
      <option value="3" <?php if(trim($BusinessDetails)=="3") {echo "Selected";} ?>>Last 6-12 months bank statements</option>
      <option value="4" <?php if(trim($BusinessDetails)=="4") {echo "Selected";} ?>>In the case of transfer of a loan: Last 12 months of  loans statement  along with the Sanction Letter of your previous bank</option>
      <option value="5" <?php if(trim($BusinessDetails)=="5") {echo "Selected";} ?>>Any other loan statements on books of companies along with Sanction Letters</option>
      <option value="6" <?php if(trim($BusinessDetails)=="6") {echo "Selected";} ?>>Last 12 months loan statement with Sanction Letter of any other existing loans</option>
     <option value="7" <?php if(trim($BusinessDetails)=="7") {echo "Selected";} ?>>Business incorporation date proof – PAN Card</option>    <option value="8" <?php if(trim($BusinessDetails)=="8") {echo "Selected";} ?>>MOA(Memorandum of Association) and AOA (Articles of Association)</option>   
      <option value="9" <?php if(trim($BusinessDetails)=="9") {echo "Selected";} ?>>Latest shareholding pattern on company letterhead</option>
      <option value="10" <?php if(trim($BusinessDetails)=="10") {echo "Selected";} ?>>List of current Directors on company letterhead.</option>      
      <option value="11" <?php if(trim($BusinessDetails)=="11") {echo "Selected";} ?>>Certificate of Incorporation</option>      
    <option value="12" <?php if(trim($BusinessDetails)=="12") {echo "Selected";} ?>>Partnership Deed</option>   
      <option value="13" <?php if(trim($BusinessDetails)=="13") {echo "Selected";} ?>>Certificate of Registration</option>
      <option value="14" <?php if(trim($BusinessDetails)=="14") {echo "Selected";} ?>>Proof of continuation:  Trade license /Establishment /Sales Tax certificate</option>      
      <option value="15" <?php if(trim($BusinessDetails)=="15") {echo "Selected";} ?>>Proof of continuation: Trade license /Establishment /Sales Tax certificate/ SSI Registration</option>      
    <option value="16" <?php if(trim($BusinessDetails)=="16") {echo "Selected";} ?>>Brief Business Profile on the Letter Head of the firm by the applicant</option>   
      <option value="17" <?php if(trim($BusinessDetails)=="17") {echo "Selected";} ?>>Copy of Tax Deduction Certificate 26 AS  / Form – 16A (if applicable)</option>
      <option value="18" <?php if(trim($BusinessDetails)=="18") {echo "Selected";} ?>>Copy of Advance Tax paid / Self Assessment Tax paid challan</option>      
      <option value="19" <?php if(trim($BusinessDetails)=="19") {echo "Selected";} ?>>Copy of Educational Qualification Certificate ( professional  loans ) </option>      
<option value="20" <?php if(trim($BusinessDetails)=="20") {echo "Selected";} ?>>Copy of Professional Practice Certificate</option>   
<option value="21" <?php if(trim($BusinessDetails)=="21") {echo "Selected";} ?>>Salary Certificate (in case of doctors having salaried income)</option>   
      </select>   </td>
</tr>
<tr>
	<td class="fontstyle"><b>Gross Turnover</b></td>
	<td> <select name="SalSlip[]" id="SalSlip" style="width:170px;" multiple="multiple">
    <option value="">Please Select</option>
    <option value="1" <?php if(trim($GrossTurnover)=="1") {echo "Selected";} ?>>Latest 2  Years ITRs' , Computation of Income, P&L, Balance sheet with all schedules with CA seal and sign</option>
   <option value="2" <?php if(trim($GrossTurnover)=="2") {echo "Selected";} ?>>Tax Audit Report (Where Gross Turnover Exceeds Rs 1 Crs for Non Professional Self Employed and Gross Receipts Exceeds 25 Lacs incase of Professionals and )</option>
   <option value="3" <?php if(trim($GrossTurnover)=="3") {echo "Selected";} ?>>Last 1 Year bank statements (with logo and Bank name) both Current and SB Account</option>
   <option value="4" <?php if(trim($GrossTurnover)=="4") {echo "Selected";} ?>>Business Continuity Proof for 3 Yrs</option>
   <option value="5" <?php if(trim($GrossTurnover)=="5") {echo "Selected";} ?>>Existing loan details and 6 months emi reflecting bank statement</option>
   <option value="6" <?php if(trim($GrossTurnover)=="6") {echo "Selected";} ?>>Latest LOD,OS Letter and Last 12 Months SOA in case of BT Proposal</option>
   <option value="7" <?php if(trim($GrossTurnover)=="7") {echo "Selected";} ?>>Partnership Deed & Latest list of partners & NOC as per Bank  bank format</option>
   <option value="8" <?php if(trim($GrossTurnover)=="8") {echo "Selected";} ?>>In case applicant is a Partner- Partnership firm's audited ITR along with complete financials to be collected</option>
   <option value="9" <?php if(trim($GrossTurnover)=="9") {echo "Selected";} ?>>Partnership Authority Letter on Letterhead of the Firm signed by all partners in case Firm to stand as guarantor</option>
   <option value="10" <?php if(trim($GrossTurnover)=="10") {echo "Selected";} ?>>Incase applicant is a Director, then the company's  audited ITR along with complete financials to be collected</option>
   <option value="11" <?php if(trim($GrossTurnover)=="11") {echo "Selected";} ?>>Board Resolution as per Bank  bank format- Incase company is applicant/guarantor</option>
   <option value="12" <?php if(trim($GrossTurnover)=="12") {echo "Selected";} ?>>Certificate of Incorporation</option>
   <option value="13" <?php if(trim($GrossTurnover)=="13") {echo "Selected";} ?>>MOA and AOA</option>
   <option value="14" <?php if(trim($GrossTurnover)=="14") {echo "Selected";} ?>>DIN of all Directors to be collected where company is applicant,Co_Applicant or Guarantor to the Loan</option>
      <option value="15" <?php if(trim($GrossTurnover)=="15") {echo "Selected";} ?>>Latest Share Holding Pattern</option>
    </select>
	</td>
	<td class="fontstyle"><b></b></td>
	<td class="fontstyle">
    </td>
</tr>   <tr><td colspan="3" align="left" class="fontstyle"><input type="checkbox" value="1" name="reschedule" id="reschedule" /> Re-Schedule</td><td align="right"><input type="submit" name="submit_appdt" value="Save" style="background-color:#036; color:#fff; font-size:17px;"></td></tr> 
       </table>
   </form>    
       </td></tr>
       
       <tr>
         <tr>
          <td colspan="4">
          <table width="100%" style="border:#00F groove 1px;">
          <tr>
          <td colspan="4">
       <?php
		$getApptDetailsSql = "select * from zexternal_appointment_docs where RequestID='".$rowsCon->AllRequestID."' and viewstatus=0 and Reply_Type=6 order by id asc";
		$getApptDetailsQry = $obj->fun_db_query($getApptDetailsSql);
		$getApptDetailsresCount = $obj->fun_db_get_num_rows($getApptDetailsQry);
		$DocsArr = '';
		if($getApptDetailsresCount>0)
		{
		$DocsArr = '';
		$DocsArrStatus = '';
		$j=0;
  
		while($rowApptDetails = $obj->fun_db_fetch_rs_object($getApptDetailsQry))
		{
			
			$DocsArr = '';
			$DocsArrStatus = '';
			
			if(strlen($rowApptDetails->IDProof)>0) { $DocsArr[] =$rowApptDetails->IDProof; }
			if(strlen($rowApptDetails->AddressProof)>0) { $DocsArr[] =$rowApptDetails->AddressProof; }
			if(strlen($rowApptDetails->PanCard)>0) { $DocsArr[] =$rowApptDetails->PanCard; }
			if(strlen($rowApptDetails->SalSlip)>0) {
				$arrSalSlip = explode(',', $rowApptDetails->SalSlip);
				$arrSS = '';
				for($arrSCnt=0;$arrSCnt<count($arrSalSlip);$arrSCnt++)
				{
					$arrSS[]=GrossTurnoverValue($arrSalSlip[$arrSCnt]);
				}
				 $DocsArr[] = implode(', ', $arrSS); 
				
			 }
			if(strlen($rowApptDetails->BankStmnt)>0) { 
				$arrBankStmnt = explode(',', $rowApptDetails->BankStmnt);
				$arrBS = '';
				for($arrS=0;$arrS<count($arrBankStmnt);$arrS++)
				{
					$arrBS[]=BusinessDetailsValue($arrBankStmnt[$arrS]);
				}
				 $DocsArr[] = implode(', ', $arrBS); 
			}
			if(strlen($rowApptDetails->PassSizePhoto)>0) { $DocsArr[] =$rowApptDetails->PassSizePhoto; }
			
			if($rowApptDetails->IDProof_Status==1) { $DocsArrStatus[] =$rowApptDetails->IDProof; }
			if($rowApptDetails->AddressProof_Status==1) { $DocsArrStatus[] =$rowApptDetails->AddressProof; }
			if($rowApptDetails->PanCard_Status==1) { $DocsArrStatus[] =$rowApptDetails->PanCard; }
			if($rowApptDetails->SalSlip_Status==1) { $DocsArrStatus[] =$rowApptDetails->SalSlip; }
			if($rowApptDetails->BankStmnt_Status==1) { $DocsArrStatus[] =$rowApptDetails->BankStmnt; }
			if($rowApptDetails->PassSizePhoto_Status==1) { $DocsArrStatus[] =$rowApptDetails->PassSizePhoto; }
			
			$getFEDetailsSql = "select Name as FE_Name, Mobile_Number as FE_Mobile from zexternal_appointment_users where id='".$rowApptDetails->docpickerid."'";
			$getFEDetailsQry = $obj->fun_db_query($getFEDetailsSql);
			$getFEDetailsObj = $obj->fun_db_fetch_rs_object($getFEDetailsQry);
			
			$FE_Name = $getFEDetailsObj->FE_Name;
			$FE_Mobile = $getFEDetailsObj->FE_Mobile;
			
	   ?>
     <table width="100%" cellspacing="4" cellpadding="2" style="border:#000 1px solid;" >
<tr>  <td bgcolor="#003399" colspan="2" align="left"><strong style="color:#FFF;"><?php if($j==0) { echo "Appointment - "; } else { echo "Re-scheduled on ".$rowApptDetails->updated_date ; } ?>
</strong></td><td colspan="2" align="right" bgcolor="#003399"><?php if($rowApptDetails->viewstatus==111) {?><a href="edit-appointment.php?id=<?php echo $rowApptDetails->id; ?>" target="_blank" style="color:#FFF; font-weight:bold;">EDIT</a> <?php } ?></td></tr>
        <tr>  <td bgcolor="#DAEAF9" colspan="2"><strong>Remarks</strong></td><td width="27%" bgcolor="#DAEAF9"><strong>Select Date</strong></td><td width="15%" bgcolor="#DAEAF9"><strong>Select Time Slab</strong></td></tr>
        <tr>  <td bgcolor="#FFFFFF" colspan="2"><?php echo $rowApptDetails->special_remarks; ?></td>
          <td bgcolor="#FFFFFF" valign="top"><?php echo $rowApptDetails->appt_date; ?></td>
          <td bgcolor="#FFFFFF" valign="top"><?php echo $rowApptDetails->appt_time; ?></td>
        </tr>
         <tr><td colspan="4" bgcolor="#DAEAF9"  ><b>Address - </b><?php echo $rowApptDetails->Address; ?></td></tr>
         <tr><td colspan="4" bgcolor="#DAEAF9"  ><b>Documents - <?php echo implode(' , ', $DocsArr); ?> </b></td></tr>
         <tr><td colspan="4" >&nbsp;</td></tr>
         <?php if($rowApptDetails->docpickerid>0) { ?><tr><td colspan="4" bgcolor="#DAEAF9" ><b>Status</b> [Assigned to - <?php echo $FE_Name; ?> (<?php echo $FE_Mobile; ?>)]</td></tr>
         <tr><td colspan="4" ><b>Documents Picked -</b> <?php echo implode(' , ', $DocsArrStatus); ?><br />
         <b>Feedback - </b> <?php if($rowApptDetails->docStatus==1){ echo "Complete";}  
		 					  else if($rowApptDetails->docStatus==2){ echo "Incomplete Pick-up";}
							  else if($rowApptDetails->docStatus==3){ echo "Sent For Login";}
							  else if($rowApptDetails->docStatus==4){ echo "Return To Sales";}
							  else if($rowApptDetails->docStatus==5){ echo "Logged In";}	
								?><br />         
         <b>Remarks - </b> <?php echo $rowApptDetails->doc_pickup_remark;?>
         </td></tr>
        
             <?php } ?>      
          <tr><td colspan="4" style="background:#9C6;" ><b>Spoc Remark -</b><?php echo $rowApptDetails->assigned_remark; ?></td></tr>
          </table>
     <?php 
	 $j=$j+1;
	 } } ?>
    </td></tr>
      </table>
       
     </td></tr>
       
       </tr>
       </table>
   
  
</div>
</body></html>