<?php
require_once("includes/application-top-inner-plcalling.php");
//require_once("includes/application-top-inner.php");
//require '../eligiblebidderfuncPL.php';
$qryCheck = "SELECT * FROM Bidders where leadidentifier in ('pl_alloclms_admin','pl_alloclms_subadmin') and BidderID='".$_SESSION["BidderID"]."'";
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
                        <div style="background:#F00; width:150px; padding-left:7px; line-height:30px; height:30px; float:right; margin-right:50px; margin-top:7px; border-radius:20%;"><a href="pllms-change-password.php" style="color:#FFF; text-align:center; text-decoration:none; font-size:12px;">Change Agent Password</a></div>
<div style="clear:both;"></div>
</div>
<div style="clear:both; height:15px;"></div>
          <div> 
    <table width="98%" border="0">
    <tr><td align="right" style="font-size:10px; font-weight:bold;"><?php echo $_SESSION['Bidder_Name']; ?></td></tr>
	  <tr><td align="center" style="font-size:22px; font-weight:bold;">Supervisory Admin</td></tr>
              <tr>
        <td align="right"></td>
      </tr>
              <tr>
        <td align="center" width="100%"><div align="center">
            <table width="600" border="0" cellpadding="4" cellspacing="1" class="blueborder" bgcolor="#FFFFFF">
              <form name="frmsearch" action="plallocation_consolidated.php" method="get" onSubmit="return chkform();">
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
                	<option value="All" <? if($varCmbFeedback == "All") { echo "selected"; } ?>>All</option>
		<option value="" <? if($varCmbFeedback == "") { echo "selected"; } ?>>No Feedback</option>
		<option value="Other Product" <? if($varCmbFeedback == "Other Product") { echo "selected"; } ?>>Other Product</option>
		<option value="Not Interested" <? if($varCmbFeedback == "Not Interested") { echo "selected"; } ?>>Not Interested</option>
		<option value="Callback Later" <? if($varCmbFeedback == "Callback Later") { echo "selected"; } ?>>Callback Later</option>
		<option value="Wrong Number" <? if($varCmbFeedback == "Wrong Number") { echo "selected"; } ?>>Wrong Number</option>
		<option value="Not Eligible" <? if($varCmbFeedback == "Not Eligible") { echo "selected"; }?>>Not Eligible</option>
		<option value="Send Now" <? if($varCmbFeedback == "Send Now") { echo "selected"; }?>>Send Now</option>
		<option value="Ringing" <? if($varCmbFeedback == "Ringing") { echo "selected"; }?>>Ringing</option>
		<option value="Not Contactable" <? if($varCmbFeedback == "Not Contactable") { echo "selected"; }?>>Not Contactable</option>
		<option value="Duplicate" <? if($varCmbFeedback == "Duplicate") { echo "selected"; }?>>Duplicate</option>
		<option value="Not Applied" <? if($varCmbFeedback == "Not Applied") { echo "selected"; } ?>>Not Applied</option>
		<option value="FollowUp" <? if($varCmbFeedback == "FollowUp") { echo "selected"; } ?>>FollowUp</option>
		<option value="Not Interested - Offer" <? if($varCmbFeedback == "Not Interested - Offer") { echo "selected"; }?>>Not Interested - Offer</option>
		<option value="Not Interested - Direct" <? if($varCmbFeedback == "Not Interested - Direct") { echo "selected"; }?>>Not Interested - Direct</option>
		<option value="Not Eligible - FOIR" <? if($varCmbFeedback == "Not Eligible - FOIR") { echo "selected"; }?>>Not Eligible - FOIR</option>
		<option value="Not Eligible - Cibil" <? if($varCmbFeedback == "Not Eligible - Cibil") { echo "selected"; }?>>Not Eligible - Cibil</option>
		<option value="Not Eligible - Others" <? if($varCmbFeedback == "Duplicate") { echo "selected"; }?>>Not Eligible - Others</option>
		<option value="Appointment - Cibil Ok" <? if($varCmbFeedback == "Appointment - Cibil Ok") { echo "Appointment - Cibil Ok"; }?>>Appointment - Cibil Ok</option>
		<option value="Appointment - Others" <? if($varCmbFeedback == "Appointment - Others") { echo "selected"; }?>>Appointment - Others</option>
				                    </select></td>
      <td width="29%" align="center"  valign="middle" class="bidderclass">Agents</td>
	  <td width="58%"  valign="middle" class="bidderclass"><select name="agents" id="agents">
		
		<option value="">Please Select</option>
<?php
	if($_SESSION['leadidentifier']=='pl_alloclms_admin')
	{
		$getExpertsActiveBiddersSql = "select BidderID,Associated_Bank,Status from Bidders where leadidentifier='pl_alloclms_subadmin'";
		$getExpertsActiveBiddersQry= $obj->fun_db_query($getExpertsActiveBiddersSql);
		$recordExpertsCountActiveBidders = mysql_num_rows($getExpertsActiveBiddersQry);
		while($rowgetExpertsActiveBiddersQry = $obj->fun_db_fetch_rs_object($getExpertsActiveBiddersQry))
		{
			$BidderID = $rowgetExpertsActiveBiddersQry->BidderID;
			$Associated_Bank = $rowgetExpertsActiveBiddersQry->Associated_Bank;
			$getAgentSql = "select BidderID,Associated_Bank,Status from Bidders where leadidentifier='plalloclms' and Global_Access_ID like '%".$BidderID."%'";
			$getAgentQry= $obj->fun_db_query($getAgentSql);
			$getAgentsID = '';
			while($rowgetAgentQry = $obj->fun_db_fetch_rs_object($getAgentQry))
			{
				$getAgentsID[] = $rowgetAgentQry ->BidderID;
			}
			$getAgentsIDStr = implode(',',$getAgentsID);
			?>
			<option value="<?php echo $getAgentsIDStr ; ?>" <? if($getAgentsIDStr==$agents) echo "selected"; ?> ><?php echo $Associated_Bank; ?> </option>
			<?php
		}
	
	}

		$getExpertsActiveBiddersSql = "select BidderID,Associated_Bank,Status from Bidders where leadidentifier='plalloclms' and Global_Access_ID like '%".$_SESSION["BidderID"]."%'";
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
			<option value="<?php echo $BidderID; ?>" <? if($BidderID==$agents) echo "selected"; ?> <?php if($Status==1) { ?> style="font-weight:bold;" <?php } ?>><?php echo $Associated_Bank; ?> (<?php echo $statusValue; ?>)</option>
			<?php
		}
	$getallBiddersStr = implode(',',$allBidders);
	?>
<option value="<?php echo $getallBiddersStr; ?>" <? if($agents==$getallBiddersStr) echo "selected"; ?>>All Agents</option>	
	</select>
</td>
                </tr>
                 <tr>
                  <td><strong>Net Salary</strong></td>
                  <td><select name="salaryrange" id="salaryrange">
		<option value="-1" <? if($salaryclause=="-1") echo "selected"; ?>>All</option>
		<option value="1" <? if($salaryclause=="1") echo "selected"; ?>>0- 3 lacs</option>
		<option value="2" <? if($salaryclause=="2") echo "selected"; ?>>3 lacs - 4.8 lacs</option>
		<option value="3" <? if($salaryclause=="3") echo "selected"; ?>>4.8 lacs - 9 lacs</option>
		<option value="4" <? if($salaryclause=="4") echo "selected"; ?>>9 lacs & above</option>
		<option value="5" <? if($salaryclause=="5") echo "selected"; ?>>Exact 4 lacs</option></select></td>
                <td><strong>Company Category</strong></td>
                <td><select name="company_category" id="company_category">
                        <option value="">Company Category</option>
            <option value="Listed" <? if($company_category=="Listed") echo "selected"; ?>>Listed</option>
            <option value="Unlisted" <? if($company_category=="Unlisted") echo "selected"; ?>>Unlisted</option></select></td>   
                 </tr>
                 <tr>
                <td><strong>Ref No </strong></td><td><input type="text" name="refernce_no" id="refernce_no" value="<?php echo $refernce_no; ?>" class="input-lead" >                &nbsp;</td> 
                  
  <td align="left"><input name="Submit" type="submit" class="bluebutton" value="Search" border="0"></td>                </tr>
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
		$feedback_tble="plcallinglms_allocation";
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
		
		if($salaryclause=="1")
		{
			$salaryfilter="AND (Net_Salary>='0' and Net_Salary<'300000')";
		}
		elseif($salaryclause=="2")
		{
			$salaryfilter="AND (Net_Salary>='300000' and Net_Salary<'480000')";	
		}
		elseif($salaryclause=="3")
		{
			$salaryfilter="AND (Net_Salary>='480000' and Net_Salary<'900000')";	
		}
		elseif($salaryclause=="4")
		{
			$salaryfilter="AND (Net_Salary>='900000')";
		}
		elseif($salaryclause=="5")
		{
			$salaryfilter="AND (Net_Salary='400000')";
		}
		else
		{
			$salaryfilter="";
		}	
		
		if($empstatus=="1")
		{
			$empstatusfilter=" AND (Employment_Status='1') ";
		}
		elseif($empstatus=="0")
		{
			$empstatusfilter=" AND (Employment_Status='0') ";
		}
		else
		{
			$empstatusfilter=" ";
		}	
		
		if(strlen($refernce_no)>3)
		{	$appdtxt="PL";
			list($requestidno, $bidderid) = split('[S]', $refernce_no);
			$refernce_no_section = str_replace($appdtxt, "",$requestidno);

			 $refernce_no_clause = " AND plcallinglms_allocation.plallocateid = '".$refernce_no_section."' ";
		}

		
		
		if($agents=="All")
		{
			$getExpertsActiveBiddersSql = "select BidderID from Bidders where leadidentifier='plalloclms'";
			$getExpertsActiveBiddersQry= $obj->fun_db_query($getExpertsActiveBiddersSql);
			$recordExpertsCountActiveBidders = mysql_num_rows($getExpertsActiveBiddersQry);
			$agentID='';
			while($rowgetExpertsActiveBiddersQry = $obj->fun_db_fetch_rs_object($getExpertsActiveBiddersQry))
			{
				$agentID[] = $rowgetExpertsActiveBiddersQry->BidderID;
			}
			
				$agentsStr=implode(",",$agentID);
				$agentClause=" AND ".$feedback_tble.".BidderID in (".$agentsStr.") ";	
		}
		else
		{
			$agentsStr=$agents;
			$agentClause=" AND ".$feedback_tble.".BidderID in (".$agents.") ";
		}	

		
	?>       <p class="bodyarial11">
              <?=$Msg?>
            </p>
             <p><span id="name_status" style="color:#F00; font-weight:bold;"></span> </p>
            <table width="900" border="0" cellpadding="4" cellspacing="1" class="blueborder" bgcolor="#FFFFFF">
              <? $srh_qry=""; 
		//echo "BidderIDstatic - ".$BidderIDstatic;
		if($mob_num>0)
		{
			$mob_num_clause = " AND ".TABLE_REQ_LOAN_PERSONAL.".Mobile_Number = '".$mob_num."' ";
		}
		
		
		if($BidderIDstatic!="")
		{
			//echo "hello";." ".$refernce_no_clause
			
			$qry="SELECT *, plcallinglms_allocation.BidderID as Agent_ID FROM ".$feedback_tble.",".TABLE_REQ_LOAN_PERSONAL." LEFT OUTER JOIN Req_Feedback_PL ON Req_Feedback_PL.AllRequestID=".TABLE_REQ_LOAN_PERSONAL.".RequestID AND Req_Feedback_PL.BidderID in (".$agentsStr.") WHERE ".$feedback_tble.".AllRequestID=".TABLE_REQ_LOAN_PERSONAL.".RequestID and ".$feedback_tble.".BidderID in (".$agentsStr.")  and ((".$feedback_tble.".DOE Between '".($min_date)."' and '".($max_date)."') or (Req_Feedback_PL.Followup_Date Between '".($min_date)."' and '".($max_date)."')) ";
			
                        if($company_category!="")
                        {
                        $qry .=" AND company_category='".$company_category."'";
                        }  
                        
                        $qry=$qry.$FeedbackClause." ".$agentClause." ".$mob_num_clause." ".$salaryfilter." ".$empstatusfilter." ".$refernce_no_clause." group by ".TABLE_REQ_LOAN_PERSONAL.".Mobile_Number " ;
		}		
	$srh_qry = $qry;

//echo $qry;
$resCount = $objAdmin->fun_get_num_rows($qry);
if($resCount>$limit)
{
$pagelinks = paginate($limit, $resCount);
}

$qry.= " order by ".$feedback_tble.".DOE DESC LIMIT $start,$limit ";
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
			
			if($color%2!=0)
					{
						$colorvar = "#FFF";
					}
				else{
						$colorvar = "#EEE";
					}
	?>
                 <tr  bgcolor="<?php echo $colorvar;?>">			 
 <td class="bodyarial11"><? echo "PL".$row->plallocateid."S".$row->Agent_ID; ?></td>
 <td class="bodyarial11"><?php echo $row->Agent_ID; ?></td>               
 <td class="bodyarial11"><? echo $row->Name; ?></td>
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
                 <? echo $row->Feedback; ?>
       <?php
	   $day = date("D");	
		if($time >=18 && $time<21 )
		{
		
		
		
			$feedsSql = "SELECT Feedback,BidderID from Req_Feedback_PL where BidderID in (846,847,854,9,10,63,67,68,6276) and Reply_Type=1 and AllRequestID='".$row->RequestID."'";	
		}
		else if($day=="Sun")
		{
		$feedsSql = "SELECT Feedback,BidderID from Req_Feedback_PL where BidderID in (6255,6256,6257,6258,6259,6260,6261,6262,6263,6264,6265,6266,6267,6268,6269,6270,846,847,854,9,10,63,67,68,6276,6278,6277) and Reply_Type=1 and AllRequestID='".$row->RequestID."'";
		}
		else
		{
			$feedsSql = "SELECT Feedback,BidderID from Req_Feedback_PL where BidderID in (6255,6256,6257,6258,6259,6260,6261,6262,6263,6264,6265,6266,6267,6268,6269,6270,6278,6277) and Reply_Type=1 and AllRequestID='".$row->RequestID."'";	
		}
		$feedsQuery = $obj->fun_db_query($feedsSql);
		$feedsRows = $obj->fun_db_fetch_rs_object($feedsQuery);
		//$feedsQuery = ExecQuery($feedsSql);
		$numFeeds = $objAdmin->fun_get_num_rows($feedsSql);
		//$numFeeds = mysql_num_rows($feedsQuery);
		
		$feeds = $feedsRows->Feedback;
		$BiddsID = $feedsRows->BidderID;
		//echo $feeds."".$BiddsID;
		$BidsSql = "SELECT Bidder_Name from Bidders where BidderID ='".$BiddsID."'";
		$BidsQuery = $obj->fun_db_query($BidsSql);
		$BidsRow = $obj->fun_db_fetch_rs_object($BidsQuery);
		$BiddName = $BidsRow->Bidder_Name;
		if($numFeeds>0)
		{
			echo "<br>".$feeds;
			//echo "<br>".$feeds."<br> [<b>".$BiddName."</b>]";
		}
		

    ?>
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
		<option value="<? echo $strURL.'&Feedback=Other Product'?>" <? if($varFeedback == "Other Product") { echo "selected"; } ?>>Other Product</option>
		<option value="<? echo $strURL.'&Feedback=Not Interested'?>" <? if($varFeedback == "Not Interested") { echo "selected"; } ?>>Not Interested</option>
		<option value="<? echo $strURL.'&Feedback=Not Contactable'?>" <? if($varFeedback == "Not Contactable") { echo "selected"; } ?>>Not Contactable</option>
		<option value="<? echo $strURL.'&Feedback=Callback Later'?>" <? if($varFeedback == "Callback Later") { echo "selected"; } ?>>Callback Later</option>
		<option value="<? echo $strURL.'&Feedback=Wrong Number'?>" <? if($varFeedback == "Wrong Number") { echo "selected"; } ?>>Wrong Number</option>
		<option value="<? echo $strURL.'&Feedback=Send Now'?>" <? if($varFeedback == "Send Now") { echo "selected"; } ?> >Send Now</option>
		<option value="<? echo $strURL.'&Feedback=Not Eligible'?>" <? if($varFeedback == "Not Eligible") { echo "selected"; } ?> >Not Eligible</option>
		<option value="<? echo $strURL.'&Feedback=Ringing'?>" <? if($varFeedback == "Ringing") { echo "selected"; } ?> >Ringing</option>
		<option value="<? echo $strURL.'&Feedback=Duplicate'?>" <? if($varFeedback == "Duplicate") { echo "selected"; } ?> >Duplicate</option>
		<option value="<? echo $strURL.'&Feedback=Not Applied'?>" <? if($varFeedback == "Not Applied") { echo "selected"; } ?> >Not Applied</option>
		<option value="<? echo $strURL.'&Feedback=FollowUp'?>" <? if($varFeedback == "FollowUp") { echo "selected"; } ?>>FollowUp</option>
		
		<option value="<? echo $strURL.'&Feedback=Not Interested - Offer'?>" <? if($varFeedback == "Not Interested - Offer") { echo "selected"; } ?>>Not Interested - Offer</option>	
		<option value="<? echo $strURL.'&Feedback=Not Interested - Direct'?>" <? if($varFeedback == "Not Interested - Direct") { echo "selected"; } ?>>Not Interested - Direct</option>
		<option value="<? echo $strURL.'&Feedback=Not Eligible - FOIR'?>" <? if($varFeedback == "Not Eligible - FOIR") { echo "selected"; } ?>>Not Eligible - FOIR</option>
		<option value="<? echo $strURL.'&Feedback=Not Eligible - Cibil'?>" <? if($varFeedback == "Not Eligible - Cibil") { echo "selected"; } ?>>Not Eligible - Cibil</option>
		<option value="<? echo $strURL.'&Feedback=Not Eligible - Others'?>" <? if($varFeedback == "Not Eligible - Others") { echo "selected"; } ?>>Not Eligible - Others</option>
		<option value="<? echo $strURL.'&Feedback=Appointment - Cibil Ok'?>" <? if($varFeedback == "Appointment - Cibil Ok") { echo "selected"; } ?>>Appointment - Cibil Ok</option>
		<option value="<? echo $strURL.'&Feedback=Appointment - Others'?>" <? if($varFeedback == "Appointment - Others") { echo "selected"; } ?>>Appointment - Others</option>
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
