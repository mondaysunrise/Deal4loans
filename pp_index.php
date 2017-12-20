<?php
	require 'scripts/session_check_online.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';	
	
 
	$search="";
	if(isset($_REQUEST['search']))
	{
		$search=$_REQUEST['search'];
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


	//Paging
	$pagesize=40;
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
	
?>
<html>
<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=WINDOWS-1252">
<title>Login</title>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<link href="includes/style1.css" rel="stylesheet" type="text/css">
<link href="style.css" rel="stylesheet" type="text/css" />

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
}.bluebtn{
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

.style4 {
	color: #0033FF;
	font-weight: bold;
}
.style6 {color: #084459; font-weight: bold; }
</style>
<script type="text/JavaScript">
<!--//date function complete start here>>>
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
	document.frmsearch.action="pp_index.php?search=y"+gifName;
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
		if(document.frmsearch.min_date.value<"2009-12-15")
	{
		alert("Sorry!!!! Your minimum date is 2009-12-15. Please Select.");
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
//alert( selObj.selectedIndex);
 eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
 if (restore) selObj.selectedIndex=0;
}
</script>
<script language="Javascript">

<!--

function toggleDiv(id,flagit) {

if (flagit=="1"){

if (document.layers) document.layers[''+id+''].visibility = "show"

else if (document.all) document.all[''+id+''].style.visibility = "visible"

else if (document.getElementById) document.getElementById(''+id+'').style.visibility = "visible"

}

else

if (flagit=="0"){

if (document.layers) document.layers[''+id+''].visibility = "hide"

else if (document.all) document.all[''+id+''].style.visibility = "hidden"

else if (document.getElementById) document.getElementById(''+id+'').style.visibility = "hidden"

}

}

//-->

</script>
</head>
<?php 
 if(isset($_SESSION['UserType']))
{
	include "pp_lms_head.php";
}
?>

<table width="100%" border="0"  align="center" cellpadding="0" cellspacing="0" >

<tr>
    <td align="center">
	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#45B2D8">
      
	
	<tr><td>&nbsp;</td></tr>
 <tr><td align="center">
 
 <table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
   <tr>
     <td height="30" align="center" valign="middle"><img src="images/login-srch-pnl.gif" width="650" height="30"></td>
   </tr>
      <tr>
     <td height="30" align="center" valign="middle" class="style1"  background="images/login-form-login-bg.gif" style="font-size:14px;">&nbsp;</td>
   </tr>
   <tr>
     <td align="center" valign="middle" background="images/login-form-login-bg.gif"><table width="95%" border="0"  cellpadding="1" cellspacing="0">
 <form name="frmsearch" action="pp_index.php?search=y" method="post" onSubmit="return chkform();">
 
  
  
   <tr>
   <td colspan="3" align="center">
   <table border="0" width="90%" cellpadding="0" cellspacing="0"><tr>
     <td width="20%" valign="middle" class="style1">&nbsp;&nbsp;Date&nbsp;&nbsp; From </td>
     <td width="24%" align="left" valign="middle" class="bidderclass"><?$current_date=date('Y-m-d');?> 
	     <input name="min_date" type="text" id="min_date" size="15" <? if($min_date=="") { ?>value="<? echo $mindefineDate; ?>"<? } else { ?>value="<? echo $min_date; ?>" <? }?>></td>
     <td width="7%" align="left" valign="middle" class="bidderclass"><input name="b12" type="button" class="buttonfordate" onClick="javascript:pedirFecha(min_date,'');" value="&lt; Insert" bgcolor="#45B2D8"> </td>
  
     <td valign="middle" align="center" class="style1" width="8%">To</td>
     <td align="left" valign="middle" class="style1" width="24%"> <input name="max_date" type="text" id="max_date" size="15" value="<? echo $max_date; ?>"></td>
     <td align="left" valign="middle" class="style1" width="17%"><input name="b122" type="button" class="buttonfordate" onClick="javascript:pedirFecha(max_date,'');" value="&lt; Insert"></td>
	   </tr>
	   </table>
	   </td></tr>
   <tr>
   <td colspan="3" align="center"><table border="0" cellpadding="0" cellspacing="0" width="85%">
     <td width="30%" valign="middle" class="style1"></td>
     <td width="30%"  valign="middle" class="bidderclass">
	<input type="hidden" name="product" id="product" value="Req_Loan_Personal">
	 </td>
     <td width="10%"  valign="middle" class="bidderclass">&nbsp;</td>
   
     <td width="30%" valign="middle" class="style1">Bidders:</td>
     <td width="50%" align="left" valign="middle" class="bidderclass">
		<select name="cmbfeedback" id="cmbfeedback" style="width:190px;">
		<option value="1" <? if($varCmbFeedback == "1") { echo "selected"; } ?>>HDFC Cards</option>
		<option value="2" <? if($varCmbFeedback == "2") { echo "selected"; }?>>Fullerton PL Internal</option>
		<option value="3" <? if($varCmbFeedback == "3") { echo "selected"; }?>>Fullerton PL FIL</option>
		<option value="4" <? if($varCmbFeedback == "4") { echo "selected"; }?>>Fullerton PL Small Cities</option>
		<option value="5" <? if($varCmbFeedback == "5") { echo "selected"; }?>>Stanc Cards</option>
        <option value="6" <? if($varCmbFeedback == "6") { echo "selected"; }?>>ING Vysya PL</option>
        <option value="7" <? if($varCmbFeedback == "7") { echo "selected"; }?>>Bajaj Finserv PL</option>
    <!--     <option value="8" <? if($varCmbFeedback == "8") { echo "selected"; }?>>Citibank PL</option> -->
        <option value="9" <? if($varCmbFeedback == "9") { echo "selected"; }?>>HDBFS PL</option>
        <option value="10" <? if($varCmbFeedback == "10") { echo "selected"; }?>>HDFC Car Loan</option>
        <option value="11" <? if($varCmbFeedback == "11") { echo "selected"; }?>>HDFC Personal Loan</option>    

	   <option value="12" <? if($varCmbFeedback == "12") { echo "selected"; }?>>ICICI Cards</option>
          <option value="13" <? if($varCmbFeedback == "13") { echo "selected"; }?>>FedBank LAP</option>
        <option value="14" <? if($varCmbFeedback == "14") { echo "selected"; }?>>FedBank HL</option>
        <option value="15" <? if($varCmbFeedback == "15") { echo "selected"; }?>>Kotak PL</option> 
		<option value="16" <? if($varCmbFeedback == "16") { echo "selected"; }?>>Indus PL </option>
<option value="17" <? if($varCmbFeedback == "17") { echo "selected"; }?>>Citi PL (Andro)</option>
<option value="18" <? if($varCmbFeedback == "18") { echo "selected"; }?>>SCB PL (Andro)</option>
<option value="19" <? if($varCmbFeedback == "19") { echo "selected"; }?>>ICICI PL (Andro)</option>
		
	
    	</select>	 </td>
     
	   </tr>
</table></td></tr>
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


	if($search=="y")
	{

	//	print_r($_POST);
		$min_date=$min_date." 00:00:00";
		$max_date=$max_date." 23:59:59";
		$min_pieces = explode("-", $min_date);
		$max_pieces = explode("-", $max_date);
		$min_month = $min_pieces[1];
		$min1_month = $min_pieces[1] - 1;
		$max1_month = $max_pieces[1] - 1;
		$min1_mktime = mktime(0, 0, 0, $min1_month  , $min_pieces[2], $min_pieces[0]);
		$max1_mktime = mktime(0, 0, 0, $max1_month  , $max_pieces[2], $max_pieces[0]);
		$min1_date = date("Y-m-d",$min1_mktime)." 00:00:00";
		$max1_date = date("Y-m-d",$max1_mktime)." 23:59:59";

		$min2_month = $min_pieces[1] - 2;
		$max2_month = $max_pieces[1] - 2;
		$min2_mktime = mktime(0, 0, 0, $min2_month  , $min_pieces[2], $min_pieces[0]);
		$max2_mktime = mktime(0, 0, 0, $max2_month  , $max_pieces[2], $max_pieces[0]);
		$min2_date = date("Y-m-d",$min2_mktime)." 00:00:00";
		$max2_date = date("Y-m-d",$max2_mktime)." 23:59:59";
		
		if($varCmbFeedback==1)//HDFC Cards
		{
			$BidderID_str = '2009';
			$Reply_Type = 4;
		}
		else if($varCmbFeedback==2)//Fullerton PL Internal
		{
			$BidderID_str = '996,1000,1012,1015,1037,1050';
			$Reply_Type = 1;
		} 
		else if($varCmbFeedback==3)//Fullerton PL FIL
		{
			$BidderID_str = '1739,1745,1746,1747,1748,1749,1752,1753,1754,1755,1782,1783,1784,1808,1806,1807,1809,1810,1811,1812,1813,1863,1864,1865,1866,1869,1870,1892,1893,1894,1895,1902,1910,1922,1923,1924,1990,2004,2023,2024,2026,2152,2033,2034,2050,2051,2052,2053,2056,2057,2058,2059,2060,2061,2062,2063,2064,2065,2066,2067,2068,2069,2070,2071,2,116,2132,2155,2158,2606,1262,2477,2478,2488,2489,2487,2372,2330,2329,223,2195,2181,2161,2705,2710,2714,2717,2716,2763';
			$Reply_Type = 1;
		}
		else if($varCmbFeedback==4)//Fullerton PL Small Cities
		{
			$BidderID_str = '1360,1361,1362,1363,1372,1375,1523,1524,1359,1364,1365,1370,1519,1520,1521,1522,1366,1367,1368,1369,1515,1516,1517,1518,1371,1373,1374,1376,1525,1526,1527,1029,1215,1221,1222,1642,1641,1090,1091,1092,1093,1871,1872,1873,1874,1875,1876,1877,1292,1432,1436,1439,1204,1223,1424,1425,1429,1433,1435,1293,1427,1428,1431,1437,1294,1423,1426,1430,1434,1438,1470,1471,1473,1480,2295,1095,1096,1097,1098,1106,1108,1102,1105,1163,1100,1103,1104,1107,1379,1381,1387,1385,1384,1380,1386,1125,1378,1383,1377,1686,1284,1295,1287,1546,1547,1548,1549,1550,1551,1552,1553,1554,1555,1556,1557,1558,1559,1560,1561,1562,1338,1339,1340,1343,1347,1348,1350,1451,1452,1342,1344,1345,1346,1453,1454,1456,1455,1351,1353,1354,1355,1356,1357,1462,1463,1464,1465,1349,1352,1358,1457,1458,1459,1460,1461,1164,1165,1162,1166,1167,1168,1226,1597,1598,1599,1600,1601,1602,1603,1857,1858,1859,1860,1861,1025,1675,2168,2296,2297,2298,2299,2300,2301,2302,2303,2304,2305,2335,2336,2337,2338,2339,2340,2341,2342,2343,2344,2280,2281,2283,2284,2285,2286,2287,2288,2289,2290,2291,2292,2293,2294,2295';
			$Reply_Type = 1;
		}
		else if($varCmbFeedback==5)//Stanc Cards
		{
			$BidderID_str = '2370';
			$Reply_Type = 4;
		}
		else if($varCmbFeedback==6)//ING Vysya PL
		{
			$BidderID_str = '2490,2496,2497,2498,2499,2500,2813,4019,4020';
			$Reply_Type = 1;
		}
		else if($varCmbFeedback==7)//Bajaj Finserv PL
		{
			$BidderID_str = '2422,2423,2424,2425,2426,2427,2428,2429,2430,2431,2432,2433,2434,2435,2436,2437,2438,2439,2440,2441,2442,2443,2444,2445,2446,2447,2448,2449,2450,2451,2476';
			$Reply_Type = 1;
		}
		else if($varCmbFeedback==8)//Citibank PL
		{
			$BidderID_str = '';
			$Reply_Type = 1;
		}
		else if($varCmbFeedback==9)//HDBFS PL
		{
			$BidderID_str = '2400,2401,2402,2403,2404,2405,2406,2407,2471,2472,2473,2474,2475,2470,2469,2468,2467,2466,2465,2464,2463,2462,2461,2460,2459,2458,2457,2691,2859,2860,2858';
			$Reply_Type = 1;
		}
		else if($varCmbFeedback==10)//HDFC CL
		{
			$BidderID_str = '1825';
			$Reply_Type = 3;
		}
		else if($varCmbFeedback==11)//HDFC PL
		{
			$BidderID_str = '1887,1888,1889,1890,1891,1950,1957,1958,1959,1960,2626,2628,2629,2627';
			$Reply_Type = 1;
		}
		else if($varCmbFeedback==12)//ICICI Cards
		{
			$BidderID_str = '3179,3183,3184,3185,3186,3187,3188,3189';
			$Reply_Type = 4;
		}
		else if($varCmbFeedback==13)//FedBank LAP
		{
			$BidderID_str = '3523,3524,3525';
			$Reply_Type = 5;
		}
		else if($varCmbFeedback==14)//FedBank HL
		{
			$BidderID_str = '3512,3513,3514,3515,3516,3517,3518,3519,3520,3521';
			$Reply_Type = 2;
		}
		else if($varCmbFeedback==15)//Kotak PL
		{
			$BidderID_str = '2998,2999,3000,3001,3002,3003,3004,3005,3006,3007,3008,3009,3010,3011,3012,3013,3014,3015';
			$Reply_Type = 1;
		}
		else if($varCmbFeedback==16)//Indus PL
		{
			$BidderID_str = '4083,4084,4085,4086,4087,4088,4089,4090,4091,4092';
			$Reply_Type = 1;
		}
		else if($varCmbFeedback==17)//Citi PL andro
		{
			$BidderID_str = '2721,3359,3722,3208,2722,3390,3579,2809,2723,2830,2830,3376,2937';
			$Reply_Type = 1;
		}
		else if($varCmbFeedback==18)//SCB PL andro
		{
			$BidderID_str = '3724,3725,3725,3726,3727,3787,3788,3870,3900,3968';
			$Reply_Type = 1;
		}
		else if($varCmbFeedback==19)//ICICI PL andro
		{
			$BidderID_str = '2917,2918,2919,2963,2982,2983,2983,2996,3134,3195,3216,3241,3254,3255,3256,3257,3258,3364,3371,3380,3450,3553,3259,3382,3452,3449,2963,3581,3595,3537,3658,3753,3754,3554,3383,3451,3132,3197,3381,3532,3198,3533,2962,2984,2995,3061,3133,3196,3199,3407,3868,3944,3945,3553,4032,2917';
			$Reply_Type = 1;
		}
		
	?>
  
 <p class="bodyarial11"><?=$Msg?></p>
 <table width="950" border="0" align="center" cellpadding="4" cellspacing="4" bgcolor="#FFFFFF" >
 
   <tr>   
     <td width="351" align="center" bgcolor="#FFFFFF" class="style2">Bidder Name</td>
	 <td width="224" align="center" bgcolor="#FFFFFF" class="style2">

	 <?php
	 $mkTime =  mktime(0, 0, 0,$min_month  , $min_pieces[2], $min_pieces[0]);
	  echo date("F, Y", $mkTime); ?>
     
     </td>
	 <td width="175" align="center" bgcolor="#FFFFFF" class="style2">
     <?php
	 $m1 = 
	 $mkTimeLM =  mktime(0, 0, 0, $min1_month  , $min_pieces[2], $min_pieces[0]);
	 echo date("F, Y", $mkTimeLM);
	 ?>     </td>
	 <td width="148" align="center" bgcolor="#FFFFFF" class="style2">
	 <?php
	 $mkTimeLTLM =  mktime(0, 0, 0, $min2_month  , $min_pieces[2], $min_pieces[0]);
	 echo date("F, Y", $mkTimeLTLM);
	 ?></td>
   </tr>
	<?php
if($varCmbFeedback == "6")
{
if($max_date<'2012-05-29' || $min_date<'2012-05-29')
	{
		$min_dateing = "2012-05-29";
	}
	else
	{
		$min_dateing = $min_date;
	}
$qryEx1="SELECT ingvyasyaplid FROM ingvyasya_pl_calc_leads where net_salary>=30000 and  (city in ('Bangalore','Chennai','Hyderabad','Delhi','Gaziabad','Noida','Gurgaon','Faridabad','Sahibabad','Mumbai','Navi mumbai','Thane','Pune','Jaipur') and eligible_loanAmt!='' and  (Dated  Between '".($min_dateing)."' and '".($max_date)."'))";
		$res1=ExecQuery($qryEx1);
		$rcount1 = mysql_num_rows($res1);
	
	if($max1_date<'2012-05-29' || $min1_date<'2012-05-29')
	{
		$min1_dateing = "2012-05-29";
	}
	else
	{
		$min1_dateing = $min1_date;
	}
	
	$qryEx2="SELECT ingvyasyaplid FROM ingvyasya_pl_calc_leads where net_salary>=30000 and  (city in ('Bangalore','Chennai','Hyderabad','Delhi','Gaziabad','Noida','Gurgaon','Faridabad','Sahibabad','Mumbai','Navi mumbai','Thane','Pune','Jaipur') and eligible_loanAmt!='' and  (Dated  Between '".($min1_dateing)."' and '".($max1_date)."'))";
		$res2=ExecQuery($qryEx2);
		 $rcount2 = mysql_num_rows($res2);
	
	if($max2_date<'2012-05-29' || $min2_date<'2012-05-29')
	{
		$min2_dateing = "2012-05-29";
	}
	else
	{
		$min2_dateing = $min2_date;
	}
	
	 $qryEx3="SELECT ingvyasyaplid FROM ingvyasya_pl_calc_leads where net_salary>=30000 and  (city in ('Bangalore','Chennai','Hyderabad','Delhi','Gaziabad','Noida','Gurgaon','Faridabad','Sahibabad','Mumbai','Navi mumbai','Thane','Pune','Jaipur') and eligible_loanAmt!='' and  (Dated  Between '".($min2_dateing)."' and '".($max2_date)."'))";
		$res3=ExecQuery($qryEx3);
		$rcount3 = mysql_num_rows($res3);

}
elseif($varCmbFeedback == "7")
		{

$qryEx1="SELECT bajajcibilid FROM bajaj_cibildetails where (bajaj_dated Between '".($min_date)."' and '".($max_date)."')";
		$res1=ExecQuery($qryEx1);
		$rcount1 = mysql_num_rows($res1);

		$qryEx2="SELECT bajajcibilid FROM bajaj_cibildetails where (bajaj_dated Between '".($min1_date)."' and '".($max1_date)."')";
		$res2=ExecQuery($qryEx2);
		$rcount2 = mysql_num_rows($res2);

	$qryEx3="SELECT bajajcibilid FROM bajaj_cibildetails where (bajaj_dated Between '".($min2_date)."' and '".($max2_date)."')";
		$res3=ExecQuery($qryEx3);
		$rcount3 = mysql_num_rows($res3);

		}
else
{
	$rcount1 = '';
	$rcount2 = '';
	$rcount3 = '';
}
?>

       <tr> 
     <td align="center" bgcolor="#999999" class="style3" height="20" style="color:#FFFFFF;" >
	   <span class="style4"> Total </span></td>
     <td align="center" bgcolor="#999999" class="style3" style="color:#FFFFFF;" >
      <strong> <?php 
	 $getCount1Sql = "select sum(BookLeadCount) as sum from Bidders_Book_Keeping where BidderID in (".$BidderID_str.") and BookProduct='".$Reply_Type."' and (BookEntryTime between '".$min_date."' and '".$max_date."')";
	 //echo $getCount1Sql."<br>";
	 $getCount1Query = ExecQuery($getCount1Sql);
	 $sum1 = mysql_result($getCount1Query,0,'sum');
	 echo $sum1 +$rcount1;
	 ?></strong>       </td>
     <td align="center" bgcolor="#999999" class="style3" style="color:#FFFFFF;" >
<strong>	  <?php 
	 $getCount1Sql = "select sum(BookLeadCount) as sum from Bidders_Book_Keeping where BidderID in (".$BidderID_str.") and BookProduct='".$Reply_Type."' and (BookEntryTime between '".$min1_date."' and '".$max1_date."')";
	 //echo $getCount1Sql."<br>";
	 $getCount1Query = ExecQuery($getCount1Sql);
	 $sum1 = mysql_result($getCount1Query,0,'sum');
	 echo $sum1 + $rcount2;
	 ?>
</strong>     </td>
     <td align="center" bgcolor="#999999" class="style3" style="color:#FFFFFF;" >
<strong>	 <?php 
	 $getCount1Sql = "select sum(BookLeadCount) as sum from Bidders_Book_Keeping where BidderID in (".$BidderID_str.") and BookProduct='".$Reply_Type."' and (BookEntryTime between '".$min2_date."' and '".$max2_date."')";
	 //echo $getCount1Sql."<br>";
	 $getCount1Query = ExecQuery($getCount1Sql);
	 $sum1 = mysql_result($getCount1Query,0,'sum');
	 echo $sum1 + $rcount3;
	 ?>
</strong>     </td>
      </tr>

<?php
if($varCmbFeedback == "6")
{
?>
<tr> 
     <td align="center" bgcolor="#DFF6FF" class="style3" height="20" style="color:#FFFFFF;" >
	   <span class="style6"> Exclusive </span></td>
     <td align="center" bgcolor="#DFF6FF" class="style3" style="color:#FFFFFF;" >
       <span class="style6"> 
       <?php 		echo $rcount1;	 ?>
         </span></td>
     <td align="center" bgcolor="#DFF6FF" class="style3" style="color:#FFFFFF;" >
       <span class="style6">	  
           <?php 		echo $rcount2;	 ?>    </span></td>
     <td align="center" bgcolor="#DFF6FF" class="style3" style="color:#FFFFFF;" >
       <span class="style6">	 
       <?php 
		echo $rcount3 ;
	 ?>
        </span></td>
      </tr>
      
      <?php
	  }
if($varCmbFeedback == "7")
{
?>
<tr> 
     <td align="center" bgcolor="#DFF6FF" class="style3" height="20" style="color:#FFFFFF;" >
	   <span class="style6"> Green Channel </span></td>
     <td align="center" bgcolor="#DFF6FF" class="style3" style="color:#FFFFFF;" >
       <span class="style6"> 
       <?php 		echo $rcount1;	 ?>
         </span></td>
     <td align="center" bgcolor="#DFF6FF" class="style3" style="color:#FFFFFF;" >
       <span class="style6">	  
           <?php 		echo $rcount2;	 ?>    </span></td>
     <td align="center" bgcolor="#DFF6FF" class="style3" style="color:#FFFFFF;" >
       <span class="style6">	 
       <?php 
		echo $rcount3 ;
	 ?>
        </span></td>
      </tr>
      
      <?php
	  }
	 
	  ?>
<? 
	$qry="SELECT * FROM Bidders_List WHERE BidderID in (".$BidderID_str.") and Reply_Type='".$Reply_Type."'";
	$qry=$qry." order by BidderID DESC";
//echo $qry;
	$result=ExecQuery($qry);
	$recordcount = mysql_num_rows($result);
	
		$maxpage = $recordcount % $pagesize;
		if($recordcount % $pagesize == 0)
		{
			$maxpage = $recordcount / $pagesize;
		}
		else
		{
			$maxpage = ceil($recordcount / $pagesize);
		}

		$qry1="SELECT BidderID, Reply_Type, Restrict_Bidder FROM Bidders_List WHERE BidderID in (".$BidderID_str.") and Reply_Type='".$Reply_Type."'";
		$qry1=$qry1." order by BidderID DESC";
		$qry1=$qry1." LIMIT $startrow, $pagesize"; 
		//echo $qry;
		$result1=ExecQuery($qry1);
		$recordcount1 = mysql_num_rows($result1);
	//echo $BidderID_str;
	//$BidderArr = explode(",", $BidderID_str);	
//print_r($BidderArr);
$total1[] = '';
$total2[] = '';
$total3[] = '';
	for($bid=0;$bid<$recordcount1;$bid++)
	{	
		$Restrict_Bidder = mysql_result($result1,$bid,'Restrict_Bidder');
		$Reply_Type = mysql_result($result1,$bid,'Reply_Type');		
		$BidderID = mysql_result($result1,$bid,'BidderID');		
 ?>
				
   <tr> 
     <td align="left" bgcolor="#DFF6FF" class="style3" >
   <!--  <div id="div_<?php //echo $bid; ?>">Link 1 text! I've restrained the div size to 200px wide in the style declaration. Modify this to suit yourself.</div> -->
	 <?php
	 $getNameSql = "select * from Bidders where BidderID='".$BidderID."'";
	 $getNameQuery = ExecQuery($getNameSql);
	 $Bidder_Name = mysql_result($getNameQuery,0,'Bidder_Name');
	 $City = mysql_result($getNameQuery,0,'City');
	 echo $Bidder_Name.", ";
	 echo $BidderID.", ";
	 if($Restrict_Bidder==1)
	 {
	 	echo "Active";
	 }
	 else
	 {
	 	echo "Inactive";
	 }
	 echo ", ".$City;
	 ?>  
    <!-- <a href="#" onMouseOver="toggleDiv('div_<?php //echo $bid; ?>',1)" onMouseOut="toggleDiv('div_<?php //echo $bid; ?>',0)"><strong>City</strong></a> -->   </td>
     <td align="center" bgcolor="#DFF6FF" class="style3">
	 <?php
	 //echo $min_date;
	// echo "<br>";
//	 echo $max_date;
	 $getCount1Sql = "select sum(BookLeadCount) as sum from Bidders_Book_Keeping where BidderID='".$BidderID."' and BookProduct='".$Reply_Type."' and (BookEntryTime between '".$min_date."' and '".$max_date."')";
	 //echo $getCount1Sql."<br>";
	 $getCount1Query = ExecQuery($getCount1Sql);
	 $sum1 = mysql_result($getCount1Query,0,'sum');
	 echo $sum1;
	 $total1[] = $sum1;
	 ?>     </td>
	<td align="center" bgcolor="#DFF6FF" class="style3">
	<?php 
	
//	echo $min1_date;
	//echo "<br>";
	//echo $max1_date;
	$getCount2Sql = "select sum(BookLeadCount) as sum from Bidders_Book_Keeping where BidderID='".$BidderID."' and BookProduct='".$Reply_Type."' and (BookEntryTime between '".$min1_date."' and '".$max1_date."')";
	 $getCount2Query = ExecQuery($getCount2Sql);
	$sum2 = mysql_result($getCount2Query,0,'sum');
	echo $sum2;
	$total2[] = $sum2;
	?>    </td>
	 <td align="center" bgcolor="#DFF6FF" class="style3">
	 	<?php 

//	echo $min2_date;
	//echo "<br>";
	//echo $max2_date;
	
	$getCount3Sql = "select sum(BookLeadCount) as sum from Bidders_Book_Keeping where BidderID='".$BidderID."' and BookProduct='".$Reply_Type."' and (BookEntryTime between '".$min2_date."' and '".$max2_date."')";
	 $getCount3Query = ExecQuery($getCount3Sql);
	 $sum3 = mysql_result($getCount3Query,0,'sum');
	 $total3[] = $sum3;
	echo $sum3;
	?>     </td>
   </tr>
   
   
	<?
		}
	?>
       <tr> 
     <td align="center" bgcolor="#999999" class="style3" height="20" style="color:#FFFFFF;" >
	   <span class="style4"> Total </span></td>
     <td align="center" bgcolor="#999999" class="style3" style="color:#FFFFFF;" >
     
      <strong> <?php 
	 echo array_sum($total1) + $rcount1;
	 ?></strong>       </td>
     <td align="center" bgcolor="#999999" class="style3" style="color:#FFFFFF;" >
<strong>	 <?php 
	 echo array_sum($total2) + $rcount2;
	 ?>
</strong>     </td>
     <td align="center" bgcolor="#999999" class="style3" style="color:#FFFFFF;" >
<strong>	 <?php 
	 echo array_sum($total3) + $rcount3;
	 ?>
</strong>     </td>
      </tr>
		</table>
         <br>
	<? 
	//echo $recordcount;
	if($recordcount>0)
	{
	?>

 <table width="758"  border="0" cellpadding="5" cellspacing="1" bgcolor="#FFFFFF" style="border:#DFF6FF 1px solid;">
   <tr>
     <td align="center" class="bluelink" style="font-size:14px; color:#000000; font-weight:bold;">
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
 </table>
  <?php
  }
  ?>

 <?php
		
}
		

	?>
 </table>
 <br>
</td></tr></table>


</body>

</html>
