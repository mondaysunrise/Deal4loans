<?php
$IP_Remote = $_SERVER["REMOTE_ADDR"];
if($IP_Remote=='192.124.249.12' || $IP_Remote=='185.93.228.12') { $IP= $_SERVER['HTTP_X_SUCURI_CLIENTIP']; }
else { $IP= $IP_Remote;	}
if($IP=="122.176.100.27" || $IP=="122.176.100.28" || $IP=="122.176.122.134" || $IP=="122.161.196.68" || $IP=="61.246.3.127" || $IP=="122.160.30.168" )
{
 require 'scripts/db_init.php';
require 'scripts/functions.php';
require 'soapservice_cfl_pl.php';

//print_R($_POST);

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		foreach($_POST as $a=>$b)
			$$a=$b;	
		
		$full_name = FixString($full_name);
		$dob = FixString($dob);
		$marital_status = FixString($marital_status);
		$purpose_of_loan = FixString($purpose_of_loan);
		$current_address = FixString($current_address);
		$property_status = FixString($property_status);
		$annual_income = FixString($annual_income);
		$company_name =  FixString($company_name);
		$office_address = FixString($office_address);
		$requestid = FixString($requestid);
		$panno = FixString($panno);
		$comment_section = FixString($comment_section);
		$ccfeedback = FixString($ccfeedback);
		$FollowupDate  = FixString($FollowupDate);
		$capfirstid  = FixString($capfirstid);
		$Email  = FixString($Email);
		$City_Other  = FixString($City_Other);
		$City  = FixString($City);
		$Mobile_Number  = FixString($Mobile_Number);
		$first_webservice = FixString($first_webservice);
		$gender = FixString($gender);
		$Total_Experience = FixString($Total_Experience);
		$capitalfirst_resipincode = FixString($resipincode);
		$officepincode = FixString($officepincode);
		$City = FixString($City);
		$City_Other = FixString($City_Other);
		$capitalfirst_occupation = FixString($capitalfirst_occupation);
		$Dated=ExactServerdate();

	if($City=="Others" && strlen($City_Other)>0)
	{
		$strcity=$City_Other;
	}
	else
	{
		$strcity=$City;
	}

$direct_flag=2;
	if(strlen($full_name)>0 && strlen($Mobile_Number)>2)
	{
	
	 $getpldetails="select capitalfirst_mobile_number From apply_pl_capitalfirst Where (capitalfirst_mobile_number='".$Mobile_Number."')";
	list($alreadyExist,$plrow)=Mainselectfunc($getpldetails,$array = array());
if($alreadyExist>0)
		{	echo "Duplicate Lead";	}
		else
		{
$data = array("capitalfirst_name" => $full_name, "capitalfirst_dob" => $dob, "capitalfirst_marital_stat" => $marital_status, "capitalfirst_purpose_ofloan" => $purpose_of_loan, "capitalfirst_current_address" => $current_address, "capitalfirst_property_stat" => $property_status, "capitalfirst_annual_income" => $annual_income, "capitalfirst_company_name" => $company_name, "capitalfirst_office_address" => $office_address, "capitalfirst_panno" => $panno, "capitalfirst_dated"=> $Dated, "direct_flag"=> $direct_flag, "capitalfirst_gender" => $gender, "capitalfirst_resipincode" => $capitalfirst_resipincode,"capitalfirst_officepincode"=> $officepincode,"capitalfirst_city"=> $City ,"capitalfirst_city_other"=> $City_Other, "capitalfirst_occupation"=> $capitalfirst_occupation, "capitalfirst_email"=>$Email, "capitalfirst_mobile_number"=> $Mobile_Number, "capitalfirst_totalexp" =>$Total_Experience);
//echo "<br><br>";
//print_r($data);
$capitalfirstid = Maininsertfunc("apply_pl_capitalfirst", $data);
	}
	}
	
//webservice
$findme   = 'Loan Application Number';
$firstpos = strpos($first_webservice, $findme);

if($ccfeedback=="Send Now" && $firstpos===false)
	{
	//echo $strcity." - ".$full_name." - ".$capitalfirst_resipincode." - ".$gender." - ".$marital_status." - ".$dob." - ".$Email." - ".$panno." - ".$current_address."<br><br>";
$firststatus=cflfirstserv($strcity,$full_name,$capitalfirst_resipincode,$gender,$marital_status,$dob,$Email,$panno,$current_address, $Mobile_Number);
if(strlen($firststatus)>2)
	{
		$DataArray = array("first_webservice" => $firststatus,"first_webdated"=> $Dated);
		$wherecondition ="(capitalfirstid=".$capitalfirstid.")";
		Mainupdatefunc ('apply_pl_capitalfirst', $DataArray, $wherecondition);
	}
	}
//webservice end
	if(strlen($ccfeedback)>0 || strlen($comment_section)>0)
	{
		$strSQL="";
		$Msg="";
		$result = ExecQuery("select FeedbackID,not_contactable_counter from Req_Feedback_PL where AllRequestID=".$capitalfirstid." and BidderID=".$bidderid." AND Reply_Type=4");
		$num_rows = mysql_num_rows($result);
		if($num_rows > 0)
		{	
			$row = mysql_fetch_array($result);
			$strSQL="Update Req_Feedback_PL Set Feedback='".$ccfeedback."',comment_section='".$comment_section."',Followup_Date='".$FollowupDate."'";
			$strSQL=$strSQL."Where FeedbackID=".$row["FeedbackID"];
			}
		else
		{
			$strSQL="Insert into Req_Feedback_PL(AllRequestID, BidderID, Reply_Type , Feedback, Followup_Date,comment_section) Values (";
			$strSQL=$strSQL.$capitalfirstid.",'5692',1,'".$ccfeedback."','".$FollowupDate."','".$comment_section."')";
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
}
if($IP=="122.176.100.27" || $IP=="122.176.100.28" || $IP=="122.176.122.134" || $IP=="122.161.196.68" || $IP=="61.246.3.127" || $IP=="122.160.30.168" )
{
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script language="javascript" type="text/javascript" src="scripts/datetime.js"></script>
<title>Credit Card</title>
<style type="text/css">
<!--
.style2 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold;}
.style21 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size:12px;}
-->
</style>
</head>
<body>
<form name="loan_form" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>?postid=<?echo $requestid;?>&biddt=<? echo $bidderid;?>" >
<input type="hidden" name="biddtnw" value="<?echo $bidderid;?>">
<table style='border:1px dotted #9C9A9C;' cellspacing="2" cellpadding="5" width="600" height="80%" align="center" border="0" >
<tr><td colspan="2" align="center" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold;">CFL Personal loan customer details</td></tr>
<tr>
        <td width="180"><span class="style2">Customer Name: </span></td>
    <td width="392"><span class="style21"><input name="full_name" type="text" class="capital-first_input" id="full_name" /></span></td>
  </tr>
     <tr>
        <td><span class="style2"> DOB: </span></td>
       <td><span class="style21"><input name="dob" type="text" class="capital-first_input" id="dob" /> (YYYY-MM-DD)</span></td>
  </tr>
     <tr>
        <td><span class="style2"> Email: </span></td>
       <td><span class="style21"><input type="text" name="Email" id="Email"></span></td>
  </tr>
     <tr>
        <td><span class="style2"> Mobile No: </span></td>
       <td><span class="style21"><input type="text" name="Mobile_Number" id="Mobile_Number"></span></td>
  </tr>
     <tr>
        <td><span class="style2"> Occupation: </span></td>
       <td><span class="style21"><select class="fontstyle" name="capitalfirst_occupation" id="capitalfirst_occupation">
			<option value="Salaried" >Salaried</option>
			<option value="Self Employed" >Self Employed</option></select></span></td>
  </tr>
     <tr>
        <td><span class="style2"> Company Name: </span></td>
       <td><span class="style21"><input name="company_name" type="text" class="capital-first_input" id="company_name" /></span></td>
  </tr>
   <tr>
        <td><span class="style2"> Total Experience </span></td>
       <td><span class="style21"><input name="Total_Experience" type="text" class="capital-first_input" id="Total_Experience" /></span></td>
  </tr>     
<tr>
     <td><span class="style2"> City: </span></td>
    <td><span class="style21"><select size="1" name="City" id="City"> <option value="Ahmedabad">Ahmedabad</option>
		<option value="Bangalore" <? if($strcity=="Bangalore") { echo "Selected"; } ?> >Bangalore</option>
		<option value="Baroda" <? if($strcity=="Baroda") { echo "Selected"; } ?>>Baroda</option>
		<option value="Vadodara" <? if($strcity=="Vadodara") { echo "Selected"; } ?>>Vadodara</option>
		<option value="Bhopal" <? if($strcity=="Bhopal") { echo "Selected"; } ?>>Bhopal</option>
		<option value="Bhubneshwar" <? if($strcity=="Bhubneshwar") { echo "Selected"; } ?>>Bhubneshwar</option>
		<option value="Chandigarh" <? if($strcity=="Chandigarh") { echo "Selected"; } ?>>Chandigarh</option>
		<option value="Chennai" <? if($strcity=="Chennai") { echo "Selected"; } ?>>Chennai</option>
		<option value="Coimbatore" <? if($strcity=="Coimbatore") { echo "Selected"; } ?>>Coimbatore</option>
		<option value="Cuttack" <? if($strcity=="Cuttack") { echo "Selected"; } ?>>Cuttack</option>
		<option value="Delhi" <? if($strcity=="Delhi") { echo "Selected"; } ?>>Delhi</option>
		<option value="Ghaziabad" <? if($strcity=="Ghaziabad") { echo "Selected"; } ?>>Ghaziabad</option>
		<option value="Gurgaon" <? if($strcity=="Gurgaon") { echo "Selected"; } ?>>Gurgaon</option>
		<option value="Noida" <? if($strcity=="Noida") { echo "Selected"; } ?>>Noida</option>
		<option value="Faridabad" <? if($strcity=="Faridabad") { echo "Selected"; } ?>>Faridabad</option>
		<option value="Hyderabad" <? if($strcity=="Hyderabad") { echo "Selected"; } ?>>Hyderabad</option>
		<option value="Indore" <? if($strcity=="Indore") { echo "Selected"; } ?>>Indore</option>
		<option value="Jaipur" <? if($strcity=="Jaipur") { echo "Selected"; } ?>>Jaipur</option>
		<option value="Jalandhar" <? if($strcity=="Jalandhar") { echo "Selected"; } ?>>Jalandhar</option>
		<option value="Jodhpur" <? if($strcity=="Jodhpur") { echo "Selected"; } ?>>Jodhpur</option>
		<option value="Kolkata" <? if($strcity=="Kolkata") { echo "Selected"; } ?>>Kolkata</option>
		<option value="Lucknow" <? if($strcity=="Lucknow") { echo "Selected"; } ?>>Lucknow</option>
		<option value="Ludhiana" <? if($strcity=="Ludhiana") { echo "Selected"; } ?>>Ludhiana</option>
		<option value="Mumbai" <? if($strcity=="Mumbai") { echo "Selected"; } ?>>Mumbai</option>
		<option value="Navi Mumbai" <? if($strcity=="Navi Mumbai") { echo "Selected"; } ?>>Navi Mumbai</option>
		<option value="Thane" <? if($strcity=="Thane") { echo "Selected"; } ?>>Thane</option>
		<option value="Nagpur" <? if($strcity=="Nagpur") { echo "Selected"; } ?>>Nagpur</option>
		<option value="Nasik" <? if($strcity=="Nasik") { echo "Selected"; } ?>>Nasik</option>
		<option value="Pune" <? if($strcity=="Pune") { echo "Selected"; } ?>>Pune</option>
		<option value="Surat" <? if($strcity=="Surat") { echo "Selected"; } ?>>Surat</option>
		<option value="Udaipur" <? if($strcity=="Udaipur") { echo "Selected"; } ?>>Udaipur</option>
		<option value="Vijaywada" <? if($strcity=="Vijaywada") { echo "Selected"; } ?>>Vijaywada</option>
		<option value="Vishakapatnam" <? if($strcity=="Vishakapatnam") { echo "Selected"; } ?>>Vishakapatnam</option>
		<option value="Vizag" <? if($strcity=="Vizag") { echo "Selected"; } ?>>Vizag</option>
		<option value="Madurai" <? if($strcity=="Madurai") { echo "Selected"; } ?>>Madurai</option>
		<option value="Ambala" <? if($strcity=="Ambala") { echo "Selected"; } ?>>Ambala</option>
		<option value="Anand" <? if($strcity=="Anand") { echo "Selected"; } ?>>Anand</option><option value="Others" <? if($strcity=="Others") { echo "Selected"; } ?>>Others</option></select></span></td>
  </tr>
     <tr>
        <td><span class="style2"> Other City: </span></td>
       <td><span class="style21"><input type="text" name="City_Other" id="City_Other"></span></td>
  </tr>    
   <tr><td><span class="style2">PAN No:</span></td><td><span class="style21"><input type="text" name="panno" id="panno" maxlength="10" class="capital-first_input"/></span></td></tr>
      <tr>
        <td><span class="style2"> Annual Income: </span></td>
        <td><span class="style21"><input name="annual_income" type="text" class="capital-first_input" id="annual_income" /></span></td>
  </tr>
  <tr>
    <td class="style2">Gender</td>
    <td class="style2"><label for="select"></label>
      <select name="gender" class="capital-first_input" id="gender">
        <option value="Male" <? if($capitalfirst_gender=="Male") echo "Selected"; ?>>Male</option>
        <option value="Female" <? if($capitalfirst_gender=="Female") echo "Selected"; ?>>Female</option>
        </select></td>
  </tr>
  <tr>  
    <td><span class="style2">Marital Status </span></td>
    <td><span class="style2"><label for="select"></label>
      <select name="marital_status" class="capital-first_input" id="marital_status">
        <option value="Single" <? if($marital_status == "Single") { echo "selected"; } ?> >Single</option>
        <option value="Married" <? if($marital_status == "Married") { echo "selected"; } ?> >Married</option>
        </select> </span></td>
  </tr>
  <tr>
    <td><span class="style2">Purpose of Loan </span></td>
    <td><span class="style2"><select name="purpose_of_loan" class="capital-first_input" id="purpose_of_loan">
	<option value="">Please Select</option>
      <option value="Car Repair or Purchase" <? if($purpose_of_loan == "Car Repair or Purchase") { echo "selected"; }?>>Car Repair/Purchase</option>
      <option value="Education" <? if($purpose_of_loan == "Education") { echo "selected"; }?>>Education</option>
      <option value="Holidays" <? if($purpose_of_loan == "Holidays") { echo "selected"; }?>>Holidays</option>
       <option value="Home Improvement or Lot Downpayment" <?if($purpose_of_loan == "Home Improvement or Lot Downpayment") { echo "selected"; }?>>Home Improvement/Lot Downpayment</option>
       <option value="Investments" <? if($purpose_of_loan == "Medical Expense") { echo "selected"; }?>>Investments</option>
       <option value="Medical Expense" <? if($purpose_of_loan == "selected") { echo "selected"; }?>>Medical Expense</option>
       <option value="Others" <? if($purpose_of_loan == "Others") { echo "selected"; }?>>Others</option>
         <option value="Wedding" <? if($purpose_of_loan == "Wedding") { echo "selected"; }?>>Wedding</option>    
    </select> </span></td>
  </tr>
  <tr>
    <td><span class="style2">Current Address (With Landmark) </span></td>
    <td><span class="style2"><textarea rows="3" cols="21" name="current_address" id="current_address" class="capital-first_txtinput"><? echo $current_address; ?></textarea> </span></td>
  </tr>
   <tr>
        <td><span class="style2"> Pincode: <? echo $ccrow["capitalfirst_resipincode"]; ?></span></td>
       <td><span class="style21"><input type="text"  name="resipincode" id="resipincode"></span></td>
  </tr>
  
  <tr>
    <td><span class="style2">Property Status </span></td>
    <td><span class="style2"><select name="property_status" class="capital-first_input" id="property_status">
		<option value="">Please Select</option>
      <option value="Company Provided" <? if($property_status == "Company Provided") { echo "selected"; } ?> >Company Provided</option>
      <option value="Mortgaged" <? if($property_status == "Mortgaged") { echo "selected"; } ?>>Mortgaged</option>
      <option value="Owned" <? if($property_status == "Owned") { echo "selected"; } ?>>Owned</option>
      <option value="Relatives House" <? if($property_status == "Relatives House") { echo "selected"; } ?>>Relatives House</option>
      <option value="Rented" <? if($property_status == "Rented") { echo "selected"; } ?>>Rented</option>
        </select> </span></td>
    </tr>
	 <tr>
    <td><span class="style2">Office Address (With Landmark) </span></td>
    <td><span class="style2"><textarea rows="3" cols="21" name="office_address" id="office_address" class="capital-first_txtinput"><? echo $office_address; ?></textarea> </span></td>
  </tr>   
   <tr>
        <td><span class="style2">Office Pincode: </span></td>
       <td><span class="style21"><input type="text" name="officepincode" id="officepincode"></span></td>
  </tr>
  	  <tr>
        <td><span class="style2">LMS Comments: </span></td>
        <td><span class="style21"><textarea rows="2" cols="15" name="comment_section"><? echo $ccrow["comment_section"]; ?></textarea></span></td>
     </tr>
	 <tr>
       <td><span class="style2">LMS feedback </span></td>
        <td><span class="style21"><select name="ccfeedback" id="ccfeedback">
		<option value="" <?if($Feedback == "") { echo "selected"; }?>>No Feedback</option>
		<option value="Ringing" <?if($Feedback == "Ringing") { echo "selected"; }?>>Ringing</option>
		<option value="Not Interested" <?if($Feedback == "Not Interested") { echo "selected"; }?>>Not Interested</option>
		<option value="Callback Later" <?if($Feedback == "Callback Later") { echo "selected"; }?>>Callback Later</option>
		<option value="Wrong Number" <?if($Feedback == "Wrong Number") { echo "selected"; }?>>Wrong Number</option>
		<option value="Not Eligible" <?if($Feedback == "Not Eligible") { echo "selected"; }?>>Not Eligible</option>
		<option value="FollowUp" <? if($Feedback == "FollowUp") { echo "selected"; }?>>FollowUp</option>
		<option value="Send Now" <? if($Feedback == "Send Now") { echo "selected"; }?>>Send Now</option>
	<option value="Approved" <? if($Feedback == "Approved") { echo "selected"; }?>>Entry Done- Approved</option>
	<option value="Reject" <? if($Feedback == "Reject") { echo "selected"; }?>>Entry Done- Reject</option>
	</select></span></td>
     </tr>	
	 <tr>
	 <td class="fontstyle"><b>Follow Up Date</b></td>
	<td class="fontstyle"><input type="Text"  name="FollowupDate" id="FollowupDate" maxlength="25" size="15" <?php if($Followup_Date !='0000-00-00 00:00:00') { ?>value="<?php  echo $followup_date; ?>" <?php } ?>><a href="javascript:NewCal('FollowupDate','yyyymmdd',true,24)"><img src="images/cal.gif" width="16" height="16" border="0" alt="Pick a date"></a></td>
	 </tr>   
	 <tr><td colspan="2" align="center"><input type="Submit" name="Submit" value="Submit"></td></tr>
   </table>
</form>
</body>
</html>
<? } ?>
