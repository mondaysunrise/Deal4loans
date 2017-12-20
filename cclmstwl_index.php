<?php
require_once("includes/application-top-inner.php");
define("NoOFLMS", 2);
define("TABLE_SBI_CCOOFFERS_DIRECTSITE", "sbi_ccoffers_directonsite");
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
	
  
	$lms_feedbackClause="";
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
	$application_no="";
	if(isset($_REQUEST['application_no']))
	{
		$application_no=$_REQUEST['application_no'];
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

	$varCmblms_feedback="";
	if(isset($_REQUEST['cmblms_feedback']))
	{
		$varCmblms_feedback=$_REQUEST['cmblms_feedback'];
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
	$lms_feedback="";
	if(isset($_REQUEST['lms_feedback']))
	{
		$lms_feedback=$_REQUEST['lms_feedback'];
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
         <script type="text/javascript">

    function checkCall(RequestID,agent_user)
    {	
	   $.ajax({ type: 'post',  url: '/dialerclick2callcc.php',  data: {  RequestID:RequestID,agent_user:agent_user, },
			   success: function (response) {
			   //alert(response);
			   $( '#name_status' ).html(response);
  		          if(response=="OK") { return true;	 } else { return false;	}
                }
		      });
	}
	</script>
        
		</head>
		<body style="margin:0px 0px 0px 0px; padding:0px 0px 0px 0px; background-color:#45B2D8;">
<!-- End Main Banner Menu Panel --><div style="width:100%; background: #CCC; padding:0px 0px 10px 0px;"><div style="background:#F00; width:40px; padding-left:7px; line-height:30px; height:30px; float:right; margin-right:50px; margin-top:7px; border-radius:20%;"><a href="logout.php" style="color:#FFF; text-align:center; text-decoration:none; font-size:12px;">Logout</a></div>
<div style="clear:both;"></div>
</div>
<div style="clear:both; height:15px;"></div>
          <div> 
    <table width="98%" border="0">
	  <tr><td align="right"><a href="/commonlms_report.php?bidderid=<?php echo $_SESSION['BidderID'];?>&product=10" target="_blank">today's Report</a></td></tr>
              <tr>
        <td align="right"></td>
      </tr>
              <tr>
        <td align="center" width="100%"><div align="center">
            <table width="600" border="0" cellpadding="4" cellspacing="1" class="blueborder" bgcolor="#FFFFFF">
              <form name="frmsearch" action="cclmstwl_index.php" method="get" onSubmit="return chkform();">
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
                  <td width="12%"><strong>lms_feedback:</strong></td>
                  <td width="29%"><select name="cmblms_feedback" id="cmblms_feedback">
                      <option value="All" <? if($varCmblms_feedback == "All") { echo "selected"; } ?>>All</option>
                      <option value="" <? if($varCmblms_feedback == "") { echo "selected"; } ?>>No Feedback</option>
                      <option value="Other Product" <? if($varCmblms_feedback == "Other Product") { echo "selected"; } ?>>Other Product</option>
                      <option value="Not Interested" <? if($varCmblms_feedback == "Not Interested") { echo "selected"; } ?>>Not Interested</option>
                      <option value="Callback Later" <? if($varCmblms_feedback == "Callback Later") { echo "selected"; } ?>>Callback Later</option>
                      <option value="Wrong Number" <? if($varCmblms_feedback == "Wrong Number") { echo "selected"; } ?>>Wrong Number</option>
                      <option value="Not Eligible" <?if($varCmblms_feedback == "Not Eligible") { echo "selected"; }?>>Not Eligible</option>
                      <option value="Ringing" <?if($varCmblms_feedback == "Ringing") { echo "selected"; }?>>Ringing</option>
                      <option value="Not Contactable" <?if($varCmblms_feedback == "Not Contactable") { echo "selected"; }?>>Not Contactable</option>
                      <option value="Duplicate" <?if($varCmblms_feedback == "Duplicate") { echo "selected"; }?>>Duplicate</option>
                      <option value="Send Now" <? if($varCmblms_feedback == "Send Now") { echo "selected"; } ?>>Send Now</option>
                      <option value="Not Applied" <? if($varCmblms_feedback == "Not Applied") { echo "selected"; } ?>>Not Applied</option>
                      <option value="FollowUp" <? if($varCmblms_feedback == "FollowUp") { echo "selected"; } ?>>FollowUp</option>
					  <option value="Process" <? if($varCmblms_feedback == "Process") { echo "selected"; } ?>>Cibil ok</option>
						<option value="Closed" <? if($varCmblms_feedback == "Closed" || $varCmblms_feedback == "Disbursed") { echo "selected"; } ?>>Cibil Reject</option>
                    </select></td>
                   <td width="29%" align="center"  valign="middle" class="bidderclass">Search with Mobile No</td>
	  <td width="58%"  valign="middle" class="bidderclass"><input type="text" name="mob_num" id="mob_num" value="<?php echo $mob_num; ?>" >
</td>
                </tr>

            <tr><td colspan="2">Search with Application No</td><td><input type="text" name="application_no" id="application_no" value="<?php echo $application_no; ?>" ></td></td>
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

	if(strlen(trim($RequestID))>0 && strlen($lms_feedback)>0)
	{
		$strSQL="";
		$Msg="";		
		$strSQL="Update ".TABLE_SBI_CCOOFFERS_DIRECTSITE." Set lms_feedback='".$lms_feedback."',CallerID='".$_SESSION['BidderID']."' ";
		$strSQL=$strSQL."Where sbiccoffersid=".$RequestID;
		//echo $strSQL;
		$result = $obj->fun_db_query($strSQL);
		if ($result == 1)
		{	}
		else
		{
			$Msg = "** There was a problem in adding your lms_feedback. Please try again.";
		}
	}
	if($search=="y")
	{		
		$min_dateonly=$min_date;
		$max_dateonly=$max_date;

		$min_date=$min_date." 00:00:00";
		$max_date=$max_date." 23:59:59";

		if(strlen(trim($varCmblms_feedback))==0)
		{
			$lms_feedbackClause=" AND (lms_feedback IS NULL OR lms_feedback='' OR lms_feedback='No Feedback') ";
		}
		else if($varCmblms_feedback=="All")
		{
			$lms_feedbackClause=" ";
		}
		else
		{
			$lms_feedbackClause=" AND lms_feedback='".$varCmblms_feedback."' ";
		}			
	?>       <p class="bodyarial11">
              <?=$Msg?>
            </p>
                <p><span id="name_status" style="color:#F00; font-weight:bold;"></span> </p>
            <table width="758" border="0" cellpadding="4" cellspacing="1" class="blueborder" bgcolor="#FFFFFF">
              <? $srh_qry=""; 
		if($mob_num>0)
		{
			$mob_num_clause = " AND ".TABLE_SBI_CCOOFFERS_DIRECTSITE.".sbicc_mobile = '".$mob_num."' ";
		}
		if($_SESSION['BidderID']!="")
		{
			if($_SESSION['BidderID']==5924)
			{
				$srch_qry="SELECT sbicc_name AS Name, sbicc_dob AS DOB ,sbicc_email AS Email, sbicc_mobile AS MobileNo, sbicc_occupation AS Occupation, sbicc_net_salary AS Salary, sbicc_city AS City,sbicc_dated AS Dated,lms_comment AS comments,lms_feedback AS Feedback,lms_followup_date AS FollowupDate, sendnow_date AS SendDate FROM ".TABLE_SBI_CCOOFFERS_DIRECTSITE." WHERE ( ".TABLE_SBI_CCOOFFERS_DIRECTSITE.".sbicc_dated Between '".($min_date)."' and '".($max_date)."' or ".TABLE_SBI_CCOOFFERS_DIRECTSITE.".lms_followup_date Between '".($min_date)."' and '".($max_date)."') ";
				$srch_qry=$srch_qry.$lms_feedbackClause;

				$qry="SELECT * FROM ".TABLE_SBI_CCOOFFERS_DIRECTSITE." WHERE ( ".TABLE_SBI_CCOOFFERS_DIRECTSITE.".sbicc_dated Between '".($min_date)."' and '".($max_date)."' or ".TABLE_SBI_CCOOFFERS_DIRECTSITE.".lms_followup_date Between '".($min_date)."' and '".($max_date)."') ";
		$qry=$qry.$lms_feedbackClause." ".$mob_num_clause;
			}
			else
			{
				if($application_no>0)
				{
					$qry="SELECT * FROM ".TABLE_SBI_CCOOFFERS_DIRECTSITE." JOIN sbi_credit_card_5633 ON sbi_credit_card_5633.RequestID=".TABLE_SBI_CCOOFFERS_DIRECTSITE.".sbiccoffersid WHERE (( ".TABLE_SBI_CCOOFFERS_DIRECTSITE.".sbicc_dated Between '".($min_date)."' and '".($max_date)."' or ".TABLE_SBI_CCOOFFERS_DIRECTSITE.".lms_followup_date Between '".($min_date)."' and '".($max_date)."')";
					$qry=$qry.$lms_feedbackClause.") and sbi_credit_card_5633.ApplicationNumber ='".$application_no."' and sbi_credit_card_5633.productflag=10";									
				}
				else
				{
$qry="SELECT * FROM ".TABLE_SBI_CCOOFFERS_DIRECTSITE." WHERE ( ".TABLE_SBI_CCOOFFERS_DIRECTSITE.".sbicc_dated Between '".($min_date)."' and '".($max_date)."' or ".TABLE_SBI_CCOOFFERS_DIRECTSITE.".lms_followup_date Between '".($min_date)."' and '".($max_date)."')";
		$qry=$qry.$lms_feedbackClause." ".$mob_num_clause;
				}
			}	
		}		
//$srh_qry = $qry;
	
//echo $qry;
$resCount = $objAdmin->fun_get_num_rows($qry);
if($resCount>$limit)
{
$pagelinks = paginate($limit, $resCount);
}

$qry.= " order by sbicc_dated DESC LIMIT $start,$limit ";
//echo $qry;
$result = $obj->fun_db_query($qry);
 ?>
              <tr>
                <td colspan="11"><strong><? echo $start+1; ?> to <? echo $start+$limit; ?> Out of <? echo $resCount; ?> Records </strong></td>
              </tr>
              <tr>
                <td class="head1">Name</td>
                <td class="head1">Mobile</td>
                <td class="head1">Salary</td>
                <td class="head1">City</td>
                <td class="head1">Emp stat</td>
                <td class="head1">lms_feedback</td>                
                <td class="head1">FollowUp date</td>               
                <td class="head1">Comments</td>   
					<td class="head1">DOE</td> 
                   <td class="head1">Call</td>          
                <!--  <td class="head1">lms_feedbackfrom Other LMS</td>--> 
              </tr>
              <?			
		if($resCount>0)
			{
				$color = 1;		
		while($row = $obj->fun_db_fetch_rs_object($result))
		{
			$Followup_Date = $row->lms_followup_date;				
			$exptodayformat = explode(" ",$Followup_Date);
			$explodeTime = explode(":",$exptodayformat[1]);
			$explodeHr = $explodeTime[0] - 1; 
			$FinalMinDate = '"'.$exptodayformat[0].' '.$explodeHr.':'.$explodeTime[1].':'.$explodeTime[2].'"';
			$FinalMaxDate ='"'.$exptodayformat[0].' 23:59:59"';
			$TodayFormat = date("Y-m-d");
			$FinalDay = $exptodayformat[0];		
			$Employment_Status=$row->sbicc_occupation;
			
			if($color%2!=0)
					{
						$colorvar = "#FFF";
					}
				else{
						$colorvar = "#EEE";
					}
	?>
              <!--///////////////////////-->
              <tr  bgcolor="<?php echo $colorvar;?>">			 
                <td class="bodyarial11"><a href="/sbicctwlleadlms-detail.php?postid=<? echo urlencode($row->sbiccoffersid); ?>&biddt=<? echo $_SESSION['BidderID'];?>" target="_blank"><? echo $row->sbicc_name; ?></a></td>
                <td class="bodyarial11"><? echo ccMasking($row->sbicc_mobile); ?></td>
                <td class="bodyarial11"><? echo $row->sbicc_net_salary; ?></td>
                <td class="bodyarial11"><? echo $row->sbicc_city; ?></td>
				<td class="bodyarial11"><? if($sbicc_occupation==1) { echo "Salaried";} else { echo "Self Employed";} ?></td>
                <?
	    if($row->sbicc_city=="Others")
        {
            $City= $row->sbicc_city;
        }
        else
        {
            $City= $row->sbicc_city;
        }
	   ?>              
		<td class="bodyarial11">
                 <? echo getJumpMenu("cclmstwl_index.php",$row->sbiccoffersid,"4",$row->lms_feedback,$pageno,$varmin_date,$varmax_date,$varCmblms_feedback, $val) ?>
     </td>
         <td class="bodyarial11"><input type="text" name="Followup_Date" id="Followup_Date" value="<? echo $Followup_Date; ?>"></td>
	 <td class="bodyarial11"><textarea rows="2" cols="10"><? echo $row->lms_comment; ?></textarea></td>
	  <td class="bodyarial11"><? echo $row->sbicc_dated; ?></td>
        <td class="bodyarial11">
           <input type="button" name="chkCall" value="Call" onClick="checkCall(<?php echo $row->sbiccoffersid; ?>,<?php echo $_SESSION['BidderID']; ?>)" />        </td>
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
<?	  if($_SESSION['BidderID']==5924 && $search=="y")
			{ ?>
	  <!--<tr><td colspan="2" align="center"><table width="500" border="0" cellspacing="1" cellpadding="4">
			 <form name="frmdownload" action="/common_download.php" method="post">
			   <tr>
				 <td align="center">
				 <input type="hidden" name="qry1" value="<? echo $srch_qry; ?>">
				 <input type="hidden" name="qry2" value="Req_Credit_Card">
				 <input type="hidden" name="min_date" value="<? echo $min_date; ?>">
				 <input type="hidden" name="max_date" value="<? echo $max_date; ?>">
				 <input name="Submit2" type="submit" class="bluebtn" value="Export List To Excel">
				 </td>
			   </tr>
			 </form>
			 </table></td></tr>-->
			 <? } ?>
            </table>
        </div>
		<?
function getJumpMenu($varPHPPage, $varRequestID, $varType, $varlms_feedback, $varpageon, $varmindate, $varmaxdate,$cmblms_feedback,$varVal)
{
	$strURL="";
	$strURL=$varPHPPage."?search=y&RequestID=".$varRequestID."&type=".$varType."&pageno=".$varpageon."&min_date=".urlencode($varmindate)."&max_date=".urlencode($varmaxdate)."&cmblms_feedback=".urlencode($cmblms_feedback)."&product=4";
?>
	<select name="type" id="type" onChange="MM_jumpMenu('parent',this,0)">
		<option value="<? echo $strURL.'&lms_feedback='?>" <? if($varlms_feedback == "") { echo "selected"; } ?>>No Feedback</option>
		<option value="<? echo $strURL.'&lms_feedback=Other Product'?>" <? if($varlms_feedback == "Other Product") { echo "selected"; } ?>>Other Product</option>
		<option value="<? echo $strURL.'&lms_feedback=Not Interested'?>" <? if($varlms_feedback == "Not Interested") { echo "selected"; } ?>>Not Interested</option>
		<option value="<? echo $strURL.'&lms_feedback=Not Contactable'?>" <? if($varlms_feedback == "Not Contactable") { echo "selected"; } ?>>Not Contactable</option>
		<option value="<? echo $strURL.'&lms_feedback=Callback Later'?>" <? if($varlms_feedback == "Callback Later") { echo "selected"; } ?>>Callback Later</option>
		<option value="<? echo $strURL.'&lms_feedback=Wrong Number'?>" <? if($varlms_feedback == "Wrong Number") { echo "selected"; } ?>>Wrong Number</option>
		<option value="<? echo $strURL.'&lms_feedback=Send Now'?>" <? if($varlms_feedback == "Send Now") { echo "selected"; } ?> >Send Now</option>
		<option value="<? echo $strURL.'&lms_feedback=Not Eligible'?>" <? if($varlms_feedback == "Not Eligible") { echo "selected"; } ?> >Not Eligible</option>
		<option value="<? echo $strURL.'&lms_feedback=Ringing'?>" <? if($varlms_feedback == "Ringing") { echo "selected"; } ?> >Ringing</option>
		<option value="<? echo $strURL.'&lms_feedback=Duplicate'?>" <? if($varlms_feedback == "Duplicate") { echo "selected"; } ?> >Duplicate</option>
		<option value="<? echo $strURL.'&lms_feedback=Not Applied'?>" <? if($varlms_feedback == "Not Applied") { echo "selected"; } ?> >Not Applied</option>
		<option value="<? echo $strURL.'&lms_feedback=FollowUp'?>" <? if($varlms_feedback == "FollowUp") { echo "selected"; } ?>>FollowUp</option>	
		 <option value="<? echo $strURL.'&lms_feedback=Process'?>" <? if($varlms_feedback == "Process") { echo "selected"; } ?>>Cibil ok </option>
		<option value="<? echo $strURL.'&lms_feedback=Closed'?>" <? if($varlms_feedback == "Closed") { echo "selected"; } ?>>Cibil Reject</option>
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
} catch(err) {}</script>
</body>
</html>
