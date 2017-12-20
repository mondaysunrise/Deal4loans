<?php
	//require 'scripts/session_check_online.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';


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


	$RequestID="";
	if(isset($_REQUEST['RequestID']))
	{
		$RequestID=$_REQUEST['RequestID'];
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

function DetermineAgeFromDOB ($YYYYMMDD_In)
{
  $yIn=substr($YYYYMMDD_In, 0, 4);
  $mIn=substr($YYYYMMDD_In, 4, 2);
  $dIn=substr($YYYYMMDD_In, 6, 2);

  $ddiff = date("d") - $dIn;
  $mdiff = date("m") - $mIn;
  $ydiff = date("Y") - $yIn;

  // Check If Birthday Month Has Been Reached
  if ($mdiff < 0)
  {
    // Birthday Month Not Reached
    // Subtract 1 Year From Age
    $ydiff--;
  } elseif ($mdiff==0)
  {
    // Birthday Month Currently
    // Check If BirthdayDay Passed
    if ($ddiff < 0)
    {
      //Birthday Not Reached
      // Subtract 1 Year From Age
      $ydiff--;
    }
  }
  return $ydiff;
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
	document.frmsearch.action="hdfccardsview.php?search=y"+gifName;
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
		

		function savePancard(i)
		{

			var RequestID = document.getElementById('RequestID_'+i).value;
						//alert(RequestID);
			var validate_pan = document.getElementById('validate_pan_'+i).value;

			if((RequestID!=""))
			{
				var queryString = "?RequestID=" + RequestID + "&validate_pan="+ validate_pan ;
			//	alert(queryString);
				ajaxRequest.open("GET", "hdfcsavepancard.php" + queryString, true);
				// Create a function that will receive data sent from the server
				ajaxRequest.onreadystatechange = function(){
					if(ajaxRequest.readyState == 4)
					{
						
						var ajaxDisplay = document.getElementById('feeds_'+i);
						ajaxDisplay.innerHTML = ajaxRequest.responseText;
					}
				}
				ajaxRequest.send(null); 
			 }
		}
		
		function sendHDFCMail(i)
		{
			var RequestID = document.getElementById('RequestID_'+i).value;
						//alert(RequestID);
			var Name = document.getElementById('Name_'+i).value;						
		
			var email = document.getElementById('email_'+i).value;						
		
			if((RequestID!=""))
			{
				var queryString = "?RequestID=" + RequestID + "&Name="+ Name + "&email="+ email ;
			//	alert(queryString);
				ajaxRequest.open("GET", "hdfcemail.php" + queryString, true);
				// Create a function that will receive data sent from the server
				ajaxRequest.onreadystatechange = function(){
					if(ajaxRequest.readyState == 4)
					{
						
						var ajaxDisplay = document.getElementById('mails_'+i);
						ajaxDisplay.innerHTML = ajaxRequest.responseText;
					}
				}
				ajaxRequest.send(null); 
			 }
		
		}
		
	window.onload = ajaxFunction;
</script>
</head><body>
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
     <td align="center" valign="middle" background="images/login-form-login-bg.gif"><table width="95%" border="0"  cellpadding="1" cellspacing="0">
 <form name="frmsearch" action="hdfccardsview.php?search=y" method="post" onSubmit="return chkform();">
   
  <tr><td colspan="3">&nbsp;</td></tr>
  
   <tr>
   <td colspan="3" align="center">
   <table border="0" width="90%" cellpadding="0" cellspacing="0"><tr>
     <td width="20%" valign="middle" class="style1">&nbsp;&nbsp;Date&nbsp;&nbsp; From </td>
     <td width="24%" align="left" valign="middle" class="bidderclass" ><? $current_date=date('Y-m')."-01";?> 
	   <input name="min_date" type="text" id="min_date" size="15" <? if($min_date=="") { ?>value="<?php echo $current_date; ?>" <? } else { ?>value="<? echo $min_date; ?>" <? }?>></td>
	   <td>
       <input name="b12" type="button" class="bluebutton" onClick="javascript:pedirFecha(min_date,'');" value="&lt; Insert">  </td>
  
     <td valign="middle" align="center" class="style1" width="8%">To</td>
     <td align="left" valign="middle" class="style1" width="24%" >  <input name="max_date" type="text" id="max_date" size="15" value="<? echo $max_date; ?>"></td>
        <td> <input name="b122" type="button" class="bluebutton" onClick="javascript:pedirFecha(max_date,'');" value="&lt; Insert"></td>
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
		
	?>
 <p class="bodyarial11"><?=$Msg?></p>
 <table width="950" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#FFFFFF" >
 <? 
		$search_qry="SELECT * FROM req_hdfc_lead WHERE Dated  Between '".($min_date)."' and '".($max_date)."' ";	
		//$search_qry=$search_qry.$FeedbackClause;
		$search_qry=$search_qry."group by Phone ";
		$search_qry=$search_qry." order by Dated DESC";

		$qry="SELECT * FROM req_hdfc_lead WHERE Dated  Between '".($min_date)."' and '".($max_date)."' group by Phone ";	
		//$search_qry=$search_qry.$FeedbackClause;
		//$search_qry=$search_qry."group by Phone ";
		
	
//	echo"hello".$qry."<br>";
		$result=ExecQuery($qry);
		$recordcount = mysql_num_rows($result);
 ?>
   <tr>
     <td colspan="7" style="border-bottom:1px solid #45B2D8;"><strong><? echo $startrow+1; ?> to <? echo min($startrow+$pagesize,$recordcount); ?> Out of <? echo $recordcount; ?> Records </strong></td>
     </tr>
   <tr>   
     <td width="149" align="center" bgcolor="#FFFFFF" class="style2">Name</td>
	  <td width="70" align="center" bgcolor="#FFFFFF" class="style2">City</td>
     <td width="88" align="center" bgcolor="#FFFFFF" class="style2">Mobile</td>
     <td width="91" align="center" bgcolor="#FFFFFF" class="style2">Salary </td>
	   <td width="75" align="center" bgcolor="#FFFFFF" class="style2">DOB</td>
     <td width="90" align="center" bgcolor="#FFFFFF" class="style2">Pancard </td>  
    <td width="90" align="center" bgcolor="#FFFFFF" class="style2">Check Pancard</td>  	 
    <td width="90" align="center" bgcolor="#FFFFFF" class="style2">Send Mail</td>  	 
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
		
		
		$qry="SELECT * from req_hdfc_lead WHERE Dated  Between '".($min_date)."' and '".($max_date)."' ";
		//$qry=$qry.$FeedbackClause;
		$qry=$qry."group by Phone";
		$qry=$qry." order by Dated DESC";
		$qry=$qry." LIMIT $startrow, $pagesize"; 
		
		
	//	echo $qry;
		$result=ExecQuery($qry);

		$i=1;
		if($recordcount>0)
		{
		while($row=mysql_fetch_array($result))
		{
	?>
   <tr>
     <td align="center" bgcolor="#DFF6FF" class="style3" ><? echo $row["Name"]; ?></td>
	 <td align="center" bgcolor="#DFF6FF" class="style3"><? echo $row["City"]; ?></td>
     <td align="center" bgcolor="#DFF6FF" class="style3"><? echo $row["Phone"]; ?></td>
     <td align="center" bgcolor="#DFF6FF" class="style3"><? echo $row["Monthly_Salary"]; ?></td>
     <td align="center" bgcolor="#DFF6FF" class="style3"><? echo $row["DOB"]; ?></td>
	 <td align="center" bgcolor="#DFF6FF" class="style3"><? echo $row["pancard"]; ?></td>  
	 <td align="center" bgcolor="#DFF6FF" class="style3">
	<?php
	$finalWords = "";
	$Applied_status= '';
	 $Age = DetermineAgeFromDOB($row["DOB"]);
	 $Applied_status= $row["Last_Applied"];
	if($Age>20 && $Applied_status=="No")
	{
		$company_name = "";
		$Employment_Status = "";
		$hdfc_account = "";
		$City = "";
		$Net_Salary  = "";
	
		$company_name = $row["company_name"];
		$Employment_Status = $row["Employement_Type"];
		$hdfc_account = $row["HDFC_Account"];
		$City = $row["City"];
		if($City=="Others")
		{
			$CityC = $row["City_Other"];
		}
		else
		{
			$CityC = $City;
		}
		
		$Net_Salary = $row["Monthly_Salary"];
		
		$maxCC = $row["cc_bank_limit"];
		$maxCC_Limit = explode(',',$maxCC);
		
		$maxCCLimit = max($maxCC_Limit);


		$checkCCLimitSql = "SELECT * FROM hdfc_card_for_card where city = '".$CityC."'";
		$checkCCLimitQuery = ExecQuery($checkCCLimitSql);
		$card_limit = mysql_result($checkCCLimitQuery,0,'card_limit');

	
		$getCompanySql ="select * from hdfc_company_list_gold where COMPANY_NAME = '".$company_name."'";
		
		$getCompanyQuery = ExecQuery($getCompanySql);
	//	echo $getCompanySql;
	//	echo "<br>";
		$getCompanyNum = mysql_num_rows($getCompanyQuery);
		//echo "Num  ".$getCompanyNum;
		
		if($getCompanyNum>0)
		{
			//echo "if";
			if($Employment_Status=="Salaried" && ($hdfc_account=="Salary Account"  || $hdfc_account=="No") )
			{
			//inhouse
				$cutoff = "inhouse";
				if($hdfc_account=="No")
				{
					$checkCategory = "Cat_V";
				}
			}
			else if($Employment_Status=="Salaried" &&  ($hdfc_account=="Non-Salary Account" || $hdfc_account=="No") )
			{
				//opm
				$cutoff = "opm";	
				if($hdfc_account=="No")
				{
					$checkCategory = "Cat_Z";
				}
			}
			
			
			//City, Net_Salary , hdfc_account , Employment_Status
			$checkCitySql = "select * from hdfc_salary_cut_gold where city = '".$CityC."' and cutoff='".$cutoff."'";
			//echo $checkCitySql;
//			echo "<br>";
			$checkCityQuery = ExecQuery($checkCitySql);
			$checkCityNum = mysql_num_rows($checkCityQuery);
		
			
				$salarycut = mysql_result($checkCityQuery,0,$checkCategory);
				//echo $salarycut."--".$Net_Salary."--".$card_limit."--".$maxCCLimit;
				//echo "<br>";
			
				if(($Net_Salary >=$salarycut && $salarycut>0 ) || (($maxCCLimit >= $card_limit) && $card_limit>0 && $maxCCLimit>0))
				//if($Net_Salary >=$salarycut)
				{
					$finalWords = "You are eligible for the card.";
					//echo $finalWords."if"; 
				}
			
		}
		else
		{
			//echo "else";
			if($Employment_Status=="Salaried" )
			{
				$cutoff = "opm";
				$checkCitySql = "select * from hdfc_salary_cut_gold where city = '".$CityC."' and cutoff='".$cutoff."'";
				//echo "<br>";
				$checkCityQuery = ExecQuery($checkCitySql);
				$checkCityNum = mysql_num_rows($checkCityQuery);
					
				$salarycut = mysql_result($checkCityQuery,0,'Cat_Z');
				//echo "else  ".$salarycut;
				//echo "<br>";
			//	echo $salarycut."--".$Net_Salary."--".$card_limit."--".$maxCCLimit;
				//echo "<br>";
			
			//	if($salarycut >=$Net_Salary || (($credit_limit >= $maxCCLimit) && $card_limit>0 && $maxCCLimit>0) )
				if(($Net_Salary >=$salarycut && $salarycut>0 ) || (($maxCCLimit >= $card_limit) && $card_limit>0 && $maxCCLimit>0) )
				{
					$finalWords = "You are eligible for the card.";
					//echo $finalWords."gfgfgf"; 
				}
			}
		
		}
	
	}
	//echo $finalWords;
	
	if($finalWords=="You are eligible for the card.")
	{
		echo $cutoff;
		echo ".";
	}
	?>
		<input type="hidden" name="RequestID_<?php echo $i; ?>" id="RequestID_<?php echo $i; ?>" value="<?php echo $row["RequestID"]; ?>" >
		<input type="hidden" name="Name_<?php echo $i; ?>" id="Name_<?php echo $i; ?>" value="<?php echo $row["Name"]; ?>" >
				<input type="hidden" name="email_<?php echo $i; ?>" id="email_<?php echo $i; ?>" value="<?php echo $row["Email"]; ?>" >
		
		<select name="validate_pan_<?php echo $i; ?>" id="validate_pan_<?php echo $i; ?>" onChange="return savePancard('<?php echo $i; ?>');"><option value="" <?php if($row["valid_pan"]=='') { echo "selected";} ?>>Select</option><option value="0" <?php if($row["valid_pan"]=='0') { echo "selected";} ?>>Invalid</option> <option value="1" <?php if($row["valid_pan"]=='1') { echo "selected";} ?>>Valid</option></select><div id="feeds_<?php echo $i; ?>" style="text-align:center; font-weight:bold;"></div></td> 
	<td align="center" bgcolor="#DFF6FF" class="style3">
	<?php
	if($row["send_mail"] !='1')
	{
	?>
	<a href="#" onClick="return sendHDFCMail('<?php echo $i; ?>');">Send Mail</a>
	<div id="mails_<?php echo $i; ?>" style="text-align:center; font-weight:bold;"></div>
	<?php
	}
	?>
	
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
 <form name="frmdownload" action="hdfccards_download.php" method="post">
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


</body>

</html>
