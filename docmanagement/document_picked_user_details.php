<?php
include "includes/header.php";
if(!empty($_GET['page'])){
$page = $_GET['page'];
}else{
$page = 1;
}
$limit = 10;
$start = ($page - 1) * $limit;

$Query = "select Req_Loan_Personal.RequestID as AllRequestID, Name,City, Mobile_Number, id, docpickerid, IDProof, AddressProof, zexternal_appointment_docs.PanCard, SalSlip, BankStmnt, PassSizePhoto, IDProof_Status, AddressProof_Status, PanCard_Status, SalSlip_Status, BankStmnt_Status, PassSizePhoto, PassSizePhoto_Status, AssignBy, docStatus, doc_pickup_remark,feedback_date, disbursed_date from zexternal_appointment_docs LEFT OUTER JOIN Req_Loan_Personal ON Req_Loan_Personal.RequestID= zexternal_appointment_docs.RequestID where id!='' and zexternal_appointment_docs.Reply_Type=1 and id='".$_REQUEST['id']."'";
$result = $obj->fun_db_query($Query);
$rowsCon = $obj->fun_db_fetch_rs_object($result);

if(isset($_POST['Submit']))
{
	$EditUser =  $objAdmin->processEditDocProcess($_REQUEST['id'],"EDIT");
	if($EditUser)
	{
		$rUrl = SITE_URL."document_picked_user_details.php?id=".$_REQUEST['id']."&msg=edit";
		$objAdmin->redirectURL($rUrl);
	}
}
	
?>
<link rel="stylesheet" type="text/css" href="../callinglms/css-datepicker/jquery-ui.css">
		<script src="../callinglms/js-datepicker/jquery-1.5.1.js"></script>
		<script src="../callinglms/js-datepicker/jquery.ui.core.js"></script>
		<script src="../callinglms/js-datepicker/jquery.ui.datepicker.js"></script>
<script>
		$(document).ready(function() {
			
			var date = new Date();
			var m = date.getMonth(), d = date.getDate(), y = date.getFullYear();
			
			$('#disbursalMonth').datepicker({
                                        changeMonth: true,
					changeYear: true,				
            				maxDate: new Date(y, m, d),
					dateFormat: 'yy-mm-dd'
			});
			}); 
			$(function() {
				$( "#disbursalMonth" ).datepicker();
				
			});
			
                        
                        function funDocStatus(StatusVal,fid){
                            
                        if(fid!= 7)
                        {
                        document.getElementById('ShowHideDisBurs').style.display = "none";
                    }else{
                        document.getElementById('ShowHideDisBurs').style.display = "block";
                        }
                    }
		</script> 
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
			}if(strlen($rowsCon->SalSlip)>3)
			{
				?><tr><td>
                <input type="checkbox" name="SalSlip_Status" id="SalSlip_Status<?php echo $rowsCon->id;?>" value="1" <?php if($rowsCon->SalSlip_Status==1){ echo "checked";} ?>  /> <?php echo $rowsCon->SalSlip; ?></td></tr>
                <?php	
			}if(strlen($rowsCon->BankStmnt)>3)
			{
				?><tr><td>
                <input type="checkbox" name="BankStmnt_Status" id="BankStmnt_Status<?php echo $rowsCon->id;?>" value="1" <?php if($rowsCon->BankStmnt_Status==1){ echo "checked";} ?>  /> <?php echo $rowsCon->BankStmnt; ?></td></tr>
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
    <!--     <option value="1" <?php if($rowsCon->docStatus==1){ echo "selected";} ?>>Complete</option>
          <option value="2" <?php if($rowsCon->docStatus==2){ echo "selected";} ?>>Incomplete Pick-up</option>
           <option value="3"<?php if($rowsCon->docStatus==3){ echo "selected";} ?>>Sent For Login</option>-->
         <option value="5"<?php if($rowsCon->docStatus==5){ echo "selected";} ?>>Logged In</option>

      <option value="4"<?php if($rowsCon->docStatus==4){ echo "selected";} ?>>Return To Sales</option>  
            <option value="6"<?php if($rowsCon->docStatus==6){ echo "selected";} ?>>Approved</option>    
            <option value="7"<?php if($rowsCon->docStatus==7){ echo "selected";} ?>>Disbursed</option>    
                  <option value="8"<?php if($rowsCon->docStatus==8){ echo "selected";} ?>>Post Login Reject</option>    
                              <option value="9"<?php if($rowsCon->docStatus==9){ echo "selected";} ?>>Cancelled - AUD</option>                      
         
         </select>   <span id="ShowHideDisBurs" <?php if($rowsCon->docStatus!=7) { ?> style="display:none;" <?php }?>>Disbursal Month : <input type="text" name="disbursalMonth" id="disbursalMonth" value="<?php echo date("Y-m-d", strtotime($rowsCon->disbursed_date)); ?>" /></span></td>
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