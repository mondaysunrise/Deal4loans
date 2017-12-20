<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	//session_start();

//echo "hello";
	$FeedbackClause="";
	$OrderBy=" order by Req_Loan_Home.Updated_Date desc";

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
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Login</title>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<link href="includes/style1.css" rel="stylesheet" type="text/css">
<link href="style.css" rel="stylesheet" type="text/css" />

<?
if(isset($_SESSION['BidderID']))
 {
echo "<table width='100%' border='0' cellspacing='0' cellpadding='0'><tr><td width='205' height='70' align='center' valign='middle'  ><img src='images/logo.gif' width='193' height='58' /></td><td width='417' align='left'   class='style1' style='color:#0B6FCC;' ></td><td width='351' align='left' valign='middle'   class='style1' style='color:#0B6FCC;' ><table border='0' align='right' cellpadding='0' cellspacing='0'><tr><td width='6' height='32' align='left' valign='top'><img src='images/insur-form-lgt-btn-lft.gif' width='6' height='32' /></td><td background='images/insur-form-lgt-btn-bg.gif' style=' background-repeat:repeat-x; height:32px;'><table width='100%' border='0' align='center' cellpadding='0' cellspacing='0'><tr><td align='left' valign='middle' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#000000; font-weight:bold; padding-right:15px;'>Welcome ".ucwords($_SESSION['UserType'])." ".$_SESSION['UName']."</td><td align='left' style='padding-right:2px;' width='22'>&nbsp;</td>
<td align='right' class='style1' style='color:#000000; font-weight:bold;'><div align='right' class='style1' style='color:#000000; font-weight:bold;'> <a href='Logout.php' style='color:#000000; font-size:13px; text-decoration:none;'>Logout</a></div></td></tr></table></td><td width='6' height='32'>&nbsp;</td>
</tr></table></td></tr></table><div align='center' valign='middle' style='height:20px; background-color: #0B6FCC;'>&nbsp;</div>";
	}


?>



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
	document.frmsearch.action="icici_agent_index.php?search=y"+gifName;
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
	if(document.frmsearch.min_date.value<"2009-07-10")
	{
		alert("Sorry!!!! Your minimum date is 2009-07-10.Please Select.");
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
	/*if(document.frmsearch.max_date.value>"<?php echo $_SESSION['definedate'];?>")
	{
		alert("Sorry!! for inconvience to view leads after <?php echo $_SESSION['definedate'];?> click the link.");
		document.frmsearch.max_date.value="";
		document.frmsearch.max_date.focus();
		return false;
	}*/
}

function MM_jumpMenu(targ,selObj,restore){ //v3.0
 eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
 if (restore) selObj.selectedIndex=0;
}
</script>
<style>
.style1 {
	font-family: verdana;
	font-size: 11px;
	font-weight: bold;
	color:#FFFFFF;
}
</style>
 <!---</form>-->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td  align="left" valign="top" width="174"><?php //include 'agentleftpanel.php';?></td>
    <td align="center" valign="top"><table width="100%" border="0" align="center">
 <tr><td align="center" width="100%">

<table width="550"   border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td><table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td width="13" height="22" align="left" valign="top">&nbsp;</td>
          <td height="31" align="center" valign="bottom" background="images/insur-form-tp-bg.gif" class="style1" style="font-size:12px;" >Search for Appointments</td>
          <td width="13" height="22" align="right" valign="top">&nbsp;</td>
        </tr>
              <tr>
                <td height="22" align="left" valign="top" background="images/insur-form-lft-bg.gif" style="background-repeat:repeat-y;">&nbsp;</td>
                <td align="center" bgcolor="#087BBC"><table width="95%" border="0" align="right" cellpadding="4" cellspacing="1" >
 <form name="frmsearch" action="icici_agent_index.php?search=y" method="post" onSubmit="return chkform();">
     
   <tr>
     <td colspan="2" height="12"></td>
       </tr>
   <tr>
     <td width="23%" class="style1"><strong>Date:</strong></td>
     <td width="77%" class="style1">From 
<?	 $current_date=date('Y-m-d');?>
       <input name="min_date" type="text" id="min_date" size="15" <? if($min_date=="") { ?>value="<? echo $current_date; ?>"<? } else { ?>value="<? echo $min_date; ?>" <? }?>>
	   <a href="javascript:pedirFecha(min_date,'');" ><img src='images/cal.gif' width='16' height='16' border='0' alt='Pick a date'></a>&nbsp;&nbsp;
	   <!--<input name="b12" type="button" class="bluebutton" onClick="javascript:pedirFecha(min_date,'');" value="&lt; Insert">    --> 
         To <span class="style1">
         <input name="max_date" type="text" id="max_date" size="15" value="<? echo $max_date; ?>">
		  <a href="javascript:pedirFecha(max_date,'');" ><img src='images/cal.gif' width='16' height='16' border='0' alt='Pick a date'></a>
         <!--<input name="b122" type="button" class="bluebutton" onClick="javascript:pedirFecha(max_date,'');" value="&lt; Insert">-->
        </span></td>
   </tr>
 

    <tr>
     <td colspan="2" align="center"><input name="Submit" type="submit" class="bluebutton" value="Search" border="0"></td>
     </tr>
   </form>
 </table></td>
                <td height="22" align="right" valign="top"  background="images/insur-form-rgt-bg-img.gif" style="background-repeat:repeat-y;">&nbsp;</td>
        </tr>
              <tr>
                <td width="30" height="31" align="left" valign="top">&nbsp;</td>
          <td height="31" align="center" valign="bottom" background="images/insur-form-bottom-bg.gif" >&nbsp;</td>
          <td width="30" height="31" align="right" valign="top">&nbsp;</td>
        </tr>
          </table></td>
    </tr>
        <tr>
          <td>&nbsp;</td>
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
 <p class="style1"><?=$Msg?></p>
 <table width="758" border="0" cellpadding="4" cellspacing="1" bgcolor="#0B6FCC">
 <? 
	

	$search_qry="SELECT * FROM icici_agent_leadallocation, Req_Loan_Home WHERE icici_agent_leadallocation.allrequestid = Req_Loan_Home.RequestID AND icici_agent_leadallocation.bidderid =993 AND icici_agent_leadallocation.product =2
AND ( icici_agent_leadallocation.allocation_date BETWEEN '".$min_date."' AND '".$max_date."')";
	//$search_qry=$search_qry.$FeedbackClause;
	$search_qry=$search_qry."group by Req_Loan_Home.Mobile_Number";
	//echo $search_qry."<br>";

	$qry="SELECT * FROM icici_agent_leadallocation, Req_Loan_Home WHERE icici_agent_leadallocation.allrequestid = Req_Loan_Home.RequestID AND icici_agent_leadallocation.bidderid =993 AND icici_agent_leadallocation.product =2
AND ( icici_agent_leadallocation.allocation_date BETWEEN '".$min_date."' AND '".$max_date."')";
	//$qry=$qry.$FeedbackClause;
	$qry=$qry."group by Req_Loan_Home.Mobile_Number";

	list($recordcount,$result)=MainselectfuncNew($qry,$array = array());
 ?>
   <tr>
     <td colspan="11" bgcolor="#FFFFFF" style="color:#063B6C;"><strong><? echo $startrow+1; ?> to <? echo min($startrow+$pagesize,$recordcount); ?> Out of <? echo $recordcount; ?> Records </strong></td>
     </tr>
   <tr>
     <td align="center" bgcolor="#FFFFFF" class="style1" style="color:#063B6C;">Name</td>
      <td align="center" bgcolor="#FFFFFF" class="style1" style="color:#063B6C;">City</td>
     <td align="center" bgcolor="#FFFFFF" class="style1" style="color:#063B6C;">Mobile</td>
     <td align="center" bgcolor="#FFFFFF" class="style1" style="color:#063B6C;">Net Salary </td>
     <td align="center" bgcolor="#FFFFFF" class="style1" style="color:#063B6C;">DOB</td>
	 <td align="center" bgcolor="#FFFFFF" class="style1" style="color:#063B6C;">Loan Amount</td>
	 	 <td align="center" bgcolor="#FFFFFF" class="style1" style="color:#063B6C;">Agent Name</td>
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
		
			
		$qry="SELECT * FROM icici_agent_leadallocation, Req_Loan_Home WHERE icici_agent_leadallocation.allrequestid = Req_Loan_Home.RequestID AND icici_agent_leadallocation.bidderid =993 AND icici_agent_leadallocation.product =2 AND ( icici_agent_leadallocation.allocation_date BETWEEN '".$min_date."' AND '".$max_date."')";
	//	$qry=$qry.$FeedbackClause;
		$qry=$qry."group by Req_Loan_Home.Mobile_Number";
		$qry=$qry.$OrderBy." LIMIT $startrow, $pagesize"; 
	//echo "qry::".$qry."<br>";
		
		list($recordcountDisplay,$resultDisplay)=MainselectfuncNew($qry,$array = array());
		$i=1;
		if($recordcount>0)
		{
		for($j=0;$j<$recordcountDisplay;$j++)
		{
			//$customerid=$row["requestid"]
	?>
   <tr>
     <td class="style1" bgcolor="#FFFFFF" style="color:#063B6C;"><? echo $resultDisplay[$j]["Name"]; ?></td>
       <td class="style1" bgcolor="#FFFFFF" style="color:#063B6C;"><? echo $resultDisplay[$j]["City"]; ?></td>
     <td class="style1" bgcolor="#FFFFFF" style="color:#063B6C;"><? echo $resultDisplay[$j]["Mobile_Number"]; ?></td>
     <td class="style1" bgcolor="#FFFFFF" style="color:#063B6C;"><? echo $resultDisplay[$j]["Net_Salary"]; ?></td>
     <td class="style1" bgcolor="#FFFFFF" style="color:#063B6C;"><? echo $resultDisplay[$j]["DOB"]; ?></td>
	   <td class="style1" bgcolor="#FFFFFF" style="color:#063B6C;"><? echo $resultDisplay[$j]["Loan_Amount"]; ?></td>
	       
		<?
		$getagent="select  agent_name From icici_hfc_agents Where  agentid=".$resultDisplay[$j]["agentid"]."";
	$get=mysql_fetch_array($getagent);

	list($getagentCount,$get)=MainselectfuncNew($getagent,$array = array());
		$getcontr=count($get)-1;
	?>
	<td class="style1" bgcolor="#FFFFFF" style="color:#063B6C;"><? echo  $get[$getcontr]["agent_name"]; ?></td>
   <!--  <td class="style1" bgcolor="#FFFFFF" style="color:#063B6C;"><? //echo getJumpMenu("icici_agent_index.php",$row["customerid"],"1",$row["Feedback"],$pageno,$varmin_date,$varmax_date,$varCmbFeedback) ?></td>-->
   </tr>
	<?	
					$i=$i+1;
		}
		
		}
	?>
 </table>
 <br>
 <table width="758"  border="0" cellpadding="5" cellspacing="1" bgcolor="#0B6FCC">
	<? 
	if($recordcount>0)
	{
	?>
   <tr>
     <td align="center" bgcolor="#FFFFFF" class="style1" style="color:#063B6C;">
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
 <table  cellspacing="1" cellpadding="4">
 <tr><td>
 <table  border="0" cellspacing="1" cellpadding="4">
 <form name="frmdownload" action="iciciagent_download.php" method="post">
   <tr>
     <td align="center">
	   <input type="hidden" name="qry1" value="<? echo $search_qry; ?>">
	 <input name="Submit2" type="submit" class="bluebutton" value="Export List To txt">
	 </td>
   </tr>
 </form>
 </table></td><td> <table border="0" cellspacing="1" cellpadding="4">
 <form name="frmdownload" action="iciciagent_exldownload.php" method="post">
   <tr>
     <td align="center">
	   <input type="hidden" name="qry1" value="<? echo $search_qry; ?>">
	 <input name="Submit2" type="submit" class="bluebutton" value="Export List To Excel">
	 </td>
   </tr>
 </form>
 </table></td></tr></table>
 <h3 class="style1">
   <?
 }
 ?>
    </h3>
 </td></tr></table></td>
  </tr>
</table>


  
  
<?php //include '~Bottom.php';?>

<?
/*function getJumpMenu($varPHPPage, $varRequestID, $varType, $varFeedback, $varpageon, $varmindate, $varmaxdate,$cmbfeedback)
{
	$strURL="";
	$strURL=$varPHPPage."?search=y&RequestID=".$varRequestID."&type=".$varType."&pageno=".$varpageon."&min_date=".urlencode($varmindate)."&max_date=".urlencode($varmaxdate)."&cmbfeedback=".urlencode($cmbfeedback);*/
?>
	<!--<select name="type" id="type" onChange="MM_jumpMenu('parent',this,0)">
		<option value="<? echo $strURL.'&Feedback='?>" <? if($varFeedback == "") { echo "selected"; } ?>>No Feedback</option>
		<option value="<? echo $strURL.'&Feedback=Other Product'?>" <? if($varFeedback == "Other Product") { echo "selected"; } ?>>Other Product</option>
		<option value="<? echo $strURL.'&Feedback=Not Interested'?>" <? if($varFeedback == "Not Interested") { echo "selected"; } ?>>Not Interested</option>
		<option value="<? echo $strURL.'&Feedback=Callback Later'?>" <? if($varFeedback == "Callback Later") { echo "selected"; } ?>>Callback Later</option>
		<option value="<? echo $strURL.'&Feedback=Wrong Number'?>" <? if($varFeedback == "Wrong Number") { echo "selected"; } ?>>Wrong Number</option>
		<option value="<? echo $strURL.'&Feedback=Not Contactable'?>" <? if($varFeedback == "Not Contactable") { echo "selected"; } ?> >Not Contactable</option>
		<option value="<? echo $strURL.'&Feedback=Send Now'?>" <? if($varFeedback == "Send Now") { echo "selected"; } ?> >Send Now</option>
		<option value="<? echo $strURL.'&Feedback=Duplicate'?>" <? if($varFeedback == "Duplicate") { echo "selected"; } ?> >Duplicate</option>
		<option value="<? echo $strURL.'&Feedback=Not Eligible'?>" <? if($varFeedback == "Not Eligible") { echo "selected"; } ?> >Not Eligible</option>
		<option value="<? echo $strURL.'&Feedback=Ringing'?>" <? if($varFeedback == "Ringing") { echo "selected"; } ?> >Ringing</option>

		<option value="<? echo $strURL.'&Feedback=FollowUp'?>" <? if($varFeedback == "FollowUp") { echo "selected"; } ?>>FollowUp</option>
	</select>-->
<?
//}
?>
<?php include 'bottompanel.php';?>
</body>

</html>
