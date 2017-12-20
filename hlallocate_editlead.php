<?php
//ini_set('max_execution_time', 600);
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
		$checked_bidders = trim($_POST["checked_bidders"]);
	
	 if(strlen($hlfeedback)>0 || strlen($comment_section)>0)
	{
		if($post>1 && strlen($checked_bidders)>0)
		{
			 $hlresult = ExecQuery("Update Req_Loan_Home set checked_bidders='".$checked_bidders."' where (RequestID=".$post.")");
			// echo "Update Req_Loan_Home set checked_bidders='".$checked_bidders."' where (RequestID=".$post.")";
		}
		 $strSQL="";
		$Msg="";
	
		$result = ExecQuery("select FeedbackID from Req_Feedback_HL where AllRequestID=".$post." and BidderID=".$bidid." AND Reply_Type=2");	
		
		$num_rows = mysql_num_rows($result);
		if($num_rows > 0)
		{
			$row = mysql_fetch_array($result);
			$strSQL="Update Req_Feedback_HL Set Feedback='".$hlfeedback."' ,comment_section='".$comment_section."', Followup_Date='".$FollowupDate."',BidderID=".$bidid;
			$strSQL=$strSQL." Where FeedbackID=".$row["FeedbackID"];

		}
		else
		{
			$strSQL="Insert into Req_Feedback_HL(AllRequestID, BidderID, Reply_Type , Feedback, Followup_Date,comment_section) Values (";
			$strSQL=$strSQL.$post.",".$bidid.",2,'".$hlfeedback."','".$FollowupDate."','".$comment_section."')";
		}

		//echo $strSQL;
		$result = ExecQuery($strSQL);
		if ($result == 1)
		{
		}
		else
		{
			$Msg = "** There was a problem in adding your feedback. Please try again.";
		}
		// feedback book keeping
		$strfbSQL="";
		$Msg="";
		$mindate=date('Y-m-d')." 00:00:00";
		$maxdate=date('Y-m-d')." 23:59:59";
		$resultfb = ExecQuery("select feedbkid from feedback_bookkeeping where (AllRequestID=".$post." and BidderID=".$bidid." AND Reply_Type=2 and leadidentifier='hlallocatelms' and Feedback='".$hlfeedback."' and Comments='".$comment_section."' and Followup_Date='".$FollowupDate."')");	
		$fbnum_rows = mysql_num_rows($resultfb);
		if($fbnum_rows > 0)
		{
			$fbrow = mysql_fetch_array($resultfb);
			$strfbSQL="Update feedback_bookkeeping Set Feedback='".$hlfeedback."' ,Comments='".$comment_section."', Followup_Date='".$FollowupDate."'";
			$strfbSQL=$strfbSQL." Where feedbkid=".$fbrow["feedbkid"];

		}
		else
		{
			$strfbSQL="Insert into feedback_bookkeeping(AllRequestID, BidderID, Reply_Type , Feedback, Followup_Date,Comments,leadidentifier) Values (";
			$strfbSQL=$strfbSQL.$post.",".$bidid.",2,'".$hlfeedback."','".$FollowupDate."','".$comment_section."','hlallocatelms')";
		}

		//echo $strfbSQL;
		$fbresult = ExecQuery($strfbSQL);
		if ($fbresult == 1)
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
<p align="center"><b>Home loan Lead Details </b></p>
<?php 
$qryCheck = "SELECT * FROM Bidders where (leadidentifier in ('hlallocatelms'))";
$qryCheckResult = ExecQuery($qryCheck);
while($hlrow=mysql_fetch_array($qryCheckResult))
		{
 	$hlbidderid[] = $hlrow["BidderID"];
}
 $hlbidderidstr=implode(",",$hlbidderid);

 $viewqry="select comment_section,CC_Bank,Creative, Referral_Flag,Property_Value,Co_Applicant_Name,Co_Applicant_DOB,Co_Applicant_Income ,Co_Applicant_Obligation,Total_Obligation,Req_Loan_Home.checked_bidders,Req_Loan_Home.Tataaig_Home,Req_Loan_Home.Tataaig_Auto,Req_Loan_Home.Tataaig_Health,Req_Loan_Home.Company_Name, Req_Loan_Home.Dated,Req_Loan_Home.Name,Req_Loan_Home.Accidental_Insurance,Req_Loan_Home.source,Req_Loan_Home.Add_Comment,Req_Loan_Home.Landline,Req_Loan_Home.Std_Code,Req_Loan_Home.Residence_Address,Req_Loan_Home.Net_Salary,Req_Loan_Home.Sms_Sent,Req_Loan_Home.Email_Sent,Req_Loan_Home.Landline_O,Req_Loan_Home.Std_Code_O,Req_Loan_Home.Mobile_Number,Req_Loan_Home.Employment_Status,Req_Loan_Home.City,Req_Loan_Home.City_Other, Req_Loan_Home.PL_Bank, Req_Loan_Home.Loan_Amount, Req_Loan_Home.Email,Req_Loan_Home.DOB,Req_Loan_Home.Budget,Req_Loan_Home.Property_Loc,Req_Loan_Home.Pincode,Req_Loan_Home.Loan_Time,Req_Loan_Home.Hl_mailer,Req_Loan_Home.Property_Identified,Req_Feedback_HL.Feedback,Req_Feedback_HL.BidderID,Req_Feedback_HL.Followup_Date,Req_Loan_Home.Bidderid_Details,Req_Loan_Home.Existing_Loan,Req_Loan_Home.Existing_Bank ,Req_Loan_Home.Existing_ROI from Req_Loan_Home LEFT OUTER JOIN Req_Feedback_HL ON Req_Feedback_HL.AllRequestID=Req_Loan_Home.RequestID and Req_Feedback_HL.BidderID in (".$hlbidderidstr.") where Req_Loan_Home.RequestID=".$post." "; 
	//echo "dd".$viewqry;
	$viewlead = ExecQuery($viewqry);
	$viewleadscount =mysql_num_rows($viewlead);
	$Name = mysql_result($viewlead,0,'Name');
	$Tataaig_Home=  mysql_result($viewlead,0,'Tataaig_Home');
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
 ?>
<form name="loan_form" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>?id=<?echo $post;?>&Bid=<? echo $bidid;?>" onSubmit="return chkhomeloan(document.loan_form);">
<input type="hidden" name="bidderid_details" value="<? echo $Bidderid_Details;?>">
<input type="hidden" name="BidderId" value="<? echo $bidid;?>">
<input type="hidden" name="hlrequestid" id="hlrequestid" value="<? echo $post;?>">
<input type="hidden" name="Dated" value="<? echo $Dated;?>">
<table style='border:1px dotted #9C9A9C;'width="700" height="80%" align="center" >
<?php
if(strlen(strpos($source, "wf -")) > 0)
{
?>

<tr>
	<td style="border:1px solid black;" colspan="4" bgcolor="#DAEAF9" align="center" class="fontstyle" ><p align="center"><b style="color:red; font-size:16px;">Customer Applied on Wishfin</b></p></td></tr>
<tr>
<?php } ?>
<tr>
	<td style="border:1px solid black;" colspan="4" bgcolor="#DAEAF9" align="center" class="fontstyle" ><b>Balance Transfer</b></td></tr>
<tr>
	<td width="25%"><b>Existing Bank</b></td>
	<td width="25%"><input type="text" name="hl_Existing_Bank" id="hl_Existing_Bank" value="<?php echo $Existing_Bank; ?>"></td>
	<td ><b>Existing Loan </b></td>
	<td ><input type="text" name="hl_Existing_Loan" id="hl_Existing_Loan" value="<?php echo $Existing_Loan; ?>"></td>
</tr>
<tr>
	<td width="25%"><b>Existing ROI</b></td>
	<td width="25%"><input type="text" name="hl_Existing_ROI" id="hl_Existing_ROI" value="<?php echo $Existing_ROI; ?>"></td>
	<td >&nbsp;</td>
	<td >&nbsp;</td>
</tr>
<tr>
	<td style="border:1px solid black;" colspan="4" bgcolor="#DAEAF9" align="center" class="fontstyle" ><b>Personal Details</b></td></tr><tr>	<td ><b>Name</b>
	</td>
	<td ><input type="text" name="hlname" id="hlname" value="<? echo $Name;?>"> </td>
<td ><b>Email id</b></td>
	<td ><input type="text" name="hlemail" id="hlemail" value="<? echo $Email;?>"></td>
	</tr>
<tr>
	<td width="25%"><b>Mobile</b></td>
	<td width="25%">+91<input type="hidden" name="hlmobile" size="15" value="<? echo $Mobile;?>"><? echo $Mobile;?></td>
	<td ><b>DOB </b></td>
	<td ><input type="text" name="day" id="day" value="<? echo $dd;?>" size="2" maxlength="2">-<input type="text" name="month" id="month" value="<? echo $mm;?>" size="2" maxlength="2">-<input type="text" name="year" id="year" value="<? echo $year;?>" size="4" maxlength="4">(dd-mm-yyyy)</td>
</tr>
<tr>
	<td><b>Residence No.</b></td>
	<td><input type="text" name="hlstd_code" size="2" value="<? echo $Std_Code;?>" >-<input type="text" name="hllandline" size="10" value="<?echo $Landline;?>"></td>
	
	<td ><b>Office No.</b></td>
	<td ><input type="text" name="hlstd_code_o"  size="2" value="<? echo $Std_Code_O; ?>" >-<input type="text" name="hllandline_o" size="10" value="<?echo $Landline_O;?>"></td>
  </tr>
<tr>
	<td ><b>City</b></td>
	<td><!--<input type="text" name="hlcity" id="hlcity" value="<?echo $City;?>"></textarea>--><select size="1" name="hlcity" > <?=getCityList($City)?></select></td>
	<td ><b>Pincode</b></td>
	<td ><input type="text" name="hlpincode" size="10" value="<? echo $Pincode;?>" id="hlpincode"></td>
</tr>
<tr>
	<td ><b>Residence Address</b></td>
	<td  ><textarea  name="hlresiaddress" rows="2" cols="18"><? echo $Residence_Address;?></textarea></td>
	<td ><b>Other City</b></td>
	<td><!--<input type="text" name="hlcity" id="hlcity" value="<?echo $City;?>"></textarea>--><input type="text" name="hlother_city" id="hlother_city" value="<? echo $City_Other;?>"> </td>
</tr>

<tr>
	<!--<td>
		<table width="100%">
		<tr>--><td style="border:1px solid black;" colspan="4" bgcolor="#DAEAF9" align="center" class="fontstyle" ><b>Employment Details</b></td></tr>
<tr>
	<td><b>Employment Status</b></td>
	<td><select name="hlemployment_status" id="hlemployment_status">
		<option value="1" <? if($Employment_Status ==1){echo "selected"; }?>>Salaried</option>
		<option value="0" <? if($Employment_Status ==0) {echo "selected"; }?>>Self Employed</option></select>	</td>
	<td ><b>Annual Income</b></td>
	<td><input type="text" name="hlnet_salary" id="hlnet_salary" value="<? echo $Net_Salary;?>"  onKeyUp="getDigitToWords('hlnet_salary','formatedIncome','wordIncome');" onKeyPress=" getDigitToWords('hlnet_salary','formatedIncome','wordIncome');" style="float: left" onBlur="getDigitToWords('hlnet_salary','formatedIncome','wordIncome');"></td>
</tr>
<tr><td><b>Company Name</b></td><td><input type="text" name="hlcompany_name" id="hlcompany_name" value="<? echo $Company_Name?>"></td><td colspan="2"></td></tr>
<tr>
<td colspan="2">&nbsp;</td>
	<td colspan="2" ><span id='formatedIncome' style='font-size:11px; font-weight:bold;color:666699;font-Family:Verdana;'></span><span id='wordIncome' style='font-size:11px;
font-weight:bold;color:666699;font-Family:Verdana;text-transform: capitalize;'></span></td>
</tr>
<tr>
	<td style="border:1px solid black;" colspan="4" bgcolor="#DAEAF9" align="center" class="fontstyle" ><b>Other Details</b></td></tr>
<tr>
	<td><b>Loan Amount</b></td>
	<td><input type="text" name="hlloanamt" id="hlloanamt" value="<? echo $Loan_Amount;?>" onKeyUp="getDigitToWords('hlloanamt','formatedloan','wordloan');" onKeyPress="getDigitToWords('hlloanamt','formatedloan','wordloan');" style="float: left" onBlur="getDigitToWords('hlloanamt','formatedloan','wordloan');"></td>
<td ><b>Loan Time</b></td>
	<td ><select name="hlloantime" >
	<option value="-1" <? if (($Loan_Time==-1) || ($Loan_Time=="")) { echo "selected";}?>>Please select</option>
    	<OPTION value="15 days" <? if($Loan_Time =="15 days"){echo "selected"; }?>>15 days</OPTION>
	<OPTION value="1 month" <? if($Loan_Time =="1 month"){echo "selected"; }?>>1 months</OPTION>
	<OPTION value="2 months" <? if($Loan_Time =="2 months"){echo "selected"; }?>>2 months</OPTION>
	<OPTION value="3 months" <? if($Loan_Time =="3 months"){echo "selected"; }?>>3 months</OPTION>
	<OPTION value="3 months above" <? if($Loan_Time =="3 months above"){echo "selected"; }?>>more than 3 months</OPTION>
	</SELECT>	</td>
</tr>
<tr>
	<td colspan="2" ><span id='formatedloan' style='font-size:11px; font-weight:bold;color:666699;font-Family:Verdana;'></span><span id='wordloan' style='font-size:11px;
font-weight:bold;color:666699;font-Family:Verdana;text-transform: capitalize;'></span></td>
<td colspan="2">&nbsp;</td>
</tr>
<tr>
	<td><b>Property Identified</b></td>
	<td ><input type="radio" name="hlproperty_identified" <? if($Property_Identified==1){ echo "checked";}?> value="1">Yes<input type="radio" name="hlproperty_identified" <? if($Property_Identified==0){echo "checked";}?> value="0">No</td>
	<td><b>Property Location</b></td>
	<td ><input type="text" name="hlproperty_loc" value="<? echo  $Property_Loc;?>"></td>
</tr>
<tr>
	<td><b>Property Value</b></td>
<td><input type="text" name="hlProperty_Value" id="hlProperty_Value" value="<? echo $Property_Value; ?>"></td>
	<td><b>Total Obligation</b></td>
<td><input type="text" name="hlTotal_Obligation" id="hlTotal_Obligation" value="<? echo $Total_Obligation; ?>"></td>
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
<td><input type="text" name="hlCo_Applicant_Name" id="hlCo_Applicant_Name" value="<? echo $Co_Applicant_Name; ?>"></td>
	<td ><b>Co-Applicant DOB</b></td><td><input type="text" name="hlCo_Applicant_DOB" id="hlCo_Applicant_DOB" value="<? echo $Co_Applicant_DOB; ?>"></td>
</tr>
<tr>
	<td><b>Co Monthly Income:</b></td>
<td><input type="text" name="hlCo_Applicant_Income" id="hlCo_Applicant_Income" value="<? echo $Co_Applicant_Income; ?>"></td>
	<td ><b>Co Applicant Obligation</b></td><td><input type="text" name="hlCo_Applicant_Obligation" id="hlCo_Applicant_Obligation" value="<? echo $Co_Applicant_Obligation; ?>"></td>
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
	$getFedbackQuery = ExecQuery("select FeedbackID, Feedback, Followup_Date from Req_Feedback_HL where AllRequestID='".$post."' and BidderID='3635' AND Reply_Type=2");
	$num_rows = mysql_num_rows($getFedbackQuery);
		if($num_rows > 0)
		{
			echo $Feedback3635 = mysql_result($getFedbackQuery,0,'Feedback');
			$originalFeedback = $Feedback_c;
	echo "<br>";
			$followup_date3635 = mysql_result($getFedbackQuery,0,'Followup_Date');
		}
	?>
    <select name="hlfeedback" id="feedback">
		<option value="" <?if($Feedback == "" || $Feedback == "No Feedback") { echo "selected"; }?>>No Feedback</option>
		<option value="Other Product" <?if($Feedback == "Other Product") { echo "selected"; }?>>Other Product</option>
		<option value="Not Interested" <?if($Feedback == "Not Interested") { echo "selected"; }?>>Not Interested</option>
		<option value="Callback Later" <?if($Feedback == "Callback Later") { echo "selected"; }?>>Callback Later</option>
		<option value="Wrong Number" <?if($Feedback == "Wrong Number") { echo "selected"; }?>>Wrong Number</option>
		<option value="Not Contactable" <?if($Feedback == "Not Contactable") { echo "selected"; }?>>Not Contactable</option>
		<option value="Duplicate" <?if($Feedback == "Duplicate") { echo "selected"; }?>>Duplicate</option>
		<option value="Ringing" <?if($Feedback == "Ringing") { echo "selected"; }?>>Ringing</option>
		<option value="Not Eligible" <?if($Feedback == "Not Eligible") { echo "selected"; }?>>Not Eligible</option>
		<option value="FollowUp" <?if($Feedback == "FollowUp") { echo "selected"; }?>>FollowUp</option>
		<option value="Appointment" <?if($Feedback == "Appointment") { echo "selected"; }?>>Appointment</option>
		<option value="Arranging Document" <?if($Feedback == "Arranging Document") { echo "selected"; }?>>Arranging Document</option>
		<option value="Documents Pick" <?if($Feedback == "Documents Pick") { echo "selected"; }?>>Documents Pick</option>
	</select>	</td>
	<td><b>Follow Up Date</b></td>
	<td><input type="Text"  name="FollowupDate" id="FollowupDate" maxlength="25" size="15" <?php if($followup_date !='0000-00-00 00:00:00') { ?>value="<?php  echo $followup_date; ?>" <?php } ?>><a href="javascript:NewCal('FollowupDate','yyyymmdd',true,24)"><img src="images/cal.gif" width="16" height="16" border="0" alt="Pick a date"></a></td>
</tr>
<tr>
<td><b>LMS Comment</b></td>
		<td><textarea rows="2" cols="20" name="hladd_comment" id="hladd_comment" readonly><? echo $add_comment; ?></textarea></td>
		<td><b>add Comment</b></td>
		<td><textarea rows="2" cols="20" name="comment_section" id="comment_section" ><? echo $comment_section; ?></textarea></td>
</tr>
<tr>
<td><b>Selected bank</b></td>
<td><select name="checked_bidders" id="checked_bidders">
	<option value="">Please Select</option>
	<option value="Axis Bank" <?php if($checked_bidders=="Axis Bank") { echo "Selected";} ?>>Axis Bank</option>
	<option value="Bank Of Baroda" <?php if($checked_bidders=="Bank Of Baroda") { echo "Selected";} ?>>Bank Of Baroda</option>
	<option value="DHFL" <?php if($checked_bidders=="DHFL") { echo "Selected";} ?>>DHFL</option>
	<option value="LIC HFL" <?php if($checked_bidders=="LIC HFL") { echo "Selected";} ?>>LIC HFL</option>
	<option value="Sriram Housing Finance" <?php if($checked_bidders=="Sriram Housing Finance") { echo "Selected";} ?>>Sriram Housing Finance</option>
	</select></td>
	<td colspan="2">&nbsp;</td>
</tr>
<tr><td colspan="4">&nbsp;</td></tr>
 <tr>
     <td colspan="4" align="center"><br><input type="submit" class="bluebutton" value="Submit">    </td>
  </tr>
   <tr><td height="30" colspan="4" align="center" bgcolor="#E5E5E5"><b>Lead Lifecycle</b></td></tr>
  <tr><td height="30" colspan="4"><?php $sqllifecycle="Select BidderID,Dated,Feedback,Comments From feedback_bookkeeping Where (AllRequestID='".$post."' and Reply_Type=2 and leadidentifier='hlallocatelms')";
  $sqllifecycleresult = ExecQuery($sqllifecycle); 
  $lcrecordcount = mysql_num_rows($sqllifecycleresult);
  if($lcrecordcount>0)
  { echo "<table align='center' border=1><tr><td>Agentid</td><td>Feedback</td><td>Comments</td><td>Date</td></tr>";
  while($lcrow=mysql_fetch_array($sqllifecycleresult))
		{
$sqllifecyclebid=ExecQuery("Select Bidder_Name From Bidders Where (BidderID='".$lcrow["BidderID"]."' and leadidentifier='hlallocatelms')");
  $bidrow=mysql_fetch_array($sqllifecyclebid);
		echo "<tr><td>".$bidrow["Bidder_Name"]."</td><td>".$lcrow["Feedback"]."</td><td>".$lcrow["Comments"]."</td><td>".$lcrow["Dated"]."</td></tr>";

		}
		echo "</table>";
  }
  ?></td>
</tr>
</table>
</form>
</body>
</html>