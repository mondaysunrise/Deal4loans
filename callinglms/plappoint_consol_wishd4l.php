<?php
require_once("includes/application-top-inner-plcalling.php");
//require_once("includes/application-top-inner.php");
//require '../eligiblebidderfuncPL.php';
$qryCheck = "SELECT * FROM Bidders where BidderID='".$_SESSION["BidderID"]."'";
$resCountCheck = $objAdmin->fun_get_num_rows($qryCheck);
$qryCheckResult = $obj->fun_db_query($qryCheck);
if($resCountCheck>0)
{
	$rowqryCheck = $obj->fun_db_fetch_rs_object($qryCheckResult);
 	$source = $rowqryCheck->source;
	//echo "<br>";
	$standard_fields = $rowqryCheck->standard_fields;
}
else {
		echo "Not a Valid User";
		echo '<meta http-equiv="refresh" content="5; URL=http://www.deal4loans.com/callinglms/pllmslogin.php">';
		die(); 
	 }
define("NoOFLMS", 2);
$time = date("G");
if(!empty($_GET['page'])){
$page = $_GET['page'];
}else{
$page = 1;
}
$limit = 25;
$start = ($page - 1) * $limit;

function cleanSpace($string) {
   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
   return preg_replace('/[^A-Za-z0-9\-]/', ' ', $string); // Removes special chars.
}

function ccMasking($number, $maskingCharacter = 'X') 
{
	return substr($number, 0, 2) . str_repeat($maskingCharacter, strlen($number) - 4) . substr($number, -2);
}
function GetBankIds($Bankname)
{
  return $quryBId = "SELECT BankID,Bank_Name FROM Bank_Master Where Bank_Name='".$Bankname."'"; 
 
}
$BidderIDstatic=$_SESSION["BidderID"];

$salaryclause="";
if(isset($_REQUEST['salaryrange']))
{
	$salaryclause=$_REQUEST['salaryrange'];
}
$empstatus="";   
if(isset($_REQUEST['empstatus']))
{
	$empstatus=$_REQUEST['empstatus'];
}

  $val = "Req_Loan_Personal";
  
	$FeedbackClause="";
	//$OrderBy=" order by Req_Loan_Personal.Dated desc";
	$mob_num="";
	if(isset($_REQUEST['mob_num']))
	{
		$mob_num = $_REQUEST['mob_num'];
	}
        $company_category="";
	if(isset($_REQUEST['company_category']))
	{
            $company_category = $_REQUEST['company_category'];
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
	$BiddIDs="";	
	if(isset($_REQUEST['BiddIDs']))
	{
		$BiddIDs=$_REQUEST['BiddIDs'];
	}
	
	$refernce_no="";
	if(isset($_REQUEST['refernce_no']))
	{
		$refernce_no = $_REQUEST['refernce_no'];
	}

$queryAgentPL = "SELECT BidderID FROM Bidders WHERE leadidentifier ='plalloclms'";
       $SqlAgentPL =  $obj->fun_db_query($queryAgentPL);
       $AgentIds = "";
       while($rowAgentPL = $obj->fun_db_fetch_rs_object($SqlAgentPL))
       {
       $AgentIds[]= $rowAgentPL->BidderID;
       }
       $AgentIds = implode("','",$AgentIds);
       
     $queryBidPL = "SELECT BidderID FROM Bidders WHERE Global_Access_ID LIKE '%7189%'";
       $SqlBidPL =  $obj->fun_db_query($queryBidPL);
       $BIdIds = "";
       while($rowBidPL = $obj->fun_db_fetch_rs_object($SqlBidPL))
       {
       $BIdIds[]= $rowBidPL->BidderID;
       }
       $BIdIds = implode("','",$BIdIds);
       
       $excludearrcallerqry=$obj->fun_db_query("Select BidderID from Bidders Where (leadidentifier LIKE  '%plmainlms%') order by BidderID ASC");
	$excludearrCallerrID = '';
	while($excluderowcal=$obj->fun_db_fetch_rs_object($excludearrcallerqry))
	{
		$excludearrCallerID[] = $excluderowcal->BidderID;
	}

	$excludearrCallerIDStr=implode("','",$excludearrCallerID);
       
       
?>
<html>
		<head>
     
  		<meta http-equiv="Content-Language" content="en-us">
		<meta http-equiv="Content-Type" content="text/html; charset=WINDOWS-1252">
		<title>Send Now</title>
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
        
       <!-- <script type="text/javascript" src="/js/jquery.js"></script>-->
<script type="text/javascript">

    function checkCall(RequestID,agent_user)
    {	
	   $.ajax({ type: 'post',  url: '/dialer_click2callplalloction.php',  data: {  RequestID:RequestID,agent_user:agent_user, },
			   success: function (response) {
			   //alert(response);
			   $( '#name_status' ).html(response);
  		          if(response=="OK") { return true;	 } else { return false;	}
                }
		      });
	  
	}
	
var ajaxRequest;  // The variable that makes Ajax possible!
		function ajaxFunction(){
			
			try{
				// Opera 8.0+, Firefox, Safari
				ajaxRequest = new XMLHttpRequest();
			} catch (e){
				// Internet Explorer Browsers
				try{
					ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
				} catch (e) {
					try{
						ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
					} catch (e){
						// Something went wrong
						alert("Your browser broke!");
						return false;
					}
				}
			}
		}
			
		function getNumValue(iLoc,id, parameterVal)
		{
			//alert(iLoc);
			var allLoc = [];
			if(parameterVal>0 )
			{
				for(var iTrav=1; iTrav <= parameterVal; iTrav++) { allLoc.push(iTrav); }
			}
			else
			{
				for(var iTrav=1; iTrav <= <?php echo $limit; ?>; iTrav++) { allLoc.push(iTrav); }
			}
			var iRemove = allLoc.indexOf(iLoc);
			if(iRemove != -1) { allLoc.splice(iRemove, 1); }
			
		//	alert(allLoc);
			
			var queryString = "?get_requestid=" + id;
			ajaxRequest.open("GET", "/getfullertonNum.php" + queryString, true);
			ajaxRequest.onreadystatechange = function(){
				if(ajaxRequest.readyState == 4)
				{
					document.getElementById('clik4Num_'+ iLoc).innerHTML = "<b style='font-size:12px;'>"+ajaxRequest.responseText+"</b>";
						for(var iTraverse = allLoc.length; iTraverse--;)
						{ document.getElementById('clik4Num_'+ allLoc[iTraverse]).innerHTML = 'XXXXXXXXXX';	}
				}
			}
				ajaxRequest.send(null); 
		}
		window.onload = ajaxFunction;

	
	</script>
		</head>
		<body style="margin:0px 0px 0px 0px; padding:0px 0px 0px 0px; background-color:#45B2D8;">
                    <!-- End Main Banner Menu Panel --><div style="width:100%; background: #CCC; padding:0px 0px 10px 0px;">
                        
                        <div style="background:#F00; width:40px; padding-left:7px; line-height:30px; height:30px; float:right; margin-right:50px; margin-top:7px; border-radius:20%;"> <a href="logout2.php" style="color:#FFF; text-align:center; text-decoration:none; font-size:12px;">Logout</a></div>
                        <!--<div style="background:#F00; width:150px; padding-left:7px; line-height:30px; height:30px; float:right; margin-right:50px; margin-top:7px; border-radius:20%;"><a href="pllms-change-password.php" style="color:#FFF; text-align:center; text-decoration:none; font-size:12px;">Change Agent Password</a></div>-->
<div style="clear:both;"></div>
</div>
<div style="clear:both; height:15px;"></div>
          <div> 
    <table width="98%" border="0">
    <tr><td align="right" style="font-size:10px; font-weight:bold;"><a href="plappointment_consolidated.php">WishFin Appointment</a></td>
        <td align="right" style="font-size:10px; font-weight:bold;"><a href="plappoint_consol_wishd4l.php">WishFin HDFC Appointment</a></td></tr>
    
    <tr><td align="center" style="font-size:22px; font-weight:bold;">WishFin HDFC Appointment</td></tr>
    
    
              <tr>
        <td align="right"></td>
      </tr>
              <tr>
        <td align="center" width="100%"><div align="center">
             <form name="frmsearch" action="plappoint_consol_wishd4l.php" method="get" onSubmit="return chkform();">
                <input type="hidden" name="BidderIDstatic" id="BidderIDstatic" value="<? echo $_SESSION["BidderID"];?>">
                <input type="hidden" name="search" id="search" value="y">
                <table width="600" border="0" cellpadding="4" cellspacing="1" class="blueborder" bgcolor="#FFFFFF">
             
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
	  <td>Banks <select name="BankID" id="BiddIDs">	


<?php
echo $qury = "SELECT BankID,Bidder_Name,BidderID FROM Bidders_List Where Reply_Type=1 and BankID ='4' GROUP BY BankID ORDER BY Bidder_Name ASC";
$Results= $obj->fun_db_query($qury);
while($rowGet = $obj->fun_db_fetch_rs_object($Results))
{
    $BankID = $rowGet->BankID;
    $Bank_Name = $rowGet->Bidder_Name;
    $BanksIDS[] = $BankID;
    			?>
			<option value="<?php echo $BankID; ?>" <? if($_REQUEST['BankID']==$BankID) echo "selected"; ?>><?php echo $Bank_Name; ?> </option>
			<?php
		}
               $AllBanks = implode(",",$BanksIDS);
                ?>
			
	</select>
</td>
<td width="12%"><strong>Feedback:</strong></td>
                  <td width="29%"><select name="cmbfeedback" id="cmbfeedback">
                	<option value="All" <? if($varCmbFeedback == "All") { echo "selected"; } ?>>All</option>
		
		<option value="Not Interested" <? if($varCmbFeedback == "Not Interested") { echo "selected"; } ?>>Not Interested</option>
		<option value="Not Eligible" <? if($varCmbFeedback == "Not Eligible") { echo "selected"; }?>>Not Eligible</option>
		<option value="Rescheduled" <? if($varCmbFeedback == "Rescheduled") { echo "selected"; }?>>Rescheduled</option>
		<option value="Cancelled" <? if($varCmbFeedback == "Cancelled") { echo "selected"; }?>>Cancelled</option>
		<option value="Documents Picked" <? if($varCmbFeedback == "Documents Picked") { echo "selected"; }?>>Documents Picked</option>
		<option value="Login" <? if($varCmbFeedback == "Login") { echo "selected"; }?>>Login</option>
		<option value="Approved" <? if($varCmbFeedback == "Approved") { echo "selected"; } ?>>Approved</option>
		<option value="Disbursed" <? if($varCmbFeedback == "Disbursed") { echo "selected"; } ?>>Disbursed</option>
		<option value="Post Login Reject" <? if($varCmbFeedback == "Post Login Reject") { echo "selected"; }?>>Post Login Reject</option>
                <option value="Aligned" <? if($varCmbFeedback == "Aligned") { echo "selected"; }?>>Aligned</option>
                <option value="Documents Incomplete" <? if($varCmbFeedback == "Documents Incomplete") { echo "selected"; }?>>Documents Incomplete</option>
		</select></td>
                  
      
                </tr>
                <!---<td width="12%"><strong>Bank Feedback:</strong></td>
                  <td width="29%"><select name="bankfeedback" id="bankfeedback">
                	<option value="All" <? if($varCmbFeedback == "All") { echo "selected"; } ?>>All</option>
		
		<option value="Appointment" <? if($varCmbFeedback == "Appointment") { echo "selected"; } ?>>Appointment</option>
		<option value="Disbursed" <? if($varCmbFeedback == "Disbursed") { echo "selected"; }?>>Disbursed</option>
		<option value="Documents Picked" <? if($varCmbFeedback == "Documents Picked") { echo "selected"; }?>>Documents Picked</option>
		<option value="Follow Up" <? if($varCmbFeedback == "Follow Up") { echo "selected"; }?>>Follow Up</option>
		<option value="Login/WIP" <? if($varCmbFeedback == "Login/WIP") { echo "selected"; }?>>Login/WIP</option>
		<option value="Not Contactable" <? if($varCmbFeedback == "Not Contactable") { echo "selected"; }?>>Not Contactable</option>
		<option value="Not Eligible" <? if($varCmbFeedback == "Not Eligible") { echo "selected"; } ?>>Not Eligible</option>
		<option value="Not Interested" <? if($varCmbFeedback == "Not Interested") { echo "selected"; } ?>>Not Interested</option>
		<option value="Post Login Reject" <? if($varCmbFeedback == "Post Login Reject") { echo "selected"; }?>>Post Login Reject</option>
		</select></td>-->
                <tr>
                    <td align="left">&nbsp;</td>
                    <td width="12%"><strong>Reference Number</strong></td>
	  <td><input name="refernce_no" type="text" id="refernce_no" value="<? echo $_REQUEST['refernce_no']; ?>" /></td>
          <td align="left">&nbsp;</td>
                </tr>
                
                
                
                 <tr>
                     <td align="left">&nbsp;</td>
                     <td align="left">&nbsp;</td>
                     <td align="left">&nbsp;</td>
                     <td align="left"><input name="Submit" type="submit" class="bluebutton" value="Search" /></td>                </tr>
             
            </table>
                 </form>
            <p>&nbsp;</p>
            <?	
			$search_date="";
	$varmin_date=$min_date;
	$varmax_date=$max_date;

	if(strlen(trim($RequestID))>0)
	{
		$strSQL="";
		$Msg="";
		$fbqry="select FeedbackID from Req_Feedback_PL where AllRequestID=$RequestID and BidderID=".$_SESSION['BidderID']." AND Reply_Type=1";
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
			$strSQL=$strSQL.$RequestID.",".$_SESSION['BidderID'].",'1','".$Feedback."')";
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
		$feedback_tble="Req_Feedback_Bidder_PL";
		$min_dateonly=$min_date;
		$max_dateonly=$max_date;

		$min_date=$min_date." 00:00:00";
		$max_date=$max_date." 23:59:59";

		?>       <p class="bodyarial11">
              <?=$Msg?>
            </p>
             <p><span id="name_status" style="color:#F00; font-weight:bold;"></span> </p>
            <table width="900" border="0" cellpadding="4" cellspacing="1" class="blueborder" bgcolor="#FFFFFF">
              <?
              $queryfrBidd = "SELECT BankID,Bidder_Name,BidderID FROM Bidders_List Where Reply_Type=1 and (lms_block_flag=0 OR lms_block_flag=1) "; 
            $ResfrBidd=  $obj->fun_db_query($queryfrBidd);
             while($rowGetfrBidd = $obj->fun_db_fetch_rs_object($ResfrBidd)){
                  $arrVal[]=$rowGetfrBidd->BidderID;
             }
    $GetBidIDs = implode(',',$arrVal);
              
              $srh_qry=""; 
		if($mob_num>0)
		{
			$mob_num_clause = " AND ".TABLE_REQ_LOAN_PERSONAL.".Mobile_Number = '".$mob_num."' ";
		}		
		
		if($BidderIDstatic!="")
		{
		   
$qry="select *, Req_Loan_Personal.RequestID, Req_Loan_Personal.Name, Req_Loan_Personal.Mobile_Number, plcallinglms_allocation.BidderID as AgentID, Req_Feedback_Bidder_PL.BidderID as Bidder_ID, Req_Feedback.Feedback, Req_Feedback.BidderID as checkBidderID  from plcallinglms_allocation left outer join Req_Loan_Personal on plcallinglms_allocation.AllRequestID=Req_Loan_Personal.RequestID left outer join Req_Feedback_Bidder_PL on plcallinglms_allocation.AllRequestID= Req_Feedback_Bidder_PL.AllRequestID and Req_Feedback_Bidder_PL.BidderID in ('".$BIdIds."') left outer join Req_Feedback on plcallinglms_allocation.AllRequestID= Req_Feedback.AllRequestID and Req_Feedback.BidderID in ('".$BIdIds."') LEFT OUTER JOIN Req_Feedback_PL ON plcallinglms_allocation.AllRequestID= Req_Feedback_PL.AllRequestID where (plcallinglms_allocation.BidderID in ('".$AgentIds."') and Req_Feedback_Bidder_PL.BidderID in ('".$BIdIds."')  and (plcallinglms_allocation.BidderID NOT IN ('".$excludearrCallerIDStr."')) and (Req_Feedback_Bidder_PL.Allocation_Date  Between '".($min_date)."' and '".($max_date)."' or Req_Feedback.Followup_Date Between '".($min_date)."' and '".($max_date)."') )  AND (Req_Feedback.Feedback IS NULL OR Req_Feedback.Feedback='' OR Req_Feedback.Feedback='No Feedback')";


if($_REQUEST['cmbfeedback']!='All'){
$qry.=" AND Req_Feedback_PL.Feedback='".$_REQUEST['cmbfeedback']."'";
}

//$qry="SELECT *, Req_Feedback_Bidder_PL.BidderID as Bidder_ID FROM Req_Feedback_Bidder_PL,Req_Loan_Personal LEFT OUTER JOIN Req_Feedback_PL ON Req_Feedback_PL.AllRequestID=Req_Loan_Personal.RequestID AND Req_Feedback_PL.BidderID in (".$BidderIDstatic.") LEFT JOIN plcallinglms_allocation ON plcallinglms_allocation.AllRequestID=Req_Loan_Personal.RequestID WHERE Req_Feedback_Bidder_PL.AllRequestID=Req_Loan_Personal.RequestID and ((Req_Feedback_Bidder_PL.Allocation_Date Between '".($min_date)."' and '".($max_date)."' or Req_Feedback_PL.Followup_Date Between '" . ($min_date) . "' and '" . ($max_date) . "')) AND Req_Feedback_Bidder_PL.BidderID in($BIdIds) AND Req_Feedback_PL.Feedback='Send Now'";
                    
                  
                    
                    
                    if($refernce_no!="")
                    {
                        $RefArray = explode("S",$refernce_no);
                        $feedbackNum  = preg_replace("/[^0-9,.]/", "", $RefArray[0]);
                      $qry.=" AND Req_Feedback_Bidder_PL.Feedback_ID=".$feedbackNum; 
                    }
                    $qry .= "  GROUP BY Req_Feedback_Bidder_PL.AllRequestID";
			
		}		
	$srh_qry = $qry;

//echo $qry;
$resCount = $objAdmin->fun_get_num_rows($qry);
if($resCount>$limit)
{
$pagelinks = paginate($limit, $resCount);
}

$qry.= " order by Req_Feedback_Bidder_PL.Allocation_Date DESC LIMIT $start,$limit ";
//echo $qry;
//echo "<br>".$resCount;
$result = $obj->fun_db_query($qry);
$getParameterVal = min($start+$limit,$resCount) % $limit;
 ?>
              <tr>
                <td colspan="7"><strong><? echo $start+1; ?> to <? echo $start+$limit; ?> Out of <? echo $resCount; ?> Records </strong></td>
              </tr>
              <tr>
              <td class="head1">Reference ID</td>
                <td class="head1">Agent ID</td>
                <td class="head1">Name</td>
                <td class="head1">Mobile</td>
                <td class="head1">Salary</td>
                <td class="head1">City</td>
                <td class="head1">Feedback</td>                
                <td class="head1">FollowUp date</td>
            	<td class="head1">Bank Feedback</td>
                <td class="head1">Company Category</td>            	
              </tr>
              <?			
	if($resCount>0)
			{
				$color = 1;		
				
		while($row = $obj->fun_db_fetch_rs_object($result))
		{
		//echo "<pre>";
                   // print_r($row);
			
                    $QryAgent = "SELECT plallocateid,BidderID AS AgentID FROM plcallinglms_allocation WHERE AllRequestID='".$row->RequestID."'";
                    $resultAgent = $obj->fun_db_query($QryAgent);
                    $rowAgent = $obj->fun_db_fetch_rs_object($resultAgent);
                    
                    
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
 <td class="bodyarial11"><? echo "PL".$row->Feedback_ID."S".$row->Bidder_ID; ?></td>
 <td class="bodyarial11"><?php echo $rowAgent->AgentID; ?></td>               
 <td class="bodyarial11"><a href="../plappointmentlead-details.php?postid=<?php echo $row->RequestID; ?>&biddt=<?php echo $row->Bidder_ID;?>" target="_blank"><? echo $row->Name; ?></a></td>
                <td class="bodyarial11"><?php //echo ccMasking($row->Mobile_Number); ?> <span id="clik4Num_<?php echo $color; ?>">XXXXXXXXXX</span></td>
                <td class="bodyarial11"><span id="clkNum<?php echo $color; ?>" onClick="getNumValue(<?php echo $color; ?>,<?php echo $row->RequestID; ?>,<?php echo $getParameterVal; ?>);" style="cursor:hand;"><? echo $row->Net_Salary; ?></span><? //echo $row->Net_Salary; ?></td>
                <td class="bodyarial11"><? echo $row->City; ?></td>
		<!--		<td class="bodyarial11"><?php 
				list($FinalBidder,$finalBidderName) = $objeligiblebidderfuncPL->getBiddersList("Req_Loan_Personal",$row->RequestID,$row->City,$row->Referral_Flag,$row->source);

   for($i=0;$i<count($FinalBidder);$i++)
			{
		
		//echo $finalBidderName[$i].","; // 2140293
			}
		?></td>
       -->
		<td class="bodyarial11">
                 <?php 
                  $Qryfeedback = "SELECT * FROM Req_Feedback_PL WHERE AllRequestID='".$row->RequestID."' AND BidderID='".$row->Bidder_ID."'";
                    $resultfeedback = $obj->fun_db_query($Qryfeedback);
                    $rowfeedback = $obj->fun_db_fetch_rs_object($resultfeedback);
                  echo $varFeedback =  $rowfeedback->Feedback;
                 
                 ///echo getJumpMenu($varPHPPage, $varRequestID, $varType, $varFeedback, $varpageon, $varmindate, $varmaxdate,$cmbfeedback,$varVal);?>
       
     </td>
         <td class="bodyarial11"><input type="text" name="Followup_Date" id="Followup_Date" value="<? echo $Followup_Date; ?>"></td>
  <!-- <td class="bodyarial11">
<?php
$sourceLead =  $row->source;
if(strlen(strpos($sourceLead, "wf -")) > 0)
{
//	echo '<br><b style="color:red; font-weight:bold; font-size:10px;">WishFin</b>';
}
?>
</td>-->
<td class="bodyarial11">
<?php 
$getCheckNumRows=0;
$getCheckSql = "select Feedback_ID, Comments as rm_comments, Feedback as rm_feedback, BidderID as AllocatedBidderID from Req_Feedback_Comments_PL where AllRequestID= '".$row->RequestID."' and Reply_Type='1'";

			 $getCheckQuery =  $obj->fun_db_query($getCheckSql);

			 $getCheckNumRows = $objAdmin->fun_get_num_rows($getCheckSql);
			 if($getCheckNumRows>0)
			 {
				 while($rowFeedback = $obj->fun_db_fetch_rs_object($getCheckQuery))
				 {
					 $rm_feedback = $rowFeedback->rm_feedback;
					 $AllocatedBidderID = $rowFeedback->AllocatedBidderID;	
					 $Feedback_ID = $rowFeedback->Feedback_ID;
					 if(strlen($rm_feedback)>1)
					 {				
			 			$AllocatedBidsSql = "SELECT Associated_Bank from Bidders where BidderID ='".$AllocatedBidderID."'";
						$AllocatedBidsQuery = $obj->fun_db_query($AllocatedBidsSql);
						$AllocatedBidsRow = $obj->fun_db_fetch_rs_object($AllocatedBidsQuery);
						$AllocatedBiddName = $AllocatedBidsRow->Associated_Bank;
						$RefID = "PL".$Feedback_ID."S".$AllocatedBidderID;
					 	echo "<b>".$AllocatedBiddName."</b> [".$RefID."] - ".$rm_feedback;
					 }
					 
				 }
			}
?>
</td>
<td class="bodyarial11"><?php echo $row->company_category;?></td>
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
    <?php  if($resCount<=5000)
          {
          ?>
              <br>
                <form name="frmdownload" action="/misappt_download_consolidated.php" method="post">
  <table  border="0" cellpadding="5" cellspacing="1" align="center">
              <tr>
                <td style="color:#FFF;" align="center" bgcolor="#FFFFFF">

	 <input type="hidden" name="qry1" value="<? echo $srh_qry; ?>">
	 <input type="hidden" name="qry2" value="<? echo $val; ?>">
	 <input type="hidden" name="min_date" value="<? echo $min_date; ?>">
	 <input type="hidden" name="max_date" value="<? echo $max_date; ?>">
	 <input name="Submit2" type="submit" class="bluebtn" value="Export List To Excel">
</td>
              </tr>
            </table>
 </form>
  <?
  		}
            
 }
 ?>            </div></td>
      </tr>
            </table>
        </div>
		<?
function getJumpMenu($varPHPPage, $varRequestID, $varType, $varFeedback, $varpageon, $varmindate, $varmaxdate,$cmbfeedback,$varVal)
{
//www.deal4loans.com/callinglms/plallocation_consolidated.php?search=y&RequestID=2115107&type=1&pageno=&min_date=2016-05-01&max_date=2016-06-01&cmbfeedback=All&product=Req_Loan_Personal&Feedback=Not%20Applied 
	$strURL="";
	$strURL=$varPHPPage."?search=y&RequestID=".$varRequestID."&type=".$varType."&pageno=".$varpageon."&min_date=".urlencode($varmindate)."&max_date=".urlencode($varmaxdate)."&cmbfeedback=".urlencode($cmbfeedback)."&product=".$varVal;
?>
	<select name="type" id="type" onChange="MM_jumpMenu('parent',this,0)">
            <option value="<? echo $strURL.'&Feedback='?>" <? if($varFeedback == "") { echo "selected"; } ?>>No Feedback</option>	
            <option value="<? echo $strURL.'&Feedback=Not Interested'?>" <? if($varFeedback == "Not Interested") { echo "selected"; } ?>>Not Interested</option>
		<option value="<? echo $strURL.'&Feedback=Not Eligible'?>" <? if($varFeedback == "Not Eligible") { echo "selected"; } ?> >Not Eligible</option>
		<option value="<? echo $strURL.'&Feedback=Rescheduled'?>" <? if($varFeedback == "Rescheduled") { echo "selected"; } ?> >Rescheduled</option>
		<option value="<? echo $strURL.'&Feedback=Cancelled'?>" <? if($varFeedback == "Cancelled") { echo "selected"; } ?> >Cancelled</option>
		<option value="<? echo $strURL.'&Feedback=Documents Picked'?>" <? if($varFeedback == "Documents Picked") { echo "selected"; } ?> >Documents Picked</option>
		<option value="<? echo $strURL.'&Feedback=Login'?>" <? if($varFeedback == "Login") { echo "selected"; } ?>>Login</option>
		
		<option value="<? echo $strURL.'&Feedback=Approved'?>" <? if($varFeedback == "Approved") { echo "selected"; } ?>>Approved</option>	
		<option value="<? echo $strURL.'&Feedback=Disbursed'?>" <? if($varFeedback == "Disbursed") { echo "selected"; } ?>>Disbursed</option>
		<option value="<? echo $strURL.'&Feedback=Post Login Reject'?>" <? if($varFeedback == "Post Login Reject") { echo "selected"; } ?>>Post Login Reject</option>
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
