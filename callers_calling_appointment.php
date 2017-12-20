<?php
require 'scripts/session_check_online.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';
//callers_calling_appointment.php

	function getDocStatus($value)
	{
		if($value==1){ $DocStatus ="Complete";}  
		else if($value==2){ $DocStatus ="Incomplete Pick-up";}
		else if($value==3){ $DocStatus ="Sent For Login";}
		else if($value==4){ $DocStatus ="Return To Sales";}
		else if($value==5){ $DocStatus ="Logged In";}	

		return $DocStatus;
	}


$IP_Remote = $_SERVER["REMOTE_ADDR"];
if($IP_Remote=='192.124.249.12' || $IP_Remote=='185.93.228.12') { $IP= $_SERVER['HTTP_X_SUCURI_CLIENTIP']; }
else { $IP= $IP_Remote;	}
//echo $IP;
if($IP=="122.176.100.27" || $IP=="122.176.100.28" || $IP=="122.176.122.134" || $IP=="122.161.196.68" || $IP=="61.246.3.127" || $IP=="122.160.30.168"  || $IP=="122.161.193.191" || $IP=="122.160.74.241" || $IP=="122.160.74.235" || $IP=="172.20.122.14" || $IP=="180.151.74.83" || $IP=="115.249.245.30" || $IP=="182.71.109.218" || $IP=="122.160.74.235" || $IP=="185.93.231.12" || $IP=="192.88.134.12" || $IP=="124.124.244.141")
{
}
else {
	echo "Not a Valid User";
	echo '<meta http-equiv="refresh" content="5; URL=http://www.deal4loans.com/bidderslogin.php">';
	die(); 
}
//define("ENABLELOGIN", 1);
//for session variables
$productVal="";
	if(isset($_REQUEST['productVal']) && strlen($_REQUEST['productVal'])>0 )
	{
		 $productVal=$_REQUEST['productVal'];
	}
	else
	{
		$productVal=$_SESSION['product'];
	}

$val = getReqValue1($productVal);

 $pro_code=$productVal;



$logfilecontent="";
$logfilecontent.="********************************************************\n";
$logfilecontent.= "Datetime: ".ExactServerdate()."\n";
$logfilecontent.="IP Address: ".$IP."\n";
$logfilecontent.= "Session Variable: ".$sessionVar."\n";

$todaydt=date('Y-m-d');
function getReqValue1($pKey){
	$titles = array(
        '1' => 'Req_Loan_Personal',
		'2' => 'Req_Loan_Home',
		'3' => 'Req_Loan_Car',
		'4' => 'Req_Credit_Card',
		'5' => 'Req_Loan_Against_Property',
		'6' => 'Req_Business_Loan',
		'7' => 'Req_Loan_Gold',
		'10'=> 'Req_Loan_Bike'

	);
	foreach ($titles as $key=>$value)
	    if($pKey==$key)
		return $value;

	return "";
  }

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

$refernce_no="";
	if(isset($_REQUEST['refernce_no']))
	{
		$refernce_no = $_REQUEST['refernce_no'];
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

	$FeedbackClause="";
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
	
		
	$inhouseCut = '';
		$inhouseCut_Call = '';
		if($_SESSION['BidderID']==6467 || $_SESSION['BidderID']==6359 || $_SESSION['BidderID']==6358 ||  $_SESSION['BidderID']==6484 || $_SESSION['BidderID']==6483 || $_SESSION['BidderID']==6361 || $_SESSION['BidderID']==6482 || $_SESSION['BidderID']==6514 || $_SESSION['BidderID']==6482 || $_SESSION['BidderID']==6465)

		 {
		 $inhouseCut_Call = 1;
		 }
	if( $_SESSION['BidderID']==6484 || $_SESSION['BidderID']==6483 || $_SESSION['BidderID']==6361 || $_SESSION['BidderID']==6482 || $_SESSION['BidderID']==6514 || $_SESSION['BidderID']==6482 || $_SESSION['BidderID']==6465)// Cut for Inhouse
	{
		$inhouseCut = 1;	
	}

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
.input-lead{
	/* [disabled]border-radius:5px; */
	width: 150px;
	border: thin solid #CCC;
	height: 22px;
}
hr{ border-top:thin solid #CCC;}
.welcometext{ font-size:24px; color:#FFF; font-family:Arial, Helvetica, sans-serif;}
.heading-lead{ font-size:16px; text-align:left; color:#084459; font-family:Arial, Helvetica, sans-serif;}
.div-lead-left{ float:left; width:336px;}
.div-lead-left-small{ float:left; width:250px;}
.div-lead-left-button{ float:left; width:100px; margin-top:-5px;}
.div-lead-left-big{float:left; width:387px;}
</style>
<script type="text/JavaScript">
/*
function killCopy(e){ return false; }
function reEnable(){return true; }
document.onselectstart=new Function ("return false");
if (window.sidebar){ document.onmousedown=killCopydocument.onclick=reEnable }
function clickIE4(){if (event.button==2){ return false; } }
function clickNS4(e){ if (document.layers||document.getElementById&&!document.all){ if (e.which==2||e.which==3){ return false;} } }
if (document.layers){ document.captureEvents(Event.MOUSEDOWN); document.onmousedown=clickNS4; } else if (document.all&&!document.getElementById){ document.onmousedown=clickIE4; }
document.oncontextmenu=new Function("return false")*/
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
.auto-style1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 13px;
	color: #052733;
}
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
<!--
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
//-->
function sendmail(form)
{
	var gifName = form;
	document.frmsearch.action="callers_calling_appointment.php?search=y"+gifName;
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
				ajaxRequest.open("GET", "sbiadd_comment_lms_iccs.php" + queryString, true);
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
	
	function getNumberValue(iLoc,id, parameterVal)
	{
		//alert(iLoc);
		var allLoc = [];
		if(parameterVal>0 )
		{
			for(var iTrav=1; iTrav <= parameterVal; iTrav++) { allLoc.push(iTrav); }
		}
		else
		{
			for(var iTrav=1; iTrav <= <?php echo $pagesize; ?>; iTrav++) { allLoc.push(iTrav); }
		}
		var iRemove = allLoc.indexOf(iLoc);
		if(iRemove != -1) { allLoc.splice(iRemove, 1); }
		
		//alert(allLoc);
		
		var queryString = "?get_requestid=" + id;
		ajaxRequest.open("GET", "getfullertonNum.php" + queryString, true);
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
  
   <?php
	 if($inhouseCut_Call==1)
	 {
	?>	 
	
	 <script type="text/javascript">

    function checkCall(RequestID,agent_user)
    {	
	   $.ajax({ type: 'post',  url: '/dialerclick2callpltata.php',  data: {  RequestID:RequestID,agent_user:agent_user, },
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
	else if($_SESSION['BidderID']==6617)
	 {
	?>	 
	
	 <script type="text/javascript">

    function checkCall(RequestID,agent_user)
    {	
	   $.ajax({ type: 'post',  url: '/dialerclick2callplabfl.php',  data: {  RequestID:RequestID,agent_user:agent_user, },
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
	else
	{ ?>
  <script type="text/javascript">



    function checkCall(RequestID,agent_user)
    {	
		var funcVal = 'call';
	   $.ajax({ type: 'post',  url: '/external_dialer_c2c_pl.php',  data: {  RequestID:RequestID,agent_user:agent_user, functionC:funcVal },
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
	   $.ajax({ type: 'post',  url: '/external_dialer_c2c_pl.php',  data: {  RequestID:RequestID,agent_user:agent_user, functionC:funcVal, disPos:dispID },
			   success: function (response) {
			   //alert(response);
			   $( '#name_status' ).html(response);
  		          if(response=="OK") { return true;	 } else { return false;	}
                }
		      });
	}
</script>
<?php } ?>  

</head><body>
<table width="100%" border="0"  align="center" cellpadding="0" cellspacing="0" >
<tr>
    <td align="center">
	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#45B2D8">
			<tr><td style="padding-top:5px;  padding-right:10px; font-size:13px; text-align:right;">&nbsp;&nbsp;<a  href="/callers_calling_index.php" style="color:#FFFFFF;"><b>Calling</b></a> | <a href="/callers_calling_login.php" style="color:#FFFFFF;"><b>login</b></a></td></tr>

      <tr>
	  <td style="padding-top:10px;"><table  width="669" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#45B2D8" >
<? if (((!isset($val) && $viewtexttype==1) || ($val=="Req_Loan_Personal")) || ((!isset($val) && $viewtexttype==2) || ($val=="".$val."")))
	{?>
	<tr>
	  <td width="669"  align="left" valign="top" bgcolor="#FFFFFF" style="background-repeat:no-repeat;" ><table width="97%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="20" align="center"  >
	<h1 style="line-height:18px; " class="auto-style1">Dashboard - Appointment 
	To Login </h1>
	  </td>
  </tr>
  </table>
</td>
	  </tr>
		  </table></td>
</tr>
	<? } ?>
	    <tr><td>
		<form name="frmsearch" action="callers_calling_appointment.php?search=y" method="post" onSubmit="return chkform();">
		<div class="wrapper-leads">   
<input type="hidden" name="BidderIDstatic" id="BidderIDstatic" value="<? echo $BidderIDstatic;?>">
<input type="hidden" name="productVal" id="productVal" value="<? echo $productVal; ?>">
<input type="hidden" name="cmbfeedback" id="cmbfeedback" value="Appointment" />

	    <p class="heading-lead"><strong>Select date range</strong></p>
        <div class="div-lead-left">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="47%" class="style1">From</td>
    <td width="53%"><input name="min_date" class="input-lead" type="text" id="min_date" size="15" value="<? echo $_REQUEST['min_date']; ?>"  ></td>
  </tr>
</table>
        </div>
        <div class="div-lead-left">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="19%" class="style1">To</td>
    <td width="81%"><input name="max_date" class="input-lead" type="text" id="max_date" size="15" value="<? echo $_REQUEST['max_date']; ?>">
    
    </td>
  </tr>
</table>
        </div>
         <div style="clear:both;"></div>
        <hr>
          
        <div>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="24%" class="style1">Search with Refrence No</td>
    <td width="26%"><input type="text" name="refernce_no" id="refernce_no" value="<?php echo $refernce_no; ?>" class="input-lead" ></td>
      <td width="24%" class="style1">Spoc Feedback</td>
    <td width="26%">
   <select name="cmbfeedback" id="cmbfeedback" class="input-lead">
 		<option value="All" <? if($varCmbFeedback == "All") { echo "selected"; } ?>>All</option>
		<option value="Appointment - Rescheduled" <?php if($varCmbFeedback== "Appointment - Rescheduled") { echo 'selected';} ?> >Appointment - Rescheduled</option>
		<option value="Appointment - Cancelled" <?php if($varCmbFeedback== "Appointment - Cancelled") { echo 'selected';} ?> >Appointment - Cancelled</option>
		<option value="Assigned For Pick-up" <?php if($varCmbFeedback== "Assigned For Pick-up") { echo 'selected';} ?> >Assigned For Pick-up</option>
		<option value="Ringing" <?php if($varCmbFeedback== "Ringing") { echo 'selected';} ?> >Ringing</option>
		<option value="Followup" <?php if($varCmbFeedback== "Followup") { echo 'selected';} ?> >Followup</option>
		 <option value="Complete Pick-up" <?php if($varCmbFeedback=="Complete Pick-up"){ echo "selected";} ?>>Complete Pick-up</option>
         <option value="Incomplete Pick-up" <?php if($varCmbFeedback=="Incomplete Pick-up"){ echo "selected";} ?>>Incomplete Pick-up</option>
         <option value="Sent For Login" <?php if($varCmbFeedback=="Sent For Login"){ echo "selected";} ?>>Sent For Login</option>
   </select>    
    </td>
  </tr>
  <tr>
    <td class="style1" align="center" colspan="4"><input name="Submit" type="image"  src="images/login-form-lgn-srch.gif" style="width:111px; height:35px; border:none;" border="0">
     </td>
    </tr>
</table>


        </div>
        
<div style="clear:both;"></div>
	    </div></form></td></tr> 
	    <tr><td>
			&nbsp;</td></tr> 
 </table>
	<?php
	$search_date="";
	$varmin_date=$min_date;
	$varmax_date=$max_date;
	if($search=="y")
	{
		$min_date=$min_date." 00:00:00";
		$max_date=$max_date." 23:59:59";
		$FeedbackClause=" AND client_lead_allocate.Feedback='Appointment' ";
		
		if($asmwise>0)
		{
			$citywise_clause=" AND client_lead_allocate.AsmID in (".$asmwise.")";
			$citywise="";
		}

		if($mob_num>0)
		{
			$mob_num_clause = " AND `".$val."`.Mobile_Number = '".$mob_num."' ";
		}
		
		$feedback_tble="client_lead_allocate";	

	if(strlen($refernce_no)>3)
		{	$appdtxt="PL";
			list($requestidno, $bidderid) = split('[S]', $refernce_no);
			$refernce_no_section = str_replace($appdtxt, "",$requestidno);

			 $refernce_no_clause = " AND zexternal_appointment_docs.Feedback_ID = '".$refernce_no_section."' ";
		}
	?>
 <p class="bodyarial11"><?=$Msg?></p>
   <p align="center"><span id="name_status" style="color:#F00; font-weight:bold;"></span> </p>
<table width="950" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#FFFFFF" >
 <? 
$strBidderID= implode("','",$arrBidderID);//Not in use
	
		
	if(strlen(trim($varCmbFeedback))==0)
	{
		$FeedbackClause=" ";
	}
	else if($varCmbFeedback=="All")
	{
		$FeedbackClause=" ";
	}
	else
	{
		if($varCmbFeedback==1 || $varCmbFeedback==2 || $varCmbFeedback==3)
		{
			$FeedbackClause=" AND zexternal_appointment_docs.docStatus='".$varCmbFeedback."' ";
		}
		else
		{
			$FeedbackClause=" AND zexternal_appointment_docs.spoc_status='".$varCmbFeedback."' ";
		}

	}
		
	$Query = "select Req_Loan_Personal.RequestID AS RequestID, Req_Loan_Personal.RequestID AS AllRequestID, Name, City, Mobile_Number, docpickerid, id, caller_id, Loan_Amount, Company_Name, Net_Salary, appt_date, appt_time, special_remarks, spoc_status, assigned_remark, doc_pickup_remark, zexternal_appointment_docs.updated_date AS updateDt, docStatus, zexternal_appointment_docs.Feedback_ID, zexternal_appointment_docs.BidderID, zexternal_appointment_docs.BankID from zexternal_appointment_docs LEFT OUTER JOIN Req_Loan_Personal ON Req_Loan_Personal.RequestID= zexternal_appointment_docs.RequestID where 1=1 and zexternal_appointment_docs.Reply_Type=1 and zexternal_appointment_docs.viewstatus=1  and  zexternal_appointment_docs.AgentFeedback=1";
	$agent_ids = $BidderIDstatic;
	$Query .= " and zexternal_appointment_docs.caller_id in (".$agent_ids.") ";
	$Query .= $FeedbackClause." ".$citywise_clause." ".$mob_num_clause." ".$refernce_no_clause;
	$Query .= " and ((zexternal_appointment_docs.dated  Between '".($min_date)."' and '".($max_date)."') ) ";
	//echo $Query."<br><br>";
	
		$result=d4l_ExecQuery($Query);
		$recordcount = d4l_mysql_num_rows($result);
 ?>
	 <tr>
     <td colspan="11" style="border-bottom:1px solid #45B2D8;"><strong><? echo $startrow+1; ?> to <? echo min($startrow+$pagesize,$recordcount); ?> Out of <? echo $recordcount; ?> Records </strong>
     </tr>	
   <tr>
   <td width="149" align="center" bgcolor="#FFFFFF" class="style2">Reference No</td>
     <td width="149" align="center" bgcolor="#FFFFFF" class="style2">Name</td>
       <?php
	 if($inhouseCut==1)
	 {
	?>

<td width="88" align="center" bgcolor="#FFFFFF" class="style2">Mobile</td>  
<?php } ?>
	   <td width="88" align="center" bgcolor="#FFFFFF" class="style2">City</td>     
     <td width="91" align="center" bgcolor="#FFFFFF" class="style2">Net Salary </td>

	 <td width="90" align="center" bgcolor="#FFFFFF" class="style2">Loan Amount </td>	
	 
     <td width="171" align="center" bgcolor="#FFFFFF" class="style2">Spoc Feedback</td>
      <td width="171" align="center" bgcolor="#FFFFFF" class="style2">Field Executive</td>
	 <td width="250" align="center" bgcolor="#FFFFFF" class="style2">Common Comment</td>
      <td width="171" align="center" bgcolor="#FFFFFF" class="style2">Appointment Date</td>
	  <td width="180" align="center" bgcolor="#FFFFFF" class="style2">Call</td>
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
	
		$qry= $Query;
		$qry=$qry." group by Req_Loan_Personal.Mobile_Number";
		$qry=$qry." order by Req_Loan_Personal.Dated DESC";

		$qry=$qry." LIMIT $startrow, $pagesize"; 
		//}
		$result=d4l_ExecQuery($qry);
		$getParameterVal = min($startrow+$pagesize,$recordcount) % $pagesize;
		
//echo $qry."<br>";
		$logfilecontent.="Sql Query: ".$qry."\n";
		$logfilecontent.="********************************************************";
		if($pro_code==1)
			{
				$leadviewpage="edit-personal-details.php";
			}
			elseif($pro_code==2)
			{
				$leadviewpage="homeloanlead-details.php";
			}
			elseif($pro_code==3)
			{
				$leadviewpage="carloanlead-details.php";
			}
			elseif($pro_code==4)
			{
				$leadviewpage="creditcardlead-details.php";
			}
			elseif($pro_code==5)
			{
				$leadviewpage="loanagainstlead-details.php";
			}
			else
			{				}
		$i=1;
		if($recordcount>0)
		{
		while($row=d4l_mysql_fetch_array($result))
		{						
		
																
	?>
	<input type="hidden" name="requestid_<? echo $i;?>" id="requestid_<? echo $i;?>" value="<? echo $row["RequestID"];?>">
	<input type="hidden" name="bidderid" id="bidderid" value="<? echo $BidderIDstatic;?>">
   <tr>
   <td align="center" bgcolor="#DFF6FF" class="style3"><? echo "PL".$row["Feedback_ID"]."S".$BidderIDstatic; ?></td>
      <td align="center" bgcolor="#DFF6FF" class="style3"><a href="/<? echo $leadviewpage; ?>?postid=<? echo $row["RequestID"]; ?>&biddt=<? echo $BidderIDstatic; ?>" target="_blank"><?php echo $row["Name"]; ?></a></td>
    <?php
	 if($inhouseCut==1)
	 {
	?>
      <td align="center" bgcolor="#DFF6FF" class="style3"><span id="clik4Num_<?php echo $i; ?>">XXXXXXXXXX</span></td>
<?php } ?>
      
		<td align="center" bgcolor="#DFF6FF" class="style3"><?php
	 if($inhouseCut==1)
	 {
	?><span id="clkNum<?php echo $i; ?>" onClick="return getNumberValue(<?php echo $i; ?>,<?php echo $row["RequestID"]; ?>,<?php echo $getParameterVal; ?>)" style="cursor:hand;"><?php echo $row["City"]; ?></span><?php } else { ?><?php echo $row["City"]; ?><?php } ?></td>

     <td align="center" bgcolor="#DFF6FF" class="style3"><? echo $row["Net_Salary"]; ?></td>
	  <td align="center" bgcolor="#DFF6FF" class="style3"><? echo $row["Loan_Amount"]; ?></td>
	  
	  <td align="center" bgcolor="#DFF6FF" class="style3">	  <?php	  		echo  $row["spoc_status"];	  ?>
	  <?php if($row["docStatus"]==1 || $row["docStatus"]==2 || $row["docStatus"]==3)
	  {
	  	if(strlen($row["spoc_status"])>0) {} else 
	  	{ ?>
	  		<span style="color:green; font-weight:bold;"><?php echo getDocStatus($row["docStatus"]); ?></span>
<?php	  	}
	  }
	  ?>
  </td>
	  	  <td align="center" bgcolor="#DFF6FF" class="style3">	  <?php	  
	  $getFEDetailsSql = "select Name as FE_Name, Mobile_Number as FE_Mobile from zexternal_appointment_users where id='".$row["docpickerid"]."'";
			$getFEDetailsQry = d4l_ExecQuery($getFEDetailsSql);
			$FE_Name = d4l_mysql_result($getFEDetailsQry,0,'FE_Name');
			$FE_Mobile = d4l_mysql_result($getFEDetailsQry,0,'FE_Mobile');
			if(strlen($FE_Name)>0) {
			echo $FE_Name." (".$FE_Mobile.")"; } ?> </td>
		  <td align="center" bgcolor="#DFF6FF" class="style3">
          <textarea readonly cols="20" rows="3"><? echo $row["assigned_remark"]; ?></textarea></td>
          <td align="center" bgcolor="#DFF6FF" class="style3"><?php echo date("d/m/Y", strtotime($row["appt_date"])); echo "<br>".$row["appt_time"]; ?></td>
          
          
          <td align="center" bgcolor="#DFF6FF" class="style3"><input type="button" name="chkCall" value="Call" onClick="checkCall(<?php echo $row['RequestID'] ?>,<?php echo $BidderIDstatic ?>)" /></td>
          
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
   if($datediffvar<=7)
		{
      ?>
<!--<table width="500" border="0" cellspacing="1" cellpadding="4">
 <form name="frmdownload" action="bidder_download.php" method="post">
   <tr>
     <td align="center">
	 <input type="hidden" name="qry1" value="<? //echo $search_qry; ?>">
	    <input type="hidden" name="BidderIDstatic" value="<? //echo $BidderIDstatic; ?>">
	 <input type="hidden" name="qry2" value="<? //echo $val; ?>">
	 <input type="hidden" name="min_date" value="<? //echo $min_date; ?>">
	 <input type="hidden" name="max_date" value="<? //echo $max_date; ?>">
	 <input name="Submit2" type="submit" class="bluebtn" value="Export List To Excel">
	 </td>
   </tr>
 </form>
 </table>-->
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
