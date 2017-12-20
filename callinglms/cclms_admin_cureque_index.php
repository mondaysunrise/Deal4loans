<?php
require_once("includes/application-top-inner.php");
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

$agents="";	
	if(isset($_REQUEST['agents']))
	{
		$agents=$_REQUEST['agents'];
	}
	
	$refernce_no="";
	if(isset($_REQUEST['refernce_no']))
	{
		$refernce_no = $_REQUEST['refernce_no'];
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
		<!--DatePicker End-->
       </head>
		<body style="margin:0px 0px 0px 0px; padding:0px 0px 0px 0px; background-color:#45B2D8;">
<?php include "header_cc.php"; ?>
<div style="clear:both; height:15px;"></div>
          <div> 
    <table width="98%" border="0">
	               <tr>
        <td align="center" style="font-size:16px; font-weight:bold;">curing queue Leads</td>
      </tr>
 <tr>
        <td align="right"></td>
      </tr>
              <tr>
        <td align="center" width="100%"><div align="center">
            <table width="600" border="0" cellpadding="4" cellspacing="1" class="blueborder" bgcolor="#FFFFFF">
              <form name="frmsearch" action="cclms_admin_cureque_index.php" method="get" onSubmit="return chkform();">
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
                  <td width="12%"><!--<strong>Feedback:</strong>--></td>
                  <td width="29%"><!--<select name="cmbfeedback" id="cmbfeedback">
                      <option value="All" <? if($varCmbFeedback == "All") { echo "selected"; } ?>>
					  All</option>
                      <option value="" <? if($varCmbFeedback == "") { echo "selected"; } ?>>
					  No Feedback</option>
                      <option value="Other Product" <? if($varCmbFeedback == "Other Product") { echo "selected"; } ?>>
					  Other Product</option>
                      <option value="Not Interested" <? if($varCmbFeedback == "Not Interested") { echo "selected"; } ?>>
					  Not Interested</option>
                      <option value="Callback Later" <? if($varCmbFeedback == "Callback Later") { echo "selected"; } ?>>
					  Callback Later</option>
                      <option value="Wrong Number" <? if($varCmbFeedback == "Wrong Number") { echo "selected"; } ?>>
					  Wrong Number</option>
                      <option value="Not Eligible" <?if($varCmbFeedback == "Not Eligible") { echo "selected"; }?>>
					  Not Eligible</option>
                      <option value="Ringing" <?if($varCmbFeedback == "Ringing") { echo "selected"; }?>>
					  Ringing</option>
                      <option value="Not Contactable" <?if($varCmbFeedback == "Not Contactable") { echo "selected"; }?>>
					  Not Contactable</option>
                      <option value="Duplicate" <?if($varCmbFeedback == "Duplicate") { echo "selected"; }?>>
					  Duplicate</option>
                      <option value="Send Now" <? if($varCmbFeedback == "Send Now") { echo "selected"; } ?>>
					  Send Now</option>
                      <option value="Not Applied" <? if($varCmbFeedback == "Not Applied") { echo "selected"; } ?>>
					  Not Applied</option>
                      <option value="FollowUp" <? if($varCmbFeedback == "FollowUp") { echo "selected"; } ?>>
					  FollowUp</option>
					  <option value="Process" <? if($varCmbFeedback == "Process") { echo "selected"; } ?>>
					  Cibil ok</option>
					  <option value="Closed" <? if($varCmbFeedback == "Closed" || $varCmbFeedback == "Disbursed") { echo "selected"; } ?>>
					  Cibil Reject</option>
                    </select>--></td>
                   <td width="29%" align="center"  valign="middle" class="bidderclass">
				  Agents</td>
	  <td width="58%"  valign="middle" class="bidderclass"><select name="agents" id="agents">
		
		<option value="Blanks">All Ref</option>
		<option value="All" <? if($agents=="All") echo "selected"; ?>>All Agents</option>	

<?php
			$getExpertsActiveBiddersSql = "select BidderID,Associated_Bank,Status from Bidders where leadidentifier in ('diallercallerccpredictive', 'diallerleadccsmsnew')";
		$getExpertsActiveBiddersQry= $obj->fun_db_query($getExpertsActiveBiddersSql);
		$recordExpertsCountActiveBidders = mysql_num_rows($getExpertsActiveBiddersQry);
		$allBidders = '';		
			
		while($rowgetExpertsActiveBiddersQry = $obj->fun_db_fetch_rs_object($getExpertsActiveBiddersQry))
		{
			$BidderID = $rowgetExpertsActiveBiddersQry->BidderID;
			$allBidders[]=$BidderID;
			$Associated_Bank = $rowgetExpertsActiveBiddersQry->Associated_Bank;
			$Status = $rowgetExpertsActiveBiddersQry->Status;
			if($Status==1) { $statusValue = "Enabled";	} else { $statusValue = "Disabled"; }
			?>
			<option value="<?php echo $BidderID; ?>" <? if($BidderID==$agents) echo "selected"; ?> <?php if($Status==1) { ?> style="font-weight:bold;" <?php } ?>><?php echo $BidderID ; ?> (<?php echo $statusValue; ?>)</option>
			<?php
		}

	?>
	</select>

</td>
                </tr>
                <tr> </tr>
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
		 $fbqry="select RequestID from Req_Credit_Card_Sms where RequestID=$RequestID";
		$result = $obj->fun_db_query($fbqry);	
				
		$num_rows = $obj->fun_db_get_num_rows($result);
		if($num_rows > 0)
		{
			$row = $obj->fun_db_fetch_rs_array($result);
			$strSQL="Update Req_Credit_Card_Sms Set Feedback='".$Feedback."' ";
			$strSQL=$strSQL."Where RequestID=".$RequestID;
		}
//echo "<br>".$strSQL;
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
			$FeedbackClause=" AND (Req_Credit_Card_Sms.Feedback IS NULL OR Req_Credit_Card_Sms.Feedback='' OR Req_Credit_Card_Sms.Feedback='No Feedback') ";
		}
		else if($varCmbFeedback=="All")
		{
			$FeedbackClause=" ";
		}
		else
		{
			$FeedbackClause=" AND Req_Credit_Card_Sms.Feedback='".$varCmbFeedback."' ";
		}	
		$feedback_tble = "cards_curing_queue";
		if($agents=="All")
		{//lead_allocate
			$getExpertsActiveBiddersSql = "select BidderID from Bidders where leadidentifier in ('diallercallerccpredictive', 'diallerleadccsmsnew')";
			$getExpertsActiveBiddersQry= $obj->fun_db_query($getExpertsActiveBiddersSql);
			$recordExpertsCountActiveBidders = mysql_num_rows($getExpertsActiveBiddersQry);
			$agentID='';
			while($rowgetExpertsActiveBiddersQry = $obj->fun_db_fetch_rs_object($getExpertsActiveBiddersQry))
			{
				$agentID[] = $rowgetExpertsActiveBiddersQry->BidderID;
			}
			
				$agentsStr=implode(",",$agentID);
				$agentClause=" AND ".$feedback_tble.".AgentID in (".$agentsStr.") ";	
		}
		else if($agents=="Blanks")
		{
			$agentClause=" ";
		}
		else
		{
			$agentsStr=$agents;
			$agentClause=" AND ".$feedback_tble.".AgentID in (".$agents.") ";
		}	
		
		
	?>       <p class="bodyarial11">
              <?=$Msg?>
            </p>
             <p align="center"><span id="name_status" style="color:#F00; font-weight:bold;"></span> </p>
            <table width="998" border="0" cellpadding="4" cellspacing="1" class="blueborder" bgcolor="#FFFFFF">
              <? $srh_qry=""; 
		if($mob_num>0)
		{
			$mob_num_clause = " AND ".TABLE_REQ_CREDIT_CARD.".Mobile_Number = '".$mob_num."' ";
		}
		if($_SESSION['BidderID']!="")
		{
			//$qry = "SELECT * FROM Req_Credit_Card_Sms RIGHT OUTER JOIN cards_curing_queue ON cards_curing_queue.RefRequestID=Req_Credit_Card_Sms.RequestID WHERE ((( Req_Credit_Card_Sms.Updated_Date Between '".($min_date)."' and '".($max_date)."') or (Req_Credit_Card_Sms.Followup_Date Between '".($min_date)."' and '".($max_date)."') or (cards_curing_queue.dated Between '".($min_date)."' and '".($max_date)."'))  and cards_curing_queue.identifier= 'sales reject') ";

			$qry = "SELECT * FROM Req_Credit_Card RIGHT OUTER JOIN cards_curing_queue ON cards_curing_queue.RequestID=Req_Credit_Card.RequestID WHERE ((( Req_Credit_Card.Updated_Date Between '".($min_date)."' and '".($max_date)."') or (cards_curing_queue.dated Between '".($min_date)."' and '".($max_date)."'))  and cards_curing_queue.identifier= 'curing queue' and cards_curing_queue.process!= '10') ";

		$qry=$qry." ".$agentClause;
	$srh_qry = $qry;	
		}		

//echo $qry;
$resCount = $objAdmin->fun_get_num_rows($qry);
if($resCount>$limit)
{
$pagelinks = paginate($limit, $resCount);
}
$getParameterVal = min($start+$limit,$resCount) % $limit;

$qry.= " order by Updated_Date DESC LIMIT $start,$limit ";

$result = $obj->fun_db_query($qry);
 ?>
              <tr>
                <td colspan="11"><strong><? echo $start+1; ?> to <? echo $start+$limit; ?> 
				Out of <? echo $resCount; ?> Records </strong></td>
              </tr>
              <tr>
                <td class="head1">Name</td>
                <td class="head1">Mobile</td>
                <td class="head1">Salary</td>
                <td class="head1">City</td>
                <td class="head1">Emp stat</td>
                <td class="head1">Feedback</td>                
           
                <td class="head1">Comments</td>  
				 <td class="head1">DOE</td>  
								 <td class="head1">Application No</td> 
								 	 <td class="head1">Agent ID</td> 
				 <td class="head1">Status</td>
					
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
              <!--///////////////////////-->
              <tr  bgcolor="<?php echo $colorvar;?>">			 
                <td class="bodyarial11"><a href="/sbiccleadlms-details.php?postid=<? echo urlencode($row->RequestID); ?>&biddt=<? echo $row->AgentID; ?>&process=cq" target="_blank"><? echo $row->Name; ?></a></td>
                <td class="bodyarial11">
                <?php  echo ccMasking($row->Mobile_Number);  ?>
                
                </td>
                <td class="bodyarial11"> <?php 
                  echo $row->Net_Salary;  ?>
</td>
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
                 <?
	$qryCommentQuery = $obj->fun_db_fetch_rs_object($obj->fun_db_query("SELECT * FROM Req_Credit_Card_Sms where RequestID='".$row->RefRequestID."'"));
	
 echo $qryCommentQuery->Feedback; ?>
     </td>

	 <td class="bodyarial11"><textarea rows="2" cols="10"><? echo $qryCommentQuery->comment_section; ?></textarea></td>
         <td class="bodyarial11"><? echo $row->Updated_Date; ?></td>
					 <td class="bodyarial11"><? echo $row->LeadRefNumber; ?></td> 
				 <td class="bodyarial11"><? echo $row->AgentID; ?></td>
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
<?	  if( $search=="y")
	  {
	 	$blockThis=0;
  		if($resCount<=5000 && $blockThis==1)
		{
          ?>
	  <tr><td colspan="2" align="center"><table width="500" border="0" cellspacing="1" cellpadding="4">
			 <form name="frmdownload" action="/mis_cc_download.php" method="post">
			 
			 

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
			 <? } } ?>
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
