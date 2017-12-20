<?php
require 'scripts/session_check_online.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';

$uniqueName =$_SESSION['uniqueName'];
if($uniqueName=="team_priya1" || $uniqueName=="team_balbir")
{
	$given_to=1;
}
elseif($uniqueName=="team_rakhi2")
{
	$given_to=2;
}
else
{
	if(isset($_REQUEST['type']))
	{
		$given_to=$_REQUEST['type'];
	}
}

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

/******************************************************************************************/ 
/*	Code Added by Santosh :: Search with the mobile number of user						  */
/******************************************************************************************/
$varSrchMobileNo = "";
$srchMobileQry = "";
if($_REQUEST['srch_mobile']!=""){
	$varSrchMobileNo = $_REQUEST['srch_mobile'];
	$srchMobileQry .= " and mobile='".$varSrchMobileNo."' ";		
}		
/******************************************************************************************/


$RequestID="";
if(isset($_REQUEST['RequestID']))
{
	$RequestID=$_REQUEST['RequestID'];
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
<script language="javascript" type="text/javascript" src="scripts/datetime.js"></script>
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
	document.frmsearch.action="customer_fbvdview.php?search=y"+gifName;
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
		if(document.frmsearch.min_date.value<"2014-08-01")
	{
		alert("Sorry!!!! Your minimum date is 2014-08-01.Please Select.");
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

function submitform()
{
 document.bidder_array.submit();
}   
</script>
     </head><body >
<?php include '~Top12.php';?>
  <!-- End Main Banner Menu Panel -->
  <!-- Start Main Container Panel -->
  <div id="dvContentPanel">
   <div id="dvMaincontent">
 <br>
 <br>
  <table width="712" border="0">
 
 <tr><td align="center" width="100%">
 <div align="center">
 <table width="600" border="0" cellpadding="4" cellspacing="1" class="blueborder">
 <form name="frmsearch" action="customer_fbvdview.php?search=y" method="post" onSubmit="return chkform();">
 <input type="hidden" name="BidderIDstatic" id="BidderIDstatic" value="<? echo $_SESSION["BidderID"];?>">
   <tr>
     <td colspan="3" class="head1">Search</td>
     </tr>
   <tr>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
     <td width="51%">&nbsp;</td>
   </tr>   
   <tr>
     <td width="15%"><strong>Date:</strong></td>
     <td width="42%">From 
	   <input name="min_date" type="text" id="min_date" size="15" <? if($min_date=="") { ?>value="2011-01-01"<? } else { ?>value="<? echo $min_date; ?>" <? }?>>		
       <input name="b12" type="button" class="bluebutton" onClick="javascript:pedirFecha(min_date,'');" value="&lt; Insert">     
     </td>
     <td width="43%">To <span class="bodyarial11">
       <input name="max_date" type="text" id="max_date" size="15" value="<? echo $max_date; ?>">
       <input name="b122" type="button" class="bluebutton" onClick="javascript:pedirFecha(max_date,'');" value="&lt; Insert">
       </span>
     </td>
   </tr>
     <tr>
     <td width="15%"><strong>Feedback:</strong></td>
     <td width="42%">
	<select name="cmbfeedback" id="cmbfeedback">
		<option value="All" <? if($varCmbFeedback == "All") { echo "selected"; } ?>>All</option>
		<option value="" <? if($varCmbFeedback == "") { echo "selected"; } ?>>No Feedback</option>
		<option value="Other Product" <? if($varCmbFeedback == "Other Product") { echo "selected"; } ?>>Other Product</option>
		<option value="Not Interested" <? if($varCmbFeedback == "Not Interested") { echo "selected"; } ?>>Not Interested</option>
		<option value="Callback Later" <? if($varCmbFeedback == "Callback Later") { echo "selected"; } ?>>Callback Later</option>
		<option value="Wrong Number" <? if($varCmbFeedback == "Wrong Number") { echo "selected"; } ?>>Wrong Number</option>
		<option value="Not Eligible" <?if($varCmbFeedback == "Not Eligible") { echo "selected"; }?>>Not Eligible</option>
		<option value="Ringing" <?if($varCmbFeedback == "Ringing") { echo "selected"; }?>>Ringing</option>
		<option value="Not Contactable" <?if($varCmbFeedback == "Not Contactable") { echo "selected"; }?>>Not Contactable</option>
		<option value="Duplicate" <?if($varCmbFeedback == "Duplicate") { echo "selected"; }?>>Duplicate</option>
		<option value="Send Now" <? if($varCmbFeedback == "Send Now") { echo "selected"; } ?>>Send Now</option>
		<option value="Not Applied" <? if($varCmbFeedback == "Not Applied") { echo "selected"; } ?>>Not Applied</option>
		<option value="FollowUp" <? if($varCmbFeedback == "FollowUp") { echo "selected"; } ?>>FollowUp</option>
        <option value="Interested But Not Convinced" <? if($varCmbFeedback == "Interested But Not Convinced") { echo "selected"; } ?>>Interested But Not Convinced</option>
        <option value="Already Applied" <? if($varCmbFeedback == "Already Applied") { echo "selected"; } ?>>Already Applied</option>
	</select>
	 </td>
     <td width="43%">
     <strong>Mobile No.:</strong> <input type="text" name="srch_mobile" value="<?php echo $varSrchMobileNo; ?>" />
     </td>
   </tr>
  
   <tr>
     <td colspan="3" align="center"><input name="Submit" type="submit" class="bluebutton" value="Search" border="0"></td>
     </tr>
   </form>
 </table>
 <p>&nbsp;</p>
	<?
	$search_date="";
	$varmin_date=$min_date;
	$varmax_date=$max_date;

	if(strlen(trim($RequestID))>0)
	{
		$strSQL="";
		$Msg="";

		$result = ExecQuery("select custfbvdid from customer_feedback_verified where (custfbvdid='".$RequestID."')");		
		$num_rows = mysql_num_rows($result);
		if($num_rows > 0)
		{
			$row = mysql_fetch_array($result);
			$strSQL="Update customer_feedback_verified Set d4l_feedback='".$Feedback."' ";
			$strSQL=$strSQL."Where custfbvdid=".$row["custfbvdid"];
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
			$FeedbackClause=" AND (customer_feedback_verified.d4l_feedback IS NULL OR customer_feedback_verified.d4l_feedback='') ";
		}
		else if($varCmbFeedback=="All")
		{
			$FeedbackClause=" ";
		}
		else
		{
			$FeedbackClause=" AND customer_feedback_verified.d4l_feedback='".$varCmbFeedback."' ";
		}		
	?>
 <p class="bodyarial11"><?=$Msg?></p>
 <table width="758" border="0" cellpadding="4" cellspacing="1" class="blueborder">
 <? 
if($_SESSION['BidderID']==74)
	{
		$qry="Select * from  customer_feedback_verified Where ((((dated between '".$min_date."' and '".$max_date."') or ( followup_date between '".$min_date."' and '".$max_date."')) and given_to=".$given_to.")";
		$qry=$qry.$FeedbackClause.$srchMobileQry.")";
}		
		else
		{
		echo "not authoried to view the details";
		}

	//echo"hello".$qry."<br>";
		$changedresult=ExecQuery($qry);
		$recordcount = mysql_num_rows($changedresult);
		for($i=0;$i<$recordcount;$i++)
		{
		$lead = mysql_result($changedresult,$i,'RequestID');
		$leadsid[] =$lead;
		}
 ?>
   <tr>
     <td colspan="11"><strong><? echo $startrow+1; ?> to <? echo min($startrow+$pagesize,$recordcount); ?> Out of <? echo $recordcount; ?> Records </strong></td>
     </tr>
   <tr>
   <td class="head1">Name</td>
	<td class="head1">Mobile</td>
	<td class="head1">Salary</td>
	<td class="head1">City</td>
	<td class="head1">Eligible Bidders</td>
     <td class="head1">Feedback</td><?
	if((($varFeedback=="FollowUp")|| ($varFeedback=="Callback Later")) || ($varCmbFeedback == "FollowUp")) { ?> <td class="head1">FollowUp date</td><? } ?>
	
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
	
if($_SESSION['BidderID']==74)
{
	 $qry="Select * from  customer_feedback_verified Where (((dated between '".$min_date."' and '".$max_date."') or ( followup_date between '".$min_date."' and '".$max_date."')) and given_to=".$given_to.")";
		$qry=$qry.$FeedbackClause.$srchMobileQry;
		$qry=$qry." order by dated DESC";
		$qry=$qry." LIMIT $startrow, $pagesize";
}
		else
		{
			echo "not authoried to view the details";
		}

		$result=ExecQuery($qry);

		$i=1;
		if($recordcount>0)
		{
		while($row=mysql_fetch_array($result))
		{
			$Followup_Date = $row['Followup_Date'];				
			$exptodayformat = explode(" ",$Followup_Date);
			$explodeTime = explode(":",$exptodayformat[1]);
			$explodeHr = $explodeTime[0] - 1; 
			$FinalMinDate = '"'.$exptodayformat[0].' '.$explodeHr.':'.$explodeTime[1].':'.$explodeTime[2].'"';
			$FinalMaxDate ='"'.$exptodayformat[0].' 23:59:59"';
			$TodayFormat = date("Y-m-d");
			$FinalDay = $exptodayformat[0];
	?>
<tr>
<td class="bodyarial11"><a href="customer_fbvddetails.php?id=<? echo urlencode($row['custfbvdid']); ?>" target="_blank"><? echo $row["customer_name"]; ?></a></td>
<td class="bodyarial11"><img src="gButt.php?text=<? echo $row["mobile"]; ?>" /></td>
<td class="bodyarial11"><? echo $row["income"]; ?></td>
<td class="bodyarial11"><? echo $row["city"]; ?></td>
<td class="bodyarial11">
<b>	 <? echo getJumpMenu("customer_fbvdview.php",$row["custfbvdid"],$given_to,$row["d4l_feedback"],$pageno,$varmin_date,$varmax_date,$varCmbFeedback, $val) ?>
     </td>
	
<td><input name="followup_date_<? echo $i;?>" type="text" id="followup_date_<? echo $i;?>" size="10" value="<? echo $row["followup_date"];?>"></td>
</tr>
  <!------------///////////////////////////------------->
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
 <? if($_SESSION['uniqueName']=="team_balbir")
		{ ?>
		
 <form name="frmdownload" action="downloadcustomerfedbk.php" method="post">
<table width="500" border="0" cellspacing="1" cellpadding="4">
   <tr>
     <td align="center">
	   <input type="hidden" name="qry1" value="<? echo $qry; ?>">
	   <input type="hidden" name="qry2" value="<? echo $val; ?>">	 
	    <input type="hidden" name="min_date" value="<? echo $min_date; ?>">
	   <input type="hidden" name="max_date" value="<? echo $max_date; ?>">
	 <input name="Submit2" type="submit" class="bluebtn" value="Export List To Excel">
	 </td>
   </tr>
 </table> 
 </form>
   <?
 }
	}
 ?>
    </div>
 </td></tr></table>
  </div>
   </div>
<?
function getJumpMenu($varPHPPage, $varRequestID, $varType, $varFeedback, $varpageon, $varmindate, $varmaxdate,$cmbfeedback,$varVal)
{
	$strURL="";
	$strURL=$varPHPPage."?search=y&RequestID=".$varRequestID."&type=".$varType."&pageno=".$varpageon."&min_date=".urlencode($varmindate)."&max_date=".urlencode($varmaxdate)."&cmbfeedback=".urlencode($cmbfeedback)."&product=".$varVal;
?>
	<select name="type" id="type" onChange="MM_jumpMenu('parent',this,0)">
		<option value="<? echo $strURL.'&Feedback='?>" <? if($varFeedback == "") { echo "selected"; } ?>>No Feedback</option>
		<option value="<? echo $strURL.'&Feedback=Other Product'?>" <? if($varFeedback == "Other Product") { echo "selected"; } ?>>Other Product</option>
		<option value="<? echo $strURL.'&Feedback=Not Interested'?>" <? if($varFeedback == "Not Interested") { echo "selected"; } ?>>Not Interested</option>
		<option value="<? echo $strURL.'&Feedback=Not Contactable'?>" <? if($varFeedback == "Not Contactable") { echo "selected"; } ?>>Not Contactable</option>
		<option value="<? echo $strURL.'&Feedback=Callback Later'?>" <? if($varFeedback == "Callback Later") { echo "selected"; } ?>>Callback Later</option>
		<option value="<? echo $strURL.'&Feedback=Wrong Number'?>" <? if($varFeedback == "Wrong Number") { echo "selected"; } ?>>Wrong Number</option>
		<option value="<? echo $strURL.'&Feedback=Send Now'?>" <? if($varFeedback == "Send Now") { echo "selected"; } ?> >Send Now</option>
		<option value="<? echo $strURL.'&Feedback=Not Eligible'?>" <? if($varFeedback == "Not Eligible") { echo "selected"; } ?> >Not Eligible</option>
		<option value="<? echo $strURL.'&Feedback=Ringing'?>" <? if($varFeedback == "Ringing") { echo "selected"; } ?> >Ringing</option>
		<option value="<? echo $strURL.'&Feedback=Duplicate'?>" <? if($varFeedback == "Duplicate") { echo "selected"; } ?> >Duplicate</option>
		<option value="<? echo $strURL.'&Feedback=Not Applied'?>" <? if($varFeedback == "Not Applied") { echo "selected"; } ?> >Not Applied</option>
		<option value="<? echo $strURL.'&Feedback=FollowUp'?>" <? if($varFeedback == "FollowUp") { echo "selected"; } ?>>FollowUp</option>		
        <option value="<? echo $strURL.'&Feedback=Interested But Not Convinced'?>" <? if($varCmbFeedback == "Interested But Not Convinced") { echo "selected"; } ?>>Interested But Not Convinced</option>
        <option value="<? echo $strURL.'&Feedback=Already Applied'?>" <? if($varCmbFeedback == "Already Applied") { echo "selected"; } ?>>Already Applied</option>
	</select>	
<?
}
?>
</form>
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
