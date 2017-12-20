<?php
require 'scripts/session_check_online.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';
//define("ENABLELOGIN", 1);

//for session variables
foreach ($_SESSION as $key=>$val)
 $sessionVar.= $key." ".$val."\n";

$IP_Remote = $_SERVER["REMOTE_ADDR"];
if($IP_Remote=='192.124.249.12' || $IP_Remote=='185.93.228.12') { $IP= $_SERVER['HTTP_X_SUCURI_CLIENTIP']; }
else { $IP= $IP_Remote;	}

$logfilecontent="";
$logfilecontent.="********************************************************\n";
$logfilecontent.= "Datetime: ".ExactServerdate()."\n";
$logfilecontent.="IP Address: ".$IP."\n";
$logfilecontent.= "Session Variable: ".$sessionVar."\n";

$todaydt=date('Y-m-d');
$val="Req_Loan_Home";
$BidderIDstatic="";
if(isset($_REQUEST['BidderIDstatic']) && strlen($_REQUEST['BidderIDstatic'])>0 )
{
	 $BidderIDstatic=$_REQUEST['BidderIDstatic'];
}
else
{
	$BidderIDstatic=$_SESSION['BidderID'];
}
$pagename = $BidderIDstatic;

$FeedbackClause="";

$refernce_no="";
if(isset($_REQUEST['refernce_no']))
{
	$refernce_no = $_REQUEST['refernce_no'];
}

$citywise="";
if(isset($_REQUEST['citywise']))
{
	$citywise = $_REQUEST['citywise'];
}

$caller=1;
if(isset($_REQUEST['caller']))
{
	$caller = $_REQUEST['caller'];
}

$varFilter="";
if(isset($_REQUEST['filter']))
{
	$varFilter=$_REQUEST['filter'];
}

$bidsession="";
if(isset($_REQUEST['bidsession']))
{
	$bidsession = $_REQUEST['bidsession'];
}

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

$varcallerfeedback="";
if(isset($_REQUEST['callerfeedback']))
{
	$varcallerfeedback=$_REQUEST['callerfeedback'];
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


//Paging
$pagesize=25;
$startrow=0;

if(empty($_GET['pageno']))
{
	if($startrow == 0)
	{
		$pageno = $startrow + 1;
	}
}
else
{
	$pageno = $_GET['pageno'];
	$startrow = ($pageno - 1) * $pagesize;
}

//Set the counter start
if($pageno/$pagesize == 0)
{
	$counterstart = $pageno - ($pagesize - 1);
}
else
{
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
<script language="javascript" type="text/javascript" src="scripts/datetime.js"></script>
<link href="style.css" rel="stylesheet" type="text/css" />
<style type="text/css">
body{ background:#45B2D8;}
.lead-d4l-logo{ float:left; margin-left:2%; margin-top:25px;}
.wrapper-leads{width:63%; margin:2px auto; padding:10px 10px 10px 20px; background:#FFF; border-radius:10px;}
.input-lead{ border-radius:5px; width:150px; border:thin solid #CCC; height:22px;}
hr{ border-top:thin solid #CCC;}
.welcometext{ font-size:24px; color:#FFF; font-family:Arial, Helvetica, sans-serif;}
.heading-lead{ font-size:16px; text-align:left; color:#084459; font-family:Arial, Helvetica, sans-serif;}
.div-lead-left{ float:left; width:336px;}
.div-lead-left-small{ float:left; width:250px;}
.div-lead-left-smallest{ float:left; width:300px;}

.div-lead-left-button{ float:left; width:100px; margin-top:-5px;}
.div-lead-left-big{float:left; width:387px;}
</style>
<script type="text/JavaScript">
function killCopy(e){ return false; }
function reEnable(){return true; }
document.onselectstart=new Function ("return false");
if (window.sidebar){ document.onmousedown=killCopydocument.onclick=reEnable }
function clickIE4(){if (event.button==2){ return false; } }
function clickNS4(e){ if (document.layers||document.getElementById&&!document.all){ if (e.which==2||e.which==3){ return false;} } }
if (document.layers){ document.captureEvents(Event.MOUSEDOWN); document.onmousedown=clickNS4; } else if (document.all&&!document.getElementById){ document.onmousedown=clickIE4; }
document.oncontextmenu=new Function("return false")
</script>
<?php 
	 if(isset($_SESSION['UserType']))
	{
echo "<table width='100%' border='0' cellspacing='0' cellpadding='0'><tr><td width='323' height='93' align='left' valign='top'><img src='http://www.deal4loans.com/images/login-logo.gif' width='323' height='93' /></td><td align='left' valign='top' style='color:#0B6FCC;' ><table width='100%' border='0' cellspacing='0' cellpadding='0' bgcolor='#0A92C0'><tr><td height='67' align='right' valign='middle' bgcolor='#C8E3F3' style='padding-right:10px;'><table border='0' align='right' cellpadding='0' cellspacing='0' bgcolor='#0A92C0'><tr><td width='6' height='32' align='left' valign='top'><img  src='http://www.deal4loans.com/images/login-form-logut-lft.gif' width='6' height='32' /></td><td background='http://www.deal4loans.com/images/login-form-logut-bg.gif' style=' background-repeat:repeat-x; height:32px;'><table width='100%' border='0' align='center' cellpadding='0' cellspacing='0'><tr><td align='left' valign='middle' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#FFFFFF; font-weight:bold; padding-right:15px;' > Welcome ".ucwords($_SESSION['UserType'])." ".$_SESSION['UName']."</td><td align='left' style='padding-right:2px;' width='22'><img src='http://www.deal4loans.com/images/login-logut-btn.gif' /></td><td align='right' class='style1' style='color:#FFFFFF; font-weight:bold;'><div align='right' class='style1' style='color:#FFFFFF; font-weight:bold;'> <a href='Logout.php' style='color:#FFFFFF; font-size:13px; text-decoration:none; font-family:Verdana, Arial, Helvetica, sans-serif;'>Logout</a></div></td></tr></table></td><td width='6' height='32'><img src='http://www.deal4loans.com/images/login-form-logut-rgt.gif' width='6' height='32' /></td></tr></table></td></tr><tr><td>&nbsp;</td></tr></table></td></tr></table>";
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
p{ margin-top:2px; margin-bottom:2px;}
</style>
<!--DatePicker Start-->
<link rel="stylesheet" type="text/css" href="/callinglms/css-datepicker/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="/callinglms/css-datepicker/datepicker.css">
<script src="/callinglms/js-datepicker/jquery-1.5.1.js"></script>
<script src="/callinglms/js-datepicker/jquery.ui.core.js"></script>
<script src="/callinglms/js-datepicker/jquery.ui.datepicker.js"></script>
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
<script type="text/JavaScript">		
//ebable disable button
function disableIt(obj)
{
	obj.disabled = !(obj.disabled);
	var z = (obj.disabled) ? 'disabled' : 'enabled';
	//alert(obj.type + ' now ' + z);
}
// enable disable finish here		

function sendmail(form)
{
	var gifName = form;
	document.frmsearch.action="sbihl_callingview_callerint.php?search=y"+gifName;
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
	
	if(document.frmsearch.min_date.value<"<?php echo $joindate;?>")
	{
		alert("Sorry!!!! Your minimum date is <?php echo $joindate;?>.Please Select.");
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

function MM_jumpMenu(targ,selObj,restore){ //v3.0
//alert( selObj.selectedIndex);
 eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
 if (restore) selObj.selectedIndex=0;
}

<!--
function popitup(url) {
	newwindow=window.open(url,'name','height=280,width=200');
	if (window.focus) {newwindow.focus()}
	return false;
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
var get_comment_section = document.getElementById('comment_section_'+ id).value;
var get_requestid= document.getElementById('requestid_'+ id).value;
var get_bidderid= document.getElementById('bidderid').value;
var get_followup= document.getElementById('followup_date_'+ id).value;
var queryString = "?comment_section=" + get_comment_section + "&get_requestid=" + get_requestid + "&get_bidderid=" + get_bidderid + "&get_followup=" + get_followup;
//alert(queryString); 
	ajaxRequest.open("GET", "sbiadd_comment_lms.php" + queryString, true);
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
}

window.onload = ajaxFunction;
</script>
</head>
<body>
<table width="100%" border="0"  align="center" cellpadding="0" cellspacing="0" >
	<tr>
    <td align="center">
		<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#45B2D8">
		<tr>
			<td style="padding-top:5px; font-size:13px;">&nbsp;&nbsp; <a  href="/change_lms_pwd.php" target="_blank" style="color:#FFFFFF;"><b>Change Password</b></a></td>
		</tr>
		<tr>
			<td style="padding-top:10px;">
				<table  width="669" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#45B2D8" >
				<? if (((!isset($val) && $viewtexttype==1) || ($val=="Req_Loan_Personal")) || ((!isset($val) && $viewtexttype==2) || ($val=="Req_Loan_Home"))){
				?>
					<tr>
						<td width="669"  align="left" valign="top" bgcolor="#FFFFFF" style="background-repeat:no-repeat;" >
							<table width="97%" border="0" align="center" cellpadding="0" cellspacing="0">
								<tr>
									<td height="20" align="center"  ><h1 style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; color:#052733; line-height:18px; font-weight:bold;">Welcome to Deal4Loans LMS</h1></td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<? } ?>
	    <tr>
		<td>
		<form name="frmsearch" action="sbihl_callingview_callerint.php?search=y" method="post" onSubmit="return chkform();">
		<div class="wrapper-leads">   
			<input type="hidden" name="BidderIDstatic" id="BidderIDstatic" value="<? echo $BidderIDstatic;?>">
			<p class="heading-lead"><strong>Select date range</strong></p>
			<div class="div-lead-left">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td width="47%" class="style1">From</td>
						<td width="53%">
							<input name="min_date" class="input-lead" type="text" id="min_date" size="15" value="<? echo $_REQUEST['min_date']; ?>"  >
						</td>
					</tr>
				</table>
			</div>
			<div class="div-lead-left">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td width="19%" class="style1">To</td>
						<td width="81%">
							<input name="max_date" class="input-lead" type="text" id="max_date" size="15" value="<? echo $_REQUEST['max_date']; ?>">
						</td>
					</tr>
				</table>
			</div>
			<div style="clear:both;"></div>
			<hr>
			<p class="heading-lead"><strong>Add Filter</strong></p>
			<div class="div-lead-left">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td width="40%" class="style1">Caller Feedback</td>
						<td width="60%">
							<select name="callerfeedback" id="callerfeedback" class="input-lead">
								<option value="All" <? if($varcallerfeedback == "All") { echo "selected"; } ?>>All</option>
								<option value="" <? if($varcallerfeedback == "") { echo "selected"; } ?>>No Feedback</option>
								<option value="Not Eligible" <? if($varcallerfeedback == "Not Eligible") { echo "selected"; } ?>>Not Eligible</option>
								<option value="Not Eligible Income" <?if($varcallerfeedback == "Not Eligible Income") { echo "selected"; }?>>Not Eligible Income</option>
								<option value="Not Eligible Property" <?if($varcallerfeedback == "Not Eligible Property") { echo "selected"; }?>>Not Eligible Property</option>
								<option value="Property Not Identified" <?if($varcallerfeedback == "Property Not Identified") { echo "selected"; }?>>Property Not Identified</option>
								<option value="Not Interested" <? if($varcallerfeedback == "Not Interested") { echo "selected"; } ?>>Not Interested</option>
								<option value="Not Contactable" <? if($varcallerfeedback == "Not Contactable") { echo "selected"; } ?>>Not Contactable</option>
								<option value="Callback Later" <? if($varcallerfeedback == "Callback Later") { echo "selected"; } ?>>Callback Later</option>
								<option value="Ringing" <? if($varcallerfeedback == "Ringing") { echo "selected"; } ?>>Ringing</option>
								<option value="FollowUp" <? if($varcallerfeedback == "FollowUp") { echo "selected"; } ?>>FollowUp</option>
								<option value="Wrong Number" <? if($varcallerfeedback == "Wrong Number") { echo "selected"; } ?>>Wrong Number</option>	
								<option value="Appointment" <? if($varcallerfeedback == "Appointment") { echo "selected"; } ?>>Appointment</option>
								<option value="Arranging Documents" <? if($varcallerfeedback == "Arranging Documents") { echo "selected"; } ?>>Arranging Documents</option>
								<option value="Document Picked" <? if($varcallerfeedback == "Document Picked") { echo "selected"; } ?>>Document Picked</option>
								<option value="Login" <? if($varcallerfeedback == "Login") { echo "selected"; } ?>>Login</option>
								<option value="Sanctioned" <? if($varcallerfeedback == "Sanctioned") { echo "selected"; } ?>>Sanctioned</option>
								<option value="Disbursed" <? if($varcallerfeedback == "Disbursed") { echo "selected"; } ?>>Disbursed</option>
								<option value="Duplicate" <? if($varcallerfeedback == "Duplicate") { echo "selected"; } ?>>Duplicate</option>
							</select>
						</td>
					</tr>
				</table>
			</div>
			<div class="div-lead-left-smallest">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td width="40%" class="style1">City wise</td>
						<td width="60%">
							<select name="citywise" class="input-lead" id="citywise"><option value="">All</option>
							<?
							$arrBidderID="";
							$getglobalidSql = d4l_ExecQuery("select BidderID,City from Bidders where (Global_Access_ID ='6319')");
							while($getglobal = d4l_mysql_fetch_array($getglobalidSql))
							{
								$arrBidderID[]=$getglobal["BidderID"];
							?>
							<option value="<?php echo $getglobal["BidderID"]; ?>" <? if($getglobal["BidderID"]==$citywise) {echo "Selected";} ?>><?php echo $getglobal["City"]; ?></option>
							<? 
							} 
							?>
							</select>
						</td>
					</tr>
				</table>
			</div>
			<div class="div-lead-left">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td width="40%" class="style1">Caller</td>
						<td width="60%">
							<select name="caller" class="input-lead" id="citywise">
								<option value="1"<? if($caller == 1) { echo "selected"; }?>>Please Select</option>
								<option value="caller1" <? if($caller == "caller1") { echo "selected"; }?>>Caller 1</option>
								<option value="caller2" <? if($caller == "caller2") { echo "selected"; }?>>Caller 2</option>
								<option value="" <? if($caller == "") { echo "selected"; }?>>No Caller</option>
							</select>
						</td>
					</tr>
				</table>
			</div>
			<div class="div-lead-left-smallest">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td width="40%" class="style1">Filter</td>
						<td width="60%">
							<select name="filter" id="filter" class="input-lead">
								<option value="All" <? if($varFilter == "All") { echo "selected"; } ?>>All</option>
								<option value="Followup Date" <? if($varFilter == "Followup Date") { echo "selected"; } ?>>Followup Date</option>
								<option value="Assigned Date" <? if($varFilter == "Assigned Date") { echo "selected"; } ?>>Assigned Date</option>
								<option value="Feedback Last Updated" <? if($varFilter == "Feedback Last Updated") { echo "selected"; } ?>>Feedback Last Updated</option>
							</select>
						</td>
					</tr>
				</table>
			</div>
			<div style="clear:both;"></div>
			<hr>
			<p class="heading-lead"><strong>Search</strong></p>
			<div class="div-lead-left">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td width="47%" class="style1">Search with Mobile No</td>
						<td width="53%">
							<input type="text" class="input-lead" name="mob_num" id="mob_num" value="<?php echo $mob_num; ?>" maxlength="10">
						</td>
					</tr>
				</table>
			</div>
			<div class="div-lead-left-big">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td width="48%" class="style1">Search with Refrence No</td>
						<td width="52%">
							<input type="text" name="refernce_no" id="refernce_no" value="" class="input-lead" >
						</td>
					</tr>
				</table>
			</div>
			<div class="div-lead-left-button">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td class="style1">
							<input name="Submit" type="image"  src="images/login-form-lgn-srch.gif" style="width:111px; height:35px; border:none;" border="0">
						</td>
					</tr>
				</table>
			</div>
			<div style="clear:both;"></div>
		</div>
		</form>
		</td>
		</tr>
		</table>
<?
$search_date="";
$varmin_date=$min_date;
$varmax_date=$max_date;
if(strlen(trim($RequestID))>0)
{
	//echo "select leadid from client_lead_allocate where AllRequestID=$RequestID and BidderID=".$bidsession;
	$strSQL="";
	$Msg="";
	$result = d4l_ExecQuery("select leadid from client_lead_allocate where AllRequestID=$RequestID and BidderID=".$bidsession);		
	$num_rows = d4l_mysql_num_rows($result);
	if($num_rows > 0)
	{
		$row = d4l_mysql_fetch_array($result);
		$strSQL="Update client_lead_allocate Set Feedback='".$Feedback."' ";
		$strSQL=$strSQL." Where leadid=".$row["leadid"];
	}
	
	//echo $strSQL;
	$result = d4l_ExecQuery($strSQL);
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
	$min_date=$min_date." 00:00:00";
	$max_date=$max_date." 23:59:59";

	if(strlen(trim($varcallerfeedback))==0)
	{
		$callerFeedbackClause=" AND (client_lead_allocate.Feedback IS NULL OR client_lead_allocate.Feedback='' OR client_lead_allocate.Feedback='No Feedback')";
	}
	else if($varcallerfeedback=="All")
	{
		$callerFeedbackClause="";
	}
	else
	{
		$callerFeedbackClause=" AND client_lead_allocate.Feedback='".$varcallerfeedback."'";
	}
	
	if($caller=="")
	{
		$callerClause=" AND (client_lead_allocate.caller_name IS NULL OR client_lead_allocate.caller_name = '')";
	}
	elseif($caller=="caller1" || $caller == "caller2")
	{
		$callerClause=" AND (client_lead_allocate.caller_name='".$caller."')";
	}
	
	//all filters
	/*if(strlen($citywise)>0 )
	{
		//$citywise_clause=" AND client_lead_allocate.AsmID in (".$citywise.")";
		if($citywise=="MUMBAI")
		{
			$citywise_clause=" AND Req_Loan_Home.City in ('Mumbai','Thane','Navi Mumbai')";
		}
		elseif($citywise=="DELHI"){
			$citywise_clause=" AND Req_Loan_Home.City in ('Delhi','Gaziabad','Faridabad','Gurgaon','Noida')";				
		}
		else{
		$citywise_clause=" AND Req_Loan_Home.City in ('".$citywise."')";
		}
		$asmwise="";
	}*/
	if($asmwise>0)
	{
		$citywise_clause=" AND client_lead_allocate.AsmID in (".$asmwise.")";
		$citywise="";
	}

	if($mob_num>0)
	{
		$mob_num_clause = " AND `".$val."`.Mobile_Number = '".$mob_num."'";
	}

	$feedback_tble="client_lead_allocate";
	
	if(!empty($varFilter))
	{
		if($varFilter == 'Assigned Date'){
			$filterclause .= " AND ((".$feedback_tble.".Allocation_Date Between '".($min_date)."' and '".($max_date)."'))";
		}
		elseif($varFilter == 'Followup Date'){
			$filterclause .= " AND ((".$feedback_tble.".Followup_Date Between '".($min_date)."' and '".($max_date)."'))";
		}
		elseif($varFilter == 'Feedback Last Updated'){
			$filterclause .= " AND ((telecaller_feedback_bookkeeping.Dated Between '".($min_date)."' and '".($max_date)."'))";
		}
		else{
			$filterclause .= " AND ((".$feedback_tble.".Allocation_Date Between '".($min_date)."' and '".($max_date)."') OR (".$feedback_tble.".Followup_Date Between '".($min_date)."' and '".($max_date)."'))";
		}
	}

	if(strlen($refernce_no)>3)
	{
		$appdtxt="HL";
		list($requestidno, $bidderid) = split('[S]', $refernce_no);
		$refernce_no_section = str_replace($appdtxt, "",$requestidno);

		$refernce_no_clause = " AND `".$feedback_tble."`.Feedback_ID = '".$refernce_no_section."'";
	}
?>
<p class="bodyarial11"><?=$Msg?></p>
<table width="950" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#FFFFFF" >
<? 
	$strBidderID= implode("','",$arrBidderID);
	if ($pro_code==2)
	{
		$getfieldsdwnld="Employment_Status,Property_Identified,Allocation_Date,Name,DOB,Email,City,City_Other,Pincode,Mobile_Number,Net_Salary,Add_Comment,Loan_Amount,Feedback,Budget,Property_Loc,Loan_Time,comment_section,Feedback_ID,Property_Value,axis_executive_name,Followup_Date";
	}
	//get bidderid 
	if(strlen($citywise)>0)
	{	
		//get biddeid
		$qry="SELECT client_lead_allocate.*, Req_Loan_Home.* , telecaller_feedback_bookkeeping.Dated FROM client_lead_allocate JOIN Req_Loan_Home ON(client_lead_allocate.AllRequestID=Req_Loan_Home.RequestID) LEFT JOIN telecaller_feedback_bookkeeping ON (telecaller_feedback_bookkeeping.AllRequestID=Req_Loan_Home.RequestID AND (telecaller_feedback_bookkeeping.Dated = (SELECT Dated FROM telecaller_feedback_bookkeeping WHERE AllRequestID = Req_Loan_Home.RequestID ORDER BY Dated DESC LIMIT 1))) WHERE (client_lead_allocate.BidderID in ('".$citywise."') AND client_lead_allocate.Reply_Type=2)";
		$qry=$qry.$callerFeedbackClause." ".$callerClause." ".$citywise_clause." ".$mob_num_clause." ".$refernce_no_clause." ".$filterclause;
		$qry=$qry." group by ".$val.".Mobile_Number";
		$qry=$qry." order by ".$val.".Dated DESC";
	}
	else
	{
		//get biddeid
		$qry="SELECT client_lead_allocate.*, Req_Loan_Home.* , telecaller_feedback_bookkeeping.Dated FROM client_lead_allocate JOIN Req_Loan_Home ON(client_lead_allocate.AllRequestID=Req_Loan_Home.RequestID) LEFT JOIN telecaller_feedback_bookkeeping ON (telecaller_feedback_bookkeeping.AllRequestID=Req_Loan_Home.RequestID AND (telecaller_feedback_bookkeeping.Dated = (SELECT Dated FROM telecaller_feedback_bookkeeping WHERE AllRequestID = Req_Loan_Home.RequestID ORDER BY Dated DESC LIMIT 1))) WHERE (client_lead_allocate.BidderID in ('".$strBidderID."') AND client_lead_allocate.Reply_Type=2)";
		$qry=$qry.$callerFeedbackClause." ".$callerClause." ".$citywise_clause." ".$mob_num_clause." ".$refernce_no_clause." ".$filterclause;
		$qry=$qry." group by ".$val.".Mobile_Number";
		$qry=$qry." order by ".$val.".Dated DESC";
	}
	$srch_qry=$qry;
	//echo $qry."<br>";
	$result=d4l_ExecQuery($qry);
	$recordcount = d4l_mysql_num_rows($result);
?>
	<tr>
		<td colspan="11" style="border-bottom:1px solid #45B2D8;"><strong><? echo $startrow+1; ?> to <? echo min($startrow+$pagesize,$recordcount); ?> Out of <? echo $recordcount; ?> Records </strong>
	</tr>	
	<tr>
		<td width="149" align="center" bgcolor="#FFFFFF" class="style2">Reference No</td>
		<td width="149" align="center" bgcolor="#FFFFFF" class="style2">Name</td>
		<td width="88" align="center" bgcolor="#FFFFFF" class="style2">City</td>     
		<td width="91" align="center" bgcolor="#FFFFFF" class="style2">Net Salary </td>
		<td width="90" align="center" bgcolor="#FFFFFF" class="style2">Loan Amount </td>	
		<td width="180" align="center" bgcolor="#FFFFFF" class="style2">Caller feedback</td>
		<td width="180" align="center" bgcolor="#FFFFFF" class="style2">Asm feedback</td>
	</tr>
<?
	//Set Maximum Page start
	$maxpage = $recordcount % $pagesize;
	if($recordcount % $pagesize == 0)
	{
		$maxpage = $recordcount / $pagesize;
	}
	else
	{
		$maxpage = ceil($recordcount / $pagesize);
	}
	$qry=$qry." LIMIT $startrow, $pagesize"; 
	$result=d4l_ExecQuery($qry);
	//echo $qry."<br>";
	$logfilecontent.="Sql Query: ".$qry."\n";
	$logfilecontent.="********************************************************";
	
	$i=1;
	if($recordcount>0)
	{
		while($row=d4l_mysql_fetch_array($result))
		{
	?>
		<input type="hidden" name="requestid_<? echo $i;?>" id="requestid_<? echo $i;?>" value="<? echo $row["RequestID"];?>">
		<input type="hidden" name="bidderid" id="bidderid" value="<? echo $BidderIDstatic;?>">
		<tr>
			<td align="center" bgcolor="#DFF6FF" class="style3"><? echo "HL".$row["Feedback_ID"]."S".$BidderIDstatic; ?></td>
			<td align="center" bgcolor="#DFF6FF" class="style3">
				<?php
				$sqlExclusive = "select  BidderID  from Req_Feedback_Bidder_HL where (AllRequestID = '".$row["RequestID"]."' and Reply_Type=2)";
				$queryExclusive = d4l_ExecQuery($sqlExclusive);
				$numRowsExclusive = d4l_mysql_num_rows($queryExclusive);
				if($numRowsExclusive==1)
				{
					echo '<b style="font:Verdana, Arial, Helvetica, sans-serif; color:#FF0000; font-size:9px;"> [Exclusive Lead] </b><br>';
				} ?>
				<a href="/sbihomeloanlead-details.php?postid=<? echo $row["RequestID"]; ?>&biddt=<? echo $row["BidderID"]; ?>" target="_blank">
				<? echo $row["Name"]; ?></a>
			</td>     
			<td align="center" bgcolor="#DFF6FF" class="style3"><? echo $row["City"]; ?></td>
			<td align="center" bgcolor="#DFF6FF" class="style3"><? echo $row["Net_Salary"]; ?></td>
			<td align="center" bgcolor="#DFF6FF" class="style3"><? echo $row["Loan_Amount"]; ?></td>
			<td align="center" bgcolor="#DFF6FF" class="style3"><? echo $row["Feedback"]; ?></td>
			<td align="center" bgcolor="#DFF6FF" class="style3"><? echo $row["Asm_Feedback"]; ?></td>
		</tr>
	<?		
			$i=$i+1;
		}
	}
?>
</table>
<br>
<table width="758"  border="0" cellpadding="5" cellspacing="1">
	<? 
	if($recordcount>0)
	{
	?>
   <tr>
     <td align="center" class="bluelink">
	 <? 
		$c=1;
		for($c=1;$c<=$maxpage;$c++)
		{	
			if( $pageno==$c)
			{
					echo $c."&nbsp;";
			}
			else
			{
			?>
				<a onClick="javascript:sendmail('<? echo "&id=".$i."&pageno=".$c; ?>')" style="cursor:hand"><? echo $c; ?></a>
			<?
			}
		} 
		?>		</td>
     </tr>
   <? 
   } 
   ?>
</table>
<br>
	<? 
	//download clause here 
	$datediffvar= timeDiff($varmin_date,$varmax_date);
    if($datediffvar<=90)
	{
	?>
<table width="500" border="0" cellspacing="1" cellpadding="4">
 <form name="frmdownload" action="bidder_download.php" method="post">
   <tr>
     <td align="center">
	 <input type="hidden" name="qry1" value="<? echo $srch_qry; ?>">
	    <input type="hidden" name="BidderIDstatic" value="<? echo $BidderIDstatic; ?>">
	 <input type="hidden" name="qry2" value="<? echo $val; ?>">
	 <input type="hidden" name="min_date" value="<? echo $min_date; ?>">
	 <input type="hidden" name="max_date" value="<? echo $max_date; ?>">
	 <input name="Submit2" type="submit" class="bluebtn" value="Export List To Excel">
	 </td>
   </tr>
 </form>
</table>
<? 
	}
}
?>
</td></tr></table>
</td></tr></table>

<?
//logfile entry
if(ENABLELOGIN==1)
{
	$newFileName = './logfile/'.$pagename.".txt";
	file_put_contents($newFileName,$logfilecontent, FILE_APPEND);
}
		//end of logfile entry
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
