<?php
require 'scripts/session_check_online.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';
$IP_Remote = $_SERVER["REMOTE_ADDR"];
if($IP_Remote=='192.124.249.12' || $IP_Remote=='185.93.228.12') { $IP= $_SERVER['HTTP_X_SUCURI_CLIENTIP']; }
else { $IP= $IP_Remote;	}

$todaydt=date('Y-m-d');

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

$caller_id="";
	if(isset($_REQUEST['caller_id']))
	{
		echo $caller_id=$_REQUEST['caller_id'];
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
$val ="Req_Loan_Personal";
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
/*function killCopy(e){ return false; }
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
<script type="text/JavaScript">
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
  html = html + "\r\n  </form>\r\n  </div>\r\n</body>\r\n</html>\r\n";
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
	document.frmsearch.action="bidders_consolidate_appointment.php?search=y"+gifName;
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

function MM_jumpMenu(targ,selObj,restore){ //v3.0
 eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
 if (restore) selObj.selectedIndex=0;
}
</script>
<table width="100%" border="0"  align="center" cellpadding="0" cellspacing="0" bgcolor="#45B2D8">
<tr>
<td>&nbsp;</td></tr>
	  <tr><td align="center" style="font-size:22px; font-weight:bold;">Appointments</td></tr>
 <tr><td align="center"> 
 <table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
   <tr>
     <td height="30" align="center" valign="middle"><img src="images/login-srch-pnl.gif" width="650" height="30"></td>
   </tr>
   <tr>
     <td align="center" valign="middle" background="images/login-form-login-bg.gif"><table width="95%" border="0"  cellpadding="1" cellspacing="0">
 <form name="frmsearch" action="bidders_consolidate_appointment.php?search=y" method="post" onSubmit="return chkform();">
   <input type="hidden" name="BidderIDstatic" id="BidderIDstatic" value="<?  if($BidderIDstatic>0){ echo $BidderIDstatic;} else { echo $_SESSION["BidderID"]; }?>">
   <tr><td colspan="3">&nbsp;</td></tr>
   <tr>
   <td colspan="3" align="center">
   <table border="0" width="90%" cellpadding="0" cellspacing="0"><tr>
     <td width="20%" valign="middle" class="style1">&nbsp;&nbsp;Date&nbsp;&nbsp; From </td>
     <td width="24%" align="left" valign="middle" class="bidderclass" ><?$current_date=date('Y-m-d');?> 
	   <input name="min_date" type="text" id="min_date" size="15" value="<? echo $min_date; ?>"></td>
	   <td>
       <input name="b12" type="button" class="bluebutton" onClick="javascript:pedirFecha(min_date,'');" value="&lt; Insert">  </td>
       <td valign="middle" align="center" class="style1" width="8%">To</td>
     <td align="left" valign="middle" class="style1" width="24%" >  <input name="max_date" type="text" id="max_date" size="15" value="<? echo $max_date; ?>"></td>
        <td> <input name="b122" type="button" class="bluebutton" onClick="javascript:pedirFecha(max_date,'');" value="&lt; Insert"></td>
	   </tr>
	   </table>
	   </td></tr>
	<!-- <tr><td width="30%" valign="middle" >Feedback:</td>
		 <td width="30%" align="left" valign="middle" class="bidderclass">
	
<select name="cmbfeedback" id="cmbfeedback" style="width:120px;">
	<option value="All" <? if($varCmbFeedback == "All") { echo "selected"; } ?>>All</option>
			<option value="" <? if($varCmbFeedback == "") { echo "selected"; } ?>>No Feedback</option>
			<option value="Not Eligible" <? if($varCmbFeedback == "Not Eligible") { echo "selected"; } ?>>Not Eligible</option>
			<option value="Not Interested" <? if($varCmbFeedback == "Not Interested") { echo "selected"; } ?>>Not Interested</option>
			<option value="Callback Later" <? if($varCmbFeedback == "Callback Later") { echo "selected"; } ?>>Callback Later</option>
			<option value="Wrong Number" <? if($varCmbFeedback == "Wrong Number") { echo "selected"; } ?>>Wrong Number</option>
            <option value="Process" <? if($varCmbFeedback == "Process" || $varCmbFeedback == "Login") { echo "selected"; } ?>>Process</option>
            <option value="Closed" <? if($varCmbFeedback == "Closed" || $varCmbFeedback == "Disbursed") { echo "selected"; } ?>>Closed</option>
            <option value="Not Available" <? if($varCmbFeedback == "Not Available") { echo "selected"; } ?>>Not Available</option>
            <option value="Ringing" <? if($varCmbFeedback == "Ringing") { echo "selected"; } ?>>Ringing</option>
			<option value="FollowUp" <? if($varCmbFeedback == "FollowUp") { echo "selected"; } ?>>FollowUp</option>
			<option value="Documents Pick" <? if($varCmbFeedback == "Documents Pick") { echo "selected"; } ?>>Documents Pick</option>
			<option value="Loan Rejected" <? if($varCmbFeedback == "Loan Rejected") { echo "selected"; } ?>>Loan Rejected</option>
		<option value="Appointment" <? if($varCmbFeedback == "Appointment") { echo "selected"; } ?>>Appointment</option>
		</select>	
		
 </td><td colspan="2"></td></tr>-->
<!--			  <tr>       <td width="19%" align="center"  valign="middle" class="bidderclass">Mobile</td>
	  <td width="68%"  valign="middle" class="bidderclass"><input type="text" name="mob_num" id="mob_num" value="<?php echo $mob_num; ?>" >
</td>
</tr>-->
   <tr>
      <td colspan="3" align="center" valign="middle"><input name="Submit" type="image"  src="images/login-form-lgn-srch.gif" style="width:111px; height:35px; border:none;" border="0"></td>
     </tr>
   </form>
 </table></td>
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
		$result = ExecQuery("select statid from smspl_status_details where AllRequestID=$RequestID and caller_id=".$caller_id);		
		$num_rows = mysql_num_rows($result);
		if($num_rows > 0)
		{
			$row = mysql_fetch_array($result);
			$strSQL="Update smspl_status_details Set final_feedback='".$Feedback."', finalstat_dated=Now() ";
			$strSQL=$strSQL."Where statid=".$row["statid"];
		}
		else
		{
			$strSQL="Insert into smspl_status_details(AllRequestID, caller_id, ProductID , final_feedback, finalstat_dated) Values (";
			$strSQL=$strSQL.$RequestID.",'".$caller_id."','1','".$Feedback."', Now())";
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
			$FeedbackClause=" AND (Req_Feedback.Feedback IS NULL OR Req_Feedback.Feedback='' OR Req_Feedback.Feedback='No Feedback') ";
		}
		else if($varCmbFeedback=="All")
		{
			$FeedbackClause=" ";
		}
		else
		{
			$FeedbackClause=" AND Req_Feedback.Feedback='".$varCmbFeedback."' ";
		}

		
		if($mob_num>0)
{
	$mob_num_clause = " AND Req_Loan_Personal.Mobile_Number = '".$mob_num."' ";
}
	?>
 <p class="bodyarial11"><?=$Msg?></p>
 <table width="1050" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#FFFFFF" >
 <?php
 	$leadidentifier = 'plalloclms';
// 	echo "Select BidderID from Bidders Where (leadidentifier='".$leadidentifier."') order by BidderID ASC<br>";
	$arrcallerqry=ExecQuery("Select BidderID from Bidders Where (leadidentifier='".$leadidentifier."') order by BidderID ASC");
	$arrCallerrID = '';
	while($rowcal=mysql_fetch_array($arrcallerqry))
	{
		$arrCallerID[] = $rowcal["BidderID"];
	}

	$arrCallerIDStr=implode("','",$arrCallerID);

//	echo "<br>";
	//	echo "Select BidderID from Bidders Where (Global_Access_ID in (".$_SESSION['BidderID'].")) order by BidderID ASC<br>";
	//Select BidderID from Bidders Where (Global_Access_ID like '%2454%') order by BidderID ASC
	$allBiddersQry = ExecQuery("Select BidderID from Bidders Where (Global_Access_ID like '%".$_SESSION['BidderID']."%') order by BidderID ASC");
	$numAllBidders = mysql_num_rows($allBiddersQry);
	if($numAllBidders>0)
	{
		$arrBidderID = '';
		while($rowBidders=mysql_fetch_array($allBiddersQry))
		{
			$arrBidderID[] = $rowBidders["BidderID"];
		}
	}
	else
	{
		$arrBidderID[] = $_SESSION['BidderID'];
	}
	$arrBidderIDStr=implode("','",$arrBidderID);
	
	
	
	$excludearrcallerqry=ExecQuery("Select BidderID from Bidders Where (leadidentifier LIKE  '%plmainlms%') order by BidderID ASC");
	$excludearrCallerrID = '';
	while($excluderowcal=mysql_fetch_array($excludearrcallerqry))
	{
		$excludearrCallerID[] = $excluderowcal["BidderID"];
	}

	$excludearrCallerIDStr=implode("','",$excludearrCallerID);

		$bidderAllocationTbl="Req_Feedback_Bidder_PL";
		$productTbl = "Req_Loan_Personal";
		$agentTbl = "plcallinglms_allocation";
		$feedbackTbl = "Req_Feedback";
		
			
		$qry="select *, ".$productTbl.".RequestID, ".$productTbl.".Name, ".$productTbl.".Mobile_Number, ".$agentTbl.".BidderID as AgentID, ".$bidderAllocationTbl.".BidderID as Bidder, ".$feedbackTbl.".Feedback, ".$feedbackTbl.".BidderID as checkBidderID  from ".$agentTbl." left outer join ".$productTbl." on ".$agentTbl.".AllRequestID=".$productTbl.".RequestID left outer join ".$bidderAllocationTbl." on ".$agentTbl.".AllRequestID= ".$bidderAllocationTbl.".AllRequestID and ".$bidderAllocationTbl.".BidderID in ('".$arrBidderIDStr."') left outer join ".$feedbackTbl." on ".$agentTbl.".AllRequestID= ".$feedbackTbl.".AllRequestID and ".$feedbackTbl.".BidderID in ('".$arrBidderIDStr."') where (".$agentTbl.".BidderID in ('".$arrCallerIDStr."') and ".$bidderAllocationTbl.".BidderID in ('".$arrBidderIDStr."')  and (".$agentTbl.".BidderID NOT IN ('".$excludearrCallerIDStr."')) and (".$bidderAllocationTbl.".Allocation_Date  Between '".($min_date)."' and '".($max_date)."' or Req_Feedback.Followup_Date Between '".($min_date)."' and '".($max_date)."') ) ";
		$qry=$qry.$FeedbackClause." ".$mob_num_clause." ".$refernce_no_clause;
		$qry=$qry."group by ".$val.".Mobile_Number";
	$search_qry = $qry;
	//	echo"hello".$search_qry."<br>";
		$result=ExecQuery($qry);
		$recordcount = mysql_num_rows($result);
 ?>
   <tr>
     <td colspan="11" style="border-bottom:1px solid #45B2D8;"><strong><? echo $startrow+1; ?> to <? echo min($startrow+$pagesize,$recordcount); ?> Out of <? echo $recordcount; ?> Records </strong></td>
     </tr>
   <tr>
      <td width="140" align="center" bgcolor="#FFFFFF" class="style2">Name</td>
	  <td width="70" align="center" bgcolor="#FFFFFF" class="style2">City</td>
     <td width="88" align="center" bgcolor="#FFFFFF" class="style2">Mobile</td>
     <td width="91" align="center" bgcolor="#FFFFFF" class="style2">Net Salary </td>
	  <td width="90" align="center" bgcolor="#FFFFFF" class="style2">Loan Amount </td>
	 <td width="90" align="center" bgcolor="#FFFFFF" class="style2">Bank Comments</td>
	       <td width="90" align="center" bgcolor="#FFFFFF" class="style2">Bank Feedback</td>
	 <td width="90" align="center" bgcolor="#FFFFFF" class="style2">Uploaded 
	 Feedback</td>
	       <td width="90" align="center" bgcolor="#FFFFFF" class="style2">
		   Uploaded Comments</td>
       <td width="90" align="center" bgcolor="#FFFFFF" class="style2">BidderID</td>	       
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

		$qry="select ".$productTbl.".RequestID, ".$productTbl.".Name, ".$productTbl.".Mobile_Number,".$productTbl.".City, ".$productTbl.".Net_Salary, ".$productTbl.".Loan_Amount, ".$agentTbl.".BidderID as CallerID, ".$bidderAllocationTbl.".BidderID as Bidder, ".$feedbackTbl.".Feedback, ".$feedbackTbl.".BidderID as checkBidderID, ".$feedbackTbl.".comment_section  from ".$agentTbl." left outer join ".$productTbl." on ".$agentTbl.".AllRequestID=".$productTbl.".RequestID	left outer join ".$bidderAllocationTbl." on ".$agentTbl.".AllRequestID= ".$bidderAllocationTbl.".AllRequestID and ".$bidderAllocationTbl.".BidderID in ('".$arrBidderIDStr."')	left outer join ".$feedbackTbl." on ".$agentTbl.".AllRequestID= ".$feedbackTbl.".AllRequestID and ".$feedbackTbl.".BidderID in ('".$arrBidderIDStr."') where (".$agentTbl.".BidderID in ('".$arrCallerIDStr."') and ".$bidderAllocationTbl.".BidderID in ('".$arrBidderIDStr."')   and (".$agentTbl.".BidderID NOT IN ('".$excludearrCallerIDStr."')) and (".$bidderAllocationTbl.".Allocation_Date  Between '".($min_date)."' and '".($max_date)."' or Req_Feedback.Followup_Date Between '".($min_date)."' and '".($max_date)."')) ";
		$qry=$qry.$FeedbackClause." ".$mob_num_clause." ".$refernce_no_clause;
		$qry=$qry."group by ".$val.".Mobile_Number";
		$qry=$qry." order by ".$productTbl.".Dated";
		$qry=$qry." LIMIT $startrow, $pagesize"; 	
		
		//	echo "Qry - ".$qry."<br>";
		
		$result=ExecQuery($qry);
		$reply_type=1;
		$i=1;
		if($recordcount>0)
		{
		while($row=mysql_fetch_array($result))
		{
			$rm_feedback = '';
			$rm_comments = '';
			//RM Feedback
			$getCheckSql = "select Comments as rm_comments, Feedback as rm_feedback from Req_Feedback_Comments_PL where AllRequestID= '".$row["RequestID"]."' and Reply_Type='".$reply_type."' and BidderID='".$row["Bidder"]."'";
			 $getCheckQuery = ExecQuery($getCheckSql);
			 $rm_feedback = mysql_result($getCheckQuery,0,'rm_feedback');
			 $rm_comments = mysql_result($getCheckQuery,0,'rm_comments');
	?>
	<input type="hidden" name="requestid_<? echo $i;?>" id="requestid_<? echo $i;?>" value="<? echo $row["RequestID"];?>">
		<input type="hidden" name="product_<? echo $i;?>" id="product_<? echo $i;?>" value="<? echo $pro_code;?>">
			<input type="hidden" name="BidderID" id="BidderID" value="<? echo $_SESSION['BidderID'];?>">
			<input type="hidden" name="caller_id" id="caller_id" value="<? echo $row['CallerID'];?>">
   <tr>
      <td align="center" bgcolor="#DFF6FF" class="style3"><? echo $row["Name"]; ?></td>
	  <td align="center" bgcolor="#DFF6FF" class="style3"><? echo $row["City"]; ?></td>
     <td align="center" bgcolor="#DFF6FF" class="style3"><? echo $row["Mobile_Number"]; ?></td>
     <td align="center" bgcolor="#DFF6FF" class="style3"><? echo $row["Net_Salary"]; ?></td>
	 <td align="center" bgcolor="#DFF6FF" class="style3"><? echo $row["Loan_Amount"]; ?></td>
	  <td  align="center" bgcolor="#DFF6FF" class="style3"><? echo $row["comment_section"]; ?></td>
     <td align="center" bgcolor="#DFF6FF" class="style3"><? echo $row["feedback"]; ?></td>

	  <td  align="center" bgcolor="#DFF6FF" class="style3"><?  echo $rm_feedback; ?></td>
     <td align="center" bgcolor="#DFF6FF" class="style3"><? echo $rm_comments; ?></td>
   <td  align="center" bgcolor="#DFF6FF" class="style3"><? echo $row["Bidder"]; ?></td>
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
   	}
 ?>
</table>
<?php if($search=="y")
	{
 ?>
 <table width="500" border="0" cellspacing="1" cellpadding="4">
 <form name="frmdownload" action="misappt_download.php" method="post">
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

</table>
<?php } ?>
</td></tr></table>
<?
function getJumpMenu($varPHPPage, $varRequestID, $varType, $varFeedback, $varpageon, $varmindate, $varmaxdate,$cmbfeedback,$varVal)
{
	$strURL="";
	$strURL=$varPHPPage."?search=y&RequestID=".$varRequestID."&type=".$varType."&pageno=".$varpageon."&min_date=".urlencode($varmindate)."&max_date=".urlencode($varmaxdate)."&cmbfeedback=".urlencode($cmbfeedback)."&caller_id=".$varVal;
?>
	<select name="type" id="type" onChange="MM_jumpMenu('parent',this,0)" class="style3" style="width:110px;">
		<option value="<? echo $strURL.'&Feedback='?>" <? if($varFeedback == "") { echo "selected"; } ?> >No Feedback</option>
	<option value="<? echo $strURL.'&Feedback=Documents Pending'?>" <? if($varFeedback == "Documents Pending") { echo "selected"; } ?>>Documents Pending</option>
	<option value="<? echo $strURL.'&Feedback=Documents Picked'?>" <? if($varFeedback == "Documents Picked") { echo "selected"; } ?>>Documents Picked</option>
	<option value="<? echo $strURL.'&Feedback=Login'?>" <? if($varFeedback == "Login") { echo "selected"; } ?>>Login/WIP</option>
	<option value="<? echo $strURL.'&Feedback=Pre-Login Reject'?>" <? if($varFeedback == "Pre-Login Reject") { echo "selected"; } ?>>Pre-Login Reject</option>
	<option value="<? echo $strURL.'&Feedback=Approved'?>" <? if($varFeedback == "Approved") { echo "selected"; } ?>>Approved</option>
	<option value="<? echo $strURL.'&Feedback=Disbursed'?>" <? if($varFeedback == "Disbursed") { echo "selected"; } ?>>Disbursed</option>
	<option value="<? echo $strURL.'&Feedback=Post Login Reject'?>" <? if($varFeedback == "Post Login Reject") { echo "selected"; } ?>>Post Login Reject</option>
	<option value="<? echo $strURL.'&Feedback=Rescheduled'?>" <? if($varFeedback == "Rescheduled") { echo "selected"; } ?>>Rescheduled</option>
	<option value="<? echo $strURL.'&Feedback=Ringing'?>" <? if($varFeedback == "Ringing") { echo "selected"; } ?>>Ringing</option>
	<option value="<? echo $strURL.'&Feedback=cust_noncoperative'?>" <? if($varFeedback == "cust_noncoperative") { echo "selected"; } ?>>Cust Not Co-operating</option>
	</select>
	<?  } ?>
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
<?php
if($IP=="182.71.109.218")
{
	//echo $IP;
		//echo "Qry - ".$qry."<br>";
}

?>
