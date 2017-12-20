<?php
	require 'scripts/session_check_online.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	
	$_SESSION['BidderID']=1624;
	echo $_SESSION['BidderID'];

	function getReqValue1($pKey){
	$titles = array(
        'Req_Loan_Personal' => '1',
		'Req_Loan_Home' => '2',
		'Req_Loan_Car' => '3',
		'Req_Credit_Card' => '4',
		'Req_Loan_Against_Property' => '5',
		'Req_Business_Loan' => '6',

	);
	foreach ($titles as $key=>$value)
	    if($pKey==$key)
		return $value;

	return "";
  }

  
  $product="";
	if(isset($_REQUEST['product']))
	{
		$product=$_REQUEST['product'];
	}
  
  $val = $product;
$procode= getReqValue1($product);

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

	
	//echo $val."<br>";
	
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
	document.frmsearch.action="affliate_updatelms_index.php?search=y"+gifName;
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
		if(document.frmsearch.min_date.value<"2010-07-01")
	{
		alert("Sorry!!!! Your minimum date is 2010-07-01.Please Select.");
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

function insertData(id)
		{
			
		var get_requestid= document.getElementById('requestid_'+ id).value;
		var get_product= document.getElementById('product_'+ id).value;
		var get_loan_disbursed= document.getElementById('loan_dis_'+ id).value;
		var get_bidid= document.getElementById('strbidderid_'+ id).value;
		var get_affid= document.getElementById('affliateid_'+ id).value;
	
		var queryString = "?reqtid=" + get_requestid + "&pro=" + get_product + "&loan_dis=" + get_loan_disbursed + "&bidid=" + get_bidid + "&affid=" + get_affid;
				
				//alert(queryString); 
				ajaxRequest.open("GET", "affliate_totalcost_insert.php" + queryString, true);
				// Create a function that will receive data sent from the server
				ajaxRequest.onreadystatechange = function(){
					if(ajaxRequest.readyState == 4)
					{
						if(ajaxRequest.responseText>0)
						{
							//alert(ajaxRequest.responseText);
							document.getElementById('total_cost_'+ id).value=ajaxRequest.responseText;
							alert('cost has been saved');
						}
						else
						{
							alert('cant save the Total cost');
						}
					}
				}

				ajaxRequest.send(null); 
			 
		}

	window.onload = ajaxFunction;

</script>

 </form>
 <br>
 <br>
  <table width="712" border="0">
  
 <tr><td align="center" width="100%">
 <div align="center">
 <table width="600" border="0" cellpadding="4" cellspacing="1" class="blueborder">
 <form name="frmsearch" action="affliate_updatelms_index.php?search=y" method="post" onSubmit="return chkform();">
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
	   <input name="min_date" type="text" id="min_date" size="15" <? if($min_date=="") { ?>value="2010-07-01"<? } else { ?>value="<? echo $min_date; ?>" <? }?>>
		
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
			
			<option value="In Process" <? if($varCmbFeedback == "In Process") { echo "selected"; } ?>>In Process</option>
			<option value="Booked" <? if($varCmbFeedback == "Booked") { echo "selected"; } ?>>Booked</option>
			
	<option value="Rejected" <? if($varCmbFeedback == "Rejected") { echo "selected"; } ?>>Rejected</option>
	</select>

	 </td>
   </tr>
    <tr>
		<td width="20%"><strong>Product</strong></td>
		<td width="80%"><select name="product" id="product">
		<option value="">Please Select</option>
		<option value="Req_Loan_Personal" <? if($val=="Req_Loan_Personal") echo "Selected"; ?>>Personal Loan</option>
				<option value="Req_Loan_Home" <? if($val=="Req_Loan_Home") echo "Selected"; ?>>Home Loan</option>

		</select></td>
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
		if($val=="Req_Loan_Personal")
		{
			$lmsbidid="846,847,854";
		}
		elseif($val=="Req_Loan_Home")
		{
			$lmsbidid="460,732,812,207";
		}
		$strSQL="";
		$Msg="";

		$result = ExecQuery("select FeedbackID from Req_Feedback where (AllRequestID=$RequestID and BidderID=".$_SESSION['BidderID']." AND Reply_Type=".$procode.")");		
		$num_rows = mysql_num_rows($result);
		if($num_rows > 0)
		{
			$row = mysql_fetch_array($result);
			$strSQL="Update Req_Feedback Set Feedback='".$Feedback."' ";
			$strSQL=$strSQL."Where FeedbackID=".$row["FeedbackID"];

			if($Feedback=="Booked" || $Feedback=="Rejected" || $Feedback=="In Process")
			{
			$result1 = ExecQuery("Update Req_Feedback Set Feedback='".$Feedback."'  where (AllRequestID=$RequestID and BidderID in(".$lmsbidid.") AND Reply_Type=".$procode.")");	

			//echo "Update Req_Feedback Set Feedback='".$Feedback."'  where (AllRequestID=$RequestID and BidderID in(".$lmsbidid.") AND Reply_Type=".$procode.")";
			//echo "<br>";
			}
		}
		else
		{
			$strSQL="Insert into Req_Feedback(AllRequestID, BidderID, Reply_Type , Feedback) Values (";
			$strSQL=$strSQL.$RequestID.",".$_SESSION['BidderID'].",'".$procode."','".$Feedback."')";
if($Feedback=="Booked" || $Feedback=="Rejected" || $Feedback=="In Process")
			{
			$result1 = ExecQuery("Update Req_Feedback Set Feedback='".$Feedback."' where (AllRequestID=".$RequestID." and BidderID in(".$lmsbidid.") AND Reply_Type=".$procode.")");
			//echo "2";
			//echo "Update Req_Feedback Set Feedback='".$Feedback."'  where (AllRequestID=$RequestID and BidderID in(".$lmsbidid.") AND Reply_Type=".$procode.")";
			//echo "<br>";
			}
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
 <table width="758" border="0" cellpadding="4" cellspacing="1" class="blueborder">
 <? 
		
		if($_SESSION['BidderID']==1624)
		{
			$qry="SELECT RequestID, Feedback,Referral_Flag, Mobile_Number, Name, City, City_Other, Net_Salary
FROM ".$val." LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID= ".$val.".RequestID and Req_Feedback.BidderID=".$_SESSION['BidderID']."
WHERE (
(
".$val.".Dated
BETWEEN '".$min_date."'
AND '".$max_date."'
)
AND Referral_Flag =1 and Allocated=1 and Bidder_Count>0
)";
$qry=$qry.$FeedbackClause;
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
     <td class="head1">Feedback</td>
	 <!--<td class="head1">Total Disbursed Amt</td>-->
	  <td class="head1">Loan Disbursed</td>

	 <td class="head1">Total Cost</td>

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
		
		if($_SESSION['BidderID']==1624)
		{
			/* $qry="SELECT RequestID,Feedback, Referral_Flag, Mobile_Number, Name, City, City_Other, Net_Salary
FROM ".$val." LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID= ".$val.".RequestID and Req_Feedback.BidderID=".$_SESSION['BidderID']."
WHERE (
(
".$val.".Dated
BETWEEN '".$min_date."'
AND '".$max_date."'
)
AND Referral_Flag =1 and Allocated=1 and Bidder_Count>0
)";*/
$qry="SELECT *,Req_Feedback_Bidder.BidderID as affliate FROM Req_Feedback_Bidder,`".$val."` LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID=`".$val."`.RequestID AND Req_Feedback.BidderID in (".$_SESSION['BidderID'].") WHERE (Req_Feedback_Bidder.AllRequestID=`".$val."`.RequestID and Req_Feedback_Bidder.Reply_Type=".$procode." and (".$val.".Dated
BETWEEN '".$min_date."'
AND '".$max_date."'
)
AND `".$val."`.Referral_Flag =1 and `".$val."`.Allocated=1 and `".$val."`.Bidder_Count>0)";

		}
		else
		{
			echo "not authoried to view the details";
		}


		$qry=$qry.$FeedbackClause;
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
<input type="hidden" name="product_<? echo $i;?>" id="product_<? echo $i;?>" value="<? echo $procode;?>">
<input type="hidden" name="affliateid_<? echo $i;?>" id="affliateid_<? echo $i;?>" value="<? echo $row["affliate"];?>">
<tr>
<td class="bodyarial11"><? echo $row["Name"]; ?></td>
<td class="bodyarial11"><? echo $row["Mobile_Number"]; ?></td>
<td class="bodyarial11"><? echo $row["Net_Salary"]; ?></td>
<td class="bodyarial11"><? echo $row["City"]; ?></td>
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
	<td><select name="strbidderid_<? echo $i;?>" id="strbidderid_<? echo $i;?>"><?
		$BidderID="";   
	   $BiddersChurn="SELECT Bidder_Name,Req_Feedback_Bidder1.BidderID As bid FROM Req_Feedback_Bidder1 LEFT OUTER JOIN Bidders_List ON Bidders_List.BidderID = Req_Feedback_Bidder1.BidderID and Bidders_List.Reply_Type =".$procode." WHERE AllRequestID = '".$row["RequestID"]."' AND Req_Feedback_Bidder1.Reply_Type =".$procode;
	//echo $BiddersChurn;
	$BiddersChurnSql = ExecQuery($BiddersChurn);
	$NumRowBiddersChurnSql = mysql_num_rows($BiddersChurnSql);
	while($newrow=mysql_fetch_array($BiddersChurnSql))
				{
			$BidderID[]=$newrow["bid"];
			$Bidder_n[]=$newrow["Bidder_Name"];
				}

		for($r=0;$r<count($BidderID);$r++)
			{
				?>
<option value="<? echo $Bidder_n[$r];?>"><? echo $Bidder_n[$r]; ?></option>
				<?
			}
	
	
		?>
		
		</select></td>


    <td class="bodyarial11"><? echo getJumpMenu("affliate_updatelms_index.php",$row["RequestID"],"1",$row["Feedback"],$pageno,$varmin_date,$varmax_date,$varCmbFeedback, $val) ?></td>
<!--<td class="bodyarial11"><input type="text"  size="15" name="total_dis_<? //echo $i;?>" id="total_dis_<? //echo $i;?>" value="<? //echo $cost["Total_Disbursed"]; ?>"> </td>-->

	<td class="bodyarial11"><input type="text"  size="10" name="loan_dis_<? echo $i;?>" id="loan_dis_<? echo $i;?>" value="<? echo $row["Loan_Disbursed"]; ?>"> </td>

<? $getcost=ExecQuery("select Total_Cost From  Req_Feedback_Bidder  Where (AllRequestID=".$row["RequestID"]." and Reply_Type=".$procode.")");
	$cost=mysql_fetch_array($getcost);
	

	?>

<td align="center" bgcolor="#DFF6FF" class="bodyarial11" >
<table width="100%"><tr><td><input type="text"  size="10" name="total_cost_<? echo $i;?>" id="total_cost_<? echo $i;?>" value="<? echo $cost["Total_Cost"]; ?>" readonly></td><td><a onClick="insertData(<? echo $i;?>);" style="cursor:pointer; color:blue;" class="style3">&nbsp;&nbsp;Save</a></td></tr></table></td>

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
	$strURL=$varPHPPage."?search=y&RequestID=".$varRequestID."&type=".$varType."&pageno=".$varpageon."&min_date=".urlencode($varmindate)."&max_date=".urlencode($varmaxdate)."&cmbfeedback=".urlencode($cmbfeedback)."&product=".$varVal;
?>
	<select name="type" id="type" onChange="MM_jumpMenu('parent',this,0)">
		<option value="<? echo $strURL.'&Feedback='?>" <? if($varFeedback == "") { echo "selected"; } ?>>No Feedback</option>
		<option value="<? echo $strURL.'&Feedback=In Process'?>" <? if($varFeedback == "In Process") { echo "selected"; } ?>>In Process</option>
	<option value="<? echo $strURL.'&Feedback=Booked'?>" <? if($varFeedback == "Booked") { echo "selected"; } ?>>Booked</option>
		<option value="<? echo $strURL.'&Feedback=Rejected'?>" <? if($varFeedback == "Rejected") { echo "selected"; } ?>>Rejected</option>
		
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
