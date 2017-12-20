<?php
require_once("includes/application-topbl.php");
$IP_Remote = $_SERVER["REMOTE_ADDR"];
if($IP_Remote=='192.124.249.12' || $IP_Remote=='185.93.228.12') { $IP= $_SERVER['HTTP_X_SUCURI_CLIENTIP']; }
else { $IP= $IP_Remote;	}
define("NoOFLMS", 2);
if(!empty($_GET['page'])){
$page = $_GET['page'];
}else{
$page = 1;
}
$limit = 25;
$start = ($page - 1) * $limit;
//print_r($_SESSION);
//echo "<br>".$_SESSION["BidderID"];
$BidderIDstatic="";
	if(isset($_REQUEST['BidderIDstatic']) && strlen($_REQUEST['BidderIDstatic'])>0 )
	{
		 $BidderIDstatic=$_REQUEST['BidderIDstatic'];
	}
	
	if(isset($BidderIDstatic) && strlen($_REQUEST['BidderIDstatic'])>0)
	{
$_SESSION["BidderID"] = $BidderIDstatic;
	}
	
 $dwlndtomorrow  = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"));
	 $daydwlnd=date('Y-m-d',$dwlndtomorrow);
	 
 
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

	

?>
<html>
	<head>
	<meta http-equiv="Content-Language" content="en-us">
	<meta http-equiv="Content-Type" content="text/html; charset=WINDOWS-1252">
	<title>Login</title>
	<script Language="JavaScript" Type="text/javascript" src="../scripts/common.js"></script>
	<link href="../includes/style1.css" rel="stylesheet" type="text/css">
	<link href="../style.css" rel="stylesheet" type="text/css" />
	<script language="javascript" type="text/javascript" src="../scripts/datetime.js"></script>
	<style>
/* Pagination*/

div.pagination {
	padding: 3px;
	margin: 3px;
}
div.pagination a {
	padding: 2px 5px 2px 5px;
	margin: 2px;
	border: 1px solid #AAAADD;
	text-decoration: none; /* no underline */
	color: #000099;
}
div.pagination a:hover, div.pagination a:active {
	border: 1px solid #000099;
	color: #000;
}
div.pagination span.current {
	padding: 2px 5px 2px 5px;
	margin: 2px;
	border: 1px solid #000099;
	font-weight: bold;
	background-color: #2b62b5;
	color: #FFF;
}
div.pagination span.disabled {
	padding: 2px 5px 2px 5px;
	margin: 2px;
	border: 1px solid #CCC;
	color: #CCC;
}
</style>
		<!--DatePicker Start-->
		<link rel="stylesheet" type="text/css" href="css-datepicker/jquery-ui.css">
		<link rel="stylesheet" type="text/css" href="css-datepicker/datepicker.css">
		<script src="js-datepicker/jquery-1.5.1.js"></script>
		<script src="js-datepicker/jquery.ui.core.js"></script>
		<script src="js-datepicker/jquery.ui.datepicker.js"></script>
		<script> 
			$(function() {
				var dates = $( "#min_date, #max_date" ).datepicker({
					defaultDate: "-1",
					changeMonth: true,
					changeYear: true,
					numberOfMonths: 1,
					onSelect: function( selectedDate ) {
						var option = this.id == "min_date" ? "minDate" : "maxDate",
							instance = $( this ).data( "datepicker" ),
							date = $.datepicker.parseDate(
								instance.settings.dateFormat ||
								$.datepicker._defaults.dateFormat,
								selectedDate, instance.settings );
						dates.not( this ).datepicker( "option", option, date );
					}
				});
			});

		function MM_jumpMenu(targ,selObj,restore){ //v3.0
 eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
if (restore) selObj.selectedIndex=0;
}

		</script>

		<!--DatePicker End-->
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

   <style type="text/css">
.discennect-row{ background:#FFF; padding:10px; border-radius:5px; width:600px; margin:auto; font-family:Arial, Helvetica, sans-serif;}
.diler-status-select{padding:10px; border:thin solid #CCC; width:200px;}
.disconnect-btn{ padding:10px; border-radius:5px; color:#FFF; text-align:center; background:#06C; text-decoration:none;}
</style>
		</head>
		<body style="margin:0px 0px 0px 0px; padding:0px 0px 0px 0px; background-color:#45B2D8;">
<!-- End Main Banner Menu Panel --><div style="width:100%; background: #CCC; padding:0px 0px 10px 0px;"><div style="background:#F00; width:40px; padding-left:7px; line-height:30px; height:30px; float:right; margin-right:50px; margin-top:7px; border-radius:20%;"><a href="logout.php" style="color:#FFF; text-align:center; text-decoration:none; font-size:12px;">Logout</a></div>
<div style="clear:both;"></div>
</div>
<div style="clear:both; height:15px;"></div>
          <div> 
    <table width="98%" border="0">
	
              <tr>
        <td align="right"></td>
      </tr>
              <tr>
        <td align="center" width="100%"><div align="center">
            <table width="600" border="0" cellpadding="4" cellspacing="1" class="blueborder" bgcolor="#FFFFFF">
              <form name="frmsearch" action="sbi_mis_cc_index.php" method="get" onSubmit="return chkform();">
                <input type="hidden" name="BidderIDstatic" id="BidderIDstatic" value="<? echo $_SESSION["BidderID"];?>">
                <input type="hidden" name="search" id="search" value="y">
                <tr>
                  <td colspan="4" class="head1">Search</td>
                </tr>
                <tr>
                  <td colspan="3">&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td width="12%"><strong>Date:</strong></td>
                  <td width="29%">From
                    <input name="min_date" type="text" id="min_date" size="15" value="<? echo $_REQUEST['min_date']; ?>" ></td>
                  <td width="13%" style="text-align:right;">To</td>
                  <td><input name="max_date" type="text" id="max_date" size="15" value="<? echo $_REQUEST['max_date']; ?>">
                  <input type="hidden" name="cmbfeedback" id="cmbfeedback" value="All" />
                  </td>
                </tr>
             
              
				<tr>
				 <td>&nbsp;</td>
                  <td colspan="3" align="left"><input name="Submit" type="submit" class="bluebutton" value="Search" border="0"></td>
                </tr>
              </form>
            </table>
            <p>&nbsp;</p>
            <?	
       	$search_date="";
	$varmin_date=$min_date;
	$varmax_date=$max_date;

	
	if($search=="y")
	{		
		
		$min_date=$min_date." 00:00:00";
		$max_date=$max_date." 23:59:59";
	
	
	?>       <p class="bodyarial11">
              <?=$Msg?>
            </p>
             <p><span id="name_status" style="color:#F00; font-weight:bold;"></span> </p>
            <table width="1024" border="0" cellpadding="4" cellspacing="1" class="blueborder" bgcolor="#FFFFFF">
	<tr><td style="color:#000; font-size:14px; font-weight:bold;">Total Count of Leads</td><td style="color:#000; font-size:14px; font-weight:bold;">
           <?  
	
			
			$qry="SELECT count(*) as countTotal FROM `Req_Credit_Card` as rcc LEFT JOIN `sbi_credit_card_5633`as scc ON(scc.RequestID = rcc.RequestID AND scc.process_type = 'direct') WHERE (rcc.`source` = 'sbi_cards_apply') AND (DATE(rcc.`Dated`) BETWEEN '".$min_date."' AND '".$max_date."')  ORDER BY `rcc`.`RequestID`  DESC";
			
			$resCount = $objAdmin->fun_get_num_rows($qry);
		
			$result = $obj->fun_db_query($qry);
			$row = $obj->fun_db_fetch_rs_object($result);
		echo	$countTotal = $row->countTotal;
 ?></td></tr>   
  
	<tr><td style="color:#000; font-size:14px; font-weight:bold;">Approved Leads</td><td style="color:#000; font-size:14px; font-weight:bold;">
           <? 
	$countTotal='';
			
			$qry="SELECT count(*) as countTotal FROM `Req_Credit_Card` as rcc LEFT JOIN `sbi_credit_card_5633`as scc ON(scc.RequestID = rcc.RequestID AND scc.process_type = 'direct') WHERE (rcc.`source` = 'sbi_cards_apply') AND (DATE(rcc.`Dated`) BETWEEN '".$min_date."' AND '".$max_date."') AND (scc.`ProcessingStatus` = 1) ORDER BY `rcc`.`RequestID`  DESC
";
			
			$resCount = $objAdmin->fun_get_num_rows($qry);
		
			$result = $obj->fun_db_query($qry);
			$row = $obj->fun_db_fetch_rs_object($result);
		echo	$countTotal = $row->countTotal;
 ?></td></tr>   

	<tr><td style="color:#000; font-size:14px; font-weight:bold;">Rejected Leads</td><td style="color:#000; font-size:14px; font-weight:bold;">
           <? 
	$countTotal='';

			
			$qry="SELECT count(*) as countTotal FROM `Req_Credit_Card` as rcc LEFT JOIN `sbi_credit_card_5633`as scc ON(scc.RequestID = rcc.RequestID AND scc.process_type = 'direct') WHERE (rcc.`source` = 'sbi_cards_apply') AND (DATE(rcc.`Dated`) BETWEEN '".$min_date."' AND '".$max_date."') AND (scc.`ProcessingStatus` = 7) ORDER BY `rcc`.`RequestID`  DESC";
			
			$resCount = $objAdmin->fun_get_num_rows($qry);
		
			$result = $obj->fun_db_query($qry);
			$row = $obj->fun_db_fetch_rs_object($result);
		echo	$countTotal = $row->countTotal;
 ?></td></tr>   

	<tr><td style="color:#000; font-size:14px; font-weight:bold;">Incomplete Leads</td><td style="color:#000; font-size:14px; font-weight:bold;">
           <? 
	
			$countTotal='';

			$qry="SELECT count(*) as countTotal FROM `Req_Credit_Card` as rcc LEFT JOIN `sbi_credit_card_5633`as scc ON(scc.RequestID = rcc.RequestID AND scc.process_type = 'direct') WHERE (rcc.`source` = 'sbi_cards_apply') AND (DATE(rcc.`Dated`) BETWEEN '".$min_date."' AND '".$max_date."') AND (scc.`sbiccid` IS NULL) ORDER BY `rcc`.`RequestID`  DESC";
			
			$resCount = $objAdmin->fun_get_num_rows($qry);
		
			$result = $obj->fun_db_query($qry);
			$row = $obj->fun_db_fetch_rs_object($result);
		echo	$countTotal = $row->countTotal;
 ?></td></tr>   
             



 <?			
	
		}
	?>
           </table>
              </div></td>
      </tr>
            </table>
        </div>
		
</body>
</html>
