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
function getApiStatus($statusVal){
    if($statusVal=='1'){
        $StatusRes="AIP APPROVED";
    }elseif($statusVal=='2'){
        $StatusRes="ELIGIBLE FOR LOWER EMI";
    }elseif($statusVal=='3'){
        $StatusRes="AIP REJECT";
    }elseif($statusVal=='0'){
        $StatusRes="FAILURE/ERROR";
    }
    return $StatusRes;
    
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
		if($BidderIDstatic==4093)
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
$Portal="";
	if(isset($_REQUEST['Portal']))
	{
		$Portal=$_REQUEST['Portal'];
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

        $inhouseCut_Call = '';
	if( $_SESSION['BidderID']==2680)
        {
            $inhouseCut_Call = 1; // Displaying Numbers
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
<script type="text/javascript">
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
	document.frmsearch.action="scb_view_api_lead.php?search=y"+gifName;
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
	else if($BidderIDstatic==4093)
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
</script>
<table width="100%" border="0"  align="center" cellpadding="0" cellspacing="0" >
<tr>
    <td align="center">
	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#45B2D8">
      <tr>
	  <td style="padding-top:15px;"><table  width="669" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#5BBEE0" >
			<tr>
				  <td width="669" align="left" valign="top" bgcolor="#FFFFFF" style="background-repeat:no-repeat;" ><table width="97%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="40" align="center"  ><h1 style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; color:#052733; line-height:18px; font-weight:bold;">Welcome to Deal4Loans LMS</h1></td>
  </tr>
 <?  if($pro_code==1)
  { ?>
  <tr>
    <td  style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#052733; line-height:17px;">
  PERSONAL LOAN is a need based product. Your end-sales will depend upon how quickly you contact the customer (after he registers for Loan).<br/><b>Tips: <br>1.</b> Login as many times a day as possible and contact the customer early .<br/>
		<b>2.</b> Ensure that your contact numbers go to the customer in the auto-acknowledgement SMS that Deal4Loans sends. <br></td>
  </tr>
  <? } 
  else if ($pro_code==2)
  { ?> 
 <tr>
    <td  style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#052733; line-height:17px;">HOME LOAN is a Life time decison for most customers- hence the decision cycle is long. As a loan provider you need to engage with the customer through out their decision cycle..<br/><b>Tips: <br>1.</b> Leave your contact numbers via email/SMS (functionality provided in Deal4Loans LMS) after you have contacted the customer.<br/>
<b>2.</b> Tell the loan seeker how much tax savings will this home loan get him/her.
	</td>
  </tr>
 <?  } ?>
 </table>
</td>	  </tr>
		  </table></td>
    </tr>
    <tr><td>&nbsp;</td></tr>
 <tr><td align="center"> 
 <table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
   <tr>
     <td height="30" align="center" valign="middle"><img src="images/login-srch-pnl.gif" width="650" height="30"></td>
   </tr>
   <tr>
     <td align="center" valign="middle" background="images/login-form-login-bg.gif"><table width="95%" border="0"  cellpadding="1" cellspacing="0">
             <form name="frmsearch" action="scb_view_api_lead.php?search=y" method="post" onSubmit="return chkform();">
  <input type="hidden" name="BidderIDstatic" id="BidderIDstatic" value="<? echo $BidderIDstatic;?>">
   <tr><td colspan="3">&nbsp;</td></tr>
   <tr>
   <td colspan="3" align="center">
   <table border="0" width="90%" cellpadding="0" cellspacing="0"><tr>
     <td width="20%" valign="middle" class="style1">&nbsp;&nbsp;Date&nbsp;&nbsp; From </td>
     <td width="24%" align="left" valign="middle" class="bidderclass" ><?$current_date=date('Y-m-d');?> 
	   <input name="min_date" type="text" id="min_date" size="15" <? if($min_date=="") { ?>value="<? if($BidderIDstatic==4093) { echo $joindate60; } elseif($BidderIDstatic==2454) {echo "2016-02-01";} else { echo $_SESSION['JoinDate']; } ?>"<? } else { ?>value="<? echo $min_date; ?>" <? }?>></td>
	   <td>
       <input name="b12" type="button" class="bluebutton" onClick="javascript:pedirFecha(min_date,'');" value="&lt; Insert">  </td>
       <td valign="middle" align="center" class="style1" width="8%">To</td>
     <td align="left" valign="middle" class="style1" width="24%" >  <input name="max_date" type="text" id="max_date" size="15" value="<? echo $max_date; ?>"></td>
        <td> <input name="b122" type="button" class="bluebutton" onClick="javascript:pedirFecha(max_date,'');" value="&lt; Insert"></td>
	   </tr>
	   </table>
	   </td></tr>
   <tr>
       <td width="20%" valign="middle" class="style1">Contact number</td>
       <td width="24%" align="left" valign="middle" class="bidderclass" ><input type="text" name="contactNumber" value="<?php echo $_REQUEST['contactNumber']?>" id="contactNumber" /></td>
	   <td width="20%" valign="middle" class="style1">Website</td>
	   <td width="24%" align="left" valign="middle" class="bidderclass">
		<select name="Portal">
			<option value="1" <?php if($Portal==1) { echo "Selected";} ?>>Deal4loans</option>
			<option value="2" <?php if($Portal==2) { echo "Selected";} ?>>Wishfin</option>
			</select>
		</td>      
   </tr>
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
	if($search=="y")
	{
		$min_date=$min_date." 00:00:00";
		$max_date=$max_date." 23:59:59";
	?>
 <p class="bodyarial11"><?=$Msg?></p>
 <table width="950" border="0" align="center" cellpadding="2" cellspacing="3" bgcolor="#FFFFFF" >
 <?php
 if($Portal==2)
		{
		$wishfin_tbl="xkyknzl5dwfyk4hg_tms_bank_api";
		 $qry="Select Name,Email, Employment_Status, Company_Name,City,Mobile_Number, Total_Experience, Net_Salary, Loan_Amount,Dated,json_response_data  FROM ".$wishfin_tbl.",Req_Loan_Personal  LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID=Req_Loan_Personal.RequestID WHERE ".$wishfin_tbl.".bank_code='036' AND ".$wishfin_tbl.".product_type='PL' AND ".$wishfin_tbl.".d4l_id=Req_Loan_Personal.RequestID AND ".$wishfin_tbl.".date_requested Between '".($min_date)."' and '".($max_date)."' group by Req_Loan_Personal.Mobile_Number";		
		}
		else
		{
 $qry="Select websrvid,leadid, request_xml,webservice_bidder_details.feedback, webservice_bidder_details.bidderid,doe,RequestID,UserID,Name,Email, Employment_Status, Company_Name,City,Mobile_Number, Total_Experience, Net_Salary, Loan_Amount,Dated FROM webservice_bidder_details,Req_Loan_Personal  LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID=Req_Loan_Personal.RequestID WHERE webservice_bidder_details.bidderid='Standard Chartered' AND webservice_bidder_details.leadid=Req_Loan_Personal.RequestID AND webservice_bidder_details.doe Between '".($min_date)."' and '".($max_date)."' group by Req_Loan_Personal.Mobile_Number";		
		}
		//echo $qry."<br>";
		$result=ExecQuery($qry);
		$recordcount = mysql_num_rows($result);
 ?>
   <tr>
     <td colspan="11" style="border-bottom:1px solid #45B2D8;"><strong><? echo $startrow+1; ?> to <? echo min($startrow+$pagesize,$recordcount); ?> Out of <? echo $recordcount; ?> Records </strong></td>
     </tr>
   <tr>
      <td width="70" align="center" bgcolor="#FFFFFF" class="style2">Name</td>
	  <td width="70" align="center" bgcolor="#FFFFFF" class="style2">City</td><td width="70" align="center" bgcolor="#FFFFFF" class="style2">Mobile</td>
   
     <td width="91" align="center" bgcolor="#FFFFFF" class="style2">Net Salary </td>
	  <td width="90" align="center" bgcolor="#FFFFFF" class="style2">Loan Amount </td>
        
<?php      if(($IP=="182.71.109.218" || $IP=="122.176.100.27" || $IP=="122.176.100.28" || $IP=="122.176.122.134" || $IP=="122.161.196.68" || $IP=="61.246.3.127" || $IP=="122.160.30.168" || $IP=="180.188.224.34" || $IP=="122.161.193.191" || $IP=="122.160.74.241" || $IP=="122.160.74.235" || $IP=="1.23.114.53" || "185.93.231.12"))
	{ ?>
	<td width="90" align="center" bgcolor="#FFFFFF" class="style2">Feedback </td>
   	   <td width="125" align="center" bgcolor="#FFFFFF" class="style2">Comment</td>          
         <?php }
    ?>
	<? if($BidderIDstatic=="2680") { ?> <td width="90" align="center" bgcolor="#FFFFFF" class="style2">Bank Response(API) </td> <? } ?>
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
	if($Portal==2)
		{
		$wishfin_tbl="xkyknzl5dwfyk4hg_tms_bank_api";
		 $qry="Select Name,Email, Employment_Status, Company_Name,City,Mobile_Number, Total_Experience, Net_Salary, Loan_Amount,Dated,json_response_data FROM ".$wishfin_tbl.",Req_Loan_Personal  LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID=Req_Loan_Personal.RequestID WHERE ".$wishfin_tbl.".bank_code='036' AND ".$wishfin_tbl.".product_type='PL' AND ".$wishfin_tbl.".d4l_id=Req_Loan_Personal.RequestID AND ".$wishfin_tbl.".date_requested Between '".($min_date)."' and '".($max_date)."' group by Req_Loan_Personal.Mobile_Number";
		 $qry=$qry." order by Req_Loan_Personal.Dated DESC";
                $search_qry = $qry;
		$qry=$qry." LIMIT $startrow, $pagesize"; 
		}
		else
		{
		$qry="Select websrvid,leadid, request_xml,webservice_bidder_details.feedback, webservice_bidder_details.bidderid,doe,RequestID,UserID,Name,Email, Employment_Status, Company_Name,City,Mobile_Number, Total_Experience, Net_Salary, Loan_Amount,Dated FROM webservice_bidder_details,Req_Loan_Personal  LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID=Req_Loan_Personal.RequestID WHERE webservice_bidder_details.bidderid='Standard Chartered' AND webservice_bidder_details.leadid=Req_Loan_Personal.RequestID AND webservice_bidder_details.doe Between '".($min_date)."' and '".($max_date)."' ";
		if(!empty($_REQUEST['contactNumber'])){
		$qry=$qry." AND Req_Loan_Personal.Mobile_Number='".$_REQUEST['contactNumber']."'";
		}
	   $qry=$qry." group by Req_Loan_Personal.Mobile_Number";
		$qry=$qry." order by ".$val.".Dated DESC";
                $search_qry = $qry;
		$qry=$qry." LIMIT $startrow, $pagesize"; 
	        $getParameterVal = min($startrow+$pagesize,$recordcount);
		//echo $qry."<br><br>";
	}
		
		$result=ExecQuery($qry);
		$logqry = $qry;
		$logfilecontent.="Sql Query: ".$logqry."\n";
		$logfilecontent.="********************************************************";
		$i=1;
		if($recordcount>0)
		{
                $color = 1;
		while($row=mysql_fetch_array($result))
		{
                    $RequestXml = $row[3];
                    $FirstEle = explode(",",$RequestXml);
                    $FirstEleVal = $FirstEle[0];
                    $EleStatusArr = explode("-",$FirstEleVal);
                    //echo "<pre>";
                    //print_r($EleStatusArr);
                    $AIPStatus = $EleStatusArr[1];
	?>
	
   <tr>
      <td align="center" bgcolor="#DFF6FF" class="style3" >
          <?php if($AIPStatus==0){ ?>
          <a target="_blank" href="http://www.deal4loans.com/apply_stancpl_consent.php?pl_requestid=<?php echo $row['RequestID'];?>&pl_bank_name=Standard Chartered&aiplead=yes"><?php echo $row["Name"]; ?></a> <?php  } else {echo $row["Name"]; }?></td>
	  <td align="center" bgcolor="#DFF6FF" class="style3"><? echo $row["City"]; ?></td>
          <td bgcolor="#DFF6FF" class="style3" >
                 <?php 
                if($inhouseCut_Call==1) {
                ?>
                  <span id="clik4Num_<?php echo $color; ?>">XXXXXXXXXX</span>

                
                <?php } else {  echo ccMasking($row['Mobile_Number']); } ?>

                <?php //echo ccMasking($row->Mobile_Number); ?></td>
     <td align="center" bgcolor="#DFF6FF" class="style3">
         <?php 
                if($inhouseCut_Call==1) {
                ?>&nbsp;&nbsp;
                <span id="clkNum<?php echo $color; ?>" onClick="getNumValue(<?php echo $color; ?>,<?php echo $row['RequestID']; ?>,<?php echo $getParameterVal; ?>);" style="cursor:hand; font-weight:bold;"><?php echo $row['Net_Salary'];?></span><?php } else {  echo $row['Net_Salary']; } ?> </td>
	 <td align="center" bgcolor="#DFF6FF" class="style3"><? echo $row["Loan_Amount"]; ?></td>
	 <?php      if(($IP=="182.71.109.218" || $IP=="122.176.100.27" || $IP=="122.176.100.28" || $IP=="122.176.122.134" || $IP=="122.161.196.68" || $IP=="61.246.3.127" || $IP=="122.160.30.168" || $IP=="180.188.224.34" || $IP=="122.161.193.191" || $IP=="122.160.74.241" || $IP=="122.160.74.235" || $IP=="1.23.114.53" || "185.93.231.12"))
	{
		echo     '<td align="center" bgcolor="#DFF6FF" colspan="2" width="250">';
//		echo $row["RequestID"]; echo $row['sentbidder'];
		$getUploadedFeedback = '';
		$getUploadedComments = '';

		$getFeedbackSql = "select Feedback, Comments, BidderID from Req_Feedback_Comments_PL where AllRequestID='".$row["RequestID"]."' and BidderID='".$row['sentbidder']."' and Feedback!='' ";
		
		$getFeedbackQuery = ExecQuery($getFeedbackSql);
		$getUploadedNumRows = mysql_num_rows($getFeedbackQuery);
		
		$getFeedbackOthersSql = "select Feedback, Comments, BidderID from Req_Feedback_Comments_PL where AllRequestID='".$row["RequestID"]."' and BidderID!='".$row['sentbidder']."' and Feedback!=''";
		
		$getFeedbackOthersQuery = ExecQuery($getFeedbackOthersSql);
		$getUploadedNumOthersRows = mysql_num_rows($getFeedbackOthersQuery);
if($getUploadedNumRows>0 || $getUploadedNumOthersRows>0)
    {
?>
<table width="100%" border="0" align="center" cellpadding="2" cellspacing="1" bgcolor="#FFFFFF" >
    <?php 
	if($getUploadedNumRows>0)
		{
			$getUploadedFeedback = mysql_result($getFeedbackQuery,0,'Feedback');
			$getUploadedComments = mysql_result($getFeedbackQuery,0,'Comments');
			$getUploadedBidderID = mysql_result($getFeedbackQuery,0,'BidderID');
			$getBidderSQl1 = "select Bidder_Name from Bidders_List where BidderID= '".$getUploadedBidderID."'";
			$getBidderQuery1 = ExecQuery($getBidderSQl1);
			$getBidder_Name1 = mysql_result($getBidderQuery1,0,'Bidder_Name');
	?>
    <tr>
    <td align="center" bgcolor="#DFF6FF"><?php echo $getUploadedFeedback; ?></td>    <td align="center" bgcolor="#DFF6FF" ><?php echo $getUploadedComments; ?></td><td align="center" bgcolor="#DFF6FF" ><?php echo $getBidder_Name1; ?></td><tr><?php } 
    if($getUploadedNumOthersRows>0)
		{
			$getUploadedOthersFeedback = '';
			$getUploadedOthersComments = '';
			$getUploadedOthersBidderID = '';
			
			for($ii=0;$ii<$getUploadedNumOthersRows;$ii++)
			{
			$getUploadedOthersFeedback = mysql_result($getFeedbackOthersQuery,$ii,'Feedback');
			$getUploadedOthersComments = mysql_result($getFeedbackOthersQuery,$ii,'Comments');
			$getUploadedOthersBidderID = mysql_result($getFeedbackOthersQuery,$ii,'BidderID');
			$getBidderSQl = "select Bidder_Name from Bidders_List where BidderID= '".$getUploadedOthersBidderID."'";
			$getBidderQuery = ExecQuery($getBidderSQl);
			$getBidder_Name = mysql_result($getBidderQuery,0,'Bidder_Name');
	?>
    <tr>
    <td align="center" bgcolor="#FFCC99"><?php echo $getUploadedOthersFeedback; ?></td>    <td align="center" bgcolor="#FFCC99"><?php echo $getUploadedOthersComments; ?></td> <td align="center" bgcolor="#FFCC99" ><?php echo $getBidder_Name; ?></td><tr><?php
	
			}
	 } ?>
    </table>
        <?php
	}
		echo '</td>';
	} ?>
<?php
	  if($Portal==2)
		{
				$apifeedback = $row["json_response_data"];
				$apifeedbackarr = json_decode($apifeedback,true);
				//print_r($apifeedbackArray);
				$response="Status - ". getApiStatus($apifeedbackarr["Status"])."<br> ".$apifeedbackarr["ReferenceCode"]."<br> ".$apifeedbackarr["Errorinfo"];
				//{"Status":3,"ReferenceCode":"#PLFUQX9CO","EligibleEMI":0,"Errorcode":0,"Errorinfo":"","RequestIP":"205.147.101.128"}
			}else
			{
       			$apifeedback = $row["feedback"];
				$apifeedbackarr=explode(",",$apifeedback);
                $StatusArr = explode(" -",$apifeedbackarr[0]);  
				$response="Status - ". getApiStatus($StatusArr[1])."<br> ".$apifeedbackarr[1]."<br> ".$apifeedbackarr[3];
			}
                	     
		?>
				<td align="left" bgcolor="#DFF6FF" ><? echo  $response; ?></td>            
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
					?>  <tr><td align="center"><form name="frmdownload" action="bidder_download.php" method="post"><table width="500" border="0" cellspacing="1" cellpadding="4">
 
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
 
 </table></form></td></tr><?
				}
				else
				{					
				}
			}
			else
			{
			?>
   <tr><td align="center"><form name="frmdownload" action="bidder_download.php" method="post"><table width="500" border="0" cellspacing="1" cellpadding="4">

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
 
 </table></form></td></tr>
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
</body>
</html>
