<?php
require 'scripts/session_checkTM.php';
//	session_start();
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

//print_r ($_SESSION);

if(isset($_POST['Submit']))
{
	$CalledName = $_POST['CalledName'];
	$Phone = $_POST['Phone'];
	$Email = $_POST['Email'];
	$Card_Type = $_POST['Card_Type'];
	$Pancard = $_POST['Pancard'];
	$Pincode = $_POST['Pincode'];
	$TCaller_Name = $_POST['TCaller_Name'];
	$TMU_ID = $_SESSION['TMU_ID'];
	$EntryDate = $_POST['EntryDate'];
	$Source = $_POST['Source'];
	
	$CheckSqlPincode = "select PincodeID from TMU_Pincode  where Pincode=".$Pincode;
	//echo $CheckSqlPincode."<br>";
	$CheckPincodeResult = ExecQuery($CheckSqlPincode);
	$NumRowsPincode= mysql_num_rows($CheckPincodeResult);


	$CheckSqlPhone = "select TME_ID from Telecaller_Mgmt_Entry  where TME_Mobile =".$Phone;
	$CheckPhoneResult = ExecQuery($CheckSqlPhone);
	$NumRowsPhone = mysql_num_rows($CheckPhoneResult);
	
	$CheckSqlPan = "select TME_ID from Telecaller_Mgmt_Entry  where  TME_Pancard ='".$Pancard."' ";
	$CheckPanResult = ExecQuery($CheckSqlPan);
	$NumRowsPan = mysql_num_rows($CheckPanResult);
	
	$CheckSqlBoth = "select TME_ID from Telecaller_Mgmt_Entry  where TME_Mobile ='".$Phone."' and TME_Pancard ='".$Pancard."' ";
	$CheckBothResult = ExecQuery($CheckSqlBoth);
	$NumRowsBoth = mysql_num_rows($CheckBothResult);
	
	if($NumRowsBoth>0)
	{
		
		$msg = "Duplicate Phone and Pancard";
		$row = mysql_fetch_array($CheckBothResult);
		$ID = $row['TME_ID'];
	}

	else if($NumRowsPan>0)
	{
		
		$row = mysql_fetch_array($CheckPanResult);
		$ID = $row['TME_ID'];
		$msg = "Duplicate Pancard";
	}
	elseif($NumRowsPincode==0)
	{
		$msg="Invalid entry via Pincode";
	}
	else
	{
		
	    $InsertSql = "INSERT INTO `Telecaller_Mgmt_Entry` ( `TME_Name` , `TME_Mobile` , `TME_Pancard` , `TME_TCaller_Name` ,  `TMU_ID`, `TME_TCEntryDate`, `TME_InitialDate`,`TME_Source`, `TME_Product_Type`, `TME_Card_Type`,`TME_Pincode` ) VALUES ('".$CalledName."', '".$Phone."', '".$Pancard."', '".$TCaller_Name."', '".$TMU_ID."', '".$EntryDate."', Now(), '".$Source."', '".$Email."', '".$Card_Type."','".$Pincode."')";
		$Query = ExecQuery($InsertSql);
		$ID = mysql_insert_id();
		$msg = "Value Insert";

		//$Checktosend="getUser_Register_New";
					/*include "scripts/commonicicicardmailer.php";

					$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
					$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
					$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
					//echo $Type_Loan;

					if(isset($Card_Type))
					{
						mail($Email,'Next step for your card application -Deal4loans', $message, $headers);
					}*/
	}
	
	
}

?>

<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=WINDOWS-1252">
<title>Login</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>

<script Language="JavaScript" Type="text/javascript" >
function containsalph(param)
{
	mystrLen = param.length;
	for(i=0;i<mystrLen;i++)
	{
		if((param.charAt(i)<"0")||(param.charAt(i)>"9"))
		{
			return true;
		}
	}
	return false;
}
function containsdigit(param)
{
	mystrLen = param.length;
	for(i=0;i<mystrLen;i++)
	{
		if((param.charAt(i)=="0") || (param.charAt(i)=="1") || (param.charAt(i)=="2") || (param.charAt(i)=="3") || (param.charAt(i)=="4") || (param.charAt(i)=="5") || (param.charAt(i)=="6") || (param.charAt(i)=="7") || (param.charAt(i)=="8") || (param.charAt(i)=="9") || (param.charAt(i)=="/"))
		{
			return true;
		}
	}
	return false;
}
function poptastic(url)
{
	newwindow=window.open(url,'name','height=100,width=500');
	if (window.focus) {newwindow.focus()}
}
   

function checkEmptyForAuth(Form)
{
	var btn2;
	var btn3;
	var myOption;
	var i;
	var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
	var dt,mdate;dt=new Date();
	
	var alpha=/^[a-zA-Z\ ]*$/;
	var alphanum=/^[a-zA-Z0-9]*$/;
	var num=/^[0-9]*$/;
	var space=/^[\ ]*$/;
	var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";
	
	if(Form.CalledName.value=="")
	{
		alert("Kindly fill in your Name!");
		Form.CalledName.focus();
		return false;
	}
	else if(containsdigit(Form.CalledName.value)==true)
	{
		alert("Name contains numbers!");
		Form.CalledName.focus();
		return false;
	}
    for (var i = 0; i < Form.CalledName.value.length; i++) 
	{
		if (iChars.indexOf(Form.CalledName.value.charAt(i)) != -1) 
		{
			alert ("Name has special characters.\n Please remove them and try again.");
			Form.CalledName.focus();
			return false;
	  	}
    }
	if(Form.Email.value== "" )
	{
		alert("Kindly fill in your Email!");
		Form.Email.focus();
		return false;
	}
	
	if((Form.Phone.value=='Mobile') || (Form.Phone.value==''))
	{
		alert("Kindly fill in your Mobile Number!");
		Form.Phone.focus();
		return false;
	}

	if (Form.Phone.value.length < 10 )
	{
			alert("Please Enter 10 Digits"); 
			 Form.Phone.focus();
			return false;
	}
	if (Form.Phone.value.charAt(0)!="9")
	{
			alert("The number should start only with 9");
			Form.Phone.focus();
			return false;
	}
	
	if(Form.Pancard.value== "" )
	{
		alert("Kindly fill in your Pancard Number!");
		Form.Pancard.focus();
		return false;
	}
		if(Form.Pincode.value== "" )
	{
		alert("Kindly fill in your Pincode !");
		Form.Pincode.focus();
		return false;
	}	
	if (Form.TCaller_Name.selectedIndex==0)
	{
		alert("Please enter TeleCaller Name");
		Form.TCaller_Name.focus();
		return false;
	}
	
	if (Form.Source.selectedIndex==0)
	{
		alert("Please enter Source");
		Form.Source.focus();
		return false;
	}
	if (Form.Card_Type.selectedIndex==0)
	{
		alert("Please enter Card Type");
		Form.Card_Type.focus();
		return false;
	}
	if((Form.TCaller_Name.value=="" ) || (Form.TCaller_Name.value=="TeleCaller Name")|| (Trim(Form.TCaller_Name.value))==false)
	{
		alert("Kindly fill in  TeleCaller Name!");
		Form.TCaller_Name.focus();
		return false;
	}
	else if(containsdigit(Form.TCaller_Name.value)==true)
	{
		alert("Name contains numbers!");
		Form.TCaller_Name.focus();
		return false;
	}
    for (var i = 0; i < Form.TCaller_Name.value.length; i++) 
	{
		if (iChars.indexOf(Form.TCaller_Name.value.charAt(i)) != -1) 
		{
			alert ("Name has special characters.\n Please remove them and try again.");
			Form.TCaller_Name.focus();
			return false;
	  	}
    }
	
	
	
	
}



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

	</script>
	<script Language="JavaScript" Type="text/javascript">
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


	function checkpincode()
		{
			
			var new_Pincode = document.getElementById('Pincode').value;
					
			//alert (new_Pincode);
			
			if((new_Pincode!=""))
			{
				var queryString = "?Pincode=" + new_Pincode ;
				//alert(queryString); 
				
				ajaxRequest.open("GET", "checkpincodevalidity.php" + queryString, true);
				// Create a function that will receive data sent from the server
				ajaxRequest.onreadystatechange = function(){
					if(ajaxRequest.readyState == 4)
					{
						var ajaxDisplay = document.getElementById('checkdiv');
						ajaxDisplay.innerHTML = ajaxRequest.responseText;
										
					}
				}

				ajaxRequest.send(null); 
			 }
			
		
		}

	window.onload = ajaxFunction;

		</script>
<link href="includes/style1.css" rel="stylesheet" type="text/css">
<link href="style.css" rel="stylesheet" type="text/css" />

<?php include '~TopTM.php';?>


  <!-- End Main Banner Menu Panel -->
  <!-- Start Main Container Panel -->
  <div id="dvContentPanel">
   <div id="dvMaincontent">

 <br>
 <br>
  <table width="712" border="0">
 <tr><td align="center">
 <?php
 			$ResSql = "select  TME_ID from Telecaller_Mgmt_Entry  where  TMU_ID='".$_SESSION['TMU_ID']."'";
			$Res = ExecQuery($ResSql);
			$NumRow = mysql_num_rows($Res);
			echo "<strong>".$NumRow."</strong> Entries done by ".$_SESSION['Name'] ;
 ?>
 </td></tr>
  <tr><td align="center">
 <?php
 			$today = date("Y-m-d");
			$getDate = $today." 00:00:00";
 			$ResSql = "select  TME_ID from Telecaller_Mgmt_Entry  where  TMU_ID='".$_SESSION['TMU_ID']."' and TME_Date > '".$getDate."'";
			$Res = ExecQuery($ResSql);
			$NumRow = mysql_num_rows($Res);
			echo "<strong>".$NumRow."</strong> Entries done by ".$_SESSION['Name']." Today" ;
 ?>
 </td></tr>
 <!--<tr><td align="center" class="bodyarial11"><? //echo $msg?></td></tr> -->
 <tr><td align="center" width="100%">
 <div align="center">


<FORM NAME="frmTMEntry" action="TMU_Entry.php" method="post" onSubmit="return checkEmptyForAuth(document.frmTMEntry);">
			<TABLE ALIGN="center" WIDTH="50%" CELLPADDING="0" CELLSPACING="0" BORDER="0">
				<TR>
					<TD>
						<FIELDSET CLASS="textfield">
							<LEGEND>
								<FONT SIZE="2" TYPE="Comic Sans"><I>User Details:</I></FONT>
							</LEGEND>

								<TABLE WIDTH="50%" ALIGN="center" CELLPADDING="1" CELLSPACING="1" BGCOLOR="#FFFFFF" BORDER="0">
								<TR ALIGN="left" VALIGN="middle" BORDERCOLOR="#FFFFFF" BGCOLOR="#FFFFFF">
									<TD WIDTH="10" NOWRAP></TD>
									<TD WIDTH="86" NOWRAP>
										<DIV ALIGN="right" CLASS="NormalText"> 
                Name:&nbsp;</DIV></TD>

									<TD WIDTH="285" NOWRAP>
										<INPUT NAME="CalledName" TYPE="text" CLASS="textfield" TABINDEX="1" ><font size="1" color="#FF0000">*</font>
									</TD>
								</TR>
								<TR ALIGN="left" VALIGN="middle" BORDERCOLOR="#FFFFFF" BGCOLOR="#FFFFFF">
									<TD NOWRAP></TD>
									<TD NOWRAP>
										<DIV ALIGN="right" CLASS="NormalText">Email Id:&nbsp;&nbsp; </DIV>
									</TD>                  
									<TD NOWRAP>
										<INPUT NAME="Email" TYPE="text"  CLASS="textfield" TABINDEX="2"><font size="1" color="#FF0000">*</font>
									</TD>                  
								</TR>

								<TR ALIGN="left" VALIGN="middle" BORDERCOLOR="#FFFFFF">
									<TD NOWRAP></TD>
									<TD NOWRAP>
										<DIV ALIGN="right" CLASS="NormalText">Mobile 
                No. :&nbsp;&nbsp; </DIV>
									</TD>
									<TD NOWRAP>
									<!-- 	<INPUT NAME="Phone" TYPE="text" CLASS="textfield" TABINDEX="1" maxlength="10"> -->
										<input size="20" type="text" onChange="intOnly(this);" maxlength="10"  onKeyUp="intOnly(this);" onKeyPress="intOnly(this)"; class="style4" name="Phone" TABINDEX="3"><font size="1" color="#FF0000">*</font>
									<!-- 	<INPUT NAME="txtAuthDegree" TYPE="text" CLASS="textfield" TABINDEX="1"> * -->
									</TD>
								</TR>

								<TR ALIGN="left" VALIGN="middle" BORDERCOLOR="#FFFFFF" BGCOLOR="#FFFFFF">
									<TD NOWRAP></TD>
									<TD NOWRAP>
										<DIV ALIGN="right" CLASS="NormalText">PanCard:&nbsp;&nbsp; </DIV>
									</TD>                  
									<TD NOWRAP>
										<INPUT NAME="Pancard" TYPE="text" maxlength="10" CLASS="textfield" TABINDEX="4"><font size="1" color="#FF0000">*</font>
									</TD>                  
								</TR>
<TR ALIGN="left" VALIGN="middle" BORDERCOLOR="#FFFFFF" BGCOLOR="#FFFFFF">
									<TD NOWRAP></TD>
									<TD NOWRAP>
										<DIV ALIGN="right" CLASS="NormalText">Pincode:&nbsp;&nbsp; </DIV>
									</TD>                  
									<TD NOWRAP>
										<INPUT NAME="Pincode" id="Pincode"  TYPE="text" maxlength="6" CLASS="textfield" TABINDEX="5" onchange='checkpincode();'><font size="1" color="#FF0000">*</font><div id="checkdiv" ></div>
									</TD>                  
								</TR>
								<!--<TR ALIGN="left" VALIGN="middle" BORDERCOLOR="#FFFFFF" BGCOLOR="#FFFFFF">
									<TD NOWRAP colspan="3" >								
									
									</TD>                  
								</TR>-->
								<TR ALIGN="left" VALIGN="middle" BORDERCOLOR="#FFFFFF">
									<TD NOWRAP></TD>
									<TD NOWRAP>
										<DIV ALIGN="right" CLASS="NormalText">TeleCaller Name:&nbsp;&nbsp;</DIV>
									</TD>
									<TD NOWRAP>
									<?php // if($_SESSION['TMU_ID']<=3) {
									
									 ?>
										<select name="TCaller_Name" class="textfield" tabindex="6" onchange='checkpincode();'>
										<option value="-1">Please Select</option>
									<?php 
										$TSQL = "select * from Telecaller_Mgmt_User where TCallerFlag=1 order by TMU_Name asc";
										$TQuery = ExecQuery($TSQL);
										$TCount = mysql_num_rows($TQuery);
										
										for($i=0;$i<$TCount;$i++)
										{
											$TeleCallerCode = mysql_result($TQuery,$i,'TMU_Name');
											?><option value="<? echo $TeleCallerCode; ?>" ><? echo $TeleCallerCode?></option>
										<?}
									?>	
									</select>*
								
										<?php //} else {?>
										<!-- <INPUT NAME="TCaller_Name" TYPE="text" CLASS="textfield" TABINDEX="4"> *  -->
										<?php //} ?>
									</TD>
								</TR>
									
								<TR ALIGN="left" VALIGN="middle" BORDERCOLOR="#FFFFFF" BGCOLOR="#FFFFFF">
									<TD NOWRAP></TD>
									<TD NOWRAP>
										<DIV ALIGN="right" CLASS="NormalText">Source:&nbsp;&nbsp; </DIV>
									</TD>                  
									<TD NOWRAP>
									<select name="Source" class="textfield" tabindex="7">
										<option value="-1">Please Select</option>
										<option value="D4L">D4L</option>
										<option value="CitiBank">CitiBank</option>
										<option value="Times">Times</option>
										<option value="PL">PL</option>
										<option value="HL">HL</option>
										<option value="Reference">Reference</option>
										<option value="Justdial">Justdial</option>
											</select>
									</TD>                  
								</TR>
								<TR ALIGN="left" VALIGN="middle" BORDERCOLOR="#FFFFFF" BGCOLOR="#FFFFFF">
									<TD NOWRAP></TD>
									<TD NOWRAP>
										<DIV ALIGN="right" CLASS="NormalText">Type Of Card </DIV>
									</TD>                  
									<TD NOWRAP>
									<select name="Card_Type" class="textfield" tabindex="8">
										<option value="-1">Please Select</option>
										<option value="American_Express_Card">American Express Card</option>
										<option value="Future_Gold_Card">Future Gold Card</option>
										<option value="HPCL_Gold_Card">HPCL Gold Card</option>
										<option value="Indiatimes_Card">Indiatimes Card</option>
										<option value="HPCL_Silver_Card">HPCL Silver Card</option>
										<option value="Kingfisher_Card">Kingfisher Card</option>
										<option value="Big_Bazar_Card">Big Bazar Card</option>
										<option value="Preferred_Card">Preferred Card</option>
										<option value="EMI_Card">EMI Card</option>
										<option value="Platinum_Card">Platinum Card</option>
										<option value="Titanium_Card">Titanium Card</option>
										
											</select>
									</TD>                  
								</TR>
								
									<TR ALIGN="left" VALIGN="middle" BORDERCOLOR="#FFFFFF" BGCOLOR="#FFFFFF">
									<TD NOWRAP></TD>
									<TD NOWRAP>
										<DIV ALIGN="right" CLASS="NormalText">Date:&nbsp;&nbsp; </DIV>
									</TD>                  
									<TD NOWRAP>
									<?php $TDate =  date("Y-m-d", mktime(0, 0, 0, date("m")  , date("d")-1, date("Y")));?>
										  <input name="EntryDate" type="text" id="EntryDate" size="15" tabindex="9" value="<?php echo $TDate; ?>"> <input name="b12" type="button" class="bluebutton" onClick="javascript:pedirFecha(EntryDate,'');" value="Click">
									</TD>                  
								</TR>

								<TR>
									<TD COLSPAN="3" NOWRAP>
										<DIV ALIGN="right">
											<INPUT NAME="Submit" TYPE="submit" CLASS="btnStyle" VALUE="Save" TABINDEX="10">
											<INPUT NAME="Reset" TYPE="reset" CLASS="btnStyle" VALUE="Cancel"  TABINDEX="11">
										</DIV>
									</TD>
								</TR>
							</TABLE>
						</FIELDSET>
					</TD>
				</TR>

				<TR>
					<TD ALIGN="center">
						<DIV ID="2" ALIGN="top"></DIV>
					</TD>
				</TR>
			</TABLE>
		</FORM>
	<?php
		if(isset($msg))
		{
			
			$ResultSql = "select * from Telecaller_Mgmt_Entry  where  TME_ID ='".$ID."' ";
			$Result = ExecQuery($ResultSql);
			//$NumRows = mysql_num_rows($Result);
			 $Update_ID = mysql_result($Result,0,'TME_ID');
			
	?>
		<table  cellpadding="4" cellspacing="1" class="blueborder" width="60%">
		<tr>
			<td colspan="4" align="center"><strong><?php echo $msg; ?></strong></td>
		</tr>
		<tr>
			<td class="head1">Name</td>
			<td class="head1">Mobile</td>
			<td class="head1">Pancard</td>
			<td class="head1">TeleCaller_Name</td>
		</tr>
		<tr>
			<td class="bodyarial11"><?php echo mysql_result($Result,0,'TME_Name'); ?></td>
			<td class="bodyarial11"><?php echo mysql_result($Result,0,'TME_Mobile'); ?></td>
			<td class="bodyarial11"><?php echo mysql_result($Result,0,'TME_Pancard'); ?></td>
			<td class="bodyarial11"><?php echo mysql_result($Result,0,'TME_TCaller_Name'); ?></td>
		</tr>
	<?php if($msg=="Duplicate Phone and Pancard" || $msg=="Duplicate Pancard") { ?>
		<tr><td class="bodyarial11"><strong>Date of Entry</strong>: </td><td colspan="3" class="bodyarial11"><?php echo mysql_result($Result,0,'TME_Date'); ?></td></tr>
<?php } else { ?>


		<tr><td class="bodyarial11"><strong>Date of Entry</strong>: </td><td colspan="3" class="bodyarial11"><?php echo mysql_result($Result,0,'TME_InitialDate'); ?></td></tr>
		<?php } ?>
			<tr><td class="bodyarial11"><strong>Unique Bank ID</strong>: </td><td colspan="3" class="bodyarial11"><?php echo mysql_result($Result,0,'TME_UniqueID'); ?></td></tr>
	<?php
	$UniqueID=mysql_result($Result,0,'TME_UniqueID');
	
	 ?>
			<tr><td class="bodyarial11" colspan="3"><strong>Click the Button to update</strong>: </td><td  class="bodyarial11">
			
			<a href="javascript:poptastic('TMU_UpdateBankID.php?ID=<?php echo $Update_ID; ?>&EnteredByID=<?php echo $_SESSION['TMU_ID']; ?>');">Update Bank ID</a>
			</td></tr>
			<?php   ?>
		</table>
		<?php
		}
		?>
 <br>
 
 <br>

 <h3 class="bodyarial11">

    </div>
 </td></tr></table>
  </div>
   </div>
<?php //include '~Bottom.php';?>


</body>

</html>
