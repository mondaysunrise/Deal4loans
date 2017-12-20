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
		$array_without_initial_agent = array_diff($shift_agents, array($agents));
		$display_agents = implode(',', $array_without_initial_agent);
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
              <form name="frmsearch" action="cc_lead_reassigning_leads.php" method="post" onSubmit="return chkform();">
               <input name="agents" type="hidden" id="agents" value="<? echo $agents; ?>" >
               <input name="cmbfeedback" type="hidden" id="cmbfeedback" value="<? echo $varCmbFeedback; ?>" >
                <input name="shift_agents" type="hidden" id="shift_agents"  value="<? echo $display_agents; ?>" >
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
                  <td style="width: 37%"><strong>From <?php echo $min_date; ?>
                    <input name="min_date" type="hidden" id="min_date" size="15" value="<? echo $min_date; ?>" >
				  </strong><br />
                  <strong>To </strong><?php echo $max_date;?>
<input name="max_date" type="hidden" id="max_date" size="15" value="<? echo $max_date; ?>" readonly="readonly">&nbsp;&nbsp;&nbsp; </td>
                  <td><strong>Feedback:</strong> <?php echo $varCmbFeedback; ?></td>
                </tr>
          
                <tr>
                  <td align="center" valign="middle" class="bidderclass" colspan="2">
				  <strong>Agents</strong></td><td align="center"  valign="middle" class="bidderclass" colspan="2">
					<strong>Shift Leads to Agents</strong></td></tr>
                 <tr> <td colspan="2" valign="top" align="center">
					<?php echo $agents;
					$min_date=$min_date." 00:00:00";
					$max_date=$max_date." 23:59:59";
		
					$leadCountSql = "SELECT `RequestID`, `Name`, `Employment_Status`, `City`, `Mobile_Number`, `Pancard`, Updated_Date,BidderID FROM `Req_Credit_Card_Sms` left join ".$allocation_table." on ".$allocation_table.".`AllRequestID`=Req_Credit_Card_Sms.`RequestID` WHERE Allocation_Date between '".$min_date."' AND '".$max_date."' AND ".$allocation_table.".BidderID= '".$agents."' AND Feedback='".$varCmbFeedback."'";//
					$leadCountQuey= $obj->fun_db_query($leadCountSql);
					$leadCount = $obj->fun_db_get_num_rows($leadCountQuey);
					echo "<br />";
					echo "Lead Count - ".$leadCount;

 ?></td>
                  
                  <td colspan="2" align="center">
                  	<?php echo $display_agents; ?>
                  </td>
                </tr>
			<tr>
                  <td align="center" colspan="4">
                  <?php
                  if($leadCount>500 || $leadCount==0 || count($array_without_initial_agent)==0 ) { 
                   ?>
                   You can re-churn Maximum 500 leads.
                   <?php
                   }
                   else
                   {
                  
                  ?>
                  <input name="Submit" type="submit" class="bluebutton" value="Submit" border="0">
                  <?php } ?>
                  <br /><br /><br /><br /><br />
                  <a href="cc_lead_reassigning_index.php" >Go Back to Select Again</a>
                  </td>
                </tr>

              </form>
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
