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

	$mob_num="";
	if(isset($_REQUEST['mob_num']))
	{
		$mob_num = $_REQUEST['mob_num'];
	}

$strCity="";
if(isset($_REQUEST['City']))
	{
		$strCity=$_REQUEST['City'];
	}
	echo $strCity."<br>";

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
	document.frmsearch.action="icici_cardslmsview.php?search=y"+gifName;
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
			
		var get_comment_section = document.getElementById('comment_section_'+ id).value;
		var get_requestid= document.getElementById('requestid_'+ id).value;
		var get_product= document.getElementById('product_'+ id).value;
		var get_bidderid= document.getElementById('bidderid').value;
		
		var queryString = "?comment_section=" + get_comment_section + "&get_requestid=" + get_requestid + "&get_product=" + get_product + "&get_bidderid=" + get_bidderid;
				
			//	alert(queryString); 
				ajaxRequest.open("GET", "insert_comment_icici_cclms.php" + queryString, true);
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
 <form name="frmsearch" action="icici_cardslmsview.php?search=y" method="post" onSubmit="return chkform();">
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
     
	 <? if($_SESSION['BidderID']==3190) {?>
     <td width="9%"  valign="middle" class="bidderclass">City</td>
	  <td width="26%"  valign="middle" class="bidderclass"><select name="City" id="City" >
	  <option value="" <? if($strCity=="") { echo "Selected"; }?>>All</option>
	  <option value="3478" <? if($strCity=="3478") { echo "Selected"; }?>>Ahmedabad</option>
	  <option value="3179" <? if($strCity=="3179") { echo "Selected"; }?>>Bangalore</option>
	  <option value="3492" <? if($strCity=="3492") { echo "Selected"; }?>>Bharuch</option>
	  <option value="3479" <? if($strCity=="3479") { echo "Selected"; }?>>Chandigarh</option>
 <option value="3183" <? if($strCity=="3183") { echo "Selected"; }?>>Chennai</option>
 <option value="3481" <? if($strCity=="3481") { echo "Selected"; }?>>Cochin</option>
 <option value="3184" <? if($strCity=="3184") { echo "Selected"; }?>>Delhi</option>
    <option value="3501" <? if($strCity=="3501") { echo "Selected"; }?>>Gandhidham</option>
 <option value="3185" <? if($strCity=="3185") { echo "Selected"; }?>>Hyderabad</option>
 <option value="3480" <? if($strCity=="3480") { echo "Selected"; }?>>Indore</option>
 <option value="3186" <? if($strCity=="3186") { echo "Selected"; }?>>Jaipur</option>
 <option value="3493" <? if($strCity=="3493") { echo "Selected"; }?>>Jamnagar</option>
 <option value="3187" <? if($strCity=="3187") { echo "Selected"; }?>>Mumbai</option>
 <option value="3188" <? if($strCity=="3188") { echo "Selected"; }?>>Kolkata</option>
 <option value="3189" <? if($strCity=="3189") { echo "Selected"; }?>>Pune</option>
      <option value="3502" <? if($strCity=="3502") { echo "Selected"; }?>>Rajkot</option>
 <option value="3494" <? if($strCity=="3494") { echo "Selected"; }?>>Surat</option>
 <option value="3495" <? if($strCity=="3495") { echo "Selected"; }?>>Trivandrum</option>
  <option value="3491" <? if($strCity=="3491") { echo "Selected"; }?>>Vadodara</option>
 </select>
</td>
<? } ?>
<? if($_SESSION['BidderID']!=3190) {?>
     <td width="9%"  valign="middle" class="bidderclass">Mobile</td>
	  <td width="26%"  valign="middle" class="bidderclass"><input type="text" name="mob_num" id="mob_num" value="<?php echo $mob_num; ?>" >
</td>
<? } ?>
<td width="9%" bgcolor="#CCCCCC">Status</td>
<td width="15%" ><select name="lead_stat" id="lead_stat"><option value="0" <? if($lead_stat == "0") { echo "selected"; } ?>>select</option><option value="1" <? if($lead_stat == "1") { echo "selected"; } ?>>Open</option><option value="2" <? if($lead_stat == "2") { echo "selected"; } ?>>Closed</option></select></td>
<td width="5%"><b> OR </b></td>
<td width="11%" bgcolor="#CCCCCC">Feedback</td>
<td width="25%"><select name="cmbfeedback" id="cmbfeedback" style="width:120px;">
<option value="select" <? if($varCmbFeedback == "select") { echo "selected"; } ?> >Select</option>
			<option value="All" <? if($varCmbFeedback == "All") { echo "selected"; } ?>>All</option>
			<option value="" <? if($varCmbFeedback == "") { echo "selected"; } ?>>No Feedback</option>
			<option value="FollowUp" <? if($varCmbFeedback == "FollowUp") { echo "selected"; } ?>>FollowUp</option>
			<option value="Booked" <? if($varCmbFeedback == "Booked") { echo "selected"; } ?>>Approved/Booked</option>
			<option value="Not Eligible" <? if($varCmbFeedback == "Not Eligible") { echo "selected"; } ?>>Not Eligible</option>
			<option value="Not Interested" <? if($varCmbFeedback == "Not Interested") { echo "selected"; } ?>>Not Interested</option>		
			<option value="Logged In" <? if($varCmbFeedback == "Logged In") { echo "selected"; } ?>>Logged In</option>
<option value="Wrong Number" <? if($varCmbFeedback == "Wrong Number") { echo "selected"; } ?>>Wrong Number</option>
	<option value="Not contactable" <? if($varCmbFeedback == "Not contactable") { echo "selected"; } ?>>Not Contactable</option>
	<option value="Applied Thru Other Channel" <? if($varCmbFeedback == "Applied Thru Other Channel") { echo "selected"; } ?>>Applied Thru Other Channel</option>
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

		$result = ExecQuery("select FeedbackID from Req_Feedback_CC where AllRequestID=$RequestID and BidderID=".$_SESSION['BidderID']);		
		$num_rows = mysql_num_rows($result);
		if($num_rows > 0)
		{
			$row = mysql_fetch_array($result);
			$strSQL="Update Req_Feedback_CC Set Feedback='".$Feedback."'";
			$strSQL=$strSQL."Where FeedbackID=".$row["FeedbackID"];
		}
		else
		{
			
			$strSQL="Insert into Req_Feedback_CC(AllRequestID, BidderID, Reply_Type , Feedback) Values (";
			$strSQL=$strSQL.$RequestID.",".$_SESSION['BidderID'].",".$pro_code.",'".$Feedback."')";
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
		
if($varCmbFeedback!="select")
		{
		if(strlen(trim($varCmbFeedback))==0)
		{
			$FeedbackClause=" AND (Req_Feedback_CC.Feedback IS NULL OR Req_Feedback_CC.Feedback='') ";
		}
		else if($varCmbFeedback=="All")
		{
			$FeedbackClause=" ";
		}
		else
		{
			$FeedbackClause=" AND Req_Feedback_CC.Feedback='".$varCmbFeedback."' ";
		}
		}
		else
		{
			if(isset($lead_stat) && ($lead_stat==1 || $lead_stat==2))
			{
				if($lead_stat==1)
			{
				$FeedbackClause=" AND (Req_Feedback_CC.Feedback='FollowUp' OR Req_Feedback_CC.Feedback IS NULL OR Req_Feedback_CC.Feedback='' OR Req_Feedback_CC.Feedback='Logged In' OR Req_Feedback_CC.Feedback='No Feedback') ";
			}
			else if ($lead_stat==2)
			{
				$FeedbackClause=" AND (Req_Feedback_CC.Feedback!='FollowUp' and Req_Feedback_CC.Feedback!='') ";
			}
			}

		}
if($mob_num>0)
{
	$mob_num_clause = " AND Req_Credit_Card.Mobile_Number = '".$mob_num."' ";
}
?>
 <p class="bodyarial11"><?=$Msg?></p>
 <table width="950" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#FFFFFF" >
<? 
		if($_SESSION['BidderID']==3190 && $strCity>0)
		{
			$strbidder=$strCity;
		}
		else
		{
			$strbidder=$_SESSION['BidderID'];
		}

$getfields="Existing_Relationship,Account_No,RequestID,Name,Mobile_Number,Allocation_Date,Net_Salary,Company_Name,Loan_Amount,Employment_Status,Feedback,comment_section,City";
if($_SESSION['BidderID']==3190 && $strCity=="")
	{
	
$search_qry="SELECT * FROM Req_Feedback_Bidder_CC,`".$val."` LEFT OUTER JOIN Req_Feedback_CC ON Req_Feedback_CC.AllRequestID=".$val.".RequestID AND Req_Feedback_CC.BidderID in (3183,3184,3185,3186,3187,3188,3189,3179,3478,3479,3480,3481,3491,3492,3493,3494,3495,3501,3502) WHERE Req_Feedback_Bidder_CC.AllRequestID=`".$val."`.RequestID and Req_Feedback_Bidder_CC.BidderID in (3183,3184,3185,3186,3187,3188,3189,3179,3478,3479,3480,3481,3491,3492,3493,3494,3495,3501,3502) and Req_Feedback_Bidder_CC.Reply_Type=".$pro_code." and (Req_Feedback_Bidder_CC.Allocation_Date Between '".($min_date)."' and '".($max_date)."' or Req_Feedback_CC.Followup_Date Between '".($min_date)."' and '".($max_date)."') ";

$search_qry=$search_qry.$FeedbackClause;
	$search_qry=$search_qry."group by ".$val.".Mobile_Number";
	$search_qry=$search_qry." order by ".$val.".Dated DESC";

	$qry="SELECT RequestID FROM Req_Feedback_Bidder_CC,`".$val."` LEFT OUTER JOIN Req_Feedback_CC ON Req_Feedback_CC.AllRequestID=".$val.".RequestID AND Req_Feedback_CC.BidderID in (3183,3184,3185,3186,3187,3188,3189,3179,3478,3479,3480,3481,3491,3492,3493,3494,3495,3501,3502) WHERE Req_Feedback_Bidder_CC.AllRequestID=`".$val."`.RequestID and Req_Feedback_Bidder_CC.BidderID in (3183,3184,3185,3186,3187,3188,3189,3179,3478,3479,3480,3481,3491,3492,3493,3494,3495,3501,3502) and Req_Feedback_Bidder_CC.Reply_Type=".$pro_code." and (Req_Feedback_Bidder_CC.Allocation_Date Between '".($min_date)."' and '".($max_date)."' or Req_Feedback_CC.Followup_Date Between '".($min_date)."' and '".($max_date)."') ";
	$qry=$qry.$FeedbackClause;
	$qry=$qry."group by ".$val.".Mobile_Number";
	$result=ExecQuery($qry);
	$recordcount = mysql_num_rows($result);
	}
	else
	{
		if($_SESSION['BidderID']==3190 && $strCity>0)
		{
			$strbidder=$strCity;
		}
		else
		{
			$strbidder=$_SESSION['BidderID'];
		}
		$search_qry="SELECT * FROM Req_Feedback_Bidder_CC,`".$val."` LEFT OUTER JOIN Req_Feedback_CC ON Req_Feedback_CC.AllRequestID=".$val.".RequestID AND Req_Feedback_CC.BidderID in (".$strbidder.") WHERE Req_Feedback_Bidder_CC.AllRequestID=`".$val."`.RequestID and Req_Feedback_Bidder_CC.BidderID in (".$strbidder.") and Req_Feedback_Bidder_CC.Reply_Type=".$pro_code." and (Req_Feedback_Bidder_CC.Allocation_Date Between '".($min_date)."' and '".($max_date)."' or Req_Feedback_CC.Followup_Date Between '".($min_date)."' and '".($max_date)."') ";	
		$search_qry=$search_qry.$FeedbackClause;
		$search_qry=$search_qry.$mob_num_clause;
		
	$search_qry=$search_qry."group by ".$val.".Mobile_Number";
	$search_qry=$search_qry." order by ".$val.".Dated DESC";

	$qry="SELECT RequestID FROM Req_Feedback_Bidder_CC,`".$val."` LEFT OUTER JOIN Req_Feedback_CC ON Req_Feedback_CC.AllRequestID=".$val.".RequestID AND Req_Feedback_CC.BidderID in (".$strbidder.") WHERE Req_Feedback_Bidder_CC.AllRequestID=`".$val."`.RequestID and Req_Feedback_Bidder_CC.BidderID in (".$strbidder.") and Req_Feedback_Bidder_CC.Reply_Type=".$pro_code." and (Req_Feedback_Bidder_CC.Allocation_Date Between '".($min_date)."' and '".($max_date)."' or Req_Feedback_CC.Followup_Date Between '".($min_date)."' and '".($max_date)."') ";
	$qry=$qry.$FeedbackClause;
	$qry=$qry.$mob_num_clause;
	$qry=$qry."group by ".$val.".Mobile_Number";
	$result=ExecQuery($qry);
	$recordcount = mysql_num_rows($result);

	
	}
		//echo $qry."<br>";
?>
 <tr>
     <td colspan="10" style="border-bottom:1px solid #45B2D8;"><strong><? echo $startrow+1; ?> to <? echo min($startrow+$pagesize,$recordcount); ?> Out of <? echo $recordcount; ?> Records </strong>
     </tr>
	 
   <tr>
       <td width="141" align="center" bgcolor="#FFFFFF" class="style2">Name </td>
<td width="141" align="center" bgcolor="#FFFFFF" class="style2">City </td>
<td width="141" align="center" bgcolor="#FFFFFF" class="style2">Mobile </td>
<td width="141" align="center" bgcolor="#FFFFFF" class="style2">Net Salary </td>
<td width="141" align="center" bgcolor="#FFFFFF" class="style2">Company Name </td>
<td width="141" align="center" bgcolor="#FFFFFF" class="style2">Employment Status </td>
<td width="141" align="center" bgcolor="#FFFFFF" class="style2">File Status</td>
<td width="141" align="center" bgcolor="#FFFFFF" class="style2">Feedback </td>
<td width="141" align="center" bgcolor="#FFFFFF" class="style2">Add Comment </td>
<td width="141" align="center" bgcolor="#FFFFFF" class="style2">Documents</td>
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

if($_SESSION['BidderID']==3190 && $strCity=="")
		{
   $qry="SELECT ".$getfields." FROM Req_Feedback_Bidder_CC,`".$val."` LEFT OUTER JOIN Req_Feedback_CC ON Req_Feedback_CC.AllRequestID=".$val.".RequestID AND Req_Feedback_CC.BidderID in (3183,3184,3185,3186,3187,3188,3189,3179,3478,3479,3480,3481,3491,3492,3493,3494,3495,3501,3502) WHERE Req_Feedback_Bidder_CC.AllRequestID=`".$val."`.RequestID and Req_Feedback_Bidder_CC.BidderID in (3183,3184,3185,3186,3187,3188,3189,3179,3478,3479,3480,3481,3491,3492,3493,3494,3495,3501,3502) and Req_Feedback_Bidder_CC.Reply_Type=".$pro_code." and (Req_Feedback_Bidder_CC.Allocation_Date Between '".($min_date)."' and '".($max_date)."' or Req_Feedback_CC.Followup_Date Between '".($min_date)."' and '".($max_date)."') ";
		$qry=$qry.$FeedbackClause;
		}
		else
		{
	$qry="SELECT ".$getfields." FROM Req_Feedback_Bidder_CC,`".$val."` LEFT OUTER JOIN Req_Feedback_CC ON Req_Feedback_CC.AllRequestID=".$val.".RequestID AND Req_Feedback_CC.BidderID in (".$strbidder.") WHERE Req_Feedback_Bidder_CC.AllRequestID=`".$val."`.RequestID and Req_Feedback_Bidder_CC.BidderID in (".$strbidder.") and Req_Feedback_Bidder_CC.Reply_Type=".$pro_code." and (Req_Feedback_Bidder_CC.Allocation_Date Between '".($min_date)."' and '".($max_date)."' or Req_Feedback_CC.Followup_Date Between '".($min_date)."' and '".($max_date)."') ";

		}
		
		$qry=$qry.$FeedbackClause;
		$qry=$qry.$mob_num_clause;
		$qry=$qry."group by ".$val.".Mobile_Number";
		$qry=$qry." order by ".$val.".Dated DESC";
		$qry=$qry." LIMIT $startrow, $pagesize"; 

		//echo $qry."<br>"; 
		$result=ExecQuery($qry);

		$i=1;
		if($recordcount>0)
		{
		while($row=mysql_fetch_array($result))
		{																								
		?>
		<input type="hidden" name="requestid_<? echo $i;?>" id="requestid_<? echo $i;?>" value="<? echo $row["RequestID"];?>">
		<input type="hidden" name="product_<? echo $i;?>" id="product_<? echo $i;?>" value="<? echo $pro_code;?>">
			<input type="hidden" name="bidderid" id="bidderid" value="<? echo $strbidder;?>">
  <tr>
  
     <td align="center" bgcolor="#DFF6FF" class="style3" ><? echo $row["Name"]; ?></td>
	  <td align="center" bgcolor="#DFF6FF" class="style3"><? echo $row["City"]; ?></td>
     <td align="center" bgcolor="#DFF6FF" class="style3"><? echo $row["Mobile_Number"]; ?></td>
     <td align="center" bgcolor="#DFF6FF" class="style3"><? echo $row["Net_Salary"]; ?></td>
	  <td align="center" bgcolor="#DFF6FF" class="style3"><? echo $row["Company_Name"]; ?></td>
	  <td align="center" bgcolor="#DFF6FF" class="style3"><? if($row["Employment_Status"]==1) { echo "Salaried";} else { echo "Se;f Employed";} ?></td>
<td align="center" bgcolor="#DFF6FF" class="style3">
 <? if($row["Feedback"]=="" || $row["Feedback"]=="FollowUp" || $row["Feedback"]=="Logged In") { echo "Open"; }?>
<? if($row["Feedback"]!="" && $row["Feedback"]!="FollowUp" && $row["Feedback"]!="Logged In") { echo "Closed"; }?>

</td>
    <td align="center" bgcolor="#DFF6FF" class="style3"><? 
	if($_SESSION['BidderID']==3190)
		{
echo $row["Feedback"];
	}
			else
			{
	echo getJumpMenu("icici_cardslmsview.php",$row["RequestID"],"3",$row["Feedback"],$pageno,$varmin_date,$varmax_date,$varCmbFeedback);
			} ?>
	</td>
<td align="center" bgcolor="#DFF6FF" class="bodyarial11" >
<? if($_SESSION['BidderID']==3190)
		{
			echo $row["comment_section"]; 	
		}
		else
			{ ?>
<table width="100%"><tr><td><textarea  name="comment_section_<? echo $i;?>" id="comment_section_<? echo $i;?>" cols="15" rows="2"><? echo $row["comment_section"]; ?></textarea></td><td><a onClick="insertData(<? echo $i;?>);" style="cursor:pointer; color:blue;" class="style3">Save</a></td></tr></table>
<? } ?>
</td>
<td align="center" bgcolor="#DFF6FF" class="style3">
<? $checkDocsSqlcc = "select Bank_Statement from upload_documents where (RequestID='".$row["RequestID"]."' and Reply_Type=4)";
		$checkDocsQuerycc = ExecQuery($checkDocsSqlcc);
		$numcheckDocscc = mysql_num_rows($checkDocsQuerycc);
		if($numcheckDocscc>0)
		{
		?>
    <a href="download-documents.php?Lid=<?php echo $row["RequestID"]; ?>&Prid=<? echo $pro_code; ?>" onClick="return popitup('download-documents.php?Lid=<?php echo $row["RequestID"]; ?>&Prid=<? echo $pro_code; ?>')">Documents</a></td>
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
   <tr><td align="center"><table width="500" border="0" cellspacing="1" cellpadding="4">
 <form name="frmdownload" action="bidder_download.php" method="post">
   <tr>
     <td align="center">
	   <input type="hidden" name="qry1" value="<? echo $search_qry; ?>">
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
	<option value="<? echo $strURL.'&Feedback=FollowUp'?>" <? if($varFeedback == "FollowUp") { echo "selected"; } ?> >FollowUp</option>
<option value="<? echo $strURL.'&Feedback=Not Interested'?>" <? if($varFeedback == "Not Interested") { echo "selected"; } ?>>Not Interested</option>
	<option value="<? echo $strURL.'&Feedback=Not Eligible'?>" <? if($varFeedback == "Not Eligible") { echo "selected"; } ?>>Not Eligible</option>
	<option value="<? echo $strURL.'&Feedback=Logged In'?>" <? if($varFeedback == "Logged In") { echo "selected"; } ?>>Logged In</option>
	
	<option value="<? echo $strURL.'&Feedback=Not contactable'?>" <? if($varFeedback == "Not contactable") { echo "selected"; } ?>>Not contactable</option>
	<option value="<? echo $strURL.'&Feedback=Wrong Number'?>" <? if($varFeedback == "Wrong Number") { echo "selected"; } ?>>Wrong Number</option>
	<option value="<? echo $strURL.'&Feedback=Applied thru other channel'?>" <? if($varFeedback == "Applied thru other channel") { echo "selected"; } ?>>Applied Thru Other Channel</option>
	<option value="<? echo $strURL.'&Feedback=Booked'?>" <? if($varFeedback == "Booked") { echo "selected"; } ?>>Approved/Booked</option>
    <option value="<? echo $strURL.'&Feedback=Post Login Reject'?>" <? if($varFeedback == "Post Login Reject") { echo "selected"; } ?>>Post Login Reject</option>
</select>
	
<?
}

?>
</body>

</html>
