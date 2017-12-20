<?php
ini_set("display_errors", "1");
error_reporting(E_ALL);
require_once("includes/application-top-inner.php");

//include "../../api/v1/converttopdf/convert2pdf.pdf";
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

$dwlndtomorrow  = mktime(0, 0, 0, date("m")  , date("d")-60, date("Y"));
$daydwlnd=date('Y-m-d',$dwlndtomorrow);

$salaryclause="";
if(isset($_REQUEST['salaryrange']))
{
	$salaryclause=$_REQUEST['salaryrange'];
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

$RequestID="";
if(isset($_REQUEST['RequestID']))
{
	$RequestID=$_REQUEST['RequestID'];
}

$pan_num="";
if(isset($_REQUEST['pan_num']))
{
	$pan_num=$_REQUEST['pan_num'];
}

$lmstyped="";
if(isset($_REQUEST['lmstyped']))
{
	$lmstyped=$_REQUEST['lmstyped'];
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
			defaultDate: "+1w",
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

	 function popitup(url) {
            newwindow=window.open(url,'name','height=280,width=200');
            if (window.focus) {newwindow.focus()}
            return false;
            }
</script>
</head>
<body style="margin:0px 0px 0px 0px; padding:0px 0px 0px 0px; background-color:#45B2D8;">
<!-- End Main Banner Menu Panel -->
<div style="width:100%; background: #CCC; padding:0px 0px 10px 0px;">
	<div style="background:#F00; width:40px; padding-left:7px; line-height:30px; height:30px; float:right; margin-right:50px; margin-top:7px; border-radius:20%;">
		<a href="logout.php" style="color:#FFF; text-align:center; text-decoration:none; font-size:12px;">Logout</a>
	</div>
	<div style="clear:both;"></div>
</div>
<div style="clear:both; height:15px;"></div>
<div> 
    <table width="98%" border="0">
		<tr>
			<td align="right"><a href="creditreport_completeview.php"> Complete cibil report</a></td>
		</tr>
        <tr>
			<td align="center" width="100%"><div align="center">
            <table width="600" border="0" cellpadding="4" cellspacing="1" class="blueborder" bgcolor="#FFFFFF">
				<form name="frmsearch" action="creditreport_index.php" method="get" onSubmit="return chkform();">
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
						<input name="min_date" type="text" id="min_date" size="15" <? if($min_date=="" || $min_date<$daydwlnd) { ?>value="<? echo $daydwlnd; ?>"<? } else { ?>value="<? echo $min_date; ?>" <? } ?> >
					</td>
					<td width="13%" style="text-align:right;">To</td>
					<td>
						<input name="max_date" type="text" id="max_date" size="15" value="<? echo $_REQUEST['max_date']; ?>">
					</td>
                </tr>
				<? if($_SESSION['BidderID']==7193)
				{ ?>
				<tr>
					<td width="29%" align="center"  valign="middle" class="bidderclass">Select source</td>
					<td width="58%"  valign="middle" class="bidderclass">
						<select name="lmstyped" id="lmstyped">
							<option value="">Please Select</option>
							<?php $lmstype=explode(",",$_SESSION['City']);
							for($c=0;$c<count($lmstype);$c++)
							{ ?>
							<option value="<? echo $lmstype[$c]; ?>" <? if($lmstyped==$lmstype[$c]) {echo "selected";} ?>><? echo $lmstype[$c]; ?></option>
							<? 
							} ?>
							<option value="wishfin">Wishfin</option>
						</select>
					</td>
					<td width="12%">&nbsp;</td>
					<td width="29%">&nbsp;</td>
				</tr>
				<? } ?>
                <tr>
					<td width="12%">&nbsp;</td>
					<td width="29%">&nbsp;</td>
					<td width="29%" align="center"  valign="middle" class="bidderclass">Search with Pan No</td>
					<td width="58%"  valign="middle" class="bidderclass">
						<input type="text" name="pan_num" id="pan_num" value="<?php echo $pan_num; ?>" >
					</td>
                </tr>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td align="left">
						<input name="Submit" type="submit" class="bluebutton" value="Search" border="0">
					</td>
                </tr>
				</form>
            </table>
            <p>&nbsp;</p>
            <?	
			$search_date="";
			if($search=="y")
			{		
			?>  
			<p class="bodyarial11">
            <?=$Msg?>
            </p>
            <p><span id="name_status" style="color:#F00; font-weight:bold;"></span> </p>
            <table width="758" border="0" cellpadding="4" cellspacing="1" class="blueborder" bgcolor="#FFFFFF">
				<? 
				if($pan_num!='')
				{
					$pan_num_clause = " AND api_customer_cibil.pancard = '".$pan_num."' ";
				}
				if($lmstyped!='')
				{
					$lmstype_clause = " AND api_customer_cibil.process_source = '".$lmstyped."' ";
				}
				if($_SESSION['BidderID']!="")
				{
					if($_SESSION['BidderID']==7193)
					{
						if($lmstyped=="wishfin")
						{
							$qry="SELECT * FROM xkyknzl5dwfyk4hg_cibil WHERE (status=1 and DATE(`date_created`) between '".$min_date."' and '".$max_date."')";
							//$qry=$qry.$pan_num_clause.$lmstype_clause;
						}
						else
						{
						$qry="SELECT * FROM `api_customer_cibil` WHERE (status=1 and `pancard`!='' and `first_name`!='' and DATE(`date_created`) between '".$min_date."' and '".$max_date."')";
						$qry=$qry.$pan_num_clause.$lmstype_clause;
						}
					}
					else
					{
						$qry="SELECT * FROM `api_customer_cibil` WHERE (status=1 and `process_source` ='".$_SESSION['City']."' and `pancard`!='' and `first_name`!='' and DATE(`date_created`) between '".$min_date."' and '".$max_date."')";
						$qry=$qry.$pan_num_clause;
					}
				}		
				$srh_qry = $qry;

				$resCount = $objAdmin->fun_get_num_rows($qry);
				if($resCount>$limit)
				{
					$pagelinks = paginate($limit, $resCount);
				}
				$qry.= " order by `date_created` DESC LIMIT $start,$limit ";
				$result = $obj->fun_db_query($qry);
				?>
				<tr>
					<td colspan="11"><strong><? echo $start+1; ?> to <? echo $start+$limit; ?> Out of <? echo $resCount; ?> Records </strong></td>
				</tr>
				<tr>
					<td class="head1">Name</td>
					<td class="head1">City</td>
					<!--<td class="head1">Feedback</td>     -->           
					<td class="head1">Comments</td> 
					<td class="head1">download pdf</td> 
				</tr>
				<?			
				$filenameinclude="";
				$appendurl="";
				if($resCount>0)
				{
					$color = 1;		
					while($row = $obj->fun_db_fetch_rs_object($result))
					{
						$Id=$row->id;
						if($color%2!=0)
						{
							$colorvar = "#FFF";
						}
						else{
							$colorvar = "#EEE";
						}
				?>
				<tr  bgcolor="<?php echo $colorvar;?>">			 
					<td class="bodyarial11">
					<?php 
					$cbrtfrow = new stdClass();
					$responseData = '';
					$reportcheck="Select id,cibil_email From `api_log_cibil` where (api_from='CibilCustomerAssets' and product='CreditScore' and cibil_score>0 and cibil_email!='' and productid='".$Id."')";
					$cbrtresult = $obj->fun_db_query($reportcheck);
					$cbrtrow = $obj->fun_db_fetch_rs_object($cbrtresult);
					$ldid = $cbrtrow->id;
					if($ldid>0) {
					$strencode= "email=".$cbrtrow->cibil_email."&id=".$ldid;
					$appendurl= base64_encode($strencode);
					$responseData = "Cibil Score fetched successfully";
					
					?>
						<a href="http://www.deal4loans.com/cibil/creditreport.php?<?php echo $appendurl; ?>" target="_blank"><? echo $row->first_name; ?></a>
					<? 
					} else {
						$reportfailcheck="Select api_response_data From `api_log_cibil` where (product='CreditScore' and productid='".$Id."') order by id DESC Limit 0,1";
						$cbrtresultf = $obj->fun_db_query($reportfailcheck);
						$cbrtfrow = $obj->fun_db_fetch_rs_object($cbrtresultf);
						echo $row->first_name;
						if(!empty($cbrtfrow->api_response_data)){
							$responseData = $cbrtfrow->api_response_data;
						}
						else{
							$responseData = "Unable to fetch Cibil Score";
						}
					}
					?>
					</td>
					<td class="bodyarial11"><? echo $row->city_name; ?></td>
					<?
					if($row->City=="Others")
					{
						$City= $row->City_Other;
					}
					else
					{
						$City= $row->City;
					}
					?>              
					<td class="bodyarial11">
						<textarea rows="3" cols="30"><? echo $responseData; ?></textarea>
					</td>
					<td>
					<?php					 
               if($responseData == "Cibil Score fetched successfully")
						{
				$fileName=$row->first_name."_".$row->pancard.".pdf";
                // create pdf
                 ?><a href="getcibilpdf.php?vid=<?php echo $appendurl; ?>&flnme=<?php echo $fileName; ?>&src=" target="_blank">Download<? } ?></td>
				</tr>
					<?
					$color++;
					}
				}
				?>
			</table>
			<br>
            <table  border="0" cellpadding="5" cellspacing="1" align="center">
				<tr>
					<td style="color:#FFF;" align="center" bgcolor="#FFFFFF"><?php echo $pagelinks;?></td>
				</tr>
			</table>
            <?
			}
			?>
		</div>
	</td>
</tr>
</table>
</div>
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
