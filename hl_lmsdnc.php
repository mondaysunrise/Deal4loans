<?php
	require 'scripts/session_check_online.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	require 'eligiblebidderfunc.php';
	//require 'eligiblebidderfunc_proploc.php';


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

   
  $val = "Req_Loan_Home";
  //echo "nnnnnnnn".$val;
	$FeedbackClause="";
	//$OrderBy=" order by Req_Loan_Personal.Dated desc";

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
<script language="javascript" type="text/javascript" src="scripts/datetime.js"></script>

<?php include '~Top.php';?>



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
	document.frmsearch.action="hl_lmsdnc.php?search=y"+gifName;
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
		if(document.frmsearch.min_date.value<"2008-01-08")
	{
		alert("Sorry!!!! Your minimum date is 2008-01-08.Please Select.");
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

 </form>
 <br>
 <br>
  <table width="712" border="0" align="center">
  <tr><td align="right"><a href="commonlms_report.php?bidderid=<?php echo $_SESSION['BidderID'];?>&product=2" target="_blank">today's Report</a></td></tr>
 <tr><td align="center" width="100%">
 <div align="center">
 <table width="600" border="0" cellpadding="4" cellspacing="1" class="blueborder">
 <form name="frmsearch" action="hl_lmsdnc.php?search=y" method="post" onSubmit="return chkform();">
   <tr>
     <td colspan="2" class="head1">Search</td>
    </tr>
   <tr>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
   </tr>
   
   <tr><?php $currentdate=date('Y-m-d');?>
     <td width="20%"><strong>Date:</strong></td>
     <td width="80%">From 
	   <input name="min_date" type="text" id="min_date" size="15" <? if($min_date=="") { ?>value="<? echo $currentdate;?>"<? } else { ?>value="<? echo $min_date; ?>" <? }?>>
		
       <input name="b12" type="button" class="bluebutton" onClick="javascript:pedirFecha(min_date,'');" value="&lt; Insert">     
         To <span class="bodyarial11">
         <input name="max_date" type="text" id="max_date" size="15" value="<? echo $max_date; ?>">
         <input name="b122" type="button" class="bluebutton" onClick="javascript:pedirFecha(max_date,'');" value="&lt; Insert">
        </span></td>
   </tr>
     <tr>
     <td width="20%"><strong>Feedback:</strong></td>
     <td width="80%">
		<select name="cmbfeedback" id="cmbfeedback">
			<option value="All" <? if($varCmbFeedback == "All") { echo "selected"; } ?>>All</option>
			<option value="" <? if($varCmbFeedback == "") { echo "selected"; } ?>>No Feedback</option>
			<option value="Other Product" <? if($varCmbFeedback == "Other Product") { echo "selected"; } ?>>Other Product</option>
			<option value="Not Interested" <? if($varCmbFeedback == "Not Interested") { echo "selected"; } ?>>Not Interested</option>
			<option value="Callback Later" <? if($varCmbFeedback == "Callback Later") { echo "selected"; } ?>>Callback Later</option>
			<option value="Wrong Number" <? if($varCmbFeedback == "Wrong Number") { echo "selected"; } ?>>Wrong Number</option>
			<option value="Not Contactable" <? if($varCmbFeedback == "Not Contactable") { echo "selected"; } ?>>Not Contactable</option>
			<option value="Duplicate" <? if($varCmbFeedback == "Duplicate") { echo "selected"; } ?>>Duplicate</option>
			<option value="Send Now" <? if($varCmbFeedback == "Send Now") { echo "selected"; } ?>>Send Now</option>
			<option value="Ringing" <? if($varCmbFeedback == "Ringing") { echo "selected"; } ?>>Ringing</option>
			<option value="Not Eligible" <? if($varCmbFeedback == "Not Eligible") { echo "selected"; } ?>>Not Eligible</option>
			
	<option value="FollowUp" <? if($varCmbFeedback == "FollowUp") { echo "selected"; } ?>>FollowUp</option>


		</select>

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

	if(strlen(trim($RequestID))>0)
	{
		$strSQL="";
		$Msg="";

		$result = ExecQuery("select FeedbackID from Req_Feedback where AllRequestID=$RequestID and BidderID=".$_SESSION['BidderID']." AND Reply_Type=2");		
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
			$strSQL=$strSQL.$RequestID.",".$_SESSION['BidderID'].",2,'".$Feedback."')";
		}

	echo $strSQL;
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
 <table width="870" border="0" cellpadding="4" cellspacing="1" class="blueborder" align="center">
 <? 
		if($_SESSION['BidderID']==207)
		{
			$qry="SELECT RequestID from Req_Loan_Home LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID= Req_Loan_Home.RequestID and Req_Feedback.BidderID in (732,812,460,207) LEFT OUTER JOIN sms_acknowledgement ON sms_acknowledgement.air2web_requestid=Req_Loan_Home.RequestID and  sms_acknowledgement.product_type=2 and (sms_acknowledgement.a2wstatus='REJECTD' or sms_acknowledgement.a2wstatus='') WHERE ((( (Req_Loan_Home.Updated_Date Between '".($min_date)."' and '".($max_date)."' ) and  (Req_Loan_Home.Bidderid_Details IS NULL or Req_Loan_Home.Bidderid_Details='') and MOD(Req_Loan_Home.RequestID,2)=0 ) or ((Req_Loan_Home.Bidderid_Details IS NULL or Req_Loan_Home.Bidderid_Details='') and (Req_Feedback.Followup_Date Between '".($min_date)."' and '".($max_date)."' and MOD(Req_Feedback.AllRequestID,2)=0 )) and Req_Feedback.BidderID in (732,812,460,207)) and Req_Loan_Home.source!='LIC Housing LP' and (sms_acknowledgement.a2wstatus='REJECTD' or sms_acknowledgement.a2wstatus=''))";
			$qry=$qry.$FeedbackClause;
			$qry=$qry."group by Req_Loan_Home.Mobile_Number";

		}
		elseif($_SESSION['BidderID']==812)
		{
			$qry="SELECT RequestID from Req_Loan_Home LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID= Req_Loan_Home.RequestID and Req_Feedback.BidderID in (732,812,460,207) LEFT OUTER JOIN sms_acknowledgement ON sms_acknowledgement.air2web_requestid=Req_Loan_Home.RequestID and  sms_acknowledgement.product_type=2 and (sms_acknowledgement.a2wstatus='REJECTD' or sms_acknowledgement.a2wstatus='') WHERE ((((Req_Loan_Home.Updated_Date Between '".($min_date)."' and '".($max_date)."' ) and  (Req_Loan_Home.Bidderid_Details IS NULL or Req_Loan_Home.Bidderid_Details='') and MOD(Req_Loan_Home.RequestID,2)=1 ) or ((Req_Loan_Home.Bidderid_Details IS NULL or Req_Loan_Home.Bidderid_Details='') and (Req_Feedback.Followup_Date Between '".($min_date)."' and '".($max_date)."' and MOD(Req_Feedback.AllRequestID,2)=1 )) and Req_Feedback.BidderID in (732,812,460,207)) and Req_Loan_Home.source!='LIC Housing LP' and (sms_acknowledgement.a2wstatus='REJECTD' or sms_acknowledgement.a2wstatus=''))";
			$qry=$qry.$FeedbackClause;
			$qry=$qry."group by Req_Loan_Home.Mobile_Number";

		}
		
		else
		{
			echo "<script>alert('NOT Authorised to access it')</script>";

		}
		
	//echo"hello".$search_qry."<br><br>";
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
	 <td class="head1">City</td>
     <td class="head1"> bidders</td>
	<td class="head1">Status</td>
	  <td class="head1"> Date</td>
     <td class="head1">Feedback</td><?
	if((($varFeedback=="FollowUp")|| ($varFeedback=="Callback Later")) || ($varCmbFeedback == "FollowUp")) { ?> <td class="head1">FollowUp date</td><? } ?>
	 <td class="head1">&nbsp; </td>
	 	 <td class="head1">View history</td>

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
		if($_SESSION['BidderID']==207)
		{	
			$qry="SELECT Referral_Flag ,RequestID,Updated_Date,Mobile_Number,Name,City,City_Other,Feedback,Followup_Date,BidderID,updated_flag from Req_Loan_Home LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID= Req_Loan_Home.RequestID and Req_Feedback.BidderID in (732,812,460,207) LEFT OUTER JOIN sms_acknowledgement ON sms_acknowledgement.air2web_requestid=Req_Loan_Home.RequestID and  sms_acknowledgement.product_type=2 and (sms_acknowledgement.a2wstatus='REJECTD' or sms_acknowledgement.a2wstatus='') WHERE ((( (Req_Loan_Home.Updated_Date Between '".($min_date)."' and '".($max_date)."' ) and  (Req_Loan_Home.Bidderid_Details IS NULL or Req_Loan_Home.Bidderid_Details='') and MOD(Req_Loan_Home.RequestID,2)=0 ) or ((Req_Loan_Home.Bidderid_Details IS NULL or Req_Loan_Home.Bidderid_Details='') and (Req_Feedback.Followup_Date Between '".($min_date)."' and '".($max_date)."' and MOD(Req_Feedback.AllRequestID,2)=0 )) and Req_Feedback.BidderID in (732,812,460,207)) and Req_Loan_Home.source!='LIC Housing LP' and (sms_acknowledgement.a2wstatus='REJECTD' or sms_acknowledgement.a2wstatus=''))";
			$qry=$qry.$FeedbackClause;
			$qry=$qry."group by Req_Loan_Home.Mobile_Number";
			$qry=$qry." LIMIT $startrow, $pagesize"; 
			
		}
		elseif($_SESSION['BidderID']==812)
		{
			$qry="SELECT Referral_Flag ,RequestID,Updated_Date,Mobile_Number,Name,City,City_Other,Feedback,Followup_Date,BidderID,updated_flag from Req_Loan_Home LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID= Req_Loan_Home.RequestID and Req_Feedback.BidderID in (732,812,460,207) LEFT OUTER JOIN sms_acknowledgement ON sms_acknowledgement.air2web_requestid=Req_Loan_Home.RequestID and  sms_acknowledgement.product_type=2 and (sms_acknowledgement.a2wstatus='REJECTD' or sms_acknowledgement.a2wstatus='') WHERE ((((Req_Loan_Home.Updated_Date Between '".($min_date)."' and '".($max_date)."' ) and  (Req_Loan_Home.Bidderid_Details IS NULL or Req_Loan_Home.Bidderid_Details='') and MOD(Req_Loan_Home.RequestID,2)=1 ) or ((Req_Loan_Home.Bidderid_Details IS NULL or Req_Loan_Home.Bidderid_Details='') and (Req_Feedback.Followup_Date Between '".($min_date)."' and '".($max_date)."' and MOD(Req_Feedback.AllRequestID,2)=1 )) and Req_Feedback.BidderID in (732,812,460,207)) and Req_Loan_Home.source!='LIC Housing LP' and (sms_acknowledgement.a2wstatus='REJECTD' or sms_acknowledgement.a2wstatus=''))";
			$qry=$qry.$FeedbackClause;
			$qry=$qry."group by Req_Loan_Home.Mobile_Number";
			$qry=$qry." LIMIT $startrow, $pagesize"; 

		}
	
		else
		{
			echo "<script>alert('NOT Authorised to access it')</script>";

		}
//echo "<br>";
//echo $qry;
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
   <td class="bodyarial11"><?//echo $row["RequestID"]; ?><a href="editlead.php?id=<? echo urlencode($row['RequestID']); ?>&Bid=<? echo $_SESSION['BidderID'];?>&to=<? echo $min_date;?>&from=<? echo $max_date;?>" target="_blank"><? echo $row["Name"]; ?></a></td>
	<td class="bodyarial11"><? echo $row["Mobile_Number"]; ?></td>
	<?
	    if($row["City"]=="Others")
        {
            $City= $row["City_Other"];
        }
        else
        {
            $City= $row["City"];
        }
	   ?>
	   <td class="bodyarial11"><? echo $City; ?></td>
	 

	<td><? list($FinalBidder,$finalBidderName)= geteligibleBiddersList("Req_Loan_Home",$row["RequestID"],$City,$strreferral);
   for($i=0;$i<count($FinalBidder);$i++)
			{
				echo $finalBidderName[$i].",";
			}
	
		?>
		</td>
<td class="bodyarial11"><? 	
	$smstatChurn="SELECT a2wstatus FROM sms_acknowledgement WHERE (air2web_requestid = '".$row["RequestID"]."' AND product_type=2)";
	//echo $BiddersChurn;
	$smstatChurnSql = ExecQuery($smstatChurn);
	$smsrow=mysql_fetch_array($smstatChurnSql);
	if($smsrow["a2wstatus"]=="REJECTD")
			{
		echo "<span style='color: #FF0000;'>DND</span>";
			}
			else if ($smsrow["a2wstatus"]=="DELIVRD")
			{
				echo "NON-DNC";
			} ?></td>
	
		
		<?php list($dated,$time) = split(' ', $row["Updated_Date"]); ?>
  <td class="bodyarial11"><?php echo $dated;?></td>
    <td class="bodyarial11"><? echo getJumpMenu("hl_lmsdnc.php",$row["RequestID"],"1",$row["Feedback"],$pageno,$varmin_date,$varmax_date,$varCmbFeedback, $val) ?></td>
	<?php
			
	if(($Followup_Date>$FinalMinDate || $Followup_Date<$FinalMaxDate) && ($Followup_Date !='0000-00-00 00:00:00') &&  ($TodayFormat==$FinalDay) ) 
			{ 
				if($row['updated_flag']==1)
				{
					?>
					<td  bgcolor="#33CCCC"> 
				<?}
				else
				{ ?>
					<td  bgcolor="#FF0000"> 
					<?php 
				}

		}
		else
			{
			?>
<td  class="bodyarial11"> 
			<? }?><form action="agents_followup.php" name="FollowupForm" method="post" onSubmit="return followup_form();"><input type="Text"  name="FollowupDate-<?php echo $row["RequestID"]; ?>" maxlength="25" size="15" <?php if($Followup_Date !='0000-00-00 00:00:00') { ?>value="<?php  echo $Followup_Date; ?>" <?php } ?>><a href="javascript:NewCal('FollowupDate-<?php echo $row["RequestID"]; ?>','yyyymmdd',true,24)"><img src="images/cal.gif" width="16" height="16" border="0" alt="Pick a date"></a><input type="hidden" name="aid-<?php echo $row["RequestID"]; ?>" value="<?php  echo $row['RequestID']; ?>"><input type="hidden" name="a_count" value="<?php  echo $recordcount; ?>"><input type="hidden" name="varmin_date" value="<?php  echo $varmin_date; ?>"><input type="hidden" name="varmax_date" value="<?php  echo $varmax_date; ?>"><input type="submit" name="submit" value="  "></form></td> 
	
<td><a HREF="javascript:void(0)"
onclick="window.open('http://www.deal4loans.com/get_complete_details.php?mob=<? echo urlencode($row['Mobile_Number']); ?>&pt=Req_Loan_Home')" >View</a></td>
	

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
<!--<form name="frmdownload" action="bidder_download.php" method="post">
   <tr>
     <td align="center">
	   <input type="hidden" name="qry1" value="<? echo $search_qry; ?>">
	   <input type="hidden" name="qry2" value="<? echo $val; ?>">
	 <input name="Submit2" type="submit" class="bluebutton" value="Export List To Excel">
	 </td>
   </tr>
 </form>
 </table>-->
 <h3 class="bodyarial11">
   <?
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
//	$strURL=$varPHPPage."?search=y&RequestID=".$varRequestID."&type=".$varType."&pageno=".$varpageon."&min_date=".urlencode($varmindate)."&max_date=".urlencode($varmaxdate)."&cmbfeedback=".urlencode($cmbfeedback);
		$strURL=$varPHPPage."?search=y&RequestID=".$varRequestID."&type=".$varType."&pageno=".$varpageon."&min_date=".urlencode($varmindate)."&max_date=".urlencode($varmaxdate)."&cmbfeedback=".urlencode($cmbfeedback)."&product=".$varVal;
?>
	<select name="type" id="type" onChange="MM_jumpMenu('parent',this,0)">
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
