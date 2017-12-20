<?php
	require 'scripts/session_check_online.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
			function appendzero($number, $digits=2)	{  $output = str_pad($number, $digits, "0", STR_PAD_LEFT);	   return $output;	} 
	
	$plfeedback="";
	if(isset($_REQUEST['plfeedback']))
	{
		$Feedback=$_REQUEST['plfeedback'];
	}
	$lms_details="";
	if(isset($_REQUEST['lms_details']))
	{
		$lms_details=$_REQUEST['lms_details'];
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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Personal Loan MIS Report</title>
<style type="text/css">
.data_text_a{ font-family:Verdana, Geneva, sans-serif; font-size:12px; color: #333;}
.data_text_b{ font-family:Verdana, Geneva, sans-serif; font-size:16px; font-weight:bold; color:#C33;}
.data_text_c{ font-family:Verdana, Geneva, sans-serif; font-size:14px; color:#6C6; font-weight: bold;}
table{border:1px solid #CCC; margin:0px 0px 0px 0px; padding:0px 0px 0px 0px;} 
</style>
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

.buttonfordate {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: #FFFFFF;
	background-color: #45B2D8;
	border: 1px solid #45B2D8;
	font-weight: bold;
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
	document.frmsearch.action="bidders_index.php?search=y"+gifName;
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
	
	if(document.frmsearch.min_date.value<"<?php echo $joindate;?>")
	{
		alert("Sorry!!!! Your minimum date is <?php echo $joindate;?>.Please Select.");
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

function MM_jumpMenu(targ,selObj,restore){ //v3.0
//alert( selObj.selectedIndex);
 eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
 if (restore) selObj.selectedIndex=0;
}
</script>
</head>
<body>
<?php 
	 if(isset($_SESSION['UserType']))
	{
echo "<table width='100%' border='0' cellspacing='0' cellpadding='0'><tr><td width='323' height='93' align='left' valign='top'  ><img src='http://www.deal4loans.com/rnew/images/login-logo.gif' width='323' height='93' /></td><td align='left' valign='top' style='color:#0B6FCC;' ><table width='100%' border='0' cellspacing='0' cellpadding='0' bgcolor='#0A92C0'><tr><td height='67' align='right' valign='middle' bgcolor='#C8E3F3' style='padding-right:10px;'><table border='0' align='right' cellpadding='0' cellspacing='0' bgcolor='#0A92C0'><tr><td width='6' height='32' align='left' valign='top'><img  src='http://www.deal4loans.com/rnew/images/login-form-logut-lft.gif' width='6' height='32' /></td><td background='http://www.deal4loans.com/rnew/images/login-form-logut-bg.gif' style=' background-repeat:repeat-x; height:32px;'><table width='100%' border='0' align='center' cellpadding='0' cellspacing='0'><tr><td align='left' valign='middle' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#FFFFFF; font-weight:bold; padding-right:15px;' > Welcome ".ucwords($_SESSION['UserType'])." ".$_SESSION['UName']."</td><td align='left' style='padding-right:2px;' width='22'><img src='http://www.deal4loans.com/rnew/images/login-logut-btn.gif' /></td><td align='right' class='style1' style='color:#FFFFFF; font-weight:bold;'><div align='right' class='style1' style='color:#FFFFFF; font-weight:bold;'> <a href='Logout.php' style='color:#FFFFFF; font-size:13px; text-decoration:none; font-family:Verdana, Arial, Helvetica, sans-serif;'>Logout</a></div></td></tr></table></td><td width='6' height='32'><img src='http://www.deal4loans.com/rnew/images/login-form-logut-rgt.gif' width='6' height='32' /></td></tr></table></td></tr><tr><td>&nbsp;</td></tr></table></td></tr></table>";
	}

	include "mis_head.php";
?>
<table width="100%" border="0" cellspacing="2" cellpadding="2">
<tr>
    <td align="center" style="font-family:Arial, Helvetica, sans-serif; font-size:16px; font-weight:bold;">
Personal Loan</td></tr>
  <tr>
    <td align="center">
<table width="600" border="0" align="center" cellpadding="0" cellspacing="0" style="border:#0033CC 1px solid;">
   <tr>
     <td height="30" align="center" valign="middle"><img src="images/login-srch-pnl.gif" width="650" height="30"></td>
   </tr>
   <tr>
     <td align="center" valign="middle" background="images/login-form-login-bg.gif"><table width="95%" border="0"  cellpadding="1" cellspacing="0">
 <form name="frmsearch" action="plmisreport.php?search=y" method="post" onSubmit="return chkform();">
   <tr><td colspan="3">&nbsp;</td></tr>

   <tr>
   <td colspan="3" align="center">
   <table border="0" width="90%" cellpadding="0" cellspacing="0"><tr>
     <td width="20%" valign="middle" class="style1">&nbsp;&nbsp;Date&nbsp;&nbsp; From </td>
     <td width="24%" align="left" valign="middle" class="bidderclass"><?$current_date=date('Y-m-d');?> 
	     <input name="min_date" type="text" id="min_date" size="15" <? if($min_date=="") { ?>value="<? echo $joindate; ?>"<? } else { ?>value="<? echo $min_date; ?>" <? }?>></td>
     <td width="7%" align="left" valign="middle" class="bidderclass"><input name="b12" type="button" class="buttonfordate" onClick="javascript:pedirFecha(min_date,'');" value="&lt; Insert" bgcolor="#45B2D8"> </td>
  
     <td valign="middle" align="center" class="style1" width="8%">To</td>
     <td align="left" valign="middle" class="style1" width="24%"> <input name="max_date" type="text" id="max_date" size="15" value="<? echo $max_date; ?>"></td>
     <td align="left" valign="middle" class="style1" width="17%"><input name="b122" type="button" class="buttonfordate" onClick="javascript:pedirFecha(max_date,'');" value="&lt; Insert"></td>
	   </tr>
	   </table>
	   </td></tr>
   <tr>
   <td colspan="3" align="center"><table border="0" cellpadding="0" cellspacing="0" width="85%">
     <td width="30%" valign="middle" class="style1">LMs</td>
     <td width="30%"  valign="middle" class="bidderclass">
     <select name="lms_details" id="lms_details">
     <option value="All" <? if($lms_details == "All") { echo "selected"; }?>>All</option>
     <option value="846" <? if($lms_details == "846") { echo "selected"; }?>>PL LMS 1</option>
     <option value="847" <? if($lms_details == "847") { echo "selected"; }?>>PL LMS 2</option>
     <option value="854" <? if($lms_details == "854") { echo "selected"; }?>>PL LMS 3</option>
     <option value="9" <? if($lms_details == "9") { echo "selected"; }?>>PL LMS 4</option>
     <option value="10" <? if($lms_details == "10") { echo "selected"; }?>>PL LMS 5</option>
	 <option value="63" <? if($lms_details == "63") { echo "selected"; }?>>PL LMS 6</option>
	 <option value="67" <? if($lms_details == "67") { echo "selected"; }?>>PL LMS 7</option>
	 <option value="68" <? if($lms_details == "68") { echo "selected"; }?>>PL LMS 8</option>
      <option value="3621" <? if($lms_details == "3621") { echo "selected"; }?>>PL Evening LMS</option>
     </select>
		</td>
     <td width="10%"  valign="middle" class="bidderclass">&nbsp;</td>
   
     <td width="30%" valign="middle" class="style1"><!--Feedback: --></td>


     <td width="50%" align="left" valign="middle" class="bidderclass">
	   <!-- <select name="plfeedback" id="feedback">
		<option value="No Feedback" <? if($Feedback == "") { echo "selected"; }?>>No Feedback</option>
		<option value="Other Product" <? if($Feedback == "Other Product") { echo "selected"; }?>>Other Product</option>
		<option value="Not Interested" <? if($Feedback == "Not Interested") { echo "selected"; }?>>Not Interested</option>
		<option value="Callback Later" <? if($Feedback == "Callback Later") { echo "selected"; }?>>Callback Later</option>
		<option value="Wrong Number" <? if($Feedback == "Wrong Number") { echo "selected"; }?>>Wrong Number</option>
		<option value="Send Now" <? if($Feedback == "Send Now") { echo "selected"; }?>>Send Now</option>
		<option value="Not Eligible" <? if($Feedback == "Not Eligible") { echo "selected"; }?>>Not Eligible</option>
		<option value="Duplicate" <? if($Feedback == "Duplicate") { echo "selected"; }?>>Duplicate</option>
		<option value="Not Contactable" <? if($Feedback == "Not Contactable") { echo "selected"; }?>>Not Contactable</option>
		<option value="Ringing" <? if($Feedback == "Ringing") { echo "selected"; }?>>Ringing</option>
	<option value="FollowUp" <? if($Feedback == "FollowUp") { echo "selected"; }?>>FollowUp</option>
	<option value="Not Applied" <? if($Feedback == "Not Applied") { echo "selected"; }?>>Not Applied</option>
	</select> --> </td>
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
  
 </table>


</td></tr>
  <tr>
    <td align="center">

<?php
if($_GET['search']=='y')
{

	$min_date=$min_date." 00:00:00";
	$max_date=$max_date." 23:59:59";
	
	if(strlen(trim($Feedback))==0)
	{
		$FeedbackClause=" AND (Req_Feedback.Feedback IS NULL OR Req_Feedback.Feedback='') ";
	}
	else if($Feedback=="All")
	{
		$FeedbackClause=" ";
	}
	else
	{
		$FeedbackClause=" AND Req_Feedback.Feedback='".$Feedback."' ";
	}

$biddIDS = '';
if($lms_details=="All")
{
	$biddIDS = array(9,10,846,847,854,3621,63,67,68);
}
else 
{
	$biddIDS = array($lms_details);
}

	for($j=0;$j<count($biddIDS);$j++)
	{	
	$sql_PL = "select Req_Feedback_PL.Feedback as Feedback, count(*) as CountLeads from Req_Feedback_PL left join Req_Loan_Personal on Req_Loan_Personal.RequestID = Req_Feedback_PL.AllRequestID where (Req_Loan_Personal.Dated between '".$min_date."' and '".$max_date."') and  Req_Feedback_PL.BidderID='".$biddIDS[$j]."' group by Req_Feedback_PL.Feedback";
	$sql_Query = ExecQuery($sql_PL);
	$count_Leads = mysql_num_rows($sql_Query);	
	if($count_Leads>0)
	{
	?>
 <table width="950" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#FFFFFF" >
  <tr>
     <td  align="left" bgcolor="#FFFFFF" class="style2" height="25" colspan="2" style="border-bottom:#660000 dashed 2px;">
	 <?php 
	 if($biddIDS[$j]==847)
	 {
	 	echo "PL LMS 2 [847]";
	 }
	 else if($biddIDS[$j]==846)
	 {
	 	echo "PL LMS 1 [846]";
	 }
	 else if($biddIDS[$j]==854)
	 {
	 	echo "PL LMS 3 [854]";
	 }
	 else if($biddIDS[$j]==9)
	 {
	 	echo "PL LMS 4 [9]";
	 }
	 else if($biddIDS[$j]==10)
	 {
	 	echo "PL LMS 5 [10]";
	 }
	  else if($biddIDS[$j]==63)
	 {
	 	echo "PL LMS 6 [63]";
	 }
	  else if($biddIDS[$j]==67)
	 {
	 	echo "PL LMS 7 [67]";
	 }
	  else if($biddIDS[$j]==68)
	 {
	 	echo "PL LMS 8 [68]";
	 }
	 else if($biddIDS[$j]==3621)
	 {
	 	echo "PL Evening LMS [3621]";
	 }	 
	 ?>     
     </td>
     </tr>     
  <tr>
   
     <td width="149" align="center" bgcolor="#FFFFFF" class="style2" height="25">Feedback</td>
     <td width="149" align="center" bgcolor="#FFFFFF" class="style2">Count Leads</td>
     </tr>     
    <?php
		for($i=0;$i<$count_Leads;$i++)
		{
			$Feedback = mysql_result($sql_Query,$i,'Feedback');
			$CountLeads = mysql_result($sql_Query,$i,'CountLeads');
		?>
		<tr>
             <td align="center" bgcolor="#DFF6FF" class="style3"><? echo $Feedback; ?></td>
		     <td align="center" bgcolor="#DFF6FF" class="style3" height="25"><? echo $CountLeads; ?></td>
		</tr>

        
        <?php
		}
	?>
	</table>
	<?php
	}
	else
	{
		echo "No Feedback";
	}
}
}
?>
</td></tr></table>
</body>
</html>
