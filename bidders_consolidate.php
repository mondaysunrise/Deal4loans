<?php
require 'scripts/session_check_online.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';
//define("ENABLELOGIN", 1);
//for session variables
function ccMasking($number, $maskingCharacter = 'X') 
{
	return substr($number, 0, 2) . str_repeat($maskingCharacter, strlen($number) - 4) . substr($number, -2);
}

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

$todaydt=date('Y-m-d');

$checkbidderid="";
	if(isset($_REQUEST['city']))
	{
		$checkbidderid=$_REQUEST['city'];
	}

function getTableName($pKey)
{
    $titles = array(
        1=> 'Req_Loan_Personal',
        2=> 'Req_Loan_Home',
        3=> 'Req_Loan_Car',
        4=> 'Req_Credit_Card',
        5=> 'Req_Loan_Against_Property',
        6=> 'Req_Business_Loan'
    );
    foreach ($titles as $key=>$value)
        if($pKey==$key)
        return $value;
    return "";
}

$getbranch=explode(",", $branch);
$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-90, date("Y"));
$day45=date('Y-m-d',$tomorrow);
$joindate=$day45;

$tomorrow2997  = mktime(0, 0, 0, date("m")  , date("d")-90, date("Y"));
$day45_2997=date('Y-m-d',$tomorrow2997);
$joindate2997=$day45_2997;

if($BidderIDstatic==2501)
{
	$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-45, date("Y"));
	$day45=date('Y-m-d',$tomorrow);
	$joindate=$day45;
}

if($BidderIDstatic==4093 || $BidderIDstatic==6279 /*|| $BidderIDstatic==5788*/)
{
	$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-60, date("Y"));
	$day60=date('Y-m-d',$tomorrow);
	$joindate60=$day60;
}

$getbranchwise="";
if(isset($_REQUEST['getbranchwise']))
	{
		$getbranchwise=$_REQUEST['getbranchwise'];
	}

$refernce_no="";
	if(isset($_REQUEST['refernce_no']))
	{
		$refernce_no = $_REQUEST['refernce_no'];
	}

$mob_num="";
	if(isset($_REQUEST['mob_num']))
	{
		$mob_num = $_REQUEST['mob_num'];
	}
	
	$FeedbackClause="";

$pro_code= $_SESSION['product'];
$val= getTableName($_SESSION['product']);

	$search="";
	if(isset($_GET['search']))
	{
		$search=$_GET['search'];
	}
	//echo $joindate60;
	$min_date="";
	if(isset($_REQUEST['min_date']))
	{	$min_date=$_REQUEST['min_date'];
		if($BidderIDstatic==4093 /*|| $BidderIDstatic==5788*/)
		{
			echo $min_date." : ".$joindate60;
			if($min_date<$joindate60)
			{
				$min_date=$joindate60;
			}
			else
			{
				$min_date=$_REQUEST['min_date'];
			}
		}
		else
		{
			$min_date=$_REQUEST['min_date'];
		}
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
	
	//Set the page no

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
	///
function getCombo($strVal,$strselect)
	{
		$strSelectedCaption;
		$stroption = $strVal;
		if(strlen(trim($stroption))>0)
		{
			$pieces1 = explode(",", $stroption);
			for($l=0;$l<count($pieces1);$l++)
			{	
				echo " pieces1[$l] : ".$pieces1[$l]."<BR>";
				$strSelectedCaption="";
				switch ($pieces1[$l])
				 {				
					Case "1":
						if($strselect=="Req_Loan_Personal"){ $strSelectedCaption="selected"; }
						echo "<option value='Req_Loan_Personal'".$strSelectedCaption.">Personal Loan</option>";
					break;
					Case "2":
					if($strselect=="Req_Loan_Home"){ $strSelectedCaption="selected"; }
					 echo "<option value='Req_Loan_Home'".$strSelectedCaption.">Home Loan</option>";
					break;
					Case "3":
						if($strselect=="Req_Loan_Car"){ $strSelectedCaption="selected"; }
					 echo "<option value='Req_Loan_Car'".$strSelectedCaption.">Car Loan</option>";
					break;
					Case "4":
						if($strselect=="Req_Credit_Card"){ $strSelectedCaption="selected"; }
					 echo "<option value='Req_Credit_Card' ".$strSelectedCaption.">Credit Card</option>";
					break;
					Case "5":
						if($strselect=="Req_Loan_Against_Property"){ $strSelectedCaption="selected"; }
					 echo "<option value='Req_Loan_Against_Property' ".$strSelectedCaption.">Loan Againt Property</option>";
					break;
				}
		}
	}	
   }
?>
<html>
<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=WINDOWS-1252">
<title>Login</title>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<link href="includes/style1.css" rel="stylesheet" type="text/css">
<link href="style.css" rel="stylesheet" type="text/css" />
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
<link rel="stylesheet" type="text/css" href="callinglms/css-datepicker/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="callinglms/css-datepicker/datepicker.css">
<link rel="stylesheet" type="text/css" href="css-datetimepicker/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="css-datetimepicker/jquery-ui-timepicker-addon.css">
<script src="callinglms/js-datepicker/jquery-1.5.1.js"></script>
<script src="callinglms/js-datepicker/jquery.ui.core.js"></script>
<script src="callinglms/js-datepicker/jquery.ui.datepicker.js"></script>
<script src="js-datetimepicker/jquery-ui-timepicker-addon.js"></script>
<script> 
	$(function() {
		$("[id^=followup_date_]").datetimepicker({  
			defaultDate: "today",
			changeMonth: true,
			changeYear: true,
			numberOfMonths: 1,
			minDate:0,
			timeFormat: 'hh:mm:ss',
		});
	});
</script>
<?php 
	 if(isset($_SESSION['UserType']))
	{
echo "<table width='100%' border='0' cellspacing='0' cellpadding='0'><tr><td width='323' height='93' align='left' valign='top'  ><img src='http://www.deal4loans.com/images/login-logo.gif' width='323' height='93' /></td><td align='left' valign='top' style='color:#0B6FCC;' ><table width='100%' border='0' cellspacing='0' cellpadding='0' bgcolor='#0A92C0'><tr><td height='67' align='right' valign='middle' bgcolor='#C8E3F3' style='padding-right:10px;'><table border='0' align='right' cellpadding='0' cellspacing='0' bgcolor='#0A92C0'><tr><td width='6' height='32' align='left' valign='top'><img  src='http://www.deal4loans.com/images/login-form-logut-lft.gif' width='6' height='32' /></td><td background='http://www.deal4loans.com/rnew/images/login-form-logut-bg.gif' style=' background-repeat:repeat-x; height:32px;'><table width='100%' border='0' align='center' cellpadding='0' cellspacing='0'><tr><td align='left' valign='middle' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#FFFFFF; font-weight:bold; padding-right:15px;' > Welcome ".ucwords($_SESSION['UserType'])." ".$_SESSION['UName']."</td><td align='left' style='padding-right:2px;' width='22'><img src='http://www.deal4loans.com/images/login-logut-btn.gif' /></td><td align='right' class='style1' style='color:#FFFFFF; font-weight:bold;'><div align='right' class='style1' style='color:#FFFFFF; font-weight:bold;'> <a href='Logout.php' style='color:#FFFFFF; font-size:13px; text-decoration:none; font-family:Verdana, Arial, Helvetica, sans-serif;'>Logout</a></div></td></tr></table></td><td width='6' height='32'><img src='http://www.deal4loans.com/images/login-form-logut-rgt.gif' width='6' height='32' /></td></tr></table></td></tr><tr><td>&nbsp;</td></tr></table></td></tr></table>";
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
</style>
<script type="text/javascript">
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
				for(var iTrav=1; iTrav <= <?php echo $pagesize; ?>; iTrav++) { allLoc.push(iTrav); }
			}
			var iRemove = allLoc.indexOf(iLoc);
			if(iRemove != -1) { allLoc.splice(iRemove, 1); }
			
			//alert(id);
			
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
<table width="100%" border="0"  align="center" cellpadding="0" cellspacing="0" >
<tr>
    <td align="center">
	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#45B2D8">
		<tr>
			<td style="padding-top:15px;">
				<table  width="669" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#5BBEE0" >
				<tr>
					<td width="669" align="left" valign="top" bgcolor="#FFFFFF" style="background-repeat:no-repeat;" >
						<table width="97%" border="0" align="center" cellpadding="0" cellspacing="0">
							<tr>
								<td height="40" align="center">
									<h1 style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; color:#052733; line-height:18px; font-weight:bold;">Welcome to Deal4Loans LMS</h1>
								</td>
							</tr>
							<? if($pro_code==1){ ?>
							<tr>
								<td  style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#052733; line-height:17px;">
								PERSONAL LOAN is a need based product. Your end-sales will depend upon how quickly you contact the customer (after he registers for Loan).<br/><b>Tips: <br>1.</b> Login as many times a day as possible and contact the customer early .<br/>
								<b>2.</b> Ensure that your contact numbers go to the customer in the auto-acknowledgement SMS that Deal4Loans sends. <br>
								</td>
							</tr>
							<? } 
							else if ($pro_code==2)
							{ ?> 
							<tr>
								<td  style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#052733; line-height:17px;">HOME LOAN is a Life time decison for most customers- hence the decision cycle is long. As a loan provider you need to engage with the customer through out their decision cycle..<br/><b>Tips: <br>1.</b> Leave your contact numbers via email/SMS (functionality provided in Deal4Loans LMS) after you have contacted the customer.<br/>
								<b>2.</b> Tell the loan seeker how much tax savings will this home loan get him/her.
								</td>
							</tr>
							<? } ?>
						</table>
					</td>
				</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td align="right" style="padding-right:10px;">
				<a  href="/change_lms_pwd.php" target="_blank" style="color:#FFFFFF;"><b>Change Password</b></a> &nbsp;&nbsp;
				<? if($BidderIDstatic==2501) { ?> 
				<a href="ing-vysya_index.php" style="color:#FFFFFF;" ><strong>Exclusive Leads</strong></a><br> <a href="ing-vysya_mlrindex.php" style="color:#FFFFFF;" ><strong>Mailer Leads</strong></a> <br> <a href="ing-vysya_btmlrindex.php" style="color:#FFFFFF;" ><strong>BT Leads</strong></a>
				<? } else { ?> &nbsp;<? }?>
				<? if($BidderIDstatic==4093) { ?> 
				<a href="indusind_mlrindex.php" target="_blank"> Mailer Leads</a>
				<? } else { ?> &nbsp;<? }?>	
				<? if($BidderIDstatic==5264) { ?> 
				<a href="tatacapital_plmlrview.php" target="_blank"> Mailer Leads</a>
				<? } else { ?> &nbsp;<? }?>	
				<? if($BidderIDstatic==2454) { ?> 
				<a href="bajajmailer_hlview.php" target="_blank"> HL Mailer Leads</a>  | <a href="bajajmailer_lview.php" target="_blank"> Mailer Leads</a>  | <a href="bajajgrnchnl_lview.php" target="_blank"> Green Chanel Leads</a>
				<? } else { ?> &nbsp;<? }?>
				<? if($BidderIDstatic==2997) { ?> 
				<a href="bidders_btview.php?bidplbt=4175" target="_blank"> BT Leads</a> 
				<? } else { ?> &nbsp;<? }
				if($BidderIDstatic==2924) { ?> 
				<a href="bidders_btview.php?bidplbt=4178" target="_blank"> BT Leads</a> 
				<? } else { ?> &nbsp;<? }
				if($BidderIDstatic==2920) { ?> 
				<a href="icicimailer_btview.php" target="_blank">BT mailer Leads</a> | <a href="bidders_btview.php?bidplbt=4174" target="_blank">BT Leads</a> 
				<? } else { ?> &nbsp;<? }
				
				$IP_Remote = $_SERVER["REMOTE_ADDR"];
				if($IP_Remote=='192.124.249.12' || $IP_Remote=='185.93.228.12') { $IP= $_SERVER['HTTP_X_SUCURI_CLIENTIP']; }
				else { $IP= $IP_Remote;	}
				
				if(($BidderIDstatic==2454 || $BidderIDstatic==2997 || $BidderIDstatic==4093 || $BidderIDstatic==5373 || $BidderIDstatic==5264 || $BidderIDstatic==5957 || $BidderIDstatic==2680 || $BidderIDstatic==2663 || $BidderIDstatic==5654 || $BidderIDstatic==6387 || $BidderIDstatic==6279) && ($IP=="122.176.100.27" || $IP=="122.176.100.28" || $IP=="122.176.122.134" || $IP=="122.161.196.68" || $IP=="61.246.3.127" || $IP=="122.160.30.168" || $IP=="14.98.140.109" || $IP=="122.160.74.241" || $IP=="122.160.74.235" || $IP=="182.71.109.218" || $IP=="1.23.114.53" || "185.93.231.12" || $IP=="122.176.54.194")) { ?> 
				<a href="/bidders_consolidate_statext.php" style="color:#FFFFFF;" target="_blank"><strong>Praveen Channel</strong></a> | <a href="/bidders_consolidate_appointment.php" style="color:#FFFFFF;" target="_blank"><strong>Appointment</strong></a>
				<? }
				if(($IP=="182.71.109.218" || $IP=="122.176.100.27" || $IP=="122.176.100.28" || $IP=="122.176.122.134" || $IP=="122.161.196.68" || $IP=="61.246.3.127" || $IP=="122.160.30.168" || $IP=="180.188.224.34" || $IP=="122.161.193.191" || $IP=="122.160.74.241" || $IP=="122.160.74.235" || $IP=="1.23.114.53" || "185.93.231.12"))
				{
					if($_SESSION['product']==1) {?> 
						<br> <a href="/bidders_update_feedback.php" style="color:#FFFFFF;"><strong>Update Feedbacks</strong></a>
				<?php } 
				}
				?>
				<? if($BidderIDstatic==2680) { ?>  
                                                <a href="/scb_view_api_lead.php" target="_blank" style="color:#FFFFFF;"><strong>SCB API Leads</strong></a> 
				 <?php } ?>
			</td>
		</tr>
		<tr>
			<td align="center"> 
				<table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
					<tr>
						<td height="30" align="center" valign="middle"><img src="images/login-srch-pnl.gif" width="650" height="30"></td>
					</tr>
					<tr>
						<td align="center" valign="middle" background="images/login-form-login-bg.gif">
							<table width="95%" border="0"  cellpadding="1" cellspacing="0">
								<form name="frmsearch" action="bidders_consolidate.php?search=y" method="post" onSubmit="return chkform();">
									<input type="hidden" name="BidderIDstatic" id="BidderIDstatic" value="<? echo $BidderIDstatic;?>">
									<tr><td colspan="3">&nbsp;</td></tr>
									<tr>
										<td colspan="3" align="center">
											<table border="0" width="90%" cellpadding="0" cellspacing="0">
												<tr>
												<td width="20%" valign="middle" class="style1">&nbsp;&nbsp;Date&nbsp;&nbsp; From </td>
												<td width="24%" align="left" valign="middle" class="bidderclass" ><?$current_date=date('Y-m-d');?> 
													<input name="min_date" type="text" id="min_date" size="15" <? if($min_date=="") { ?>value="<? if($BidderIDstatic==4093 || $BidderIDstatic==6279 /*|| $BidderIDstatic==5788*/) { echo $joindate60; } elseif($BidderIDstatic==2454) {echo "2016-02-01";} else { echo $_SESSION['JoinDate']; } ?>"<? } else { ?>value="<? echo $min_date; ?>" <? }?>>
												</td>
												<td>
													<input name="b12" type="button" class="bluebutton" onClick="javascript:pedirFecha(min_date,'');" value="&lt; Insert">
												</td>
												<td valign="middle" align="center" class="style1" width="8%">To</td>
												<td align="left" valign="middle" class="style1" width="24%" >
													<input name="max_date" type="text" id="max_date" size="15" value="<? echo $max_date; ?>">
												</td>
												<td>
													<input name="b122" type="button" class="bluebutton" onClick="javascript:pedirFecha(max_date,'');" value="&lt; Insert">
												</td>
												</tr>
											</table>
										</td>
									</tr>
									<? 
									if($BidderIDstatic==5191){ ?>
									<input type="hidden" value="5183,5184,5185,5186,5187,5188,5189,5190" name="city" id="city">
									<? 
									}
									elseif($BidderIDstatic==6392)
									{
										$WriteCity ='<tr><td><strong>Cities:</strong></td><td><select name="city" id="city">';
										$WriteCity .='<option value="">Please Select</option>';
										$WriteCity .= '<option value="6285"'; 
										if(6285==$checkbidderid)
										{ 
											$WriteCity .=" selected"; 
										}
										$WriteCity .='>LMS 1</option>';
										$WriteCity .= '<option value="6389"'; 
										if(6389==$checkbidderid)
										{ 
											$WriteCity .=" selected"; 
										}
										$WriteCity .='>LMS 2</option>';
										$WriteCity .= '<option value="6390"'; 
										if(6390==$checkbidderid)
										{ 
											$WriteCity .=" selected"; 
										}
										$WriteCity .='>LMS 3</option>';		
										$WriteCity .= '<option value="6285,6389,6390"';
										if('6285,6389,6390'==$checkbidderid)
										{ 
											$WriteCity .=" selected "; 
										}
										$WriteCity .='>All</option>';						 
										$WriteCity .= '</select></td></tr>'; 
										echo $WriteCity;				 						 
									}
									else
									{
										if($BidderIDstatic==2997 || $BidderIDstatic==5778)
										{
											$GetCitySql = "select Bidders.BidderID, Bidders.City,Bidders_List.Restrict_Bidder from Bidders left join Bidders_List on Bidders_List.BidderID = Bidders.BidderID where ( FIND_IN_SET ('".$BidderIDstatic."',Bidders.Global_Access_ID) ) order by City ASC";
										}
										else
										{
											$GetCitySql = "select Bidders.BidderID, Bidders.City,Bidders_List.Restrict_Bidder from Bidders left join Bidders_List on Bidders_List.BidderID = Bidders.BidderID where ( FIND_IN_SET ('".$BidderIDstatic."',Bidders.Global_Access_ID) ) AND Bidders_List.Restrict_Bidder=1 order by City ASC";
										}

										$GetCityQuery = d4l_ExecQuery($GetCitySql);
										$GetCityCount = d4l_mysql_num_rows($GetCityQuery);
										if($GetCityCount>0)
										{
											$arrBidderID = "";
											$WriteCity ='<tr><td><strong>Cities:</strong></td><td><select name="city" id="city">';
											$WriteCity .='<option value="">Please Select</option>';
											for($i=0;$i<$GetCityCount;$i++)
											{
												$GetBidderID = d4l_mysql_result($GetCityQuery,$i,'BidderID');
												$GetCity = d4l_mysql_result($GetCityQuery,$i,'City');
												$arrBidderID[] = $GetBidderID;
												$WriteCity .= '<option value="'.$GetBidderID.'"'; 
												if($GetBidderID==$checkbidderid)
												{ 
													$WriteCity .=" selected"; 
												}
												if($GetCity == 'Delhi'){
													$GetCity = 'New Delhi';
												}
												if($GetCity == 'hubli'){
													$GetCity = 'Belgaum';
												}
												if($GetCity == 'Mumbai'){
													$GetCity = 'Thane';
												}
												if($GetCity == 'Mumbai 1'){
													$GetCity = 'Mumbai';
												}
												if($GetCity == 'Mumbai 2'){
													$GetCity = 'Navi Mumbai';
												}
												$WriteCity .='>'.$GetCity.'</option><br>';						
											}
											if($BidderIDstatic==2997)
											{
												$WriteCity .=  '<option value="3000,3003,3004,3009,3010,3012,3013,3014,3654,3889,3890"';
												if("3000,3003,3004,3009,3010,3012,3013,3014,3654,3889,3890"==$checkbidderid) { $WriteCity .=" selected "; }
												$WriteCity .='>North</option>';
												$WriteCity .=  '<option value="2998,2999,3005,3006,3007,3008,3015"';
												if("2998,2999,3005,3006,3007,3008,3015"==$checkbidderid) { $WriteCity .=" selected "; }
												$WriteCity .='>West</option>';
												$WriteCity .=  '<option value="3001,3002,3011,3801"';
												if("3001,3002,3011,3801"==$checkbidderid) { $WriteCity .=" selected "; }
												$WriteCity .='>South</option>';
											}
											elseif($BidderIDstatic==4093)
											{
												$WriteCity .=  '<option value="4083,4084,4085,5815,4086,5409,5410,5884,6496,6497,6498"';
												 if("4083,4084,4085,5815,4086,5409,5410,5884,6496,6497,6498"==$checkbidderid) { $WriteCity .=" selected "; }
												$WriteCity .='>North</option>';
												$WriteCity .=  '<option value="4087,4088,4089,5413,5414,5415"';
												 if("4087,4088,4089,5413,5414,5415"==$checkbidderid) { $WriteCity .=" selected "; }
												$WriteCity .='>South</option>';
												$WriteCity .=  '<option value="5168,4090,5937,4091,4092,5411,5412,5890"';
												 if("5168,4090,5937,4091,4092,5411,5412,5890"==$checkbidderid) { $WriteCity .=" selected "; }
												$WriteCity .='>West</option>';
											}
											elseif($BidderIDstatic=="2663")
											{
												$WriteCity .=  '<option value="4648,1950,5382,5313,1891,6384"';
												 if("4648,1950,5382,5313,1891,6384"==$checkbidderid) { $WriteCity .=" selected "; }
												$WriteCity .='>North</option>';
												$WriteCity .=  '<option value="2627,5157,3036,2628,5204,2629,4804,4403,2626"';
												 if("2627,5157,3036,2628,5204,2629,4804,4403,2626"==$checkbidderid) { $WriteCity .=" selected "; }
												$WriteCity .='>South</option>';
												$WriteCity .=  '<option value="1888,1958,5315,5408,1959,5317,1957,5314,1960,5316"';
												 if("1888,1958,5315,5408,1959,5317,1957,5314,1960,5316"==$checkbidderid) { $WriteCity .=" selected "; }
												$WriteCity .='>West</option>';
												$WriteCity .=  '<option value="mailer"';
												 if("mailer"==$checkbidderid) { $WriteCity .=" selected "; }
												$WriteCity .='>Mailer</option>';
											}
											$strBidderID = implode(",", $arrBidderID);
											$WriteCity .= '<option value="'.$strBidderID.'"';
											if($strBidderID==$checkbidderid)
											{ 
												$WriteCity .=" selected "; 
											}
											$WriteCity .='>All</option><br>';
											$WriteCity .= '</select></td></tr>'; 
											echo $WriteCity;
										}
									}
									
									if($BidderIDstatic=="5788" || $BidderIDstatic=="2997" || $BidderIDstatic=="6119" || $BidderIDstatic=="6148" || $BidderIDstatic=="6575")
									{
									?>
									<tr>
										<td width="30%" valign="middle" >Feedback:</td>
										<td width="30%" align="left" valign="middle" class="bidderclass">
										<select name="cmbfeedback" id="cmbfeedback" style="width:120px;">
											<option value="All" <? if($varCmbFeedback == "All") { echo "selected"; } ?>>All</option>
											<option value="" <? if($varCmbFeedback == "") { echo "selected"; } ?>>No Feedback</option>
											<option value="Not Eligible" <? if($varCmbFeedback == "Not Eligible") { echo "selected"; } ?>>Not Eligible</option>
											<option value="Not Interested" <? if($varCmbFeedback == "Not Interested") { echo "selected"; } ?>>Not Interested</option>
											<option value="Callback Later" <? if($varCmbFeedback == "Callback Later") { echo "selected"; } ?>>Callback Later</option>
											<option value="Wrong Number" <? if($varCmbFeedback == "Wrong Number") { echo "selected"; } ?>>Wrong Number</option>
		
											<? if($BidderIDstatic=="6119") 
											{ ?>
											<option value="Process" <? if($varCmbFeedback == "Process" || $varCmbFeedback == "Login") { echo "selected"; } ?>>Process</option>
											<option value="Closed" <? if($varCmbFeedback == "Closed" || $varCmbFeedback == "Closed") { echo "selected"; } ?>>Closed</option>
											<option value="Not Available" <? if($varCmbFeedback == "Not Available") { echo "selected"; } ?>>Not Available</option>
											<? 
											}
											elseif($BidderIDstatic=="6148")
											{ ?>
											<option value="Login" <? if($varCmbFeedback == "Login") { echo "selected"; } ?>>Login</option>
											<? 
											}
											elseif($BidderIDstatic=="6575")
											{ ?>
											<option value="Login" <? if($varCmbFeedback == "Login") { echo "selected"; } ?>>Login</option>
											<option value="Not Contactable" <? if($varCmbFeedback == "Not Contactable") { echo "selected"; } ?>>Not Contactable</option>
											<option value="Disbursed" <? if($varCmbFeedback == "Disbursed") { echo "selected"; } ?>>Disbursed</option>
											<option value="Sanctioned" <? if($varCmbFeedback == "Sanctioned") { echo "selected"; } ?>>Sanctioned</option>
											<? }
											elseif($BidderIDstatic=="5788")
											{ ?>
											<option value="Property Not Identified" <? if($varCmbFeedback == "Property Not Identified") { echo "selected"; } ?>>Property Not Identified</option>
											<? }
											else
											{ ?>
											<option value="Process" <? if($varCmbFeedback == "Process" || $varCmbFeedback == "Login") { echo "selected"; } ?>>Process</option>
											<option value="Closed" <? if($varCmbFeedback == "Closed" || $varCmbFeedback == "Disbursed") { echo "selected"; } ?>>Disbursed</option>
											<option value="Sanctioned" <? if($varCmbFeedback == "Sanctioned") { echo "selected"; } ?>>Sanctioned</option>
											<? 
											} ?>
											<option value="Ringing" <? if($varCmbFeedback == "Ringing") { echo "selected"; } ?>>Ringing</option>
											<option value="FollowUp" <? if($varCmbFeedback == "FollowUp") { echo "selected"; } ?>>FollowUp</option>
											<option value="Documents Pick" <? if($varCmbFeedback == "Documents Pick") { echo "selected"; } ?>>Documents Pick</option>
											<option value="Loan Rejected" <? if($varCmbFeedback == "Loan Rejected") { echo "selected"; } ?>>Loan Rejected</option>
											<option value="Appointment" <? if($varCmbFeedback == "Appointment") { echo "selected"; } ?>>Appointment</option>
										</select>
									</td>
									<td colspan="2"></td>
								</tr>
									<? 
									} ?>
									<tr>
										<? if($BidderIDstatic=="2998" || $BidderIDstatic=="2999" || $BidderIDstatic=="3000" || $BidderIDstatic=="3001" || $BidderIDstatic=="3002" || $BidderIDstatic=="3003" || $BidderIDstatic=="3004" || $BidderIDstatic=="3005" || $BidderIDstatic=="3006" || $BidderIDstatic=="3007" || $BidderIDstatic=="3008" || $BidderIDstatic=="3009" || $BidderIDstatic=="3010" || $BidderIDstatic=="3011" || $BidderIDstatic=="3012" || $BidderIDstatic=="3013" || $BidderIDstatic=="3014" || $BidderIDstatic=="3015" || $BidderIDstatic=="2997" || $BidderIDstatic=="3654" || $BidderIDstatic=="3801" || $BidderIDstatic=="3889" || $BidderIDstatic=="3890" || $BidderIDstatic=="5356" || $BidderIDstatic=="6148" || $BidderIDstatic=="6575" || $BidderIDstatic=="6582" || $BidderIDstatic=="5788") {?>
										<td width="19%" align="center"  valign="middle" class="bidderclass">Search with Mobile no</td>
										<td width="68%"  valign="middle" class="bidderclass"><input type="text" name="mob_num" id="mob_num" value="<?php echo $mob_num; ?>" ></td>
										<? } else {?>
										<td width="13%" colspan="3">&nbsp;</td>
										<? } ?>
									</tr>
									<tr>
										<td width="29%" align="center"  valign="middle" class="bidderclass">Search with Reference No</td>
										<td width="58%"  valign="middle" class="bidderclass"><input type="text" name="refernce_no" id="refernce_no" value="<?php echo $refernce_no; ?>" ></td>
									</tr>
									<tr>
										<td colspan="3" align="center" valign="middle"><input name="Submit" type="image"  src="images/login-form-lgn-srch.gif" style="width:111px; height:35px; border:none;" border="0"></td>
									</tr>
								</form>
							</table>
						</td>
					</tr>
					<tr>
						<td width="650" height="8" align="center" valign="top" ><img src="images/login-bot-pnl.gif" width="650" height="8"></td>
					</tr>
					<tr>
						<td align="center" valign="middle" >&nbsp;</td>
					</tr>
				</table>
				<?
				$search_date="";
				$varmin_date=$min_date;
				$varmax_date=$max_date;
				if(strlen(trim($RequestID))>0)
				{
					$strSQL="";
					$Msg="";
					$result = d4l_ExecQuery("select FeedbackID from Req_Feedback where AllRequestID=$RequestID and BidderID=".$BidderIDstatic);		
					$num_rows = d4l_mysql_num_rows($result);
					$currentdate = date('Y-m-d H:i:s');
					if($num_rows > 0)
					{
						$row = d4l_mysql_fetch_array($result);
						$strSQL="Update Req_Feedback Set Feedback='".$Feedback."', last_update_dated = '".$currentdate."' ";
						$strSQL=$strSQL."Where FeedbackID=".$row["FeedbackID"];
					}
					else
					{
						$strSQL="Insert into Req_Feedback(AllRequestID, BidderID, Reply_Type , Feedback, last_update_dated) Values (";
						$strSQL=$strSQL.$RequestID.",".$BidderIDstatic.",".$pro_code.",'".$Feedback."','".$currentdate."')";
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
					
					if(strlen(trim($varCmbFeedback))==0)
					{
						$FeedbackClause=" AND (Req_Feedback.Feedback IS NULL OR Req_Feedback.Feedback='' OR Req_Feedback.Feedback='No Feedback') ";
					}
					else if($varCmbFeedback=="All")
					{
						$FeedbackClause=" ";
					}
					else
					{
						$FeedbackClause=" AND (Req_Feedback.Feedback='".$varCmbFeedback."') ";
					}
					
					if($mob_num>0)
					{
						$mob_num_clause = " AND `".$val."`.Mobile_Number = '".$mob_num."' ";
					}
					if($pro_code==1)
					{
						$feedback_tble="Req_Feedback_Bidder_PL";
					}
					elseif($pro_code==2)
					{
						$feedback_tble="Req_Feedback_Bidder_HL";
					}
					elseif($pro_code==3)
					{
						$feedback_tble="Req_Feedback_Bidder_CL";
					}
					elseif($pro_code==4)
					{
						$feedback_tble="Req_Feedback_Bidder_CC";
					}
					elseif($pro_code==5)
					{
						$feedback_tble="Req_Feedback_Bidder_LAP";
					}
					else
					{
						$feedback_tble="Req_Feedback_Bidder1";
					}

					if(strlen($refernce_no)>3)
					{	
						if($pro_code==1) {$appdtxt="PL";}elseif($pro_code==2){$appdtxt="HL";}elseif($pro_code==3){$appdtxt="CL";}elseif($pro_code==4){$appdtxt="CC";}elseif($pro_code==5){$appdtxt="LAP";}else{$appdtxt="";}
						list($requestidno, $bidderid) = split('[S]', $refernce_no);
						$refernce_no_section = str_replace($appdtxt, "",$requestidno);

						$refernce_no_clause = " AND `".$feedback_tble."`.Feedback_ID = '".$refernce_no_section."' ";
					}
					?>
					<p class="bodyarial11"><?=$Msg?></p>
					<table width="950" border="0" align="center" cellpadding="2" cellspacing="3" bgcolor="#FFFFFF" >
					<? 
					if($city>0)
					{
						$biddervalue="(".$branch.")";
					}
					else
					{
						$biddervalue="('".$getbranchwise."')";
					}
					if($BidderIDstatic==2454 || $BidderIDstatic==2501)
					{			
						$search_qry="SELECT *,".$feedback_tble.".BidderID AS sentbidder FROM ".$feedback_tble.",`".$val."` LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID=".$val.".RequestID AND Req_Feedback.BidderID in (".$checkbidderid.") WHERE ".$feedback_tble.".AllRequestID=`".$val."`.RequestID and ".$feedback_tble.".BidderID in (".$checkbidderid.") and ".$feedback_tble.".Reply_Type=".$pro_code."  and ".$val.".source !='postpaid-mailer' and (".$feedback_tble.".Allocation_Date  Between '".($min_date)."' and '".($max_date)."' or Req_Feedback.Followup_Date Between '".($min_date)."' and '".($max_date)."') ";	
						//$search_qry=$search_qry.$FeedbackClause;
						$search_qry=$search_qry."group by ".$val.".Mobile_Number";
						$search_qry=$search_qry." order by ".$val.".Dated DESC";

						$qry="SELECT *,".$feedback_tble.".BidderID AS sentbidder FROM ".$feedback_tble.",`".$val."` LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID=".$val.".RequestID AND Req_Feedback.BidderID in (".$checkbidderid.") WHERE ".$feedback_tble.".AllRequestID=`".$val."`.RequestID and ".$feedback_tble.".BidderID in (".$checkbidderid.")  and ".$feedback_tble.".Reply_Type=".$pro_code." and ".$val.".source !='postpaid-mailer' and (".$feedback_tble.".Allocation_Date Between '".($min_date)."' and '".($max_date)."' or Req_Feedback.Followup_Date Between '".($min_date)."' and '".($max_date)."') ";
						//$qry=$qry.$FeedbackClause;
						$qry=$qry."group by ".$val.".Mobile_Number";
					}
					else if ($BidderIDstatic==2414)
					{
						$search_qry="SELECT *,".$feedback_tble.".BidderID AS sentbidder FROM ".$feedback_tble.",`".$val."` LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID=".$val.".RequestID AND Req_Feedback.BidderID in (".$checkbidderid.",2414) WHERE ".$feedback_tble.".AllRequestID=`".$val."`.RequestID and ".$feedback_tble.".BidderID in (".$checkbidderid.",2414) and ".$feedback_tble.".Reply_Type=".$pro_code."  and ".$val.".source !='postpaid-mailer' and (".$feedback_tble.".Allocation_Date  Between '".($min_date)."' and '".($max_date)."' or Req_Feedback.Followup_Date Between '".($min_date)."' and '".($max_date)."') ";	
						//$search_qry=$search_qry.$FeedbackClause;
						$search_qry=$search_qry."group by ".$val.".Mobile_Number";
						$search_qry=$search_qry." order by ".$val.".Dated DESC";

						$qry="SELECT * FROM ".$feedback_tble.",`".$val."` LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID=".$val.".RequestID AND Req_Feedback.BidderID in (".$checkbidderid.",2414) WHERE ".$feedback_tble.".AllRequestID=`".$val."`.RequestID and ".$feedback_tble.".BidderID in (".$checkbidderid.",2414)  and ".$feedback_tble.".Reply_Type=".$pro_code." and ".$val.".source !='postpaid-mailer' and (".$feedback_tble.".Allocation_Date Between '".($min_date)."' and '".($max_date)."' or Req_Feedback.Followup_Date Between '".($min_date)."' and '".($max_date)."') ";
						//$qry=$qry.$FeedbackClause;
						$qry=$qry."group by ".$val.".Mobile_Number";
					}
					else if($BidderIDstatic=="2663")
					{
						if($checkbidderid=="mailer")
						{
							$strBidderID = implode(",", $arrBidderID);
							$checkbidderid = $strBidderID;
							$sourceclause="and ".$val.".source like '%EML_HDFC_PLBT%'";
						}
						else
						{
							$strBidderID =$checkbidderid;
							$sourceclause="and ".$val.".source not like '%EML_HDFC_PLBT%'";
						}
						$search_qry="SELECT *,".$feedback_tble.".BidderID AS sentbidder FROM ".$feedback_tble.",`".$val."` LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID=".$val.".RequestID AND Req_Feedback.BidderID in (".$strBidderID.") WHERE ".$feedback_tble.".AllRequestID=`".$val."`.RequestID and ".$feedback_tble.".BidderID in (".$strBidderID.") and ".$feedback_tble.".Reply_Type=".$pro_code." and (".$feedback_tble.".Allocation_Date  Between '".($min_date)."' and '".($max_date)."' or Req_Feedback.Followup_Date Between '".($min_date)."' and '".($max_date)."') ".$sourceclause."";	
						$search_qry=$search_qry.$mob_num_clause." ".$refernce_no_clause;
						$search_qry=$search_qry."group by ".$val.".Mobile_Number";
						$search_qry=$search_qry." order by ".$val.".Dated DESC";

						$qry="SELECT * FROM ".$feedback_tble.",`".$val."` LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID=".$val.".RequestID AND Req_Feedback.BidderID in (".$strBidderID.") WHERE ".$feedback_tble.".AllRequestID=`".$val."`.RequestID and ".$feedback_tble.".BidderID in (".$strBidderID.")  and ".$feedback_tble.".Reply_Type=".$pro_code." and (".$feedback_tble.".Allocation_Date Between '".($min_date)."' and '".($max_date)."' or Req_Feedback.Followup_Date Between '".($min_date)."' and '".($max_date)."')  ".$sourceclause."";
						$qry=$qry.$mob_num_clause." ".$refernce_no_clause;
						$qry=$qry."group by ".$val.".Mobile_Number";
					}
					else if($BidderIDstatic=="2998" || $BidderIDstatic=="2999" || $BidderIDstatic=="3000" || $BidderIDstatic=="3001" || $BidderIDstatic=="3002" || $BidderIDstatic=="3003" || $BidderIDstatic=="3004" || $BidderIDstatic=="3005" || $BidderIDstatic=="3006" || $BidderIDstatic=="3007" || $BidderIDstatic=="3008" || $BidderIDstatic=="3009" || $BidderIDstatic=="3010" || $BidderIDstatic=="3011" || $BidderIDstatic=="3012" || $BidderIDstatic=="3013" || $BidderIDstatic=="3014" || $BidderIDstatic=="3015" || $BidderIDstatic=="2997" || $BidderIDstatic=="3654" || $BidderIDstatic=="3801" || $BidderIDstatic=="3889" || $BidderIDstatic=="3890" || $BidderIDstatic=="5356" || $BidderIDstatic=="5264" || $BidderIDstatic=="5373")
					{
						$search_qry="SELECT *,".$feedback_tble.".BidderID AS sentbidder FROM ".$feedback_tble.",`".$val."` LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID=".$val.".RequestID AND Req_Feedback.BidderID in (".$checkbidderid.") WHERE ".$feedback_tble.".AllRequestID=`".$val."`.RequestID and ".$feedback_tble.".BidderID in (".$checkbidderid.") and ".$feedback_tble.".Reply_Type=".$pro_code." and (".$feedback_tble.".Allocation_Date  Between '".($min_date)."' and '".($max_date)."' or Req_Feedback.Followup_Date Between '".($min_date)."' and '".($max_date)."')";	
						if($BidderIDstatic==2997)
						{
							$search_qry=$search_qry.$FeedbackClause;
						}
						$search_qry=$search_qry.$mob_num_clause;
						$search_qry=$search_qry."group by ".$val.".Mobile_Number";
						$search_qry=$search_qry." order by ".$val.".Dated DESC";

						$qry="SELECT * FROM ".$feedback_tble.",`".$val."` LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID=".$val.".RequestID AND Req_Feedback.BidderID in (".$checkbidderid.") WHERE ".$feedback_tble.".AllRequestID=`".$val."`.RequestID and ".$feedback_tble.".BidderID in (".$checkbidderid.")  and ".$feedback_tble.".Reply_Type=".$pro_code." and (".$feedback_tble.".Allocation_Date Between '".($min_date)."' and '".($max_date)."' or Req_Feedback.Followup_Date Between '".($min_date)."' and '".($max_date)."') ";
						if($BidderIDstatic==2997)
						{
							$qry=$qry.$FeedbackClause;
						}
						$qry=$qry.$mob_num_clause." ".$refernce_no_clause;
						$qry=$qry."group by ".$val.".Mobile_Number";
					}
					else if($BidderIDstatic==5788)
					{
						//$search_qry="SELECT *,".$feedback_tble.".BidderID AS sentbidder FROM ".$feedback_tble.",`".$val."` LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID=".$val.".RequestID AND Req_Feedback.BidderID in (".$checkbidderid.",5788) WHERE ".$feedback_tble.".AllRequestID=`".$val."`.RequestID and ".$feedback_tble.".BidderID in (".$checkbidderid.") and ".$feedback_tble.".Reply_Type=".$pro_code." and (".$feedback_tble.".Allocation_Date  Between '".($min_date)."' and '".($max_date)."' or Req_Feedback.Followup_Date Between '".($min_date)."' and '".($max_date)."') ";
						
						$search_qry = "SELECT Req_Feedback_Bidder_HL.*, Req_Loan_Home.*,Req_Feedback_Bidder_HL.BidderID AS sentbidder,Req_Feedback.Feedback, Req_Feedback.Followup_Date, Req_Feedback.comment_section FROM Req_Loan_Home as Req_Loan_Home JOIN Req_Feedback_Bidder_HL as Req_Feedback_Bidder_HL ON(Req_Feedback_Bidder_HL.AllRequestID=Req_Loan_Home.RequestID) LEFT JOIN Req_Feedback ON (Req_Feedback.AllRequestID=Req_Loan_Home.RequestID AND Req_Feedback.BidderID IN(".$checkbidderid.",$BidderIDstatic) AND IF(Req_Feedback.last_update_dated != '0000-00-00 00:00:00', Req_Feedback.last_update_dated = (SELECT max(last_update_dated) FROM Req_Feedback RF1 WHERE RF1.AllRequestID = Req_Feedback.AllRequestID) $FeedbackClause, Req_Feedback.FeedbackID = (SELECT max(FeedbackID) FROM Req_Feedback RF1 WHERE RF1.AllRequestID = Req_Feedback.AllRequestID) $FeedbackClause)) WHERE Req_Feedback_Bidder_HL.BidderID IN (".$checkbidderid.") AND Req_Feedback_Bidder_HL.Reply_Type = ".$pro_code." AND (Req_Feedback_Bidder_HL.Allocation_Date Between '".($min_date)."' and '".($max_date)."' or Req_Feedback.Followup_Date Between '".($min_date)."' and '".($max_date)."')";	
						
						//$search_qry=$search_qry.$FeedbackClause;
						
						//$search_qry=$search_qry."AND IF(Req_Feedback.last_update_dated != '0000-00-00 00:00:00', Req_Feedback.last_update_dated = (SELECT max(last_update_dated) FROM Req_Feedback RF1 WHERE RF1.AllRequestID = Req_Feedback.AllRequestID) $FeedbackClause, Req_Feedback.FeedbackID = (SELECT max(FeedbackID) FROM Req_Feedback RF1 WHERE RF1.AllRequestID = Req_Feedback.AllRequestID) $FeedbackClause)";
						
						$search_qry=$search_qry."group by ".$val.".Mobile_Number";
						$search_qry=$search_qry." order by ".$val.".Dated DESC";

						
						/*Code By Rachit Jain 15-06-2017 Start */
						$qry = "SELECT Req_Feedback_Bidder_HL.*, Req_Loan_Home.*,Req_Feedback_Bidder_HL.BidderID AS sentbidder,Req_Feedback.Feedback, Req_Feedback.Followup_Date, Req_Feedback.comment_section FROM Req_Loan_Home as Req_Loan_Home JOIN Req_Feedback_Bidder_HL as Req_Feedback_Bidder_HL ON(Req_Feedback_Bidder_HL.AllRequestID=Req_Loan_Home.RequestID) LEFT JOIN Req_Feedback ON (Req_Feedback.AllRequestID=Req_Loan_Home.RequestID AND Req_Feedback.BidderID IN(".$checkbidderid.",$BidderIDstatic) AND IF(Req_Feedback.last_update_dated != '0000-00-00 00:00:00', Req_Feedback.last_update_dated = (SELECT max(last_update_dated) FROM Req_Feedback RF1 WHERE RF1.AllRequestID = Req_Feedback.AllRequestID) $FeedbackClause, Req_Feedback.FeedbackID = (SELECT max(FeedbackID) FROM Req_Feedback RF1 WHERE RF1.AllRequestID = Req_Feedback.AllRequestID) $FeedbackClause)) WHERE Req_Feedback_Bidder_HL.BidderID IN (".$checkbidderid.") AND Req_Feedback_Bidder_HL.Reply_Type = ".$pro_code." AND (Req_Feedback_Bidder_HL.Allocation_Date Between '".($min_date)."' and '".($max_date)."' or Req_Feedback.Followup_Date Between '".($min_date)."' and '".($max_date)."')";
						
						//$qry=$qry.$FeedbackClause;
						//$qry=$qry."AND IF(Req_Feedback.last_update_dated != '0000-00-00 00:00:00', Req_Feedback.last_update_dated = (SELECT max(last_update_dated) FROM Req_Feedback RF1 WHERE RF1.AllRequestID = Req_Feedback.AllRequestID) $FeedbackClause, Req_Feedback.FeedbackID = (SELECT max(FeedbackID) FROM Req_Feedback RF1 WHERE RF1.AllRequestID = Req_Feedback.AllRequestID) $FeedbackClause)";
						$qry=$qry."group by ".$val.".Mobile_Number";
						/*Code By Rachit Jain 15-06-2017 End */
						//echo "<br>".$search_qry."<br>";
						//echo"<br>".$qry."<br>";
					}
					else
					{
						$search_qry="SELECT *,".$feedback_tble.".BidderID AS sentbidder FROM ".$feedback_tble.",`".$val."` LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID=".$val.".RequestID AND Req_Feedback.BidderID in (".$checkbidderid.") WHERE ".$feedback_tble.".AllRequestID=`".$val."`.RequestID and ".$feedback_tble.".BidderID in (".$checkbidderid.") and ".$feedback_tble.".Reply_Type=".$pro_code." and (".$feedback_tble.".Allocation_Date  Between '".($min_date)."' and '".($max_date)."' or Req_Feedback.Followup_Date Between '".($min_date)."' and '".($max_date)."') ";	
						if($BidderIDstatic==6119 || $BidderIDstatic==6148)
						{
							$search_qry=$search_qry.$FeedbackClause;
						}
						$search_qry=$search_qry."group by ".$val.".Mobile_Number";
						$search_qry=$search_qry." order by ".$val.".Dated DESC";

						$qry="SELECT * FROM ".$feedback_tble.",`".$val."` LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID=".$val.".RequestID AND Req_Feedback.BidderID in (".$checkbidderid.") WHERE ".$feedback_tble.".AllRequestID=`".$val."`.RequestID and ".$feedback_tble.".BidderID in (".$checkbidderid.")  and ".$feedback_tble.".Reply_Type=".$pro_code." and (".$feedback_tble.".Allocation_Date Between '".($min_date)."' and '".($max_date)."' or Req_Feedback.Followup_Date Between '".($min_date)."' and '".($max_date)."') ";
						if($BidderIDstatic==6119 || $BidderIDstatic==6148)
						{
							$qry=$qry.$FeedbackClause;
						}
						$qry=$qry."group by ".$val.".Mobile_Number";
					}
					if($BidderIDstatic==6392)
					{
							//echo"hello".$qry."<br>";
					}
					//echo"hello".$qry."<br>";
					$result=d4l_ExecQuery($qry);
					$recordcount = d4l_mysql_num_rows($result);
					?>
					<tr>
						<td colspan="11" style="border-bottom:1px solid #45B2D8;"><strong><? echo $startrow+1; ?> to <? echo min($startrow+$pagesize,$recordcount); ?> Out of <? echo $recordcount; ?> Records </strong></td>
					</tr>
					<tr>
						<td width="70" align="center" bgcolor="#FFFFFF" class="style2">Name</td>
						<td width="70" align="center" bgcolor="#FFFFFF" class="style2">City</td>
						<td width="88" align="center" bgcolor="#FFFFFF" class="style2">Mobile</td>
						<td width="91" align="center" bgcolor="#FFFFFF" class="style2">Net Salary </td>
						<td width="90" align="center" bgcolor="#FFFFFF" class="style2">Loan Amount </td>
						<td width="90" align="center" bgcolor="#FFFFFF" class="style2">Feedback </td>
						<? if($BidderIDstatic=="5788" || $BidderIDstatic=="6078" || $BidderIDstatic=="5373"  || $BidderIDstatic=="5654") { ?> 
						<td width="90" align="center" bgcolor="#FFFFFF" class="style2">Comments </td> 
						<? } ?>
						<?php if(($IP=="182.71.109.218" || $IP=="122.176.100.27" || $IP=="122.176.100.28" || $IP=="122.176.122.134" || $IP=="122.161.196.68" || $IP=="61.246.3.127" || $IP=="122.160.30.168" || $IP=="180.188.224.34" || $IP=="122.161.193.191" || $IP=="122.160.74.241" || $IP=="122.160.74.235" || $IP=="1.23.114.53" || "185.93.231.12")){ ?>
						<td width="90" align="center" bgcolor="#FFFFFF" class="style2">Feedback </td>
						<td width="125" align="center" bgcolor="#FFFFFF" class="style2">Comment</td>          
						<?php }
						?>
						<? if($BidderIDstatic=="2680") { ?> 
						<td width="90" align="center" bgcolor="#FFFFFF" class="style2">Bank Response(API) </td> 
						<? } ?>
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

					if($BidderIDstatic==2454 || $BidderIDstatic==2501)
					{
						$qry="SELECT *,".$feedback_tble.".BidderID AS sentbidder FROM ".$feedback_tble.",`".$val."` LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID=".$val.".RequestID AND Req_Feedback.BidderID in (".$checkbidderid.") WHERE ".$feedback_tble.".AllRequestID=`".$val."`.RequestID and ".$feedback_tble.".BidderID in (".$checkbidderid.") and ".$feedback_tble.".Reply_Type=".$pro_code." and ".$val.".source !='postpaid-mailer' and ( ".$feedback_tble.".Allocation_Date Between '".($min_date)."' and '".($max_date)."' or Req_Feedback.Followup_Date Between '".($min_date)."' and '".($max_date)."') ";
						//$qry=$qry.$FeedbackClause;
						$qry=$qry."group by ".$val.".Mobile_Number";
						$qry=$qry." order by ".$val.".Dated DESC";
						$qry=$qry." LIMIT $startrow, $pagesize";
					}
					if($BidderIDstatic==2414)
					{
						$qry="SELECT * FROM ".$feedback_tble.",`".$val."` LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID=".$val.".RequestID AND Req_Feedback.BidderID in (".$checkbidderid.",2414) WHERE ".$feedback_tble.".AllRequestID=`".$val."`.RequestID and ".$feedback_tble.".BidderID in (".$checkbidderid.",2414) and ".$feedback_tble.".Reply_Type=".$pro_code." and ".$val.".source !='postpaid-mailer' and ( ".$feedback_tble.".Allocation_Date Between '".($min_date)."' and '".($max_date)."' or Req_Feedback.Followup_Date Between '".($min_date)."' and '".($max_date)."') ";
						//$qry=$qry.$FeedbackClause;
						$qry=$qry."group by ".$val.".Mobile_Number";
						$qry=$qry." order by ".$val.".Dated DESC";
						$qry=$qry." LIMIT $startrow, $pagesize";
					}
					else if($BidderIDstatic=="2663")
					{
						if($checkbidderid=="mailer")
						{
							$strBidderID = implode(",", $arrBidderID);
							$sourceclause="and ".$val.".source like '%EML_HDFC_PLBT%'";
						}
						else
						{
							$strBidderID =$checkbidderid;
							$sourceclause="and ".$val.".source not like '%EML_HDFC_PLBT%'";
						}
						$qry="SELECT *,".$feedback_tble.".BidderID AS sentbidder FROM ".$feedback_tble.",`".$val."` LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID=".$val.".RequestID AND Req_Feedback.BidderID in (".$strBidderID.") WHERE ".$feedback_tble.".AllRequestID=`".$val."`.RequestID and ".$feedback_tble.".BidderID in (".$strBidderID.") and ".$feedback_tble.".Reply_Type=".$pro_code." and ( ".$feedback_tble.".Allocation_Date Between '".($min_date)."' and '".($max_date)."' or Req_Feedback.Followup_Date Between '".($min_date)."' and '".($max_date)."') ".$sourceclause."";
						//$qry=$qry.$FeedbackClause;
						$qry=$qry.$mob_num_clause;
						$qry=$qry."group by ".$val.".Mobile_Number";
						$qry=$qry." order by ".$val.".Dated DESC";
						$qry=$qry." LIMIT $startrow, $pagesize"; 

					}
					else if($BidderIDstatic=="2998" || $BidderIDstatic=="2999" || $BidderIDstatic=="3000" || $BidderIDstatic=="3001" || $BidderIDstatic=="3002" || $BidderIDstatic=="3003" || $BidderIDstatic=="3004" || $BidderIDstatic=="3005" || $BidderIDstatic=="3006" || $BidderIDstatic=="3007" || $BidderIDstatic=="3008" || $BidderIDstatic=="3009" || $BidderIDstatic=="3010" || $BidderIDstatic=="3011" || $BidderIDstatic=="3012" || $BidderIDstatic=="3013" || $BidderIDstatic=="3014" || $BidderIDstatic=="3015" || $BidderIDstatic=="2997" || $BidderIDstatic=="3654" || $BidderIDstatic=="3801" || $BidderIDstatic=="3889" || $BidderIDstatic=="3890" || $BidderIDstatic=="5356" || $BidderIDstatic=="5264" || $BidderIDstatic=="5373")
					{
						$qry="SELECT *,".$feedback_tble.".BidderID AS sentbidder FROM ".$feedback_tble.",`".$val."` LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID=".$val.".RequestID AND Req_Feedback.BidderID in (".$checkbidderid.") WHERE ".$feedback_tble.".AllRequestID=`".$val."`.RequestID and ".$feedback_tble.".BidderID in (".$checkbidderid.")  and ".$feedback_tble.".Reply_Type=".$pro_code." and (".$feedback_tble.".Allocation_Date Between '".($min_date)."' and '".($max_date)."' or Req_Feedback.Followup_Date Between '".($min_date)."' and '".($max_date)."') ";
						if($BidderIDstatic==2997)
						{
							$qry=$qry.$FeedbackClause;
						}
						$qry=$qry.$mob_num_clause." ".$refernce_no_clause;
						$qry=$qry."group by ".$val.".Mobile_Number";
						$qry=$qry." order by ".$val.".Dated DESC";
						$qry=$qry." LIMIT $startrow, $pagesize"; 
					}
					else if($BidderIDstatic=="5788")
					{
						/*$qry="SELECT *,".$feedback_tble.".BidderID AS sentbidder FROM ".$feedback_tble.",`".$val."` LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID=".$val.".RequestID AND Req_Feedback.BidderID in (".$checkbidderid.",5788) WHERE ".$feedback_tble.".AllRequestID=`".$val."`.RequestID and ".$feedback_tble.".BidderID in (".$checkbidderid.") and ".$feedback_tble.".Reply_Type=".$pro_code." and ( ".$feedback_tble.".Allocation_Date Between '".($min_date)."' and '".($max_date)."' or Req_Feedback.Followup_Date Between '".($min_date)."' and '".($max_date)."') ";

						$qry=$qry.$FeedbackClause;
						
						$qry=$qry.$mob_num_clause." ".$refernce_no_clause;
						$qry=$qry."group by ".$val.".Mobile_Number";
						$qry=$qry." order by ".$val.".Dated DESC";
						$qry=$qry." LIMIT $startrow, $pagesize"; 
						echo $qry;
						*/
						
						/*Code By Rachit Jain 15-06-2017 Start */
						$qry = "SELECT Req_Feedback_Bidder_HL.*, Req_Loan_Home.*,Req_Feedback_Bidder_HL.BidderID AS sentbidder,Req_Feedback.Feedback, Req_Feedback.Followup_Date, Req_Feedback.comment_section FROM Req_Loan_Home as Req_Loan_Home JOIN Req_Feedback_Bidder_HL as Req_Feedback_Bidder_HL ON(Req_Feedback_Bidder_HL.AllRequestID=Req_Loan_Home.RequestID) LEFT JOIN Req_Feedback as Req_Feedback ON (Req_Feedback.AllRequestID=Req_Loan_Home.RequestID AND Req_Feedback.BidderID IN(".$checkbidderid.",$BidderIDstatic) AND IF(Req_Feedback.last_update_dated != '0000-00-00 00:00:00', Req_Feedback.last_update_dated = (SELECT max(last_update_dated) FROM Req_Feedback RF1 WHERE RF1.AllRequestID = Req_Feedback.AllRequestID) $FeedbackClause, Req_Feedback.FeedbackID = (SELECT max(FeedbackID) FROM Req_Feedback RF1 WHERE RF1.AllRequestID = Req_Feedback.AllRequestID) $FeedbackClause)) WHERE Req_Feedback_Bidder_HL.BidderID IN (".$checkbidderid.") AND Req_Feedback_Bidder_HL.Reply_Type = ".$pro_code." AND (Req_Feedback_Bidder_HL.Allocation_Date Between '".($min_date)."' and '".($max_date)."' or Req_Feedback.Followup_Date Between '".($min_date)."' and '".($max_date)."')";
						
						//$qry = $qry.$FeedbackClause;
						
						$qry=$qry.$mob_num_clause." ".$refernce_no_clause;
						//$qry=$qry."AND IF(Req_Feedback.last_update_dated != '0000-00-00 00:00:00', Req_Feedback.last_update_dated = (SELECT max(last_update_dated) FROM Req_Feedback RF1 WHERE RF1.AllRequestID = Req_Feedback.AllRequestID) $FeedbackClause, Req_Feedback.FeedbackID = (SELECT max(FeedbackID) FROM Req_Feedback RF1 WHERE RF1.AllRequestID = Req_Feedback.AllRequestID) $FeedbackClause)";
						$qry=$qry."group by ".$val.".Mobile_Number";
						$qry=$qry." order by ".$val.".Dated DESC, Req_Feedback.last_update_dated DESC";
						$qry=$qry." LIMIT $startrow, $pagesize";
						/*Code By Rachit Jain 15-06-2017 End */
						//echo "<br><br>";echo $qry;
					}
					else
					{
						$qry="SELECT *,".$feedback_tble.".BidderID AS sentbidder FROM ".$feedback_tble.",`".$val."` LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID=".$val.".RequestID AND Req_Feedback.BidderID in (".$checkbidderid.") WHERE ".$feedback_tble.".AllRequestID=`".$val."`.RequestID and ".$feedback_tble.".BidderID in (".$checkbidderid.") and ".$feedback_tble.".Reply_Type=".$pro_code." and ( ".$feedback_tble.".Allocation_Date Between '".($min_date)."' and '".($max_date)."' or Req_Feedback.Followup_Date Between '".($min_date)."' and '".($max_date)."') ";
						if($BidderIDstatic==5788 || $BidderIDstatic==2997 || $BidderIDstatic==6119 || $BidderIDstatic==6148 || $BidderIDstatic==5373 )
						{
							$qry=$qry.$FeedbackClause;
						}
						$qry=$qry.$mob_num_clause." ".$refernce_no_clause;
						$qry=$qry."group by ".$val.".Mobile_Number";
						$qry=$qry." order by ".$val.".Dated DESC";
						$qry=$qry." LIMIT $startrow, $pagesize"; 
					}
					$getParameterVal = min($startrow+$pagesize,$recordcount);
					if($BidderIDstatic==5373)
					{
						//echo $qry."<br><br>";
					}
					$result=d4l_ExecQuery($qry);
					$logqry = $qry;
					$logfilecontent.="Sql Query: ".$logqry."\n";
					$logfilecontent.="********************************************************";
					$i=1;
					if($recordcount>0)
					{
						$color = 1;
						while($row=d4l_mysql_fetch_array($result))
						{
						?>
							<input type="hidden" name="requestid_<? echo $i;?>" id="requestid_<? echo $i;?>" value="<? echo $row["RequestID"];?>">
							<input type="hidden" name="product_<? echo $i;?>" id="product_<? echo $i;?>" value="<? echo $pro_code;?>">
							<input type="hidden" name="bidderid" id="bidderid" value="<? echo $BidderIDstatic;?>">
							<tr>
								<td align="center" bgcolor="#DFF6FF" class="style3" >
									<?php
									$sqlExclusive = "select  BidderID  from ".$feedback_tble." where (AllRequestID = '".$row["RequestID"]."' and Reply_Type='".$pro_code."')";
									$queryExclusive = d4l_ExecQuery($sqlExclusive);
									$numRowsExclusive = d4l_mysql_num_rows($queryExclusive);
									if($numRowsExclusive==1)
									{
										echo '<b style="color:#FF0000; font-size:9px;"> [Exclusive Lead] </b><br>';
									}
									if($BidderIDstatic==6078)
									{ ?>
									<a href="/personalloanlead-details.php?postid=<? echo $row["RequestID"]; ?>&biddt=<? echo $row['sentbidder']; ?>&sessbid=<? echo $BidderIDstatic; ?>" target="_blank">
									<?  echo $row["Name"]; 
									} 
									else if($BidderIDstatic==5788) { ?>
                                    <a href="/homeloanlead-details.php?postid=<? echo $row["RequestID"]; ?>&biddt=<? echo $BidderIDstatic; ?>" target="_blank"><? echo $row["Name"]; ?></a>
                                    <? }else if($BidderIDstatic==7236 || $BidderIDstatic==7479){?>
                                     <a target="_blank" href="http://www.deal4loans.com/personalloanlead-details.php?postid=<?php echo $row['RequestID'];?>&biddt=<?php echo $BidderIDstatic; ?>"><?php echo $row["Name"]; ?></a>
                                    <?                                     
                                    }
									else {
                                                                            ?>
                                    <a target="_blank" href="http://www.deal4loans.com/apply_stancpl_consent.php?pl_requestid=<?php echo $row['RequestID'];?>&pl_bank_name=Standard Chartered&aiplead=yes"><?php echo $row["Name"]; ?></a>
                                                                            
                                                                            <?php } ?>
								</td>
								<td align="center" bgcolor="#DFF6FF" class="style3"><? echo $row["City"]; ?></td>
								<td align="center" bgcolor="#DFF6FF" class="style3">
								<?php 
								if( $_SESSION['BidderID']==6732 || $_SESSION['BidderID']==6733) {
								?>
								<span id="clik4Num_<?php echo $color; ?>">XXXXXXXXXX</span>                
								<?php } else {  echo ccMasking($row['Mobile_Number']); } ?></td>
								<td align="center" bgcolor="#DFF6FF" class="style3">
									<?php
									if( $_SESSION['BidderID']==6732 || $_SESSION['BidderID']==6733) {
									?>
									<span id="clkNum<?php echo $color; ?>" onClick="getNumValue(<?php echo $color; ?>,<?php echo $row['RequestID']; ?>,<?php echo $getParameterVal; ?>);" style="cursor:hand;"><? echo $row['Net_Salary']; ?></span>
									<?php 
									} else {
										echo $row['Net_Salary'];
									} ?>
								</td>
								<td align="center" bgcolor="#DFF6FF" class="style3"><? echo $row["Loan_Amount"]; ?></td>
								<td align="center" bgcolor="#DFF6FF" class="style3">
									<?php
										//$commentQry = "SELECT Feedback, comment_section, Followup_Date FROM Req_Feedback WHERE AllRequestID='".$row["RequestID"]."' order by FeedbackID DESC Limit 0,1";
										//$commentresult = d4l_ExecQuery($commentQry);
										//$commentrow=d4l_mysql_fetch_assoc($commentresult);
									?>
								<? 
								if($BidderIDstatic==2997)
								{
									if($row["Feedback"]=="Closed")
									{
										echo "Disbursed";
									}
									else if($row["Feedback"]=="Process")
									{
										echo "Login";
									}
									else
									{
										echo $row["Feedback"];
									}
								}
								/*elseif($BidderIDstatic==5788 && $row["Feedback"]=="Closed")
								{
									if($row["Feedback"]=="Closed")
									{
										echo "Disbursed";
									}				
								}*/
								else if($BidderIDstatic == 5788){
									echo getJumpMenu("bidders_consolidate.php", $row["RequestID"], "2", $row["Feedback"], $pageno, $varmin_date, $varmax_date, $varCmbFeedback, $val, $BidderIDstatic,$checkbidderid);
								} 
								else
								{
									echo $row["Feedback"]; 
								}
								
								
								?>
								</td>
								<? 
								if(/*$BidderIDstatic=="5788" ||*/ $BidderIDstatic=="6078" || $BidderIDstatic=="5373" || $BidderIDstatic=="5654") { 
								?>
								<td align="center" bgcolor="#DFF6FF" width="150"><textarea cols="15" rows="2" readonly><? echo $row["comment_section"]; ?></textarea></td>
								<?
								}
								if($BidderIDstatic=="5788") {
								?>
								<td align="center" bgcolor="#DFF6FF" class="bodyarial11">
									<table width="100%">
										<tr>
											<td>
												<textarea  name="comment_section_<? echo $i; ?>" id="comment_section_<? echo $i; ?>" cols="15" rows="2"><? echo $row["comment_section"]; ?></textarea>
											</td>
											<td>
												<a onClick="insertDatakotak(<? echo $i; ?>);" style="cursor:pointer; color:blue;" class="style3">Save</a>
											</td>
										</tr>
										<tr>
											<td colspan="2">
												<input name="followup_date_<? echo $i; ?>" type="text" id="followup_date_<? echo $i; ?>" size="10" value="<? echo $row["Followup_Date"]; ?>">&nbsp;<!--<input name="b123" type="button" class="buttonfordate" onClick="javascript:pedirFecha(followup_date_<? echo $i; ?>, '');" value="flwupDate" bgcolor="#45B2D8" style="width:65px; font-size:11px;background-color:background-color:#45B2D8;">-->
											</td>
										</tr>
									</table>
								</td>
								<?
								}
								if(($IP=="182.71.109.218" || $IP=="122.176.100.27" || $IP=="122.176.100.28" || $IP=="122.176.122.134" || $IP=="122.161.196.68" || $IP=="61.246.3.127" || $IP=="122.160.30.168" || $IP=="180.188.224.34" || $IP=="122.161.193.191" || $IP=="122.160.74.241" || $IP=="122.160.74.235" || $IP=="1.23.114.53" || "185.93.231.12"))
								{
								echo '<td align="center" bgcolor="#DFF6FF" colspan="2" width="250">';

								$getUploadedFeedback = '';
								$getUploadedComments = '';

								$getFeedbackSql = "select Feedback, Comments, BidderID from Req_Feedback_Comments_PL where AllRequestID='".$row["RequestID"]."' and BidderID='".$row['sentbidder']."' and Feedback!='' ";
								
								$getFeedbackQuery = d4l_ExecQuery($getFeedbackSql);
								$getUploadedNumRows = d4l_mysql_num_rows($getFeedbackQuery);
								
								$getFeedbackOthersSql = "select Feedback, Comments, BidderID from Req_Feedback_Comments_PL where AllRequestID='".$row["RequestID"]."' and BidderID!='".$row['sentbidder']."' and Feedback!=''";
								
								$getFeedbackOthersQuery = d4l_ExecQuery($getFeedbackOthersSql);
								$getUploadedNumOthersRows = d4l_mysql_num_rows($getFeedbackOthersQuery);
								
								if($getUploadedNumRows>0 || $getUploadedNumOthersRows>0)
								{
								?>

								<table width="100%" border="0" align="center" cellpadding="2" cellspacing="1" bgcolor="#FFFFFF" >
									<?php 
									if($getUploadedNumRows>0)
									{
										$getUploadedFeedback = d4l_mysql_result($getFeedbackQuery,0,'Feedback');
										$getUploadedComments = d4l_mysql_result($getFeedbackQuery,0,'Comments');
										$getUploadedBidderID = d4l_mysql_result($getFeedbackQuery,0,'BidderID');
										$getBidderSQl1 = "select Bidder_Name from Bidders_List where BidderID= '".$getUploadedBidderID."'";
										$getBidderQuery1 = d4l_ExecQuery($getBidderSQl1);
										$getBidder_Name1 = d4l_mysql_result($getBidderQuery1,0,'Bidder_Name');
										?>
										<tr>
											<td align="center" bgcolor="#DFF6FF"><?php echo $getUploadedFeedback; ?></td>
											<td align="center" bgcolor="#DFF6FF" ><?php echo $getUploadedComments; ?></td>
											<td align="center" bgcolor="#DFF6FF" ><?php echo $getBidder_Name1; ?></td>
										<tr>
									<?php 
									}
									if($getUploadedNumOthersRows>0)
									{
										$getUploadedOthersFeedback = '';
										$getUploadedOthersComments = '';
										$getUploadedOthersBidderID = '';

										for($ii=0;$ii<$getUploadedNumOthersRows;$ii++)
										{
											$getUploadedOthersFeedback = d4l_mysql_result($getFeedbackOthersQuery,$ii,'Feedback');
											$getUploadedOthersComments = d4l_mysql_result($getFeedbackOthersQuery,$ii,'Comments');
											$getUploadedOthersBidderID = d4l_mysql_result($getFeedbackOthersQuery,$ii,'BidderID');
											$getBidderSQl = "select Bidder_Name from Bidders_List where BidderID= '".$getUploadedOthersBidderID."'";
											$getBidderQuery = d4l_ExecQuery($getBidderSQl);
											$getBidder_Name = d4l_mysql_result($getBidderQuery,0,'Bidder_Name');
										?>
										<tr>
											<td align="center" bgcolor="#FFCC99"><?php echo $getUploadedOthersFeedback; ?></td>
											<td align="center" bgcolor="#FFCC99"><?php echo $getUploadedOthersComments; ?></td>
											<td align="center" bgcolor="#FFCC99" ><?php echo $getBidder_Name; ?></td>
											<tr><?php
										}
									}
									?>
									</table>
								<?php
								}
								echo '</td>';
								} 
								if($BidderIDstatic=="2680")
								{
									$apiquery="SELECT feedback FROM `webservice_bidder_details` WHERE `bidderid` like'%Standard%' and leadid=".$row["RequestID"]; 
									//$apiqueryresult = d4l_ExecQuery($apiquery);
									//$apirow=d4l_mysql_fetch_array($result);
									//$apifeedback = $apirow["feedback"];
									//$apifeedbackarr=explode(",",$apifeedback);
										?>
									<td align="center" bgcolor="#DFF6FF" ><? //echo $apifeedbackarr[0]." ".$apifeedbackarr[1]." ".$apifeedbackarr[3]; ?></td>
								<?
								} 
								?>
							</tr>
	<?
			$i=$i+1;
                        $color++;
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
 
  $datediffvar= timeDiff($varmin_date,$varmax_date);

   if($datediffvar<=7 || ($BidderIDstatic==6119 && $datediffvar<=92))
		{
  if($BidderIDstatic==2501)
			{
				if($joindate < $min_date)
				{
					?>  <tr><td align="center"><table width="500" border="0" cellspacing="1" cellpadding="4">
 <form name="frmdownload" action="bidder_download.php" method="post">
   <tr>
     <td align="center">
	   <input type="hidden" name="qry1" value="<? echo $search_qry; ?>">
	      <input type="hidden" name="BidderIDstatic" value="<? echo $BidderIDstatic; ?>">
	   <input type="hidden" name="qry2" value="<? echo $val; ?>">
	    <input type="hidden" name="min_date" value="<? echo $min_date; ?>">
	   <input type="hidden" name="max_date" value="<? echo $max_date; ?>">
	 <input name="Submit2" type="submit" class="bluebtn" value="Export List To Excel">
	 </td>
   </tr>
 </form>
 </table></td></tr><?
				}
				else
				{					
				}
			}
			else
			{
			?>
   <tr><td align="center"><table width="500" border="0" cellspacing="1" cellpadding="4">
 <form name="frmdownload" action="bidder_download.php" method="post">
   <tr>
     <td align="center">
	   <input type="hidden" name="qry1" value="<? echo $search_qry; ?>">
	      <input type="hidden" name="BidderIDstatic" value="<? echo $BidderIDstatic; ?>">
	   <input type="hidden" name="qry2" value="<? echo $val; ?>">
	    <input type="hidden" name="min_date" value="<? echo $min_date; ?>">
	   <input type="hidden" name="max_date" value="<? echo $max_date; ?>">
	 <input name="Submit2" type="submit" class="bluebtn" value="Export List To Excel">
	 </td>
   </tr>
 </form>
 </table></td></tr>
 <tr><td>&nbsp;</td></tr>
 <tr><td>&nbsp;</td></tr>
 </table>
   <?
		}	
	}
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

function getJumpMenu($varPHPPage, $varRequestID, $varType, $varFeedback, $varpageon, $varmindate, $varmaxdate, $cmbfeedback, $varVal, $BidderIDstatic,$checkbidderid) {
    $strURL = "";
    $strURL = $varPHPPage . "?search=y&RequestID=" . $varRequestID . "&type=" . $varType . "&pageno=" . $varpageon . "&min_date=" . urlencode($varmindate) . "&max_date=" . urlencode($varmaxdate) . "&cmbfeedback=" . urlencode($cmbfeedback) . "&product=" . $varVal. "&city=" . $checkbidderid;
    ?>
    <select name="type" id="type" onChange="MM_jumpMenu('parent', this, 0)" class="style3" style="width:110px;">
        <option value="<? echo $strURL . '&Feedback=' ?>" <? if ($varFeedback == "") { echo "selected";	} ?> >No Feedback</option>
		<option value="<? echo $strURL . '&Feedback=Not Eligible' ?>" <? if ($varFeedback == "Not Eligible") {
            echo "selected";
        } ?>>Not Eligible</option>
		<option value="<? echo $strURL . '&Feedback=Not Interested' ?>" <? if ($varFeedback == "Not Interested") {
            echo "selected";
        } ?>>Not Interested</option>
        <option value="<? echo $strURL . '&Feedback=Callback Later' ?>" <? if ($varFeedback == "Callback Later") {
            echo "selected";
        } ?>>Callback Later</option>
        <option value="<? echo $strURL . '&Feedback=Wrong Number' ?>" <? if ($varFeedback == "Wrong Number") {
            echo "selected";
        } ?>>Wrong Number</option>
        <option value="<? echo $strURL . '&Feedback=Process' ?>" <? if ($varFeedback == "Process") {
            echo "selected";
        } ?>>Process</option>
        <option value="<? echo $strURL . '&Feedback=Closed' ?>" <? if ($varFeedback == "Closed") {
            echo "selected";
        } ?>>Disbursed</option>
        <option value="<? echo $strURL . '&Feedback=Sanctioned' ?>" <? if ($varFeedback == "Sanctioned") {
            echo "selected";
        } ?>>Sanctioned</option>
        <option value="<? echo $strURL . '&Feedback=Ringing' ?>" <? if ($varFeedback == "Ringing") {
            echo "selected";
        } ?>>Ringing</option>
        <option value="<? echo $strURL . '&Feedback=FollowUp' ?>" <? if ($varFeedback == "FollowUp") {
            echo "selected";
        } ?>>FollowUp</option>
        <option value="<? echo $strURL . '&Feedback=Documents Pick' ?>" <? if ($varFeedback == "Documents Pick") {
            echo "selected";
        } ?>>Documents Pick</option>
        <option value="<? echo $strURL . '&Feedback=Loan Rejected' ?>" <? if ($varFeedback == "Loan Rejected") {
            echo "selected";
        } ?>>Loan Rejected</option>
        <option value="<? echo $strURL . '&Feedback=Appointment' ?>" <? if ($varFeedback == "Appointment") {
            echo "selected";
        } ?>>Appointment</option>
        <option value="<? echo $strURL . '&Feedback=Property Not Identified' ?>" <? if ($varFeedback == "Property Not Identified") {
            echo "selected";
        } ?>>Property Not Identified</option>
    </select>
<?
}
?>
 </td></tr></table>
</td></tr></table>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-1312775-1");
pageTracker._trackPageview();
} catch(err) {}</script>
<script type="text/javascript">
<!--
//date function complete start here>>>
nombresMes = Array("","january","february","march","april","may","june","july","august","september","october","november","december");
var anoInicial = 1900;
var anoFinal = 2100;
var ano;
var mes;
var dia;
var campoDeRetorno;
var titulo;
function diasDelMes(ano,mes) {
       if ((mes==1)||(mes==3)||(mes==5)||(mes==7)||(mes==8)||(mes==10)||(mes==12)) dias=31
  else if ((mes==4)||(mes==6)||(mes==9)||(mes==11)) dias=31
  else if ((((ano % 100)==0) && ((ano % 400)==0)) || (((ano % 100)!=0) && ((ano % 4)==0))) dias = 29
  else dias = 28;
  return dias;
};

function crearSelectorMes(mesActual) {
  var selectorMes = "";
  selectorMes = "<select name='mes' size='1' onChange='javascript:opener.dibujarMes(self.document.Forma1.ano[self.document.Forma1.ano.selectedIndex].value,self.document.Forma1.mes[self.document.Forma1.mes.selectedIndex].value);'>\r\n";
  for (var i=1; i<=12; i++) {
    selectorMes = selectorMes + "  <option value='" + i + "'";
    if (i == mesActual) selectorMes = selectorMes + " selected";
    selectorMes = selectorMes + ">" + nombresMes[i] + "</option>\r\n";
  }
  selectorMes = selectorMes + "</select>\r\n";
  return selectorMes;
}

function crearSelectorAno(anoActual) {
  var selectorAno = "";
  selectorAno = "<select name='ano' size='1' onChange='javascript:opener.dibujarMes(self.document.Forma1.ano[self.document.Forma1.ano.selectedIndex].value,self.document.Forma1.mes[self.document.Forma1.mes.selectedIndex].value);'>\r\n";
  for (var i=anoInicial; i<=anoFinal; i++) {
    selectorAno = selectorAno + "  <option value='" + i + "'";
    if (i == anoActual) selectorAno = selectorAno + " selected";
    selectorAno = selectorAno + ">" + i + "</option>\r\n";
  }
  selectorAno = selectorAno + "</select>";
  return selectorAno;
}

function crearTablaDias(numeroAno,numeroMes) {
  var tabla = "<table border='0' cellpadding='2' cellspacing='0' bgcolor='#ffffff'>\r\n  <tr>";
  var fechaInicio = new Date();
  fechaInicio.setYear(numeroAno);
  fechaInicio.setMonth(numeroMes-1);
  fechaInicio.setDate(1);
  ajuste = fechaInicio.getDay();
  tabla = tabla + "\r\n    <td align='center'>Su</td><td align='center'>Mo</td><td align='center'>Tu</td><td align='center'>We</td><td align='center'>Th</td><td align='center'>Fr</td><td align='center'>Sa</td></div>\r\n  <tr>";
  for (var j=1; j<=ajuste; j++) {
    tabla = tabla + "\r\n    <td></td>";
  }
  for (var i=1; i<10; i++) {
    tabla = tabla + "\r\n    <td"
    if ((i == diaHoy()) && (numeroMes == mesHoy()) && (numeroAno == anoHoy())) tabla = tabla + " bgcolor='#ff0000'";
    tabla = tabla + "><input type='button' value='0" + i + "' onClick='javascript:opener.ano=self.document.Forma1.ano[self.document.Forma1.ano.selectedIndex].value; opener.mes=self.document.Forma1.mes[self.document.Forma1.mes.selectedIndex].value; opener.dia=" + i + "; self.close();'></td>";
    if (((i+ajuste) % 7)==0) tabla = tabla + "\r\n  </tr>\r\n\  <tr>";
  }
  for (var i=10; i<=diasDelMes(numeroAno,numeroMes); i++) {
    tabla = tabla + "\r\n    <td"
    if ((i == diaHoy()) && (numeroMes == mesHoy()) && (numeroAno == anoHoy())) tabla = tabla + " bgcolor='#ff0000'";
    tabla = tabla + "><input type='button' value='" + i + "' onClick='javascript:opener.ano=self.document.Forma1.ano[self.document.Forma1.ano.selectedIndex].value; opener.mes=self.document.Forma1.mes[self.document.Forma1.mes.selectedIndex].value; opener.dia=" + i + "; self.close();'></td>";
    if (((i+ajuste) % 7)==0) tabla = tabla + "\r\n  </tr>\r\n\  <tr>";
  }
  tabla = tabla + "\r\n  </tr>\r\n</table>";
  return tabla;
}

function dibujarMes(numeroAno,numeroMes) {
  var html = "";
  html = html + "<html>\r\n<head>\r\n  <title>" + titulo + "</title>\r\n</head>\r\n<body bgcolor='#ffffff' onUnload='opener.escribirFecha();'>\r\n  <div align='center'>\r\n  <form name='Forma1'>\r\n";
  html = html + crearSelectorMes(numeroMes);
  html = html + crearSelectorAno(numeroAno);
  html = html + crearTablaDias(numeroAno,numeroMes);
  html = html + "<center><p><input type='button' name='hoy' value='today: " + dia + "/" + mes + "/" + ano + "' onClick='javascript:self.close();'></center>";
  //html = html + "\r\n  </form>\r\n  </div>\r\n</body>\r\n</html>\r\n";
  html = html + "\r\n  </form>\r\n  </div>";
  ventana = open("","calendario","width=360,height=270");
  ventana.document.open();
  ventana.document.writeln(html);
  ventana.document.close();
  ventana.focus();
}

function anoHoy() {
  var fecha = new Date();
  if (navigator.appName == "Netscape") return fecha.getYear() + 1900
  else return fecha.getYear();
}

function mesHoy() {
  var fecha = new Date();
  return fecha.getMonth()+1;
}

function diaHoy() 
{
	var fecha = new Date();
	return fecha.getDate();
}

function pedirFecha(campoTexto,nombreCampo) 
{
  ano = anoHoy();
  mes = mesHoy();
  dia = diaHoy();
  campoDeRetorno = campoTexto;
  titulo = nombreCampo;
  dibujarMes(ano,mes);
}

function escribirFecha() 
{
	if(dia<10)
	{
		dia="0"+dia;
	}
	if(mes<10)
	{
		mes="0"+mes;
	}
		campoDeRetorno.value = ano + "-" + mes + "-" + dia;
}

// date function finish here
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
	document.frmsearch.action="bidders_consolidate.php?search=y"+gifName;
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
	<?if($BidderIDstatic==1727)
		{?>
	if(document.frmsearch.min_date.value<"2010-11-15")
	{
		alert("Sorry!!!! Your minimum date is 2010-11-15.Please Select.");
		document.frmsearch.min_date.value="";
		document.frmsearch.min_date.focus();
		return false;
	}
	<? }
	else if($BidderIDstatic==4093  || $BidderIDstatic==6279 /*|| $BidderIDstatic==5788*/)
	{ ?>
		if(document.frmsearch.min_date.value<"<? echo $joindate60; ?>")
		{
		alert("Sorry!!!! Your minimum date is <? echo $joindate60; ?>.Please Select.");
		document.frmsearch.min_date.value="";
		document.frmsearch.min_date.focus();
		return false;
		}
	<? }
	else if($BidderIDstatic==2454)
	{ ?>
		if(document.frmsearch.min_date.value<"2016-02-01")
	{
		alert("Sorry!!!! Your minimum date is 2016-02-01.Please Select.");
		document.frmsearch.min_date.value="";
		document.frmsearch.min_date.focus();
		return false;
	}
	<? }
	else if($BidderIDstatic==2920)
	{ ?>
		if(document.frmsearch.min_date.value<"<? echo $joindate ?>")
	{
		alert("Sorry!!!! Your minimum date is <? echo $joindate ?>.Please Select.");
		document.frmsearch.min_date.value="";
		document.frmsearch.min_date.focus();
		return false;
	}
	<? }
	else if($BidderIDstatic==2997)
	{ ?>
		if(document.frmsearch.min_date.value<"<? echo $joindate2997 ?>")
	{
		alert("Sorry!!!! Your minimum date is <? echo $joindate2997 ?>.Please Select.");
		document.frmsearch.min_date.value="";
		document.frmsearch.min_date.focus();
		return false;
	}
	<? }
	else { ?>
		if(document.frmsearch.min_date.value<"2011-03-16")
	{
		alert("Sorry!!!! Your minimum date is 2011-03-16.Please Select.");
		document.frmsearch.min_date.value="";
		document.frmsearch.min_date.focus();
		return false;
	}
	<? } ?>
	if(document.frmsearch.max_date.value=="")
	{
		alert("Sorry!!!! Please Enter Maximum date.");
		document.frmsearch.max_date.value="";
		document.frmsearch.max_date.focus();
		return false;
	}
}

function MM_jumpMenu(targ,selObj,restore){ //v3.0
 eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
 if (restore) selObj.selectedIndex=0;
}

function insertDatakotak(id)
{
	var get_comment_section = document.getElementById('comment_section_'+ id).value;
	var get_requestid= document.getElementById('requestid_'+ id).value;
	var get_product= document.getElementById('product_'+ id).value;
	var get_bidderid= document.getElementById('bidderid').value;
	var get_followup= document.getElementById('followup_date_'+ id).value;
	var queryString = "?comment_section=" + get_comment_section + "&get_requestid=" + get_requestid + "&get_product=" + get_product + "&get_bidderid=" + get_bidderid + "&get_followup=" + get_followup;
	alert(queryString); 
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
}
</script>

</body>
</html>
