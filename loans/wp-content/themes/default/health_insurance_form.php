<?php $getnewtitle=get_the_title(); 
$aftrreplace=str_replace("|", "-", $getnewtitle);
list($first_part,$last_part) = split('-', $aftrreplace);
$WebsitePath = "http://www.bimadeals.com/";

?>
<script type="text/javascript" src="http://www.bimadeals.com/scripts/validation_life_form.js"></script><style type="text/css">
#dhtmltooltip{
position: absolute;
left: -300px;
width: 320px;
border: 1px solid black;
padding: 2px;
background-color: lightyellow;
visibility: hidden;
z-index: 100;
filter: progid:DXImageTransform.Microsoft.Shadow(color=gray,direction=135);
}
#dhtmlpointer{
position:absolute;
left: -300px;
z-index: 101;
visibility: hidden;
}
.style1 {color: #FF0000}
.pg_heading
{
color:#443133;
font-family:Arial,Helvetica,sans-serif;
font-size:17px;
font-weight:bold;
line-height:19px;
margin:0 0 10px;
padding:15px 0 3px;
text-align:center;
}
.frmtxt{	
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size:11px;
	font-weight:normal;
	text-align:left;
	color:#000000;
}
.frmbldtxt{	
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size:11px;
	font-weight:bold;
	text-align:left;
}
.brdr5{
	border:5px solid #a2d7f6;
	background:#f6fcff;
}
.frmbldtxt{	
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size:11px;
	font-weight:bold;
	text-align:left;
}
</style></head>	<body>
		<table width="100%" border="0" cellspacing="0" cellpadding="0"   >
			<tr>
				<td valign="bottom" >
					<form name="loan_form" method="post" action="http://www.bimadeals.com/Right.php" onSubmit="return chkformQuickApply();">
					<input type="hidden" name="Type_Insurance" id="Type_Insurance" value="Req_Health_Insurance">
					<input type="hidden" name="source" id="source" value="SEO_D4L_HI Seo">
						<table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0" class="brdr5">
							<tr>
								<td style=" padding:12px;">
									<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
									<tr>
										<td height="30"  bgcolor="#FFFFFF" class="frmbldtxt" align="center"><h1 style="margin:0px; padding:0px;"> Apply For Health Insurance </h1></td>
									</tr>
								</table>
								</td>
							</tr>
						<tr>
						<td>
						<table width="98%" border="0" align="right" cellpadding="0" cellspacing="0"  id="frm">
						<tr>
						<td colspan="2" align="center">
							<table width="100%"  border="0" cellspacing="0" cellpadding="0">
							<tr>
							<td valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
							<tr valign="middle">
							<td width="14%" height="28" class="frmbldtxt" style="padding-top:3px; ">Full Name :</td>
							<td width="23%" height="28" class="frmbldtxt"  style="padding-top:3px; "><input type="text" name="fullname" id="fullname" style="width:140px;" maxlength="30"  onchange="insertData();" tabindex="1" /></td>
							<td width="10%" height="28" class="frmbldtxt" style="padding-top:3px; ">&nbsp;Mobile :</td>
							<td width="23%" height="28" class="frmbldtxt"  style="padding-top:3px; ">
							<table cellpadding="0" cellspacing="0" width="100%"><tr><td>+91</td><td><input type="text" name="mobile" id="mobile" style="width:90px;" maxlength="10" tabindex="2" /></td></tr></table>
							</td>
							<td width="9%" height="28" class="frmbldtxt" style="padding-top:3px; ">Email :</td>
							<td width="21%" height="28" class="frmbldtxt"  style="padding-top:3px; "><input type="text" name="email_id" style="width:150px;" id="email_id" /></td>
							</tr>
							</table>
						</td>
						<td width="220" valign="top">
							<table  border="0" cellspacing="0" cellpadding="0">
							<tr>
							<td height="28" class="frmbldtxt" width="70">&nbsp;&nbsp;City :</td>
							<td class="frmbldtxt"><select size="1"  style="width:150px;" name="city" id="city" onChange="cityother(); insertData();">
							<option value="Please Select">Please Select</option>
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
                                <option value="Others">Others</option>
							</select></td>
							</tr>
							</table>
						</td>
						</tr>
						<tr><td colspan="2">&nbsp;</td></tr>
						<tr>
						<td width="76%" align="left" class="frmbldtxt"  style="font-weight:normal;">
						<input type="checkbox" name="accept" style="border:none;" checked>
						I authorize Bimadeals.com & its partnering companies to contact me to explain the product & I Agree to <a href="http://www.bimadeals.com/Privacy.php" target="_blank" rel="nofollow">privacy policy</a> and <a href="http://www.bimadeals.com/Privacy.php" target="_blank" rel="nofollow">Terms and Conditions</a>.</td>
						<td width="24%"><input type="submit"  value="submit" style="background-image:url(http://www.bimadeals.com/images/gt-qut-btn.gif); cursor:pointer; background-repeat:no-repeat; width:109px; height:29px; background-position:center; border:none; font-size:0px;" name="submit"></td>
						</tr>
						</table></td>
						</tr>
						</table>
						</td></tr></table>
					</form>
				</td>
			</tr>
		</table>
	