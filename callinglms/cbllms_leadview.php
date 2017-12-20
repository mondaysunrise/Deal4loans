<?php
require_once("includes/application-top-inner.php");

if(($_SESSION["BidderID"]!==base64_decode($_REQUEST['BidderIDstatic'])) && ISSET($_REQUEST['BidderIDstatic']))
{
	session_unset();
	session_destroy();
	echo "Not a Valid User";
	echo '<meta http-equiv="refresh" content="5; URL=http://www.deal4loans.com/callinglms/lmslogin.php">';
	die(); 
}
//print_r($_POST);
$postid = $_REQUEST["postid"];
$biddt = $_REQUEST["biddt"];
$BidderIDstatic="";
	if(isset($_REQUEST['BidderIDstatic']) && strlen($_REQUEST['BidderIDstatic'])>0 )
	{
		 $BidderIDstatic=base64_decode($_REQUEST['BidderIDstatic']);
		// $_SESSION["BidderID"] = base64_decode($BidderIDstatic);
	}
	else
	{
		$BidderIDstatic=$_SESSION["BidderID"];
	}
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		foreach($_POST as $a=>$b)
			$$a=$b;
		$Feedback = $_POST["plfeedback"];
		$FollowupDate = $_POST["FollowupDate"];
		$pladd_comment = $_POST["pladd_comment"];

		if(strlen(trim($postid))>0)
		{
			$strSQL="";
			$Msg="";
			$fbqry="select id from wf_lead_allocate where leadid=$postid and callerid=".$biddt." AND product=15";
			$result = $obj->fun_db_query($fbqry);	
					
			$num_rows = $obj->fun_db_get_num_rows($result);
			if($num_rows > 0)
			{
				$row = $obj->fun_db_fetch_rs_array($result);
				$strSQL="Update wf_lead_allocate Set feedback='".$Feedback."', followup_date='".$FollowupDate."', comments='".$pladd_comment."' ";
				$strSQL=$strSQL."Where id=".$row["id"];
			}
			else
			{
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
		</script>
		<script type="text/JavaScript">
function killCopy(e){ return false; }
function reEnable(){return true; }
document.onselectstart=new Function ("return false");
if (window.sidebar){ document.onmousedown=killCopydocument.onclick=reEnable }
function clickIE4(){if (event.button==2){ return false; } }
function clickNS4(e){ if (document.layers||document.getElementById&&!document.all){ if (e.which==2||e.which==3){ return false;} } }
if (document.layers){ document.captureEvents(Event.MOUSEDOWN); document.onmousedown=clickNS4; } else if (document.all&&!document.getElementById){ document.onmousedown=clickIE4; }
document.oncontextmenu=new Function("return false")
</script>
		<!--DatePicker End-->
		</head>
		<body style="margin:0px 0px 0px 0px; padding:0px 0px 0px 0px; background-color:#45B2D8;">
<?php 
$viewqry="select first_name, middle_name, last_name, gender, date_of_birth, mobile_number, email_id, pancard, is_pancard_kyc, residence_address, residence_pincode, city_name, state_code, legal_response, cibil_score, cibil_score_fetch_date from xkyknzl5dwfyk4hg_cibil where id=".$postid." "; 
//echo "dd".$viewqry;
$viewlead = $objwf->fun_db_query($viewqry);
$viewleadscount =$objwf->fun_db_get_num_rows($viewlead);
$first_name = $objwf->fun_get_mysql_result($viewlead,0,'first_name');
$middle_name = $objwf->fun_get_mysql_result($viewlead,0,'middle_name');
$last_name = $objwf->fun_get_mysql_result($viewlead,0,'last_name');
$full_name= $first_name." ".$middle_name." ".$last_name;
$gender = $objwf->fun_get_mysql_result($viewlead,0,'gender');
$date_of_birth = $objwf->fun_get_mysql_result($viewlead,0,'date_of_birth');
$mobile_number = $objwf->fun_get_mysql_result($viewlead,0,'mobile_number');
$email_id = $objwf->fun_get_mysql_result($viewlead,0,'email_id');
$pancard = $objwf->fun_get_mysql_result($viewlead,0,'pancard');
$is_pancard_kyc = $objwf->fun_get_mysql_result($viewlead,0,'is_pancard_kyc');
$residence_address = $objwf->fun_get_mysql_result($viewlead,0,'residence_address');
$residence_pincode = $objwf->fun_get_mysql_result($viewlead,0,'residence_pincode');
$city_name = $objwf->fun_get_mysql_result($viewlead,0,'city_name');
$state_code = $objwf->fun_get_mysql_result($viewlead,0,'state_code');
$cibil_score = $objwf->fun_get_mysql_result($viewlead,0,'cibil_score');
$cibil_score_fetch_date = $objwf->fun_get_mysql_result($viewlead,0,'cibil_score_fetch_date');
?>
<!-- End Main Banner Menu Panel -->
<div style="width:100%; background: #CCC; padding:0px 0px 10px 0px;"><div style="background:#F00; width:40px; padding-left:7px; line-height:30px; height:30px; float:right; margin-right:50px; margin-top:7px; border-radius:20%;"><a href="logout.php" style="color:#FFF; text-align:center; text-decoration:none; font-size:12px;">Logout</a></div>
<div style="clear:both;"></div>
</div>
<div style="clear:both; height:15px;"></div>
<!--`first_name`, `middle_name`, `last_name`, `gender`, `date_of_birth`, `mobile_number`, `email_id`, `pancard`, `is_pancard_kyc`, `residence_address`, `residence_pincode`, `city_name`, `state_code`, `legal_response`, `cibil_score`, `cibil_score_fetch_date`,-->
 <div style="background:#FFF;">  <form name="loan_form" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>?postid=<? echo $postid; ?>&biddt=<? echo $biddt;?>" >
<input type="hidden" name="biddt" value="<? echo $biddt; ?>">
<input type="hidden" name="postid" id="postid" value="<? echo $postid; ?>">
  <table style='border:1px dotted #9C9A9C;' cellspacing="2" cellpadding="5" width="600" height="80%" align="center" border="0" >
      <tr>
      <td style="border:1px solid black;" colspan="4" bgcolor="#DAEAF9" align="center" class="fontstyle" ><b>Personal Details</b></td>
    </tr>
    <tr>
      <td class="fontstyle" width="92"><b> Name</b></td>
      <td class="fontstyle" width="212"><?php echo $full_name; ?></td>
      <td class="fontstyle" width="75"><b>Gender</b></td>
      <td class="fontstyle" width="169"><?php if($gender==2) { echo "Female"; } else
	  {
		  echo "Male";
	  } ?></td>
    </tr>
    <tr>
		<td class="fontstyle"><b>DOB</b></td>
      <td class="fontstyle"><?php echo $date_of_birth; ?></td>
      <td class="fontstyle"><b>Mobile</b></td>
      <td class="fontstyle">+91<?php echo $mobile_number; ?></td>
    </tr>
	<tr>
	<td class="fontstyle" width="75"><b>Email id</b></td>
	<td class="fontstyle" width="169"><?php echo $email_id; ?></td>
	<td class="fontstyle" width="75"><b>Pancard</b></td>
	<td class="fontstyle" width="169"><?php echo $pancard; ?></td>
	</tr>

    <tr>
      <td class="fontstyle"><b>City</b></td>
      <td class="fontstyle"><?php echo $city_name; ?></td>
      <td class="fontstyle"><b>State</b></td>
      <td class="fontstyle"><?php echo $state_code; ?></td>
    </tr>
    <tr>
      <td class="fontstyle"><b>Residence Address</b></td>
      <td colspan="2" class="fontstyle"><?php echo $residence_address; ?></td>
      <td class="fontstyle"><b>Residence Pincode</b></td>
      <td colspan="2" class="fontstyle"><?php echo $residence_pincode; ?></td>
    </tr>
     <tr>
      <td class="fontstyle"><b>Cibil Score</b></td>
      <td colspan="2" class="fontstyle"><?php echo $cibil_score; ?></td>
      <td class="fontstyle"><b>Is KYC</b></td>
      <td colspan="2" class="fontstyle"><?php echo $is_pancard_kyc; ?></td>
    </tr>
    <tr>
      <td class="fontstyle"><b>Feedback</b></td>
      <td class="fontstyle"><?php
	$getFedbackQuery = $obj->fun_db_query("select feedback, followup_date, comments from wf_lead_allocate where leadid='".$postid."'and product=15");
	$num_rows = $obj->fun_db_get_num_rows($getFedbackQuery);
		if($num_rows > 0)
		{
			$Feedback = $obj->fun_get_mysql_result($getFedbackQuery,0,'feedback');
			$Followup_Date = $obj->fun_get_mysql_result($getFedbackQuery,0,'followup_date');
			$comments = $obj->fun_get_mysql_result($getFedbackQuery,0,'comments');
		}
	?>
        <select name="plfeedback" id="feedback">
          <option value="" <?if($Feedback == "") { echo "selected"; }?>>No Feedback</option>
          <option value="Other Product" <?if($Feedback == "Other Product") { echo "selected"; }?>>Other Product</option>
          <option value="Not Interested" <?if($Feedback == "Not Interested") { echo "selected"; }?>>Not Interested</option>
          <option value="Callback Later" <?if($Feedback == "Callback Later") { echo "selected"; }?>>Callback Later</option>
          <option value="Wrong Number" <?if($Feedback == "Wrong Number") { echo "selected"; }?>>Wrong Number</option>
          <option value="Send Now" <?if($Feedback == "Send Now") { echo "selected"; }?>>Send Now</option>
          <option value="Not Eligible" <?if($Feedback == "Not Eligible") { echo "selected"; }?>>Not Eligible</option>
          <option value="Duplicate" <?if($Feedback == "Duplicate") { echo "selected"; }?>>Duplicate</option>
          <option value="Not Contactable" <?if($Feedback == "Not Contactable") { echo "selected"; }?>>Not Contactable</option>
          <option value="Ringing" <?if($Feedback == "Ringing") { echo "selected"; }?>>Ringing</option>
          <option value="FollowUp" <?if($Feedback == "FollowUp") { echo "selected"; }?>>FollowUp</option>
          <option value="Not Applied" <?if($Feedback == "Not Applied") { echo "selected"; }?>>Not Applied</option>
        </select></td>
      <td class="fontstyle"><b>Follow Up Date</b></td>
      <td class="fontstyle">
        <input type="Text"  name="FollowupDate" id="FollowupDate" maxlength="25" size="15" <?php if($Followup_Date !='0000-00-00 00:00:00') { ?>value="<?php  echo $Followup_Date; ?>" <?php } ?>>
        <a href="javascript:NewCal('FollowupDate','yyyymmdd',true,24)"><img src="../images/cal.gif" width="16" height="16" border="0" alt="Pick a date"></a></td>
    </tr>
        <tr>
      <td colspan="2"></td>
      <td><b>Add Comment</b></td>
      <td><textarea rows="2" cols="20" name="pladd_comment" id="pladd_comment" ><? echo $comments; ?></textarea></td>
    </tr>
    <tr>
      <td colspan="4" align="center"><input type="submit" class="bluebutton" value="Submit"></td>
    </tr>
    <tr>
      <td colspan="4" align="right">
      <?php
      //sccl.first_dated > DATE_SUB(NOW(), INTERVAL 180 DAY)
		$checkCCSql = "select RequestID, source from Req_Credit_Card where ((`Mobile_Number` = '".$mobile_number."' ";
		if(!empty($pancard))
		{
			$checkCCSql .= " OR (`Pancard` = '".$pancard."') ";
		}
		$checkCCSql .= ") AND source='wf_zbl_leads' AND Updated_Date>'2017-11-25 00:00:00')";
		//echo $checkCCSql."<br>";
		$checkCCQuery = $obj->fun_db_query($checkCCSql);
		$checkCCCount =$obj->fun_db_get_num_rows($checkCCQuery);
		if($checkCCCount>0)
		{
			$source= $obj->fun_get_mysql_result($checkCCQuery,0,'source');
			$RequestID= $obj->fun_get_mysql_result($checkCCQuery,0,'RequestID');
			if($source=='wf_zbl_leads')
			{
				$location = "/sbiccleadlms-details.php?postid=".urlencode($RequestID)."&biddt=".$BidderIDstatic;
				//header ("Location: ".$location);
				?>
				<a href="<?php echo $location; ?>" target="_blank">Credit Card</a>
				<?php
			}
			
		}
		else {
				$checkCCSql = "select RequestID, source from Req_Credit_Card where ((Updated_Date > DATE_SUB(NOW(), INTERVAL 30 DAY)) AND (`Mobile_Number` = '".$mobile_number."' ";
				if(!empty($pancard))
				{
					$checkCCSql .= " OR (`Pancard` = '".$pancard."') ";
				}
				$checkCCSql .= "))";
				//echo $checkCCSql."<br>";
				$checkCCQuery = $obj->fun_db_query($checkCCSql);
				$checkCCCount =$obj->fun_db_get_num_rows($checkCCQuery);
				if($checkCCCount>0)
				{
					$source= $obj->fun_get_mysql_result($checkCCQuery,0,'source');
					$RequestID= $obj->fun_get_mysql_result($checkCCQuery,0,'RequestID');
				/*	if($source=='wf_zbl_leads')
					{
						$location = "/sbiccleadlms-details.php?postid=".urlencode($RequestID)."&biddt=".$BidderIDstatic;
						//header ("Location: ".$location);
						*/
						?>
				<!--		<a href="<?php echo $location; ?>" target="_blank">Credit Card</a>-->
						<?php
				//	}
					
					
				}
				else {		
		
					$checkAmexSql = "select cc_requestid as RequestID FROM `credit_card_banks_apply` WHERE (`applied_bankname` like '%American%' AND request_data != '' AND ((request_data LIKE '%<tem:MOBILE>".$mobile_number."</tem:MOBILE>%') ";
					if(!empty($pancard))
					{
						$checkAmexSql .= " OR (request_data LIKE '%<tem:PANCARD>".$pancard."</tem:PANCARD>%') ";
					}
					$checkAmexSql .= ") AND (last_updated > DATE_SUB(NOW(), INTERVAL 30 DAY))) DESC limit 0,1";
					$checkAmexQuery = $obj->fun_db_query($checkAmexSql);
					$checkAmexCount =$obj->fun_db_get_num_rows($checkAmexQuery);
				//	echo "<br>".$checkAmexSql."<br>";
					if($checkAmexCount>0) {} else
					{ ?>
						<a href="/cibilToCreditCardEntry.php?postid=<? echo urlencode($postid); ?>&biddt=<? echo $BidderIDstatic;?>&cardcc=Amex" target="_blank">Amex Credit Card</a>
					<?php
					}	
					$checkSBISql = "select RequestID FROM `sbi_credit_card_5633` WHERE ( request_xml != '' AND ((request_xml LIKE '%<Mobile>".$mobile_number."</Mobile>%') ";
					
		//			select cc_requestid, COUNT(cc_requestid) AS c FROM `webservice_log_sbi` GROUP BY cc_requestid HAVING C < 2 ) as temp) AND response_xml = '' AND request_xml LIKE '%".$RequestID."%' AND request_xml LIKE '%".$PAN."%'
					
					if(!empty($pancard))
					{
						$checkSBISql .= " OR (request_xml LIKE '%<PAN>".$pancard."</PAN>%') ";
					}
					$checkSBISql .= ") AND (first_dated > DATE_SUB(NOW(), INTERVAL 180 DAY)))  order by sbiccid DESC limit 0,1";
					$checkSBIQuery = $obj->fun_db_query($checkSBISql);
					$checkSBICount =$obj->fun_db_get_num_rows($checkSBIQuery);
					//echo "<br>".$checkSBISql."<br>";
					if($checkSBICount>0) {} else
					{ ?>
						 <a href="/cibilToCreditCardEntry.php?postid=<? echo urlencode($postid); ?>&biddt=<? echo $BidderIDstatic;?>&cardcc=SBI"  target="_blank">SBI Credit Card</a>
					<?php
					}
				}
		}
      
      ?>
      
      
      </td>
    </tr>
    

    
  </table>
</form>		  
           </div>
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
