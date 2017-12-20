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
 $Query = "select Req_Loan_Personal.RequestID as AllRequestID, Name,City, Mobile_Number, id, docpickerid, IDProof, AddressProof, zexternal_appointment_docs.PanCard, SalSlip, BankStmnt, PassSizePhoto, IDProof_Status, AddressProof_Status, PanCard_Status, SalSlip_Status, BankStmnt_Status, PassSizePhoto, PassSizePhoto_Status, AssignBy, docStatus from zexternal_appointment_docs LEFT OUTER JOIN Req_Loan_Personal ON Req_Loan_Personal.RequestID= zexternal_appointment_docs.RequestID where id!='' and zexternal_appointment_docs.Reply_Type=6 and zexternal_appointment_docs.viewstatus=1 and  zexternal_appointment_docs.docpickerid!=0 ";
 if($_SESSION['UserType']>1)
 { 
	$CityArr = explode(",",$_SESSION['UserCityList']);
	$CityStr = implode("','",$CityArr);
	$Query .= " and Req_Loan_Personal.City in ('".$CityStr."') ";
 }
 //echo $Query;

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
          <td><a href="document_picked_user_details-bl.php?id=<?php echo $rowsCon->id;?>" target="_blank"><?php echo $rowsCon->Name;?></a></td>
          
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
			}if(strlen($rowsCon->SalSlip)>=1)
			{
				?>
                <input type="checkbox" name="SalSlip_Status" id="SalSlip_Status<?php echo $rowsCon->id;?>" value="1" <?php if($rowsCon->SalSlip_Status==1){ echo "checked";} ?>  /> <?php echo GrossTurnoverValue($rowsCon->SalSlip); ?><br />
                <?php	
			}if(strlen($rowsCon->BankStmnt)>=1)
			{
				?>
                <input type="checkbox" name="BankStmnt_Status" id="BankStmnt_Status<?php echo $rowsCon->id;?>" value="1" <?php if($rowsCon->BankStmnt_Status==1){ echo "checked";} ?>  /> <?php echo BusinessDetailsValue($rowsCon->BankStmnt); ?><br />
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