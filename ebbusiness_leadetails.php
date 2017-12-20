<?php
require 'scripts/session_check_online.php';
require 'scripts/db_init.php';

$requestid = $_REQUEST["id"];

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

$plfeedback = $_POST["plfeedback"];
$d4l_remark = $_POST["d4l_remark"];
$FollowupDate = $_POST["FollowupDate"];
$strSQL="Update Req_EBBusiness_Leads Set eb_feedback='".$plfeedback."', eb_remarks='".$d4l_remark."', followup_date='".$FollowupDate."', date_of_crosscheck=Now() where  custfbvdid= ".$requestid;
$strSQLresult = ExecQuery($strSQL);

if(isset($_POST["eb_exist_loan_1"]) && strlen($_POST["eb_exist_loan_1"])>0 && $_POST["entry1"]=="")
	{
	$eb_exist_loan_1=$_POST["eb_exist_loan_1"]; $eb_bankname_1=$_POST["eb_bankname_1"]; $eb_roi_1=$_POST["eb_roi_1"]; $eb_tenure_1=$_POST["eb_tenure_1"]; $eb_emi_1=$_POST["eb_emi_1"]; $eb_existloanamt_1=$_POST["eb_existloanamt_1"]; $eb_month_1=$_POST["eb_month_1"]; $eb_year_1=$_POST["eb_year_1"];
	$ebchqry1="INSERT INTO `EBBusiness_leads_credithistory` (`ebch_loan_type`, `ebch_bank_name`, `ebch_roi`, `ebch_tenure`, `ebch_emi`, `ebch_loan_amount`, `ebch_loan_month`, `ebch_loan_year`, `ebch_dated`, `ebleadid`, ebch_sequence) VALUES ('".$eb_exist_loan_1."', '".$eb_bankname_1."', '".$eb_roi_1."', '".$eb_tenure_1."', '".$eb_emi_1."', '".$eb_existloanamt_1."', '".$eb_month_1."', '".$eb_year_1."', Now(), '".$requestid."','1')";
		$strSQLresult = ExecQuery($ebchqry1);
	}
if(isset($_POST["eb_exist_loan_2"]) && strlen($_POST["eb_exist_loan_2"])>0 && $_POST["entry2"]=="")
	{
	$eb_exist_loan_2=$_POST["eb_exist_loan_2"]; $eb_bankname_2=$_POST["eb_bankname_2"]; $eb_roi_2=$_POST["eb_roi_2"]; $eb_tenure_2=$_POST["eb_tenure_2"]; $eb_emi_2=$_POST["eb_emi_2"]; $eb_existloanamt_2=$_POST["eb_existloanamt_2"]; $eb_month_2=$_POST["eb_month_2"]; $eb_year_2=$_POST["eb_year_2"];
	$ebchqry2="INSERT INTO `EBBusiness_leads_credithistory` (`ebch_loan_type`, `ebch_bank_name`, `ebch_roi`, `ebch_tenure`, `ebch_emi`, `ebch_loan_amount`, `ebch_loan_month`, `ebch_loan_year`, `ebch_dated`, `ebleadid`, ebch_sequence) VALUES ('".$eb_exist_loan_2."', '".$eb_bankname_2."', '".$eb_roi_2."', '".$eb_tenure_2."', '".$eb_emi_2."', '".$eb_existloanamt_2."', '".$eb_month_2."', '".$eb_year_2."', Now(), '".$requestid."','2')";
		$strSQLresult = ExecQuery($ebchqry2);
	}
if(isset($_POST["eb_exist_loan_3"]) && strlen($_POST["eb_exist_loan_3"])>0 && $_POST["entry3"]=="")
	{
	$eb_exist_loan_3=$_POST["eb_exist_loan_3"]; $eb_bankname_3=$_POST["eb_bankname_3"]; $eb_roi_3=$_POST["eb_roi_3"]; $eb_tenure_3=$_POST["eb_tenure_3"]; $eb_emi_3=$_POST["eb_emi_3"]; $eb_existloanamt_3=$_POST["eb_existloanamt_3"]; $eb_month_3=$_POST["eb_month_3"]; $eb_year_3=$_POST["eb_year_3"];

	$ebchqry3="INSERT INTO `EBBusiness_leads_credithistory` (`ebch_loan_type`, `ebch_bank_name`, `ebch_roi`, `ebch_tenure`, `ebch_emi`, `ebch_loan_amount`, `ebch_loan_month`, `ebch_loan_year`, `ebch_dated`, `ebleadid` , ebch_sequence) VALUES ('".$eb_exist_loan_3."', '".$eb_bankname_3."', '".$eb_roi_3."', '".$eb_tenure_3."', '".$eb_emi_3."', '".$eb_existloanamt_3."', '".$eb_month_3."', '".$eb_year_3."', Now(), '".$requestid."', '3')";
		$strSQLresult = ExecQuery($ebchqry3);
	}
}

$pldetails = "select  * from Req_EBBusiness_Leads Where (ebleadid=".$requestid.")";
//echo $pldetails."<br>";
$pldetailsresult = ExecQuery($pldetails);
$plrow=mysql_fetch_array($pldetailsresult);
$Feedback = $plrow["eb_feedback"];
$followup_date= $plrow["followup_date"];

$ebchdetails = "select  * from EBBusiness_leads_credithistory Where (ebleadid=".$requestid.")";
$ebchdetailsresult = ExecQuery($ebchdetails);
while($row1=mysql_fetch_array($ebchdetailsresult))
{
	$ebleadchid[]=$row1["ebleadchid"];
	$leadseq[]=$row1["ebch_sequence"];	
		$eb_exist_loan_1[] = $row1["ebch_loan_type"]; 
		$eb_bankname_1[] = $row1["ebch_bank_name"]; 
		$eb_roi_1[] = $row1["ebch_roi"]; 
		$eb_tenure_1[] = $row1["ebch_tenure"]; 
		$eb_emi_1[] = $row1["ebch_emi"]; 
		$eb_existloanamt_1[] = $row1["ebch_loan_amount"]; 
		$eb_month_1[] = $row1["ebch_loan_month"]; 
		$eb_year_1[] = $row1["ebch_loan_year"];
}

//echo "hello".$leadseq[0];
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
<script type="text/JavaScript">
function existloany(a)
{
	if(a==1)
	{
		if(document.getElementById("divfaq1").style.display=='none')
		{
			document.getElementById("divfaq1").style.display='';
		}
		else
		{		}
	}
	else if(a==2)
	{
		if(document.getElementById("divfaq1").style.display=='')
		{
			document.getElementById("divfaq1").style.display='none';
		}
		else
		{		}		
	}
		
}
</script>
</head>
<body>
<form name="loan_form" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>?id=<?echo $requestid;?>" >
<input type="hidden" name="id" id="id" value="<? echo $requestid; ?>">
<table style='border:1px dotted #9C9A9C;' cellspacing="2" cellpadding="5" width="600" height="80%" align="center" border="0" >
<tr><td colspan="2" align="center" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold;">Personal loan customer details</td></tr>
<tr>
        <td width="180"><span class="style2">Customer Name: </span></td>
    <td width="392"><span class="style21"><? echo $plrow["eb_name"]; ?></span></td>
  </tr>
     <tr>
        <td><span class="style2"> Mobile No: </span></td>
       <td><span class="style21"><? echo $plrow["eb_mobile_number"]; ?></span></td>
  </tr>
   <tr>
        <td><span class="style2"> Email: </span></td>
       <td><span class="style21"><? echo $plrow["eb_email"]; ?></span></td>
  </tr>
   <tr>
        <td><span class="style2"> DOB: </span></td>
       <td><span class="style21"><? echo $plrow["eb_dob"]; ?></span></td>
  </tr>    
     <tr>
        <td><span class="style2"> Company Name: </span></td>
       <td><span class="style21"><? echo $plrow["eb_company_name"]; ?></span></td>
  </tr>  
<tr>
        <td><span class="style2"> City: </span></td>
    <td><span class="style21"><? echo $plrow["eb_city"]; ?></span></td>
  </tr>    
      <tr>
        <td><span class="style2"> Annual Income: </span></td>
        <td><span class="style21"><? echo $plrow["eb_net_salary"]; ?></span></td>
  </tr>     
      <tr>
        <td><span class="style2">Required Loan Amount: </span></td>
        <td><span class="style21"><? echo $plrow["eb_loan_amount"]; ?></span></td>
     </tr>
     <tr>
        <td><span class="style2">Loan Amount taken from Bank: </span></td>
        <td><span class="style21"><? echo $plrow["eb_bank_name"]; ?></span></td>
     </tr>
     <tr>
        <td><span class="style2">ROI</span></td>
        <td><span class="style21"><? echo $plrow["eb_roi"]; ?></span></td>
     </tr>
	 <tr>
        <td><span class="style2">Tenure </span></td>
        <td><span class="style21"><? echo $plrow["eb_tenure"]; ?></span></td>
     </tr>
     <tr>
        <td width="180"><span class="style2">EMI: </span></td>
        <td width="392"><span class="style21"><? echo $plrow["eb_emi"]; ?></span></td>
  </tr>
	 <tr>
        <td width="180"><span class="style2">Existing Loan </span></td>
        <td width="392"><span class="style21"><input type="radio" name="existing_loanflag" id="existing_loanflag" value="1" onClick="return existloany(1);">Yes <input type="radio" name="existing_loanflag" id="existing_loanflag" value="2" onClick="return existloany(2);">No</span></td>
  </tr>
  <tr>
        <td width="180" colspan="2">
		<?
//echo "helldddo".$row1["ebch_sequence"];
if($leadseq[0]>0)
		{ ?>
			<div  id="divfaq1">
		<? }
		else
		{ ?>
		<div style="display:none;" id="divfaq1">
		<? } ?>
			<table cellpadding="5" cellspacing="0" border=1 width="100%">
				<tr>
					<td>Loan Type</td>
					<td>Bank Name</td>
					<td>ROI</td>
					<td>Loan Taken (Month)</td>
					<td>Loan Taken (Year)</td>
					<td>Total Loan taken</td>
					<td>Tenure</td>
					<td>EMI</td>
				</tr>
				<tr>				
					<td><select name="eb_exist_loan_1" id="eb_exist_loan_1"><option value="">Please Select</option><option value="Home Loan" <? if($eb_exist_loan_1[0] == "Home Loan") { echo "selected"; }?>>Home Loan</option><option value="Personal Loan" <? if($eb_exist_loan_1[0] == "Personal Loan") { echo "selected"; }?>>Personal Loan</option><option value="Car Loan" <? if($eb_exist_loan_1[0] == "Car Loan") { echo "selected"; }?>>Car Loan</option><option value="Education Loan" <? if($eb_exist_loan_1[0] == "Education Loan") { echo "selected"; }?>>Education Loan</option><option value="Gold Loan" <? if($eb_exist_loan_1[0] == "Gold Loan") { echo "selected"; }?>>Gold Loan</option><option value="Other" <? if($eb_exist_loan_1[0] == "Other") { echo "selected"; }?>>Other</option></select></td>
					<td><input type="text" name="eb_bankname_1" id="eb_bankname_1" value="<? echo $eb_bankname_1[0]; ?>"></td>
					<td><input type="text" name="eb_roi_1" id="eb_roi_1" style="width:25px;" value="<? echo $eb_roi_1[0]; ?>"></td>
					<td><select name="eb_month_1" id="eb_month_1"><option value="Jan" <? if($$eb_month_1[0] == "Jan") { echo "selected"; }?>>Jan</option>
					<option value="Jan" <? if($eb_month_1[0] == "Jan") { echo "selected"; }?>>Jan</option>
					<option value="Feb" <? if($eb_month_1[0] == "Feb") { echo "selected"; }?>>Feb</option>
					<option value="March" <? if($eb_month_1[0] == "March") { echo "selected"; }?>>March</option>
					<option value="April" <? if($eb_month_1[0] == "April") { echo "selected"; }?>>April</option>
					<option value="May" <? if($eb_month_1[0] == "May") { echo "selected"; }?>>May</option>
					<option value="June" <? if($eb_month_1[0] == "June") { echo "selected"; }?>>June</option>
					<option value="July" <? if($eb_month_1[0] == "July") { echo "selected"; }?>>July</option>
					<option value="Aug" <? if($eb_month_1[0] == "Aug") { echo "selected"; }?>>Aug</option>
					<option value="Sep" <? if($eb_month_1[0] == "Sep") { echo "selected"; }?>>Sep</option>	
					<option value="Oct" <? if($eb_month_1[0] == "Oct") { echo "selected"; }?>>Oct</option>
					<option value="Nov" <? if($eb_month_1[0] == "Nov") { echo "selected"; }?>>Nov</option>
					<option value="Dec" <? if($eb_month_1[0] == "Dec") { echo "selected"; }?>>Dec</option>
					</select></td>
						<td><input type="text" name="eb_year_1" id="eb_year_1" maxlength="4" style="width:25px;" value="<? echo $eb_year_1[0]; ?>"></td>
					<td><input type="text" name="eb_existloanamt_1" id="eb_existloanamt_1" style="width:80px;" value="<? echo $eb_existloanamt_1[0]; ?>"></td>
					<td><input type="text" name="eb_tenure_1" id="eb_tenure_1" style="width:30px;" value="<? echo $eb_tenure_1[0]; ?>"></td>
					<td><input type="text" name="eb_emi_1" id="eb_emi_1" style="width:30px;" value="<? echo $eb_emi_1[0]; ?>"><input type="hidden" name="entry1" id="entry1" value="<? echo $ebleadchid[0]; ?>"></td>
				</tr>
				<tr>
					<td><select name="eb_exist_loan_2" id="eb_exist_loan_2"><option value="">Please Select</option><option value="Home Loan" <? if($eb_exist_loan_1[1] == "Home Loan") { echo "selected"; }?>>Home Loan</option>
<option value="Personal Loan" <? if($eb_exist_loan_1[1] == "Personal Loan") { echo "selected"; }?>>Personal Loan</option>
<option value="Car Loan" <? if($eb_exist_loan_1[1] == "Car Loan") { echo "selected"; }?>>Car Loan</option>
<option value="Education Loan" <? if($eb_exist_loan_1[1] == "Education Loan") { echo "selected"; }?>>Education Loan</option>
<option value="Gold Loan" <? if($eb_exist_loan_1[1] == "Gold Loan") { echo "selected"; }?>>Gold Loan</option>
<option value="Other" <? if($eb_exist_loan_1[1] == "Other") { echo "selected"; }?>>Other</option></select></td>
					<td><input type="text" name="eb_bankname_2" id="eb_bankname_2" value="<? echo $eb_bankname_1[1]; ?>"></td>
					<td><input type="text" name="eb_roi_2" id="eb_roi_2" style="width:25px;" value="<? echo $eb_roi_1[1]; ?>"></td>
					<td><select name="eb_month_2" id="eb_month_2"><option value="Jan" <? if($eb_month_1[1] == "Jan") { echo "selected"; }?>>Jan</option>
<option value="Feb" <? if($eb_month_1[1] == "Feb") { echo "selected"; }?>>Feb</option>
<option value="March" <? if($eb_month_1[1] == "March") { echo "selected"; }?>>March</option>
<option value="April" <? if($eb_month_1[1] == "April") { echo "selected"; }?>>April</option>
<option value="May" <? if($eb_month_1[1] == "May") { echo "selected"; }?>>May</option>
<option value="June" <? if($eb_month_1[1] == "June") { echo "selected"; }?>>June</option>
<option value="July" <? if($eb_month_1[1] == "July") { echo "selected"; }?>>July</option>
<option value="Aug" <? if($eb_month_1[1] == "Aug") { echo "selected"; }?>>Aug</option>
<option value="Sep" <? if($eb_month_1[1] == "Sep") { echo "selected"; }?>>Sep</option>	
<option value="Oct" <? if($eb_month_1[1] == "Oct") { echo "selected"; }?>>Oct</option>
<option value="Nov" <? if($eb_month_1[1] == "Nov") { echo "selected"; }?>>Nov</option>
<option value="Dec" <? if($eb_month_1[1] == "Dec") { echo "selected"; }?>>Dec</option></select></td>
						<td><input type="text" name="eb_year_2" id="eb_year_2" maxlength="4" style="width:25px;" value="<? echo $eb_year_1[1]; ?>"></td>
					<td><input type="text" name="eb_existloanamt_2" id="eb_existloanamt_2" style="width:80px;" value="<? echo $eb_existloanamt_1[1]; ?>"></td>
					<td><input type="text" name="eb_tenure_2" id="eb_tenure_2" style="width:30px;" value="<? echo $eb_tenure_1[1]; ?>"></td>
					<td><input type="text" name="eb_emi_2" id="eb_emi_2" style="width:30px;" value="<? echo $eb_emi_1[1]; ?>"><input type="hidden" name="entry2" id="entry2" value="<? echo $ebleadchid[1]; ?>"></td>
				</tr>
				<tr>
					<td><select name="eb_exist_loan_3" id="eb_exist_loan_3"><option value="">Please Select</option><option value="Home Loan" <? if($eb_exist_loan_1[2] == "Home Loan") { echo "selected"; }?>>Home Loan</option>
<option value="Personal Loan" <? if($eb_exist_loan_1[2] == "Personal Loan") { echo "selected"; }?>>Personal Loan</option>
<option value="Car Loan" <? if($eb_exist_loan_1[2] == "Car Loan") { echo "selected"; }?>>Car Loan</option>
<option value="Education Loan" <? if($eb_exist_loan_1[2] == "Education Loan") { echo "selected"; }?>>Education Loan</option>
<option value="Gold Loan" <? if($eb_exist_loan_1[2] == "Gold Loan") { echo "selected"; }?>>Gold Loan</option>
<option value="Other" <? if($eb_exist_loan_1[2] == "Other") { echo "selected"; }?>>Other</option></select></td>
					<td><input type="text" name="eb_bankname_3" id="eb_bankname_3" value="<? echo $eb_bankname_1[2]; ?>"></td>
					<td><input type="text" name="eb_roi_3" id="eb_roi_3" style="width:25px;"></td>
					<td><select name="eb_month_3" id="eb_month_3"><option value="Jan" <? if($eb_month_1[2] == "Jan") { echo "selected"; }?>>Jan</option>
<option value="Feb" <? if($eb_month_1[2] == "Feb") { echo "selected"; }?>>Feb</option>
<option value="March" <? if($eb_month_1[2] == "March") { echo "selected"; }?>>March</option>
<option value="April" <? if($eb_month_1[2] == "April") { echo "selected"; }?>>April</option>
<option value="May" <? if($eb_month_1[2] == "May") { echo "selected"; }?>>May</option>
<option value="June" <? if($eb_month_1[2] == "June") { echo "selected"; }?>>June</option>
<option value="July" <? if($eb_month_1[2] == "July") { echo "selected"; }?>>July</option>
<option value="Aug" <? if($eb_month_1[2] == "Aug") { echo "selected"; }?>>Aug</option>
<option value="Sep" <? if($eb_month_1[2] == "Sep") { echo "selected"; }?>>Sep</option>	
<option value="Oct" <? if($eb_month_1[2] == "Oct") { echo "selected"; }?>>Oct</option>
<option value="Nov" <? if($eb_month_1[2] == "Nov") { echo "selected"; }?>>Nov</option>
<option value="Dec" <? if($eb_month_1[2] == "Dec") { echo "selected"; }?>>Dec</option></select></td>
						<td><input type="text" name="eb_year_3" id="eb_year_3" maxlength="4" style="width:25px;"></td>
					<td><input type="text" name="eb_existloanamt_3" id="eb_existloanamt_3" style="width:80px;"></td>
					<td><input type="text" name="eb_tenure_3" id="eb_tenure_3" style="width:30px;"></td>
					<td><input type="text" name="eb_emi_3" id="eb_emi_3" style="width:30px;"><input type="hidden" name="entry3" id="entry3" value="<? echo $ebleadchid[2]; ?>"></td>
				</tr>
			</table></div></td>        
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
	</select></span></td>
  </tr>
  <tr>
        <td width="180"><span class="style2">D4l Remark </span></td>
        <td width="392"><span class="style21"><textarea rows="2" cols="20" name="d4l_remark"><? echo $plrow["eb_remarks"]; ?></textarea></span></td>
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
