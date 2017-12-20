<?php
	require 'scripts/session_check_online.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

$todaydt=date('Y-m-d');

$BidderIDstatic="";
	if(isset($_REQUEST['BidderIDstatic']))
	{
		$BidderIDstatic=$_REQUEST['BidderIDstatic'];
	}

if($BidderIDstatic>0){ $finalbidderid=$BidderIDstatic;} else { $finalbidderid=$_SESSION["BidderID"]; }


$secure_chk="Select bidderid from bidders_session_details Where (sessionid='".$_SESSION["our_session"]."' and bidderid='".$finalbidderid."' and product='".$_SESSION['product']."' and login_date='".$todaydt."')";

$resultsecure_chk = ExecQuery($secure_chk);
$recordcount = mysql_num_rows($resultsecure_chk);
$securerow = mysql_fetch_array($resultsecure_chk);
if($securerow["bidderid"]>0)
{
	//echo "valid";
}
else
{
	session_destroy();
	$PostURL ="http://www.deal4loans.com/index.php";
	header("Location: $PostURL");
}

	$product=$_SESSION['ReplyType'];
	$date=$_SESSION['Date'];
$Define_PrePost = $_SESSION['DefinePrePost'];
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
		'7' => 'Req_Loan_Gold'

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
        'Req_Business_Loan' => '6',
		'Req_Loan_Gold' => '7'
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
function getCombo($strVal,$strselect)

	{
		$strSelectedCaption;
        //echo "eeeee".$strselect."<br>";
		$stroption = $strVal;
		if(strlen(trim($stroption))>0)
		{
			$pieces1 = explode(",", $stroption);
			for($l=0;$l<count($pieces1);$l++)
			{	
				echo " pieces1[$l] : ".$pieces1[$l]."<BR>";
				$strSelectedCaption="";
				switch ($pieces1[$l])
				 {				
					Case "1":
						if($strselect=="Req_Loan_Personal"){ $strSelectedCaption="selected"; }
						echo "<option value='Req_Loan_Personal'".$strSelectedCaption.">Personal Loan</option>";
					break;
					Case "2":
					if($strselect=="Req_Loan_Home"){ $strSelectedCaption="selected"; }
					 echo "<option value='Req_Loan_Home'".$strSelectedCaption.">Home Loan</option>";
					break;
					Case "3":
						if($strselect=="Req_Loan_Car"){ $strSelectedCaption="selected"; }
					 echo "<option value='Req_Loan_Car'".$strSelectedCaption.">Car Loan</option>";
					break;
					Case "4":
						if($strselect=="Req_Credit_Card"){ $strSelectedCaption="selected"; }
					 echo "<option value='Req_Credit_Card' ".$strSelectedCaption.">Credit Card</option>";
					break;
					Case "5":
						if($strselect=="Req_Loan_Against_Property"){ $strSelectedCaption="selected"; }
					 echo "<option value='Req_Loan_Against_Property' ".$strSelectedCaption.">Loan Againt Property</option>";
					break;
					Case "6":
						if($strselect=="Req_Business_Loan"){ $strSelectedCaption="selected"; }
					 echo "<option value='Req_Business_Loan' ".$strSelectedCaption.">Business Loan</option>";
					break;
					Case "7":
						if($strselect=="Req_Loan_Gold"){ $strSelectedCaption="selected"; }
					 echo "<option value='Req_Loan_Gold' ".$strSelectedCaption.">Gold Loan</option>";
					break;
				}
				
			}
		}

		
   }

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

.buttonfordate {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: #FFFFFF;
	background-color: #45B2D8;
	border: 1px solid #45B2D8;
	font-weight: bold;
}

</style>

<script language="javascript" type="text/javascript">
<!--
function popitup(url) {
	newwindow=window.open(url,'name','height=280,width=200');
	if (window.focus) {newwindow.focus()}
	return false;
}


// -->
</script>

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
	document.frmsearch.action="bidders_index_hdfc.php?search=y"+gifName;
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
			
		var get_comment_section = document.getElementById('comment_section_'+ id).value;
		var get_requestid= document.getElementById('requestid_'+ id).value;
		var get_product= document.getElementById('product_'+ id).value;
		var get_bidderid= document.getElementById('bidderid').value;
		
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
		<tr><td style="padding-top:5px; font-size:13px;">&nbsp;&nbsp; <a  href="/change_lms_pwd.php" target="_blank" style="color:#FFFFFF;"><b>Change Password</b></a> <?	 if($_SESSION['BidderID']==1536 || $_SESSION['BidderID']==1537 || $_SESSION['BidderID']==1538 || $_SESSION['BidderID']==1542 || $_SESSION['BidderID']==1139 || $_SESSION['BidderID']==1129 || $_SESSION['BidderID']==1130 || $_SESSION['BidderID']==1137 || $_SESSION['BidderID']==1140 || $_SESSION['BidderID']==1244 || $_SESSION['BidderID']==1249 || $_SESSION['BidderID']==1535 || $_SESSION['BidderID']==1975)
	{
?>
 | <a href="lead_barclays.php"  style="font-weight:bold; color:#FFFFFF;">Exclusive Leads</a>
<?php
	}	?>
 </td></tr>
      <tr>
	  <td style="padding-top:10px;"><table  width="669" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#45B2D8" >

		<? if (((!isset($val) && $viewtexttype==1) || ($val=="Req_Loan_Personal")) || ((!isset($val) && $viewtexttype==2) || ($val=="Req_Loan_Home")))
	{?>
				<tr>
				  <td width="669" height="150" align="left" valign="top" bgcolor="#FFFFFF" style="background-repeat:no-repeat;" ><table width="97%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="40" align="center"  ><h1 style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; color:#052733; line-height:18px; font-weight:bold;">Welcome to Deal4Loans LMS</h1></td>
  </tr>
  <tr>
    <td  style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#052733; line-height:17px;"><? if ((!isset($val) && $viewtexttype==1) || ($val=="Req_Loan_Personal")) {?>PERSONAL LOAN is a need based product. Your end-sales will depend upon how quickly you contact the customer (after he registers for Loan).<br/><b>Tips: <br>1.</b> Login as many times a day as possible and contact the customer early .<br/>
		<b>2.</b> Ensure that your contact numbers go to the customer in the auto-acknowledgement SMS that Deal4Loans sends. <br>
<? } elseif((!isset($val) && $viewtexttype==2) || ($val=="Req_Loan_Home")) {?>HOME LOAN is a Life time decison for most customers- hence the decision cycle is long. As a loan provider you need to engage with the customer through out their decision cycle..<br/><b>Tips: <br>1.</b> Leave your contact numbers via email/SMS (functionality provided in Deal4Loans LMS) after you have contacted the customer.<br/>
<b>2.</b> Tell the loan seeker how much tax savings will this home loan get him/her.
	<? } ?>
	</td>
  </tr>
</table>
</td>
</tr>
		  </table></td>
     
	</tr>
	<? } ?>
	<tr><td>&nbsp;</td></tr>
 <tr><td align="center">
 
 <table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
   <tr>
     <td height="30" align="center" valign="middle"><img src="images/login-srch-pnl.gif" width="650" height="30"></td>
   </tr>
   <tr>
     <td align="center" valign="middle" background="images/login-form-login-bg.gif"><table width="95%" border="0"  cellpadding="1" cellspacing="0">
 <form name="frmsearch" action="bidders_index_hdfc.php?search=y" method="post" onSubmit="return chkform();">
  <input type="hidden" name="BidderIDstatic" id="BidderIDstatic" value="<?  if($BidderIDstatic>0){ echo $BidderIDstatic;} else { echo $_SESSION["BidderID"]; }?>">
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
     <td width="30%" valign="middle" class="style1">Product</td>
     <td width="30%"  valign="middle" class="bidderclass">
	  <?  //echo "product".$_SESSION['ReplyType']; ?>
	 <select name="product" style="width:150px;">
	 <?  
	 getCombo($_SESSION['ReplyType'],$val)?>
	 </select>	</td>
     <td width="10%"  valign="middle" class="bidderclass">&nbsp;</td>
   
     <td width="30%" valign="middle" class="style1">Feedback:</td>
<?	 if($_SESSION['BidderID']==1536 || $_SESSION['BidderID']==1537 || $_SESSION['BidderID']==1538 || $_SESSION['BidderID']==1542 || $_SESSION['BidderID']==1139 || $_SESSION['BidderID']==1129 || $_SESSION['BidderID']==1130 || $_SESSION['BidderID']==1137 || $_SESSION['BidderID']==1140 || $_SESSION['BidderID']==1244 || $_SESSION['BidderID']==1249 || $_SESSION['BidderID']==1535 || $_SESSION['BidderID']==1975)
	{
		?>
     <td width="50%" align="left" valign="middle" class="bidderclass">
		<select name="cmbfeedback" id="cmbfeedback" style="width:120px;">
<option value="All" <? if($varCmbFeedback == "All") { echo "selected"; } ?>>All</option>
<option value="" <? if($varCmbFeedback == "") { echo "selected"; } ?>>No Feedback</option>
<option value="Appointment" <? if($varCmbFeedback == "Appointment") { echo "selected"; } ?>>Appointment</option>
<option value="FollowUp" <? if($varCmbFeedback == "FollowUp") { echo "selected"; } ?>>FollowUp</option>
<option value="Documents Pick" <? if($varCmbFeedback == "Documents Pick") { echo "selected"; } ?>>Documents Pick</option>
<option value="Pre-Login Reject" <? if($varCmbFeedback == "Pre-Login Reject") { echo "selected"; } ?>>Pre-Login Reject</option>
<option value="Login" <? if($varCmbFeedback == "Login") { echo "selected"; } ?>>Login</option>
<option value="NI on Rate" <? if($varCmbFeedback == "NI on Rate") { echo "selected"; } ?>>NI on Rate</option>

	</select>	 </td>
<? } 
		else
		{?>

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
     
     <? } ?>
	   </tr>
</table></td></tr>
<? if($_SESSION['BidderID']==2009) 
{?>
<tr>
   <td colspan="3" align="center" class="style1">
City Wise 
	 <select name="citywise" id="citywise" style="width:150px;">
	 <option value="1" <? if($citywise=="1") { echo "selected";}?>>ALL</option>
	 <option value="Ahmedabad" <? if($citywise=="Ahmedabad") { echo "selected";}?>>Ahmedabad</option>
 <option value="Gandhinagar" <? if($citywise=="Gandhinagar") { echo "selected";}?>>Gandhinagar</option>
 <option value="Bangalore" <? if($citywise=="Bangalore") { echo "selected";}?>>Bangalore</option>
 <option value="Baroda" <? if($citywise=="Baroda") { echo "selected";}?>>Baroda</option>
 <option value="Chandigarh" <? if($citywise=="Chandigarh") { echo "selected";}?>>Chandigarh</option>
  <option value="2" <? if($citywise=="2") { echo "selected";} ?>>Chandigarh ALL</option>
  <option value="Sohana" <? if($citywise=="Sohana") { echo "selected";}?>>Sohana</option>
 <option value="mohali" <? if($citywise=="mohali") { echo "selected";}?>>mohali</option>
 <option value="Panchkula" <? if($citywise=="Panchkula") { echo "selected";}?>>Panchkula</option>
 <option value="Chennai" <? if($citywise=="Chennai") { echo "selected";}?>>Chennai</option>

 <option value="Cochin" <? if($citywise=="Cochin") { echo "selected";} ?> >Cochin</option> <option value="kochi" <? if($citywise=="kochi") { echo "selected";} ?> >kochi</option> <option value="Coimbatore" <? if($citywise=="Coimbatore") { echo "selected";} ?> >Coimbatore</option> <option value="Delhi" <? if($citywise=="Delhi") { echo "selected";} ?> >Delhi</option> <option value="Gurgaon" <? if($citywise=="Gurgaon") { echo "selected";} ?> >Gurgaon</option> <option value="Noida" <? if($citywise=="Noida") { echo "selected";} ?> >Noida</option> <option value="Goa" <? if($citywise=="Goa") { echo "selected";} ?> >Goa</option> <option value="Mapusa" <? if($citywise=="Mapusa") { echo "selected";} ?> >Mapusa</option> <option value="Panjim" <? if($citywise=="Panjim") { echo "selected";} ?> >Panjim</option> <option value="Margoa" <? if($citywise=="Margoa") { echo "selected";} ?> >Margoa</option> <option value="Hyderabad" <? if($citywise=="Hyderabad") { echo "selected";} ?> >Hyderabad</option> <option value="Indore" <? if($citywise=="Indore") { echo "selected";} ?> >Indore</option> <option value="Jaipur" <? if($citywise=="Jaipur") { echo "selected";} ?> >Jaipur</option> <option value="Kolkata" <? if($citywise=="Kolkata") { echo "selected";} ?> >Kolkata</option> <option value="Jharsuguda" <? if($citywise=="Jharsuguda") { echo "selected";} ?> >Jharsuguda</option> <option value="Lucknow" <? if($citywise=="Lucknow") { echo "selected";} ?> >Lucknow</option> <option value="3" <? if($citywise=="3") { echo "selected";} ?> >Lucknow ALL</option><option value="Ludhiana" <? if($citywise=="Ludhiana") { echo "selected";} ?> >Ludhiana</option> <option value="Mumbai" <? if($citywise=="Mumbai") { echo "selected";} ?> >Mumbai</option> <option value="Nagpur" <? if($citywise=="Nagpur") { echo "selected";} ?> >Nagpur</option> <option value="Nasik" <? if($citywise=="Nasik") { echo "selected";} ?> >Nasik</option> <option value="Pune" <? if($citywise=="Pune") { echo "selected";} ?> >Pune</option> <option value="Surat" <? if($citywise=="Surat") { echo "selected";} ?> >Surat</option> <option value="Bardoli" <? if($citywise=="Bardoli") { echo "selected";} ?> >Bardoli</option> <option value="Agra" <? if($citywise=="Agra") { echo "selected";} ?> >Agra</option> <option value="Ahmednagar" <? if($citywise=="Ahmednagar") { echo "selected";} ?> >Ahmednagar</option> <option value="Allahabad" <? if($citywise=="Allahabad") { echo "selected";} ?> >Allahabad</option> <option value="Ambala" <? if($citywise=="Ambala") { echo "selected";} ?> >Ambala</option> <option value="Amritsar" <? if($citywise=="Amritsar") { echo "selected";} ?> >Amritsar</option> <option value="Aurangabad" <? if($citywise=="Aurangabad") { echo "selected";} ?> >Aurangabad</option> <option value="Belgaum" <? if($citywise=="Belgaum") { echo "selected";} ?> >Belgaum</option> <option value="Bhopal" <? if($citywise=="Bhopal") { echo "selected";} ?> >Bhopal</option> <option value="Bhubneshwar" <? if($citywise=="Bhubneshwar") { echo "selected";} ?> >Bhubneshwar</option> <option value="Calicut" <? if($citywise=="Calicut") { echo "selected";} ?> >Calicut</option> <option value="Manjeri" <? if($citywise=="Manjeri") { echo "selected";} ?> >Manjeri</option> <option value="Daman" <? if($citywise=="Daman") { echo "selected";} ?> >Daman</option> <option value="Vapi" <? if($citywise=="Vapi") { echo "selected";} ?> >Vapi</option> <option value="Dehradun" <? if($citywise=="Dehradun") { echo "selected";} ?> >Dehradun</option> <option value="Guwahati" <? if($citywise=="Guwahati") { echo "selected";} ?> >Guwahati</option> <option value="Jalandhar" <? if($citywise=="Jalandhar") { echo "selected";} ?> >Jalandhar</option> <option value="Jammu" <? if($citywise=="Jammu") { echo "selected";} ?> >Jammu</option> <option value="Jamnagar" <? if($citywise=="Jamnagar") { echo "selected";} ?> >Jamnagar</option> <option value="Jamshedpur" <? if($citywise=="Jamshedpur") { echo "selected";} ?> >Jamshedpur</option> <option value="Jodhpur" <? if($citywise=="Jodhpur") { echo "selected";} ?> >Jodhpur</option> <option value="Kanpur" <? if($citywise=="Kanpur") { echo "selected";} ?> >Kanpur</option> <option value="Kolhapur" <? if($citywise=="Kolhapur") { echo "selected";} ?> >Kolhapur</option> <option value="Kottayam" <? if($citywise=="Kottayam") { echo "selected";} ?> >Kottayam</option> <option value="Thiruvalla" <? if($citywise=="Thiruvalla") { echo "selected";} ?> >Thiruvalla</option> <option value="Cheng" <? if($citywise=="Cheng") { echo "selected";} ?> >Cheng</option> <option value="Madurai" <? if($citywise=="Madurai") { echo "selected";} ?> >Madurai</option> <option value="Mysore" <? if($citywise=="Mysore") { echo "selected";} ?> >Mysore</option> <option value="Patiala" <? if($citywise=="Patiala") { echo "selected";} ?> >Patiala</option> <option value="Patna" <? if($citywise=="Patna") { echo "selected";} ?> >Patna</option> <option value="Raipur" <? if($citywise=="Raipur") { echo "selected";} ?> >Raipur</option> <option value="Rajahmundry" <? if($citywise=="Rajahmundry") { echo "selected";} ?> >Rajahmundry</option> <option value="Rajkot" <? if($citywise=="Rajkot") { echo "selected";} ?> >Rajkot</option> <option value="Ranchi" <? if($citywise=="Ranchi") { echo "selected";} ?> >Ranchi</option> <option value="Rourkela" <? if($citywise=="Rourkela") { echo "selected";} ?> >Rourkela</option> <option value="Salem" <? if($citywise=="Salem") { echo "selected";} ?> >Salem</option> <option value="Shimla" <? if($citywise=="Shimla") { echo "selected";} ?> >Shimla</option> <option value="Siliguri" <? if($citywise=="Siliguri") { echo "selected";} ?> >Siliguri</option> <option value="Trichur" <? if($citywise=="Trichur") { echo "selected";} ?> >Trichur</option> <option value="Chalakudy" <? if($citywise=="Chalakudy") { echo "selected";} ?> >Chalakudy</option> <option value="Thalassery" <? if($citywise=="Thalassery") { echo "selected";} ?> >Thalassery</option> <option value="Trichy" <? if($citywise=="Trichy") { echo "selected";} ?> >Trichy</option> <option value="Trivandrum" <? if($citywise=="Trivandrum") { echo "selected";} ?> >Trivandrum</option> <option value="Udaipur" <? if($citywise=="Udaipur") { echo "selected";} ?> >Udaipur</option> <option value="Vijaywada" <? if($citywise=="Vijaywada") { echo "selected";} ?> >Vijaywada</option> <option value="Vizag" <? if($citywise=="Vizag") { echo "selected";} ?> >Vizag</option> <option value="Thane" <? if($citywise=="Thane") { echo "selected";} ?> >Thane</option> <option value="Navi Mumbai" <? if($citywise=="Navi Mumbai") { echo "selected";} ?> >Navi Mumbai</option> <option value="Gaziabad" <? if($citywise=="Gaziabad") { echo "selected";} ?> >Gaziabad</option> <option value="Faridabad" <? if($citywise=="Faridabad") { echo "selected";} ?> >Faridabad</option> <option value="Vishakapatanam" <? if($citywise=="Vishakapatanam") { echo "selected";} ?> >Vishakapatanam</option>

	 </select>
   </td></tr>
     <? }?>
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
			$strSQL="Update Req_Feedback Set Feedback='".$Feedback."'";
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
			
	if($citywise==2)
		{
			$citywisenw="Ludhiana','Amritsar','Jalandhar','Patiala','Bathinda','Mohali','Chandigarh','Ziragpur','Hoshiarpur','Pathankot','Moga','Batala','Abohar','Khanna','Phagwara','Firozpur','Kapurthala','Shimla','Baddi";
		}
		else if($citywise==3)
		{
			$citywisenw="Kanpur','Lucknow','Agra','Varanasi','Banaras','Meerut','Bareilly','Aligarh','Moradabad','Saharanpur','Gorakhpur','Firozabad','Jhansi','Mathura','Rampur','Farrukhabad','Hapur','Faizabad','Etawah','Bulandshahr','Hardoi','Raebareli','Modinagar','Jaunpur','Ambala','Bhiwani','Hisar','Jhajjar','Kaithal','Kurukshetra','Panipat','Rewari','Rohtak','Sirsa','Sonipat','Yamuna Nagar";
		}
		else
		{
			$citywisenw=$citywise;
		}
		
		$getfields="Existing_Relationship,Loan_Amount,Loan_No,Account_No,RequestID,Name,Mobile_Number,Allocation_Date,Net_Salary,Company_Name,Loan_Amount,Employment_Status,Feedback,comment_section,eligible,interest_stat,post_login_stat,Bidder_Count";
			$getfieldsdwnld="Employment_Status,Allocation_Date,Existing_Relationship,DOB,Name,Email,Company_Name,City,City_Other,Mobile_Number,Net_Salary,Descr,Feedback,Pancard,No_of_Banks,Pancard_No,comment_section,Account_No,CC_Holder,Bidder_Count,RequestID";

			if($citywise!=1)
			{
				$search_qry="SELECT ".$getfieldsdwnld." FROM Req_Feedback_Bidder_CC,`".$val."` LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID=".$val.".RequestID AND Req_Feedback.BidderID= '".$_SESSION['BidderID']."' WHERE Req_Feedback_Bidder_CC.AllRequestID=`".$val."`.RequestID and Req_Feedback_Bidder_CC.BidderID = '".$_SESSION['BidderID']."' and Req_Feedback_Bidder_CC.Reply_Type=".$pro_code."  and (Req_Credit_Card.City in ('".$citywisenw."') or Req_Credit_Card.City_Other in ('".$citywisenw."')) and (Req_Feedback_Bidder_CC.Allocation_Date  Between '".($min_date)."' and '".($max_date)."' or Req_Feedback.Followup_Date Between '".($min_date)."' and '".($max_date)."') ";	
				$search_qry=$search_qry.$FeedbackClause;
				$search_qry=$search_qry."group by ".$val.".Mobile_Number";
				$search_qry=$search_qry." order by ".$val.".Dated DESC";

				$qry="SELECT RequestID FROM Req_Feedback_Bidder_CC,`".$val."` LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID=".$val.".RequestID AND Req_Feedback.BidderID= '".$_SESSION['BidderID']."' WHERE Req_Feedback_Bidder_CC.AllRequestID=`".$val."`.RequestID and Req_Feedback_Bidder_CC.BidderID = '".$_SESSION['BidderID']."' and Req_Feedback_Bidder_CC.Reply_Type=".$pro_code."  and (Req_Credit_Card.City in ('".$citywisenw."') or Req_Credit_Card.City_Other in ('".$citywisenw."')) and (Req_Feedback_Bidder_CC.Allocation_Date Between '".($min_date)."' and '".($max_date)."' or Req_Feedback.Followup_Date Between '".($min_date)."' and '".($max_date)."') ";
				$qry=$qry.$FeedbackClause;
				$qry=$qry."group by ".$val.".Mobile_Number";
			}
			else
			{
				$search_qry="SELECT ".$getfieldsdwnld." FROM Req_Feedback_Bidder_CC,`".$val."` LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID=".$val.".RequestID AND Req_Feedback.BidderID= '".$_SESSION['BidderID']."' WHERE Req_Feedback_Bidder_CC.AllRequestID=`".$val."`.RequestID and Req_Feedback_Bidder_CC.BidderID = '".$_SESSION['BidderID']."' and Req_Feedback_Bidder_CC.Reply_Type=".$pro_code." and (Req_Feedback_Bidder_CC.Allocation_Date  Between '".($min_date)."' and '".($max_date)."' or Req_Feedback.Followup_Date Between '".($min_date)."' and '".($max_date)."') ";	
				$search_qry=$search_qry.$FeedbackClause;
				$search_qry=$search_qry."group by ".$val.".Mobile_Number";
				$search_qry=$search_qry." order by ".$val.".Dated DESC";

				$qry="SELECT RequestID FROM Req_Feedback_Bidder_CC,`".$val."` LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID=".$val.".RequestID AND Req_Feedback.BidderID= '".$_SESSION['BidderID']."' WHERE Req_Feedback_Bidder_CC.AllRequestID=`".$val."`.RequestID and Req_Feedback_Bidder_CC.BidderID = '".$_SESSION['BidderID']."' and Req_Feedback_Bidder_CC.Reply_Type=".$pro_code." and (Req_Feedback_Bidder_CC.Allocation_Date Between '".($min_date)."' and '".($max_date)."' or Req_Feedback.Followup_Date Between '".($min_date)."' and '".($max_date)."') ";
				$qry=$qry.$FeedbackClause;
				$qry=$qry."group by ".$val.".Mobile_Number";			
			}
			
	//echo"hello".$qry."<br>";
		$result=ExecQuery($qry);
		$recordcount = mysql_num_rows($result);
 ?>
<tr>
     <td colspan="11" style="border-bottom:1px solid #45B2D8;"><strong><? echo $startrow+1; ?> to <? echo min($startrow+$pagesize,$recordcount); ?> Out of <? echo $recordcount; ?> Records </strong>
     </tr>
	  <tr>
   
     <td width="149" align="center" bgcolor="#FFFFFF" class="style2">Name</td>
	 <td width="88" align="center" bgcolor="#FFFFFF" class="style2">City</td>
     <td width="88" align="center" bgcolor="#FFFFFF" class="style2">Mobile</td>
	<td width="91" align="center" bgcolor="#FFFFFF" class="style2">Net Salary </td>
	<td width="100" align="center" bgcolor="#FFFFFF" class="style2">Company Name </td>
	 <td width="130" align="center" bgcolor="#FFFFFF" class="style2">Employment Status </td>
     <td width="71" align="center" bgcolor="#FFFFFF" class="style2">Feedback</td>
	 <td width="180" align="center" bgcolor="#FFFFFF" class="style2">Add Comment</td>
	
	<?	if ($Define_PrePost=="PostPaid" && ((strncmp ("HDFC", $_SESSION['Associated_Bank'],4))==0) && ($pro_code==4 ))
		{ ?>
<td width="180" align="center" bgcolor="#FFFFFF" class="style2">Existing Relation</td>
<td width="150" align="center" bgcolor="#FFFFFF" class="style2">Download</td>
		<? } ?>

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
		
		
			if($citywise!=1)
			{
		
				$qry="SELECT ".$getfields.",Req_Credit_Card.City FROM Req_Feedback_Bidder_CC,`".$val."` LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID=`".$val."`.RequestID AND Req_Feedback.BidderID= '".$_SESSION['BidderID']."' WHERE Req_Feedback_Bidder_CC.AllRequestID=`".$val."`.RequestID and Req_Feedback_Bidder_CC.BidderID = '".$_SESSION['BidderID']."' and Req_Feedback_Bidder_CC.Reply_Type=".$pro_code." and (Req_Credit_Card.City in ('".$citywisenw."') or Req_Credit_Card.City_Other in ('".$citywisenw."')) and ( Req_Feedback_Bidder_CC.Allocation_Date Between '".($min_date)."' and '".($max_date)."' or Req_Feedback.Followup_Date Between '".($min_date)."' and '".($max_date)."') ";
			}
			else
			{
				$qry="SELECT ".$getfields.", Req_Credit_Card.City FROM Req_Feedback_Bidder_CC,`".$val."` LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID=`".$val."`.RequestID AND Req_Feedback.BidderID= '".$_SESSION['BidderID']."' WHERE Req_Feedback_Bidder_CC.AllRequestID=`".$val."`.RequestID and Req_Feedback_Bidder_CC.BidderID = '".$_SESSION['BidderID']."' and Req_Feedback_Bidder_CC.Reply_Type=".$pro_code." and ( Req_Feedback_Bidder_CC.Allocation_Date Between '".($min_date)."' and '".($max_date)."' or Req_Feedback.Followup_Date Between '".($min_date)."' and '".($max_date)."') ";
			
			}
			
		
		
		$qry=$qry.$FeedbackClause;
		$qry=$qry."group by ".$val.".Mobile_Number";
		$qry=$qry." order by ".$val.".Dated DESC";
		$qry=$qry." LIMIT $startrow, $pagesize"; 
		
//echo $qry;
		$result=ExecQuery($qry);

		$i=1;
		if($recordcount>0)
		{
		while($row=mysql_fetch_array($result))
		{																												
	?>
	<input type="hidden" name="requestid_<? echo $i;?>" id="requestid_<? echo $i;?>" value="<? echo $row["RequestID"];?>">
		<input type="hidden" name="product_<? echo $i;?>" id="product_<? echo $i;?>" value="<? echo $pro_code;?>">
			<input type="hidden" name="bidderid" id="bidderid" value="<? echo $_SESSION['BidderID'];?>">
   <tr>
  
     <td align="center" bgcolor="#DFF6FF" class="style3" >
	<?php
	 $sqlExclusive = "select  BidderID  from Req_Feedback_Bidder_CC where (AllRequestID = '".$row["RequestID"]."' and Reply_Type='".$pro_code."')";
	 $queryExclusive = ExecQuery($sqlExclusive);
	 $numRowsExclusive = mysql_num_rows($queryExclusive);
	 if($numRowsExclusive==1)
	 {
 	echo '<b style="font:Verdana, Arial, Helvetica, sans-serif; color:#FF0000; font-size:9px;"> [Exclusive Lead] </b><br>';

	 }
	 ?>
	 <? echo $row["Name"]; ?></td>
     <td align="center" bgcolor="#DFF6FF" class="style3"><? echo $row["City"]; ?></td>
	  <td align="center" bgcolor="#DFF6FF" class="style3"><? echo $row["Mobile_Number"]; ?></td>
	   <td align="center" bgcolor="#DFF6FF" class="style3"><? echo $row["Net_Salary"]; ?></td>
	<td align="center" bgcolor="#DFF6FF" class="style3"><? echo $row["Company_Name"]; ?></td>
    <td align="center" bgcolor="#DFF6FF" class="style3"><? if($row["Employment_Status"]==0) { echo "Self Employed"; } else { echo "Salaried"; }?></td> 
   	    <td align="center" bgcolor="#DFF6FF" class="style3"><? echo getJumpMenu("bidders_index_hdfc.php",$row["RequestID"],"1",$row["Feedback"],$pageno,$varmin_date,$varmax_date,$varCmbFeedback, $val) ?>
		</td>
	<td align="center" bgcolor="#DFF6FF" class="bodyarial11" ><table width="100%"><tr><td><textarea  name="comment_section_<? echo $i;?>" id="comment_section_<? echo $i;?>" cols="15" rows="2"><? echo $row["comment_section"]; ?></textarea></td><td><a onClick="insertData(<? echo $i;?>);" style="cursor:pointer; color:blue;" class="style3">Save</a></td></tr></table></td>
	
<?	

		$keyFBidders = '';
		$bidderSql = "select Bidders_List.BidderID as BidderID from Bidders_List left join Bidders on Bidders.BidderID= Bidders_List.BidderID and Bidders_List.Reply_Type=1 and Bidders_List.Restrict_Bidder=1 and Bidders_List.BankID=17 where (Bidders_List.Reply_Type=1 and Bidders_List.Restrict_Bidder=1 and Bidders_List.BankID=17 and Bidders.Define_PrePost='PostPaid' )";
	
	
	$bidderQuery = ExecQuery($bidderSql);
	$numbidder = mysql_num_rows($bidderQuery);
	$arrBidderID = '';
	for($i=0;$i<$numbidder;$i++)
	{
		$BidID  = mysql_result($bidderQuery,$i,'BidderID');
		$arrBidderID[] = $BidID;
	}

	//print_r($arrBidderID);
	$keyFBidders = array_search($_SESSION['BidderID'], $arrBidderID);	
		
		if(strlen($keyFBidders)>1)
	{
	//echo "hello";
	?>
  
     <?php }
	
		if($Define_PrePost=="PostPaid" && ((strncmp ("HDFC", $_SESSION['Associated_Bank'],4))==0 ) && ($pro_code==4))
			{ $numcheckDocscc="";
				if($row["Loan_Amount"]==1)
			{
				
		$checkDocsSqlcc = "select Bank_Statement from upload_documents where (RequestID='".$row["RequestID"]."' and Reply_Type=4)";
		$checkDocsQuerycc = ExecQuery($checkDocsSqlcc);
		$numcheckDocscc = mysql_num_rows($checkDocsQuerycc);
		} 
		?>
<td align="center" bgcolor="#DFF6FF" class="style3" ><? if($row["Existing_Relationship"]==1 && strlen($row["Account_No"])>0)
				{
				 echo "Acc no : ".$row["Account_No"]." ";
								 
				}
				if($row["Existing_Relationship"]==2 && strlen($row["Loan_No"])>0)
				{
				 echo "Loan no : ".$row["Loan_No"]." "; 
			
				}
			
			?></td>

			<td align="center" bgcolor="#DFF6FF" class="style3">&nbsp; <?	 if($numcheckDocscc>0)
		{
		?>
    <a href="download-documents.php?Lid=<?php echo $row["RequestID"]; ?>&Prid=<? echo $pro_code; ?>" onClick="return popitup('download-documents.php?Lid=<?php echo $row["RequestID"]; ?>&Prid=<? echo $pro_code; ?>')">Documents</a>
		<?php
		}
		
	?>
   
		</td>
		<? } ?>
         
  <td align="center" bgcolor="#DFF6FF" class="style3" >&nbsp;
    </td>
    <td align="center" bgcolor="#DFF6FF" class="style3" >&nbsp;
    </td>
        	
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
 <form name="frmdownload" action="bidder_download.php" method="post">
   <tr>
     <td align="center">
	   <input type="hidden" name="qry1" value="<? echo $search_qry; ?>">
	   <input type="hidden" name="qry2" value="<? echo $val; ?>">
	 
	    <input type="hidden" name="min_date" value="<? echo $min_date; ?>">
	   <input type="hidden" name="max_date" value="<? echo $max_date; ?>">
	 <input name="Submit2" type="submit" class="bluebtn" value="Export List To Excel">
	 </td>
   </tr>
 </form>
 </table>

   <?
 }
 ?>
 </td></tr></table>
</td></tr></table>

<?
function getJumpMenu($varPHPPage, $varRequestID, $varType, $varFeedback, $varpageon, $varmindate, $varmaxdate,$cmbfeedback,$varVal)
{
	$strURL="";

		$strURL=$varPHPPage."?search=y&RequestID=".$varRequestID."&type=".$varType."&pageno=".$varpageon."&min_date=".urlencode($varmindate)."&max_date=".urlencode($varmaxdate)."&cmbfeedback=".urlencode($cmbfeedback)."&product=".$varVal;
?>
	<select name="type" id="type" onChange="MM_jumpMenu('parent',this,0)" class="style3" style="width:110px;">
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
