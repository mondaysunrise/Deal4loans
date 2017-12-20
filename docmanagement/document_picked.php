<?php
include "includes/header.php";
if(!empty($_GET['page'])){
$page = $_GET['page'];
}else{
$page = 1;
}
$limit = 10;
$start = ($page - 1) * $limit;
if(isset($_REQUEST['del'])=="yes")	
	{
		$sql = "DELETE FROM ".TABLE_USER. " WHERE id='".$_REQUEST['id']."'";
		$resultDel = $obj->fun_db_query($sql);
		if($resultDel)
			{
				$msg = BANK_DEL_MSG;
			}
	}
//echo "<pre>";	
//print_r($_SESSION);
?>
<script>
function processForm(id) {
	
	var IDProof_Status = document.getElementById('IDProof_Status'+id).checked;
	if(IDProof_Status==true)
	{
		var IDProofStatus = 1;	
	}
	var AddressProof_Status = document.getElementById('AddressProof_Status'+id).checked;
	if(AddressProof_Status==true)
	{
		var AddressProofStatus = 1;	
	}
	var PanCard_Status = document.getElementById('PanCard_Status'+id).checked;
	if(PanCard_Status==true)
	{
		var PanCardStatus = 1;	
	}
	var SalSlip_Status = document.getElementById('SalSlip_Status'+id).checked;
	if(SalSlip_Status==true)
	{
		var SalSlipStatus = 1;	
	}
	var BankStmnt_Status = document.getElementById('BankStmnt_Status'+id).checked;
	if(BankStmnt_Status==true)
	{
		var BankStmntStatus = 1;	
	}
	var PassSizePhoto_Status = document.getElementById('PassSizePhoto_Status'+id).checked;
	if(PassSizePhoto_Status==true)
	{
		var PassSizePhotoStatus = 1;	
	}
	if (id == "") {
        document.getElementById("txtHint").innerHTML = "";
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
                document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
            }
        };
		
        xmlhttp.open("GET","documentPickedAjax.php?id="+id+"&IDProof_Status="+IDProofStatus+"&AddressProof_Status="+AddressProofStatus+"&PanCard_Status="+PanCardStatus+"&SalSlip_Status="+SalSlipStatus+"&BankStmnt_Status="+BankStmntStatus+"&PassSizePhoto_Status="+PassSizePhotoStatus,true);
        xmlhttp.send();
    }
	
}
</script>

<script>
function funDocStatus(id,DocSts) {
	if (id == "") {
        document.getElementById("DocStatusMsg"+id).innerHTML = "";
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
                document.getElementById("DocStatusMsg"+id).innerHTML = xmlhttp.responseText;
            }
        };
		
        xmlhttp.open("GET","documentPickedAjax.php?id="+id+"&DocSts="+DocSts,true);
        xmlhttp.send();
    }
}
</script>

<div id="payment_container-dash_page">
  <?php include "includes/left.php";?>
  <div class="content_right">
    <h1>Leads assign to Document Pickup </h1>
    <br />
    <?php 
	if($_REQUEST['msg']!="")
			{
			?>
    <div class="msg_payee"><img src="./images/approved-new.png" align="absmiddle"/><?php echo $_REQUEST['msg'];?></div>
    <?php }?>
    <div id="txtHint" style="float:right; color:#0C3; font-weight:bold;"></div>
    
    <table width="717" cellspacing="0" cellpadding="3" border="1" style="border:solid 1px #ccc;" class="table-prolist">
      <thead>
        <tr>
          <td width="39" height="33" bgcolor="#999999"><strong>Sr No</strong></td>
          <td width="103" bgcolor="#999999"><strong>Name</strong></td>
        
          <td width="113" bgcolor="#999999"><strong>Mobile Num</strong></td>
          <td width="145" bgcolor="#999999"><strong>Doc Picker</strong></td>
          <td width="97" bgcolor="#999999"><strong>Assign By</strong></td>
          <td width="170" bgcolor="#999999"><strong>Doc Picked</strong></td>
          <td width="170" bgcolor="#999999"><strong>Doc Status</strong></td>
        </tr>
      </thead>
      <tbody>
        <?php
 $w = 1;
 $color = 1;
 $Query = "select Req_Loan_Personal.RequestID as AllRequestID, Name,City, Mobile_Number, id, docpickerid, IDProof, AddressProof, PanCard, SalSlip, BankStmnt, PassSizePhoto, IDProof_Status, AddressProof_Status, PanCard_Status, SalSlip_Status, BankStmnt_Status, PassSizePhoto, PassSizePhoto_Status, AssignBy, docStatus from zexternal_appointment_docs LEFT OUTER JOIN Req_Loan_Personal ON Req_Loan_Personal.RequestID= zexternal_appointment_docs.RequestID where id!=''";
 if($_SESSION['UserType']>1)
 { 
   $Query .= " and Req_Loan_Personal.City='".$_SESSION['UserCity']."' ";
 }

$resultCount = $obj->fun_db_query($Query);
$resCount = $obj->fun_db_get_num_rows($resultCount);
if($resCount>$limit)
{
$pagelinks = paginate($limit, $resCount);
}
$Query.= " ORDER BY id DESC LIMIT $start,$limit ";

$result = $obj->fun_db_query($Query);
//echo $Query."<br>";
while($rowsCon = $obj->fun_db_fetch_rs_object($result))
	{
		
		if($color %2!=0){
				$colorvar = "#FFFFFF";
			}
		else{
				$colorvar = "#DDD";
			}
	
	$UserInfo = $objAdmin->fun_getAdminUserInfo($rowsCon->AssignBy);
	
 ?>
        <tr bgcolor="<?php echo $colorvar;?>">
          <td><?php echo $w;?></td>
          <td><?php echo $rowsCon->Name;?></td>
          
            <td><?php echo $rowsCon->Mobile_Number;?></td>
          <td>
		  <?php // Query for pickup Guy.
		  	$getPickupSql = "select * from zexternal_appointment_users where id = '".$rowsCon->docpickerid."' "; 
		  	$getPickupResult = $obj->fun_db_query($getPickupSql);
			$rowsgetPickup = $obj->fun_db_fetch_rs_object($getPickupResult);
				echo $rowsgetPickup->Name;
		  ?>
          </td>
           <td><?php echo $UserInfo['Name'];?></td>
       <form name="frm" method="post" action="">
        <td>
			<?php
			//IDProof, AddressProof, PanCard, SalSlip, BankStmnt, PassSizePhoto 
			if(strlen($rowsCon->IDProof)>3)
			{
				?>
                <input type="checkbox" name="IDProof_Status" id="IDProof_Status<?php echo $rowsCon->id;?>" value="1" <?php if($rowsCon->IDProof_Status==1){ echo "checked";} ?>  /> <?php echo $rowsCon->IDProof; ?><br />
                <?php	
			}
			if(strlen($rowsCon->AddressProof)>3)
			{
				?>
                <input type="checkbox" name="AddressProof_Status" id="AddressProof_Status<?php echo $rowsCon->id;?>" value="1" <?php if($rowsCon->AddressProof_Status==1){ echo "checked";} ?> /> <?php echo $rowsCon->AddressProof; ?><br />
                <?php	
			}if(strlen($rowsCon->PanCard)>3)
			{
			
				?>
                <input type="checkbox" name="PanCard_Status" id="PanCard_Status<?php echo $rowsCon->id;?>" value="1" <?php if($rowsCon->PanCard_Status==1){ echo "checked";} ?>  /> <?php echo $rowsCon->PanCard; ?><br />
                <?php	
			}if(strlen($rowsCon->SalSlip)>3)
			{
				?>
                <input type="checkbox" name="SalSlip_Status" id="SalSlip_Status<?php echo $rowsCon->id;?>" value="1" <?php if($rowsCon->SalSlip_Status==1){ echo "checked";} ?>  /> <?php echo $rowsCon->SalSlip; ?><br />
                <?php	
			}if(strlen($rowsCon->BankStmnt)>3)
			{
				?>
                <input type="checkbox" name="BankStmnt_Status" id="BankStmnt_Status<?php echo $rowsCon->id;?>" value="1" <?php if($rowsCon->BankStmnt_Status==1){ echo "checked";} ?>  /> <?php echo $rowsCon->BankStmnt; ?><br />
                <?php	
			} 
			if(strlen($rowsCon->PassSizePhoto)>3)
			{
				?>
                <input type="checkbox" name="PassSizePhoto_Status" id="PassSizePhoto_Status<?php echo $rowsCon->id;?>" value="1" <?php if($rowsCon->PassSizePhoto_Status==1){ echo "checked";} ?> /> <?php echo $rowsCon->PassSizePhoto; ?>
                <?php	
			}
			
			
			?>  <br />      
        <input type="button" name="save_value" id="btnSubmit" value="Save" onclick="processForm(<?php echo $rowsCon->id;?>)" />
        
        </td></form>
        
         <td> <div id="DocStatusMsg<?php echo $rowsCon->id;?>" style="float:right; color:#0C3; font-weight:bold;"></div><select name="DocStatus"   onchange="funDocStatus(<?php echo $rowsCon->id;?>,this.value)">
         <option value="">Select Doc Status</option>
         <option value="1" <?php if($rowsCon->docStatus==1){ echo "selected";} ?>>Complete</option>
          <option value="2" <?php if($rowsCon->docStatus==2){ echo "selected";} ?>>Incomplete</option>
           <option value="3"<?php if($rowsCon->docStatus==3){ echo "selected";} ?>>Login</option>
         </select></td>
        
        </tr>
        <?php $w++;$color++;}?>
       
    </table>
    </td>
    </tr>
   
    </tbody>
    </table>
   <div style="float:right;"> <?php echo $pagelinks;?></div>
  </div>
</div>
</body></html>