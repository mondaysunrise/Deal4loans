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
	
	
//echo "pppp".$count;

	

	
?>

<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Login</title>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script language="javascript" type="text/javascript" src="scripts/datetimepicker.js"></script>
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
			var arr='Payment_Received_'+index+'N';
			var arr1='Amount_Left_'+index+'N';
			var z=y-x-document.getElementById(arr).value;
			//alert(z);
			document.getElementById(arr1).value=z;	
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
			var arr='Amount_Left_'+index+'N';
			var z=y-x;
			document.getElementById(arr).value=z;
				
	//		frm.submit();
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
 <form name="frmsearch" action="billing_feedback.php?search=y" method="post" onSubmit="return chkform();">
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
       <input name="b12" type="button" class="bluebutton" onClick="javascript:pedirFecha(min_date,'');" value="Select Date">     
        <!--  To <span class="bodyarial11">
         <input name="max_date" type="text" id="max_date" size="15"<? if($max_date=="") { ?>value="<?  echo $D;?>"<? } else { ?>value="<? echo $max_date; ?>" <? }?>>
         <input name="b122" type="button" class="bluebutton" onClick="javascript:pedirFecha(max_date,'');" value="&lt; Insert">
        </span> -->
            <input name="Submit" type="submit" class="bluebutton" value="Search" border="0"></td>
   </tr>
   <tr>
          <td colspan="2" align="center">&nbsp;</td>
     </tr>
   </form>
 </table>
 <p>&nbsp;</p>
	<?
	$search_date="";
	if($search=="y")
	{
		$min_date=$min_date." 00:00:00";
		//$max_date=$max_date." 23:59:59";
		
			$expdat = explode(" ",$min_date);
			$expdate = explode("-",$expdat[0]);
			// echo $expdate[1];
			
			$finalval = date("M y", mktime(0, 0, 0, $expdate[1]+1, 0, $expdate[0]));
		
	?>
	
 
	<form name="EntertoBill" method="post"  action="billing_feedbackSubmit.php">
      <table width="858" border="0" cellpadding="2" cellspacing="1" class="blueborder">
<?
	$search_qry="select * from Bill_Record ";
//	$qry="select * from Bidders_List where  Min_Date>='".$min_date."' and  Max_Date>='".$max_date."' ";
	 $qry="select * from Bill_Record where  Bill_Period='".$finalval."'";
		
		 list($recordcount,$getrow)=MainselectfuncNew($qry,$array = array());
		$cntr=0;
		//$result1=ExecQuery($qry);
		$recordcount = count($getrow);
 ?>
       <tr>
	   	<td width="55" class="head1">Serial No.</td> 
				  <td width="55" class="head1">GeneratedBy</td>
		  <td width="55" class="head1">Invoice Number</td>
          <td width="55" class="head1">Bidder Name</td>
          <td width="102" class="head1">Product Type</td>
          <td width="45" class="head1">Lead Volume</td>
          <td width="86" class="head1">Cost/Lead</td>
          <td width="94" class="head1">Sub Total</td>
          <td width="118" class="head1">Service Tax</td>
          <td width="104" class="head1">Total Amount</td>
		  <td width="111" class="head1">Payment Mode</td>
		  <td width="111" class="head1">Payment Received Date</td>
          <td width="111" class="head1">Payment Received</td>

		  <td width="111" class="head1">TDS</td> 
		  <td width="111" class="head1">Amount Left</td>
        </tr>
		<?php
		
		$Validate = count($getrow);
		$TotalPayment = 0;
		
		
		while($cntr<count($getrow))
        {
			$BID  = $getrow[$cntr]['BID'];
			$Generated_By  = $getrow[$cntr]['Generated_By'];
			$Invoice_Number = $getrow[$cntr]['Invoice_Number'];
			$StoredName = $getrow[$cntr]['Name'];
			$StoredProduct = $getrow[$cntr]['Product'];
			$StoredLeadCount = $getrow[$cntr]['Lead_Volume'];
			$TotalStoredLeadCount = $TotalStoredLeadCount +$StoredLeadCount;
			
			$StoredCost_Lead = $getrow[$cntr]['Cost_Lead'];
			$StoredSub_Total = $getrow[$cntr]['Sub_Total'];		
			$TotalStoredSub_Total = $TotalStoredSub_Total +$StoredSub_Total;
			
			$StoredService_Tax = $getrow[$cntr]['Service_Tax'];
			$TotalStoredService_Tax = $TotalStoredService_Tax +$StoredService_Tax;
			
			$StoredTotal_Amount = $getrow[$cntr]['Total_Amount'];
			$TotalPayment = $TotalPayment +$StoredTotal_Amount;
			$StoredTDS = $getrow[$cntr]['Payment_TDS'];
			
			$Payment_Received = $getrow[$cntr]['Payment_Received'];
			$Payment_Mode = $getrow[$cntr]['Payment_Mode'];
			$Payment_By = $getrow[$cntr]['Payment_By'];
			$Generated_By  = $getrow[$cntr]['Generated_By'];
			$AmtLeft = $StoredTotal_Amount-$Payment_Received-$StoredTDS; 
			$TotalAmtLeft = $TotalAmtLeft +$AmtLeft;
			
		
		?>
		 <tr> 
		 <td class="bodyarial11"><?php $SerialNo = $SerialNo + 1;
		echo $SerialNo; ?> </td>
		<td width="55" class="bodyarial11"><?php echo $Generated_By; ?></td>
		 <td width="55" class="bodyarial11"><strong><?php echo $Invoice_Number; ?></strong></td>
          <td width="55" class="bodyarial11"><?php echo $StoredName; ?></td>
          <td width="102" class="bodyarial11"><?php echo $StoredProduct; ?></td>
          <td width="45" class="bodyarial11"><?php echo $StoredLeadCount; ?></td>
          <td width="86" class="bodyarial11"><?php echo $StoredCost_Lead; ?></td>
          <td width="94" class="bodyarial11"><?php echo $StoredSub_Total; ?></td>
          <td width="118" class="bodyarial11"><?php echo $StoredService_Tax; ?></td>
          <td width="104" class="bodyarial11"><?php echo $StoredTotal_Amount; ?></td>
		  <td width="111" class="bodyarial11">
		  <select name="Payment_By_<?php echo $i; ?>" >
		  <option value="Cheque" <?php if($Payment_By=="Cheque") echo "selected";?>>Cheque</option>
		  <option value="DD" <?php if($Payment_By=="DD") echo "selected";?>>Demand Draft</option>
		  <option value="NT" <?php if($Payment_By=="NT") echo "selected";?>>Net Transfer</option></select>
		  
		   <input type='text' name='Payment_Mode_<?php echo $i; ?>' value='<?php echo $Payment_Mode; ?>' size="15">
		   <input type='hidden' name='min_date' value='<?php echo $min_date; ?>'>
		   <input type='hidden' name='BidderID_<?php echo $i; ?>' value='<?php echo $BID; ?>'>
		  </td>
        
		  <td width="111" class="bodyarial11">
		  <input type="Text"  name="Payment_Date_<?php echo $i; ?>" maxlength="25" size="15" ><a href="javascript:NewCal('Payment_Date_<?php echo $i; ?>','yyyymmdd',false,0)"><img src="images/cal.gif" width="16" height="16" border="0" alt="Pick a date"></a></td>
		  <td width="111" class="bodyarial11"><input type='text' name='Payment_Received_<?php echo $i; ?>N' value='<?php echo $Payment_Received; ?>' size="4" onChange='calculatelead(this.form,this.value,<?php echo $StoredTotal_Amount; ?>,<?php echo $i; ?>)'>
		   </td>
		   <td width="111" class="bodyarial11"><input type='text' name='Payment_TDS_<?php echo $i; ?>N'  size="4" onChange='calculate(this.form,this.value,<?php echo $StoredTotal_Amount; ?>,<?php echo $i; ?>)' value='<?php echo $StoredTDS; ?>'>
		   </td>
		  <td width="111" class="bodyarial11"><input type='text' name='Amount_Left_<?php echo $i; ?>N'  size="4" value="<?php echo $AmtLeft; ?>" readonly></td>
		 
       </tr>
		<?php
		$cntr=$cntr+1; }
		?>
		<tr> 
		<td width="55" class="bodyarial11">&nbsp;</td>
		 <td width="55" class="bodyarial11"></td>
          <td width="55" class="bodyarial11"></td>
          <td width="102" class="bodyarial11"></td>
          <td width="45" class="bodyarial11"><strong><?php echo $TotalStoredLeadCount; ?></strong></td>
          <td width="86" class="bodyarial11"></td>
          <td width="94" class="bodyarial11"><strong><?php echo $TotalStoredSub_Total; ?></strong></td>
          <td width="118" class="bodyarial11"><strong><?php echo $TotalStoredService_Tax; ?></strong></td>
          <td width="104" class="bodyarial11"><strong><?php echo $TotalPayment; ?></strong></td>
		  <td width="55" class="bodyarial11"></td>
          <td width="111" class="bodyarial11"> <input type='hidden' name='RecordCount' value='<?php echo $recordcount; ?>'><input  type="submit" name="submit" value="Submit">
		  </td>
		  <td width="55" class="bodyarial11"></td>
		  <td width="111" class="bodyarial11"><strong><?php echo $TotalAmtLeft; ?></strong></td>
		  </tr>
		</table>
		</form>
		<?php
		}
		?>
		
	

 </h3>
 </center>
</div>

</body>

</html>