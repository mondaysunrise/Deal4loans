<?php
	require 'scripts/session_check_online.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

	$search="";
	if(isset($_GET['search']))
	{
		$search=$_GET['search'];
	}

//print_r($_POST);
	
	$Name_S="";
	if(isset($_REQUEST['Name_S']))
	{
		$Name_S=$_REQUEST['Name_S'];
	}
	
	$Email_S="";
	if(isset($_REQUEST['Email_S']))
	{
		$Email_S=$_REQUEST['Email_S'];
	}
	
	$Mobile_S="";
	if(isset($_REQUEST['Mobile_S']))
	{
		$Mobile_S=$_REQUEST['Mobile_S'];
	}
	
	$City_S="";
	if(isset($_REQUEST['City_S']))
	{
		$City_S=$_REQUEST['City_S'];
	}	

	$Product_S="";
	if(isset($_REQUEST['Product_S']))
	{
		$Product_S=$_REQUEST['Product_S'];
	}
   
	//Paging
	$pagesize=45;
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
	document.frmsearch.action="search_agent_list.php?search=y"+gifName;
	document.frmsearch.submit();
}

function MM_jumpMenu(targ,selObj,restore){ //v3.0
 eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
 if (restore) selObj.selectedIndex=0;
}
</script>
</head><body>
<table width="1004" border="0"  align="center" cellpadding="0" cellspacing="0" >

<tr>
    <td align="center">
<?php 
include "agentregistration_header.php";
?>
</td></tr><tr><td align="center">
<table width="100%" border="0"  align="center" cellpadding="0" cellspacing="0" >

<tr>
    <td align="center">
	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#45B2D8">
<tr><td>
<table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
   <tr>
     <td height="30" align="center" valign="middle"><img src="images/login-srch-pnl.gif" width="650" height="30"></td>
   </tr>
   <tr>
     <td align="center" valign="middle" background="images/login-form-login-bg.gif"><table width="95%" border="0"  cellpadding="1" cellspacing="0">
 <form name="frmsearch" action="search_agent_list.php?search=y" method="post" >
   
  <tr><td colspan="3">&nbsp;</td></tr>
  
   <tr>
   <td colspan="3" align="center">
   <table border="0" width="90%" cellpadding="0" cellspacing="0"><tr>
     <td width="16%" valign="middle" class="style1">&nbsp;&nbsp;&nbsp;&nbsp; Name </td>
     <td width="28%" align="left" valign="middle" class="bidderclass" > 
	   <input name="Name_S" type="text" id="Name_S" value="<?php echo $Name_S; ?>"  ></td>
	   <td width="12%">
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  </td>
  
     <td valign="middle" align="center" class="style1" width="8%">Email</td>
     <td align="left" valign="middle" class="style1" width="24%" >  <input name="Email_S" type="text" id="Email_S" value="<?php echo $Email_S; ?>"  ></td>
        <td width="12%"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
	   </tr>
	   </table>
	   </td></tr>
       
       
         <tr>
   <td colspan="3" align="center">
   <table border="0" width="90%" cellpadding="0" cellspacing="0"><tr>
     <td width="15%" valign="middle" class="style1">&nbsp;&nbsp;&nbsp;&nbsp; Mobile </td>
     <td width="29%" align="left" valign="middle" class="bidderclass" >
	   <input name="Mobile_S" type="text" id="Mobile_S" value="<?php echo $Mobile_S; ?>"  ></td>
	   <td width="12%">
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  </td>
  
     <td valign="middle" align="center" class="style1" width="8%">City</td>
     <td align="left" valign="middle" class="style1" width="24%" >  <select name="City_S" id="City_S">
     <option value="" >All</option>
     <?php
	 $getCitySql = "select A_City from Req_Agent_Pay where A_City!='Others' group by A_City ";
	 $getCityQuery = ExecQuery($getCitySql);
	 $getCityNum = mysql_num_rows($getCityQuery);
	 $selected = "";
	 for($i=0;$i<$getCityNum;$i++)
	 {
		$selected="";
	 	$A_City = mysql_result($getCityQuery,$i,'A_City');
		if($A_City==$City_S)
		{
			$selected="selected";
		}
		echo "<option value='".$A_City."' ".$selected.">".$A_City."</option>";
	 }
	 ?>
     <?php
	 $getCitySql = "select A_City_Other from Req_Agent_Pay where A_City='Others' group by A_City ";
	 $getCityQuery = ExecQuery($getCitySql);
	 $getCityNum = mysql_num_rows($getCityQuery);
	 $selected = "";
	 for($i=0;$i<$getCityNum;$i++)
	 {
	 	$selected = "";
	 	$A_City = mysql_result($getCityQuery,$i,'A_City_Other');
		if($A_City==$City_S)
		{
			$selected="selected";
		}
		echo "<option value='".$A_City."' ".$selected.">".$A_City."</option>";
	 }
	 ?>

     </select>
     </td>
        <td width="12%"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
	   </tr>
	   </table>
	   </td></tr>
           <tr>
   <td colspan="3" align="center">
   <table border="0" width="90%" cellpadding="0" cellspacing="0"><tr>
     <td width="15%" valign="middle" class="style1">&nbsp;&nbsp;&nbsp;&nbsp; Product </td>
     <td width="29%" align="left" valign="middle" class="bidderclass" >
	<select name="Product_S" id="Product_S">
     <option value="" >All</option>
     <option value="Personal Loan" <?php if($Product_S=="Personal Loan") echo "selected"; ?> >Personal Loan</option>
     <option value="Home Loan" <?php if($Product_S=="Home Loan") echo "selected"; ?> >Home Loan</option>
     <option value="Car Loan" <?php if($Product_S=="Car Loan") echo "selected"; ?> >Car Loan</option>
     <option value="Loan Against Property" <?php if($Product_S=="Loan Against Property") echo "selected"; ?> >Loan Against Property</option>
     <option value="Business Loan" <?php if($Product_S=="Business Loan") echo "selected"; ?> >Business Loan</option>
     <option value="Credit Card" <?php if($Product_S=="Credit Card") echo "selected"; ?> >Credit Card</option> 
     <option value="Life Insurance" <?php if($Product_S=="Life Insurance") echo "selected"; ?> >Life Insurance</option>
     <option value="Health Insurance" <?php if($Product_S=="Health Insurance") echo "selected"; ?> >Health Insurance</option>
     </select></td>
	   <td width="12%">
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  </td>
  
     <td valign="middle" align="center" class="style1" width="8%">&nbsp;</td>
     <td align="left" valign="middle" class="style1" width="24%" >  &nbsp;
     </td>
        <td width="12%"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
	   </tr>
	   </table>
	   </td></tr>
  

  <tr><td colspan="3">&nbsp;</td></tr>
   <tr>
    
	  <td width="33%" colspan="3" align="center" valign="middle"><input name="Submit" type="image"  src="http://www.deal4loans.com/images/login-form-lgn-srch.gif" style="width:111px; height:35px; border:none;" border="0"></td>
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

</td></tr>
 <tr><td align="center">
<?
	$search_date="";
	$varmin_date=$min_date;
	$varmax_date=$max_date;

	if($search=="y")
	{
		$mindate=$min_date." 00:00:00";
		$maxdate=$max_date." 23:59:59";
	?>
<p class="bodyarial11"><?=$Msg?></p>
<table width="950" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#FFFFFF" >
<? 

	if(strlen($Name_S)>0)
	{
		$nameF = " and A_Name like '".$Name_S."%'";
	}
	if(strlen($Email_S)>0)
	{
		$emailF = " and A_Email like '".$Email_S."%'";		
	}
	
	if(strlen($Mobile_S)>0)
	{
		$mobileF = " and A_Mobile like '".$Mobile_S."%'";
	}
	if(strlen($City_S)>0)
	{
		$cityF = " and ((A_City = '".$City_S."') or (A_City_Other = '".$City_S."'))";
	}
	if(strlen($Product_S)>0)
	{
		$productF = " and A_Product like '%".$Product_S."%'";
	}
	


	$Sql = "select * from Req_Agent_Pay where 1=1 ".$nameF." ".$emailF." ".$mobileF." ".$cityF." ".$productF." ";// group by A_Mobile
		//echo $Sql;
	//echo "<br>";
	$Query = ExecQuery($Sql);
	$recordcount = mysql_num_rows($Query);
 ?>
<tr>
		 <td colspan="6">
	 <strong><? echo $startrow+1; ?> to <? echo min($startrow+$pagesize,$recordcount); ?> Out of <? echo $recordcount; ?> Records </strong></td>
		 </tr>
      <?
	if($recordcount>0)
	{
	
	?>
    <tr>
		 <td width="114" height="20" align="center" class="head1">Name/Email</td>
		 <td width="150" align="center" class="head1">Password</td>
		 <td width="160" align="center" class="head1">Mobile</td>
		 <td width="160" align="center" class="head1">City</td>
		 <td width="177" align="center" class="head1">Address</td>	
		 <td width="160" align="center" class="head1">Products Deals in</td>
         <td width="160" align="center" class="head1">Dated</td>
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
	
	
	
		$DataSql = "select * from Req_Agent_Pay where 1=1 ".$nameF." ".$emailF." ".$mobileF." ".$cityF." ".$productF." order by  A_Date desc LIMIT $startrow, $pagesize";

		$Data = ExecQuery($DataSql);
		$DataNumRows = mysql_num_rows($Data);
		for($i=0;$i<$DataNumRows;$i++)
		{
			$A_ID = mysql_result($Data,$i,'A_ID');
			$A_Name = mysql_result($Data,$i,'A_Name');
			$A_Email = mysql_result($Data,$i,'A_Email');
			$City = mysql_result($Data,$i,'A_City');
			if($City =="Others")
			{
				$City = mysql_result($Data,$i,'A_City_Other');			
			}
			$A_Mobile = mysql_result($Data,$i,'A_Mobile');
			$A_Product = mysql_result($Data,$i,'A_Product');
			$Address  = mysql_result($Data,$i,'Address');
			$A_Date  = mysql_result($Data,$i,'A_Date');
			$pwd = mysql_result($Data,$i,'pwd');
				if($i%2==0)
			{	
				$bgcolor = "#CCCCCC";	
			}
			else
			{
				$bgcolor = "#FFFFFF";
			}
			
			
			echo "<tr bgcolor='".$bgcolor."'>";
			echo '<td class="bodyarial11" height="26">'.$A_Name.'<br><b>'.$A_Email.'</b></td>';
			echo '<td class="bodyarial11" align="center" style="font-weight:bold;">'.$pwd; 
			echo '</td>';
			echo '<td class="bodyarial11">'.$A_Mobile.'</td>';
			echo '<td class="bodyarial11">'.$City.'</td>';
			echo '<td class="bodyarial11">'.$Address .'</td>';
			echo '<td class="bodyarial11">'.$A_Product.'</td>';
			echo '<td class="bodyarial11">'.$A_Date.'</td>';
			
			echo "</tr>";
		
			$detailsSql = "SELECT * FROM package_purchase_details where AID = '".$A_ID."' ";	
			$detailsQuery = ExecQuery($detailsSql);
			$numDetails = mysql_num_rows($detailsQuery);
			if($numDetails>0)
			{
				echo "<tr bgcolor='ecc6c6'><td colspan='7' align='left' style='padding-left:15px;'><table width='750' border='0' cellpadding='1' cellspacing='1'>";
				for($ds=0;$ds<$numDetails;$ds++)
				{
					$purchase_status = mysql_result($detailsQuery,$ds,'purchase_status');
					if($purchase_status=="success")
					{
						$Pid = mysql_result($detailsQuery,$ds,'Pid');	
						$getPackageSql = "SELECT * FROM product_for_sale where Pid = '".$Pid."' ";
						$getPackageQuery = ExecQuery($getPackageSql);
						$Package_Name_Display = mysql_result($getPackageQuery,0,'Package_Name_Display');
						
						$response_dt = mysql_result($detailsQuery,$ds,'response_dt'); 
						$ResTranId = mysql_result($detailsQuery,$ds,'ResTranId'); 
						$ResTrackId = mysql_result($detailsQuery,$ds,'ResTrackId');
						
						$ResAmount = mysql_result($detailsQuery,$ds,'ResAmount');
						echo '<tr><td class="bodyarial11"><b>Payment Done</b></td>';
						echo '<td class="bodyarial11">'.$Package_Name_Display.'</td>';
						echo '<td class="bodyarial11">Rs. '.$ResAmount.'/-</td>';
						echo '<td class="bodyarial11"><b>'.$ResTranId.'</b></td>';
						echo '<td class="bodyarial11"><b>'.$ResTrackId.'</b></td>';
						echo '<td class="bodyarial11">'.$response_dt.'</td></tr>';
							
					}
				}
				echo "</table></td></tr>";
			}
		}
	?>
    
    
    
  
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
     <td align="center" class="bluelink">
	 <? 
		$c=1;
		for($c=1;$c<=$maxpage;$c++)
		{	
			if( $pageno==$c)
			{
				
			//	echo $c."&nbsp;";
			}
			else
			{
			?>
				<!--<a onClick="javascript:sendmail('<? echo "&id=".$i."&pageno=".$c; ?>')" style="cursor:hand"><? echo $c; ?></a> -->
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
 
   <?
 }
 ?>
 
 </td>
 </tr></table>
</td></tr></table>
</td></tr></table>
</body>
</html>