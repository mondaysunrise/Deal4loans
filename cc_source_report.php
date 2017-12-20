<?php
	require 'scripts/session_check_online.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

	$search="";
	if(isset($_GET['search']))
	{
		$search=$_GET['search'];
	}
	
	$min_date="";
	if(isset($_POST['min_date']))
	{
		$min_date=$_POST['min_date'];
	}
	
	$max_date="";
	if(isset($_POST['max_date']))
	{
		$max_date=$_POST['max_date'];
	}
	
	
	//Paging
	$pagesize=150;
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
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Login</title>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<link rel="stylesheet" type="text/css" href="css/menu.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link href="includes/style.css" rel="stylesheet" type="text/css">

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
  ventana = open("","calendario","width=220,height=270");
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
	document.frmsearch.action="cc_source_report.php?search=y"+gifName;
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
	if(document.frmsearch.min_date.value<"2009-02-01")
	{
		alert("Sorry!!!! Your minimum date is 2009-02-01.Please Select.");
		document.frmsearch.min_date.value="";
		document.frmsearch.min_date.focus();
		return false;
	}
	if(document.frmsearch.max_date.value=="")
	{
		alert("Sorry!!!! Please Select Maximum Date.");
		document.frmsearch.max_date.value="";
		document.frmsearch.max_date.focus();
		return false;
	}

}
</script>
<link href="style.css" rel="stylesheet" type="text/css" />
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<style>
.newstyle
{ 
	font-family:verdana;
	color:white;
	font-weight:bold;

}
</style>

</head>

<body>

<div align="center">
<div id="dvContainer">
  <!-- Start Top Panel -->
  <div id="dvTopPanel">
    <div id="dvLogoPanel">
      <div id="dvLogo"><img src="/images/logo.gif" alt="Deal4Loans" /></div>
      <div id="dvTopRightPanel">
	    <h1>
	 <?php 
	 if(isset($_SESSION['UserType']))
	{
echo "<font style='Font-size:12px;'>Welcome ".ucwords($_SESSION['UserType'])." <b>".$_SESSION['UName']." ( <a href=/Logout.php>Logout</a> )</b>";
	}		
	?>	  
</h1>
      </div>
    </div>
  </div>  
 <? $current_date=date('Y-m-d');
 ?>
 <form name="frmsearch" action="cc_source_report.php?search=y" method="post" onSubmit="return chkform();">
  <table width="750" border="0" cellpadding="4" cellspacing="1" class="blueborder">

  <tr>
     <td colspan="3" align="right"><a href="/allproductslogin_index.php">HOME</a></td>
     </tr>
   <tr>
     <td colspan="3" class="head1" align="center">Allocated Leads for SBI</td>
     </tr>
   <tr>
     <td colspan="3">&nbsp;</td>
   </tr>
   <tr>
     <td width="20%"><strong>Date:</strong></td>
     <td width="60%">From 
       <input name="min_date" type="text" id="min_date" size="15" <? if($min_date=="") { ?>value="<? echo $current_date; ?>"<? } else { ?>value="<? echo $min_date; ?>" <? }?>>
       <input name="b12" type="button" class="bluebutton" onClick="javascript:pedirFecha(min_date,'');" value="&lt; Insert">     
         To <span class="bodyarial11">
         <input name="max_date" type="text" id="max_date" size="15" value="<? echo $max_date; ?>">
         <input name="b122" type="button" class="bluebutton" onClick="javascript:pedirFecha(max_date,'');" value="&lt; Insert">
        </span></td>
   <td align="center" width="20%"><input name="Submit" type="submit" class="bluebutton" value="Search" border="0"></td>
     </tr>
 
 </table>
   </form>
 <p>&nbsp;</p>
	<?
	$search_date="";
	if($search=="y")
	{
		$min_date=$min_date." 00:00:00";
		$max_date=$max_date." 23:59:59";
	
	?>
 <table width="758" border="0" cellpadding="4" cellspacing="1" class="blueborder">

   <tr>
     <td class="head1">Source</td>
     <td class="head1">Count of Approved SBI Leads</td>
	 <td class="head1">Total Leads </td>
	<!-- <td class="head1">Credit Card Name </td>
	  <td class="head1">Debit Card Bank </td>
	 <td class="head1">Debit Card Name </td>
    <td class="head1">Source</td>-->       
   </tr>
	<?php
	$qry1="SELECT COUNT( * ) as countleads , source FROM Req_Credit_Card WHERE RequestID IN ( SELECT RequestID FROM  `sbi_credit_card_5633` WHERE  `ProcessingStatus` =1 AND  `first_dated` BETWEEN  '".$min_date."' AND  '".$max_date."' and process_type!='TWL_LMS' and productflag!=10 ) GROUP BY source  order by countleads desc";
		$result1=ExecQuery($qry1);
		$recordcount = mysql_num_rows($result1);

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
		//echo "<br>".$maxpage."<br>";
		
		$qry="SELECT COUNT( * ) as countleads , source FROM Req_Credit_Card WHERE RequestID IN ( SELECT RequestID FROM  `sbi_credit_card_5633` WHERE  `ProcessingStatus` =1 AND  `first_dated` BETWEEN  '".$min_date."' AND  '".$max_date."' and process_type!='TWL_LMS' and productflag!=10 ) GROUP BY source  order by countleads desc  LIMIT $startrow, $pagesize";
		$result=ExecQuery($qry);
		$recordcount = mysql_num_rows($result);
	//	echo "<br>".$qry."<br>";
//echo "<pre>";		print_r($result);
		$i=1;
		if($recordcount>0)
		{
		while($row=mysql_fetch_array($result))
		{
			$source = $row["source"];
	?>
   <tr>
<td class="bodyarial11"><? echo $source;?></td>
<td class="bodyarial11"><? echo $row["countleads"];?></td>
<td class="bodyarial11">
<?php 
$table = '';
if($source=='SMS_Lead_ICCS' || $source=='SMS_LeadNew')
{
	$table = 'Req_Credit_Card_Sms';
}
else
{
	$table = 'Req_Credit_Card';
}
$totalSql = "SELECT COUNT( * ) as countTotal FROM ".$table." WHERE source='".$source."' AND  `Dated` BETWEEN  '".$min_date."' AND  '".$max_date."'";
$totalQuery = ExecQuery($totalSql);
echo $countTotal = mysql_result($totalQuery,0,'countTotal');
?></td>
   
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
 </center>
</div>
</body>

</html>