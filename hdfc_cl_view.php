<?php
	require 'scripts/session_check_online.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';


function getReqValue1($pKey){
	$titles = array(
	'1' => 'Ahmedabad',
	'2' => 'Bangalore',
	'3' => 'Baroda',
	'4' => 'Chennai',
	'5' => 'Chandigarh',
	'6' => 'Delhi,Gurgaon,Noida,Gaziabad,Faridabad',
	'7' => 'Secunderabad,Hyderabad',
	'8' => 'Jaipur',
	'9' => 'Kolkata',
	'10' => 'Mumbai,Navi Mumbai,Thane',
	'11' => 'Pune',
	'12' => 'Surat',
	'13' => 'Amritsar',
	'14' => 'Aurangabad',
	'15' => 'Cochin',
	'16' => 'Jalandhar',
	'17' => 'Kanpur',
	'18' => 'Kolhapur',
	'19' => 'Lucknow',
	'20' => 'Kottayam',
	'21' => 'Ludhiana',
	'22' => 'Nagpur',
	'23' => 'Nasik',
	'24' => 'Rajkot',
	'25' => 'Trivandrum'
		
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

//	echo $city."<br>";
$branch=getReqValue1($city);

//echo "getbranchwise".$getbranchwise."<br>";

 $val = "Req_Loan_Car";

   $pro_code=3;

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
	document.frmsearch.action="hdfc_cl_view.php?search=y"+gifName;
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
	
		if(document.frmsearch.min_date.value<"2011-01-10")
	{
		alert("Sorry!!!! Your minimum date is 2011-01-10.Please Select.");
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
 eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
 if (restore) selObj.selectedIndex=0;
}


var ajaxRequest;  // The variable that makes Ajax possible!
		function ajaxFunction(){
			
			try{
				// Opera 8.0+, Firefox, Safari
				ajaxRequest = new XMLHttpRequest();
			} catch (e){
				// Internet Explorer Browsers
				try{
					ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
				} catch (e) {
					try{
						ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
					} catch (e){
						// Something went wrong
						alert("Your browser broke!");
						return false;
					}
				}
			}
		}

function insertData(id)
		{
			//alert("hello");
		var get_comment_section = document.getElementById('comment_section_'+ id).value;
		var get_requestid= document.getElementById('requestid_'+ id).value;
		var get_product= document.getElementById('product_'+ id).value;
		var get_bidderid= document.getElementById('bidderid').value;
		//alert(get_comment_section);
		//alert(get_requestid);
		//alert(get_bidderid);

		var queryString = "?comment_section=" + get_comment_section + "&get_requestid=" + get_requestid + "&get_product=" + get_product + "&get_bidderid=" + get_bidderid;
				
				//alert(queryString); 
				ajaxRequest.open("GET", "insert_comment_lms.php" + queryString, true);
				// Create a function that will receive data sent from the server
				ajaxRequest.onreadystatechange = function(){
					if(ajaxRequest.readyState == 4)
					{
						if(ajaxRequest.responseText=="insert")
						{
							alert('comment has been saved');
						}
						else
						{
							alert('cant save the comment');
						}
					}
				}

				ajaxRequest.send(null); 
			 
		}
	window.onload = ajaxFunction;
	
	function popitup(url) {
	newwindow=window.open(url,'name','height=180,width=290');
	if (window.focus) {newwindow.focus()}
	return false;
}

	
</script>

<table width="100%" border="0"  align="center" cellpadding="0" cellspacing="0" >

<tr>
    <td align="center">
	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#45B2D8">
      <tr>
	  <td style="padding-top:15px;"><table  width="669" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#5BBEE0" >
		
				<tr>
				  <td width="669" align="left" valign="top" bgcolor="#FFFFFF" style="background-repeat:no-repeat;" ><table width="97%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="40" align="center"  ><h1 style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; color:#052733; line-height:18px; font-weight:bold;">Welcome to Deal4Loans LMS</h1></td>
  </tr>
 <tr><td align="right"><a href="/hdfc_cl_appview.php" style="text-decoration:none; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px;"><b>App Leads</b></a></td></tr>
</table>
</td>
		 </tr>
		  </table></td>
 	</tr>
	<tr><td>&nbsp;</td></tr>
 <tr><td align="center">
 <table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
   <tr>
     <td height="30" align="center" valign="middle"><img src="images/login-srch-pnl.gif" width="650" height="30"></td>
   </tr>
   <tr>
     <td align="center" valign="middle" background="images/login-form-login-bg.gif"><table width="95%" border="0"  cellpadding="1" cellspacing="0">
 <form name="frmsearch" action="hdfc_cl_view.php?search=y" method="post" onSubmit="return chkform();">
   <tr><td colspan="3">&nbsp;</td></tr>
    <tr>
   <td colspan="3" align="center">
   <table border="0" width="90%" cellpadding="0" cellspacing="0"><tr>
     <td width="20%" valign="middle" class="style1">&nbsp;&nbsp;Date&nbsp;&nbsp; From </td>
     <td width="24%" align="left" valign="middle" class="bidderclass" ><?$current_date=date('Y-m-d');?> 
	   <input name="min_date" type="text" id="min_date" size="15" <? if($min_date=="") { ?>value="2011-01-10"<? } else { ?>value="<? echo $min_date; ?>" <? }?>></td>
	   <td>
       <input name="b12" type="button" class="bluebutton" onClick="javascript:pedirFecha(min_date,'');" value="&lt; Insert">  </td>
  
     <td valign="middle" align="center" class="style1" width="8%">To</td>
     <td align="left" valign="middle" class="style1" width="24%" >  <input name="max_date" type="text" id="max_date" size="15" value="<? echo $max_date; ?>"></td>
        <td> <input name="b122" type="button" class="bluebutton" onClick="javascript:pedirFecha(max_date,'');" value="&lt; Insert"></td>
	   </tr>
	   </table>
	   </td></tr>
   <tr>
   <td colspan="3" align="center"><table border="0" cellpadding="0" cellspacing="0" width="80%">
     
     <td width="20%" valign="middle" class="style1">Feedback:</td>
		 <td width="50%" align="left" valign="middle" class="bidderclass">
		<select name="cmbfeedback" id="cmbfeedback" style="width:120px;">
<option value="All" <? if($varCmbFeedback == "All") { echo "selected"; } ?>>All</option>
<option value="" <? if($varCmbFeedback == "") { echo "selected"; } ?>>No Feedback</option>
<option value="Process" <? if($varCmbFeedback == "Process") { echo "selected"; } ?>>Process</option>
<option value="Not Eligible" <? if($varCmbFeedback == "Not Eligible") { echo "selected"; } ?>>Not Eligible</option>
<option value="Not Interested" <? if($varCmbFeedback == "Not Interested") { echo "selected"; } ?>>Not Interested</option>
<option value="Callback Later" <? if($varCmbFeedback == "Callback Later") { echo "selected"; } ?>>Callback Later</option>
<option value="Wrong Number" <? if($varCmbFeedback == "Wrong Number") { echo "selected"; } ?>>Wrong Number</option>
<option value="Closed" <? if($varCmbFeedback == "Closed") { echo "selected"; } ?>>Closed</option>
<option value="FollowUp" <? if($varCmbFeedback == "FollowUp") { echo "selected"; } ?>>FollowUp</option>
<option value="Not Available" <? if($varCmbFeedback == "Not Available") { echo "selected"; } ?>>Not Available</option>
<option value="Ringing" <? if($varCmbFeedback == "Ringing") { echo "selected"; } ?>>Ringing</option>
<option value="Documents Pick" <? if($varCmbFeedback == "Documents Pick") { echo "selected"; } ?>>Documents Pick</option>
<option value="Loan Rejected" <? if($varCmbFeedback == "Loan Rejected") { echo "selected"; } ?>>Loan Rejected</option>
<option value="Appointment" <? if($varCmbFeedback == "Appointment") { echo "selected"; } ?>>Appointment</option>
		</select>	 </td>

		 <td width="30%" valign="middle" align="right" class="style1">City :&nbsp;&nbsp;&nbsp; </td>
     <td width="30%"  valign="middle" class="bidderclass"><select name="city" id="city">
	    <option value="26" <?if($city==26) { echo "selected";} ?>>All</option>
		<option value="1" <?if($city==1) { echo "selected";} ?>>Ahmedabad</option>
		<option value="2" <?if($city==2) { echo "selected";} ?>>Bangalore</option>
		<option value="3" <?if($city==3) { echo "selected";} ?>>Baroda</option>
		<option value="4" <?if($city==4) { echo "selected";} ?>>Chennai</option>
		<option value="5" <?if($city==5) { echo "selected";} ?>>Chandigarh</option>
		<option value="6" <?if($city==6) { echo "selected";} ?>>Delhi & NCR</option>
		<option value="7" <?if($city==7) { echo "selected";} ?>>Hyderabad</option>
		<option value="8" <?if($city==8) { echo "selected";} ?>>Jaipur</option>
		<option value="9" <?if($city==9) { echo "selected";} ?>>Kolkata</option>
		<option value="10" <?if($city==10) { echo "selected";} ?>>Mumbai</option>
		<option value="11" <?if($city==11) { echo "selected";} ?>>Pune</option>
		<option value="12" <?if($city==12) { echo "selected";} ?>>Surat</option>
		<option value="13" <?if($city==13) { echo "selected";} ?>>Amritsar</option>
		<option value="14" <?if($city==14) { echo "selected";} ?>>Aurangabad</option>
		<option value="15" <?if($city==15) { echo "selected";} ?>>Cochin</option>
		<option value="16" <?if($city==16) { echo "selected";} ?>>Jalandhar</option>
		<option value="17" <?if($city==17) { echo "selected";} ?>>Kanpur</option>
		<option value="18" <?if($city==18) { echo "selected";} ?>>Kolhapur</option>
		<option value="19" <?if($city==19) { echo "selected";} ?>>Lucknow</option>
		<option value="20" <?if($city==20) { echo "selected";} ?>>Kottayam</option>
		<option value="21" <?if($city==21) { echo "selected";} ?>>Ludhiana</option>
		<option value="22" <?if($city==22) { echo "selected";} ?>>Nagpur</option>
		<option value="23" <?if($city==23) { echo "selected";} ?>>Nasik</option>
		<option value="24" <?if($city==24) { echo "selected";} ?>>Rajkot</option>
		<option value="25" <?if($city==25) { echo "selected";} ?>>Trivandrum</option>
      </select></td>
        
	   </tr>
</table></td></tr>

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

		$result = ExecQuery("select FeedbackID from Req_Feedback where AllRequestID=".$RequestID." and BidderID=".$_SESSION['BidderID']);		
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
	//echo $strSQL;
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
	if(strlen($branch)>0)
		{
			
			$oldcity = explode(",", $branch);
			$newcity = implode ("','",$oldcity) ;
				//echo $newcity."<br>";
			$propercity="('".$newcity."')";
		}
		
		$consolidate_biddid="";

		if($city==26)
		{
			
		$search_qry="SELECT * FROM Req_Feedback_Bidder1,`".$val."` LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID=Req_Loan_Car.RequestID AND Req_Feedback.BidderID =".$_SESSION['BidderID']."  WHERE Req_Feedback_Bidder1.AllRequestID=`".$val."`.RequestID and Req_Feedback_Bidder1.BidderID in (1825,1880,1881,2095,2096,2097,2106,2113)  and Req_Feedback_Bidder1.Reply_Type=".$pro_code." and (Req_Feedback_Bidder1.Allocation_Date  Between '".($min_date)."' and '".($max_date)."' ) ";	
		$search_qry=$search_qry.$FeedbackClause;
		$search_qry=$search_qry."group by ".$val.".Mobile_Number";
		$search_qry=$search_qry." order by ".$val.".Dated DESC";

		$qry="SELECT comment_section,RequestID,Name,City,Mobile_Number,Net_Salary,Loan_Amount,Employment_Status,Feedback FROM Req_Feedback_Bidder1,`".$val."` LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID=Req_Loan_Car.RequestID AND Req_Feedback.BidderID =".$_SESSION['BidderID']."  WHERE Req_Feedback_Bidder1.AllRequestID=`".$val."`.RequestID and Req_Feedback_Bidder1.BidderID in (1825,1880,1881,2095,2096,2097,2106,2113) and Req_Feedback_Bidder1.Reply_Type=".$pro_code." and (Req_Feedback_Bidder1.Allocation_Date Between '".($min_date)."' and '".($max_date)."' ) ";
		$qry=$qry.$FeedbackClause;
		$qry=$qry."group by ".$val.".Mobile_Number";
		}
		else
		{

			$search_qry="SELECT * FROM Req_Feedback_Bidder1,`".$val."` LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID=Req_Loan_Car.RequestID AND Req_Feedback.BidderID =".$_SESSION['BidderID']."  WHERE Req_Feedback_Bidder1.AllRequestID=`".$val."`.RequestID and Req_Feedback_Bidder1.BidderID in (1825,1880,1881,2095,2096,2097,2106,2113)  and `".$val."`.City in ".$propercity." and Req_Feedback_Bidder1.Reply_Type=".$pro_code." and (Req_Feedback_Bidder1.Allocation_Date  Between '".($min_date)."' and '".($max_date)."' ) ";	
		$search_qry=$search_qry.$FeedbackClause;
		$search_qry=$search_qry."group by ".$val.".Mobile_Number";
		$search_qry=$search_qry." order by ".$val.".Dated DESC";

		$qry="SELECT comment_section,RequestID,Name,City,Mobile_Number,Net_Salary,Loan_Amount,Employment_Status,Feedback FROM Req_Feedback_Bidder1,`".$val."` LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID=Req_Loan_Car.RequestID AND Req_Feedback.BidderID =".$_SESSION['BidderID']."  WHERE Req_Feedback_Bidder1.AllRequestID=`".$val."`.RequestID and Req_Feedback_Bidder1.BidderID in (1825,1880,1881,2095,2096,2097,2106,2113)  and `".$val."`.City in ".$propercity." and Req_Feedback_Bidder1.Reply_Type=".$pro_code." and (Req_Feedback_Bidder1.Allocation_Date Between '".($min_date)."' and '".($max_date)."' ) ";
		$qry=$qry.$FeedbackClause;
		$qry=$qry."group by ".$val.".Mobile_Number";

		}
	
	//echo"hello".$qry."<br>";
		$result=ExecQuery($qry);
		$recordcount = mysql_num_rows($result);
 ?>
   <tr>
     <td colspan="9" style="border-bottom:1px solid #45B2D8;"><strong><? echo $startrow+1; ?> to <? echo min($startrow+$pagesize,$recordcount); ?> Out of <? echo $recordcount; ?> Records </strong></td>
     </tr>
   <tr>
      <td width="149" align="center" bgcolor="#FFFFFF" class="style2">Name</td>
	  <td width="70" align="center" bgcolor="#FFFFFF" class="style2">City</td>
     <td width="88" align="center" bgcolor="#FFFFFF" class="style2">Mobile</td>
     <td width="91" align="center" bgcolor="#FFFFFF" class="style2">Net Salary </td>
	  <td width="141" align="center" bgcolor="#FFFFFF" class="style2">Employment Status </td>
	  <td width="141" align="center" bgcolor="#FFFFFF" class="style2">Feedback </td>
 <td width="180" align="center" bgcolor="#FFFFFF" class="style2">Add Comment</td>
    
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
		if($city==26)
		{
	$qry="SELECT comment_section,RequestID,Name,City,Mobile_Number,Net_Salary,Loan_Amount,Employment_Status,Feedback FROM Req_Feedback_Bidder1,`".$val."` LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID=Req_Loan_Car.RequestID AND Req_Feedback.BidderID  =".$_SESSION['BidderID']."  WHERE Req_Feedback_Bidder1.AllRequestID=`".$val."`.RequestID and Req_Feedback_Bidder1.BidderID in (1825,1880,1881,2095,2096,2097,2106,2113) and Req_Feedback_Bidder1.Reply_Type=".$pro_code." and ( Req_Feedback_Bidder1.Allocation_Date Between '".($min_date)."' and '".($max_date)."' ) ";
		$qry=$qry.$FeedbackClause;
		$qry=$qry."group by ".$val.".Mobile_Number";
		$qry=$qry." order by ".$val.".Dated DESC";
		$qry=$qry." LIMIT $startrow, $pagesize"; 
		}
		else
		{
			$qry="SELECT comment_section,RequestID,Name,City,Mobile_Number,Net_Salary,Loan_Amount,Employment_Status,Feedback FROM Req_Feedback_Bidder1,`".$val."` LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID=Req_Loan_Car.RequestID AND Req_Feedback.BidderID  =".$_SESSION['BidderID']."  WHERE Req_Feedback_Bidder1.AllRequestID=`".$val."`.RequestID and Req_Feedback_Bidder1.BidderID in (1825,1880,1881,2095,2096,2097,2106,2113) and `".$val."`.City in ".$propercity." and Req_Feedback_Bidder1.Reply_Type=".$pro_code." and ( Req_Feedback_Bidder1.Allocation_Date Between '".($min_date)."' and '".($max_date)."' ) ";
		$qry=$qry.$FeedbackClause;
		$qry=$qry."group by ".$val.".Mobile_Number";
		$qry=$qry." order by ".$val.".Dated DESC";
		$qry=$qry." LIMIT $startrow, $pagesize"; 
		}
		
//echo $qry;
		$result=ExecQuery($qry);

		$i=1;
		if($recordcount>0)
		{
		while($row=mysql_fetch_array($result))
		{
			
			
			$sqlHDFC_Car = ExecQuery("SELECT * FROM hdfc_car_loan_leads WHERE car_loan_ReqId=".$row['RequestID']);
			$rowHDFC_Car=mysql_fetch_array($sqlHDFC_Car);
			//print_r($rowHDFC_Car);
			
	?>
	<input type="hidden" name="requestid_<? echo $i;?>" id="requestid_<? echo $i;?>" value="<? echo $row["RequestID"];?>">
		<input type="hidden" name="product_<? echo $i;?>" id="product_<? echo $i;?>" value="<? echo $pro_code;?>">
			<input type="hidden" name="bidderid" id="bidderid" value="<? echo $_SESSION['BidderID'];?>">
   <tr>
       <td align="center" bgcolor="#DFF6FF" class="style3" ><? echo $row["Name"]; ?></td>
	  <td align="center" bgcolor="#DFF6FF" class="style3"><? echo $row["City"]; ?></td>
     <td align="center" bgcolor="#DFF6FF" class="style3"><? echo $row["Mobile_Number"]; ?></td>
     <td align="center" bgcolor="#DFF6FF" class="style3"><? echo $row["Net_Salary"]; ?></td>
	     <td align="center" bgcolor="#DFF6FF" class="style3"><? if($row["Employment_Status"]==0) { echo "Self Employed"; } else { echo "Salaried"; }?></td> 
	 <td align="center" bgcolor="#DFF6FF" class="style3"><? echo getJumpMenu("hdfc_cl_view.php",$row["RequestID"],"1",$row["Feedback"],$pageno,$varmin_date,$varmax_date,$varCmbFeedback, $val,$city) ?></td>
	 
	<td align="center" bgcolor="#DFF6FF" class="bodyarial11" ><table width="100%"><tr><td><textarea  name="comment_section_<? echo $i;?>" id="comment_section_<? echo $i;?>" cols="18" rows="1"><? echo $row["comment_section"]; ?></textarea></td><td><a onClick="insertData(<? echo $i;?>);" style="cursor:pointer; color:blue;" class="style3">&nbsp;&nbsp;Save</a> <?php  if($rowHDFC_Car['pdfDownload']==1) {?>  | <a  href="#" onClick="return popitup('hdfcgeneratePDF.php?vid=<?php echo $row["RequestID"]; ?>')" style="cursor:pointer; color:blue;">Download</a>  <?php }?></td></tr></table></td>
   			
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
 <tr><!--<td>
 <table border="0" cellspacing="0" cellpadding="0">
 <form name="frmdownload" action="bidder_download.php" method="post">
   <tr>
     <td align="center">
	   <input type="hidden" name="qry1" value="<? echo $search_qry; ?>">
	   <input type="hidden" name="qry2" value="<? echo $val; ?>">
	 
	    <input type="hidden" name="min_date" value="<? echo $min_date; ?>">
	   <input type="hidden" name="max_date" value="<? echo $max_date; ?>">
	 <input name="Submit2" type="submit" class="bluebtn" value="Export List To Open Office">
	 </td>
   </tr>
   </table>
 </form>
 </td>-->
 <td align="center">
 <table border="0" cellspacing="0" cellpadding="0">
 <form name="xlsdownload" action="bidder_download.php" method="post">
   <tr>
     <td align="center">
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

<?
function getJumpMenu($varPHPPage, $varRequestID, $varType, $varFeedback, $varpageon, $varmindate, $varmaxdate,$cmbfeedback,$varVal,$varcity)
{
	$strURL="";
$strURL=$varPHPPage."?search=y&RequestID=".$varRequestID."&type=".$varType."&pageno=".$varpageon."&min_date=".urlencode($varmindate)."&max_date=".urlencode($varmaxdate)."&cmbfeedback=".urlencode($cmbfeedback)."&product=".$varVal."&city=".$varcity;
?>
	<select name="type" id="type" onChange="MM_jumpMenu('parent',this,0)">
		<option value="<? echo $strURL.'&Feedback='?>" <? if($varFeedback == "") { echo "selected"; } ?> >No Feedback</option>
		<option value="<? echo $strURL.'&Feedback=Process'?>" <? if($varFeedback == "Process") { echo "selected"; } ?>>Process</option>
		<option value="<? echo $strURL.'&Feedback=Not Eligible'?>" <? if($varFeedback == "Not Eligible") { echo "selected"; } ?>>Not Eligible</option>
		<option value="<? echo $strURL.'&Feedback=Not Interested'?>" <? if($varFeedback == "Not Interested") { echo "selected"; } ?>>Not Interested</option>
		<option value="<? echo $strURL.'&Feedback=Callback Later'?>" <? if($varFeedback == "Callback Later") { echo "selected"; } ?>>Callback Later</option>
		<option value="<? echo $strURL.'&Feedback=Wrong Number'?>" <? if($varFeedback == "Wrong Number") { echo "selected"; } ?>>Wrong Number</option>
		<option value="<? echo $strURL.'&Feedback=Closed'?>" <? if($varFeedback == "Closed") { echo "selected"; } ?>>Closed</option>
		
	<option value="<? echo $strURL.'&Feedback=FollowUp'?>" <? if($varFeedback == "FollowUp") { echo "selected"; } ?>>FollowUp</option>
		<? //} ?>
		<option value="<? echo $strURL.'&Feedback=Not Available'?>" <? if($varFeedback == "Not Available") { echo "selected"; } ?>>Not Available</option>
		
		<option value="<? echo $strURL.'&Feedback=Ringing'?>" <? if($varFeedback == "Ringing") { echo "selected"; } ?>>Ringing</option>
		
		<option value="<? echo $strURL.'&Feedback=Documents Pick'?>" <? if($varFeedback == "Documents Pick") { echo "selected"; } ?>>Documents Pick</option>
		
		<option value="<? echo $strURL.'&Feedback=Loan Rejected'?>" <? if($varFeedback == "Loan Rejected") { echo "selected"; } ?>>Loan Rejected</option>
		
		<option value="<? echo $strURL.'&Feedback=Appointment'?>" <? if($varFeedback == "Appointment") { echo "selected"; } ?>>Appointment</option>
				
</select>
	
<?
}

?>
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
