<?php
	require 'scripts/session_check_online.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

	$FeedbackClause="";
	$OrderBy=" order by Req_Agent.Dated desc";
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
	///////////////////////////////
	$varCmbFeedback="";
	if(isset($_REQUEST['cmbfeedback']))
	{
		$varCmbFeedback=$_REQUEST['cmbfeedback'];
	}

	$A_ID="";
	if(isset($_REQUEST['A_ID']))
	{
		$A_ID=$_REQUEST['A_ID'];
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
	////////////////////////////
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
<script language="javascript" type="text/javascript" src="scripts/datetime.js"></script>
<link href="style.css" rel="stylesheet" type="text/css" />

<?php include '~Top.php';?>
  <!-- End Main Banner Menu Panel -->
  <!-- Start Main Container Panel -->
  <div id="dvContentPanel">
   <div id="dvMaincontent"><script type="text/JavaScript">
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
	document.frmsearch.action="agents_index.php?search=y"+gifName;
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
	if(document.frmsearch.min_date.value<"2007-11-30")
	{
		alert("Sorry!!!! Your minimum date is 2007-11-30.Please Select.");
		document.frmsearch.min_date.value="";
		document.frmsearch.min_date.focus();
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

		function insertTemp(counter)
		{
			alert (counter);
			var Followupdate = document.getElementById('FollowupDate-'+counter).value;
			alert(Followupdate);
			var Requestid = document.getElementById('aid-'+counter).value;
			alert (Requestid);
			var Comment = document.getElementById('comment-'+counter).value;
			alert (Comment);
			if((Requestid!=""))
			{

				var queryString = "?request=" + Requestid + "&followupdate=" + Followupdate + "&comment=" + Comment;
				//var queryString = "?Mobile=" + Mobile ;
				alert(queryString); 
				ajaxRequest.open("GET", "update-agent-details.php" + queryString, true);
				// Create a function that will receive data sent from the server
				ajaxRequest.onreadystatechange = function(){
					if(ajaxRequest.readyState == 4)
					{
						//document.myForm.time.value=ajaxRequest.responseText;
						//var ajaxDisplay = document.getElementById('ajaxDiv');
						//ajaxDisplay.innerHTML = ajaxRequest.responseText;
						//document.write(ajaxRequest.responseText); 
					
					}
				}

				ajaxRequest.send(null); 
			 }
			
		
		}

		

	
	function OnloadCalls()
	{
		ajaxFunction();
		insertTemp();
		
		
	}
	//swindow.onload = OnloadCalls;
	window.onload = ajaxFunction;

</script>
</head> </form>
 <br>
 <br>
 <table width="712" border="0">
 
 <tr><td align="center" width="100%">
 <div align="center">
  <table width="600" border="0" cellpadding="4" cellspacing="1" >
  <tr>
     <td colspan="2" class="head1" align="center">Deal4loans DSA/Bank</td>
     </tr>
	 <tr><td>&nbsp;</td></tr>
	 </table>
 <table width="600" border="0" cellpadding="4" cellspacing="1" class="blueborder">
  
 <form name="frmsearch" action="agents_index.php?search=y" method="post" onSubmit="return chkform();">

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
       <input name="min_date" type="text" id="min_date" size="15" <? if($min_date=="") { ?>value="2007-11-30"<? } else { ?>value="<? echo $min_date; ?>" <? }?>>
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
			<option value="Interested" <? if($varCmbFeedback == "Interested") { echo "selected"; } ?>>Interested</option>
			<option value="Small City" <? if($varCmbFeedback == "Small City") { echo "selected"; } ?>>Small City</option>
			<option value="Not Interested" <? if($varCmbFeedback == "Not Interested") { echo "selected"; } ?>>Not Interested</option>
			<option value="Callback Later" <? if($varCmbFeedback == "Callback Later") { echo "selected"; } ?>>Callback Later</option>
			<option value="Wrong Number" <? if($varCmbFeedback == "Wrong Number") { echo "selected"; } ?>>Wrong Number</option>
			<option value="FollowUp" <? if($varCmbFeedback == "FollowUp") { echo "selected"; } ?>>FollowUp</option>
			<option value="Mail Sent" <? if($varCmbFeedback == "Mail Sent") { echo "selected"; } ?>>Nc-Mail Sent</option>
			<option value="Closed" <? if($varCmbFeedback == "Closed") { echo "selected"; } ?>>Closed</option>
			<option value="Already Bidder" <? if($varCmbFeedback == "Already Bidder") { echo "selected"; } ?>>Already Bidder</option>
			<option value="Customer" <? if($varCmbFeedback == "Customer") { echo "selected"; } ?>>Customer</option>
			<option value="Affiliate " <? if($varCmbFeedback == "Affiliate") { echo "selected"; } ?>>Affiliate</option>
			<option value="Prospects" <? if($varCmbFeedback == "Prospects") { echo "selected"; } ?>>Prospects</option>
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
	if(strlen(trim($A_ID))>0)
	{
		$strSQL="";
		$Msg="";

		
			$strSQL="Update Req_Agent Set  A_Feedback='".$Feedback."' ";
			$strSQL=$strSQL."Where A_ID='".$A_ID."'";
		

		//echo $strSQL;
		$result = ExecQuery($strSQL);
		//exit();
		if ($result == 1)
		{
		}
		else
		{
			$Msg = "** There was a problem in adding your feedback. Please try again.";
		}
	}
	
		
	//$search_date="";
	if($search=="y")
	{
		if($min_date!="" and $max_date!="")
		{
			$min_date=$min_date." 00:00:00";
			$max_date=$max_date." 23:59:59";
			$search_date=$search_date." and UNIX_TIMESTAMP(Req_Agent.A_Date)>='".strtotime($min_date)."' and UNIX_TIMESTAMP(Req_Agent.A_Date)<='".strtotime($max_date)."'";
		}
		else if($min_date!="" and $max_date=="")
		{
			$min_date=$min_date." 00:00:00";
			$search_date=$search_date." and UNIX_TIMESTAMP(Req_Agent.A_Date)>='".strtotime($min_date)."'";
		}
		else if($min_date=="" and $max_date!="")
		{
			$max_date=$max_date." 23:59:59";
			$search_date=$search_date." and UNIX_TIMESTAMP(Req_Agent.A_Date)<='".strtotime($max_date)."'";
		}
		else
		{
			$search_date=$search_date." and Req_Agent.A_Date!=''";
		}
		
		if(strlen(trim($varCmbFeedback))==0)
		{
			$FeedbackClause=" AND (Req_Agent.A_Feedback IS NULL OR Req_Agent.A_Feedback='') ";
		}
		else if($varCmbFeedback=="All")
		{
			$FeedbackClause="";
		}
		else
		{
			$FeedbackClause=" AND Req_Agent.A_Feedback='".$varCmbFeedback."' ";
		}
	?>
	<p class="bodyarial11"><?=$Msg?></p>
 <table width="870" border="0" cellpadding="4" cellspacing="1" class="blueborder">
 <?
		
		$search_qry="select * from Req_Agent  where 1=1  ".$search_date." ".$FeedbackClause." order by Req_Agent.A_Date desc";
		$qry="select * from Req_Agent  where 1=1   ".$search_date."  ".$FeedbackClause." order by Req_Agent.A_Date desc";
		//echo "<br>".$qry;
		$result=ExecQuery($qry);
		$recordcount = mysql_num_rows($result);
		if($recordcount>0)
		{
 ?>
   <tr>
     <td colspan="10"><strong><? echo $startrow+1; ?> to <? echo min($startrow+$pagesize,$recordcount); ?> Out of <? echo $recordcount; ?> Records </strong></td>
     </tr>
   <tr>
     <td class="head1">Name</td>
	       <td class="head1">City</td>
	      <td class="head1">Mobile</td>
	 <td class="head1">Products</td>
	 <td class="head1">Associated Bank</td>    
	 	<!--<td class="head1">Query Type</td> -->
	 <td class="head1">FeedBack</td>     
	 <td class="head1">Followup date</td>    
	 <td class="head1">Comment</td>     
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
		$qry="select * from Req_Agent  where 1=1  ".$search_date."  ".$FeedbackClause." order by Req_Agent.A_Date desc LIMIT $startrow, $pagesize";
		//echo $qry;
		$result=ExecQuery($qry);
		
		$i=1;
		if($recordcount>0)
		{
		while($row=mysql_fetch_array($result))
		{
			$TodayFormat = date("Y-m-h h:i:s");
			list( $td,$tt) = split('[ ]', $TodayFormat);
			$TodayFormatend = date("Y-m-d");
			$TodayFormatend = $TodayFormatend." 23:59:59";
			$follow= $row["A_FollowupDate"];
			list( $d,$t) = split('[ ]', $follow);

				
	?>
   <tr>
     <td class="bodyarial11"><? echo $row["A_Name"]; ?></td>
	 	 <!--<td class="bodyarial11"><? echo $row["A_Email"]; ?></td>-->
       <td class="bodyarial11"><? echo $row["A_City"]; ?></td>
    <!-- <td class="bodyarial11"><? echo $row["A_City_Other"]; ?></td>-->
	 <td class="bodyarial11"><? echo $row["A_Mobile"]; ?></td>
	 <td class="bodyarial11"><? echo $row["A_Product"]; ?></td>
	 <td class="bodyarial11"><? echo $row["A_Company"]; ?></td> 
<!--<td class="bodyarial11"><?//if($row["A_Query_Type"]==1){ echo "DSA";} elseif($row["A_Query_Type"]==2){ echo "Bank";}?></td>-->
	<td class="bodyarial11"><? echo getJumpMenu("agents_index.php",$row["A_ID"],"1",$row["A_Feedback"],$pageno,$varmin_date,$varmax_date,$varCmbFeedback) ?></td>
	<? if ($td== $d)
	{?>
		<td bgcolor="#FF0000">
	<?}
	else{?>
	<td class="bodyarial11">
	<?}?>
	<input type="hidden" name="aid-<?php echo $i; ?>" id="aid-<?php echo $i; ?>" value="<?php  echo  $row["A_ID"]; ?>">
	<input type="Text" onChange="insertTemp(<? echo $i; ?>)" onclick="insertTemp(<? echo $i; ?>)" name="FollowupDate-<?php echo $i;?>" id="FollowupDate-<?php echo $i;?>" maxlength="25" size="15" <?php if($Followup_Date !='0000-00-00 00:00:00') { ?>value="<?php  echo $row["A_FollowupDate"]; ?>" <?php } ?>><a href="javascript:NewCal('FollowupDate-<?php echo $i;?>','yyyymmdd',true,24)"><img src="images/cal.gif" width="16" height="16" border="0" alt="Pick a date"></a></td>
	<td class="bodyarial11">
	<textarea rows="2" cols="10" onKeyup name="comment-<?php echo $i;?>" id="comment-<?php echo $i;?>"><? echo $row["A_Comment"]; ?></textarea><a onClick="insertTemp(<? echo $i; ?>);" style="cursor:pointer; color:blue;" class="style3">&nbsp;&nbsp;Save</a></td> 
   </tr>
	<?
			
					$i=$i+1;
		}
		
		}
		}//if(NumRows)
		else
		{
		?>
		 <tr>
     <td colspan="10" align="center"><strong>No Records Found</strong></td>
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
 <form name="frmdownload" action="agents_download.php" method="post">
   <tr>
     <td align="center">
	   <input type="hidden" name="qry1" value="<? echo $search_qry; ?>">
	 <input name="Submit2" type="submit" class="bluebutton" value="Export To Excel">
	 </td>
   </tr>
 </form>
 </table>
 <h3 class="bodyarial11">
   <?
 }
 ?>

 </h3>
 </center>
</div>
<?
function getJumpMenu($varPHPPage, $varRequestID, $varType, $varFeedback, $varpageon, $varmindate, $varmaxdate,$cmbfeedback)
{
	$strURL="";
	$strURL=$varPHPPage."?search=y&A_ID=".$varRequestID."&type=".$varType."&pageno=".$varpageon."&min_date=".urlencode($varmindate)."&max_date=".urlencode($varmaxdate)."&cmbfeedback=".urlencode($cmbfeedback);
?>
	<select name="type" id="type" onChange="MM_jumpMenu('parent',this,0)">
		<option value="<? echo $strURL.'&Feedback='?>" <? if($varFeedback == "") { echo "selected"; } ?>>No Feedback</option>
		<option value="<? echo $strURL.'&Feedback=Interested'?>" <? if($varFeedback == "Interested") { echo "selected"; } ?>>Interested</option>
		<option value="<? echo $strURL.'&Feedback=Small City'?>" <? if($varFeedback == "Small City") { echo "selected"; } ?>>Small City</option>
		<option value="<? echo $strURL.'&Feedback=Not Interested'?>" <? if($varFeedback == "Not Interested") { echo "selected"; } ?>>Not Interested</option>
		<option value="<? echo $strURL.'&Feedback=Callback Later'?>" <? if($varFeedback == "Callback Later") { echo "selected"; } ?>>Callback Later</option>
		<option value="<? echo $strURL.'&Feedback=Wrong Number'?>" <? if($varFeedback == "Wrong Number") { echo "selected"; } ?>>Wrong Number</option>
		<option value="<? echo $strURL.'&Feedback=FollowUp'?>" <? if($varFeedback == "FollowUp") { echo "selected"; } ?>>FollowUp</option>
		<option value="<? echo $strURL.'&Feedback=Mail Sent'?>" <? if($varFeedback == "Mail Sent") { echo "selected"; } ?>>Nc-Mail Sent</option>
		<option value="<? echo $strURL.'&Feedback=Closed'?>" <? if($varFeedback == "Closed") { echo "selected"; } ?>>Closed</option>
		<option value="<? echo $strURL.'&Feedback=Already Bidder'?>" <? if($varFeedback == "Already Bidder") { echo "selected"; } ?>>Already Bidder</option>
		<option value="<? echo $strURL.'&Feedback=Customer'?>" <? if($varFeedback == "Customer") { echo "selected"; } ?>>Customer</option>
		<option value="<? echo $strURL.'&Feedback=Affiliate '?>" <? if($varFeedback == "Affiliate") { echo "selected"; } ?>>Affiliate</option>
		<option value="<? echo $strURL.'&Feedback=Prospects'?>" <? if($varFeedback == "Prospects") { echo "selected"; } ?>>Prospects</option>
	</select>
<?
}
?>
</body>

</html>