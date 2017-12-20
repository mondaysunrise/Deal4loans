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
	document.frmsearch.action="cc_offer_leads.php?search=y"+gifName;
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
</head>

<body>
<div align="center">
 <center>
 <?php include '~TopBidder.php'; ?>
 </form>
 <br>
 <br>
 <? $current_date=date('Y-m-d');
 ?>
 <table width="600" border="0" cellpadding="4" cellspacing="1" class="blueborder">
 <form name="frmsearch" action="cc_offer_leads.php?search=y" method="post" onSubmit="return chkform();">
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
       <input name="min_date" type="text" id="min_date" size="15" <? if($min_date=="") { ?>value="<? echo $current_date; ?>"<? } else { ?>value="<? echo $min_date; ?>" <? }?>>
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
	if($search=="y")
	{
		if($min_date!="" and $max_date!="")
		{
			$min_date=$min_date." 00:00:00";
			$max_date=$max_date." 23:59:59";
			$search_date=$search_date." and UNIX_TIMESTAMP(store_records_mailer.mailer_dated)>='".strtotime($min_date)."' and UNIX_TIMESTAMP(store_records_mailer.mailer_dated)<='".strtotime($max_date)."'";
		}
		else if($min_date!="" and $max_date=="")
		{
			$min_date=$min_date." 00:00:00";
			$search_date=$search_date." and UNIX_TIMESTAMP(store_records_mailer.mailer_dated)>='".strtotime($min_date)."'";
		}
		else if($min_date=="" and $max_date!="")
		{
			$max_date=$max_date." 23:59:59";
			$search_date=$search_date." and UNIX_TIMESTAMP(store_records_mailer.mailer_dated)<='".strtotime($max_date)."'";
		}
		else
		{
			$search_date=$search_date." and store_records_mailer.mailer_dated!=''";
		}
	?>
 <table width="758" border="0" cellpadding="4" cellspacing="1" class="blueborder">
 <?

		$search_qry="select *  from store_records_mailer where 1=1 ".$search_date." group by store_records_mailer.mobile";

	
		$qry="select * from store_records_mailer where 1=1 ".$search_date."  group by store_records_mailer.mobile order by store_records_mailer.mailer_dated desc";
		$result=ExecQuery($qry);
		
		$recordcount = mysql_num_rows($result);
 ?>
   <tr>
     <td colspan="11"><strong><? echo $startrow+1; ?> to <? echo min($startrow+$pagesize,$recordcount); ?> Out of <? echo $recordcount; ?> Records </strong></td>
     </tr>
   <tr>
     <td class="head1">Name</td>
     <!--<td class="head1">Email </td>-->
     <td class="head1">City</td>
     <!--<td class="head1">Mobile</td>-->
     <td class="head1">Credit Card Bank </td>
	 <td class="head1">Credit Card Name </td>
	  <td class="head1">Debit Card Bank </td>
	 <td class="head1">Debit Card Name </td>

    <td class="head1">Source</td>
        
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
		
		$qry="select * from store_records_mailer where 1=1 ".$search_date."  group by store_records_mailer.mobile order by store_records_mailer.mailer_dated desc LIMIT $startrow, $pagesize";
		$result=ExecQuery($qry);
		
		$i=1;
		if($recordcount>0)
		{
		while($row=mysql_fetch_array($result))
		{
	?>
   <tr>
     <td class="bodyarial11"><? echo $row["name"]; ?></td>
   <!-- <td class="bodyarial11"><?// echo $row["email"]; ?></td>-->
     <td class="bodyarial11"><? echo $row["city"]; ?></td>
     <!--<td class="bodyarial11"><? //echo $row["mobile"]; ?></td>-->
     <td class="bodyarial11"><? 
	if(strlen($row["ccholder_bank"])>0)
			{
		echo $row["ccholder_bank"];
	
	}
	else
			{
		$bankname="";
		$cardname="";
		$getbank=ExecQuery("select * From store_mailer_cards where (user_id=".$row["mailerid"]." and   	  card_type=1)");
		while($get=mysql_fetch_array($getbank))
				{
			$bankname[]=$get["bank_name"];
			$cardname[]=$get["card_name"];
				}
				$bankname=array_unique($bankname);
				$cardname=array_unique($cardname);
				$strbankname=implode(",",$bankname);
				$strcardname=implode(",",$cardname);

echo $strbankname;
		}
	
	 ?></td>
<td class="bodyarial11"><? echo $strcardname;?></td>
<td class="bodyarial11"><? 
	if(strlen($row["ccholder_bank"])>0)
			{
		echo $row["ccholder_bank"];
	
	}
	else
			{
		$bankdcname="";
		$carddcname="";
		$getdcbank=ExecQuery("select * From store_mailer_cards where (user_id=".$row["mailerid"]." and   	  card_type=2)");
		while($getdc=mysql_fetch_array($getdcbank))
				{
			$bankdcname[]=$getdc["bank_name"];
			$carddcname[]=$getdc["card_name"];
				}
				$bankdcname=array_unique($bankdcname);
				$carddcname=array_unique($carddcname);
				$strbankdcname=implode(",",$bankdcname);
				$strcarddcname=implode(",",$carddcname);

echo $strbankdcname;
		}
	
	 ?></td>
<td class="bodyarial11"><? echo $strcarddcname;?></td>
<td class="bodyarial11"><? echo $row["source"];?></td>



     <!--<td class="bodyarial11"><? //if($row["accidental_insurance"]==1) { echo "Yes";} else { echo "No";} ?></td>-->
     
    
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
 <?// if($_SESSION['BidderID']=='766')
		//{?>
 <table width="500" border="0" cellspacing="1" cellpadding="4">
 <form name="frmdownload" action="cc_offer_download.php" method="post">
   <tr>
     <td align="center">
	   <input type="hidden" name="qry1" value="<? echo $search_qry; ?>">
	    
	 <input name="Submit2" type="submit" class="bluebutton" value="Export To Excel">
	 </td>
   </tr>
 </form>
 </table>
 <? //}
  // else {
	   ?><!--<table width="500" border="0" cellspacing="1" cellpadding="4">
 <form name="frmdownload" action="newcc_download.php" method="post">
   <tr>
     <td align="center">
	   <input type="hidden" name="qry1" value="<? echo $search_qry; ?>">
	     <input type="hidden" name="min_date" value="<? echo $min_date; ?>">
		  <input type="hidden" name="max_date" value="<? echo $max_date; ?>">
	 <input name="Submit2" type="submit" class="bluebutton" value="Export To Excel">
	 </td>
   </tr>
 </form>
 </table>-->
 <? //} ?>

 <h3 class="bodyarial11">
   <?
 }
 ?>
   <?php include '~Bottom.php'; ?>
 </h3>
 </center>
</div>
</body>

</html> <h3 class="bodyarial11">
   <?
// }
 ?>
   <?php include '~Bottom.php'; ?>
 </h3>
 </center>
</div>
</body>

</html>