<?php
require_once("includes/application-top-inner.php");
define("NoOFLMS", 2);
if(!empty($_GET['page'])){
$page = $_GET['page'];
}else{
$page = 1;
}
$limit = 25;
$start = ($page - 1) * $limit;

$BidderIDstatic="";
	if(isset($_REQUEST['BidderIDstatic']) && strlen($_REQUEST['BidderIDstatic'])>0 )
	{
		 $BidderIDstatic=$_REQUEST['BidderIDstatic'];
	}
	else
	{
		$BidderIDstatic=$_SESSION['BidderID'];
	}


echo $BidderIDstatic;

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

   $employment_stat="";
   if(isset($_REQUEST['employment_stat']))
	{
		$employment_stat=$_REQUEST['employment_stat'];
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

function ccMasking($number, $maskingCharacter = 'X')
{
return substr($number, 0, 2) . str_repeat($maskingCharacter, strlen($number) - 4) . substr($number, -2);
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
	  <tr><td align="right"><a href="/personal-loan-chatapp.php?biddt=<?php echo $BidderIDstatic;?>" target="_blank">Add Lead</a> | <a href="/commonlms_report.php?bidderid=<?php echo $BidderIDstatic;?>&product=1" target="_blank">today's Report</a></td></tr>
              <tr>
        <td align="right"></td>
      </tr>
              <tr>
        <td align="center" width="100%"><div align="center">
            <table width="600" border="0" cellpadding="4" cellspacing="1" class="blueborder" bgcolor="#FFFFFF">
              <form name="frmsearch" action="smsapp_pllms_dashboard.php" method="get" onSubmit="return chkform();">
                <input type="hidden" name="BidderIDstatic" id="BidderIDstatic" value="<? echo $BidderIDstatic;?>">
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
                      <option value="" <? if($varCmbFeedback == "" || $varCmbFeedback == "No Feedback") { echo "selected"; } ?>>No Feedback</option>
                      <option value="Other Product" <? if($varCmbFeedback == "Other Product") { echo "selected"; } ?>>Other Product</option>
                      <option value="Not Interested" <? if($varCmbFeedback == "Not Interested") { echo "selected"; } ?>>Not Interested</option>
                      <option value="Callback Later" <? if($varCmbFeedback == "Callback Later") { echo "selected"; } ?>>Callback Later</option>
                      <option value="Wrong Number" <? if($varCmbFeedback == "Wrong Number") { echo "selected"; } ?>>Wrong Number</option>
                      <option value="Not Eligible" <?if($varCmbFeedback == "Not Eligible") { echo "selected"; }?>>Not Eligible</option>
					  <option value="Not Eligible CNL" <?if($varCmbFeedback == "Not Eligible CNL") { echo "selected"; }?>>Not Eligible (City not listed)</option>
                      <option value="Ringing" <?if($varCmbFeedback == "Ringing") { echo "selected"; }?>>Ringing</option>
                      <option value="Not Contactable" <?if($varCmbFeedback == "Not Contactable") { echo "selected"; }?>>Not Contactable</option>
                      <option value="Duplicate" <?if($varCmbFeedback == "Duplicate") { echo "selected"; }?>>Duplicate</option>
                      <option value="Send Now" <? if($varCmbFeedback == "Send Now") { echo "selected"; } ?>>Send Now</option>
                      <option value="Not Applied" <? if($varCmbFeedback == "Not Applied") { echo "selected"; } ?>>Not Applied</option>
                      <option value="FollowUp" <? if($varCmbFeedback == "FollowUp") { echo "selected"; } ?>>FollowUp</option>
					  <option value="Process" <? if($varCmbFeedback == "Process") { echo "selected"; } ?>>Cibil ok</option>
						<option value="Closed" <? if($varCmbFeedback == "Closed" || $varCmbFeedback == "Disbursed") { echo "selected"; } ?>>Cibil Reject</option>
						<option value="CFL Approved" <? if($varCmbFeedback == "CFL Approved") { echo "CFL Approved"; } ?>>CFL Approved</option>
						<option value="CFL Reject" <? if($varCmbFeedback == "CFL Reject") { echo "CFL Reject"; } ?>>CFL Reject</option>
                    </select></td>
                   <td width="29%" align="center"  valign="middle" class="bidderclass">Search with Mobile No</td>
	  <td width="58%"  valign="middle" class="bidderclass"><input type="text" name="mob_num" id="mob_num" value="<?php echo $mob_num; ?>" >
</td>
                </tr>
                <tr><td width="12%"><strong>Occupation</strong></td>
                  <td width="29%"><select name="employment_stat" id="employment_stat">
				  <option value="0" <? if($employment_stat == "0") { echo "selected"; } ?>>Please Select</option>
                      <option value="1" <? if($employment_stat == 1) { echo "selected"; } ?>>Salaried</option>
					  <option value="2" <? if($employment_stat == 2) { echo "selected"; } ?>>Self Employed</option>
					  </select></tr>
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
		$fbqry="select FeedbackID from Req_Feedback_PL where AllRequestID=$RequestID and BidderID=".$BidderIDstatic." AND Reply_Type=1";
		$result = $obj->fun_db_query($fbqry);	
				
		$num_rows = $obj->fun_db_get_num_rows($result);
		if($num_rows > 0)
		{
			$row = $obj->fun_db_fetch_rs_array($result);
			$strSQL="Update Req_Feedback_PL Set Feedback='".$Feedback."' ";
			$strSQL=$strSQL."Where FeedbackID=".$row["FeedbackID"];
		}
		else
		{
			$strSQL="Insert into Req_Feedback_PL(AllRequestID, BidderID, Reply_Type , Feedback) Values (";
			$strSQL=$strSQL.$RequestID.",".$BidderIDstatic.",'1','".$Feedback."')";
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
			$FeedbackClause=" AND (Req_Feedback_PL.Feedback IS NULL OR Req_Feedback_PL.Feedback='' OR Req_Feedback_PL.Feedback='No Feedback') ";
		}
		else if($varCmbFeedback=="All")
		{
			$FeedbackClause=" ";
		}
		else
		{
			$FeedbackClause=" AND Req_Feedback_PL.Feedback='".$varCmbFeedback."' ";
		}			
	?>       <p class="bodyarial11">
              <?=$Msg?>
            </p>
            <table width="758" border="0" cellpadding="4" cellspacing="1" class="blueborder" bgcolor="#FFFFFF">
              <? $srh_qry=""; 

		 if($employment_stat==1)
		{
			 $EmploymentStatus=" AND ".TABLE_REQ_LOAN_PERSONAL.".Employment_Status=1";
		}
		elseif($employment_stat==2)
		{
			$EmploymentStatus=" AND ".TABLE_REQ_LOAN_PERSONAL.".Employment_Status=0";
		}
		else
		{
			$EmploymentStatus="";
		}

		if($mob_num>0)
		{
			$mob_num_clause = " AND ".TABLE_REQ_LOAN_PERSONAL.".Mobile_Number = '".$mob_num."' ";
		}
		if($BidderIDstatic!="")
		{
		$feedback_tble="lead_allocate";
/*if($_SESSION['BidderID']==5926)
			{
				$qry="SELECT *,Req_Feedback_PL.BidderID as allocateccbid FROM ".$feedback_tble.",".TABLE_REQ_LOAN_PERSONAL." LEFT OUTER JOIN Req_Feedback_PL ON Req_Feedback_PL.AllRequestID=".TABLE_REQ_LOAN_PERSONAL.".RequestID AND Req_Feedback_PL.BidderID in (5658,5657) WHERE ".$feedback_tble.".AllRequestID=".TABLE_REQ_LOAN_PERSONAL.".RequestID and ".$feedback_tble.".BidderID in (5658,5657) and ".$feedback_tble.".Reply_Type=4 and ( ".$feedback_tble.".Allocation_Date Between '".($min_date)."' and '".($max_date)."' or Req_Feedback_PL.Followup_Date Between '".($min_date)."' and '".($max_date)."' or Req_Feedback_PL.last_updated between '".($min_dateonly)."' and '".($max_dateonly)."') ";
		$qry=$qry.$FeedbackClause." ".$mob_num_clause;
			}
			else
			{*/
		$qry="SELECT * FROM ".$feedback_tble.",".TABLE_REQ_LOAN_PERSONAL." LEFT OUTER JOIN Req_Feedback_PL ON Req_Feedback_PL.AllRequestID=".TABLE_REQ_LOAN_PERSONAL.".RequestID AND Req_Feedback_PL.BidderID= '".$BidderIDstatic."' WHERE ".$feedback_tble.".AllRequestID=".TABLE_REQ_LOAN_PERSONAL.".RequestID and ".$feedback_tble.".BidderID = '".$BidderIDstatic."' and ".$feedback_tble.".Reply_Type=1 and ( ".$feedback_tble.".Allocation_Date Between '".($min_date)."' and '".($max_date)."' or Req_Feedback_PL.Followup_Date Between '".($min_date)."' and '".($max_date)."') ".$EmploymentStatus;
		$qry=$qry.$FeedbackClause." ".$mob_num_clause;
			//}	
		}		
$srh_qry = $qry;

$resCount = $objAdmin->fun_get_num_rows($qry);
if($resCount>$limit)
{
$pagelinks = paginate($limit, $resCount);
}

$qry.= " order by Allocation_Date DESC LIMIT $start,$limit ";
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
                <td class="head1">Feedback</td>                
                <td class="head1">FollowUp date</td>               
                <td class="head1">Comments</td>
				<? if($varCmbFeedback ="Send Now") { ?>
               <td class="head1">final feedback</td>
				<td class="head1">final Team feedback</td>
			   <? } ?>
              </tr>
              <?			
		if($resCount>0)
			{
				$color = 1;		
		while($row = $obj->fun_db_fetch_rs_object($result))
		{
			$Followup_Date = $row->Followup_Date;				
			$exptodayformat = explode(" ",$Followup_Date);
			$explodeTime = explode(":",$exptodayformat[1]);
			$explodeHr = $explodeTime[0] - 1; 
			$FinalMinDate = '"'.$exptodayformat[0].' '.$explodeHr.':'.$explodeTime[1].':'.$explodeTime[2].'"';
			$FinalMaxDate ='"'.$exptodayformat[0].' 23:59:59"';
			$TodayFormat = date("Y-m-d");
			$FinalDay = $exptodayformat[0];		
			$Employment_Status=$row->Employment_Status;
			
			if($color%2!=0)
					{
						$colorvar = "#FFF";
					}
				else{
						$colorvar = "#EEE";
					}
	?>
                 <tr  bgcolor="<?php echo $colorvar;?>">			 
                <td class="bodyarial11"><a href="/personalloan_smsleaddetails.php?postid=<? echo urlencode($row->RequestID); ?>&biddt=<? echo $BidderIDstatic;?>" target="_blank"><? echo $row->Name; ?></a></td>
                <td class="bodyarial11"><img src="gButt.php?text=<? echo $row->Mobile_Number; ?>" /><?php //echo ccMasking($row->Mobile_Number); ?></td>
                <td class="bodyarial11"><? echo $row->Net_Salary; ?></td>
                <td class="bodyarial11"><? echo $row->City; ?></td>
				<td class="bodyarial11"><? if($Employment_Status==1) { echo "Salaried";} else { echo "Self Employed";} ?></td>
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
                 <? echo getJumpMenu("smsapp_pllms_dashboard.php",$row->RequestID,"4",$row->Feedback,$pageno,$varmin_date,$varmax_date,$varCmbFeedback, $val) ?>
     </td>
         <td class="bodyarial11"><input type="text" name="Followup_Date" id="Followup_Date" value="<? echo $Followup_Date; ?>"></td>
	 <td class="bodyarial11"><textarea rows="2" cols="10"><? echo $row->comment_section; ?></textarea></td>
	 <? if($varCmbFeedback ="Send Now") { ?>
	 <td class="bodyarial11"><? $appdetailsqry="select final_feedback from smspl_status_details where ( `AllRequestID`=".$row->RequestID." and ProductID=1)"; $appdetailsqryresult = $obj->fun_db_query($appdetailsqry); $dtrow = $obj->fun_db_fetch_rs_object($appdetailsqryresult); 
   echo $dtrow->final_feedback ; ?></td>
   <td class="bodyarial11"><? echo $row->final_team_feedback; ?></td>
   <? } ?>
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
<?	  if($BidderIDstatic==5926 && $search=="y")
			{ ?>
	  <tr><td colspan="2" align="center"><table width="500" border="0" cellspacing="1" cellpadding="4">
			 <form name="frmdownload" action="/bidder_download.php" method="post">
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
			 <? } ?>
            </table>
        </div>
		<?
function getJumpMenu($varPHPPage, $varRequestID, $varType, $varFeedback, $varpageon, $varmindate, $varmaxdate,$cmbfeedback,$varVal)
{
	$strURL="";
	$strURL=$varPHPPage."?search=y&RequestID=".$varRequestID."&type=".$varType."&pageno=".$varpageon."&min_date=".urlencode($varmindate)."&max_date=".urlencode($varmaxdate)."&cmbfeedback=".urlencode($cmbfeedback)."&product=4";
?>
	<select name="type" id="type" onChange="MM_jumpMenu('parent',this,0)">
		<option value="<? echo $strURL.'&Feedback='?>" <? if($varFeedback == "" || $varFeedback == "No Feedback") { echo "selected"; } ?>>No Feedback</option>
		<option value="<? echo $strURL.'&Feedback=Other Product'?>" <? if($varFeedback == "Other Product") { echo "selected"; } ?>>Other Product</option>
		<option value="<? echo $strURL.'&Feedback=Not Interested'?>" <? if($varFeedback == "Not Interested") { echo "selected"; } ?>>Not Interested</option>
		<option value="<? echo $strURL.'&Feedback=Not Contactable'?>" <? if($varFeedback == "Not Contactable") { echo "selected"; } ?>>Not Contactable</option>
		<option value="<? echo $strURL.'&Feedback=Callback Later'?>" <? if($varFeedback == "Callback Later") { echo "selected"; } ?>>Callback Later</option>
		<option value="<? echo $strURL.'&Feedback=Wrong Number'?>" <? if($varFeedback == "Wrong Number") { echo "selected"; } ?>>Wrong Number</option>
		<option value="<? echo $strURL.'&Feedback=Send Now'?>" <? if($varFeedback == "Send Now") { echo "selected"; } ?> >Send Now</option>
		<option value="<? echo $strURL.'&Feedback=Not Eligible'?>" <? if($varFeedback == "Not Eligible") { echo "selected"; } ?> >Not Eligible</option><option value="<? echo $strURL.'&Feedback=Send Now'?>" <? if($varFeedback == "Send Now") { echo "selected"; } ?> >Send Now</option>
		<option value="<? echo $strURL.'&Feedback=Not Eligible CNL'?>" <? if($varFeedback == "Not Eligible CNL") { echo "selected"; } ?> >Not Eligible CNL</option>
		<option value="<? echo $strURL.'&Feedback=Ringing'?>" <? if($varFeedback == "Ringing") { echo "selected"; } ?> >Ringing</option>
		<option value="<? echo $strURL.'&Feedback=Duplicate'?>" <? if($varFeedback == "Duplicate") { echo "selected"; } ?> >Duplicate</option>
		<option value="<? echo $strURL.'&Feedback=Not Applied'?>" <? if($varFeedback == "Not Applied") { echo "selected"; } ?> >Not Applied</option>
		<option value="<? echo $strURL.'&Feedback=FollowUp'?>" <? if($varFeedback == "FollowUp") { echo "selected"; } ?>>FollowUp</option>	
		 <option value="<? echo $strURL.'&Feedback=Process'?>" <? if($varFeedback == "Process") { echo "selected"; } ?>>Cibil ok </option>
		<option value="<? echo $strURL.'&Feedback=Closed'?>" <? if($varFeedback == "Closed") { echo "selected"; } ?>>Cibil Reject</option>
		<option value="<? echo $strURL.'&Feedback=CFL Approved'?>" <? if($varFeedback == "CFL Approved") { echo "selected"; } ?>>CFL Approved</option>
		<option value="<? echo $strURL.'&Feedback=CFL Reject'?>" <? if($varFeedback == "CFL Reject") { echo "selected"; } ?>>CFL Reject</option>
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
