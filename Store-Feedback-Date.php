<?php

	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
		$id = $_GET['id'];
		$bidderid = $_GET['Bid'];


	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		foreach($_POST as $a=>$b)
			$$a=$b;
		$followupdate = FixString($followupdate);
		$hour = FixString($hour);
		
		$minute = FixString($minute);
		$interval = FixString($interval);
		if(($interval=="PM") && ($hour < 12)) 
		{
			
			IF (STRLEN(trim($minute)) < 2)
			{
				$updateminute = "0".$minute;
			}
			else
			{
				$updateminute = $minute;
			}
			$chour = 12+$hour;
			$Followdate =$followupdate." ".$chour.":".$updateminute.":00";
			
		}
		elseif (($interval=="AM") && ($hour < 12))
		{
			IF (STRLEN(trim($hour)) < 2)
			{
				$updatehour = "0".$hour;
			}
			else
			{
				$updatehour = $hour;
			}
			IF (STRLEN(trim($minute)) < 2)
			{
				$updateminute = "0".$minute;
			}
			else
			{
				$updateminute = $minute;
			}

			$Followdate =$followupdate." ".$updatehour.":".$updateminute.":00";
		}
		elseif ($hour == 12)
		{
			$Followdate =$followupdate." ".$hour.":".$minute.":00";
		}
//echo "Date".$Followdate;
//$sql1 = "Update Req_Feedback set Followup_Date='$Followdate' where AllRequestID=$id and (Feedback='FollowUp' or Feedback='Callback Later') and BidderID=$bidderid";
//echo "ddd".$sql1;
	//$result = ExecQuery($sql1);
	
	$DataArray = array("Followup_Date"=>$Followdate);
	$wherecondition ="AllRequestID=$id and (Feedback='FollowUp' or Feedback='Callback Later') and BidderID=$bidderid";
	Mainupdatefunc ('Req_Feedback', $DataArray, $wherecondition);

	echo "<script>window.close()"."</script>";
	}
?>
<script Language="JavaScript" Type="text/javascript" src="scripts/feedbacktime.js"></script>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script type="text/JavaScript">
<!--


//date function complete start here
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
</script>
<style>
.bluebutton {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: blue;
	font-weight: bold;
}
.bodyarial11 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: #333333;
	text-decoration: none;
}
.blueborder {
	border: 1px solid #529BE4;
}
</style>
<form name="Followup_date" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>?id=<?echo $id;?>&Bid=<? echo $bidderid;?>" >
<table style='border:1px dotted #9C9A9C;'>
<tr><td colspan="4" ><? //echo $id; ?></td></tr>
<tr><td class="bodyarial11">FollowUp date</td><td  colspan="3" class="bodyarial11">
<input type='text'  id='followupdate' name='followupdate' ><img src="images/cal.gif" width="16" height="16" border="0" alt="Pick a date" onClick="javascript:pedirFecha(followupdate,'');">
	  		<span class="descriptions">pick a date..</span></td></tr>
			<tr><td class="bodyarial11">Time</td><td class="bodyarial11">Hours<input type="text" size="2" maxlength="2" name="hour"></td><td class="bodyarial11">Mins <input size="2" type="text" name="minute" maxlength="2"></td><td class="bodyarial11"><select name="interval"><option value="AM">AM</option><option value="PM">PM</option></td></tr>
 <tr>
     <td colspan="2" align="center"><input name="Submit" type="submit" class="bluebutton" value="Submit" border="0"></td>
     </tr>
	 </table>