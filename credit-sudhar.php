<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Welcome-1</title>
<link href="css/creditsudhaar_style.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="scripts/common.js"></script>
<script language="javascript">
function validateMe(theFrm){

	if(theFrm.Name.value=="")
	{
		alert("Please enter Your Name");
		theFrm.Name.focus();
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
		
	
	
	if(theFrm.Message.value=="")
	{
		alert("Please enter Your Message");
		theFrm.Message.focus();
		return false;
	}
	
	
	return true;
    }
	
  function keyRestrict(e, validchars)
    {
    debugger;
	    var key='', keychar='';
	    key = getKeyCode(e);
	    if (key == null) return true;
	    keychar = String.fromCharCode(key);
	    keychar = keychar.toLowerCase();
	    validchars = validchars.toLowerCase();
	    if (validchars.indexOf(keychar) != -1)
		    return true;
	    if ( key==null || key==0 || key==8 || key==9 || key==13 || key==27 )
		    return true;
	    return false;
	 }
	 function getKeyCode(e)
	 {
	    if (window.event)
	       return window.event.keyCode;
	    else if (e)
	       return e.which;
	    else
	       return null;
	}
    
</script>
</head>
<body>

<div class="headerWrapper">
<div class="header wrap"></div>
</div>

<div class="wrap">
  <div id="logoHolder"> <img src="new-images/credit-sudhaar-logo.png" width="328" height="94" alt="credt sudhaar logo"></div>
  <div style="float:right; margin-left: 170px;margin-top: 10px;">
    <div class="welcome_hd_right">
    <img src="new-images/creditsudhaar_restore_enh.jpg" width="229" height="48" border="0">	</div>
  </div>
</div>
<div style="clear:both;"></div>
<div id="mai_nwrapper">
<div class="welcome_left"> <h3 class="title" style="font-family:Arial, Helvetica, sans-serif; font-size:25px; margin-left:10px; margin-bottom:5px;">Contact Form</h3>
<div style="width:98%; ">
<form action="credit-sudhar-thanks.php" method="post" name="formCS"  onSubmit="return validateMe(this);">
  <table width="98%" border="0" align="center" cellpadding="0" cellspacing="8">
  <tr>
    <td width="36%" height="30" style="font-family: arial;
font-weight: bold; font-size:15px;">Name : <span style="color:red">*</span></td>
    <td width="64%" height="35">
           <input name="Name" type="text" class="input" id="Name" onkeypress="return keyRestrict(event,'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTWXYZ '+String.fromCharCode(241))"/>
    </td>
  </tr>
 
  <tr>
    <td height="30" style="font-family: arial;
font-weight: bold; font-size:15px;">Email : <span style="color:red">*</span></td>
    <td height="35"><input name="Email" type="text" class="input" id="Email" /></td>
  </tr>
 
  <tr>
    <td height="30" style="font-family: arial;
font-weight: bold; font-size:15px;">City : <span style="color:red">*</span></td>
    <td><select name="City" class="select" id="City">
       <option value="Please Select">Please Select</option><option value="Ahmedabad">Ahmedabad</option><option value="Bangalore">Bangalore</option><option value="Chandigarh">Chandigarh</option><option value="Chennai">Chennai</option><option value="Cochin">Cochin</option><option value="Delhi">Delhi</option><option value="Hyderabad">Hyderabad</option><option value="Jaipur">Jaipur</option><option value="Jalandhar">Jalandhar</option><option value="Kolkata">Kolkata</option><option value="Lucknow">Lucknow</option><option value="Mumbai">Mumbai</option><option value="Nagpur">Nagpur</option><option value="Pune">Pune</option><option value="Surat">Surat</option><option value="Ananthpur">Ananthpur</option><option value="Aurangabad">Aurangabad</option><option value="Baroda">Baroda</option><option value="Bhimavaram">Bhimavaram</option><option value="Bhiwadi">Bhiwadi</option><option value="Bhopal">Bhopal</option><option value="Bhubneshwar">Bhubneshwar</option><option value="Calicut">Calicut</option><option value="Coimbatore">Coimbatore</option><option value="Cuttack">Cuttack</option><option value="Dehradun">Dehradun</option><option value="Dindigul">Dindigul</option><option value="Eluru">Eluru</option><option value="Ernakulam">Ernakulam</option><option value="Erode">Erode</option><option value="Faridabad">Faridabad</option><option value="Gaziabad">Gaziabad</option><option value="Guntur">Guntur</option><option value="Gurgaon">Gurgaon</option><option value="Guwahati">Guwahati</option><option value="Hosur">Hosur</option><option value="Indore">Indore</option><option value="Jabalpur">Jabalpur</option><option value="Jamshedpur">Jamshedpur</option><option value="Kakinada">Kakinada</option><option value="Karaikkal">Karaikkal</option><option value="Karimnagar">Karimnagar</option><option value="Karur">Karur</option><option value="Kanpur">Kanpur</option><option value="Khammam">Khammam</option><option value="Kishangarh">Kishangarh</option><option value="Kochi">Kochi</option><option value="Kozhikode">Kozhikode</option><option value="Kumbakonam">Kumbakonam</option><option value="Kurnool">Kurnool</option><option value="Ludhiana">Ludhiana</option><option value="Madurai">Madurai</option><option value="Mangalore">Mangalore</option><option value="Mysore">Mysore</option><option value="Nagerkoil">Nagerkoil</option><option value="Nasik">Nasik</option><option value="Navi Mumbai">Navi Mumbai</option><option value="Nellore">Nellore</option><option value="Nizamabad">Nizamabad</option><option value="Noida">Noida</option><option value="Ongole">Ongole</option><option value="Ooty">Ooty</option><option value="Patna">Patna</option><option value="Pondicherry">Pondicherry</option><option value="Pudukottai">Pudukottai</option><option value="Rajahmundry">Rajahmundry</option><option value="Ramagundam">Ramagundam</option><option value="Raipur">Raipur</option><option value="Rewari">Rewari</option><option value="Sahibabad">Sahibabad</option><option value="Salem">Salem</option><option value="Srikakulam">Srikakulam</option><option value="Thane">Thane</option><option value="Thanjavur">Thanjavur</option><option value="Thrissur">Thrissur</option><option value="Thiruvananthapuram">Thiruvananthapuram</option><option value="Tirunelveli">Tirunelveli</option><option value="Tirupathi">Tirupathi</option><option value="Trivandrum">Trivandrum</option><option value="Trichy">Trichy</option><option value="Tuticorin">Tuticorin</option><option value="Vadodara">Vadodara</option><option value="Vellore">Vellore</option><option value="Vishakapatanam">Vishakapatanam</option><option value="Vizag">Vizag</option><option value="Vizianagaram">Vizianagaram</option><option value="Warangal">Warangal</option>             <option value="Vapi">Vapi</option>
				   <option value="Ankleshwar">Ankleshwar</option>
				    <option value="Anand">Anand</option>
					 <option value="Anand">Dahod</option>
					  <option value="Anand">Navsari</option>
    </select></td>
  </tr>
  
  <tr>
    <td height="30" style="font-family: arial;
font-weight: bold;"><label style="font-family: arial;
font-weight: bold; float:left; font-size:15px;">Mobile No. : <span style="color:red;">*</span></label></td>
    <td>+91-
      <input name="Mobile" type="text" class="mobile_input" id="Mobile" maxlength="10" onkeypress="return keyRestrict(event,'0123456789'+String.fromCharCode(241))"/></td>
  </tr>
 
  <tr>
    <td height="30" style="font-family: arial;
font-weight: bold; font-size:15px;" valign="top">Message : <span style="color:red">*</span></td>
    <td align="left">
      <textarea name="Message" id="Message" class="text_area"  rows="5"></textarea>
    </td>
  </tr>
  <tr>
    <td style="font-family: arial;
font-weight: bold;">&nbsp;</td>
    <td align="center"><input type="reset" class="btn" value="Reset"><div style="float:left; display:inline;">&nbsp;&nbsp;&nbsp;</div><input type="submit" class="btn" tabindex="6" value="Send"></td>
  </tr>
</table>
 </form>
</div>

</div>
<div class="welcome_right">
      
       <h3>Credit Health Check-Up</h3>
       <p>Compilation of Reports from
 all Credit Bureaus
</p>
<p>Multibureau Analysis of CIBIL, 
EQUIFAX, EXPERIAN Credit Reports
</p><p>8 Parameter Credit Health Map
</p>
<h3 style="padding-top:4px;">Issue Resolution</h3>
<p>Error Tracking & Reconciliation</p>
<p>NACCC Certified Credit Counsellor</p>
<p>Debt Reconciliation/Settlements</p>
<p>Score Improvement Module</p>
<h3 style="padding-top:18px;">Achieve Credit & Financial Goals</h3>
<p>Tax Advisory</p>
<p>Assistance in Filing Tax Returns</p>
<p>Access to Credit Sudhaar Finance</p>
<p>Assistance in Loan Processing</p>
<h3 style="padding-top:22px;">Protect Your Credit</h3>
<p>Identity Theft Protection</p>
<p>Fraudulent Charges Protection</p>
<p>Lost Wallet Protection</p>
<p>ATM Assault & Robbery Protection</p>
<p>Assistance in making a Will</p>
       
        </div>
  
  </div>
  
  
   </div>

</div>
</body></html>