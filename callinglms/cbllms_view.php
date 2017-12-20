<?php
require_once("includes/application-top-inner.php");
define("TABLE_SBI_CCOOFFERS_DIRECTSITE", "sbi_ccoffers_directonsite");
define("NoOFLMS", 2);
function ccMasking($number, $maskingCharacter = 'X') 
{
	return substr($number, 0, 2) . str_repeat($maskingCharacter, strlen($number) - 4) . substr($number, -2);
}


if(!empty($_GET['page'])){
$page = $_GET['page'];
}else{
$page = 1;
}
$limit = 25;
$start = ($page - 1) * $limit;
//print_r($_SESSION);

if(($_SESSION["BidderID"]!==base64_decode($_REQUEST['BidderIDstatic'])) && ISSET($_REQUEST['BidderIDstatic']))
{
	session_unset();
	session_destroy();
	echo "Not a Valid User";
	echo '<meta http-equiv="refresh" content="5; URL=http://www.deal4loans.com/callinglms/lmslogin.php">';
	die(); 
}


$BidderIDstatic="";
	if(isset($_REQUEST['BidderIDstatic']) && strlen($_REQUEST['BidderIDstatic'])>0 )
	{
		 $BidderIDstatic=base64_decode($_REQUEST['BidderIDstatic']);
		// $_SESSION["BidderID"] = base64_decode($BidderIDstatic);
	}
	else
	{
		$BidderIDstatic=$_SESSION["BidderID"];
	}

//	echo $_SESSION["BidderID"];
//	echo $BidderIDstatic;

	
$salaryclause="";
if(isset($_REQUEST['salaryrange']))
{
		$salaryclause=$_REQUEST['salaryrange'];

}
   
  $val = "Req_Loan_Personal";
  
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
	
	$cc_type="";
	if(isset($_REQUEST['cc_type']))
	{
		$cc_type=$_REQUEST['cc_type'];
	}
	$application_no="";
	if(isset($_REQUEST['application_no']))
	{
		$application_no=$_REQUEST['application_no'];
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
					defaultDate: "-1d",
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
		<script type="text/javascript">

    function checkCall(RequestID,agent_user)
    {	
	   $.ajax({ type: 'post',  url: '/dialerclick2callcibilwf.php',  data: {  RequestID:RequestID,agent_user:agent_user, },
			   success: function (response) {
			   //alert(response);
			   $( '#name_status' ).html(response);
  		          if(response=="OK") { return true;	 } else { return false;	}
                }
		      });
	}
	</script>

		<!--DatePicker End-->
		</head>
		<body style="margin:0px 0px 0px 0px; padding:0px 0px 0px 0px; background-color:#45B2D8;">
<!-- End Main Banner Menu Panel -->
<div style="width:100%; background: #CCC; padding:0px 0px 10px 0px;"><div style="background:#F00; width:40px; padding-left:7px; line-height:30px; height:30px; float:right; margin-right:50px; margin-top:7px; border-radius:20%;"><a href="logout.php" style="color:#FFF; text-align:center; text-decoration:none; font-size:12px;">Logout</a></div>
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
              <form name="frmsearch" action="cbllms_view.php" method="get" onSubmit="return chkform();">
                <input type="hidden" name="BidderIDstatic" id="BidderIDstatic" value="<? echo base64_encode($_SESSION["BidderID"]);?>">
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
                      <option value="All" <? if($varCmbFeedback == "All") { echo "selected"; } ?>>All</option>
                      <option value="" <? if($varCmbFeedback == "") { echo "selected"; } ?>>No Feedback</option>
                      <option value="Not Interested" <? if($varCmbFeedback == "Not Interested") { echo "selected"; } ?>>Not Interested</option>
                      <option value="Callback Later" <? if($varCmbFeedback == "Callback Later") { echo "selected"; } ?>>Callback Later</option>
                      <option value="Wrong Number" <? if($varCmbFeedback == "Wrong Number") { echo "selected"; } ?>>Wrong Number</option>
                      <option value="Not Eligible" <?if($varCmbFeedback == "Not Eligible") { echo "selected"; }?>>Not Eligible</option>
                      <option value="Ringing" <?if($varCmbFeedback == "Ringing") { echo "selected"; }?>>Ringing</option>
                      <option value="Not Contactable" <?if($varCmbFeedback == "Not Contactable") { echo "selected"; }?>>Not Contactable</option>
                      <option value="Duplicate" <?if($varCmbFeedback == "Duplicate") { echo "selected"; }?>>Duplicate</option>
                      <option value="FollowUp" <? if($varCmbFeedback == "FollowUp") { echo "selected"; } ?>>FollowUp</option>
					  <option value="Send Now PL" <? if($varCmbFeedback == "Send Now PL") { echo "selected"; } ?>>Send Now PL</option>
					  <option value="Send Now CC" <? if($varCmbFeedback == "Send Now CC") { echo "selected"; } ?>>Send Now CC</option>
					  <option value="Send Now HL" <? if($varCmbFeedback == "Send Now HL") { echo "selected"; } ?>>Send Now HL</option>
					  </select></td>
                   <td width="29%" align="center"  valign="middle" class="bidderclass"></td>
	  <td width="58%"  valign="middle" class="bidderclass"></td>
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
		$strSQL="";
		$Msg="";
		$fbqry="select id from wf_lead_allocate where leadid=$RequestID and callerid=".$BidderIDstatic." AND product=15";
		$result = $obj->fun_db_query($fbqry);	
				
		$num_rows = $obj->fun_db_get_num_rows($result);
		if($num_rows > 0)
		{
			$row = $obj->fun_db_fetch_rs_array($result);
			$strSQL="Update wf_lead_allocate Set feedback='".$Feedback."' ";
			$strSQL=$strSQL."Where id=".$row["id"];
		}
		else
		{
		}

//echo $strSQL;
		$result = $obj->fun_db_query($strSQL);
		if ($result == 1)
		{
		}
		else
		{
			$Msg = "** There was a problem in adding your feedback. Please try again.";
		}
		
	}
	if($search=="y")
	{		
		$min_dateonly=$min_date;
		$max_dateonly=$max_date;

		$min_date=$min_date." 00:00:00";
		$max_date=$max_date." 23:59:59";

		if(strlen(trim($varCmbFeedback))==0)
		{
			$FeedbackClause=" AND (wf_lead_allocate.feedback IS NULL OR wf_lead_allocate.feedback='' OR wf_lead_allocate.feedback='No Feedback') ";
		}
		else if($varCmbFeedback=="All")
		{
			$FeedbackClause=" ";
		}
		else
		{
			$FeedbackClause=" AND wf_lead_allocate.feedback='".$varCmbFeedback."' ";
		}
	
	?>       
	<p class="bodyarial11">
	<?=$Msg?><?php //echo "<pre>"; print_r($_SESSION); ?>
	</p>
	<p align="center"><span id="name_status" style="color:#F00; font-weight:bold;"></span> </p>
	<table width="758" border="0" cellpadding="4" cellspacing="1" class="blueborder" bgcolor="#FFFFFF">
	<? $srh_qry=""; 
		
		if($BidderIDstatic!="")
		{
			$feedback_tble="wf_lead_allocate";

			$qry="SELECT * FROM ".$feedback_tble."  WHERE (".$feedback_tble.".callerid = '".$BidderIDstatic."' and ".$feedback_tble.".product=15 and ( ".$feedback_tble.".date_created Between '".($min_date)."' and '".($max_date)."' or ".$feedback_tble.".followup_date Between '".($min_date)."' and '".($max_date)."') )";
			$qry=$qry.$FeedbackClause." ".$mob_num_clause;
		}	

		$srh_qry = $qry;
		$resCount = $objAdmin->fun_get_num_rows($qry);
		if($resCount>$limit)
		{
			$pagelinks = paginate($limit, $resCount);
		}
		$getParameterVal = min($start+$limit,$resCount) % $limit;
		
		$qry.= " order by date_created DESC LIMIT $start,$limit ";
		
		//echo $qry;
		$result = $obj->fun_db_query($qry);
 ?>
              <tr>
                <td colspan="11"><strong><? echo $start+1; ?> to <? echo $start+$limit; ?> Out of <? echo $resCount; ?> Records </strong></td>
              </tr>
              <tr>
                <td class="head1">Name</td>
                <td class="head1">City</td>
				<td class="head1">Mobile No</td>
				<td class="head1">Cibil Score</td>
				<td class="head1">Report</td>
                <td class="head1">Feedback</td>                
                <td class="head1">FollowUp date</td>               
                <td class="head1">Comments</td>
                <td class="head1">Call</td> 
			   </tr>
              <?			
		if($resCount>0)
			{
				$color = 1;		
		while($row = $obj->fun_db_fetch_rs_object($result))
		{//$objwf->
			$leadid = $row->leadid;
			if($leadid>0)
			{
				$wfcibilqry="SELECT `first_name`, `middle_name`, `last_name`, `gender`, `date_of_birth`, `mobile_number`, `email_id`, `pancard`, `is_pancard_kyc`, `residence_address`, `residence_pincode`, `city_name`, `state_code`, `legal_response`, `cibil_score`, `cibil_score_fetch_date`, `cibil_status`, `cibil_xml_data` FROM `xkyknzl5dwfyk4hg_cibil` Where (id='".$leadid."')";
				$wfresult=$objwf->fun_db_query($wfcibilqry);
				$wfrow = $objwf->fun_db_fetch_rs_object($wfresult);	
				$first_name = $wfrow->first_name;
				$middle_name = $wfrow->middle_name;
				$last_name = $wfrow->last_name;
				$full_name = $first_name." ".$middle_name." ".$last_name;
			}
			//print_r($row);
			$Followup_Date = $row->followup_date;				
			$exptodayformat = explode(" ",$Followup_Date);
			$explodeTime = explode(":",$exptodayformat[1]);
			$explodeHr = $explodeTime[0] - 1; 
			$FinalMinDate = '"'.$exptodayformat[0].' '.$explodeHr.':'.$explodeTime[1].':'.$explodeTime[2].'"';
			$FinalMaxDate ='"'.$exptodayformat[0].' 23:59:59"';
			$TodayFormat = date("Y-m-d");
			$FinalDay = $exptodayformat[0];		
				
			if($color%2!=0)
					{
						$colorvar = "#FFF";
					}
				else{
						$colorvar = "#EEE";
					}
					$appendurl="id=".$leadid."&bid=".$BidderIDstatic;
					$querycoded= base64_encode($appendurl);
	?>
              <!--///////////////////////-->
			  
              <tr  bgcolor="<?php echo $colorvar;?>">			 
                <td class="bodyarial11"><a href="cbllms_leadview.php?postid=<? echo urlencode($leadid); ?>&biddt=<? echo $BidderIDstatic;?>" target="_blank"><?php echo $full_name; ?></a></td>
				<td class="bodyarial11"><?php echo $wfrow->city_name; ?></td>
				<td class="bodyarial11"><?php echo $wfrow->mobile_number; ?></td>
				<td class="bodyarial11"><?php echo $wfrow->cibil_score; ?></td>
				<td class="bodyarial11"><?php if($wfrow->cibil_status=="Success") { ?><a href="http://www.deal4loans.com/cibil/wfcreditreport.php?<?php echo $querycoded; ?>" target="_blank">view report</a><? } ?></td>
               <td class="bodyarial11"><?php echo getJumpMenu("cbllms_view.php",$row->leadid,"15",$row->feedback,$pageno,$varmin_date,$varmax_date,$varCmbFeedback, $val); ?>
     </td>
         <td class="bodyarial11"><input type="text" name="Followup_Date" id="Followup_Date" value="<? echo $Followup_Date; ?>"></td>
	 <td class="bodyarial11"><textarea rows="2" cols="10"><? echo $row->comments; ?></textarea></td>
	 <td class="bodyarial11"><input type="button" name="chkCall" value="Call" onClick="checkCall(<?php echo $row->leadid; ?>,<?php echo $BidderIDstatic ?>)" /></td>
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
function getJumpMenu($varPHPPage, $varRequestID, $varType, $varFeedback, $varpageon, $varmindate, $varmaxdate,$cmbfeedback,$varVal)
{
	$strURL="";
	$strURL=$varPHPPage."?search=y&RequestID=".$varRequestID."&type=".$varType."&pageno=".$varpageon."&min_date=".urlencode($varmindate)."&max_date=".urlencode($varmaxdate)."&cmbfeedback=".urlencode($cmbfeedback)."&product=4";
?>
	<select name="type" id="type" onChange="MM_jumpMenu('parent',this,0)">
		<option value="<? echo $strURL.'&Feedback='?>" <? if($varFeedback == "") { echo "selected"; } ?>>No Feedback</option>
		<option value="<? echo $strURL.'&Feedback=Not Interested'?>" <? if($varFeedback == "Not Interested") { echo "selected"; } ?>>Not Interested</option>
		<option value="<? echo $strURL.'&Feedback=Not Contactable'?>" <? if($varFeedback == "Not Contactable") { echo "selected"; } ?>>Not Contactable</option>
		<option value="<? echo $strURL.'&Feedback=Callback Later'?>" <? if($varFeedback == "Callback Later") { echo "selected"; } ?>>Callback Later</option>
		<option value="<? echo $strURL.'&Feedback=Wrong Number'?>" <? if($varFeedback == "Wrong Number") { echo "selected"; } ?>>Wrong Number</option>
		<option value="<? echo $strURL.'&Feedback=Not Eligible'?>" <? if($varFeedback == "Not Eligible") { echo "selected"; } ?> >Not Eligible</option>
		<option value="<? echo $strURL.'&Feedback=Ringing'?>" <? if($varFeedback == "Ringing") { echo "selected"; } ?> >Ringing</option>
		<option value="<? echo $strURL.'&Feedback=Duplicate'?>" <? if($varFeedback == "Duplicate") { echo "selected"; } ?> >Duplicate</option>
		<option value="<? echo $strURL.'&Feedback=FollowUp'?>" <? if($varFeedback == "FollowUp") { echo "selected"; } ?>>FollowUp</option>
		<option value="<? echo $strURL.'&Feedback=Send Now PL'?>" <? if($varFeedback == "Send Now PL") { echo "selected"; } ?>>Send Now PL</option>
		<option value="<? echo $strURL.'&Feedback=Send Now CC'?>" <? if($varFeedback == "Send Now CC") { echo "selected"; } ?>>Send Now CC</option>
		<option value="<? echo $strURL.'&Feedback=Send Now HL'?>" <? if($varFeedback == "Send Now HL") { echo "selected"; } ?>>Send Now HL</option>
		
	</select>	
<?
}
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
