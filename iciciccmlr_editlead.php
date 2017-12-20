<?php
require 'scripts/session_check_online.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';

	session_start();
	$post=$_REQUEST['id'];

	$bidid =$_REQUEST['Bid'];
		

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		foreach($_POST as $a=>$b)
			$$a=$b;
			
		/* FIX STRINGS */
		echo $ccfeedback = $_POST["ccfeedback"];
		$FollowupDate = $_POST["FollowupDate"];
		$ccadd_comment= $_REQUEST['ccadd_comment'];
		$which_card = $_REQUEST["which_card"];
		$appt_address = $_REQUEST["appt_address"];
		$app_time = $_REQUEST["app_time"];
		$appdate = $_REQUEST["appdate"];
		$Bidder_Id = $_REQUEST['BidderId'];
		
		
	 if(strlen($ccfeedback)>0)
	{
		$strSQL="";
		$Msg="";


$strSQL="Update icici_credit_card Set icici_comment='".$ccadd_comment."', icici_followup_date='".$FollowupDate."', icici_feedback='".$ccfeedback."'";
			$strSQL=$strSQL." Where iciciccid=".$post;
echo $strSQL;
		$result = ExecQuery($strSQL);
		if ($result == 1)
		{
		}
		else
		{
			$Msg = "** There was a problem in adding your feedback. Please try again.";
		}

	}//feedback END

	if($ccfeedback=="Appointment fixed" && (strlen($appt_address)>1 || strlen($appdate)>1))
	{
		$strSQLappt="";
		$Msgapt="";
		$resultappt = ExecQuery("select ApptID from ICICI_CCAppt_Details where AllRequestID=".$post." and BidderID=".$Bidder_Id." AND Reply_Type=4 and lead_type='mailer'");		
		$num_rows = mysql_num_rows($resultappt);
		if($num_rows > 0)
		{
			$rowapt = mysql_fetch_array($resultappt);
			
			$strSQLappt="Update ICICI_CCAppt_Details Set Appt_Address='".$appt_address."',Appt_Date='".$appdate."',Appt_Time='".$app_time."',Appt_card_name='".$which_card."',Appt_Dated=Now()";
			$strSQLappt=$strSQLappt."Where  ApptID=".$rowapt["ApptID"];
		}
		else
		{
			$strSQLappt="Insert into ICICI_CCAppt_Details(AllRequestID, BidderID, Reply_Type , Appt_Address, Appt_Date, Appt_Time, Appt_card_name, Appt_Dated,lead_type) Values (";
			$strSQLappt=$strSQLappt.$post.",".$Bidder_Id.",4,'".$appt_address."','".$appdate."','".$app_time."','".$which_card."',Now(),'mailer')";
			
		}
		//echo $strSQLappt;
		$resultappt = ExecQuery($strSQLappt);
		if ($resultappt == 1)
		{
		}
		else
		{
			$Msgapt = "** There was a problem in adding your Appointment Details. Please try again.";
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
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script type="text/javascript" src="http://www.deal4loans.com/ajax.js"></script>
<script type="text/javascript" src="http://www.deal4loans.com/ajax-dynamic-cclist.js"></script>

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

<p align="center"><b>Credit Card Lead Details </b></p>

<?php 
$viewqry="select * from icici_credit_card where icici_credit_card.iciciccid=".$post." "; 

//echo "dd".$viewqry;
$viewlead = ExecQuery($viewqry);
$viewleadscount =mysql_num_rows($viewlead);
$Name = mysql_result($viewlead,0,'icici_name');
$Mobile = mysql_result($viewlead,0,'icici_mobileno');
$Updated_Date = mysql_result($viewlead,0,'icici_dated');
$Feedback = mysql_result($viewlead,0,'icici_feedback');
$followup_date = mysql_result($viewlead,0,'icici_followup_date');
$comment_section = mysql_result($viewlead,0,'icici_comment');

$apptqry="select * From ICICI_CCAppt_Details where (AllRequestID=".$post." and BidderID=".$bidid." and lead_type='mailer')";
//echo $apptqry."<br>";
$apptlead = ExecQuery($apptqry);
$appt=mysql_fetch_array($apptlead);

?>
<style>
.fontstyle
	{
		font-family:Verdana Arial, Helvetica, sans-serif;
		font-size:12px;
	}
</style>
<form name="loan_form" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>?id=<?echo $post;?>&Bid=<? echo $bidid;?>" >
<input type="hidden" name="BidderId" value="<?echo $bidid;?>">
<table style='border:1px dotted #9C9A9C;' cellspacing="2" cellpadding="5" width="600" height="80%" align="center" border="0" >
<tr>
	<!--<td>
		<table width="100%">
		<tr>--><td style="border:1px solid black;" colspan="4" bgcolor="#DAEAF9" align="center" class="fontstyle" ><b>Personal Details</b></td></tr>
		<tr>
			<td class="fontstyle" width="150"><b> Name</b></td>
			<td class="fontstyle" width="150"><? echo $Name;?></td>
			<td class="fontstyle"><b>Mobile</b></td>
			<td class="fontstyle"><?echo $Mobile;?></td>
			</tr>
					 
		<tr>
			<td colspan="4" class="fontstyle"><input type="hidden" name="ccrequestid" id="ccrequestid" value="<?echo $post;?>"></td>
		</tr>
        <tr><td colspan="4" bgcolor="#DAEAF9" align="center" style="border:1px solid black;" ><b>Appointment Details </b></td></tr>
       <tr><td><b>Appointment Address</b></td><td colspan="3"><textarea cols="35" rows="3" name="appt_address" id="appt_address"><? echo $appt["Appt_Address"]; ?></textarea></td></tr>
        <tr><td><b>Appointment Date</b></td><td>
			<input type='Text'  name='appdate' id='appdate' maxlength='25' size='15' value="<? echo $appt["Appt_Date"];?>" tabindex="13" style="height:20px;"/>

<a href="javascript:NewCal('appdate','yyyymmdd',false,'');" ><img src='images/cal.gif' width='16' height='16' border='0' alt='Pick a date'></a></span></td><td><b>Appointment Time</b></td><td><select name="app_time" id="app_time" tabindex="14"><option value="please select">Time slab</option>
<option value="Call Before Coming" <? if($appt["Appt_Time"]=="Call Before Coming") { echo "Selected"; } ?> >Call Before Coming</option>					
<option value="8(am)-9(am)" <? if($appt["Appt_Time"]=="8(am)-9(am)") { echo "Selected"; } ?>>8(am)-9(am)</option>
<option value="9(am)-10(am)" <? if($appt["Appt_Time"]=="9(am)-10(am)") { echo "Selected"; } ?>>9(am)-10(am)</option>
<option value="10(am)-11(am)" <? if($appt["Appt_Time"]=="10(am)-11(am)") { echo "Selected"; } ?>>10(am)-11(am)</option>
<option value="11(am)-12(am)" <? if($appt["Appt_Time"]=="11(am)-12(am)") { echo "Selected"; } ?>>11(am)-12(am)</option>
<option value="12(am)-1(pm)" <? if($appt["Appt_Time"]=="12(am)-1(pm)") { echo "Selected"; } ?>>12(am)-1(pm)</option>
<option value="1(pm)-2(pm)" <? if($appt["Appt_Time"]=="1(pm)-2(pm)") { echo "Selected"; } ?>>1(pm)-2(pm)</option>
<option value="2(pm)-3(pm)" <? if($appt["Appt_Time"]=="2(pm)-3(pm)") { echo "Selected"; } ?>>2(pm)-3(pm)</option>
<option value="3(pm)-4(pm)" <? if($appt["Appt_Time"]=="3(pm)-4(pm)") { echo "Selected"; } ?>>3(pm)-4(pm)</option>
<option value="4(pm)-5(pm)" <? if($appt["Appt_Time"]=="4(pm)-5(pm)") { echo "Selected"; } ?>>4(pm)-5(pm)</option>
<option value="5(pm)-6(pm)" <? if($appt["Appt_Time"]=="5(pm)-6(pm)") { echo "Selected"; } ?>>5(pm)-6(pm)</option>
<option value="6(pm)-7(pm)" <? if($appt["Appt_Time"]=="6(pm)-7(pm)") { echo "Selected"; } ?>>6(pm)-7(pm)</option>
<option value="7(pm)-8(pm)" <? if($appt["Appt_Time"]=="7(pm)-8(pm)") { echo "Selected"; } ?>>7(pm)-8(pm)</option>
<option value="Any Time" <? if($appt["Appt_Time"]=="Any Time") { echo "Selected"; } ?>>Any Time</option>

</select>	</td></tr>
	
<tr><td><b>Required Card Name</b></td>
<td colspan="2">
<select name="which_card" id="which_card">
<option value="">Choose card</option>
<option value="ICICI Bank HPCL Platinum Credit Card" <? if($appt["Appt_card_name"]=="ICICI Bank HPCL Platinum Credit Card") { echo "Selected";} ?>>ICICI Bank HPCL Platinum Credit Card </option>
<option value="ICICI Bank HPCL Titanium Credit Card" <? if($appt["Appt_card_name"]=="ICICI Bank HPCL Titanium Credit Card") { echo "Selected";} ?>>ICICI Bank HPCL Titanium Credit Card</option>
<option value="ICICI Bank Rubyx Credit Cards" <? if($appt["Appt_card_name"]=="ICICI Bank Rubyx Credit Cards") { echo "Selected";} ?>>ICICI Bank Rubyx Credit Cards</option>
<option value="ICICI Bank Coral Credit Card" <? if($appt["Appt_card_name"]=="ICICI Bank Coral Credit Card") { echo "Selected";} ?> >ICICI Bank Coral Credit Card</option>
<option value="ICICI Bank Sapphiro Credit Cards" <? if($appt["Appt_card_name"]=="ICICI Bank Sapphiro Credit Cards") { echo "Selected";} ?>>ICICI Bank Sapphiro Credit Cards</option>
<option value="ICICI Bank Platinum Chip Credit Card" <? if($appt["Appt_card_name"]=="ICICI Bank Platinum Chip Credit Card") {  echo "Selected";} ?>>ICICI Bank Platinum Chip Credit Card</option>

</select></td></tr>
<tr><td colspan="4" bgcolor="#DAEAF9" align="center" style="border:1px solid black;" ><b>ADD Feedback </b></td></tr>
<tr>
	<td class="fontstyle"><b>Feedback</b></td>
	<td class="fontstyle"><select name="ccfeedback" id="feedback">
	<option value="" <? if($Feedback == "") { echo "selected"; } ?>>No Feedback</option>
			<option value="FollowUp" <? if($Feedback == "FollowUp") { echo "selected"; } ?>>FollowUp</option>
			<option value="Booked" <? if($Feedback == "Booked") { echo "selected"; } ?>>Approved/Booked</option>
			<option value="Not Eligible" <? if($Feedback == "Not Eligible") { echo "selected"; } ?>>Not Eligible</option>
			<option value="Not Interested" <? if($Feedback == "Not Interested") { echo "selected"; } ?>>Not Interested</option>		
			<option value="Logged In" <? if($Feedback == "Logged In") { echo "selected"; } ?>>Logged In</option>
<option value="Wrong Number" <? if($Feedback == "Wrong Number") { echo "selected"; } ?>>Wrong Number</option>
	<option value="Not contactable" <? if($Feedback == "Not contactable") { echo "selected"; } ?>>Not Contactable</option>
	<option value="Applied Thru Other Channel" <? if($Feedback == "Applied Thru Other Channel") { echo "selected"; } ?>>Applied Thru Other Channel</option>
	<option value="Booked" <? if($Feedback == "Booked") { echo "selected"; } ?>>Approved/Booked</option>
	<option value="Docs Collected" <? if($Feedback == "Docs Collected") { echo "selected"; } ?>>Docs Collected</option>
	<option value="Appointment postponed" <? if($Feedback == "Appointment postponed") { echo "selected"; } ?>>Appointment postponed</option>
	<option value="Appointment fixed" <? if($Feedback == "Appointment fixed") { echo "selected"; } ?>>Appointment fixed</option>
	</select>	</td>
	

	<td class="fontstyle"><b>Follow Up Date</b></td>
	<td class="fontstyle"><input type="Text"  name="FollowupDate" id="FollowupDate" maxlength="25" size="15" <?php if($Followup_Date !='0000-00-00 00:00:00') { ?>value="<?php  echo $followup_date; ?>" <?php } ?>><a href="javascript:NewCal('FollowupDate','yyyymmdd',true,24)"><img src="images/cal.gif" width="16" height="16" border="0" alt="Pick a date"></a></td>
</tr>
	<tr>
		<td><b>Add Comment</b></td>
		<td><textarea rows="2" cols="20" name="ccadd_comment" id="ccadd_comment" ><? echo $comment_section; ?></textarea></td>
	</tr>


 <tr>
     <td colspan="4" align="center"><p>
       <input type="submit" class="bluebutton" value="Save">
     </p>      </td>
   </tr>
</table>
</form>
</body>
</html>