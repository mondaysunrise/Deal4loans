<?php
include "includes/header.php";

$IP_Remote = $_SERVER["REMOTE_ADDR"];
if($IP_Remote=='192.124.249.12' || $IP_Remote=='185.93.228.12') { $IP= $_SERVER['HTTP_X_SUCURI_CLIENTIP']; }
else { $IP= $IP_Remote;	}


if(!empty($_GET['page'])){
$page = $_GET['page'];
}else{
$page = 1;
}
$limit = 20;
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

if($_REQUEST['ppId'])
{
	$objAdmin->processPickupPerson($_REQUEST['id'],$_REQUEST['ppId']);
}
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
?>		<link rel="stylesheet" type="text/css" href="../callinglms/css-datepicker/jquery-ui.css">
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
    
    <div id="PrintMsg" style="float:right; color:#0C3; font-weight:bold;"></div>
       <table width="700" border="0" cellpadding="4" cellspacing="1" class="blueborder" bgcolor="#FFFFFF" style="border:#666 1px solid;">
              <form name="frmsearch" action="pl-assign-to1.php" method="get" onSubmit="return chkform();">
               <input type="hidden" name="search" id="search" value="y">
                <tr>
                  <td colspan="4" class="head1"><strong>Search</strong></td>
                </tr>
                <tr>
                  <td width="12%"><strong>Date:</strong></td>
                  <td width="29%">From
                    <input name="min_date" type="text" id="min_date" size="15" value="<? echo $_REQUEST['min_date']; ?>" ></td>
                  <td width="13%" style="text-align:right;">To</td>
                  <td><input name="max_date" type="text" id="max_date" size="15" value="<? echo $_REQUEST['max_date']; ?>"></td>
                </tr>
                <tr>
                    <td width="29%" align="center"  valign="middle" class="bidderclass">Search with Ref Number</td>
	  <td width="58%" valign="middle" class="bidderclass"><input type="text" name="refernce_no" id="refernce_no" value="<?php echo $refernce_no; ?>" >
</td>
                  <td>&nbsp;</td>
                  <td align="left"><input name="Submit" type="submit" class="bluebutton" value="Search" border="0"></td>
                </tr>
              </form>
            </table>

    <table width="717" cellspacing="0" cellpadding="3" border="1" style="border:solid 1px #ccc;" class="table-prolist">
      <thead>
        <tr>
          <td width="90" height="33" bgcolor="#999999"><strong>Sr No</strong></td>
           <td width="190" bgcolor="#999999"><strong>Ref ID</strong></td>  
          <td width="190" bgcolor="#999999"><strong>Bank Name</strong></td>
          <td width="190" bgcolor="#999999"><strong>Name</strong></td>
        
          <td width="183" bgcolor="#999999"><strong>Mobile Num</strong></td>
          <td width="183" bgcolor="#999999"><strong>City</strong></td>
          <td width="98" bgcolor="#999999"><strong>Field Executive</strong></td>
        </tr>
      </thead>
      <tbody> 
        <?php
$w = 1;
$color = 1;
$BankID =  $_SESSION['BankID'];
$Query = "select Req_Loan_Personal.RequestID AS AllRequestID,Req_Loan_Personal.source, Name, City, Mobile_Number, docpickerid, id, caller_id, Loan_Amount, Company_Name, Net_Salary, appt_date, appt_time, special_remarks, spoc_status, assigned_remark, doc_pickup_remark, zexternal_appointment_docs.updated_date AS updateDt, docStatus, zexternal_appointment_docs.Feedback_ID, zexternal_appointment_docs.BidderID, zexternal_appointment_docs.BankID from zexternal_appointment_docs LEFT OUTER JOIN Req_Loan_Personal ON Req_Loan_Personal.RequestID= zexternal_appointment_docs.RequestID where 1=1 and zexternal_appointment_docs.Reply_Type=1 and zexternal_appointment_docs.viewstatus=1  and  zexternal_appointment_docs.AgentFeedback=1";
$search_query = "select Req_Loan_Personal.RequestID AS AllRequestID, Name, City, City_Other, Mobile_Number, docpickerid, id, caller_id, Loan_Amount, Company_Name, Net_Salary, appt_date, appt_time, special_remarks, spoc_status, assigned_remark, doc_pickup_remark, zexternal_appointment_docs.updated_date AS updateDt, docStatus from zexternal_appointment_docs LEFT OUTER JOIN Req_Loan_Personal ON Req_Loan_Personal.RequestID= zexternal_appointment_docs.RequestID where 1=1 and zexternal_appointment_docs.Reply_Type=1 and zexternal_appointment_docs.viewstatus=1 ";
 if($_SESSION['UserType']>1)
 {
//	  City LIKE '%".$Customer_City."%'
	$agent_ids = $_SESSION['agent_ids'];
	$CityArr = explode(",",$_SESSION['UserCityList']);
	$CityStr = implode("','",$CityArr);
	$Query .= " and Req_Loan_Personal.City in ('".$CityStr."') and zexternal_appointment_docs.caller_id in (".$agent_ids.")  and zexternal_appointment_docs.BankID in (".$BankID.") ";
	$search_query .=  " and Req_Loan_Personal.City in ('".$CityStr."') ";
	
 }
 
 if($search=="y")
 {		
	if((strlen($min_date)>3) && (strlen($max_date)>3 ))
	{
		$min_date=$min_date." 00:00:00";
		$max_date=$max_date." 23:59:59";
		$Query .= " and (zexternal_appointment_docs.dated  Between '".($min_date)."' and '".($max_date)."')";
		$search_query .=  " and (zexternal_appointment_docs.dated  Between '".($min_date)."' and '".($max_date)."')";
	}


	if(strlen($refernce_no)>3)
	{
		list($requestidno, $bidderid) = split('[S]', $refernce_no);
		$appdtxt = "PL";
		$refernce_no_section = str_replace($appdtxt, "",$requestidno);

		echo $getRefIDSearchSql = "select RequestID as AllRequestID from zexternal_appointment_docs where Feedback_ID='".$refernce_no_section."'";
		$getRefIDSearchResult = $obj->fun_db_query($getRefIDSearchSql);
		$rowsRefIDSearch = $obj->fun_db_fetch_rs_object($getRefIDSearchResult);
               
                print_r($rowsRefIDSearch);
		$Query .= " AND Req_Loan_Personal.RequestID = '".$rowsRefIDSearch->AllRequestID."' ";
		
	}
	
}
 
$resultCount = $obj->fun_db_query($Query);
$resCount = $obj->fun_db_get_num_rows($resultCount);
if($resCount>$limit)
{
$pagelinks = paginate($limit, $resCount);
}
$Query.= " ORDER BY id DESC LIMIT $start,$limit ";
echo "<br>".$Query."<br>";
if($IP='182.71.109.218')
{
	
//	echo $getRefIDSearchSql;
//echo "<br><br>Get Search Qry - ";

//echo $search_query;
}
$result = $obj->fun_db_query($Query);
while($rowsCon = $obj->fun_db_fetch_rs_object($result))
	{
		
		if($color %2!=0){
			$colorvar = "#FFFFFF";
		}
		else {
			$colorvar = "#DDD";
		}
	
	
 ?>
        <tr bgcolor="<?php echo $colorvar; ?>">
          <td><?php echo $w; ?></td>
           <td><?php
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
			if(strlen(strpos($rowsCon->source, "wf")) > 0)
			{
				$validateWFLeadSql = "select AllRequestID as checkRequestID from plcallinglms_allocation where (BidderID in (select BidderID from Bidders where leadidentifier='plalloclms' ) and AllRequestID='".$rowsCon->AllRequestID."')";
				$validateWFLeadResult = $obj->fun_db_query($validateWFLeadSql);
				$rowsvalidateWFLead = $obj->fun_db_fetch_rs_object($validateWFLeadResult);
				if($rowsvalidateWFLead->checkRequestID==$rowsCon->AllRequestID)
				{
					echo "<br><b>WishFin</b>";
				}
			}
			 ?></td>
            <td><?php 
	//		$getBankSql = "select Associated_Bank from Bidders left join Req_Feedback_Bidder_PL on Bidders.BidderID=Req_Feedback_Bidder_PL.BidderID where Req_Feedback_Bidder_PL.AllRequestID='".$rowsCon->AllRequestID."' and Bidders.Associated_Bank in ('Tata Capital', 'ICICI Bank')";
			$getBankSql = "select Associated_Bank from Bidders where BidderID='".$rowsCon->caller_id."' and Bidders.Associated_Bank in ('Tata Capital', 'ICICI Bank')";
			$getBankResult = $obj->fun_db_query($getBankSql);
			$rowsBank = $obj->fun_db_fetch_rs_object($getBankResult);
			
			if(strlen($rowsBank->Associated_Bank)>0)
			{
				echo $rowsBank->Associated_Bank;
			}
			else
			{
				$getBankSql = "select Bank_Name from Bank_Master where BankID='".$rowsCon->BankID."'";
				$getBankResult = $obj->fun_db_query($getBankSql);
				$rowsBank = $obj->fun_db_fetch_rs_object($getBankResult);
				echo $rowsBank->Bank_Name;
			}			
			
			?></td>
          <td><a href="doc-pick-user-details.php?id=<?php echo $rowsCon->id;?>" target="_blank"><?php echo $rowsCon->Name;?></a></td>
          
            <td><?php echo $rowsCon->Mobile_Number;?></td>
          <td><?php echo $rowsCon->City;?></td>
          <td>
		  <select name="pickup_person" id="pickup_person"  onchange="loadDoc(<?php echo $rowsCon->id;?>,this.value,'<?php echo $_SESSION['UID'];?>')">
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
		  ?></select>
          </td>
        </tr>
        <?php $w++;$color++;}?>
       
    </table>
    </td>
    </tr>
   
    </tbody>
    </table>
   <div style="float:right;"> <?php echo $pagelinks;?></div>
   <div style="clear:both; height:4px;"></div>
  <?php
  if($_SESSION['UserType']==1) {
   if($search=="y")
 {		
 ?> 
   <div style="float:right;"> <table  border="0" cellpadding="5" cellspacing="1" align="center">
              <tr>
                <td style="color:#FFF;" align="center" bgcolor="#FFFFFF">
                <form name="frmdownload" action="/misdocs_download.php" method="post">
	 <input type="hidden" name="qry1" value="<? echo $search_query; ?>">
	  <input type="hidden" name="qry2" value="<? echo $val; ?>">
	 <input type="hidden" name="min_date" value="<? echo $min_date; ?>">
	 <input type="hidden" name="max_date" value="<? echo $max_date; ?>">
	 <input name="Submit2" type="submit" class="bluebtn" value="Export List To Excel">
 </form>

                
</td>
              </tr>
            </table>
                    
</div>
  <?php } }
  
  
  ?>
  
  </div>
</div>
</body></html>