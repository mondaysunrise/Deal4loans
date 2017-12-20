<?php
include "includes/header.php";
if(!empty($_GET['page'])){
$page = $_GET['page'];
}else{
$page = 1;
}
$limit = 10;
$start = ($page - 1) * $limit;
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
$Query = "select Req_Loan_Personal.RequestID as AllRequestID, Name,City, Mobile_Number, id, docpickerid, IDProof, AddressProof, zexternal_appointment_docs.PanCard, SalSlip, BankStmnt, PassSizePhoto, IDProof_Status, AddressProof_Status, PanCard_Status, SalSlip_Status, BankStmnt_Status, PassSizePhoto, PassSizePhoto_Status, AssignBy, docStatus, doc_pickup_remark from zexternal_appointment_docs LEFT OUTER JOIN Req_Loan_Personal ON Req_Loan_Personal.RequestID= zexternal_appointment_docs.RequestID where id!='' and zexternal_appointment_docs.Reply_Type=6 and id='".$_REQUEST['id']."'";
$result = $obj->fun_db_query($Query);
$rowsCon = $obj->fun_db_fetch_rs_object($result);

if(isset($_POST['Submit']))
{
	$EditUser =  $objAdmin->processEditDocProcess($_REQUEST['id'],"EDIT");
	if($EditUser)
	{
		$rUrl = SITE_URL."document_picked_user_details-bl.php?id=".$_REQUEST['id']."&msg=edit";
		$objAdmin->redirectURL($rUrl);
	}
}
?>
<div id="payment_container-dash_page">
  <?php //include "includes/left.php";?>

    <h1>Leads assign to Document Pickup </h1>
     <?php 
	if($_REQUEST['msg']!="")
	{
	?>
    <div class="msg_payee"><img src="./images/approved-new.png" align="absmiddle"/><?php echo $_REQUEST['msg'];?></div>
    <?php }?>
    <div id="txtHint" style="float:right; color:#0C3; font-weight:bold;"></div>
   <form name="frm" method="post" action="">
    <table width="717" cellspacing="0" cellpadding="3" border="1" style="border:solid 1px #ccc;" class="table-prolist">
      
        <tr>
          <td height="33"><strong>Name</strong> - <?php echo $rowsCon->Name;?></td>
          <td height="33"><strong>Mobile Number</strong> - <?php echo $rowsCon->Mobile_Number;?></td>
        </tr>
         <tr>
          <td height="33"><strong>City</strong></td>
          <td><?php echo $rowsCon->City;?></td>
        </tr>
        
       
        <tr>
          <td height="33">Doc Picked</td>
         <td><table> <?php
			//IDProof, AddressProof, PanCard, SalSlip, BankStmnt, PassSizePhoto 
			if(strlen($rowsCon->IDProof)>3)
			{
				?><tr><td>
                <input type="checkbox" name="IDProof_Status" id="IDProof_Status<?php echo $rowsCon->id;?>" value="1" <?php if($rowsCon->IDProof_Status==1){ echo "checked";} ?>  /> <?php echo $rowsCon->IDProof; ?></td></tr>
                <?php	
			}
			if(strlen($rowsCon->AddressProof)>3)
			{
				?><tr><td>
                <input type="checkbox" name="AddressProof_Status" id="AddressProof_Status<?php echo $rowsCon->id;?>" value="1" <?php if($rowsCon->AddressProof_Status==1){ echo "checked";} ?> /> <?php echo $rowsCon->AddressProof; ?></td></tr>
                <?php	
			}if(strlen($rowsCon->PanCard)>3)
			{
			
				?><tr><td>
                <input type="checkbox" name="PanCard_Status" id="PanCard_Status<?php echo $rowsCon->id;?>" value="1" <?php if($rowsCon->PanCard_Status==1){ echo "checked";} ?>  /> <?php echo $rowsCon->PanCard; ?></td></tr>
                <?php	
			}if(strlen($rowsCon->SalSlip)>=1)
			{
				?><tr><td>
                <input type="checkbox" name="SalSlip_Status" id="SalSlip_Status<?php echo $rowsCon->id;?>" value="1" <?php if($rowsCon->SalSlip_Status==1){ echo "checked";} ?>  /> <?php echo GrossTurnoverValue($rowsCon->SalSlip); ?></td></tr>
                <?php	
			}if(strlen($rowsCon->BankStmnt)>=1)
			{
				?><tr><td>
                <input type="checkbox" name="BankStmnt_Status" id="BankStmnt_Status<?php echo $rowsCon->id;?>" value="1" <?php if($rowsCon->BankStmnt_Status==1){ echo "checked";} ?>  /> <?php echo BusinessDetailsValue($rowsCon->BankStmnt); ?></td></tr>
                <?php	
			} 
			if(strlen($rowsCon->PassSizePhoto)>3)
			{
				?><tr><td>
                <input type="checkbox" name="PassSizePhoto_Status" id="PassSizePhoto_Status<?php echo $rowsCon->id;?>" value="1" <?php if($rowsCon->PassSizePhoto_Status==1){ echo "checked";} ?> /> <?php echo $rowsCon->PassSizePhoto; ?></td></tr>
                <?php	
			}
			
			
			?>  </table>
     </td>
        </tr>
          <tr>
          <td height="33">Doc Status</td>
          <td> <div id="DocStatusMsg<?php echo $rowsCon->id;?>" style="float:right; color:#0C3; font-weight:bold;"></div><select name="DocStatus"   onchange="funDocStatus(<?php echo $rowsCon->id;?>,this.value)">
         <option value="">Please Select</option>
         <option value="1" <?php if($rowsCon->docStatus==1){ echo "selected";} ?>>Complete</option>
          <option value="2" <?php if($rowsCon->docStatus==2){ echo "selected";} ?>>Incomplete Pick-up</option>
           <option value="3"<?php if($rowsCon->docStatus==3){ echo "selected";} ?>>Sent For Login</option>
         <option value="5"<?php if($rowsCon->docStatus==5){ echo "selected";} ?>>Logged In</option>
      <option value="4"<?php if($rowsCon->docStatus==4){ echo "selected";} ?>>Return To Sales</option>           
               <option value="6" <?php if($rowsCon->docStatus==6){ echo "selected";} ?>>Post Login Reject</option>
            <option value="7" <?php if($rowsCon->docStatus==7){ echo "selected";} ?>>Approved</option>
               <option value="8" <?php if($rowsCon->docStatus==8){ echo "selected";} ?>>Disbursed</option>

         </select></td>
            </tr>
          <tr>
          <td height="33">Remarks</td>
          <td> <textarea rows="2" cols="55" name="doc_pickup_remark" id="doc_pickup_remark" onchange="NosplcharComment(this);"><?php echo $rowsCon->doc_pickup_remark; ?></textarea></td>
        </tr>
     <tr><td colspan="2"><input type="submit" name="Submit" id="btnSubmit" value="Submit"  /></td></tr>     
    </table>
    </form>
   <div style="float:right;"> <?php echo $pagelinks;?></div>
</div>
</body></html>