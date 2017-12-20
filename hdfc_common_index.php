<?php
	require 'scripts/session_check_online.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

echo "bidders::".$_SESSION['BidderID'];
	$FeedbackClause="";

	$ValidFeedbackClause="";
	$OrderBy=" order by Req_Loan_Home.Dated desc";
	$filename = "closedby_pl.php";

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

	$varValidFeedback="";
	if(isset($_REQUEST['validfeedback']))
	{
		$varValidFeedback=$_REQUEST['validfeedback'];
	}

	$ValidRequestID="";
	if(isset($_REQUEST['validRequestID']))
	{
		$ValidRequestID=$_REQUEST['validRequestID'];
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
	$Bidder_Flag="";
	if(isset($_REQUEST['Bidder_Flag']))
	{
		$Bidder_Flag=$_REQUEST['Bidder_Flag'];
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
<script Language="JavaScript" Type="text/javascript" src="scripts/feedbacktime.js"></script>

<?php include '~Top.php';?>


<div id="dvMainbanner">
   
    <div id="dvbannerContainer"> <img src="images/main_banner1.gif" /> </div>
  </div>
  <!-- End Main Banner Menu Panel -->
  <!-- Start Main Container Panel -->
  <div id="dvContentPanel">
   <div id="dvMaincontent">

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
	document.frmsearch.action="hdfc_common_index.php?search=y"+gifName;
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
	if(document.frmsearch.min_date.value<"2007-10-31")
	{
		alert("Sorry!!!! Your minimum date is 2007-10-31.Please Select.");
		document.frmsearch.min_date.value="";
		document.frmsearch.min_date.focus();
		return false;
	}
	/*if(document.frmsearch.max_date.value>"2007-07-20")
	{
		alert("Your Maximum date is 2007-07-20.");
		document.frmsearch.max_date.value="";
		document.frmsearch.max_date.focus();
		return false;
	}*/
}




function MM_jumpMenu(targ,selObj,restore){ //v3.0
 eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
 if (restore) selObj.selectedIndex=0;
 }

function HandleOnload() {

 window.open("ViewStatus.php?BidderID=<?echo $_SESSION['BidderID']; ?>", "tinyWindow")
}

 window.onload = HandleOnload();
</script>



 </form>
 <br>
 <br>
  <table width="712" border="0">
 <tr><td align="center" width="100%">
 <div align="center">
 <table width="600" border="0" cellpadding="4" cellspacing="1" class="blueborder">
 <form name="frmsearch" action="hdfc_common_index.php?search=y" method="post" onSubmit="return chkform();">
   <tr>
     <td colspan="2" class="head1">Search</td>
     </tr>
   <tr>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
   </tr>
   <tr>
     <td width="20%"><strong>Date:</strong></td>
     <td width="80%">From 
       <input name="min_date" type="text" id="min_date" size="15" <? if($min_date=="") { ?>value="2007-10-31"<? } else { ?>value="<? echo $min_date; ?>" <? }?>>
       <input name="b12" type="button" class="bluebutton" onClick="javascript:pedirFecha(min_date,'');" value="&lt; Insert">     
         To <span class="bodyarial11">
         <input name="max_date" type="text" id="max_date" size="15" value="<? echo $max_date; ?>">
         <input name="b122" type="button" class="bluebutton" onClick="javascript:pedirFecha(max_date,'');" value="&lt; Insert">
        </span></td>
   </tr>
   <tr>
     <td colspan="2" width="100%"><table border="0" width="100%"><tr><td><strong>validate</strong></td><td>
     		<select name="validfeedback" id="validfeedback">
			<option value="All" <? if($varValidFeedback == "All") { echo "selected"; } ?>>All</option>
			<option value="1" <? if($varValidFeedback == "1") { echo "selected"; } ?>>Yes</option>
			<option value="0" <? if($varValidFeedback == "0") { echo "selected"; } ?>>No</option>
		</select>
		</td>
		<td><strong>Feedback:</strong></td>
		<td>
		<select name="cmbfeedback" id="cmbfeedback" onselect="">
			<option value="All" <? if($varCmbFeedback == "All") { echo "selected"; } ?>>All</option>
			<option value="" <? if($varCmbFeedback == "") { echo "selected"; } ?>>No Feedback</option>
			<option value="FollowUp" <? if($varCmbFeedback == "FollowUp") { echo "selected"; } ?>>FollowUp</option>
			<option value="Not Eligible" <? if($varCmbFeedback == "Not Eligible") { echo "selected"; } ?>>Not Eligible</option>
			<option value="Not Interested" <? if($varCmbFeedback == "Not Interested") { echo "selected"; } ?>>Not Interested</option>
			<option value="Callback Later" <? if($varCmbFeedback == "Callback Later") { echo "selected"; } ?>>Callback Later</option>
			<option value="Wrong Number" <? if($varCmbFeedback == "Wrong Number") { echo "selected"; } ?>>Wrong Number</option>
			<option value="PickUp" <? if($varCmbFeedback == "PickUp") { echo "selected"; } ?>>PickUp</option>
			<option value="Ringing" <? if($varCmbFeedback == "Ringing") { echo "selected"; } ?>>Ringing</option>
		</select></td></tr></table>

	 </td>
   </tr>
  

   <tr>
     <td colspan="2" align="center"><input name="Submit" type="submit" class="bluebutton" value="Search" border="0"></td>
     </tr>
   </form>
 </table>
 <p>&nbsp;</p>
	<?
	$search_date="";
	$varmin_date=$min_date;
	$varmax_date=$max_date;

	if(strlen(trim($ValidRequestID))>0)
	{
		echo "hello".$ValidRequestID;
		$valstrSQL="";
		$ValMsg="";

		$valresult = ExecQuery("select RequestID from Req_Loan_Home where RequestID=$ValidRequestID");		
		$num_rows = mysql_num_rows($valstrSQL);
		if($num_rows > 0)
		{
			$row = mysql_fetch_array($valresult);
			$valstrSQL="Update Req_Loan_Home Set Bidder_Flag='".$Bidder_Flag."' ";
			$valstrSQL=$valstrSQL." Where RequestID=".$row["RequestID"];
		
		}
		else
		{
			$valstrSQL="Update Req_Loan_Home Set Bidder_Flag='".$Bidder_Flag."' ";
			$valstrSQL=$valstrSQL."Where RequestID=".$ValidRequestID;
		}
//echo "update". $valstrSQL;
		$valresult = ExecQuery($valstrSQL);
		
		if ($valresult == 1) 
		{
		}
		else
		{
			$ValMsg = "** There was a problem in adding your feedback. Please try again.";
		}
	}

if(strlen(trim($RequestID))>0)
	{
		$strSQL="";
		$Msg="";
		$result = ExecQuery("select FeedbackID from Req_Feedback where AllRequestID=$RequestID and BidderID=".$_SESSION['BidderID']." AND Reply_Type=1");		
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
			$strSQL=$strSQL.$RequestID.",".$_SESSION['BidderID'].",".$type.",'".$Feedback."')";
		}
//		echo $strSQL;
		$result = ExecQuery($strSQL);

		if ($result ==1 )
		{
		}
		else
		{
			$Msg = "** There was a problem in adding your feedback. Please try again.";
		}
	}

	if($search=="y")
	{
		if($min_date!="" and $max_date!="")
		{
			$min_date=$min_date." 00:00:00";
			$max_date=$max_date." 23:59:59";
			$search_date=$search_date." and UNIX_TIMESTAMP(Req_Loan_Home.Dated)>='".strtotime($min_date)."' and UNIX_TIMESTAMP(Req_Loan_Home.Dated)<='".strtotime($max_date)."'";
		}
		else if($min_date!="" and $max_date=="")
		{
			$min_date=$min_date." 00:00:00";
			$search_date=$search_date." and UNIX_TIMESTAMP(Req_Loan_Home.Dated)>='".strtotime($min_date)."'";
		}
		else if($min_date=="" and $max_date!="")
		{
			$max_date=$max_date." 23:59:59";
			$search_date=$search_date." and UNIX_TIMESTAMP(Req_Loan_Home.Dated)<='".strtotime($max_date)."'";
		}
		else
		{
			$search_date=$search_date." and Req_Loan_Home.Dated!=''";
		}

		if(strlen(trim($varValidFeedback))==0)
		{
			$ValidFeedbackClause=" AND (Req_Loan_Home.Bidder_Flag IS NULL OR Req_Loan_Home.Bidder_Flag='') ";
		}
		else if($varValidFeedback=="All")
		{
			$ValidFeedbackClause="";
		}
		else
		{
			$ValidFeedbackClause=" AND Req_Loan_Home.Bidder_Flag='".$varValidFeedback."' ";
		}

		if(strlen(trim($varCmbFeedback))==0)
		{
			$FeedbackClause=" AND (Req_Feedback.Feedback IS NULL OR Req_Feedback.Feedback='') ";
		}
		else if($varCmbFeedback=="All")
		{
			$FeedbackClause="";
		}
		else
		{
			$FeedbackClause=" AND Req_Feedback.Feedback='".$varCmbFeedback."' ";
		}

	?>
 <p class="bodyarial11"><?=$Msg?></p>
 <table width="758" border="0" cellpadding="4" cellspacing="1" class="blueborder">
 <? 
		$search_qry="SELECT * FROM Req_Feedback_Bidder1,Req_Loan_Home LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID= Req_Loan_Home.RequestID AND Req_Feedback.BidderID= '".$_SESSION['BidderID']."' WHERE Req_Feedback_Bidder1.AllRequestID= Req_Loan_Home.RequestID and Req_Feedback_Bidder1.BidderID in('662','663','664','665','666','667','668','669') ".$search_date; 
		$search_qry=$search_qry.$FeedbackClause;
		$search_qry=$search_qry.$ValidFeedbackClause;
		//$search_qry=$search_qry."group by Req_Loan_Home.Mobile_Number";
		//echo $search_qry."<br>";
	$qry="SELECT * FROM Req_Feedback_Bidder1,Req_Loan_Home LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID= Req_Loan_Home.RequestID AND Req_Feedback.BidderID= '".$_SESSION['BidderID']."' WHERE Req_Feedback_Bidder1.AllRequestID= Req_Loan_Home.RequestID and Req_Feedback_Bidder1.BidderID in('662','663','664','665','666','667','668','669') ".$search_date;
		$qry=$qry.$FeedbackClause;
		$qry=$search_qry.$ValidFeedbackClause;
		//$qry=$qry."group by Req_Loan_Home.Mobile_Number";
		$qry=$qry.$OrderBY;
	
		//echo"hello".$qry."<br>";
		$result=ExecQuery($qry);
		$recordcount = mysql_num_rows($result);
 ?>
   <tr>
     <td colspan="11"><strong><? echo $startrow+1; ?> to <? echo min($startrow+$pagesize,$recordcount); ?> Out of <? echo $recordcount; ?> Records </strong></td>
     </tr>
   <tr>
     <td class="head1">Name</td>
	  <td class="head1">Email</td>
     <td class="head1">City</td>
     <td class="head1">Mobile</td>
      <td class="head1">Employment Status </td>
     <td class="head1">Feedback</td>
      <td class="head1">Valid</td>
	<?if($row["Sms_Sent"]!=1) {?><td class="head1">SMS</td><? } ?>
	<?if($row["Email_Sent"]!=1) {?><td class="head1">Email</td><? } ?>
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
		
	
	$qry="SELECT * FROM Req_Feedback_Bidder1,Req_Loan_Home LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID= Req_Loan_Home.RequestID AND Req_Feedback.BidderID= '".$_SESSION['BidderID']."' WHERE Req_Feedback_Bidder1.AllRequestID= Req_Loan_Home.RequestID and Req_Feedback_Bidder1.BidderID in('662','663','664','665','666','667','668','669') ".$search_date;
	$qry=$qry.$FeedbackClause;
	$qry=$search_qry.$ValidFeedbackClause;
	//$qry=$qry."group by Req_Loan_Home.Mobile_Number";
	$qry=$qry.$OrderBy." LIMIT $startrow, $pagesize"; 
		
	//echo "ff".$qry;

		$result=ExecQuery($qry);

		$i=1;
		if($recordcount>0)
		{
		while($row=mysql_fetch_array($result))
		{
	?>
   <tr>
     <td class="bodyarial11"><a href="viewleads.php?id=<? echo urlencode($row['RequestID']); ?>&Bid=<? echo $_SESSION['BidderID'];?>" target="_blank"><? echo $row["Name"]; ?></a></td>
	<td class="bodyarial11"><? echo $row["Email"]; ?></td>
      <td class="bodyarial11"><? echo $row["City"]; ?></td>
     <td class="bodyarial11"><? echo $row["Mobile_Number"]; ?></td>
      <td class="bodyarial11"><? if($row["Employment_Status"]==0) { echo "Self Employed"; } else { echo "Salaried"; }?></td>
     <td><? echo getJumpMenu("hdfc_common_index.php",$row["RequestID"],"1",$row["Feedback"],$pageno,$varmin_date,$varmax_date,$varCmbFeedback); ?><?if($varFeedback=="FollowUp"){?><a href="javascript:NewCal('followupdate','ddmmmyyyy',true,12)"><img src='images/cal.gif'  width='16' height='16' border='0' alt='Pick a date'></a><? } ?></td>
	 <td class="bodyarial11"><? echo getJumpValMenu("hdfc_common_index.php",$row["RequestID"],$row["Bidder_Flag"],$pageno,$varmin_date,$varmax_date,$varValidFeedback) ?></td>
	<? if($row["Sms_Sent"] != 1){?> <td><input type="button" class="bluebutton" name="sms" onclick="window.open('sendsms-email.php?Mobile=<? echo $row["Mobile_Number"];?>&RequestID=<? echo urlencode($row['RequestID']); ?>')" value="SendSMS"></td><? } else {?><td>&nbsp;</td> <? }?>
	<? if(($row["Email_Sent"] != 1) && (strlen(trim($row['Email']))>0)) {?> <td><input type="button" class="bluebutton" name="Email;"  value="SendEmail" onclick="window.open('send-Email.php?Name=<? echo urlencode($row["Name"]); ?>&Email=<? echo urlencode($row['Email']);?>')"></td><? } else {?><td>&nbsp;</td> <? }?>
   
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
 <form name="frmdownload" action="hl_download.php" method="post">
   <tr>
     <td align="center">
	   <input type="hidden" name="qry1" value="<? echo $search_qry; ?>">
	 <input name="Submit2" type="submit" class="bluebutton" value="Export List To Excel">
	 </td>
   </tr>
 </form>
 </table>
 <h3 class="bodyarial11">
   <?
 }
 ?>
    </div>
 </td></tr></table>
  </div>
   </div>
<?php include '~Bottom.php';?>

<?
function getJumpValMenu($varPHPPage, $varvalRequestID, $varValidFeedback, $varpageon, $varmindate, $varmaxdate,$validfeedback)
{
	$strURL="";
	$strURL=$varPHPPage."?search=y&validRequestID=".$varvalRequestID."&pageno=".$varpageon."&min_date=".urlencode($varmindate)."&max_date=".urlencode($varmaxdate)."&validfeedback=".urlencode($validfeedback);
?>
	<select name="type" id="type" onChange="MM_jumpMenu('parent',this,0)">
		<option value="<? echo $strURL.'&Bidder_Flag=1'?>" <? if($varValidFeedback == "1") { echo "selected"; } ?>>Yes</option>
		<option value="<? echo $strURL.'&Bidder_Flag=0'?>" <? if($varValidFeedback == "0") { echo "selected"; } ?>>No</option>
	</select>
<?
}
?>
<?
function getJumpMenu($varPHPPage, $varRequestID, $varType, $varFeedback, $varpageon, $varmindate, $varmaxdate,$cmbfeedback)
{
	$strURL="";
	$strURL=$varPHPPage."?search=y&RequestID=".$varRequestID."&type=".$varType."&pageno=".$varpageon."&min_date=".urlencode($varmindate)."&max_date=".urlencode($varmaxdate)."&cmbfeedback=".urlencode($cmbfeedback);
?>
	<select name="type" id="type" onChange="MM_jumpMenu('parent',this,0);">
		<option value="<? echo $strURL.'&Feedback='?>" <? if($varFeedback == "") { echo "selected"; } ?>>No Feedback</option>
		<option value="<? echo $strURL.'&Feedback=FollowUp'?>" <? if($varFeedback == "FollowUp") { echo "selected"; } ?>>FollowUp</option>
		<option value="<? echo $strURL.'&Feedback=Not Eligible'?>" <? if($varFeedback == "Not Eligible") { echo "selected"; } ?>>Not Eligible</option>
		<option value="<? echo $strURL.'&Feedback=Not Interested'?>" <? if($varFeedback == "Not Interested") { echo "selected"; } ?>>Not Interested</option>
		<option value="<? echo $strURL.'&Feedback=Callback Later'?>" <? if($varFeedback == "Callback Later") { echo "selected"; } ?>>Callback Later</option>
		<option value="<? echo $strURL.'&Feedback=Wrong Number'?>" <? if($varFeedback == "Wrong Number") { echo "selected"; } ?>>Wrong Number</option>
		<option value="<? echo $strURL.'&Feedback=PickUp'?>" <? if($varFeedback == "PickUp") { echo "selected"; } ?>>PickUp</option>
		<option value="<? echo $strURL.'&Feedback=Ringing'?>" <? if($varFeedback == "Ringing") { echo "selected"; } ?>>Ringing</option>
	</select>
<? if(($varFeedback=="FollowUp")|| ($varFeedback=="Callback Later")){ ?><img src='images/cal.gif'  width='16' height='16' border='0' alt='Pick a date' onclick="window.open('Store-Feedback-Date.php?id=<?echo $varRequestID;?>&Bid=<? echo $_SESSION['BidderID'];?>')"></a><? } ?>


<?
}
?>
</body>

</html>
