<?php
require 'scripts/session_check_online.php';
require 'scripts/db_init.php';

$requestid = $_REQUEST["id"];

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

$plfeedback = $_POST["plfeedback"];
$d4l_remark = $_POST["d4l_remark"];
$FollowupDate = $_POST["FollowupDate"];
$strSQL="Update customer_feedback_verified Set d4l_feedback='".$plfeedback."', d4l_remarks='".$d4l_remark."', followup_date='".$FollowupDate."', date_of_crosscheck=Now() where  custfbvdid= ".$requestid;
$strSQLresult = ExecQuery($strSQL);

}

$pldetails = "select  * from customer_feedback_verified Where (custfbvdid=".$requestid.")";
//echo $pldetails."<br>";
$pldetailsresult = ExecQuery($pldetails);
$plrow=mysql_fetch_array($pldetailsresult);
$Feedback = $plrow["d4l_feedback"];

$followup_date= $plrow["followup_date"];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Personal Loan</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<link href="includes/style.css" rel="stylesheet" type="text/css">
<script language="javascript" type="text/javascript" src="scripts/datetime.js"></script>
<style type="text/css">
<!--
.style2 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold;}
.style21 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size:12px;}
-->
</style>
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
</head>
<body>
<form name="loan_form" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>?id=<?echo $requestid;?>" >
<input type="hidden" name="id" id="id" value="<? echo $requestid; ?>">
<table style='border:1px dotted #9C9A9C;' cellspacing="2" cellpadding="5" width="600" height="80%" align="center" border="0" >
<tr><td colspan="2" align="center" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold;">Personal loan customer details</td></tr>
<tr>
        <td width="180"><span class="style2">Customer Name: </span></td>
    <td width="392"><span class="style21"><? echo $plrow["customer_name"]; ?></span></td>
  </tr>
     
     <tr>
        <td><span class="style2"> Mobile No: </span></td>
       <td><span class="style21"><? echo $plrow["mobile"]; ?></span></td>
  </tr>
    
     <tr>
        <td><span class="style2"> Company Name: </span></td>
       <td><span class="style21"><? echo $plrow["company_name"]; ?></span></td>
  </tr>
  
<tr>
        <td><span class="style2"> City: </span></td>
    <td><span class="style21"><? echo $plrow["city"]; ?></span></td>
  </tr>
    
      <tr>
        <td><span class="style2"> Annual Income: </span></td>
        <td><span class="style21"><? echo $plrow["income"]; ?></span></td>
  </tr>
     
      <tr>
        <td><span class="style2">Required Loan Amount: </span></td>
        <td><span class="style21"><? echo $plrow["loan_amount"]; ?></span></td>
     </tr>
     <tr>
        <td><span class="style2">Salary Account Bank: </span></td>
        <td><span class="style21"><? echo $plrow["account"]; ?></span></td>
     </tr>
     <tr>
        <td><span class="style2">Bank Feedback </span></td>
        <td><span class="style21"><? echo $plrow["bank_feedback"]; ?></span></td>
     </tr>
	 <tr>
        <td><span class="style2">Bank Remark </span></td>
        <td><span class="style21"><? echo $plrow["bank_remark"]; ?></span></td>
     </tr>
     <tr>
        <td width="180"><span class="style2">Date of entry: </span></td>
        <td width="392"><span class="style21"><? echo $plrow["doe"]; ?></span></td>
  </tr>
  <tr>
        <td width="180"><span class="style2">D4l Feedback: </span></td>
        <td width="392"><span class="style21"> <select name="plfeedback" id="feedback">
		<option value="No Feedback" <?if($Feedback == "") { echo "selected"; }?>>No Feedback</option>
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
        <option value="Interested But Not Convinced" <?if($Feedback == "Interested But Not Convinced") { echo "selected"; }?>>Interested But Not Convinced</option>
        <option value="Already Applied" <?if($Feedback == "Already Applied") { echo "selected"; }?>>Already Applied</option>
	</select></span></td>
  </tr>
  <tr>
        <td width="180"><span class="style2">D4l Remark </span></td>
        <td width="392"><span class="style21"><textarea rows="2" cols="20" name="d4l_remark"><? echo $plrow["d4l_remarks"]; ?></textarea></span></td>
  </tr>
  <tr>
        <td width="180"><span class="style2">FollowUp Date: </span></td>
       <td class="fontstyle"><input type="Text"  name="FollowupDate" id="FollowupDate" maxlength="25" size="15" <?php if($Followup_Date !='0000-00-00 00:00:00') { ?>value="<?php  echo $followup_date; ?>" <?php } ?>><a href="javascript:NewCal('FollowupDate','yyyymmdd',true,24)"><img src="images/cal.gif" width="16" height="16" border="0" alt="Pick a date"></a></td>
  </tr>
 <tr>
     <td colspan="4" align="center"><input type="submit" class="bluebutton" value="Submit"> 
      </td>
   </tr>
</table>
</form>
</body>
</html>
