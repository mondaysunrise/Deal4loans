<?php
	require 'scripts/session_check_online.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

//echo $IP_Remote = $_SERVER["REMOTE_ADDR"];
//echo "<br>";
if($IP_Remote=='192.124.249.12' || $IP_Remote=='185.93.228.12') { $IP= $_SERVER['HTTP_X_SUCURI_CLIENTIP']; }
else { $IP= $IP_Remote;	}
$validByIP = 0;
	if($IP=="122.176.100.27" || $IP=="122.176.100.28" || $IP=="122.161.196.68" || $IP=="61.246.3.127" || $IP=="122.160.30.168" || $IP=="180.188.224.34" || $IP=="122.161.193.191" || $IP=="122.160.74.241" || $IP=="122.160.74.235"  || $IP=="182.71.109.218" || $IP=="1.23.114.53" || "185.93.231.12") 
{
	$validByIP = 1;
}	
	
//echo $validByIP."<br>";
echo $_SESSION['BidderID']."<br><br>";
function getReqValue1($pKey){
	$titles = array(
        '1' => '1360,1361,1362,1363,1372,1375,1523,1524,1359,1364,1365,1370,1519,1520,1521,1522,1366,1367,1368,1369,1515,1516,1517,1518,1371,1373,1374,1376,1525,1526,1527,1029,1215,1221,1222,1642,1641,1090,1091,1092,1093,1871,1872,1873,1874,1875,1876,1877,1292,1432,1436,1439,1204,1223,1424,1425,1429,1433,1435,1293,1427,1428,1431,1437,1294,1423,1426,1430,1434,1438,1470,1471,1473,1480,2295,1095,1096,1097,1098,1106,1108,1102,1105,1163,1100,1103,1104,1107,2280,1379,1381,1387,1385,1384,1380,1386,1125,1378,1383,1377,1686,1284,1295,1287,1546,1547,1548,1549,1550,1551,1552,1553,1554,1555,1556,1557,1558,1559,1560,1561,1562,1338,1339,1340,1343,1347,1348,1350,1451,1452,1342,1344,1345,1346,1453,1454,1456,1455,1351,1353,1354,1355,1356,1357,1462,1463,1464,1465,1349,1352,1358,1457,1458,1459,1460,1461,1164,1165,1162,1166,1167,1168,1226,1597,1598,1599,1600,1601,1602,1603,1857,1858,1859,1860,1861,1025,1675,2168,2296,2297,2298,2299,2300,2301,2302,2303,2304,2305,2335,2336,2337,2338,2339,2340,2341,2342,2343,2344,2280,2281,2283,2284,2285,2286,2287,2288,2289,2290,2291,2292,2293,2294,2295,332,4466,4467,4468,4469,4470,4471,4472,4665,4666,4667,4658,4641,4642,4643,4645,4644,4770,4747,5273,5274,5275,5376,5379,5420,5421,5429,3322,3315,3325,5106,5661,3320,5917,5918,5915,5938,5690,5992,6093,6094,5991,6156,6157,6337,3318,3317,3319,6398,6399,6400,6401,6402,6403,6404,6405,1522,3316,1522,3324,3323,5459,6682,6797,6965,6966,6967,6968,6969,6970',
		'2' => '1029,1641,1642,4667,4641',
		'3' => '1215,1221,4658,4642',
		'4' => '1292,1432,1436,1439',
		'5' => '',
		'6' => '1095,1096,1097,1098,1106,1108,4747',
		'7' => '1338,1339,1340,1343,1347,1348,1350,1451,1452',
		'8' => '1125,1377,1378,1379,1380,1381,1382,1383,1384,1385,1386,1387,1857,1858,1859,1860',
		'9' => '1284,1287,1295,4643',
		'10' => '1351,1353,1354,1355,1356,1357,1462,1463,1464,1465',
		'11' => '1162,1164,1165,1166,1167,1168,1226',
		'12' => '1349,1352,1358,1457,1458,1459,1460,1461,1686',
		'13' => '1378,1380,1383,1386',
		'14' => '1090,1091,1092,1093,1675,4466,4467,4468,4469,4470,4471,4472',
		'15' => '1162,1166,1167,1168,1226,4644',
		'16' => '1342,1344,1345,1346,1453,1454,1456,1455',
		'17' => '1284,1550,1554,1558,1561,1562,4645,6797',
		'18' => '1295,1546,1548,1551,1552,1557,1559,1560',
		'19' => '1287,1547,1549,1553,1555,1556',
		'20' => '1102,1105,1163',
		'21' => '1100,1103,1104,1107',
		'22' => '1294,1423,1426,1430,1434,1438',
		'23' => '1222',
		'24' => '1360,1361,1362,1363,1372,1375,1523,1524',
		'25' => '1351,1353,1354,1355,1356,1357,1462,1463,1464,1465',
		'26' => '1377,1384,1385,1387',
		'27' => '1349,1352,1358,1457,1458,1459,1460,1461',
		'28' => '1359,1364,1365,1366,1370,1519,1520,1521,1522,4770',
		'29' => '1367,1368,1369,1515,1516,1517,1518',
		'30' => '1371,1373,1374,1376,1525,1526,1527',
		'31' => '1597,1598,1599,1600,1601,1602,1603',
		'32' => '1861',
		'33' => '1871,1873',
		'34' => '1872,1874,1875,1876,6965',
		'35' => '1877',
		'36' => '2280',
		'37' => '2281',
		'38' => '2883',
		'39' => '2284',
		'40' => '2285',
		'41' => '2286',
		'42' => '2287',
		'43' => '2288',
		'44' => '2289',
		'45' => '2290',
		'46' => '2291',
		'47' => '2292',
		'48' => '2293',
		'49' => '2294',
		'50' => '2295',
		'51' => '2296',
		'52' => '2297',
		'53' => '2298',
		'54' => '2299',
		'55' => '2300',
		'56' => '2301',
		'57' => '2302',
		'58' => '2303',
		'59' => '2304',
		'60' => '2305',
		'61' => '2335',
		'62' => '2336',
		'63' => '2337',
		'64' => '2338',
		'65' => '2339',
		'66' => '2340',
		'67' => '2341',
		'68' => '2342',
		'69' => '2343',
		'70' => '2344',
		'71' => '1025,4665,4666',
		'72' => '5273',
		'73' => '5274',
		'74' => '5275'
		
		);

	foreach ($titles as $key=>$value)
	    if($pKey==$key)
		return $value;

	return "";
		}


$city="";
	if(isset($_REQUEST['city']))
	{
		$city=$_REQUEST['city'];
	}

$branch=getReqValue1($city);
//echo $branch."<br>";
$getbranch=explode(",", $branch);
//print_r($getbranch);
//echo "<br>";
$getbranchwise="";
if(isset($_REQUEST['getbranchwise']))
	{
		$getbranchwise=$_REQUEST['getbranchwise'];
	}

//echo "getbranchwise".$getbranchwise."<br>";

 $val = "Req_Loan_Personal";
 // echo "bye".$val;
   $pro_code=1;

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

<?php 
	 if(isset($_SESSION['UserType']))
	{
echo "<table width='100%' border='0' cellspacing='0' cellpadding='0'><tr><td width='323' height='93' align='left' valign='top'  ><img src='http://www.deal4loans.com/rnew/images/login-logo.gif' width='323' height='93' /></td><td align='left' valign='top' style='color:#0B6FCC;' ><table width='100%' border='0' cellspacing='0' cellpadding='0' bgcolor='#0A92C0'><tr><td height='67' align='right' valign='middle' bgcolor='#C8E3F3' style='padding-right:10px;'><table border='0' align='right' cellpadding='0' cellspacing='0' bgcolor='#0A92C0'><tr><td width='6' height='32' align='left' valign='top'><img  src='http://www.deal4loans.com/rnew/images/login-form-logut-lft.gif' width='6' height='32' /></td><td background='http://www.deal4loans.com/rnew/images/login-form-logut-bg.gif' style=' background-repeat:repeat-x; height:32px;'><table width='100%' border='0' align='center' cellpadding='0' cellspacing='0'><tr><td align='left' valign='middle' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#FFFFFF; font-weight:bold; padding-right:15px;' > Welcome ".ucwords($_SESSION['UserType'])." ".$_SESSION['UName']."</td><td align='left' style='padding-right:2px;' width='22'><img src='http://www.deal4loans.com/rnew/images/login-logut-btn.gif' /></td><td align='right' class='style1' style='color:#FFFFFF; font-weight:bold;'><div align='right' class='style1' style='color:#FFFFFF; font-weight:bold;'> <a href='Logout.php' style='color:#FFFFFF; font-size:13px; text-decoration:none; font-family:Verdana, Arial, Helvetica, sans-serif;'>Logout</a></div></td></tr></table></td><td width='6' height='32'><img src='http://www.deal4loans.com/rnew/images/login-form-logut-rgt.gif' width='6' height='32' /></td></tr></table></td></tr><tr><td>&nbsp;</td></tr></table></td></tr></table>";
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
	document.frmsearch.action="fullerton_index.php?search=y"+gifName;
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
	<?if($_SESSION['Date']>$mindefineDate)
		{?>
	if(document.frmsearch.min_date.value<"<?php echo $mindefineDate;?>")
	{
		alert("Sorry!!!! Your minimum date is <?php echo $mindefineDate;?>.Please Select.");
		document.frmsearch.min_date.value="";
		document.frmsearch.min_date.focus();
		return false;
	}
	<? } 
	else {?>
		if(document.frmsearch.min_date.value<"2009-02-05")
	{
		alert("Sorry!!!! Your minimum date is 2009-00-05.Please Select.");
		document.frmsearch.min_date.value="";
		document.frmsearch.min_date.focus();
		return false;
	}
	<? }?>
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
	  <td style="padding-top:15px;"><table  width="669" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#5BBEE0">		
				<tr>
				  <td width="669" height="150" align="left" valign="top" bgcolor="#FFFFFF" style="background-repeat:no-repeat;" ><table width="97%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="40" align="center"  ><h1 style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; color:#052733; line-height:18px; font-weight:bold;">Welcome to Deal4Loans LMS</h1></td>
  </tr>
  <tr>
    <td  style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#052733; line-height:17px;"><? if ((!isset($val) && $viewtexttype==1) || ($val=="Req_Loan_Personal")) {?>PERSONAL LOAN is a need based product. Your end-sales will depend upon how quickly you contact the customer (after he registers for Loan).<br/><b>Tips: <br>1.</b> Login as many times a day as possible and contact the customer early .<br/>
		<b>2.</b> Ensure that your contact numbers go to the customer in the auto-acknowledgement SMS that Deal4Loans sends. <br>
<? } elseif((!isset($val) && $viewtexttype==2) || ($val=="Req_Loan_Personal")) {?>HOME LOAN is a Life time decison for most customers- hence the decision cycle is long. As a loan provider you need to engage with the customer through out their decision cycle..<br/><b>Tips: <br>1.</b> Leave your contact numbers via email/SMS (functionality provided in Deal4Loans LMS) after you have contacted the customer.<br/>
<b>2.</b> Tell the loan seeker how much tax savings will this home loan get him/her.
	<? } ?>
	</td>
  </tr>
</table>
</td>  </tr>			 
		  </table></td>     
	</tr>
	<tr><td>&nbsp;</td></tr>
	<?php $IP_Remote = $_SERVER["REMOTE_ADDR"];
if($IP_Remote=='192.124.249.12' || $IP_Remote=='185.93.228.12') { $IP= $_SERVER['HTTP_X_SUCURI_CLIENTIP']; }
else { $IP= $IP_Remote;	}
	if($IP=="122.176.100.27" || $IP=="122.176.100.28" || $IP=="122.176.122.134" || $IP=="122.161.196.68" || $IP=="61.246.3.127" || $IP=="122.160.30.168" || $IP=="180.188.224.34" || $IP=="122.161.193.191" || $IP=="122.160.74.241" || $IP=="122.160.74.235"  || $IP=="182.71.109.218" || $IP=="1.23.114.53" || "185.93.231.12") { ?> <tr><td style="float:right" bgcolor="#45B2D8"><a href="/bidders_consolidate_statext.php" style="color:#FFFFFF;" target="_blank"><strong>Praveen Channel</strong></a>  | <a href="/bidders_consolidate_appointment.php" style="color:#FFFFFF;" target="_blank"><strong>Appointment</strong></a> | <a href="/bidders_update_feedback.php" style="color:#FFFFFF;"><strong>Update Feedbacks</strong></a></td></tr><? } ?>
 <tr><td align="center">
  
 <table width="600" border="0" align="center" cellpadding="0" cellspacing="0" >
   <tr>
     <td height="30" align="center" valign="middle"><img src="images/login-srch-pnl.gif" width="650" height="30"></td>
   </tr>
   <tr>
     <td align="center" valign="middle" background="images/login-form-login-bg.gif"><table width="95%" border="0"  cellpadding="1" cellspacing="0">
 <form name="frmsearch" action="fullerton_index.php?search=y" method="post" onSubmit="return chkform();">   
  <tr><td colspan="3">&nbsp;</td></tr>  
   <tr>
   <td colspan="3" align="center">
   <table border="0" width="90%" cellpadding="0" cellspacing="0"><tr>
     <td width="20%" valign="middle" class="style1">&nbsp;&nbsp;Date&nbsp;&nbsp; From </td>
     <td width="24%" align="left" valign="middle" class="bidderclass" ><?$current_date=date('Y-m-d');?> 
	   <input name="min_date" type="text" id="min_date" size="15" <? if($min_date=="") { ?>value="2009-02-05"<? } else { ?>value="<? echo $min_date; ?>" <? }?>></td>	   <td>
       <input name="b12" type="button" class="bluebutton" onClick="javascript:pedirFecha(min_date,'');" value="&lt; Insert">  </td> 
     <td valign="middle" align="center" class="style1" width="8%">To</td>
     <td align="left" valign="middle" class="style1" width="24%" >  <input name="max_date" type="text" id="max_date" size="15" value="<? echo $max_date; ?>"></td>
        <td> <input name="b122" type="button" class="bluebutton" onClick="javascript:pedirFecha(max_date,'');" value="&lt; Insert"></td>
	   </tr>
	   </table>
	   </td></tr>
  <tr><td valign="middle" class="style1">City</td><td>
	  <select name="city" id="city">
	  <option value="-1">Please select</option>
	 <option value="1" <?if($city==1) { echo "selected";} ?>>All</option>
	<option value="2" <?php if($city==2) { echo "selected";} ?>>Ahmedabad</option>
<option value="3" <?  if($city==3) { echo "selected";} ?>>Baroda</option>
<option value="4" <? if($city==4) { echo "selected";} ?>>Bhopal</option>
<option value="5" <? if($city==5) { echo "selected";} ?>>Chandigarh </option>
<option value="6" <? if($city==6) { echo "selected";} ?>>Chandigarh-HP</option>
<option value="7" <? if($city==7) { echo "selected";} ?>>Coimbatore</option>
<option value="8" <? if($city==8) { echo "selected";} ?>>Dehradun</option>
<option value="9" <? if($city==9) { echo "selected";} ?>>East</option>
<option value="10" <? if($city==10) { echo "selected";} ?>>Indore </option>
<option value="11" <? if($city==11) { echo "selected";} ?>>Jabalpur</option>
<option value="12" <? if($city==12) { echo "selected";} ?>>Jaipur</option>
<option value="13" <? if($city==13) { echo "selected";} ?>>Jodhpur</option>
<option value="14" <? if($city==14) { echo "selected";} ?>>Karnal</option>
<option value="71" <? if($city==71) { echo "selected";} ?>>Kolkata</option>
<option value="15" <? if($city==15) { echo "selected";} ?>>Lucknow</option>
<option value="16" <? if($city==16) { echo "selected";} ?>>Madurai</option>
<option value="17" <? if($city==17) { echo "selected";} ?>>Nagpur</option>
<option value="18" <? if($city==18) { echo "selected";} ?>>Nasik</option>
<option value="19" <? if($city==19) { echo "selected";} ?>>Pune</option>
<option value="20" <? if($city==20) { echo "selected";} ?>>Punjab-1</option>
<option value="21" <? if($city==21) { echo "selected";} ?>>Punjab-2</option>
<option value="22" <? if($city==22) { echo "selected";} ?>>Raipur</option>
<option value="23" <? if($city==23) { echo "selected";} ?>>Saurashtra</option>
<option value="24" <? if($city==24) { echo "selected";} ?>>Tirupati</option>
<option value="25" <? if($city==25) { echo "selected";} ?>>Trichy</option>
<option value="26" <? if($city==26) { echo "selected";} ?>>Udaipur</option>
<option value="27" <? if($city==27) { echo "selected";} ?>>Vellore</option>
<option value="28" <? if($city==28) { echo "selected";} ?>>Vijayawada</option>
<option value="29" <? if($city==29) { echo "selected";} ?>>Vishakapatnam</option>
<option value="30" <? if($city==30) { echo "selected";} ?>>Warangal</option>
<option value="31" <? if($city==31) { echo "selected";} ?>>Varanasi</option>
<option value="32" <? if($city==32) { echo "selected";} ?>>Firozabad</option>
<option value="33" <? if($city==33) { echo "selected";} ?>>Bangalore</option>
<option value="34" <? if($city==34) { echo "selected";} ?>>Hubli</option>
<option value="35" <? if($city==35) { echo "selected";} ?>>Hospet</option>
<option value="36" <? if($city==36) { echo "selected";} ?>>Hoshiarpur</option>
<option value="37" <? if($city==37) { echo "selected";} ?>>Khanna</option>
<option value="38" <? if($city==38) { echo "selected";} ?>>Solan</option>
<option value="39" <? if($city==39) { echo "selected";} ?>>Sirsa</option>
<option value="40" <? if($city==40) { echo "selected";} ?>>Batala</option>
<option value="41" <? if($city==41) { echo "selected";} ?>>Kotkapura</option>
<option value="42" <? if($city==42) { echo "selected";} ?>>Barnala</option>
<option value="43" <? if($city==43) { echo "selected";} ?>>Abohar</option>
<option value="44" <? if($city==44) { echo "selected";} ?>>Mandi</option>
<option value="45" <? if($city==45) { echo "selected";} ?>>Kapurthala</option>
<option value="46" <? if($city==46) { echo "selected";} ?>>Dharamshala</option>
<option value="47" <? if($city==47) { echo "selected";} ?>>FARIDKOT</option>
<option value="48" <? if($city==48) { echo "selected";} ?>>Mansa</option>
<option value="49" <? if($city==49) { echo "selected";} ?>>NABHA</option>
<option value="50" <? if($city==50) { echo "selected";} ?>>Ambala</option>
<option value="51" <? if($city==51) { echo "selected";} ?>>Ranebennur</option>
<option value="52" <? if($city==52) { echo "selected";} ?>>Davanagere</option>
<option value="53" <? if($city==53) { echo "selected";} ?>>Sirsi</option>
<option value="54" <? if($city==54) { echo "selected";} ?>>Bijapur</option>
<option value="55" <? if($city==55) { echo "selected";} ?>>Raichur</option>
<option value="56" <? if($city==56) { echo "selected";} ?>>Gulbarga</option>
<option value="57" <? if($city==57) { echo "selected";} ?>>Sindhanoor</option>
<option value="58" <? if($city==58) { echo "selected";} ?>>Shimoga</option>
<option value="59" <? if($city==59) { echo "selected";} ?>>Bidar</option>
<option value="60" <? if($city==60) { echo "selected";} ?>>Chickmagalur</option>
<option value="61" <? if($city==61) { echo "selected";} ?>>NAVSARI</option>
<option value="62" <? if($city==62) { echo "selected";} ?>>BHARUCH</option>
<option value="63" <? if($city==63) { echo "selected";} ?>>ANKLESHWAR</option>
<option value="64" <? if($city==64) { echo "selected";} ?>>DAHOD</option>
<option value="65" <? if($city==65) { echo "selected";} ?>>JAMNAGAR</option>
<option value="66" <? if($city==66) { echo "selected";} ?>>SURENDRANAGAR</option>
<option value="67" <? if($city==67) { echo "selected";} ?>>GANDHIDHAM</option>
<option value="68" <? if($city==68) { echo "selected";} ?>>JUNAGADH</option>
<option value="69" <? if($city==69) { echo "selected";} ?>>JETPUR</option>
<option value="70" <? if($city==70) { echo "selected";} ?>>BHUJ</option>
<option value="72" <? if($city==72) { echo "selected";} ?>>Balotra</option>
<option value="73" <? if($city==73) { echo "selected";} ?>>Hanumangarh</option>
<option value="74" <? if($city==74) { echo "selected";} ?>>Sikar</option>
</select>
</td><td></td></tr>
  <tr><td colspan="3">&nbsp;</td></tr>
   <tr>    
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

		$result = ExecQuery("select FeedbackID from Req_Feedback where AllRequestID=$RequestID and BidderID=".$_SESSION['BidderID']);		
		$num_rows = mysql_num_rows($result);
		if($num_rows > 0)
		{
			$row = mysql_fetch_array($result);
			$strSQL="Update Req_Feedback Set Feedback='".$Feedback."' ";
			$strSQL=$strSQL."Where FeedbackID=".$row["FeedbackID"];
		}
		else
		{
			$strSQL="Insert into Req_Feedback(AllRequestID, BidderID, Reply_Type , Feedback) Values (";
			$strSQL=$strSQL.$RequestID.",".$_SESSION['BidderID'].",".$pro_code.",'".$Feedback."')";
		}

//		echo $strSQL;
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
			$FeedbackClause=" AND (Req_Feedback.Feedback IS NULL OR Req_Feedback.Feedback='') ";
		}
		else if($varCmbFeedback=="All")
		{
			$FeedbackClause=" ";
		}
		else
		{
			$FeedbackClause=" AND Req_Feedback.Feedback='".$varCmbFeedback."' ";
		}

	?>
 <p class="bodyarial11"><?=$Msg?></p>
 <table width="950" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#FFFFFF" >
 <? 
	if($city>0)
		{
			$biddervalue="(".$branch.")";
			//echo "if:: ";
		}
		else
		{
			$biddervalue="('33')";
			//echo "else:: ";
		}
		$search_qry="SELECT *,Req_Feedback_Bidder_PL.BidderID AS sentbidder FROM Req_Feedback_Bidder_PL,`".$val."` LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID=Req_Loan_Personal.RequestID AND Req_Feedback.BidderID in ".$biddervalue." WHERE Req_Feedback_Bidder_PL.AllRequestID=`".$val."`.RequestID and Req_Feedback_Bidder_PL.BidderID in ".$biddervalue." and Req_Feedback_Bidder_PL.Reply_Type=".$pro_code." and (Req_Feedback_Bidder_PL.Allocation_Date  Between '".($min_date)."' and '".($max_date)."' ) ";	
		//$search_qry=$search_qry.$FeedbackClause;
		$search_qry=$search_qry."group by ".$val.".Mobile_Number";
		$search_qry=$search_qry." order by ".$val.".Dated DESC";

		$qry="SELECT RequestID,Name,City,Mobile_Number,Net_Salary,Loan_Amount,Employment_Status,Feedback FROM Req_Feedback_Bidder_PL,`".$val."` LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID=Req_Loan_Personal.RequestID AND Req_Feedback.BidderID in ".$biddervalue." WHERE Req_Feedback_Bidder_PL.AllRequestID=`".$val."`.RequestID and Req_Feedback_Bidder_PL.BidderID in ".$biddervalue."  and Req_Feedback_Bidder_PL.Reply_Type=".$pro_code." and (Req_Feedback_Bidder_PL.Allocation_Date Between '".($min_date)."' and '".($max_date)."' ) ";
		//$qry=$qry.$FeedbackClause;
		$qry=$qry."group by ".$val.".Mobile_Number";		
	
	//echo"hello".$qry."<br>";
		$result=ExecQuery($qry);
		$recordcount = mysql_num_rows($result);
 ?>
   <tr>
     <td colspan="11" style="border-bottom:1px solid #45B2D8;"><strong><? echo $startrow+1; ?> to <? echo min($startrow+$pagesize,$recordcount); ?> Out of <? echo $recordcount; ?> Records </strong></td>
     </tr>
   <tr>   
     <td width="149" align="center" bgcolor="#FFFFFF" class="style2">Name</td>
	  <td width="70" align="center" bgcolor="#FFFFFF" class="style2">City</td>
     <td width="88" align="center" bgcolor="#FFFFFF" class="style2">Mobile</td>
     <td width="91" align="center" bgcolor="#FFFFFF" class="style2">Net Salary </td>
	   <td width="75" align="center" bgcolor="#FFFFFF" class="style2">DOB</td>
     <td width="90" align="center" bgcolor="#FFFFFF" class="style2">Loan Amount </td>
     <td width="141" align="center" bgcolor="#FFFFFF" class="style2">Employment Status </td>
	  <td width="141" align="center" bgcolor="#FFFFFF" class="style2">Feedback </td>    
   <?php      if(($IP=="182.71.109.218" || $IP=="122.176.100.27" || $IP=="122.176.100.28" || $IP=="122.176.122.134" || $IP=="122.161.196.68" || $IP=="61.246.3.127" || $IP=="122.160.30.168" || $IP=="180.188.224.34" || $IP=="122.161.193.191" || $IP=="122.160.74.241" || $IP=="122.160.74.235" || $IP=="1.23.114.53" || "185.93.231.12"))
	{ ?>
   	  <td width="90" align="center" bgcolor="#FFFFFF" class="style2">Feedback</td>
	   <td width="90" align="center" bgcolor="#FFFFFF" class="style2">Comment</td>          
    <?php }
    ?>
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
				
		$qry="SELECT RequestID,Name,City,Mobile_Number,Net_Salary,Loan_Amount,Employment_Status,Feedback, Req_Feedback_Bidder_PL.BidderID AS sentbidder FROM Req_Feedback_Bidder_PL,`".$val."` LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID=Req_Loan_Personal.RequestID AND Req_Feedback.BidderID in ".$biddervalue." WHERE Req_Feedback_Bidder_PL.AllRequestID=`".$val."`.RequestID and Req_Feedback_Bidder_PL.BidderID in ".$biddervalue." and Req_Feedback_Bidder_PL.Reply_Type=".$pro_code." and ( Req_Feedback_Bidder_PL.Allocation_Date Between '".($min_date)."' and '".($max_date)."' ) ";
		//$qry=$qry.$FeedbackClause;
		$qry=$qry."group by ".$val.".Mobile_Number";
		$qry=$qry." order by ".$val.".Dated DESC";
		$qry=$qry." LIMIT $startrow, $pagesize"; 
		$result=ExecQuery($qry);

		$i=1;
		if($recordcount>0)
		{
		while($row=mysql_fetch_array($result))
		{
	?>
	<input type="hidden" name="requestid_<? echo $i;?>" id="requestid_<? echo $i;?>" value="<? echo $row["RequestID"];?>">
		<input type="hidden" name="product_<? echo $i;?>" id="product_<? echo $i;?>" value="<? echo $pro_code;?>">
			<input type="hidden" name="bidderid" id="bidderid" value="<? echo $_SESSION['BidderID'];?>">
            
   <tr>
       <td align="center" bgcolor="#DFF6FF" class="style3" ><? echo $row["Name"]; ?></td>
	  <td align="center" bgcolor="#DFF6FF" class="style3"><? echo $row["City"]; ?></td>
     <td align="center" bgcolor="#DFF6FF" class="style3"><? echo $row["Mobile_Number"]; ?></td>
     <td align="center" bgcolor="#DFF6FF" class="style3"><? echo $row["Net_Salary"]; ?></td>
	     <td align="center" bgcolor="#DFF6FF" class="style3"><? echo $row["DOB"]; ?></td>
     <td align="center" bgcolor="#DFF6FF" class="style3"><? echo $row["Loan_Amount"]; ?></td>
     <td align="center" bgcolor="#DFF6FF" class="style3"><? if($row["Employment_Status"]==0) { echo "Self Employed"; } else { echo "Salaried"; }?></td> 
	 <td align="center" bgcolor="#DFF6FF" class="style3"><? echo $row["Feedback"]; ?></td>   		
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
	} 
	?>	
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
 <table width="500" border="0" cellspacing="1" cellpadding="4">
 <tr><td>
 <!--<table border="0" cellspacing="0" cellpadding="0">
 <form name="frmdownload" action="fullerton_download.php" method="post">
   <tr>
     <td align="center">
	   <input type="hidden" name="qry1" value="<? echo $search_qry; ?>">
        <input type="hidden" name="BidderIDstatic" value="<? echo $_SESSION['BidderID'];?>">
	   <input type="hidden" name="qry2" value="<? echo $val; ?>">	 
	    <input type="hidden" name="min_date" value="<? echo $min_date; ?>">
	   <input type="hidden" name="max_date" value="<? echo $max_date; ?>">
	 <input name="Submit2" type="submit" class="bluebtn" value="Export List To Open Office">
	 </td>
   </tr>
   </table>-->
 </form>
 </td>
 <td>
 <table border="0" cellspacing="0" cellpadding="0">
 <form name="xlsdownload" action="bidder_download.php" method="post">
   <tr>
     <td align="center">
       <input type="hidden" name="BidderIDstatic" value="<? echo $_SESSION['BidderID'];?>">
	   <input type="hidden" name="qry1" value="<? echo $search_qry; ?>">
	   <input type="hidden" name="qry2" value="<? echo $val; ?>">
	   <input type="hidden" name="min_date" value="<? echo $min_date; ?>">
	   <input type="hidden" name="max_date" value="<? echo $max_date; ?>">
	   <input name="Submit2" type="submit" class="bluebtn" value="Export List To Excel">
	 </td>
   </tr>
 </form><table>
 </td></tr>
 </table>
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
</body>
</html>
