<?php
 $requestid = $_REQUEST["postid"];
 $bidderid = $_REQUEST["biddt"];
require 'scripts/session_check_online.php';
require 'scripts/db_init.php';

function ccMasking($number, $maskingCharacter = 'X') 
{
	return substr($number, 0, 2) . str_repeat($maskingCharacter, strlen($number) - 4) . substr($number, -2);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		foreach($_POST as $a=>$b)
			$$a=$b;
		$comment_section = $_POST["comment_section"];
		$ccfeedback = $_POST["ccfeedback"];
		$Feedback = $ccfeedback;
		$FollowupDate  = $_POST["FollowupDate"];

	$Day = $_REQUEST['Day'];
	$Month = $_REQUEST['Month'];
	$Year = $_REQUEST['Year'];
	$DOB = $Year."-".$Month."-".$Day;
	
	$strUpdateSQL="Update Req_Loan_Personal Set Name='".$_REQUEST['Name']."',DOB='".$DOB."',Pancard='".$_REQUEST['PANCard']."', Cibilscore='".$_REQUEST['cibilScore']."', Cibilok='".$_REQUEST['cibilOk']."', company_category='".$_REQUEST['company_category']."' Where RequestID=".$_REQUEST["postid"];
	$UpdateResult = ExecQuery($strUpdateSQL);
	
	if(strlen($ccfeedback)>0 || strlen($comment_section)>0)
	{
		if($ccfeedback=="Process")
		{
			$last_updated=Date('Y-m-d');
		}
		else
		{
			$last_updated="";
		}
		$strSQL="";
		$Msg="";
		$result = ExecQuery("select FeedbackID,not_contactable_counter from Req_Feedback_PL where AllRequestID=".$requestid." and BidderID=".$bidderid." AND Reply_Type=1");
//echo "select FeedbackID,not_contactable_counter from Req_Feedback_PL where AllRequestID=".$requestid." and BidderID=".$bidderid." AND Reply_Type=4";
		
		$num_rows = mysql_num_rows($result);
		if($num_rows > 0)
		{	
			$row = mysql_fetch_array($result);
			$strSQL="Update Req_Feedback_PL Set Feedback='".$ccfeedback."',comment_section='".$comment_section."',Followup_Date='".$FollowupDate."' ";
			$strSQL=$strSQL."Where FeedbackID=".$row["FeedbackID"];



			}
		else
		{
			$strSQL="Insert into Req_Feedback_PL(AllRequestID, BidderID, Reply_Type , Feedback, Followup_Date,comment_section) Values (";
			$strSQL=$strSQL.$requestid.",".$bidderid.",1,'".$ccfeedback."','".$FollowupDate."','".$comment_section."')";
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
}
}
$followup_date="";
$ccdetails = "select Employment_Status,CC_Holder,Dated,DOB,Name,Email,Company_Name,City,City_Other,Mobile_Number,Net_Salary,Loan_Amount,Pincode,IP_Address,Add_Comment,Residence_Address,Total_Experience,Pancard, Cibilscore, Cibilok, company_category from Req_Loan_Personal Where (RequestID=".$requestid.")";
//echo $ccdetails."<br>";
$ccdetailsresult = ExecQuery($ccdetails);
$ccrow=mysql_fetch_array($ccdetailsresult);

$DOBVal = $ccrow['DOB'];
$DOBArr = explode("-",$DOBVal);
$DOBYear = $DOBArr[0];
$DOBMonth = $DOBArr[1];
$DOBDay = $DOBArr[2];
$company_category = $ccrow['company_category'];

$cc_alldetails = ExecQuery("select * from lead_allocate Where (AllRequestID=".$requestid." and BidderID=".$bidderid.")");
//echo $ccdetails."<br>";
$ccrowal=mysql_fetch_array($cc_alldetails);

if($ccrow["Employment_Status"]==0) { $emp_status="Self Employed"; } else { $emp_status="Salaried"; }

if($ccrow["CC_Holder"]==1) { $cc_holder="Yes"; }  if($ccrow["CC_Holder"]==0) { $cc_holder="No"; }
					
			if($ccrow["Card_Vintage"]==1)	{	$card_vintage="Less than 6 months";}
			elseif($ccrow["Card_Vintage"]==2)	{	$card_vintage="6 to 9 months";}
		elseif($ccrow["Card_Vintage"]==3)	{	$card_vintage="9 to 12 months";}
		elseif($ccrow["Card_Vintage"]==4)		{	$card_vintage="more than 12 months";}
		else
			{
				$card_vintage="";
			}

$ccfb_alldetails = ExecQuery("select * from Req_Feedback_PL Where (BidderID=".$bidderid." and AllRequestID=".$requestid.")");
//echo "select * from Req_Feedback_PL Where (BidderID=".$bidderid." and AllRequestID=".$requestid.")";
//echo $ccfb_alldetails."<br>";
$ccrowfb=mysql_fetch_array($ccfb_alldetails);
$Feedback= $ccrowfb["Feedback"];
$followup_date= $ccrowfb["Followup_Date"];
$comment_section= $ccrowfb["comment_section"];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script language="javascript" type="text/javascript" src="scripts/datetime.js"></script>
<title>Personal Loan</title>
<style type="text/css">
<!--
.style2 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
}
.style21 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
}
-->
</style>
<script>

function formValidate(Form){
	var a=Form.PANCard.value;
	if(a!=""){
		var regex1=/^[a-zA-Z]{5}\d{4}[a-zA-Z]{1}$/;  //this is the pattern of regular expersion
		if(regex1.test(a)== false)
			{
				alert('Please enter valid pan number');
				Form.PANCard.focus();
				return false;
			}
		if (Form.PANCard.value.charAt(3)!="P" && Form.PANCard.value.charAt(3)!="p")
			{
				alert('Please enter valid pan number');
				Form.PANCard.focus();
				return false;
			}
	 	}
	}

function numOnly(evt){
	var charCode = (evt.which) ? evt.which : event.keyCode
	 if (charCode > 31 && (charCode < 46 || charCode > 57))
	return false;

	 return true;
	}
    </script>
</head>
<body>
<form name="loan_form" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>?postid=<?echo $requestid;?>&biddt=<? echo $bidderid;?>"  onSubmit="return formValidate(document.loan_form); ">
  <input type="hidden" name="biddtnw" value="<?echo $bidderid;?>">
  <input type="hidden" name="postidnw" value="<?echo $requestid;?>">
  <table style='border:1px dotted #9C9A9C;' cellspacing="2" cellpadding="5" width="600" height="80%" align="center" border="0" >
    <tr>
      <td colspan="2" align="center" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold;">Personal loan customer details</td>
    </tr>
    <tr>
      <td width="219"><span class="style2">Full Name As Per PAN Card: </span></td>
      <td width="353"><span class="style21">
        <input type="text" name="Name" value="<? echo $ccrow["Name"]; ?>"  />
        </span></td>
    </tr>
    <tr>
      <td><span class="style2"> Date of Birth As Per PAN Card: </span></td>
      <td><span class="style21">
        <select name="Day">
          <option value="">Select Day</option>
          <option value="01" <?php if($DOBDay==01) {echo "selected";}?>>01</option>
          <option value="02" <?php if($DOBDay==02) {echo "selected";}?>>02</option>
          <option value="03" <?php if($DOBDay==03) {echo "selected";}?>>03</option>
          <option value="04" <?php if($DOBDay==04) {echo "selected";}?>>04</option>
          <option value="05" <?php if($DOBDay==05) {echo "selected";}?>>05</option>
          <option value="06" <?php if($DOBDay==06) {echo "selected";}?>>06</option>
          <option value="07" <?php if($DOBDay==07) {echo "selected";}?>>07</option>
          <option value="08" <?php if($DOBDay==08) {echo "selected";}?>>08</option>
          <option value="09" <?php if($DOBDay==09) {echo "selected";}?>>09</option>
          <option value="10" <?php if($DOBDay==10) {echo "selected";}?>>10</option>
          <?php for ($d=11;$d<=31;$d++) {?>
          <option value="<?php echo $d;?>" <?php if($DOBDay==$d) {echo "selected";}?>><?php echo $d;?></option>
          <?php }?>
        </select>
        <select name="Month">
          <option value="">Select Month</option>
          <option value="01" <?php if($DOBMonth=='01') {echo "selected";}?>>Jan</option>
          <option value="02" <?php if($DOBMonth=='02') {echo "selected";}?>>Feb</option>
          <option value="03" <?php if($DOBMonth=='03') {echo "selected";}?>>Mar</option>
          <option value="04" <?php if($DOBMonth=='04') {echo "selected";}?>>Apr</option>
          <option value="05" <?php if($DOBMonth=='05') {echo "selected";}?>>May</option>
          <option value="06" <?php if($DOBMonth=='06') {echo "selected";}?>>Jun</option>
          <option value="07" <?php if($DOBMonth=='07') {echo "selected";}?>>Jul</option>
          <option value="08" <?php if($DOBMonth=='08') {echo "selected";}?>>Aug</option>
          <option value="09" <?php if($DOBMonth=='09') {echo "selected";}?>>Sep</option>
          <option value="10" <?php if($DOBMonth=='10') {echo "selected";}?>>Oct</option>
          <option value="11" <?php if($DOBMonth=='11') {echo "selected";}?>>Nov</option>
          <option value="12" <?php if($DOBMonth=='12') {echo "selected";}?>>Dec</option>
        </select>
        <select name="Year">
          <option value="">Select Year</option>
          <?php for ($y=1950;$y<=2010;$y++) {?>
          <option value="<?php echo $y;?>" <?php if($DOBYear==$y) {echo "selected";}?>><?php echo $y;?></option>
          <?php }?>
        </select>
        </span></td>
    </tr>
    <tr>
      <td><span class="style2"> Email: </span></td>
      <td><span class="style21"><? echo $ccrow["Email"]; ?></span></td>
    </tr>
    <tr>
      <td><span class="style2"> Mobile No: </span></td>
      <td><span class="style21"><? echo ccMasking($ccrow["Mobile_Number"]);  ?></span></td>
    </tr>
    <tr>
      <td><span class="style2"> Occupation: </span></td>
      <td><span class="style21"><? echo $emp_status; ?></span></td>
    </tr>
    <tr>
      <td><span class="style2"> Company Name: </span></td>
      <td><span class="style21"><? echo $ccrow["Company_Name"]; ?></span></td>
    </tr>
    <tr>
      <td><span class="style2"> Total Experience: </span></td>
      <td><span class="style21"><? echo $ccrow["Total_Experience"]; ?></span></td>
    </tr>
    <tr>
      <td><span class="style2"> City: </span></td>
      <td><span class="style21"><? echo $ccrow["City"]; ?></span></td>
    </tr>
    <tr>
      <td><span class="style2"> Other City: </span></td>
      <td><span class="style21"><? echo $ccrow["City_Other"]; ?></span></td>
    </tr>
    <tr>
      <td><span class="style2"> Pincode: </span></td>
      <td><span class="style21"><? echo $ccrow["Pincode"]; ?></span></td>
    </tr>
    <tr>
      <td colspan="2"><table width="100%" cellpadding="0" cellspacing="0">
          <tr>
            <td width="32%" class="style2"> Card Holder: </td>
            <td width="25%" class="style21"><? echo $cc_holder; ?></td>
            <td width="23%" class="style2">Card Vintage: </td>
            <td width="20%" class="style21"><? echo $card_vintage; ?></td>
          </tr>
        </table></td>
    </tr>
    <tr>
      <td><span class="style2"> Annual Income: </span></td>
      <td><span class="style21"><? echo $ccrow["Net_Salary"]; ?></span></td>
    </tr>
    <tr>
      <td><span class="style2"> Loan Amount: </span></td>
      <td><span class="style21"><? echo $ccrow["Loan_Amount"]; ?></span></td>
    </tr>
    <tr>
      <td><span class="style2">Comments: </span></td>
      <td><span class="style21"><? echo $ccrow["Add_Comment"]; ?></span></td>
    </tr>
     <tr>
      <td><span class="style2">Company Category: </span></td>
      <td><span class="style21">
      
       <select name="company_category" id="company_category">
          <option value="" <? if($company_category== "") { echo "selected"; }?>>Please Select</option>
          <option value="Listed" <? if($company_category== "Listed") { echo "selected"; }?>>Listed</option>
          <option value="Unlisted" <? if($company_category== "Unlisted") { echo "selected"; }?>>Unlisted</option>
          <option value="Delisted" <? if($company_category== "Delisted") { echo "selected"; }?>>Delisted</option>
          <option value="Negative Profile" <? if($company_category== "Negative Profile") { echo "selected"; }?>>Negative Profile</option>
          <option value="CD To SAL" <? if($company_category== "CD To SAL") { echo "selected"; }?>>CD To SAL</option>
		</select>
        </span></td>
    </tr>

    <tr>
      <td><span class="style2">LMS Comments: </span></td>
      <td><span class="style21">
        <textarea rows="2" cols="15" name="comment_section"><? echo $ccrowfb["comment_section"]; ?></textarea>
        </span></td>
    </tr>
    <tr>
      <td><span class="style2">LMS feedback </span></td>
      <td><span class="style21">
        <select name="ccfeedback" id="ccfeedback">
          <option value="" <? if($Feedback == "") { echo "selected"; }?>>No Feedback</option>
          <option value="Ringing" <? if($Feedback == "Ringing") { echo "selected"; }?>>Ringing</option>
          <option value="Callback Later" <? if($Feedback == "Callback Later") { echo "selected"; }?>>Callback Later</option>
          <option value="Wrong Number" <? if($Feedback == "Wrong Number") { echo "selected"; }?>>Wrong Number</option>
          <option value="Not Eligible" <? if($Feedback == "Not Eligible") { echo "selected"; }?>>Not Eligible</option>
           <option value="Duplicate" <? if($Feedback == "Duplicate") { echo "selected"; }?>>Duplicate</option>
          <option value="FollowUp" <? if($Feedback == "FollowUp") { echo "selected"; }?>>FollowUp</option>
          <option value="Not Interested" <? if($Feedback == "Not Interested") { echo "selected"; }?>>Not Interested</option>
          <option value="OTP Done Ok" <? if($Feedback == "OTP Done Ok") { echo "selected"; }?> >OTP Done Ok</option>
          <option value="OTP Done Not Ok" <? if($Feedback == "OTP Done Not Ok") { echo "selected"; }?> >OTP Done Not Ok</option>
          <option value="Not Interested On Rate or Offer" <? if($Feedback == "Not Interested On Rate or Offer") { echo "selected"; }?> >Not Interested On Rate or Offer</option>
          <option value="Direct Not Interested" <? if($Feedback == "Direct Not Interested") { echo "selected"; }?> >Direct Not Interested</option>
          <option value="Not Contactable" <? if($Feedback == "Not Contactable") { echo "selected"; }?> >Not Contactable</option>
        </select>
        </span></td>
    </tr>
    <tr>
      <td class="fontstyle"><b>Follow Up Date</b></td>
      <td class="fontstyle"><input type="Text"  name="FollowupDate" id="FollowupDate" maxlength="25" size="15" <?php if($Followup_Date !='0000-00-00 00:00:00') { ?>value="<?php  echo $followup_date; ?>" <?php } ?>>
        <a href="javascript:NewCal('FollowupDate','yyyymmdd',true,24)"><img src="images/cal.gif" width="16" height="16" border="0" alt="Pick a date"></a></td>
    </tr>
    <tr>
      <td width="219"><span class="style2">Date of entry: </span></td>
      <td width="353"><span class="style21"><? echo $ccrowal["Allocation_Date"]; ?></span></td>
    </tr>
    <tr>
      <td width="219"><span class="style2">Customer IP: </span></td>
      <td width="353"><span class="style21"><? echo $ccrow["IP_Address"]; ?></span></td>
    </tr>
    <tr>
      <td><span class="style2"> PAN Card Number: </span></td>
      <td><span class="style21"> <input type="text" name="PANCard" value="<? echo $ccrow["Pancard"]; ?>"  /></span></td>
    </tr>
   <tr>
      <td width="180"><span class="style2">Cibil Ok: </span></td>
      <td width="392"><span class="style21"><input type="radio" name="cibilOk" value="1" <? if($ccrow["Cibilok"]==1) { echo "checked";} ?> />Yes&nbsp;&nbsp;&nbsp;<input type="radio" name="cibilOk" value="0" <? if($ccrow["Cibilok"]==0) { echo "checked";}?> />No</span></td>
    </tr>
    
    <tr>
      <td width="219"><span class="style2">Cibil Score: </span></td>
      <td width="353"><span class="style21"><input type="text" name="cibilScore" value="<? echo $ccrow["Cibilscore"]; ?>" maxlength="3" onkeypress="return numOnly(event)" /></span></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="Submit" name="Submit" value="Submit"></td>
    </tr>
  </table>
</form>
</body>
</html>