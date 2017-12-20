<?php include "includes/header.php";

$BidderID = $_SESSION['BidderID'];

if(!empty($_GET['page'])){
$page = $_GET['page'];
}else{
$page = 1;
}
$limit = 10;
$start = ($page - 1) * $limit;

if(isset($_REQUEST['del'])=="yes")	
{
	$sql = "DELETE FROM ".TABLE_BRANCH. " WHERE id='".$_REQUEST['id']."'";
	$resultDel = $obj->fun_db_query($sql);
	if($resultDel)
	{
		$msg = BANK_DEL_MSG;
	}
}
$qryCheck = "SELECT * FROM Bidders where (leadidentifier in ('hlallocatelmsCitywise'))";
$qryCheckResult = $obj->fun_db_query($qryCheck);
while($hlrow = $obj->fun_db_fetch_rs_object($qryCheckResult))
{
 	$hlbidderid[] = $hlrow->BidderID;
	$BidderNamear[] = $hlrow->Bidder_Name;
}
$hlbidderidstr=implode(",",$hlbidderid);
$search="";
if(isset($_REQUEST['search']))
{
	$search=$_REQUEST['search'];
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

$allocatebidder="";
if(isset($_REQUEST['allocatebidder']))
{
	$allocatebidder=$_REQUEST['allocatebidder'];
}
?>
<link rel="stylesheet" type="text/css" href="css-datepicker/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="css-datepicker/datepicker.css">
<script src="js-datepicker/jquery-1.5.1.js"></script>
<script src="js-datepicker/jquery.ui.core.js"></script>
<script src="js-datepicker/jquery.ui.datepicker.js"></script>
<script> 

	$(document).ready(function() {
		$('#globalCheckbox').click(function() {
			$('.checkBox').each(function() {
				$(this).attr('checked',!$(this).attr('checked'));
			});
		});
	});
	
	$(function() {
		var dates = $( "#min_date, #max_date" ).datepicker({
			defaultDate: "today",
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
<div id="payment_container-dash_page">
  <?php include "includes/hlcallinglmsleft.php";?>
  <div class="content_right">
    <h1>Welcome to <?php echo SITE_NAME; ?> Today's Report</h1>
    <div>
	<table width="600" border="0" cellpadding="4" cellspacing="1" class="blueborder" bgcolor="#FFFFFF">
	  <form name="frmsearch" action="hlcallinglmsdashboard.php" method="post" onSubmit="return chkform();">
		<input type="hidden" name="BidderIDstatic" id="BidderIDstatic" value="<?php echo $BidderID; ?>">
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
		  <td width="29%">
			<select name="cmbfeedback" id="cmbfeedback">
				<option value="All" <? if($varCmbFeedback == "All") { echo "selected"; } ?>>All</option>
				<option value="" <? if($varCmbFeedback == "") { echo "selected"; } ?>>No Feedback</option>
				<option value="Other Product" <? if($varCmbFeedback == "Other Product") { echo "selected"; } ?>>Other Product</option>
				<option value="Not Interested" <? if($varCmbFeedback == "Not Interested") { echo "selected"; } ?>>Not Interested</option>
				<option value="Callback Later" <? if($varCmbFeedback == "Callback Later") { echo "selected"; } ?>>Callback Later</option>
				<option value="Wrong Number" <? if($varCmbFeedback == "Wrong Number") { echo "selected"; } ?>>Wrong Number</option>
				<option value="Not Eligible" <? if($varCmbFeedback == "Not Eligible") { echo "selected"; }?>>Not Eligible</option>
				<option value="Ringing" <? if($varCmbFeedback == "Ringing") { echo "selected"; }?>>Ringing</option>
				<option value="Not Contactable" <? if($varCmbFeedback == "Not Contactable") { echo "selected"; }?>>Not Contactable</option>
				<option value="Duplicate" <? if($varCmbFeedback == "Duplicate") { echo "selected"; }?>>Duplicate</option>
				<option value="Not Applied" <? if($varCmbFeedback == "Not Applied") { echo "selected"; } ?>>Not Applied</option>
				<option value="FollowUp" <? if($varCmbFeedback == "FollowUp") { echo "selected"; } ?>>FollowUp</option>
				<option value="Appointment" <? if($varCmbFeedback == "Appointment") { echo "selected"; } ?>>Appointment</option>
				<option value="Arranging Document" <? if($varCmbFeedback == "Arranging Document") { echo "selected"; } ?>>Arranging Document</option>
				<option value="Documents Pick" <? if($varCmbFeedback == "Documents Pick") { echo "selected"; } ?>>Documents Pick</option>
			</select>
		  </td>
		  <td>Agent ID</td>
		  <td>
				<select name="allocatebidder"><option value="<?php echo $hlbidderidstr;?>">All</option>
				<?php 
				for($i=0;$i<count($BidderNamear);$i++) 
				{
				?>
					<option value="<?php echo $hlbidderid[$i]; ?>" <?php if($allocatebidder==$hlbidderid[$i]) {echo "Selected";} ?>><?php echo $BidderNamear[$i]; ?></option>
				<? 
				} 
				?>
				</select>
			</td>
		</tr>
		<tr>
			<td width="29%" align="center"  valign="middle" class="bidderclass"></td>
			<td width="58%"  valign="middle" class="bidderclass"></td>
			<td>&nbsp;</td>
			<td align="left"><input name="Submit" type="submit" class="bluebutton" value="Search" border="0"></td>
		</tr>
	  </form>
	</table>
<?php
if($search=="y")
{
	$min_dateonly=$min_date;
	$max_dateonly=$max_date;

	$min_date=$min_date." 00:00:00";
	$max_date=$max_date." 23:59:59";

	if(strlen(trim($varCmbFeedback))==0)
	{
		$FeedbackClause=" AND (Req_Feedback_HL.Feedback IS NULL OR Req_Feedback_HL.Feedback='' OR Req_Feedback_HL.Feedback='No Feedback') ";
	}
	else if($varCmbFeedback=="All")
	{
		$FeedbackClause=" ";
	}
	else
	{
		$FeedbackClause=" AND Req_Feedback_HL.Feedback='".$varCmbFeedback."' ";
	}

	//$min_date=date('Y-m-d')." 00:00:00";
	//$max_date=date('Y-m-d')." 23:59:59";

	$qry="SELECT count(hlallocateid) as contfeedback,Feedback,hlcallinglms_allocation.BidderID FROM hlcallinglms_allocation,Req_Loan_Home LEFT OUTER JOIN Req_Feedback_HL ON Req_Feedback_HL.AllRequestID=Req_Loan_Home.RequestID AND Req_Feedback_HL.BidderID in (".$allocatebidder.") WHERE hlcallinglms_allocation.AllRequestID=Req_Loan_Home.RequestID and hlcallinglms_allocation.BidderID in (".$allocatebidder.") and ((hlcallinglms_allocation.DOE Between '".$min_date."' and '".$max_date."') or (Req_Feedback_HL.Followup_Date Between '".$min_date."' and '".$max_date."')) ";
	$qry=$qry.$FeedbackClause." group by Feedback, BidderID";
	//echo $qry;
	$result = $obj->fun_db_query($qry);
	echo "<table border=1><tr><td>Count</td><td>Feedback</td><td>AgentID</td></tr>";
	while($BidsRow = $obj->fun_db_fetch_rs_object($result))
	{
		$bididcaller=$BidsRow->BidderID;
		$sqllifecyclebid="Select Bidder_Name From Bidders Where (BidderID='".$bididcaller."' and leadidentifier='hlallocatelmsCitywise')";
		$callerresult = $obj->fun_db_query($sqllifecyclebid);
		$callrRow = $obj->fun_db_fetch_rs_object($callerresult);
		echo "<tr><td>".$BidsRow->contfeedback."</td><td>".$BidsRow->Feedback."</td><td>".$callrRow->Bidder_Name."</td></tr>";
	}
	echo "</table>";
}
?>
    </div>
  </div>
</div>
