<?php
require 'scripts/session_check_online.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';

$BidderID = $_SESSION['BidderID'];

function ccMasking($number, $maskingCharacter = 'X') {
    return substr($number, 0, 2) . str_repeat($maskingCharacter, strlen($number) - 4) . substr($number, -2);
}

$todaydt = date('Y-m-d');
$secure_chk = "Select bidderid from bidders_session_details Where (sessionid='" . $_SESSION["our_session"] . "' and bidderid='" . $_SESSION['BidderID'] . "' and product='" . $_SESSION['product'] . "' and login_date='" . $todaydt . "')";

$resultsecure_chk = ExecQuery($secure_chk);
$recordcount = mysql_num_rows($resultsecure_chk);
$securerow = mysql_fetch_array($resultsecure_chk);
if ($securerow["bidderid"] > 0) {
    //echo "valid";
} else {
    session_destroy();
    $PostURL = "http://www.deal4loans.com/index.php";
    header("Location: $PostURL");
}

function getReqValue1($pKey) {
    $titles = array(
        '1' => '996,997,998,1000,1012,1015,1037,1050',
        '2' => '1000',
        '3' => '1012',
        '4' => '1015',
        '5' => '1037',
        '6' => '1050',
        '7' => '996,997,998'
    );

    foreach ($titles as $key => $value)
        if ($pKey == $key)
            return $value;

    return "";
}

$city = "";
if (isset($_REQUEST['city'])) {
    $city = $_REQUEST['city'];
}
$allocated_bidder = "";

if (isset($_REQUEST['allocated_bidder'])) {
    $allocated_bidder = $_REQUEST['allocated_bidder'];
}

//echo $allocated_bidder."<br>";

$branch = getReqValue1($city);

$getbranch = explode(",", $branch);

$getbranchwise = "";

if (isset($_REQUEST['getbranchwise'])) {
    $getbranchwise = $_REQUEST['getbranchwise'];
}


$val = "Req_Loan_Personal";

$pro_code = 1;

$FeedbackClause = "";


$search = "";
if (isset($_GET['search'])) {
    $search = $_GET['search'];
}

$min_date = "";
if (isset($_REQUEST['min_date'])) {
    $min_date = $_REQUEST['min_date'];
}

$max_date = "";
if (isset($_REQUEST['max_date'])) {
    $max_date = $_REQUEST['max_date'];
}

$varCmbFeedback = "";
if (isset($_REQUEST['cmbfeedback'])) {
    $varCmbFeedback = $_REQUEST['cmbfeedback'];
}
$varAgent = "";
if (isset($_REQUEST['agent'])) {
    $varAgent = $_REQUEST['agent']; 
}

$RequestID = "";
if (isset($_REQUEST['RequestID'])) {
    $RequestID = $_REQUEST['RequestID'];
}
$type = "";
if (isset($_REQUEST['type'])) {
    $type = $_REQUEST['type'];
}
$Feedback = "";
if (isset($_REQUEST['Feedback'])) {
    $Feedback = $_REQUEST['Feedback'];
}

//Paging
$pagesize = 25;
$startrow = 0;

//Set the page no

if (empty($_GET['pageno'])) {
    if ($startrow == 0) {
        $pageno = $startrow + 1;
    }
} else {
    $pageno = $_GET['pageno'];
    $startrow = ($pageno - 1) * $pagesize;
}

//Set the counter start
if ($pageno / $pagesize == 0) {
    $counterstart = $pageno - ($pagesize - 1);
} else {
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
        <link href="includes/style1.css" rel="stylesheet" type="text/css">
        <link href="style.css" rel="stylesheet" type="text/css" />
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
            function killCopy(e){ return false; }
            function reEnable(){return true; }
            document.onselectstart=new Function ("return false");
            if (window.sidebar){ document.onmousedown=killCopydocument.onclick=reEnable }
            function clickIE4(){if (event.button==2){ return false; } }
            function clickNS4(e){ if (document.layers||document.getElementById&&!document.all){ if (e.which==2||e.which==3){ return false;} } }
            if (document.layers){ document.captureEvents(Event.MOUSEDOWN); document.onmousedown=clickNS4; } else if (document.all&&!document.getElementById){ document.onmousedown=clickIE4; }
            document.oncontextmenu=new Function("return false")
        </script>
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
            document.frmsearch.action="fullerton_majorcty_view.php?search=y"+gifName;
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
<? if ($_SESSION['Date'] > $mindefineDate) {
    ?>
                if(document.frmsearch.min_date.value<"<?php echo $mindefineDate; ?>")
                {
                alert("Sorry!!!! Your minimum date is <?php echo $mindefineDate; ?>.Please Select.");
                document.frmsearch.min_date.value="";
                document.frmsearch.min_date.focus();
                return false;
                }
<? } else {
    ?>
                if(document.frmsearch.min_date.value<"2009-02-05")
                {
                alert("Sorry!!!! Your minimum date is 2009-00-05.Please Select.");
                document.frmsearch.min_date.value="";
                document.frmsearch.min_date.focus();
                return false;
                }
<? } ?>
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

            function getNumValue(iLoc,id, parameterVal)
            {
            //alert(parameterVal);
            var allLoc = [];
            if(parameterVal>0 )
            {
            for(var iTrav=1; iTrav <= parameterVal; iTrav++) { allLoc.push(iTrav); }
            }
            else
            {
            for(var iTrav=1; iTrav <= <?php echo $pagesize; ?>; iTrav++) { allLoc.push(iTrav); }
            }
            var iRemove = allLoc.indexOf(iLoc);
            if(iRemove != -1) { allLoc.splice(iRemove, 1); }


            var queryString = "?get_requestid=" + id;
            ajaxRequest.open("GET", "getfullertonNum.php" + queryString, true);
            ajaxRequest.onreadystatechange = function(){
            if(ajaxRequest.readyState == 4)
            {
            document.getElementById('clik4Num_'+ iLoc).innerHTML = "<b style='font-size:12px;'>"+ajaxRequest.responseText+"</b>";
            //	document.getElementById('clik4Num_'+ iLoc).innerHTML = "<input type='text' name='mob_mob_mob' style='font-size:12px; background-color:#DFF6FF; border:0px;'  readonly='readonly' value='"+ajaxRequest.responseText+"' >";
            for(var iTraverse = allLoc.length; iTraverse--;)
            { document.getElementById('clik4Num_'+ allLoc[iTraverse]).innerHTML = 'XXXXXXXXXX';	}
            }
            }
            ajaxRequest.send(null); 
            }
            window.onload = ajaxFunction;

        </script>
        <script language="javascript" type="text/javascript">
<!--
        function popitup(url) {
    newwindow = window.open(url, 'name', 'height=280,width=200');
    if (window.focus) {
        newwindow.focus()
    }
    return false;
}
// -->
        </script>
    </head><body>
    <!--<input type='text' name='mob_mob_mob' style='font-size:12px; background-color:#DFF6FF; border:0px;' value='"+ajaxRequest.responseText+"' >-->
<?php
if (isset($_SESSION['UserType'])) {
    echo "<table width='100%' border='0' cellspacing='0' cellpadding='0'><tr><td width='323' height='93' align='left' valign='top'  ><img src='http://www.deal4loans.com/rnew/images/login-logo.gif' width='323' height='93' /></td><td align='left' valign='top' style='color:#0B6FCC;' ><table width='100%' border='0' cellspacing='0' cellpadding='0' bgcolor='#0A92C0'><tr><td height='67' align='right' valign='middle' bgcolor='#C8E3F3' style='padding-right:10px;'><table border='0' align='right' cellpadding='0' cellspacing='0' bgcolor='#0A92C0'><tr><td width='6' height='32' align='left' valign='top'><img  src='http://www.deal4loans.com/rnew/images/login-form-logut-lft.gif' width='6' height='32' /></td><td background='http://www.deal4loans.com/rnew/images/login-form-logut-bg.gif' style=' background-repeat:repeat-x; height:32px;'><table width='100%' border='0' align='center' cellpadding='0' cellspacing='0'><tr><td align='left' valign='middle' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#FFFFFF; font-weight:bold; padding-right:15px;' > Welcome " . ucwords($_SESSION['UserType']) . " " . $_SESSION['UName'] . "</td><td align='left' style='padding-right:2px;' width='22'><img src='http://www.deal4loans.com/rnew/images/login-logut-btn.gif' /></td><td align='right' class='style1' style='color:#FFFFFF; font-weight:bold;'><div align='right' class='style1' style='color:#FFFFFF; font-weight:bold;'> <a href='Logout.php' style='color:#FFFFFF; font-size:13px; text-decoration:none; font-family:Verdana, Arial, Helvetica, sans-serif;'>Logout</a></div></td></tr></table></td><td width='6' height='32'><img src='http://www.deal4loans.com/rnew/images/login-form-logut-rgt.gif' width='6' height='32' /></td></tr></table></td></tr><tr><td>&nbsp;</td></tr></table></td></tr></table>";
}
?>

        <table width="100%" border="0"  align="center" cellpadding="0" cellspacing="0"  >
            <tr>
                <td align="center">
                    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#45B2D8">
                        <tr>
                            <td style="padding-top:15px;"><table  width="669" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#5BBEE0" >

                                    <tr>
                                        <td width="669" height="150" align="left" valign="top" bgcolor="#FFFFFF" style="background-repeat:no-repeat;" ><table width="97%" border="0" align="center" cellpadding="0" cellspacing="0">
                                                <tr>
                                                    <td height="40" align="center"  ><h1 style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; color:#052733; line-height:18px; font-weight:bold;">Welcome to Deal4Loans LMS</h1></td>
                                                </tr>
                                                <tr>
                                                    <td  style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#052733; line-height:17px;"><? if ((!isset($val) && $viewtexttype == 1) || ($val == "Req_Loan_Personal")) { ?>PERSONAL LOAN is a need based product. Your end-sales will depend upon how quickly you contact the customer (after he registers for Loan).<br/><b>Tips: <br>1.</b> Login as many times a day as possible and contact the customer early .<br/>
                                                            <b>2.</b> Ensure that your contact numbers go to the customer in the auto-acknowledgement SMS that Deal4Loans sends. <br>
        <? } elseif ((!isset($val) && $viewtexttype == 2) || ($val == "Req_Loan_Personal")) { ?>HOME LOAN is a Life time decison for most customers- hence the decision cycle is long. As a loan provider you need to engage with the customer through out their decision cycle..<br/><b>Tips: <br>1.</b> Leave your contact numbers via email/SMS (functionality provided in Deal4Loans LMS) after you have contacted the customer.<br/>
                                                            <b>2.</b> Tell the loan seeker how much tax savings will this home loan get him/her.
        <? } ?>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>			  </tr>
                                </table></td>
                        </tr>
<?php
$IP_Remote = $_SERVER["REMOTE_ADDR"];
if ($IP_Remote == '192.124.249.12' || $IP_Remote == '185.93.228.12') {
    $IP = $_SERVER['HTTP_X_SUCURI_CLIENTIP'];
} else {
    $IP = $IP_Remote;
}
if ($IP == "122.176.100.27" || $IP == "122.176.100.28" || $IP == "122.176.122.134" || $IP == "122.161.196.68" || $IP == "61.246.3.127" || $IP == "122.160.30.168" || $IP == "180.188.224.34" || $IP == "122.161.193.191" || $IP == "122.160.74.241" || $IP == "122.160.74.235" || $IP == "182.71.109.218" || $IP == "1.23.114.53" || "185.93.231.12") {
    ?> <tr><td style="float:right" bgcolor="#45B2D8"> <a href="/bidders_consolidate_appointment.php" style="color:#FFFFFF;" target="_blank"><strong>Appointment</strong></a> | <a href="/bidders_update_feedback.php" style="color:#FFFFFF;"><strong>Update Feedbacks</strong></a></td></tr><? } ?>
                        <tr><td>&nbsp;</td></tr>
                        <tr><td align="center">

                                <table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td height="30" align="center" valign="middle"><img src="images/login-srch-pnl.gif" width="650" height="30"></td>
                                    </tr>
                                    <tr>
                                        <td align="center" valign="middle" background="images/login-form-login-bg.gif">
<table width="95%" border="0"  cellpadding="1" cellspacing="0">
<form name="frmsearch" action="consolidatefullerton_majorcty_view.php?search=y" method="get" onSubmit="return chkform();">  
    <input type="hidden" name="search" value="y" 
<tr>
    <td colspan="3">&nbsp;</td>
</tr>  
<tr>
<td colspan="3" align="center">
    <table border="0" width="90%" cellpadding="0" cellspacing="0"><tr>
            <td width="20%" valign="middle" class="style1">&nbsp;&nbsp;Date&nbsp;&nbsp; From </td>
            <td width="24%" align="left" valign="middle" class="bidderclass" ><? $current_date = date('Y-m-d'); ?> 
                <input name="min_date" type="text" id="min_date" size="15" <? if ($min_date == "") { ?>value="<?php echo $current_date; ?>" <? } else { ?>value="<? echo $min_date; ?>" <? } ?>></td>
            <td>
                <input name="b12" type="button" class="bluebutton" onClick="javascript:pedirFecha(min_date, '');" value="&lt; Insert">  </td>

            <td valign="middle" align="center" class="style1" width="8%">To</td>
            <td align="left" valign="middle" class="style1" width="24%" >  <input name="max_date" type="text" id="max_date" size="15" value="<? echo $max_date; ?>"></td>
            <td> <input name="b122" type="button" class="bluebutton" onClick="javascript:pedirFecha(max_date, '');" value="&lt; Insert"><?php //echo "Check IP - -".$IP;  ?></td>
        </tr>
    </table>
</td></tr>
<tr> 
    <td colspan="3" align="center"> <table border="0" width="90%" cellpadding="0" cellspacing="0">
            <tr>
                <td width="10%" valign="middle" class="style1">City </td>
                <td width="30%" valign="middle" class="style1">
                    <select name="city" id="city">
                        <option value="-1">Please select</option>
                        <option value="1" <? if ($city == 1) {
echo "selected";
} ?>>All</option>
                        <option value="2" <?php if ($city == 2) {
echo "selected";
} ?>>Delhi</option>
                        <option value="3" <? if ($city == 3) {
echo "selected";
} ?>>Hyderabad</option>
                        <option value="4" <? if ($city == 4) {
echo "selected";
} ?>>Mumbai</option>
                        <option value="5" <? if ($city == 5) {
echo "selected";
} ?>>Chennai </option>
                        <option value="6" <? if ($city == 6) {
echo "selected";
} ?>>Bangalore</option>
                        <option value="7" <? if ($city == 7) {
echo "selected";
} ?>>Pune</option>
                    </select>
                </td>
                <td width="15%" valign="middle" class="style1">Feedback:</td>
                <td width="50%" align="left" valign="middle" class="bidderclass">
                    <select name="cmbfeedback" id="cmbfeedback" style="width:120px;">
                        <option value="All" <? if ($varCmbFeedback == "All") {
echo "selected";
} ?>>All</option>
                        <option value="" <? if ($varCmbFeedback == "") {
echo "selected";
} ?>>No Feedback</option>
                        <option value="Process" <? if ($varCmbFeedback == "Process") {
echo "selected";
} ?>>Process</option>
                        <option value="Not Eligible" <? if ($varCmbFeedback == "Not Eligible") {
echo "selected";
} ?>>Not Eligible</option>
                        <option value="Not Interested" <? if ($varCmbFeedback == "Not Interested") {
echo "selected";
} ?>>Not Interested</option>
                        <option value="Callback Later" <? if ($varCmbFeedback == "Callback Later") {
echo "selected";
} ?>>Callback Later</option>
                        <option value="Wrong Number" <? if ($varCmbFeedback == "Wrong Number") {
echo "selected";
} ?>>Wrong Number</option>
                        <option value="Closed" <? if ($varCmbFeedback == "Closed") {
echo "selected";
} ?>>Closed</option>
                        <option value="FollowUp" <? if ($varCmbFeedback == "FollowUp") {
echo "selected";
} ?>>FollowUp</option>
                        <option value="Not Available" <? if ($varCmbFeedback == "Not Available") {
                            echo "selected";
                        } ?>>Not Available</option>
                        <option value="Ringing" <? if ($varCmbFeedback == "Ringing") {
                            echo "selected";
                        } ?>>Ringing</option>
                        <option value="Documents Pick" <? if ($varCmbFeedback == "Documents Pick") {
                            echo "selected";
                        } ?>>Documents Pick</option>
                        <option value="Loan Rejected" <? if ($varCmbFeedback == "Loan Rejected") {
                            echo "selected";
                        } ?>>Loan Rejected</option>
                        <option value="Appointment" <? if ($varCmbFeedback == "Appointment") {
                            echo "selected";
                        } ?>>Appointment</option>
                        <option value="Not interested for ROI" <? if ($varCmbFeedback == "Not interested for ROI") {
                            echo "selected";
                        } ?>>Not interested for ROI</option>
                        <option value="Not interested for LoanAmt" <? if ($varCmbFeedback == "Not interested for LoanAmt") {
                            echo "selected";
                        } ?>>Not interested for LoanAmt</option>
                    </select>	
                </td>
               <?php
               $getAgentSql = ExecQuery("select BidderID,Associated_Bank,Status from Bidders where leadidentifier='AccountFullertonProcess' and Global_Access_ID like '%" . $BidderID . "%' ORDER BY Associated_Bank ASC");        $countrowAgent = mysql_num_rows($getAgentSql);
               if($countrowAgent>0) {
               ?>

                <td width="15%" valign="middle" class="style1">Agent:</td>
                <td width="50%" align="left" valign="middle" class="bidderclass">
                    <select name="agent" id="agent" style="width:120px;">
                        <option value="">Select</option>
                        <option value="All" <?php if($_REQUEST['agent']=='All'){ echo "selected";}?>>All</option>
<?php

while ($rowAgent = mysql_fetch_array($getAgentSql)) {
?>

                            <option value="<?php echo $rowAgent['BidderID']; ?>" <?php if($_REQUEST['agent']==$rowAgent['BidderID']) {echo "Selected";}?>><?php echo $rowAgent['Associated_Bank']; ?></option>
<?php } ?>
                    </select>	
                </td>
               <?php }?>
            </tr></table></td></tr>
                                                    <tr><td colspan="3">&nbsp;</td></tr>   <tr>    
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
                                $search_date = "";
                                $varmin_date = $min_date;
                                $varmax_date = $max_date;

                                if (strlen(trim($RequestID)) > 0) {
                                    $strSQL = "";
                                    $Msg = "";

                                    $result = ExecQuery("select FeedbackID from Req_Feedback where AllRequestID=$RequestID and BidderID in (" . $allocated_bidder . ")");
                                    $num_rows = mysql_num_rows($result);
                                    if ($num_rows > 0) {
                                        $row = mysql_fetch_array($result);
                                        $strSQL = "Update Req_Feedback Set Feedback='" . $Feedback . "' ";
                                        $strSQL = $strSQL . "Where FeedbackID=" . $row["FeedbackID"];
                                    } else {
                                        $strSQL = "Insert into Req_Feedback(AllRequestID, BidderID, Reply_Type , Feedback) Values (";
                                        $strSQL = $strSQL . $RequestID . "," . $allocated_bidder . "," . $pro_code . ",'" . $Feedback . "')";
                                    }

                                    echo $strSQL;
                                    $result = ExecQuery($strSQL);
                                    if ($result == 1) {
                                        
                                    } else {
                                        $Msg = "** There was a problem in adding your feedback. Please try again.";
                                    }
                                }

                                if ($search == "y") {
                                    $min_date = $min_date . " 00:00:00";
                                    $max_date = $max_date . " 23:59:59";

                                    if (strlen(trim($varCmbFeedback)) == 0) {
                                        $FeedbackClause = " AND (Req_Feedback.Feedback IS NULL OR Req_Feedback.Feedback='') ";
                                    } else if ($varAgent == "All") {
                                        $FeedbackClause = " ";
                                    } else if ($varCmbFeedback == "All") {
                                        $FeedbackClause = " ";
                                    }
                                    else {
                                        $FeedbackClause = " AND Req_Feedback.Feedback='" . $varCmbFeedback . "' ";
                                    }
                                    ?>
                                    <p class="bodyarial11"><?= $Msg ?></p>
                                    <table width="950" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#FFFFFF" >
                                        <?
                                        if ($city > 0) {
                                            $biddervalue = "(" . $branch . ")";
                                            //echo "if:: ";
                                        } else {
                                            $biddervalue = "(996,997,998,1000,1012,1015,1037,1050)";
                                            //echo "else:: ";
                                        }
                                        $search_qry = "SELECT *,Req_Feedback_Bidder_PL.BidderID AS sentbidder FROM Req_Feedback_Bidder_PL,`" . $val . "` LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID=Req_Loan_Personal.RequestID AND Req_Feedback.BidderID in " . $biddervalue . " WHERE Req_Feedback_Bidder_PL.AllRequestID=`" . $val . "`.RequestID and Req_Feedback_Bidder_PL.BidderID in " . $biddervalue . " and Req_Feedback_Bidder_PL.Reply_Type=" . $pro_code . " and (Req_Feedback_Bidder_PL.Allocation_Date  Between '" . ($min_date) . "' and '" . ($max_date) . "' ) ";
                                        $search_qry = $search_qry . $FeedbackClause;
                                        $search_qry = $search_qry . "group by " . $val . ".Mobile_Number";
                                        $search_qry = $search_qry . " order by " . $val . ".Dated DESC";

                                        $qry = "SELECT RequestID,City,Name,Mobile_Number,Allocation_Date,Net_Salary,Company_Name,Loan_Amount,Employment_Status,Feedback,comment_section,Hdfc_Eligibility,Citibank_Eligibility,Barclays_Eligibility,eligible,interest_stat,post_login_stat FROM Req_Feedback_Bidder_PL,`" . $val . "` LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID=Req_Loan_Personal.RequestID AND Req_Feedback.BidderID in " . $biddervalue . " WHERE Req_Feedback_Bidder_PL.AllRequestID=`" . $val . "`.RequestID and Req_Feedback_Bidder_PL.BidderID in " . $biddervalue . "  and Req_Feedback_Bidder_PL.Reply_Type=" . $pro_code . " and (Req_Feedback_Bidder_PL.Allocation_Date Between '" . ($min_date) . "' and '" . ($max_date) . "' ) ";
                                        $qry = $qry . $FeedbackClause;
                                        $qry = $qry . "group by " . $val . ".Mobile_Number";

                                        //echo"hello".$qry."<br>";
                                        $result = ExecQuery($qry);
                                        $recordcount = mysql_num_rows($result);
                                        $getParameterVal = min($startrow + $pagesize, $recordcount) % $pagesize;
//		$getParameterVal = ;
//		if($getParameterVal>0 && $getParameterVal<25) { $getParameterVal = $pagesize;}  
                                        ?>
                                        <tr>
                                            <td colspan="11" style="border-bottom:1px solid #45B2D8;"><strong><? echo $startrow + 1; ?> to <? echo min($startrow + $pagesize, $recordcount); ?> Out of <? echo $recordcount; ?> Records </strong></td>
                                        </tr>
                                        <tr>
                                            <td width="91" align="center" bgcolor="#FFFFFF" class="style2">Name </td>
                                            <td width="91" align="center" bgcolor="#FFFFFF" class="style2">Mobile</td>
                                            <td width="100" align="center" bgcolor="#FFFFFF" class="style2">City</td>
                                            <td width="100" align="center" bgcolor="#FFFFFF" class="style2">Co Name</td>
                                            <td width="100" align="center" bgcolor="#FFFFFF" class="style2">Salary</td>
                                            <td width="90" align="center" bgcolor="#FFFFFF" class="style2">Loan Amount </td>
                                            <td width="130" align="center" bgcolor="#FFFFFF" class="style2">Employment Status </td>
                                            <td width="71" align="center" bgcolor="#FFFFFF" class="style2">Feedback</td>
                                            <td width="180" align="center" bgcolor="#FFFFFF" class="style2">Add Comment</td>
                                            <td width="180" align="center" bgcolor="#FFFFFF" class="style2">HDFC eligibility</td>
                                            <td width="180" align="center" bgcolor="#FFFFFF" class="style2">Citibank eligibility</td>
                                            <td width="180" align="center" bgcolor="#FFFFFF" class="style2">Barclays eligibility</td>
                                            <td width="180" align="center" bgcolor="#FFFFFF" class="style2">Documents</td>
                                            <td width="180" align="center" bgcolor="#FFFFFF" class="style2">Appointments</td>
                                            <td width="180" align="center" bgcolor="#FFFFFF" class="style2">TeleCaller</td>
                                        <?php if (($IP == "182.71.109.218" || $IP == "122.176.100.27" || $IP == "122.176.100.28" || $IP == "122.176.122.134" || $IP == "122.161.196.68" || $IP == "61.246.3.127" || $IP == "122.160.30.168" || $IP == "180.188.224.34" || $IP == "122.161.193.191" || $IP == "122.160.74.241" || $IP == "122.160.74.235")) {
                                            ?>
                                                <td width="90" align="center" bgcolor="#FFFFFF" class="style2">Feedback</td>
                                                <td width="90" align="center" bgcolor="#FFFFFF" class="style2">Comment</td>          
                                        <?php }
                                        ?>

                                        </tr>
                                        <?
                                        //Set Maximum Page start
                                        $maxpage = $recordcount % $pagesize;
                                        if ($recordcount % $pagesize == 0) {
                                            $maxpage = $recordcount / $pagesize;
                                        } else {
                                            $maxpage = ceil($recordcount / $pagesize);
                                        }

                                        $qry = "SELECT RequestID,City,Name,Mobile_Number,Allocation_Date,Net_Salary,Company_Name,Loan_Amount,Employment_Status,Feedback,comment_section,Hdfc_Eligibility,Citibank_Eligibility,Barclays_Eligibility,eligible,interest_stat,post_login_stat,Req_Feedback_Bidder_PL.BidderID AS Allocate_Bidder, Req_Feedback_Bidder_PL.BidderID AS sentbidder FROM Req_Feedback_Bidder_PL,`" . $val . "` LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID=Req_Loan_Personal.RequestID AND Req_Feedback.BidderID in " . $biddervalue . " WHERE Req_Feedback_Bidder_PL.AllRequestID=`" . $val . "`.RequestID and Req_Feedback_Bidder_PL.BidderID in " . $biddervalue . " and Req_Feedback_Bidder_PL.Reply_Type=" . $pro_code . " and ( Req_Feedback_Bidder_PL.Allocation_Date Between '" . ($min_date) . "' and '" . ($max_date) . "' ) ";
                                        $qry = $qry . $FeedbackClause;
                                        $qry = $qry . "group by " . $val . ".Mobile_Number";
                                        $qry = $qry . " order by " . $val . ".Dated DESC";
                                        $qry = $qry . " LIMIT $startrow, $pagesize";

//echo $qry;
                                        $result = ExecQuery($qry);

                                        $i = 1;
                                        if ($recordcount > 0) {
                                            while ($row = mysql_fetch_array($result)) {
                                                ?>
                                                <input type="hidden" name="requestid_<? echo $i; ?>" id="requestid_<? echo $i; ?>" value="<? echo $row["RequestID"]; ?>">
                                                <input type="hidden" name="product_<? echo $i; ?>" id="product_<? echo $i; ?>" value="<? echo $pro_code; ?>">
                                                <input type="hidden" name="allocated_bidder_<? echo $i; ?>" id="allocated_bidder_<? echo $i; ?>" value="<? echo $row['Allocate_Bidder']; ?>">
                                                <tr>
                                                    <td align="center" bgcolor="#DFF6FF" class="style3"><?php
                                                        $numRowsExclusive = '';
                                                        $sqlExclusive = "select  BidderID  from Req_Feedback_Bidder_PL where (AllRequestID = '" . $row["RequestID"] . "' and Reply_Type='" . $pro_code . "')";
                                                        $queryExclusive = ExecQuery($sqlExclusive);
                                                        $numRowsExclusive = mysql_num_rows($queryExclusive);
                                                        if ($numRowsExclusive == 1) {
                                                            echo '<b style="font:Verdana, Arial, Helvetica, sans-serif; color:#FF0000; font-size:9px;"> [Exclusive Lead] </b><br>';
                                                        }
                                                        ?><span id="clkNum<?php echo $i; ?>" onClick="getNumValue(<?php echo $i; ?>,<?php echo $row["RequestID"]; ?>,<?php echo $getParameterVal; ?>);" style="cursor:hand;"><? echo $row["Name"]; ?></span></td>
                                                    <td align="center" bgcolor="#DFF6FF" class="style3"><span id="clik4Num_<?php echo $i; ?>">XXXXXXXXXX</span></td>
                                                    <td align="center" bgcolor="#DFF6FF" class="style3"><? echo $row["City"]; ?></td>
                                                    <td align="center" bgcolor="#DFF6FF" class="style3"><? echo $row["Company_Name"]; ?></td>
                                                    <td align="center" bgcolor="#DFF6FF" class="style3"><? echo $row["Net_Salary"]; ?></td>
                                                    <td align="center" bgcolor="#DFF6FF" class="style3"><? echo $row["Loan_Amount"]; ?></td>
                                                    <td align="center" bgcolor="#DFF6FF" class="style3"><? if ($row["Employment_Status"] == 0) {
                                                            echo "Self Employed";
                                                        } else {
                                                            echo "Salaried";
                                                        } ?></td> 
                                                    <td align="center" bgcolor="#DFF6FF" class="style3"><? echo getJumpMenu("fullerton_majorcty_view.php", $row["RequestID"], "1", $row["Feedback"], $pageno, $varmin_date, $varmax_date, $varCmbFeedback, $val, $row['Allocate_Bidder'], $city) ?></td>	
                                                    <td align="center" bgcolor="#DFF6FF" class="bodyarial11" ><table width="100%"><tr><td><textarea  name="comment_section_<? echo $i; ?>" id="comment_section_<? echo $i; ?>" cols="18" rows="1"><? echo $row["comment_section"]; ?></textarea></td><td><a onClick="insertData(<? echo $i; ?>);" style="cursor:pointer; color:blue;" class="style3">&nbsp;&nbsp;Save</a></td></tr></table></td>
                                                    <td align="center" bgcolor="#DFF6FF" class="style3" color="#FF0000"><? if (strlen($row["Hdfc_Eligibility"]) > 0) {
                                                echo $row["Hdfc_Eligibility"];
                                            } else {
                                                echo "Not Eligibile";
                                            }
                                            ?></td>
                                                    <td align="center" bgcolor="#DFF6FF" class="style3" color="#FF0000"><? if (strlen($row["Citibank_Eligibility"]) > 0) {
                                                echo $row["Citibank_Eligibility"];
                                            } else {
                                                echo "Not eligibile";
                                            } ?></td>
                                                    <td align="center" bgcolor="#DFF6FF" class="style3" color="#FF0000"><? if (strlen($row["Barclays_Eligibility"]) > 0) {
                                                echo $row["Barclays_Eligibility"];
                                            } else {
                                                echo "Not Eligibile";
                                            } ?></td>
                                                    <td align="center" bgcolor="#DFF6FF" class="style3" >
                                                        <?php
                                                        $checkDocsSql = "select * from upload_documents where (RequestID='" . $row["RequestID"] . "' and Reply_Type=1)";
                                                        $checkDocsQuery = ExecQuery($checkDocsSql);
                                                        $numcheckDocs = mysql_num_rows($checkDocsQuery);
                                                        if ($numcheckDocs > 0) {
                                                            ?>
                                                            <a href="download-documents.php?Lid=<?php echo $row["RequestID"]; ?>&Prid=<? echo $pro_code; ?>" onClick="return popitup('download-documents.php?Lid=<?php echo $row["RequestID"]; ?>&Prid=<? echo $pro_code; ?>')" >Documents</a>
                                                            <?php
                                                        }
                                                        ?>

                                                    </td>
                                                    <td align="center" bgcolor="#DFF6FF" class="style3" >

                                                        <?php
                                                        // Appointment 
                                                        $getAppointmentSql = "SELECT * FROM fil_appointments where RequestID='" . $row["RequestID"] . "'";
                                                        $getAppointmentQuery = ExecQuery($getAppointmentSql);
                                                        $getAppointmentNum = mysql_num_rows($getAppointmentQuery);
                                                        if ($getAppointmentNum > 0) {
                                                            ?>
                                                            <a href="showAppointment.php?Lid=<?php echo $row["RequestID"]; ?>&Prid=<? echo $pro_code; ?>" onClick="return popitup('showAppointment.php?Lid=<?php echo $row["RequestID"]; ?>&Prid=<? echo $pro_code; ?>')">AppointMent</a>

                                                        <?php
                                                    }
                                                    ?>
                                                    </td>
                                                    <td align="center" bgcolor="#DFF6FF" class="style3" >
                                                    <?php
                                                    $ggSQl = "SELECT * FROM fullerton_allocation_track where RequestID='" . $row["RequestID"] . "'";
                                                    $ggQuery = ExecQuery($ggSQl);
                                                    $ggMobile = mysql_result($ggQuery, 0, 'Mobile');
                                                    $ggBName = mysql_result($ggQuery, 0, 'BName');
                                                    echo $ggBName;
                                                    echo "<br>";
                                                    echo $ggMobile;
                                                    ?>
                                                    </td>
                                                    <?php
                                                    if (($IP == "182.71.109.218" || $IP == "122.176.100.27" || $IP == "122.176.100.28" || $IP == "122.176.122.134" || $IP == "122.161.196.68" || $IP == "61.246.3.127" || $IP == "122.160.30.168" || $IP == "180.188.224.34" || $IP == "122.161.193.191" || $IP == "122.160.74.241" || $IP == "122.160.74.235")) {
                                                        echo '<td align="center" bgcolor="#DFF6FF" colspan="2" width="250">';
//		echo $row["RequestID"]; echo $row['sentbidder'];
                                                        $getUploadedFeedback = '';
                                                        $getUploadedComments = '';

                                                        $getFeedbackSql = "select Feedback, Comments, BidderID from Req_Feedback_Comments_PL where AllRequestID='" . $row["RequestID"] . "' and BidderID='" . $row['sentbidder'] . "' and Feedback!='' ";

                                                        $getFeedbackQuery = ExecQuery($getFeedbackSql);
                                                        $getUploadedNumRows = mysql_num_rows($getFeedbackQuery);

                                                        $getFeedbackOthersSql = "select Feedback, Comments, BidderID from Req_Feedback_Comments_PL where AllRequestID='" . $row["RequestID"] . "' and BidderID!='" . $row['sentbidder'] . "' and Feedback!=''";

                                                        $getFeedbackOthersQuery = ExecQuery($getFeedbackOthersSql);
                                                        $getUploadedNumOthersRows = mysql_num_rows($getFeedbackOthersQuery);

                                                        if ($getUploadedNumRows > 0 || $getUploadedNumOthersRows > 0) {
                                                            ?>

                                                        <table width="100%" border="0" align="center" cellpadding="2" cellspacing="1" bgcolor="#FFFFFF" >
                                                                <?php
                                                                if ($getUploadedNumRows > 0) {
                                                                    $getUploadedFeedback = mysql_result($getFeedbackQuery, 0, 'Feedback');
                                                                    $getUploadedComments = mysql_result($getFeedbackQuery, 0, 'Comments');
                                                                    $getUploadedBidderID = mysql_result($getFeedbackQuery, 0, 'BidderID');
                                                                    $getBidderSQl1 = "select Bidder_Name from Bidders_List where BidderID= '" . $getUploadedBidderID . "'";
                                                                    $getBidderQuery1 = ExecQuery($getBidderSQl1);
                                                                    $getBidder_Name1 = mysql_result($getBidderQuery1, 0, 'Bidder_Name');
                                                                    ?>
                                                                <tr>
                                                                    <td align="center" bgcolor="#DFF6FF"><?php echo $getUploadedFeedback; ?></td>    <td align="center" bgcolor="#DFF6FF" ><?php echo $getUploadedComments; ?></td><td align="center" bgcolor="#DFF6FF" ><?php echo $getBidder_Name1; ?></td><tr><?php
                                                                }

                                                                if ($getUploadedNumOthersRows > 0) {
                                                                    $getUploadedOthersFeedback = '';
                                                                    $getUploadedOthersComments = '';
                                                                    $getUploadedOthersBidderID = '';

                                                                    for ($ii = 0; $ii < $getUploadedNumOthersRows; $ii++) {
                                                                        $getUploadedOthersFeedback = mysql_result($getFeedbackOthersQuery, $ii, 'Feedback');
                                                                        $getUploadedOthersComments = mysql_result($getFeedbackOthersQuery, $ii, 'Comments');
                                                                        $getUploadedOthersBidderID = mysql_result($getFeedbackOthersQuery, $ii, 'BidderID');
                                                                        $getBidderSQl = "select Bidder_Name from Bidders_List where BidderID= '" . $getUploadedOthersBidderID . "'";
                                                                        $getBidderQuery = ExecQuery($getBidderSQl);
                                                                        $getBidder_Name = mysql_result($getBidderQuery, 0, 'Bidder_Name');
                                                                        ?>
                                                                    <tr>
                                                                        <td align="center" bgcolor="#FFCC99"><?php echo $getUploadedOthersFeedback; ?></td>    <td align="center" bgcolor="#FFCC99"><?php echo $getUploadedOthersComments; ?></td> <td align="center" bgcolor="#FFCC99" ><?php echo $getBidder_Name; ?></td><tr><?php
                                                }
                                            }
                                            ?>
                                                        </table>

                                            <?php
                                        }
                                        echo '</td>';
                                    }
                                    ?>	
                                    </tr>
                                            <?
                                            $i = $i + 1;
                                        }
                                    }
                                    ?>
                        </table>
                        <br>
                        <table width="758"  border="0" cellpadding="5" cellspacing="1">
                                    <?
                                    if ($recordcount > 0) {
                                        ?>
                                <tr>
                                    <td align="center" class="bluelink">
                                        <?
                                        $c = 1;
                                        for ($c = 1; $c <= $maxpage; $c++) {
                                            if ($pageno == $c) {

                                                echo $c . "&nbsp;";
                                            } else {
                                                ?>
                                                <a onClick="javascript:sendmail('<? echo "&id=" . $i . "&pageno=" . $c; ?>')" style="cursor:hand"><? echo $c; ?></a>
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
    <?php
    $getAgentQuery = ExecQuery("select BidderID,Associated_Bank,Status from Bidders where leadidentifier='AccountFullertonProcess' and Global_Access_ID like '%" . $BidderID . "%' ORDER BY Associated_Bank ASC");
    $rowAgentCnt = mysql_num_rows($getAgentQuery);
    if ($rowAgentCnt > 0) {
        ?>
                            <form name="xlsdownload" action="bidder_download_fullerton_020317yash.php" method="post">
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
                                    <?php
                                }
                            }
                            ?>

                                </td></tr></table>
<?

function getJumpMenu($varPHPPage, $varRequestID, $varType, $varFeedback, $varpageon, $varmindate, $varmaxdate, $cmbfeedback, $varVal, $allocate_bidder, $city) {
    $strURL = "";
    $strURL = $varPHPPage . "?search=y&RequestID=" . $varRequestID . "&type=" . $varType . "&pageno=" . $varpageon . "&min_date=" . urlencode($varmindate) . "&max_date=" . urlencode($varmaxdate) . "&cmbfeedback=" . urlencode($cmbfeedback) . "&product=" . $varVal . "&allocated_bidder=" . $allocate_bidder . "&city=" . $city;
    ?>
                                <select name="type" id="type" onChange="MM_jumpMenu('parent', this, 0)">
                                    <option value="<? echo $strURL . '&Feedback=' ?>" <? if ($varFeedback == "") {
        echo "selected";
    } ?> >No Feedback</option>
                                    <option value="<? echo $strURL . '&Feedback=Process' ?>" <? if ($varFeedback == "Process") {
        echo "selected";
    } ?>>Process</option>
                                    <option value="<? echo $strURL . '&Feedback=Not Eligible' ?>" <? if ($varFeedback == "Not Eligible") {
        echo "selected";
    } ?>>Not Eligible</option>
                                    <option value="<? echo $strURL . '&Feedback=Not Interested' ?>" <? if ($varFeedback == "Not Interested") {
        echo "selected";
    } ?>>Not Interested</option>
                                    <option value="<? echo $strURL . '&Feedback=Callback Later' ?>" <? if ($varFeedback == "Callback Later") {
                                echo "selected";
                            } ?>>Callback Later</option>
                                    <option value="<? echo $strURL . '&Feedback=Wrong Number' ?>" <? if ($varFeedback == "Wrong Number") {
                                echo "selected";
                            } ?>>Wrong Number</option>
                                    <option value="<? echo $strURL . '&Feedback=Closed' ?>" <? if ($varFeedback == "Closed") {
                                echo "selected";
                            } ?>>Closed</option>
                                    <option value="<? echo $strURL . '&Feedback=FollowUp' ?>" <? if ($varFeedback == "FollowUp") {
                                echo "selected";
                            } ?>>FollowUp</option>
    <? //}  ?>
                                    <option value="<? echo $strURL . '&Feedback=Not Available' ?>" <? if ($varFeedback == "Not Available") {
        echo "selected";
    } ?>>Not Available</option>
                                    <option value="<? echo $strURL . '&Feedback=Ringing' ?>" <? if ($varFeedback == "Ringing") {
        echo "selected";
    } ?>>Ringing</option>
                                    <option value="<? echo $strURL . '&Feedback=Documents Pick' ?>" <? if ($varFeedback == "Documents Pick") {
        echo "selected";
    } ?>>Documents Pick</option>
                                    <option value="<? echo $strURL . '&Feedback=Loan Rejected' ?>" <? if ($varFeedback == "Loan Rejected") {
        echo "selected";
    } ?>>Loan Rejected</option>
                                    <option value="<? echo $strURL . '&Feedback=Appointment' ?>" <? if ($varFeedback == "Appointment") {
        echo "selected";
    } ?>>Appointment</option>
                                    <option value="<? echo $strURL . '&Feedback=Not interested for ROI' ?>" <? if ($varFeedback == "Not interested for ROI") {
        echo "selected";
    } ?>>Not interested for ROI</option>
                                    <option value="<? echo $strURL . '&Feedback=Not interested for LoanAmt' ?>" <? if ($varFeedback == "Not interested for LoanAmt") {
        echo "selected";
    } ?>>Not interested for LoanAmt</option>

                                </select>	
    <?
}
?>
                            <script type="text/javascript">
                                var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
                                document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
                            </script>
                            <script type="text/javascript">
                                try {
                                    var pageTracker = _gat._getTracker("UA-1312775-1");
                                    pageTracker._trackPageview();
                                } catch (err) {
                                }</script>
                            </body>
                            </html>
