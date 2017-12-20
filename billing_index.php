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
 <form name="frmsearch" action="billing_index.php?search=y" method="post" onSubmit="return chkform();">
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
	
 	 <form name="EntertoBill" action="billing_confirm.php" method="post" target="_blank" >
	<!-- <form name="EntertoBill" method="post" onSubmit="return HandleOnSubmit('billing_confirm.php')"> -->
      <table width="1000" border="0" cellpadding="2" cellspacing="1" class="blueborder">
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
	
	 list($recordcount,$getrow)=MainselectfuncNew($qry,$array = array());
		$cntr=0;
	
	//$result1=ExecQuery($qry);
	//$recordcount = mysql_num_rows($result1);
 ?>
  
        <tr> 
		<td width="55" class="head1">Serial No.</td> 
		<td width="55" class="head1">GeneratedBy</td>
          <td width="55" class="head1">BD Name</td>
		  <td width="55" class="head1">Bidder Name</td>
		  <td width="55" class="head1">Associated Bank</td>
		  <td width="102" class="head1">City</td>
          <td width="102" class="head1">Product Type</td>
          <td width="45" class="head1">Count</td>
          <td width="86" class="head1">Discount Lead</td>
		  <td width="86" class="head1">Discount Reason</td>
          <td width="94" class="head1">Total Lead</td>
          <td width="118" class="head1">Cost/Lead</td>
          <td width="104" class="head1">Total Amount</td>
		  <td width="104" class="head1">Tax on Amount</td>
		  <td width="104" class="head1">Grand Total</td>
          <td width="111" class="head1">Generate/RePrint</td>
          <td width="111" class="head1">Edit </td>
		 <!--  <td width="111" class="head1">EMail</td> -->
        </tr>
        <?
	//$qry="select * from Bidders_List where  Restrict_Bidder = 1 and  Multiplier>0";
	if($Repy_TypeProduct==-1)
		$qry="select * from Bidders_List where  1 = 1 ORDER BY `BidderID` ASC ";
	else 
		$qry="select * from Bidders_List where  1 = 1 and Reply_type = '".$Repy_TypeProduct."' ORDER BY `BidderID` ASC ";
	
	 list($num_rows,$getrow)=MainselectfuncNew($qry,$array = array());
		$cntr=0;
	
	//	$result=ExecQuery($qry);
		
		// $num_rows = mysql_num_rows($result);
		
	//	$i=1;
		//if($recordcount>0)
	//	{
	//	while($row=mysql_fetch_array($result))
		$SerialNo =0;
		while($cntr<count($getrow))
        {
			$Bidder_Name =$getrow[$cntr]['Bidder_Name'];
			$Reply_Type = $getrow[$cntr]['Reply_Type'];
			$BidderID = $getrow[$cntr]['BidderID'];
			$Multiplier = $getrow[$cntr]['Multiplier'];
			$City = $getrow[$cntr]['City'];	
			$Restrict_Bidder = $getrow[$cntr]['Restrict_Bidder'];	
			$search_date="";
			
			$Sql_Bidder = "select Bidder_Name, Associated_Bank, BD_Name, Define_PrePost, Join_Date from Bidders where BidderID=".$BidderID;
			
			 list($recordcount,$Row_Bidder)=MainselectfuncNew($Sql_Bidder,$array = array());

			//$Query_Bidder = ExecQuery($Sql_Bidder);
			//$Row_Bidder = mysql_fetch_array($Query_Bidder);
			
			
			
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
    	 list($Validate,$getrow)=MainselectfuncNew($Sql,$array = array());
		$cntr2=0;

			
			//$Query = ExecQuery($Sql);
			 //$Validate = mysql_num_rows($Query);
		
			 if($Validate>0)
			 {
				$StoredLeadCount = $getrow[$cntr2]['Lead_Volume'];
				$StoredCost_Lead = $getrow[$cntr2]['Cost_Lead'];
				$StoredSub_Total = $getrow[$cntr2]['Sub_Total'];
				$Invoice_Number = $getrow[$cntr2]['Invoice_Number'];
				$Generated_By  = $getrow[$cntr2]['Generated_By'];	
				$GBID  = $getrow[$cntr2]['BID'];	
				$Discount_Reason  = $getrow[$cntr2]['Discount_Reason'];	
				$Discount_Lead  = $getrow[$cntr2]['Discount_Lead'];	
				$Total_Lead  = $getrow[$cntr2]['Total_Lead'];	
			}
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
		if($Row_Bidder['Define_PrePost']=='PostPaid')
	{
		?> 
	   <tr   >
		<td class="bodyarial11"><?php 
		
		$SerialNo = $SerialNo + 1;
		echo $SerialNo; ?></td> 
		 <td  class="bodyarial11"><select name="GeneratedBy_<?php echo $z; ?>" >
            <!--  <option value="Priyanka Seth" <?php //if($Generated_By=='Priyanka Seth') echo "selected";?>>Priyanka</option>-->
             <!-- <option value="Niharika Arora" <?php //if($Generated_By=='Niharika Arora') echo "selected";?>>Niharika</option> -->
			 <option value="Nidhi Khanna" <?php if($Generated_By=='Nidhi Khanna') echo "selected";?>>Nidhi</option>
			  <option value="Bhavana Jhingan" <?php //if($Generated_By=='Bhavana Jhingan') echo "selected";?>>Bhavana</option>
             <!--<option value="Ritika Arora" <?php //if($Generated_By=='Ritika Arora') echo "selected";?>>Ritika</option> -->
            </select> </td>
			<td class="bodyarial11"><?php echo $Row_Bidder['BD_Name']; ?></td>
          
		  <td class="bodyarial11"><?php echo $Row_Bidder['Bidder_Name']; ?> (<?php echo $BidderID; ?>)</td>
		  <td class="bodyarial11"><?php echo $Row_Bidder['Associated_Bank']; ?></td>
		  
		  
		  
		  <td class="bodyarial11"><?php 
		// City
		$ExplodeCity = explode(",", $City);
		echo "<select style='width:110'>";
		for($ii=0;$ii<count($ExplodeCity);$ii++)
			echo "<option>".$ExplodeCity[$ii]."</option>";
		echo "</select>";
		  ?>
		  </td>
          <td class="bodyarial11"><?php echo getReqValue($Reply_Type); ?></td>
          <td class="bodyarial11">
            <?php
	 
	 $val = getReqValue1($Reply_Type);

		$qry23="SELECT * FROM Req_Feedback_Bidder1,`".$val."` LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID=".$val.".RequestID AND Req_Feedback.BidderID= '".$BidderID."' WHERE Req_Feedback_Bidder1.AllRequestID=`".$val."`.RequestID and Req_Feedback_Bidder1.BidderID = '".$BidderID."' and Req_Feedback_Bidder1. Allocation_Date Between '".($min_date)."' and '".($max_date)."' and  Req_Feedback_Bidder1.Reply_Type = '".$Reply_Type."' ";
		$qry23=$qry23.$FeedbackClause;
		$qry23=$qry23."group by ".$val.".Mobile_Number";
	//echo"hello".$qry23."<br>";
		 list($numberofrecords,$getrow)=MainselectfuncNew($qry23,$array = array());
		$cntr3=0;

		
		
		//$result23=ExecQuery($qry23);
	if($Validate<1)
	{
		echo $numberofrecords = mysql_num_rows($result23);
		?>
		<input type="hidden" name="Total_Lead_<?php echo $z; ?>" value="<?php echo $numberofrecords; ?>">
		<?php
	}
	else
	{	
		if($Total_Lead>0)	
			echo $Total_Lead;
		else
			echo $StoredLeadCount;
			
	}
		?>
	 </td>
		<td>
		<?php
		 $mul = $Multiplier;
		if($Validate<1) {
		 ?>
            <input type='text'  name="extralead_<?php echo $z; ?>N" size="1" onKeyUp='calculatelead(this.form,this.value,<?php echo $numberofrecords; ?>,<?php echo $z; ?>)' onChange='calculatelead(this.form,this.value,<?php echo $numberofrecords; ?>,<?php echo $z; ?>)' > 
            <?php } 
			else {
				if($Discount_Lead>0)
			 		echo $Discount_Lead; 
			 	else
					echo "NA";
			 } 
?></td>
<td>
<?php

		if($Validate<1) {
		 ?>
<input type="text" name="Discount_Reason_<?php echo $z; ?>" size="20">
<?php
} 
else { echo $Discount_Reason; } ?>

</td>

<td class='bodyarial11' ><?php 
     if($Validate<1) {
		 ?>
            <input type='text' size="2" onFocus='initiallead(<?php echo $numberofrecords; ?>,<?php echo $z; ?>)' name='finallead_<?php echo $z; ?>N'  value="<?php echo $numberofrecords; ?>" readonly> 
            <?php }
		else
		echo $StoredLeadCount;
		 ?>
          </td>
          <td class="bodyarial11" >
            <?php
	$mul = $Multiplier;
	 
	 $originalAmount = $mul * $numberofrecords;
	 
	 
	 if($Validate<1) {
		 ?>
            <input type='text' size='1' maxlength='3' name='Variable_<?php echo $z; ?>N' value='<?php echo $mul ; ?>' onChange='calculate(this.form,this.value,<?php echo $numberofrecords; ?>,<?php echo $z; ?>)' onKeyUp="calculate(this.form,this.value,<?php echo $numberofrecords; ?>,<?php echo $z; ?>)" > 
            <?php
	}
	else 
		echo $StoredCost_Lead;
	
	?></td><td><?php
if($Validate<1) {
		 ?>
            <input type='text' onFocus='initial(<?php echo $z; ?>)' name='extra_<?php echo $z; ?>N' id='extra' size='2' value="<?php echo $originalAmount; ?>" onChange=" calculatetax(this.form, this.value, <?php echo $z; ?>)" onKeyDown=" calculatetax(this.form, this.value, <?php echo $z; ?>)" onKeyUp=" calculatetax(this.form, this.value, <?php echo $z; ?>)"> 
            <?php
	}
	else 
		echo $StoredSub_Total;
		?>
	</td>
	<td>
		<input type="text" size='1' name="taxvalue_<?php echo $z; ?>N" value="<?php echo $tax = $originalAmount *10.3 /100; ?>" readonly> 
	
	</td>
	<td>
		<input type="text" size='3' name="grandtotal_<?php echo $z; ?>N" value="<?php echo $grandtotal = $originalAmount + ($originalAmount *10.3 /100); ?>" readonly> 
	
	</td>
	<td>
	<?php

	if($Validate<1)
	{
?>
            <input  type="submit" name="submit" value="Submit_<?php echo $z; ?>"> 
            <?php }
else {
		
		// if($Validate>1)
	//	 {
		 	for($a=0;$a<$Validate;$a++)
			{
				$BID  = mysql_result($Query,$a,'BID');
				$Bill_Period  = mysql_result($Query,$a,'Bill_Period');
				
				echo "<a href='billing_reprint.php?BID=".$BID."' target='_blank' >[ ".$Bill_Period." ]</a>";
			}
				
		// }

?>
         <!--    <input  type="submit" name="submit" value="RePrint_<?php //echo $z; ?>">  -->
            <?php }
?>
          </td>
          <td> 
            <?php
	if($Validate>=1)
	{
?>

            <input  type="submit" name="submit" value="Edit_<?php echo $z; ?>"> 
            <?php }

?>
          </td>
		<!-- 
		       <td> 
            <?php
//	if($Validate>=1)
	//{
?>

           <a href="billing_email.php?billno=<?php //echo $Invoice_Number; ?>&BID=<?php //echo $GBID; ?>&Bidder_ID=<?php //echo $BidderID; ?>" target="_blank">Email This</a>
            <?php// }

?>
          </td> -->
		  
        </tr>
        <?	
		//echo "cc".$_REQUEST["count"]."<BR>";
   	
		}
		$cntr = $cntr + 1;
		}
		?>
        <?php //	}
	?>
      </table>
    </form>

 <h3 class="bodyarial11">
   <?
 }
 ?>

 </h3>
 </center>
</div>

</body>

</html>