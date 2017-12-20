<html>
<head>
<title>Landing Page</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script type="text/javascript" src="scripts/common.js"></script>
<script language="javascript">
function validateMe(theFrm){

	if(theFrm.Name.value=="")
	{
		alert("Please enter Your Name");
		theFrm.Name.focus();
		return false;
	}
	if(theFrm.Mobile.value=="")
	{
		alert("Please Enter Mobile Number");
		theFrm.Mobile.focus();
		return false;
	}
	if(isNaN(theFrm.Mobile.value)|| theFrm.Mobile.value.indexOf(" ")!=-1)
	{
		alert("Enter numeric value");
		theFrm.Mobile.focus();
		return false;  
	}
	if (theFrm.Mobile.value.length < 10 )
	{
		alert("Please Enter 10 Digits"); 
		theFrm.Mobile.focus();
		return false;
	}
	if ((theFrm.Mobile.value.charAt(0)!="9") && (theFrm.Mobile.value.charAt(0)!="8")&& (theFrm.Mobile.value.charAt(0)!="7"))
	{
		alert("The number should start only with 9 or 8 or 7.");
		theFrm.Mobile.focus();
		return false;
	}
	
	if(theFrm.Email.value=="")
	{
		alert("Please enter  Email Address");
		theFrm.Email.focus();
		return false;
	}
	var str=theFrm.Email.value
	var aa=str.indexOf("@")
	var bb=str.indexOf(".")
	var cc=str.charAt(aa)
	
	if(aa==-1)
	{
		alert("Please enter the valid Email Address");
		theFrm.Email.focus();
		return false;
	}
	else if(bb==-1)
	{
		alert("Please enter the valid Email Address");
		theFrm.Email.focus();
		return false;
	}
	
	
	if (theFrm.City.selectedIndex==0)
	{
		alert("Please enter City Name to Continue");
		theFrm.City.focus();
		return false;
	}
	
	if(theFrm.Message.value=="")
	{
		alert("Please enter Your Message");
		theFrm.Message.focus();
		return false;
	}
	
	
	return true;
    }
</script>
</head>
<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<center>
<div align="center" style="padding:20px;">
<table id="Table_01" width="738" border="0" cellpadding="0" cellspacing="0" style="border: solid 1px #CCC">
	<tr>
		<td width="738" ><table cellpadding="0" cellspacing="0" border="0" width="100%"> 
        <tr>
        <td valign="top" width="336" align="center"><img src="http://www.deal4loans.com/emailer/creditsudhaar/credit_health_ppt.jpg" width="285" height="374" border="0"></td>
        
        <td width="404" valign="top">
        <form action="creditsudhaar-thanks.php" method="post" name="formCS"  onSubmit="return validateMe(this);">
        <table cellpadding="3" cellspacing="0" border="0" width="100%">
        <tr><td colspan="2" style=" color:#FF3300; font-family:Arial, Helvetica, sans-serif; font-size:25px; font-weight:bold;"> Contact Form</td></tr>
        <tr><td width="35%" height="34" style="color:#333333; font-family:Arial, Helvetica, sans-serif; font-size:15px; font-weight:bold;">Name </td>
        <td width="65%"><input type="text" name="Name" id="Name" style="width:210px; height:24px;"  ></td></tr>
               <tr><td height="34" style="color:#333333; font-family:Arial, Helvetica, sans-serif; font-size:15px; font-weight:bold;">Mobile </td><td><input type="text" name="Mobile" id="Mobile"  style="width:210px; height:24px;" onchange="intOnly(this);" onkeyup="intOnly(this);" onkeypress="intOnly(this)"; ></td></tr>
        <tr><td height="34" style="color:#333333; font-family:Arial, Helvetica, sans-serif; font-size:15px; font-weight:bold;">Email </td><td><input type="text" name="Email" id="Email"  style="width:210px; height:24px;" ></td></tr>
        <tr><td height="34" style="color:#333333; font-family:Arial, Helvetica, sans-serif; font-size:15px; font-weight:bold;">City </td><td> <select name="City" id="City" style="width:210px; height:24px; font-family:Verdana, Geneva, sans-serif; font-size:12px; color:#4c4c4c;"  tabindex="7">
                            <option value="Please Select">Please Select</option><option value="Ahmedabad">Ahmedabad</option><option value="Bangalore">Bangalore</option><option value="Chandigarh">Chandigarh</option><option value="Chennai">Chennai</option><option value="Cochin">Cochin</option><option value="Delhi">Delhi</option><option value="Hyderabad">Hyderabad</option><option value="Jaipur">Jaipur</option><option value="Jalandhar">Jalandhar</option><option value="Kolkata">Kolkata</option><option value="Lucknow">Lucknow</option><option value="Mumbai">Mumbai</option><option value="Nagpur">Nagpur</option><option value="Pune">Pune</option><option value="Surat">Surat</option><option value="Ananthpur">Ananthpur</option><option value="Aurangabad">Aurangabad</option><option value="Baroda">Baroda</option><option value="Bhimavaram">Bhimavaram</option><option value="Bhiwadi">Bhiwadi</option><option value="Bhopal">Bhopal</option><option value="Bhubneshwar">Bhubneshwar</option><option value="Calicut">Calicut</option><option value="Coimbatore">Coimbatore</option><option value="Cuttack">Cuttack</option><option value="Dehradun">Dehradun</option><option value="Dindigul">Dindigul</option><option value="Eluru">Eluru</option><option value="Ernakulam">Ernakulam</option><option value="Erode">Erode</option><option value="Faridabad">Faridabad</option><option value="Gaziabad">Gaziabad</option><option value="Guntur">Guntur</option><option value="Gurgaon">Gurgaon</option><option value="Guwahati">Guwahati</option><option value="Hosur">Hosur</option><option value="Indore">Indore</option><option value="Jabalpur">Jabalpur</option><option value="Jamshedpur">Jamshedpur</option><option value="Kakinada">Kakinada</option><option value="Karaikkal">Karaikkal</option><option value="Karimnagar">Karimnagar</option><option value="Karur">Karur</option><option value="Kanpur">Kanpur</option><option value="Khammam">Khammam</option><option value="Kishangarh">Kishangarh</option><option value="Kochi">Kochi</option><option value="Kozhikode">Kozhikode</option><option value="Kumbakonam">Kumbakonam</option><option value="Kurnool">Kurnool</option><option value="Ludhiana">Ludhiana</option><option value="Madurai">Madurai</option><option value="Mangalore">Mangalore</option><option value="Mysore">Mysore</option><option value="Nagerkoil">Nagerkoil</option><option value="Nasik">Nasik</option><option value="Navi Mumbai">Navi Mumbai</option><option value="Nellore">Nellore</option><option value="Nizamabad">Nizamabad</option><option value="Noida">Noida</option><option value="Ongole">Ongole</option><option value="Ooty">Ooty</option><option value="Patna">Patna</option><option value="Pondicherry">Pondicherry</option><option value="Pudukottai">Pudukottai</option><option value="Rajahmundry">Rajahmundry</option><option value="Ramagundam">Ramagundam</option><option value="Raipur">Raipur</option><option value="Rewari">Rewari</option><option value="Sahibabad">Sahibabad</option><option value="Salem">Salem</option><option value="Srikakulam">Srikakulam</option><option value="Thane">Thane</option><option value="Thanjavur">Thanjavur</option><option value="Thrissur">Thrissur</option><option value="Thiruvananthapuram">Thiruvananthapuram</option><option value="Tirunelveli">Tirunelveli</option><option value="Tirupathi">Tirupathi</option><option value="Trivandrum">Trivandrum</option><option value="Trichy">Trichy</option><option value="Tuticorin">Tuticorin</option><option value="Vadodara">Vadodara</option><option value="Vellore">Vellore</option><option value="Vishakapatanam">Vishakapatanam</option><option value="Vizag">Vizag</option><option value="Vizianagaram">Vizianagaram</option><option value="Warangal">Warangal</option>             <option value="Vapi">Vapi</option>
				   <option value="Ankleshwar">Ankleshwar</option>
				    <option value="Anand">Anand</option>
					 <option value="Anand">Dahod</option>
					  <option value="Anand">Navsari</option>
                        </select></td></tr>
                <tr><td height="34" style="color:#333333; font-family:Arial, Helvetica, sans-serif; font-size:15px; font-weight:bold;">Message </td><td><textarea name="Message" style="width:210px; height:44px;" ></textarea></td></tr>
                        <tr><td height="44">&nbsp; </td><td><input type="submit" name="submit" value="Submit" style="   border: 1px solid #006;
    background: #9cf; height:30px; width:100px; font-size:16px; font-weight:bolder;" ></td></tr>
                             <tr><td colspan="2" align="center" style="border-top:#333333 1px solid;"><img style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; display: block;" src="http://www.deal4loans.com/emailer/creditsudhaar/emailer_14.jpg" width="337" height="105" alt="CreditSudhaar's 4 Step Plan to Credit Health Improvement"></td></tr>
        </table>
        </form>
        </td>
        
        </tr>
</table>
        </td>
	</tr>
	
	<tr>
		<td>
        	<table cellpadding="0" cellspacing="0" width="100%">
            	<tr>
                	<td>
			<img style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; display: block;" src="http://www.deal4loans.com/emailer/creditsudhaar/emailer_05.jpg" width="185" height="139" alt="STEP I - Accurate Interpretation of Credit Reports"></td>
		<td colspan="2">
			<img style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; display: block;" src="http://www.deal4loans.com/emailer/creditsudhaar/emailer_06.jpg" width="184" height="139" alt="STEP II - Identifying issues with the report"></td>
		<td colspan="2">
			<img style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; display: block;" src="http://www.deal4loans.com/emailer/creditsudhaar/emailer_07.jpg" width="185" height="139" alt="STEP III - Comprehensive Analysis"></td>
		<td colspan="2">
			<img style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; display: block;" src="http://www.deal4loans.com/emailer/creditsudhaar/emailer_08.jpg" width="184" height="139" alt="STEP IV - Detailed plan for Credit Health improvement"></td>
                </tr>
            </table>
        </td>
	</tr>
	<tr>
		<td style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; padding:4px; ">
<strong style="font-size:12px;">Disclaimer:</strong> This is an advertisement on behalf of credit Sudhaar. <strong style="font-size:11px;">Deal4loans.com</strong> is not responsible for any service related issue. 
</td>
	</tr>
</table>
</div>
</center>
</body>
</html>