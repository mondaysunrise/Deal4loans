<?php
require_once("includes/application-top-inner.php");
define("NoOFLMS", 2);
function ccMasking($number, $maskingCharacter = 'X') 
{
	return substr($number, 0, 2) . str_repeat($maskingCharacter, strlen($number) - 4) . substr($number, -2);
}
$feedback_tble="lead_allocate";
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


$inhouseCut_Call = '';
	$inhouseCut_Call = 1; // Displaying Numbers
	
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
		<script type="text/javascript">

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
        
        function ValProducts(valIdent)
        {
           $.ajax({ type: 'post',  url: '/callinglms/cclmsajax.php',  data: {  valIdent:valIdent, },
			   success: function (response) {
			   //alert(response);
			   $( '#ProAjax' ).html(response);
  		          if(response=="OK") { return true;	 } else { return false;	}
                }
		      });
           
        }
        
	</script>

		</head>
		<body style="margin:0px 0px 0px 0px; padding:0px 0px 0px 0px; background-color:#45B2D8;">

<?php include "header_cc_admin_lms.php"; ?>
          <div> 
    <table width="98%" border="0">
	  <!---<tr><td align="right"><a href="/commonlms_report.php?bidderid=<?php echo $_SESSION['BidderID'];?>&product=4" target="_blank">
		  today's Report</a></td></tr>-->
              <tr>
        <td align="right"></td>
      </tr>
              <tr>
        <td align="center" width="100%"><div align="center">
            <form name="frmsearch" action="cc_lms_pending_sendnow.php" method="get" onSubmit="return chkform();"><table width="600" border="0" cellpadding="4" cellspacing="1" class="blueborder" bgcolor="#FFFFFF">
                
                <input type="hidden" name="BidderIDstatic" id="BidderIDstatic" value="<? echo $_SESSION["BidderID"];?>">
                  <input type="hidden" name="cmbfeedback" id="cmbfeedback" value="Send Now">
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
                
                <tr><td width="12%"><strong>Products:</strong></td>
                  <td width="29%"><select name="products" id="products" onchange="ValProducts(this.value)">
                      <option value="" >Please Select Products</option>
                      <option value="1" <? if($_REQUEST['products'] == "1") { echo "selected"; } ?>>Two Wheeler </option>
                     <option value="2" <? if($_REQUEST['products'] == "2") { echo "selected"; } ?>>SMS</option>
                      <option value="3" <? if($_REQUEST['products'] == "3") { echo "selected"; } ?>>Direct</option>
                      
                    </select></td></tr>
                
                <tr> <td id="ProAjax" colspan="4">
                        <?php 
                        $ProVal = $_REQUEST['products'];
                        if($ProVal!="")
                        {
                        ?>
                        <table width="100%">
<tr id="capmaigndv">
                  <td>Campaigns</td>
                  <td>
                  <select name="Campaign" id="Campaign" onchange="getAgentsinCampaign(this.value)">
                      <option value="" <? if($Campaign == "") { echo "selected"; } ?>>Please Select</option>

                  <?php
                  
                  if($ProVal==1)
                  {
                    $qryCheck = "SELECT BidderID, leadidentifier FROM Bidders where leadidentifier in ('diallerleadcc1') group by leadidentifier";//'CallerAccountCity',  
                  }else if($ProVal==2)
                  {
                      $qryCheck = "SELECT BidderID, leadidentifier FROM Bidders where leadidentifier in ('diallercallerccpredictive', 'diallerleadccsmsnew') group by leadidentifier";//'CallerAccountCity', 
                  }
                  elseif($ProVal==3)
                  {
	                $qryCheck = "SELECT BidderID, leadidentifier FROM Bidders where leadidentifier in ('diallerleadcc') group by leadidentifier";//'CallerAccountCity',
                  }
					$resCountCheck = $objAdmin->fun_get_num_rows($qryCheck);
					$qryCheckResult = $obj->fun_db_query($qryCheck);
					while($row = $obj->fun_db_fetch_rs_object($qryCheckResult))
					{
					?>
                    <option value="<?php echo $row->leadidentifier; ?>" <? if($Campaign == $row->leadidentifier) { echo "selected"; } ?>><?php echo $row->leadidentifier; ?></option>
					<?php								
					}
				  ?></select></td>
                  <td width="25%" style="text-align: right;">Agents</td>
				  <td width="25%">
				  <span id="name_agents">
				  <?php
                                  
				    $qryCheck1 = "SELECT BidderID, Bidder_Name, Status FROM Bidders where leadidentifier in ('".$Campaign."') and leadidentifier!=''";
					$recordcount = $objAdmin->fun_get_num_rows($qryCheck1);
					$qryCheckResult1 = $obj->fun_db_query($qryCheck1);
					$status_text = '';
					?>
					<select name="Agents" id="Agents" ><?php if($recordcount>0) { ?><option value="All" <? if($Agents == "All") { echo "selected"; } ?>>All</option><?php while($row1 = $obj->fun_db_fetch_rs_object($qryCheckResult1)) { $Status = $row1->Status; if($Status ==1) {$status_text = "Enabled"; } else { $status_text = "Disabled"; }  ?><option value="<?php echo $row1->BidderID; ?>" <? if($Agents == $row1->BidderID) { echo "selected"; } ?>><?php echo $row1->BidderID; ?> [<?php echo $row1->Bidder_Name; ?>] (<?php echo $status_text; ?>) </option><?php	 } } else { echo '<option value="">Please Select</option>'; } ?></select>
				  </span>
				  </td>
				  </tr>
                        </table><?php }?></td> </tr>
                
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td align="left"><input name="Submit" type="submit" class="bluebutton" value="Search" border="0"></td>
                </tr>
              
            </table></form>
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
		
		
		if($Agents=="All")
		{
			$qryAgentsID = "SELECT BidderID FROM Bidders where leadidentifier in ('".$Campaign."')";
			//echo $qryAgentsID."<br>";
			$resCountAgentsID = $objAdmin->fun_get_num_rows($qryAgentsID);
			$qryAgentsIDResult = $obj->fun_db_query($qryAgentsID);
			$BidderIDstaticArr = '';
			while($rowAgentsID = $obj->fun_db_fetch_rs_object($qryAgentsIDResult))
			{
				$BidderIDstaticArr[] =$rowAgentsID->BidderID;				
			}
			$BidderIDstatic = implode(',', $BidderIDstaticArr);
		}
		else
		{
			$BidderIDstatic = $Agents;
		}
	
		
	?>       <p class="bodyarial11">
              <?=$Msg?>
            </p>
             <p align="center"><span id="name_status" style="color:#F00; font-weight:bold;"></span> </p>
            <table width="958" border="0" cellpadding="4" cellspacing="1" class="blueborder" bgcolor="#FFFFFF">
              <? 
              if($_REQUEST['products']==3) {
                 if($Agents=="All")
		{
                  $qryAgentsID = "SELECT BidderID FROM Bidders where leadidentifier in ('diallerleadcc')";
			//echo $qryAgentsID."<br>";
			$resCountAgentsID = $objAdmin->fun_get_num_rows($qryAgentsID);
			$qryAgentsIDResult = $obj->fun_db_query($qryAgentsID);
			$BidderIDstaticArr = '';
			while($rowAgentsID = $obj->fun_db_fetch_rs_object($qryAgentsIDResult))
			{
				$BidderIDstaticArr[] =$rowAgentsID->BidderID;				
			}
			$BidderIDstatic = implode(',', $BidderIDstaticArr); 
                }
		else
		{
			$BidderIDstatic = $Agents;
		}  
              }
              
              $srh_qry=""; 
		if($mob_num>0)
		{
			$mob_num_clause = " AND ".TABLE_REQ_CREDIT_CARD.".Mobile_Number = '".$mob_num."' ";
		}
		if($_SESSION['BidderID']!="")
		{
		if($_REQUEST['products']==1)
                 {              
                    $qry = "SELECT * FROM sbi_ccoffers_directonsite LEFT JOIN Req_Loan_Bike ON sbi_ccoffers_directonsite.sbicc_requestid=Req_Loan_Bike.RequestID WHERE (( Req_Loan_Bike.Updated_Date Between '".($min_date)."' and '".($max_date)."'))";
                    
                           
                 }
                else if($_REQUEST['products']==2)
                 {
                  $qry = "SELECT * FROM Req_Credit_Card_Sms LEFT OUTER JOIN lead_allocate ON lead_allocate.AllRequestID=Req_Credit_Card_Sms.RequestID WHERE (( Req_Credit_Card_Sms.Updated_Date Between '".($min_date)."' and '".($max_date)."' or Req_Credit_Card_Sms.Followup_Date Between '".($min_date)."' and '".($max_date)."') and lead_allocate.BidderID  in (".$BidderIDstatic.") ) ";
                 }else if($_REQUEST['products']==3)
                 {               
                   $qry = "SELECT *, ".$feedback_tble.".BidderID as BidID  FROM ".$feedback_tble.",".TABLE_REQ_CREDIT_CARD." LEFT OUTER JOIN Req_Feedback_CC ON Req_Feedback_CC.AllRequestID=".TABLE_REQ_CREDIT_CARD.".RequestID AND Req_Feedback_CC.BidderID in (".$BidderIDstatic.") WHERE ".$feedback_tble.".AllRequestID=".TABLE_REQ_CREDIT_CARD.".RequestID and ".$feedback_tble.".BidderID in (".$BidderIDstatic.") and ".$feedback_tble.".Reply_Type=4 and ( ".$feedback_tble.".Allocation_Date Between '".($min_date)."' and '".($max_date)."' or Req_Feedback_CC.Followup_Date Between '".($min_date)."' and '".($max_date)."')";
                 }
                if($_REQUEST['products']==1)
                {
                    if($_REQUEST['cmbfeedback']!="All")
                    {
                     $qry .= "  AND sbi_ccoffers_directonsite.lms_feedback='".$_REQUEST['cmbfeedback']."'"; 
                    }
                }
                if($_REQUEST['products']==3)
                {
                    if($_REQUEST['cmbfeedback']!="All")
                    {
                     $qry .= "  AND Req_Feedback_CC.Feedback='".$_REQUEST['cmbfeedback']."'"; 
                    }
                }
                else{
                 
                 $qry=$qry.$FeedbackClause." ".$mob_num_clause;
                    }
                }		
$srh_qry = $qry;

//echo $srh_qry;
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
                <td class="head1">Agent ID</td>
                <td class="head1">Name</td>
                <td class="head1">Mobile</td>
                <td class="head1">Salary</td>
                <td class="head1">City</td>
                <td class="head1">Emp status</td>
                <td class="head1">Feedback</td>                
                <td class="head1">FollowUp date</td>               
                <td class="head1">Comments</td> 
                <td class="head1">DOE</td>  
                <td class="head1">Bank Name(ICICI)</td>                
                <td class="head1">Application ID</td>               
                <td class="head1">Decision Status</td> 
                 <td class="head1">Bank Name(RBL)</td>                
                <td class="head1">Application ID</td>               
                <td class="head1">Decision Status</td>
                
                <td class="head1">Bank Name(Standard)</td>                
                <td class="head1">Application ID</td>               
                <td class="head1">Decision Status</td>
                <td class="head1">Bank Name(Amex)</td>                
                <td class="head1">Approve</td>               
                <td class="head1">Decision Status</td>
                
              </tr>
              <?			
		if($resCount>0)
			{	
				$color = 1;		
		while($row = $obj->fun_db_fetch_rs_object($result))
		{
		   //echo "<pre>";
                   // print_r($row);
                    if($_REQUEST['products']==1)
                    { $feedbackVal = $row->lms_feedback;
                    $Followup_Date = $row->lms_feedback; 
                    $CommentVal = $row->lms_comment;
                    $BidderID = "5923";
                    }else{
                     $feedbackVal = $row->Feedback; 
                     $Followup_Date = $row->Followup_Date;
                     $CommentVal = $row->comment_section;
                     if($_REQUEST['products']==3)
                     {
                     $BidderID = $row->BidID;
                     }else{
                          $BidderID = $row->BidderID;
                     }
                     
                    }
                    
                    
                    				
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
                                        
                     $quryResData = "SELECT * FROM credit_card_banks_apply WHERE cc_requestid ='".$row->AllRequestID."' and cc_requestid>0 and applied_bankname='ICICI Bank' GROUP BY cc_requestid";
                     $resultResData = $obj->fun_db_query($quryResData);
                     $rowResData = $obj->fun_db_fetch_rs_object($resultResData);
                     $appliedBankname = $rowResData->applied_bankname;
                     //echo "<pre>";
                    //print_r($rowResData);
                     
                     //Json FOrmat
                     $ResponseData = $rowResData->response_data;
                     $JSonRes = json_decode($ResponseData);                                     //print_r($JSonRes);
                     
                     $RespData = $rowResData->response_data;
                     
                     
                    $JSonResSeprate = explode(",",$RespData);
                    //print_r($JSonResSeprate);
                    $ReFcodeArr = $JSonResSeprate[1];
                    $RefVal  = explode("-#",$ReFcodeArr);  
                    //print_r($ReFcodeArr);
                    $RefValPrint = $RefVal[1];
                    
                    //for Decision Status
                     $DeciArr = $JSonResSeprate[3];
                     $DeciVal = explode("-",$DeciArr); 
                     $DeciValPrint =  $DeciVal[1];
                     
           
                     
                      $RBLquryResData = "SELECT * FROM credit_card_banks_apply WHERE cc_requestid ='".$row->AllRequestID."' and cc_requestid>0 and applied_bankname='RBL Bank' GROUP BY cc_requestid";
                     $RBLresultResData = $obj->fun_db_query($RBLquryResData);
                     $RBLrowResData = $obj->fun_db_fetch_rs_object($RBLresultResData);
                     $RBLappliedBankname = $RBLrowResData->applied_bankname;
                     //echo "<pre>";
                    //print_r($rowResData);
                     
                     //Json FOrmat
                     $RBLResponseData = $RBLrowResData->response_data;
                     $RBLJSonRes = json_decode($RBLResponseData);                                     //print_r($JSonRes);
                     
                     $RBLRespData = $RBLrowResData->response_data;
                     
                     
                    $RBLJSonResSeprate = explode(",",$RBLRespData);
                    //print_r($JSonResSeprate);
                    $RBLReFcodeArr = $RBLJSonResSeprate[1];
                    $RBLRefVal  = explode("-#",$RBLReFcodeArr);  
                    //print_r($ReFcodeArr);
                    $RBLRefValPrint = $RBLRefVal[1];
                    
                    //for Decision Status
                     $RBLDeciArr = $RBLJSonResSeprate[3];
                     $RBLDeciVal = explode("-",$RBLDeciArr); 
                     $RBLDeciValPrint =  $RBLDeciVal[1];
                     
                     
                     //Standard Charted
                     $StancquryResData = "SELECT * FROM credit_card_banks_apply WHERE cc_requestid ='".$row->AllRequestID."' and cc_requestid>0 and applied_bankname='Standard Chartered' GROUP BY cc_requestid";
                     $StancresultResData = $obj->fun_db_query($StancquryResData);
                     $StancrowResData = $obj->fun_db_fetch_rs_object($StancresultResData);
                     $StancappliedBankname = $StancrowResData->applied_bankname;
                     //echo "<pre>";
                    //print_r($rowResData);
                     
                     //Json FOrmat
                     $StancResponseData = $StancrowResData->response_data;
                     $StancJSonRes = json_decode($StancResponseData);                                     //print_r($JSonRes);
                     
                     $StancRespData = $StancrowResData->response_data;
                     
                     
                    $StancJSonResSeprate = explode(",",$StancRespData);
                    //print_r($JSonResSeprate);
                    $StancReFcodeArr = $StancJSonResSeprate[1];
                    $StancRefVal  = explode("-#",$StancReFcodeArr);  
                    //print_r($ReFcodeArr);
                    $StancRefValPrint = $StancRefVal[1];
                    
                    //for Decision Status
                     $StancDeciArr = $StancJSonResSeprate[3];
                     $StancDeciVal = explode("-",$StancDeciArr); 
                     $StancDeciValPrint =  $StancDeciVal[1];
                     
               
                   // American Express 
                    $resCountAmex = "";
                    $AmexquryResData = "SELECT * FROM credit_card_banks_apply WHERE cc_requestid ='".$row->AllRequestID."' and cc_requestid>0 and applied_bankname='American Express' GROUP BY cc_requestid";
                    $AmexresultResData = $obj->fun_db_query($AmexquryResData);
                    $resCountAmex = $objAdmin->fun_get_num_rows($AmexquryResData);                   
                    if($resCountAmex>0)
                    {
                        $AmexrowResData = $obj->fun_db_fetch_rs_object($AmexresultResData);
                        
                        $AmexappliedBankname = $AmexrowResData->applied_bankname;
                        $outputAmex = $AmexrowResData->response_data;
                        $ArrxmlAmex= "";
                        $outputAmex= str_replace('<?xml version="1.0" encoding="utf-8"?><soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema"><soap:Body><submitApplicationResponse xmlns="http://tempuri.org/">','',$outputAmex);
                        $outputAmex= str_replace('</submitApplicationResponse></soap:Body></soap:Envelope>', '', $outputAmex);
                        $ArrxmlAmex = new SimpleXMLElement($outputAmex);
                    }  
                 
                     
	?>
              <!--///////////////////////-->
              <tr  bgcolor="<?php echo $colorvar;?>">			 
                <td class="bodyarial11"><? echo $BidderID;  ?></td>
                <td class="bodyarial11"><a href="cc_lead_details.php?postid=<?php echo $row->RequestID;?>&biddt=<?php echo $BidderID; ?>&products=<?php echo $_REQUEST['products'];?>" target="_blank"><? echo $row->Name; ?></a></td>        
                <td class="bodyarial11"><?php
                if($inhouseCut_Call==1) {
                ?><span id="clik4Num_<?php echo $color; ?>">XXXXXXXXXX</span>
<?php } else {  echo ccMasking($row->Mobile_Number); } ?></td>
                <td class="bodyarial11"> <?php 
                if($inhouseCut_Call==1) {
                ?>
<span id="clkNum<?php echo $color; ?>" onClick="getNumValue(<?php echo $color; ?>,<?php echo $row->RequestID; ?>,<?php echo $getParameterVal; ?>);" style="cursor:hand;"><? echo $row->Net_Salary; ?></span> <?php } else {  echo $row->Net_Salary; } ?>
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
                 echo $feedbackVal;
                 ?>
     </td>
         <td class="bodyarial11"><? echo $Followup_Date; ?></td>
         <td class="bodyarial11"><textarea rows="2" cols="10" readonly="readonly"><? echo $CommentVal; ?></textarea></td>
	 <td class="bodyarial11"><? echo $row->Updated_Date; ?></td> 
	 <td class="bodyarial11"><?php echo $appliedBankname;?></td> 
         <td class="bodyarial11"><?php echo $JSonRes->ApplicationId;  ?><?php echo $RefValPrint;  ?></td>
         <td class="bodyarial11"><?php echo $JSonRes->Decision ;?><?php echo $DeciValPrint ;?><?php //echo $SuccResVal;?></td> 
         
         
         <td class="bodyarial11"><?php echo $RBLappliedBankname;?></td> 
         <td class="bodyarial11"><?php echo $RBLJSonRes->ApplicationId;  ?><?php echo $RBLRefValPrint;  ?></td>
         <td class="bodyarial11"><?php echo $RBLJSonRes->Decision ;?><?php echo $RBLDeciValPrint ;?></td> 
         
         <td class="bodyarial11"><?php echo $StancappliedBankname;?></td> 
         <td class="bodyarial11"><?php echo $StancJSonRes->ApplicationId;  ?><?php echo $StancRefValPrint;  ?></td>
         <td class="bodyarial11"><?php echo $StancJSonRes->Decision ;?><?php echo $StancDeciValPrint ;?></td> 
	
         <td class="bodyarial11"><?php if($resCountAmex>0)
                                        { echo $AmexappliedBankname; } ?></td> 
         <td class="bodyarial11"><?php if($resCountAmex>0)
					{   
             //echo "<pre>";
             //print_r($ArrxmlAmex);
             
             echo $successRespons = $ArrxmlAmex->successResponse->approved; }  ?></td>
         <td class="bodyarial11"><?php if($resCountAmex>0)
         {
             echo $Status = $ArrxmlAmex->status->success; }  ?></td> 
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
<?	  if( $search=="y" && $_SESSION['BidderID'])
			{ ?>
	  <?php /*<tr><td colspan="2" align="center"><form name="frmdownload" action="mis_cc_download_240317yash.php" method="post"><table width="500" border="0" cellspacing="1" cellpadding="4">
			 
			   <tr>
				 <td align="center">
				 <input type="hidden" name="qry1" value="<? echo $srh_qry; ?>">
				 <input type="hidden" name="qry2" value="Req_Credit_Card">
				 <input type="hidden" name="min_date" value="<? echo $min_date; ?>">
				 <input type="hidden" name="max_date" value="<? echo $max_date; ?>">
				 <input name="Submit2" type="submit" class="bluebtn" value="Export List To Excel">
				 </td>
			   </tr>*/ ?>
			 
			 </table></form></td></tr>
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
		<option value="<? echo $strURL.'&Feedback='?>" <? if($varFeedback == "") { echo "selected"; } ?>>
		No Feedback</option>
		<option value="<? echo $strURL.'&Feedback=Other Product'?>" <? if($varFeedback == "Other Product") { echo "selected"; } ?>>
		Other Product</option>
		<option value="<? echo $strURL.'&Feedback=Not Interested'?>" <? if($varFeedback == "Not Interested") { echo "selected"; } ?>>
		Not Interested</option>
		<option value="<? echo $strURL.'&Feedback=Not Contactable'?>" <? if($varFeedback == "Not Contactable") { echo "selected"; } ?>>
		Not Contactable</option>
		<option value="<? echo $strURL.'&Feedback=Callback Later'?>" <? if($varFeedback == "Callback Later") { echo "selected"; } ?>>
		Callback Later</option>
		<option value="<? echo $strURL.'&Feedback=Wrong Number'?>" <? if($varFeedback == "Wrong Number") { echo "selected"; } ?>>
		Wrong Number</option>
		<option value="<? echo $strURL.'&Feedback=Send Now'?>" <? if($varFeedback == "Send Now") { echo "selected"; } ?> >
		Send Now</option>
		<option value="<? echo $strURL.'&Feedback=Not Eligible'?>" <? if($varFeedback == "Not Eligible") { echo "selected"; } ?> >
		Not Eligible</option>
		<option value="<? echo $strURL.'&Feedback=Ringing'?>" <? if($varFeedback == "Ringing") { echo "selected"; } ?> >
		Ringing</option>
		<option value="<? echo $strURL.'&Feedback=Duplicate'?>" <? if($varFeedback == "Duplicate") { echo "selected"; } ?> >
		Duplicate</option>
		<option value="<? echo $strURL.'&Feedback=Not Applied'?>" <? if($varFeedback == "Not Applied") { echo "selected"; } ?> >
		Not Applied</option>
		<option value="<? echo $strURL.'&Feedback=FollowUp'?>" <? if($varFeedback == "FollowUp") { echo "selected"; } ?>>
		FollowUp</option>	
		 <option value="<? echo $strURL.'&Feedback=Process'?>" <? if($varFeedback == "Process") { echo "selected"; } ?>>
		 Cibil ok </option>
		<option value="<? echo $strURL.'&Feedback=Closed'?>" <? if($varFeedback == "Closed") { echo "selected"; } ?>>
		Cibil Reject</option>
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
