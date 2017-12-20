<?php
require 'scripts/session_check_online.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';

$requestid = $_REQUEST["postid"];
$bidderid = $_REQUEST["biddt"];

$hldetails = "select Followup_Date,sendnow_flag,Dated,HL_RequestID, Gender, Email, Name, DOB, Mobile_Number, Pancard, Employment_Status, Residence_Address, Pincode, Net_Salary, City, City_Other, Loan_Amount, IP_Address, Disposition from Req_Loan_Home_Extrafields Where (HL_RequestID=".$requestid.")";
$hldetailsresult = ExecQuery($hldetails);
$recordcount = mysql_num_rows($hldetailsresult);

if($recordcount>0)
{
	$hlrow=mysql_fetch_array($hldetailsresult);
	$varCmbFeedback = $hlrow["Disposition"];
	$HL_RequestID = $hlrow["HL_RequestID"];
	$datasendnow_flag= $hlrow["sendnow_flag"];//
	$followup_date= $hlrow["Followup_Date"];//
}
else
{
	$hldetails = "select Dated, Gender, Email, Name, DOB, Mobile_Number, Pancard, Employment_Status, Residence_Address, Pincode, Net_Salary, City, City_Other, Loan_Amount, IP_Address from Req_Loan_Home Where (RequestID=".$requestid.")";
	$hldetailsresult = ExecQuery($hldetails);
	$hlrow=mysql_fetch_array($hldetailsresult);

}


if($hlrow["Employment_Status"]==0) { $emp_status="Self Employed"; } else { $emp_status="Salaried"; }

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		foreach($_POST as $a=>$b)
			$$a=$b;

	$hlname= $_POST["hlname"]; //
	$hldob= $_POST["hldob"];//
	$hlemail= $_POST["hlemail"];//
	$hlmobile= $_POST["hlmobile"];//
	$hlgender = $_POST["hlgender"];
	$hlemployment_status= $_POST["hlemployment_status"];
	$hlipaddress= $_POST["hlipaddress"];
	$pancard= $_POST["pancard"];
	$hlresiaddress= $_POST["hlresiaddress"];
	$hlpincode= $_POST["hlpincode"];
	$hlstate= $_POST["hlstate"];
	$hlsalary= $_POST["hlsalary"];//
	$hlcity= $_POST["hlcity"];//
	$hlcityother= $_POST["hlcityother"];//
	$hlloanamt= $_POST["hlloanamt"];//
	$HL_RequestID= $_POST["HL_RequestID"];//
	$hlipaddress= $_POST["hlipaddress"];//
	$cmbfeedback= $_POST["cmbfeedback"];//
	$sendnow_flag= $_POST["sendnow_flag"];//
	$FollowupDate= $_POST["FollowupDate"];//

	if(strlen($cmbfeedback)>0 && $cmbfeedback=="Send for CIBIL" && $sendnow_flag==0)
	{
		$lastupdated=1;
		$strlast_updated=", last_updated=Now(), sendnow_flag=1";
	}
	else
	{
		$lastupdated=0;
		$strlast_updated="";
	}
	
	if($HL_RequestID>0)
	{
		$InsertProductSql = "Update Req_Loan_Home_Extrafields set HL_RequestID='$requestid', Name='$hlname', Email='$hlemail', DOB='$hldob', Gender='$hlgender', Mobile_Number='$hlmobile', City='$hlcity', City_Other='$hlcityother', Residence_Address='$hlresiaddress', Residence_State='$hlstate', Employment_Status='$hlemployment_status', Pincode='$hlpincode',Net_Salary='$hlsalary', Loan_Amount='$hlloanamt',Pancard='$pancard', source='BOB', Disposition='$cmbfeedback'".$strlast_updated.", Followup_Date='$FollowupDate' where HL_RequestID=".$requestid; 
	}
	else
	{
		$InsertProductSql = "INSERT INTO Req_Loan_Home_Extrafields (HL_RequestID, Name, Email, DOB, Gender, Pancard, City, City_Other, Residence_Address, Residence_State, Employment_Status, Pincode, Mobile_Number, Net_Salary, Loan_Amount, Dated, source, IP_Address, Disposition, sendnow_flag, Followup_Date) VALUES ('$requestid','$hlname', '$hlemail', '$hldob', '$hlgender', '$pancard','$hlcity', '$hlcityother', '$hlresiaddress', '$hlstate', '$hlemployment_status', '$hlpincode', '$hlmobile', '$hlsalary', '$hlloanamt', Now(), 'BOB', '$hlipaddress', '$cmbfeedback','$sendnow_flag', '$FollowupDate')"; 

	}
	//echo $InsertProductSql;
			$InsertProductSqlresult = ExecQuery($InsertProductSql);
}



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Home Loan</title>
<style type="text/css">
<!--
.style2 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold;}
.style21 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size:12px;}
-->
</style>
<script language="javascript" type="text/javascript" src="scripts/datetime.js"></script>
</head>
<body>
<form name="loan_form" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>?postid=<?echo $requestid;?>&biddt=<? echo $bidderid;?>" >
<input type="hidden" name="biddtnw" value="<? echo $bidderid; ?>">
<input type="hidden" name="postidnw" value="<? echo $requestid; ?>">
<input type="hidden" name="HL_RequestID" value="<? echo $HL_RequestID; ?>">
<input type="hidden" name="sendnow_flag" value="<? echo $datasendnow_flag; ?>">
<table style='border:1px dotted #9C9A9C;' cellspacing="2" cellpadding="5" width="600" height="80%" align="center" border="0" >
<tr><td colspan="2" align="center" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold;">Home Loan Customer Details</td></tr>
<tr>
    <td width="180"><span class="style2">Customer Name: </span></td>
    <td width="392"><span class="style21"><input type="text" name="hlname" id="hlname" value="<? echo $hlrow["Name"];?>" ></span></td>
  </tr>
     <tr>
        <td><span class="style2"> DOB: </span></td>
       <td><span class="style21"><input type="text" name="hldob" id="hldob" value="<? echo $hlrow["DOB"]; ?>" ></span></td>
  </tr>
     <tr>
        <td><span class="style2"> Email: </span></td>
       <td><span class="style21"><input type="text" name="hlemail" id="hlemail" value="<? echo $hlrow["Email"]; ?>"></span></td>
  </tr>
     <tr>
        <td><span class="style2"> Mobile No: </span></td>
       <td><span class="style21"><input type="text" name="hlmobile" id="hlmobile" value="<? echo $hlrow["Mobile_Number"]; ?>"></span></td>
  </tr>
   <tr>
        <td><span class="style2"> Gender: </span></td>
       <td><span class="style21"><input type="radio" value="1" name="hlgender" id="hlgender" <? if($hlrow["Gender"]==1){ echo "checked";}?> class="NoBrdr" checked>Male
     <input type="radio" value="2" name="hlgender"  id="hlgender" class="NoBrdr" <?if($hlrow["Gender"]==2){ echo "checked";}?>>Female</span></td>
  </tr>
    <tr>
        <td><span class="style2"> Pan No: </span></td>
       <td><span class="style21"><input type="text" id="pancard" name="pancard" value="<? echo $hlrow["Pancard"]; ?>"></span></td>
  </tr>
     <tr>  
        <td><span class="style2"> Occupation: </span></td>
       <td><span class="style21"><select name="hlemployment_status" id="hlemployment_status">
		<option value="1" <? if($hlrow["Employment_Status"] ==1){echo "selected"; }?>>Salaried</option>
		<option value="0" <? if($hlrow["Employment_Status"] ==0) {echo "selected"; }?>>Self Employed</option></select></span></td>
  </tr>
   <tr>
        <td><span class="style2"> Residence Address </span></td>
       <td><span class="style21"><textarea rows="2" cols="30" id="hlresiaddress" name="hlresiaddress"><? echo $hlrow["Residence_Address"]; ?></textarea></span></td>
  </tr>  
   <tr>
        <td><span class="style2"> Pincode: </span></td>
       <td><span class="style21"><input type="text" id="hlpincode" name="hlpincode" value="<? echo $hlrow["Pincode"]; ?>"></span></td>
  </tr>    
  <tr>
        <td><span class="style2"> Residencs State </span></td>
       <td><span class="style21"><select name="hlstate" ><? $getstate="select state from master_india_city group by state";
			   $getstateresult = ExecQuery($getstate);
				while($hlstate=mysql_fetch_array($getstateresult))
				{
	 ?><option value="<? echo $hlstate["state"]; ?>"  <? if($hlrow["Residence_State"]==$hlstate["state"]) {echo "Selected";} ?>><? echo $hlstate["state"]; ?></option><? } ?></select></span></td>
  </tr>  
   <tr>
        <td><span class="style2"> Annual Income: </span></td>
        <td><span class="style21"><input type="text" id="hlsalary" name="hlsalary" value="<? echo $hlrow["Net_Salary"]; ?>"></span></td>
  </tr>
  <tr>
        <td><span class="style2"> City: </span></td>
    <td><span class="style21"><select size="1" name="hlcity" > <?=getCityList($hlrow["City"])?></select></span></td>
  </tr>
     <tr>
        <td><span class="style2"> Other City: </span></td>
       <td><span class="style21"><input type="text" id="hlcityother" name="hlcityother" value="<? echo $hlrow["City_Other"]; ?>"></span></td>
  </tr>
    
     <tr>
        <td><span class="style2">Required Loan Amount </span></td>
        <td><span class="style21"><input type="text" id="hlloanamt" name="hlloanamt" value="<? echo $hlrow["Loan_Amount"]; ?>"></span></td>
     </tr>
    <tr>
        <td width="180"><span class="style2">Date of entry: </span></td>
        <td width="392"><span class="style21"><? echo date("d-M-Y",strtotime($hlrow["Dated"])); ?></span></td>
  </tr>
  <tr>
        <td width="180"><span class="style2">Customer IP: </span></td>
        <td width="392"><span class="style21"><input type="hidden" name="hlipaddress" id="hlipaddress" value="<? echo $hlrow["IP_Address"]; ?>"><? echo $hlrow["IP_Address"]; ?></span></td>
  </tr>
   <tr>
        <td width="180">Feedback</td>
		<td>  <select name="cmbfeedback" id="cmbfeedback" style="width:120px;">
			<option value="" <? if($varCmbFeedback == "") { echo "selected"; } ?>>No Feedback</option>
			 <option value="Disbursed" <? if($varCmbFeedback == "Disbursed") { echo "selected"; } ?>>Disbursed</option>
			<option value="Login" <? if($varCmbFeedback == "Login") { echo "selected"; } ?>>Login</option>
			<option value="Sanctioned" <? if($varCmbFeedback == "Sanctioned") { echo "selected"; } ?>>Sanctioned</option>
			<option value="Docs Picked" <? if($varCmbFeedback == "Docs Picked") { echo "selected"; } ?>>Docs Picked</option>
			<option value="Appointment" <? if($varCmbFeedback == "Appointment") { echo "selected"; } ?>>Appointment</option>
			<option value="HOT Lead" <? if($varCmbFeedback == "HOT Lead") { echo "selected"; } ?>>HOT Lead</option>
			<option value="COLD Lead" <? if($varCmbFeedback == "COLD Lead") { echo "selected"; } ?>>COLD Lead</option>
			<option value="NI - ROI / Fee issue" <? if($varCmbFeedback == "NI - ROI / Fee issue") { echo "selected"; } ?>>NI - ROI / Fee issue</option>
			<option value="NI - Plan Changed" <? if($varCmbFeedback == "NI - Plan Changed") { echo "selected"; } ?>>NI - Plan Changed</option>
			<option value="NE - Income" <? if($varCmbFeedback == "NE - Income") { echo "selected"; } ?>>NE - Income</option>
			<option value="NE - Property" <? if($varCmbFeedback == "NE - Property") { echo "selected"; } ?>>NE - Property</option>
			<option value="Ringing" <? if($varCmbFeedback == "Ringing") { echo "selected"; } ?>>Ringing</option> 
			 <option value="Send for CIBIL" <? if($varCmbFeedback == "Send for CIBIL") { echo "selected"; } ?>>Send for CIBIL</option> 
			</select>
			</td></tr>
		<tr>
		<td class="fontstyle"><b>Follow Up Date</b></td>
	<td class="fontstyle"><input type="Text"  name="FollowupDate" id="FollowupDate" maxlength="25" size="15" <?php if($Followup_Date !='0000-00-00 00:00:00') { ?>value="<?php  echo $followup_date; ?>" <?php } ?>><a href="javascript:NewCal('FollowupDate','yyyymmdd',true,24)"><img src="images/cal.gif" width="16" height="16" border="0" alt="Pick a date"></a></td>
		</tr>
	<tr>
        <td width="180"><span class="style2">Date time: </span></td>
        <td width="392"><span class="style21"><? echo $hlrow["Dated"]; ?></span></td>
  </tr>
<tr>
        <td width="180" colspan="2">&nbsp;</td></tr>
 <tr>
        <td width="180" colspan="2" align="center"><input type="submit" name="submit" value="Submit"></td></tr>
</table>
</form>
</body>
</html>
