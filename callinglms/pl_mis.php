<?php
require_once("includes/application-top-inner.php");
define("ADMIN_TITLE", "Personal Loan MIS Report");
define("FDBCKCALLDONE", "'Ringing','Not Contactable','No Feedback',''");// Not In define Feedbacks
define("FDBCKNOFEEDBACK", "''");// For No Feedback
define("FDBCKRINGING", "'Ringing'");// For Ringing
define("FDBCKCONVERTED", "'Appointment'");
define("FDBCKFOLLOWUP", "'FollowUp'");
define("FDBCKNOTCONTACT", "'Not Contactable'");
define("FDBCKNOTELIGIBLEFOIR", "'Not Eligible - FOIR'");
define("FDBCKNOTELIGIBLESALARY", "'Not Eligible - Salary'");
define("FDBCKNOTELIGIBLEOTHERS", "'Not Eligible - Others'");
define("FDBCKNOTINTERESTDIRECT", "'Not Interested - Direct'");
define("FDBCKNOTINTERESTOFFER", "'Not Interested - Offer'");
define("FDBCKNOTINTERESTLOANAMOUNT", "'Not Interested - Loan Amount'");
define("FDBCKTUPART", "'TU Approved','TU Approved Followup','TU Approved Not Interested','TU Referred','TU Referred Followup','TU Referred Not Interested','TU Declined'");

//+ Tata Capital
define("FDBCKCIBOKFOLLOWUP", "'CIBIL ok - Follow Up'");
define("FDBCKCIBOKNI", "'CIBIL Ok - Not Interested'");
define("FDBCKNECIBIL", "'NE - CIBIL'");
define("FDBCKNEOTHER", "'NE - Other'");
define("FDBCKCIBREFFOLLOWUP", "'CIBIL Refer - Follow Up'");
define("FDBCKCIBREFNI", "'CIBIL Refer - Not Interested'");

//TU Feedback
define("FDBCKTUAPPROVED", "'TU Approved'");
define("FDBCKTUAPPROVEDFOLLOWUP", "'TU Approved Followup'");
define("FDBCKTUAPPROVEDNOTINTERESTED", "'TU Approved Not Interested'");
define("FDBCKTUREFERRED", "'TU Referred'");
define("FDBCKTUREFERREDFOLLOWUP", "'TU Referred Followup'");
define("FDBCKTUREFERREDNOTINTERESTED", "'TU Referred Not Interested'");
define("FDBCKTUDECLINED", "'TU Declined'");



// CFL and IIFL 
define("FDBCKNOTELIGIBLE", "'Not Eligible'");
define("FDBCKNOTINTERESTED", "'Not Interested'");
define("FDBCKCALLBACKLATER", "'Callback Later'");
define("FDBCKWRONGNUMBER", "'Wrong Number'");
define("FDBCKPROCESS", "'Process'");
define("FDBCKCLOSED", "'Closed'");
define("FDBCKNOTAVAILABLE", "'Not Available'");
define("FDBCKDOCUMENTSPICK", "'Documents Pick'");
define("FDBCKLOANREJECTED", "'Loan Rejected'");





if ($_REQUEST['min_date'] == '') {
    $min_date = date("Y-m-d");
} else {
    $min_date = "";
    if (isset($_REQUEST['min_date'])) {
        $min_date = $_REQUEST['min_date'];
    }
}

if ($_REQUEST['max_date'] == '') {
    $max_date = date("Y-m-d");
} else {
    $max_date = "";
    if (isset($_REQUEST['max_date'])) {
        $max_date = $_REQUEST['max_date'];
    }
}
$Campaign="";
if(isset($_REQUEST['Campaign']))
    {
        $Campaign = $_REQUEST['Campaign'];
    }
$Agents = '';	
if(isset($_REQUEST['Agents']))
    {
        $Agents = $_REQUEST['Agents'];
    }

$varCmbFeedback = "";
if (isset($_REQUEST['cmbfeedback'])) {
    $varCmbFeedback = $_REQUEST['cmbfeedback'];
}
$min_date = $min_date . " 00:00:00";
$max_date = $max_date . " 23:59:59";

function getReqValue1($pKey){
	$titles = array(
        '1' => 'Req_Loan_Personal'
            );
	foreach ($titles as $key=>$value)
	    if($pKey==$key)
		return $value;
	return "";
  }
// Get Lead Recieve
function LeadReceivedCount($BidId, $min_date, $max_date) {
    $productVal=1;
    $val = getReqValue1($productVal);
    $pro_code=$productVal; 
    
    if($_REQUEST['Campaign']=='CallerAccountIIFL' || $_REQUEST['Campaign']=='CallerAccountCFL')
    {
       
        return $qry="SELECT RequestID FROM Req_Feedback_Bidder_PL,`Req_Loan_Personal` LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID=Req_Loan_Personal.RequestID AND Req_Feedback.BidderID in(".$BidId.") WHERE Req_Feedback_Bidder_PL.AllRequestID=`Req_Loan_Personal`.RequestID and Req_Feedback_Bidder_PL.BidderID  in(".$BidId.") and Req_Feedback_Bidder_PL.Reply_Type=1 and (Req_Feedback_Bidder_PL.Allocation_Date Between '".($min_date)."' and '".($max_date)."' or Req_Feedback.Followup_Date Between '".($min_date)."' and '".($max_date)."') group by Req_Loan_Personal.Mobile_Number";
        
    }else{
    
    $qry="SELECT * FROM client_lead_allocate,".$val."  WHERE (client_lead_allocate.BidderID in(".$BidId.") and client_lead_allocate.Reply_Type=".$pro_code." and client_lead_allocate.AllRequestID=`".$val."`.RequestID and (client_lead_allocate.Allocation_Date Between '".($min_date)."' and '".($max_date)."' or client_lead_allocate.Followup_Date Between '".($min_date)."' and '".($max_date)."'))";
    return $qry=$qry."group by ".$val.".Mobile_Number";
    }
}

function CallingDone($BidId, $min_date, $max_date, $FeedbackVal) {
    $productVal=1;
    $val = getReqValue1($productVal);
    $pro_code=$productVal; 
    if($_REQUEST['Campaign']=='CallerAccountIIFL' || $_REQUEST['Campaign']=='CallerAccountCFL')
    {
       
        return $qry="SELECT RequestID,axis_executive_name FROM Req_Feedback_Bidder_PL,`Req_Loan_Personal` LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID=Req_Loan_Personal.RequestID AND Req_Feedback.BidderID in(".$BidId.") WHERE Req_Feedback_Bidder_PL.AllRequestID=`Req_Loan_Personal`.RequestID and Req_Feedback_Bidder_PL.BidderID  in(".$BidId.") and Req_Feedback_Bidder_PL.Reply_Type=1 and (Req_Feedback_Bidder_PL.Allocation_Date Between '".($min_date)."' and '".($max_date)."' or Req_Feedback.Followup_Date Between '".($min_date)."' and '".($max_date)."') AND Req_Feedback.Feedback  NOT IN ($FeedbackVal) group by Req_Loan_Personal.Mobile_Number";
        
    }else{
    $FeedbackClause = " AND client_lead_allocate.Feedback NOT IN ($FeedbackVal)";
    $qry="SELECT * FROM client_lead_allocate,".$val."  WHERE (client_lead_allocate.BidderID in(".$BidId.") and client_lead_allocate.Reply_Type=".$pro_code." and client_lead_allocate.AllRequestID=`".$val."`.RequestID and (client_lead_allocate.Allocation_Date Between '".($min_date)."' and '".($max_date)."' or client_lead_allocate.Followup_Date Between '".($min_date)."' and '".($max_date)."'))";
    $qry=$qry.$FeedbackClause." ".$citywise_clause." ".$mob_num_clause." ".$refernce_no_clause." ".$Primary_AccClause;
    return $qry=$qry."group by ".$val.".Mobile_Number";
    }
    
    }

function GetConvertedCnt($BidId, $min_date, $max_date, $FeedbackVal) {
    $productVal=1;
    $val = getReqValue1($productVal);
    $pro_code=$productVal;
    
    if($_REQUEST['Campaign']=='CallerAccountIIFL' || $_REQUEST['Campaign']=='CallerAccountCFL')
    {
       
    $qry="SELECT RequestID FROM Req_Feedback_Bidder_PL,`Req_Loan_Personal` LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID=Req_Loan_Personal.RequestID AND Req_Feedback.BidderID in(".$BidId.") WHERE Req_Feedback_Bidder_PL.AllRequestID=`Req_Loan_Personal`.RequestID and Req_Feedback_Bidder_PL.BidderID  in(".$BidId.") and Req_Feedback_Bidder_PL.Reply_Type=1 and (Req_Feedback_Bidder_PL.Allocation_Date Between '".($min_date)."' and '".($max_date)."' or Req_Feedback.Followup_Date Between '".($min_date)."' and '".($max_date)."') AND Req_Feedback.Feedback  IN ($FeedbackVal) group by Req_Loan_Personal.Mobile_Number";
        
    }else{
    $FeedbackClause = " AND client_lead_allocate.Feedback IN ($FeedbackVal)";
    $qry="SELECT * FROM client_lead_allocate,".$val."  WHERE (client_lead_allocate.BidderID in(".$BidId.") and client_lead_allocate.Reply_Type=".$pro_code." and client_lead_allocate.AllRequestID=`".$val."`.RequestID and (client_lead_allocate.Allocation_Date Between '".($min_date)."' and '".($max_date)."' or client_lead_allocate.Followup_Date Between '".($min_date)."' and '".($max_date)."'))";
    $qry=$qry.$FeedbackClause." ".$citywise_clause." ".$mob_num_clause." ".$refernce_no_clause." ".$Primary_AccClause;
    $qry=$qry."group by ".$val.".Mobile_Number";
    }
    return $qry;
}

function GetNofeedback($BidId, $min_date, $max_date, $FeedbackVal) {
    $productVal=1;
    $val = getReqValue1($productVal);
    $pro_code=$productVal;
    if($_REQUEST['Campaign']=='CallerAccountIIFL' || $_REQUEST['Campaign']=='CallerAccountCFL')
    {
       
    $qry="SELECT RequestID FROM Req_Feedback_Bidder_PL,`Req_Loan_Personal` LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID=Req_Loan_Personal.RequestID AND Req_Feedback.BidderID in(".$BidId.") WHERE Req_Feedback_Bidder_PL.AllRequestID=`Req_Loan_Personal`.RequestID and Req_Feedback_Bidder_PL.BidderID  in(".$BidId.") and Req_Feedback_Bidder_PL.Reply_Type=1 and (Req_Feedback_Bidder_PL.Allocation_Date Between '".($min_date)."' and '".($max_date)."' or Req_Feedback.Followup_Date Between '".($min_date)."' and '".($max_date)."') AND ((Req_Feedback.Feedback  is NULL) OR (Req_Feedback.Feedback =''))  group by Req_Loan_Personal.Mobile_Number";
        
    }else{
    
    $FeedbackClause = " AND ((client_lead_allocate.Feedback is NULL) OR (client_lead_allocate.Feedback ='No Feedback'))";
    
    $qry="SELECT * FROM client_lead_allocate,".$val."  WHERE (client_lead_allocate.BidderID in(".$BidId.") and client_lead_allocate.Reply_Type=".$pro_code." and client_lead_allocate.AllRequestID=`".$val."`.RequestID and (client_lead_allocate.Allocation_Date Between '".($min_date)."' and '".($max_date)."' or client_lead_allocate.Followup_Date Between '".($min_date)."' and '".($max_date)."'))";
    $qry=$qry.$FeedbackClause." ".$citywise_clause." ".$mob_num_clause." ".$refernce_no_clause." ".$Primary_AccClause;
    $qry=$qry."group by ".$val.".Mobile_Number";
    }
    
     return $qry;
}

?>
<html>
    <head>
        <meta http-equiv="Content-Language" content="en-us">
        <meta http-equiv="Content-Type" content="text/html; charset=WINDOWS-1252">
        <title><?= ADMIN_TITLE; ?></title>
        <script Language="JavaScript" Type="text/javascript" src="../scripts/common.js"></script>
        <link href="../includes/style1.css" rel="stylesheet" type="text/css">
        <link href="../style.css" rel="stylesheet" type="text/css" />
        <!--DatePicker Start-->
        <link rel="stylesheet" type="text/css" href="css-datepicker/jquery-ui.css">
        <link rel="stylesheet" type="text/css" href="css-datepicker/datepicker.css">
        <script src="js-datepicker/jquery-1.5.1.js"></script>
        <script src="js-datepicker/jquery.ui.core.js"></script>
        <script src="js-datepicker/jquery.ui.datepicker.js"></script>
        <script>
            $(function () {
                var dates = $("#min_date, #max_date").datepicker({
                    defaultDate: "+1w",
                    changeMonth: true,
                    changeYear: true,
                    numberOfMonths: 1,
                    onSelect: function (selectedDate) {
                        var option = this.id == "min_date" ? "minDate" : "maxDate",
                                instance = $(this).data("datepicker"),
                                date = $.datepicker.parseDate(
                                        instance.settings.dateFormat ||
                                        $.datepicker._defaults.dateFormat,
                                        selectedDate, instance.settings);
                        dates.not(this).datepicker("option", option, date);
                    }
                });
            });

function getAgentsinCampaign(leadidentifier)
    {	
	   $.ajax({ type: 'post',  url: '/getAgentsinCampaign.php',  data: {  leadidentifier:leadidentifier, },
			   success: function (response) {
			   //alert(response);
			   $( '#Agents' ).html(response);
  		          if(response=="OK") { return true;	 } else { return false;	}
                }
		      });
	  
	}
        </script>
        <!--DatePicker End-->
    </head>
    <body style="margin:0px 0px 0px 0px; padding:0px 0px 0px 0px; background-color:#45B2D8;">
        <?php include "header_pl_admin_lms.php"; ?>

        <div style="clear:both;"></div>
    </div>
    <div style="clear:both; height:15px;"></div>
    <div> 
        <table width="98%" border="0">
              <!--<tr><td align="right"><a href="/commonlms_report.php?bidderid=<?php echo $_SESSION['BidderID']; ?>&product=11" target="_blank">today's Report</a></td></tr>-->
            <tr>
                <td align="right"></td>
            </tr>
            <tr>
                <td align="center" width="100%">
                        <form name="frmsearch" action="pl_mis.php" method="get" onSubmit="return chkform();">
                            <table width="600" border="0" cellpadding="4" cellspacing="1" class="blueborder" bgcolor="#FFFFFF">

                                <input type="hidden" name="BidderIDstatic" id="BidderIDstatic" value="<? echo $_SESSION["BidderID"]; ?>">
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
                                        <input name="min_date" type="text" id="min_date" size="15" value="<? if($_REQUEST['min_date']==''){echo date("Y-m-d");}else {echo $_REQUEST['min_date'];} ?>" ></td>
                                    <td width="13%" style="text-align:right;">To</td>
                                    <td><input name="max_date" type="text" id="max_date" size="15" value="<? if($_REQUEST['max_date']==''){echo date("Y-m-d");}else {echo $_REQUEST['max_date']; } ?>"></td>
                                </tr>
<tr> <td colspan="4">
                    <table width="100%">
                        <tr>
                            <td><strong>Campaigns</strong></td>
                  <td>
                  <select name="Campaign" id="Campaign" onchange="getAgentsinCampaign(this.value)">
                      <option value="" <? if($Campaign == "") { echo "selected"; } ?>>Please Select</option>
                  <?php
$qryCheck = "SELECT BidderID, leadidentifier,Process_Name FROM Bidders where leadidentifier in ('CallerAccountBTata','CallerAccountCFL','CallerAccountICICI','CallerAccountIIFL','CallerAccountMICICI','CallerAccountMTata','CallerAccountOICICI','CallerAccountCICICI','CallerAccountRBLDMP','CallerAccountRBLBHC','CallerAccountRBLDH','CallerAccountINDUSINDBCH','CallerAccountINDUSINDDMP','CallerAccountDialingDMP','CallerAccountDialingBCH','CallerAccountQBERABCD','CallerAccountCTata','CallingIncredDM','PL_ICICI_BCDHKMP','tatacapitalcalling','ICICISALAccount','CallerAccountQBERAMETRO','CallerAccountCFLAllCity','CallerAccountINDUSINDALL','CallerAccountRBLMCK','CallerAccountICICIBangalore','tatacapitalBcalling','CallerAccountAPKTata') group by leadidentifier ORDER BY Associated_Bank ASC";//'CallerAccountCity',  
$resCountCheck = $objAdmin->fun_get_num_rows($qryCheck);
$qryCheckResult = $obj->fun_db_query($qryCheck);
while($row = $obj->fun_db_fetch_rs_object($qryCheckResult))
    {
?>
<option value="<?php echo $row->leadidentifier; ?>" <? if($Campaign == $row->leadidentifier) { echo "selected"; } ?>><?php echo $row->Process_Name; ?></option>
<?php								
    }
?></select></td>
<td width="25%" style="text-align: right;"><strong>Agents</strong></td>
				  <td width="25%">
				  <span id="name_agents">
<?php
    $qryCheck1 = "SELECT BidderID, Bidder_Name, Status FROM Bidders where leadidentifier in ('".$Campaign."') and leadidentifier!='' AND Status=1";
    $recordcount = $objAdmin->fun_get_num_rows($qryCheck1);
    $qryCheckResult1 = $obj->fun_db_query($qryCheck1);
    $status_text = '';
?>
    <select name="Agents" id="Agents" ><?php if($recordcount>0) { ?><option value="All" <? if($Agents == "All") { echo "selected"; } ?>>All</option><?php while($row1 = $obj->fun_db_fetch_rs_object($qryCheckResult1)) { $Status = $row1->Status; if($Status ==1) {$status_text = "Enabled"; } else { $status_text = "Disabled"; }  ?><option value="<?php echo $row1->BidderID; ?>" <? if($Agents == $row1->BidderID) { echo "selected"; } ?>><?php echo $row1->BidderID; ?> [<?php echo $row1->Bidder_Name; ?>] (<?php echo $status_text; ?>) </option><?php	 } } else { echo '<option value="">Please Select</option>'; } ?></select>
				  </span>
				  </td>
				  </tr>
                        </table></td> </tr>

                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td align="left"><input name="Submit" type="submit" class="bluebutton" value="Search" border="0"></td>
                                </tr>
                            </table>
                        </form>
                        <p>&nbsp;</p>
<?php
                           $qryGetAgent = "SELECT BidderID, Bidder_Name, Associated_Bank,Status,leadidentifier FROM Bidders where leadidentifier in ('".$Campaign."') and leadidentifier!='' AND Status=1";
                            if($Agents!='All'){
                              $qryGetAgent .=   " AND BidderID='".$Agents."'";
                            }
                            
                            $recordcount = $objAdmin->fun_get_num_rows($qryGetAgent);
                            $qryCheckResultAgent = $obj->fun_db_query($qryGetAgent);
                           
if($_REQUEST['search']=='y'){
                            ?>
                        <table width="97%" border="0" cellpadding="4" cellspacing="1" class="blueborder" bgcolor="#FFFFFF">
<tr>
                                <td class="head1" colspan="26">Personal Loan - Lead Assessment - Date range (<?php echo $min_date?> to <?php echo $max_date?>)</td>
                            </tr>
                            <tr>
                <td class="head1">Agent</td>
                <td class="head1">Lead Received</td>
                <td class="head1">Calling done</td>
                <td class="head1">No Feedback </td>
                <td class="head1">Ringing </td>
                <td class="head1">Not Contactable</td>
                <td class="head1">Appointment</td>
                <td class="head1">Follow up</td>
                <?php if($Campaign=='CallerAccountIIFL' || $Campaign=='CallerAccountCFL')
                {?>
                  <td class="head1">Not Eligible</td>
                  <td class="head1">Not Interested</td>
                  <td class="head1">Callback Later</td>
                  <td class="head1">Wrong Number</td>
                  <td class="head1">Process</td>
                  <td class="head1">Closed</td>
                  <td class="head1">Not Available</td>
                  <td class="head1">Documents Pick</td>
                  <td class="head1">Loan Rejected</td>

                <?php }else{
                    ?>
                
                <td class="head1">Not Eligible - FOIR</td>
                <td class="head1">Not Eligible - Salary</td>
                <td class="head1">Not Eligible - Others</td>
                <td class="head1">Not Interested - Direct</td>
                <td class="head1">Not Interested - Offer (ROI/PF etc)</td>
                <td class="head1">Not Interested - Loan Amount</td>
                
                 <?php 
                //Tata Capital
                if($Campaign=='CallerAccountBTata' || $Campaign=='CallerAccountMTata')
                {?>
                <td class="head1">CIBIL ok - Follow Up</td>
                <td class="head1">CIBIL Ok - Not Interested</td>
                <td class="head1">NE - CIBIL</td>
                <td class="head1">NE - Other</td>
                <td class="head1">CIBIL Refer - Follow Up</td>
                <td class="head1">CIBIL Refer - Not Interested</td>
                <?php }?>
                
                
                <?php 
                //RBL Bank
                if($Campaign=='CallerAccountRBLBHC' || $Campaign=='CallerAccountRBLDH' || $Campaign=='CallerAccountRBLDMP')
                {?>
                 <td class="head1">TU Approved</td>
                 <td class="head1">TU Referred</td>
                 <td class="head1">TU Declined</td>
                <?php }?>
               	
                <?php if($Campaign=='CallerAccountOICICI' || $Campaign=='CallerAccountICICI' || $Campaign=='CallerAccountMICICI' || $Campaign=='CallerAccountOICICI' || $Campaign=='CallerAccountCICICI')
                {?>
                
                <td class="head1">TU Approved</td>
                <td class="head1">TU Approved Followup</td>
                <td class="head1">TU Approved Not Interested</td>
                <td class="head1">TU Referred</td>
                <td class="head1">TU Referred Followup</td>
                <td class="head1">TU Referred Not Interested</td>
                <td class="head1">TU Declined</td>
                <?php 
                }
                }?>
                <td class="head1">L2C %</td>
            </tr>
           
<?
if ($recordcount > 0) {
    $color = 1; 
    while ($rowAgent = $obj->fun_db_fetch_rs_object($qryCheckResultAgent)) {
        $full_name = $rowAgent->Bidder_Name;
        $BidderID = $rowAgent->BidderID;
        $feedback_tble = "lead_allocate";
        $LeadCnt = LeadReceivedCount($BidderID, $min_date, $max_date);
        $LeadRecCnt = $obj->fun_db_query($LeadCnt);
        $num_rows = $obj->fun_db_get_num_rows($LeadRecCnt);
       
        // Calling Done
        $FeedbackCallDone = FDBCKCALLDONE;
        $callingDone = CallingDone($BidderID, $min_date, $max_date, $FeedbackCallDone);
        $LeadcallingDoneCnt = $obj->fun_db_query($callingDone);
        $num_rowsCallingDone = $obj->fun_db_get_num_rows($LeadcallingDoneCnt);
        $percentageCallingDone = $num_rowsCallingDone * 100 / $num_rows;
        //Converted
        $Convertfdbk = FDBCKCONVERTED;
        $Converted = GetConvertedCnt($BidderID, $min_date, $max_date, $Convertfdbk);
        $LeadConvertedCnt = $obj->fun_db_query($Converted);
        $num_rowsConverted = $obj->fun_db_get_num_rows($LeadConvertedCnt);
        //Percentage Converted
        $percentageConvert = $num_rowsConverted * 100 / $num_rows;
        
        // Not Contact
        $NotContact = FDBCKNOTCONTACT;
        $NotContactVal = GetConvertedCnt($BidderID, $min_date, $max_date, $NotContact);
        $LeadNotContactCnt = $obj->fun_db_query($NotContactVal);
        $num_rowsNotContact = $obj->fun_db_get_num_rows($LeadNotContactCnt);
        $percentageNotContact = $num_rowsNotContact * 100 / $num_rows;
        
        

        //FollowUp
        $FollowUpfdbk = FDBCKFOLLOWUP;
        $FollowUpVal = GetConvertedCnt($BidderID, $min_date, $max_date, $FollowUpfdbk);
        $LeadFollowUpCnt = $obj->fun_db_query($FollowUpVal);
        $num_rowsFollowUp = $obj->fun_db_get_num_rows($LeadFollowUpCnt);

        //Percentage FollowUp
        $percentageFollowUp = $num_rowsFollowUp * 100 / $num_rows;

        
        //Not Eligible - FOIR
        $NotEligibleFoirfdbk = FDBCKNOTELIGIBLEFOIR;
        $NotEligibleFoirVal = GetConvertedCnt($BidderID, $min_date, $max_date, $NotEligibleFoirfdbk);
        $LeadNotEligibleFoirCnt = $obj->fun_db_query($NotEligibleFoirVal);
        $num_rowsNotEligibleFoir = $obj->fun_db_get_num_rows($LeadNotEligibleFoirCnt);

        //Percentage Not Eligible - FOIR
        $percentageNotEligibleFoir = $num_rowsNotEligibleFoir * 100 / $num_rows;
        //Not Eligible - Salary
        $NotEligibleSalaryfdbk = FDBCKNOTELIGIBLESALARY;
        $NotEligibleSalaryVal = GetConvertedCnt($BidderID, $min_date, $max_date, $NotEligibleSalaryfdbk);
        $LeadNotEligibleSalaryCnt = $obj->fun_db_query($NotEligibleSalaryVal);
        $num_rowsNotEligibleSalary = $obj->fun_db_get_num_rows($LeadNotEligibleSalaryCnt);

        //Percentage Not Eligible - Salary
        $percentageNotEligibleSalary = $num_rowsNotEligibleSalary * 100 / $num_rows;
        
        
        //Not Eligible - Others
        $NotEligibleOthersfdbk = FDBCKNOTELIGIBLEOTHERS;
        $NotEligibleOthersVal = GetConvertedCnt($BidderID, $min_date, $max_date, $NotEligibleOthersfdbk);
        $LeadNotEligibleOthersCnt = $obj->fun_db_query($NotEligibleOthersVal);
        $num_rowsNotEligibleOthers = $obj->fun_db_get_num_rows($LeadNotEligibleOthersCnt);

        //Percentage Not Eligible - Others
        $percentageNotEligibleOthers = $num_rowsNotEligibleOthers * 100 / $num_rows;

        
        //Not Interested - Direct
        $NotIntDirectfdbk = FDBCKNOTINTERESTDIRECT;
        $NotIntDirectVal = GetConvertedCnt($BidderID, $min_date, $max_date, $NotIntDirectfdbk);
        $LeadNotIntDirectCnt = $obj->fun_db_query($NotIntDirectVal);
        $num_rowsNotIntDirect = $obj->fun_db_get_num_rows($LeadNotIntDirectCnt);

        //Percentage Not Interested - Direct
        $percentageNotIntDirect = $num_rowsNotIntDirect * 100 / $num_rows;
        //Not Interested - Offer
        $NotIntOfferfdbk = FDBCKNOTINTERESTOFFER;
        $NotIntOfferVal = GetConvertedCnt($BidderID, $min_date, $max_date, $NotIntOfferfdbk);
        $LeadNotIntOfferCnt = $obj->fun_db_query($NotIntOfferVal);
        $num_rowsNotIntOffer = $obj->fun_db_get_num_rows($LeadNotIntOfferCnt);
        //Percentage Not Interested - Offer
        $percentageNotIntOffer = $num_rowsNotIntOffer * 100 / $num_rows;
        //Not Interested - Loan Amount
        $NotIntLoanAmountfdbk = FDBCKNOTINTERESTLOANAMOUNT;
        $NotIntLoanAmountVal = GetConvertedCnt($BidderID, $min_date, $max_date, $NotIntLoanAmountfdbk);
        $LeadNotIntLoanAmountCnt = $obj->fun_db_query($NotIntLoanAmountVal);
        $num_rowsNotIntLoanAmount = $obj->fun_db_get_num_rows($LeadNotIntLoanAmountCnt);

        //Percentage Not Interested - Loan Amount
        $percentageNotIntLoanAmount = $num_rowsNotIntLoanAmount * 100 / $num_rows;
        
        $NoFeedbackfdbk = FDBCKNOFEEDBACK;
        $NoFeedbackArr = GetNofeedback($BidderID, $min_date, $max_date, $NoFeedbackfdbk);
        $NoFeedbackCnt = $obj->fun_db_query($NoFeedbackArr);
        $num_rowsNoFeedback = $obj->fun_db_get_num_rows($NoFeedbackCnt);
        
        //Percentage No Feedback
        $percentageNoFeedback = $num_rowsNoFeedback * 100 / $num_rows;
        
        //Ringing
        $Ringingfdbk = FDBCKRINGING;
        $RingingArr = GetConvertedCnt($BidderID, $min_date, $max_date, $Ringingfdbk);
        $LeadRingingCnt = $obj->fun_db_query($RingingArr);
        $num_rowsRinging = $obj->fun_db_get_num_rows($LeadRingingCnt);
        
        //Percentage Ringing
        $percentageRinging = $num_rowsRinging * 100 / $num_rows;
		
        
        // For TU
        $FDBCKTUPART = FDBCKTUPART;
        $TUVal = GetConvertedCnt($BidderID, $min_date, $max_date, $FDBCKTUPART);
        $LeadTUCnt = $obj->fun_db_query($TUVal);
        $num_rowstu = $obj->fun_db_get_num_rows($LeadTUCnt);
        $percentagetu = $num_rowstu * 100 / $num_rows;
        
        // TU Approved
        $FDBCKTUApproved = FDBCKTUAPPROVED;
        $TUApprovedVal = GetConvertedCnt($BidderID, $min_date, $max_date, $FDBCKTUApproved);
        $LeadTUApprovedCnt = $obj->fun_db_query($TUApprovedVal);
        $num_rowsTUApproved = $obj->fun_db_get_num_rows($LeadTUApprovedCnt);
        $percentageTUApproved = $num_rowsTUApproved * 100 / $num_rows;
        
        //TU Approved Followup
        $FDBCKTUApprovedFollowup = FDBCKTUAPPROVEDFOLLOWUP;
        $TUApprovedFollowupVal = GetConvertedCnt($BidderID, $min_date, $max_date, $FDBCKTUApprovedFollowup);
        $LeadTUApprovedFollowupCnt = $obj->fun_db_query($TUApprovedFollowupVal);
        $num_rowsTUApprovedFollowup = $obj->fun_db_get_num_rows($LeadTUApprovedFollowupCnt);
        $percentageTUApprovedFollowup = $num_rowsTUApprovedFollowup * 100 / $num_rows;
        
        //TU Approved Not Interested
        $FDBCKTUApprovedNotInterested = FDBCKTUAPPROVEDNOTINTERESTED;
        $TUApprovedNotInterestedVal = GetConvertedCnt($BidderID, $min_date, $max_date, $FDBCKTUApprovedNotInterested);
        $LeadTUApprovedNotInterestedCnt = $obj->fun_db_query($TUApprovedNotInterestedVal);
        $num_rowsTUApprovedNotInterested = $obj->fun_db_get_num_rows($LeadTUApprovedNotInterestedCnt);
        $percentageTUApprovedNotInterested = $num_rowsTUApprovedNotInterested * 100 / $num_rows;
        //TU Referred
        $FDBCKTUReferred = FDBCKTUREFERRED;
        $TUReferredVal = GetConvertedCnt($BidderID, $min_date, $max_date, $FDBCKTUReferred);
        $LeadTUReferredCnt = $obj->fun_db_query($TUReferredVal);
        $num_rowsTUReferred = $obj->fun_db_get_num_rows($LeadTUReferredCnt);
        $percentageTUReferred = $num_rowsTUReferred * 100 / $num_rows;
        
        //TU Referred Followup
        $FDBCKTUReferredFollowup = FDBCKTUREFERREDFOLLOWUP;
        $TUReferredFollowupVal = GetConvertedCnt($BidderID, $min_date, $max_date, $FDBCKTUReferredFollowup);
        $LeadTUReferredFollowupCnt = $obj->fun_db_query($TUReferredFollowupVal);
        $num_rowsTUReferredFollowup = $obj->fun_db_get_num_rows($LeadTUReferredFollowupCnt);
        $percentageTUReferredFollowup = $num_rowsTUReferredFollowup * 100 / $num_rows;
        
        //TU Referred Not Interested
        $FDBCKTUReferredNotInterested = FDBCKTUREFERREDNOTINTERESTED;
        $TUReferredNotInterestedVal = GetConvertedCnt($BidderID, $min_date, $max_date, $FDBCKTUReferredNotInterested);
        $LeadTUReferredNotInterestedCnt = $obj->fun_db_query($TUReferredNotInterestedVal);
        $num_rowsTUReferredNotInterested = $obj->fun_db_get_num_rows($LeadTUReferredNotInterestedCnt);
        $percentageTUReferredNotInterested = $num_rowsTUReferredNotInterested * 100 / $num_rows;
        //TU Declined
        $FDBCKTUDeclined = FDBCKTUDECLINED;
        $TUDeclinedVal = GetConvertedCnt($BidderID, $min_date, $max_date, $FDBCKTUDeclined);
        $LeadTUDeclinedCnt = $obj->fun_db_query($TUDeclinedVal);
        $num_rowsTUDeclined = $obj->fun_db_get_num_rows($LeadTUDeclinedCnt);
        $percentageTUDeclined = $num_rowsTUDeclined * 100 / $num_rows;
        
        
        //CFL and IIFL
        //Not Eligible 
        $NotEligiblefdbk = FDBCKNOTELIGIBLE;
        $NotEligibleArr = GetConvertedCnt($BidderID, $min_date, $max_date, $NotEligiblefdbk);
        $LeadNotEligibleCnt = $obj->fun_db_query($NotEligibleArr);
        $num_rowsNotEligible = $obj->fun_db_get_num_rows($LeadNotEligibleCnt);
        $percentageNotEligible = $num_rowsNotEligible * 100 / $num_rows;
        
        //Not Interested 
        $NotInterestedfdbk = FDBCKNOTINTERESTED;
        $NotInterestedArr = GetConvertedCnt($BidderID, $min_date, $max_date, $NotInterestedfdbk);
        $LeadNotInterestedCnt = $obj->fun_db_query($NotInterestedArr);
        $num_rowsNotInterested = $obj->fun_db_get_num_rows($LeadNotInterestedCnt);
        $percentageNotInterested = $num_rowsNotInterested * 100 / $num_rows;
        
        //Call back Later 
        $CallbackLaterfdbk = FDBCKCALLBACKLATER;
        $CallbackLaterArr = GetConvertedCnt($BidderID, $min_date, $max_date, $CallbackLaterfdbk);
        $LeadCallbackLaterCnt = $obj->fun_db_query($CallbackLaterArr);
        $num_rowsCallbackLater = $obj->fun_db_get_num_rows($LeadCallbackLaterCnt);
        $percentageCallbackLater = $num_rowsCallbackLater * 100 / $num_rows;
        
        //Wrong Number 
        $WrongNumberfdbk = FDBCKWRONGNUMBER;
        $WrongNumberArr = GetConvertedCnt($BidderID, $min_date, $max_date, $WrongNumberfdbk);
        $LeadWrongNumberCnt = $obj->fun_db_query($WrongNumberArr);
        $num_rowsWrongNumber = $obj->fun_db_get_num_rows($LeadWrongNumberCnt);
        $percentageWrongNumber = $num_rowsWrongNumber * 100 / $num_rows;
        
        //Process 
        $Processfdbk = FDBCKPROCESS;
        $ProcessArr = GetConvertedCnt($BidderID, $min_date, $max_date, $Processfdbk);
        $LeadProcessCnt = $obj->fun_db_query($ProcessArr);
        $num_rowsProcess = $obj->fun_db_get_num_rows($LeadProcessCnt);
        $percentageProcess = $num_rowsProcess * 100 / $num_rows;
        
        //Closed 
        $Closedfdbk = FDBCKCLOSED;
        $ClosedArr = GetConvertedCnt($BidderID, $min_date, $max_date, $Closedfdbk);
        $LeadClosedCnt = $obj->fun_db_query($ClosedArr);
        $num_rowsClosed = $obj->fun_db_get_num_rows($LeadClosedCnt);
        $percentageClosed = $num_rowsClosed * 100 / $num_rows;
        
        //Not Available 
        $NotAvailablefdbk = FDBCKNOTAVAILABLE;
        $NotAvailableArr = GetConvertedCnt($BidderID, $min_date, $max_date, $NotAvailablefdbk);
        $LeadNotAvailableCnt = $obj->fun_db_query($NotAvailableArr);
        $num_rowsNotAvailable = $obj->fun_db_get_num_rows($LeadNotAvailableCnt);
        $percentageNotAvailable = $num_rowsNotAvailable * 100 / $num_rows;
        
        //Documents Pick 
        $DocumentPickfdbk = FDBCKDOCUMENTSPICK;
        $DocumentPickArr = GetConvertedCnt($BidderID, $min_date, $max_date, $DocumentPickfdbk);
        $LeadDocumentPickCnt = $obj->fun_db_query($DocumentPickArr);
        $num_rowsDocumentPick = $obj->fun_db_get_num_rows($LeadDocumentPickCnt);
        $percentageDocumentPick = $num_rowsDocumentPick * 100 / $num_rows;
        
        //Loan Rejected
        $LoanRejectedfdbk = FDBCKLOANREJECTED;
        $LoanRejectedArr = GetConvertedCnt($BidderID, $min_date, $max_date, $LoanRejectedfdbk);
        $LeadLoanRejectedCnt = $obj->fun_db_query($LoanRejectedArr);
        $num_rowsLoanRejected = $obj->fun_db_get_num_rows($LeadLoanRejectedCnt);
        $percentageLoanRejected = $num_rowsLoanRejected * 100 / $num_rows;
        
        //TATA
        //CIBIL ok - Follow Up
        $CIBILokFollowUpfdbk = FDBCKCIBOKFOLLOWUP;
        $CIBILokFollowUpArr = GetConvertedCnt($BidderID, $min_date, $max_date, $CIBILokFollowUpfdbk);
        $LeadCIBILokFollowUpCnt = $obj->fun_db_query($CIBILokFollowUpArr);
        $num_rowsCIBILokFollowUp = $obj->fun_db_get_num_rows($LeadCIBILokFollowUpCnt);
        $percentageCIBILokFollowUp = $num_rowsCIBILokFollowUp * 100 / $num_rows;
        
        //CIBIL Ok - Not Interested
        $CibiOkNIfdbk = FDBCKCIBOKNI;
        $CibiOkNIArr = GetConvertedCnt($BidderID, $min_date, $max_date, $CibiOkNIfdbk);
        $LeadCibiOkNICnt = $obj->fun_db_query($CibiOkNIArr);
        $num_rowsCibiOkNI = $obj->fun_db_get_num_rows($LeadCibiOkNICnt);
        $percentageCibiOkNI = $num_rowsCibiOkNI * 100 / $num_rows;
        
        //NE - CIBIL
        $NECibilfdbk = FDBCKNECIBIL;
        $NECibilArr = GetConvertedCnt($BidderID, $min_date, $max_date, $NECibilfdbk);
        $LeadNECibilCnt = $obj->fun_db_query($NECibilArr);
        $num_rowsNECibil = $obj->fun_db_get_num_rows($LeadNECibilCnt);
        $percentageNECibil = $num_rowsNECibil * 100 / $num_rows;
        
        //NE - Other
        $NEOtherfdbk = FDBCKNEOTHER;
        $NEOtherArr = GetConvertedCnt($BidderID, $min_date, $max_date, $NEOtherfdbk);
        $LeadNEOtherCnt = $obj->fun_db_query($NEOtherArr);
        $num_rowsNEOther = $obj->fun_db_get_num_rows($LeadNEOtherCnt);
        $percentageNEOther = $num_rowsNEOther * 100 / $num_rows;
        
        //CIBIL Refer - Follow Up
        $CibRefFollowupfdbk = FDBCKCIBREFFOLLOWUP;
        $CibRefFollowupArr = GetConvertedCnt($BidderID, $min_date, $max_date, $CibRefFollowupfdbk);
        $LeadCibRefFollowupCnt = $obj->fun_db_query($CibRefFollowupArr);
        $num_rowsCibRefFollowup = $obj->fun_db_get_num_rows($LeadCibRefFollowupCnt);
        $percentageCibRefFollowup = $num_rowsCibRefFollowup * 100 / $num_rows;
        
        //CIBIL Refer - Not Interested
        $CibilRefNIfdbk = FDBCKCIBREFNI;
        $CibilRefNIArr = GetConvertedCnt($BidderID, $min_date, $max_date, $CibilRefNIfdbk);
        $LeadCibilRefNICnt = $obj->fun_db_query($CibilRefNIArr);
        $num_rowsCibilRefNI = $obj->fun_db_get_num_rows($LeadCibilRefNICnt);
        $percentageCibilRefNI = $num_rowsCibilRefNI * 100 / $num_rows;
        
        
        //Lead To Disbursal %
       $qryDbrsed = "SELECT caller_id, RequestID, Feedback_ID, BidderID, BankID, feedback_date, disbursed_date FROM zexternal_appointment_docs WHERE caller_id  in ($BidderID) AND (disbursed_date between '".($min_date)."' and '".($max_date)."')";
        $LeadDbrsedRes = $obj->fun_db_query($qryDbrsed);
        $num_rowsDbrsed = $obj->fun_db_get_num_rows($LeadDbrsedRes);
        $rowDbrsed = $obj->fun_db_fetch_rs_object($LeadDbrsedRes);
        
        
        $L2CPercent = $num_rowsDbrsed*100/$num_rows;
        
        
      
//prin_r($LeadCnt);
//Get Comment (Response) 
        if ($color % 2 != 0) {
            $colorvar = "#FFF";
        } else {
            $colorvar = "#EEE";
        }
        ?>
                                    <!--///////////////////////-->
            <tr  bgcolor="<?php echo $colorvar; ?>">                                        <td class="bodyarial11"><? echo $full_name." [".$BidderID."]"; ?></td>
                <td class="bodyarial11"><?php echo $num_rows; ?></td>
                <td class="bodyarial11"><table border="0" cellspacing="0" width="100%">
                        <tr>
                            <td><?php echo $num_rowsCallingDone; ?></td>
                           </tr>
                           <tr>
                            <td><? echo round($percentageCallingDone,2); ?>%</td>
                           </tr>
                        
                    </table></td>
                <td class="bodyarial11"> <table border="0" cellspacing="0" width="100%">
                        <tr>
                            <td><? echo $num_rowsNoFeedback; ?></td>
                           </tr>
                           <tr>
                            <td><? echo round($percentageNoFeedback,2); ?>%</td>
                           </tr>
                        
                    </table></td>
                <td class="bodyarial11"><table border="0" cellspacing="0" width="100%">
                        <tr>
                            <td><? echo $num_rowsRinging; ?></td>
                           </tr>
                           <tr>
                            <td><? echo round($percentageRinging,2); ?>%</td>
                           </tr>
                        
                    </table></td>
                
                <td class="bodyarial11">
                    <table border="0" cellspacing="0" width="100%">
                        <tr>
                            <td>
                    <?php echo $num_rowsNotContact; ?></td>
                           </tr>
                           <tr>
                            <td><? echo round($percentageNotContact,2); ?>%</td>
                           </tr>
                        
                    </table></td>
                <td class="bodyarial11"><table border="0" cellspacing="0" width="100%">
                        <tr>
                            <td><?php echo $num_rowsConverted; ?></td>
                           </tr>
                           <tr>
                            <td><? echo round($percentageConvert,2); ?>%</td>
                           </tr>
                        
                    </table></td>
                
               
                <td class="bodyarial11"><table border="0" cellspacing="0" width="100%">
                        <tr>
                            <td><? echo $num_rowsFollowUp; ?></td>
                           </tr>
                           <tr>
                            <td><? echo round($percentageFollowUp,2); ?>%</td>
                           </tr>
                        
                    </table></td>
                <?php if($Campaign=='CallerAccountIIFL' || $Campaign=='CallerAccountCFL')
                {?>
               
                    <td class="bodyarial11"><table border="0" cellspacing="0" width="100%">
                        <tr>
                            <td><? echo $num_rowsNotEligible; ?></td>
                           </tr>
                           <tr>
                            <td><? echo round($percentageNotEligible,2); ?>%</td>
                           </tr>
                       
                    </table></td>
                    <td class="bodyarial11"><table border="0" cellspacing="0" width="100%">
                        <tr>
                            <td><? echo $num_rowsNotInterested; ?></td>
                           </tr>
                           <tr>
                            <td><? echo round($percentageNotInterested,2); ?>%</td>
                           </tr>
                       
                    </table></td>
                    <td class="bodyarial11"><table border="0" cellspacing="0" width="100%">
                        <tr>
                            <td><? echo $num_rowsCallbackLater; ?></td>
                           </tr>
                           <tr>
                            <td><? echo round($percentageCallbackLater,2); ?>%</td>
                           </tr>
                     
                    </table></td>
                    <td class="bodyarial11"><table border="0" cellspacing="0" width="100%">
                        <tr>
                            <td><? echo $num_rowsWrongNumber; ?></td>
                           </tr>
                           <tr>
                            <td><? echo round($percentageWrongNumber,2); ?>%</td>
                           </tr>
                        
                    </table></td>
                    <td class="bodyarial11"><table border="0" cellspacing="0" width="100%">
                        <tr>
                            <td><? echo $num_rowsProcess; ?></td>
                           </tr>
                           <tr>
                            <td><? echo round($percentageProcess,2); ?>%</td>
                           </tr>
                        
                    </table></td>
                    <td class="bodyarial11"><table border="0" cellspacing="0" width="100%">
                        <tr>
                            <td><? echo $num_rowsClosed; ?></td>
                           </tr>
                           <tr>
                            <td><? echo round($percentageClosed,2); ?>%</td>
                           </tr>
                        
                    </table></td>
                    <td class="bodyarial11"><table border="0" cellspacing="0" width="100%">
                        <tr>
                            <td><? echo $num_rowsNotAvailable; ?></td>
                           </tr>
                           <tr>
                            <td><? echo round($percentageNotAvailable,2); ?>%</td>
                           </tr>
                        
                    </table></td>
                    <td class="bodyarial11"><table border="0" cellspacing="0" width="100%">
                        <tr>
                            <td><? echo $num_rowsDocumentPick; ?></td>
                           </tr>
                           <tr>
                            <td><? echo round($percentageDocumentPick,2); ?>%</td>
                           </tr>
                       
                    </table></td>
                    <td class="bodyarial11"><table border="0" cellspacing="0" width="100%">
                        <tr>
                            <td><? echo $num_rowsLoanRejected; ?></td>
                           </tr>
                           <tr>
                            <td><? echo round($percentageLoanRejected,2); ?>%</td>
                           </tr>
                        
                    </table></td>
                    
                    
               <?php }else{
                ?>
                
                    <td class="bodyarial11"><table border="0" cellspacing="0" width="100%">
                        <tr>
                            <td><? echo $num_rowsNotEligibleFoir; ?></td>
                           </tr>
                           <tr>
                            <td><? echo round($percentageNotEligibleFoir,2); ?>%</td>
                           </tr>
                        
                    </table></td>
                
                <td class="bodyarial11"><table border="0" cellspacing="0" width="100%">
                        <tr>
                            <td><? echo $num_rowsNotEligibleSalary; ?></td>
                           </tr>
                           <tr>
                            <td><? echo round($percentageNotEligibleSalary,2); ?>%</td>
                           </tr>
                        
                    </table></td>
                
                <td class="bodyarial11"><table border="0" cellspacing="0" width="100%">
                        <tr>
                            <td><? echo $num_rowsNotEligibleOthers; ?></td>
                           </tr>
                           <tr>
                            <td><? echo round($percentageNotEligibleOthers,2); ?>%</td>
                           </tr>
                        
                    </table></td>
                
                <td class="bodyarial11"><table border="0" cellspacing="0" width="100%">
                        <tr>
                            <td><? echo $num_rowsNotIntDirect; ?></td>
                           </tr>
                           <tr>
                            <td><? echo round($percentageNotIntDirect,2); ?>%</td>
                           </tr>
                        
                    </table></td>
                
                <td class="bodyarial11"><table border="0" cellspacing="0" width="100%">
                        <tr>
                            <td><? echo $num_rowsNotIntOffer; ?></td>
                           </tr>
                           <tr>
                            <td><? echo round($percentageNotIntOffer,2); ?>%</td>
                           </tr>
                        
                    </table></td>
                
                <td class="bodyarial11"><table border="0" cellspacing="0" width="100%">
                        <tr>
                            <td><? echo $num_rowsNotIntLoanAmount; ?></td>
                           </tr>
                           <tr>
                            <td><? echo round($percentageNotIntLoanAmount,2); ?>%</td>
                           </tr>
                        
                    </table></td>
                     <?php 
                //Tata Capital
                if($Campaign=='CallerAccountBTata' || $Campaign=='CallerAccountMTata')
                {?>
                 <td class="bodyarial11"><table border="0" cellspacing="0" width="100%">
                        <tr>
                            <td><? echo $num_rowsCIBILokFollowUp; ?></td>
                           </tr>
                           <tr>
                            <td><? echo round($percentageCIBILokFollowUp,2); ?>%</td>
                           </tr>
                        
                    </table></td>
                    <td class="bodyarial11"><table border="0" cellspacing="0" width="100%">
                        <tr>
                            <td><? echo $num_rowsCibiOkNI; ?></td>
                           </tr>
                           <tr>
                            <td><? echo round($percentageCibiOkNI,2); ?>%</td>
                           </tr>
                        
                    </table></td>
                    <td class="bodyarial11"><table border="0" cellspacing="0" width="100%">
                        <tr>
                            <td><? echo $num_rowsNECibil; ?></td>
                           </tr>
                           <tr>
                            <td><? echo round($percentageNECibil,2); ?>%</td>
                           </tr>
                        
                    </table></td>
                    <td class="bodyarial11"><table border="0" cellspacing="0" width="100%">
                        <tr>
                            <td><? echo $num_rowsNEOther; ?></td>
                           </tr>
                           <tr>
                            <td><? echo round($percentageNEOther,2); ?>%</td>
                           </tr>
                        
                    </table></td>
                    <td class="bodyarial11"><table border="0" cellspacing="0" width="100%">
                        <tr>
                            <td><? echo $num_rowsCibRefFollowup; ?></td>
                           </tr>
                           <tr>
                            <td><? echo round($percentageCibRefFollowup,2); ?>%</td>
                           </tr>
                        
                    </table></td>
                    <td class="bodyarial11"><table border="0" cellspacing="0" width="100%">
                        <tr>
                            <td><? echo $num_rowsCibilRefNI; ?></td>
                           </tr>
                           <tr>
                            <td><? echo round($percentageCibilRefNI,2); ?>%</td>
                           </tr>
                        
                    </table></td>
                    
                <?php
                }
                ?>
                    
                    
                    <?php 
                //RBL Bank
                if($Campaign=='CallerAccountRBLBHC' || $Campaign=='CallerAccountRBLDH' || $Campaign=='CallerAccountRBLDMP')
                {?>
                 <td class="bodyarial11"><table border="0" cellspacing="0" width="100%">
                        <tr>
                            <td><? echo $num_rowsTUApproved; ?></td>
                           </tr>
                           <tr>
                            <td><? echo round($percentageTUApproved,2); ?>%</td>
                           </tr>
                        
                </table></td>
                <td class="bodyarial11"><table border="0" cellspacing="0" width="100%">
                        <tr>
                            <td><? echo $num_rowsTUReferred; ?></td>
                           </tr>
                           <tr>
                            <td><? echo round($percentageTUReferred,2); ?>%</td>
                           </tr>
                        
                </table></td>
                <td class="bodyarial11"><table border="0" cellspacing="0" width="100%">
                        <tr>
                            <td><? echo $num_rowsTUDeclined; ?></td>
                           </tr>
                           <tr>
                            <td><? echo round($percentageTUDeclined,2); ?>%</td>
                           </tr>
                        
                </table></td>
                
                <?php // RBL END
                }?>
                    
                    
                    
                <?php if($Campaign=='CallerAccountOICICI' || $Campaign=='CallerAccountICICI' || $Campaign=='CallerAccountMICICI' || $Campaign=='CallerAccountOICICI' || $Campaign=='CallerAccountCICICI')
                {?>
		<td class="bodyarial11"><table border="0" cellspacing="0" width="100%">
                        <tr>
                            <td><? echo $num_rowsTUApproved; ?></td>
                           </tr>
                           <tr>
                            <td><? echo round($percentageTUApproved,2); ?>%</td>
                           </tr>
                        
                </table></td>
                <td class="bodyarial11"><table border="0" cellspacing="0" width="100%">
                        <tr>
                            <td><? echo $num_rowsTUApprovedFollowup; ?></td>
                           </tr>
                           <tr>
                            <td><? echo round($percentageTUApprovedFollowup,2); ?>%</td>
                           </tr>
                        
                </table></td>
                <td class="bodyarial11"><table border="0" cellspacing="0" width="100%">
                        <tr>
                            <td><? echo $num_rowsTUApprovedNotInterested; ?></td>
                           </tr>
                           <tr>
                            <td><? echo round($percentageTUApprovedNotInterested,2); ?>%</td>
                           </tr>
                        
                </table></td>
                <td class="bodyarial11"><table border="0" cellspacing="0" width="100%">
                        <tr>
                            <td><? echo $num_rowsTUReferred; ?></td>
                           </tr>
                           <tr>
                            <td><? echo round($percentageTUReferred,2); ?>%</td>
                           </tr>
                        
                </table></td>
                <td class="bodyarial11"><table border="0" cellspacing="0" width="100%">
                        <tr>
                            <td><? echo $num_rowsTUReferredFollowup; ?></td>
                           </tr>
                           <tr>
                            <td><? echo round($percentageTUReferredFollowup,2); ?>%</td>
                           </tr>
                        
                </table></td>
                <td class="bodyarial11"><table border="0" cellspacing="0" width="100%">
                        <tr>
                            <td><? echo $num_rowsTUReferredNotInterested; ?></td>
                           </tr>
                           <tr>
                            <td><? echo round($percentageTUReferredNotInterested,2); ?>%</td>
                           </tr>
                        
                </table></td>
                <td class="bodyarial11"><table border="0" cellspacing="0" width="100%">
                        <tr>
                            <td><? echo $num_rowsTUDeclined; ?></td>
                           </tr>
                           <tr>
                            <td><? echo round($percentageTUDeclined,2); ?>%</td>
                           </tr>
                        
                </table></td>



                <?php } }?>
                
                <td class="bodyarial11"><table border="0" cellspacing="0" width="100%">
                        <tr>
                            <td><? echo $L2CPercent; ?>%</td>
                           </tr>
                           
                        
                </table></td>
                
            </tr>
                <?
                $color++;
                $totalLeadReceive += $num_rows;
                $totalCallingDone += $num_rowsCallingDone;
                $totalpercentageCallingDone += $percentageCallingDone;
                $totalNotConnect += $num_rowsNotContact;
                $totalpercentageNotContact +=$percentageNotContact;
                $totalConverted +=$num_rowsConverted;
                $totalConvertedPercent +=$percentageConvert;
                $totalFollowUp += $num_rowsFollowUp;
                $totalpercentageFollowUp += $percentageFollowUp;
                $totalNotEligibleFoir += $num_rowsNotEligibleFoir;
                $totalpercentageNotEligibleFoir += $percentageNotEligibleFoir;
                $totalNotEligibleSalary +=$num_rowsNotEligibleSalary;
                $totalpercentageNotEligibleSalary += $percentageNotEligibleSalary;
                $totalNotEligibleOthers +=$num_rowsNotEligibleOthers;
                $totalpercentageNotEligibleOthers += $percentageNotEligibleOthers;
                $totalNotIntDirect +=$num_rowsNotIntDirect;
                $totalpercentageNotIntDirect +=$percentageNotIntDirect;
                $totalNotIntOffer +=$num_rowsNotIntOffer;
                $totalpercentageNotIntOffer +=$percentageNotIntOffer;
                $totalNotIntLoanAmount +=$num_rowsNotIntLoanAmount;
                $totalpercentageNotIntLoanAmount +=$percentageNotIntLoanAmount;
                $totalNoFeedback +=$num_rowsNoFeedback;
                $totalpercentageNoFeedback +=$percentageNoFeedback;
                $totalRinging +=$num_rowsRinging;
                $totalpercentageRinging +=$percentageRinging;
                
                $totalTUApproved +=$num_rowsTUApproved;
                $totalpercentageTUApproved +=$percentageTUApproved;
                $totalTUApprovedFollowup +=$num_rowsTUApprovedFollowup;
                $totalpercentageTUApprovedFollowup +=$percentageTUApprovedFollowup;
                $totalTUApprovedNotInterested +=$num_rowsTUApprovedNotInterested;
                $totalpercentageTUApprovedNotInterested +=$percentageTUApprovedNotInterested;
                $totalTUReferred +=$num_rowsTUReferred;
                $totalpercentageTUReferred +=$percentageTUReferred;
                $totalTUReferredFollowup +=$num_rowsTUReferredFollowup;
                $totalpercentageTUReferredFollowup +=$percentageTUReferredFollowup;
                $totalTUReferredNotInterested +=$num_rowsTUReferredNotInterested;
                $totalpercentageTUReferredNotInterested +=$percentageTUReferredNotInterested;
                $totalTUDeclined +=$num_rowsTUDeclined;
                $totalpercentageTUDeclined +=$percentageTUDeclined;
                
                $totalNotEligible +=$num_rowsNotEligible;
                $totalpercentageNotEligible +=$percentageNotEligible;
                $totalNotInterested +=$num_rowsNotInterested;
                $totalpercentageNotInterested +=$percentageNotInterested;
                $totalCallbackLater +=$num_rowsCallbackLater;
                $totalpercentageCallbackLater +=$percentageCallbackLater;
                $totalWrongNumber +=$num_rowsWrongNumber;
                $totalpercentageWrongNumber +=$percentageWrongNumber;
                $totalProcess +=$num_rowsProcess;
                $totalpercentageProcess +=$percentageProcess;
                $totalClosed +=$num_rowsClosed;
                $totalpercentageClosed +=$percentageClosed;
                $totalNotAvailable +=$num_rowsNotAvailable;
                $totalpercentageNotAvailable +=$percentageNotAvailable;
                $totalDocumentPick +=$num_rowsDocumentPick;
                $totalpercentageDocumentPick +=$percentageDocumentPick;
                $totalLoanRejected +=$num_rowsLoanRejected;
                $totalpercentageLoanRejected +=$percentageLoanRejected;
                
                
                $totalCIBILokFollowUp +=$num_rowsCIBILokFollowUp;
                $totalpercentageCIBILokFollowUp +=$percentageCIBILokFollowUp;
                $totalCibiOkNI +=$num_rowsCibiOkNI;
                $totalpercentageCibiOkNI +=$percentageCibiOkNI;
                $totalNECibil +=$num_rowsNECibil;
                $totalpercentageNECibil +=$percentageNECibil;
                $totalNEOther +=$num_rowsNEOther;
                $totalpercentageNEOther +=$percentageNEOther;
                $totalCibRefFollowup +=$num_rowsCibRefFollowup;
                $totalpercentageCibRefFollowup +=$percentageCibRefFollowup;
                $totalCibilRefNI +=$num_rowsCibilRefNI;
                $totalpercentageCibilRefNI +=$percentageCibilRefNI;
                
                $totalpercentageL2C +=$L2CPercent;
                
                
            
            }
        }
        ?>
            <tr>
                <td><table border="0" cellspacing="0" width="100%">
                        <tr>
                            <td><strong>Total</strong></td>
                           </tr>
                           <tr>
                            <td>In %</td>
                           </tr>
                        
                    </table></td>
                <td><strong><?php echo $totalLeadReceive;?></strong></td>
                <td><strong><table border="0" cellspacing="0" width="100%">
                        <tr>
                            <td><strong><?php echo $totalCallingDone;?></strong></td>
                           </tr>
                           <tr>
                            <td><strong><?php echo round($totalpercentageCallingDone/$recordcount,2);?>%</strong></td>
                           </tr>
                        
                    </table></strong></td>
                <td><table border="0" cellspacing="0" width="100%">
                        <tr>
                            <td><strong><?php echo $totalNoFeedback;?></strong></td>
                           </tr>
                           <tr>
                            <td><strong><?php echo round($totalpercentageNoFeedback/$recordcount,2);?>%</strong></td>
                           </tr>
                        
                    </table></td>
               
                <td><table border="0" cellspacing="0" width="100%">
                        <tr>
                            <td><strong><?php echo $totalRinging;?></strong></td>
                           </tr>
                           <tr>
                            <td><strong><?php echo round($totalpercentageRinging/$recordcount,2);?>%</strong></td>
                           </tr>
                        
                    </table></td>
                
                <td><table border="0" cellspacing="0" width="100%">
                        <tr>
                            <td><strong><?php echo $totalNotConnect;?></strong></td>
                           </tr>
                           <tr>
                            <td><strong><?php echo round($totalpercentageNotContact/$recordcount,2);?>%</strong></td>
                           </tr>
                        
                    </table></td>
                <td><table border="0" cellspacing="0" width="100%">
                        <tr>
                            <td><strong><?php echo $totalConverted;?></strong></td>
                           </tr>
                           <tr>
                            <td><strong><?php echo round($totalConvertedPercent/$recordcount,2);?>%</strong></td>
                           </tr>
                        
                    </table></td>
               
                <td><table border="0" cellspacing="0" width="100%">
                        <tr>
                            <td><strong><?php echo $totalFollowUp;?></strong></td>
                           </tr>
                           <tr>
                            <td><strong><?php echo round($totalpercentageFollowUp/$recordcount,2);?>%</strong></td>
                           </tr>
                        
                    </table></td>
                    
                <?php if($Campaign=='CallerAccountIIFL' || $Campaign=='CallerAccountCFL')
                {?>
                <td><table border="0" cellspacing="0" width="100%">
                        <tr>
                            <td><strong><?php echo $totalNotEligible;?></strong></td>
                           </tr>
                           <tr>
                            <td><strong><?php echo round($totalpercentageNotEligible/$recordcount,2);?>%</strong></td>
                           </tr>
                        
                    </table></td>
                    <td><table border="0" cellspacing="0" width="100%">
                        <tr>
                            <td><strong><?php echo $totalNotInterested;?></strong></td>
                           </tr>
                           <tr>
                            <td><strong><?php echo round($totalpercentageNotInterested/$recordcount,2);?>%</strong></td>
                           </tr>
                        
                    </table></td>
                    <td><table border="0" cellspacing="0" width="100%">
                        <tr>
                            <td><strong><?php echo $totalCallbackLater;?></strong></td>
                           </tr>
                           <tr>
                            <td><strong><?php echo round($totalpercentageCallbackLater/$recordcount,2);?>%</strong></td>
                           </tr>
                        
                    </table></td>
                    <td><table border="0" cellspacing="0" width="100%">
                        <tr>
                            <td><strong><?php echo $totalWrongNumber;?></strong></td>
                           </tr>
                           <tr>
                            <td><strong><?php echo round($totalpercentageWrongNumber/$recordcount,2);?>%</strong></td>
                           </tr>
                        
                    </table></td>
                    <td><table border="0" cellspacing="0" width="100%">
                        <tr>
                            <td><strong><?php echo $totalProcess;?></strong></td>
                           </tr>
                           <tr>
                            <td><strong><?php echo round($totalpercentageProcess/$recordcount,2);?>%</strong></td>
                           </tr>
                        
                    </table></td>
                    <td><table border="0" cellspacing="0" width="100%">
                        <tr>
                            <td><strong><?php echo $totalClosed;?></strong></td>
                           </tr>
                           <tr>
                            <td><strong><?php echo round($totalpercentageClosed/$recordcount,2);?>%</strong></td>
                           </tr>
                        
                    </table></td>
                    <td><table border="0" cellspacing="0" width="100%">
                        <tr>
                            <td><strong><?php echo $totalNotAvailable;?></strong></td>
                           </tr>
                           <tr>
                            <td><strong><?php echo round($totalpercentageNotAvailable/$recordcount,2);?>%</strong></td>
                           </tr>
                        
                    </table></td>
                    <td><table border="0" cellspacing="0" width="100%">
                        <tr>
                            <td><strong><?php echo $totalDocumentPick;?></strong></td>
                           </tr>
                           <tr>
                            <td><strong><?php echo round($totalpercentageDocumentPick/$recordcount,2);?>%</strong></td>
                           </tr>
                        
                    </table></td>
                    <td><table border="0" cellspacing="0" width="100%">
                        <tr>
                            <td><strong><?php echo $totalLoanRejected;?></strong></td>
                           </tr>
                           <tr>
                            <td><strong><?php echo round($totalpercentageLoanRejected/$recordcount,2);?>%</strong></td>
                           </tr>
                        
                    </table></td>
                <? }else{?>
                    
               
                <td><table border="0" cellspacing="0" width="100%">
                        <tr>
                            <td><strong><?php echo $totalNotEligibleFoir;?></strong></td>
                           </tr>
                           <tr>
                            <td><strong><?php echo round($totalpercentageNotEligibleFoir/$recordcount,2);?>%</strong></td>
                           </tr>
                        
                    </table></td>
               
                <td><table border="0" cellspacing="0" width="100%">
                        <tr>
                            <td><strong><?php echo $totalNotEligibleSalary;?></strong></td>
                           </tr>
                           <tr>
                            <td><strong><?php echo round($totalpercentageNotEligibleSalary/$recordcount,2);?>%</strong></td>
                           </tr>
                        
                    </table></td>
               
                <td><table border="0" cellspacing="0" width="100%">
                        <tr>
                            <td><strong><?php echo $totalNotEligibleOthers;?></strong></td>
                           </tr>
                           <tr>
                            <td><strong><?php echo round($totalpercentageNotEligibleOthers/$recordcount,2);?>%</strong></td>
                           </tr>
                        
                    </table></td>
               
                <td><table border="0" cellspacing="0" width="100%">
                        <tr>
                            <td><strong><?php echo $totalNotIntDirect;?></strong></td>
                           </tr>
                           <tr>
                            <td><strong><?php echo round($totalpercentageNotIntDirect/$recordcount,2);?>%</strong></td>
                           </tr>
                        
                    </table></td>
                
                 <td><table border="0" cellspacing="0" width="100%">
                        <tr>
                            <td><strong><?php echo $totalNotIntOffer;?></strong></td>
                           </tr>
                           <tr>
                            <td><strong><?php echo round($totalpercentageNotIntOffer/$recordcount,2);?>%</strong></td>
                           </tr>
                        
                    </table></td>
                
                 <td><table border="0" cellspacing="0" width="100%">
                        <tr>
                            <td><strong><?php echo $totalNotIntLoanAmount;?></strong></td>
                           </tr>
                           <tr>
                            <td><strong><?php echo round($totalpercentageNotIntLoanAmount/$recordcount,2);?>%</strong></td>
                           </tr>
                        
                    </table></td>
                    <?php 
                //Tata Capital
                if($Campaign=='CallerAccountBTata' || $Campaign=='CallerAccountMTata')
                {?>
                 <td><table border="0" cellspacing="0" width="100%">
                        <tr>
                            <td><strong><?php echo $totalCIBILokFollowUp;?></strong></td>
                           </tr>
                           <tr>
                            <td><strong><?php echo round($totalpercentageCIBILokFollowUp/$recordcount,2);?>%</strong></td>
                           </tr>
                        
                    </table></td>
                    <td><table border="0" cellspacing="0" width="100%">
                        <tr>
                            <td><strong><?php echo $totalCibiOkNI;?></strong></td>
                           </tr>
                           <tr>
                            <td><strong><?php echo round($totalpercentageCibiOkNI/$recordcount,2);?>%</strong></td>
                           </tr>
                        
                    </table></td>
                    <td><table border="0" cellspacing="0" width="100%">
                        <tr>
                            <td><strong><?php echo $totalNECibil;?></strong></td>
                           </tr>
                           <tr>
                            <td><strong><?php echo round($totalpercentageNECibil/$recordcount,2);?>%</strong></td>
                           </tr>
                        
                    </table></td>
                    <td><table border="0" cellspacing="0" width="100%">
                        <tr>
                            <td><strong><?php echo $totalNEOther;?></strong></td>
                           </tr>
                           <tr>
                            <td><strong><?php echo round($totalpercentageNEOther/$recordcount,2);?>%</strong></td>
                           </tr>
                        
                    </table></td>
                    <td><table border="0" cellspacing="0" width="100%">
                        <tr>
                            <td><strong><?php echo $totalCibRefFollowup;?></strong></td>
                           </tr>
                           <tr>
                            <td><strong><?php echo round($totalpercentageCibRefFollowup/$recordcount,2);?>%</strong></td>
                           </tr>
                        
                    </table></td>
                    <td><table border="0" cellspacing="0" width="100%">
                        <tr>
                            <td><strong><?php echo $totalCibilRefNI;?></strong></td>
                           </tr>
                           <tr>
                            <td><strong><?php echo round($totalpercentageCibilRefNI/$recordcount,2);?>%</strong></td>
                           </tr>
                        
                    </table></td>
                <?php
                }
                ?>
                    
                    
                    <?php 
                //RBL Bank
                if($Campaign=='CallerAccountRBLBHC' || $Campaign=='CallerAccountRBLDH' || $Campaign=='CallerAccountRBLDMP')
                {?>
                 <td><table border="0" cellspacing="0" width="100%">
                        <tr>
                            <td><strong><?php echo $totalTUApproved;?></strong></td>
                           </tr>
                           <tr>
                            <td><strong><?php echo round($totalpercentageTUApproved/$recordcount,2);?>%</strong></td>
                           </tr>
                        
                </table></td> 
                <td><table border="0" cellspacing="0" width="100%">
                        <tr>
                            <td><strong><?php echo $totalTUReferred;?></strong></td>
                           </tr>
                           <tr>
                            <td><strong><?php echo round($totalpercentageTUReferred/$recordcount,2);?>%</strong></td>
                           </tr>
                        
                </table></td>
                <td><table border="0" cellspacing="0" width="100%">
                        <tr>
                            <td><strong><?php echo $totalTUDeclined;?></strong></td>
                           </tr>
                           <tr>
                            <td><strong><?php echo round($totalpercentageTUDeclined/$recordcount,2);?>%</strong></td>
                           </tr>
                        
                </table></td>
                <?php 
                //RBL END
                }?>
                 
                    <?php if($Campaign=='CallerAccountOICICI' || $Campaign=='CallerAccountICICI' || $Campaign=='CallerAccountMICICI' || $Campaign=='CallerAccountOICICI' || $Campaign=='CallerAccountCICICI')
                {?>
                     <td><table border="0" cellspacing="0" width="100%">
                        <tr>
                            <td><strong><?php echo $totalTUApproved;?></strong></td>
                           </tr>
                           <tr>
                            <td><strong><?php echo round($totalpercentageTUApproved/$recordcount,2);?>%</strong></td>
                           </tr>
                        
                </table></td>
                <td><table border="0" cellspacing="0" width="100%">
                        <tr>
                            <td><strong><?php echo $totalTUApprovedFollowup;?></strong></td>
                           </tr>
                           <tr>
                            <td><strong><?php echo round($totalpercentageTUApprovedFollowup/$recordcount,2);?>%</strong></td>
                           </tr>
                        
                </table></td>
                <td><table border="0" cellspacing="0" width="100%">
                        <tr>
                            <td><strong><?php echo $totalTUApprovedNotInterested;?></strong></td>
                           </tr>
                           <tr>
                            <td><strong><?php echo round($totalpercentageTUApprovedNotInterested/$recordcount,2);?>%</strong></td>
                           </tr>
                        
                </table></td>
                <td><table border="0" cellspacing="0" width="100%">
                        <tr>
                            <td><strong><?php echo $totalTUReferred;?></strong></td>
                           </tr>
                           <tr>
                            <td><strong><?php echo round($totalpercentageTUReferred/$recordcount,2);?>%</strong></td>
                           </tr>
                        
                </table></td>
                <td><table border="0" cellspacing="0" width="100%">
                        <tr>
                            <td><strong><?php echo $totalTUReferredFollowup;?></strong></td>
                           </tr>
                           <tr>
                            <td><strong><?php echo round($totalpercentageTUReferredFollowup/$recordcount,2);?>%</strong></td>
                           </tr>
                        
                </table></td>
                <td><table border="0" cellspacing="0" width="100%">
                        <tr>
                            <td><strong><?php echo $totalTUReferredNotInterested;?></strong></td>
                           </tr>
                           <tr>
                            <td><strong><?php echo round($totalpercentageTUReferredNotInterested/$recordcount,2);?>%</strong></td>
                           </tr>
                        
                </table></td>
                <td><table border="0" cellspacing="0" width="100%">
                        <tr>
                            <td><strong><?php echo $totalTUDeclined;?></strong></td>
                           </tr>
                           <tr>
                            <td><strong><?php echo round($totalpercentageTUDeclined/$recordcount,2);?>%</strong></td>
                           </tr>
                        
                </table></td>
                    
                    
                    
                <?php } }?>
                <td><table border="0" cellspacing="0" width="100%">
                        <tr>
                            <td><strong><?php echo $totalpercentageL2C;?>%</strong></td>
                           </tr>
                          
                           </tr>
                        
                </table></td>
                
            </tr>

            
    </table>
                        <?php } ?>
              </td>
            </tr>

        </table>
    </div>
   </body>
</html>
