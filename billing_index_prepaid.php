<?php
ob_start();
require 'scripts/session_checkBilling.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
//echo "Session :::: ";
//print_r ($_SESSION);
	
	function getReqValue1($pKey){
	$titles = array(
        '1' => 'Req_Loan_Personal',
		'2' => 'Req_Loan_Home',
		'3' => 'Req_Loan_Car',
		'4' => 'Req_Credit_Card',
		'5' => 'Req_Loan_Against_Property',
		'6' => 'Req_Business_Loan'
	);
	
	foreach ($titles as $key=>$value)
	    if($pKey==$key)
		return $value;

	return "";
  }

	function getReqValue($pKey){
	$titles = array(
        '1' => 'Personal Loan',
		'2' => 'Home Loan',
		'3' => 'Car  Loan',
		'4' => 'CreditCard',
		'5' => 'Loan Against Property',
		'6' => 'Business Loan',
	);
	foreach ($titles as $key=>$value)
	    if($pKey==$key)
		return $value;

	return "";
  }
  
  	
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
//echo "pppp".$count;

	
?>

<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Pre Paid </title>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
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
	document.frmsearch.action="billing_index.php?search=y"+gifName;
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
			var y = x * 10.3 / 100 ;
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


		
</script>
</head>

<body>
<div align="center">
 <center>
 <?php  include '~TopBilling.php'; ?>
 <br>
 <br>
 <table width="600" border="0" cellpadding="4" cellspacing="1" class="blueborder">
 <form name="frmsearch" action="billing_index_prepaid.php?search=y" method="post" onSubmit="return chkform();">
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
   <td width="20%">Products</td>
     <td width="80%" align="left">
		 <select name="Repy_TypeProduct"> 
	  <option value="-1" <?php if($Repy_TypeProduct==-1) echo "selected"; ?>>Select Product</option>
	 <option value="1" <?php if($Repy_TypeProduct==1) echo "selected"; ?>>Personal Loan</option>
	 <option value="2" <?php if($Repy_TypeProduct==2) echo "selected"; ?>>Home Loan</option>
	 <option value="3" <?php if($Repy_TypeProduct==3) echo "selected"; ?>>Car Loan</option>
	 <option value="4" <?php if($Repy_TypeProduct==4) echo "selected"; ?>>Credit Card</option>
	 <option value="5" <?php if($Repy_TypeProduct==5) echo "selected"; ?>>Loan Against Property</option>
	 <option value="6" <?php if($Repy_TypeProduct==6) echo "selected"; ?>>Business loan</option>
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
	if($search=="y")
	{
		$min_date=$min_date." 00:00:00";
		$max_date=$max_date." 23:59:59";
		
	?>
	
 	      <table width="799" border="0" cellpadding="2" cellspacing="1" class="blueborder">
<?
	if($Repy_TypeProduct==-1)
	{
	$search_qry="select * from Bidders_List where  1 = 1  and  Multiplier>0 ORDER BY `BidderID` ASC ";
	$qry="select * from Bidders_List where 1 = 1  and  Multiplier>0 ORDER BY `BidderID` ASC ";
	}
	else
	{
	
	$search_qry="select * from Bidders_List where  1 = 1  and  Multiplier>0 and Reply_type = '".$Repy_TypeProduct."' ORDER BY `BidderID` ASC ";
	$qry="select * from Bidders_List where 1 = 1  and  Multiplier>0 and Reply_type = '".$Repy_TypeProduct."' ORDER BY `BidderID` ASC ";
	}
	
	 list($recordcount,$getrow)=MainselectfuncNew($search_qry,$array = array());

 ?>
      
        <tr>
		<td width="55" class="head1">Serial No.</td>  
		<td width="85" class="head1">GeneratedBy</td>
          <td width="51" class="head1">BD Name</td>
		  <td width="52" class="head1">Bidder Name</td>
		  <td width="67" class="head1">Associated Bank</td>
		  <td width="67" class="head1">Starting Date</td>
		  <td width="82" class="head1">City</td>
          <td width="98" class="head1">Product Type</td>
          <td width="102" class="head1">Maximun Leads</td>
          <td width="92" class="head1">Leads Till Now</td>
          <td width="66" class="head1">Cost/Lead</td>
		   <td width="66" class="head1">Amount Received</td>
		   <td width="66" class="head1">Amount Used</td>
		   <td width="66" class="head1">Amount Left</td>
          </tr>
        <?
	//$qry="select * from Bidders_List where  Restrict_Bidder = 1 and  Multiplier>0";
	/*if($Repy_TypeProduct==-1)
		$qry="select * from Bidders_List, Bidders where  1 = 1 and Bidders.Define_PrePost='PrePaid' ORDER BY `Bidders_List.BidderID` ASC ";
	else 
		$qry="select * from Bidders_List, Bidders where  1 = 1 and Bidders_List.Reply_type = '".$Repy_TypeProduct."' and Bidders.Define_PrePost='PrePaid' ORDER BY `Bidders_List.BidderID` ASC ";
	*/
	if($Repy_TypeProduct==-1)
		$qry="select * from Bidders_List where  1 = 1 ORDER BY `BidderID` ASC ";
	else 
		$qry="select * from Bidders_List where  1 = 1 and Reply_type = '".$Repy_TypeProduct."' ORDER BY `BidderID` ASC ";
	
	
	//echo $qry;
	
	 list($num_rows,$MyRows)=MainselectfuncNew($qry,$array = array());
		$cntr2=0;

		
while($cntr2<count($MyRows))
        {
			//From Bidders_List
			$Bidder_Name = $MyRows[$cntr2]['Bidder_Name'];
			$Reply_Type = $MyRows[$cntr2]['Reply_Type'];
			$BidderID = $MyRows[$cntr2]['BidderID'];
			$Multiplier = $MyRows[$cntr2]['Multiplier'];
			$City = $MyRows[$cntr2]['City'];
			$Restrict_Bidder = $MyRows[$cntr2]['Restrict_Bidder'];	
			
			$CapLead_Count = $MyRows[$cntr2]['CapLead_Count'];	
			$CapLead_CountArray = explode(',', $CapLead_Count);
			
			$search_date="";
			
			$Sql_Bidder = "select Bidder_Name, Associated_Bank, BD_Name, Define_PrePost, Join_Date, Prepaid_Amount from Bidders where BidderID=".$BidderID;
			
			 list($recordcount,$Row_Bidder)=MainselectfuncNew($Sql_Bidder,$array = array());
		$cntr=0;
			
		
			
			
			$expdat = explode(" ",$min_date);
			$expdate = explode("-",$expdat[0]);
			// echo $expdate[1];
			
			$finalminval = date("M y", mktime(0, 0, 0, $expdate[1]+1, 0, $expdate[0]));
			
			$expdatmax = explode(" ",$max_date);
			$expdatemax = explode("-",$expdatmax[0]);
			// echo $expdate[1];
			
			$finalmaxval = date("M y", mktime(0, 0, 0, $expdatemax[1]+1, 0, $expdatemax[0]));
			
			$BillProduct = getReqValue($Reply_Type);
		//$multiplier= $row["Multiplier"];
	$Sql = "select * from Bill_Record where Bill_Sent>=1 and BidderID=$BidderID and  (Bill_Period='".$finalminval."' or Bill_Period='".$finalmaxval."') and Product = '".$BillProduct."'";
//		$Sql = "select * from Bill_Record where Bill_Sent>=1 and BidderID=$BidderID and  Bill_Period='".$finalminval."' ";
 list($Validate,$Arrrow)=MainselectfuncNew($Sql,$array = array());
		$i=0;

		 
		$StoredLeadCount = $Arrrow[$i]['Lead_Volume'];
		$StoredCost_Lead = $Arrrow[$i]['Cost_Lead'];
		$StoredSub_Total = $Arrrow[$i]['Sub_Total'];
		$Invoice_Number = $Arrrow[$i]['Invoice_Number'];
		$Generated_By  = $Arrrow[$i]['Generated_By'];	
		
	?>
	
        <input type='hidden' name='BidderID_<?php echo $z; ?>' value='<?php echo $BidderID; ?>'>
		 <input type='hidden' name='Invoice_<?php echo $z; ?>' value='<?php echo $Invoice_Number; ?>'>
        <input type='hidden' name='Product_<?php echo $z; ?>' value='<?php echo getReqValue($Reply_Type); ?>'>
        <input type='hidden' name='Min_Date' value='<?php echo $min_date; ?>'>
        <input type='hidden' name='Max_Date' value='<?php echo $max_date; ?>'>
     <?php 
	 /*
	 if($Restrict_Bidder==1)
	 	echo "<tr bgcolor=#FFCC00 >";
	else 
		echo "<tr>";*/
	
	
	if($Row_Bidder['Define_PrePost']=='PrePaid')
	{
	?> 
	 
	   <tr   >
		<td class="bodyarial11"><?php $SerialNo = $SerialNo + 1;
		echo $SerialNo; ?> </td>
		 <td  class="bodyarial11"><select name="GeneratedBy_<?php echo $z; ?>" >
              <option value="Priyanka Seth" <?php if($Generated_By=='Priyanka Seth') echo "selected";?>>Priyanka</option>
              <option value="Niharika Arora" <?php if($Generated_By=='Niharika Arora') echo "selected";?>>Niharika</option>
              <option value="Ritika Arora" <?php if($Generated_By=='Ritika Arora') echo "selected";?>>Ritika</option>
            </select> </td>
			<td class="bodyarial11"><?php echo $Row_Bidder['BD_Name']; ?></td>
          
		  <td class="bodyarial11"><?php echo $Row_Bidder['Bidder_Name']; ?> (<?php echo $BidderID; ?>)</td>
		  <td class="bodyarial11"><?php echo $Row_Bidder['Associated_Bank']; ?></td>
		   
		  		  <td class="bodyarial11"><?php echo $Row_Bidder['Join_Date']; ?></td>
		  
		  <td class="bodyarial11"><?php 
		// City
		$ExplodeCity = explode(",", $City);
		echo "<select style='width:110'>";
		for($ii=0;$ii<count($ExplodeCity);$ii++)
			echo "<option>".$ExplodeCity[$ii]."</option>";
		echo "</select>";
		  ?>		  </td>
          <td class="bodyarial11"><?php echo getReqValue($Reply_Type); ?></td>
          <td class="bodyarial11">
            <?php
	 
	 
	echo  "<b>".$CapLead_CountArray[3]."<b>";
	 
			?>	 </td>
		<td>
		<?php
	 $val = getReqValue1($Reply_Type);

		$qry23="SELECT * FROM Req_Feedback_Bidder1,`".$val."` LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID=".$val.".RequestID AND Req_Feedback.BidderID= '".$BidderID."' WHERE Req_Feedback_Bidder1.AllRequestID=`".$val."`.RequestID and Req_Feedback_Bidder1.BidderID = '".$BidderID."' and ".$val.".Dated Between '".($min_date)."' and '".($max_date)."' and  Req_Feedback_Bidder1.Reply_Type = '".$Reply_Type."' ";
		$qry23=$qry23.$FeedbackClause;
		$qry23=$qry23."group by ".$val.".Mobile_Number";
	//echo"hello".$qry23."<br>";
		
		 list($numberofrecords,$getrow2)=MainselectfuncNew($qry23,$array = array());
		$cntr=0;
		
	if($Validate<1)
		echo $numberofrecords = $numberofrecords;
	else
		echo $StoredLeadCount;

		
		?></td><td class="bodyarial11" >
          <?php
	$mul = $Multiplier;
	 
	 $originalAmount = $mul * $numberofrecords;
	 echo $mul ;  
	 
	
	?></td>
	<td><?php 
	$Prepaid_Amount = $Row_Bidder['Prepaid_Amount'];
	if($Prepaid_Amount>0)
		echo $Prepaid_Amount;
	else
		"Not Defined";
	
	?></td>
	<td>
	<?php
	
		echo $StoredLeadCount*$Multiplier;
	
	
	?>
	
	</td>
		<td>
	<?php
	if($Prepaid_Amount>0)
	{
		echo $Prepaid_Amount - ($StoredLeadCount*$Multiplier);
	}
	
	?>
	
	</td>
	   </tr>
        <?	
		//echo "cc".$_REQUEST["count"]."<BR>";
   	}
		$cntr2 = $cntr2 + 1;}
		?>
      </table>
   

 <h3 class="bodyarial11">
   <?
  
 }
 ?>

 </h3>
 </center>
</div>

</body>

</html>