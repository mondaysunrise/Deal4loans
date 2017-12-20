<?php
	require 'scripts/session_check_online.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

$city="";
	if(isset($_REQUEST['city']))
	{
		$city=$_REQUEST['city'];
	}


 $val = "Req_Loan_Personal";
 
   $pro_code=1;

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
	document.frmsearch.action="appt_citi_index.php?search=y"+gifName;
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
		if(document.frmsearch.min_date.value<"2009-02-05")
	{
		alert("Sorry!!!! Your minimum date is 2009-00-05.Please Select.");
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
			//alert("hello");
		var get_comment_section = document.getElementById('comment_section_'+ id).value;
		var get_requestid= document.getElementById('requestid_'+ id).value;
		var get_product= document.getElementById('product_'+ id).value;
		var get_bidderid= document.getElementById('allocated_bidder_'+id).value;
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
<script language="javascript" type="text/javascript">
<!--
function popitup(url) {
	newwindow=window.open(url,'name','height=580,width=600');
	if (window.focus) {newwindow.focus()}
	return false;
}


// -->
</script>


<table width="100%" border="0"  align="center" cellpadding="0" cellspacing="0" >

<tr>
    <td align="center">
	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#45B2D8">
      <tr>
	  <td style="padding-top:15px;"><table  width="669" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#5BBEE0" >
		
				<tr>
				  <td width="669" align="left" valign="top" bgcolor="#FFFFFF" style="background-repeat:no-repeat;" ><table width="97%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="40" align="center"  ><h1 style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; color:#052733; line-height:18px; font-weight:bold;">Welcome to Citibank Appointments</h1></td>
  </tr>
  <tr>
    <td  style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#052733; line-height:17px;">&nbsp;</td>
  </tr>
</table>
</td>
			  </tr>
		  </table></td>
     
	</tr>
	<tr><td>&nbsp;</td></tr>
 <tr><td align="center">
 
 <table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
   <tr>
     <td height="30" align="center" valign="middle"><img src="images/login-srch-pnl.gif" width="650" height="30"></td>
   </tr>
   <tr>
     <td align="center" valign="middle" background="images/login-form-login-bg.gif"><table width="95%" border="0"  cellpadding="1" cellspacing="0">
 <form name="frmsearch" action="appt_citi_index.php?search=y" method="post" onSubmit="return chkform();">
   
  <tr><td colspan="3">&nbsp;</td></tr>
  
   <tr>
   <td colspan="3" align="center">
   <table border="0" width="90%" cellpadding="0" cellspacing="0"><tr>
     <td width="20%" valign="middle" class="style1">&nbsp;&nbsp;Date&nbsp;&nbsp; From </td>
     <td width="24%" align="left" valign="middle" class="bidderclass" ><?$current_date=date('Y-m-d');?> 
	   <input name="min_date" type="text" id="min_date" size="15" <? if($min_date=="") { ?>value="2009-02-05"<? } else { ?>value="<? echo $min_date; ?>" <? }?>></td>
	   <td>
       <input name="b12" type="button" class="bluebutton" onClick="javascript:pedirFecha(min_date,'');" value="&lt; Insert">  </td>
  
     <td valign="middle" align="center" class="style1" width="8%">To</td>
     <td align="left" valign="middle" class="style1" width="24%" >  <input name="max_date" type="text" id="max_date" size="15" value="<? echo $max_date; ?>"></td>
        <td> <input name="b122" type="button" class="bluebutton" onClick="javascript:pedirFecha(max_date,'');" value="&lt; Insert"></td>
	   </tr>
	   </table>
	   </td></tr>
	<tr> 
	<td colspan="3" align="center">&nbsp;</td>
	</tr>

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
 
 //	$getDocSql = "select * from citi_appointments where 	Dated between '".$min_date."' and '".$max_date."'";
	//$getDocQuery = ExecQuery($getDocSql);
//	echo $getDocSql."<br>";
	//$numgetDoc = mysql_num_rows($getDocQuery);
	
		$getBidders_Sql = "select Bidders_List.BidderID as BidderID from Bidders_List where Bidders_List.BankID='1' and Bidders_List.Reply_Type='1' and Bidders_List.Restrict_Bidder='1' ";
		$getBidders_Query = ExecQuery($getBidders_Sql);
		$numR = mysql_num_rows($getBidders_Query);
		$Bid = "";
		for($j=0;$j<$numR;$j++)
		{
			$BidderID = mysql_result($getBidders_Query,$j,'BidderID');
			$Bid[] = $BidderID;
		}
		
		$bidderStr = implode(",",$Bid);
//echo 	$qry="select * from citi_appointments left join Req_Feedback_Bidder1 on Req_Feedback_Bidder1.AllRequestID = citi_appointments.RequestID where (citi_appointments.Dated between '".$min_date."' and '".$max_date."') and Req_Feedback_Bidder1.BidderID in (".$bidderStr.")";
	
	
		$search_qry="select * from citi_appointments left join Req_Feedback_Bidder1 on Req_Feedback_Bidder1.AllRequestID = citi_appointments.RequestID where (Req_Feedback_Bidder1.Allocation_Date between '".$min_date."' and '".$max_date."') and Req_Feedback_Bidder1.BidderID in (".$bidderStr.")";	
		$qry="select * from citi_appointments left join Req_Feedback_Bidder1 on Req_Feedback_Bidder1.AllRequestID = citi_appointments.RequestID where (Req_Feedback_Bidder1.Allocation_Date between '".$min_date."' and '".$max_date."') and Req_Feedback_Bidder1.BidderID in (".$bidderStr.")";
		$result=ExecQuery($qry);
		$recordcount = mysql_num_rows($result);
 ?>
   <tr>
     <td colspan="8" style="border-bottom:1px solid #45B2D8;"><strong><? echo $startrow+1; ?> to <? echo min($startrow+$pagesize,$recordcount); ?> Out of <? echo $recordcount; ?> Records </strong></td>
     </tr>
<tr>
<td class="head1" align="center"><b>BidderID</b></td>
<td class="head1" align="center"><b>Bidder Name</b></td>
<td class="head1" align="center"><b>Customer Name</b></td>
<td class="head1" align="center"><b>City</b></td>
<td class="head1" align="center"><b>Address</b></td>
<td class="head1" align="center"><b>Time</b></td>
<td class="head1" align="center"><b>Docs</b></td>
<td class="head1" align="center"><b>&nbsp;</b></td>
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
		
		
		$qry="select * from citi_appointments left join Req_Feedback_Bidder1 on Req_Feedback_Bidder1.AllRequestID = citi_appointments.RequestID where (Req_Feedback_Bidder1.Allocation_Date between '".$min_date."' and '".$max_date."') and Req_Feedback_Bidder1.BidderID in (".$bidderStr.") ";
		$qry=$qry." order by citi_appointments.Dated DESC";
		$qry=$qry." LIMIT $startrow, $pagesize"; 
		
//echo $qry;
		$result=ExecQuery($qry);

		$i=1;
		if($recordcount>0)
		{
		while($row=mysql_fetch_array($result))
		{
			$id = $row["id"];
			$address_apt  = $row["address_apt"]; 
			$RequestID = $row["RequestID"]; 
			$appdate  = $row["appdate"]; 
			$changeapp_time  = $row["changeapp_time"];
			$docs = $row["docs"]; 
			$Reply_Type = $row["Reply_Type"]; 
			$time = '';
				if($changeapp_time=="08:00:00")
				{
					$time =  "8(am)-9(am)";
				}	
				else if($changeapp_time=="09:00:00")
				{
					$time =  "9(am)-10(am)";
				}
				else if($changeapp_time=="10:00:00")
				{
					$time =  "10(am)-11(am)";
				}
				else if($changeapp_time=="11:00:00")
				{
					$time =  "11(am)-12(pm)";
				}
				else if($changeapp_time=="12:00:00")
				{
					$time =  "12(pm)-1(pm)";
				}
				else if($changeapp_time=="13:00:00")
				{
					$time =  "1(pm)-2(pm)";
				}
				else if($changeapp_time=="14:00:00")
				{
					$time =  "2(pm)-3(pm)";
				}
				else if($changeapp_time=="15:00:00")
				{
					$time =  "3(pm)-4(pm)";
				}
				else if($changeapp_time=="16:00:00")
				{
					$time =  "4(pm)-5(pm)";
				}
				else if($changeapp_time=="17:00:00")
				{
					$time =  "5(pm)-6(pm)";
				}
				else if($changeapp_time=="18:00:00")
				{
					$time =  "6(pm)-7(pm)";
				}
				else if($changeapp_time=="19:00:00")
				{
					$time =  "7(pm)-8(pm)";
				}
			
	
		$getBiddersSql = "select Bidders_List.BidderID as BidderID, Req_Feedback_Bidder1.AllRequestID as AllRequestID from Req_Feedback_Bidder1 left join Bidders_List on Bidders_List.BidderID=Req_Feedback_Bidder1.BidderID where Req_Feedback_Bidder1.AllRequestID='".$RequestID."' and Bidders_List.BankID='1' and Req_Feedback_Bidder1.Reply_Type='1'";
		$getBiddersQuery = ExecQuery($getBiddersSql);
		//echo "<br>".$getBiddersSql."<br>";	
		$BidID = mysql_result($getBiddersQuery,0,'BidderID');
		//echo "<br>".$BidderID;
		$getCustomerSql = "select * FROM Req_Loan_Personal where  RequestID = '".$RequestID."' ";
		$getCustomerQuery = ExecQuery($getCustomerSql);
		$Name = mysql_result($getCustomerQuery,0,'Name');
		$Mobile_Number = mysql_result($getCustomerQuery,0,'Mobile_Number');
		$City = mysql_result($getCustomerQuery,0,'City');
		if($City=="Others")
		{
			$City = mysql_result($getCustomerQuery,0,'City_Other');
		}
		
		$getBidderSql = "select * FROM Bidders where  BidderID = '".$BidID."' ";
		$getBidderQuery = ExecQuery($getBidderSql);
		$BidderName = mysql_result($getBidderQuery,0,'Bidder_Name');
	
		$getSmsSql = "SELECT * FROM `Req_Compaign` where BidderID = '".$BidID."'";	
		$getSmsQuery = ExecQuery($getSmsSql);
		$BidMobile_no = mysql_result($getSmsQuery,0,'Mobile_no');
	
	
	?>
	<tr  bgcolor="#DFF6FF" class="style3">
		<td bgcolor="#DFF6FF" class="style3" align="center"><?php echo $BidID; ?>&nbsp;</td>
		<td bgcolor="#DFF6FF" class="style3" align="center"><?php echo $BidderName; ?><br><?php echo $BidMobile_no; ?>&nbsp;</td>
		<td bgcolor="#DFF6FF" class="style3" align="center"><?php echo $Name; ?><br><?php echo $Mobile_Number; ?>&nbsp;</td>
		<td bgcolor="#DFF6FF" class="style3" align="center"><?php echo $City; ?>&nbsp;</td>
		<td bgcolor="#DFF6FF" class="style3" align="center"><?php echo $address_apt; ?>&nbsp;</td>
		<td bgcolor="#DFF6FF" class="style3" align="center"><?php echo $appdate.' - '.$time; ?>&nbsp;</td>
		<td bgcolor="#DFF6FF" class="style3" align="center"><?php echo $docs; ?></td>	
<td bgcolor="#DFF6FF" class="style3" align="center"><a href="editcitiAppointment.php?Lid=<?php echo $row["RequestID"]; ?>&BidderID=<?php echo $BidID; ?>" onClick="return popitup('editcitiAppointment.php?Lid=<?php echo $row["RequestID"]; ?>&BidderID=<?php echo $BidID; ?>')">EDIT</a></td>
      	
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
 <form name="xlsdownload" action="appt_citidownload.php" method="post">
 <table border="0" cellspacing="0" cellpadding="0">
  <tr>
     <td align="center">
	   <input type="hidden" name="qry1" value="<? echo $search_qry; ?>">
	   <input type="hidden" name="qry2" value="<? echo $val; ?>">
	 
	    <input type="hidden" name="min_date" value="<? echo $min_date; ?>">
	   <input type="hidden" name="max_date" value="<? echo $max_date; ?>">
	 <input name="Submit2" type="submit" class="bluebtn" value="Export List To Excel">
	 </td>
   </tr>
<table>
 </form>
   <?
 }
 ?>
 </td></tr></table>

</body>

</html>
