<?php
ini_set('max_execution_time', 300);
require 'scripts/session_check_onlinelms.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';
$maxage=date('Y')-62;
$minage=date('Y')-18;

function DetermineAgeFromDOB ($YYYYMMDD_In)
{
  $yIn=substr($YYYYMMDD_In, 0, 4);
  $mIn=substr($YYYYMMDD_In, 4, 2);
  $dIn=substr($YYYYMMDD_In, 6, 2);

  $ddiff = date("d") - $dIn;
  $mdiff = date("m") - $mIn;
  $ydiff = date("Y") - $yIn;

  // Check If Birthday Month Has Been Reached
  if ($mdiff < 0)
  {
    // Birthday Month Not Reached
    // Subtract 1 Year From Age
    $ydiff--;
  } elseif ($mdiff==0)
  {
    // Birthday Month Currently
    // Check If BirthdayDay Passed
    if ($ddiff < 0)
    {
      //Birthday Not Reached
      // Subtract 1 Year From Age
      $ydiff--;
    }
  }
  return $ydiff;
}

$post=$_REQUEST['id'];
$bidid =$_REQUEST['Bid'];

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	foreach($_POST as $a=>$b)
		$$a=$b;
	/* FIX STRINGS */
	$comment_section = $_POST["comment_section"];
	$hlfeedback = $_POST["hlfeedback"];
	$FollowupDate = $_POST["FollowupDate"];
	$bidid = $_POST["BidderId"];
	$post = $_POST["hlrequestid"];
	//$checked_bidders = trim($_POST["hlrequestid"]);
	$managerdetails = explode("_",trim($_POST["managerid"]));
	$managerid = $managerdetails[0];
	$managermobile = $managerdetails[1];
	$manageremail = $managerdetails[2];
	$managername = $managerdetails[3];
	$Name = trim($_POST["hlname"]);
	$AnnualIncome = trim($_POST["hlnet_salary"]);
	$LoanAmount = trim($_POST["hlloanamt"]);
	$Phone = trim($_POST["hlmobile"]);
	$SelectedBank = trim($_POST["checked_bidders"]);
	$callerBidname=trim($_POST["callerBidname"]);
	$select_aro=trim($_POST["select_aro"]);
	$allocated_bidder=trim($_POST["allocatedBidder"]);

	if(strlen($hlfeedback)>0 || strlen($comment_section)>0)
	{
		$strSQL="";
		$Msg="";
		
			$result = ExecQuery("select FeedbackID from Req_Feedback_HL where AllRequestID=".$post." and BidderID=".$bidid." AND Reply_Type=2");
			$num_rows = mysql_num_rows($result);
			if($num_rows > 0)
			{
				$row = mysql_fetch_array($result);
				$strSQL="Update Req_Feedback_HL Set Feedback='".$hlfeedback."' ,comment_section='".$comment_section."', Followup_Date='".$FollowupDate."',BidderID='".$bidid."',last_update_dated=NOW()";
				$strSQL=$strSQL." Where FeedbackID=".$row["FeedbackID"];
			}
			else
			{
				$strSQL="Insert into Req_Feedback_HL(AllRequestID, BidderID, Reply_Type , Feedback, Followup_Date,comment_section,last_update_dated) Values (";
				$strSQL=$strSQL.$post.",".$bidid.",2,'".$hlfeedback."','".$FollowupDate."','".$comment_section."',NOW())";
			}
		
		$result = ExecQuery($strSQL);
		if ($result == 1)
		{
		}
		else
		{
			$Msg = "** There was a problem in adding your feedback. Please try again.";
		}

		$strfbSQL="";
		$Msg="";
		$mindate=date('Y-m-d')." 00:00:00";
		$maxdate=date('Y-m-d')." 23:59:59";
		$resultfb = ExecQuery("select feedbkid from feedback_bookkeeping where (AllRequestID=".$post." and BidderID=".$bidid." AND Reply_Type=2 and Feedback='".$hlfeedback."' and Comments='".$comment_section."' and Followup_Date='".$FollowupDate."')");	
		$fbnum_rows = mysql_num_rows($resultfb);
		if($fbnum_rows > 0)
		{
			$fbrow = mysql_fetch_array($resultfb);
			$strfbSQL="Update feedback_bookkeeping Set Feedback='".$hlfeedback."' ,Comments='".$comment_section."', Followup_Date='".$FollowupDate."', Dated=Now()";
			$strfbSQL=$strfbSQL." Where feedbkid=".$fbrow["feedbkid"];
		}
		else
		{
			$strfbSQL="Insert into feedback_bookkeeping(AllRequestID, BidderID, Reply_Type , Feedback, Followup_Date, Comments, leadidentifier, Dated) Values (";
			$strfbSQL=$strfbSQL.$post.",".$bidid.",2,'".$hlfeedback."','".$FollowupDate."','".$comment_section."','".$leadidentifier."', Now())";
		}

		$fbresult = ExecQuery($strfbSQL);
		if ($fbresult == 1)
		{}
		else
		{
			$Msg = "** There was a problem in adding your feedback. Please try again.";
		}
	}

	echo $leadidentifier;
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">
.heading-customer{ font-family:Arial, Helvetica, sans-serif; font-size:18px; color:#FFF;}
body{ font-family:Arial, Helvetica, sans-serif;}
tr td {font-size:12px;}
td { padding:5px;}
</style>
<link rel="stylesheet" type="text/css" href="css/menu.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link href="includes/style.css" rel="stylesheet" type="text/css">
<script language="javascript" type="text/javascript" src="scripts/datetime.js"></script>
<script language="javascript" type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<link rel="stylesheet" type="text/css" href="callinglms/css-datepicker/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="callinglms/css-datepicker/datepicker.css">
<link rel="stylesheet" type="text/css" href="css-datetimepicker/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="css-datetimepicker/jquery-ui-timepicker-addon.css">
<script src="callinglms/js-datepicker/jquery-1.5.1.js"></script>
<script src="callinglms/js-datepicker/jquery.ui.core.js"></script>
<script src="callinglms/js-datepicker/jquery.ui.datepicker.js"></script>
<script src="js-datetimepicker/jquery-ui-timepicker-addon.js"></script>
<script> 
	$(function() {
		/*$("#FollowupDate").datepicker({
			defaultDate: "today",
			changeMonth: true,
			changeYear: true,
			numberOfMonths: 1,
			minDate:0
		});*/
		
		$("#FollowupDate").datetimepicker({  
			defaultDate: "today",
			changeMonth: true,
			changeYear: true,
			numberOfMonths: 1,
			minDate:0,
			timeFormat: 'hh:mm:ss',
			onSelect: function() {
				var selectedFollowUpDate = $(this).val();
				selectedFollowUpDate = selectedFollowUpDate.substring(0,10);
				$.ajax({
					url: 'hllmsallocate_editlead.php',
					type: 'POST',
					data: {
						method: 'FollowUpCount',
						selectedFollowUpDate: selectedFollowUpDate,
						bidder : '<?php echo $bidid; ?>',
					},
					success: function(response){
						//console.log(response);
						alert('Total FollowUp\'s are '+response);
					}
				});
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
<script>
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

function forsendmail()
{
	var new_type = document.getElementById('CCmailertype').value;
	var new_request = document.getElementById('hlrequestid').value;
	var new_name = document.getElementById('hlname').value;
	var new_email = document.getElementById('hlemail').value;
	if((new_name!=""))
	{
		var queryString = "?Name=" + new_name + "&Email="+ new_email + "&Type=" + new_type + "&Request=" + new_request ;
		//alert(queryString); 
		ajaxRequest.open("GET", "sendHlemail.php" + queryString, true);
		// Create a function that will receive data sent from the server
		ajaxRequest.onreadystatechange = function(){
			if(ajaxRequest.readyState == 4)
			{						
				var ajaxDisplay = document.getElementById('CCajaxDiv');
				ajaxDisplay.innerHTML = "sent";
			}
		}

		ajaxRequest.send(null); 
	 }
}

function forsendsms()
{
	var new_type = document.getElementById('HLmailertype').value;
	var new_request = document.getElementById('hlrequestid').value;
	var new_name = document.getElementById('hlname').value;
	var new_email = document.getElementById('hlemail').value;

	if((new_name!=""))
	{
		var queryString = "?Name=" + new_name + "&Email="+ new_email + "&Type=" + new_type + "&Request=" + new_request ;
		//alert(queryString); 
		ajaxRequest.open("GET", "sendHlemail.php" + queryString, true);
		// Create a function that will receive data sent from the server
		ajaxRequest.onreadystatechange = function(){
			if(ajaxRequest.readyState == 4)
			{
				var ajaxDisplay = document.getElementById('HLajaxDiv');
				ajaxDisplay.innerHTML = "sent";
			}
		}
		ajaxRequest.send(null); 
	 }
}
window.onload = ajaxFunction;
</script>
<script>
function chkhomeloan(Form)
{
	var space=/^[\ ]*$/;
	var num=/^[0-9]*$/;
	//alert("hello");
	if((Form.day.value!="") && (Form.month.value!="") && (Form.year.value!=""))
	{
		if((space.test(Form.day.value)) || (Form.day.value=="dd"))
		{
			alert("Kindly enter your Date of Birth");
			Form.day.select();
			return false;
		}
		else if(!num.test(Form.day.value))
		{
			alert("Kindly enter your Date of Birth(numbers Only)");
			Form.day.select();
			return false;
		}
		else if((Form.day.value<1) || (Form.day.value>31))
		{
			alert("Kindly Enter your valid Date of Birth(Range 1-31)");
			Form.day.select();
			return false;
		}
		else if((space.test(Form.month.value)) || (Form.month.value=="mm"))
		{
			alert("Kindly enter your Month of Birth");
			Form.month.select();
			return false;
		}
		else if(!num.test(Form.month.value))
		{
			alert("Kindly enter your Month of Birth(numbers Only)");
			Form.month.select();
			return false;
		}
		else if((Form.month.value<1) || (Form.month.value>12))
		{
			alert("Kindly Enter your valid Month of Birth(Range 1-12)");
			Form.month.select();
			return false;
		}
		else if((Form.month.value==2) && (Form.day.value>29))
		{
			alert("Month February cannot have more than 29 days");
			Form.day.select();
			return false;
		}
		else if((space.test(Form.year.value)) || (Form.year.value=="yyyy"))
		{
			alert("Kindly enter your Year of Birth");
			Form.year.select();
			return false;
		}
		else if(!num.test(Form.year.value))
		{
			alert("Kindly enter your Year of Birth(numbers Only) !");
			Form.year.select();
			return false;
		}
		else if((Form.day.value > 28) && (parseInt(Form.month.value)==2) && ((Form.year.value%4) != 0))
		{
			alert("February cannot have more than 28 days.");
			Form.day.select();
			return false;
		}
		else if((parseInt(Form.day.value)==31) && ((parseInt(Form.month.value)==4)||(parseInt(Form.month.value)==6)||(parseInt(Form.month.value)==9)||(parseInt(Form.month.value)==11)||(parseInt(Form.month.value)==2)))
		{
			alert("this month Cannot have 31st Day");Form.day.select();
			return false;
		}
		else if(Form.year.value.length != 4)
		{
			alert("Kindly enter your correct 4 digit Year of Birth.(Numeric ONLY)!");
			Form.year.select();
			return false;
		}
		else if(Form.year.value > parseInt(mdate-21) || Form.year.value < parseInt(mdate-62))
		{
			alert("Age Criteria! \n Applicants between age group 21 - 62 only are elgibile.");
			Form.year.select();
			return false;
		}
	}
}

</script>
<STYLE>
a
{
	cursor:pointer;
}
.bluebutton {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: blue;
	font-weight: bold;
}
</style>
</head>
<body >
<!--<p align="center"><b>Home loan Lead Details </b></p>-->
<?php 

		$viewqry="select comment_section,CC_Bank,Creative, Referral_Flag,Property_Value,Co_Applicant_Name,Co_Applicant_DOB,Co_Applicant_Income ,Co_Applicant_Obligation,Total_Obligation,Req_Loan_Home.checked_bidders,Req_Loan_Home.Tataaig_Auto,Req_Loan_Home.Tataaig_Health,Req_Loan_Home.Company_Name, Req_Loan_Home.Dated,Req_Loan_Home.Name,Req_Loan_Home.Accidental_Insurance,Req_Loan_Home.source,Req_Loan_Home.Referrer,Req_Loan_Home.Add_Comment,Req_Loan_Home.Landline,Req_Loan_Home.Std_Code,Req_Loan_Home.Residence_Address,Req_Loan_Home.Net_Salary,Req_Loan_Home.Sms_Sent,Req_Loan_Home.Email_Sent,Req_Loan_Home.Landline_O,Req_Loan_Home.Std_Code_O,Req_Loan_Home.Mobile_Number,Req_Loan_Home.Employment_Status,Req_Loan_Home.City,Req_Loan_Home.City_Other, Req_Loan_Home.PL_Bank, Req_Loan_Home.Loan_Amount, Req_Loan_Home.Email,Req_Loan_Home.DOB,Req_Loan_Home.Budget,Req_Loan_Home.Property_Loc,Req_Loan_Home.Pincode,Req_Loan_Home.Loan_Time,Req_Loan_Home.Hl_mailer,Req_Loan_Home.Property_Identified,Req_Feedback_HL.Feedback,Req_Feedback_HL.BidderID,Req_Feedback_HL.Followup_Date,Req_Loan_Home.Bidderid_Details,Req_Loan_Home.Existing_Loan,Req_Loan_Home.Existing_Bank ,Req_Loan_Home.Existing_ROI from Req_Loan_Home LEFT OUTER JOIN Req_Feedback_HL ON Req_Feedback_HL.AllRequestID=Req_Loan_Home.RequestID and Req_Feedback_HL.BidderID in (".$bidid.") where Req_Loan_Home.RequestID=".$post."  order by FeedbackID DESC Limit 0,1";
	
	//echo "dd".$viewqry;
	$viewlead = ExecQuery($viewqry);
	$viewleadscount =mysql_num_rows($viewlead);
	$Name = mysql_result($viewlead,0,'Name');
	$Company_Name = mysql_result($viewlead,0,'Company_Name');
	$Hl_mailer = mysql_result($viewlead,0,'Hl_mailer');
	$Dated = mysql_result($viewlead,0,'Dated');
	$Tataaig_Health=  mysql_result($viewlead,0,'Tataaig_Health');
	$Tataaig_Auto=  mysql_result($viewlead,0,'Tataaig_Auto');
	$Mobile = mysql_result($viewlead,0,'Mobile_Number');
	$Landline = mysql_result($viewlead,0,'Landline');
	$Landline_O = mysql_result($viewlead,0,'Landline_O');
	$Std_Code = mysql_result($viewlead,0,'Std_Code');
	$Std_Code_O = mysql_result($viewlead,0,'Std_Code_O');
	$Net_Salary = mysql_result($viewlead,0,'Net_Salary');
	$Residence_Address = mysql_result($viewlead,0,'Residence_Address');
	$City = mysql_result($viewlead,0,'City');
	$City_Other = mysql_result($viewlead,0,'City_Other');
	$Employment_Status = mysql_result($viewlead,0,'Employment_Status');
	$Loan_Amount = mysql_result($viewlead,0,'Loan_Amount');
	$Email = mysql_result($viewlead,0,'Email');
	$source = mysql_result($viewlead,0,'source');
	$Referrer = mysql_result($viewlead,0,'Referrer');
	$add_comment = mysql_result($viewlead,0,'Add_Comment');
	$Pincode = mysql_result($viewlead,0,'Pincode');
	$Property_Loc = mysql_result($viewlead,0,'Property_Loc');
	$Loan_Time = mysql_result($viewlead,0,'Loan_Time');
	$followup_date = mysql_result($viewlead,0,'Followup_Date');
	$Feedback = mysql_result($viewlead,0,'Feedback');
	$Email_Sent = mysql_result($viewlead,0,'Email_Sent');
	$Sms_Sent = mysql_result($viewlead,0,'Sms_Sent');
	$Budget = mysql_result($viewlead,0,'Budget'); 
	$CC_Bank = mysql_result($viewlead,0,'CC_Bank'); 
	$Bidderid_Details = mysql_result($viewlead,0,'Bidderid_Details');
	$Property_Identified = mysql_result($viewlead,0,'Property_Identified');
	$DOB = @mysql_result($viewlead,0,'DOB');
	$Accidental_Insurance = @mysql_result($viewlead,0,'Accidental_Insurance');
	$checked_bidders = @mysql_result($viewlead,0,'checked_bidders');
	$Property_Value = mysql_result($viewlead,0,'Property_Value');
	$Co_Applicant_Name = @mysql_result($viewlead,0,'Co_Applicant_Name');
	$Co_Applicant_DOB = @mysql_result($viewlead,0,'Co_Applicant_DOB');
	$Co_Applicant_Income = @mysql_result($viewlead,0,'Co_Applicant_Income');
	$Co_Applicant_Obligation = @mysql_result($viewlead,0,'Co_Applicant_Obligation');
	$Total_Obligation = @mysql_result($viewlead,0,'Total_Obligation');
	$Referral_Flag = @mysql_result($viewlead,0,'Referral_Flag');
	$comment_section = @mysql_result($viewlead,0,'comment_section');
	if($Referral_Flag==0)
	{
		$Referral_Flag = @mysql_result($viewlead,0,'Creative');
	}
	$PL_Bank = @mysql_result($viewlead,0,'PL_Bank');
	$Existing_Bank = @mysql_result($viewlead,0,'Existing_Bank');
	$Existing_ROI = @mysql_result($viewlead,0,'Existing_ROI');
	$Existing_Loan = @mysql_result($viewlead,0,'Existing_Loan');

	list($year,$mm,$dd) = split('[-]', $DOB);
	$monthly_income = $Net_Salary/12;
	$getnetAmount = ($monthly_income + $Co_Applicant_Income);
	$total_obligation = $Total_Obligation + $Co_Applicant_Obligation;
	$netAmount=($getnetAmount - $total_obligation);
	$dateofbirth = str_replace("-","", $DOB);
	$dateofbirth = DetermineAgeFromDOB($dateofbirth);
	$tenorPossible = 60 - $dateofbirth;

	if($City=="Others")
	{
		$calcity=$City_Other;
	}
	else
	{
		$calcity=$City;
	}
	$getCheckSQl = "select DOE, BidderID from hlcallinglms_allocation where (AllRequestID = '".$post."' and BidderID in (".$hlbidderidstr.")) order by hlallocateid DESC";
	$getCheckQuery = ExecQuery($getCheckSQl);
	$doe = mysql_result($getCheckQuery,0,'DOE');
	$allocated_bidder = mysql_result($getCheckQuery,0,'BidderID');
?>
</head>
<body>
<form name="loan_form" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>?id=<?echo $post;?>&Bid=<? echo $bidid;?>" onSubmit="return chkhomeloan(document.loan_form);">
<input type="hidden" name="bidderid_details" value="<? echo $Bidderid_Details;?>">
<input type="hidden" name="BidderId" value="<? echo $bidid;?>">
<input type="hidden" name="hlrequestid" id="hlrequestid" value="<? echo $post;?>">
<input type="hidden" name="Dated" value="<? echo $Dated;?>">
<input type="hidden" name="allocatedBidder" value="<? echo $allocated_bidder;?>">
<table width="1000" border="0" align="center" cellpadding="00" cellspacing="0" style="border:thin solid #CCC;">
<?php
if(strlen(strpos($source, "wf -")) > 0)
{
?>
<tr>
	<td height="35" colspan="2" align="center" valign="middle" bgcolor="#1c2731" class="heading-customer">Customer Applied on Wishfin HL</td>
</tr>
<? 
}
else
{ ?>
<tr>
    <td height="35" colspan="2" align="center" valign="middle" bgcolor="#1c2731" class="heading-customer">Customer Applied for HL</td>
</tr>
<? 
} ?>
<tr>
    <td width="365" height="30" align="center" bgcolor="#E5E5E5"><b>Balance Transfer</b></td>
	<td width="635" height="30" align="center" bgcolor="#E5E5E5"><strong>Personal Details</strong></td>
</tr>
<tr>
	<td valign="top">
	<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border:thin solid #CCC;">
      <tr>
        <td width="43%"><strong>Existing Bank</strong></td>
        <td width="57%"><input type="text" name="hl_Existing_Bank" id="hl_Existing_Bank" value="<?php echo $Existing_Bank; ?>"></td>
      </tr>
      <tr>
        <td><strong>Existing ROI</strong></td>
        <td><input type="text" name="hl_Existing_ROI" id="hl_Existing_ROI" value="<?php echo $Existing_ROI; ?>"></td>
      </tr>
      <tr>
        <td><strong>Existing Loan </strong></td>
        <td><input type="text" name="hl_Existing_Loan" id="hl_Existing_Loan" value="<?php echo $Existing_Loan; ?>"></td>
      </tr>
      <tr>
        <td height="30" colspan="2" align="center" bgcolor="#E5E5E5"><strong>Employment Details</strong></td>
        </tr>
      <tr>
        <td><b>Employment Status</b></td>
        <td>
			<select name="hlemployment_status2" id="hlemployment_status2">
				<option value="1" <? if($Employment_Status ==1){echo "selected"; }?>>Salaried</option>
				<option value="0" <? if($Employment_Status ==0) {echo "selected"; }?>>Self Employed</option>
			</select>
		</td>
      </tr>
      <tr>
        <td><b>Company Name</b></td>
        <td><input type="text" name="hlcompany_name2" id="hlcompany_name2" value="<? echo $Company_Name?>"></td>
      </tr>
      <tr>
        <td><b>Annual Income</b></td>
        <td><input type="text" name="hlnet_salary" id="hlnet_salary" value="<? echo $Net_Salary;?>"  onKeyUp="getDigitToWords('hlnet_salary','formatedIncome','wordIncome');" onKeyPress=" getDigitToWords('hlnet_salary','formatedIncome','wordIncome');" style="float: left" onBlur="getDigitToWords('hlnet_salary','formatedIncome','wordIncome');"></td>
      </tr>
      <tr>
        <td height="30" colspan="2" align="center" bgcolor="#E5E5E5"><b>Other Details</b></td>
        </tr>
      <tr>
        <td><b>Loan Amount</b></td>
        <td><input type="text" name="hlloanamt" id="hlloanamt" value="<? echo $Loan_Amount;?>" onKeyUp="getDigitToWords('hlloanamt','formatedloan','wordloan');" onKeyPress="getDigitToWords('hlloanamt','formatedloan','wordloan');" style="float: left" onBlur="getDigitToWords('hlloanamt','formatedloan','wordloan');"></td>
      </tr>
      <tr>
        <td><b>Property Identified</b></td>
        <td><input type="radio" name="hlproperty_identified" <? if($Property_Identified==1){ echo "checked";}?> value="1">Yes<input type="radio" name="hlproperty_identified" <? if($Property_Identified==0){echo "checked";}?> value="0">No</td>
      </tr>
      <tr>
        <td><b>Property Value</b></td>
        <td><input type="text" name="hlProperty_Value" id="hlProperty_Value" value="<? echo $Property_Value; ?>"></td>
      </tr>
      <tr>
        <td><strong>Which Khatha ?</strong></td>
        <td><select Name="which_khatha" id="which_khatha">
          <option value="">Select</option>
          <option value="1" <? if($CC_Bank==1) { echo "Selected";}?>>A Khatha</option>
          <option value="2" <? if($CC_Bank==2) { echo "Selected";}?>>B Khatha</option>
        </select></td>
      </tr>
      <tr>
        <td><b>Loan Time</b></td>
        <td><select name="hlloantime2" >
          <option value="-1" <? if (($Loan_Time==-1) || ($Loan_Time=="")) { echo "selected";}?>>Please select</option>
          <OPTION value="15 days" <? if($Loan_Time =="15 days"){echo "selected"; }?>>15 days</OPTION>
          <OPTION value="1 month" <? if($Loan_Time =="1 month"){echo "selected"; }?>>1 months</OPTION>
          <OPTION value="2 months" <? if($Loan_Time =="2 months"){echo "selected"; }?>>2 months</OPTION>
          <OPTION value="3 months" <? if($Loan_Time =="3 months"){echo "selected"; }?>>3 months</OPTION>
          <OPTION value="3 months above" <? if($Loan_Time =="3 months above"){echo "selected"; }?>>more than 3 months</OPTION>
        </SELECT></td>
      </tr>
      <tr>
        <td><b>Property Location</b></td>
        <td><input type="text" name="hlproperty_loc2" value="<? echo  $Property_Loc;?>"></td>
      </tr>
      <tr>
        <td><b>Total Obligation</b></td>
        <td><input type="text" name="hlTotal_Obligation2" id="hlTotal_Obligation2" value="<? echo $Total_Obligation; ?>"></td>
      </tr>
	  <tr>
        <td><b>Lead Assign date</b></td>
        <td><?php echo $doe; ?></td>
      </tr>
	  <tr>
		<td height="30" colspan="2" align="center" bgcolor="#E5E5E5"><b>Reference Details</b></td>
	  </tr>
	  <tr>
		<td><b>Source</b></td>
		<td>
		<?php 
			if($source != 'HLReferralProgram' && $source != 'HLInternalReference'){
				echo 'Web';
			}else{
				echo $source;
			}
		?>
		</td>
	  </tr>
	  <tr>
		<td><b>Referrer</b></td>
		<td><?php echo $Referrer; ?></td>
	  </tr>
    </table>
    </td>
    <td valign="top"><table width="100%" border="1" cellpadding="0" cellspacing="0" style="border:thin solid #CCC;">
      <tr>
        <td width="22%"><b>Name</b></td>
        <td width="31%"><input type="text" name="hlname" id="hlname" value="<? echo $Name;?>" readonly></td>
        <td width="16%"><b>Email id</b></td>
        <td width="31%"><input type="text" name="hlemail" id="hlemail" value="<? echo $Email;?>"></td>
      </tr>
      <tr>
        <td><b>Mobile</b></td>
        <td>+91<input type="hidden" name="hlmobile" size="15" value="<? //echo $Mobile;?>"><? //echo $Mobile;?></td>
        <td><b>DOB </b></td>
        <td><input type="text" name="day" id="day" value="<? echo $dd;?>" size="2" maxlength="2">-<input type="text" name="month" id="month" value="<? echo $mm;?>" size="2" maxlength="2">-<input type="text" name="year" id="year" value="<? echo $year;?>" size="4" maxlength="4">(dd-mm-yyyy)</td>
      </tr>
      <tr>
        <td><b>Residence No.</b></td>
        <td><input type="text" name="hlstd_code" size="2" value="<? echo $Std_Code;?>" >-<input type="text" name="hllandline" size="10" value="<?echo $Landline;?>"></td>
        <td><b>Office No.</b></td>
        <td><input type="text" name="hlstd_code_o"  size="2" value="<? echo $Std_Code_O; ?>" >-<input type="text" name="hllandline_o" size="10" value="<?echo $Landline_O;?>"></td>
      </tr>
      <tr>
        <td><b>Residence Address</b></td>
        <td><textarea  name="hlresiaddress" rows="2" cols="18"><? echo $Residence_Address;?></textarea></td>
        <td><b>Pincode</b></td>
        <td><input type="text" name="hlpincode" size="10" value="<? echo $Pincode;?>" id="hlpincode"></td>
      </tr>
      <tr>
        <td><b>City</b></td>
        <td><select size="1" name="hlcity" > <?=getCityList($City)?></select></td>
        <td><b>Other City</b></td>
        <td><input type="text" name="hlother_city" id="hlother_city" value="<? echo $City_Other;?>"></td>
      </tr>
      <tr>
        <td height="30" colspan="4" align="center" bgcolor="#E5E5E5"><b>Co applicant Details</b></td>
        </tr>
      <tr>
        <td><b>Co Applicant Name:</b></td>
        <td><input type="text" name="hlCo_Applicant_Name2" id="hlCo_Applicant_Name2" value="<? echo $Co_Applicant_Name; ?>"></td>
        <td><b>Co-Applicant DOB</b></td>
        <td><input type="text" name="hlCo_Applicant_DOB2" id="hlCo_Applicant_DOB2" value="<? echo $Co_Applicant_DOB; ?>"></td>
      </tr>
      <tr>
        <td><b>Co Monthly Income:</b></td>
        <td><input type="text" name="hlCo_Applicant_Income2" id="hlCo_Applicant_Income2" value="<? echo $Co_Applicant_Income; ?>"></td>
        <td><b>Co Applicant Obligation</b></td>
        <td><input type="text" name="hlCo_Applicant_Obligation2" id="hlCo_Applicant_Obligation2" value="<? echo $Co_Applicant_Obligation; ?>"></td>
      </tr>
	  <tr>
		<td height="30" colspan="4" align="center" bgcolor="#E5E5E5"><b>Add Feedback</b></td>
	  </tr>
	  <tr>
		<td><b>Feedback</b></td>
		<td>
			<select name="hlfeedback" id="feedback">
				<option value="" <?if($Feedback == "" || $Feedback == "No Feedback") { echo "selected"; }?>>No Feedback</option>
				<option value="Not Interested" <?if($Feedback == "Not Interested") { echo "selected"; }?>>Not Interested</option>
				<option value="Callback Later" <?if($Feedback == "Callback Later") { echo "selected"; }?>>Callback Later</option>
				<option value="FollowUp" <?if($Feedback == "FollowUp") { echo "selected"; }?>>FollowUp</option>
				<option value="No Response" <? if($Feedback == "No Response") { echo "selected"; } ?>>No Response</option>
				<option value="Not Eligible" <?if($Feedback == "Not Eligible") { echo "selected"; }?>>Not Eligible</option>
				<option value="Appointment" <?if($Feedback == "Appointment") { echo "selected"; }?>>Appointment</option>
				<option value="Docs Awaited" <? if($Feedback == "Docs Awaited") { echo "selected"; } ?>>Docs Awaited</option>
				<option value="Documents Pick" <? if($Feedback == "Documents Pick") { echo "selected"; } ?>>Docs Picked</option>
				<option value="Login" <? if($Feedback == "Login") { echo "selected"; } ?>>Login</option>
				<option value="Language Barrier" <? if($Feedback == "Language Barrier") { echo "selected"; } ?>>Language Barrier</option>
				<option value="DNC" <? if($Feedback == "DNC") { echo "selected"; } ?>>DNC</option>
				<option value="Approved" <? if($Feedback == "Approved") { echo "selected"; } ?>>Approved</option>
				<option value="Disbursed" <? if($Feedback == "Disbursed") { echo "selected"; } ?>>Disbursed</option>
			</select>
		</td>
		<td><b>Follow Up Date</b></td>
		<td>
			<input type="Text"  name="FollowupDate" id="FollowupDate" maxlength="25" size="15" value="<?php  echo $followup_date; ?>">
			<!--<a href="javascript:NewCal('FollowupDate','yyyymmdd',true,24)"><img src="images/cal.gif" width="16" height="16" border="0" alt="Pick a date"></a>-->
	</td>
</tr>
<tr>
	<td><b>LMS Comment</b></td>
	<td><textarea rows="2" cols="20" name="hladd_comment" id="hladd_comment" readonly><? echo $add_comment; ?></textarea></td>
	<td><b>add Comment</b></td>
	<td><textarea rows="2" cols="20" name="comment_section" id="comment_section" ><? echo $comment_section; ?></textarea></td>
</tr>
<tr>
	<td><b>Send SMS</b></td>
	<td>
		<input type="button" name="sms" onClick="window.open('hllmsallocate_sendsms.php?Mobile=<? echo $Mobile;?>&RequestID=<? echo urlencode($post);?>&Bidid=<?php echo $bidid; ?>')" value="SendSMS">
	</td>
	<td><b>Send Email</b></td>
	<td>
		<input type="button" name="sms" onClick="window.open('hllmsallocate_sendemail.php?Email=<? echo $Email;?>&RequestID=<? echo urlencode($post);?>&Bidid=<?php echo $bidid; ?>')" value="SendEmail">
	</td>
</tr>
</table></td>
</tr>
<tr><td colspan="4" align="center"><input type="submit" class="bluebutton" value="Submit"></td></tr>
<tr><td height="30" colspan="4" align="center" bgcolor="#E5E5E5"><b>Lead Lifecycle</b></td></tr>
<tr>
	<td height="30" colspan="4">
	<?php 
	$sqllifecycle="Select BidderID,Dated,Feedback,Comments,Followup_Date, smstext, emailtext From feedback_bookkeeping Where (AllRequestID='".$post."' and Reply_Type=2 and BidderID='".$bidid."') ORDER BY Dated ASC";
	$sqllifecycleresult = ExecQuery($sqllifecycle); 
	$lcrecordcount = mysql_num_rows($sqllifecycleresult);
	if($lcrecordcount>0)
	{
	?>
		<table align='center' border=1>
			<tr>
				<td>Agentid</td>
				<td>Feedback</td>
				<td>Followup Date</td>
				<td>Comments</td>
				<td>Date</td>
			</tr>
		<?php 
		while($lcrow=mysql_fetch_array($sqllifecycleresult))
		{
			if($lcrow["Feedback"] == 'Email Sent'){
				$Comments = $lcrow["Comments"].'<br>'.$lcrow["emailtext"];
			}
			elseif($lcrow["Feedback"] == 'Sms Sent'){
				$Comments = $lcrow["Comments"].'<br>'.$lcrow["smstext"];
			}
			else{
				$Comments = $lcrow["Comments"];
			}
			$sqllifecyclebid=ExecQuery("Select Bidder_Name From Bidders Where BidderID='".$lcrow["BidderID"]."'");
			$bidrow=mysql_fetch_array($sqllifecyclebid);
		?>
			<tr>
				<td><?php echo $bidrow["Bidder_Name"];?></td>
				<td>
					<?php
					if($lcrow["Feedback"] == 'Email Sent'){
					?>
					<a href="viewContent.php?viewContent=<?php echo $lcrow["emailtext"];?>" target="_blank"><?php echo $lcrow["Feedback"]; ?></a>
					<?php
					}
					elseif($lcrow["Feedback"] == 'Sms Sent'){
					?>
					<a href="viewContent.php?viewContent=<?php echo $lcrow["smstext"];?>" target="_blank"><?php echo $lcrow["Feedback"]; ?></a>
					<?php
					}
					else{
						echo $lcrow["Feedback"];
					}
					?>
				</td>
				<td><?php echo $lcrow["Followup_Date"];?></td>
				<td><?php echo $lcrow["Comments"];?></td>
				<td><?php echo $lcrow["Dated"];?></td>
			</tr>
		<?php 
			if($lcrow["BidderID"]==$bidid)
			{
				$callerBidname=$bidrow["Bidder_Name"];
			}
		}
		?>
		</table>
		<input type="hidden" value="<?php echo $callerBidname; ?>" name="callerBidname">
	<?
	}
	?>
	</td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td valign="top">&nbsp;</td>
</tr>
</table>
</form>
</body>
</html>
