<?php
require 'scripts/session_check_online.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';
//define("ENABLELOGIN", 1);
//for session variables
foreach ($_SESSION as $key=>$val)
 $sessionVar.= $key." ".$val."\n";
//print_r($_SESSION);
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
$salarywise="";
	if(isset($_REQUEST['salarywise']))
	{
		$salarywise = $_REQUEST['salarywise'];
	}

$loanwise="";
	if(isset($_REQUEST['loanwise']))
	{
		$loanwise= $_REQUEST['loanwise'];
	}

	
$bankwise="";
	if(isset($_REQUEST['bankwise']))
	{
		$bankwise = $_REQUEST['bankwise'];
	}
	
	$FeedbackClause="";
	$bankwiseClause ="";

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
	
echo "<table width='100%' border='0' cellspacing='0' cellpadding='0'><tr><td width='323' height='93' align='left' valign='top'  ><img src='http://www.deal4loans.com/images/login-logo.gif' width='323' height='93' /></td><td align='left' valign='top' style='color:#0B6FCC;' ><table width='100%' border='0' cellspacing='0' cellpadding='0' bgcolor='#0A92C0'><tr><td height='67' align='right' valign='middle' bgcolor='#C8E3F3' style='padding-right:10px;'><table border='0' align='right' cellpadding='0' cellspacing='0' bgcolor='#0A92C0'><tr><td width='6' height='32' align='left' valign='top'><img  src='http://www.deal4loans.com/images/login-form-logut-lft.gif' width='6' height='32' /></td><td background='http://www.deal4loans.com/rnew/images/login-form-logut-bg.gif' style=' background-repeat:repeat-x; height:32px;'><table width='100%' border='0' align='center' cellpadding='0' cellspacing='0'><tr><td align='left' valign='middle' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#FFFFFF; font-weight:bold; padding-right:15px;' > Welcome ".ucwords($_SESSION['UserType'])." ".$_SESSION['UName']."</td><td align='left' style='padding-right:2px;' width='22'><img src='http://www.deal4loans.com/images/login-logut-btn.gif' /></td><td align='right' class='style1' style='color:#FFFFFF; font-weight:bold;'><div align='right' class='style1' style='color:#FFFFFF; font-weight:bold;'> <a href='Logout.php' style='color:#FFFFFF; font-size:13px; text-decoration:none; font-family:Verdana, Arial, Helvetica, sans-serif;'>Logout</a></div></td></tr></table></td><td width='6' height='32'><img src='http://www.deal4loans.com/images/login-form-logut-rgt.gif' width='6' height='32' /></td></tr></table></td></tr><tr><td>&nbsp;</td></tr></table></td></tr></table>";
	
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
	document.frmsearch.action="leads_consolidate.php?search=y"+gifName;
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
<table width="100%" border="0"  align="center" cellpadding="0" cellspacing="0" >
<tr>
    <td align="center">
	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#45B2D8">
    
	
 <tr><td align="center"> 
 <table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
   <tr>
     <td height="30" align="center" valign="middle"><img src="images/login-srch-pnl.gif" width="650" height="30"></td>
   </tr>
   <tr>
     <td align="center" valign="middle" background="images/login-form-login-bg.gif"><table width="95%" border="0"  cellpadding="1" cellspacing="0">
 <form name="frmsearch" action="leads_consolidate.php?search=y" method="post" onSubmit="return chkform();">
  <input type="hidden" name="BidderIDstatic" id="BidderIDstatic" value="<? echo $BidderIDstatic;?>">
   <tr><td colspan="4">&nbsp;</td></tr>
   <tr>
   <td colspan="4" align="center">
   <table border="0" width="90%" cellpadding="0" cellspacing="0"><tr>
     <td width="20%" valign="middle" class="style1">&nbsp;&nbsp;Date&nbsp;&nbsp; From </td>
     <td width="24%" align="left" valign="middle" class="bidderclass" ><? $current_date=date('Y-m-d');?> 
	   <input name="min_date" type="text" id="min_date" size="15" value="<? echo $min_date; ?>"></td>
	   <td>
       <input name="b12" type="button" class="bluebutton" onClick="javascript:pedirFecha(min_date,'');" value="&lt; Insert">  </td>
       <td valign="middle" align="center" class="style1" width="8%">To</td>
     <td align="left" valign="middle" class="style1" width="24%" >  <input name="max_date" type="text" id="max_date" size="15" value="<? echo $max_date; ?>"></td>
        <td> <input name="b122" type="button" class="bluebutton" onClick="javascript:pedirFecha(max_date,'');" value="&lt; Insert"></td>
	   </tr>
	   </table>
	   </td></tr>
<tr><td valign="middle"  colspan="2">&nbsp;</td></tr>
<tr><td width="18%" valign="middle" style="padding-left:20px;" class="style1" >Feedback:</td>
		 <td width="44%" align="left" valign="middle" class="bidderclass">
    	<select name="cmbfeedback" id="cmbfeedback" style="width:190px;">
		<option value="All" <? if($varCmbFeedback == "All") { echo "selected"; } ?>>All Leads</option>
		<option value="NoFeedback" <? if($varCmbFeedback == "NoFeedback") { echo "selected"; } ?>>No Feedback</option>		
        <option value="Leads with Feedback" <? if($varCmbFeedback == "Leads with Feedback") { echo "selected"; } ?>>Leads with Feedback</option>
		<option value="Not Eligible" <? if($varCmbFeedback == "Not Eligible") { echo "selected"; } ?>>Not Eligible</option>
		<option value="Not Interested" <? if($varCmbFeedback == "Not Interested") { echo "selected"; } ?>>Not Interested</option>
		<option value="Not Contactable" <? if($varCmbFeedback == "Not Contactable") { echo "selected"; } ?>>Not Contactable</option>
	    <option value="FollowUp" <? if($varCmbFeedback == "FollowUp") { echo "selected"; } ?>>FollowUp</option>
		<option value="Documents Pick" <? if($varCmbFeedback == "Documents Pick") { echo "selected"; } ?>>Documents Pick</option>
		<option value="Loan Rejected" <? if($varCmbFeedback == "Loan Rejected") { echo "selected"; } ?>>Loan Rejected</option>
		<option value="Appointment" <? if($varCmbFeedback == "Appointment") { echo "selected"; } ?>>Appointment</option>
		<option value="Login/WIP" <? if($varCmbFeedback == "Login/WIP") { echo "selected"; } ?>>Login/WIP</option>
		<option value="Disbursed" <? if($varCmbFeedback == "Disbursed") { echo "selected"; } ?>>Disbursed</option>
		<option value="Post Login Reject" <? if($varCmbFeedback == "Post Login Reject") { echo "selected"; } ?>>Post Login Reject</option>
		</select>	 </td><td width="14%"  class="style1">Bank Wise:&nbsp;&nbsp;</td><td width="24%"> 	<select name="bankwise" id="bankwise" style="width:145px;">
		<option value="All" <? if($bankwise == "All") { echo "selected"; } ?>>All Banks</option>
       <?php 
	   $getBankSql = "select leadmapid, bank_individual_id, bank_name from smspl_mapping_bidderlms";
	   $getBankQuery = ExecQuery($getBankSql);
	   $getBankNumRows = mysql_num_rows($getBankQuery);
	   $selected = '';
	   for($i=0;$i<$getBankNumRows;$i++)
	   {
		  $selected = '';
		  $leadmapid = mysql_result($getBankQuery,$i,'leadmapid');
		  $bank_name = mysql_result($getBankQuery,$i,'bank_name');
		  if($bankwise==$leadmapid)
		  {
		  	$selected = 'selected';
		  }
	 	?>
       <option value="<? echo $leadmapid; ?>" <? echo $selected; ?>><? echo $bank_name; ?></option>        
        <?php
	   }
	   
	   ?>
<option value="ICICI" <? if($bankwise == "ICICI") { echo "selected"; } ?>>ICICI Bank</option>
		
		</select>	 </td><td width="0%" colspan="2"></td></tr>
		
<tr><td valign="middle">&nbsp;</td></tr>

  <tr>
       <td width="18%" align="center"  valign="middle" class="bidderclass">Salary</td>
	  <td width="44%"  valign="middle" class="bidderclass" >
	  <select name="salarywise" id="salarywise" style="width:145px;">
		<option value="All" <? if($salarywise == "All") { echo "selected"; } ?>>All</option>
		<option value="1" <? if($salarywise == "1") { echo "selected"; } ?>>Upto 6 Lacs</option>
		<option value="2" <? if($salarywise == "2") { echo "selected"; } ?>>6 Lacs - 9 Lacs</option>
		<option value="3" <? if($salarywise == "3") { echo "selected"; } ?>>Above 9 Lacs</option>
	  </select>
<td width="18%" align="center"  valign="middle" class="bidderclass">Loan Amount</td>
	  <td width="44%"  valign="middle" class="bidderclass"> <select name="loanwise" id="loanwise" style="width:145px;">
		<option value="All" <? if($loanwise == "All") { echo "selected"; } ?>>All</option>
		<option value="1" <? if($loanwise == "1") { echo "selected"; } ?>>Upto 5 Lacs</option>
		<option value="2" <? if($loanwise == "2") { echo "selected"; } ?>>5 Lacs - 10 Lacs</option>
		<option value="3" <? if($loanwise == "3") { echo "selected"; } ?>>Above 10 Lacs</option>
	  </select>

</td></tr>

  <tr>
       <td width="18%" align="center"  valign="middle" class="bidderclass">Search with Mobile no</td>
	  <td width="44%"  valign="middle" class="bidderclass" ><input type="text" name="mob_num" id="mob_num" value="<?php echo $mob_num; ?>" ><td width="18%" align="center"  valign="middle" class="bidderclass">Search with Reference No</td>
	  <td width="44%"  valign="middle" class="bidderclass"><input type="text" name="refernce_no" id="refernce_no" value="<?php echo $refernce_no; ?>" >
</td></tr>
   <tr>
      <td colspan="4" align="center" valign="middle"><input name="Submit" type="image"  src="images/login-form-lgn-srch.gif" style="width:111px; height:35px; border:none;" border="0"></td>
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
	
	if($search=="y")
	{
	//	print_r($_POST);
		//echo "<br>";
		$val= getTableName(1);
		$pro_code = 1;
		$min_date=$min_date." 00:00:00";
		$max_date=$max_date." 23:59:59";
		
		if(strlen(trim($varCmbFeedback))==0)
		{
			$FeedbackClause=" AND (Req_Feedback_Comments_PL.Feedback IS NULL OR Req_Feedback.Feedback='' OR Req_Feedback.Feedback='No Feedback') ";
		}
		else if($varCmbFeedback=="All")
		{
			$FeedbackClause=" ";
		}
		else if($varCmbFeedback=="NoFeedback")
		{
			$FeedbackClause=" AND Req_Feedback_Comments_PL.Feedback='' ";
		}
		else if ($varCmbFeedback =="Leads with Feedback")
		{
			$FeedbackClause=" AND Req_Feedback_Comments_PL.Feedback!='' ";
		}
		else
		{
			$FeedbackClause=" AND Req_Feedback_Comments_PL.Feedback='".$varCmbFeedback."' ";
		}
		
		if($mob_num>0)
		{
			$mob_num_clause = " AND `".$val."`.Mobile_Number = '".$mob_num."' ";
		}
		$loanwiseClause="";

		if($loanwise==1)
		{
			$loanwiseClause=" AND (`".$val."`.Loan_Amount<500000) ";
		}
		else if($loanwise==2)
		{
			$loanwiseClause=" AND (`".$val."`.Loan_Amount>=500000 AND `".$val."`.Loan_Amount<1000000 ) ";
		}
		else if($loanwise==3)
		{
			$loanwiseClause=" AND (`".$val."`.Loan_Amount>=1000000) ";
		}
		else
		{
			$loanwiseClause=' ';
		}
$salarywiseClause="";

		if($salarywise==1)
		{
			$salarywiseClause=" AND (`".$val."`.Net_Salary<600000) ";
		}
		else if($salarywise==2)
		{
			$salarywiseClause=" AND (`".$val."`.Net_Salary>=600000 AND `".$val."`.Net_Salary<900000 ) ";
		}
		else if($salarywise==3)
		{
			$salarywiseClause=" AND (`".$val."`.Net_Salary>=900000) ";
		}
		else
		{
			$salarywiseClause=' ';
		}


	if(strlen($refernce_no)>3)
		{	if($pro_code==1) {$appdtxt="PL";}elseif($pro_code==2){$appdtxt="HL";}elseif($pro_code==3){$appdtxt="CL";}elseif($pro_code==4){$appdtxt="CC";}elseif($pro_code==5){$appdtxt="LAP";}else{$appdtxt="";}
			list($requestidno, $bidderid) = split('[S]', $refernce_no);
			$refernce_no_section = str_replace($appdtxt, "",$requestidno);

			$refernce_no_clause = " AND `".$feedback_tble."`.Feedback_ID = '".$refernce_no_section."' ";
		}
		if($pro_code==1)
		{
			$feedback_tble="Req_Feedback_Comments_PL";
		}

	if($bankwise=="All")
	{
		$bankwiseClause = " ";
	}
	else if($bankwise=="ICICI")
	{
		   //For ICICI 
	   $getICICIOptionsSql  = "select BidderID from Bidders where Global_Access_ID=6147";
	   $getICICIOptionsQuery = ExecQuery($getICICIOptionsSql);
	   $getICICIOptionsQueryNumRows = mysql_num_rows($getICICIOptionsQuery);
	   $ICICIBidders = '';
	   for($i=0;$i<$getICICIOptionsQueryNumRows;$i++)
	   {
		  $BidderIDICICI = mysql_result($getICICIOptionsQuery,$i,'BidderID');
 		  $ICICIBidders[] = $BidderIDICICI;
	   }
	   $ICICIBiddersStr =  implode(",", $ICICIBidders);
		$bankwiseClause = " AND ".$feedback_tble.".BidderID in (".$ICICIBiddersStr.") ";
		
	}
	else
	{
		$getBankDetailsSql = "select bank_individual_id from smspl_mapping_bidderlms where leadmapid = '".$bankwise."'";
		$getBankDetailsQuery = ExecQuery($getBankDetailsSql);
		$bank_individual_id = mysql_result($getBankDetailsQuery,0,'bank_individual_id');
		$bankwiseClause = " AND ".$feedback_tble.".BidderID in (".$bank_individual_id.") ";
	}

	?>
 <p class="bodyarial11"><?=$Msg?></p>
 <table width="950" border="0" align="center" cellpadding="4" cellspacing="4" bgcolor="#FFFFFF" >
 <? 
 

	
		
		$qry = "select RequestID from  ".$feedback_tble." left outer join ".$val." on ".$val.".RequestID = ".$feedback_tble.".AllRequestID where  ".$feedback_tble.".Reply_Type=".$pro_code." and (".$feedback_tble.".Allocation_Date Between '".($min_date)."' and '".($max_date)."' ) and ".$val.".Allocated = 1  ";
		$qry=$qry.$FeedbackClause;
		$qry=$qry.$mob_num_clause." ".$refernce_no_clause." ".$bankwiseClause." ".$salarywiseClause." ".$loanwiseClause;

		//$qry=$qry."group by ".$val.".Mobile_Number";
		$qry=$qry."group by ".$feedback_tble.".AllRequestID";
		$qry=$qry." order by ".$val.".Dated DESC";
		//echo"hello".$qry."<br>";
		$result=ExecQuery($qry);
		$recordcount = mysql_num_rows($result);
 ?>
   <tr>
     <td colspan="11" style="border-bottom:1px solid #45B2D8;"><strong><? echo $startrow+1; ?> to <? echo min($startrow+$pagesize,$recordcount); ?> Out of <? echo $recordcount; ?> Records </strong></td>
     </tr>
   <tr>
      <td width="146" align="center" bgcolor="#FFFFFF" class="style2">Name</td>
	  <td width="95" align="center" bgcolor="#FFFFFF" class="style2">City</td>
     <td width="137" align="center" bgcolor="#FFFFFF" class="style2">Mobile</td>
     <td width="99" align="center" bgcolor="#FFFFFF" class="style2">Net Salary </td>
	  <td width="91" align="center" bgcolor="#FFFFFF" class="style2">Loan Amount </td>
      <td width="156" align="center" bgcolor="#FFFFFF" class="style2" >Comapny Name</td>
      <td width="150" align="center" bgcolor="#FFFFFF" class="style2" >Allocated Bidders </td>

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


		$qry = "select RequestID,Name,City,Mobile_Number,Loan_Amount,Net_Salary,Company_Name from  ".$feedback_tble." left outer join ".$val." on ".$val.".RequestID = ".$feedback_tble.".AllRequestID where  ".$feedback_tble.".Reply_Type=".$pro_code." and (".$feedback_tble.".Allocation_Date Between '".($min_date)."' and '".($max_date)."' ) and ".$val.".Allocated = 1  ";
		$qry=$qry.$FeedbackClause;
		$qry=$qry.$mob_num_clause." ".$refernce_no_clause." ".$bankwiseClause." ".$salarywiseClause." ".$loanwiseClause;
//		$qry=$qry."group by ".$val.".Mobile_Number";
		$qry=$qry."group by ".$feedback_tble.".AllRequestID";
		$qry=$qry." order by ".$val.".Dated DESC";
		$qry=$qry." LIMIT $startrow, $pagesize"; 
		
//		echo $qry."<br><br>";
		$result=ExecQuery($qry);
		$logqry = $qry;
		$logfilecontent.="Sql Query: ".$logqry."\n";
		$logfilecontent.="********************************************************";
		$i=1;
		if($recordcount>0)
		{
		while($row=mysql_fetch_array($result))
		{
	?>
	
   <tr>
      <td align="center" bgcolor="#DFF6FF" class="style3" >
	 <?php
	 $sqlExclusive = "select  BidderID  from ".$feedback_tble." where (AllRequestID = '".$row["RequestID"]."' and Reply_Type='".$pro_code."')";
	 $queryExclusive = ExecQuery($sqlExclusive);
	 $numRowsExclusive = mysql_num_rows($queryExclusive);
	 if($numRowsExclusive==1)
	 {
 	echo '<b style="color:#FF0000; font-size:9px;"> [Exclusive Lead] </b><br>';
	 }
	 echo $row["Name"]; ?></td>
	  <td align="center" bgcolor="#DFF6FF" class="style3"><? echo $row["City"]; ?></td>
     <td align="center" bgcolor="#DFF6FF" class="style3"><? echo $row["Mobile_Number"]; ?></td>
     <td align="center" bgcolor="#DFF6FF" class="style3"><? echo $row["Net_Salary"]; ?></td>
	 <td align="center" bgcolor="#DFF6FF" class="style3"><? echo $row["Loan_Amount"]; ?></td>
      <td align="center" bgcolor="#DFF6FF" class="style3"><? echo $row["Company_Name"]; ?></td>
     <td align="center" bgcolor="#DFF6FF" class="style3" ><?
	
	
	 $getBiddersIDSql = "select * from ".$feedback_tble." where AllRequestID = '".$row["RequestID"]."'";
	 $getBiddersIDQuery = ExecQuery($getBiddersIDSql);
	 $numRows1 = mysql_num_rows($getBiddersIDQuery);
	 if($numRows1>0)
	 {
		 $BidderIDArr = '';
		 $Bidder_NameArr = '';
		 for($j=0;$j<$numRows1;$j++)
		 {
			$BidderID = mysql_result($getBiddersIDQuery,$j,'BidderID');
			$getBidderSql = "select Associated_Bank from Bidders where BidderID='".$BidderID."'";	 
			$getBidderQuery = ExecQuery($getBidderSql);
			$Bidder_Name = mysql_result($getBidderQuery,0,'Associated_Bank');
			$Bidder_NameArr[] = $Bidder_Name;
			$BidderIDArr[] = $BidderID;
		 }
	//	echo implode(", ", $BidderIDArr);
		//echo "<br>";
		echo implode(", ", $Bidder_NameArr);
	 }
	 	 ?> </td>
	 </tr>

<?php // 		$uniqueid ="PL".$row["Feedback_ID"]."S".$row['sentbidder'];
$numRows = '';

// $getFeedbackSql = "select * from ".$feedback_tble." where AllRequestID = '".$row["RequestID"]."' and Feedback!=''";
 $getFeedbackSql = "select * from ".$feedback_tble." where AllRequestID = '".$row["RequestID"]."'";
	 $getFeedbackQuery = ExecQuery($getFeedbackSql);
	 $numRows = mysql_num_rows($getFeedbackQuery);
	// if($numRows>0)
	 //{
		 ?>
		<tr><td colspan="7"><table width="100%" border="1" cellspacing="3" style=" border-collapse:collapse;">
         <?php
		 for($k=0;$k<$numRows;$k++)
		 {
			$Feedback_ID = mysql_result($getFeedbackQuery,$k,'Feedback_ID');
			$BidderID = mysql_result($getFeedbackQuery,$k,'BidderID');
			$Feedback = mysql_result($getFeedbackQuery,$k,'Feedback');
			$Comments = mysql_result($getFeedbackQuery,$k,'Comments');
			$getBidderSql = "select Associated_Bank from Bidders where BidderID='".$BidderID."'";	 
			$getBidderQuery = ExecQuery($getBidderSql);
			$Bidder_Name = mysql_result($getBidderQuery,0,'Associated_Bank');
			
			?>
			<tr>
            	<td class="style3" width="30%"><strong>Ref ID</strong> - <?php echo "PL".$Feedback_ID."S".$BidderID;?></td>
            	<td class="style3" width="15%"><?php echo $Bidder_Name; ?></td>
                <td class="style3" width="15%"><?php echo $Feedback; ?></td>
                <td class="style3" width="40%"><?php echo $Comments; ?></td>
            </tr>
			<?php
		 }
		?></table></td></tr><?php
		 
	 //}


 ?>

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
 
  $datediffvar= timeDiff($varmin_date,$varmax_date);

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

</table>
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