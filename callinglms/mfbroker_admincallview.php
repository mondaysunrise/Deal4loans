<?php
require_once("includes/application-top-inner.php");

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

	
$salaryclause="";
if(isset($_REQUEST['salaryrange']))
{
		$salaryclause=$_REQUEST['salaryrange'];

}
   
	$FeedbackClause="";
	//$OrderBy=" order by Req_Loan_Personal.Dated desc";
	$mob_num="";
	if(isset($_REQUEST['mob_num']))
	{
		$mob_num = $_REQUEST['mob_num'];
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
	
	$bank_name="";
	if(isset($_REQUEST['bank_name']))
	{
		$bank_name=$_REQUEST['bank_name'];
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

	$RequestID="";
	if(isset($_REQUEST['RequestID']))
	{
		$RequestID=$_REQUEST['RequestID'];
	}
	
	$Feedback="";
	if(isset($_REQUEST['Feedback']))
	{
		$Feedback=$_REQUEST['Feedback'];
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
		</script>
		<!--DatePicker End-->
		</head>
		<body style="margin:0px 0px 0px 0px; padding:0px 0px 0px 0px; background-color:#45B2D8;">
<!-- End Main Banner Menu Panel --><div style="width:100%; background: #CCC; padding:0px 0px 10px 0px;"><div style="background:#F00; width:40px; padding-left:7px; line-height:30px; height:30px; float:right; margin-right:50px; margin-top:7px; border-radius:20%;"><a href="logout.php" style="color:#FFF; text-align:center; text-decoration:none; font-size:12px;">Logout</a></div>
<div style="clear:both;"></div>
</div>
<div style="clear:both; height:15px;"></div>
          <div> 
    <table width="98%" border="0">
	              <tr>
        <td align="right"><a href="mfbroker_adminview.php"> lead allocate mis</td>
      </tr>
              <tr>
        <td align="center" width="100%"><div align="center">
            <table width="600" border="0" cellpadding="4" cellspacing="1" class="blueborder" bgcolor="#FFFFFF">
              <form name="frmsearch" action="mfbroker_admincallview.php" method="get" onSubmit="return chkform();">
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
                  <td><input name="max_date" type="text" id="max_date" size="15" value="<? echo $_REQUEST['max_date']; ?>"></td>
                </tr>
                <tr>
                  <td width="12%"></td>
                  <td width="29%"></td>
                   <td width="29%" align="center"  valign="middle" class="bidderclass">Broker id</td>				   
	  <td width="58%"  valign="middle" class="bidderclass"><select name="bank_name" ><option value="">Please Select</option><?php 
	  $getbankname="SELECT id FROM xkyknzl5dwfyk4hg_mf_broker_user where (status=1) GROUP BY id"; 
	  $resultbnkname=$objwf->fun_db_query($getbankname); 
		  while($bnkrow=$objwf->fun_db_fetch_rs_array($resultbnkname))
	  { ?>
		<option value="<?php echo $bnkrow["caller_mobile_number"]; ?>" <?php if($bank_name==$bnkrow["caller_mobile_number"]) { echo "Selected"; } ?>><?php echo $bnkrow["id"]; ?></option>
	 <? }
 ?></select></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td align="left"><input name="Submit" type="submit" class="bluebutton" value="Search" border="0"></td>
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
	}
	if($search=="y")
	{		
		$min_dateonly=$min_date;
		$max_dateonly=$max_date;
		$min_date=$min_date." 00:00:00";
		$max_date=$max_date." 23:59:59";
		
	?>       <p class="bodyarial11">
              <?=$Msg?>
            </p>
            <table width="758" border="0" cellpadding="4" cellspacing="1" class="blueborder" bgcolor="#FFFFFF">
              <? $srh_qry=""; 
		
		if($_SESSION['BidderID']!="" && $_SESSION['BidderID']==7530)
		{ 
			if($bank_name=="")
			{
				$qry="Select count(id) AS countcall,bidder_phone,DATE(date_started) AS calldate from xkyknzl5dwfyk4hg_tms_broker_api where (DATE(date_started) Between '".$min_dateonly."' and '".$max_dateonly."') group by bidder_phone, DATE(date_started)";
			}
			else
			{
			$qry="Select count(id) As countcall,bidder_phone,DATE(date_started) AS calldate from xkyknzl5dwfyk4hg_tms_broker_api where (DATE(date_started) Between '".$min_dateonly."' and '".$max_dateonly."' and bidder_phone='".$bank_name."') group by bidder_phone, DATE(date_started)";
			}
			$qry=$qry.$FeedbackClause."";
			
		}	//	
$srh_qry = $qry;
$resCount = $objwf->fun_get_num_rows($qry);
if($resCount>$limit)
{
	$pagelinks = paginate($limit, $resCount);
}

		if($_SESSION['BidderID']==7530)
			{
		$qry.= " order by xkyknzl5dwfyk4hg_tms_broker_api.date_started DESC LIMIT $start,$limit ";
			}
		//echo $qry;
		$result = $objwf->fun_db_query($qry);
 ?>
              <tr>
                <td colspan="11"><strong><? echo $start+1; ?> to <? echo $start+$limit; ?> Out of <? echo $resCount; ?> Records </strong></td>
              </tr>
              <tr>
                <td class="head1">count</td>
                <td class="head1">Broker id</td>                        
            	<td class="head1">date</td> 
                <!--  <td class="head1">Feedbackfrom Other LMS</td>--> 
              </tr>
              <?			
		if($resCount>0)
			{
				$color = 1;		
		while($row = $objwf->fun_db_fetch_rs_object($result))
		{
				if($color%2!=0)
					{
						$colorvar = "#FFF";
					}
				else{
						$colorvar = "#EEE";
					}
	?>
			<tr  bgcolor="<?php echo $colorvar;?>">			 
			<td class="bodyarial11"><?php echo $row->countcall; ?></td>
			<td class="bodyarial11"><? 
			$getfbname="SELECT id FROM xkyknzl5dwfyk4hg_mf_broker_user where (caller_mobile_number='".$row->bidder_phone."' and status=1) "; 
			$resultfbname=$objwf->fun_db_query($getfbname); 
			$fbrow=$objwf->fun_db_fetch_rs_object($resultfbname);			 
			echo $fbrow->id; ?></td>
			<td class="bodyarial11"><?php echo $row->calldate; ?></td>
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
 ?>            </div></td>
      </tr>

            </table>
        </div>
		<?
	function timeDiff($firstTime,$lastTime)
		{
		$firstTime=strtotime($firstTime);
		$lastTime=strtotime($lastTime);
		$timeDiff = ($lastTime-$firstTime)/86400;
		return $timeDiff;
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
} catch(err) {}</script>
</body>
</html>
