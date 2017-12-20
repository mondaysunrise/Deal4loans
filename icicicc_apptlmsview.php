<?php
	require 'scripts/session_check_online.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	

$FeedbackClause="";

	$search="";
	if(isset($_GET['search']))
	{
		$search=$_GET['search'];
	}
	
$lead_stat="";
	if(isset($_REQUEST['lead_stat']))
	{
		$lead_stat=$_REQUEST['lead_stat'];
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

$mob_num="";
	if(isset($_REQUEST['mob_num']))
	{
		$mob_num = $_REQUEST['mob_num'];
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
	
	$varCmbFeedback="";
	if(isset($_REQUEST['cmbfeedback']))
	{
		$varCmbFeedback=$_REQUEST['cmbfeedback'];
	}


$strCity="";
if(isset($_REQUEST['City']))
	{
		$strCity=$_REQUEST['City'];
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

$val ="Req_Credit_Card";
$pro_code =4;
?>

<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=WINDOWS-1252">
<title>Login</title>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<link href="includes/style1.css" rel="stylesheet" type="text/css">
<link href="style.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript" src="scripts/datetime.js"></script>

<?php 
	 if(isset($_SESSION['UserType']))
	{
echo "<table width='100%' border='0' cellspacing='0' cellpadding='0'><tr><td width='323' height='93' align='left' valign='top'  ><img src='http://www.deal4loans.com/images/logo.gif' width='323' height='93' /></td><td align='left' valign='top' style='color:#0B6FCC;' ><table width='100%' border='0' cellspacing='0' cellpadding='0' bgcolor='#0A92C0'><tr><td height='67' align='right' valign='middle' bgcolor='#C8E3F3' style='padding-right:10px;'><table border='0' align='right' cellpadding='0' cellspacing='0' bgcolor='#0A92C0'><tr><td width='6' height='32' align='left' valign='top'><img  src='http://www.deal4loans.com/rnew/images/login-form-logut-lft.gif' width='6' height='32' /></td><td background='http://www.deal4loans.com/rnew/images/login-form-logut-bg.gif' style=' background-repeat:repeat-x; height:32px;'><table width='100%' border='0' align='center' cellpadding='0' cellspacing='0'><tr><td align='left' valign='middle' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#FFFFFF; font-weight:bold; padding-right:15px;' > Welcome ".ucwords($_SESSION['UserType'])." ".$_SESSION['UName']."</td><td align='left' style='padding-right:2px;' width='22'><img src='http://www.deal4loans.com/rnew/images/login-logut-btn.gif' /></td><td align='right' class='style1' style='color:#FFFFFF; font-weight:bold;'><div align='right' class='style1' style='color:#FFFFFF; font-weight:bold;'> <a href='Logout.php' style='color:#FFFFFF; font-size:13px; text-decoration:none; font-family:Verdana, Arial, Helvetica, sans-serif;'>Logout</a></div></td></tr></table></td><td width='6' height='32'><img src='http://www.deal4loans.com/rnew/images/login-form-logut-rgt.gif' width='6' height='32' /></td></tr></table></td></tr><tr><td>&nbsp;</td></tr></table></td></tr></table>";
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
	document.frmsearch.action="icicicc_apptlmsview.php?search=y"+gifName;
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

		if(document.frmsearch.min_date.value<"2012-07-25")
	{
		alert("Sorry!!!! Your minimum date is 2012-07-25.Please Select.");
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

if(document.frmsearch.cmbfeedback.selectedIndex >0 && document.frmsearch.lead_stat.selectedIndex >0)
{
	alert("You cant select Status & feedback together");
	return false;
}


}
function popitup(url) {
	newwindow=window.open(url,'name','height=280,width=200');
	if (window.focus) {newwindow.focus()}
	return false;
}

function MM_jumpMenu(targ,selObj,restore){ //v3.0
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
			
		var get_app_address = document.getElementById('Appt_Address_'+ id).value;
		var get_requestid= document.getElementById('requestid_'+ id).value;
		var get_bidderid= document.getElementById('bidderid').value;
		var get_FollowupDate= document.getElementById('FollowupDate_'+ id).value;
		var get_app_time= document.getElementById('app_time_'+ id).value;
			
		var queryString = "?get_app_address=" + get_app_address + "&get_FollowupDate=" + get_FollowupDate + "&get_requestid=" + get_requestid + "&get_app_time=" + get_app_time + "&get_bidderid=" + get_bidderid;
				
				alert(queryString); 
				ajaxRequest.open("GET", "insert_comment_icici_ccapptlms.php" + queryString, true);
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

<table width="100%" border="0"  align="center" cellpadding="0" cellspacing="0" >

<tr>
    <td align="center">
	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#45B2D8">
      <tr>
	  <td style="padding-top:15px;" align="center"><h1 style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; color:#052733; line-height:18px; font-weight:bold;">Welcome to Deal4loans LMS</h1></td>
     
	</tr>
	<tr><td>&nbsp;</td></tr>
 <tr><td align="center">
 
 <table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
   <tr>
     <td height="30" align="center" valign="middle"><img src="images/login-srch-pnl.gif" width="650" height="30"></td>
   </tr>
   <tr>
     <td align="center" valign="middle" background="images/login-form-login-bg.gif"><table width="95%" border="0"  cellpadding="1" cellspacing="0">
 <form name="frmsearch" action="icicicc_apptlmsview.php?search=y" method="post" onSubmit="return chkform();">
     <tr><td colspan="3">&nbsp;</td></tr>
  
   <tr>
   <td colspan="3" align="center">
   <table border="0" width="90%" cellpadding="0" cellspacing="0"><tr>
     <td width="20%" valign="middle" class="style1">&nbsp;&nbsp;Date&nbsp;&nbsp; From </td>
     <td width="24%" align="left" valign="middle" class="bidderclass" ><? $current_date=date('Y-m-d'); ?>
	   <input name="min_date" type="text" id="min_date" size="15" <? if($min_date=="") { ?>value="<? echo $current_date; ?>"<? } else { ?>value="<? echo $min_date; ?>" <? }?>></td>
	   <td>
       <input name="b12" type="button" class="bluebutton" onClick="javascript:pedirFecha(min_date,'');" value="&lt; Insert">  </td>
  
     <td valign="middle" align="center" class="style1" width="8%">To</td>
     <td align="left" valign="middle" class="style1" width="24%" >  <input name="max_date" type="text" id="max_date" size="15" value="<? echo $max_date; ?>"></td>
        <td> <input name="b122" type="button" class="bluebutton" onClick="javascript:pedirFecha(max_date,'');" value="&lt; Insert"></td>
	   </tr>
	   </table>
	   </td></tr>
    <tr><td colspan="3">&nbsp;</td></tr>
  <tr>
   <td colspan="3" align="center"><table border="0" cellpadding="0" cellspacing="0" width="95%">
     
	 <? if($_SESSION['BidderID']==3667) {?>
     <td width="9%"  valign="middle" class="bidderclass">City</td>
	  <td width="26%"  valign="middle" class="bidderclass"><select name="City" id="City" >
	  <option value="" <? if($strCity=="") { echo "Selected"; }?>>All</option>
	   <option value="3664" <? if($strCity=="3664") { echo "Selected"; }?>>Bangalore</option>
	 <option value="3665" <? if($strCity=="3665") { echo "Selected"; }?>>Chennai</option>
  <option value="3666" <? if($strCity=="3666") { echo "Selected"; }?>>Hyderabad</option>
 <option value="3662" <? if($strCity=="3662") { echo "Selected"; }?>>Mumbai</option>
 <option value="3663" <? if($strCity=="3663") { echo "Selected"; }?>>Pune</option>

 </select>
</td>
<? }  if($_SESSION['BidderID']!=3667) {?>
     <td width="9%"  valign="middle" class="bidderclass">Mobile</td>
	  <td width="26%"  valign="middle" class="bidderclass"><input type="text" name="mob_num" id="mob_num" value="<?php echo $mob_num; ?>" >
</td>
<? } ?>

<td width="11%" bgcolor="#CCCCCC">Feedback</td>
<td width="25%"><select name="cmbfeedback" id="cmbfeedback" style="width:120px;">
			<option value="All" <? if($varCmbFeedback == "All") { echo "selected"; } ?>>All</option>
			<option value="" <? if($varCmbFeedback == "") { echo "selected"; } ?>>No Feedback</option>
			<option value="Appointment Cancelled" <? if($varCmbFeedback == "Appointment Cancelled") { echo "selected"; } ?>>Appointment Cancelled</option>

			<option value="Appointment Postponed" <? if($varCmbFeedback == "Appointment Postponed") { echo "selected"; } ?>>Appointment Postponed</option>

			<option value="Documents Picked" <? if($varCmbFeedback == "Documents Picked") { echo "selected"; } ?>>Documents Picked</option>

			<option value="Partial Docs Picked" <? if($varCmbFeedback == "Partial Docs Picked") { echo "selected"; } ?>>Partial Docs Picked</option>
			
			<option value="Login" <? if($varCmbFeedback == "Login") { echo "selected"; } ?>>Login/WIP</option>

<option value="Booked" <? if($varCmbFeedback == "Booked") { echo "selected"; } ?>>Approved/Booked</option>

	<option value="Post Login Reject" <? if($varCmbFeedback == "Post Login Reject") { echo "selected"; } ?>>Post Login Reject</option>
	
</select></td>

   	  </tr>
</table></td></tr>
    
	  <td width="33%" colspan="3" align="center" valign="middle"><input name="Submit" type="image"  src="images/login-form-lgn-srch.gif" style="width:111px; height:35px; border:none;" border="0"></td>
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

		$result = ExecQuery("select ApptID from  ICICI_CCAppt_Details where AllRequestID=$RequestID and BidderID=".$_SESSION['BidderID']);		
		$num_rows = mysql_num_rows($result);
		if($num_rows > 0)
		{
			$row = mysql_fetch_array($result);
			$strSQL="Update  ICICI_CCAppt_Details Set Appt_Feedback='".$Feedback."'";
			$strSQL=$strSQL."Where ApptID=".$row["ApptID"];
		}
		else
		{
			
			$strSQL="Insert into  ICICI_CCAppt_Details(AllRequestID, BidderID, Reply_Type , Appt_Feedback) Values (";
			$strSQL=$strSQL.$RequestID.",".$_SESSION['BidderID'].",'4','".$Feedback."')";
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
			$FeedbackClause=" AND (ICICI_CCAppt_Details.Appt_Feedback IS NULL OR ICICI_CCAppt_Details.Appt_Feedback='') ";
		}
		else if($varCmbFeedback=="All")
		{
			$FeedbackClause="";
		}
		else
		{
			$FeedbackClause=" AND ICICI_CCAppt_Details.Appt_Feedback='".$varCmbFeedback."' ";
		}
		if($mob_num>0)
{
	$mob_num_clause = " AND Req_Credit_Card.Mobile_Number = '".$mob_num."' ";
}
?>
 <p class="bodyarial11"><?=$Msg?></p>
 <table width="1000" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#FFFFFF" >
<? 
		if($_SESSION['BidderID']==3667 && $strCity>0)
		{
			$strbidder=$strCity;
		}
		else
		{
			$strbidder=$_SESSION['BidderID'];
		}


if($_SESSION['BidderID']==3667 && $strCity=="")
	{
	
$search_qry="Select * from ICICI_CCAppt_Details LEFT OUTER JOIN Req_Credit_Card ON Req_Credit_Card.RequestID=ICICI_CCAppt_Details.AllRequestID Where (ICICI_CCAppt_Details.Appt_Dated between '".($min_date)."' and '".($max_date)."' and ICICI_CCAppt_Details.BidderID in (3662,3663,3664,3665,3666))";
$search_qry=$search_qry.$FeedbackClause;

	$qry="Select * from ICICI_CCAppt_Details LEFT OUTER JOIN Req_Credit_Card ON Req_Credit_Card.RequestID=ICICI_CCAppt_Details.AllRequestID Where (ICICI_CCAppt_Details.Appt_Dated between '".($min_date)."' and '".($max_date)."' and ICICI_CCAppt_Details.BidderID in (3662,3663,3664,3665,3666))";
	$qry=$qry.$FeedbackClause;
	$result=ExecQuery($qry);
	$recordcount = mysql_num_rows($result);
	}
	else
	{
		if($_SESSION['BidderID']==3667 && $strCity>0)
		{
			$strbidder=$strCity;
		}
		else
		{
			$strbidder=$_SESSION['BidderID'];
		}
		$search_qry="Select * from ICICI_CCAppt_Details LEFT OUTER JOIN Req_Credit_Card ON Req_Credit_Card.RequestID=ICICI_CCAppt_Details.AllRequestID Where (ICICI_CCAppt_Details.Appt_Dated between '".($min_date)."' and '".($max_date)."' and ICICI_CCAppt_Details.BidderID in (".$strbidder."))";	
		$search_qry=$search_qry.$FeedbackClause;
		$search_qry=$search_qry.$mob_num_clause;
	
	
	$qry="Select * from ICICI_CCAppt_Details LEFT OUTER JOIN Req_Credit_Card ON Req_Credit_Card.RequestID=ICICI_CCAppt_Details.AllRequestID Where (ICICI_CCAppt_Details.Appt_Dated between '".($min_date)."' and '".($max_date)."' and ICICI_CCAppt_Details.BidderID in (".$strbidder."))";
	$qry=$qry.$FeedbackClause;
	$qry=$qry.$mob_num_clause;
	$result=ExecQuery($qry);
	$recordcount = mysql_num_rows($result);
}
		//echo $qry."<br>";
?>
 <tr>
     <td colspan="11" style="border-bottom:1px solid #45B2D8;"><strong><? echo $startrow+1; ?> to <? echo min($startrow+$pagesize,$recordcount); ?> Out of <? echo $recordcount; ?> Records </strong>
     </tr>
	 
   <tr>
       <td width="72" align="center" bgcolor="#FFFFFF" class="style2">Name </td>
<td width="75" align="center" bgcolor="#FFFFFF" class="style2">Mobile </td>
<td width="75" align="center" bgcolor="#FFFFFF" class="style2">Net Salary </td>

<td width="120" align="center" bgcolor="#FFFFFF" class="style2">Card Name </td>
<td width="78" align="center" bgcolor="#FFFFFF" class="style2">Appt Feedback </td>
<td width="106" align="center" bgcolor="#FFFFFF" class="style2">Appointment Address </td>
<td width="102" align="center" bgcolor="#FFFFFF" class="style2">Appointment Time</td>
<td width="137" align="center" bgcolor="#FFFFFF" class="style2">Appointment Date</td>
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

if($_SESSION['BidderID']==3667 && $strCity=="")
		{
   $qry="Select * from ICICI_CCAppt_Details LEFT OUTER JOIN Req_Credit_Card ON Req_Credit_Card.RequestID=ICICI_CCAppt_Details.AllRequestID Where (ICICI_CCAppt_Details.Appt_Dated between '".($min_date)."' and '".($max_date)."' and ICICI_CCAppt_Details.BidderID in (3662,3663,3664,3665,3666))";
		$qry=$qry.$FeedbackClause;
		}
		else
		{
	$qry="Select * from ICICI_CCAppt_Details LEFT OUTER JOIN Req_Credit_Card ON Req_Credit_Card.RequestID=ICICI_CCAppt_Details.AllRequestID Where (ICICI_CCAppt_Details.Appt_Dated between '".($min_date)."' and '".($max_date)."' and ICICI_CCAppt_Details.BidderID in (".$strbidder."))";
$qry=$qry.$FeedbackClause;
		$qry=$qry.$mob_num_clause;
		}

		//echo $qry."<br>";
		$qry=$qry." LIMIT $startrow, $pagesize"; 

		//echo $qry."<br>"; 
		$result=ExecQuery($qry);

		$i=1;
		if($recordcount>0)
		{
		while($row=mysql_fetch_array($result))
		{																					$followup_date=$row['Appt_Date'];
		?>
		<input type="hidden" name="requestid_<? echo $i;?>" id="requestid_<? echo $i;?>" value="<? echo $row["RequestID"];?>">
		<input type="hidden" name="product_<? echo $i;?>" id="product_<? echo $i;?>" value="<? echo $pro_code;?>">
			<input type="hidden" name="bidderid" id="bidderid" value="<? echo $strbidder;?>">
  <tr>
  
     <td align="center" bgcolor="#DFF6FF" class="style3" ><? echo $row["Name"]; ?></td>
	  
     <td align="center" bgcolor="#DFF6FF" class="style3"><? echo $row["Mobile_Number"]; ?></td>
     <td align="center" bgcolor="#DFF6FF" class="style3"><? echo $row["Net_Salary"]; ?></td>

	 
      	  <td align="center" bgcolor="#DFF6FF" class="style3" width="107"><?
		  echo $row["Appt_card_name"];
 ?></td>

    <td align="center" bgcolor="#DFF6FF" class="style3"><? 
	if($_SESSION['BidderID']==3667)
		{
echo $row["Appt_Feedback"];
	}
			else
			{
	echo getJumpMenu("icicicc_apptlmsview.php",$row["RequestID"],"3",$row["Appt_Feedback"],$pageno,$varmin_date,$varmax_date,$varCmbFeedback);
			} ?>
	</td>
   
<td align="center" bgcolor="#DFF6FF" class="bodyarial11" >
<? if($_SESSION['BidderID']==3667)
		{
			echo $row["Appt_Address"]; 	
		}
		else
			{ ?>
<textarea  name="Appt_Address_<? echo $i;?>" id="Appt_Address_<? echo $i;?>" cols="15" rows="2"><? echo $row["Appt_Address"]; ?></textarea>
<? } ?>
</td>
 
 <td align="center" bgcolor="#DFF6FF" class="style3" ><? if($_SESSION['BidderID']==3667)
		{
echo $row["Appt_Time"];
	}
			else
			{ ?> <select name="app_time_<? echo $i;?>" id="app_time_<? echo $i;?>" tabindex="14"><option value="please select">Time slab</option>
<option value="Call Before Coming" <? if($row["Appt_Time"]=="Call Before Coming") { echo "Selected"; } ?> >Call Before Coming</option>					
<option value="8(am)-9(am)" <? if($row["Appt_Time"]=="8(am)-9(am)") { echo "Selected"; } ?>>8(am)-9(am)</option>
<option value="9(am)-10(am)" <? if($row["Appt_Time"]=="9(am)-10(am)") { echo "Selected"; } ?>>9(am)-10(am)</option>
<option value="10(am)-11(am)" <? if($row["Appt_Time"]=="10(am)-11(am)") { echo "Selected"; } ?>>10(am)-11(am)</option>
<option value="11(am)-12(am)" <? if($row["Appt_Time"]=="11(am)-12(am)") { echo "Selected"; } ?>>11(am)-12(am)</option>
<option value="12(am)-1(pm)" <? if($row["Appt_Time"]=="12(am)-1(pm)") { echo "Selected"; } ?>>12(am)-1(pm)</option>
<option value="1(pm)-2(pm)" <? if($row["Appt_Time"]=="1(pm)-2(pm)") { echo "Selected"; } ?>>1(pm)-2(pm)</option>
<option value="2(pm)-3(pm)" <? if($row["Appt_Time"]=="2(pm)-3(pm)") { echo "Selected"; } ?>>2(pm)-3(pm)</option>
<option value="3(pm)-4(pm)" <? if($row["Appt_Time"]=="3(pm)-4(pm)") { echo "Selected"; } ?>>3(pm)-4(pm)</option>
<option value="4(pm)-5(pm)" <? if($row["Appt_Time"]=="4(pm)-5(pm)") { echo "Selected"; } ?>>4(pm)-5(pm)</option>
<option value="5(pm)-6(pm)" <? if($row["Appt_Time"]=="5(pm)-6(pm)") { echo "Selected"; } ?>>5(pm)-6(pm)</option>
<option value="6(pm)-7(pm)" <? if($row["Appt_Time"]=="6(pm)-7(pm)") { echo "Selected"; } ?>>6(pm)-7(pm)</option>
<option value="7(pm)-8(pm)" <? if($row["Appt_Time"]=="7(pm)-8(pm)") { echo "Selected"; } ?>>7(pm)-8(pm)</option>
<option value="Any Time" <? if($row["Appt_Time"]=="Any Time") { echo "Selected"; } ?>>Any Time</option>

</select><? } ?></td>
<? if($_SESSION['BidderID']==3667)
		{ ?>
		<td align="center" bgcolor="#DFF6FF" class="bodyarial11" ><? echo $followup_date; ?>
		</td>
		 <? }
		else
			{
			?>
<td align="center" bgcolor="#DFF6FF" class="bodyarial11" ><table>
<tr>
 <td align="center" bgcolor="#DFF6FF" class="style3"><input type="Text"  name="FollowupDate_<? echo $i;?>" id="FollowupDate_<? echo $i;?>" maxlength="25" size="15" <?php if($followup_date !='0000-00-00 00:00:00') { ?>value="<?php  echo $followup_date; ?>" <?php } ?>><a href="javascript:NewCal('FollowupDate_<? echo $i;?>','yyyymmdd',false,24)"><img src="images/cal.gif" width="16" height="16" border="0" alt="Pick a date"></a></td><td><a onClick="insertData(<? echo $i;?>);" style="cursor:pointer; color:blue;" class="style3">Save</a></td></tr></table></td>
 <? } ?>
  </tr>
<? 
		 	$i=$i+1;
		}
		}?>	
   
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
   <!--<tr><td align="center"><table width="500" border="0" cellspacing="1" cellpadding="4">
 <form name="frmdownload" action="bidder_download.php" method="post">
   <tr>
     <td align="center">
	   <input type="hidden" name="qry1" value="<? //echo $search_qry; ?>">
	   <input type="hidden" name="qry2" value="<? //echo $val; ?>">
	 
	    <input type="hidden" name="min_date" value="<? //echo $min_date; ?>">
	   <input type="hidden" name="max_date" value="<? //echo $max_date; ?>">
	 <input name="Submit2" type="submit" class="bluebtn" value="Export List To Excel">
	 </td>
   </tr>
 </form>
 </table></td></tr>-->
 
 </table>
   <?
 }
 ?>
 </td></tr></table>
</td></tr></table>

<?
function getJumpMenu($varPHPPage, $varRequestID, $varType, $varFeedback, $varpageon, $varmindate, $varmaxdate,$cmbfeedback,$varVal)
{
	$strURL="";
	$strURL=$varPHPPage."?search=y&RequestID=".$varRequestID."&type=".$varType."&pageno=".$varpageon."&min_date=".urlencode($varmindate)."&max_date=".urlencode($varmaxdate)."&cmbfeedback=".urlencode($cmbfeedback);
?>
<select name="type" id="type" onChange="MM_jumpMenu('parent',this,0)" class="style3" style="width:110px;">
	<option value="<? echo $strURL.'&Feedback='?>" <? if($varFeedback == "") { echo "selected"; } ?> >No Feedback</option>
	<option value="<? echo $strURL.'&Feedback=Appointment Cancelled'?>" <? if($varFeedback == "Appointment Cancelled") { echo "selected"; } ?> >Appointment Cancelled</option>

<option value="<? echo $strURL.'&Feedback=Appointment Postponed'?>" <? if($varFeedback == "Appointment Postponed") { echo "selected"; } ?>>Appointment Postponed</option>

	<option value="<? echo $strURL.'&Feedback=Documents Picked'?>" <? if($varFeedback == "Documents Picked") { echo "selected"; } ?>>Documents Picked</option>

	<option value="<? echo $strURL.'&Feedback=Partial Docs Picked'?>" <? if($varFeedback == "Partial Docs Picked") { echo "selected"; } ?>>Partial Docs Picked</option>

	<option value="<? echo $strURL.'&Feedback=Login'?>" <? if($varFeedback == "Login") { echo "selected"; } ?>>Login/WIP</option>

	<option value="<? echo $strURL.'&Feedback=Booked'?>" <? if($varFeedback == "Booked") { echo "selected"; } ?>>Approved/Booked</option>
	<option value="<? echo $strURL.'&Feedback=Post Login Reject'?>" <? if($varFeedback == "Post Login Reject") { echo "selected"; } ?>>Post Login Reject</option>
	
</select>
	
<?
}

?>
</body>

</html>
