<?php
require 'scripts/session_check_online.php';
require 'scripts/db_init.php';

$requestid = $_REQUEST["postid"];
$bidderid = $_REQUEST["biddt"];
//$sessbid = $_REQUEST["sessbid"];
$sessbid = $_SESSION["BidderID"];
$pldetails = "select Company_Type,Salary_Drawn,Employment_Status,Residential_Status,EMI_Paid,Card_Vintage,CC_Holder,Dated,DOB,Name,Email,Company_Name,City,City_Other,Years_In_Company,Total_Experience,Mobile_Number,Net_Salary,Loan_Any,Loan_Amount,PL_EMI_Amt,Pincode,Card_Limit,IP_Address,Add_Comment from Req_Loan_Personal Where (RequestID=".$requestid.")";
//echo $pldetails."<br>";
$pldetailsresult = ExecQuery($pldetails);
$plrow=mysql_fetch_array($pldetailsresult);

$pl_alldetails = ExecQuery("select * from Req_Feedback_Bidder_PL Where (AllRequestID=".$requestid." and BidderID=".$bidderid.")");
//echo $pldetails."<br>";
$plrowal=mysql_fetch_array($pl_alldetails);

$getCheckSql = ExecQuery("select Feedback_ID, Comments as rm_comments, Feedback as rm_feedback, BidderID as AllocatedBidderID from Req_Feedback_Comments_PL where AllRequestID= '".$_REQUEST['postid']."' and Reply_Type='1'");
$plRefeedComment =mysql_fetch_array($getCheckSql);


if($plrow["Annual_Turnover"]==1) { $annual_turnover="0-40 Lacs"; } 
else if($plrow["Annual_Turnover"]==2) { $annual_turnover="1Cr - 3Crs"; } 
else if($plrow["Annual_Turnover"]==3) { $annual_turnover="3Crs & above"; } 
else if($plrow["Annual_Turnover"]==4) { $annual_turnover="40Lacs To 1 Cr"; } 
else { $annual_turnover="";  }

if($plrow["Employment_Status"]==0) { $emp_status="Self Employed"; } else { $emp_status="Salaried"; }

if($plrow["CC_Holder"]==1) { $cc_holder="Yes"; }  if($plrow["CC_Holder"]==0) { $cc_holder="No"; }
		
			if($plrow["EMI_Paid"]==1){ $emi_paid="Less than 6 months";}
			elseif($plrow["EMI_Paid"]==2) {  $emi_paid="6 to 9 months"; }
			elseif($plrow["EMI_Paid"]==3){  $emi_paid="9 to 12 months"; }
			elseif($plrow["EMI_Paid"]==4){  $emi_paid="more than 12 months"; }
			else
			{ $emi_paid="";
			}
			if($plrow["Card_Vintage"]==1)	{	$card_vintage="Less than 6 months";}
			elseif($plrow["Card_Vintage"]==2)	{	$card_vintage="6 to 9 months";}
		elseif($plrow["Card_Vintage"]==3)	{	$card_vintage="9 to 12 months";}
		elseif($plrow["Card_Vintage"]==4)		{	$card_vintage="more than 12 months";}
		else
			{
				$card_vintage="";
			}

if($plrow["Company_Type"]==0)	{	$Company_Type="";}
if($plrow["Company_Type"]==1)	{	$Company_Type="Pvt Ltd";}
if($plrow["Company_Type"]==2)	{	$Company_Type="MNC Pvt Ltd";}
if($plrow["Company_Type"]==3)	{	$Company_Type="Limited";}
if($plrow["Company_Type"]==4)	{	$Company_Type="Govt.( Central/State )";}
if($plrow["Company_Type"]==5)	{	$Company_Type="PSU (Public sector Undertaking)";}

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$plfeedback = $_POST["plfeedback"];
	$followupdate = $_POST["followupdate"];
	
	if(strlen(trim($requestid))>0 && $bidderid>0)
	{
	
		$strSQL="";
		$Msg="";
                
                $result = ExecQuery("select FeedbackID from Req_Feedback_PL where AllRequestID=$requestid and BidderID=".$bidderid);
		$num_rows = mysql_num_rows($result);
               
		if($num_rows > 0)
		{
			$row = mysql_fetch_array($result);
			$strSQL="Update Req_Feedback_PL Set Feedback='".$plfeedback."',Followup_Date='".$followupdate."', comment_section='".$_REQUEST['lmsRemark']."'";
			$strSQL=$strSQL."Where FeedbackID=".$row["FeedbackID"];
		}
		else
		{
			$strSQL="Insert into Req_Feedback_PL(AllRequestID, BidderID, Reply_Type , Feedback, Followup_Date,comment_section) Values (";
			$strSQL=$strSQL.$requestid.",".$bidderid.",'1','".$plfeedback."','".$followupdate."','".$_REQUEST['lmsRemark']."')";
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
$plfedresult = ExecQuery("select Feedback,Followup_Date,comment_section from Req_Feedback_PL where AllRequestID=$requestid and BidderID=".$bidderid);
$plrowfedbk=mysql_fetch_array($plfedresult);
$Feedback = $plrowfedbk["Feedback"];
$followupdate = $plrowfedbk["Followup_Date"];
$comment_section = $plrowfedbk["comment_section"];
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
</style>
<? if($bidderid==5108 || $sessbid==6078)
{
}
else
{ ?>
<script type="text/javascript">
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
<link rel="stylesheet" type="text/css" href="callinglms/css-datepicker/jquery-ui.css">
		<link rel="stylesheet" type="text/css" href="callinglms/css-datepicker/datepicker.css">
		<script src="callinglms/js-datepicker/jquery-1.5.1.js"></script>
		<script src="callinglms/js-datepicker/jquery.ui.core.js"></script>
		<script src="callinglms/js-datepicker/jquery.ui.datepicker.js"></script>
<script>
		$(document).ready(function() {
			
			var date = new Date();
			var m = date.getMonth(), d = date.getDate(), y = date.getFullYear();
			
			$('#datepicker').datepicker({
					/*minDate: new Date(y, m, d+1),*/
					dateFormat: 'yy-mm-dd',
					changeMonth: true,
					changeYear: true
			});
			}); 
			$(function() {
				$( "#datepicker" ).datepicker();
				
				
			});
			
		</script> 
</head>
<body>
<? if($sessbid==6978)
{
?>
<form name="loan_form" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>?postid=<?echo $requestid;?>&biddt=<? echo $bidderid;?>&sessbid=<? echo $_SESSION['BidderID']; ?>" >
<input type="hidden" name="postid" value="<? echo $requestid;?>">
<input type="hidden" name="biddt" value="<? echo $bidderid;?>">
<input type="hidden" name="sessbid" value="<? echo $sessbid;?>">

<? 
} ?>
<table style='border:1px dotted #9C9A9C;' cellspacing="2" cellpadding="5" width="600" height="80%" align="center" border="0" >
<tr><td colspan="2" align="center" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold;">Personal loan customer details</td></tr>
<tr>
        <td width="180"><span class="style2">Customer Name: </span></td>
    <td width="392"><span class="style21"><? echo $plrow["Name"]; ?></span></td>
  </tr>
     <tr>
        <td><span class="style2"> DOB: </span></td>
       <td><span class="style21"><? echo $plrow["DOB"]; ?></span></td>
  </tr>
     <tr>
        <td><span class="style2"> Email: </span></td>
       <td><span class="style21"><? echo $plrow["Email"]; ?></span></td>
  </tr>
     <tr>
        <td><span class="style2"> Mobile No: </span></td>
       <td><span class="style21">XXXXXXXXXX<? //echo $plrow["Mobile_Number"]; ?></span></td>
  </tr>
     <tr>
        <td><span class="style2"> Occupation: </span></td>
       <td><span class="style21"><? echo $emp_status; ?></span></td>
  </tr>
     <tr>
        <td><span class="style2"> Company Name: </span></td>
       <td><span class="style21"><? echo $plrow["Company_Name"]; ?></span></td>
  </tr>
     <tr>
        <td><span class="style2"> Company Type: </span></td>
        <td><span class="style21"><? echo $Company_Type;?></span></td>
     </tr>
<tr>
        <td><span class="style2"> City: </span></td>
    <td><span class="style21"><? echo $plrow["City"]; ?></span></td>
  </tr>
     <tr>
        <td><span class="style2"> Other City: </span></td>
       <td><span class="style21"><? echo $plrow["City_Other"]; ?></span></td>
  </tr>
     <tr>
        <td><span class="style2"> Pincode: </span></td>
       <td><span class="style21"><? echo $plrow["Pincode"]; ?></span></td>
  </tr>
     <tr><td colspan="2"><table width="100%" cellpadding="0" cellspacing="0">
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
        <td><span class="style21"><? echo $plrow["Net_Salary"]; ?></span></td>
  </tr>
      <tr>
        <td><span class="style2"> Annual Turnover: </span></td>
        <td><span class="style21"><? echo $annual_turnover; ?></span></td>
  </tr>
     <tr><td colspan="2"><table width="100%" cellpadding="0" cellspacing="0">
     <tr>
        <td width="33%" class="style2"> Loan Running: </td>
        <td width="24%" class="style21"><? echo $plrow["Loan_Any"]; ?></td>
        <td width="23%" class="style2">Total EMI Paid: </td>
        <td width="20%" class="style21"><? echo $emi_paid; ?></td>
     </tr></table></td>
     </tr>
      <tr>
        <td><span class="style2">Required Loan Amount: </span></td>
        <td><span class="style21"><? echo $plrow["Loan_Amount"]; ?></span></td>
     </tr>
     <tr>
        <td><span class="style2">Current Account Bank: </span></td>
        <td><span class="style21"><? echo $plrow["Primary_Acc"]; ?></span></td>
     </tr>
     <tr>
        <td><span class="style2">Comments: </span></td>
        <td><span class="style21"><? echo $plrow["Add_Comment"]; ?></span></td>
     </tr>
     <tr>
        <td width="180"><span class="style2">Date of entry: </span></td>
        <td width="392"><span class="style21"><? echo $plrowal["Allocation_Date"]; ?></span></td>
  </tr>
  <tr>
        <td width="180"><span class="style2">Customer IP: </span></td>
        <td width="392"><span class="style21"><? echo $plrow["IP_Address"]; ?></span></td>
  </tr>
<tr>
        <td width="180"><span class="style2">Bank Feedback: </span></td>
        <td width="392"><span class="style21"><? echo $plRefeedComment["rm_feedback"]; ?></span></td>
  </tr>
<tr>
        <td width="180"><span class="style2">Bank Remarks: </span></td>
        <td width="392"><span class="style21"><? echo $plRefeedComment["rm_comments"]; ?></span></td>
  </tr>


  <? 
  echo $sessbid;
  if($sessbid==6978)
{
?>

	 <tr>
       <td><span class="style2">LMS feedback </span></td>
        <td><span class="style21"><select name="plfeedback" id="plfeedback">
		<option value="" <?if($Feedback == "") { echo "selected"; }?>>No Feedback</option>
		
		<option value="Not Interested" <?if($Feedback == "Not Interested") { echo "selected"; }?>>Not Interested</option>
                <option value="Not Eligible" <?if($Feedback == "Not Eligible") { echo "selected"; }?>>Not Eligible</option>
		
		<option value="Rescheduled" <?if($Feedback == "Rescheduled") { echo "selected"; }?>>Rescheduled</option>
		<option value="Cancelled" <?if($Feedback == "Cancelled") { echo "selected"; }?>>Cancelled</option>
		<option value="Documents Picked" <?if($Feedback == "Documents Picked") { echo "selected"; }?>>Documents Picked</option>
		<option value="Login" <?if($Feedback == "Login") { echo "selected"; }?>>Login</option>	
		<option value="Approved" <?if($Feedback == "Approved") { echo "selected"; }?>>Approved</option>
		<option value="Disbursed" <?if($Feedback == "Disbursed") { echo "selected"; }?>>Disbursed</option>
		<option value="Post Login Reject" <?if($Feedback == "Post Login Reject") { echo "selected"; }?>>Post Login Reject</option>
                
                <option value="Aligned" <?if($Feedback == "Aligned") { echo "selected"; }?>>Aligned</option>
                 <option value="Documents Incomplete" <?if($Feedback == "Documents Incomplete") { echo "selected"; }?>>Documents Incomplete</option>
                
	</select></span></td>
     </tr>
<tr>
    <td><span class="style2">LMS Remarks</span></td>
    <td><span class="style21"><textarea name="lmsRemark" id="lmsRemark"><?php echo $comment_section;?></textarea> </span></td>
    
</tr>
<tr>
        <td><span class="style2">Follow-up Date: </span></td>
        <td><span class="style21"><input type="text" name="followupdate" id="datepicker" value="<?php echo $followupdate;?>" /></span></td>
     </tr>
	   <tr><td colspan="2" align="center"><input type="Submit" name="Submit" value="Submit"></td></tr>
           
<? } ?>
</table>
<? if($sessbid==6978)
{
?>
</form>
<? } ?>
</body>
</html>
