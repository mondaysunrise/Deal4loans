<?php
require_once("includes/application-top-inner_test.php");

function ccMasking($number, $maskingCharacter = 'X') 
{
	return substr($number, 0, 2) . str_repeat($maskingCharacter, strlen($number) - 4) . substr($number, -2);
}


if(!empty($_GET['page'])){
$page = $_GET['page'];
}else{
$page = 1;
}
$limit = 25;
$start = ($page - 1) * $limit;

if(($_SESSION["BidderID"]!==base64_decode($_REQUEST['BidderIDstatic'])) && ISSET($_REQUEST['BidderIDstatic']))
{
	session_unset();
	session_destroy();
	echo "Not a Valid User";
	echo '<meta http-equiv="refresh" content="5; URL=http://www.deal4loans.com/callinglms/lmslogin.php">';
	die(); 
}


$BidderIDstatic="";
if(isset($_REQUEST['BidderIDstatic']) && strlen($_REQUEST['BidderIDstatic'])>0 )
{
	 $BidderIDstatic=base64_decode($_REQUEST['BidderIDstatic']);
}
else
{
	$BidderIDstatic=$_SESSION["BidderID"];
}


$FeedbackClause="";
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


$current_date="";
if(isset($_REQUEST['current_date']))
{
	$current_date=$_REQUEST['current_date'];
}


$application_no="";
if(isset($_REQUEST['application_no']))
{
	$application_no=$_REQUEST['application_no'];
}

$varCmbFeedback="";
if(isset($_REQUEST['cmbfeedback']))
{
	$varCmbFeedback=$_REQUEST['cmbfeedback'];
}

$RequestID="";
if(isset($_REQUEST['RequestID']))
{
	$RequestID=$_REQUEST['RequestID'];
}

$Feedback="";
if(isset($_REQUEST['Feedback']))
{
	$Feedback=$_REQUEST['Feedback'];
}
$inhouseCut_Call = $_SESSION['CallStatus'];
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
		var dates = $( "#min_date, #max_date, #current_date" ).datepicker({
			defaultDate: "-1d",
			changeMonth: true,
			changeYear: true,
			numberOfMonths: 1,
			onSelect: function( selectedDate ) {
				var option = this.id == "min_date" ? "minDate" : "maxDate",
				instance = $( this ).data( "datepicker" ),
				date = $.datepicker.parseDate(
							instance.settings.dateFormat ||
							$.datepicker._defaults.dateFormat,
							selectedDate, instance.settings
						);
				dates.not( this ).datepicker( "option", option, date );
			}
		});
	});

	function MM_jumpMenu(targ,selObj,restore){ //v3.0
		eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
		if (restore) selObj.selectedIndex=0;
	}

	function checkCall(RequestID,agent_user)
    {
		$.ajax({ 
			type: 'post',
			url: '/dialerclick2callsbipreferred.php',
			data: {
			   RequestID:RequestID,
			   agent_user:agent_user,
			},
			success: function (response) {
				//alert(response);
				$( '#name_status' ).html(response);
				if(response=="OK"){
					return true;
				}
				else{
					return false;
				}
			}
		});
	}


	var ajaxRequest;  // The variable that makes Ajax possible!
	function ajaxFunction(){
		try{
			// Opera 8.0+, Firefox, Safari
			ajaxRequest = new XMLHttpRequest();
		} catch (e){
			// Internet Explorer Browsers
			try{
				ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
			} catch (e) {
				try{
					ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
				} catch (e){
					// Something went wrong
					alert("Your browser broke!");
					return false;
				}
			}
		}
	}

			
	function getNumValue(iLoc,id, parameterVal)
	{
		var allLoc = [];
		if(parameterVal>0 )
		{
			for(var iTrav=1; iTrav <= parameterVal; iTrav++) { allLoc.push(iTrav); }
		}
		else
		{
			for(var iTrav=1; iTrav <= <?php echo $limit; ?>; iTrav++) { allLoc.push(iTrav); }
		}
		var iRemove = allLoc.indexOf(iLoc);
		if(iRemove != -1) { allLoc.splice(iRemove, 1); }
		
		var queryString = "?get_requestid=" + id;
		ajaxRequest.open("GET", "/getcreditcardNumMain.php" + queryString, true);
		ajaxRequest.onreadystatechange = function(){
			if(ajaxRequest.readyState == 4)
			{
				document.getElementById('clik4Num_'+ iLoc).innerHTML = "<b style='font-size:12px;'>"+ajaxRequest.responseText+"</b>";
					for(var iTraverse = allLoc.length; iTraverse--;)
					{ document.getElementById('clik4Num_'+ allLoc[iTraverse]).innerHTML = 'XXXXXXXXXX';	}
			}
		}
			ajaxRequest.send(null); 
	}
	window.onload = ajaxFunction;
</script>
<!--DatePicker End-->
</head>
<body style="margin:0px 0px 0px 0px; padding:0px 0px 0px 0px; background-color:#45B2D8;">
<?php include "header_cc_lms.php"; ?>
<div style="clear:both;"></div>
<div style="clear:both; height:15px;"></div>
<div> 
	<table width="98%" border="0">
		<tr>
			<td align="right">
				<a href="/callinglms/cclms_index_verifier.php?BidderIDstatic=<?php echo base64_encode($_SESSION["BidderID"]);?>" target="_blank">Main Leads</a>
			</td>			
		</tr>
		<tr>
			<td align="right"></td>
		</tr>
		<tr>
			<td align="center" width="100%"><div align="center">
				<table width="600" border="0" cellpadding="4" cellspacing="1" class="blueborder" bgcolor="#FFFFFF">
				<form name="frmsearch" action="cclms_index_twl_verifier.php" method="get" onSubmit="return chkform();">
					<input type="hidden" name="BidderIDstatic" id="BidderIDstatic" value="<? echo base64_encode($_SESSION["BidderID"]);?>">
					<input type="hidden" name="search" id="search" value="y">
					<tr>
						<td colspan="4" class="head1">Search</td>
					</tr>
					<tr>
						<td colspan="3">&nbsp;</td>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td width="40%" align="left"  valign="middle" class="bidderclass"><strong>Date:</strong></td>
						<td width="60%">
							<input name="current_date" type="text" id="current_date" size="15" value="<? echo $_REQUEST['current_date']; ?>" >
						</td>
						<!--<td width="60%">
							<input name="min_date" type="text" id="min_date" size="15" value="<? echo $_REQUEST['min_date']; ?>" >
						</td>
						<td width="13%" style="text-align:right;">To</td>
						<td><input name="max_date" type="text" id="max_date" size="15" value="<? echo $_REQUEST['max_date']; ?>"></td>-->
					</tr>
					<tr>
						<td width="40%" align="left"  valign="middle" class="bidderclass"><strong>Feedback:</strong></td>
						<td width="60%">
							<select name="cmbfeedback" id="cmbfeedback">
								<option value="All" <? if($varCmbFeedback == "All") { echo "selected"; } ?>>All</option>
								<option value="" <? if($varCmbFeedback == "") { echo "selected"; } ?>>No Feedback</option>
								<option value="Send For Appointment" <? if($varCmbFeedback == "Send For Appointment") { echo "selected"; } ?>>Send For Appointment</option>
								<option value="FollowUp" <? if($varCmbFeedback == "FollowUp") { echo "selected"; } ?>>FollowUp</option>
								<option value="Ringing" <? if($varCmbFeedback == "Ringing") { echo "selected"; }?>>Ringing</option>
								<option value="Not Contactable" <? if($varCmbFeedback == "Not Contactable") { echo "selected"; }?>>Not Contactable</option>
								<option value="Not Interested" <? if($varCmbFeedback == "Not Interested") { echo "selected"; }?>>Not Interested</option>
								<option value="Not Eligible" <? if($varCmbFeedback == "Not Eligible") { echo "selected"; }?>>Not Eligible</option>
								<option value="Never Applied" <? if($varCmbFeedback == "Never Applied") { echo "selected"; }?>>Never Applied</option>
								<option value="Wrong Number" <? if($varCmbFeedback == "Wrong Number") { echo "selected"; }?>>Wrong Number</option>
								<option value="OCL Customer" <? if($varCmbFeedback == "OCL Customer") { echo "selected"; }?>>OCL Customer</option>
							</select>
						</td>
					</tr>
					<!--<tr>
						<td width="40%" align="left"  valign="middle" class="bidderclass">Search with Mobile No</td>
						<td width="60%"  valign="middle" class="bidderclass">
							<input type="text" name="mob_num" id="mob_num" value="<?php echo $mob_num; ?>" >
						</td>
					</tr>
					<tr>
						<td width="40%" align="left"  valign="middle" class="bidderclass">Search with Application No</td>
						<td width="60%"  valign="middle" class="bidderclass">
							<input type="text" name="application_no" id="application_no" value="<?php echo $application_no; ?>" >
						</td>
					</tr>-->
					<tr>
						<td colspan="2" align="center"><input name="Submit" type="submit" class="bluebutton" value="Search" border="0"></td>
					</tr>
				</form>
				</table>
				<p>&nbsp;</p>
				<?
				$varmin_date=$min_date;
				$varmax_date=$max_date;
				$varcurrent_date=$current_date;

				if(strlen(trim($RequestID))>0)
				{
					$strSQL="";
					$Msg="";
					$fbqry="select FeedbackID from Req_Feedback_CC where AllRequestID=$RequestID and BidderID=".$BidderIDstatic." AND Reply_Type=10";
					$result = $obj->fun_db_query($fbqry);	

					$num_rows = $obj->fun_db_get_num_rows($result);
					if($num_rows > 0)
					{
						$row = $obj->fun_db_fetch_rs_array($result);
						$strSQL="Update Req_Feedback_CC Set Feedback='".$Feedback."' ";
						$strSQL=$strSQL."Where FeedbackID=".$row["FeedbackID"];
					}
					else
					{
						$strSQL="Insert into Req_Feedback_CC(AllRequestID, BidderID, Reply_Type , Feedback) Values (";
						$strSQL=$strSQL.$RequestID.",".$BidderIDstatic.",'10','".$Feedback."')";
					}
					//echo $strSQL;
					$result = $obj->fun_db_query($strSQL);
					if ($result == 1)
					{
					}
					else
					{
						$Msg = "** There was a problem in adding your feedback. Please try again.";
					}
				}
				if($search=="y")
				{
					$min_dateonly=$min_date;
					$max_dateonly=$max_date;

					$min_date=$min_date." 00:00:00";
					$max_date=$max_date." 23:59:59";

					if(strlen(trim($varCmbFeedback))==0)
					{
						$FeedbackClause=" AND (rfc.Feedback IS NULL OR rfc.Feedback='' OR rfc.Feedback='No Feedback')";
					}
					else if($varCmbFeedback=="All")
					{
						$FeedbackClause="";
					}
					else
					{
						$FeedbackClause=" AND rfc.Feedback='".$varCmbFeedback."'";
					}
				?>
				<p class="bodyarial11"><?=$Msg?><?php //echo "<pre>"; print_r($_SESSION); ?></p>
				<p align="center"><span id="name_status" style="color:#F00; font-weight:bold;"></span></p>
				<table width="758" border="0" cellpadding="4" cellspacing="1" class="blueborder" bgcolor="#FFFFFF">
				<? 
				if($mob_num>0)
				{
					$mob_num_clause = " AND Req_Credit_Card.Mobile_Number = '".$mob_num."'";
				}
				
				$search_qry = "SELECT scc.LeadRefNumber, scc.ApplicationNumber, scc.ProcessingStatus, CONCAT(substring_index(substring_index(request_xml, '<FirstName>', -1), '</FirstName>', 1), ' ', substring_index(substring_index(request_xml, '<MiddleName>', -1), '</MiddleName>', 1), ' ', substring_index(substring_index(request_xml, '<LastName>', -1), '</LastName>', 1)) As CustomerName, scc.sbi_cc_holder As 'SBI CardHolder', REPLACE(substring_index(substring_index(request_xml, '<CompanyName>', -1), '</CompanyName>', 1), ',' , ' ') As CompanyName, rfc.comment_section As Remarks, SUBSTR(appointment_datetime, 1,10) As AppointmentDate, SUBSTR(appointment_datetime, 12,8) As AppointmentTime, IF(scc.appointment_address=1,REPLACE(CONCAT(scc.ResidenceAddress1,' ',scc.ResidenceAddress2,' ',ResidenceAddress3),',',' '), REPLACE(CONCAT(scc.OfficeAddress1,' ',scc.OfficeAddress2,' ',OfficeAddress3),',',' ')) As AppointmentAddress, 'Yes' As VerificationStatus, substring_index(substring_index(request_xml, '<AccountNumber>', -1), '</AccountNumber>', 1) As AccountNumber FROM lead_allocate as la JOIN sbi_ccoffers_directonsite as scd ON (la.AllRequestID = scd.sbiccoffersid) LEFT JOIN Req_Feedback_CC as rfc ON (rfc.AllRequestID=scd.sbiccoffersid AND rfc.BidderID = '".$BidderIDstatic."') LEFT JOIN sbi_credit_card_5633 as scc ON(scc.RequestID = la.AllRequestID AND scc.productflag = 10 AND scc.ApplicationNumber != '') WHERE la.BidderID = '".$BidderIDstatic."' AND la.Reply_Type=10 AND (DATE(la.Allocation_Date) = '".$current_date."' OR rfc.Followup_Date = '".$current_date."') AND (scc.first_dated > DATE_SUB(NOW(), INTERVAL 180 DAY)) AND (scc.appointment_datetime != '0000-00-00 00:00:00')";
				$search_qry=$search_qry.$FeedbackClause;
				
				$qry="SELECT *, ApplicationNumber FROM lead_allocate as la JOIN sbi_ccoffers_directonsite as scd ON (la.AllRequestID = scd.sbiccoffersid) LEFT JOIN Req_Feedback_CC as rfc ON (rfc.AllRequestID=scd.sbiccoffersid AND rfc.BidderID = '".$BidderIDstatic."') LEFT JOIN sbi_credit_card_5633 as scc ON(scc.RequestID = la.AllRequestID AND scc.productflag = 10 AND scc.ApplicationNumber != '') WHERE la.BidderID = '".$BidderIDstatic."' AND la.Reply_Type=10 AND (DATE(la.Allocation_Date) = '".$current_date."' OR rfc.Followup_Date = '".$current_date."') AND (scc.first_dated > DATE_SUB(NOW(), INTERVAL 180 DAY))";
				$qry=$qry.$FeedbackClause;
				//echo $qry;
				$resCount = $objAdmin->fun_get_num_rows($qry);
				if($resCount>$limit)
				{
					$pagelinks = paginate($limit, $resCount);
				}
				$getParameterVal = min($start+$limit,$resCount) % $limit;
				$qry.= " ORDER BY Allocation_Date DESC LIMIT $start,$limit ";
				//echo $qry;
				$result = $obj->fun_db_query($qry);
				?>
				<tr>
					<td colspan="11"><strong><? echo $start+1; ?> to <? echo $start+$limit; ?> Out of <? echo $resCount; ?> Records </strong></td>
				</tr>
				<tr>
					<td class="head1">Name</td>
					<td class="head1">Mobile</td>
					<td class="head1">Salary</td>
					<td class="head1">City</td>
					<td class="head1">Emp stat</td>
					<td class="head1">Feedback</td>                
					<td class="head1">FollowUp date</td>               
					<td class="head1">Comments</td>
					<td class="head1">ApplicationNumber</td>
					<td class="head1">DOE</td> 
					<td class="head1">Call</td>
				</tr>
				<?
				if($resCount>0)
				{
					$color = 1;		
					while($row = $obj->fun_db_fetch_rs_object($result))
					{
						//print_r($row);
						$Followup_Date = $row->Followup_Date;
						$Feedback = $row->Feedback;
						$comment_section = $row->comment_section;
						$Employment_Status=$row->sbicc_occupation;
						$Name=$row->sbicc_name;
						$RequestID= $row->sbiccoffersid;
						$Net_Salary = $row->sbicc_net_salary;
						$Mobile = $row->sbicc_mobile;
						$City= $row->sbicc_city;
						$ApplicationNumber = $row->ApplicationNumber;
						$Updated_Date = $row->sbicc_dated;
						
						if($color%2!=0)
						{
							$colorvar = "#FFF";
						}
						else{
							$colorvar = "#EEE";
						}
						?>
				<tr bgcolor="<?php echo $colorvar;?>">
					<td class="bodyarial11">
						<a href="/sbicctwlleadlms-detail-verifier.php?postid=<? echo urlencode($RequestID); ?>&biddt=<? echo $BidderIDstatic;?>" target="_blank"><? if(strlen($Name)>0) {echo $Name; } else { echo "Customer"; } ?></a>
					</td>
					<td class="bodyarial11">
					<?php 
						if($inhouseCut_Call==1 && ($BidderIDstatic!=5633)) {
					?>
						<span id="clik4Num_<?php echo $color; ?>">XXXXXXXXXX</span>
					<?php
						} else {  echo ccMasking($Mobile); } ?>
					</td>
					<td class="bodyarial11">
					<?php 
						if($inhouseCut_Call==1 && ($BidderIDstatic!=5633)) {
					?>
						<span id="clkNum<?php echo $color; ?>" onClick="getNumValue(<?php echo $color; ?>,<?php echo $RequestID; ?>,<?php echo $getParameterVal; ?>);" style="cursor:hand;"><? echo $Net_Salary; ?></span> <?php } else {  echo $Net_Salary; } ?>
					</td>
					<td class="bodyarial11"><? echo $City; ?></td>
					<td class="bodyarial11"><? if($Employment_Status==1) { echo "Salaried";} else { echo "Self Employed";} ?></td>
					<td class="bodyarial11">
						<?
						echo getJumpMenu("cclms_index_twl_verifier.php",$RequestID,"10",$Feedback,$pageno,$varcurrent_date,$varCmbFeedback);
						?>
					</td>
					<td class="bodyarial11"><input type="text" name="Followup_Date" id="Followup_Date" value="<? echo $Followup_Date; ?>"></td>
					<td class="bodyarial11"><textarea rows="2" cols="10"><? echo $comment_section; ?></textarea></td>
					<td class="bodyarial11"><? echo $ApplicationNumber; ?></td>
					<td class="bodyarial11"><? echo $Updated_Date; ?></td>
					<td class="bodyarial11">
						<input type="button" name="chkCall" value="Call" onClick="checkCall(<?php echo $RequestID; ?>,<?php echo $BidderIDstatic; ?>)" />
					</td>
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
				</table>
				
				<table width="500" border="0" cellspacing="1" cellpadding="4">
					<form name="frmdownload" action="../download-excel-using-qry.php" method="post">
						<tr>
							<td align="center">
								<input type="hidden" name="qry" value="<? echo $search_qry; ?>">
								<input type="hidden" name="BidderIDstatic" value="<? echo $BidderIDstatic; ?>">
								<input name="Submit2" type="submit" class="bluebtn" value="Export List To Excel">
							</td>
						</tr>
					</form>
				</table>
			<?
			}
			?>            
			</div>
			</td>
		</tr>
	</table>
</div>
<?
function getJumpMenu($varPHPPage, $varRequestID, $varType, $varFeedback, $varpageon, $varcurrentdate, $varmaxdate,$cmbfeedback)
{
	$strURL="";
	$strURL=$varPHPPage."?search=y&RequestID=".$varRequestID."&type=".$varType."&pageno=".$varpageon."&current_date=".urlencode($varcurrentdate)."&cmbfeedback=".urlencode($cmbfeedback)." ";
?>
	<select name="type" id="type" onChange="MM_jumpMenu('parent',this,0)">
		<option value="<? echo $strURL.'&Feedback='?>" <? if($varFeedback == "") { echo "selected"; } ?>>No Feedback</option>
		<option value="<? echo $strURL.'&Feedback=Send For Appointment'?>" <? if($varFeedback == "Send For Appointment") { echo "selected"; } ?> >Send For Appointment</option>
		<option value="<? echo $strURL.'&Feedback=FollowUp'?>" <? if($varFeedback == "FollowUp") { echo "selected"; } ?>>FollowUp</option>
		<option value="<? echo $strURL.'&Feedback=Ringing'?>" <? if($varFeedback == "Ringing") { echo "selected"; } ?>>Ringing</option>
		<option value="<? echo $strURL.'&Feedback=Not Contactable'?>" <? if($varFeedback == "Not Contactable") { echo "selected"; } ?>>Not Contactable</option>
		<option value="<? echo $strURL.'&Feedback=Not Interested'?>" <? if($varFeedback == "Not Interested") { echo "selected"; } ?>>Not Interested</option>
		<option value="<? echo $strURL.'&Feedback=Not Eligible'?>" <? if($varFeedback == "Not Eligible") { echo "selected"; } ?>>Not Eligible</option>
		<option value="<? echo $strURL.'&Feedback=Never Applied'?>" <? if($varFeedback == "Never Applied") { echo "selected"; } ?>>Never Applied</option>
		<option value="<? echo $strURL.'&Feedback=Wrong Number'?>" <? if($varFeedback == "Wrong Number") { echo "selected"; } ?>>Wrong Number</option>
		<option value="<? echo $strURL.'&Feedback=OCL Customer'?>" <? if($varFeedback == "OCL Customer") { echo "selected"; } ?>>OCL Customer</option>
	</select>	
<?
}

function timeDiff($firstTime,$lastTime)
{
	$firstTime=strtotime($firstTime);
	$lastTime=strtotime($lastTime);
	$timeDiff = ($lastTime-$firstTime)/86400;
	return $timeDiff;
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
