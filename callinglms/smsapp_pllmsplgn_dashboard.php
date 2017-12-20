<?php
require_once("includes/application-top-inner.php");
define("NoOFLMS", 2);
if(!empty($_GET['page'])){
$page = $_GET['page'];
}else{
$page = 1;
}
$limit = 25;
$start = ($page - 1) * $limit;

$BidderIDstatic="";
	if(isset($_REQUEST['BidderIDstatic']) && strlen($_REQUEST['BidderIDstatic'])>0 )
	{
		 $BidderIDstatic=$_REQUEST['BidderIDstatic'];
	}
	else
	{
		$BidderIDstatic=$_SESSION['BidderID'];
	}
	
$salaryclause="";
if(isset($_REQUEST['salaryrange']))
{
	$salaryclause=$_REQUEST['salaryrange'];
}
   
  $val = "Req_Loan_Personal";
  
	$FeedbackClause="";
	//$OrderBy=" order by Req_Loan_Personal.Dated desc";
	$mob_num="";
	if(isset($_REQUEST['mob_num']))
	{
		$mob_num = $_REQUEST['mob_num'];
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

	$varCmbFeedback="";
	if(isset($_REQUEST['cmbfeedback']))
	{
		$varCmbFeedback=$_REQUEST['cmbfeedback'];
	}
	
	$cmbbankwise="";
	if(isset($_REQUEST['cmbbankwise']))
	{
		$cmbbankwise=$_REQUEST['cmbbankwise'];
	}

	$RequestID="";
	if(isset($_REQUEST['RequestID']))
	{
		$RequestID=$_REQUEST['RequestID'];
	}
	$type="";
	if(isset($_REQUEST['type']))
	{
		$type=$_REQUEST['type'];
	}
	$Feedback="";
	if(isset($_REQUEST['Feedback']))
	{
		$Feedback=$_REQUEST['Feedback'];
}	
?>
<html>
		<head>
		<meta http-equiv="Content-Language" content="en-us">
		<meta http-equiv="Content-Type" content="text/html; charset=WINDOWS-1252">
		<title>Login</title>
		<script Language="JavaScript" Type="text/javascript" src="../scripts/common.js"></script>
		<link href="../includes/style1.css" rel="stylesheet" type="text/css">
		<link href="../style.css" rel="stylesheet" type="text/css" />
		<script language="javascript" type="text/javascript" src="../scripts/datetime.js"></script>
		<style>
/* Pagination*/
div.pagination {
	padding: 3px;
	margin: 3px;
}
div.pagination a {
	padding: 2px 5px 2px 5px;
	margin: 2px;
	border: 1px solid #AAAADD;
	text-decoration: none; /* no underline */
	color: #000099;
}
div.pagination a:hover, div.pagination a:active {
	border: 1px solid #000099;
	color: #000;
}
div.pagination span.current {
	padding: 2px 5px 2px 5px;
	margin: 2px;
	border: 1px solid #000099;
	font-weight: bold;
	background-color: #2b62b5;
	color: #FFF;
}
div.pagination span.disabled {
	padding: 2px 5px 2px 5px;
	margin: 2px;
	border: 1px solid #CCC;
	color: #CCC;
}
</style>
		<!--DatePicker Start-->
		<link rel="stylesheet" type="text/css" href="css-datepicker/jquery-ui.css">
		<link rel="stylesheet" type="text/css" href="css-datepicker/datepicker.css">
		<script src="js-datepicker/jquery-1.5.1.js"></script>
		<script src="js-datepicker/jquery.ui.core.js"></script>
		<script src="js-datepicker/jquery.ui.datepicker.js"></script>
		<script> 
			$(function() {
				var dates = $( "#min_date, #max_date" ).datepicker({
					defaultDate: "+1w",
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

		function MM_jumpMenu(targ,selObj,restore){ //v3.0
 eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
if (restore) selObj.selectedIndex=0;
}
		</script>
		<!--DatePicker End-->
		</head>
		<body style="margin:0px 0px 0px 0px; padding:0px 0px 0px 0px; background-color:#45B2D8;">
<!-- End Main Banner Menu Panel --><div style="width:100%; background: #CCC; padding:0px 0px 10px 0px;"><div style="background:#F00; width:40px; padding-left:7px; line-height:30px; height:30px; float:right; margin-right:50px; margin-top:7px; border-radius:20%;"><a href="logout.php" style="color:#FFF; text-align:center; text-decoration:none; font-size:12px;">Logout</a></div>
<div style="clear:both;"></div>
</div>
<div style="clear:both; height:15px;"></div>
          <div> 
    <table width="98%" border="0">
	              <tr>
        <td align="center" width="100%"><div align="center">
            <table width="600" border="0" cellpadding="4" cellspacing="1" class="blueborder" bgcolor="#FFFFFF">
              <form name="frmsearch" action="smsapp_pllmsplgn_dashboard.php" method="get" onSubmit="return chkform();">
                <input type="hidden" name="BidderIDstatic" id="BidderIDstatic" value="<? echo $BidderIDstatic;?>">
                <input type="hidden" name="search" id="search" value="y">
                <tr>
                  <td colspan="4" class="head1">Search</td>
                </tr>
                <tr>
                  <td colspan="3">&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td width="12%"><strong>Date:</strong></td>
                  <td width="29%">From
                    <input name="min_date" type="text" id="min_date" size="15" value="<? echo $_REQUEST['min_date']; ?>" ></td>
                  <td width="13%" style="text-align:right;">To</td>
                  <td><input name="max_date" type="text" id="max_date" size="15" value="<? echo $_REQUEST['max_date']; ?>"></td>
                </tr>
                <tr>
                  <td width="12%"><strong>Feedback:</strong></td>
                  <td width="29%"><select name="cmbfeedback" id="cmbfeedback">
                   	<option value="All" <? if($varCmbFeedback == "All") { echo "selected"; } ?>>All</option>
					<option value="" <? if($varCmbFeedback == "") { echo "selected"; } ?>>No Feedback</option>
					<option value="Documents Pending" <? if($varCmbFeedback == "Documents Pending") { echo "selected"; } ?>>Documents Pending</option>
					<option value="Documents Picked" <? if($varCmbFeedback == "Documents Picked") { echo "selected"; } ?>>Documents Picked</option>
					<option value="Login" <? if($varCmbFeedback == "Login") { echo "selected"; } ?>>Login/WIP</option>
					<option value="Pre-Login Reject" <? if($varCmbFeedback == "Pre-Login Reject") { echo "selected"; } ?>>Pre-Login Reject</option>
					<option value="Approved" <? if($varCmbFeedback == "Approved") { echo "selected"; } ?>>Approved</option>
					<option value="Disbursed" <? if($varCmbFeedback == "Disbursed") { echo "selected"; } ?>>Disbursed</option>
					<option value="Post Login Reject" <? if($varCmbFeedback == "Post Login Reject") { echo "selected"; } ?>>Post Login Reject</option>	
					<option value="Rescheduled" <? if($varCmbFeedback == "Rescheduled") { echo "selected"; } ?>>Rescheduled</option>
					<option value="Ringing" <? if($varCmbFeedback == "Ringing") { echo "selected"; } ?>>Ringing</option>
					<option value="Not Eligible" <? if($varCmbFeedback == "Not Eligible") { echo "selected"; } ?>>Not Eligible</option>
					<option value="Not Interested" <? if($varCmbFeedback == "Not Interested") { echo "selected"; } ?>>Not Interested</option>
					<option value="cust_noncoperative" <? if($varCmbFeedback == "cust_noncoperative") { echo "selected"; } ?>>Cust Not Co-operating</option>
			</select></td>
                   <td width="29%" align="center"  valign="middle" class="bidderclass">Search with Mobile No</td>
	  <td width="58%"  valign="middle" class="bidderclass"><input type="text" name="mob_num" id="mob_num" value="<?php echo $mob_num; ?>" >
</td>                </tr>
                <tr><td width="12%"><strong>Bank Wise</strong></td>
                  <td width="29%"><select name="cmbbankwise" id="cmbbankwise">
				  <option value="" <? if($cmbbankwise == "") { echo "selected"; } ?>>All</option>
				  <?php $bnkwseqry="Select bank_name,bank_consiolidated_id,bank_individual_id from smspl_mapping_bidderlms order by bank_name"; 
						$result = $obj->fun_db_query($bnkwseqry);
						while($bnkrow = $obj->fun_db_fetch_rs_object($result))
						{	$bank_name = $bnkrow->bank_name;
							$bank_consiolidated_id = $bnkrow->bank_consiolidated_id;
							?>
							<option value="<? echo $bank_consiolidated_id; ?>" <? if($cmbbankwise == $bank_consiolidated_id) { echo "selected"; } ?>><? echo $bank_name; ?></option>
						<? }
				  ?> 
			</select></td><td colspan="2">&nbsp;</td></tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td align="left"><input name="Submit" type="submit" class="bluebutton" value="Search" border="0"></td>
                </tr>
              </form>
            </table>
            <p>&nbsp;</p>
            <?	
			$search_date="";
	$varmin_date=$min_date;
	$varmax_date=$max_date;

	if(strlen(trim($RequestID))>0)
	{
		/*$strSQL="";
		$Msg="";
		$fbqry="select FeedbackID from smspl_status_details where AllRequestID=$RequestID and BidderID=".$BidderIDstatic." AND Reply_Type=1";
		$result = $obj->fun_db_query($fbqry);	
				
		$num_rows = $obj->fun_db_get_num_rows($result);
		if($num_rows > 0)
		{
			$row = $obj->fun_db_fetch_rs_array($result);
			$strSQL="Update smspl_status_details Set Feedback='".$Feedback."' ";
			$strSQL=$strSQL."Where FeedbackID=".$row["FeedbackID"];
		}
		else
		{
			$strSQL="Insert into smspl_status_details(AllRequestID, BidderID, Reply_Type , Feedback) Values (";
			$strSQL=$strSQL.$RequestID.",".$BidderIDstatic.",'1','".$Feedback."')";
		}

//echo $strSQL;
		$result = $obj->fun_db_query($strSQL);
		if ($result == 1)
		{
		}
		else
		{
			$Msg = "** There was a problem in adding your feedback. Please try again.";
		}*/
	}
	if($search=="y")
	{		
		$min_dateonly=$min_date;
		$max_dateonly=$max_date;

		$min_date=$min_date." 00:00:00";
		$max_date=$max_date." 23:59:59";

		if(strlen(trim($varCmbFeedback))==0)
		{
			$FeedbackClause=" AND (smspl_status_details.final_feedback IS NULL OR smspl_status_details.final_feedback='' OR smspl_status_details.final_feedback='No Feedback') ";
		}
		else if($varCmbFeedback=="All")
		{
			$FeedbackClause=" ";
		}
		else
		{
			$FeedbackClause=" AND smspl_status_details.final_feedback='".$varCmbFeedback."' ";
		}			
	?>       <p class="bodyarial11">
              <?=$Msg?>
            </p>
            <table width="758" border="0" cellpadding="4" cellspacing="1" class="blueborder" bgcolor="#FFFFFF">
              <? $srh_qry=""; 
		if($mob_num>0)
		{
			$mob_num_clause = " AND ".TABLE_REQ_LOAN_PERSONAL.".Mobile_Number = '".$mob_num."' ";
		}
		if($BidderIDstatic!="")
		{
			if($cmbbankwise>0)
			{
				$bnkwseindqry="Select bank_individual_id from smspl_mapping_bidderlms where (bank_consiolidated_id='".$cmbbankwise."')"; 
				$result = $obj->fun_db_query($bnkwseindqry);
				$bnkindrow = $obj->fun_db_fetch_rs_object($result);
				$bank_individual_id = $bnkindrow->bank_individual_id;
				$bankwise_clause=" and smsapp_leadallocation_log.BidderID in (".$bank_individual_id.") and (smspl_status_details.BidderID in (".$bank_individual_id.") or smspl_status_details.final_bidderid in (".$cmbbankwise."))";
			}
			$serach_qry="SELECT Name,Company_Name,City,Net_Salary AS Income, Loan_Amount AS LoanAmount, (select Bidder_Name from Bidders_List Where BidderID=smsapp_leadallocation_log.BidderID) AS sentbid,final_feedback AS BDfeedback, REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(final_remarks, '$', ''), '!', ''), '?', ''), '/', ''), '.', ''), ':', ''), '’', ''), ';', ''), '#', ''), '<BR>', '') AS BDremarks, REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(special_remarks, '$', ''), '!', ''), '?', ''), '/', ''), '.', ''), ':', ''), '’', ''), ';', ''), '#', ''), '<BR>', '') AS yourcomment,Sendnow_Date FROM smsapp_leadallocation_log,Req_Loan_Personal LEFT OUTER JOIN smspl_status_details ON smspl_status_details.AllRequestID=Req_Loan_Personal.RequestID AND smspl_status_details.caller_id in (5930,5929,5931,5959,5960) WHERE smsapp_leadallocation_log.RequestID=Req_Loan_Personal.RequestID and smsapp_leadallocation_log.ProductID=1 and (smsapp_leadallocation_log.Sendnow_Date Between '".($min_date)."' and '".($max_date)."')";
			 $serach_qry=$serach_qry.$bankwise_clause;
			 $serach_qry=$serach_qry.$FeedbackClause;

			$qry="SELECT *,smsapp_leadallocation_log.BidderID  AS sentbid,smsapp_leadallocation_log.leadlogid as ldlogid FROM smsapp_leadallocation_log,Req_Loan_Personal LEFT OUTER JOIN smspl_status_details ON smspl_status_details.AllRequestID=Req_Loan_Personal.RequestID AND smspl_status_details.caller_id in (5930,5929,5931,5959,5960) WHERE smsapp_leadallocation_log.RequestID=Req_Loan_Personal.RequestID and smsapp_leadallocation_log.ProductID=1 and (smsapp_leadallocation_log.Sendnow_Date Between '".($min_date)."' and '".($max_date)."')";
			$qry=$qry.$bankwise_clause;
			$qry=$qry.$FeedbackClause." ".$mob_num_clause;		
		}		
$srh_qry = $qry;

//echo $qry;
$resCount = $objAdmin->fun_get_num_rows($qry);
if($resCount>$limit)
{
$pagelinks = paginate($limit, $resCount);
}

$qry.= " order by finalstat_dated ASC LIMIT $start,$limit ";

$result = $obj->fun_db_query($qry);
 ?>
              <tr>
                <td colspan="11"><strong><? echo $start+1; ?> to <? echo $start+$limit; ?> Out of <? echo $resCount; ?> Records </strong></td>
              </tr>
              <tr>
                <td class="head1">Name</td>
                <td class="head1">Bank Name</td>
                <td class="head1">City</td>
                <td class="head1">Emp stat</td>
                <td class="head1">Feedback</td> 
                <td class="head1">Comments</td>
				<? if($varCmbFeedback ="Send Now") { ?>
               <td class="head1">Your Comments</td>
			   <? } ?>
              </tr>
              <?			
		if($resCount>0)
			{
				$color = 1;		
		while($row = $obj->fun_db_fetch_rs_object($result))
		{
			$Followup_Date = $row->Followup_Date;				
			$exptodayformat = explode(" ",$Followup_Date);
			$explodeTime = explode(":",$exptodayformat[1]);
			$explodeHr = $explodeTime[0] - 1; 
			$FinalMinDate = '"'.$exptodayformat[0].' '.$explodeHr.':'.$explodeTime[1].':'.$explodeTime[2].'"';
			$FinalMaxDate ='"'.$exptodayformat[0].' 23:59:59"';
			$TodayFormat = date("Y-m-d");
			$FinalDay = $exptodayformat[0];		
			$Employment_Status=$row->Employment_Status;			
			if($color%2!=0)
					{
						$colorvar = "#FFF";
					}
				else{
						$colorvar = "#EEE";
					}
	?>
           <tr bgcolor="<?php echo $colorvar;?>">			 
             <td class="bodyarial11"><a href="/smsapp_pladmin-details.php?postid=<? echo urlencode($row->RequestID); ?>&biddt=<? echo $BidderIDstatic;?>&leadlogid=<?php echo $row->ldlogid; ?>" target="_blank"><? echo $row->Name; ?></a></td>
			 <td class="bodyarial11"><?php $bidderid=$row->sentbid;
			 $bidqry="select Bidder_Name from Bidders_List Where BidderID=".$bidderid; $resultbidqry = $obj->fun_db_query($bidqry); $rowbd = $obj->fun_db_fetch_rs_object($resultbidqry); echo $rowbd->Bidder_Name;  ?></td>
             <td class="bodyarial11"><? echo $row->City; ?></td>
			<td class="bodyarial11"><? if($Employment_Status==1) { echo "Salaried";} else { echo "Self Employed";} ?></td>
         <?
	    if($row->City=="Others")
        {
            $City= $row->City_Other;
        }
        else
        {
            $City= $row->City;
        }
	   ?>              
		<td class="bodyarial11">
       <? echo getJumpMenu("smsapp_pllmsplgn_dashboard.php",$row->RequestID,"4",$row->final_feedback,$pageno,$varmin_date,$varmax_date,$varCmbFeedback, $val) ?>   </td>
          <td class="bodyarial11"><textarea rows="2" cols="10"><? echo $row->final_remarks; ?></textarea></td>
		  <td class="bodyarial11"><textarea rows="2" cols="10"><? echo $row->special_remarks; ?></textarea></td>
	               </tr>
                <?
		$color++;
		}		
		}
	?>
           </table>
            <br>
            <table  border="0" cellpadding="5" cellspacing="1" align="center">
              <tr>
                <td style="color:#FFF;" align="center" bgcolor="#FFFFFF"><?php echo $pagelinks;?></td>
              </tr>
			  <tr><td colspan="2" align="center"><table width="500" border="0" cellspacing="1" cellpadding="4">
			 <form name="frmdownload" action="/common_download.php" method="post">
			   <tr>
				 <td align="center">
				 <input type="hidden" name="qry1" value="<? echo $serach_qry; ?>">
				 <input type="hidden" name="min_date" value="<? echo $min_date; ?>">
				 <input type="hidden" name="max_date" value="<? echo $max_date; ?>">
				 <input name="Submit2" type="submit" class="bluebtn" value="Export List To Excel">
				 </td>
			   </tr>
			 </form>
			 </table></td></tr>
            </table>
            <?
 }
 ?>            </div></td>
      </tr>
	  
            </table>
        </div>
		<?
function getJumpMenu($varPHPPage, $varRequestID, $varType, $varFeedback, $varpageon, $varmindate, $varmaxdate,$cmbfeedback,$varVal)
{
	$strURL="";
	$strURL=$varPHPPage."?search=y&RequestID=".$varRequestID."&type=".$varType."&pageno=".$varpageon."&min_date=".urlencode($varmindate)."&max_date=".urlencode($varmaxdate)."&cmbfeedback=".urlencode($cmbfeedback)."&product=4";
?>
	<select name="type" id="type" onChange="MM_jumpMenu('parent',this,0)">
	<option value="<? echo $strURL.'&Feedback='?>" <? if($varFeedback == "") { echo "selected"; } ?> >No Feedback</option>
	<option value="<? echo $strURL.'&Feedback=Documents Pending'?>" <? if($varFeedback == "Documents Pending") { echo "selected"; } ?>>Documents Pending</option>
	<option value="<? echo $strURL.'&Feedback=Documents Picked'?>" <? if($varFeedback == "Documents Picked") { echo "selected"; } ?>>Documents Picked</option>
	<option value="<? echo $strURL.'&Feedback=Login'?>" <? if($varFeedback == "Login") { echo "selected"; } ?>>Login/WIP</option>
	<option value="<? echo $strURL.'&Feedback=Pre-Login Reject'?>" <? if($varFeedback == "Pre-Login Reject") { echo "selected"; } ?>>Pre-Login Reject</option>
	<option value="<? echo $strURL.'&Feedback=Approved'?>" <? if($varFeedback == "Approved") { echo "selected"; } ?>>Approved</option>
	<option value="<? echo $strURL.'&Feedback=Disbursed'?>" <? if($varFeedback == "Disbursed") { echo "selected"; } ?>>Disbursed</option>
	<option value="<? echo $strURL.'&Feedback=Post Login Reject'?>" <? if($varFeedback == "Post Login Reject") { echo "selected"; } ?>>Post Login Reject</option>
	<option value="<? echo $strURL.'&Feedback=Rescheduled'?>" <? if($varFeedback == "Rescheduled") { echo "selected"; } ?>>Rescheduled</option>
	<option value="<? echo $strURL.'&Feedback=Ringing'?>" <? if($varFeedback == "Ringing") { echo "selected"; } ?>>Ringing</option>
	<option value="<? echo $strURL.'&Feedback=Not Eligible'?>" <? if($varFeedback == "Not Eligible") { echo "selected"; } ?>>Not Eligible</option>
	<option value="<? echo $strURL.'&Feedback=Not Interested'?>" <? if($varFeedback == "Not Interested") { echo "selected"; } ?>>Not Interested</option>
	<option value="<? echo $strURL.'&Feedback=cust_noncoperative'?>" <? if($varFeedback == "cust_noncoperative") { echo "selected"; } ?>>Cust Not Co-operating</option>
	</select>
	</select>	
<?
}
?>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script> 
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-1312775-1");
pageTracker._trackPageview();
} catch(err) {}</script>
</body>
</html>
