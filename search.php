<?php
	require 'scripts/session_check_online.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	
	
	$Email = $_SESSION['Email'];
	
	//To Retrieve the Bidder ID
		
		$qry_bidder="select BidderID from Bidders where Email='".$Email."'";
		$res_bidder=ExecQuery($qry_bidder);
		$row_bidder=mysql_fetch_array($res_bidder);
		
		$bidder_id=$row_bidder["BidderID"];
		
	//
	
	$mode="";
	if(isset($_GET['mode']))
	{
		$mode=$_GET['mode'];
	}
	
	$loan_type="";
	$min_date="";
	$max_date="";
	$city="";
	$city1="";
	$salaried=0;
	$salaried_amount="";
	$self_emp=0;
	$self_emp_amount="";
	
	if(isset($_POST['loan_type']))
	{
		$loan_type=$_POST['loan_type'];
	}
	if(isset($_POST['min_date']))
	{
		$min_date=$_POST['min_date'];
	}
	if(isset($_POST['max_date']))
	{
		$max_date=$_POST['max_date'];
	}
	if(isset($_POST['city']))
	{
		$city=$_POST['city'];
		for($i=0;$i<sizeof($city);$i++)
		{
			$city_data=$city_data.$city[$i].", ";
		}
	}
	if(isset($_POST['city1']))
	{
		$city1=$_POST['city1'];
	}
	if(isset($_POST['salaried']))
	{
		$salaried=$_POST['salaried'];
	}
	if(isset($_POST['salaried_amount']))
	{
		$salaried_amount=$_POST['salaried_amount'];
		$salaried_amount_data="";
		for($i=0;$i<sizeof($salaried_amount);$i++)
		{
			$salaried_amount_data=$salaried_amount_data.$salaried_amount[$i].", ";
		}
	}
	if(isset($_POST['self_emp']))
	{
		$self_emp=$_POST['self_emp'];
	}
	if(isset($_POST['self_emp_amount']))
	{
		$self_emp_amount=$_POST['self_emp_amount'];
		$self_emp_amount_data="";
		for($i=0;$i<sizeof($self_emp_amount);$i++)
		{
			$self_emp_amount_data=$self_emp_amount_data.$self_emp_amount[$i].", ";
		}
	}
	
	$session_id=session_id();
	
	//For Paging
	
	//Set the page size
	$PageSize =20;
	$StartRow = 0;
	
	//Set the page no
	if(empty($_GET['PageNo']))
	{
		if($StartRow == 0)
		{
			$PageNo = $StartRow + 1;
		}
	}
	else
	{
		$PageNo = $_GET['PageNo'];
		$StartRow = ($PageNo - 1) * $PageSize;
	}
	
	//Set the counter start
	if($PageNo/$PageSize == 0)
	{
		$CounterStart = $PageNo - ($PageSize - 1);
	}
	else
	{
		$CounterStart = $PageNo - ($PageNo % $PageSize) + 1;
	}
	
	//Counter End
	$CounterEnd = $CounterStart + ($PageSize - 1);
	
	///
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Search</title>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script Language="JavaScript" Type="text/javascript" src="scripts/menu.js"></script>
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

function diaHoy() {
  var fecha = new Date();
  return fecha.getDate();
}

function pedirFecha(campoTexto,nombreCampo) {
  ano = anoHoy();
  mes = mesHoy();
  dia = diaHoy();
  campoDeRetorno = campoTexto;
  titulo = nombreCampo;
  dibujarMes(ano,mes);
}

function escribirFecha() {
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

function deletetemp()
{
	<?
		$qry1="delete from `temp` where session_id='".$session_id."'";
		$result1 = ExecQuery($qry1);
	?>
}
function disabledownload()
{
	document.frmqry.Submit22.disabled = true;
}
function sendmail(form)
{
	var gifName = form;
	document.frmsearch.action="search.php?mode=search"+gifName;
	document.frmsearch.submit();
}
</script>
</head>
<body class="body" onLoad="deletetemp()">
<div align="center">
 <center>
 <?php include '~Top.php'; ?>
<table border="0" cellspacing="1" width="712" cellpadding="0">
   <tr>
     <td width="202" align="center" valign="top">
<?php if(isset($_SESSION['UserType']))
	{
	include '~Left.php';
	}
	else
	{
	include '~Login.php';
	}
?>     </td>
     <td width="510" valign="top" align=center><br>
     
       <table width="450" border="0" cellpadding="4" cellspacing="1" class="blueborder">
         <form name="frmsearch" action="search.php?mode=search&PageNo=1" method="post">
           <tr class="head1">
             <td colspan="2">Search Fresh Leads</td>
			  </tr>
           <tr>
             <td align="right" class="bodyarial11"><strong>Loan Type:</strong></td>
             <td><select name="loan_type" id="loan_type">
                 <option value="personal_loan" <? if($loan_type=="personal_loan") { ?> selected="selected" <? } ?>>Personal Loan</option>
                 <option value="car_loan" <? if($loan_type=="car_loan") { ?> selected="selected" <? } ?>>Car Loan</option>
                 <option value="credit_card_loan" <? if($loan_type=="credit_card_loan") { ?> selected="selected" <? } ?>>Credit Card Loan</option>
                 <option value="loan_against_property" <? if($loan_type=="loan_against_property") { ?> selected="selected" <? } ?>>Loan Against Property</option>
                 <option value="home_loan" <? if($loan_type=="home_loan") { ?> selected="selected" <? } ?>>Home Loan</option>
               </select>             </td>
           </tr>
           <tr>
             <td width="30%" align="right" class="bodyarial11"><strong>Date: </strong></td>
             <td width="80%" class="bodyarial11"><span class="bodytext">From:</span>
                 <input name="min_date" type="text" id="min_date" value="<? echo $min_date; ?>" size="15">
                 <input name="b12" type="button" class="bluebutton" onClick="javascript:pedirFecha(min_date,'');" value="&lt; Insert">
                 <span class="bodytext">To</span>
                 <input name="max_date" type="text" id="max_date" value="<? echo $max_date;?>" size="15">
                 <input name="b12" type="button" class="bluebutton" onClick="javascript:pedirFecha(max_date,'');" value="&lt; Insert"></td>
           </tr>
           <tr>
             <td align="right" valign="top" class="bodyarial11"><strong>City: </strong></td>
             <td><select name="city[]" size="4" multiple id="city[]">
                 <option value="None" <? if($city=="") { ?> selected="selected" <? } else { for($i=0;$i<sizeof($city);$i++) { if($city[$i]=="None") { ?> selected="selected" <? } } } ?>>
               None
               </option>
                 <option value="Ahmedabad" <? for($i=0;$i<sizeof($city);$i++) { if($city[$i]=="Ahmedabad") { ?> selected="selected" <? } } ?>>Ahmedabad</option>
                 <option value="Aurangabad" <? for($i=0;$i<sizeof($city);$i++) { if($city[$i]=="Aurangabad") { ?> selected="selected" <? } } ?>>Aurangabad</option>
                 <option value="Bangalore" <? for($i=0;$i<sizeof($city);$i++) { if($city[$i]=="Bangalore") { ?> selected="selected" <? } } ?>>Bangalore</option>
                 <option value="Baroda" <? for($i=0;$i<sizeof($city);$i++) { if($city[$i]=="Baroda") { ?> selected="selected" <? } } ?>>Baroda</option>
                 <option value="Bhubneshwar" <? for($i=0;$i<sizeof($city);$i++) { if($city[$i]=="Bhubneshwar") { ?> selected="selected" <? } } ?>>Bhubneshwar</option>
                 <option value="Chandigarh" <? for($i=0;$i<sizeof($city);$i++) { if($city[$i]=="Chandigarh") { ?> selected="selected" <? } } ?>>Chandigarh</option>
                 <option value="Chennai" <? for($i=0;$i<sizeof($city);$i++) { if($city[$i]=="Chennai") { ?> selected="selected" <? } } ?>>Chennai</option>
                 <option value="Cochin" <? for($i=0;$i<sizeof($city);$i++) { if($city[$i]=="Cochin") { ?> selected="selected" <? } } ?>>Cochin</option>
                 <option value="Coimbatore" <? for($i=0;$i<sizeof($city);$i++) { if($city[$i]=="Coimbatore") { ?> selected="selected" <? } } ?>>Coimbatore</option>
                 <option value="Cuttack" <? for($i=0;$i<sizeof($city);$i++) { if($city[$i]=="Cuttack") { ?> selected="selected" <? } } ?>>Cuttack</option>
                 <option value="Dehradun" <? for($i=0;$i<sizeof($city);$i++) { if($city[$i]=="Dehradun") { ?> selected="selected" <? } } ?>>Dehradun</option>
                 <option value="Delhi" <? for($i=0;$i<sizeof($city);$i++) { if($city[$i]=="Delhi") { ?> selected="selected" <? } } ?>>Delhi</option>
                 <option value="Gaziabad" <? for($i=0;$i<sizeof($city);$i++) { if($city[$i]=="Gaziabad") { ?> selected="selected" <? } } ?>>Gaziabad</option>
                 <option value="Gurgaon" <? for($i=0;$i<sizeof($city);$i++) { if($city[$i]=="Gurgaon") { ?> selected="selected" <? } } ?>>Gurgaon</option>
                 <option value="Hosur" <? for($i=0;$i<sizeof($city);$i++) { if($city[$i]=="Hosur") { ?> selected="selected" <? } } ?>>Hosur</option>
                 <option value="Hyderabad" <? for($i=0;$i<sizeof($city);$i++) { if($city[$i]=="Hyderabad") { ?> selected="selected" <? } } ?>>Hyderabad</option>
                 <option value="Indore" <? for($i=0;$i<sizeof($city);$i++) { if($city[$i]=="Indore") { ?> selected="selected" <? } } ?>>Indore</option>
                 <option value="Jaipur" <? for($i=0;$i<sizeof($city);$i++) { if($city[$i]=="Jaipur") { ?> selected="selected" <? } } ?>>Jaipur</option>
                 <option value="Jamshedpur" <? for($i=0;$i<sizeof($city);$i++) { if($city[$i]=="Jamshedpur") { ?> selected="selected" <? } } ?>>Jamshedpur</option>
                 <option value="Kanpur" <? for($i=0;$i<sizeof($city);$i++) { if($city[$i]=="Kanpur") { ?> selected="selected" <? } } ?>>Kanpur</option>
                 <option value="Kolkata" <? for($i=0;$i<sizeof($city);$i++) { if($city[$i]=="Kolkata") { ?> selected="selected" <? } } ?>>Kolkata</option>
                 <option value="Lucknow" <? for($i=0;$i<sizeof($city);$i++) { if($city[$i]=="Lucknow") { ?> selected="selected" <? } } ?>>Lucknow</option>
                 <option value="Ludhiana" <? for($i=0;$i<sizeof($city);$i++) { if($city[$i]=="Ludhiana") { ?> selected="selected" <? } } ?>>Ludhiana</option>
                 <option value="Madurai" <? for($i=0;$i<sizeof($city);$i++) { if($city[$i]=="Madurai") { ?> selected="selected" <? } } ?>>Madurai</option>
                 <option value="Mangalore" <? for($i=0;$i<sizeof($city);$i++) { if($city[$i]=="Mangalore") { ?> selected="selected" <? } } ?>>Mangalore</option>
                 <option value="Mysore" <? for($i=0;$i<sizeof($city);$i++) { if($city[$i]=="Mysore") { ?> selected="selected" <? } } ?>>Mysore</option>
                 <option value="Mumbai" <? for($i=0;$i<sizeof($city);$i++) { if($city[$i]=="Mumbai") { ?> selected="selected" <? } } ?>>Mumbai</option>
                 <option value="Nagpur" <? for($i=0;$i<sizeof($city);$i++) { if($city[$i]=="Nagpur") { ?> selected="selected" <? } } ?>>Nagpur</option>
                 <option value="Nasik" <? for($i=0;$i<sizeof($city);$i++) { if($city[$i]=="Nasik") { ?> selected="selected" <? } } ?>>Nasik</option>
                 <option value="Navi Mumbai" <? for($i=0;$i<sizeof($city);$i++) { if($city[$i]=="Navi Mumbai") { ?> selected="selected" <? } } ?>>Navi Mumbai</option>
                 <option value="Noida" <? for($i=0;$i<sizeof($city);$i++) { if($city[$i]=="Noida") { ?> selected="selected" <? } } ?>>Noida</option>
                 <option value="Pune" <? for($i=0;$i<sizeof($city);$i++) { if($city[$i]=="Pune") { ?> selected="selected" <? } } ?>>Pune</option>
                 <option value="Sahibabad" <? for($i=0;$i<sizeof($city);$i++) { if($city[$i]=="Sahibabad") { ?> selected="selected" <? } } ?>>Sahibabad</option>
                 <option value="Surat" <? for($i=0;$i<sizeof($city);$i++) { if($city[$i]=="Surat") { ?> selected="selected" <? } } ?>>Surat</option>
                 <option value="Thane" <? for($i=0;$i<sizeof($city);$i++) { if($city[$i]=="Thane") { ?> selected="selected" <? } } ?>>Thane</option>
                 <option value="Trivandrum" <? for($i=0;$i<sizeof($city);$i++) { if($city[$i]=="Trivandrum") { ?> selected="selected" <? } } ?>>Trivandrum</option>
                 <option value="Trichy" <? for($i=0;$i<sizeof($city);$i++) { if($city[$i]=="Trichy") { ?> selected="selected" <? } } ?>>Trichy</option>
                 <option value="Vishakapatanam" <? for($i=0;$i<sizeof($city);$i++) { if($city[$i]=="Vishakapatanam") { ?> selected="selected" <? } } ?>>Vishakapatanam</option>
               </select>             </td>
           </tr>
           <tr>
             <td align="right" class="bodyarial11">&nbsp;</td>
             <td class="bodytext">OR</td>
           </tr>
           <tr>
             <td align="right" class="bodyarial11"><strong>Enter Your City:</strong> </td>
             <td class="bodytext"><input name="city1" type="text" id="city1" value="<? echo $city1; ?>"></td>
           </tr>
           <tr>
             <td align="right" class="bodyarial11"><strong>Employment Status: </strong></td>
             <td class="bodytext"><input name="salaried" type="checkbox" id="salaried" value="1" <? if($salaried==1) { ?> checked="checked" <? } ?>>
               &nbsp;Salaried</td>
           </tr>
           <tr>
             <td align="right" class="bodyarial11">&nbsp;</td>
             <td><select name="salaried_amount[]" size="4" multiple id="salaried_amount[]">
                 <option value="None" <? if($salaried_amount=="") { ?>selected="selected" <? } else { for($i=0;$i<sizeof($salaried_amount);$i++) { if($salaried_amount[$i]=="None") { ?>selected="selected"<? } } } ?>>None</option>
                 <option value="6" <? for($i=0;$i<sizeof($salaried_amount);$i++) { if($salaried_amount[$i]=="6") { ?>selected="selected"<? } } ?>>Less Than 5000</option>
                 <option value="0" <? for($i=0;$i<sizeof($salaried_amount);$i++) { if($salaried_amount[$i]=="0") { ?>selected="selected"<? } } ?>>5000-10000</option>
                 <option value="1" <? for($i=0;$i<sizeof($salaried_amount);$i++) { if($salaried_amount[$i]=="1") { ?>selected="selected"<? } } ?>>10001-20000</option>
                 <option value="2" <? for($i=0;$i<sizeof($salaried_amount);$i++) { if($salaried_amount[$i]=="2") { ?>selected="selected"<? } } ?>>20001-30000</option>
                 <option value="3" <? for($i=0;$i<sizeof($salaried_amount);$i++) { if($salaried_amount[$i]=="3") { ?>selected="selected"<? } } ?>>30001-50000</option>
                 <option value="4" <? for($i=0;$i<sizeof($salaried_amount);$i++) { if($salaried_amount[$i]=="4") { ?>selected="selected"<? } } ?>>50001-100000</option>
                 <option value="5" <? for($i=0;$i<sizeof($salaried_amount);$i++) { if($salaried_amount[$i]=="5") { ?>selected="selected"<? } } ?>>100001 and Above</option>
             </select></td>
           </tr>
           <tr>
             <td>&nbsp;</td>
             <td><span class="bodytext">
               <input name="self_emp" type="checkbox" id="self_emp" value="1" <? if($self_emp==1) { ?> checked="checked" <? } ?>>
               Self Employed </span></td>
           </tr>
           <tr>
             <td>&nbsp;</td>
             <td><select name="self_emp_amount[]" size="4" multiple id="self_emp_amount[]">
                 <option value="None" <? if($self_emp_amount=="") { ?>selected="selected" <? } else { for($i=0;$i<sizeof($self_emp_amount);$i++) { if($self_emp_amount[$i]=="None") { ?>selected="selected"<? } } } ?>>None</option>
                 <option value="6" <? for($i=0;$i<sizeof($self_emp_amount);$i++) { if($self_emp_amount[$i]=="6") { ?>selected="selected"<? } } ?>>Less Than 50000</option>
                 <option value="0" <? for($i=0;$i<sizeof($self_emp_amount);$i++) { if($self_emp_amount[$i]=="0") { ?>selected="selected"<? } } ?>>50000-100000</option>
                 <option value="1" <? for($i=0;$i<sizeof($self_emp_amount);$i++) { if($self_emp_amount[$i]=="1") { ?>selected="selected"<? } } ?>>100001-200000</option>
                 <option value="2" <? for($i=0;$i<sizeof($self_emp_amount);$i++) { if($self_emp_amount[$i]=="2") { ?>selected="selected"<? } } ?>>200001-300000</option>
                 <option value="3" <? for($i=0;$i<sizeof($self_emp_amount);$i++) { if($self_emp_amount[$i]=="3") { ?>selected="selected"<? } } ?>>300001-500000</option>
                 <option value="4" <? for($i=0;$i<sizeof($self_emp_amount);$i++) { if($self_emp_amount[$i]=="4") { ?>selected="selected"<? } } ?>>500001-1000000</option>
                 <option value="5" <? for($i=0;$i<sizeof($self_emp_amount);$i++) { if($self_emp_amount[$i]=="5") { ?>selected="selected"<? } } ?>>1000001 and Above</option>
               </select>             </td>
           </tr>
           <tr>
             <td>&nbsp;</td>
             <td><input name="Submit" type="submit" class="bluebutton" value="Go"></td>
           </tr>
         </form>
       </table> 
       <p>&nbsp;</p>
		<?
		$search_criteria="";
		if($mode!="")
		{
				if($loan_type=="personal_loan")
				{
					$qry="select * from Req_Loan_Personal, wUsers where Req_Loan_Personal.UserID=wUsers.UserID and wUsers.IsPublic=1";
				}
				if($loan_type=="car_loan")
				{
					$qry="select * from Req_Loan_Car, wUsers where Req_Loan_Car.UserID=wUsers.UserID and wUsers.IsPublic=1";
				}
				if($loan_type=="credit_card_loan")
				{
					$qry="select * from Req_Credit_Card, wUsers where Req_Credit_Card.UserID=wUsers.UserID and wUsers.IsPublic=1";
				}
				if($loan_type=="loan_against_property")
				{
					$qry="select * from Req_Loan_Against_Property, wUsers where Req_Loan_Against_Property.UserID=wUsers.UserID and wUsers.IsPublic=1";
				}
				if($loan_type=="home_loan")
				{
					$qry="select * from Req_Loan_Home, wUsers where Req_Loan_Home.UserID=wUsers.UserID and wUsers.IsPublic=1";
				}
				
				if($min_date!="" and $max_date!="")
				{
					if($mode=="")
					{
						$min_date=$min_date." 00:00:00";
						$max_date=$max_date." 23:59:59";
					}
					$search_criteria=$search_criteria." and UNIX_TIMESTAMP(Dated)>='".strtotime($min_date)."' and UNIX_TIMESTAMP(Dated)<='".strtotime($max_date)."'";
				}
				elseif($min_date!="" and $max_date=="")
				{
					if($mode=="")
					{
						$min_date=$min_date." 00:00:00";
					}
					$search_criteria=$search_criteria." and UNIX_TIMESTAMP(Dated)>='".strtotime($min_date)."'";
				}
				elseif($min_date=="" and $max_date!="")
				{
					if($mode=="")
					{
						$max_date=$max_date." 23:59:59";
					}
					$search_criteria=$search_criteria." and UNIX_TIMESTAMP(Dated)<='".strtotime($max_date)."'";
				}
				else
				{
					$search_criteria=$search_criteria." and Dated!=''";
				}
				if($city[0]!="None")
				{
					$city_search=" and (";
					for($i=0;$i<sizeof($city);$i++)
					{
						$city_search=$city_search." City='".$city[$i]."' or City_Other='".$city[$i]."' or ";
					}
					if($city1!="")
					{
						$city_search=$city_search." City Like '".$city1."' or City_Other Like '".$city1."' or ";
					}
					$city_search=substr($city_search,0,strlen($city_search)-4);
					$city_search=$city_search." )";
				}
				if($city[0]=="None")
				{
					if($city1!="")
					{
						$city_search1=" and (";
						$city_search1=$city_search1." City Like '%".$city1."%' or City_Other Like '%".$city1."%')";
					}
				}
				if($salaried==1)
				{
					if($salaried_amount[0]!="None")
					{
						$salaried_search=" and (";
						for($i=0;$i<sizeof($salaried_amount);$i++)
						{
							if($salaried_amount[$i]==0)
							{
								$salaried_search=$salaried_search." ( Employment_Status=1 and Net_Salary>=5000*12 and Net_Salary<=10000*12 ) or ";
							}
							if($salaried_amount[$i]==1)
							{
								$salaried_search=$salaried_search." ( Employment_Status=1 and Net_Salary>=10001*12 and Net_Salary<=20000*12 ) or ";
							}
							if($salaried_amount[$i]==2)
							{
								$salaried_search=$salaried_search." ( Employment_Status=1 and Net_Salary>=20001*12 and Net_Salary<=30000*12 ) or ";
							}
							if($salaried_amount[$i]==3)
							{
								$salaried_search=$salaried_search." ( Employment_Status=1 and Net_Salary>=30001*12 and Net_Salary<=50000*12 ) or ";
							}
							if($salaried_amount[$i]==4)
							{
								$salaried_search=$salaried_search." ( Employment_Status=1 and Net_Salary>=50001*12 and Net_Salary<=100000*12 ) or ";
							}
							if($salaried_amount[$i]==5)
							{
								$salaried_search=$salaried_search." ( Employment_Status=1 and Net_Salary>=100001*12 ) or ";
							}
							if($salaried_amount[$i]==6)
							{
								$salaried_search=$salaried_search." ( Employment_Status=1 and Net_Salary<5000*12 ) or ";
							}
						}
					
					
					if($self_emp==1)
					{
					if($self_emp_amount[0]!="None")
					{
						for($i=0;$i<sizeof($self_emp_amount);$i++)
						{
							if($self_emp_amount[$i]==0)
							{
								$salaried_search=$salaried_search." ( Employment_Status=0 and Net_Salary>=50000 and Net_Salary<=100000 ) or ";
							}
							if($self_emp_amount[$i]==1)
							{
								$salaried_search=$salaried_search." ( Employment_Status=0 and Net_Salary>=100001 and Net_Salary<=200000 ) or ";
							}
							if($self_emp_amount[$i]==2)
							{
								$salaried_search=$salaried_search." ( Employment_Status=0 and Net_Salary>=200001 and Net_Salary<=300000 ) or ";
							}
							if($self_emp_amount[$i]==3)
							{
								$salaried_search=$salaried_search." ( Employment_Status=0 and Net_Salary>=300001 and Net_Salary<=500000 ) or ";
							}
							if($self_emp_amount[$i]==4)
							{
								$salaried_search=$salaried_search." ( Employment_Status=0 and Net_Salary>=500001 and Net_Salary<=1000000 ) or ";
							}
							if($self_emp_amount[$i]==5)
							{
								$salaried_search=$salaried_search." ( Employment_Status=0 and Net_Salary>=1000001 ) or ";
							}
							if($self_emp_amount[$i]==6)
							{
								$salaried_search=$salaried_search." ( Employment_Status=0 and Net_Salary<50000 ) or ";
							}
						}
						
						}
					}
					$salaried_search=substr($salaried_search,0,strlen($salaried_search)-4);
					$salaried_search=$salaried_search." )";
					}
				}
				
				if($salaried==0)
				{
					if($self_emp==1)
					{
						if($self_emp_amount[0]!="None")
						{
							$self_emp_search=" and (";
							for($i=0;$i<sizeof($self_emp_amount);$i++)
							{
								if($self_emp_amount[$i]==0)
								{
									$self_emp_search=$self_emp_search." ( Employment_Status=0 and Net_Salary>=50000 and Net_Salary<=100000 ) or ";
								}
								if($self_emp_amount[$i]==1)
								{
									$self_emp_search=$self_emp_search." ( Employment_Status=0 and Net_Salary>=100001 and Net_Salary<=200000 ) or ";
								}
								if($self_emp_amount[$i]==2)
								{
									$self_emp_search=$self_emp_search." ( Employment_Status=0 and Net_Salary>=200001 and Net_Salary<=300000 ) or ";
								}
								if($self_emp_amount[$i]==3)
								{
									$self_emp_search=$self_emp_search." ( Employment_Status=0 and Net_Salary>=300001 and Net_Salary<=500000 ) or ";
								}
								if($self_emp_amount[$i]==4)
								{
									$self_emp_search=$self_emp_search." ( Employment_Status=0 and Net_Salary>=500001 and Net_Salary<=1000000 ) or ";
								}
								if($self_emp_amount[$i]==5)
								{
									$self_emp_search=$self_emp_search." ( Employment_Status=0 and Net_Salary>=1000001 ) or ";
								}
								if($self_emp_amount[$i]==6)
								{
									$self_emp_search=$self_emp_search." ( Employment_Status=0 and Net_Salary<50000 ) or ";
								}
							}
							$self_emp_search=substr($self_emp_search,0,strlen($self_emp_search)-4);
							$self_emp_search=$self_emp_search." )";
						}
					}
				}
				
				//echo $qry.$search_criteria.$city_search.$city_search1.$salaried_search.$self_emp_search;			
				//$send_query=$qry.$search_criteria;
				$search_qry=$qry.$search_criteria.$city_search.$city_search1.$salaried_search.$self_emp_search;
				$search_result=ExecQuery($search_qry);
				
				$no_row=mysql_num_rows($search_result);
		?>
       <table width="450" border="0" cellpadding="4" cellspacing="1" class="blueborder">
         <form name="frmdownload" action="download_selected.php" method="post">
           <tr>
             <td colspan="9" class="head1"><strong><? echo $no_row; ?></strong>&nbsp;Search Result Found</td>
           </tr>
           <tr>
             <td width="35%" class="bluelink">Name</td>
             <td width="35%" class="bluelink">Company Name</td>
             <td width="20%" class="bluelink">City</td>
             <td width="10%" class="bluelink"><input name="Submit2" type="button" class="bluebutton" value="Check All" onClick="checkAll(document.frmleads)"></td>
           </tr>
			<?
				$RecordCount = mysql_num_rows($search_result);
				
				$MaxPage = $RecordCount % $PageSize;
				if($RecordCount % $PageSize == 0)
				{
					$MaxPage = $RecordCount / $PageSize;
				}
				else
				{
					$MaxPage = ceil($RecordCount / $PageSize);
				}
				
				$search_result=ExecQuery($search_qry." LIMIT $StartRow, $PageSize");
			
				$i=0;
				while($row_search=mysql_fetch_array($search_result))
				{
					if($loan_type=="personal_loan")
					{
						$loan_type1=1;
					}
					if($loan_type=="car_loan")
					{
						$loan_type1=3;
					}
					if($loan_type=="credit_card_loan")
					{
						$loan_type1=4;
					}
					if($loan_type=="loan_against_property")
					{
						$loan_type1=5;
					}
					if($loan_type=="home_loan")
					{
						$loan_type1=2;
					}
					$qry_download="select id from bidder_downloads1 where bidder_id=".$bidder_id." and request_id=".$row_search["RequestID"]." and loan_type=".$loan_type1."";
					$row_download=ExecQuery($qry_download);
					$no_download=mysql_num_rows($row_download);
					
					
					//Records insert into the temporary table
				if($loan_type=="personal_loan")
				{
					if($row_search["Employment_Status"]==0) { $emp_status="Self Employed";	$net_salary=$row_search["Net_Salary"]; } else { $emp_status="Salaried";	$net_salary=$row_search["Net_Salary"]; }
					if($row_search["Marital_Status"]==1) {  $marital_status="Single"; } else { $marital_status="Married"; }
					if($row_search["Residential_Status"]==1) { $residential_status="Owned"; }  if($row_search["Residential_Status"]==2) { $residential_status="Rented"; } if($row_search["Residential_Status"]==3) { $residential_status="Company Provided"; }
					if($row_search["Vehicles_Owned"]==0) { $vehicle_owned="2 Wheeler"; } if($row_search["Vehicles_Owned"]==1) { $vehicle_owned="4 Wheeler"; } if($row_search["Vehicles_Owned"]==2) { $vehicle_owned="Other"; }
					if($row_search["Loan_Any"]==0) { $loan_any="N/A"; } if($row_search["Loan_Any"]==1) { $loan_any="Car Loan"; } if($row_search["Loan_Any"]==2) { $loan_any="Home Loan"; } if($row_search["Loan_Any"]==3) { $loan_any="Personal Loan"; } if($row_search["Loan_Any"]==4) { $loan_any="Other"; }
					if($row_search["CC_Holder"]==1) { $cc_holder="Yes"; }  if($row_search["CC_Holder"]==0) { $cc_holder="No"; }
					$mobile_number1="";
					if($row_search["Mobile_Number"]=="")
					{
						$mobile_number1=$row_search["Phone"];
					}
					if($row_search["Mobile_Number"]==$row_search["Phone"])
					{
						$mobile_number1=$row_search["Mobile_Number"];
					}
					if($row_search["Mobile_Number"]!="" and $row_search["Phone"]!="")
					{
						if($row_search["Mobile_Number"]!=$row_search["Phone"])
						{
							$mobile_number1=$row_search["Mobile_Number"].", ".$row_search["Phone"];
						}
					}
					
					$qry1="insert into temp (session_id, name, email, dob, emp_status, c_name, city, city_other, year_in_comp, total_exp, mobile_number, net_salary, marital_status, residential_status, vehicle_owned, loan_any, emi_paid, cc_holder, loan_amount, count_views, count_replies, is_modified, is_processed, doe) values ('".$session_id."', '".$row_search["Name"]."', '".$row_search["DOB"]."', '".$row_search["Email"]."', '".$emp_status."', '".$row_search["Company_Name"]."', '".$row_search["City"]."', '".$row_search["City_Other"]."', '".$row_search["Years_In_Company"]."', '".$row_search["Total_Experience"]."', '".$mobile_number1."', '".$net_salary."', '".$marital_status."', '".$residential_status."', '".$vehicle_owned."', '".$loan_any."', '".$row_search["EMI_Paid"]."', '".$cc_holder."', '".$row_search["Loan_Amount"]."', '".$row_search["Count_Views"]."', '".$row_search["Count_Replies"]."', '".$row_search["IsModified"]."', '".$row_search["IsProcessed"]."', '".$row_search["Dated"]."')";
					$search_result1=ExecQuery($qry1);
				}
				if($loan_type=="car_loan")
				{
					if($row_search["Employment_Status"]==0) { $emp_status="Self Employed";	$net_salary=$row_search["Net_Salary"]; } else { $emp_status="Salaried";	$net_salary=$row_search["Net_Salary"]; }
					if($row_search["Car_Make"]==1) { $car_make="Chevrolet"; } if($row_search["Car_Make"]==2) { $car_make="Fiat"; } if($row_search["Car_Make"]==3) { $car_make="Ford"; } if($row_search["Car_Make"]==4) { $car_make="General Motors"; } if($row_search["Car_Make"]==5) { $car_make="Hindustan Motors"; } if($row_search["Car_Make"]==6) { $car_make="Honda"; } if($row_search["Car_Make"]==7) { $car_make="Hyundai"; } if($row_search["Car_Make"]==8) { $car_make="Lexus"; } if($row_search["Car_Make"]==9) { $car_make="Mahindra & Mahindra"; } if($row_search["Car_Make"]==10) { $car_make="Maruti Udyog Ltd"; } if($row_search["Car_Make"]==11) { $car_make="Mercedes Benz"; }  if($row_search["Car_Make"]==12) { $car_make="Nissan India"; } if($row_search["Car_Make"]==13) { $car_make="Porsche"; } if($row_search["Car_Make"]==14) { $car_make="Skoda Auto"; } if($row_search["Car_Make"]==15) { $car_make="Tata Motors"; } if($row_search["Car_Make"]==16) { $car_make="Toyota Kirlosker"; } if($row_search["Car_Make"]==17) { $car_make="Others"; } 		  				if($row_search["Car_Type"]==1) { $car_type="New"; } if($row_search["Car_Type"]==0) { $car_type="Used"; }
					$mobile_number1="";
					if($row_search["Mobile_Number"]=="")
					{
						$mobile_number1=$row_search["Phone"];
					}
					if($row_search["Mobile_Number"]==$row_search["Phone"])
					{
						$mobile_number1=$row_search["Mobile_Number"];
					}
					if($row_search["Mobile_Number"]!="" and $row_search["Phone"]!="")
					{
						if($row_search["Mobile_Number"]!=$row_search["Phone"])
						{
							$mobile_number1=$row_search["Mobile_Number"].", ".$row_search["Phone"];
						}
					}
		  
					$qry1="insert into temp (session_id, name, dob, email, emp_status, c_name, city, city_other, mobile_number, car_make, car_model, car_type, loan_tenure, descr, net_salary, loan_amount, count_views, count_replies, is_modified, is_processed, doe) values ('".$session_id."', '".$row_search["Name"]."', '".$row_search["DOB"]."', '".$row_search["Email"]."', '".$emp_status."', '".$row_search["Company_Name"]."', '".$row_search["City"]."', '".$row_search["City_Other"]."', '".$mobile_number1."', '".$row_search["Car_Make"]."', '".$row_search["Car_Model"]."', '".$car_type."', '".$row_search["Loan_Tenure"]."', '".$row_search["Descr"]."', '".$net_salary."', '".$row_search["Loan_Amount"]."', '".$row_search["Count_Views"]."', '".$row_search["Count_Replies"]."', '".$row_search["IsModified"]."', '".$row_search["IsProcessed"]."', '".$row_search["Dated"]."')";
					$search_result1=ExecQuery($qry1);
				}
				if($loan_type=="credit_card_loan")
				{
					if($row_search["Employment_Status"]==0) { $emp_status="Self Employed";	$net_salary=$row_search["Net_Salary"]; } else { $emp_status="Salaried";	$net_salary=$row_search["Net_Salary"]; }
		  			if($row_search["Vehicles_Owned"]==0) { $vehicle_owned="2 Wheeler"; } if($row_search["Vehicles_Owned"]==1) { $vehicle_owned="4 Wheeler"; } if($row_search["Vehicles_Owned"]==2) { $vehicle_owned="Other"; }
					if($row_search["CC_Holder"]==1) { $cc_holder="Yes"; }  if($row_search["CC_Holder"]==0) { $cc_holder="No"; }
					$mobile_number1="";
					if($row_search["Mobile_Number"]=="")
					{
						$mobile_number1=$row_search["Phone"];
					}
					if($row_search["Mobile_Number"]==$row_search["Phone"])
					{
						$mobile_number1=$row_search["Mobile_Number"];
					}
					if($row_search["Mobile_Number"]!="" and $row_search["Phone"]!="")
					{
						if($row_search["Mobile_Number"]!=$row_search["Phone"])
						{
							$mobile_number1=$row_search["Mobile_Number"].", ".$row_search["Phone"];
						}
					}
					
					$qry1="insert into temp (session_id, name, dob, email, emp_status, c_name, city, city_other, descr, total_exp, mobile_number, net_salary, vehicle_owned, cc_holder, loan_amount, count_views, count_replies, is_modified, is_processed, doe) values ('".$session_id."', '".$row_search["Name"]."', '".$row_search["DOB"]."', '".$row_search["Email"]."', '".$emp_status."', '".$row_search["Company_Name"]."', '".$row_search["City"]."', '".$row_search["City_Other"]."', '".$row_search["Descr"]."', '".$row_search["Total_Experience"]."', '".$mobile_number1."', '".$net_salary."', '".$vehicle_owned."', '".$cc_holder."', '".$row_search["Loan_Amount"]."', '".$row_search["Count_Views"]."', '".$row_search["Count_Replies"]."', '".$row_search["IsModified"]."', '".$row_search["IsProcessed"]."', '".$row_search["Dated"]."')";
					$search_result1=ExecQuery($qry1);
				}
				if($loan_type=="loan_against_property")
				{
					if($row_search["Employment_Status"]==0) { $emp_status="Self Employed";	$net_salary=$row_search["Net_Salary"]; } else { $emp_status="Salaried";	$net_salary=$row_search["Net_Salary"]; }
					if($row_search["Property_Type"]==0) { $property_type="Commercial Office Space"; } if($row_search["Property_Type"]==1) { $property_type="Apartment"; }	if($row_search["Property_Type"]==2) { $property_type="Industrial House";	} if($row_search["Property_Type"]==3) { $property_type="Showroom"; }	if($row_search["Property_Type"]==4){ $property_type="Factory"; } if($row_search["Property_Type"]==5) { $property_type="Plot";	} if($row_search["Property_Type"]==6) { $property_type="Godown";	} if($row_search["Property_Type"]==7) { $property_type="Bungalow"; }
					if($row_search["Residential_Status"]==1) { $residential_status="Owned"; }  if($row_search["Residential_Status"]==2) { $residential_status="Rented"; } if($row_search["Residential_Status"]==3) { $residential_status="Company Provided"; }
					$mobile_number1="";
					if($row_search["Mobile_Number"]=="")
					{
						$mobile_number1=$row_search["Phone"];
					}
					if($row_search["Mobile_Number"]==$row_search["Phone"])
					{
						$mobile_number1=$row_search["Mobile_Number"];
					}
					if($row_search["Mobile_Number"]!="" and $row_search["Phone"]!="")
					{
						if($row_search["Mobile_Number"]!=$row_search["Phone"])
						{
							$mobile_number1=$row_search["Mobile_Number"].", ".$row_search["Phone"];
						}
					}
								
					$qry1="insert into temp (session_id, name, dob, email, emp_status, c_name, city, city_other, mobile_number, descr, property_type, property_value, total_exp, net_salary, residential_status, loan_amount, count_views, count_replies, is_modified, is_processed, doe) values ('".$session_id."', '".$row_search["Name"]."', '".$row_search["DOB"]."', '".$row_search["Email"]."', '".$emp_status."', '".$row_search["Company_Name"]."', '".$row_search["City"]."', '".$row_search["City_Other"]."', '".$mobile_number1."', '".$row_search["Descr"]."', '".$property_type."', '".$row_search["Property_Value"]."', '".$row_search["Total_Experience"]."', '".$net_salary."', '".$residential_status."', '".$row_search["Loan_Amount"]."', '".$row_search["Count_Views"]."', '".$row_search["Count_Replies"]."', '".$row_search["IsModified"]."', '".$row_search["IsProcessed"]."', '".$row_search["Dated"]."')";
					$search_result1=ExecQuery($qry1);
				}
				if($loan_type=="home_loan")
				{
					if($row_search["Employment_Status"]==0) { $emp_status="Self Employed";	$net_salary=$row_search["Net_Salary"]; } else { $emp_status="Salaried";	$net_salary=$row_search["Net_Salary"]; }
					if($row_search["Property_Type"]==0) { $property_type="Commercial Office Space"; } if($row_search["Property_Type"]==1) { $property_type="Apartment"; }	if($row_search["Property_Type"]==2) { $property_type="Industrial House";	} if($row_search["Property_Type"]==3) { $property_type="Showroom"; }	if($row_search["Property_Type"]==4){ $property_type="Factory"; } if($row_search["Property_Type"]==5) { $property_type="Plot";	} if($row_search["Property_Type"]==6) { $property_type="Godown";	} if($row_search["Property_Type"]==7) { $property_type="Bungalow"; }
					$mobile_number1="";
					if($row_search["Mobile_Number"]=="")
					{
						$mobile_number1=$row_search["Phone"];
					}
					if($row_search["Mobile_Number"]==$row_search["Phone"])
					{
						$mobile_number1=$row_search["Mobile_Number"];
					}
					if($row_search["Mobile_Number"]!="" and $row_search["Phone"]!="")
					{
						if($row_search["Mobile_Number"]!=$row_search["Phone"])
						{
							$mobile_number1=$row_search["Mobile_Number"].", ".$row_search["Phone"];
						}
					}
									
					$qry1="insert into temp (session_id, name, email, emp_status, c_name, city, city_other, mobile_number, descr, property_type, property_value, total_exp, net_salary, loan_amount, count_views, count_replies, is_modified, is_processed, doe) values ('".$session_id."', '".$row_search["Name"]."', '".$row_search["DOB"]."', '".$row_search["Email"]."', '".$emp_status."', '".$row_search["Company_Name"]."', '".$row_search["City"]."', '".$row_search["City_Other"]."', '".$mobile_number1."', '".$row_search["Descr"]."', '".$property_type."', '".$row_search["Property_Value"]."', '".$row_search["Total_Experience"]."', '".$net_salary."', '".$row_search["Loan_Amount"]."', '".$row_search["Count_Views"]."', '".$row_search["Count_Replies"]."', '".$row_search["IsModified"]."', '".$row_search["IsProcessed"]."', '".$row_search["Dated"]."')";
					$search_result1=ExecQuery($qry1);
				}
				////
			?>
           <tr>
             <td class="bodyarial11"><? if($no_download>0) { ?><strong><? echo $row_search["Name"]; ?></strong><? } else { echo $row_search["Name"];  } ?></td>
             <td class="bodyarial11"><? if($no_download>0) { ?><strong><? echo $row_search["Company_Name"]; ?></strong><? } else { echo $row_search["Company_Name"];  } ?></td>
             <td class="bodyarial11"><? if($no_download>0) { ?><strong><? echo $row_search["City"]; ?></strong><? } else { echo $row_search["City"];  } ?></td>
             <td align="center"><input name="cb<? echo $i; ?>" type="checkbox" value="<? echo $row_search["RequestID"]; ?>"></td>
           </tr>
		   	<?
				$i=$i+1;
				}
			?>	
           <tr>
             <td colspan="9" align="center" class="bodyarial11">
			<input type="hidden" name="cblength" value="<? echo $i-1; ?>">
			<input name="search_qry" type="hidden" id="search_qry" value="<? echo $search_qry; ?>">
			<input name="bidder_id" type="hidden" id="bidder_id" value="<? echo $bidder_id; ?>">
			<input name="loan_type" type="hidden" id="loan_type" value="<? echo $loan_type; ?>">
			<input name="from_date" type="hidden" id="from_date" value="<? echo $min_date; ?>">
			<input name="to_date" type="hidden" id="to_date" value="<? echo $max_date; ?>">
			<input name="city" type="hidden" id="city" value="<? echo $city_data; ?>">
			<input name="session_id" type="hidden" id="session_id" value="<? echo $session_id; ?>">
			<input name="emp_status" type="hidden" id="emp_status" value="<? echo $emp_status; ?>">
			<input name="salaried" type="hidden" id="salaried" value="<? echo $salaried; ?>">
			<input name="salaried_amount" type="hidden" id="salaried_amount" value="<? echo $salaried_amount_data; ?>">
			<input name="self_emp" type="hidden" value="<? echo $self_emp; ?>">
			<input name="self_emp_amount" type="hidden" value="<? echo $self_emp_amount_data; ?>">
             <input name="Submit3" type="submit" class="bluebutton" value="Download Selected"></td>
           </tr>
         </form>
       </table>
	   <p>&nbsp;</p>
	   <table width="450" border="0" cellpadding="4" cellspacing="1" class="blueborder">
         <form name="frmqry" action="download.php" method="post" onSubmit="disabledownload();">
           <tr>
             <td align="center">
			 <?
				if($loan_type=="personal_loan")
				{
					$send_query="select name, dob, email, mobile_number, emp_status, c_name, city, city_other, year_in_comp, total_exp, net_salary, marital_status, residential_status, vehicle_owned, loan_any, emi_paid, cc_holder, loan_amount, count_views, count_replies, is_modified, is_processed, doe from temp where session_id='".$session_id."'";
				}
				if($loan_type=="car_loan")
				{
					$send_query="select name, dob, email, mobile_number, emp_status, c_name, city, city_other, car_make, car_model, car_type, loan_tenure, descr, net_salary, loan_amount, count_views, count_replies, is_modified, is_processed, doe from temp where session_id='".$session_id."'";
				}
				if($loan_type=="credit_card_loan")
				{
					$send_query="select name, dob, email, mobile_number, emp_status, c_name, city, city_other, descr, total_exp, net_salary, vehicle_owned, cc_holder, loan_amount, count_views, count_replies, is_modified, is_processed, doe from temp where session_id='".$session_id."'";
				}
				if($loan_type=="loan_against_property")
				{
					$send_query="select name, dob, email, mobile_number, emp_status, c_name, city, city_other, descr, property_type, property_value, total_exp, net_salary, residential_status, loan_amount, count_views, count_replies, is_modified, is_processed, doe from temp where session_id='".$session_id."'";
				}
				if($loan_type=="home_loan")
				{
					$send_query="select name, dob, email, mobile_number, emp_status, c_name, city, city_other, descr, property_type, property_value, total_exp, net_salary, loan_amount, count_views, count_replies, is_modified, is_processed, doe from temp where session_id='".$session_id."'";
				}
			?>
                 <input name="bidder_id" type="hidden" id="bidder_id" value="<? echo $bidder_id; ?>">
                 <input name="loan_type" type="hidden" id="loan_type" value="<? echo $loan_type; ?>">
                 <input name="from_date" type="hidden" id="from_date" value="<? echo $min_date; ?>">
                 <input name="to_date" type="hidden" id="to_date" value="<? echo $max_date; ?>">
                 <input name="city" type="hidden" id="city" value="<? echo $city_data; ?>">
                 <input name="city1" type="hidden" id="city1" value="<? echo $city1; ?>">
                 <input name="emp_status" type="hidden" id="emp_status" value="<? echo $emp_status; ?>">
                 <input name="qry2" type="hidden" id="qry2" value="<? echo $search_qry; ?>">
                 <input name="qry" type="hidden" id="qry" value="<? echo $send_query; ?>">
                 <input name="session_id" type="hidden" id="session_id" value="<? echo $session_id; ?>">
				 <input name="salaried" type="hidden" id="salaried" value="<? echo $salaried; ?>">
				 <input name="salaried_amount" type="hidden" id="salaried_amount" value="<? echo $salaried_amount_data; ?>">
				 <input name="self_emp" type="hidden" value="<? echo $self_emp; ?>">
				 <input name="self_emp_amount" type="hidden" value="<? echo $self_emp_amount_data; ?>">
                 <input name="Submit22" type="submit" class="bluebutton" value="Download All" border="0"></td>
           </tr>
         </form>
	     </table>
	   <?
	   }
	   ?>      
	   <p>&nbsp;</p>
	   <?
	   if($RecordCount>0)
	   {
	   ?>
	   <div align="center" class="bodytext">
	<?php
	    //echo First & Previous Link is necessary
        if($CounterStart != 1)
		{
            $PrevStart = $CounterStart - 1;
		?>
			<a onClick="javascript:sendmail('<? echo "&PageNo=1"; ?>')" style="cursor:hand">First</a>
			<a onClick="javascript:sendmail('<? echo "&PageNo=".$PrevStart; ?>')" style="cursor:hand">Previous</a>
            <!--echo "<a href=fresh_leads.php?PageNo=1 onClick='javascript:sendmail('$loan_type','$min_date','$max_date','$city','$city1','$salaried','$salaried_amount','$self_emp','$self_emp_amount')'>First </a>: -->
            <!--echo "<a href=fresh_leads.php?PageNo=$PrevStart onClick='javascript:sendmail('$loan_type','$min_date','$max_date','$city','$city1','$salaried','$salaried_amount','$self_emp','$self_emp_amount')'>Previous </a> -->
		<?
        }
        echo "  ";
        $c = 0;

        //echo Page No
        for($c=$CounterStart;$c<=$CounterEnd;$c++)
		{
            if($c < $MaxPage)
			{
                if($c == $PageNo)
				{
                    if($c % $PageSize == 0)
					{
                        echo "$c ";
                    }
					else
					{
                        echo "[$c] - ";
                    }
                }
				elseif($c % $PageSize == 0)
				{
				?>
                    <a onClick="javascript:sendmail('<? echo "&PageNo=".$c; ?>')" style="cursor:hand"><? echo $c; ?></a>
					<!--<a onClick="javascript:sendmail('<? //echo $loan_type; ?>','<? //echo $min_date; ?>','<? //echo $max_date; ?>','<? //echo $city[0]; ?>','<? //echo $city1; ?>','<? //echo $salaried; ?>','<? //echo $salaried_amount; ?>','<? //echo $self_emp; ?>','<? //echo $self_emp_amount; ?>')" style="cursor:hand"><? //echo $c; ?></a>
					echo "<a href=fresh_leads.php?PageNo=$c onClick='javascript:sendmail('$loan_type','$min_date','$max_date','$city','$city1','$salaried','$salaried_amount','$self_emp','$self_emp_amount')'>$c</a> ";-->
                
				<?
				}
				else
				{
				?>
					<a onClick="javascript:sendmail('<? echo "&PageNo=".$c; ?>')" style="cursor:hand"><? echo $c; ?></a>
				<?	
                    //echo "<a onClick='javascript:sendmail('$loan_type','$min_date','$max_date','$city','$city1','$salaried','$salaried_amount','$self_emp','$self_emp_amount')' style='cursor:hand'>$c</a> - ";
				
                }//END IF
            }
			else
			{
                if($PageNo == $MaxPage)
				{
                    echo " [$c] ";
                    break;
                }
				else
				{
				?>
					<a onClick="javascript:sendmail('<? echo "&PageNo=".$c; ?>')" style="cursor:hand"><? echo $c; ?></a>
                  <!--echo "<a onClick='javascript:sendmail('$loan_type','$min_date','$max_date','$city','$city1','$salaried','$salaried_amount','$self_emp','$self_emp_amount')' style='cursor:hand'> $c </a>-->
				<?
                 //href=fresh_leads.php?PageNo=$c 
				    break;
                }//END IF
            }//END IF
       }//NEXT

      echo "  ";

      if($CounterEnd < $MaxPage)
	  {
          $NextPage = $CounterEnd + 1;
		 ?>
		 <a onClick="javascript:sendmail('<? echo "&PageNo=".$NextPage; ?>')" style="cursor:hand">Next</a>
          <!--echo "<a onClick='javascript:sendmail('$loan_type','$min_date','$max_date','$city','$city1','$salaried','$salaried_amount','$self_emp','$self_emp_amount')' style='cursor:hand'>Next</a>
     // href=fresh_leads.php?PageNo=$NextPage-->
	 <?
	  }
      
		//echo Last link if necessary
		if($CounterEnd < $MaxPage)
		{
			$LastRec = $RecordCount % $PageSize;
			if($LastRec == 0)
			{
				$LastStartRecord = $RecordCount - $PageSize;
			}
		else
		{
			$LastStartRecord = $RecordCount - $LastRec;
		}
		
		echo " : ";
		?>
		<a onClick="javascript:sendmail('<? echo "&PageNo=".$MaxPage; ?>')" style="cursor:hand">Last</a>
		<!--echo "<a onClick='javascript:sendmail('$loan_type','$min_date','$max_date','$city','$city1','$salaried','$salaried_amount','$self_emp','$self_emp_amount')' style='cursor:hand'>Last</a>-->
		<?
		}
		?>
	</div>
	<?
	}
	?></td>
   </tr>
 </table>
<?php include '~Bottom.php'; ?>    
 </center>
</div>
</body>
</html>