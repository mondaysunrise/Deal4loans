<?php
require_once("includes/application-top-inner-hlcalling.php");
require_once("includes/classes/class.DB.WF.php");
//require_once("includes/application-top-inner.php");
//require '../eligiblebidderfuncPL.php';

$qryCheck = "SELECT * FROM Bidders where leadidentifier in ('hlallocatelms', 'hluncalledlms', 'hlallocatelmsCitywise') and BidderID='".$_SESSION["BidderID"]."'";
$resCountCheck = $objAdmin->fun_get_num_rows($qryCheck);
$qryCheckResult = $obj->fun_db_query($qryCheck);
if($resCountCheck>0)
{
	$rowqryCheck = $obj->fun_db_fetch_rs_object($qryCheckResult);
 	$source = $rowqryCheck->source;
	$leadidentifier = $rowqryCheck->leadidentifier;
	//echo "<br>";
	$standard_fields = $rowqryCheck->standard_fields;
}
else {
	echo "Not a Valid User";
	echo '<meta http-equiv="refresh" content="5; URL=http://www.deal4loans.com/callinglms/hllmslogin.php">';
	die(); 
}
define("NoOFLMS", 2);
$time = date("G");
if(!empty($_GET['page'])){
	$page = $_GET['page'];
}else{
	$page = 1;
}
$limit = 25;
$start = ($page - 1) * $limit;

function cleanSpace($string) {
   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
   return preg_replace('/[^A-Za-z0-9\-]/', ' ', $string); // Removes special chars.
}

function ccMasking($number, $maskingCharacter = 'X') 
{
	return substr($number, 0, 2) . str_repeat($maskingCharacter, strlen($number) - 4) . substr($number, -2);
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

$val = "Req_Loan_Home";
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
$refer_no="";
if(isset($_REQUEST['refer_no']))
{
	$refer_no=$_REQUEST['refer_no'];
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
<style type="text/css">
.tooltip {
    position: relative;
    display: inline-block;
}

.tooltip .tooltiptext {
    visibility: hidden;
    width: 160px;
    background-color: black;
    color: #fff;
    text-align: center;
    padding: 5px 0;
    border-radius: 6px;
     position: absolute;
    z-index: 1;
}
.tooltip:hover .tooltiptext {
    visibility: visible;
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
<!--DatePicker End-->
<script type="text/javascript">
    function checkCall(RequestID,agent_user)
    {	
	   $.ajax({ type: 'post',  url: '/dialerclick2callhl.php',  data: {  RequestID:RequestID,agent_user:agent_user, },
			   success: function (response) {
			   //alert(response);
			   $( '#name_status' ).html(response);
  		          if(response=="OK") { return true;	 } else { return false;	}
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
			//alert(iLoc);
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
			ajaxRequest.open("GET", "/getHLNum.php" + queryString, true);
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

</head>
<body style="margin:0px 0px 0px 0px; padding:0px 0px 0px 0px; background-color:#45B2D8;">
<!-- End Main Banner Menu Panel -->
<div style="width:100%; background: #CCC; padding:0px 0px 10px 0px;">
	<div style="background:#F00; width:40px; padding-left:7px; line-height:30px; height:30px; float:right; margin-right:50px; margin-top:7px; border-radius:20%;">
		<a href="logout.php?pg=HL" style="color:#FFF; text-align:center; text-decoration:none; font-size:12px;">Logout</a>
	</div>
		<?php if($leadidentifier=="hlallocatelmsCitywise") 
	{  }
	else
	{ ?>
		
	<div style="background:#F00; width:80px; padding-left:7px; line-height:30px; height:30px; float:right; margin-right:50px; margin-top:7px; border-radius:20%;">
<a href="lms_lap_index.php" target="_blank" style="color:#FFF; text-align:center; text-decoration:none; font-size:12px;">LAP Leads</a>
		
	</div><?php } ?>
	<div style="clear:both;"></div>
</div>
<div style="clear:both; height:15px;"></div>
	<div> 
		<table width="98%" border="0">
			<tr>
				<td align="right"></td>
			</tr>
			<tr>
				<td align="center" width="100%"><div align="center">
					<table width="600" border="0" cellpadding="4" cellspacing="1" class="blueborder" bgcolor="#FFFFFF">
						<form name="frmsearch" action="hlloanlms_index1.php" method="get" onSubmit="return chkform();">
							<input type="hidden" name="BidderIDstatic" id="BidderIDstatic" value="<? echo base64_encode($_SESSION["BidderID"]);?>">
							<input type="hidden" name="search" id="search" value="y">
						<tr>
							<td colspan="4" class="head1">Search</td>
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
					<?php if($leadidentifier=="hlallocatelmsCitywise")
					{ ?>
					<option value="Not Interested" <? if($varCmbFeedback == "Not Interested") { echo "selected"; } ?>>Not Interested</option>
					<option value="Callback Later" <? if($varCmbFeedback == "Callback Later") { echo "selected"; } ?>>Callback Later</option>
					<option value="FollowUp" <? if($varCmbFeedback == "FollowUp") { echo "selected"; } ?>>FollowUp</option>
					<option value="No Response" <? if($varCmbFeedback == "No Response") { echo "selected"; } ?>>No Response</option>
					<option value="Not Eligible" <? if($varCmbFeedback == "Not Eligible") { echo "selected"; }?>>Not Eligible</option>
					<option value="Appointment" <? if($varCmbFeedback == "Appointment") { echo "selected"; } ?>>Appointment</option>
					<option value="Docs Awaited" <? if($varCmbFeedback == "Docs Awaited") { echo "selected"; } ?>>Docs Awaited</option>
					<option value="Documents Pick" <? if($varCmbFeedback == "Documents Pick") { echo "selected"; } ?>>Docs Picked</option>
					<option value="Login" <? if($varCmbFeedback == "Login") { echo "selected"; } ?>>Login</option>
					<option value="Language Barrier" <? if($varCmbFeedback == "Language Barrier") { echo "selected"; } ?>>Language Barrier</option>
					<option value="DNC" <? if($varCmbFeedback == "DNC") { echo "selected"; } ?>>DNC</option>
					<option value="Approved" <? if($varCmbFeedback == "Approved") { echo "selected"; } ?>>Approved</option>
					<option value="Disbursed" <? if($varCmbFeedback == "Disbursed") { echo "selected"; } ?>>Disbursed</option>
					<? }
					else 
					{ ?>
					<option value="Other Product" <? if($varCmbFeedback == "Other Product") { echo "selected"; } ?>>Other Product</option>
					<option value="Not Interested" <? if($varCmbFeedback == "Not Interested") { echo "selected"; } ?>>Not Interested</option>
					<option value="Callback Later" <? if($varCmbFeedback == "Callback Later") { echo "selected"; } ?>>Callback Later</option>
					<option value="Wrong Number" <? if($varCmbFeedback == "Wrong Number") { echo "selected"; } ?>>Wrong Number</option>
					<option value="Not Contactable" <? if($varCmbFeedback == "Not Contactable") { echo "selected"; }?>>Not Contactable</option>
					<option value="Duplicate" <? if($varCmbFeedback == "Duplicate") { echo "selected"; }?>>Duplicate</option>
					<option value="Ringing" <? if($varCmbFeedback == "Ringing") { echo "selected"; }?>>Ringing</option>
					<option value="Not Eligible" <? if($varCmbFeedback == "Not Eligible") { echo "selected"; }?>>Not Eligible</option>
					<option value="Not Eligible Income" <? if($varCmbFeedback == "Not Eligible Income") { echo "selected"; }?>>Not Eligible Income</option>
					<option value="Not Eligible Property" <?if($varCmbFeedback == "Not Eligible Property") { echo "selected"; }?>>Not Eligible Property</option>
					<option value="Not Applied" <? if($varCmbFeedback == "Not Applied") { echo "selected"; } ?>>Not Applied</option>
					<option value="FollowUp" <? if($varCmbFeedback == "FollowUp") { echo "selected"; } ?>>FollowUp</option>
					<option value="Appointment" <? if($varCmbFeedback == "Appointment") { echo "selected"; } ?>>Appointment</option>
					<option value="Arranging Document" <? if($varCmbFeedback == "Arranging Document") { echo "selected"; } ?>>Arranging Document</option>
					<option value="Documents Pick" <? if($varCmbFeedback == "Documents Pick") { echo "selected"; } ?>>Documents Pick</option>
					<? } ?>
						</select>
					</td>
					<td class="bidderclass">Search with Reference No</td>
					<td  valign="middle" class="bidderclass"><input type="text" name="refer_no" id="refer_no" value="<?php echo $refer_no; ?>" ></td>
				</tr>
				<tr>
					<td width="29%" align="center"  valign="middle" class="bidderclass">Search with Mobile No</td>
					<td width="58%"  valign="middle" class="bidderclass"><input type="text" name="mob_num" id="mob_num" value="<?php echo $mob_num; ?>" ></td>
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
		$strSQL="";
		$Msg="";
		$fbqry="select FeedbackID from Req_Feedback_HL where AllRequestID=$RequestID and BidderID=".$_SESSION['BidderID']." AND Reply_Type=1";
		$result = $obj->fun_db_query($fbqry);	
				
		$num_rows = $obj->fun_db_get_num_rows($result);
		if($num_rows > 0)
		{
			$row = $obj->fun_db_fetch_rs_array($result);
			$strSQL="Update Req_Feedback_HL Set Feedback='".$Feedback."' ";
			$strSQL=$strSQL."Where FeedbackID=".$row["FeedbackID"];
		}
		else
		{
			$strSQL="Insert into Req_Feedback_HL(AllRequestID, BidderID, Reply_Type , Feedback) Values (";
			$strSQL=$strSQL.$RequestID.",".$_SESSION['BidderID'].",'1','".$Feedback."')";
		}

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
		?>
		<p class="bodyarial11">
		<?=$Msg?>
        </p>
        <p><span id="name_status" style="color:#F00; font-weight:bold;"></span> </p>
		<table width="958" border="0" cellpadding="4" cellspacing="1" class="blueborder" bgcolor="#FFFFFF">
        <? $srh_qry=""; 
		if($mob_num>0)
		{
			$mob_num_clause = " AND ".TABLE_REQ_LOAN_HOME.".Mobile_Number = '".$mob_num."' ";
		}
		if($refer_no>0)
		{
			$referno_clause = " AND ".TABLE_REQ_LOAN_HOME.".RequestID = '".$refer_no."' ";
		}
		if($BidderIDstatic!="")
		{
			$feedback_tble="hlcallinglms_allocation";
			$qry="SELECT * FROM ".$feedback_tble.",".TABLE_REQ_LOAN_HOME." LEFT OUTER JOIN Req_Feedback_HL ON Req_Feedback_HL.AllRequestID=".TABLE_REQ_LOAN_HOME.".RequestID AND Req_Feedback_HL.BidderID= '".$BidderIDstatic."' WHERE ".$feedback_tble.".AllRequestID=".TABLE_REQ_LOAN_HOME.".RequestID and ".$feedback_tble.".BidderID = '".$BidderIDstatic."' and ((".$feedback_tble.".DOE Between '".($min_date)."' and '".($max_date)."') or (Req_Feedback_HL.Followup_Date Between '".($min_date)."' and '".($max_date)."')) ";
			$qry=$qry.$FeedbackClause." ".$mob_num_clause ." ".$referno_clause." group by ".TABLE_REQ_LOAN_HOME.".Mobile_Number ";
			
			$exporttoexcelqry = "SELECT RequestID, Name, Net_Salary, Loan_Amount, City, Feedback, Followup_Date, comment_section FROM ".$feedback_tble.",".TABLE_REQ_LOAN_HOME." LEFT OUTER JOIN Req_Feedback_HL ON Req_Feedback_HL.AllRequestID=".TABLE_REQ_LOAN_HOME.".RequestID AND Req_Feedback_HL.BidderID= '".$BidderIDstatic."' WHERE ".$feedback_tble.".AllRequestID=".TABLE_REQ_LOAN_HOME.".RequestID and ".$feedback_tble.".BidderID = '".$BidderIDstatic."' and ((".$feedback_tble.".DOE Between '".($min_date)."' and '".($max_date)."') or (Req_Feedback_HL.Followup_Date Between '".($min_date)."' and '".($max_date)."')) ";
			$exporttoexcelqry=$exporttoexcelqry.$FeedbackClause." ".$mob_num_clause ." ".$referno_clause." group by ".TABLE_REQ_LOAN_HOME.".Mobile_Number ";
			$exporttoexcelqry.= " order by ".$feedback_tble.".DOE DESC";
		}
		$srh_qry = $qry;
		//echo $qry;
		$resCount = $objAdmin->fun_get_num_rows($qry);
		if($resCount>$limit)
		{
			$pagelinks = paginate($limit, $resCount);
		}
		$getParameterVal = min($start+$limit,$resCount) % $limit;
		$qry.= " order by ".$feedback_tble.".DOE DESC LIMIT $start,$limit ";
		$result = $obj->fun_db_query($qry);
		?>
			<tr>
                		<td colspan="11"><strong><? echo $start+1; ?> to <? echo $start+$limit; ?> Out of <? echo $resCount; ?> Records </strong></td>
			</tr>
			<tr>
				<td class="head1">Refrence No</td>
                		<td class="head1">Name</td>
                		<td class="head1">Mobile</td>
                		<td class="head1">Salary</td>
                		<td class="head1">City</td>
                		<td class="head1">Eligible Bidders</td>
                		<td class="head1">Feedback</td>                
                		<td class="head1">FollowUp date</td>        
				<td class="head1">Comments</td> 
				<td class="head1">Whatsapp</td> 
				<td class="head1">Call</td>        
			</tr>
            <?			
			if($resCount>0)
			{
				$color = 1;		
				
				while($row = $obj->fun_db_fetch_rs_object($result))
				{
					//print_r($obj->fun_db_fetch_rs_object($result));
					$Followup_Date = $row->Followup_Date;				
					$exptodayformat = explode(" ",$Followup_Date);
					$explodeTime = explode(":",$exptodayformat[1]);
					$explodeHr = $explodeTime[0] - 1; 
					$FinalMinDate = '"'.$exptodayformat[0].' '.$explodeHr.':'.$explodeTime[1].':'.$explodeTime[2].'"';
					$FinalMaxDate ='"'.$exptodayformat[0].' 23:59:59"';
					$TodayFormat = date("Y-m-d");
					$FinalDay = $exptodayformat[0];		
					$Employment_Status=$row->Employment_Status;
					$RequestID=$row->RequestID;
					
					if($color%2!=0)
					{
						$colorvar = "#FFF";
					}
					else
					{
						$colorvar = "#EEE";
					}
			?>
			<tr bgcolor="<?php echo $colorvar;?>">			 
				<td class="bodyarial11"><?php echo $row->RequestID; ?></td>
				<?php if($leadidentifier=="hlallocatelmsCitywise")
					{ ?> <td class="bodyarial11"><a href="/hdfchllmsallocate_editlead.php?id=<? echo urlencode($row->RequestID); ?>&Bid=<? echo $BidderIDstatic;?>" target="_blank"><? echo $row->Name; ?></a></td><td class="bodyarial11"><img src="gButt.php?text=<? //echo $row->Mobile_Number; ?>" />
						
					</td> <?}
			else
					{ ?>
				<td class="bodyarial11"><a href="/hllmsallocate_editlead.php?id=<? echo urlencode($row->RequestID); ?>&Bid=<? echo $BidderIDstatic;?>" target="_blank"><? echo $row->Name; ?></a></td>
				<td class="bodyarial11"><span id="clik4Num_<?php echo $color; ?>">XXXXXXXXXX</span></td>
				<? } ?>
				
				<td class="bodyarial11" id="clkNum<?php echo $color; ?>" onClick="getNumValue(<?php echo $color; ?>,<?php echo $row->RequestID; ?>,<?php echo $getParameterVal; ?>);" style="cursor:hand;"><? echo $row->Net_Salary; ?></td>
				<td class="bodyarial11"><? echo $row->City; ?></td>
				<td class="bodyarial11">
					<?php $BidsSql = "SELECT BidderID from Req_Feedback_Bidder_HL where AllRequestID ='".$RequestID."'";
					//$BidsQuery = ExecQuery($BidsSql);
					$BidsQuery = $obj->fun_db_query($BidsSql);
					$BiddName="";
					while($BidsRow = $obj->fun_db_fetch_rs_object($BidsQuery))
					{
						$BiddName .= $BidsRow->BidderID.",";
					} 
					$BiddName = substr(trim($BiddName), 0, strlen(trim($BiddName))-1);
					$BidsdtSql = "SELECT Bidder_Name from Bidders_List where BidderID in (".$BiddName.")";
					$BidsdtQuery = $obj->fun_db_query($BidsdtSql); 
					$BiddNamedt="";
					while($BidsdtRow = $obj->fun_db_fetch_rs_object($BidsdtQuery))
					{
						$BiddNamedt .= $BidsdtRow->Bidder_Name.",";
					} 
					echo $BiddNamedt;
					?>
				</td>       
				<td class="bodyarial11">
					<? echo getJumpMenu("hlloanlms_index1.php",$row->RequestID,"2",$row->Feedback,$page,$varmin_date,$varmax_date,$varCmbFeedback, $val, $leadidentifier) ?>
				</td>
				<td class="bodyarial11"><input type="text" name="Followup_Date" id="Followup_Date" value="<? echo $Followup_Date; ?>"></td>
				<td class="bodyarial11"><textarea rows="2" cols="10"><? echo $row->comment_section; ?></textarea></td>
				 <td align="center" bgcolor="#DFF6FF" class="style3"><? 
//			list($msgStatus,$message,$date)=getWhatsappMessageDetails($row->Mobile_Number,'deal4loan_homeloan7057_message');
			list($msgStatus,$message,$date)=getWhatsappMessageDetails(9971396361,'deal4loan_homeloan7057_message');
			if($msgStatus=='yes')
			{
				//echo $message;
				//echo "<br>";
			?>	
				<div class="tooltip"><?php echo $date; ?>  <span class="tooltiptext"><?php echo $message; ?></span></div>

			<?php
			}
         
         
         
         
		 ?></td>      
				   <td align="center" bgcolor="#DFF6FF" class="style3"><input type="button" name="chkCall" value="Call"  onClick="checkCall(<?php echo $row->RequestID; ?>,<?php echo $BidderIDstatic; ?>)" /></td>

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
		<?php 
		$BidderIDExclusiveCheckQry = "SELECT * FROM Bidders where leadidentifier in ('hluncalledlms') and BidderID='".$_SESSION["BidderID"]."'";
		$resCountBidderIDExclusiveCheck = $objAdmin->fun_get_num_rows($BidderIDExclusiveCheckQry);
		if($resCountBidderIDExclusiveCheck>0)
		{
		?>
		<table border="0" cellspacing="1" cellpadding="4">
			<form name="frmdownload" action="../excel-download-qry.php" method="post">
				<tr>
					<td align="center">
						<input type="hidden" name="qry" value="<? echo $exporttoexcelqry; ?>">
						<input name="Submit2" type="submit" class="bluebutton" value="Export List To Excel">
					</td>
				</tr>
			</form>
		</table>
		<?php
		}
		?>
    <?
	}
	?>
					</div>
				</td>
			</tr>
		</table>
	</div>
		<?

function getJumpMenu($varPHPPage, $varRequestID, $varType, $varFeedback, $varpageon, $varmindate, $varmaxdate,$cmbfeedback,$varVal, $leadidentifier)
{
//www.deal4loans.com/callinglms/hlloanlms_index1.php?search=y&RequestID=2115107&type=1&pageno=&min_date=2016-05-01&max_date=2016-06-01&cmbfeedback=All&product=Req_Loan_Personal&Feedback=Not%20Applied 
	$strURL="";
	$strURL=$varPHPPage."?search=y&RequestID=".$varRequestID."&type=".$varType."&pageno=".$varpageon."&min_date=".urlencode($varmindate)."&max_date=".urlencode($varmaxdate)."&cmbfeedback=".urlencode($cmbfeedback)."&product=".$varVal;

 if($leadidentifier=="hlallocatelmsCitywise")
	{ ?>
			<select name="type" id="type" onChange="MM_jumpMenu('parent',this,0)">
		<option value="<? echo $strURL.'&Feedback='?>" <? if($varFeedback == "") { echo "selected"; } ?>>No Feedback</option>
		<option value="<? echo $strURL.'&Feedback=Not Interested'?>" <? if($varFeedback == "Not Interested") { echo "selected"; } ?>>Not Interested</option>
		<option value="<? echo $strURL.'&Feedback=Callback Later'?>" <? if($varFeedback == "Callback Later") { echo "selected"; } ?>>Callback Later</option>
		<option value="<? echo $strURL.'&Feedback=FollowUp'?>" <? if($varFeedback == "FollowUp") { echo "selected"; } ?>>FollowUp</option>	
		<option value="<? echo $strURL.'&Feedback=No Response'?>" <? if($varFeedback == "No Response") { echo "selected"; } ?>>No Response</option>
		<option value="<? echo $strURL.'&Feedback=Not Eligible'?>" <? if($varFeedback == "Not Eligible") { echo "selected"; } ?> >Not Eligible</option>
		<option value="<? echo $strURL.'&Feedback=Appointment'?>" <? if($varFeedback == "Appointment") { echo "selected"; } ?>>Appointment</option>	
		<option value="<? echo $strURL.'&Feedback=Docs Awaited'?>" <? if($varFeedback == "Docs Awaited") { echo "selected"; } ?>>Docs Awaited</option>
		<option value="<? echo $strURL.'&Feedback=Documents Pick'?>" <? if($varFeedback == "Documents Pick") { echo "selected"; } ?>>Docs Picked</option>
		<option value="<? echo $strURL.'&Feedback=Login'?>" <? if($varFeedback == "Login") { echo "selected"; } ?>>Login</option>
		<option value="<? echo $strURL.'&Feedback=Language Barrier'?>" <? if($varFeedback == "Language Barrier") { echo "selected"; } ?>>Language Barrier</option>
		<option value="<? echo $strURL.'&Feedback=DNC'?>" <? if($varFeedback == "DNC") { echo "selected"; } ?>>DNC</option>
		<option value="<? echo $strURL.'&Feedback=Approved'?>" <? if($varFeedback == "Approved") { echo "selected"; } ?>>Approved</option>
		<option value="<? echo $strURL.'&Feedback=Disbursed'?>" <? if($varFeedback == "Disbursed") { echo "selected"; } ?>>Disbursed</option>
	</select>	
	<? }
		else
	{ ?>
	<select name="type" id="type" onChange="MM_jumpMenu('parent',this,0)">
		<option value="<? echo $strURL.'&Feedback='?>" <? if($varFeedback == "") { echo "selected"; } ?>>No Feedback</option>
		<option value="<? echo $strURL.'&Feedback=Other Product'?>" <? if($varFeedback == "Other Product") { echo "selected"; } ?>>Other Product</option>
		<option value="<? echo $strURL.'&Feedback=Not Interested'?>" <? if($varFeedback == "Not Interested") { echo "selected"; } ?>>Not Interested</option>
		<option value="<? echo $strURL.'&Feedback=Callback Later'?>" <? if($varFeedback == "Callback Later") { echo "selected"; } ?>>Callback Later</option>
		<option value="<? echo $strURL.'&Feedback=Wrong Number'?>" <? if($varFeedback == "Wrong Number") { echo "selected"; } ?>>Wrong Number</option>
		<option value="<? echo $strURL.'&Feedback=Not Contactable'?>" <? if($varFeedback == "Not Contactable") { echo "selected"; } ?>>Not Contactable</option>
		<option value="<? echo $strURL.'&Feedback=Duplicate'?>" <? if($varFeedback == "Duplicate") { echo "selected"; } ?> >Duplicate</option>
		<option value="<? echo $strURL.'&Feedback=Ringing'?>" <? if($varFeedback == "Ringing") { echo "selected"; } ?> >Ringing</option>
		<option value="<? echo $strURL.'&Feedback=Not Eligible'?>" <? if($varFeedback == "Not Eligible") { echo "selected"; } ?> >Not Eligible</option>
		<option value="<? echo $strURL.'&Feedback=Not Eligible Income'?>" <? if($varFeedback == "Not Eligible Income") { echo "selected"; } ?> >Not Eligible Income</option>
		<option value="<? echo $strURL.'&Feedback=Not Eligible Property'?>" <? if($varFeedback == "Not Eligible Property") { echo "selected"; } ?> >Not Eligible Property</option>
		<option value="<? echo $strURL.'&Feedback=Not Applied'?>" <? if($varFeedback == "Not Applied") { echo "selected"; } ?> >Not Applied</option>
		<option value="<? echo $strURL.'&Feedback=FollowUp'?>" <? if($varFeedback == "FollowUp") { echo "selected"; } ?>>FollowUp</option>		
		<option value="<? echo $strURL.'&Feedback=Appointment'?>" <? if($varFeedback == "Appointment") { echo "selected"; } ?>>Appointment</option>		
		<option value="<? echo $strURL.'&Feedback=Arranging Document'?>" <? if($varFeedback == "Arranging Document") { echo "selected"; } ?>>Arranging Document</option>		
		<option value="<? echo $strURL.'&Feedback=Documents Pick'?>" <? if($varFeedback == "Documents Pick") { echo "selected"; } ?>>Documents Pick</option>
	</select>	
	<? } ?>
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
<script>
$(document).ready(function() {
 $(".click-btn").hover(function(){
	$(".display").show();
		});
		
		$(".click-btn").mouseleave(function(){
	$(".display").hide();
		});
});
</script>

</body>
</html>
