<?php
session_start();
//require 'scripts/session_check_online.php';
require 'scripts/db_init.php';
require 'scripts/db_init_wishfin.php';
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
    $Process_Name=$_REQUEST['Process_Name'];
}
else
{
	$BidderIDstatic=$_SESSION['BidderID'];
	 $Process_Name=$_SESSION['Process_Name'];
}


$pagename = $BidderIDstatic;

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

$asmwise="";
if(isset($_REQUEST['asmwise']))
{
	$asmwise = $_REQUEST['asmwise'];
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
<style type="text/css">
.click-btn{color:#337ab7; border-color:#2e6da4; display:inline-block; padding:2px 4px; border:none; border-radius:4px; margin-top:1rem;}
.display{ width:100%; padding:10px; border:thin solid #CCC; display:none;}
</style>
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
    /*
function killCopy(e){ return false; }
function reEnable(){return true; }
document.onselectstart=new Function ("return false");
if (window.sidebar){ document.onmousedown=killCopydocument.onclick=reEnable }*/
function clickIE4(){if (event.button==2){ return false; } }
function clickNS4(e){ if (document.layers||document.getElementById&&!document.all){ if (e.which==2||e.which==3){ return false;} } }
if (document.layers){ document.captureEvents(Event.MOUSEDOWN); document.onmousedown=clickNS4; } else if (document.all&&!document.getElementById){ document.onmousedown=clickIE4; }
document.oncontextmenu=new Function("return false")
</script>
<?php 
	 if(isset($_SESSION['UserType']))
	{
echo "<table width='100%' border='0' cellspacing='0' cellpadding='0'><tr><td width='323' height='93' align='left' valign='top'><img src='http://www.deal4loans.com/images/login-logo.gif' width='323' height='93' /></td><td align='left' valign='top' style='color:#0B6FCC;' ><table width='100%' border='0' cellspacing='0' cellpadding='0' bgcolor='#0A92C0'><tr><td height='67' align='right' valign='middle' bgcolor='#C8E3F3' style='padding-right:10px;'><table border='0' align='right' cellpadding='0' cellspacing='0' bgcolor='#0A92C0'><tr><td width='6' height='32' align='left' valign='top'><img  src='http://www.deal4loans.com/images/login-form-logut-lft.gif' width='6' height='32' /></td><td><table width='100%' border='0' align='center' cellpadding='0' cellspacing='0'><tr><td align='left' valign='middle' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#FFFFFF; font-weight:bold; padding-right:15px;' > Welcome ".ucwords($_SESSION['UserType'])." ".$_SESSION['UName']."</td><td align='left' style='padding-right:2px;' width='22'><img src='http://www.deal4loans.com/images/login-logut-btn.gif' /></td><td align='right' class='style1' style='color:#FFFFFF; font-weight:bold;'><div align='right' class='style1' style='color:#FFFFFF; font-weight:bold;'> <a href='Logout.php' style='color:#FFFFFF; font-size:13px; text-decoration:none; font-family:Verdana, Arial, Helvetica, sans-serif;'>Logout</a></div></td></tr></table></td><td width='6' height='32'><img src='http://www.deal4loans.com/images/login-form-logut-rgt.gif' width='6' height='32' /></td></tr></table></td></tr><tr><td>&nbsp;</td></tr></table></td></tr></table>";
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
						selectedDate, instance.settings );
				dates.not( this ).datepicker( "option", option, date );
			}
		});
	});
</script>
<script type="text/javascript">		
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
	document.frmsearch.action="sbihl_whatsappview_calleracct.php?search=y"+gifName;
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

</script>

</head><body>
<table width="100%" border="0"  align="center" cellpadding="0" cellspacing="0" >
<tr>
    <td align="center">
	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#45B2D8">
		<tr><td style="padding-top:5px; font-size:13px;">&nbsp;&nbsp; <a  href="/change_lms_pwd.php" target="_blank" style="color:#FFFFFF;"><b>Change Password</b></a> |  <a  href="sbihl_callingview_calleracct.php" style="color:#FFFFFF;"><b>Main</b></a></td></tr>
      <tr>
	  <td style="padding-top:10px;"><table  width="669" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#45B2D8" >
<? if (((!isset($val) && $viewtexttype==1) || ($val=="Req_Loan_Personal")) || ((!isset($val) && $viewtexttype==2) || ($val=="Req_Loan_Home")))
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
                    <form name="frmsearch" action="sbihl_whatsappview_calleracct.php?search=y" method="post" onSubmit="return chkform();">
		<div class="wrapper-leads">   
<input type="hidden" name="BidderIDstatic" id="BidderIDstatic" value="<? echo $BidderIDstatic;?>">
<input type="hidden" name="Process_Name" id="Process_Name" value="<? echo $Process_Name;?>">
	    <p class="heading-lead"><strong>Select date range</strong></p>
        <div class="div-lead-left">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="47%" class="style1">From</td>
    <td width="53%">
	                    <input name="min_date" class="input-lead" type="text" id="min_date" size="15" value="<? echo $_REQUEST['min_date']; ?>"  ></td>
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
        <div style="clear:both; height: 10px;"></div>
       
        <table width="66%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    
      <td class="style1" style="float:right;"><input name="Submit" type="image"  src="images/login-form-lgn-srch.gif" style="width:111px; height:35px; border:none;"/>
     </td>
    </tr>
</table>
        
        <div style="clear:both;"></div>
	    </div></form></td></tr> 
 </table>
	<?
	if($search=="y")
	{
		$min_date=$min_date." 00:00:00";
		$max_date=$max_date." 23:59:59";
		
		if($mob_num>0)
		{
			$mob_num_clause = " AND `".$val."`.Mobile_Number = '".$mob_num."' ";
		}
		
		$feedback_tble="client_lead_allocate";	

	?>
<p class="bodyarial11"><?=$Msg?></p>
   <p align="center"><span id="name_status" style="color:#F00; font-weight:bold;"></span> </p>
<table width="1020" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#FFFFFF" >
	<?php
	//print_r($_SESSION);
		$arrcityBidderID="";
		$getglobalidSql = d4l_ExecQuery("select BidderID,City from Bidders where (Global_Access_ID ='6319')");
		while($getglobal = d4l_mysql_fetch_array($getglobalidSql))
		{ $arrcityBidderID[]=$getglobal["BidderID"];
		}
   		$strcityBidderID= implode("','",$arrcityBidderID);
                ##########################################
                
                //get biddeid
			$qry="SELECT Name, RequestID, xkyknzl5dwfyk4hg_wishfin_whatsapp.mobile_number, xkyknzl5dwfyk4hg_wishfin_whatsapp.date_created, BidderID FROM client_lead_allocate,Req_Loan_Home left join xkyknzl5dwfyk4hg_wishfin_whatsapp ON xkyknzl5dwfyk4hg_wishfin_whatsapp.mobile_number=Req_Loan_Home.Mobile_Number left join xkyknzl5dwfyk4hg_tms_whatsapp on xkyknzl5dwfyk4hg_tms_whatsapp.mobile=xkyknzl5dwfyk4hg_wishfin_whatsapp.mobile_number WHERE (client_lead_allocate.BidderID in ('".$strcityBidderID."') and client_lead_allocate.Reply_Type=2 and client_lead_allocate.AllRequestID=`Req_Loan_Home`.RequestID and client_lead_allocate.caller_name='".$_SESSION['Process_Name']."' and ((xkyknzl5dwfyk4hg_tms_whatsapp.date_created Between '".($min_date)."' and '".($max_date)."') AND xkyknzl5dwfyk4hg_wishfin_whatsapp.mobile_number!='' AND process_name='deal4loan_homeloan7342_message'))";
		//	$qry=$qry.$callerFeedbackClause." ".$citywise_clause." ".$mob_num_clause." ".$refernce_no_clause;
			$qry=$qry." group by xkyknzl5dwfyk4hg_wishfin_whatsapp.mobile_number ";


          //      $qry="SELECT mobile_number, message,xkyknzl5dwfyk4hg_wishfin_whatsapp.date_created FROM `xkyknzl5dwfyk4hg_wishfin_whatsapp` LEFT OUTER JOIN xkyknzl5dwfyk4hg_tms_whatsapp on xkyknzl5dwfyk4hg_tms_whatsapp.whatsapp_id=xkyknzl5dwfyk4hg_wishfin_whatsapp.id WHERE ( xkyknzl5dwfyk4hg_wishfin_whatsapp.date_created Between '".($min_date)."' and '".($max_date)."') AND `mobile_number`!='' AND process_name='deal4loan_homeloan7342_message'";
                //$qry=$qry.$mob_num_clause;
                //$qry=$qry." group by xkyknzl5dwfyk4hg_wishfin_whatsapp.mobile_number";       
                $qry=$qry." ORDER BY `xkyknzl5dwfyk4hg_wishfin_whatsapp`.`date_created` DESC"; 
               $resultcount = $result=d4l_ExecQuery($qry);
               $recordcount = d4l_mysql_num_rows($resultcount);
                
            $qry=$qry." LIMIT $startrow, $pagesize";
            
            echo $qry."<br>";
            
	$maxpage = $recordcount % $pagesize;
	if($recordcount % $pagesize == 0)
	{
		$maxpage = $recordcount / $pagesize;
	}
	else
	{
		$maxpage = ceil($recordcount / $pagesize);
	}
            //echo "<br>".$qry."<br>";
	$result=d4l_ExecQuery($qry);
                
                
	?>
	<tr>
		<td colspan="11" style="border-bottom:1px solid #45B2D8;"><strong><? echo $startrow+1; ?> to <? echo min($startrow+$pagesize,$recordcount); ?> Out of <? echo $recordcount; ?> Records </strong>
	</tr>	
	<tr>
		<td width="149" align="center" bgcolor="#FFFFFF" class="style2">Name</td>
		<td width="88" align="center" bgcolor="#FFFFFF" class="style2">Date</td>     
		       
	</tr>
	<?
	//Set Maximum Page start
		
	//echo $qry."<br>";
	$logfilecontent.="Sql Query: ".$qry."\n";
	$logfilecontent.="********************************************************";
	
	$i=1;
	if($recordcount>0)
	{
		while($row=d4l_mysql_fetch_array($result))
		{
		
		
	?>
	
	<tr>
		<td align="center" bgcolor="#DFF6FF" class="style3">
            <a href="/sbihomeloanlead-details.php?postid=<? echo $row["RequestID"]; ?>&biddt=<? echo $row["BidderID"]; ?>" target="_blank"><? echo $row["Name"]; ?></a>        
            </td>
		   
		<td align="center" bgcolor="#DFF6FF" class="style3"><? echo date("Y-m-d",strtotime($row["date_created"])); ?></td>
		
                
                      
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
	}
?>
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
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->
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
<!--<textarea>
<?php 
//echo "<br><br><br><br><br><br><br><br><br><br><br><br><br>".$srch_qry;
?></textarea>-->
