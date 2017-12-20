<?php
	require 'scripts/session_check_online.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
		require 'login_validation_bidders.php';

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
	$titles = array(
		'Req_Loan_Personal',
		'Req_Loan_Home',
		'Req_Loan_Car',
		'Req_Credit_Card' ,
		'Req_Loan_Against_Property',
		
	);

	function getReqValue($pKey){
	$titles = array(
		'Req_Loan_Personal' => '1',
		'Req_Loan_Home' => '2',
		'Req_Loan_Car' => '3',
		'Req_Credit_Card' => '4',
		'Req_Loan_Against_Property' => '5',

	);

	foreach ($titles as $key=>$value)
	    if($pKey==$key)
		return $value;

	return "";
   }
   
   function getRevValue($pKey){
	$titles = array(
		 'Req_Loan_Personal' => 'PL',
		'Req_Loan_Home' => 'HL',
		'Req_Loan_Car' => 'CL',
		'Req_Credit_Card' => 'CC',
		'Req_Loan_Against_Property' => 'LAP',

	);

	foreach ($titles as $key=>$value)
	    if($pKey==$key)
		return $value;

	return "";
   }
	
?>

<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Login</title>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<link href="includes/style1.css" rel="stylesheet" type="text/css">
<link href="style.css" rel="stylesheet" type="text/css" />

<?php include '~TopBidder.php';?>


  <!-- End Main Banner Menu Panel -->
  <!-- Start Main Container Panel -->
  <div id="dvContentPanel">
   <div id="dvMaincontent">

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
	document.frmsearch.action="ProductsCountDetails.php?search=y"+gifName;
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
	if(document.frmsearch.min_date.value<"2007-09-20")
	{
		alert("Sorry!!!! Your minimum date is 2007-09-20.Please Select.");
		document.frmsearch.min_date.value="";
		document.frmsearch.min_date.focus();
		return false;
	}
	/*if(document.frmsearch.max_date.value>"<?php echo $_SESSION['definedate'];?>")
	{
		alert("Sorry!! for inconvience to view leads after <?php echo $_SESSION['definedate'];?> click the link.");
		document.frmsearch.max_date.value="";
		document.frmsearch.max_date.focus();
		return false;
	}*/
}
</script>
 </form>
 <br>
 <br>
  <table width="712" border="0">
 <tr><td align="center" width="100%">
 <div align="center">

 <table width="600" border="0" cellpadding="4" cellspacing="1" class="blueborder">
 <form name="frmsearch" action="ProductsCountDetails.php?search=y" method="post" onSubmit="return chkform();">
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
       <input name="min_date" type="text" id="min_date" size="15" <? if($min_date=="") { ?>value="2007-09-20"<? } else { ?>value="<? echo $min_date; ?>" <? }?>>
       <input name="b12" type="button" class="bluebutton" onClick="javascript:pedirFecha(min_date,'');" value="&lt; Insert">     
         To <span class="bodyarial11">
         <input name="max_date" type="text" id="max_date" size="15" value="<? echo $max_date; ?>">
         <input name="b122" type="button" class="bluebutton" onClick="javascript:pedirFecha(max_date,'');" value="&lt; Insert">
        </span></td>
   </tr>
   <tr>
     <td colspan="2" align="center"><input name="Submit" type="submit" class="bluebutton" value="Search" border="0"></td>
     </tr>
   </form>
 </table>
 <p>&nbsp;</p>
	<?
	$search_date="";
	if(($search)=="")
	{
		$makedate=date('Y-m');
		$min_date= $makedate."-01 00:00:00";
		//$min_date= "2007-11-13 00:00:00";
		$max_date= "Now()";
	}
	
	elseif($search=="y")
	{
		$min_date=$min_date." 00:00:00";
		$max_date="'".$max_date." 23:59:59"."'";
	}
		
	?>
 <table width="758" border="0" cellpadding="4" cellspacing="1" class="blueborder">
<?if(($search)=="")
		{?>
		<tr>
			<td colspan="5" align="center"><strong>MIS from <?echo  $makedate."-01";?> to <?echo date('Y-m-d');?></strong></td>
		</tr>
		<? } ?>
	 
	   <tr>
			 <td class="head1">Products</td>
			 <td class="head1">Total no of leads</td>
			 <?for($j=0;$j<=4;$j++){?>
		  <td class="head1">sent to (<? echo $j;?>) Bidder </td>
		  
		 <? } ?>
    
   </tr>
   
	<? 
	 for($k=0;$k<count($titles);$k++)
		 {
			 if($titles[$k]=="Req_Loan_Personal" || $titles[$k]=="Req_Loan_Home")
			{
				 $actual_date="Updated_Date";
			 }
			 else
			 {
					$actual_date="Dated";
			 }

	//////////PERSONAL LOAN  QUERY//////////////////////////
			$qry="select RequestID from ".$titles[$k]." where ".$actual_date." Between '".($min_date)."' and ".($max_date)."";
			//echo "hello".$qry."<br>";
			$result=ExecQuery($qry);
			$recordcount = mysql_num_rows($result);
			$RecordsSum[] = $recordcount;

			$nobidder= ExecQuery("select RequestID from ".$titles[$k]." where Bidder_Count=0 and ".$actual_date." Between '".($min_date)."' and ".($max_date)."");
			$nobidder_allocation = mysql_num_rows($nobidder);

			$onebidder= ExecQuery("select RequestID from ".$titles[$k]." where Bidder_Count=1 and ".$actual_date." Between '".($min_date)."' and ".($max_date)." ");
			$onebidder_allocation = mysql_num_rows($onebidder);

			$twobidder= ExecQuery("select RequestID from ".$titles[$k]." where Bidder_Count=2 and ".$actual_date." Between '".($min_date)."' and ".($max_date)." ");
			$twobidder_allocation = mysql_num_rows($twobidder);

			$threebidder= ExecQuery("select RequestID from ".$titles[$k]." where Bidder_Count=3 and ".$actual_date." Between '".($min_date)."' and ".($max_date)." ");
			$threebidder_allocation = mysql_num_rows($threebidder);

			$fourbidder= ExecQuery("select RequestID from ".$titles[$k]." where Bidder_Count=4 and ".$actual_date." Between '".($min_date)."' and ".($max_date)." ");
			$fourbidder_allocation = mysql_num_rows($fourbidder);

?>
		<tr>
				 <td class="bodyarial11"><?echo getRevValue($titles[$k])?></td>
				 <td class="bodyarial11"><?php echo $recordcount;?></td>
  				 <td class="bodyarial11"><?php echo $nobidder_allocation;?></td>
				 <td class="bodyarial11"><?php echo $onebidder_allocation;?></td>
				<td class="bodyarial11"><?php echo $twobidder_allocation;?></td>
				 <td class="bodyarial11"><?php echo $threebidder_allocation;?></td>
				 <td class="bodyarial11"><?php echo $fourbidder_allocation;?></td>
			 
		<? }?>
		</tr>
		
 </table>
 <br>

 <br>
 <!--<table width="500" border="0" cellspacing="1" cellpadding="4">
 <form name="frmdownload" action="citilogin_download.php" method="post">
   <tr>
     <td align="center">
	   <input type="hidden" name="qry1" value="<? echo $search_qry; ?>">
	 <input name="Submit2" type="submit" class="bluebutton" value="Export To Excel">
	 </td>
   </tr>
 </form>
 </table>-->
 <h3 class="bodyarial11">
   <?
 ////if ($search="y")}
 ?>
   </div>
 </td></tr></table>
  </div>
  
  </div>
<?php include '~Bottom.php';?>
  </body>
</html>