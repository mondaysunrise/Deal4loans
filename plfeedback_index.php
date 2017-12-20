<?php
	require 'scripts/session_check_online.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

$mktime  = mktime(0, 0, 0, date("m")  , date("d")-4, date("Y"));
$defaultmaxDate = date("Y-m-d", $mktime);

$mkMintime  = mktime(0, 0, 0, date("m")  , date("d")-8, date("Y"));
$defaultminDate = date("Y-m-d", $mkMintime);


 $val = "Req_Loan_Personal";

	$FeedbackClause="";

	$plfeedback = "";
	if(isset($_REQUEST['plfeedback']))
	{
		$plfeedback = $_REQUEST['plfeedback'];
	}
	
	$contacted = "";
	if(isset($_REQUEST['contacted']))
	{
		$contacted = $_REQUEST['contacted'];
	}
	
	
	
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


#navcontainer{
margin:0px auto;
text-align: center;
}

 #navcontainer ul{
margin: 0px;
padding: 0px;
list-style-type: none;
text-align: center;
}

#navcontainer ul li {
 display: inline; }

#navcontainer ul li a{
text-decoration: none;
font-family:Verdana, Arial, Helvetica, sans-serif;
font-size:14px;
font-weight:bold;
padding: 0px 4px;
border:1px solid #e8e6e6;
color:#474849;
}

#navcontainer ul li a:active{
text-decoration: none;
font-family:Verdana, Arial, Helvetica, sans-serif;
font-size:14px;
font-weight:bold;
padding: 0px 4px;
border:1px solid #e8e6e6;
color:#2959d3;
}

#navcontainer ul li a:hover
{
padding: 0px 4px;
border:1px solid #da7d42;
color:#474849 ;
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
	document.frmsearch.action="plfeedback_index.php?search=y"+gifName;
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
	
	if(document.frmsearch.min_date.value>"<?php echo $defaultmaxDate;?>")
	{
		alert("Sorry!!!! Your minimum date should be less <?php echo $defaultmaxDate;?>.Please Select.");
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
	if(document.frmsearch.max_date.value > "<?php echo $defaultmaxDate; ?>")
	{
		alert("Sorry!!!! Your maximum date is <?php echo $defaultmaxDate;?>. Please Select.");
		document.frmsearch.max_date.value="";
		document.frmsearch.max_date.focus();
		return false;
	}
	
	
}

function MM_jumpMenu(targ,selObj,restore){ //v3.0
 eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
 if (restore) selObj.selectedIndex=0;
}

function checkDownload()
{
	alert("Please download data less than 1200.");
	return false;
}


</script>
<script>

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
		
		function insertPLContact(i)
		{
			
		//	alert("Test");
			var lead_id = document.getElementById('lead_id').value;
			//alert(lead_id);
			var contacted = document.getElementById('contacted_'+i).value;
			//alert(feedback);
			var bidder_id =  document.getElementById('bidder_id_'+i).value;

			if((lead_id!=""))
			{

				var queryString = "?lead_id=" + lead_id + "&contacted="+ contacted + "&bidder_id=" + bidder_id ;
				//alert(queryString); 
				ajaxRequest.open("GET", "plContacts.php" + queryString, true);
				// Create a function that will receive data sent from the server
				ajaxRequest.onreadystatechange = function(){
					if(ajaxRequest.readyState == 4)
					{
						
						var ajaxDisplay = document.getElementById('feeds');
						ajaxDisplay.innerHTML = ajaxRequest.responseText;
						
					
					}
				}

				ajaxRequest.send(null); 
			 }
			
		
		}

	
	window.onload = ajaxFunction;
</script>

<table width="100%" border="0"  align="center" cellpadding="0" cellspacing="0" >
<tr>
    <td align="right" style="padding-right:30px; font-weight:bold;">
    <a href="plfeedback_search.php">Serach by Phone</a> |  <a href="plfeedback_index.php">Serach by Date</a>
    </td></tr> 
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
     <td align="center" valign="middle" background="images/login-form-login-bg.gif">
	 <table width="95%" border="0"  cellpadding="1" cellspacing="0">
 <form name="frmsearch" action="plfeedback_index.php?search=y" method="post" onSubmit="return chkform();">
   
  <tr><td colspan="3">&nbsp;</td></tr>
  
   <tr>
   <td colspan="3" align="center">
   <table border="0" width="90%" cellpadding="0" cellspacing="3"><tr>
     <td width="20%" valign="middle" class="style1">&nbsp;&nbsp;Date&nbsp;&nbsp; From </td>
     <td width="24%" align="left" valign="middle" class="bidderclass" ><? $current_date=date('Y-m-d');?> 
	   <input name="min_date" type="text" id="min_date" size="15" <? if($min_date=="") { ?>value="<?php echo $defaultmaxDate; ?>"<? } else { ?>value="<? echo $min_date; ?>" <? }?>></td>
	   <td>
       <input name="b12" type="button" class="bluebutton" onClick="javascript:pedirFecha(min_date,'');" value="&lt; Insert">  </td>
  
     <td valign="middle" align="center" class="style1" width="8%">To</td>
     <td align="left" valign="middle" class="style1" width="24%" >  <input name="max_date" type="text" id="max_date" size="15" value="<? echo $max_date; ?>"></td>
        <td> <input name="b122" type="button" class="bluebutton" onClick="javascript:pedirFecha(max_date,'');" value="&lt; Insert"></td>
	   </tr>
	   <tr><td  valign="middle" class="style1">Feedback</td><td><select name="plfeedback" id="plfeedback" >
	<option value="" <? if($plfeedback == "") { echo "selected"; }?>>No Feedback</option>
	<option value="All" <? if($plfeedback == "All") { echo "selected"; }?>>All</option>
	<option value="Requirement Postponed/Cancelled" <? if($plfeedback == "Requirement Postponed/Cancelled") { echo "selected"; }?>>Requirement Postponed/Cancelled </option>
	<option value="Appointment" <? if($plfeedback == "Appointment") { echo "selected"; }?>>Appointment</option>
	<option value="Not Interested" <? if($plfeedback == "Not Interested") { echo "selected"; }?>>Not Interested</option>
	<option value="Follow Up/Out of station" <? if($plfeedback == "Follow Up/Out of station") { echo "selected"; }?>>Follow Up/Out of station</option>
    
	<option value="WIP / Already Applied" <? if($plfeedback == "WIP / Already Applied") { echo "selected"; }?>>WIP / Already Applied</option>
     <option value="Not Contactable" <? if($plfeedback == "Not Contactable") { echo "selected"; }?>>Not Contactable</option>
	<option value="Done Through Own/Other Source" <? if($plfeedback == "Done Through Own/Other Source") { echo "selected"; }?>>Done Through Own/Other Source</option>
	<option value="Lead Clash" <? if($plfeedback == "Lead Clash") { echo "selected"; }?>>Lead Clash</option>
	<option value="Closed Cases" <? if($plfeedback == "Closed Cases") { echo "selected"; }?>>Closed Cases</option>
	<option value="Esclation" <? if($plfeedback == "Esclation") { echo "selected"; }?>>Esclation</option>
	<option value="Application Rejected" <? if($plfeedback == "Application Rejected") { echo "selected"; }?>>Application Rejected</option>
	<option value="Other Issues" <? if($plfeedback == "Other Issues") { echo "selected"; }?>>Other Issues</option>
	</select>	</td>
	<td></td>
	<td colspan="2"  valign="middle" class="style1">Contact Status</td><td>
	<select name="contacted" id="contacted" >
<option value="All" <? if($contacted == "All") { echo "selected"; }?>>Select</option>
<option value="Yes" <? if($contacted == "Yes") { echo "selected"; }?>>Yes</option>
<option value="No" <? if($contacted == "No") { echo "selected"; }?>>No</option>
</select></td>
	</tr>
	   </table>
	   </td></tr>
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

	if($search=="y")
	{
		$min_date=$min_date." 00:00:00";
		$max_date=$max_date." 23:59:59";
		
		if(strlen(trim($plfeedback))=='No')
		{
			$FeedbackClause=" AND (pl_feedback.feedback  IS NULL OR pl_feedback.feedback ='') ";
		}
		else if($plfeedback=="All")
		{
			$FeedbackClause=" ";
		}
		else
		{
			$FeedbackClause=" AND pl_feedback.feedback ='".$plfeedback."' ";
		}
		
		if(strlen(trim($contacted))==0)
		{
			$ContactedClause=" AND (pl_feedback.contacted  IS NULL OR pl_feedback.contacted ='') ";
		}
		else if($contacted=="All")
		{
			$ContactedClause=" ";
		}
		else
		{
			$ContactedClause=" AND pl_feedback.contacted ='".$contacted."' ";
		}


	?>
 <p class="bodyarial11"><?=$Msg?></p>
 <table width="950" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#FFFFFF" >
 <? 
//		$search_qry = "SELECT * FROM Req_Loan_Personal LEFT JOIN (Req_Feedback_Bidder1, pl_feedback) ON (Req_Feedback_Bidder1.AllRequestID=Req_Loan_Personal.RequestID and pl_feedback.lead_id=Req_Loan_Personal.RequestID ) WHERE Req_Feedback_Bidder1.AllRequestID=Req_Loan_Personal.RequestID and  Req_Feedback_Bidder1.Reply_Type='1' and (Req_Feedback_Bidder1.Allocation_Date Between '".($min_date)."' and '".($max_date)."' ) ".$FeedbackClause." ".$ContactedClause."  group by Req_Feedback_Bidder1.AllRequestID";
		
				$search_qry = "SELECT * FROM Req_Loan_Personal LEFT JOIN (Req_Feedback_Bidder1, pl_feedback) ON (Req_Feedback_Bidder1.AllRequestID=Req_Loan_Personal.RequestID and pl_feedback.lead_id=Req_Loan_Personal.RequestID ) WHERE Req_Feedback_Bidder1.AllRequestID=Req_Loan_Personal.RequestID and  Req_Feedback_Bidder1.Reply_Type='1' and (Req_Feedback_Bidder1.Allocation_Date Between '".($min_date)."' and '".($max_date)."' ) ".$FeedbackClause."  group by Req_Feedback_Bidder1.AllRequestID";
				
				

		
//		 $qry = "SELECT * FROM Req_Loan_Personal LEFT JOIN (Req_Feedback_Bidder1, pl_feedback) ON (Req_Feedback_Bidder1.AllRequestID=Req_Loan_Personal.RequestID and pl_feedback.lead_id=Req_Loan_Personal.RequestID ) WHERE Req_Feedback_Bidder1.AllRequestID=Req_Loan_Personal.RequestID and  Req_Feedback_Bidder1.Reply_Type='1' and (Req_Feedback_Bidder1.Allocation_Date Between '".($min_date)."' and '".($max_date)."' ) ".$FeedbackClause." ".$ContactedClause."  group by Req_Feedback_Bidder1.AllRequestID";
//	MOD(Req_Loan_Personal.RequestID,4)=2
	
	if($_SESSION['BidderID']==2632)
	{
		$search_qry = "SELECT * FROM Bidders, Req_Feedback_Bidder1 LEFT JOIN pl_feedback ON pl_feedback.lead_id = Req_Feedback_Bidder1.AllRequestID WHERE ( MOD(Req_Feedback_Bidder1.AllRequestID,4)=0 and Req_Feedback_Bidder1.Allocation_Date BETWEEN '".($min_date)."' AND '".($max_date)."'  AND Req_Feedback_Bidder1.BidderID = Bidders.BidderID AND Bidders.Define_PrePost = 'PostPaid' AND Req_Feedback_Bidder1.Reply_Type =1 ) ".$FeedbackClause." ".$ContactedClause." GROUP BY AllRequestID";
		
		$qry = "SELECT * FROM Bidders, Req_Feedback_Bidder1 LEFT JOIN pl_feedback ON pl_feedback.lead_id = Req_Feedback_Bidder1.AllRequestID WHERE ( MOD(Req_Feedback_Bidder1.AllRequestID,4)=0 and Req_Feedback_Bidder1.Allocation_Date BETWEEN '".($min_date)."' AND '".($max_date)."'  AND Req_Feedback_Bidder1.BidderID = Bidders.BidderID AND Bidders.Define_PrePost = 'PostPaid' AND Req_Feedback_Bidder1.Reply_Type =1 ) ".$FeedbackClause." ".$ContactedClause." GROUP BY AllRequestID";
	}
	else if($_SESSION['BidderID']==2633)
	{
		$search_qry = "SELECT * FROM Bidders, Req_Feedback_Bidder1 LEFT JOIN pl_feedback ON pl_feedback.lead_id = Req_Feedback_Bidder1.AllRequestID WHERE ( MOD(Req_Feedback_Bidder1.AllRequestID,4)=1 and Req_Feedback_Bidder1.Allocation_Date BETWEEN '".($min_date)."' AND '".($max_date)."'  AND Req_Feedback_Bidder1.BidderID = Bidders.BidderID AND Bidders.Define_PrePost = 'PostPaid' AND Req_Feedback_Bidder1.Reply_Type =1 ) ".$FeedbackClause." ".$ContactedClause." GROUP BY AllRequestID";
		
		$qry = "SELECT * FROM Bidders, Req_Feedback_Bidder1 LEFT JOIN pl_feedback ON pl_feedback.lead_id = Req_Feedback_Bidder1.AllRequestID WHERE ( MOD(Req_Feedback_Bidder1.AllRequestID,4)=1 and Req_Feedback_Bidder1.Allocation_Date BETWEEN '".($min_date)."' AND '".($max_date)."'  AND Req_Feedback_Bidder1.BidderID = Bidders.BidderID AND Bidders.Define_PrePost = 'PostPaid' AND Req_Feedback_Bidder1.Reply_Type =1 ) ".$FeedbackClause." ".$ContactedClause." GROUP BY AllRequestID";
	}
	else if($_SESSION['BidderID']==2634)
	{
		$search_qry = "SELECT * FROM Bidders, Req_Feedback_Bidder1 LEFT JOIN pl_feedback ON pl_feedback.lead_id = Req_Feedback_Bidder1.AllRequestID WHERE ( MOD(Req_Feedback_Bidder1.AllRequestID,4)=2 and Req_Feedback_Bidder1.Allocation_Date BETWEEN '".($min_date)."' AND '".($max_date)."'  AND Req_Feedback_Bidder1.BidderID = Bidders.BidderID AND Bidders.Define_PrePost = 'PostPaid' AND Req_Feedback_Bidder1.Reply_Type =1 ) ".$FeedbackClause." ".$ContactedClause." GROUP BY AllRequestID";
		$qry = "SELECT * FROM Bidders, Req_Feedback_Bidder1 LEFT JOIN pl_feedback ON pl_feedback.lead_id = Req_Feedback_Bidder1.AllRequestID WHERE ( MOD(Req_Feedback_Bidder1.AllRequestID,4)=2 and Req_Feedback_Bidder1.Allocation_Date BETWEEN '".($min_date)."' AND '".($max_date)."'  AND Req_Feedback_Bidder1.BidderID = Bidders.BidderID AND Bidders.Define_PrePost = 'PostPaid' AND Req_Feedback_Bidder1.Reply_Type =1 ) ".$FeedbackClause." ".$ContactedClause." GROUP BY AllRequestID";
	}
	else if($_SESSION['BidderID']==2635)
	{
		$search_qry = "SELECT * FROM Bidders, Req_Feedback_Bidder1 LEFT JOIN pl_feedback ON pl_feedback.lead_id = Req_Feedback_Bidder1.AllRequestID WHERE ( MOD(Req_Feedback_Bidder1.AllRequestID,4)=3 and Req_Feedback_Bidder1.Allocation_Date BETWEEN '".($min_date)."' AND '".($max_date)."'  AND Req_Feedback_Bidder1.BidderID = Bidders.BidderID AND Bidders.Define_PrePost = 'PostPaid' AND Req_Feedback_Bidder1.Reply_Type =1 ) ".$FeedbackClause." ".$ContactedClause." GROUP BY AllRequestID";
		$qry = "SELECT * FROM Bidders, Req_Feedback_Bidder1 LEFT JOIN pl_feedback ON pl_feedback.lead_id = Req_Feedback_Bidder1.AllRequestID WHERE ( MOD(Req_Feedback_Bidder1.AllRequestID,4)=3 and Req_Feedback_Bidder1.Allocation_Date BETWEEN '".($min_date)."' AND '".($max_date)."'  AND Req_Feedback_Bidder1.BidderID = Bidders.BidderID AND Bidders.Define_PrePost = 'PostPaid' AND Req_Feedback_Bidder1.Reply_Type =1 ) ".$FeedbackClause." ".$ContactedClause." GROUP BY AllRequestID";
	}
		
		//$qry=$qry.$FeedbackClause;
	//	$qry=$qry."group by ".$val.".Mobile_Number";
		
	//echo "hello".$qry."<br>";
		$result=ExecQuery($qry);
		$recordcount = mysql_num_rows($result);
//		$recordcount = 0;
 ?>
  
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
		// $qry="SELECT * FROM Req_Loan_Personal LEFT JOIN (Req_Feedback_Bidder1,pl_feedback) ON (Req_Feedback_Bidder1.AllRequestID=Req_Loan_Personal.RequestID  and pl_feedback.lead_id=Req_Loan_Personal.RequestID) WHERE Req_Feedback_Bidder1.AllRequestID=Req_Loan_Personal.RequestID and  Req_Feedback_Bidder1.Reply_Type='1' and (Req_Feedback_Bidder1.Allocation_Date Between '".($min_date)."' and '".($max_date)."' ) ".$FeedbackClause." ".$ContactedClause." group by Req_Feedback_Bidder1.AllRequestID";
	if($_SESSION['BidderID']==2632)
	{
		$qry = "SELECT Req_Feedback_Bidder1.AllRequestID as ReqID, pl_feedback.feedback as Pfeedback, pl_feedback.followupdate as followupdate  FROM Bidders, Req_Feedback_Bidder1 LEFT JOIN pl_feedback ON pl_feedback.lead_id = Req_Feedback_Bidder1.AllRequestID WHERE (MOD(Req_Feedback_Bidder1.AllRequestID,4)=0 and  Req_Feedback_Bidder1.Allocation_Date BETWEEN '".($min_date)."' AND '".($max_date)."'  AND Req_Feedback_Bidder1.BidderID = Bidders.BidderID AND Bidders.Define_PrePost = 'PostPaid' AND Req_Feedback_Bidder1.Reply_Type =1 ) ".$FeedbackClause." ".$ContactedClause." GROUP BY AllRequestID";
	}
	else if($_SESSION['BidderID']==2633)
	{
		$qry = "SELECT Req_Feedback_Bidder1.AllRequestID as ReqID, pl_feedback.feedback as Pfeedback, pl_feedback.followupdate as followupdate  FROM Bidders, Req_Feedback_Bidder1 LEFT JOIN pl_feedback ON pl_feedback.lead_id = Req_Feedback_Bidder1.AllRequestID WHERE (MOD(Req_Feedback_Bidder1.AllRequestID,4)=1 and Req_Feedback_Bidder1.Allocation_Date BETWEEN '".($min_date)."' AND '".($max_date)."'  AND Req_Feedback_Bidder1.BidderID = Bidders.BidderID AND Bidders.Define_PrePost = 'PostPaid' AND Req_Feedback_Bidder1.Reply_Type =1 ) ".$FeedbackClause." ".$ContactedClause." GROUP BY AllRequestID";
	}	
	else if($_SESSION['BidderID']==2634)
	{
		$qry = "SELECT Req_Feedback_Bidder1.AllRequestID as ReqID, pl_feedback.feedback as Pfeedback, pl_feedback.followupdate as followupdate  FROM Bidders, Req_Feedback_Bidder1 LEFT JOIN pl_feedback ON pl_feedback.lead_id = Req_Feedback_Bidder1.AllRequestID WHERE ( MOD(Req_Feedback_Bidder1.AllRequestID,4)=2 and Req_Feedback_Bidder1.Allocation_Date BETWEEN '".($min_date)."' AND '".($max_date)."'  AND Req_Feedback_Bidder1.BidderID = Bidders.BidderID AND Bidders.Define_PrePost = 'PostPaid' AND Req_Feedback_Bidder1.Reply_Type =1 ) ".$FeedbackClause." ".$ContactedClause." GROUP BY AllRequestID ";
	}	
	else if($_SESSION['BidderID']==2635)
	{
		$qry = "SELECT Req_Feedback_Bidder1.AllRequestID as ReqID, pl_feedback.feedback as Pfeedback, pl_feedback.followupdate as followupdate FROM Bidders, Req_Feedback_Bidder1 LEFT JOIN pl_feedback ON pl_feedback.lead_id = Req_Feedback_Bidder1.AllRequestID WHERE (MOD(Req_Feedback_Bidder1.AllRequestID,4)=3 and Req_Feedback_Bidder1.Allocation_Date BETWEEN '".($min_date)."' AND '".($max_date)."'  AND Req_Feedback_Bidder1.BidderID = Bidders.BidderID AND Bidders.Define_PrePost = 'PostPaid' AND Req_Feedback_Bidder1.Reply_Type =1 ) ".$FeedbackClause." ".$ContactedClause." GROUP BY AllRequestID";
	}	
	    $qry=$qry." order by Req_Feedback_Bidder1.Allocation_Date DESC";
		$qry=$qry." LIMIT $startrow, $pagesize"; 
//echo "<br>";		
//echo $qry;
		$result=ExecQuery($qry);

		$i=1;
		if($recordcount>0)
		{
		?>
		 <tr>
     <td colspan="11" style="border-bottom:1px solid #45B2D8;"><strong><? echo $startrow+1; ?> to <? echo min($startrow+$pagesize,$recordcount); ?> Out of <? echo $recordcount; ?> Records </strong></td>
     </tr>
		  <tr>
   
     <td width="131" align="center" bgcolor="#FFFFFF" class="style2">Name</td>
	  <td width="84" align="center" bgcolor="#FFFFFF" class="style2">City</td>
     <td width="90" align="center" bgcolor="#FFFFFF" class="style2">Mobile</td>
     <td width="108" align="center" bgcolor="#FFFFFF" class="style2">Net Salary </td>
     <td width="251" align="center" bgcolor="#FFFFFF" class="style2">LMS Feedback + Followup Date</td>
	  <td width="128" align="center" bgcolor="#FFFFFF" class="style2">Bidders </td>
	   <td width="136" align="center" bgcolor="#FFFFFF" class="style2">Customer Feedback</td>
    
   </tr>
<?php
		
		while($row=mysql_fetch_array($result))
		{
			$REquestID = $row["ReqID"];
			$Pfeedback = $row["Pfeedback"];
			$followupdate = $row["followupdate"];
			
			$getUserSql = "select * from Req_Loan_Personal where RequestID='".$REquestID."'";
			$getUserQuery = ExecQuery($getUserSql);
			$rowUser = mysql_fetch_array($getUserQuery);
			
			if($i%2==0)
			{	
				$bgcolor = "#CCCCCC";	
			}
			else
			{
				$bgcolor = "#DFF6FF";	
			}
			
		?>
	 <tr bgcolor="" >
        <td align="left" bgcolor="<?php echo $bgcolor; ?>" class="style3" height="30" >&nbsp;&nbsp;<a href="plfeedbackedit.php?id=<?php echo $REquestID; ?>&to=<? echo $min_date;?>&from=<? echo $max_date;?>&fbidder_id=<? echo $_SESSION['BidderID'];?>" target="_blank"><? echo $rowUser["Name"]; ?></a></td>
     	<td align="center" bgcolor="<?php echo $bgcolor; ?>" class="style3"><? echo  $rowUser["City"]; ?></td>
	    <td align="center" bgcolor="<?php echo $bgcolor; ?>" class="style3"><? echo   $rowUser["Mobile_Number"]; ?></td>
	    <td align="center" bgcolor="<?php echo $bgcolor; ?>" class="style3"><? echo   $rowUser["Net_Salary"]; ?></td>
     	<td align="center" bgcolor="<?php echo $bgcolor; ?>" class="style3">
		<? 
		$feedsSql = "select * from pl_feedback where lead_id='".$REquestID."'";
		$feedsQuery = ExecQuery($feedsSql);
		$feedsNum = mysql_num_rows($feedsQuery);
		$fbbidder_id ='';
		$fbfeedback = '';
		$fbfollowupdate = '';
		for($jk=0;$jk<$feedsNum;$jk++)
		{
			$fbbidder_id = mysql_result($feedsQuery,$jk,'bidder_id');
			$fbfeedback = mysql_result($feedsQuery,$jk,'feedback');
			$fbfollowupdate = mysql_result($feedsQuery,$jk,'followupdate');
			echo $fbfeedback; echo "  "; if($fbfollowupdate!='0000-00-00 00:00:00') { echo $fbfollowupdate; }  
			echo " [".$fbbidder_id."] ";
			echo "<br>";
		}
		?></td> 
	 	<td align="left" bgcolor="<?php echo $bgcolor; ?>" class="style3">
	 <?php

	 $getBiddersSql = "select * from Req_Feedback_Bidder1 where  Reply_Type = 1 and AllRequestID='".$REquestID."'";
	 $getBiddersQuery = ExecQuery($getBiddersSql);
	 $numgetBidders = mysql_num_rows($getBiddersQuery);
	 $BFeeds = "";
	 $BiddersFeedback = "";
	 for($ii=0;$ii<$numgetBidders;$ii++)
	 {
	 
	 	$BFeeds = '';
		 $Bidder_ID = mysql_result($getBiddersQuery,$ii,'BidderID');
	 	 $checkBidderSql = "select * from Bidders where BidderID='".$Bidder_ID."' and  Bidders.Define_PrePost = 'PostPaid'";
		 $checkBidderQuery = ExecQuery($checkBidderSql);
		 
		 $checkNumRows = mysql_num_rows($checkBidderQuery);
		 if($checkNumRows>0)
		 {
		 $BFeeds = '';
			 $BidNameSql = "select * from Bank_Master left join Bidders_List on Bidders_List.BankID=Bank_Master.BankID where Bidders_List.BidderID='".$Bidder_ID."'";
			 $BidNameQuery = ExecQuery($BidNameSql);
			 $BidderName = mysql_result($BidNameQuery,0,'Bank_Name');
			
			 $bidderFeedbackSql = "select * from Req_Feedback where AllRequestID = '".$REquestID."' and  BidderID='".$Bidder_ID."' and Reply_Type=1";
			 $bidderFeedbackQuery = ExecQuery($bidderFeedbackSql);
			 $numbidderFeedback = mysql_num_rows($bidderFeedbackQuery);
			 if($numbidderFeedback>0)
			 {
			 $BFeeds = '';
				$feedbackB = mysql_result($bidderFeedbackQuery,0,'Feedback');
				if(strlen($feedbackB)>0)
				{
					$BFeeds =" [ ".$feedbackB." ]";
				}
			 }
			  else if($BidderName=="HDFC")
			 {
			 $arrBidderID = array(1887,1888,1889,1890,1891,1948,1949,1950,1951,1952,1953,1954,1955,1956,1957,1958,1959,1960);
			 if(in_array($Bidder_ID,$arrBidderID))
			 {
				 $BFeeds = '';
					$getReqSql = "select hdfcplid from hdfc_pl_calc_leads where RequestID = '".$REquestID."'";
					$getReqQuery = ExecQuery($getReqSql);
					$getReqNum = mysql_num_rows($getReqQuery);
					$hdfcplid = mysql_result($getReqQuery,0,'hdfcplid');
					if($getReqNum>0 && $hdfcplid>0)
					{
						$BFeeds = '';
						 $bidderFeedbackSql = "select Feedback from Req_Feedback where (AllRequestID = '".$hdfcplid."' and  BidderID in (2037,2410,2411) and Reply_Type=1)";
						 $bidderFeedbackQuery = ExecQuery($bidderFeedbackSql);
						 $numbidderFeedback = mysql_num_rows($bidderFeedbackQuery);
						 if($numbidderFeedback>0)
						 {
							$feedbackB = mysql_result($bidderFeedbackQuery,0,'Feedback');
							if(strlen($feedbackB)>0)
							{
								$BFeeds =" <b>[ ".$feedbackB." ]</b>";
						  }
						}	 
					}
				}
			 }
			 
			  echo "&nbsp;&nbsp;&nbsp;&nbsp;".$BidderName." [".$Bidder_ID."] ".$BFeeds."<br>";
			 $BiddersFeedback[] = $BidderName." ".$BFeeds;
		}
	 }
	 $Feedback = implode(", ", $BiddersFeedback);
	// echo $Feedback;
	 ?>
	 </td>
   		<td align="left" bgcolor="<?php echo $bgcolor; ?>" class="style3">
	 <?php
	 $cusFeedSql = "select * from customer_experience_with_banks where requestid = '".$REquestID."' and productid=1";
	 $cusFeedQuery = ExecQuery($cusFeedSql);
	 
	 $gone_to_bankid = mysql_result($cusFeedQuery,0,'gone_to_bankid');
	 $gone_to_bankname = mysql_result($cusFeedQuery,0,'gone_to_bankname');
	 $bank_experience = mysql_result($cusFeedQuery,0,'bank_experience');
	 $received_call = mysql_result($cusFeedQuery,0,'received_call');
	 
	 $arr_received_call = explode(",",$received_call);
	 $arr_gone_to_bankname = explode(",",$gone_to_bankname);

//	 print_r($arr_gone_to_bankname);

	if(count($arr_gone_to_bankname)>0 && strlen($arr_gone_to_bankname[0])>0)
	{
		 for($iij=0;$iij<count($arr_gone_to_bankname);$iij++)
		 {
			 echo "&nbsp;&nbsp;&nbsp;&nbsp;".$arr_gone_to_bankname[$iij]." [".$arr_received_call[$iij]."]<br>";
		 }
	 }
	 ?>
	</td>		
   </tr>
	<?
		
	$i=$i+1;
		}
		
		}
	else
	{
	?>
	 <tr>
     <td colspan="11" style="border-bottom:1px solid #45B2D8;" align="center"><strong>No Records Found</strong></td>
     </tr>
	
	<?php
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
       <td align="center" id="navcontainer">
	 <? 
		$c=1;
		echo "<ul>";
		for($c=1;$c<=$maxpage;$c++)
		{	
			echo "<li>";
			if( $pageno==$c)
			{
				
				echo $c."&nbsp;";
			}
			else
			{
			?>
				<a onClick="javascript:sendmail('<? echo "&id=".$i."&pageno=".$c; ?>')" style="cursor:hand;"><? echo $c; ?></a>
			<?
			}
			echo "</li>";
		
		} 
		echo "</ul>";
		?>		</td>
   </tr>
   <? 
   } 
   ?>
 </table>
 
 <br>
	<?php
	if($recordcount>1200)
	{
?>
<!--<table width="500" border="0" cellspacing="1" cellpadding="4">
 <form name="frmdownload" action="plfeedback_index.php" method="post">
   <tr>
     <td align="center">
	 
	 <input name="Submit3" type="button" class="bluebtn" value="Export List To Excel" onClick="checkDownload();">
	 
	 </td>
   </tr>
 </form>
 </table> -->

<?php	
	}
	else
	{
	?>
 <!--<table width="500" border="0" cellspacing="1" cellpadding="4">
 <form name="frmdownload" action="plfeedback_download.php" method="post">
   <tr>
     <td align="center">
	   <input type="hidden" name="qry1" value="<? echo $search_qry; ?>">
	   <input type="hidden" name="qry2" value="<? echo $val; ?>">
	 
	    <input type="hidden" name="min_date" value="<? echo $min_date; ?>">
	   <input type="hidden" name="max_date" value="<? echo $max_date; ?>">

	 <input name="Submit2" type="submit" class="bluebtn" value="Export List To Excel">
	 
	 <?php
	 
	 ?>
	 </td>
   </tr>
 </form>
 </table> -->
<?php
}
?>


   <?
 }
 ?>
 </td></tr></table>
</td></tr></table>
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
