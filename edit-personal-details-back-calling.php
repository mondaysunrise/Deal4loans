<?php
error_reporting(0);
require 'scripts/session_check_online.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';
$requestid = $_REQUEST["id"];
$bidderid = $_REQUEST["Bid"];
$Reply_Type = 12;
function ccMasking($number, $maskingCharacter = 'X') 
{
	return substr($number, 0, 2) . str_repeat($maskingCharacter, strlen($number) - 4) . substr($number, -2);
}



if($plrow["Employment_Status"]==0) { $emp_status="Self Employed"; } else { $emp_status="Salaried"; }

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		foreach($_POST as $a=>$b)
			$$a=$b;
		//print_r($_POST);
	
		$plrequestid = FixString($_POST["plrequestid"]);
		$CompanyType=$_POST["CompanyType"];
		$pladd_comment= FixString($_POST["pladd_comment"]);
		$FollowupDate= FixString($_POST["FollowupDate"]);
		$plfeedback = FixString($_POST["plfeedback"]);
		$Bidder_Id = $_REQUEST['BidderId'];
		
		$updatelead="Update Req_PL_BackCalling set Add_Comment='".$pladd_comment."',CompanyType='".$CompanyType."' where RequestID=".$plrequestid;
	//echo $updatelead."<br>";
		$updateleadresult = ExecQuery($updatelead);
		
		if(strlen($plfeedback)>0)
		{
			if($plfeedback=="Not Contactable" || $plfeedback=="Ringing" || $plfeedback=="Wrong Number" || $plfeedback=="Not Eligible")
			{
				$counter="1";
			}
			else
			{
				$counter="";
			}
		
		
		$strSQL="";
		$Msg="";
		//	echo "<br>";
		//echo "select FeedbackID,not_contactable_counter from Req_Feedback_BCalling where AllRequestID=".$plrequestid." and BidderID=".$Bidder_Id."";
		//	echo "<br>";
		$result = ExecQuery("select FeedbackID,not_contactable_counter from Req_Feedback_BCalling where AllRequestID=".$plrequestid." and BidderID=".$Bidder_Id."");		
		
		$num_rows = mysql_num_rows($result);
		if($num_rows > 0)
		{	
			$row = mysql_fetch_array($result);
			$notcontactableCounter=$row["not_contactable_counter"];
		if($plfeedback=="Not Contactable" || $plfeedback=="Ringing" || $plfeedback=="Wrong Number" || $plfeedback=="Not Eligible")
			{
				$updatedcounter=$notcontactableCounter+1;
			}
			else
			{
				$updatedcounter=$notcontactableCounter;
			}

			$strSQL="Update Req_Feedback_BCalling Set Feedback='".$plfeedback."',not_contactable_counter='".$updatedcounter."',Followup_Date='".$FollowupDate."', Caller_Name='".$_SESSION['Caller_Name']."'";
			$strSQL=$strSQL."Where FeedbackID=".$row["FeedbackID"];
			
			}
		else
		{
			$strSQL="Insert into Req_Feedback_BCalling(AllRequestID, BidderID, Reply_Type , Feedback, Followup_Date,not_contactable_counter, Caller_Name) Values (";
			$strSQL=$strSQL.$plrequestid.",".$Bidder_Id.",12,'".$plfeedback."','".$FollowupDate."','".$counter."', '".$_SESSION['Caller_Name']."')";
		
		}
	//	echo $strSQL;
		$result = ExecQuery($strSQL);
		
		
		
		}

	
}

$pldetails = "select * from Req_PL_BackCalling Where (RequestID=".$requestid.")";
//echo $pldetails."<br>";
$pldetailsresult = ExecQuery($pldetails);
$plrow=mysql_fetch_array($pldetailsresult);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Personal Loan</title>
<style type="text/css">
<!--
.style2 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold;}
.style21 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size:12px;}
-->
body{ font-family:Arial, Helvetica, sans-serif;}
</style>
<? $aa=1; if($aa == 1)
{
}
else
{ ?>
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
<? } ?>
<script language="javascript" type="text/javascript" src="scripts/datetime.js"></script>
<script language="javascript" type="text/javascript" src="scripts/common.js"></script>
</head>

<body>
 <form method="POST" action="" name="sendform">
				<input type="hidden" name="plrequestid" id="plrequestid" value="<? echo $_REQUEST['id']; ?>" />    <input type="hidden" name="BidderId" value="<? echo $bidderid; ?>" />
<table style='border:1px dotted #9C9A9C;' cellspacing="2" cellpadding="5" width="841" height="80%" align="center" border="0" >
<?php 
if(strlen($_SESSION['reportValue'])>0)
{ ?>
  <tr>
      <td colspan="4" align="center" bgcolor="#F0F0F0"><strong><?php echo $_SESSION['reportValue']; ?></strong></td>
    </tr>
<?php } ?>


  <tr>
      <td colspan="4" align="center" bgcolor="#F0F0F0" class="heading" style="border-top:1px solid #CCC; border-bottom:1px solid #CCC;"><strong>Personal Details</strong></td>
    </tr>
    <tr>
       <td valign="top" bgcolor="#F0F0F0" ><strong> ReferenceID: </strong></td>
       <td align="left" valign="top" bgcolor="#F0F0F0" ><? echo $plrow["ReferenceID"]; ?></td>
  <td valign="top" bgcolor="#F0F0F0" ><strong> CRMNumber:</strong></td>
      <td bgcolor="#F0F0F0" ><? echo $plrow["CRMNumber"]; ?></td>
  </tr>

 <tr>
      <td width="202" valign="top"> <strong>Customer Name</strong></td>
   <td  width="181" align="left" valign="top"><? echo $plrow["Name"]; ?></td>
<td  width="178" valign="top"><strong> DOB: </strong></td>
     <td  width="228"><? echo $plrow["DOB"]; ?></td>
  </tr>
     <tr>
       <td valign="top" bgcolor="#F0F0F0" ><strong> Email: </strong></td>
       <td align="left" valign="top" bgcolor="#F0F0F0" ><? echo $plrow["Email"]; ?></td>
  <td valign="top" bgcolor="#F0F0F0" ><strong> Mobile No:</strong></td>
      <td bgcolor="#F0F0F0" ><? echo ccMasking($plrow["Mobile_Number"]); ?></td>
  </tr>
     <tr>
        <td><span class="style2"> Occupation: </span></td>
       <td><span class="style21"><? echo $emp_status; ?></span></td>
         <td><span class="style2"> City: </span></td>
    <td><span class="style21"><? echo $plrow["City"]; ?></span></td>
  </tr>
  
	 <tr>
        <td><span class="style2"> Company Name: </span></td>
       <td><span class="style21"><? echo $plrow["Company_Name"]; ?></span></td>
        <td><span class="style2"> Company Type: </span></td>
        <td><span class="style21"><? echo  $plrow["ExclusiveLead"];?></span></td>
     </tr>

    
     <tr>
        <td valign="top" bgcolor="#F0F0F0"><strong> Card Holder:</strong> </td>
        <td  valign="top" bgcolor="#F0F0F0"><? echo  $plrow["cc_holder"]; ?></td>
        <td  valign="top" bgcolor="#F0F0F0"><strong>Card Vintage:</strong> </td>
        <td valign="top" bgcolor="#F0F0F0"><? echo  $plrow["card_vintage"]; ?></td>
     </tr>
     
      <tr>
        <td><span class="style2"> Annual Income: </span></td>
        <td><span class="style21"><? echo $plrow["Net_Salary"]; ?></span></td>
 
        <td><span class="style2">  CompanyType</span></td>
        <td>
        <?php $CompanyType = $plrow["CompanyType"]; ?>
        <select name="CompanyType" id="CompanyType">
    
		<option value="" <? if($CompanyType== "") { echo "selected"; } ?>>Please Select</option>
		<option value="Listed" <?php if($CompanyType=="Listed") { echo "selected"; } ?> > Listed</option>
<option value="Unlisted" <?php if($CompanyType=="Unlisted") { echo "selected"; } ?> > Unlisted </option>
</select>
</td>

     <tr>
        <td valign="top" bgcolor="#F0F0F0"><strong> Loan Running:</strong> </td>
        <td valign="top" bgcolor="#F0F0F0"><? echo $plrow["Loan_Any"]; ?></td>
        <td valign="top" bgcolor="#F0F0F0"><strong>Total EMI Paid: </strong></td>
        <td valign="top" bgcolor="#F0F0F0"><? echo $plrow["emi_paid"]; ?></td>
     </tr>
     <tr>
        <td valign="top" bgcolor="#F0F0F0"><strong> CardLimit:</strong> </td>
        <td valign="top" bgcolor="#F0F0F0"><? echo $plrow["Card_Limit"]; ?></td>
        <td valign="top" bgcolor="#F0F0F0"><strong>Total EMI Amount: </strong></td>
        <td valign="top" bgcolor="#F0F0F0"><? echo $plrow["EMIAmt"]; ?></td>
     </tr>

      <tr>
        <td><span class="style2">Required Loan Amount: </span></td>
        <td><span class="style21"><? echo $plrow["Loan_Amount"]; ?></span></td>
          <td><span class="style2">Account Bank: </span></td>
        <td><span class="style21"><? echo $plrow["Primary_Acc"]; ?></span></td>
     </tr>
     <tr>
        <td valign="top" bgcolor="#F0F0F0"><span class="style2">D4L Comments: </span></td>
        <td valign="top" bgcolor="#F0F0F0"><span class="style21"><? echo $plrow["D4lComment"]; ?></span></td>
    
        <td valign="top" bgcolor="#F0F0F0"><span class="style2">Date of entry: </span></td>
        <td valign="top" bgcolor="#F0F0F0"><span class="style21"><? echo $plrow["Updated_date"]; ?></span></td>
  </tr>
        
 <tr><td colspan="4">
   		  &nbsp;</td></tr>

<tr><td colspan="4" bgcolor="#DAEAF9" align="center" style="border:1px solid black;" ><b>ADD Feedback </b></td></tr>
<tr>
	<td class="fontstyle"><b>Feedback</b></td>
	<td class="fontstyle">
    <?php
  //  echo "select FeedbackID, Feedback from Req_Feedback_BCalling where AllRequestID='".$requestid."' and BidderID='".$bidderid."'";
	$getFedbackQuery = ExecQuery("select FeedbackID,Followup_Date, Feedback from Req_Feedback_BCalling where AllRequestID='".$requestid."' and BidderID='".$bidderid."'");
	$num_rows = mysql_num_rows($getFedbackQuery);
		if($num_rows > 0)
		{
			$Feedback = mysql_result($getFedbackQuery,0,'Feedback');
			
			$Followup_Date= mysql_result($getFedbackQuery,0,'Followup_Date');
		}
	?>
    <select name="plfeedback" id="feedback">
    
		<option value="All" <? if($Feedback == "All") { echo "selected"; } ?>>All</option>
		<option value="" <? if($Feedback == "") { echo "selected"; } ?>>No Feedback</option>
		<option value="Not Eligible" <? if($Feedback == "Not Eligible") { echo "selected"; }?>>Not Eligible</option>
                <option value="Not Contactable" <? if($Feedback == "Not Contactable") { echo "selected"; }?>>Not Contactable</option>
		<option value="Not Interested Direct" <? if($Feedback == "Not Interested Direct") { echo "selected"; } ?>>Not Interested Direct</option>
		<option value="Not Interested Offer" <? if($Feedback == "Not Interested Offer") { echo "selected"; } ?>>Not Interested Offer</option>
		<option value="Taken From Competition" <? if($Feedback == "Taken From Competition") { echo "selected"; } ?>>Taken From Competition</option>
		<option value="Already Applied In HDFC" <? if($Feedback == "Already Applied In HDFC") { echo "selected"; } ?>>Already Applied In HDFC</option>
		<option value="Callback Later" <? if($Feedback == "Callback Later") { echo "selected"; } ?>>Callback Later</option>
		<option value="Ringing" <? if($Feedback == "Ringing") { echo "selected"; }?>>Ringing</option>
		<option value="FollowUp" <? if($Feedback == "FollowUp") { echo "selected"; } ?>>FollowUp</option>
		<option value="Appointment" <? if($Feedback == "Appointment") { echo "selected"; } ?>>Appointment</option>
		<option value="Login" <? if($Feedback == "Login") { echo "selected"; } ?>>Login</option>
		<option value="Documents Pick" <? if($Feedback == "Documents Pick") { echo "selected"; } ?>>Documents Pick</option>
        <option value="Post Login Reject" <? if($Feedback == "Post Login Reject") { echo "selected"; }?>>Post Login Reject</option>
        <option value="Disbursed" <? if($Feedback == "Disbursed") { echo "selected"; }?>>Disbursed</option>
        <option value="Approved" <? if($Feedback == "Approved") { echo "selected"; }?>>Approved</option>
		

	</select>
	</td>
	<td class="fontstyle"><b>Follow Up Date</b></td>
	<td class="fontstyle"><input type="Text"  name="FollowupDate" id="FollowupDate" maxlength="25" size="15" <?php if($Followup_Date !='0000-00-00 00:00:00') { ?>value="<?php  echo $Followup_Date; ?>" <?php } ?> /><a href="javascript:NewCal('FollowupDate','yyyymmdd',true,24)"><img src="images/cal.gif" width="16" height="16" border="0" alt="Pick a date" /></a></td>
</tr>
	<tr><td colspan="2">&nbsp;</td>
		<td><b>Add Comment</b></td>
		<td><textarea rows="2" cols="20" name="pladd_comment" id="pladd_comment" ><? echo $plrow["Add_Comment"]; ?></textarea></td>
	</tr>
 <tr>
     <td colspan="4" align="center"><input type="submit" class="bluebutton" value="Submit" /> 
      </td>
   </tr>
</table>
</form>
</body>
</html>