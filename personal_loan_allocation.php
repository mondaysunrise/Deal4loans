<?php
require 'scripts/session_check_online.php';

	require 'scripts/db_init.php';
	require 'scripts/functions.php';

require 'personal_loan_allocation_function.php';

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
	
	$Repy_TypeProduct ='';
	if(isset($_REQUEST['Repy_TypeProduct']))
	{
		$Repy_TypeProduct=$_REQUEST['Repy_TypeProduct'];

	}
	$BidderCount = '';
	if(isset($_REQUEST['BidderCount']))
	{
		$BidderCount = $_REQUEST['BidderCount'];

	}	
	
	$strRequestID = '';
	if(isset($_REQUEST['strRequestID']))
	{
		$strRequestID = $_REQUEST['strRequestID'];
	}	
//	getBiddersListModule($strProduct,$strRequestID,$strCity,$strritebidder,$CountDefined);
	
	$strProduct = '';
	if(isset($_REQUEST['strProduct']))
	{
		$strProduct = $_REQUEST['strProduct'];
	}
	
	$strCity = '';
	if(isset($_REQUEST['strCity']))
	{
		$strCity = $_REQUEST['strCity'];
	}
	
	$strritebidder = '';
	if(isset($_REQUEST['strritebidder']))
	{
		$strritebidder = $_REQUEST['strritebidder'];
	}
	
	$CountDefined = '';
	if(isset($_REQUEST['CountDefined']))
	{
		$CountDefined = $_REQUEST['CountDefined'];
	}
	
	$Feedback = '';
	if(isset($_REQUEST['Feedback']))
	{
		$Feedback = $_REQUEST['Feedback'];
	}
	
	$EBS = '';
	if(isset($_REQUEST['EBS']))
	{
		$EBS = $_REQUEST['EBS'];
	}	

	$BiddersCounts = '';
	if(isset($_REQUEST['BiddersCounts']))
	{
		$BiddersCounts = $_REQUEST['BiddersCounts'];
	}
	
	
	if((strlen(trim($strRequestID))>0) && $Feedback=='Send')
	{
		$CheckLeadVolume = ExecQuery("select Bidder_Count from Req_Loan_Personal where RequestID=$strRequestID");
    	$RecordCheckLeadVolume = mysql_fetch_array($CheckLeadVolume);
		
		if($RecordCheckLeadVolume["Bidder_Count"]<4)
		{
			getBiddersListModule($strProduct,$strRequestID,$strCity,$strritebidder,$CountDefined);
			
	    //	$UpdateProductIsValid = ExecQuery("update Req_Loan_Personal set  Is_Valid =1 where RequestID=$strRequestID");
		}
	//x&y module calling
	}	
////////PAGING
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
?>

<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=WINDOWS-1252">
<title>Login</title>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<link rel="stylesheet" type="text/css" href="css/menu.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link href="includes/style.css" rel="stylesheet" type="text/css">

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
	document.frmsearch.action="personal_loan_allocation.php?search=y"+gifName;
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
	
	
	
}
		
	function onFocusBlank(element,defaultVal){
	if(element.value==defaultVal){
		element.value="";
	}
}

function onBlurDefault(element,defaultVal){
	if(element.value==""){
		element.value = defaultVal;
	}
}
	
		
		function calculate(frm,x,y,index)
		{ 
			var arr='extra_'+index+'N';
			var z=x*y;
			//alert(z);
			document.getElementById(arr).value=z;	
	//		frm.submit();
		}
	 
		function initial(index)
		{ 
			//alert(index);
			var arr='extra_'+index+'N';
			var arr2='finallead_'+index+'N';
			var arr3='Variable_'+index+'N';
			var arr4='extra2_'+index+'N';
			
			var z=document.getElementById(arr2).value*document.getElementById(arr3).value;
			//alert(z);
			document.getElementById(arr).value=z;
			document.getElementById(arr4).value=z;
			
			//return z;
		}
			
			
		function calculatelead(frm,x,y,index)
		{ 
			var arr='finallead_'+index+'N';
			var arr1='finallead2_'+index+'N';
			var z=y-x;
			document.getElementById(arr).value=z;
			document.getElementById(arr1).value=z;
		
	//		frm.submit();
		}
		
		function calculatetax(frm,x,index)
		{ 
			var arr='taxvalue_'+index+'N';
			var arr1='grandtotal_'+index+'N';
			//alert(arr);
			var y = x * 12.36 / 100 ;
			var z = parseInt(x) + parseInt(y);
			
			document.getElementById(arr).value=y;
			document.getElementById(arr1).value=z;
		}
		
	 
		function initiallead(y,index)
		{ 
			//alert(index);
			var arr='finallead_'+index+'N';
			var arr2='extralead_'+index+'N';
			var z=y-document.getElementById(arr2).value;
		//	alert(arr);
			document.getElementById(arr).value=z;
		}
			
			
	function HandleOnSubmit(file_name) {

	   myWindow = window.open(file_name, "tinyWindow", ' width=900,height=700')
	   myWindow.document.close() 

}

function MM_jumpMenu(targ,selObj,restore){ //v3.0
 eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
 if (restore) selObj.selectedIndex=0;
}

		
</script>
</head>

<body>
<div align="center">
 <center>
 <?php  include '~TopBidder.php'; ?>
 <br>
 <br><br>
 <br>
 <table width="600" border="0" cellpadding="4" cellspacing="1" class="blueborder">
 <form name="frmsearch" action="personal_loan_allocation.php?search=y" method="post" onSubmit="return chkform();">
   <tr>
     <td colspan="2" class="head1">Personal Loan Is Valid Allocation Module</td>
     </tr>
   <tr>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
   </tr>
   <tr>
     <td width="20%"><strong>Date:</strong></td>
     <td width="80%">From 
	 <?php
	 $y=date('Y');
$m=date('m');
$dd=date('d');
$D=$y.'-'.$m.'-'.$dd;
$da=$y.'-'.$m.'-01';
?>
       <input name="min_date" type="text" id="min_date" size="15" <? if($min_date=="") { ?>value="<? echo $da;?>"<? } else { ?>value="<? echo $min_date; ?>" <? }?>>
       <input name="b12" type="button" class="bluebutton" onClick="javascript:pedirFecha(min_date,'');" value="&lt; Insert">     
         To <span class="bodyarial11">
         <input name="max_date" type="text" id="max_date" size="15"<? if($max_date=="") { ?>value="<?  echo $D;?>"<? } else { ?>value="<? echo $max_date; ?>" <? }?>>
         <input name="b122" type="button" class="bluebutton" onClick="javascript:pedirFecha(max_date,'');" value="&lt; Insert">
        </span></td>
   </tr>
   <tr>
     <td width="20%"><strong>Send To Bidders</strong></td>
     <td width="80%"><input name="BiddersCounts" type="radio" value="3" <?php if($BiddersCounts==3) echo "checked"; ?>> 3 Bidders &nbsp;&nbsp;
	 <input name="BiddersCounts" type="radio" value="2" <?php if($BiddersCounts==2) echo "checked"; ?>> 2 Bidders &nbsp;&nbsp;
	 <input name="BiddersCounts" type="radio" value="1" <?php if($BiddersCounts==1) echo "checked"; ?>> 1 Bidders &nbsp;&nbsp;
	 <input name="BiddersCounts" type="radio" value="0" <?php if($BiddersCounts==0) echo "checked"; ?>> 0 Bidders &nbsp;&nbsp;
	 <input name="BiddersCounts" type="radio" value="4" <?php if($BiddersCounts==4) echo "checked"; ?>> All Bidders &nbsp;&nbsp;
	 <!-- <input name="BidderCount[]" type="checkbox" value="5" > 0 Bidders &nbsp;&nbsp; -->
	 </td>
   </tr>
	 
  
   <tr>
     <td colspan="2" align="center"><input name="Submit" type="submit" class="bluebutton" value="Search" border="0"></td>
     </tr>
   </form>
 </table>
 <p>&nbsp;</p>
 
	<?php
	if($search=="y")
	{
		$mindate = $min_date." 00:00:00";
		$maxdate = $max_date." 23:59:59";
		/*
		
		$min_date=$min_date." 00:00:00";
			$max_date=$max_date." 23:59:59";
			$search_date=$search_date." and UNIX_TIMESTAMP(Req_Loan_Personal.Dated)>='".strtotime($min_date)."' and UNIX_TIMESTAMP(Req_Loan_Personal.Dated)<='".strtotime($max_date)."'";
			*/
		//echo count($BidderCount);
		//print_r($BidderCount);
		if($BiddersCounts!=4)
			$ConditonBidder_Count = "and Bidder_Count =".$BiddersCounts;
		if($BiddersCounts==0 || $BiddersCounts==NULL )
			$ConditonBidder_Count = "and Bidder_Count =0";

		$checkedCountBidders = $BiddersCounts;

		$SqlQuery = "select * from Req_Loan_Personal where  Is_Valid = 0  ".$ConditonBidder_Count." and Dated > '".$mindate."' and Dated < '".$maxdate."' group by Mobile_Number order by Dated asc";
		//$SqlQuery = "select * from Req_Loan_Personal where  Is_Valid = 0 and  Bidder_Count < 4 and Dated > '".$mindate."' and Dated < '".$maxdate."'";
		
		//$SqlQuery = "select * from Req_Loan_Personal where  Is_Valid = 0 and  Bidder_Count < 4 and ( UNIX_TIMESTAMP(Req_Loan_Personal.Dated)>='".strtotime($mindate)."' and UNIX_TIMESTAMP(Req_Loan_Personal.Dated)<='".strtotime($maxdate)."')";
		
		//echo $SqlQuery;
		$Query = ExecQuery($SqlQuery);
		//print_r($Query);
		$numrows = mysql_num_rows($Query);
		$strBiddersName = "";
		$recordcount=$numrows;?>
 <table width="858" border="0" cellpadding="4" cellspacing="1" class="blueborder">
<tr>
     <td colspan="11"><!--<strong><? //echo $startrow+1; ?> to <? //echo min($startrow+$pagesize,$recordcount); ?> Out of <? //echo $recordcount; ?> Records </strong> --></td>
     </tr>
	 <?
if($numrows>0)
{
?>

	

	<tr>
	 <td width="43" class="head1">Serial No.</td>
     <td width="43" class="head1">Name</td>
     <!--<td width="118" class="head1">Company Name </td> -->
     <td width="28" class="head1">City</td>
     <td width="48" class="head1">Mobile</td>
     <td width="79" class="head1">Net Salary </td>
     <td width="33" class="head1">DOB</td>
     <td width="123" class="head1">Employment Status</td>
	 <td width="128" class="head1">Already Send</td>
	 <td width="74" class="head1">Eligible Set</td>
	 <td class='head1'>Send Lead</td>
	 
   </tr>
<?php
}
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
		

		for($i=0;$i<$numrows;$i++)
		{
			$RequestID = mysql_result($Query,$i,'RequestID');
			$Name = mysql_result($Query,$i,'Name');
			$Bidder_Count = mysql_result($Query,$i,'Bidder_Count');
			
			$Mobile_Number  = mysql_result($Query,$i,'Mobile_Number');
			$Net_Salary = mysql_result($Query,$i,'Net_Salary');
			$Company_Name = mysql_result($Query,$i,'Company_Name');
			$DOB = mysql_result($Query,$i,'DOB');
			$Employment_Status = mysql_result($Query,$i,'Employment_Status');
			
			if($Employment_Status==0) { $EmploymentStatus = "Self Employed"; } else { $EmploymentStatus = "Salaried"; }
			
			$City = mysql_result($Query,$i,'City');
			$City_Other = mysql_result($Query,$i,'City_Other');
			
			if($City == 'Others')
			{
				$City = $City_Other;
			}
			
			$FeedbackSql = "select BidderID from Req_Feedback_Bidder1 where  AllRequestID = '".$RequestID."' and Reply_Type = 1";
			$FeedbackSql=$FeedbackSql." LIMIT $startrow, $pagesize"; 
			$FeedbackQuery = ExecQuery($FeedbackSql);
			$CountDefined = mysql_num_rows($FeedbackQuery);
			$strBidders = "";
			$getBidderName = "";
			$strBiddersName = "";
			$strGetBidderName = "";
			while($row=mysql_fetch_array($FeedbackQuery))
			{
				 $Customerid = $row["BidderID"];
				 $strBidders =	$Customerid.", ".$strBidders;
				 $ArrayBidders[] = $Customerid;		
				 
			
				$BidderNameSql = "select Bidder_Name, Conflict_bidder from Bidders_List where BidderID = ".$Customerid." and Reply_Type = 1";
				$BidderNameQuery = ExecQuery($BidderNameSql);
			 	$Bidder_Name = mysql_result($BidderNameQuery, 0,'Bidder_Name');
				$Conflict_Bidder = mysql_result($BidderNameQuery, 0,'Conflict_bidder');
				$BidderName[] = $Bidder_Name;
				$strBiddersName =	$Bidder_Name.", ".$strBiddersName;
				$ConflictBidder[] = $Conflict_Bidder;
				 		 		 			
			}
			
			$ValueBidders = getBidders(getReqValue("Req_Loan_Personal"),$RequestID,$City); 
			
			$StringValueBidders = implode(",", $ValueBidders);
	
			$ArrayDifference_Bidders = array_diff($ValueBidders, $ArrayBidders);
			
			$ChunkConflictBidders =  array_diff($ArrayDifference_Bidders, $ConflictBidder);
			
			$ArrayDifferenceBidders  = implode(",", $ChunkConflictBidders);
		
			if(count($ArrayBidders)==0)
				$ArrayDifferenceBidders  = implode(",",$ValueBidders);
			//echo "Count ".count($ValueBidders)."<br>";
		
			$explodeArrayDifferenceBidders = explode("," , $ArrayDifferenceBidders);
			//echo count($explodeArrayDifferenceBidders);
			$strGetBidderName = "";
			for($a=0;$a<count($explodeArrayDifferenceBidders);$a++)
			{
			
				if($explodeArrayDifferenceBidders[$a]>0)
				{
					$getBiddersName_Sql = "select Bidder_Name from Bidders where BidderID=$explodeArrayDifferenceBidders[$a]";
					$getBiddersName_Query = ExecQuery($getBiddersName_Sql);
					$rowGetBidder = mysql_fetch_array($getBiddersName_Query);
					
					$getBidderName[] = $rowGetBidder['Bidder_Name']; 
				}
			}
			$strGetBidderName = implode(",",$getBidderName);
				
								
			$bdarr = explode(",", $ArrayDifferenceBidders);					
							
			//	print_r($bdarr);
			$countValueBidders = count($bdarr);
			if($countValueBidders>0 && strlen($bdarr[0])>0)
			{
			?>
			
			<tr>
			<td class='bodyarial11'><?php echo $CountingFunction = $CountingFunction + 1 ; ?></td>
						<td class='bodyarial11'><a href='personal_loan_data.php?id=<?php echo $RequestID; ?>' target='_blank'><?php echo $Name;?></a> </td>
			
			<td class='bodyarial11'><?php echo $City;?></td>
			<td class='bodyarial11'><?php echo $Mobile_Number; ?></td>
			<td class='bodyarial11'><?php echo $Net_Salary; ?></td>
			<td class='bodyarial11'><?php echo $DOB; ?></td>
			<td class='bodyarial11'><?php echo $EmploymentStatus; ?></td>
			<td class='bodyarial11'><?php echo $strBiddersName; ?>(<?php echo $strBidders; ?>)</td>
			<td class='bodyarial11'><?php echo $ArrayDifferenceBidders; ?><br><?php 
						
			echo $strGetBidderName; ?></td>
			<td class='bodyarial11'> <? echo getJumpMenu("personal_loan_allocation.php","personal",$RequestID,$City,$ArrayDifferenceBidders,$CountDefined,$min_date, $max_date, $varFeedback, $countValueBidders, $checkedCountBidders) ?></td>
			</tr>
			
			
		<?php
		 }	
		
			//echo "<tr><td>"; print_r($Val); echo "</td></tr>";
		}	
	
	
 	}
	 
	?>

	
	 <br><!--
 <table width="758"  border="0" cellpadding="5" cellspacing="1">
	<? 
	//if($recordcount>0)
	//{
	?>
   <tr>
     <td align="center" class="bluelink">
	 <? 
		//$c=1;
		//for($c=1;$c<=$maxpage;$c++)
		//{	
			//if( $pageno==$c)
			///{
				
				//echo $c."&nbsp;";
			//}
			//else
			//{
			?>
				<a onClick="javascript:sendmail('<? echo "&id=".$i."&pageno=".$c; ?>')" style="cursor:hand"><? echo $c; ?></a>
			<?
			//}
		
		?>		</td>
   </tr>
   <? 
  // } 
   	//} 
	?>
 </table> --><br/>
	
		</table><table width="500" border="0" cellspacing="1" cellpadding="4">
 <form name="frmdownload" action="personalloan-allocation_download.php" method="post">
   <tr>
     <td align="center">
	   <input type="hidden" name="qry1" value="<? echo $SqlQuery; ?>">
	 <input name="Submit2" type="submit" class="bluebutton" value="Export To Excel">
	 </td>
   </tr>
 </form>
 </table>
 <h3 class="bodyarial11">

 </h3>
 </center>
</div>
<?
function getJumpMenu($varPHPPage, $strProduct,$strRequestID,$strCity,$strritebidder,$CountDefined,$varmin_date,$varmax_date, $EligibleBiddersSet,$countValueBidders, $checkedCountBidders)
{
	$strURL="";
	

//	$strURL=$varPHPPage."?search=y&A_ID=".$varRequestID."&type=".$varType."&pageno=".$varpageon."&min_date=".urlencode($varmindate)."&max_date=".urlencode($varmaxdate)."&cmbfeedback=".urlencode($cmbfeedback);
	$strURL=$varPHPPage."?search=y&min_date=".urlencode($varmin_date)."&max_date=".urlencode($varmax_date)."&strRequestID=".urlencode($strRequestID)."&strProduct=".urlencode($strProduct)."&strCity=".urlencode($strCity)."&strritebidder=".$strritebidder."&CountDefined=".$CountDefined."&EBS=".$countValueBidders."&BiddersCounts=".$checkedCountBidders;
?>
	<select name="type" id="type" onChange="MM_jumpMenu('parent',this,0)">
		<option value=""  selected>Not Send</option>
		<option value="<? echo $strURL.'&Feedback=Send'?>" <? if($varFeedback == "Send") { echo "selected"; } ?>>Send Lead</option>
	
	</select>
<?
}
?>
</body>

</html>

</html>