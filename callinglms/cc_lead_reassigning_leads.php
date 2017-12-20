<?php
require_once("includes/application-top-inner.php");
define("NoOFLMS", 2);
//$allocation_table = 'lead_allocate_140817';
$allocation_table = 'lead_allocate';
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
	
	$shift_agents="";	
	if(isset($_REQUEST['shift_agents']))
	{
		$shift_agents=$_REQUEST['shift_agents'];
		$explode_agents = explode(',', $shift_agents);
	}
	$varCmbFeedback="";
	if(isset($_REQUEST['cmbfeedback']))
	{
		$varCmbFeedback=$_REQUEST['cmbfeedback'];
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
<?php include "header_cc_admin_lms.php"; ?>
<div style="clear:both; height:15px;"></div>
          <div> 
    <table width="98%" border="0">
	               <tr>
        <td align="center" style="font-size:16px; font-weight:bold;">In House Calling LMS Lead Churning</td>
      </tr>
 <tr>
        <td align="right"><?php //echo "<pre>"; print_r($_POST); ?> </td>
      </tr>
              <tr>
        <td align="center" width="100%"><div align="center">
            <table width="900" border="0" cellpadding="4" cellspacing="6" class="blueborder" bgcolor="#FFFFFF">
                <tr>
                  <td colspan="4" class="head1">Search</td>
                </tr>
                <tr>
                  <td colspan="3">&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                
                 <tr> <td colspan="4" valign="top" align="center">
                 <table width="50%" border="1" cellpadding="3">
                 <tr><td align="center" valign="middle" class="bidderclass"><strong>Agents</strong></td><td align="center" valign="middle" class="bidderclass"><strong>Lead Count Allocated</strong></td></tr>
<?php
	$min_date=$min_date." 00:00:00";
	$max_date=$max_date." 23:59:59";
        
       // $shift_agents = array(6501,6556,6557,6558);
		$counterVal = 1;
		$array_agents='';
		for($i=0;$i<count($explode_agents);$i++)
		{
		 	$array_agents[$counterVal] = $explode_agents[$i];
		 	$counterVal = $counterVal + 1;
		}
	//	print_r($array_agents);
       	$leadCountSql = "SELECT `RequestID`, `BidderID`, `leadid`, `Allocation_Date`, `old_bidderid`, `reallocation_archive`, Updated_Date, Feedback FROM `Req_Credit_Card_Sms` LEFT JOIN ".$allocation_table." on ".$allocation_table.".`AllRequestID`=Req_Credit_Card_Sms.`RequestID` WHERE Allocation_Date between '".$min_date."' AND '".$max_date."' AND ".$allocation_table.".BidderID= '".$agents."' AND Feedback='".$varCmbFeedback."' ORDER BY leadid ASC";//
     //  echo  $leadCountSql = "SELECT `RequestID`, `BidderID`, `leadid`, `Allocation_Date`, `old_bidderid`, `reallocation_archive`, Updated_Date FROM `Req_Credit_Card_Sms` LEFT JOIN ".$allocation_table." on ".$allocation_table.".`AllRequestID`=Req_Credit_Card_Sms.`RequestID` WHERE `leadid` in (SELECT `leadid` FROM `Req_Credit_Card_Sms` LEFT JOIN lead_allocate on lead_allocate.`AllRequestID`=Req_Credit_Card_Sms.`RequestID` WHERE Dated between '2017-06-01 00:00:00' AND '2017-06-05 23:59:59' AND lead_allocate.BidderID= '6299' AND Feedback='') ORDER BY leadid ASC";//
		//echo 	$leadCountSql."<br />";
					$leadCountQuery= $obj->fun_db_query($leadCountSql);
					$leadCount = $obj->fun_db_get_num_rows($leadCountQuery);
					//echo	"<br>Count - ".$leadCount;	
					//echo "<br>";	
					$rowFirst = $obj->fun_db_fetch_rs_object($leadCountQuery);
					$RequestID = $rowFirst->RequestID;
					$Feedback= $rowFirst->Feedback;
					$leadid = $rowFirst->leadid;
					$BidderID = $rowFirst->BidderID;
				//	echo $leadid." - ".$RequestID." - ".$BidderID."<br />";	
		//	die();		
					$getDetailsSql = "select BidderID,Allocation_Date,reallocation_archive  from ".$allocation_table." where  leadid='".$leadid."'";
					$getDetailsQuery= $obj->fun_db_query($getDetailsSql);
					$getDetailsRow= $obj->fun_db_fetch_rs_object($getDetailsQuery);
					$iBidderID = $getDetailsRow->BidderID;
					$iAllocation_Date = $getDetailsRow->Allocation_Date;
					$reallocation_archive = $getDetailsRow->reallocation_archive;
					
					if(strlen($reallocation_archive)>2) { $ireallocation_archive=$iBidderID.",".$reallocation_archive; } else { $ireallocation_archive=$iBidderID; }
					
					$updateSql = "update ".$allocation_table." set BidderID='".$array_agents[1]."', Allocation_Date=Now(), old_bidderid='".$iBidderID."', old_allocated_date='".$iAllocation_Date."', reallocation_archive='".$ireallocation_archive."' where leadid='".$leadid."' ";
					$updateTableQuery= $obj->fun_db_query($updateSql);
										
										
					$updateProductSql = "update Req_Credit_Card_Sms set Old_Feedback='".$Feedback."', Feedback='' where RequestID='".$RequestID."' ";
					$updateProductTableQuery= $obj->fun_db_query($updateProductSql);
					
					
					$updateLeadAllocationTableSql = "update lead_allocation_table set last_allocated_to='1', total_no_agents='".count($array_agents)."', total_lead_count='".$leadid."' where lead_allocation_logic='139' AND Citywise='CCREALLOCATION'";
					$updateLeadAllocationTableQuery= $obj->fun_db_query($updateLeadAllocationTableSql);
					//echo $updateLeadAllocationTableSql."<br>";
					
					//	echo "While LOOP Start <br />";	
					$i=1;
					$leads_array = '';	
					$leads_array[] =$leadid;			
					while($row = $obj->fun_db_fetch_rs_object($leadCountQuery))
					{
						$RequestID = $row->RequestID;
						$Feedback= $row->Feedback;
						$leadid = $row->leadid;
						$leads_array[] =$leadid;
						$BidderID = $row->BidderID;
						$Allocation_Date = $row->Allocation_Date;
						$old_bidderid= $row->old_bidderid;
						$reallocation_archive= $row->reallocation_archive;
						//echo $leadid." - ".$RequestID." - ".$BidderID."<br />";
											
						$sequenceidSql="Select last_allocated_to,total_no_agents From lead_allocation_table Where (lead_allocation_logic='139' AND Citywise='CCREALLOCATION')";
						$sequenceidQuery= $obj->fun_db_query($sequenceidSql);
						$sequenceidRow= $obj->fun_db_fetch_rs_object($sequenceidQuery);
						$last_allocated_to = $sequenceidRow->last_allocated_to;
						$total_no_agents = $sequenceidRow->total_no_agents;
						if($total_no_agents>$last_allocated_to)
						{
							$sequence=$last_allocated_to+1;
						}
						else
						{
							$sequence=1;
						}
						
						$getDetailsSql = "select BidderID,Allocation_Date,reallocation_archive  from ".$allocation_table." where  leadid='".$leadid."'";
						$getDetailsQuery= $obj->fun_db_query($getDetailsSql);
						$getDetailsRow= $obj->fun_db_fetch_rs_object($getDetailsQuery);
						$iBidderID = $getDetailsRow->BidderID;
						$iAllocation_Date = $getDetailsRow->Allocation_Date;
						$reallocation_archive = $getDetailsRow->reallocation_archive;
						if(strlen($reallocation_archive)>2) { $ireallocation_archive=$iBidderID.",".$reallocation_archive; } else { $ireallocation_archive=$iBidderID; }
						
						$updateSql = "update ".$allocation_table." set BidderID='".$array_agents[$sequence]."', Allocation_Date=Now(), old_bidderid='".$iBidderID."', old_allocated_date='".$iAllocation_Date."', reallocation_archive='".$ireallocation_archive."' where leadid='".$leadid."' ";
						$updateTableQuery= $obj->fun_db_query($updateSql);
						//echo $updateSql ."<br>";
						
						$updateProductSql = "update Req_Credit_Card_Sms set Old_Feedback='".$Feedback."', Feedback='' where RequestID='".$RequestID."' ";
						$updateProductTableQuery= $obj->fun_db_query($updateProductSql);

						
						$updateLeadAllocationTableSql = "update lead_allocation_table set last_allocated_to='".$sequence."', total_lead_count='".$leadid."' where lead_allocation_logic='139' AND Citywise='CCREALLOCATION'";
						$updateLeadAllocationTableQuery= $obj->fun_db_query($updateLeadAllocationTableSql);
						//echo $updateLeadAllocationTableSql."<br>";
						
						$i=$i+1;
						
					}
					
					$leadsStr = implode(',', $leads_array);
					$leadCountSql = "select count(*) as countLeads, BidderID as allocatedAgentID FROM ".$allocation_table." WHERE leadid in (".$leadsStr.") GROUP BY BidderID";
					$leadCountQuery = $obj->fun_db_query($leadCountSql);
					while($leadCountRow= $obj->fun_db_fetch_rs_object($leadCountQuery))
					{
						$allocatedAgentID= $leadCountRow->allocatedAgentID;
						$countLeads = $leadCountRow->countLeads;
					?>	
					
					 <tr><td align="center" valign="middle" class="bidderclass"><strong><?php echo $allocatedAgentID; ?></strong></td><td align="center" valign="middle" class="bidderclass"><strong><?php echo $countLeads; ?></strong></td></tr>

					<?php		
					}
	
					?>
					</table>
					
                  </td>
                </tr>
			<tr>
                  <td align="center" colspan="4">
                 
                  
                  </td>
                </tr>

              
            </table>
            <p>&nbsp;</p>
     

          </div></td>
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
