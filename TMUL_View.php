<?php
require 'scripts/session_checkTM.php';
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
<title>Download</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="includes/style1.css" rel="stylesheet" type="text/css">
<link href="style.css" rel="stylesheet" type="text/css" />
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script language="JavaScript">
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
	if(document.frmsearch.min_date.value<"2007-07-20")
	{
		alert("Sorry!!!! Your minimum date is 2007-07-20.Please Select.");
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

</script>
</head>
<?php include '~TopTM.php';?>
  <div id="dvContentPanel">
   <div id="dvMaincontent">
<br><br>
<TABLE ALIGN="center" WIDTH="50%" CELLPADDING="0" CELLSPACING="0" BORDER="0">
				<TR>
					<TD align="center"><font class="head2">
						Daily Report Summary
					</font></TD>
				</TR>
				<TR>
					<TD align="center"><b>
					&nbsp;
					</b></TD>
				</TR>
</TABLE>
<form name="frmsearch" action="TMUL_View.php?search=y" method="post" onSubmit="return chkform();">
<table width="600" border="0" cellpadding="4" cellspacing="1" class="blueborder" align="center">

   <tr>
     <td colspan="2" class="head1">Search</td>
   </tr>
   <tr>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
   </tr>
   <tr>
     <td width="20%"><strong>Date:</strong></td>
     <td width="80%">From 
       <input name="min_date" type="text" id="min_date" size="15" >
       <input name="b12" type="button" class="bluebutton" onClick="javascript:pedirFecha(min_date,'');" value="&lt; Insert">     
         To <span class="bodyarial11">
         <input name="max_date" type="text" id="max_date" size="15" >
         <input name="b122" type="button" class="bluebutton" onClick="javascript:pedirFecha(max_date,'');" value="&lt; Insert">
        </span></td>
   </tr>
   <tr>
     <td colspan="2" align="center"><input name="Submit" type="submit" class="bluebutton" value="Search" border="0"></td>
     </tr>
</table>
</form>
<br><br>
<?php
  	$search_date="";
	if($search=="y")
	{
	
		if($min_date!="" and $max_date!="")
		{
			$min_date=$min_date." 00:00:00";
			$max_date=$max_date." 23:59:59";
			$search_date=$search_date." and UNIX_TIMESTAMP(Telecaller_Mgmt_User_Lms.TMUL_Date)>='".strtotime($min_date)."' and UNIX_TIMESTAMP(Telecaller_Mgmt_User_Lms.TMUL_Date)<='".strtotime($max_date)."'";
		}
		else if($min_date!="" and $max_date=="")
		{
			$min_date=$min_date." 00:00:00";
			$search_date=$search_date." and UNIX_TIMESTAMP(Telecaller_Mgmt_User_Lms.TMUL_Date)>='".strtotime($min_date)."'";
		}
		else if($min_date=="" and $max_date!="")
		{
			$max_date=$max_date." 23:59:59";
			$search_date=$search_date." and UNIX_TIMESTAMP(Telecaller_Mgmt_User_Lms.TMUL_Date)<='".strtotime($max_date)."'";
		}
		else
		{
			$search_date=$search_date." and Telecaller_Mgmt_User_Lms.TMUL_Date!=''";
		}
?>
<table width="758" border="1" cellpadding="4" cellspacing="1" class="blueborder" align="center">
<tr>
  <td><strong>DataEntry By</strong></td>
  <td><strong>TeleCaller</strong></td>
  <td><strong>Total Entries Done</strong></td>
  <td><strong>Final Entries</strong></td>
  <td><strong>Repeated Entries</strong></td>
  <td><strong>Errors (If Any)</strong></td>
  <td><strong>Date</strong></td>
</tr>
<?php
	$RetrieveSql = "select * from Telecaller_Mgmt_User_Lms where 1=1 ".$search_date."";
	list($RetrieveNumRows,$getrow)=MainselectfuncNew($RetrieveSql,$array = array());
	$cntr=0;
	
	//$RetrieveQuery = ExecQuery($RetrieveSql);
	//$RetrieveNumRows = mysql_num_rows($RetrieveQuery);
	
		while($cntr<count($getrow))
        {
?>
<tr>
  <td>
  <?php 
  $TMULEnteredBy = $getrow[$cntr]['TMUL_EnteredBy'];
  
  $DataEntryNameSql = "select TMU_Name from Telecaller_Mgmt_User where TMU_ID=".$TMULEnteredBy;
   list($recordcount,$Myrow)=MainselectfuncNew($DataEntryNameSql,$array = array());
		$i=0;

  
  //$DataEntryNameQuery = ExecQuery($DataEntryNameSql);
   echo $Myrow[$i];
  
   ?></td>
  <td><?php echo $Myrow[$i]['TMUL_TeleCaller_Name']; ?></td>
  <td><?php echo $Myrow[$i]['TMUL_TotalEntries']; ?></td>
  <td><?php echo $Myrow[$i]['TMUL_FinalEntries']; ?></td>
  <td><?php echo $Myrow[$i]['TMUL_RepeatedEntry']; ?></td>
  <td><?php echo $Myrow[$i]['TMUL_Error']; ?></td>
    <td><?php echo $Myrow[$i]['TMUL_Date']; ?></td>
  </tr>
<?php		
	$cntr = $cntr+1;}
   
  $gettotalsum=("select sum(`TMUL_TotalEntries`) as te,sum(`TMUL_FinalEntries`) as fe,sum(`TMUL_RepeatedEntry`) as re,sum(TMUL_Error) as err from Telecaller_Mgmt_User_Lms where 1=1  ".$search_date."");
  
   list($recordcount,$row)=MainselectfuncNew($gettotalsum,$array = array());
		$cntr2=0;

  
  
  //$row=mysql_fetch_array($gettotalsum);

   ?>
   <tr>
   <td><b>TOTAL</b></td>
   <td>&nbsp;</td>
   <td><?php echo $row[$cntr2]['te'];?></td>
   <td><?php echo $row[$cntr2]['fe']; ?></td>
   <td><?php echo $row[$cntr2]['re']; ?></td>
   <td><?php echo $row[$cntr2]['err']; ?></td>
   <td>&nbsp;</td>

   </tr>

  		
		
</table>		
<?php		
	} 
?>
   
     </div>
   </div
></body>
</html>
