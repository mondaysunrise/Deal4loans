<?php
require_once("includes/application-top-inner_test.php");
define("NoOFLMS", 2);
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

$FeedbackClause="";
$BidderIDstatic="";
if(isset($_REQUEST['BidderIDstatic']) && strlen($_REQUEST['BidderIDstatic'])>0 )
{
	$BidderIDstatic=base64_decode($_REQUEST['BidderIDstatic']);
}
else
{
	$BidderIDstatic=$_SESSION["BidderID"];
}
	
$salaryclause="";
if(isset($_REQUEST['salaryrange']))
{
	$salaryclause=$_REQUEST['salaryrange'];
}
   
$mob_num="";
if(isset($_REQUEST['mob_num']))
{
	$mob_num = $_REQUEST['mob_num'];
}

$leadrefnumber="";
if(isset($_REQUEST['leadrefnumber']))
{
	$leadrefnumber = $_REQUEST['leadrefnumber'];
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

$inhouseCut_Call = '';
if($BidderIDstatic==6739 || $BidderIDstatic==6740 || $BidderIDstatic==6741 || $BidderIDstatic==6742 || $BidderIDstatic==6743 || $BidderIDstatic==6744 || $BidderIDstatic==6745 || $BidderIDstatic==6746|| $BidderIDstatic==6747) {
//	$inhouseCut_Call = 1; // Displaying Numbers
	$inhouseCut_Call = 2;
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
			defaultDate: "-1d",
			<?php if($_SESSION["leadidentifier"] == 'diallercallerccpredictive'){?>
				minDate: "-3m",
			<?php } ?>
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
<?php
	if($BidderIDstatic==6386 || $BidderIDstatic==6300 || $BidderIDstatic==6406 || $BidderIDstatic==6407 || $BidderIDstatic==6408 || $BidderIDstatic==6409 || $BidderIDstatic==6583 || $BidderIDstatic==6584 || $BidderIDstatic==6586 || $BidderIDstatic==6588 || $BidderIDstatic==6587  || $BidderIDstatic==6694 || $BidderIDstatic==6695 || $BidderIDstatic==6696 || $BidderIDstatic==6697 || $BidderIDstatic==6698 || $BidderIDstatic==6699 || $BidderIDstatic==6701 || $BidderIDstatic==6700 || $BidderIDstatic==6585 || $BidderIDstatic==6476 || $BidderIDstatic==6790 || $BidderIDstatic==6791 || $BidderIDstatic==6792  || $BidderIDstatic==6808 || $BidderIDstatic==6809 || $BidderIDstatic==6810 || $BidderIDstatic==6811 ||$BidderIDstatic==6982 || $BidderIDstatic==6983 || $BidderIDstatic==6984 || $BidderIDstatic==6985 || $BidderIDstatic==6986 || $BidderIDstatic==6987 || $BidderIDstatic==7028 || $BidderIDstatic==7029 || $BidderIDstatic==7030 || $BidderIDstatic==7031 || $BidderIDstatic==7032 || $BidderIDstatic==7033 || $BidderIDstatic==7034 || $BidderIDstatic==7035 || $_SESSION['leadidentifier']=="diallercallerccpredictive")
	{
	?>	 
	<script type="text/javascript">
	function checkCall(RequestID,agent_user)
    {
		var funcVal = 'call';
	   $.ajax({ type: 'post',  url: '/external_dialer_c2c_ccsms.php',  data: {  RequestID:RequestID,agent_user:agent_user, functionC:funcVal },
			   success: function (response) {
			   //alert(response);
			   $( '#name_status' ).html(response);
  		          if(response=="OK") { return true;	 } else { return false;	}
                }
		      });
	  
	}
	
	function disconnectCall(RequestID,agent_user)
    {
		var checkCallValue;
		var funcVal = 'disconnect';
		var dispID = $( "#disConnectStatus" ).val();
	   $.ajax({ type: 'post',  url: '/external_dialer_c2c_ccsms.php',  data: {  RequestID:RequestID,agent_user:agent_user, functionC:funcVal, disPos:dispID },
			   success: function (response) {
			   //alert(response);
			   $( '#name_status' ).html(response);
  		          if(response=="OK") { return true;	 } else { return false;	}
                }
		      });
	}
	</script>
     <?php 
	} 
	else if($_SESSION['leadidentifier']=='sbicallerdigilms_cc')
{
?>	 

	<script type="text/javascript">
	function checkCall(RequestID,agent_user)
    {
		var funcVal = 'call';
		$.ajax({
			type: 'post',
			url: '/external_dialer_digitech_c2c_sbi.php',
			data: {
				RequestID:RequestID,
				agent_user:agent_user,
				functionC:funcVal
			},
			success: function (response) {
				//alert(response);
				$( '#name_status' ).html(response);
				if(response=="OK") {
					return true;
				} else {
					return false;
				}
			}
		});
	}


	function disconnectCall(RequestID,agent_user)
    {
		var checkCallValue;
		var funcVal = 'disconnect';
		var dispID = $( "#disConnectStatus" ).val();
		$.ajax({
			type: 'post',
			url: '/external_dialer_digitech_c2c.php',
			data: {
				RequestID:RequestID,
				agent_user:agent_user,
				functionC:funcVal,
				disPos:dispID
			},
			success: function (response) {
				//alert(response);
				$( '#name_status' ).html(response);
  		        if(response=="OK") {
					return true;
				} else {
					return false;
				}
			}
		});
	}
</script>
<?php }
	else {
	 ?>
	<script type="text/javascript">

    function checkCall(RequestID,agent_user)
    {
	   $.ajax({ type: 'post',  url: '/dialerclick2callccsms1.php',  data: {  RequestID:RequestID,agent_user:agent_user, },
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
			ajaxRequest.open("GET", "/getcreditcardNum.php" + queryString, true);
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
	<?php } ?> 
</head>
<body style="margin:0px 0px 0px 0px; padding:0px 0px 0px 0px; background-color:#45B2D8;">
<?php include "header_cc_lms.php"; ?>
<div> 
	<table width="98%" border="0">
		<tr>
			<td align="right">
				<a href="/commonlms_report.php?bidderid=<?php echo $BidderIDstatic;?>&product=4" target="_blank">today's Report</a>
			</td>
		</tr>
        <tr>
			<td align="right"></td>
		</tr>
        <tr>
			<td align="center" width="100%"><div align="center">
				<table width="600" border="0" cellpadding="4" cellspacing="1" class="blueborder" bgcolor="#FFFFFF">
					<form name="frmsearch" action="cclms_sms_new_index.php" method="get" onSubmit="return chkform();">
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
						<td width="12%"><strong>Date:</strong></td>
						<td width="29%">From
							<input name="min_date" type="text" id="min_date" size="15" value="<? echo $_REQUEST['min_date']; ?>" >
						</td>
						<td width="13%" style="text-align:right;">To</td>
						<td><input name="max_date" type="text" id="max_date" size="15" value="<? echo $_REQUEST['max_date']; ?>"></td>
					</tr>
					<tr>
						<td width="12%"><strong>Feedback:</strong></td>
						<td width="29%">
							<select name="cmbfeedback" id="cmbfeedback">
								<option value="All" <? if($varCmbFeedback == "All") { echo "selected"; } ?>>
								All</option>
								<option value="" <? if($varCmbFeedback == "") { echo "selected"; } ?>>
								No Feedback</option>
								<option value="Other Product" <? if($varCmbFeedback == "Other Product") { echo "selected"; } ?>>
								Other Product</option>
								<option value="Not Interested" <? if($varCmbFeedback == "Not Interested") { echo "selected"; } ?>>
								Not Interested</option>
								<option value="Callback Later" <? if($varCmbFeedback == "Callback Later") { echo "selected"; } ?>>
								Callback Later</option>
								<option value="Wrong Number" <? if($varCmbFeedback == "Wrong Number") { echo "selected"; } ?>>
								Wrong Number</option>
								<option value="Send Now" <? if($varCmbFeedback == "Send Now") { echo "selected"; } ?>>
								Send Now</option>
								<option value="Not Eligible" <?if($varCmbFeedback == "Not Eligible") { echo "selected"; }?>>
								Not Eligible</option>
								<option value="Duplicate" <?if($varCmbFeedback == "Duplicate") { echo "selected"; }?>>
								Duplicate</option>
								<option value="Not Contactable" <?if($varCmbFeedback == "Not Contactable") { echo "selected"; }?>>
								Not Contactable</option>
								<option value="Ringing" <?if($varCmbFeedback == "Ringing") { echo "selected"; }?>>
								Ringing</option>
								<option value="FollowUp" <? if($varCmbFeedback == "FollowUp") { echo "selected"; } ?>>
								FollowUp</option>
								<option value="Not Applied" <? if($varCmbFeedback == "Not Applied") { echo "selected"; } ?>>
								Not Applied</option>
								<option value="Process" <? if($varCmbFeedback == "Process") { echo "selected"; } ?>>
								Cibil ok</option>
								<option value="Closed" <? if($varCmbFeedback == "Closed" || $varCmbFeedback == "Disbursed") { echo "selected"; } ?>>
								Cibil Reject</option>
								<option value="No Response SBI" <? if($varCmbFeedback == "No Response SBI") { echo "selected"; } ?>>
								No Response SBI</option>
								<option value="Already SBI Card User" <? if($varCmbFeedback == "Already SBI Card User") { echo "selected"; } ?>>
								Already SBI Card User</option>
							</select>
						</td>
						<!--<td width="29%" align="center"  valign="middle" class="bidderclass">Search with Mobile No</td>
						<td width="58%"  valign="middle" class="bidderclass"><input type="text" name="mob_num" id="mob_num" value="<?php echo $mob_num; ?>" ></td>-->
						<td width="29%" align="center"  valign="middle" class="bidderclass">Search with LRN</td>
						<td width="58%" valign="middle" class="bidderclass">
							<input type="text" name="leadrefnumber" id="leadrefnumber" value="<?php echo $leadrefnumber; ?>" >
						</td>
					</tr>
					<tr></tr>
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
	$varmin_date=$min_date;
	$varmax_date=$max_date;

	if(strlen(trim($RequestID))>0)
	{
		$strSQL="";
		$Msg="";
		 $fbqry="select RequestID from Req_Credit_Card_Sms where RequestID=$RequestID";
		$result = $obj->fun_db_query($fbqry);	
				
		$num_rows = $obj->fun_db_get_num_rows($result);
		if($num_rows > 0)
		{
			$row = $obj->fun_db_fetch_rs_array($result);
			$strSQL="Update Req_Credit_Card_Sms Set Feedback='".$Feedback."' ";
			$strSQL=$strSQL."Where RequestID=".$RequestID;
		}
		//echo "<br>".$strSQL;
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
			$FeedbackClause=" AND (Req_Credit_Card_Sms.Feedback IS NULL OR Req_Credit_Card_Sms.Feedback='' OR Req_Credit_Card_Sms.Feedback='No Feedback') ";
		}
		else if($varCmbFeedback=="All")
		{
			$FeedbackClause=" ";
		}
		else
		{
			$FeedbackClause=" AND Req_Credit_Card_Sms.Feedback='".$varCmbFeedback."' ";
		}			
		?>
		<p class="bodyarial11">
			<?=$Msg?>
		</p>
		<p align="center"><span id="name_status" style="color:#F00; font-weight:bold;"></span></p>
		<table width="758" border="0" cellpadding="4" cellspacing="1" class="blueborder" bgcolor="#FFFFFF">
		<? $srh_qry=""; 
		if($mob_num>0)
		{
			$mob_num_clause = " AND ".TABLE_REQ_CREDIT_CARD.".Mobile_Number = '".$mob_num."' ";
		}
		if($BidderIDstatic!="")
		{
			$qry = "SELECT Req_Credit_Card_Sms.* FROM Req_Credit_Card_Sms LEFT OUTER JOIN lead_allocate ON lead_allocate.AllRequestID=Req_Credit_Card_Sms.RequestID";
			//If leadrefnumber is not empty then it will give result for leadrefnumber only
			if(!empty($leadrefnumber)){
				$qry .= " JOIN sbi_credit_card_5633 ON (Req_Credit_Card_Sms.UserID = sbi_credit_card_5633.RequestID AND LeadRefNumber = '".$leadrefnumber."') WHERE lead_allocate.BidderID= '".$BidderIDstatic."' group by lead_allocate.AllRequestID";
			}else{
				$qry .= " WHERE (( Req_Credit_Card_Sms.Updated_Date Between '".($min_date)."' and '".($max_date)."' or Req_Credit_Card_Sms.Followup_Date Between '".($min_date)."' and '".($max_date)."' or  Req_Credit_Card_Sms.Dated Between '".($min_date)."' and '".($max_date)."' or  lead_allocate.Allocation_Date Between '".($min_date)."' and '".($max_date)."') and lead_allocate.BidderID= '".$BidderIDstatic."') ";
				$qry = $qry.$FeedbackClause." ".$mob_num_clause. " group by lead_allocate.AllRequestID";
			}
		}
		$srh_qry = $qry;
		//echo $srh_qry;
		$resCount = $objAdmin->fun_get_num_rows($qry);
		if($resCount>$limit)
		{
			$pagelinks = paginate($limit, $resCount);
		}
		$getParameterVal = min($start+$limit,$resCount) % $limit;

		$qry.= " order by Updated_Date DESC LIMIT $start,$limit ";
		//echo $qry;

		$result = $obj->fun_db_query($qry);
		?>
			<tr>
				<td colspan="11"><strong><? echo $start+1; ?> to <? echo $start+$limit; ?> 
				Out of <? echo $resCount; ?> Records </strong></td>
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
				<td class="head1">DOE</td>  
				<?php if($varCmbFeedback=="Send Now" || $varCmbFeedback=="Closed" || $varCmbFeedback=="Process")
				{ ?>  
				<td class="head1">Application No</td> 
				<td class="head1">Status</td>
				<?  } ?>	
				<td class="head1">Click to Call</td>
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
			<tr  bgcolor="<?php echo $colorvar;?>">			 
				<td class="bodyarial11"><a href="/sbiccleadlms-detailsms.php?postid=<? echo urlencode($row->RequestID); ?>&biddt=<? echo $BidderIDstatic;?>" target="_blank"><? echo $row->Name; ?></a></td>
                <td class="bodyarial11">
                <?php 
                if($inhouseCut_Call==1) {
                ?>
					<span id="clik4Num_<?php echo $color; ?>">XXXXXXXXXX</span>
                <?php } else {  echo ccMasking($row->Mobile_Number); } ?>
                </td>
                <td class="bodyarial11">
				<?php 
                if($inhouseCut_Call==1) {
                ?>
					<span id="clkNum<?php echo $color; ?>" onClick="getNumValue(<?php echo $color; ?>,<?php echo $row->RequestID; ?>,<?php echo $getParameterVal; ?>);" style="cursor:hand;"><? echo $row->Net_Salary; ?></span> <?php } else {  echo $row->Net_Salary; } ?>
				</td>
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
				<? echo getJumpMenu("cclms_sms_new_index.php",$row->RequestID,"4",$row->Feedback,$pageno,$varmin_date,$varmax_date,$varCmbFeedback, $val) ?>
				</td>
				<td class="bodyarial11"><input type="text" name="Followup_Date" id="Followup_Date" value="<? echo $Followup_Date; ?>"></td>
				<td class="bodyarial11"><textarea rows="2" cols="10"><? echo $row->comment_section; ?></textarea></td>
				<td class="bodyarial11"><? echo $row->Dated; ?></td> 
			<?php 
			$RequestID= $row->RequestID;
			if($varCmbFeedback=="Send Now" || $varCmbFeedback=="Closed" || $varCmbFeedback=="Process")
			{
				$sbifbqry="select ApplicationNumber,StatusCode,ProcessingStatus,Messages,message from sbi_credit_card_5633_log where cc_requestid=".$row->UserID; 
				$sbiresult = $obj->fun_db_query($sbifbqry);
				$sbirow = $obj->fun_db_fetch_rs_object($sbiresult);
				$StatusCode= $sbirow->StatusCode;
			?>  
				<td class="bodyarial11"><? echo $sbirow->ApplicationNumber; ?></td> 
				<td class="bodyarial11"><? if($StatusCode=="FD") { echo "Final Decline";} else { echo $sbirow->Messages; echo $sbirow->message; } ?></td>
			<? 
			}?>	
				<td class="bodyarial11">
            <?php 
				if($_SESSION['BidderID'] == 67411111) {
					$checkSMSMobileandPanSql = "SELECT rcc.RequestID, rcc.Mobile_Number, rcc.Pancard, scc.first_dated as SCC_FirstDated, sccl.first_dated as SCCL_FirstDated FROM `Req_Credit_Card` as rcc LEFT JOIN `sbi_credit_card_5633` as scc ON(scc.RequestID = rcc.RequestID AND (scc.first_dated > DATE_SUB(NOW(), INTERVAL 180 DAY))) LEFT JOIN `sbi_credit_card_5633_log` as sccl ON (sccl.cc_requestid = rcc.RequestID AND (sccl.first_dated > DATE_SUB(NOW(), INTERVAL 180 DAY))) WHERE (rcc.`Mobile_Number` = '".$row->Mobile_Number."' ";
					if(!empty($row->Pancard))
					{
						$checkSMSMobileandPanSql .= " OR (rcc.`Pancard` = '".$row->Pancard."') ";
					}
					$checkSMSMobileandPanSql .= " )  AND (scc.first_dated != '0000-00-00 00:00:00' OR sccl.first_dated != '0000-00-00 00:00:00') ";
					//echo $checkSMSMobileandPanSql;
					$checkSMSMobileandPanNumRows = $objAdmin->fun_get_num_rows($checkSMSMobileandPanSql);
					if($checkSMSMobileandPanNumRows>0)
					{ }
					else
					{ } 
				} 
			?>
					<input type="button" name="chkCall" value="Call" onClick="checkCall(<?php echo $row->RequestID; ?>,<?php echo $BidderIDstatic; ?>)" />  
				</td>
			</tr>
            <?
			$color++;
			}		
		}?>
			</table>
            <br>
            <table  border="0" cellpadding="5" cellspacing="1" align="center">
				<tr>
					<td style="color:#FFF;" align="center" bgcolor="#FFFFFF"><?php echo $pagelinks;?></td>
				</tr>
            </table>
	<?
	}?>
</div>
</td>
</tr>
<? if( $search=="y" && $BidderIDstatic==0){ ?>
	<tr><td colspan="2" align="center">
		  <table width="500" border="0" cellspacing="1" cellpadding="4">
			 <form name="frmdownload" action="/bidder_download.php" method="post">
			   <tr>
				 <td align="center">
				 <input type="hidden" name="qry1" value="<? echo $srh_qry; ?>">
				 <input type="hidden" name="qry2" value="Req_Credit_Card">
				 <input type="hidden" name="min_date" value="<? echo $min_date; ?>">
				 <input type="hidden" name="max_date" value="<? echo $max_date; ?>">
				 <input name="Submit2" type="submit" class="bluebtn" value="Export List To Excel">
				 </td>
			   </tr>
			 </form>
		</table>
		</td>
	</tr>
<? } ?>
</table>
</div>
<?
function getJumpMenu($varPHPPage, $varRequestID, $varType, $varFeedback, $varpageon, $varmindate, $varmaxdate,$cmbfeedback,$varVal)
{
	$strURL="";
	$strURL=$varPHPPage."?search=y&RequestID=".$varRequestID."&type=".$varType."&pageno=".$varpageon."&min_date=".urlencode($varmindate)."&max_date=".urlencode($varmaxdate)."&cmbfeedback=".urlencode($cmbfeedback)."&product=4";
?>
	<select name="type" id="type" onChange="MM_jumpMenu('parent',this,0)">
		<option value="<? echo $strURL.'&Feedback='?>" <? if($varFeedback == "") { echo "selected"; } ?>>
		No Feedback</option>
		<option value="<? echo $strURL.'&Feedback=Other Product'?>" <? if($varFeedback == "Other Product") { echo "selected"; } ?>>
		Other Product</option>
		<option value="<? echo $strURL.'&Feedback=Not Interested'?>" <? if($varFeedback == "Not Interested") { echo "selected"; } ?>>
		Not Interested</option>
		<option value="<? echo $strURL.'&Feedback=Not Contactable'?>" <? if($varFeedback == "Not Contactable") { echo "selected"; } ?>>
		Not Contactable</option>
		<option value="<? echo $strURL.'&Feedback=Callback Later'?>" <? if($varFeedback == "Callback Later") { echo "selected"; } ?>>
		Callback Later</option>
		<option value="<? echo $strURL.'&Feedback=Wrong Number'?>" <? if($varFeedback == "Wrong Number") { echo "selected"; } ?>>
		Wrong Number</option>
		<option value="<? echo $strURL.'&Feedback=Send Now'?>" <? if($varFeedback == "Send Now") { echo "selected"; } ?> >
		Send Now</option>
		<option value="<? echo $strURL.'&Feedback=Not Eligible'?>" <? if($varFeedback == "Not Eligible") { echo "selected"; } ?> >
		Not Eligible</option>
		<option value="<? echo $strURL.'&Feedback=Ringing'?>" <? if($varFeedback == "Ringing") { echo "selected"; } ?> >
		Ringing</option>
		<option value="<? echo $strURL.'&Feedback=Duplicate'?>" <? if($varFeedback == "Duplicate") { echo "selected"; } ?> >
		Duplicate</option>
		<option value="<? echo $strURL.'&Feedback=Not Applied'?>" <? if($varFeedback == "Not Applied") { echo "selected"; } ?> >
		Not Applied</option>
		<option value="<? echo $strURL.'&Feedback=FollowUp'?>" <? if($varFeedback == "FollowUp") { echo "selected"; } ?>>
		FollowUp</option>	
		 <option value="<? echo $strURL.'&Feedback=Process'?>" <? if($varFeedback == "Process") { echo "selected"; } ?>>
		 Cibil ok </option>
		<option value="<? echo $strURL.'&Feedback=Closed'?>" <? if($varFeedback == "Closed") { echo "selected"; } ?>>
		Cibil Reject</option>
		<option value="<? echo $strURL.'&Feedback=No Response SBI'?>" <? if($varFeedback == "No Response SBI") { echo "selected"; } ?>>
		No Response SBI</option>
		<option value="<? echo $strURL.'&Feedback=Already SBI Card User'?>" <? if($varFeedback == "Already SBI Card User") { echo "selected"; } ?>>
		Already SBI Card User</option>
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
