<?php
require 'scripts/session_check_online.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';

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
if($IP=="122.176.100.27" || $IP=="122.176.100.28" || $IP=="122.176.122.134" || $IP=="122.161.196.68" || $IP=="61.246.3.127" || $IP=="122.160.30.168"  || $IP=="122.161.193.191" || $IP=="122.160.74.241" || $IP=="122.160.74.235" || $IP=="172.20.122.14" || $IP=="180.151.74.83" || $IP=="115.249.245.30" || $IP=="182.71.109.218" || $IP=="122.160.74.235" || $IP=="185.93.231.12" || $IP=="192.88.134.12"  || $IP=="122.176.54.194" || $IP=="122.160.74.241"|| $IP=="122.176.54.210" || $IP=="122.177.136.237" || $IP=="103.18.75.251" || $IP=="124.124.244.139" || $IP=="117.212.76.98" )
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
	$Primary_Acc="";
	if(isset($_REQUEST['Primary_Acc']))
	{
		$Primary_Acc=$_REQUEST['Primary_Acc'];
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
	document.frmsearch.action="callers_calling_index1.php?search=y"+gifName;
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
		<tr><td style="padding-top:5px; padding-right:10px; font-size:13px; text-align:right;">&nbsp;&nbsp; <a  href="/change_lms_pwd.php" target="_blank" style="color:#FFFFFF;"><b>Change Password</b></a> | <a  href="/callers_calling_appointment.php" style="color:#FFFFFF;"><b>Appointment</b></a> | <a href="/callers_calling_login.php" style="color:#FFFFFF;"><b>login</b></a></td></tr>
      <tr>
	  <td style="padding-top:10px;"><table  width="669" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#45B2D8" >
<? if (((!isset($val) && $viewtexttype==1) || ($val=="Req_Loan_Personal")) || ((!isset($val) && $viewtexttype==2) || ($val=="".$val."")))
	{?>
	<tr>
	  <td width="669"  align="left" valign="top" bgcolor="#FFFFFF" style="background-repeat:no-repeat;" ><table width="97%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="20" align="center"  ><h1 style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; color:#052733; line-height:18px; font-weight:bold;">Welcome to Deal4Loans LMS</h1></td>
  </tr>
  </table>
</td>
	  </tr>
		  </table></td>
</tr>
	<? } ?>
	    <tr><td>
		<form name="frmsearch" action="callers_calling_index1.php?search=y" method="post" onSubmit="return chkform();">
		<div class="wrapper-leads">   
<input type="hidden" name="BidderIDstatic" id="BidderIDstatic" value="<? echo $BidderIDstatic;?>">
<input type="hidden" name="productVal" id="productVal" value="<? echo $productVal; ?>">

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
    <td width="81%"><input name="max_date" class="input-lead" type="text" id="max_date" size="15" value="<? echo $_REQUEST['max_date']; ?>"></td>
  </tr>
</table>
        </div>
        <div style="clear:both;"></div>
           <hr>
             <p class="heading-lead"><strong>Add Filter</strong></p>          
        <div class="div-lead-left-small" style="width: 780px">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="style1" style="width: 20%">Feedback</td>
    <td ><select name="cmbfeedback" id="cmbfeedback" class="input-lead">
 		<option value="All" <? if($varCmbFeedback == "All") { echo "selected"; } ?>>All</option>
		<option value="" <? if($varCmbFeedback == "") { echo "selected"; } ?>>No Feedback</option>
	<option value="Ringing" <? if($varCmbFeedback == "Ringing") { echo "selected"; } ?>>Ringing</option>
        <option value="Appointment" <? if($varCmbFeedback == "Appointment") { echo "selected"; } ?>>Appointment</option>
        <option value="Followup" <? if($varCmbFeedback == "Followup") { echo "selected"; } ?>>Follow up</option>
    	<option value="Not Eligible - FOIR" <? if($varCmbFeedback == "Not Eligible - FOIR") { echo "selected"; } ?>>Not Eligible - FOIR</option>
    	<option value="Not Eligible - Salary" <? if($varCmbFeedback == "Not Eligible - Salary") { echo "selected"; } ?>>Not Eligible - Salary</option>
    	<option value="Not Eligible - Others" <? if($varCmbFeedback == "Not Eligible - Others") { echo "selected"; } ?>>Not Eligible - Others</option>
	<option value="Not Interested - Direct" <? if($varCmbFeedback == "Not Interested - Direct") { echo "selected"; } ?>>Not Interested - Direct</option>
    <option value="Not Interested - Offer" <? if($varCmbFeedback == "Not Interested - Offer") { echo "selected"; } ?>>Not Interested - Offer (ROI/PF etc)</option>
    <option value="Not Interested - Loan Amount" <? if($varCmbFeedback == "Not Interested - Loan Amount") { echo "selected"; } ?>>Not Interested - Loan Amount</option>
 <option value="Not Contactable" <? if($varCmbFeedback == "Not Contactable") { echo "selected"; } ?>>Not Contactable</option>
         <?php if($_SESSION["Associated_Bank"]=="Tata Capital")
		{
        ?>
        <option value="CIBIL ok - Follow Up" <? if($varCmbFeedback == "CIBIL ok - Follow Up") { echo "selected"; } ?>>CIBIL ok - Follow Up</option>
        <option value="CIBIL Ok - Not Interested" <? if($varCmbFeedback == "CIBIL Ok - Not Interested") { echo "selected"; } ?>>CIBIL Ok - Not Interested</option>
        <option value="NE - CIBIL" <? if($varCmbFeedback == "NE - CIBIL") { echo "selected"; } ?>>NE - CIBIL</option>
        <option value="NE - Other" <? if($varCmbFeedback == "NE - Other") { echo "selected"; } ?>>NE - Other</option>
        <option value="CIBIL Refer - Follow Up" <? if($varCmbFeedback == "CIBIL Refer - Follow Up") { echo "selected"; } ?>>CIBIL Refer - Follow Up</option>
        <option value="CIBIL Refer - Not Interested" <? if($varCmbFeedback == "CIBIL Refer - Not Interested") { echo "selected"; } ?>>CIBIL Refer - Not Interested</option>
        <?php 
		}
		else if($_SESSION["Associated_Bank"]=="ICICI Bank")
		{
		?>
       <option value="TU Approved" <? if($varCmbFeedback == "TU Approved") { echo "selected"; } ?>>TU Approved</option>
 
<option value="TU Approved Followup" <? if($varCmbFeedback == "TU Approved Followup") { echo "selected"; } ?>>TU Approved Followup</option>
<option value="TU Approved Not Interested" <? if($varCmbFeedback == "TU Approved Not Interested") { echo "selected"; } ?>>TU Approved Not Interested</option>
 <option value="TU Referred" <? if($varCmbFeedback == "TU Referred") { echo "selected"; } ?>>TU Referred</option>
 <option value="TU Referred Followup" <? if($varCmbFeedback == "TU Referred Followup") { echo "selected"; } ?>>TU Referred Followup</option>
  <option value="TU Referred Not Interested" <? if($varCmbFeedback == "TU Referred Not Interested") { echo "selected"; } ?>>TU Referred Not Interested</option> 
 <option value="TU Declined" <? if($varCmbFeedback == "TU Declined") { echo "selected"; } ?>>TU Declined</option>
        <?php } ?>
	                        </select></td>
	                        <td><strong>Bank Account</strong></td>
	                        <td>
	                        <select name="Primary_Acc" id="Primary_Acc" class="input-lead">
 		<option value="Other" <? if($Primary_Acc== "") { echo "selected"; } ?>>All</option>
		<option value="ICICI Bank" <? if($Primary_Acc== "ICICI Bank") { echo "selected"; } ?>>ICICI Bank</option>
</select>
	                        </td>
  </tr>
</table>
        </div>
        <div style="clear:both;"></div>
        <hr>
        <p class="heading-lead"><strong>Search</strong></p>
      
        <div class="div-lead-left-big">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="48%" class="style1">Search with Refrence No</td>
    <td width="52%"><input type="text" name="refernce_no" id="refernce_no" value="<?php echo $refernce_no; ?>" class="input-lead" ></td>
  </tr>
</table>
        </div>
        <div class="div-lead-left-button">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="style1"><input name="Submit" type="image"  src="images/login-form-lgn-srch.gif" style="width:111px; height:35px; border:none;" border="0">
     </td>
    </tr>
</table>
        </div>
<div style="clear:both;"></div>
	    </div></form></td></tr> 
 </table>
	<?php
	$search_date="";
	$varmin_date=$min_date;
	$varmax_date=$max_date;
	if(strlen(trim($RequestID))>0)
	{
		//echo "select leadid from client_lead_allocate where AllRequestID=$RequestID and BidderID=".$bidsession;
		 if($_SERVER['REMOTE_ADDR']=="122.176.122.134")
 	    {

		//echo "select leadid from client_lead_allocate where AllRequestID=$RequestID and BidderID=".$bidsession;
		}

		$strSQL="";
		$Msg="";
		$result = ExecQuery("select leadid from client_lead_allocate where AllRequestID=$RequestID and BidderID=".$bidsession);		
		$num_rows = mysql_num_rows($result);
		if($num_rows > 0)
		{
			$row = mysql_fetch_array($result);
			$strSQL="Update client_lead_allocate Set Feedback='".$Feedback."' ";
			$strSQL=$strSQL." Where leadid=".$row["leadid"];
			
			$checkDocsSql = "select RequestID from zexternal_appointment_docs where RequestID='".$RequestID."' and Reply_Type=1 and viewstatus=1 and caller_id='".$bidsession."'";
			$checkDocsQuery = ExecQuery($checkDocsSql);
			$checkDocsNumRows = mysql_num_rows($checkDocsQuery);
			$tomorrowDate = date('Y-m-d',strtotime("+1 days"))." ".date('H:i:s');
			if($_SERVER['REMOTE_ADDR']=="122.176.122.134")
	 	    {
			//	echo "<br>".$checkDocsSql."<br>checkDocsNumRows - ".$checkDocsNumRows."<br>";
			}
			$AgentFeedback ='';
			if($Feedback=="Appointment")
			{
				$AgentFeedback =1;
			}
			else
			{
				$AgentFeedback =2;
			}
			if($checkDocsNumRows>0)
			{
				$updateSql = "update zexternal_appointment_docs set AgentFeedback='".$AgentFeedback."', appt_date='".$tomorrowDate."' where RequestID='".$RequestID."' and Reply_Type=1 and viewstatus=1 ";
				ExecQuery($updateSql);
				//echo $updateSql ." - in updateSql";
			}
			else
			{
				if($_SERVER['REMOTE_ADDR']=="122.176.122.134")
		 	    {
			//		echo "<br>Check<br>";
				}	
				
				$sql1 = "select Feedback_ID from client_lead_allocate where AllRequestID='".$RequestID."' and BidderID='".$bidsession."'";
				$query1 = ExecQuery($sql1);
				$Feedback_ID_Agent = mysql_result($query1,0,'Feedback_ID');
				$sql1 = "select BidderID from Req_Feedback_Bidder_PL where AllRequestID='".$RequestID."' and Feedback_ID='".$Feedback_ID_Agent."'";
				$query1 = ExecQuery($sql1);
				$BidderID_Agent = mysql_result($query1,0,'BidderID');
				
				$sql1 = "select BankID from Bidders_List where BidderID='".$BidderID_Agent."'";
				$query1 = ExecQuery($sql1);
				$BankID_Agent= mysql_result($query1,0,'BankID');

				
                    $QuryReqPL = "select City, City_Other from Req_Loan_Personal where RequestID='".$RequestID."'";
                    $queryReqPL1 = ExecQuery($QuryReqPL);
                    $plcity= mysql_result($queryReqPL1,0,'City');
                    $plcity_other= mysql_result($queryReqPL1,0,'City_Other');
                    if($plcity=='Others'){
                                $CityVal = $plcity_other;
                            }else{
                                $CityVal = $plcity;
                            }
                            
                                if($Feedback=="Appointment")
				{
					//insert 
					$insertSql = "INSERT INTO zexternal_appointment_docs (caller_id, RequestID, CityName, Reply_Type, appt_date, dated, updated_date, viewstatus, AgentFeedback,Feedback_ID,BidderID,BankID) VALUES ('".$bidsession."', '".$RequestID."', '".$CityVal."', '1', '".$tomorrowDate."', Now(),Now(), '1', '1', '".$Feedback_ID_Agent."', '".$BidderID_Agent."', '".$BankID_Agent."')";
					ExecQuery($insertSql);
					//echo $insertSql." - in If Condition";
				}
				else
				{
				//insert 
					$insertSql = "INSERT INTO zexternal_appointment_docs (caller_id, RequestID, CityName, Reply_Type, appt_date, dated, updated_date, viewstatus, AgentFeedback,Feedback_ID,BidderID,BankID) VALUES ('".$bidsession."', '".$RequestID."', '".$CityVal."', '1', '".$tomorrowDate."', Now(),Now(), '1', '2', '".$Feedback_ID_Agent."', '".$BidderID_Agent."', '".$BankID_Agent."')";
									//	echo $insertSql." - in Else Condition";
					//ExecQuery($insertSql);
				}
				
				if($_SERVER['REMOTE_ADDR']=="122.176.122.134")
		 	    {
			//		echo "<br>".$insertSql ."<br>";
				}	

			}
		}
		
		//echo $strSQL;
		$result = ExecQuery($strSQL);
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
		if(strlen(trim($varCmbFeedback))==0)
		{
			$FeedbackClause=" AND (client_lead_allocate.Feedback IS NULL OR client_lead_allocate.Feedback='' OR client_lead_allocate.Feedback='No Feedback') ";
		}
		else if($varCmbFeedback=="All")
		{
			$FeedbackClause=" ";
		}
		else
		{
			$FeedbackClause=" AND client_lead_allocate.Feedback='".$varCmbFeedback."' ";
		}
		
		if($Primary_Acc=="ICICI Bank")
		{
			$Primary_AccClause = " and ".$val.".Primary_Acc='".$Primary_Acc."' ";
		}
		else
		{
			$Primary_AccClause = "";
		}
		
		//all filters
		/*if(strlen($citywise)>0 )
		{
			//$citywise_clause=" AND client_lead_allocate.AsmID in (".$citywise.")";
			if($citywise=="MUMBAI")
			{
				$citywise_clause=" AND ".$val.".City in ('Mumbai','Thane','Navi Mumbai')";
			}
			elseif($citywise=="DELHI"){
				$citywise_clause=" AND ".$val.".City in ('Delhi','Gaziabad','Faridabad','Gurgaon','Noida')";				
			}
			else{
			$citywise_clause=" AND ".$val.".City in ('".$citywise."')";
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
			$mob_num_clause = " AND `".$val."`.Mobile_Number = '".$mob_num."' ";
		}
		
		$feedback_tble="client_lead_allocate";	

	if(strlen($refernce_no)>3)
		{	$appdtxt="PL";
			list($requestidno, $bidderid) = split('[S]', $refernce_no);
			$refernce_no_section = str_replace($appdtxt, "",$requestidno);

			 $refernce_no_clause = " AND `".$feedback_tble."`.Feedback_ID = '".$refernce_no_section."' ";
		}
	?>
 <p class="bodyarial11"><?=$Msg?></p>
   <p align="center"><span id="name_status" style="color:#F00; font-weight:bold;"></span> </p>
<table width="950" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#FFFFFF" >
 <? 
$strBidderID= implode("','",$arrBidderID);
	if ($pro_code==2)
			{
				$getfieldsdwnld="Employment_Status,Property_Identified,Allocation_Date,Name,DOB,Email,City,City_Other,Pincode,Mobile_Number,Net_Salary,Add_Comment,Loan_Amount,Feedback,Budget,Property_Loc,Loan_Time,comment_section,Feedback_ID,Property_Value,axis_executive_name,Followup_Date";
			}
		
			
			//get biddeid
			$qry="SELECT * FROM client_lead_allocate,".$val."  WHERE (client_lead_allocate.BidderID=".$BidderIDstatic." and client_lead_allocate.Reply_Type=".$pro_code." and client_lead_allocate.AllRequestID=`".$val."`.RequestID and (client_lead_allocate.Allocation_Date Between '".($min_date)."' and '".($max_date)."' or client_lead_allocate.Followup_Date Between '".($min_date)."' and '".($max_date)."'))";
			$qry=$qry.$FeedbackClause." ".$citywise_clause." ".$mob_num_clause." ".$refernce_no_clause." ".$Primary_AccClause ;
			$qry=$qry."group by ".$val.".Mobile_Number";
		//}
		echo $qry."<br><br>";
		if($_SERVER['REMOTE_ADDR']=="122.176.100.27")
		{
			//echo $qry."<br><br>";
		}	

		$result=ExecQuery($qry);
		$recordcount = mysql_num_rows($result);
 ?>
	 <tr>
     <td   <?php
	 if($inhouseCut==1)
	 {
	?>
 colspan="12" <?php } else { ?> colspan="11"<?php } ?> style="border-bottom:1px solid #45B2D8;"><strong><? echo $startrow+1; ?> to <? echo min($startrow+$pagesize,$recordcount); ?> Out of <? echo $recordcount; ?> Records </strong>
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
     <td width="71" align="center" bgcolor="#FFFFFF" class="style2">Spoc Feedback</td>
     <td width="71" align="center" bgcolor="#FFFFFF" class="style2">Feedback</td>
	 <td width="180" align="center" bgcolor="#FFFFFF" class="style2">Add Comment</td>
     	 <td width="180" align="center" bgcolor="#FFFFFF" class="style2">View Comment</td>
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
		/*if(strlen($citywise)>0)
		{
			$qry="SELECT * FROM client_lead_allocate,".$val."  WHERE (client_lead_allocate.BidderID in ('".$citywise."') and client_lead_allocate.Reply_Type=2 and client_lead_allocate.AllRequestID=`".$val."`.RequestID and (client_lead_allocate.Allocation_Date Between '".($min_date)."' and '".($max_date)."' or client_lead_allocate.Followup_Date Between '".($min_date)."' and '".($max_date)."'))";
			$qry=$qry.$FeedbackClause." ".$citywise_clause." ".$mob_num_clause." ".$refernce_no_clause;
			$qry=$qry."group by ".$val.".Mobile_Number";
			$qry=$qry." order by ".$val.".Dated DESC";
			$qry=$qry." LIMIT $startrow, $pagesize"; 
		}
		else
		{*/
		$qry="SELECT * FROM client_lead_allocate,".$val."  WHERE (client_lead_allocate.BidderID=".$BidderIDstatic." and client_lead_allocate.Reply_Type=".$pro_code." and client_lead_allocate.AllRequestID=`".$val."`.RequestID and (client_lead_allocate.Allocation_Date Between '".($min_date)."' and '".($max_date)."' or client_lead_allocate.Followup_Date Between '".($min_date)."' and '".($max_date)."'))";
		$qry=$qry.$FeedbackClause." ".$citywise_clause." ".$mob_num_clause." ".$refernce_no_clause." ".$Primary_AccClause;
		$qry=$qry."group by ".$val.".Mobile_Number";
		$qry=$qry." order by ".$val.".Dated DESC";
		$qry=$qry." LIMIT $startrow, $pagesize"; 
		//}
		$result=ExecQuery($qry);
//echo $qry."<br>";

$getParameterVal = min($startrow+$pagesize,$recordcount) % $pagesize;

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
		while($row=mysql_fetch_array($result))
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
	  
	  <td align="center" bgcolor="#DFF6FF" class="style3">
	  <?php
	  	$spocStatus = '';
	  	
			$getApptDetailsSql = "select * from zexternal_appointment_docs where RequestID='". $row["RequestID"]."' and caller_id='".$_SESSION['BidderID']."' order by id asc";
			$getApptDetailsQry = ExecQuery($getApptDetailsSql);
			$docStatus = mysql_result($getApptDetailsQry,0,'docStatus');
			$spocStatus = mysql_result($getApptDetailsQry,0,'spocStatus');
			if($docStatus>0 || strlen($spocStatus)>0 )
			{
				$iupdated_date = mysql_result($getApptDetailsQry,0,'updated_date');
				$iupdatedDate = " | ".$iupdated_date;
			}
			$idocStatus=  getDocStatus($docStatus);
			if(strlen($spocStatus)>0)
			{
				$ispocStatus = " | ".$spocStatus;
			}
			echo $idocStatus." ".$ispocStatus."".$iupdatedDate;
	  ?>
	  
	  </td>
       <td align="center" bgcolor="#DFF6FF" class="style3"><? if($row["Feedback"]=="Appointment")
       { echo "<b>".$row["Feedback"]."</b>"; } else { 		
	echo getJumpMenu("callers_calling_index1.php",$row["RequestID"],"1",$row["Feedback"],$pageno,$varmin_date,$varmax_date,$varCmbFeedback, $val,$row["BidderID"]); } ?>
		</td>
<td align="center" bgcolor="#DFF6FF" class="bodyarial11"><table width="100%"><tr><td><textarea  name="comment_section_<? echo $i;?>" id="comment_section_<? echo $i;?>" cols="15" rows="2"><? //echo $row["Comments"]; ?></textarea></td><td><a onClick="insertData(<? echo $i;?>);" style="cursor:pointer; color:blue;" class="style3">Save</a></td></tr>
	<tr><td colspan="2">
	
	<input name="followup_date_<? echo $i;?>" type="text" id="followup_date_<? echo $i;?>" size="10" value="<? echo $row["Followup_Date"];?>">&nbsp;<a href="javascript:NewCal('followup_date_<? echo $i;?>','yyyymmdd',true,24)"><img src="images/cal.gif" width="16" height="16" border="0" alt="Pick a date"></a></td></tr>
	</table></td>	
		  <td align="center" bgcolor="#DFF6FF" class="style3">
          <?php
		    $sql_Comments = "SELECT * FROM  `client_lead_allocated_comment` where RequestID='".$row['RequestID']."' and BidderID='".$BidderIDstatic."' ORDER BY  `client_lead_allocated_comment`.`id` DESC LIMIT 0 , 1";
 			$query_Comments = ExecQuery($sql_Comments);
			$numRows_Comments = mysql_num_rows($query_Comments);
			if($numRows_Comments>0)
			{
				$show_Comments = mysql_result($query_Comments,0,'Comments');
			}
			else 
			{
				$show_Comments = $row["Comments"];
			}
 			
		  ?>
          <textarea readonly cols="20" rows="3"><? echo $show_Comments; ?></textarea></td><td align="center" bgcolor="#DFF6FF" class="style3">
           <?php
	 if($_SESSION['BidderID']==6514)
	 { } else {
	?>

          <input type="button" name="chkCall" value="Call" onClick="checkCall(<?php echo $row['RequestID'] ?>,<?php echo $BidderIDstatic ?>)" /> <?php } ?></td>
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
function getJumpMenu($varPHPPage, $varRequestID, $varType, $varFeedback, $varpageon, $varmindate, $varmaxdate,$cmbfeedback,$varVal,$BidderIDstatic)
{
	$strURL="";
	$strURL=$varPHPPage."?search=y&RequestID=".$varRequestID."&type=".$varType."&pageno=".$varpageon."&min_date=".urlencode($varmindate)."&max_date=".urlencode($varmaxdate)."&cmbfeedback=".urlencode($cmbfeedback)."&product=".$varVal."&bidsession=".$BidderIDstatic;
?>
	<select name="type" id="type" onChange="MM_jumpMenu('parent',this,0)" class="style3" style="width:110px;">
		     
<option value="<? echo $strURL.'&Feedback='?>" <? if($varFeedback == "") { echo "selected"; } ?> >No Feedback</option>
        <option value="<? echo $strURL.'&Feedback=Ringing'?>" <? if($varFeedback == "Ringing") { echo "selected"; } ?>>Ringing</option>
        <option value="<? echo $strURL.'&Feedback=Appointment'?>" <? if($varFeedback == "Appointment") { echo "selected"; } ?>>Appointment</option>
        <option value="<? echo $strURL.'&Feedback=Followup'?>" <? if($varFeedback == "Followup") { echo "selected"; } ?>>Follow up</option>
        <option value="<? echo $strURL.'&Feedback=Not Eligible - FOIR'?>" <? if($varFeedback == "Not Eligible - FOIR") { echo "selected"; } ?>>Not Eligible - FOIR</option>
        <option value="<? echo $strURL.'&Feedback=Not Eligible - Salary'?>" <? if($varFeedback == "Not Eligible - Salary") { echo "selected"; } ?>>Not Eligible - Salary</option>
        <option value="<? echo $strURL.'&Feedback=Not Eligible - Others'?>" <? if($varFeedback == "Not Eligible - Others") { echo "selected"; } ?>>Not Eligible - Others</option>
        <option value="<? echo $strURL.'&Feedback=Not Interested - Direct'?>" <? if($varFeedback == "Not Interested - Direct") { echo "selected"; } ?>>Not Interested - Direct</option>
        <option value="<? echo $strURL.'&Feedback=Not Interested - Offer'?>" <? if($varFeedback == "Not Interested - Offer") { echo "selected"; } ?>>Not Interested - Offer (ROI/PF etc)</option>
        <option value="<? echo $strURL.'&Feedback=Not Interested - Loan Amount'?>" <? if($varFeedback == "Not Interested - Loan Amount") { echo "selected"; } ?>>Not Interested - Loan Amount</option>
		<option value="<? echo $strURL.'&Feedback=Not Contactable'?>" <? if($varFeedback == "Not Contactable") { echo "selected"; } ?>>Not Contactable</option>
        
        <?php if($_SESSION["Associated_Bank"]=="Tata Capital")
		{
        ?>
               <option value="<? echo $strURL.'&Feedback=CIBIL ok - Follow Up'?>" <? if($varFeedback == "CIBIL ok - Follow Up") { echo "selected"; } ?>>CIBIL ok - Follow Up</option>
            <option value="<? echo $strURL.'&Feedback=CIBIL Ok - Not Interested'?>" <? if($varFeedback == "CIBIL Ok - Not Interested") { echo "selected"; } ?>>CIBIL Ok - Not Interested</option>
            <option value="<? echo $strURL.'&Feedback=NE - CIBIL'?>" <? if($varFeedback == "NE - CIBIL") { echo "selected"; } ?>>NE - CIBIL</option>
            <option value="<? echo $strURL.'&Feedback=NE - Other'?>" <? if($varFeedback == "NE - Other") { echo "selected"; } ?>>NE - Other</option>
            <option value="<? echo $strURL.'&Feedback=CIBIL Refer - Follow Up'?>" <? if($varFeedback == "CIBIL Refer - Follow Up") { echo "selected"; } ?>>CIBIL Refer - Follow Up</option>
      <option value="<? echo $strURL.'&Feedback=CIBIL Refer - Not Interested'?>" <? if($varFeedback == "CIBIL Refer - Not Interested") { echo "selected"; } ?>>CIBIL Refer - Not Interested</option>
			        
         <?php 
		}
		else if($_SESSION["Associated_Bank"]=="ICICI Bank")
		{
		?>
        
        <option value="<? echo $strURL.'&Feedback=TU Approved'?>" <? if($varFeedback == "TU Approved") { echo "selected"; } ?>>TU Approved</option>

        <option value="<? echo $strURL.'&Feedback=TU Approved Followup'?>" <? if($varFeedback == "TU Approved Followup") { echo "selected"; } ?>>TU Approved Followup</option>
        <option value="<? echo $strURL.'&Feedback=TU Approved Not Interested'?>" <? if($varFeedback == "TU Approved Not Interested") { echo "selected"; } ?>>TU Approved Not Interested</option>
        <option value="<? echo $strURL.'&Feedback=TU Referred'?>" <? if($varFeedback == "TU Referred") { echo "selected"; } ?>>TU Referred</option>
          <option value="<? echo $strURL.'&Feedback=TU Referred Followup'?>" <? if($varFeedback == "TU Referred Followup") { echo "selected"; } ?>>TU Referred Followup</option>
          <option value="<? echo $strURL.'&Feedback=TU Referred Not Interested'?>" <? if($varFeedback == "TU Referred Not Interested") { echo "selected"; } ?>>TU Referred Not Interested</option>
        <option value="<? echo $strURL.'&Feedback=TU Declined'?>" <? if($varFeedback == "TU Declined") { echo "selected"; } ?>>TU Declined</option>  
        <?php 
		} ?>

</select>
<?
}
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
