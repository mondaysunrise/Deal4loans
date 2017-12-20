<?php
	require 'scripts/session_check_online.php';
//session_start();
	require 'scripts/db_init.php';
	require 'scripts/functions.php';



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

	$Reply_TypeProduct ='';
	if(isset($_REQUEST['Reply_TypeProduct']))
	{
		$Reply_TypeProduct=$_REQUEST['Reply_TypeProduct'];

	}

$TypeSource ='';
	if(isset($_REQUEST['TypeSource']))
	{
		$TypeSource=$_REQUEST['TypeSource'];

	}


////////PAGING
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
?>

<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=WINDOWS-1252">
<title>Login</title>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
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
	document.frmsearch.action="shares-data.php?search=y"+gifName;
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
	
		if (document.frmsearch.Reply_TypeProduct.selectedIndex==0)
	{
		alert("Please select Product.");
		document.frmsearch.Reply_TypeProduct.focus();
		return false;
	}

	
	
}
		
	function onFocusBlank(element,defaultVal){
	if(element.value==defaultVal){
		element.value="";
	}
}

function onBlurDefault(element,defaultVal){
	if(element.value==""){
		element.value = defaultVal;
	}
}
	
		
			
			
	function HandleOnSubmit(file_name) {

	   myWindow = window.open(file_name, "tinyWindow", ' width=900,height=700')
	   myWindow.document.close() 

}

function MM_jumpMenu(targ,selObj,restore){ //v3.0
 eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
 if (restore) selObj.selectedIndex=0;
}

	
</script>
</head>

<body>
 <table width="600" border="0" cellpadding="0" cellspacing="0" align="center">
 <tr><td valign="top">
 <div id="dvLogo"><img src="<?php echo $WebsitePath;?>images/logo.gif" alt="bimadeals"  onClick="javascript:location.href='<?php echo $WebsitePath;?>index.php'" /></div>
</td>
<td> <div align="right">
 <?php 
	if(isset($_SESSION['UserType']))
	{
echo "<font style='Font-size:12px;'>Welcome ".ucwords($_SESSION['UserType'])." <b>".$_SESSION['UName']." ( <a href=Logout.php>Logout</a> )</b>";
	}
	
	?>
	</div>
	
	</td></tr>
 <tr><td align="center"  valign="top" height="100" colspan="2">
 <form name="frmsearch" action="shares-data.php?search=y" method="post" onSubmit="return chkform();">
 <table width="600" border="0" cellpadding="4" cellspacing="0" class="blueborder" height="80">
 
   <tr>
     <td colspan="2" class="head1" height="20" align="center">Insurance Module</td>
     </tr>
   <tr>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
   </tr>
   <tr>
     <td width="20%"><strong>Date:</strong></td>
     <td width="80%">From 
	 <?php
		$y=date('Y');
		$m=date('m');
		$dd=date('d');
		$D=$y.'-'.$m.'-'.$dd;
		$da=$y.'-'.$m.'-01';
     ?>
       <input name="min_date" type="text" id="min_date" size="15" <? if($min_date=="") { ?>value="<? echo $da;?>"<? } else { ?>value="<? echo $min_date; ?>" <? }?>>
       <input name="b12" type="button" class="bluebutton" onClick="javascript:pedirFecha(min_date,'');" value="&lt; Insert">     
         To <span class="bodyarial11">
         <input name="max_date" type="text" id="max_date" size="15"<? if($max_date=="") { ?>value="<?  echo $D;?>"<? } else { ?>value="<? echo $max_date; ?>" <? }?>>
         <input name="b122" type="button" class="bluebutton" onClick="javascript:pedirFecha(max_date,'');" value="&lt; Insert">
        </span></td>
   </tr>
  
   <tr>
     <td colspan="2" align="center"><input name="Submit" type="submit" class="bluebutton" value="Search" border="0"></td>
     </tr>
   
 </table>
</form>
</td></tr>
<tr><td  bgcolor="#7BDAF9" colspan="2">
	 <table width="600" border="0" cellpadding="3" cellspacing="1" class="blueborder">

<?php
if($search=="y")
{
	$mindate = $min_date." 00:00:00";
	$maxdate = $max_date." 23:59:59";
	
		$search_qry = "select * from Req_Loan_Share where 1=1   and City = '".$_SESSION['City']."' and  Dated > '".$mindate."' and  Dated < '".$maxdate."' group by Phone";
		$LifeSql = "select * from Req_Loan_Share where 1=1   and City = '".$_SESSION['City']."' and  Dated > '".$mindate."' and  Dated < '".$maxdate."' group by Phone";
/*		
echo $LifeSql;
echo "<br>";
echo $search_qry;
echo "<br>";
*/
	$LifeQuery = ExecQuery($LifeSql);
	$recordcount = mysql_num_rows($LifeQuery);
	
	?>

	<tr>
		 <td colspan="4">
	 <strong><? echo $startrow+1; ?> to <? echo min($startrow+$pagesize,$recordcount); ?> Out of <? echo $recordcount; ?> Records </strong></td>
		 </tr>
	<?
	if($recordcount>0)
	{
	?>
		<tr>
		 <td width="114" class="head1">Name</td>
		 <td width="150" class="head1">City</td>
		 <td width="160" class="head1">Mobile</td>
		 <td width="160" class="head1">Portfolio</td>
		 <td width="160" class="head1">Loan Amount</td>
	    <td width="177" class="head1">Date of Lead</td>
		</tr>
	<?php
			$maxpage = $recordcount % $pagesize;
			if($recordcount % $pagesize == 0)
			{
				$maxpage = $recordcount / $pagesize;
			}
			else
			{
				$maxpage = ceil($recordcount / $pagesize);
			}
			
		$LifeDataSql = "select * from Req_Loan_Share where 1=1 and City = '".$_SESSION['City']."' and Dated > '".$mindate."' and  Dated < '".$maxdate."'  group by Phone order by  Dated desc LIMIT $startrow, $pagesize";
	$LifeData = ExecQuery($LifeDataSql);
	$LifeDataNumRows = mysql_num_rows($LifeData);
	
	//echo $LifeDataSql;
	
		for($i=0;$i<$LifeDataNumRows;$i++)
		{
			$Name = mysql_result($LifeData,$i,'Name');
			$City = mysql_result($LifeData,$i,'City');
			
			
			$Phone = mysql_result($LifeData,$i,'Phone');
			$portfolio = mysql_result($LifeData,$i,'portfolio');
			$Loan_Amount = mysql_result($LifeData,$i,'Loan_Amount');
			$Dated = mysql_result($LifeData,$i,'Dated');
							
			if($i%2==0)
			{	
				$bgcolor = "#CCCCCC";	
			}
			else
			{
				$bgcolor = "#FFFFFF";
			}
			
			
			echo "<tr bgcolor='".$bgcolor."'>";
			echo '<td class="bodyarial11">'.$Name.'</td>';
			echo '<td class="bodyarial11">'.$City; 
			
			echo '<td class="bodyarial11">'.$Phone.'</td>';
			echo '<td class="bodyarial11">'.$portfolio.'</td>';
			echo '<td class="bodyarial11">'.$Loan_Amount.'</td>';
			echo '<td class="bodyarial11">'.$Dated.'</td>';
			
			echo "</tr>";
		}
	}
}
?>
</table>
</td></tr>
<tr><td  colspan="2" >
<table width="600"  border="0" cellpadding="5" cellspacing="1" height="10">
	
   <tr>
     <td align="center" class="bluelink" >
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
 </td></tr>
 <tr><td colspan="2">
<?php
if($recordcount>0)
{
	?>
 <form name="frmdownload" action="shares_download.php" method="post">
 <table width="500" border="0" cellspacing="1" cellpadding="4">
   <tr>
     <td align="center">
	  <input type="hidden" name="qry1" value="<? echo $search_qry; ?>">
	 <input name="Submit2" type="submit" class="bluebutton" value="Export To Excel">
	 </td>
   </tr>
 </table>
 </form>
 <?php
 } 
 ?>
 </td></tr>
 </table>

</body>
</html>