<?php
include "includes/header.php";
?>
<div id="payment_container-dash_page">
  <?php include "includes/hllmsleft.php";?>
  <div class="content_right" style="background:#6FC; ">
    <h1>Consolidated view of HL LMS</h1>
<?php
define("TABLE_REQ_LOAN_HOME", "Req_Loan_Home");
$time = date("G");

$qryCheck = "SELECT * FROM Bidders where (leadidentifier in ('hlallocatelms'))";
$qryCheckResult = $obj->fun_db_query($qryCheck);
while($hlrow = $obj->fun_db_fetch_rs_object($qryCheckResult))
		{
 	$hlbidderid[] = $hlrow->BidderID;
}
 $hlbidderidstr=implode(",",$hlbidderid);

if(!empty($_GET['page'])){
$page = $_GET['page'];
}else{
$page = 1;
}
$limit = 25;
$start = ($page - 1) * $limit;

//$BidderIDstatic=$_SESSION["BidderID"];
$BidderIDstatic="";
	if(isset($_REQUEST['BidderIDstatic']))
	{
		$BidderIDstatic = $_REQUEST['BidderIDstatic'];
	}

  $val = "Req_Loan_Home";
  
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

	$refer_no="";
	if(isset($_REQUEST['refer_no']))
		{
			$refer_no=$_REQUEST['refer_no'];
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
					defaultDate: "today",
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
  	</script>
          <div> 
    <table width="98%" border="0">
	  
              <tr>
        <td align="right"></td>
      </tr>
              <tr>
        <td align="center" width="100%"><div align="center">
            <table width="600" border="0" cellpadding="4" cellspacing="1" class="blueborder" bgcolor="#FFFFFF">
              <form name="frmsearch" action="hlreferlms_index.php" method="get" onSubmit="return chkform();">
                <input type="hidden" name="BidderIDstatic" id="BidderIDstatic" value="6717">
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
		<option value="Other Product" <? if($varCmbFeedback == "Other Product") { echo "selected"; } ?>>Other Product</option>
		<option value="Not Interested" <? if($varCmbFeedback == "Not Interested") { echo "selected"; } ?>>Not Interested</option>
		<option value="Callback Later" <? if($varCmbFeedback == "Callback Later") { echo "selected"; } ?>>Callback Later</option>
		<option value="Wrong Number" <? if($varCmbFeedback == "Wrong Number") { echo "selected"; } ?>>Wrong Number</option>
		<option value="Not Eligible" <? if($varCmbFeedback == "Not Eligible") { echo "selected"; }?>>Not Eligible</option>
		<option value="Not Eligible Income" <?if($varCmbFeedback == "Not Eligible Income") { echo "selected"; }?>>Not Eligible Income</option>
		<option value="Not Eligible Property" <?if($varCmbFeedback == "Not Eligible Property") { echo "selected"; }?>>Not Eligible Property</option>
		<option value="Ringing" <? if($varCmbFeedback == "Ringing") { echo "selected"; }?>>Ringing</option>
		<option value="Not Contactable" <? if($varCmbFeedback == "Not Contactable") { echo "selected"; }?>>Not Contactable</option>
		<option value="Duplicate" <? if($varCmbFeedback == "Duplicate") { echo "selected"; }?>>Duplicate</option>
		<option value="Not Applied" <? if($varCmbFeedback == "Not Applied") { echo "selected"; } ?>>Not Applied</option>
		<option value="FollowUp" <? if($varCmbFeedback == "FollowUp") { echo "selected"; } ?>>FollowUp</option>
		<option value="Appointment" <? if($varCmbFeedback == "Appointment") { echo "selected"; } ?>>Appointment</option>
		<option value="Arranging Document" <? if($varCmbFeedback == "Arranging Document") { echo "selected"; } ?>>Arranging Document</option>
		<option value="Documents Pick" <? if($varCmbFeedback == "Documents Pick") { echo "selected"; } ?>>Documents Pick</option>
                   </select></td>
				     <td width="29%" align="center"  valign="middle" class="bidderclass">Search with Mobile No</td>
	  <td width="58%"  valign="middle" class="bidderclass"><input type="text" name="mob_num" id="mob_num" value="<?php echo $mob_num; ?>" >
</td>
                      </tr>
                 <tr>
                 <td width="29%" align="center"  valign="middle" class="bidderclass">Search with Reference No</td>
	  <td width="58%"  valign="middle" class="bidderclass"><input type="text" name="refer_no" id="refer_no" value="<?php echo $refer_no; ?>" >
</td>
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

	if($search=="y")
	{		
		$min_dateonly=$min_date;
		$max_dateonly=$max_date;

		$min_date=$min_date." 00:00:00";
		$max_date=$max_date." 23:59:59";

		if(strlen(trim($varCmbFeedback))==0)
		{
			$FeedbackClause=" AND (Req_Feedback_HL.Feedback IS NULL OR Req_Feedback_HL.Feedback='' OR Req_Feedback_HL.Feedback='No Feedback') ";
		}
		else if($varCmbFeedback=="All")
		{
			$FeedbackClause=" ";
		}
		else
		{
			$FeedbackClause=" AND Req_Feedback_HL.Feedback='".$varCmbFeedback."' ";
		}	
		?> <p class="bodyarial11">
              <?=$Msg?>
            </p>
             <p><span id="name_status" style="color:#F00; font-weight:bold;"></span> </p>
            <table width="758" border="0" cellpadding="4" cellspacing="1" class="blueborder" bgcolor="#FFFFFF">
              <? 
			  
		$srh_qry=""; 
		if($mob_num>0)
		{
			$mob_num_clause = " AND ".TABLE_REQ_LOAN_HOME.".Mobile_Number = '".$mob_num."' ";
		}
		if($refer_no>0)
		{
			$referno_clause = " AND ".TABLE_REQ_LOAN_HOME.".RequestID = '".$refer_no."' ";
		}
		//echo $BidderIDstatic."gg";
		if($BidderIDstatic!="")
		{
			$qry="SELECT * FROM ".TABLE_REQ_LOAN_HOME." LEFT OUTER JOIN Req_Feedback_HL ON Req_Feedback_HL.AllRequestID=".TABLE_REQ_LOAN_HOME.".RequestID AND Req_Feedback_HL.BidderID in (".$hlbidderidstr.") WHERE (( Updated_Date Between '".($min_date)."' and '".($max_date)."') and (Req_Loan_Home.source='HLReferralProgram' or Req_Loan_Home.source='HLInternalReference'))";
			$qry=$qry.$FeedbackClause." ".$mob_num_clause ." ".$referno_clause." group by ".TABLE_REQ_LOAN_HOME.".Mobile_Number ";
		}		
	$srh_qry = $qry;
//echo $qry;
	$resCount = $objAdmin->fun_get_num_rows($qry);
	if($resCount>$limit)
	{
	$pagelinks = paginate($limit, $resCount);
	}

	$qry.= " order by ".TABLE_REQ_LOAN_HOME.".Updated_Date DESC LIMIT $start,$limit ";
	//echo $qry;
	$result = $obj->fun_db_query($qry);
 ?>
              <tr>
                <td colspan="11"><strong><? echo $start+1; ?> to <? echo $start+$limit; ?> Out of <? echo $resCount; ?> Records </strong></td>
              </tr>
              <tr>
			  <td class="head1">Refrence No</td>
                <td class="head1">Name</td>
                <!--<td class="head1">Mobile</td>-->
                <td class="head1">Salary</td>
                <td class="head1">City</td>
                <!--<td class="head1">Eligible Bidders</td>-->
                <td class="head1">Feedback</td>                
                <td class="head1">FollowUp date</td>        
				 <td class="head1">Comments</td>        
                </tr>
              <?			
	if($resCount>0)
			{
				$color = 1;		
				
		while($row = $obj->fun_db_fetch_rs_object($result))
		{
			//print_r($obj->fun_db_fetch_rs_object($result));
			$Followup_Date = $row->Followup_Date;				
			$exptodayformat = explode(" ",$Followup_Date);
			$explodeTime = explode(":",$exptodayformat[1]);
			$explodeHr = $explodeTime[0] - 1; 
			$FinalMinDate = '"'.$exptodayformat[0].' '.$explodeHr.':'.$explodeTime[1].':'.$explodeTime[2].'"';
			$FinalMaxDate ='"'.$exptodayformat[0].' 23:59:59"';
			$TodayFormat = date("Y-m-d");
			$FinalDay = $exptodayformat[0];		
			$Employment_Status=$row->Employment_Status;
			$RequestID=$row->RequestID;
			
			if($color%2!=0)
					{
						$colorvar = "#FFF";
					}
				else{
						$colorvar = "#EEE";
					}
	?>
			 <tr  bgcolor="<?php echo $colorvar;?>">			 
			 <td class="bodyarial11"><?php echo $row->RequestID; ?></td>
			<td class="bodyarial11"><a href="/hllmsallocate_editlead.php?id=<? echo urlencode($row->RequestID); ?>&Bid=<? echo $BidderIDstatic;?>" target="_blank"><? echo $row->Name; ?></a></td>
			<!--<td class="bodyarial11"><?php //echo $row->Mobile_Number; ?></td>-->
			<td class="bodyarial11"><? echo $row->Net_Salary; ?></td>
			<td class="bodyarial11"><? echo $row->City; ?></td>
			<!--<td class="bodyarial11">--><?php /*$BidsSql = "SELECT BidderID from Req_Feedback_Bidder_HL where AllRequestID ='".$RequestID."'";
		//$BidsQuery = ExecQuery($BidsSql);
		$BidsQuery = $obj->fun_db_query($BidsSql);
		$BiddName="";
		while($BidsRow = $obj->fun_db_fetch_rs_object($BidsQuery))
			{
		$BiddName .= $BidsRow->BidderID.",";
			} 
		$BiddName = substr(trim($BiddName), 0, strlen(trim($BiddName))-1);
		$BidsdtSql = "SELECT Bidder_Name from Bidders_List where BidderID in (".$BiddName.")";
		$BidsdtQuery = $obj->fun_db_query($BidsdtSql); 
		$BiddNamedt="";
		while($BidsdtRow = $obj->fun_db_fetch_rs_object($BidsdtQuery))
			{
		$BiddNamedt .= $BidsdtRow->Bidder_Name.",";
			} 
			echo $BiddNamedt;*/
		?><!--</td>-->       
		<td class="bodyarial11">
             <? echo $row->Feedback; ?>   
       </td>
         <td class="bodyarial11"><input type="text" name="Followup_Date" id="Followup_Date" value="<? echo $Followup_Date; ?>"></td>
		  <td class="bodyarial11"><textarea rows="2" cols="10"><? echo $row->comment_section; ?></textarea></td>
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
