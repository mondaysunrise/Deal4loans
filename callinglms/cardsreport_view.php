<?php
require_once("includes/application-top-inner.php");
define("TABLE_CREDIT_CARD_BANKS_APPLY", "credit_card_banks_apply");
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
        <td align="right"></td>
      </tr>
              <tr>
        <td align="center" width="100%"><div align="center">
            <table width="600" border="0" cellpadding="4" cellspacing="1" class="blueborder" bgcolor="#FFFFFF">
              <form name="frmsearch" action="cardsreport_view.php" method="get" onSubmit="return chkform();">
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
                  <td width="12%"><strong>Feedback:</strong></td>
                  <td width="29%"><select name="cmbfeedback" id="cmbfeedback">
                      <option value="" <? if($varCmbFeedback == "") { echo "selected"; } ?>>All</option>
                      <option value="Approved" <? if($varCmbFeedback == "Approved") { echo "selected"; } ?>>Approved</option>
                      <option value="Refer" <? if($varCmbFeedback == "Refer") { echo "selected"; } ?>>Refer</option>
                      <option value="Reject" <? if($varCmbFeedback == "Reject") { echo "selected"; } ?>>Reject</option>
                      <option value="Error" <? if($varCmbFeedback == "Error") { echo "selected"; } ?>>Error</option>
                       </select></td>
                   <td width="29%" align="center"  valign="middle" class="bidderclass">Bank Name</td>				   
	  <td width="58%"  valign="middle" class="bidderclass"><select name="bank_name" ><option value="">Please Select</option><?php 
	  echo $getbankname="SELECT applied_bankname FROM `credit_card_banks_apply` WHERE (`applied_bankname` != '') GROUP BY applied_bankname"; 
	  $resultbnkname=$obj->fun_db_query($getbankname); 
	
	  while($bnkrow=$obj->fun_db_fetch_rs_array($resultbnkname))
	  { ?>
		<option value="<?php echo $bnkrow["applied_bankname"]; ?>" <?php if($bank_name==$bnkrow["applied_bankname"]) { echo "Selected"; } ?>><?php echo $bnkrow["applied_bankname"]; ?></option>
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
		if(strlen(trim($varCmbFeedback))>0)
		{
			if(trim($bank_name)=="American Express")
			{
				if(trim($varCmbFeedback)=="Approved")
				{
					$FeedbackClause=" and response_data like '%<success>false</success>%'";
				}
				elseif(trim($varCmbFeedback)=="Reject")
				{
					$FeedbackClause=" and response_data like '%<success>false</success>%' and response_data not like '%<errorDesc>%'";
				}
				elseif(trim($varCmbFeedback)=="Error")
				{
					$FeedbackClause=" and response_data like '%<success>false</success>%' and response_data like '%<errorDesc>%'";
				}
				else
				{
					$FeedbackClause="";
				}				
			}
			if(trim($bank_name)=="RBL Bank")
			{
				if(trim($varCmbFeedback)=="Approved")
				{
					$FeedbackClause=" and response_data like '%Status -1%' and request_data like '%rbl%'";
				}
				elseif(trim($varCmbFeedback)=="Reject")
				{
					$FeedbackClause=" and response_data like '%Status -0%' and Errorcode -6 and request_data like '%rbl%'";
				}
				elseif(trim($varCmbFeedback)=="Refer")
				{
					$FeedbackClause=" and response_data like '%Status -2%' and request_data like '%rbl%'";
				}
				elseif(trim($varCmbFeedback)=="Error")
				{
					$FeedbackClause=" and response_data like '%Status -0%' and (response_data like '%Errorcode -1%' or response_data like '%Errorcode -2%' or response_data like '%Errorcode -3%' or response_data like '%Errorcode -4%' or response_data like '%Errorcode -5%') and request_data like '%rbl%'";
				}
				else
				{
					$FeedbackClause="";
				}				
			}
			if(trim($bank_name)=="ICICI Bank")
			{
				if(trim($varCmbFeedback)=="Approved")
				{
					$FeedbackClause=" and response_data like '%Approved%' and response_data like '%Congratulations%'";
				}
				elseif(trim($varCmbFeedback)=="Reject")
				{
					$FeedbackClause=" and response_data like '%Declined%' and response_data like '%Thank you%'";
				}
				elseif(trim($varCmbFeedback)=="Refer")
				{
					$FeedbackClause=" and response_data like '%Referred%'";
				}
				elseif(trim($varCmbFeedback)=="Error")
				{
					$FeedbackClause=" and response_data like '%Declined%' and response_data like '%Error Code%'";
				}
				else
				{
					$FeedbackClause="";
				}				
			}
		}
	?>       <p class="bodyarial11">
              <?=$Msg?>
            </p>
            <table width="758" border="0" cellpadding="4" cellspacing="1" class="blueborder" bgcolor="#FFFFFF">
              <? $srh_qry=""; 
		echo $bank_name;
		if($_SESSION['BidderID']!="" && strlen(trim($bank_name))>0 && $_SESSION['BidderID']==6681)
		{ 
			$qry="Select * from ".TABLE_CREDIT_CARD_BANKS_APPLY." LEFT OUTER JOIN ".TABLE_REQ_CREDIT_CARD." ON ".TABLE_REQ_CREDIT_CARD.".RequestID=".TABLE_CREDIT_CARD_BANKS_APPLY.".cc_requestid where (".TABLE_CREDIT_CARD_BANKS_APPLY.".applied_bankname like '%".trim($bank_name)."%' and (date_created Between '".($min_date)."' and '".($max_date)."') and ".TABLE_CREDIT_CARD_BANKS_APPLY.".request_data!='')";
			$qry=$qry.$FeedbackClause."";
			
		}	//	
$srh_qry = $qry;

//echo $srh_qry;
$resCount = $objAdmin->fun_get_num_rows($qry);
if($resCount>$limit)
{
	$pagelinks = paginate($limit, $resCount);
}

if($_SESSION['BidderID']==6681)
			{
	
$qry.= " order by date_created DESC LIMIT $start,$limit ";
		}

$result = $obj->fun_db_query($qry);
 ?>
              <tr>
                <td colspan="11"><strong><? echo $start+1; ?> to <? echo $start+$limit; ?> Out of <? echo $resCount; ?> Records </strong></td>
              </tr>
              <tr>
                <td class="head1">Name</td>
				<td class="head1">Salary</td>
                <td class="head1">City</td>
                <td class="head1">lead source</td>                         
            	<td class="head1">DOE</td> 
                <!--  <td class="head1">Feedbackfrom Other LMS</td>--> 
              </tr>
              <?			
		if($resCount>0)
			{
				$color = 1;		
		while($row = $obj->fun_db_fetch_rs_object($result))
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
                <td class="bodyarial11"><?php echo $row->Name; ?></td>
                <td class="bodyarial11"><? echo $row->Net_Salary; ?></td>
                <td class="bodyarial11"><? echo $row->City; ?></td>
						<td class="bodyarial11"><? echo $row->lead_source; ?></td>
				 <td class="bodyarial11"><? echo $row->Updated_Date; ?></td>
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
<?	  if($_SESSION['BidderID']==6681 && $search=="y")
			{ 
				 $datediffvar= timeDiff($varmin_date,$varmax_date);
   if($datediffvar<=7)
		{ ?>
	  <tr><td colspan="2" align="center"><table width="500" border="0" cellspacing="1" cellpadding="4">
			 <form name="frmdownload" action="/cards_download.php" method="post">
			   <tr>
				 <td align="center">
				 <input type="hidden" name="qry1" value="<? echo $srh_qry; ?>">
				 <input type="hidden" name="qry2" value="Req_Credit_Card">
				 <input type="hidden" name="min_date" value="<? echo $min_date; ?>">
				 <input type="hidden" name="max_date" value="<? echo $max_date; ?>">
				 <input name="Submit2" type="submit" class="bluebtn" value="Export List To Excel">
				 </td>
			   </tr>
			 </form>
			 </table></td></tr>
			 <? } 
			}?>
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
