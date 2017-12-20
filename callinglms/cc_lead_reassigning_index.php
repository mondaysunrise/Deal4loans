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


function chkform()
{
	var ss=document.frmsearch.min_date.value;
	
	if(document.frmsearch.min_date.value=="")
	{
		alert("Sorry!!!! Please Enter Minimum date.");
		document.frmsearch.min_date.value="";
		document.frmsearch.min_date.focus();
		return false;
	}

	if(ss.length<10 || ss.length>10)
	{
		alert("Please fill correct date in YYYY-MM-DD format");
		document.frmsearch.min_date.value="";
		document.frmsearch.min_date.focus();
		return false;
	}
	

	if(document.frmsearch.max_date.value=="")
	{
		alert("Sorry!!!! Please Enter Maximum date.");
		document.frmsearch.max_date.value="";
		document.frmsearch.max_date.focus();
		return false;
	}
	
	if(document.frmsearch.agents.value=="")
	{
		alert("Sorry!!!! Please Select Agent from where you want to shift Lead.");
		document.frmsearch.agents.focus();
		return false;
	}

	if(document.frmsearch.shift_agents.value=="")
	{
		alert("Sorry!!!! Please Select Agent to which you want to shift Lead.");
		document.frmsearch.shift_agents.focus();
		return false;
	}
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
        <td align="center">
       
        </td>
      </tr>
              <tr>
        <td align="center" width="100%"><div align="center">
            <table width="900" border="0" cellpadding="4" cellspacing="6" class="blueborder" bgcolor="#FFFFFF">
              <form name="frmsearch" action="cc_lead_reassigning_continue.php" method="post" onSubmit="return chkform();">
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
                  <td style="text-align:right; width: 23%;"><strong>To </strong><input name="max_date" type="text" id="max_date" size="15" value="<? echo $_REQUEST['max_date']; ?>"></td>
                  <td><strong>Feedback:</strong> <select name="cmbfeedback" id="cmbfeedback">
                      <option value="" <? if($varCmbFeedback == "") { echo "selected"; } ?>>
					  No Feedback</option>
					  <option value="Ringing" <? if($varCmbFeedback == "Ringing") { echo "selected"; } ?>>
					  Ringing</option>
                    </select></td>
                </tr>
          
                <tr>
                  <td align="center"  valign="middle" class="bidderclass" colspan="2">
				  <strong>Agents</strong></td><td align="center"  valign="middle" class="bidderclass" colspan="2">
					<strong>Shift Leads to Agents</strong></td></tr>
                 <tr> <td colspan="2" valign="top" align="center"><select name="agents" id="agents">
		
		<option value="">Select</option>
		<?php
		$getExpertsActiveBiddersSql = "select BidderID,Associated_Bank,Status from Bidders where leadidentifier in ('diallerleadccsmsnew')";
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
			<option value="<?php echo $BidderID; ?>" <? if($BidderID==$agents) echo "selected"; ?> <?php if($Status==1) { ?> style="font-weight:bold;" <?php } ?>><?php echo $BidderID ; ?> 
			(<?php echo $statusValue; ?>)</option>
			<?php
		}
	?>
	</select></td>
                  
                  <td colspan="2" align="center">
                  
                  <select name="shift_agents[]" id="shift_agents" multiple="multiple" style="height:200px;" >
		
		<option value="" selected="selected">Select</option>
	

<?php
		$getExpertsActiveBiddersSql = "select BidderID,Associated_Bank,Status from Bidders where leadidentifier in ('diallerleadccsmsnew') AND Status=1";
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
			<option value="<?php echo $BidderID; ?>" <? if($BidderID==$agents) echo "selected"; ?> <?php if($Status==1) { ?> style="font-weight:bold;" <?php } ?>><?php echo $BidderID ; ?> 
			(<?php echo $statusValue; ?>)</option>
			<?php
		}
	?>
	</select>
                  </td>
                </tr>
			<tr>
                  <td align="center" colspan="4"><input name="Submit" type="submit" class="bluebutton" value="Submit" border="0"></td>
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
