<?php
require 'scripts/session_check_online.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	require 'scripts/campaign_lead_cost.php';
	session_start();


	$product=$_SESSION['ReplyType'];
	$date=$_SESSION['Date'];
		
		$textview=ExecQuery("select Reply_Type from Bidders_List where BidderID=".$_SESSION['BidderID']);
		$viewtexttype=mysql_result($textview,0,"Reply_Type");
//echo "hello".$viewtexttype;

	function getReqValue1($pKey){
	$titles = array(
        '1' => 'Req_Loan_Personal',
		'2' => 'Req_Loan_Home',
		'3' => 'Req_Loan_Car',
		'4' => 'Req_Credit_Card',
		'5' => 'Req_Loan_Against_Property',
		'6' => 'Req_Business_Loan',

	);
	foreach ($titles as $key=>$value)
	    if($pKey==$key)
		return $value;

	return "";
  }
  function getReqCode($pKey){
    $titles = array(
        'Req_Loan_Personal' => '1',
        'Req_Loan_Home' => '2',
        'Req_Loan_Car' => '3',
        'Req_Credit_Card' => '4',
        'Req_Loan_Against_Property' => '5',
        'Req_Business_Loan' => '6'
    );
    foreach ($titles as $key=>$value)
        if($pKey==$key)
        return $value;

    return "";
  }
   
 
  $val = $_REQUEST['product'];
 // echo "bye".$val;
   $pro_code=getReqCode($val);

	$FeedbackClause="";


	$search="";
	if(isset($_GET['search']))
	{
		$search=$_GET['search'];
	}
	$citywise="";
if(isset($_REQUEST['citywise']))
	{
		$citywise=$_REQUEST['citywise'];
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

	//echo "hello".$Feedback;
	
	
	
   
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
echo "<table width='100%' border='0' cellspacing='0' cellpadding='0'><tr><td width='323' height='93' align='left' valign='top'  ><img src='http://www.deal4loans.com/images/logo.gif' width='323' height='93' /></td><td align='left' valign='top' style='color:#0B6FCC;' ><table width='100%' border='0' cellspacing='0' cellpadding='0' bgcolor='#0A92C0'><tr><td height='67' align='right' valign='middle' bgcolor='#C8E3F3' style='padding-right:10px;'><table border='0' align='right' cellpadding='0' cellspacing='0' bgcolor='#0A92C0'><tr><td width='6' height='32' align='left' valign='top'><img  src='http://www.deal4loans.com/rnew/images/login-form-logut-lft.gif' width='6' height='32' /></td><td background='http://www.deal4loans.com/rnew/images/login-form-logut-bg.gif' style=' background-repeat:repeat-x; height:32px;'><table width='100%' border='0' align='center' cellpadding='0' cellspacing='0'><tr><td align='left' valign='middle' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#FFFFFF; font-weight:bold; padding-right:15px;' > Welcome ".ucwords($_SESSION['UserType'])." ".$_SESSION['UName']."</td><td align='left' style='padding-right:2px;' width='22'><img src='http://www.deal4loans.com/rnew/images/login-logut-btn.gif' /></td><td align='right' class='style1' style='color:#FFFFFF; font-weight:bold;'><div align='right' class='style1' style='color:#FFFFFF; font-weight:bold;'> <a href='Logout.php' style='color:#FFFFFF; font-size:13px; text-decoration:none; font-family:Verdana, Arial, Helvetica, sans-serif;'>Logout</a></div></td></tr></table></td><td width='6' height='32'><img src='http://www.deal4loans.com/rnew/images/login-form-logut-rgt.gif' width='6' height='32' /></td></tr></table></td></tr><tr><td>&nbsp;</td></tr></table></td></tr></table>";
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
	document.frmsearch.action="campaign-lmsview.php?search=y"+gifName;
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
	<?if($_SESSION['Date']>$mindefineDate)
		{?>
	if(document.frmsearch.min_date.value<"<?php echo $mindefineDate;?>")
	{
		alert("Sorry!!!! Your minimum date is <?php echo $mindefineDate;?>.Please Select.");
		document.frmsearch.min_date.value="";
		document.frmsearch.min_date.focus();
		return false;
	}
	<? } 
	else {?>
		if(document.frmsearch.min_date.value<"2009-12-15")
	{
		alert("Sorry!!!! Your minimum date is 2009-12-15. Please Select.");
		document.frmsearch.min_date.value="";
		document.frmsearch.min_date.focus();
		return false;
	}
	<? }?>
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

function gettooltip(get)
{
	//alert(get);
	if(get==1)
	{
		//alert(get);
	}

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

</script>



<table width="100%" border="0"  align="center" cellpadding="0" cellspacing="0" >

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
     <td height="30" align="center" valign="middle" class="style1"  background="images/login-form-login-bg.gif" style="font-size:14px;">Home Loan</td>
   </tr>
   <tr>
     <td align="center" valign="middle" background="images/login-form-login-bg.gif"><table width="95%" border="0"  cellpadding="1" cellspacing="0">
 <form name="frmsearch" action="campaign-lmsview.php?search=y" method="post" onSubmit="return chkform();">
   <tr>
   <td colspan="3" align="center">
   <table border="0" width="90%" cellpadding="0" cellspacing="0"><tr>
     <td width="20%" valign="middle" class="style1">&nbsp;&nbsp;Date&nbsp;&nbsp; From </td>
     <td width="24%" align="left" valign="middle" class="bidderclass"><? $current_date=date('Y-m-d');?> 
	     <input name="min_date" type="text" id="min_date" size="15" <? if($min_date=="") { ?>value="<? echo $mindefineDate; ?>"<? } else { ?>value="<? echo $min_date; ?>" <? }?>></td>
     <td width="7%" align="left" valign="middle" class="bidderclass"><input name="b12" type="button" class="buttonfordate" onClick="javascript:pedirFecha(min_date,'');" value="&lt; Insert" bgcolor="#45B2D8"> </td>
  
     <td valign="middle" align="center" class="style1" width="8%">To</td>
     <td align="left" valign="middle" class="style1" width="24%"> <input name="max_date" type="text" id="max_date" size="15" value="<? echo $max_date; ?>"></td>
     <td align="left" valign="middle" class="style1" width="17%"><input name="b122" type="button" class="buttonfordate" onClick="javascript:pedirFecha(max_date,'');" value="&lt; Insert"></td>
	   </tr>
	   </table>
	   </td></tr>
   <tr>
   <td colspan="3" align="center"><table border="0" cellpadding="0" cellspacing="0" width="85%">
     <td width="30%" valign="middle" class="style1"></td>
     <td width="30%"  valign="middle" class="bidderclass">
	
	 </td>
     <td width="10%"  valign="middle" class="bidderclass">&nbsp;</td>
   
     <td width="30%" valign="middle" class="style1">Feedback:</td>
     <td width="50%" align="left" valign="middle" class="bidderclass">
		<input type="hidden" name="product" id="product" value="Req_Loan_Home">
		<select name="cmbfeedback" id="cmbfeedback" style="width:120px;">
		<option value="All" <? if($varCmbFeedback == "All") { echo "selected"; } ?>>All</option>
			<option value="No Feedback" <? if($varCmbFeedback == "") { echo "selected"; }?>>No Feedback</option>
		<option value="Other Product" <? if($varCmbFeedback == "Other Product") { echo "selected"; }?>>Other Product</option>
		<option value="Not Interested" <? if($varCmbFeedback == "Not Interested") { echo "selected"; }?>>Not Interested</option>
		<option value="Callback Later" <? if($varCmbFeedback == "Callback Later") { echo "selected"; }?>>Callback Later</option>
		<option value="Wrong Number" <? if($varCmbFeedback == "Wrong Number") { echo "selected"; }?>>Wrong Number</option>
		<option value="Not Contactable" <? if($varCmbFeedback == "Not Contactable") { echo "selected"; }?>>Not Contactable</option>
		<option value="Duplicate" <? if($varCmbFeedback == "Duplicate") { echo "selected"; }?>>Duplicate</option>
		<option value="Ringing" <? if($varCmbFeedback == "Ringing") { echo "selected"; }?>>Ringing</option>
		<option value="Not Eligible" <? if($varCmbFeedback == "Not Eligible") { echo "selected"; }?>>Not Eligible</option>
		<option value="Send Now" <? if($varCmbFeedback == "Send Now") { echo "selected"; }?>>Send Now</option>

	<option value="FollowUp" <? if($varCmbFeedback == "FollowUp") { echo "selected"; }?>>FollowUp</option>
	
		</select>	 </td>
     
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

		$result = ExecQuery("select FeedbackID from Req_Feedback where AllRequestID=$RequestID and BidderID=".$_SESSION['BidderID']);		
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

//		echo $strSQL;
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
		/*if($val=="Req_Loan_Home")
		{
			$getfeed="460,812,732,207";
		}
		else
		{
			$getfeed=$_SESSION['BidderID'];
		}
	
		$search_qry="SELECT * FROM `".$val."` LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID=".$val.".RequestID AND Req_Feedback.BidderID in (".$getfeed.")
		WHERE (`".$val."`.source='common floor' and `".$val."`.Updated_Date Between '".($min_date)."' and '".($max_date)."' ";	
		$search_qry=$search_qry.$FeedbackClause.")";
		$search_qry=$search_qry."group by ".$val.".Mobile_Number";
		$search_qry=$search_qry." order by ".$val.".Updated_Date DESC";

		//$qry="SELECT * FROM `".$val."` LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID=".$val.".RequestID AND Req_Feedback.BidderID in (".$getfeed.") WHERE (`".$val."`.Updated_Date Between '".($min_date)."' and '".($max_date)."') ";
		$qry="SELECT * FROM `".$val."` LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID=".$val.".RequestID AND Req_Feedback.BidderID in (".$getfeed.") WHERE `".$val."`.source='common floor' and  (`".$val."`.Updated_Date Between '".($min_date)."' and '".($max_date)."') ";
		$qry=$qry.$FeedbackClause;
		$qry=$qry."group by ".$val.".Mobile_Number";
	
	//echo"hello".$qry."<br>";
		$result=ExecQuery($qry);
		$recordcount = mysql_num_rows($result);*/
 ?>
		  <tr>
     <td colspan="11" style="border-bottom:1px solid #45B2D8;"><strong><? echo $startrow+1; ?> to <? echo min($startrow+$pagesize,$recordcount); ?> Out of <? echo $recordcount; ?> Records </strong>
     </tr>
	
   <tr>   
     <td width="149" align="center" bgcolor="#FFFFFF" class="style2">Name</td>
	 <td width="70" align="center" bgcolor="#FFFFFF" class="style2">City</td>
     <td width="91" align="center" bgcolor="#FFFFFF" class="style2">Net Salary </td>
	 <td width="71" align="center" bgcolor="#FFFFFF" class="style2">Feedback</td>
	 <td width="71" align="center" bgcolor="#FFFFFF" class="style2">Gone to Bidders</td>
	 <td width="71" align="center" bgcolor="#FFFFFF" class="style2">Total Revenue</td>
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
		
	
		/*$qry="SELECT * FROM `".$val."` LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID=".$val.".RequestID AND Req_Feedback.BidderID in (".$getfeed.") WHERE `".$val."`.source='common floor' and (`".$val."`.Updated_Date Between '".($min_date)."' and '".($max_date)."')";
		
		$qry=$qry.$FeedbackClause."";
		$qry=$qry."group by ".$val.".Mobile_Number";
		$qry=$qry." order by ".$val.".Updated_Date DESC";
		$qry=$qry." LIMIT $startrow, $pagesize"; 
		}
//echo $qry;
		$result=ExecQuery($qry);

		$i=1;
		$recordcount=1;
		if($recordcount>0)
		{
		while($row=mysql_fetch_array($result))
		{*/
	?>
	<tr>
	 <td align="center" bgcolor="#DFF6FF" class="style3" >customer1</td>
	  <td align="center" bgcolor="#DFF6FF" class="style3" >Delhi</td>
	   <td align="center" bgcolor="#DFF6FF" class="style3" >500000</td>
	    <td align="center" bgcolor="#DFF6FF" class="style3" >Sent</td>
		 <td align="center" bgcolor="#DFF6FF" class="style3" >2</td>
		 <td align="center" bgcolor="#DFF6FF" class="style3" >97.5</td>
   </tr>
   <tr>
	 <td align="center" bgcolor="#DFF6FF" class="style3" >customer2</td>
	  <td align="center" bgcolor="#DFF6FF" class="style3" >Kolkata</td>
	   <td align="center" bgcolor="#DFF6FF" class="style3" >600000</td>
	    <td align="center" bgcolor="#DFF6FF" class="style3" >Sent</td>
		 <td align="center" bgcolor="#DFF6FF" class="style3" >4</td>
		 <td align="center" bgcolor="#DFF6FF" class="style3" >195</td>
   </tr>
   <tr>
	 <td align="center" bgcolor="#DFF6FF" class="style3" >customer3</td>
	  <td align="center" bgcolor="#DFF6FF" class="style3" >Pune</td>
	   <td align="center" bgcolor="#DFF6FF" class="style3" >300000</td>
	    <td align="center" bgcolor="#DFF6FF" class="style3" >Sent</td>
		 <td align="center" bgcolor="#DFF6FF" class="style3" >1</td>
		 <td align="center" bgcolor="#DFF6FF" class="style3" >49</td>
   </tr>
   <tr>
	 <td align="center" bgcolor="#DFF6FF" class="style3" >customer4</td>
	  <td align="center" bgcolor="#DFF6FF" class="style3" >raipur</td>
	   <td align="center" bgcolor="#DFF6FF" class="style3" >200000</td>
	    <td align="center" bgcolor="#DFF6FF" class="style3" >Not Interested</td>
		 <td align="center" bgcolor="#DFF6FF" class="style3" >0</td>
		 <td align="center" bgcolor="#DFF6FF" class="style3" >0</td>
   </tr>
	<?
		/*
					$i=$i+1;
		}
		
		}*/
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
  
 </table>
 <br>
 
 

   <?
 }
 ?>
 </td></tr></table>
</td></tr></table>

<? }?>

</body>

</html>
