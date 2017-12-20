<?php
require_once("includes/application-top-inner.php");
define("ADMIN_TITLE", "Personal Loan MIS Report - SPOC");
define("FDBCKPRELOGINREJECT", 'Pre-login Reject');//Pre-login Reject
define("FDBCKAPPRESCH", 'Appointment - Rescheduled'); //Appointment - Rescheduled
define("FDBCKAPPCANC", 'Appointment - Cancelled'); //Appointment - Cancelled
define("FDBCKASSPICKUP", 'Assigned For Pick-up'); //Assigned For Pick-up
define("FDBCKRINGING", 'Ringing');// For Ringing
define("FDBCKFOLLOWUP", 'Followup'); //Followup
define("FDBCKCOMPPICKUP", 'Complete Pick-up');// Complete Pick-up
define("FDBCKINCOMPPICKUP", 'Incomplete Pick-up'); //Incomplete Pick-up
define("FDBCKSENTLOGIN", 'Sent For Login'); //Sent For Login
define("FDBCKNOFEEDBACK", '');// NO Feedback


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
$BankName = '';	
if(isset($_REQUEST['BankName']))
    {
        $BankName = $_REQUEST['BankName'];
    }
 $City = $_REQUEST['city'];
 if(isset($City))
    {
       if($City=='Delhi')
       {
     $CityVal = "'Delhi','Gaziabad','Noida','Faridabad','Greater Noida'";
     
       }else if($City=='Mumbai'){
           $CityVal = "'Mumbai','Thane','Navi mumbai'";
       }else{
         $CityVal=$City;  
       }
    }
    
    
$varCmbFeedback = "";
if (isset($_REQUEST['cmbfeedback'])) {
    $varCmbFeedback = $_REQUEST['cmbfeedback'];
}
$min_date = $min_date . " 00:00:00";
$max_date = $max_date . " 23:59:59";

function getReqValue1($pKey){
	$titles = array(
        '1' => 'zexternal_appointment_docs'
            );
	foreach ($titles as $key=>$value)
	    if($pKey==$key)
		return $value;
	return "";
  }
  
// Get Lead Recieve
function LeadReceivedCount($BidId, $min_date, $max_date,$City) {
    if(strlen($City)>0)
    { 
      $qry = "SELECT zexternal_appointment_docs.RequestID,zexternal_appointment_docs.dated,zexternal_appointment_docs.spoc_status, Req_Loan_Personal.City FROM zexternal_appointment_docs LEFT JOIN Req_Loan_Personal ON zexternal_appointment_docs.RequestID = Req_Loan_Personal.RequestID WHERE Req_Loan_Personal.City in ('".$City."') and zexternal_appointment_docs.caller_id in(".$BidId.") and (zexternal_appointment_docs.dated Between '".($min_date)."' and '".($max_date)."')";   
    }else{
    $qry="SELECT zexternal_appointment_docs.RequestID,zexternal_appointment_docs.dated,zexternal_appointment_docs.spoc_status,Req_Loan_Personal.City FROM zexternal_appointment_docs LEFT JOIN Req_Loan_Personal ON zexternal_appointment_docs.RequestID = Req_Loan_Personal.RequestID WHERE (caller_id in(".$BidId.") and (zexternal_appointment_docs.dated Between '".($min_date)."' and '".($max_date)."'))";
    }
    return $qry;
}

function GetFeedbackCnt($BidId, $min_date, $max_date, $FeedbackVal,$City) {
    
    if(strlen($City)>0)
    { 
    $qry = "SELECT zexternal_appointment_docs.RequestID,zexternal_appointment_docs.dated,zexternal_appointment_docs.spoc_status, Req_Loan_Personal.City,Req_Loan_Personal.City FROM zexternal_appointment_docs LEFT JOIN Req_Loan_Personal ON zexternal_appointment_docs.RequestID = Req_Loan_Personal.RequestID WHERE Req_Loan_Personal.City in ('".$City."') and zexternal_appointment_docs.caller_id in(".$BidId.") and (zexternal_appointment_docs.dated Between '".($min_date)."' and '".($max_date)."') and spoc_status='".$FeedbackVal."'";
       
    }
    else{
     $qry="SELECT zexternal_appointment_docs.RequestID,zexternal_appointment_docs.dated,zexternal_appointment_docs.spoc_status,Req_Loan_Personal.City FROM zexternal_appointment_docs LEFT JOIN Req_Loan_Personal ON zexternal_appointment_docs.RequestID = Req_Loan_Personal.RequestID WHERE (caller_id in(".$BidId.") and (zexternal_appointment_docs.dated Between '".($min_date)."' and '".($max_date)."') and spoc_status='".$FeedbackVal."') ";
    
    }
    //echo "<br>Qry - ".$qry."<br>";
    return $qry;
}

// Added Send to login
function GetDocStatus($BidId, $min_date, $max_date, $DocStatus,$City){
   
    if(strlen($City)>0)
    { 
    $qry = "SELECT zexternal_appointment_docs.RequestID,zexternal_appointment_docs.dated,zexternal_appointment_docs.spoc_status, Req_Loan_Personal.City,Req_Loan_Personal.City FROM zexternal_appointment_docs LEFT JOIN Req_Loan_Personal ON zexternal_appointment_docs.RequestID = Req_Loan_Personal.RequestID WHERE Req_Loan_Personal.City in ('".$City."') and zexternal_appointment_docs.caller_id in(".$BidId.") and (zexternal_appointment_docs.dated Between '".($min_date)."' and '".($max_date)."') and DocStatus='".$DocStatus."'";
       
    }
    else{
     $qry="SELECT zexternal_appointment_docs.RequestID,zexternal_appointment_docs.dated,zexternal_appointment_docs.spoc_status,zexternal_appointment_docs.docStatus,Req_Loan_Personal.City FROM zexternal_appointment_docs LEFT JOIN Req_Loan_Personal ON zexternal_appointment_docs.RequestID = Req_Loan_Personal.RequestID WHERE (caller_id in(".$BidId.") and (zexternal_appointment_docs.dated Between '".($min_date)."' and '".($max_date)."') and DocStatus='".$DocStatus."') ";
    
    }
    //echo "<br>Qry - ".$qry."<br>";
    return $qry;
    
}


//Spoc
$qry = "SELECT caller_id,RequestID,BidderID AS BdID, BankID,CityName,Reply_Type,dated FROM zexternal_appointment_docs WHERE caller_id!='' AND dated Between '".($min_date)."' and '".($max_date)."' GROUP BY caller_id";
$resCount = $objAdmin->fun_get_num_rows($qry);
$qryResult = $obj->fun_db_query($qry);
$arrVal="";
$ReqIdVal="";
$BdIDVal ="";
$BankIDVal="";
while($rowRes = $obj->fun_db_fetch_rs_object($qryResult))
    {
        $arrVal[]=$rowRes->caller_id;
        $ReqIdVal[]=$rowRes->RequestID;
        $BdIDVal []= $rowRes->BdID;
        $BankIDVal[]=$rowRes->BankID;
        //$CityNameVal[]=$rowRes->CityName;
    }
        $AgentId = implode(',',$arrVal);
        $ReqId = implode(',',$ReqIdVal);
        $BdID = implode(',',$BdIDVal);
        $BankID = implode(',',$BankIDVal);


$QuryCity = "SELECT caller_id,RequestID,BidderID AS BdID, BankID,CityName FROM zexternal_appointment_docs WHERE caller_id!='' and Reply_Type=1 and CityName!='' GROUP BY CityName";
$resCountCity = $objAdmin->fun_get_num_rows($QuryCity);
$qryResultCity = $obj->fun_db_query($QuryCity);
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
                        <form name="frmsearch" action="pl_mis_pamac.php" method="get" onSubmit="return chkform();">
                            <table width="600" border="0" cellpadding="4" cellspacing="1" class="blueborder" bgcolor="#FFFFFF">

                                <input type="hidden" name="BidderIDstatic" id="BidderIDstatic" value="<? echo $_SESSION["BidderID"]; ?>">
                                <input type="hidden" name="search" id="search" value="y">
                                <tr>
                                    <td colspan="4" class="head1">Search (Pamac Dashboard )</td>
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
                            <td><strong>City</strong></td>
                            <td><select name="city">
                              <option value="">Select City</option>
                              <option value="Delhi" <?php if($City=='Delhi') { echo "Selected";}?>>Delhi NCR</option>
                              <option value="Mumbai"<?php if($City=='Mumbai') { echo "Selected";}?>>Mumbai</option>
                              <option value="Pune"<?php if($City=='Pune') { echo "Selected";}?>>Pune</option>
                              <option value="Hyderabad"<?php if($City=='Hyderabad') { echo "Selected";}?>>Hyderabad</option>
                              <option value="Chennai"<?php if($City=='Chennai') { echo "Selected";}?>>Chennai</option>
                              <option value="Bangalore"<?php if($City=='Bangalore') { echo "Selected";}?>>Bangalore</option>
                                </select>
                            </td>	            
<td width="25%" style="text-align: right;"><strong>Bank Name</strong></td>
				  <td width="25%">
				  <span id="cccname_agents">
    <select name="BankName" id="BankName" >
        <option value="All">All</option>
        <option value="27" <?php if($BankName=='27') { echo "Selected";}?>>ICICI</option>
        <option value="39"<?php if($BankName=='39') { echo "Selected";}?>>TATA Capital</option>
        <option value="84"<?php if($BankName=='84') { echo "Selected";}?>>IIFL</option>
        <option value="51"<?php if($BankName=='51') { echo "Selected";}?>>IndusInd</option>
        <option value="68"<?php if($BankName=='68') { echo "Selected";}?>>RBL</option>
        <option value="71"<?php if($BankName=='71') { echo "Selected";}?>>CFL</option>
       
        
    </select>
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
                           
$qryGetAgent = "SELECT caller_id, CityName,RequestID, docStatus FROM zexternal_appointment_docs where  caller_id in ($AgentId)";
if($BankName!='All')
    {
        $qryGetAgent .= " AND BankID='".$BankName."'";
    }
if($City!="" )
    {
      
    $qryGetAgent .= " AND CityName in ($CityVal)";
    }
$qryGetAgent .= " and Dated between '".($min_date)."' and '".($max_date)."'  group by caller_id";
//echo $qryGetAgent;
$recordcnt = $objAdmin->fun_get_num_rows($qryGetAgent);
$qryCheckResultAgent = $obj->fun_db_query($qryGetAgent);
if($_REQUEST['search']=='y'){
                            ?>
                        <table width="97%" border="0" cellpadding="4" cellspacing="1" class="blueborder" bgcolor="#FFFFFF">
<tr>
                                <td class="head1" colspan="34">Personal Loan - Lead Assessment - Date range (<?php echo $min_date?> to <?php echo $max_date?>)</td>
                            </tr>
                            <tr>
                <td class="head1">Agent</td>
                <td class="head1">Lead Received</td>
                <td class="head1">No Feedback</td>
                <td class="head1">Pre-login Reject</td>
                <td class="head1">Appointment - Rescheduled </td>
                <td class="head1">Ringing</td>
                <td class="head1">Appointment - Canceled</td>
                <td class="head1">Assigned For Pick-up</td>
                <td class="head1">Followup</td>
                <td class="head1">Complete Pick-up</td>
                <td class="head1">Incomplete Pick-up</td>
                <td class="head1">Sent For Login</td>
                <td class="head1">Un-picked % </td>
                <td class="head1">Appointment to login % </td>
                
            </tr>
           
<?
if ($recordcnt > 0) {
    $color = 1; 
    while ($rowAgent = $obj->fun_db_fetch_rs_object($qryCheckResultAgent)) {
        
        $QueryBid = "SELECT BidderID, Bidder_Name FROM Bidders WHERE BidderID='".$rowAgent->caller_id."'";
         $LeadQueryBid = $obj->fun_db_query($QueryBid);
         $rowLeadQueryBid = $obj->fun_db_fetch_rs_object($LeadQueryBid);
         
         
         
        $full_name = $rowLeadQueryBid->Bidder_Name;
        $BidderID = $rowLeadQueryBid->BidderID;
        $LeadCnt = LeadReceivedCount($BidderID, $min_date, $max_date,$City);
        $LeadRecCnt = $obj->fun_db_query($LeadCnt);
        $num_rows = $obj->fun_db_get_num_rows($LeadRecCnt);
       
       
        //No Feedback
        $NoFeedback1 = FDBCKNOFEEDBACK;
        $NoFeedbackVal1 = GetFeedbackCnt($BidderID, $min_date, $max_date, $NoFeedback1,$City);
       $LeadNoFeedbackCnt1 = $obj->fun_db_query($NoFeedbackVal1);
        $num_rowsNoFeedback1 = $obj->fun_db_get_num_rows($LeadNoFeedbackCnt1);
        $percentageNoFeedback1 = $num_rowsNoFeedback1 * 100 / $num_rows;
        ///

        //Pre-login Reject
        $PreLogRejfdbk = FDBCKPRELOGINREJECT;
        $PreLogRej = GetFeedbackCnt($BidderID, $min_date, $max_date, $PreLogRejfdbk,$City);
        $LeadPreLogRejCnt = $obj->fun_db_query($PreLogRej);
        $num_rowsPreLogRej = $obj->fun_db_get_num_rows($LeadPreLogRejCnt);
        
        $percentagePreLogRej = $num_rowsPreLogRej * 100 / $num_rows;

        // Appointment - Rescheduled
        $AppoResch = FDBCKAPPRESCH;
        $AppoReschVal = GetFeedbackCnt($BidderID, $min_date, $max_date, $AppoResch,$City);
        $LeadAppoReschCnt = $obj->fun_db_query($AppoReschVal);
        $num_rowsAppoResch = $obj->fun_db_get_num_rows($LeadAppoReschCnt);

        $percentageAppoResch = $num_rowsAppoResch * 100 / $num_rows;

        //Appointment - Cancelled
        $AppCancfdbk = FDBCKAPPCANC;
        $AppCancVal = GetFeedbackCnt($BidderID, $min_date, $max_date, $AppCancfdbk,$City);
        $LeadAppCancCnt = $obj->fun_db_query($AppCancVal);
        $num_rowsAppCanc = $obj->fun_db_get_num_rows($LeadAppCancCnt);
        
        $percentageAppCanc = $num_rowsAppCanc * 100 / $num_rows;
        

        //Assigned For Pick-up
        $AssPickupfdbk = FDBCKASSPICKUP;
        $AssPickupVal = GetFeedbackCnt($BidderID, $min_date, $max_date, $AssPickupfdbk,$City);
        $LeadAssPickupCnt = $obj->fun_db_query($AssPickupVal);
        $num_rowsAssPickup = $obj->fun_db_get_num_rows($LeadAssPickupCnt);
        
        $percentageAssPickup = $num_rowsAssPickup * 100 / $num_rows;

        //Ringing
        $Ringingfdbk = FDBCKRINGING;
        $RingingVal = GetFeedbackCnt($BidderID, $min_date, $max_date, $Ringingfdbk,$City);
        $LeadRingingCnt = $obj->fun_db_query($RingingVal);
        $num_rowsRinging = $obj->fun_db_get_num_rows($LeadRingingCnt);
        
        $percentageRinging = $num_rowsRinging * 100 / $num_rows;
        
        //Followup
        $FollowUpfdbk = FDBCKFOLLOWUP;
        $FollowUpVal = GetFeedbackCnt($BidderID, $min_date, $max_date, $FollowUpfdbk,$City);
        $LeadFollowUpCnt = $obj->fun_db_query($FollowUpVal);
        $num_rowsFollowUp = $obj->fun_db_get_num_rows($LeadFollowUpCnt);

        //Percentage FollowUp
        $percentageFollowUp = $num_rowsFollowUp * 100 / $num_rows;

        
        //Complete Pick-up
        $CompPickupfdbk = FDBCKCOMPPICKUP;
        $CompPickupVal = GetFeedbackCnt($BidderID, $min_date, $max_date, $CompPickupfdbk,$City);
        $LeadCompPickupCnt = $obj->fun_db_query($CompPickupVal);
        $num_rowsCompPickup = $obj->fun_db_get_num_rows($LeadCompPickupCnt);
        $percentageCompPickup = $num_rowsCompPickup * 100 / $num_rows;

        
        //Incomplete Pick-up
        $InCompPickupfdbk = FDBCKINCOMPPICKUP;
        $InCompPickupVal = GetFeedbackCnt($BidderID, $min_date, $max_date, $InCompPickupfdbk,$City);
        $LeadInCompPickupCnt = $obj->fun_db_query($InCompPickupVal);
        $num_rowsInCompPickup = $obj->fun_db_get_num_rows($LeadInCompPickupCnt);
        $percentageInCompPickup = $num_rowsInCompPickup * 100 / $num_rows;

        //Sent Login
        $SentLoginfdbk = FDBCKSENTLOGIN;
        $SentLoginVal = GetFeedbackCnt($BidderID, $min_date, $max_date, $SentLoginfdbk,$City);
        $LeadSentLoginCnt = $obj->fun_db_query($SentLoginVal);
        $num_rowsSentLogin = $obj->fun_db_get_num_rows($LeadSentLoginCnt);
        $percentageSentLogin = $num_rowsSentLogin * 100 / $num_rows;
       
        $UnPickedPercent = ($num_rowsNoFeedback1+$num_rowsPreLogRej+$num_rowsAppoResch+$num_rowsAppoResch+$num_rowsRinging)/$num_rows;
        
        $ApntmentLoginPercent =  $num_rowsSentLogin*100/$num_rows;
        
        
        

//prin_r($LeadCnt);
//Get Comment (Response) 
        if ($color % 2 != 0) {
            $colorvar = "#FFF";
        } else {
            $colorvar = "#EEE";
        }
        ?>
                                    <!--///////////////////////-->
            <tr  bgcolor="<?php echo $colorvar; ?>">                                        
                <td class="bodyarial11"><? echo $full_name." [".$BidderID."]"; ?></td>
                <td class="bodyarial11"><?php echo $num_rows; ?></td>
                
                <td class="bodyarial11"><table border="0" cellspacing="0" width="100%">
                        <tr>
                            <td><?php echo $num_rowsNoFeedback1; ?></td>
                           </tr>
                           <tr>
                            <td><? echo round($percentageNoFeedback1,2); ?>%</td>
                           </tr>
                        
                    </table></td>
                
                
                
                
                <td class="bodyarial11"><table border="0" cellspacing="0" width="100%">
                        <tr>
                            <td><?php echo $num_rowsPreLogRej; ?></td>
                           </tr>
                           <tr>
                            <td><? echo round($percentagePreLogRej,2); ?>%</td>
                           </tr>
                        
                    </table></td>
                
                
                <td class="bodyarial11"><table border="0" cellspacing="0" width="100%">
                        <tr>
                            <td><? echo $num_rowsAppoResch; ?></td>
                           </tr>
                           <tr>
                            <td><? echo round($percentageAppoResch,2); ?>%</td>
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
                
                <td class="bodyarial11"><table border="0" cellspacing="0" width="100%">
                        <tr>
                            <td><?php echo $num_rowsAppCanc; ?></td>
                           </tr>
                           <tr>
                            <td><? echo round($percentageAppCanc,2); ?>%</td>
                           </tr>
                        
                    </table></td>
                
                <td class="bodyarial11"><table border="0" cellspacing="0" width="100%">
                        <tr>
                            <td><?php echo $num_rowsAssPickup; ?></td>
                           </tr>
                           <tr>
                            <td><? echo round($percentageAssPickup,2); ?>%</td>
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
                
                <td class="bodyarial11"><table border="0" cellspacing="0" width="100%">
                        <tr>
                            <td><? echo $num_rowsCompPickup; ?></td>
                           </tr>
                           <tr>
                            <td><? echo round($percentageCompPickup,2); ?>%</td>
                           </tr>
                        
                    </table></td>
                
                <td class="bodyarial11"><table border="0" cellspacing="0" width="100%">
                        <tr>
                            <td><? echo $num_rowsInCompPickup; ?></td>
                           </tr>
                           <tr>
                            <td><? echo round($percentageInCompPickup,2); ?>%</td>
                           </tr>
                        
                    </table></td>
                
                <td class="bodyarial11"><table border="0" cellspacing="0" width="100%">
                        <tr>
                            <td><? echo $num_rowsSentLogin; ?></td>
                           </tr>
                           <tr>
                            <td><? echo round($percentageSentLogin,2); ?>%</td>
                           </tr>
                        
                    </table></td>
                <td class="bodyarial11"><? echo round($UnPickedPercent,2); ?>%</td>
                <td class="bodyarial11"><? echo round($ApntmentLoginPercent,2); ?>%</td>
             
               
                
            </tr>
                <?
                $color++;
                $totalLeadReceive += $num_rows;
                $totalNoFeedback1 += $num_rowsNoFeedback1;
                $totalpercentageNoFeedback1 +=$percentageNoFeedback1;
                $totalPreLogRej += $num_rowsPreLogRej;
                $totalpercentagePreLogRej +=$percentagePreLogRej;
                $totalAppoResch +=$num_rowsAppoResch;
                $totalpercentageAppoResch += $percentageAppoResch;
                $totalRinging += $num_rowsRinging;
                $totalpercentageRinging +=$percentageRinging;
                $totalAppCanc += $num_rowsAppCanc;
                $totalpercentageAppCanc +=$percentageAppCanc;
                $totalAssPickup += $num_rowsAssPickup;
                $totalpercentageAssPickup +=$percentageAssPickup;
                $totalFollowUp += $num_rowsFollowUp;
                $totalpercentageFollowUp += $percentageFollowUp;
                $totalCompPickup +=$num_rowsCompPickup;
                $totalpercentageCompPickup += $percentageCompPickup;
                $totalInCompPickup += $num_rowsInCompPickup;
                $totalpercentageInCompPickup += $percentageInCompPickup;
                $totalSentLogin += $num_rowsSentLogin;
                $totalpercentageSentLogin += $percentageSentLogin;
                $totalpercentageUnPicked += $UnPickedPercent;
                $totalpercentageApntmentLogin += $ApntmentLoginPercent;
                
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
                <td><table border="0" cellspacing="0" width="100%">
                        <tr>
                            <td><strong><?php echo $totalNoFeedback1;?></strong></td>
                           </tr>
                           <tr>
                            <td><strong><?php echo round($totalpercentageNoFeedback1/$recordcnt,2);?>%</strong></td>
                           </tr>
                        
                    </table></td>
                
                <td><table border="0" cellspacing="0" width="100%">
                        <tr>
                            <td><strong><?php echo $totalPreLogRej;?></strong></td>
                           </tr>
                           <tr>
                            <td><strong><?php echo round($totalpercentagePreLogRej/$recordcnt,2);?>%</strong></td>
                           </tr>
                        
                    </table></td>
                
                <td><table border="0" cellspacing="0" width="100%">
                        <tr>
                            <td><strong><?php echo $totalAppoResch;?></strong></td>
                           </tr>
                           <tr>
                            <td><strong><?php echo round($totalpercentageAppoResch/$recordcnt,2);?>%</strong></td>
                           </tr>
                        
                    </table></td>
                
                <td><table border="0" cellspacing="0" width="100%">
                        <tr>
                            <td><strong><?php echo $totalRinging;?></strong></td>
                           </tr>
                           <tr>
                            <td><strong><?php echo round($totalpercentageRinging/$recordcnt,2);?>%</strong></td>
                           </tr>
                        
                    </table></td>
                
                <td><table border="0" cellspacing="0" width="100%">
                        <tr>
                            <td><strong><?php echo $totalAppCanc;?></strong></td>
                           </tr>
                           <tr>
                            <td><strong><?php echo round($totalpercentageAppCanc/$recordcnt,2);?>%</strong></td>
                           </tr>
                        
                    </table></td>
                
                <td><table border="0" cellspacing="0" width="100%">
                        <tr>
                            <td><strong><?php echo $totalAssPickup;?></strong></td>
                           </tr>
                           <tr>
                            <td><strong><?php echo round($totalpercentageAssPickup/$recordcnt,2);?>%</strong></td>
                           </tr>
                        
                    </table></td>
                 
                <td><table border="0" cellspacing="0" width="100%">
                        <tr>
                            <td><strong><?php echo $totalFollowUp;?></strong></td>
                           </tr>
                           <tr>
                            <td><strong><?php echo round($totalpercentageFollowUp/$recordcnt,2);?>%</strong></td>
                           </tr>
                        
                    </table></td>
                
                <td><table border="0" cellspacing="0" width="100%">
                        <tr>
                            <td><strong><?php echo $totalCompPickup;?></strong></td>
                           </tr>
                           <tr>
                            <td><strong><?php echo round($totalpercentageCompPickup/$recordcnt,2);?>%</strong></td>
                           </tr>
                        
                    </table></td>
                
                <td><table border="0" cellspacing="0" width="100%">
                        <tr>
                            <td><strong><?php echo $totalInCompPickup;?></strong></td>
                           </tr>
                           <tr>
                            <td><strong><?php echo round($totalpercentageInCompPickup/$recordcnt,2);?>%</strong></td>
                           </tr>
                        
                    </table></td>
                
               <td><table border="0" cellspacing="0" width="100%">
                        <tr>
                            <td><strong><?php echo $totalSentLogin;?></strong></td>
                           </tr>
                           <tr>
                            <td><strong><?php echo round($totalpercentageSentLogin/$recordcnt,2);?>%</strong></td>
                           </tr>
                        
                    </table></td>
                
                <td><strong><?php echo round($totalpercentageUnPicked/$recordcnt,2);?>%</strong></td>
                 <td><strong><?php echo round($totalpercentageApntmentLogin/$recordcnt,2);?>%</strong></td>
            </tr>
    </table>
                        <?php } ?>
              </td>
            </tr>

        </table>
    </div>
   </body>
</html>
