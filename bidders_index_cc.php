<?php
error_reporting(E_ALL);
ini_set('display_error', 1);

require 'scripts/session_check_online.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';
//define("ENABLELOGIN", 1);
//for session variables
$limit = 25;
foreach ($_SESSION as $key => $val)
    $sessionVar.= $key . " " . $val . "\n";

$IP_Remote = $_SERVER["REMOTE_ADDR"];
if ($IP_Remote == '192.124.249.12' || $IP_Remote == '185.93.228.12') {
    $IP = $_SERVER['HTTP_X_SUCURI_CLIENTIP'];
} else {
    $IP = $IP_Remote;
}

$logfilecontent = "";
$logfilecontent.="********************************************************\n";
$logfilecontent.= "Datetime: " . ExactServerdate() . "\n";
$logfilecontent.="IP Address: " . $IP . "\n";
$logfilecontent.= "Session Variable: " . $sessionVar . "\n";

$todaydt = date('Y-m-d');

$BidderIDstatic = "";
if (isset($_REQUEST['BidderIDstatic']) && strlen($_REQUEST['BidderIDstatic']) > 0) {
    $BidderIDstatic = $_REQUEST['BidderIDstatic'];
} else {
    $BidderIDstatic = $_SESSION['BidderID'];
}
$pagename = $BidderIDstatic;

$refernce_no = "";
if (isset($_REQUEST['refernce_no'])) {
    $refernce_no = $_REQUEST['refernce_no'];
}

$mob_num = "";
if (isset($_REQUEST['mob_num'])) {
    $mob_num = $_REQUEST['mob_num'];
}

$date = $_SESSION['Date'];

function ccMasking($number, $maskingCharacter = 'X') 
{
	return substr($number, 0, 2) . str_repeat($maskingCharacter, strlen($number) - 4) . substr($number, -2);
}

$val = 'Req_Credit_Card';
$pro_code = 4;

$FeedbackClause = "";
$search = "";
if (isset($_GET['search'])) {
    $search = $_GET['search'];
}

$citywise = "";
if (isset($_REQUEST['citywise'])) {
    $citywise = $_REQUEST['citywise'];
}

$min_date = "";
if (isset($_REQUEST['min_date'])) {
    $min_date = $_REQUEST['min_date'];
}

$max_date = "";
if (isset($_REQUEST['max_date'])) {
    $max_date = $_REQUEST['max_date'];
}

$varCmbFeedback = "";
if (isset($_REQUEST['cmbfeedback'])) {
    $varCmbFeedback = $_REQUEST['cmbfeedback'];
}

$RequestID = "";
if (isset($_REQUEST['RequestID'])) {
    $RequestID = $_REQUEST['RequestID'];
}

$type = "";
if (isset($_REQUEST['type'])) {
    $type = $_REQUEST['type'];
}

$Feedback = "";
if (isset($_REQUEST['Feedback'])) {
    $Feedback = $_REQUEST['Feedback'];
}

//Paging
$pagesize = 25;
$startrow = 0;

//Set the page no
if (empty($_GET['pageno'])) {
    if ($startrow == 0) {
        $pageno = $startrow + 1;
    }
} else {
    $pageno = $_GET['pageno'];
    $startrow = ($pageno - 1) * $pagesize;
}

//Set the counter start
if ($pageno / $pagesize == 0) {
    $counterstart = $pageno - ($pagesize - 1);
} else {
    $counterstart = $pageno - ($pageno % $pagesize) + 1;
}
//Counter End
$counterend = $counterstart + ($pagesize - 1);

?>
<html>
<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=WINDOWS-1252">
<title>Login</title>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<link href="includes/style1.css" rel="stylesheet" type="text/css">
<link href="style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="callinglms/css-datepicker/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="callinglms/css-datepicker/datepicker.css">
<script src="callinglms/js-datepicker/jquery-1.5.1.js"></script>
<script src="callinglms/js-datepicker/jquery.ui.core.js"></script>
<script src="callinglms/js-datepicker/jquery.ui.datepicker.js"></script>
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
</script>
<?php
if (isset($_SESSION['UserType'])) {
    echo "<table width='100%' border='0' cellspacing='0' cellpadding='0'><tr><td width='323' height='93' align='left' valign='top'><img src='http://www.deal4loans.com/images/login-logo.gif' width='323' height='93' /></td><td align='left' valign='top' style='color:#0B6FCC;' ><table width='100%' border='0' cellspacing='0' cellpadding='0' bgcolor='#0A92C0'><tr><td height='67' align='right' valign='middle' bgcolor='#C8E3F3' style='padding-right:10px;'><table border='0' align='right' cellpadding='0' cellspacing='0' bgcolor='#0A92C0'><tr><td width='6' height='32' align='left' valign='top'><img  src='http://www.deal4loans.com/images/login-form-logut-lft.gif' width='6' height='32' /></td><td background='http://www.deal4loans.com/images/login-form-logut-bg.gif' style=' background-repeat:repeat-x; height:32px;'><table width='100%' border='0' align='center' cellpadding='0' cellspacing='0'><tr><td align='left' valign='middle' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#FFFFFF; font-weight:bold; padding-right:15px;' > Welcome " . ucwords($_SESSION['UserType']) . " " . $_SESSION['UName'] . "</td><td align='left' style='padding-right:2px;' width='22'><img src='http://www.deal4loans.com/images/login-logut-btn.gif' /></td><td align='right' class='style1' style='color:#FFFFFF; font-weight:bold;'><div align='right' class='style1' style='color:#FFFFFF; font-weight:bold;'> <a href='Logout.php' style='color:#FFFFFF; font-size:13px; text-decoration:none; font-family:Verdana, Arial, Helvetica, sans-serif;'>Logout</a></div></td></tr></table></td><td width='6' height='32'><img src='http://www.deal4loans.com/images/login-form-logut-rgt.gif' width='6' height='32' /></td></tr></table></td></tr><tr><td>&nbsp;</td></tr></table></td></tr></table>";
}
?>
<!-- End Main Banner Menu Panel -->
<!-- Start Main Container Panel -->
<style>
	.bidderclass
	{
		Font-family:Comic Sans MS;
		font-size:13px;
	}
	.style1 {
		font-family: verdana;
		font-size: 12px;
		font-weight: bold;
		color:#084459;
	}
	.style2 {
		font-family: verdana;
		font-size: 11px;
		font-weight: bold;
		color:#084459;
	}
	.style3 {
		font-family: verdana;
		font-size: 11px;
		font-weight: normal;
		color:#084459;
		text-decoration:none;
	}
	.bluebtn{
		font-family:Verdana, Arial, Helvetica, sans-serif; 
		font-size:12px;
		font-weight:bold;
		color:#084459;
		border:1px solid #084459;
		background-color:#FFFFFF;
	}
	.buttonfordate {
		font-family: Verdana, Arial, Helvetica, sans-serif;
		font-size: 11px;
		color: #FFFFFF;
		background-color: #45B2D8;
		border: 1px solid #45B2D8;
		font-weight: bold;
	}
</style>
</head>
<body>
	<table width="100%" border="0"  align="center" cellpadding="0" cellspacing="0" >
		<tr>
		<td align="center">
			<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#45B2D8">
				<tr>
					<td style="padding-top:5px; font-size:13px;">&nbsp;&nbsp;<a href="/change_lms_pwd.php" target="_blank" style="color:#FFFFFF;">
						<b>Change Password</b></a>
					</td>
				</tr>
				<tr><td>&nbsp;</td></tr>
				<tr>
				<td align="center">
				<table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
					<tr>
						<td height="30" align="center" valign="middle"><img src="images/login-srch-pnl.gif" width="650" height="30"></td>
					</tr>
					<tr>
						<td align="center" valign="middle" background="images/login-form-login-bg.gif">
							<table width="95%" border="0"  cellpadding="1" cellspacing="0">
								<form name="frmsearch" action="bidders_index_cc.php?search=y" method="post" onSubmit="return chkform();">
									<input type="hidden" name="BidderIDstatic" id="BidderIDstatic" value="<? echo $BidderIDstatic; ?>">
									<tr><td colspan="3">&nbsp;</td></tr>
									<tr>
										<td colspan="3" align="center">
											<table border="0" width="90%" cellpadding="0" cellspacing="0">
												<tr>
													<td width="20%" valign="middle" class="style1">&nbsp;&nbsp;Date&nbsp;&nbsp; From </td>
													<td width="24%" align="left" valign="middle" class="bidderclass">
														<input name="min_date" type="text" id="min_date" size="15" value="<? echo $min_date; ?>">
													</td>
													<td valign="middle" align="center" class="style1" width="8%">To</td>
													<td align="left" valign="middle" class="style1" width="24%">
														<input name="max_date" type="text" id="max_date" size="15" value="<? echo $max_date; ?>">
													</td>
												</tr>
											</table>
										</td>
									</tr>
									<tr>
										<td colspan="3" align="center">
										<table border="0" cellpadding="0" cellspacing="0" width="90%">
											<tr>
											<td width="25%" valign="middle" class="style1">Feedback:</td>
											<td width="70%" align="left" valign="middle" class="bidderclass">
												<select name="cmbfeedback" id="cmbfeedback" style="width:120px;">
													<option value="All" <? if ($varCmbFeedback == "All") {echo "selected";} ?>>All</option>
													<option value="" <? if ($varCmbFeedback == "") {echo "selected";} ?>>New lead</option>
													<option value="Not Interested" <? if ($varCmbFeedback == "Not Interested") {echo "selected";} ?>>Not Interested</option>
													<option value="Not Contactable" <? if ($varCmbFeedback == "Not Contactable") {echo "selected";} ?>>Not Contactable</option>
													<option value="FollowUp" <? if ($varCmbFeedback == "FollowUp") {echo "selected";} ?>>FollowUp</option>
													<option value="Not Eligible" <? if ($varCmbFeedback == "Not Eligible") {echo "selected";} ?>>Not Eligible</option>
													<option value="Appointment" <? if ($varCmbFeedback == "Appointment") {echo "selected";} ?>>Lead generated & appointment fixed</option>
													<option value="Documents Pick" <? if ($varCmbFeedback == "Documents Pick") {echo "selected";} ?>>Documents Pick</option>
													<option value="Docs collected" <? if ($varCmbFeedback == "Docs collected") {echo "selected";} ?>>Docs collected</option>
													<option value="DIP OK" <? if ($varCmbFeedback == "DIP OK") {echo "selected";} ?>>DIP OK</option>
													<option value="DIP curable" <? if ($varCmbFeedback == "DIP curable") {echo "selected";} ?>>DIP curable</option>
													<option value="DIP Reject" <? if ($varCmbFeedback == "DIP Reject") {echo "selected";} ?>>DIP Reject</option>
													<option value="Sales decline" <? if ($varCmbFeedback == "Sales decline") {echo "selected";} ?>>Sales decline</option>
													<option value="Prime approved" <? if ($varCmbFeedback == "Prime approved") {echo "selected";} ?>>Prime approved</option>
													<option value="Prime decline" <? if ($varCmbFeedback == "Prime decline") {echo "selected";} ?>>Prime decline</option>
													<option value="Prime Curable" <? if ($varCmbFeedback == "Prime Curable") {echo "selected";} ?>>Prime Curable</option>
													<option value="Ringing" <? if ($varCmbFeedback == "Ringing") {echo "selected";} ?>>Ringing</option>
													<option value="Callback Later" <? if ($varCmbFeedback == "Callback Later") {echo "selected";} ?>>Callback Later</option>
													<option value="Wrong Number" <? if ($varCmbFeedback == "Wrong Number") {echo "selected";} ?>>Wrong Number</option>
													<option value="Process" <? if ($varCmbFeedback == "Process" || $varCmbFeedback == "Login") {echo "selected";} ?>>Process</option>
													<option value="Closed" <? if ($varCmbFeedback == "Closed" || $varCmbFeedback == "Disbursed") {echo "selected";} ?>>Closed</option>
													<option value="Not Available" <? if ($varCmbFeedback == "Not Available") {echo "selected";} ?>>Not Available</option>
												</select>
											</td>
											</tr>
											</table>
										</td>
									</tr>
									<!--
									<tr>
											<td width="29%" align="center"  valign="middle" class="bidderclass">Search with Mobile No</td>
											<td width="58%"  valign="middle" class="bidderclass"><input type="text" name="mob_num" id="mob_num" value="<?php echo $mob_num; ?>" >
											</td>
											<td width="13%" colspan="3">&nbsp;</td>
									</tr>
									-->
									<tr>
										<td width="23%" align="center"  valign="middle" class="bidderclass">Search with Reference No</td>
										<td width="58%"  valign="middle" class="bidderclass"><input type="text" name="refernce_no" id="refernce_no" value="<?php echo $refernce_no; ?>" >
										</td>
									</tr>
									<tr>
										<td colspan="3" align="center" valign="middle"><input name="Submit" type="image"  src="images/login-form-lgn-srch.gif" style="width:111px; height:35px; border:none;" border="0"></td>
									</tr>
								</form>
							</table>
						</td>
					</tr>
					<tr>
						<td width="650" height="8" align="center" valign="top"><img src="images/login-bot-pnl.gif" width="650" height="8"></td>
					</tr>
					<tr>
						<td align="center" valign="middle" >&nbsp;</td>
					</tr>
				</table>
				<?
				$search_date = "";
				$varmin_date = $min_date;
				$varmax_date = $max_date;
				if (strlen(trim($RequestID)) > 0) {
					$strSQL = "";
					$Msg = "";
					$result = d4l_ExecQuery("select FeedbackID from Req_Feedback where AllRequestID=$RequestID and BidderID=" . $BidderIDstatic);
					$num_rows = d4l_mysql_num_rows($result);
					$currentdate = date('Y-m-d H:i:s');
					if ($num_rows > 0) {
						$row = d4l_mysql_fetch_array($result);
						$strSQL = "Update Req_Feedback Set Feedback='" . $Feedback . "' , last_update_dated = '".$currentdate."' ";
						$strSQL = $strSQL . " Where FeedbackID=" . $row["FeedbackID"];
					} else {
						$strSQL = "Insert into Req_Feedback(AllRequestID, BidderID, Reply_Type , Feedback, last_update_dated) Values (";
						$strSQL = $strSQL . $RequestID . "," . $BidderIDstatic . "," . $pro_code . ",'" . $Feedback . "','".$currentdate."')";
					}
					//echo $strSQL;
					$result = d4l_ExecQuery($strSQL);
					if ($result == 1) {
						
					} else {
						$Msg = "** There was a problem in adding your feedback. Please try again.";
					}
				}
				if ($search == "y") {
					$min_date = $min_date . " 00:00:00";
					$max_date = $max_date . " 23:59:59";

					$feedback_tble = "Req_Feedback_Bidder_CC";

					if (strlen(trim($varCmbFeedback)) == 0) {
						$FeedbackClause = " AND (Req_Feedback.Feedback IS NULL OR Req_Feedback.Feedback='' OR Req_Feedback.Feedback='No Feedback')";
					} else if ($varCmbFeedback == "All") {
						$FeedbackClause = "";
					} else {
						$FeedbackClause = " AND Req_Feedback.Feedback='".$varCmbFeedback."'";
					}
					
					if ($mob_num > 0) {
						$mob_num_clause = " AND ".$val.".Mobile_Number = '".$mob_num."'";
					}

					if (strlen($refernce_no) > 3) {
						$appdtxt = "CC";

						list($requestidno, $bidderid) = split('[S]', $refernce_no);
						$refernce_no_section = str_replace($appdtxt, "", $requestidno);

						$refernce_no_clause = " AND ".$feedback_tble.".Feedback_ID = '".$refernce_no_section."'";
					}
					?>
				<p class="bodyarial11"><?= $Msg ?></p>
				<table width="950" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#FFFFFF" >
				<?
				$qry = "SELECT RequestID, Name, Mobile_Number, DOB, Email, City, State, Pincode, Residence_Address, Pancard, IF(Gender=1,'Male', 'Female') as Gender, Allocation_Date, Net_Salary, Company_Name, IF(Employment_Status=1,'Salaried', 'Self Employed') as Employment_Status, Feedback, comment_section FROM ".$feedback_tble." JOIN ".$val." ON (".$feedback_tble.".AllRequestID = ".$val.".RequestID AND ".$feedback_tble.".BidderID = '".$BidderIDstatic."') LEFT JOIN Req_Feedback ON (Req_Feedback.AllRequestID = ".$val.".RequestID AND Req_Feedback.BidderID = '".$BidderIDstatic."')";

				$qry.= " WHERE ".$feedback_tble.".Reply_Type = ".$pro_code." AND ((".$feedback_tble.".Allocation_Date Between '".($min_date)."' AND '".($max_date)."') OR (Req_Feedback.Followup_Date Between '".($min_date)."' AND '".($max_date)."')) ";

				$qry = $qry . $FeedbackClause. " ".$mob_num_clause." ".$refernce_no_clause;
				$qry = $qry . " group by ".$val.".Mobile_Number";
				$qry = $qry . " order by ".$val.".Dated DESC";
				$search_qry = $qry;
				//echo $search_qry."<br><br>";
				$result = d4l_ExecQuery($qry);

				$recordcount = d4l_mysql_num_rows($result);
				?>
				<tr>
					<td colspan="11" style="border-bottom:1px solid #45B2D8;"><strong><? echo $startrow + 1; ?> to <? echo min($startrow + $pagesize, $recordcount); ?> Out of <? echo $recordcount; ?> Records </strong>
				</tr>
				<tr>
					<td width="149" align="center" bgcolor="#FFFFFF" class="style2">Name</td>
					<td width="88" align="center" bgcolor="#FFFFFF" class="style2">Mobile</td>
					<td width="88" align="center" bgcolor="#FFFFFF" class="style2">City</td>
					<td width="91" align="center" bgcolor="#FFFFFF" class="style2">Net Salary </td>
					<td width="100" align="center" bgcolor="#FFFFFF" class="style2">Company Name </td>
					<td width="130" align="center" bgcolor="#FFFFFF" class="style2">Employment Status </td>
					<td width="71" align="center" bgcolor="#FFFFFF" class="style2">Feedback</td>
					<td width="180" align="center" bgcolor="#FFFFFF" class="style2">Add Comment</td>
				</tr>
				<?
				//Set Maximum Page start
				$maxpage = $recordcount % $pagesize;
				if ($recordcount % $pagesize == 0) {
					$maxpage = $recordcount / $pagesize;
				} else {
					$maxpage = ceil($recordcount / $pagesize);
				}

				$qry = $qry . " LIMIT $startrow, $pagesize";
				$result = d4l_ExecQuery($qry);
				//echo $qry."<br>";

				$logfilecontent.="Sql Query: " . $qry . "\n";
				$logfilecontent.="********************************************************";
				$leadviewpage = "creditcardlead-details-yes.php";
				$i = 1;
				if ($recordcount > 0) {
					while ($row = d4l_mysql_fetch_assoc($result)) {
				 ?>
				<input type="hidden" name="requestid_<? echo $i; ?>" id="requestid_<? echo $i; ?>" value="<? echo $row["RequestID"]; ?>">
				<input type="hidden" name="product_<? echo $i; ?>" id="product_<? echo $i; ?>" value="<? echo $pro_code; ?>">
				<input type="hidden" name="bidderid" id="bidderid" value="<? echo $BidderIDstatic; ?>">
				<tr>
					<td align="center" bgcolor="#DFF6FF" class="style3" >
					<?php
					$sqlExclusive = "select  BidderID  from " . $feedback_tble . " where (AllRequestID = '" . $row["RequestID"] . "' and Reply_Type='" . $pro_code . "')";
					$queryExclusive = d4l_ExecQuery($sqlExclusive);
					$numRowsExclusive = d4l_mysql_num_rows($queryExclusive);
					if ($numRowsExclusive == 1) {
						echo '<b style="font:Verdana, Arial, Helvetica, sans-serif; color:#FF0000; font-size:9px;"> [Exclusive Lead] </b><br>';
					}

					if (strlen($leadviewpage) > 2) {
					?>
						<a href="/<? echo $leadviewpage; ?>?postid=<? echo $row["RequestID"]; ?>&biddt=<? echo $BidderIDstatic; ?>" target="_blank"><? echo $row["Name"]; ?></a>
					<? 
					}
					?>
					</td>
					<td align="center" bgcolor="#DFF6FF" class="style3">
						<?php echo ccMasking($row['Mobile_Number']); ?>
					</td>
					<td align="center" bgcolor="#DFF6FF" class="style3"><? echo $row["City"]; ?></td>
					<td align="center" bgcolor="#DFF6FF" class="style3"><? echo $row["Net_Salary"]; ?></td>
					<td align="center" bgcolor="#DFF6FF" class="style3"><? echo $row["Company_Name"]; ?></td>
					<td align="center" bgcolor="#DFF6FF" class="style3"><? echo $row["Employment_Status"]; ?></td>
					<td align="center" bgcolor="#DFF6FF" class="style3"><? echo getJumpMenu("bidders_index_cc.php", $row["RequestID"], "1", $row["Feedback"], $pageno, $varmin_date, $varmax_date, $varCmbFeedback, $val, $BidderIDstatic) ?>
					</td>
					<td align="center" bgcolor="#DFF6FF" class="bodyarial11" >
						<table width="100%">
							<tr>
								<td>
									<textarea  name="comment_section_<? echo $i; ?>" id="comment_section_<? echo $i; ?>" cols="15" rows="2"><? echo $row["comment_section"]; ?></textarea>
								</td>
								<td>
									<a onClick="insertData(<? echo $i; ?>);" style="cursor:pointer; color:blue;" class="style3">Save</a>
								</td>
							</tr>
						</table>
					</td>
				</tr>
					<?
						$i = $i + 1;
					}
				}
				?>
				</table>
				<br>
				<table width="758"  border="0" cellpadding="5" cellspacing="1">
				<?
				if ($recordcount > 0) {
				?>
					<tr>
						<td align="center" class="bluelink">
					<?
					$c = 1;
					for ($c = 1; $c <= $maxpage; $c++) {
						if ($pageno == $c) {
							echo $c . "&nbsp;";
						} else {
						?>
							<a onClick="javascript:sendmail('<? echo "&id=" . $i . "&pageno=" . $c; ?>')" style="cursor:hand"><? echo $c; ?></a>
						<?
						}
					}
					?>
						</td>
					</tr>
					<?
				}
				?>
				</table>
				<br>
					<?
					//download clause here 
					$datediffvar = timeDiff($varmin_date, $varmax_date);
					if ($datediffvar <= 7) {
					?>
					<table width="500" border="0" cellspacing="1" cellpadding="4">
						<form name="frmdownload" action="download-excel-using-qry.php" method="post">
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
				}
				?>
				</td>
				</tr>
			</table>
			</td>
		</tr>
	</table>
<?

function getJumpMenu($varPHPPage, $varRequestID, $varType, $varFeedback, $varpageon, $varmindate, $varmaxdate, $cmbfeedback, $varVal, $BidderIDstatic) {
	$strURL = "";
	$strURL = $varPHPPage . "?search=y&RequestID=" . $varRequestID . "&type=" . $varType . "&pageno=" . $varpageon . "&min_date=" . urlencode($varmindate) . "&max_date=" . urlencode($varmaxdate) . "&cmbfeedback=" . urlencode($cmbfeedback) . "&product=" . $varVal;
	?>
	<select name="type" id="type" onChange="MM_jumpMenu('parent', this, 0)" class="style3" style="width:110px;">
		<option value="<? echo $strURL . '&Feedback=' ?>" <? if ($varFeedback == "") { echo "selected";} ?> >New lead</option>
		<option value="<? echo $strURL . '&Feedback=Not Interested' ?>" <? if ($varFeedback == "Not Interested") {echo "selected";} ?>>Not Interested</option>
		<option value="<? echo $strURL . '&Feedback=Not Contactable' ?>" <? if ($varFeedback == "Not Contactable") {echo "selected";} ?>>Not Contactable</option>
		<option value="<? echo $strURL . '&Feedback=FollowUp' ?>" <? if ($varFeedback == "FollowUp") {echo "selected";} ?>>FollowUp</option>
		<option value="<? echo $strURL . '&Feedback=Not Eligible' ?>" <? if ($varFeedback == "Not Eligible") {echo "selected";} ?>>Not Eligible</option>
		<option value="<? echo $strURL . '&Feedback=Appointment' ?>" <? if ($varFeedback == "Appointment") {echo "selected";} ?>>Lead generated & appointment fixed</option>
		<option value="<? echo $strURL . '&Feedback=Documents Pick' ?>" <? if ($varFeedback == "Documents Pick") {echo "selected";} ?>>Documents Pick</option>
		<option value="<? echo $strURL . '&Feedback=Docs collected' ?>" <? if ($varFeedback == "Docs collected") {echo "selected";} ?>>Docs collected</option>
		<option value="<? echo $strURL . '&Feedback=DIP OK' ?>" <? if ($varFeedback == "DIP OK") {echo "selected";} ?>>DIP OK</option>
		<option value="<? echo $strURL . '&Feedback=DIP curable' ?>" <? if ($varFeedback == "DIP curable") {echo "selected";} ?>>DIP curable</option>
		<option value="<? echo $strURL . '&Feedback=DIP Reject' ?>" <? if ($varFeedback == "DIP Reject") {echo "selected";} ?>>DIP Reject</option>
		<option value="<? echo $strURL . '&Feedback=Sales decline' ?>" <? if ($varFeedback == "Sales decline") {echo "selected";} ?>>Sales decline</option>
		<option value="<? echo $strURL . '&Feedback=Prime approved' ?>" <? if ($varFeedback == "Prime approved") {echo "selected";} ?>>Prime approved</option>
		<option value="<? echo $strURL . '&Feedback=Prime decline' ?>" <? if ($varFeedback == "Prime decline") {echo "selected";} ?>>Prime decline</option>
		<option value="<? echo $strURL . '&Feedback=Prime Curable' ?>" <? if ($varFeedback == "Prime Curable") {echo "selected";} ?>>Prime Curable</option>
		<option value="<? echo $strURL . '&Feedback=Ringing' ?>" <? if ($varFeedback == "Ringing") {echo "selected";} ?>>Ringing</option>
		<option value="<? echo $strURL . '&Feedback=Callback Later' ?>" <? if ($varFeedback == "Callback Later") {echo "selected";} ?>>Callback Later</option>
		<option value="<? echo $strURL . '&Feedback=Wrong Number' ?>" <? if ($varFeedback == "Wrong Number") {echo "selected";} ?>>Wrong Number</option>
		<option value="<? echo $strURL . '&Feedback=Process' ?>" <? if ($varFeedback == "Process") {echo "selected";} ?>>Process</option>
		<option value="<? echo $strURL . '&Feedback=Closed' ?>" <? if ($varFeedback == "Closed") {echo "selected";} ?>>Closed</option>
		<option value="<? echo $strURL . '&Feedback=Not Available' ?>" <? if ($varFeedback == "Not Available") {echo "selected";} ?>>Not Available</option>
	</select>
<?
}

//logfile entry
if (ENABLELOGIN == 1) {
	$newFileName = './logfile/' . $pagename . ".txt";
	file_put_contents($newFileName, $logfilecontent, FILE_APPEND);
}

//end of logfile entry
function timeDiff($firstTime, $lastTime) {
	$firstTime = strtotime($firstTime);
	$lastTime = strtotime($lastTime);
	$timeDiff = ($lastTime - $firstTime) / 86400;
	return $timeDiff;
}
?>
<script type="text/javascript">
	
	function sendmail(form)
	{
		var gifName = form;
		document.frmsearch.action="bidders_index_cc.php?search=y"+gifName;
		document.frmsearch.submit();
	}
	
	function chkform()
	{
		var ss=document.frmsearch.min_date.value;

		if(ss.length<10 || ss.length>10)
		{
			alert("Please fill correct date in YYYY-MM-DD format");
			document.frmsearch.min_date.value="";
			document.frmsearch.min_date.focus();
			return false;
		}

		if(document.frmsearch.max_date.value=="")
		{
			alert("Sorry!!!! Please Enter Maximum date.");
			document.frmsearch.max_date.value="";
			document.frmsearch.max_date.focus();
			return false;
		}
	}

	function MM_jumpMenu(targ,selObj,restore){
		//alert( selObj.selectedIndex);
		eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
		if (restore) selObj.selectedIndex=0;
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

	function insertData(id)
	{
		var txt = document.getElementById('comment_section_'+ id).value;
		var re = /^[ A-Za-z0-9(,./#)+-]*$/
		if (re.test(txt)) {
			var get_comment_section = document.getElementById('comment_section_'+ id).value;
			var get_requestid= document.getElementById('requestid_'+ id).value;
			var get_product= document.getElementById('product_'+ id).value;
			var get_bidderid= document.getElementById('bidderid').value;

			var queryString = "?comment_section=" + get_comment_section + "&get_requestid=" + get_requestid + "&get_product=" + get_product + "&get_bidderid=" + get_bidderid;
			//alert(queryString); 
			ajaxRequest.open("GET", "insert_comment_lms.php" + queryString, true);
			// Create a function that will receive data sent from the server
			ajaxRequest.onreadystatechange = function(){
				if(ajaxRequest.readyState == 4)
				{
					if(ajaxRequest.responseText=="insert")
					{
						alert('comment has been saved');
					}
					else
					{
						alert('cant save the comment');
					}
				}
			}
			ajaxRequest.send(null);
		}else{
			alert('please remove Special characters.');
			document.getElementById('comment_section_'+ id).focus();
			return false;
		}
	}
	window.onload = ajaxFunction;
</script>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
	var pageTracker = _gat._getTracker("UA-1312775-1");
	pageTracker._trackPageview();
} catch (err) {
}</script>
</body>
</html>
