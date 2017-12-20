<?php
	require 'scripts/session_checkTM.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

//print_r ($_SESSION);

if(isset($_POST['Submit']))
{
	
	$EntryDate = $_POST['EntryDate'];
	$TCaller_Name = $_POST['TCaller_Name'];
	$TotalEntries = $_POST['TotalEntries'];
	$FinalEntries = $_POST['FinalEntries'];
	$RepeatedEntry = $_POST['RepeatedEntry'];
	$ErrorInEntry = $_POST['ErrorInEntry'];
	$TMU_ID = $_SESSION['TMU_ID'];
	
	
 	//$InsertSql = "INSERT INTO `Telecaller_Mgmt_User_Lms` ( `TMUL_TeleCaller_Name` , `TMUL_EnteredBy` , `TMUL_Date` , `TMUL_TotalEntries` ,  `TMUL_FinalEntries`, `TMUL_RepeatedEntry`, `TMUL_Error` ) VALUES ('".$TCaller_Name."', '".$TMU_ID."', '".$EntryDate."', '".$TotalEntries."', '".$FinalEntries."', '".$RepeatedEntry."', '".$ErrorInEntry."')";
	
	$dataInsert = array("TMUL_TeleCaller_Name"=>$TCaller_Name , "TMUL_EnteredBy"=>$TMU_ID , "TMUL_Date"=>$EntryDate , "TMUL_TotalEntries"=>$TotalEntries , "TMUL_FinalEntries"=>$FinalEntries, "TMUL_RepeatedEntry"=>$RepeatedEntry , "TMUL_Error"=>$ErrorInEntry );
		$table = 'Telecaller_Mgmt_User_Lms';
		$insert = Maininsertfunc ($table, $dataInsert);
	
		//$Query = ExecQuery($InsertSql);
		$ID = mysql_insert_id();	
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


	if (Form.TCaller_Name.selectedIndex==0)
	{
		alert("Please enter TeleCaller Name");
		Form.TCaller_Name.focus();
		return false;
	}

	if(Form.TotalEntries.value=="")
	{
		alert("Kindly fill in Total Entries!");
		Form.TotalEntries.focus();
		return false;
	}
	
	if(Form.FinalEntries.value=="")
	{
		alert("Kindly fill in Final Entries!");
		Form.FinalEntries.focus();
		return false;
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
  <tr><td align="center" width="100%">
 <div align="center">
<TABLE ALIGN="center" WIDTH="50%" CELLPADDING="0" CELLSPACING="0" BORDER="0">
				<TR>
					<TD align="center"><font class="head2">
						Daily Reporting 
					</font></TD>
				</TR>
				<TR>
					<TD align="center"><b>
					&nbsp;
					</b></TD>
				</TR>
				<TR>
					<TD align="center"><b>
						<?php if(isset($ID)) echo "Value Insert"; ?>
					</b></TD>
				</TR>
</TABLE>
<!--  <p class="bodyarial11"><?=$Msg?></p> -->
<FORM NAME="frmTMEntry" action="TMU_Lms.php" method="post" onSubmit="return checkEmptyForAuth(document.frmTMEntry);">
			<TABLE ALIGN="center" WIDTH="50%" CELLPADDING="0" CELLSPACING="0" BORDER="0">
				<TR>
					<TD>
						<FIELDSET CLASS="textfield">
							<LEGEND>
								<FONT SIZE="2" TYPE="Comic Sans"><I>Entry Details:</I></FONT>
							</LEGEND>

								<TABLE WIDTH="50%" ALIGN="center" CELLPADDING="1" CELLSPACING="1" BGCOLOR="#FFFFFF" BORDER="0">
								
								<TR ALIGN="left" VALIGN="middle" BORDERCOLOR="#FFFFFF" BGCOLOR="#FFFFFF">
									<TD NOWRAP></TD>
									<TD NOWRAP>
										<DIV ALIGN="right" CLASS="NormalText">Date:&nbsp;&nbsp; </DIV>
									</TD>                  
									<TD NOWRAP>
									<?php $TDate =  date("Y-m-d", mktime(0, 0, 0, date("m")  , date("d"), date("Y")));?>
										  <input name="EntryDate" type="text" id="EntryDate" size="15" tabindex="6" value="<?php echo $TDate; ?>"> <input name="b12" type="button" class="bluebutton" onClick="javascript:pedirFecha(EntryDate,'');" value="Click">
									</TD>                  
								</TR>
								<TR ALIGN="left" VALIGN="middle" BORDERCOLOR="#FFFFFF">
									<TD NOWRAP></TD>
									<TD NOWRAP>
										<DIV ALIGN="right" CLASS="NormalText">TeleCaller Name:&nbsp;&nbsp;</DIV>
									</TD>
									<TD NOWRAP>
									<?php // if($_SESSION['TMU_ID']<=3) {
									
									 ?>
										<select name="TCaller_Name" class="textfield" tabindex="4">
										<option value="-1">Please Select</option>
									<?php 
										$TSQL = "select * from Telecaller_Mgmt_User where TCallerFlag=1 order by TMU_Name asc";
									
									 list($TCount,$getrow)=MainselectfuncNew($TSQL,$array = array());
		$cntr=0;
									
										//$TQuery = ExecQuery($TSQL);
										//$TCount = mysql_num_rows($TQuery);
										
										
									while($cntr<count($getrow))
										{
											$TeleCallerCode = $getrow[$cntr]['TMU_Name'];
											echo "<option value=".$TeleCallerCode.">".$TeleCallerCode."</option>";
										$cntr = $cntr+1;}
									?>	
									</select>*
								
									</TD>
								</TR>
									
								
								<TR ALIGN="left" VALIGN="middle" BORDERCOLOR="#FFFFFF" BGCOLOR="#FFFFFF">
									<TD WIDTH="10" NOWRAP></TD>
									<TD WIDTH="86" NOWRAP>
										<DIV ALIGN="right" CLASS="NormalText"> 
                Total Entries:&nbsp;</DIV></TD>

									<TD WIDTH="285" NOWRAP>
										<INPUT NAME="TotalEntries" TYPE="text" CLASS="textfield" id="TotalEntries" TABINDEX="1" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)" onChange="intOnly(this)"> 
										*
									</TD>
								</TR>

								<TR ALIGN="left" VALIGN="middle" BORDERCOLOR="#FFFFFF">
									<TD NOWRAP></TD>
									<TD NOWRAP>
										<DIV ALIGN="right" CLASS="NormalText">Final Entries  :&nbsp;&nbsp; </DIV>
									</TD>
									<TD NOWRAP>
									<!-- 	<INPUT NAME="Phone" TYPE="text" CLASS="textfield" TABINDEX="1" maxlength="10"> -->
										<input name="FinalEntries" type="text" class="style4" id="FinalEntries" TABINDEX="2" onChange="intOnly(this);" onKeyPress="intOnly(this)"  onKeyUp="intOnly(this);" size="20" maxlength="10";> 
										*
									<!-- 	<INPUT NAME="txtAuthDegree" TYPE="text" CLASS="textfield" TABINDEX="1"> * -->
									</TD>
								</TR>

								<TR ALIGN="left" VALIGN="middle" BORDERCOLOR="#FFFFFF" BGCOLOR="#FFFFFF">
									<TD NOWRAP></TD>
									<TD NOWRAP>
										<DIV ALIGN="right" CLASS="NormalText">Repeated:&nbsp;&nbsp; </DIV>
									</TD>                  
								  <TD NOWRAP>
								    <INPUT NAME="RepeatedEntry" TYPE="text" CLASS="textfield" id="RepeatedEntry" TABINDEX="3" maxlength="10" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)" onChange="intOnly(this)"></TD>                  
								</TR>
								<TR ALIGN="left" VALIGN="middle" BORDERCOLOR="#FFFFFF" BGCOLOR="#FFFFFF">
									<TD NOWRAP></TD>
									<TD NOWRAP>
										<DIV ALIGN="right" CLASS="NormalText">Error:&nbsp;&nbsp; </DIV>
									</TD>                  
								  <TD NOWRAP>
								    <INPUT NAME="ErrorInEntry" TYPE="text" CLASS="textfield" id="ErrorInEntry" TABINDEX="3" maxlength="10"></TD>                  
			</TR>
								<TR>
									<TD COLSPAN="3" NOWRAP>
										<DIV ALIGN="right">
											<INPUT NAME="Submit" TYPE="submit" CLASS="btnStyle" VALUE="Save" TABINDEX="7">
											<INPUT NAME="Reset" TYPE="reset" CLASS="btnStyle" VALUE="Cancel"  TABINDEX="8">
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
