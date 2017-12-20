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

$search="";
	if(isset($_GET['search']))
	{
		$search=$_GET['search'];
	}
	
	$min_date="";
	if(isset($_REQUEST['min_date']))
	{
		$min_date=$_REQUEST['min_date'];
	}

	$max_date="";
	if(isset($_REQUEST['max_date']))
	{
		$max_date=$_REQUEST['max_date'];
	}
	
	$refernce_no="";
	if(isset($_REQUEST['refernce_no']))
	{
		$refernce_no = $_REQUEST['refernce_no'];
	}
	$DocStatusSearch='';
	if(isset($_REQUEST['DocStatusSearch']))
	{
		$DocStatusSearch = $_REQUEST['DocStatusSearch'];
	}

?>
<link rel="stylesheet" type="text/css" href="../callinglms/css-datepicker/jquery-ui.css">
		<script src="../callinglms/js-datepicker/jquery-1.5.1.js"></script>
		<script src="../callinglms/js-datepicker/jquery.ui.core.js"></script>
		<script src="../callinglms/js-datepicker/jquery.ui.datepicker.js"></script>
		<script> 
			$(function() {
				var dates = $( "#min_date, #max_date" ).datepicker({
					defaultDate: "-1",
					changeMonth: true,
					changeYear: true,
					numberOfMonths: 1,
					onSelect: function( selectedDate ) {
						var option = this.id == "min_date" ? "minDate" : "maxDate",
							instance = $( this ).data( "datepicker" ),
							date = $.datepicker.parseDate(
								instance.settings.dateFormat ||
								$.datepicker._defaults.dateFormat,
								selectedDate, instance.settings );
						dates.not( this ).datepicker( "option", option, date );
					}
				});
			});

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
  
           <form name="frmsearch" action="pl_document_picked.php" method="get" onSubmit="return chkform();">
     <table width="700" border="0" cellpadding="4" cellspacing="1" class="blueborder" bgcolor="#FFFFFF" style="border:#666 1px solid;">
               <input type="hidden" name="search" id="search" value="y">
                <tr>
                  <td colspan="4" class="head1"><strong>Search</strong></td>
                </tr>
                <tr>
                  <td width="12%"><strong>Date:</strong></td>
                  <td style="width: 26%">From
                    <input name="min_date" type="text" id="min_date" size="15" value="<? echo $_REQUEST['min_date']; ?>" ></td>
                  <td style="text-align:right; width: 24%;">To
                  <input name="max_date" type="text" id="max_date" size="15" value="<? echo $_REQUEST['max_date']; ?>"></td>
                  <td width="11%" style="text-align:right;">Feedback</td>
                  <td colspan="2">
                    <select name="DocStatusSearch">
         <option value="">Please Select</option>
         <option value="1" <?php if($DocStatusSearch==1){ echo "selected";} ?>>Complete</option>
          <option value="2" <?php if($DocStatusSearch==2){ echo "selected";} ?>>Incomplete Pick-up</option>
           <option value="3" <?php if($DocStatusSearch==3){ echo "selected";} ?>>Sent For Login</option>
         <option value="5" <?php if($DocStatusSearch==5){ echo "selected";} ?>>Logged In</option>
      <option value="4" <?php if($DocStatusSearch==4){ echo "selected";} ?>>Return To Sales</option>    
      <option value="6" <?php if($DocStatusSearch==6){ echo "selected";} ?>>Approved</option>    
            <option value="7" <?php if($DocStatusSearch==7){ echo "selected";} ?>>Disbursed</option>    
                  <option value="8" <?php if($DocStatusSearch==8){ echo "selected";} ?>>Post Login Reject</option>   
                 <option value="9"<?php if($DocStatusSearch==9){ echo "selected";} ?>>Cancelled - AUD</option>                                         
                                        </select>

                  
                  </td>
               
 </tr>
                <tr>
                    <td width="29%" align="center"  valign="middle" class="bidderclass" colspan="2">Search with Ref Number</td>
	  <td valign="middle" class="bidderclass" style="width: 29%"><input type="text" name="refernce_no" id="refernce_no" value="<?php echo $refernce_no; ?>" >
</td>
                  <td style="width: 10%">&nbsp;</td>
                  <td align="left" colspan="2"><input name="Submit" type="submit" class="bluebutton" value="Search" border="0"></td>
                </tr>
            </table>
          </form>
    
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
 $BankID =  $_SESSION['BankID'];
 $Query = "select Req_Loan_Personal.RequestID as AllRequestID, Name,City, Mobile_Number, id, docpickerid, IDProof, AddressProof, zexternal_appointment_docs.PanCard, SalSlip, BankStmnt, PassSizePhoto, IDProof_Status, AddressProof_Status, PanCard_Status, SalSlip_Status, BankStmnt_Status, PassSizePhoto, PassSizePhoto_Status, AssignBy, docStatus, caller_id, zexternal_appointment_docs.Feedback_ID, zexternal_appointment_docs.BidderID, zexternal_appointment_docs.BankID from zexternal_appointment_docs LEFT OUTER JOIN Req_Loan_Personal ON Req_Loan_Personal.RequestID= zexternal_appointment_docs.RequestID where id!='' and zexternal_appointment_docs.Reply_Type=1 and zexternal_appointment_docs.viewstatus=1 and zexternal_appointment_docs.docpickerid!=0  and  zexternal_appointment_docs.BankID='".$BankID."' ";
 if($_SESSION['UserType']>1)
 { 
	$CityArr = explode(",",$_SESSION['UserCityList']);
	$CityStr = implode("','",$CityArr);
	$Query .= " and Req_Loan_Personal.City in ('".$CityStr."') ";
 }
 //echo $Query;
 
 if($search=="y")
 {		
	if((strlen($min_date)>3) && (strlen($max_date)>3 ))
	{
		$min_date=$min_date." 00:00:00";
		$max_date=$max_date." 23:59:59";
		$Query .= " and (zexternal_appointment_docs.dated  Between '".($min_date)."' and '".($max_date)."')";
	}

	if($DocStatusSearch>0)
	{
		$Query .= " and (zexternal_appointment_docs.docStatus='".$DocStatusSearch."') ";
	}

	
	if(strlen($refernce_no)>3)
	{
		list($requestidno, $bidderid) = split('[S]', $refernce_no);
		$appdtxt = "PL";
		$refernce_no_section = str_replace($appdtxt, "",$requestidno);

		$getRefIDSearchSql = "select AllRequestID from client_lead_allocate where Feedback_ID='".$refernce_no_section."'";
		$getRefIDSearchResult = $obj->fun_db_query($getRefIDSearchSql);
		$rowsRefIDSearch = $obj->fun_db_fetch_rs_object($getRefIDSearchResult);
		if($rowsRefIDSearch>0) {  } 
		else
		{ 
			$getRefIDSearchSql = "select RequestID as AllRequestID from zexternal_appointment_docs where Feedback_ID='".$refernce_no_section."'";
			$getRefIDSearchResult = $obj->fun_db_query($getRefIDSearchSql);
			$rowsRefIDSearch = $obj->fun_db_fetch_rs_object($getRefIDSearchResult);

		}
		$Query .= " AND Req_Loan_Personal.RequestID = '".$rowsRefIDSearch->AllRequestID."' ";
	}
	
}

//echo "<br>".$Query."<br>";
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
          <td>
          <?php
		  	$getRefIDSql = "select Feedback_ID,BidderID from client_lead_allocate where AllRequestID='".$rowsCon->AllRequestID."' and BidderID='".$rowsCon->caller_id."'";
			$getRefIDResult = $obj->fun_db_query($getRefIDSql);
			$rowsRefID = $obj->fun_db_fetch_rs_object($getRefIDResult);
			if(($rowsRefID->Feedback_ID)>0)
			{
		   		echo $uniqueid = "PL".$rowsRefID->Feedback_ID."S".$rowsRefID->BidderID;
			}
			else
			{
		   		echo $uniqueid = "PL".$rowsCon->Feedback_ID."S".$rowsCon->BidderID;
			
			}		   		
			



 ?><br><br>
          <a href="document_picked_user_details.php?id=<?php echo $rowsCon->id;?>" target="_blank">
          <?php echo $rowsCon->Name;?></a></td>
          
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
        
         <td> <div id="DocStatusMsg<?php echo $rowsCon->id;?>" style="float:right; color:#0C3; font-weight:bold;"></div>
          <?php
           if($rowsCon->docStatus==7)
           {
				echo "Disbursed";
		   }
		   else
		   {          
			 ?>
         
         <select name="DocStatus"   onchange="funDocStatus(<?php echo $rowsCon->id;?>,this.value)">
         <option value="">Please Select</option>
       <!--  <option value="1" <?php if($rowsCon->docStatus==1){ echo "selected";} ?>>Complete</option>
          <option value="2" <?php if($rowsCon->docStatus==2){ echo "selected";} ?>>Incomplete Pick-up</option>
           <option value="3"<?php if($rowsCon->docStatus==3){ echo "selected";} ?>>Sent For Login</option>-->
         <option value="5"<?php if($rowsCon->docStatus==5){ echo "selected";} ?>>Logged In</option>
      <option value="4"<?php if($rowsCon->docStatus==4){ echo "selected";} ?>>Return To Sales</option>    
      <option value="6"<?php if($rowsCon->docStatus==6){ echo "selected";} ?>>Approved</option>    
            <option value="7"<?php if($rowsCon->docStatus==7){ echo "selected";} ?>>Disbursed</option>    
                  <option value="8"<?php if($rowsCon->docStatus==8){ echo "selected";} ?>>Post Login Reject</option> 
                 <option value="9"<?php if($rowsCon->docStatus==9){ echo "selected";} ?>>Cancelled - AUD</option>                      
                                        </select>
                <?php } ?>                        
                                        
                                        </td>
        
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