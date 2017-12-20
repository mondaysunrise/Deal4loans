<?php
//session_start();
	require 'scripts/session_check_online.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

	$FeedbackClause="";
	//$OrderBy=" order by Req_Credit_Card.Dated desc";

echo $_SESSION["Conflictbidder"]."<br>";
$capcount=$_SESSION["CapLead_Count"];
 $bidderquery=$_SESSION["bidquery"];
 $tablename=$_SESSION["tablename"];


  function getReqCode($pKey){
    $titles = array(
        'Req_Loan_Personal' => '1',
        'Req_Loan_Home' => '2',
        'Req_Loan_Car' => '3',
        'Req_Credit_Card' => '4',
        'Req_Loan_Against_Property' => '5',
        'Req_Business_Loan' => '6'
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

	$varCmbFeedback="";
	if(isset($_REQUEST['cmbfeedback']))
	{
		$varCmbFeedback=$_REQUEST['cmbfeedback'];
	}
	echo $varCmbFeedback;

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

$bidder_query="";
	if(isset($_REQUEST['bidder_query']))
	{
		$bidder_query=$_REQUEST['bidder_query'];
	}

	$bidder_city="";
	if(isset($_SESSION["bidcity"]))
	{
		$bidder_city=trim($_SESSION["bidcity"]);
		
		$oldcity = explode(",",$bidder_city);
		$newcity = implode ("','",$oldcity) ;
			//echo $newcity."<br>";
			$propercity="('".$newcity."')";
	}

	$table_name="";
	if(isset($_REQUEST['table_name']))
	{
		$table_name=$_REQUEST['table_name'];
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
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Login</title>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<link href="includes/style1.css" rel="stylesheet" type="text/css">
<link href="style.css" rel="stylesheet" type="text/css" />

<?php include '~Top.php';?>


<div id="dvMainbanner">
    <?php include '~Upper.php';?>
    <div id="dvbannerContainer"> <img src="images/main_banner1.gif" /> </div>
  </div>
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
	document.frmsearch.action="leadallocation_index.php?search=y"+gifName;
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
	if(document.frmsearch.min_date.value<"2008-01-01")
	{
		alert("Sorry!!!! Your minimum date is 2008-01-01.Please Select.");
		document.frmsearch.min_date.value="";
		document.frmsearch.min_date.focus();
		return false;
	}
	
	
}

function MM_jumpMenu(targ,selObj,restore){ //v3.0
 eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
 if (restore) selObj.selectedIndex=0;
}
</script>
 </form>
 <br>
 <br>
 <table width="712" border="0">
 <tr><td align="center" width="100%">
 <div align="center">
 <table width="600" border="0" cellpadding="4" cellspacing="1" class="blueborder">
 <form name="frmsearch" action="leadallocation_index.php?search=y" method="post" onSubmit="return chkform();">
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
       <input name="min_date" type="text" id="min_date" size="15" <? if($min_date=="") { ?>value="2008-06-01"<? } else { ?>value="<? echo $min_date; ?>" <? }?>>
       <input name="b12" type="button" class="bluebutton" onClick="javascript:pedirFecha(min_date,'');" value="&lt; Insert">     
         To <span class="bodyarial11">
         <input name="max_date" type="text" id="max_date" size="15" value="<? echo $max_date; ?>">
         <input name="b122" type="button" class="bluebutton" onClick="javascript:pedirFecha(max_date,'');" value="&lt; Insert">
        </span></td>
   </tr>
   <tr>
   <td colspan="2">
   <table width="100%"><tr>
     <td><strong>Feedback:</strong></td>
     <td >
		<select name="cmbfeedback" id="cmbfeedback">
			<option value="All" <? if($varCmbFeedback == "All") { echo "selected"; } ?>>All</option>
			<option value="" <? if($varCmbFeedback == "") { echo "selected"; } ?>>No Feedback</option>
			<option value="Send Now" <? if($varCmbFeedback == "Send Now") { echo "selected"; } ?>>Send Now</option>
			<option value="Not Eligible" <? if($varCmbFeedback == "Not Eligible") { echo "selected"; } ?>>Not Eligible</option>
			<option value="Not Interested" <? if($varCmbFeedback == "Not Interested") { echo "selected"; } ?>>Not Interested</option>
			<option value="Callback Later" <? if($varCmbFeedback == "Callback Later") { echo "selected"; } ?>>Callback Later</option>
			<option value="Wrong Number" <? if($varCmbFeedback == "Wrong Number") { echo "selected"; } ?>>Wrong Number</option>
			<option value="Closed" <? if($varCmbFeedback == "Closed") { echo "selected"; } ?>>Closed</option>
			<option value="Duplicate" <? if($varCmbFeedback == "Duplicate") { echo "selected"; } ?>>Duplicate</option>
		</select>
	 </td>
	 
     <td><strong>Product </strong></td>
     <td>
	 <select name="product">
	 <option value="-1" selected>Please select</option>
	 <option value="Req_Loan_Personal" <? if($_REQUEST['product']=="Req_Loan_Personal") { ?> selected <? } ?>>Personal Loan</option>
	 <option value="Req_Loan_Home" <? if($_REQUEST['product']=="Req_Loan_Home") { ?> selected <? } ?>>Home Loan</option>
 	 <option value="Req_Loan_Car" <? if($_REQUEST['product']=="Req_Loan_Car") { ?> selected <? } ?>>Car Loan</option>
 	 <option value="Req_Loan_Against_Property" <? if($_REQUEST['product']=="Req_Loan_Against_Property") { ?> selected <? } ?>>LAP</option>
	 <option value="Req_Credit_Card" <? if($_REQUEST['product']=="Req_Credit_Card") { ?> selected <? } ?>>Credit Card</option>
	 <option value="Req_Business_Loan" <? if($_REQUEST['product']=="Req_Business_Loan") { ?> selected <? } ?>>Business Loan</option>
	 </select>
	 </td>
 
	 </tr><tr><td><input type="hidden" name="bidder_query" id="bidder_query" value="<? echo $_SESSION["bidquery"];?>"><input type="hidden" name="table_name" id="table_name" value="<? echo $tablename;?>"><input type="hidden" name="bidder_city" id="bidder_city" value="<? echo $_SESSION["bidcity"];?>"></td></tr>
	 </table>
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
		$FBidderID= $_SESSION["bidderid"];
		$mvarType=getReqCode($tablename);
		if($Feedback=="Send Now")
		{
			$TodayYear = date('Y');
		$TodayMonth = date('m');
		$TodayWeek = date('W');
		$TodayDay = date('d');
	$ExplodeCapLead = explode(",", $capcount);
	$CapDay = $ExplodeCapLead[0];
	$CapWeek = $ExplodeCapLead[1];
	$CapMonth = $ExplodeCapLead[2];
	$CapLifeTime = $ExplodeCapLead[3];
	$TodayDate = date("Y-m-d");

	 $CheckDateSql = "select sum(BookLeadCount) as SumDay from Bidders_Book_Keeping where BidderID = ".$FBidderID." and BookDate = ".$TodayDay." and BookProduct='".$mvarType."'  and  BookMonth = ".$TodayMonth." and  BookYear= ".$TodayYear." ";
	 //echo "query for day".$CheckDateSql."<br>";
	$CheckDateQuery = ExecQuery($CheckDateSql);
	$row_result_D=mysql_fetch_array($CheckDateQuery);
	$DayCount = $row_result_D['SumDay'];
	
	$CheckWeekSql = "select sum(BookLeadCount) as SumWeek from Bidders_Book_Keeping where BidderID = ".$FBidderID." and BookWeek = ".$TodayWeek." and BookProduct='".$mvarType."' and  BookYear= ".$TodayYear." ";
	//echo "query for day".$CheckWeekSql."<br>";
	$CheckWeekQuery = ExecQuery($CheckWeekSql);
	$row_result_W=mysql_fetch_array($CheckWeekQuery);
	$Total4Week = $row_result_W['SumWeek'];
	
	$CheckMonthSql = "select sum(BookLeadCount) as SumMonth from Bidders_Book_Keeping where BidderID = ".$FBidderID." and BookMonth = ".$TodayMonth." and BookProduct='".$mvarType."' and  BookYear= ".$TodayYear." ";
	//echo "query for day".$CheckMonthSql."<br>";
	$CheckMonthQuery = ExecQuery($CheckMonthSql);
	$row_result_M=mysql_fetch_array($CheckMonthQuery);
	$Total4Month = $row_result_M['SumMonth'];
	$CheckLifeTimeSql = "select sum(BookLeadCount) as SumLifeTime from Bidders_Book_Keeping where BidderID = ".$FBidderID." and BookProduct='".$mvarType."'";
	//echo "query for day".$CheckLifeTimeSql."<br>";
	$CheckLifeTimeQuery = ExecQuery($CheckLifeTimeSql);
	$row_result_LT=mysql_fetch_array($CheckLifeTimeQuery);
	$Total4LifeTime = $row_result_LT['SumLifeTime'];

	
		//Start Check for Day Cap Lead
		if(($CapDay!=0 && $CapDay!='' && $DayCount<$CapDay) || $CapDay==0 || $CapDay=="NULL")
		{
			//echo "(if)DayCount : ".$DayCount." CapDay : ". $CapDay; echo "<br>";
			$ValidBidder_Day = 1;
		}
		else
		{
			$ValidBidder_Day = 0;
				//echo "(else)DayCount : ".$DayCount." CapDay : ". $CapDay;echo "<br>";
		}
		//End Check for Day Cap Lead
		//Start Check for Week Cap Lead
		if(($CapWeek!=0 && $CapWeek!='' && $Total4Week<$CapWeek) || $CapWeek==0  || $CapWeek=="NULL")
		{
			//echo "(if)Total4Week : ".$Total4Week." CapWeek : ". $CapWeek;echo "<br>";
			$ValidBidder_Week = 1;
		}
		else
		{
			//echo "(else)Total4Week : ".$Total4Week." CapWeek : ". $CapWeek;echo "<br>";
			$ValidBidder_Week = 0;
		}
		//End Check for Week Cap Lead
		//Start Check for Month Cap Lead
		if(($CapMonth!=0 && $CapMonth!='' && $Total4Month<$CapMonth) || $CapMonth==0  || $CapMonth=="NULL")
		{
			//echo "(if)Total4Month : ".$Total4Month." CapMonth : ". $CapMonth;echo "<br>";
			$ValidBidder_Month = 1;
		}
		else
		{
			//echo "(else)Total4Month : ".$Total4Month." CapMonth : ". $CapMonth;echo "<br>";
			$ValidBidder_Month = 0;
		}
		//End Check for Month Cap Lead
		//Start Check for LifeTime Cap Lead
		if(($CapLifeTime!=0 && $CapLifeTime!='' && $Total4LifeTime<$CapLifeTime) || $CapLifeTime==0  || $CapLifeTime=="NULL")
		{
			//echo "(if)Total4LifeTime : ".$Total4LifeTime." CapLifeTime : ". $CapLifeTime;echo "<br>";
			$ValidBidder_LT = 1;
		}
		else
		{
			//echo "(else)Total4LifeTime : ".$Total4LifeTime." CapLifeTime : ". $CapLifeTime;echo "<br>";
			$ValidBidder_LT = 0;
		}
		
		if($ValidBidder_Day==1 && $ValidBidder_Week==1 && $ValidBidder_Month==1 && $ValidBidder_LT==1)
		{
			$Bidderid = $FBidderID;
			$Bidder_Name = $FBidder_Name;
		}
		else 
			{
			 $Bidderid = "";
			}
			//echo $Bidderid;
		 if(strlen($Bidderid)>0)
			{
				 //Start Book Keeping Code 2008-01-04 18:29:09
                // Code Execution Start Time 2008-01-04 18:45:00   
                $BK_Year = date('Y');
                $BK_Month = date('m');
                $BK_Week = date('W');
                $BK_Day = date('d');
               
                $BookKeepingSql = "select * from Bidders_Book_Keeping where BidderID=".$Bidderid." and BookProduct=".$mvarType." and BookDate=".$BK_Day." and BookMonth=".$BK_Month." and BookYear=".$BK_Year."";
                $BookKeepingQuery = ExecQuery($BookKeepingSql);
               
                $BookLeadCountExisting = @mysql_result($BookKeepingQuery,0,'BookLeadCount');
                $BookDate = @mysql_result($BookKeepingQuery,0,'BookDate');//added
                $BookMonth = @mysql_result($BookKeepingQuery,0,'BookMonth');//added
                $BookYear = @mysql_result($BookKeepingQuery,0,'BookYear');//added

                 if($BookLeadCountExisting>=1)
                 {
                     //Update
                    $IncrementLeadCount = $BookLeadCountExisting + 1;
                    $UpdateBKSql = "update Bidders_Book_Keeping set BookLeadCount=".$IncrementLeadCount.", BookEntryTime = Now()  where BidderID = ".$Bidderid." and BookDate = ".$BK_Day." and BookMonth=".$BK_Month." and BookYear =".$BK_Year." and BookProduct =".$mvarType."";
                    ExecQuery($UpdateBKSql);
                 }
                 else
                 {
                     //Insert
                    $InitialCount = 1;
                    $InsertBKSql = "INSERT INTO Bidders_Book_Keeping ( BidderID , BookProduct , BookDate , BookWeek , BookMonth , BookYear , BookLeadCount, BookEntryTime ) VALUES (".$Bidderid.", ".$mvarType.", ".$BK_Day.",".$BK_Week.", ".$BK_Month.", ".$BK_Year.", ".$InitialCount.",Now())";
                    ExecQuery($InsertBKSql);
                 }
                 //End Book Keeping Code
            //quer to directly send lead to the corresponding bidder           
                $queryA="Insert into Req_Feedback_Bidder1 (AllRequestID,BidderID,Reply_Type,Allocated,Allocation_Date) Values ('$RequestID', '$Bidderid','$mvarType', 1, Now())";
                $resultA = ExecQuery($queryA);
				//echo "insert query ".$queryA."<br>";
//Query to increase bidder count in lead table by one
				$addbiddercount="UPDATE ".$tablename." SET Bidder_Count=(Bidder_Count+1) where RequestID=".$RequestID;
				//echo "update ".$addbiddercount."<br>";
                $addbiddercountresult = ExecQuery($addbiddercount);
//END of Query to increase bidder count in lead table by one

                //echo "<br>Final Insert Query:::".$queryA."<br>";
				$strSQL="";
		$Msg="";

		$result = ExecQuery("select FeedbackID from Req_Feedback where AllRequestID=$RequestID and BidderID=".$_SESSION['BidderID']." AND Reply_Type=".getReqCode($tablename));		
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
			$strSQL=$strSQL.$RequestID.",".$_SESSION['BidderID'].",".getReqCode($tablename).",'".$Feedback."')";
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
			else
			{
				echo "<script language=javascript>alert('Cap Burst')"."</script>"; 
			}
			
		//}
		}

		else
		{
		$strSQL="";
		$Msg="";

		$result = ExecQuery("select FeedbackID from Req_Feedback where AllRequestID=$RequestID and BidderID=".$_SESSION['BidderID']." AND Reply_Type=".getReqCode($tablename));		
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
			$strSQL=$strSQL.$RequestID.",".$_SESSION['BidderID'].",".getReqCode($tablename).",'".$Feedback."')";
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
	}
		
	
	//}

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
			$FeedbackClause="";
		}
		else
		{
			$FeedbackClause=" AND Req_Feedback.Feedback='".$varCmbFeedback."' ";
		}

	?>
 <p class="bodyarial11"><?=$Msg?></p>
 <table width="758" border="0" cellpadding="4" cellspacing="1" class="blueborder">
 <? if($tablename=="Req_Loan_Personal" || $tablename=="Req_Loan_Home")
		{
		$geteligibleleads= $bidderquery." and (City in ".$propercity." or City_Other in ".$propercity." ) and ".$tablename.".Bidder_Count<4 and Updated_Date between '".$min_date."' and '".$max_date."'";
		$geteligibleleadsresult=ExecQuery($geteligibleleads);
		}
		else
		{
		$geteligibleleads= $bidderquery." and (City in ".$propercity." or City_Other in ".$propercity." ) and ".$tablename.".Bidder_Count<4 and Dated between '".$min_date."' and '".$max_date."'";
		$geteligibleleadsresult=ExecQuery($geteligibleleads);
		}
		//echo "hello".$geteligibleleads;
		$request_id = "";
		while ($row = mysql_fetch_array($geteligibleleadsresult))
		{
			$requestid=$requestid.$row["RequestID"].",";
		
		
		}
		$requestid = substr($requestid, 0, strlen($requestid)-1);
		//echo "requestid".$requestid."<br>";

		$leadsofconflictbidder=ExecQuery("SELECT AllRequestID FROM Req_Feedback_Bidder1 WHERE Req_Feedback_Bidder1.AllRequestID in (".$requestid.") and Req_Feedback_Bidder1.BidderID in (".$_SESSION['Conflictbidder'].") and Req_Feedback_Bidder1.Reply_Type=".getReqCode($tablename)."");
	$conflictrequest_id = "";
		while ($row = mysql_fetch_array($leadsofconflictbidder))
		{
			$conflictrequest_id=$conflictrequest_id.$row["AllRequestID"].",";
		
		
		}
		$conflictrequest_id = substr($conflictrequest_id, 0, strlen($conflictrequest_id)-1);	
	
		
		$getleads=explode(",", $requestid);
		$getconflicleads=explode(",", $conflictrequest_id);
		$eligibleleads=array_diff($getleads,$getconflicleads);
		//echo "request".print_r($getleads)."<br>";
		//echo "conflict".print_r($getconflicleads)."<br>";
		//echo "final".print_r($eligibleleads)."<br>";
		if(count($eligibleleads)>0)
		{
			$eligible=implode(",", $eligibleleads);
			$qry="select * from ".$tablename." LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID=".$tablename.".RequestID AND Req_Feedback.BidderID=".$_SESSION['BidderID']." where RequestID in (".$eligible.")";
			$qry=$qry.$FeedbackClause;
			//$qry=$qry.$OrderBy." LIMIT $startrow, $pagesize"; 
		}
		//echo "heelo: ".$qry."<br>";
		$result=ExecQuery($qry);

	$recordcount = mysql_num_rows($result);
 ?>
   <tr>
     <td colspan="11"><strong><? echo $startrow+1; ?> to <? echo min($startrow+$pagesize,$recordcount); ?> Out of <? echo $recordcount; ?> Records </strong></td>
     </tr>
   <tr>
     <td class="head1">Name</td>
     <td class="head1">Company Name </td>
     <td class="head1">City</td>
     <td class="head1">Mobile</td>
     <td class="head1">Net Salary </td>
     <td class="head1">DOB</td>
     <td class="head1">Employment Status </td>
     <td class="head1">Feedback</td>
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
	
	
	if(count($eligibleleads)>0)
		{
			$eligible=implode(",", $eligibleleads);
			$qry="select * from ".$tablename." LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID=".$tablename.".RequestID AND Req_Feedback.BidderID=".$_SESSION['BidderID']." where RequestID in (".$eligible.")";
			$qry=$qry.$FeedbackClause;
			$qry=$qry." LIMIT $startrow, $pagesize"; 
		}
		//echo "heelosecond: ".$qry."<br>";
		
		$result=ExecQuery($qry);

		$i=1;
		if($recordcount>0)
		{
		while($row=mysql_fetch_array($result))
		{
	?>
   <tr>
     <td class="bodyarial11"><? echo $row["Name"]; ?></td>
    <td class="bodyarial11"><? echo $row["Company_Name"]; ?></td>
     <td class="bodyarial11"><? echo $row["City"]; ?></td>
     <td class="bodyarial11"><? echo $row["Mobile_Number"]; ?></td>
     <td class="bodyarial11"><? echo $row["Net_Salary"]; ?></td>
     <td class="bodyarial11"><? echo $row["DOB"]; ?></td>
     <td class="bodyarial11"><? if($row["Employment_Status"]==0) { echo "Self Employed"; } else { echo "Salaried"; }?></td>
     <td class="bodyarial11"><? echo getJumpMenu("leadallocation_index.php",$row["RequestID"],"1",$row["Feedback"],$pageno,$varmin_date,$varmax_date,$varCmbFeedback) ?></td>
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
 <!--<table width="500" border="0" cellspacing="1" cellpadding="4">
 <form name="frmdownload" action="Reliance_download.php" method="post">
   <tr>
     <td align="center">
	   <input type="hidden" name="qry1" value="<? echo $search_qry; ?>">
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
<?php include '~Bottom.php';?>

<?
function getJumpMenu($varPHPPage, $varRequestID, $varType, $varFeedback, $varpageon, $varmindate, $varmaxdate,$cmbfeedback)
{
	$strURL="";
	$strURL=$varPHPPage."?search=y&RequestID=".$varRequestID."&type=".$varType."&pageno=".$varpageon."&min_date=".urlencode($varmindate)."&max_date=".urlencode($varmaxdate)."&cmbfeedback=".urlencode($cmbfeedback);
?>
	<select name="type" id="type" onChange="MM_jumpMenu('parent',this,0)">
		<option value="<? echo $strURL.'&Feedback='?>" <? if($varFeedback == "") { echo "selected"; } ?>>No Feedback</option>
		<option value="<? echo $strURL.'&Feedback=Send Now'?>" <? if($varFeedback == "Send Now") { echo "selected"; } ?>>Send Now</option>
		<option value="<? echo $strURL.'&Feedback=Not Eligible'?>" <? if($varFeedback == "Not Eligible") { echo "selected"; } ?>>Not Eligible</option>
		<option value="<? echo $strURL.'&Feedback=Not Interested'?>" <? if($varFeedback == "Not Interested") { echo "selected"; } ?>>Not Interested</option>
		<option value="<? echo $strURL.'&Feedback=Callback Later'?>" <? if($varFeedback == "Callback Later") { echo "selected"; } ?>>Callback Later</option>
		<option value="<? echo $strURL.'&Feedback=Wrong Number'?>" <? if($varFeedback == "Wrong Number") { echo "selected"; } ?>>Wrong Number</option>
		<option value="<? echo $strURL.'&Feedback=Closed'?>" <? if($varFeedback == "Closed") { echo "selected"; } ?>>Closed</option>
		<option value="<? echo $strURL.'&Feedback=Duplicate'?>" <? if($varFeedback == "Duplicate") { echo "selected"; } ?>>Duplicate</option>
	</select>
<?
}
?>
</body>

</html>
