<?php
require 'scripts/session_check_online.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';




	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		foreach($_POST as $a=>$b)
			$$a=$b;

		$full_name = FixString($full_name);
		$mobile_number = FixString($mobile_number);
		$city = FixString($city);
		$reference_code=generateNumber(4);



	$SMSMessage = "Your Activation code for Barclays Credit Card is :$reference_code,keep it with you till application get processed";
		if(strlen(trim($mobile_number)) > 0){
		SendSMSforLMS($SMSMessage, $mobile_number);
		//SendSMS($SMSMessage, $mobile_number);
		}
	

		$barclayscard="Insert INTO Barclays_Credit_Card (Name,Mobile_Number,City,Reference_Code,Dated) Values ('$full_name','$mobile_number','$city','$reference_code',NOW())";
		$barclayscardresult=ExecQuery($barclayscard);
		//echo $barclayscard."<br>";

	}

 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Barclays Appication</title>
<style type="text/css">
<!--
.style5 {font-family: verdana; font-size: 12px; }
-->
</style>
<script Language="JavaScript" Type="text/javascript">
function getvaliddetails()
{
	if(document.barcalyscard.full_name.value=="")
	{
		alert("Please fill Name.");
		document.barcalyscard.full_name.focus();
		return false;
	}
	if(document.barcalyscard.mobile_number.value=="")
	{
		alert("Please fill Mobile Number.");
		document.barcalyscard.mobile_number.focus();
		return false;
	}
	if (document.barcalyscard.city.selectedIndex==0)
	{
		alert("Please select city to Continue");
		document.barcalyscard.city.focus();
		return false;
	}
}
</script>
</head>
<body>
<div align="left">&nbsp;<br><br></div>
<?php 
	 if(isset($_SESSION['UserType']))
	{
echo "<div align='right' class='style5'>Welcome <b>".$_SESSION['UName']." ( <a href=barclayslogin.php>Logout</a> )</b></div>";
	}
?>
<div align="center" class="style5">Fill in the details</div>
<br />
<form name="barcalyscard" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>" onsubmit="return getvaliddetails();">
<table align="center" style="border:1px solid #68718A" width="300px" cellpadding="2" height="150px">
	<tr>
		<td><span class="style5">Name</span></td>
		<td><input name="full_name" type="text" id="full_name" />	
  </tr>
	<tr>
		<td><span class="style5">Mobile Number</span></td>
		<td><input name="mobile_number" type="text" id="mobile_number" maxlength="10"/>	
  </tr>
	<tr>
		<td><span class="style5">City</span></td>
		<td><span class="style5">
		  <select name="city" id="city"> 
		    <option value="Please Select">Please Select City</option>
		    <option value="Ahmedabad">Ahmedabad</option>
		    <option value="Aurangabad">Aurangabad</option>
		    <option value="Bangalore">Bangalore</option>
		    <option value="Baroda">Baroda</option>
		    <option value="Bhopal">Bhopal</option>
		    <option value="Bhubneshwar">Bhubneshwar</option>
		    <option value="Chandigarh">Chandigarh</option>
		    <option value="Chennai">Chennai</option>
		    <option value="Cochin">Cochin</option>
		    <option value="Coimbatore">Coimbatore</option>
		    <option value="Cuttack">Cuttack</option>
		    <option value="Dehradun">Dehradun</option>
		    <option value="Delhi">Delhi</option>
		    <option value="Faridabad">Faridabad</option>
		    <option value="Gaziabad">Gaziabad</option>
		    <option value="Gurgaon">Gurgaon</option>
		    <option value="Guwahati">Guwahati</option>
		    <option value="Hosur">Hosur</option>
		    <option value="Hyderabad">Hyderabad</option>
		    <option value="Indore">Indore</option>
		    <option value="Jabalpur">Jabalpur</option>
		    <option value="Jaipur">Jaipur</option>
		    <option value="Jamshedpur">Jamshedpur</option>
		    <option value="Kanpur">Kanpur</option>
		    <option value="Kochi">Kochi</option>
		    <option value="Kolkata">Kolkata</option>
		    <option value="Lucknow">Lucknow</option>
		    <option value="Ludhiana">Ludhiana</option>
		    <option value="Madurai">Madurai</option>
		    <option value="Mangalore">Mangalore</option>
		    <option value="Mysore">Mysore</option>
		    <option value="Mumbai">Mumbai</option>
		    <option value="Nagpur">Nagpur</option>
		    <option value="Nasik">Nasik</option>
		    <option value="Navi Mumbai">Navi 
		      Mumbai</option>
		    <option value="Noida">Noida</option>
		    <option value="Patna">Patna</option>
		    <option value="Pune">Pune</option>
		    <option value="Ranchi">Ranchi</option>
		    <option value="Sahibabad">Sahibabad</option>
		    <option value="Surat">Surat</option>
		    <option value="Thane">Thane</option>
		    <option value="Thiruvananthapuram">Thiruvananthapuram</option>
		    <option value="Trivandrum">Trivandrum</option>
		    <option value="Trichy">Trichy</option>
		    <option value="Vadodara">Vadodara</option>
		    <option value="Vishakapatanam">Vishakapatanam</option>
		    <option value="Vizag">Vizag</option>
		    <option value="Others">Others</option>
	    </select>
  </span>   </tr>
	<tr><td colspan="2" align="center"><input type="submit" name="submit" value="submit"/></td></tr>
</table>
</form>
</body>
</html>
