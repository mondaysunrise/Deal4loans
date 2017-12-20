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
    <option value="Electricity Bill" <?php if(trim($PassSizePhoto)=="Electricity Bill") {echo "Selected";} ?>>Electricity Bill</option>
      <option value="Sales Deed copy" <?php if(trim($PassSizePhoto)=="Sales Deed copy") {echo "Selected";} ?>>Sales Deed copy</option>
      </select>
	</td>
	<td class="fontstyle"><b>Business Details</b></td>
	<td class="fontstyle">
    <?php $arrBankSTAT = explode(',', $BankStmnt); ?>
    <select name="BankStmnt[]" id="BankStmnt" style="width:170px;" multiple="multiple">
    <option value="">Please Select</option>
    <option value="1" <?php if(in_array(1, $arrBankSTAT)) {echo "Selected";} ?>>Business continuity proof – 3 years  and  more income tax return & income statements</option>
      <option value="2" <?php if(in_array(2, $arrBankSTAT)) {echo "Selected";} ?>>Last 2/3year audit re port and audited Financials</option>
      <option value="3" <?php if(in_array(3, $arrBankSTAT)) {echo "Selected";} ?>>Last 6-12 months bank statements</option>
      <option value="4" <?php if(in_array(4, $arrBankSTAT)) {echo "Selected";} ?>>In the case of transfer of a loan: Last 12 months of  loans statement  along with the Sanction Letter of your previous bank</option>
      <option value="5" <?php if(in_array(5, $arrBankSTAT)) {echo "Selected";} ?>>Any other loan statements on books of companies along with Sanction Letters</option>
      <option value="6" <?php if(in_array(6, $arrBankSTAT)) {echo "Selected";} ?>>Last 12 months loan statement with Sanction Letter of any other existing loans</option>
     <option value="7" <?php if(in_array(7, $arrBankSTAT)) {echo "Selected";} ?>>Business incorporation date proof – PAN Card</option>    <option value="8" <?php if(in_array(8, $arrBankSTAT)) {echo "Selected";} ?>>MOA(Memorandum of Association) and AOA (Articles of Association)</option>   
      <option value="9" <?php if(in_array(9, $arrBankSTAT)) {echo "Selected";} ?>>Latest shareholding pattern on company letterhead</option>
      <option value="10" <?php if(in_array(10, $arrBankSTAT)) {echo "Selected";} ?>>List of current Directors on company letterhead.</option>      
      <option value="11" <?php if(in_array(11, $arrBankSTAT)) {echo "Selected";} ?>>Certificate of Incorporation</option>      
    <option value="12" <?php if(in_array(12, $arrBankSTAT)) {echo "Selected";} ?>>Partnership Deed</option>   
      <option value="13" <?php if(in_array(13, $arrBankSTAT)) {echo "Selected";} ?>>Certificate of Registration</option>
      <option value="14" <?php if(in_array(14, $arrBankSTAT)) {echo "Selected";} ?>>Proof of continuation:  Trade license /Establishment /Sales Tax certificate</option>      
      <option value="15" <?php if(in_array(15, $arrBankSTAT)) {echo "Selected";} ?>>Proof of continuation: Trade license /Establishment /Sales Tax certificate/ SSI Registration</option>      
    <option value="16" <?php if(in_array(16, $arrBankSTAT)) {echo "Selected";} ?>>Brief Business Profile on the Letter Head of the firm by the applicant</option>   
      <option value="17" <?php if(in_array(17, $arrBankSTAT)) {echo "Selected";} ?>>Copy of Tax Deduction Certificate 26 AS  / Form – 16A (if applicable)</option>
      <option value="18" <?php if(in_array(18, $arrBankSTAT)) {echo "Selected";} ?>>Copy of Advance Tax paid / Self Assessment Tax paid challan</option>      
      <option value="19" <?php if(in_array(19, $arrBankSTAT)) {echo "Selected";} ?>>Copy of Educational Qualification Certificate ( professional  loans ) </option>      
<option value="20" <?php if(in_array(20, $arrBankSTAT)) {echo "Selected";} ?>>Copy of Professional Practice Certificate</option>   
<option value="21" <?php if(in_array(21, $arrBankSTAT)) {echo "Selected";} ?>>Salary Certificate (in case of doctors having salaried income)</option>   
      </select>   </td>
</tr>
<tr>
	<td class="fontstyle"><b>Gross Turnover</b></td>
	<td>
        <?php $arrSalSlip = explode(',', $SalSlip); ?>
     <select name="SalSlip[]" id="SalSlip" style="width:170px;" multiple="multiple">
    <option value="">Please Select</option>
    <option value="1" <?php if(in_array(1, $arrSalSlip)) {echo "Selected";} ?>>Latest 2  Years ITRs' , Computation of Income, P&L, Balance sheet with all schedules with CA seal and sign</option>
   <option value="2" <?php if(in_array(2, $arrSalSlip)) {echo "Selected";} ?>>Tax Audit Report (Where Gross Turnover Exceeds Rs 1 Crs for Non Professional Self Employed and Gross Receipts Exceeds 25 Lacs incase of Professionals and )</option>
   <option value="3" <?php if(in_array(3, $arrSalSlip)) {echo "Selected";} ?>>Last 1 Year bank statements (with logo and Bank name) both Current and SB Account</option>
   <option value="4" <?php if(in_array(4, $arrSalSlip)) {echo "Selected";} ?>>Business Continuity Proof for 3 Yrs</option>
   <option value="5" <?php if(in_array(5, $arrSalSlip)) {echo "Selected";} ?>>Existing loan details and 6 months emi reflecting bank statement</option>
   <option value="6" <?php if(in_array(6, $arrSalSlip)) {echo "Selected";} ?>>Latest LOD,OS Letter and Last 12 Months SOA in case of BT Proposal</option>
   <option value="7" <?php if(in_array(7, $arrSalSlip)) {echo "Selected";} ?>>Partnership Deed & Latest list of partners & NOC as per Bank  bank format</option>
   <option value="8" <?php if(in_array(8, $arrSalSlip)) {echo "Selected";} ?>>In case applicant is a Partner- Partnership firm's audited ITR along with complete financials to be collected</option>
   <option value="9" <?php if(in_array(9, $arrSalSlip)) {echo "Selected";} ?>>Partnership Authority Letter on Letterhead of the Firm signed by all partners in case Firm to stand as guarantor</option>
   <option value="10" <?php if(in_array(10, $arrSalSlip)) {echo "Selected";} ?>>Incase applicant is a Director, then the company's  audited ITR along with complete financials to be collected</option>
   <option value="11" <?php if(in_array(11, $arrSalSlip)) {echo "Selected";} ?>>Board Resolution as per Bank  bank format- Incase company is applicant/guarantor</option>
   <option value="12" <?php if(in_array(12, $arrSalSlip)) {echo "Selected";} ?>>Certificate of Incorporation</option>
   <option value="13" <?php if(in_array(13, $arrSalSlip)) {echo "Selected";} ?>>MOA and AOA</option>
   <option value="14" <?php if(in_array(14, $arrSalSlip)) {echo "Selected";} ?>>DIN of all Directors to be collected where company is applicant,Co_Applicant or Guarantor to the Loan</option>
      <option value="15" <?php if(in_array(15, $arrSalSlip)) {echo "Selected";} ?>>Latest Share Holding Pattern</option>
    </select>
	</td>
	<td class="fontstyle"><b></b></td>
	<td class="fontstyle">
    </td>
</tr>    
       <tr><td colspan="3" align="left" class="fontstyle">&nbsp;</td><td align="right"><input type="submit" name="submit_appdt" value="Save" style="background-color:#036; color:#fff; font-size:17px;"></td></tr> 
       </table></td></tr></table></form>