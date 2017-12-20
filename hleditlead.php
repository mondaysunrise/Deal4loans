<?php
require 'scripts/session_check_online.php';
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

session_start();
$post=$_REQUEST['id'];
$min_date =$_REQUEST['to'];
$max_date=$_REQUEST['from'];
$bidid =$_REQUEST['Bid'];

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		foreach($_POST as $a=>$b)
			$$a=$b;
		/* FIX STRINGS */
		$UserID = $_SESSION['UserID'];
		$hlrequestid = $_POST["hlrequestid"];
		$producttype=2;
		$hlfeedback = $_POST["hlfeedback"];
		$FollowupDate = $_POST["FollowupDate"];
		$Final_Bidder = $_REQUEST['Final_Bidder'];
		$Bidder_Id = $_REQUEST['BidderId'];
		$comment_section  = $_REQUEST['comment_section'];
		
 if(strlen($hlfeedback)>0)
	{
		 $strSQL="";
		$Msg="";
		$result = ExecQuery("select FeedbackID,not_contactable_counter from Req_Feedback_HL where AllRequestID=".$post." and BidderID in (5272) AND Reply_Type=2");	
		
		$num_rows = mysql_num_rows($result);
		if($num_rows > 0)
		{
			$row = mysql_fetch_array($result);
			$strSQL="Update Req_Feedback_HL Set comment_section='".$comment_section."',Feedback='".$hlfeedback."', Followup_Date='".$FollowupDate."',BidderID=".$Bidder_Id;
			$strSQL=$strSQL." Where FeedbackID=".$row["FeedbackID"];
		}
		else
		{
			$strSQL="Insert into Req_Feedback_HL(AllRequestID, BidderID, Reply_Type , Feedback, Followup_Date,not_contactable_counter, Caller_Name, comment_section) Values (";
			$strSQL=$strSQL.$post.",".$Bidder_Id.",2,'".$hlfeedback."','".$FollowupDate."','".$counter."', '".$_SESSION['Caller_Name']."', '".$comment_section."')";
		}
		echo $strSQL."<br><br>";
		$result = ExecQuery($strSQL);
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
<link rel="stylesheet" type="text/css" href="css/menu.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link href="includes/style.css" rel="stylesheet" type="text/css">
<script language="javascript" type="text/javascript" src="scripts/datetime.js"></script>
<script language="javascript" type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
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
<p align="center"><b>Home loan Lead Details </b></p>
<?php 
 $viewqry="select comment_section, CC_Bank,Creative, Referral_Flag,Property_Value,Co_Applicant_Name,Co_Applicant_DOB,Co_Applicant_Income ,Co_Applicant_Obligation,Total_Obligation,Req_Loan_Home.checked_bidders,Req_Loan_Home.Tataaig_Home,Req_Loan_Home.Tataaig_Auto,Req_Loan_Home.Tataaig_Health,Req_Loan_Home.Company_Name, Req_Loan_Home.Dated,Req_Loan_Home.Name,Req_Loan_Home.Accidental_Insurance,Req_Loan_Home.source,Req_Loan_Home.Add_Comment,Req_Loan_Home.Landline,Req_Loan_Home.Std_Code,Req_Loan_Home.Residence_Address,Req_Loan_Home.Net_Salary,Req_Loan_Home.Sms_Sent,Req_Loan_Home.Email_Sent,Req_Loan_Home.Landline_O,Req_Loan_Home.Std_Code_O,Req_Loan_Home.Mobile_Number,Req_Loan_Home.Employment_Status,Req_Loan_Home.City,Req_Loan_Home.City_Other, Req_Loan_Home.PL_Bank, Req_Loan_Home.Loan_Amount, Req_Loan_Home.Email,Req_Loan_Home.DOB,Req_Loan_Home.Budget,Req_Loan_Home.Property_Loc,Req_Loan_Home.Pincode,Req_Loan_Home.Loan_Time,Req_Loan_Home.Hl_mailer,Req_Loan_Home.Property_Identified,Req_Feedback_HL.Feedback,Req_Feedback_HL.BidderID,Req_Feedback_HL.Followup_Date,Req_Loan_Home.Bidderid_Details,Req_Loan_Home.Existing_Loan,Req_Loan_Home.Existing_Bank ,Req_Loan_Home.Existing_ROI from Req_Loan_Home LEFT OUTER JOIN Req_Feedback_HL ON Req_Feedback_HL.AllRequestID=Req_Loan_Home.RequestID and Req_Feedback_HL.BidderID in (5272) where Req_Loan_Home.RequestID=".$post." "; 
//echo "dd".$qry;
$viewlead = ExecQuery($viewqry);
$viewleadscount =mysql_num_rows($viewlead);
$Name = mysql_result($viewlead,0,'Name');
$Tataaig_Home=  mysql_result($viewlead,0,'Tataaig_Home');
$Company_Name = mysql_result($viewlead,0,'Company_Name');
$Hl_mailer = mysql_result($viewlead,0,'Hl_mailer');
$Dated = mysql_result($viewlead,0,'Dated');
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
$add_comment = mysql_result($viewlead,0,'Add_Comment');
$Pincode = mysql_result($viewlead,0,'Pincode');
$Property_Loc = mysql_result($viewlead,0,'Property_Loc');
$Loan_Time = mysql_result($viewlead,0,'Loan_Time');
$followup_date = mysql_result($viewlead,0,'Followup_Date');
$Feedback = mysql_result($viewlead,0,'Feedback');
$Budget = mysql_result($viewlead,0,'Budget'); 
$CC_Bank = mysql_result($viewlead,0,'CC_Bank'); 
$Bidderid_Details = mysql_result($viewlead,0,'Bidderid_Details');
$Property_Identified = mysql_result($viewlead,0,'Property_Identified');
$DOB = @mysql_result($viewlead,0,'DOB');
$Accidental_Insurance = @mysql_result($viewlead,0,'Accidental_Insurance');
$checked_bidders = @mysql_result($viewlead,0,'checked_bidders');
$checked_bidders = explode(",",$checked_bidders);
$Property_Value = mysql_result($viewlead,0,'Property_Value');
$Co_Applicant_Name = @mysql_result($viewlead,0,'Co_Applicant_Name');
$Co_Applicant_DOB = @mysql_result($viewlead,0,'Co_Applicant_DOB');
$Co_Applicant_Income = @mysql_result($viewlead,0,'Co_Applicant_Income');
$Co_Applicant_Obligation = @mysql_result($viewlead,0,'Co_Applicant_Obligation');
$Total_Obligation = @mysql_result($viewlead,0,'Total_Obligation');
$Referral_Flag = @mysql_result($viewlead,0,'Referral_Flag');
if($Referral_Flag==0)
{
	$Referral_Flag = @mysql_result($viewlead,0,'Creative');
}
$PL_Bank = @mysql_result($viewlead,0,'PL_Bank');
$Existing_Bank = @mysql_result($viewlead,0,'Existing_Bank');
$Existing_ROI = @mysql_result($viewlead,0,'Existing_ROI');
$Existing_Loan = @mysql_result($viewlead,0,'Existing_Loan');
$comment_section = @mysql_result($viewlead,0,'comment_section');

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
 ?>
<form name="loan_form" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>?id=<?echo $post;?>&Bid=<? echo $bidid;?>&to=<? echo $min_date?>&from=<? echo $max_date;?>" onSubmit="return chkhomeloan(document.loan_form);">
<input type="hidden" name="BidderId" value="<? echo $bidid;?>">
<input type="hidden" name="hlrequestid" id="hlrequestid" value="<? echo $post;?>">
<table style='border:1px dotted #9C9A9C;'width="700" height="80%" align="center" >
<tr>
	<td style="border:1px solid black;" colspan="4" bgcolor="#DAEAF9" align="center" class="fontstyle" ><b>Balance Transfer</b></td></tr>
<tr>
	<td width="25%"><b>Existing Bank</b></td>
	<td width="25%"><?php echo $Existing_Bank; ?></td>
	<td ><b>Existing Loan </b></td>
	<td ><?php echo $Existing_Loan; ?></td>
</tr>
<tr>
	<td width="25%"><b>Existing ROI</b></td>
	<td width="25%"><?php echo $Existing_ROI; ?></td>
	<td >&nbsp;</td>
	<td >&nbsp;</td>
</tr>
<tr>
	<td style="border:1px solid black;" colspan="4" bgcolor="#DAEAF9" align="center" class="fontstyle" ><b>Personal Details</b></td></tr><tr><td><b>Name</b>
	</td>
	<td><? echo $Name;?></td>
<td ><b>Email id</b></td>
	<td><? echo $Email;?></td>
	</tr>
<tr>
	<td width="25%"><b>Mobile</b></td>
	<td width="25%"><img src="gButt.php?text=<? echo $Mobile; ?>" /></td>
	<td><b>DOB </b></td>
	<td><? echo $DOB; ?></td>
</tr>
<tr>
	<td><b>Residence No.</b></td>
	<td><? echo $Std_Code;?>-<? echo $Landline; ?></td>
	
	<td><b>Office No.</b></td>
	<td><? echo $Std_Code_O; ?>-<? echo $Landline_O; ?></td>
  </tr>
<tr>
	<td ><b>City</b></td>
	<td><? echo $City ?></select></td>
	<td ><b>Pincode</b></td>
	<td ><? echo $Pincode;?></td>
</tr>
<tr>
	<td><b>Residence Address</b></td>
	<td><? echo $Residence_Address;?></td>
	<td><b>Other City</b></td>
	<td><? echo $City_Other;?></td>
</tr>
<tr><td><b>Source</b></td>
		<td><? echo $source; ?></td>
		     <td>
    </td></tr>
<tr>
	<!--<td>
		<table width="100%">
		<tr>--><td style="border:1px solid black;" colspan="4" bgcolor="#DAEAF9" align="center" class="fontstyle" ><b>Employment Details</b></td></tr>
<tr>
	<td><b>Employment Status</b></td>
	<td><? if($Employment_Status ==1){echo "Salaried"; }?>
		<? if($Employment_Status ==0) {echo "Self Employed"; }?></td>
	<td ><b>Annual Income</b></td>
	<td><? echo $Net_Salary;?></td>
</tr>
<tr><td><b>Company Name</b></td><td><? echo $Company_Name?></td><td colspan="2"></td></tr>
<tr>
	<td style="border:1px solid black;" colspan="4" bgcolor="#DAEAF9" align="center" class="fontstyle" ><b>Other Details</b></td></tr>
<tr>
	<td><b>Loan Amount</b></td>
	<td><? echo $Loan_Amount;?></td>
<td ><b>Loan Time</b></td>
	<td >
    <? echo $Loan_Time; ?></td>
</tr>
<tr>
	<td><b>Property Identified</b></td>
	<td ><? if($Property_Identified==1){ echo "Yes";}?><? if($Property_Identified==0){echo "No";}?> </td>
	<td><b>Property Location</b></td>
	<td ><? echo  $Property_Loc;?></td>
</tr>
<tr>
	<td><b>Property Value</b></td>
<td><? echo $Property_Value; ?></td>
	<td><b>Total Obligation</b></td>
<td><? echo $Total_Obligation; ?></td>
</tr>
<? if($Property_Loc=="Bangalore")
{ ?>
<tr>
<td>Which Khatha ?</td>
<td><select Name="which_khatha" id="which_khatha"><option value="">Select</option><option value="1" <? if($CC_Bank==1) { echo "Selected";}?>>A Khatha</option><option value="2" <? if($CC_Bank==2) { echo "Selected";}?>>B Khatha</option></select></td>
	<td colspan="2"></td>
</tr>
<? } ?>
<tr>
	<td style="border:1px solid black;" colspan="4" bgcolor="#DAEAF9" align="center" class="fontstyle" ><b>Co applicant Details</b></td></tr>
	<tr>
	<td><b>Co Applicant Name:</b></td>
<td><? echo $Co_Applicant_Name; ?></td>
	<td ><b>Co-Applicant DOB</b></td><td><? echo $Co_Applicant_DOB; ?></td>
</tr>
<tr>
	<td><b>Co Monthly Income:</b></td>
<td><? echo $Co_Applicant_Income; ?></td>
	<td ><b>Co Applicant Obligation</b></td><td><? echo $Co_Applicant_Obligation; ?></td>
</tr>
<tr>
	<!--<td>
		<table width="100%">
		<tr>--><td style="border:1px solid black;" colspan="4" bgcolor="#DAEAF9" align="center" class="fontstyle" ><b>Add Feedback</b></td></tr>
<tr>
	<td><b>Feedback</b></td>
	<td>
    <?php
	//echo "select FeedbackID, Feedback from Req_Feedback_HL where AllRequestID='".$post."' and BidderID='3635' AND Reply_Type=2";
	$getFedbackQuery = ExecQuery("select FeedbackID, Feedback, Followup_Date from Req_Feedback_HL where AllRequestID='".$post."' and BidderID='5272' AND Reply_Type=2");
	$num_rows = mysql_num_rows($getFedbackQuery);
		if($num_rows > 0)
		{
			$Feedback3635 = mysql_result($getFedbackQuery,0,'Feedback');
			$originalFeedback = $Feedback_c;
	echo "<br>";
			$followup_date3635 = mysql_result($getFedbackQuery,0,'Followup_Date');
		}
	?>
    <select name="hlfeedback" id="feedback">
		<option value="No Feedback" <?if($Feedback == "") { echo "selected"; }?>>No Feedback</option>
		<option value="Other Product" <?if($Feedback == "Other Product") { echo "selected"; }?>>Other Product</option>
		<option value="Not Interested" <?if($Feedback == "Not Interested") { echo "selected"; }?>>Not Interested</option>
		<option value="Callback Later" <?if($Feedback == "Callback Later") { echo "selected"; }?>>Callback Later</option>
		<option value="Wrong Number" <?if($Feedback == "Wrong Number") { echo "selected"; }?>>Wrong Number</option>
		<option value="Not Contactable" <?if($Feedback == "Not Contactable") { echo "selected"; }?>>Not Contactable</option>
		<option value="Duplicate" <?if($Feedback == "Duplicate") { echo "selected"; }?>>Duplicate</option>
		<option value="Ringing" <?if($Feedback == "Ringing") { echo "selected"; }?>>Ringing</option>
		<option value="Not Eligible" <?if($Feedback == "Not Eligible") { echo "selected"; }?>>Not Eligible</option>
		<option value="Send Now" <?if($Feedback == "Send Now") { echo "selected"; }?>>Send Now</option>
	<option value="FollowUp" <?if($Feedback == "FollowUp") { echo "selected"; }?>>FollowUp</option>
	</select>	</td>
	<td><b>Follow Up Date</b></td>
	<td><?php  echo $followup_date3635; ?><input type="Text"  name="FollowupDate" id="FollowupDate" maxlength="25" size="15" <?php if($Followup_Date !='0000-00-00 00:00:00') { ?>value="<?php  echo $followup_date; ?>" <?php } ?>><a href="javascript:NewCal('FollowupDate','yyyymmdd',true,24)"><img src="images/cal.gif" width="16" height="16" border="0" alt="Pick a date"></a></td>
</tr>
	<tr>
		<td><b>Add Comment</b></td>
		<td><textarea rows="2" cols="20" name="comment_section" id="comment_section" ><? echo $comment_section; ?></textarea></td>
	</tr> 
<tr><td colspan="4">&nbsp;</td></tr>
 <tr>
     <td colspan="4" align="center"><br><input type="submit" class="bluebutton" value="Submit">    </td>
  </tr>
</table>
</form>
</body>
</html>